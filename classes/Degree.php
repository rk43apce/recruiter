<?php 



class Degree extends FunctionalArea
{
	public $db;
	
	function __construct()
	{

		$this->db = new Database();

	}

	public function getDegrees($degreeLevel)
	{
			
		$sql = " SELECT * FROM degree where degreeLevel = '$degreeLevel' ";	

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