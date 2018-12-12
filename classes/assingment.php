<?php

class Assingment extends Company
{	
	public $db;
	public $assingmentData;
	public $recruiters;
	public $assingmentId;	

	function __construct()
	{

		$this->db = new Database();

	}

	public function getOnGoingAssingment($value='')
	{
		
		$sql = " SELECT company.companyName, jobrole.jobRoleTitle, employee.employeeName, cities.cityName, jobrole.minWorkExperience, jobrole.maxWorkExperience, jobrole.minFixedSalary, jobrole.maxFixedSalary, assingment.assingmentId, assingment.createdOn 		
		FROM assingment 
		inner join(company) on company.companyId = assingment.companyId 
		inner join(jobrole) on jobrole.jobRoleId = assingment.jobRoleId 
		inner join(cities) on cities.cityId = jobrole.locationId 
		inner join(employee) on employee.employeeId = assingment.spocId";	
		
		

		$result =  $this->db->querySelect($sql);

		if (!$this->db->checkResultCountZero($result)) {
		
			return $this->db->processRowSet($result);

		} else {

			return false;
		}

	}
	
		public function getEmployeeLeaderAssingment($employeeId='')
	{
		
		$sql = " SELECT company.companyName, jobrole.jobRoleTitle, employee.employeeName, cities.cityName, jobrole.minWorkExperience, jobrole.maxWorkExperience, jobrole.minFixedSalary, jobrole.maxFixedSalary, assingment.assingmentId, assingment.createdOn 		
		FROM assingment 
		inner join(company) on company.companyId = assingment.companyId 
		inner join(jobrole) on jobrole.jobRoleId = assingment.jobRoleId 
		inner join(cities) on cities.cityId = jobrole.locationId 
		inner join(employee) on employee.employeeId = assingment.spocId
		where assingment.spocId	= '$employeeId'
		";	
		
		

		$result =  $this->db->querySelect($sql);

		if (!$this->db->checkResultCountZero($result)) {
		
			return $this->db->processRowSet($result);

		} else {

			return false;
		}

	}


	public function getOnGoingAssingmentById($assingmentId)
	{
		$sql = " SELECT  assingment.assingmentId, company.companyName, company.companyId, jobrole.jobRoleTitle,  jobrole.minWorkExperience, jobrole.maxWorkExperience,  assingment.spocId, cities.cityName,  assingment.createdOn, assingment.clientBrief, assingment.noOfPosition, employee.employeeName 
		FROM assingment 
		inner join(company) on company.companyId = assingment.companyId 
		inner join(jobrole) on jobrole.jobRoleId = assingment.jobRoleId 
		inner join(cities) on cities.cityId = jobrole.locationId 
		inner join(employee) on employee.employeeId = assingment.spocId 
		where assingment.assingmentId = '$assingmentId'";

		$result =  $this->db->querySelect($sql);

		if ($this->db->isResultCountOne($result)) {
			return $this->db->processRowSet($result, true);
		} else {
			return false;
		}

	}


	public function getAssingmentRecruiterByAssingmentId($assingmentId)
	{
	 $sql = " SELECT ra.recruiterId FROM `recruiterassingment` ra INNER JOIN employee on employee.employeeId = ra.recruiterId WHERE ra.assingmentId = '$assingmentId' and isAssingmentWithdraw = 'No'";

		$result =  $this->db->querySelect($sql);

		if (!$this->db->checkResultCountZero($result)) {
			return $this->db->processRowSet($result);
		} else {
			return false;
		}

	}

	public static function selected($employeeId, $arrayrRcruiter)
	{			
			if (!count($arrayrRcruiter)) {
				# code...
				return null;
			}

		 return (in_array($employeeId, $arrayrRcruiter))? "selected" : "";
	}


	public function assignAssingmnetToEmployee()
	{		
		foreach ($this->recruiters as $recruiterId) {

		echo	$sql = "INSERT INTO recruiterassingment (assingmentId, recruiterId, recruiterAssignOn) values ('$this->assingmentId', '$recruiterId',  NOW())";

			if (!$this->db->queryInset($sql)) {
		  	 	# code...
				return false;
			}		
		}
		return true;
	}


	public  function createNewAssingment()
	{

		$columns = "";
		$values = "";

		foreach ($this->assingmentData as $column => $value) {
			$columns .= ($columns == "") ? "" : ", ";
			$columns .= $column;
			$values .= ($values == "") ? "" : ", ";
			$values .= "'" . $value . "'";
		}
		$sql = "INSERT INTO assingment ($columns) values ($values)";

		if (!$this->db->queryInset($sql)) {
			
			return false;
		}

		if (!count($this->assingmentId)) {

			Session::put('errorMsg', 'Success! Jobrole  added in database!');
			return true;
		} 

		if (!$this->assignAssingmnetToEmployee()) {
		# code...
			return false;
		}

		Session::put('errorMsg', 'Success! Jobrole  added in database!');
		return true;		
	}



	public  function updateAssingment($assingmentId, $assingmentData, $recruiters)
	{	

		$out = array();

		foreach ($assingmentData as $column => $value) {

			array_push($out, "$column='$value'");
		}

		$set = implode(', ', $out);

		$sql = "UPDATE assingment SET $set where assingmentId = '$assingmentId'";	

		if (!$this->db->queryUpdate($sql)) {

		 	return false;	

		}

		if (!$this->updateAssignmentRecruiter($assingmentId, $recruiters)) {
			
			return false;
		}

		return true;

	}


	public function updateAssignmentRecruiter($assingmentId, $recruiters)
	{	
			
		$recruiterData = $this->getAssingmentRecruiterByAssingmentId($assingmentId);	

		$arrayrRcruiter = array();

		foreach ($recruiterData as $key => $recruiter) {	 	

			array_push($arrayrRcruiter,$recruiter['recruiterId']);

		}
		
		$sql  = "UPDATE `recruiterassingment` SET `isAssingmentWithdraw` = 'Yes', recruiterWithdrawOn = NOW() WHERE recruiterId NOT IN ( '" . implode( "', '" , $recruiters ) . "' ) AND assingmentId = '$assingmentId' ";

			if (!$this->db->queryUpdate($sql)) {

			return false;	

		}



		$arrayNewRecruiters = array_diff($recruiters, $arrayrRcruiter);

		if ($arrayNewRecruiters) {			

			foreach ($arrayNewRecruiters as $column => $newRecruiter) {

			
				$sql = "INSERT INTO recruiterassingment (assingmentId, recruiterId, recruiterAssignOn) values ('$assingmentId', '$newRecruiter', NOW())";

				if (!$this->db->queryInset($sql)) {

					return false;

				}			

			}

			return true;

		}		

		return true;
	}


}