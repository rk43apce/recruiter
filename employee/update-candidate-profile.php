<?php
require_once '../core/init.php';
require_once '../functions/helper.php';
require_once '../functions/sanitize.php';

if (Input::exists('post')) {

	if (Token::check2('updateCandidateRecord', Input::get('token'))) {

		
		/*================================Candidate id ==============================================*/
		$candidateId =  escape(Input::get('candidateId'));

		if (empty($candidateId)) {
			
			Redirect::to('dashboard.php');
		}

		/*================================Candidate personal info ==============================================*/
		$candidateFullName =  escape(Input::get('candidateFullName'));
		$candidateDOB =  escape(Input::get('candidateDOB'));
		$candidateEmail =  escape(Input::get('candidateEmail'));
		$candidateMobileNo =  escape(Input::get('candidateMobileNo'));
		$candidateCity =  escape(Input::get('candidateCity'));


		/*================================Candidate education ==============================================*/
		$candiateDegrees =  Input::get('candiateDegrees');


		/*================================Candidate work history==============================================*/
		$candidateOrganisation =  escape(Input::get('candidateOrganisation'));
		$candidateDesignation =  escape(Input::get('candidateDesignation'));
		$candidateFunctionalAreaId =  escape(Input::get('candidateFunctionalAreaId'));
		$candidateNoticePeriod =  escape(Input::get('candidateNoticePeriod'));
		$candidateWorkExp =  escape(Input::get('candidateWorkExp'));
		$candidateSalary =  escape(Input::get('candidateSalary'));			



		$candidatePersonalData = array("candidateFullName"=>$candidateFullName, "candidateDOB"=>$candidateDOB, "candidateEmail"=>$candidateEmail, "candidateMobileNo"=>$candidateMobileNo, "candidateCity"=>$candidateCity);


		$candidate = new Candidate(); 

		$updateStatus = true;
		/*================================Update candidate  profile ==============================================*/	
		if (!empty($candidatePersonalData)) {	

			if (!$candidate->updateCandidateProfile($candidatePersonalData, $candidateId )) {				

				Session::put('updateWorkExperience', 'Fail to update Work experience, try again!');
				$updateStatus = false;
			}
		}


		/*================================Array candidate work experience ==============================================*/
		$workExperienceData = array("candidateOrganisation"=>$candidateOrganisation, "candidateDesignation"=>$candidateDesignation, "candidateFunctionalAreaId"=>$candidateFunctionalAreaId, "candidateNoticePeriod"=>$candidateNoticePeriod, "candidateWorkExp"=>$candidateWorkExp, "candidateSalary"=>$candidateSalary);

		/*================================Update candidate  work experience ==============================================*/
		if (!empty($workExperienceData)) {

		
			if (!$candidate->updateWorkExperience($workExperienceData, $candidateId )) {			

				Session::put('updateWorkExperience', 'Fail to update Work experience, try again!');
				$updateStatus = false;

			}			
		
		}			


		/*================================Update candidate  work experience ==============================================*/
		if (!empty($candiateDegrees)) {
				
			$arrayCandiddateSavedDegrees =  ArrayPush::makeArray($candidate->getEducation($candidateId));

			$dropDegrees = array_diff($arrayCandiddateSavedDegrees, $candiateDegrees);	

			if (!empty($dropDegrees)) {

				if (!$candidate->updateEducationHistory($dropDegrees, $candidateId )) {
					# code...
					Session::put('updateEducationHistory', 'Fail to update Work experience, try again!');
					$updateStatus = false;
				}

			}

			$arrayNewDegrees = array_diff($candiateDegrees, $arrayCandiddateSavedDegrees);

			if (!empty($arrayNewDegrees)) {	

				if ($candidate->addEducation( $candidateId, $arrayNewDegrees )) {
					
					Session::put('updateEducationHistory', 'Fail to update Work experience, try again!');
					$updateStatus = false;
				}
		
			}				 		 

		}

		if ($updateStatus) {

			
		
			Session::put('errorMsg', 'Candidate profile successfully updated!');
		}

		// Redirect::to('view-candidate-description.php?candidateId='.$candidateId);
		
	} else {
		Redirect::to('view-assingment-description.php?assingmentId='.Input::get('assingmentId'));
	}

} else {
	
	Redirect::to('view-assingment-description.php?assingmentId='.Input::get('assingmentId'));
}  



