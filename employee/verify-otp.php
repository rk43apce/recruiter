<?php 
require_once '../core/init.php';
require_once '../functions/helper.php';
require_once '../functions/sanitize.php';


if(!Input::exists('post')) {
	
	$url = 'http://' . $_SERVER['HTTP_HOST'];
	Redirect::to($url);
	echo "inValidRequest";
	exit();	
}

$login =  new Login();

$email = escape(Input::get('email'));
$otp = escape(Input::get('otp'));

$result = $login->checkEmployeeExits( $email );

$employeeId = $result[ 'employeeId' ]; // getting employee id
$status = $result[ 'isActive' ]; // getting employee curret status acitve , pending or inactive

if ($login->verifyOTP($employeeId, $otp)) {
	
		if ($login->getEmployee($employeeId)) {

			$login->destroyOTP($employeeId);
			echo "loginSuccess";
			exit();
		}

} else {

	echo "loginFail";
}


