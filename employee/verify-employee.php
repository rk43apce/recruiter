<?php 
require_once '../core/init.php';
require_once '../functions/helper.php';

$login =  new Login();

if(isset($_POST['email'])) {
		
	$employeeEmailId = $_POST['email'];
	
	$result = $login->checkEmployeeExits($employeeEmailId);

	if(!$result) {

		Session::put('errorMsg', 'No record found!');
		Redirect::to('index.php');
		exit();
	}

	if(empty($result)) {
	
		Session::put('errorMsg', 'No record found!');
		Redirect::to('index.php');
		exit();		
	}
	
	$employeeId =  $result['employeeId'];	// getting employee id
	$status =  $result['isActive'];	// getting employee curret status acitve , pending or inactive

	if($status === 'Inactive' ) {

		Session::put('errorMsg', 'Your account is deactivated!. Please contact admin!');
		Redirect::to('index.php');
		exit();	

	}

	if($status === 'Pending' ) {

		Session::put('errorMsg', 'Your account is still not activated by the admin!. Please contact admin!');
		Redirect::to('index.php');
		exit();	

	}

	if($status === 'Active' ) {

		// generate OTP
		$otp = rand(100000,999999);
		echo '<br> =================================================================== <br>';
		if($login->saveOTP($employeeId, $otp)) {

			$login->sendOTP($otp);

		}
		echo '<br> =================================================================== <br>';
		// $login->verifyOTP($employeeId, $otp);

		var_dump($login->verifyOTP($employeeId, $otp));
			
		echo '<br> =================================================================== <br>';

		var_dump($login->destroyOTP($employeeId, $otp));

		// var_dump(Session::put('employeeId', $employeeId));		
		// Redirect::to('dashboard.php');
		// exit();	

	}
	
	
}
