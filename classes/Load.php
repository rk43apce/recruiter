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

	public static function  allCandidates($value='')
	{	
		
		$candidate = new Candidate();

		if (!$allCandidatesData = $candidate->getAllCandidates()) {

			Session::put("errorMsg", 'Sorry, no record found!');
			return false;				
		}

		return $allCandidatesData;
	}	

}