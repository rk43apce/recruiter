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

		$sql = "INSERT INTO jobrole ($columns) values ($values)";		

		if (!$this->db->queryInset($sql)) { // query execute

			Session::put('errorMsg', 'Sorry!,  fail to add job in database!');
			return false;

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

		  $sql = "INSERT INTO jobroleskill (jobRoleId, skillId) values ('$this->jobRoleId', '$jobRoleSkill')";

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



}