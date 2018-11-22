<?php

/**
 * 
 */
class Assingment 
{	
	public $db;
	
	function __construct()
	{

		$this->db = new Database();

	}

	public function getOnGoingAssingment($value='')
	{
			
		$sql = " SELECT *  FROM assingment";	

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


	public function assignAssingmnetToEmployee($assingmentId, $recruiters, $createdOn)
	{
	
		foreach ($recruiters as $recruiterId) {

		  $sql = "INSERT INTO recruiterassingment (assingmentId, recruiterId, createdOn) values ('$assingmentId', '$recruiterId', '$createdOn')";

		  	 $result =  $this->db->queryInset($sql);	
	
		}

		return $result;

	}


	public  function createNewAssingment($assingmentData)
    {

		$columns = "";
		$values = "";

		foreach ($assingmentData as $column => $value) {
		    $columns .= ($columns == "") ? "" : ", ";
		    $columns .= $column;
		    $values .= ($values == "") ? "" : ", ";
		    $values .= "'" . $value . "'";
		}

		$sql = "INSERT INTO assingment ($columns) values ($values)";

		return $this->db->queryInset($sql);	

    }



}