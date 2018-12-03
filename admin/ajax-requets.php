<?php require_once '../core/init.php';
require_once '../functions/sanitize.php';

Login::isUservalid('admin');  

(!Input::exists('post')) ?  Redirect::to('./companies.php') : "";

$employeeId = Input:: get('employeeId');

if (!empty($employeeId)) {

	$employee =	new Employee();
	
	if ($employee->updateEmployeeStatus($employeeId)) {
		# code...
		echo "Employee status successfully update!";
		
	}else {

		echo "Sorry! fail to update employee status";
	}

}


