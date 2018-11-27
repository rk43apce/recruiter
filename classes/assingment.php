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


	public function getOnGoingAssingmentById($assingmentId)
	{
			
	 echo	$sql = " SELECT *  FROM assingment   where assingmentId = '$assingmentId'";	

		$result =  $this->db->querySelect($sql);

		if ($this->db->isResultCountOne($result)) {
			# code...
			// return $this->db->processRowSet($result);
			return $this->db->processRowSet($result, true);
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


	public  function updateAssingment($assingmentData, $assingmentId)
	{

		$out = array();
		foreach ($data as $column => $value) {
		array_push($out, "$column='$value'");
		}
		$set = implode(', ', $out);

		echo $sql = "UPDATE assingment SET $set assingmentId = '$assingmentId'";

		// $result = mysqli_query($this->dbc, $sql);

		// echo $sql;

		// if ($result) {
		// return true;
		// } //end of valid if

	}

}