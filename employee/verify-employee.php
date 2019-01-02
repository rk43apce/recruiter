<?php
require_once '../core/init.php';
require_once '../functions/helper.php';
require_once '../functions/sanitize.php';

if ( !Input::exists( 'post' ) ) {

	Redirect::to( './index.php' );
}

if ( !Token::check2( 'addNewCandidate', Input::get( 'token' ) ) ) {

	Session::put( 'errorMsg', 'Fail to validate. Try again!' );
	Redirect::to( './index.php' );
}

$username = escape(Input::get('username'));

if(empty($username)) {
	
	Session::put( 'errorMsg', 'Sorry! to  validate. Try again!' );
	Redirect::to( './index.php' );	
}

$login =  new Login();

$result = $login->checkEmployeeExits( $username );

if ( !$result ) {

	Session::put( 'errorMsg', 'No record found!' );
	Redirect::to( 'index.php' );
	exit();
}

if ( empty( $result ) ) {

	Session::put( 'errorMsg', 'No record found!' );
	Redirect::to( 'index.php' );
	exit();
}

$employeeId = $result[ 'employeeId' ]; // getting employee id
$status = $result[ 'isActive' ]; // getting employee curret status acitve , pending or inactive

if ( $status === 'Inactive' ) {

	Session::put( 'errorMsg', 'Your account is deactivated!. Please contact admin!' );
	Redirect::to( 'index.php' );
	exit();

}

if ( $status === 'Pending' ) {

	Session::put( 'errorMsg', 'Your account is still not activated by the admin!. Please contact admin!' );
	Redirect::to( 'index.php' );
	exit();

}



if ( $status === 'Active' ) {

	// generate OTP
	$otp = rand( 100000, 999999 );

	if ( $login->saveOTP( $employeeId, $otp ) ) {

	
		$login->sendOTP( $otp );

	}

}

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
                    <form action="./verify-otp.php" method="post">
                        <fieldset>
                            <legend align="center">Verify OTP!</legend>
                            <p align="center" class="text-success">Check your email for the OTP</p>  
                           
                            <div class="line"></div>
                              
                            <div class="form-group">
                                <label>Your Email</label> 
                                <input type="email"  class="form-control form-control-lg" value="<?php echo $username; ?>" readonly>  
                                <a href="./index.php" class="btn-link">Change email address</a>                           
                            </div> 
                           
                                                        
                            <div class="form-group">
                                <label >Enter OTP</label> 
                                <input type="text"  name="otp" class="form-control form-control-lg" placeholder="Enter Your OTP here" required="" autofocus>                                                               
                            </div>                   
                           <input type="hidden" name="employeeId" value="<?php echo $employeeId;?>">              
                            <button type="submit" class="btn btn-primary btn-lg btn-block" >Verify OTP</button>
                        	<spaan>&nbsp;</spaan>
                            <a href="./index.php" class="text-secondary">Resend OTP</a>     
                        </fieldset>
                    </form> 
                </div>          
            </div>
        </div>
    </div>

    <?php require_once  '../include/footer.php'; ?>
    
</body>
</html>