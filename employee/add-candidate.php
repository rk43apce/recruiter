<?php
require_once '../core/init.php';
require_once '../functions/helper.php';
require_once '../functions/sanitize.php';

if (Input::exists('post')) {

	if (Token::check2('addNewCandidate', Input::get('token'))) {
		/*Candidate id*/
		$candidateId =  escape(Input::get('candidateId'));
		/*Candidate personal info id*/
		$candidateFullName =  escape(Input::get('candidateFullName'));
		$candidateDOB =  escape(Input::get('candidateDOB'));
		$candidateEmail =  escape(Input::get('candidateEmail'));
		$candidateMobileNo =  escape(Input::get('candidateMobileNo'));
		$candidateCity =  escape(Input::get('candidateCity'));
		/*Candidate education history */
		$candiateDegrees =  Input::get('candiateDegrees');
		/*Candidate work history info id*/
		$candidateOrganisation =  escape(Input::get('candidateOrganisation'));
		$candidateDesignation =  escape(Input::get('candidateDesignation'));
		$candidateFunctionalAreaId =  escape(Input::get('candidateFunctionalAreaId'));
		$candidateNoticePeriod =  escape(Input::get('candidateNoticePeriod'));
		$candidateWorkExp =  escape(Input::get('candidateWorkExp'));
		$candidateSalary =  escape(Input::get('candidateSalary'));	
		
		// creating array 		
		$candidatePersonalData = array("candidateId"=>$candidateId, "candidateFullName"=>$candidateFullName, "candidateDOB"=>$candidateDOB, "candidateEmail"=>$candidateEmail, "candidateMobileNo"=>$candidateMobileNo, "candidateCity"=>$candidateCity);
		
		// creating array 		
		$candidateWorkExperience = array("candidateId"=>$candidateId, "candidateOrganisation"=>$candidateOrganisation, "candidateDesignation"=>$candidateDesignation, "candidateFunctionalAreaId"=>$candidateFunctionalAreaId, "candidateNoticePeriod"=>$candidateNoticePeriod, "candidateWorkExp"=>$candidateWorkExp, "candidateSalary"=>$candidateSalary);
		
		// instatiate candidate class 
		$candidate = new Candidate();
		
		
//		var_dump($candidate->addCandidate($candidatePersonalData));
//		
//		var_dump($candidate->addEducation($candidateId, $candiateDegrees));
//		
//		var_dump($candidate->addWorkExperience($candidateId, $candidateWorkExperience));
		
		
		
		
		
		

		
		
		
		
		
//		if($result  = $candidate->addNewCandidate($newCandidateData)) {
//			// on success redirec to 
//			Redirect::to('view-candidate-description.php?candidateId='.$candidateId);			
//			
//		} else {
//			// on failuer redirect back to form
//			Redirect::to('new-candidate.php');			
//		}		
		
	} else {
		Redirect::to('new-candidate.php');	
	}

} else {
	
	Redirect::to('new-candidate.php');	
}  



