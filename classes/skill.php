<?php 
/**
 * 
 */
class Skill 
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
}