<?php 
 
 require_once '../core/init.php';

if (!Input::exists('post')) {

	Redirect::to('./new-assingment.php');
	die();
}  

if (!Token::check2('newAssingment', Input::get('token'))) {

	Redirect::to('./new-assingment.php');
	die();
}

# code...
$assingmentId =  Input::get('assingmentId');
$companyId =  Input::get('companyId');
$jobRoleId =  Input::get('jobRoleId');
$jobCity =  Input::get('jobCity');
$noOfPosition =  Input::get('noOfPosition');
$clientBrief =  Input::get('clientBrief');
$spocId =  Input::get('spocId');
$recruiters =  Input::get('recruiters');
$createdOn = date("Y/m/d"); 

$assingmentData = array("assingmentId"=>$assingmentId, "companyId"=>$companyId, "jobRoleId"=>$jobRoleId, "jobCity"=>$jobCity, "noOfPosition"=>$noOfPosition, "clientBrief"=>$clientBrief, "spocId"=>$spocId, "createdOn"=>$createdOn);

$assingment = new Assingment();

$assingment->assingmentData = $assingmentData; // setting  class assingmentData
$assingment->recruiters = $recruiters;			// setting  class recruiters
$assingment->assingmentId = $assingmentId;		// setting  class assingmentId

$assingment->createNewAssingment();

if ($assingment->createNewAssingment()) {
	# code...
	Redirect::to('./dashboard.php');
} else {

	Redirect::to('./new-assingment.php');
}
