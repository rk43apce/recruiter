<?php 
/**
 * 
 */
class Industry 
{
	public $db;
	
	function __construct()
	{

		$this->db = new Database();

	}

	public function getIndustry()
	{
			
		$sql = " SELECT * FROM industry";	

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