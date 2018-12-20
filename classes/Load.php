<?php

class Load  {


	function __construct($foo = null)
	{
		Login::isUservalid('employee');
	}

	public static function  employeeAssingment($value='')
	{	


		$employee = new Employee();

		if (!$assingmentData = $employee->getEmployeeLeaderAssingment(Session::get('userId'))) {

			Session::put("errorMsg", 'Sorry! No ongoing assignment assign to you!');
			return false;				
		}

		return $assingmentData;

	}	

	public static function  allCandidates($assingmentId='')
	{	
		
		$candidate = new Candidate();

		if (!$allCandidatesData = $candidate->getAllCandidates($assingmentId = '')) {

			Session::put("errorMsg", 'Sorry, no record found!');
			return false;				
		}

		return $allCandidatesData;
	}
	
	
	public static function  unShortlistCandidate($assingmentId='')
	{	
		
		$candidate = new Candidate();

		if (!$allCandidatesData = $candidate->getunShortlistCandidate($assingmentId = '')) {

			Session::put("errorMsg", 'Sorry, no record found!');
			return false;				
		}

		return $unShortlistCandidateData;
	}
	
	
	
	public static function  shortlistCandidates($assingmentId)
	{	
		
	$candidate = new Candidate();

	if (!$shotlsietCandidatesData = $candidate->getShortlistCandidates($assingmentId)) {

	Session::put("errorMsg", 'Sorry, no record found!');
	return false;	

	}

	return $shotlsietCandidatesData;
		
	}
	

}