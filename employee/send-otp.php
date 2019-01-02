<?php
require_once '../core/init.php';
require_once '../functions/helper.php';
require_once '../functions/sanitize.php';

if ( !Input::exists( 'post' ) ) {

	$url = 'http://' . $_SERVER['HTTP_HOST'];
	Redirect::to($url);
	echo "inValidRequest";
	exit();	
}



$username = escape(Input::get('username'));

$login =  new Login();

$result = $login->checkEmployeeExits( $username );

if (!$result) {

	echo "noAccount";
	exit();
}


$employeeId = $result[ 'employeeId' ]; // getting employee id
$status = $result[ 'isActive' ]; // getting employee curret status acitve , pending or inactive



if ( $status === 'Active' ) {

	// generate OTP
	$otp = rand( 100000, 999999 );

	if ( $login->saveOTP( $employeeId, $otp ) ) {
	
		$login->sendOTP($username, $otp );

		echo 'Active';

	}



} else {

	echo $status;

}

