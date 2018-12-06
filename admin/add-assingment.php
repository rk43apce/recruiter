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
$frontingEntity =  Input::get('frontingEntity');
$jobCity =  Input::get('jobCity');
$noOfPosition =  Input::get('noOfPosition');
$clientBrief =  Input::get('clientBrief');
$spocId =  Input::get('spocId');
$priority =  Input::get('priority');
$recruiters =  Input::get('recruiters');
$createdOn = date("Y/m/d"); 

$assingmentData = array("assingmentId"=>$assingmentId, "companyId"=>$companyId, "jobRoleId"=>$jobRoleId, "frontingEntity"=>$frontingEntity, "jobCity"=>$jobCity, "noOfPosition"=>$noOfPosition, "clientBrief"=>$clientBrief, "noOfPosition"=>$noOfPosition, "spocId"=>$spocId, "priority"=>$priority, "createdOn"=>$createdOn);

$assingment = new Assingment();

$assingment->assingmentData = $assingmentData; // setting  class assingmentData
$assingment->recruiters = $recruiters;			// setting  class recruiters
$assingment->assingmentId = $assingmentId;		// setting  class assingmentId

if ($assingment->createNewAssingment()) {
	# code...
	Session::put('errorMsg', 'Assignment successfully created!');
	Redirect::to('./ongoing-assignment.php');

} else {

	Redirect::to('./new-assingment.php');
}
