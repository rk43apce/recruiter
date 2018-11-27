<?php 
/**
 * 
 */
class City 
{
	public $db;
	
	function __construct()
	{

		$this->db = new Database();

	}

	public function getCities()
	{
			
		$sql = " SELECT *  FROM  cities";	

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