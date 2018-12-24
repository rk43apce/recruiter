<?php 
require_once '../core/init.php';
require_once '../functions/helper.php';
$candidate =  new Candidate();

if(isset($_POST['email'])) {
		
$candidateEmailId = $_POST['email'];

	if($candidate->checkEmailAvailability($candidateEmailId)){
		
		echo 'available';
	}else {
		echo 'notAvailable';
	}
	
}
?>