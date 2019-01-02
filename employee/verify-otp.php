<?php 
require_once '../core/init.php';
require_once '../functions/helper.php';
require_once '../functions/sanitize.php';


if(Input::exists('post')) {
	
		$login =  new Login();
	
		$employeeId = escape(Input::get('employeeId'));
		$otp = escape(Input::get('otp'));		
		
		if($login->verifyOTP($employeeId, $otp)) {
			
			$result = $login->checkEmployeeExits( $employeeId );
			
			var_dump($result);
			
			$login->destroyOTP($employeeId, $otp);
			
		} else {
			Redirect::to('verify-employee.php')
		}
			
		

		
	
}
