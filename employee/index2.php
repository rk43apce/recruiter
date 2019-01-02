<?php 
require_once '../core/init.php';
require_once '../functions/helper.php';
?>
<!DOCTYPE html>
<html>

<head>
<?php require_once  '../include/css.php'; ?>   
<style type="text/css">
    .box-login {
        width: 90%;
        max-width: 460px;            
        margin-left: auto;
        margin-right: auto;
        margin-top: 10%;
    }
</style>

</head>

<body>

    <div class="container">
        <div class="box-login">
            <div  class="card">       
            <div class="card-body">     
                    <!-- <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> -->
                    <form action="" method="post">
                        <fieldset>
                            <legend align="center">Welcome!</legend>
                            <p align="center">Sign in by entering the information below</p>  
                            <p class="text-danger">
                            <?php echo (Session::exists('errorMsg'))? Session::flash('errorMsg') : "" ;?>
                            </p>
                            <div class="line"></div>                
                            <div class="form-group">
                                <label for="exampleInputEmail1">Enter Your Login Email</label> 
                                <input type="email" id="email" name="username" class="form-control form-control-lg" placeholder="Enter your email" required="" autofocus>
                                <a class="text-secondary" href="javascript:void(0);" onclick="refresh();">Change Email</a>
                                 <div id="status" class=""></div>
                            </div>
                                                                                                            
                           <div class="form-group">
                                <label style="display: none;" >Enter OTP</label> 
                                <input type="text" id="otp"  name="otp" class="form-control form-control-lg" placeholder="Enter Your OTP here" required="" autofocus style="display: none;">
                                 <div id="otpStatus" class=""></div>
                            </div>

                            <div class="form-group" id="resendBox" style="display: none;">                          
	                            <p style="text-align: center;" >
	                            	Don't Recieved Code? <a href="javascript:void(0);" onclick="resendOTP();" class="btn-link" >Resend Now</a>
	                            </p>    
                            </div>

                            <button id="verifyotp" onclick="verifyOTP();"  class="btn btn-primary btn-lg btn-block" disabled="">Verify OTP</button>
                        </fieldset>
                    </form> 
                </div>          
            </div>
        </div>
    </div>

    <?php require_once  '../include/footer.php'; ?>

    <script type="text/javascript">

    $('#otp').on('keyup keypress blur change', function(e) {

        if($(this).val().trim().length == 6) {

            var otp =  $('#otp').val();

            if($.isNumeric(otp)){

            $('#verifyotp').prop('disabled', false);
            $("#verifyotp").focus();

            } else {

                alert('Invalid Input!. Only numeric value allowed.');
            }   

        } else {
        // Disable submit button
        $('#verifyotp').prop('disabled', true);
        }

    });


	$( document ) . ready( function () {
	   $( "#email" ) . change( function () {
	       var email = $( "#email" ) . val();                
	        if (isEmailValid(email)) {
	            sendOtp( email );                   
	        } else {
	            alert('Please enter a valid email addeess!');
	            errorMsg('Please enter a valid email addeess!');  
	             $("#otp").hide();                  
	        }
	   } );
	} );

    function sendOtp( email ) {

        $( "#status" ) . html( 'Checking availabil	ity...' );
        $ . ajax( {
            type: "POST",
            url: "send-otp.php",
            data: "username=" + email,
            dataType: 'text',
            success: function ( msg ) {   
                checkStatus(msg);
            }
        } );
    } 

    function isEmailValid(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/; 
        return regex.test(email);
    }      

    function checkStatus(msg) {
        if ( msg == 'Active' ) { 
            $("#email").prop("readonly", true);            
            successMsg('<h6>Please check your email for the OTP<h6>');
            $("#otp").show().focus();
            $("#resendBox").show();  

        } else if ( msg == 'Inactive' ) { 
        $('#verifyotp').prop('disabled', true);
            errorMsg('Your account is still not activ!. Please contact admin!'); 
            $("#otp").hide();
        } else {
            $('#verifyotp').prop('disabled', true);
            errorMsg('Sorry!. No such account.');
            $("#otp").hide();
        }
    }

    function errorMsg(msg) {
        $( "#email" ) . removeClass( "is-valid" );
        $( "#status" ) . removeClass( "valid-feedback" );
        $( "#email" ) . addClass( "is-invalid" );
        $( "#status" ) . addClass( "invalid-feedback" );
        $( "#status" ) . html( "&nbsp;" + msg ); 
    }   
    
    function successMsg(msg) {
        $( "#email" ) . removeClass( "is-invalid" );
        $( "#status" ) . removeClass( "invalid-feedback" );
        $( "#email" ) . addClass( "is-valid" );
        $( "#status" ) . addClass( "valid-feedback" );
        $( "#status" ) . html( "&nbsp;" + msg ); 
    }

    function verifyOTP(argument) {
        // body...
        event.preventDefault();

        if (confirm('Are you sure?')) {

        var otp =  $('#otp').val();
        var email =  $('#email').val();

        $( "#verifyotp" ) . html( 'Please wait...' );
            $ . ajax( {
            type: "POST",
            url: "verify-otp.php",
            data:{otp:otp, email:email},
            dataType: 'text',
            success: function ( msg ) {   

                alert(msg);
                if (msg == 'loginSuccess') {
                    // Sets the new href (URL) for the current window.
                    window.location.href = "./dashboard.php";
                } else {

                    otpMsg('Sorry!. Invalid OTP. Try again.');                    
                }

            }
        } );

       } else {

            return false;
       }     
    }

    function refresh(argument) {
        // body...
        location.reload();
    }

    function otpMsg(msg) {
        $( "#verifyotp" ) . html( 'Verify OTP' );
        $( "#otp" ) . removeClass( "is-valid" );
        $( "#otpStatus" ) . removeClass( "valid-feedback" );
        $( "#otp" ) . addClass( "is-invalid" );
        $( "#otpStatus" ) . addClass( "invalid-feedback" );
        $( "#otpStatus" ) . html( "&nbsp;" + msg );
    }

    function resendOTP() {

		let  email = $('#email').val();
		sendOtp(email);
    }

    </script>



</body>

</html>