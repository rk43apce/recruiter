<?php 
/**
 * 
 */
class Skill extends City
{
	public $db;
	
	function __construct()
	{

		$this->db = new Database();

	}

	public function getSkills()
	{
			
		$sql = " SELECT *  FROM skillbank";	

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



	public function getAssingmentSkillsByAssingmentId($assingmentId)
	{
		$sql = "SELECT * FROM `skillbank` INNER JOIN jobroleskill ON jobroleskill.skillId = skillbank.skillId WHERE jobroleskill.jobRoleId = '$assingmentId' and isJobRoleSkillDrop = 'No' ";

		$result =  $this->db->querySelect($sql);

		if (!$this->db->checkResultCountZero($result)) {
		return $this->db->processRowSet($result);
		} else {
		return false;
		}

	}


	public static function selectSkills($skillId, $arrayCurrentJobroleSkills)
	{			
			if (empty($arrayCurrentJobroleSkills)) {
				# code...
				return null;
			}

		 return (in_array($skillId, $arrayCurrentJobroleSkills))? "selected" : "";
	}

}