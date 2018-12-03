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
		
		$sql = " SELECT company.companyName, jobrole.jobRoleTitle, employee.employeeName, cities.cityName, jobrole.minWorkExperience, jobrole.maxWorkExperience, jobrole.minFixedSalary, jobrole.maxFixedSalary, assingment.createdOn FROM assingment inner join(company) on company.companyId = assingment.companyId inner join(jobrole) on jobrole.jobRoleId = assingment.jobRoleId inner join(cities) on cities.cityId = jobrole.locationId inner join(employee) on employee.employeeId = assingment.spocId";	

		$result =  $this->db->querySelect($sql);

		if (!$this->db->checkResultCountZero($result)) {
		
			return $this->db->processRowSet($result);

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


	public function assignAssingmnetToEmployee()
	{		
		foreach ($this->recruiters as $recruiterId) {

		echo	$sql = "INSERT INTO recruiterassingment (assingmentId, recruiterId) values ('$this->assingmentId', '$recruiterId')";

		echo "<br>";

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