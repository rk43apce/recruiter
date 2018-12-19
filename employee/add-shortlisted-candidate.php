<?php 

require_once '../core/init.php';
require_once '../functions/helper.php';
require_once '../functions/sanitize.php';

if (!Input::exists('post')) {
	
	Redirect::to('dashboard.php');
	exit();
}

$assingmentId =  escape(Input::get('assingmentId'));
$candidateId =  escape(Input::get('candidateId'));
$shortlistBy = Session::get('userId');
$shortlistOn = date("Y/m/d"); 

if ( empty($assingmentId)) {
	Session::put('errorMsg', 'Sorry, Fail to save candidate. Please try again!');
	Redirect::to('dashboard.php');
	exit();
}

if ( empty($candidateId)) {	
	Session::put('errorMsg', 'Sorry, Fail to save candidate. Please try again!');
	Redirect::to('dashboard.php');
	exit();
}

if ( empty($shortlistBy)) {	
	
	Session::put('errorMsg', 'Sorry, Your session is expire. Please logout and try again!');	
	Redirect::to('dashboard.php');
	exit();
}

if ( empty($shortlistOn)) {
	Session::put('errorMsg', 'Sorry, Fail to save candidate. Please try again!');
	Redirect::to('dashboard.php');
	exit();
}



// creating array 		
$Data = array("assingmentId"=>$assingmentId, "candidateId"=>$candidateId, "shortlistBy"=>$shortlistBy, "shortlistOn"=>$shortlistOn);

$shortlist  = new Shortlist();

//$shortlist->exists($assingmentId, $candidateId);

if($shortlist->exists($assingmentId, $candidateId)) {
	Session::put('errorMsg', 'Candidate already shortlisted!');
	Redirect::to('view-assingment-description.php?assingmentId='.$assingmentId);
}

if (!$shortlist->candidate($Data)) {
	Session::put('errorMsg', 'Sorry, Fail to shortlist candidate. Please try again!');
	Redirect::to('shortlist.php?assingmentId='.$assingmentId);	
}

Session::put('errorMsg', 'Success! candidate succesfully shortlised.');
Redirect::to('view-assingment-description.php?assingmentId='.$assingmentId);

?>