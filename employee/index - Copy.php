
<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once '../core/init.php'; 

?>
<!DOCTYPE html>
<html>

<head>
    <?php require_once  '../include/css.php'; ?>   
    <style type="text/css">
        .box-login {
            max-width: 686px;
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
                    <form action="./verify-employee.php" method="post">
                        <fieldset>
                            <legend>Log In</legend>  
                            <p class="text-danger">
                            <?php echo (Session::exists('errorMsg'))? Session::flash('errorMsg') : "" ;?>
                            </p>
                            <div class="line"></div>                
                            <div class="form-group">
                                <label for="exampleInputEmail1">Enter Your Login Email</label> 
                                <input type="email" id="" name="email" class="form-control" placeholder="Username" required="" autofocus>
                                <div id="status" class=""></div>
                            </div>

                            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">  
                            <button type="submit" class="btn btn-primary" >Send OTP</button>
                        </fieldset>
                    </form> 
                </div>          
            </div>
        </div>
    </div>

    <?php require_once  '../include/footer.php'; ?>

    <script type="text/javascript">
        $( document ) . ready( function () {

            $( "#email" ) . change( function () {
                var usr = $( "#email" ) . val();    

                checkingAvailability(usr);

            } );
        } );


        function checkingAvailability( usr ) {

            $( "#status" ) . html( 'Checking availability...' );
            $ . ajax( {
                type: "POST",
                url: "send-otp.php",
                data: "email=" + usr,
                dataType: 'text',
                success: function ( msg ) {
                    if ( msg == 'available' ) { 
                        alert(msg);                   

                    } else {                    
                        alert(msg); 

                        $(':input[type="submit"]').prop('disabled', false);

                    }
                }
            } );
        }   

    </script>

</body>

</html>