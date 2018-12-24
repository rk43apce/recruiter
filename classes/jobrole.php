<?php

/**
 * 
 */
class Jobrole extends FunctionalArea
{	
	public $db;
	public $jobRoleData;
	public $jobRoleSkills;
	public $jobRoleId;
	
	function __construct()
	{
		$this->db = new Database();
	}



	public  function createNewJobRole()
    {
    
		$columns = "";
		$values = "";

		foreach ( $this->jobRoleData as $column => $value) {
			$columns .= ($columns == "") ? "" : ", ";
			$columns .= $column;
			$values .= ($values == "") ? "" : ", ";
			$values .= "'" . $value . "'";
		}

		$sql = "INSERT INTO jobrole ($columns, createdOn) values ($values, NOW())";		

		if (!$this->db->queryInset($sql)) { // query execute


			var_dump($this->db->queryInset($sql));

			// Session::put('errorMsg', 'Sorry!,  fail to add job in database!');
			// return false;

		}

		if (!count($this->jobRoleSkills)) {

			Session::put('errorMsg', 'Success!,  Jobrole  added in database!');
			return true;
		} 

		if (!$this->addJobRoleSkills()) {
		# code...
			return false;
		}

		Session::put('errorMsg', 'Success!,  Jobrole  added in database!');
		return true;
    }

    	public function addJobRoleSkills()
	{			

		foreach ( $this->jobRoleSkills as $jobRoleSkill) {

		  $sql = "INSERT INTO jobroleskill (jobRoleId, skillId, jobRollSkillCreatedOn) values ('$this->jobRoleId', '$jobRoleSkill', NOW())";

		  	 if (!$this->db->queryInset($sql)) {
		  	 	# code...
		  	 	return fasle;
		  	 }
		}

		return true;
	
	}


		public function getJobRoleByCompanyId($companyId)
	{
			
		$sql = " SELECT *  FROM  jobrole inner join  functionalareas on jobrole.functionalAreaId = functionalareas.functionalareaId where jobrole.companyId =  $companyId";	

		$result =  $this->db->querySelect($sql);

		if (!$this->db->checkResultCountZero($result)) {
			# code...
			// return $this->db->processRowSet($result);
			return $this->db->processRowSet($result);
			// return false;

		} else {

			return false;
		}

	}


	public function getJobRoleByJobRoleId($jobRoleId)
	{
			
	// echo $sql = " SELECT *  FROM  jobrole jb inner join  functionalareas fn on jb.functionalAreaId = fn.functionalareaId inner join(company) on company.companyId = jb.companyId    where jb.jobRoleId = '$jobRoleId'";	

		$sql = "SELECT * FROM jobrole jb inner join functionalareas fn on jb.functionalAreaId = fn.functionalareaId inner join(company) on company.companyId = jb.companyId inner join(cities) on cities.cityId = jb.locationId where jb.jobRoleId = '$jobRoleId'";

		$result =  $this->db->querySelect($sql);

		if ($this->db->isResultCountOne($result)) {
		
			return $this->db->processRowSet($result, true);

		} else {

			return false;
		}

	}


			/*============================= add get job description  ==========================================*/

	public function getJD( $jobRoleId ) {

		$sql = " SELECT *  FROM jdTracker
			
		where jdTracker.jobRoleId = '$jobRoleId' ";

		$result = $this->db->querySelect( $sql );

		if ( !$this->db->isResultCountOne( $result ) ) {
			return false;
		}

		return $this->db->processRowSet( $result, true );

	}	



	/*============================= add get candidate by candidate id  ==========================================*/

	public function getJobRoleSkills($jobRoleId)
	{

		$sql = " SELECT *  FROM jobroleskill  inner join(skillbank) on skillbank.skillId =  jobroleskill.skillId  where jobRoleId = '$jobRoleId' AND isJobRoleSkillDrop = 'No' ";

		$result =  $this->db->querySelect($sql);

		if ($this->db->checkResultCountZero($result)) {

			return false;
		} 

		return $this->db->processRowSet($result);
	}






	public  function updateJobRole($jobRoleId, $jobRoleDataToUpdate, $jobRoleSkills)
	{	


		$out = array();

		foreach ($jobRoleDataToUpdate as $column => $value) {

			array_push($out, "$column='$value'");
		}

		$set = implode(', ', $out);

		$sql = "UPDATE jobrole SET $set where jobRoleId = '$jobRoleId'";	

		if (!$this->db->queryUpdate($sql)) {

			Session::put('errorMsg', 'Sorry! Fail to update, please try again.');

		 	return false;
		}

		if (!$this->updateJobRoleSkills($jobRoleId, $jobRoleSkills)) {
			return false;
		}

		return true;
		
	}



	public function updateJobRoleSkills($jobRoleId, $jobRoleSkills)
	{	
		// getting all skill job with Jobrole
		
		$currentJobroleSkillsData = $this->getAssingmentSkillsByAssingmentId($jobRoleId);
	
		$arraySkillId = array();

		// creating array of skills
		foreach ($currentJobroleSkillsData as $key => $skill) {	 	

			array_push($arraySkillId,$skill['skillId']);
		}


		// Drop skills 
		if (!empty($jobRoleSkills)) {

		

			$sql  = "UPDATE `jobroleskill` SET `isJobRoleSkillDrop` = 'Yes', jobRoleSkillDropOn = NOW() WHERE skillId NOT IN ( '" . implode( "', '" , $jobRoleSkills ) . "' ) AND jobRoleId = '$jobRoleId' ";

			if (!$this->db->queryUpdate($sql)) {

			return false;	

			}
			
		}


		// getting diffrence of old and new jobrole skills 

		$arrayNewJobRoleSkills = array_diff($jobRoleSkills, $arraySkillId);

		if ( empty($arrayNewJobRoleSkills)) {			

			return true;

		}	

		// Insert new skill for jobrole 

		foreach ($arrayNewJobRoleSkills as $column => $newSkill) {

		$sql = "INSERT INTO jobroleskill (jobRoleId, skillId, jobRollSkillCreatedOn) values ('$jobRoleId', '$newSkill', NOW())";

			if (!$this->db->queryInset($sql)) {

			return false;

			}			

		}

		return true;	

	}



	/*============================= add get candidate by candidate id  ==========================================*/

	public function getCurrency()
	{

		$sql = " SELECT *  FROM currency";

		$result =  $this->db->querySelect($sql);

		if ($this->db->checkResultCountZero($result)) {

			return false;
		} 

		return $this->db->processRowSet($result);
	}


}