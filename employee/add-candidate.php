<?php
require_once '../core/init.php';
require_once '../functions/helper.php';
require_once '../functions/sanitize.php';

if (Input::exists('post')) {

	if (Token::check2('addNewCandidate', Input::get('token'))) {
		$candidateId =  escape(Input::get('candidateId'));
		$assingmentId =  escape(Input::get('assingmentId'));
		$candidateFullName =  escape(Input::get('candidateFullName'));
		$candidateDOB =  escape(Input::get('candidateDOB'));
		$candidateEmail =  escape(Input::get('candidateEmail'));
		$candidateMobileNo =  escape(Input::get('candidateMobileNo'));
		$candidateCity =  escape(Input::get('candidateCity'));
		$candidateOrganisation =  escape(Input::get('candidateOrganisation'));
		$candidateDesignation =  escape(Input::get('candidateDesignation'));
		$candidateFunctionalAreaId =  escape(Input::get('candidateFunctionalAreaId'));
		$candidateNoticePeriod =  escape(Input::get('candidateNoticePeriod'));
		$candidateWorkExp =  escape(Input::get('candidateWorkExp'));
		$candidateSalary =  escape(Input::get('candidateSalary'));
		$candidateCreatedOn =  $createdOn = date("Y/m/d");	
		
		$newCandidateData = array("candidateId"=>$candidateId, "assingmentId"=>$assingmentId, "candidateFullName"=>$candidateFullName, "candidateDOB"=>$candidateDOB, "candidateEmail"=>$candidateEmail, "candidateMobileNo"=>$candidateMobileNo, "candidateCity"=>$candidateCity, "candidateOrganisation"=>$candidateOrganisation, "candidateDesignation"=>$candidateDesignation, "candidateFunctionalAreaId"=>$candidateFunctionalAreaId, "candidateNoticePeriod"=>$candidateNoticePeriod, "candidateWorkExp"=>$candidateWorkExp, "candidateSalary"=>$candidateSalary, "candidateCreatedOn"=>$candidateCreatedOn);
		
		$candidate = new Candidate();
		$candidate->candidateId = $candidateId;
		$candidate->candiateDegrees = Input::get('candiateDegrees');		
		
		if($result  = $candidate->addNewCandidate($newCandidateData)) {
			// on success redirec to 
			Redirect::to('view-candidate-description.php?candidateId='.$candidateId);			
			
		} else {
			// on failuer redirect back to form
			Redirect::to('view-assingment-description.php?candidateId='.Input::get('assingmentId'));			
		}		
		
	} else {
		Redirect::to('view-assingment-description.php?assingmentId='.Input::get('assingmentId'));
	}

} else {
	
	Redirect::to('view-assingment-description.php?assingmentId='.Input::get('assingmentId'));
}  



