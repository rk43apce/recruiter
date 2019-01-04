<?php
require_once '../core/init.php';
require_once '../functions/sanitize.php';

Login::isUservalid('admin');  

if(isset($_POST["image"]))
{
	$data = $_POST["image"];

	$image_array_1 = explode(";", $data);

	$image_array_2 = explode(",", $image_array_1[1]);

	$data = base64_decode($image_array_2[1]);

	$pictureName = time() . '.jpeg';
		
		if(file_put_contents('../upload/pic/'.$pictureName, $data)) {	
			
			$employee = new Employee();	
			if($employee->picture($pictureName, Session::get('employeeId'))) {
				
				Session::put('pictureName', $pictureName);	
				echo 'true';	
				
			} else {
				echo 'false';
			}
			
		} else {
				echo 'false';
		}

}else {
	echo 'false';
}