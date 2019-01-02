<?php 
require_once '../core/init.php';
require_once '../functions/sanitize.php';

Login::auth('employeeId');

if (!Input::exists('post')) {
	
	Session::put('errorMsg', 'Sorry!, Validation fail! ');
	Redirect::to('./dashboard.php');
	
}	

if (!Token::check2('addCandidateStatus', Input::get('token'))) {	
	
	Session::put('errorMsg', 'Sorry!, Validation fail! ');
	Redirect::to('./dashboard.php');
	
}	

if(!Session::exists('employeeId')) {

	Session::put('errorMsg', 'Sorry!, Your session is expire. Please login and try again! ');			

	Redirect::to('./employees.php');

}

if(empty(Session::get('employeeId'))) {

	Session::put('errorMsg', 'Sorry!, Your session is expire. Please login and try again! ');	
	Redirect::to('./employees.php');

}		

$assingmentId =  Input::get('assingmentId');
$candidateId =  Input::get('candidateId');
$employeeId =  Session::get('employeeId');	
$stageId =  Input::get('stageId');	
$note =  escape(Input::get('note'));

if(empty($assingmentId) || empty($candidateId) || empty($employeeId) || empty($employeeId)) {

	Session::put('errorMsg', 'Sorry!, Validation fail! ');
	Redirect::to('./dashboard.php');
}		

$candidateStageData = array("employeeId"=>$employeeId, "assingmentId"=>$assingmentId, "candidateId"=>$candidateId, "stageId"=>$stageId, "note"=>$note);

$candidate = new Candidate();

if ($candidate->addStage($candidateStageData)) {	

	Session::put('errorMsg', 'Success!, Candidate stage successfully updated!');	
	Redirect::to($_SERVER['HTTP_REFERER']);
	
} else {
	
	Session::put('errorMsg', 'Sorry!, Fail to  update. Please try again!');	
	Redirect::to($_SERVER['HTTP_REFERER']);
} 	
   
    
?>