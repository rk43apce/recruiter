<?php 

/**
 * 
 */
class Employee {
			
	public $db;
	
	function __construct()
	{

		$this->db = new Database();

	}



	public function addNewEmployee($employeeData='')
	{	
		# code...
		$columns = "";
		$values = "";

		foreach ($employeeData as $column => $value) {
		    $columns .= ($columns == "") ? "" : ", ";
		    $columns .= $column;
		    $values .= ($values == "") ? "" : ", ";
		    $values .= "'" . $value . "'";
		}

		echo $sql = "INSERT INTO employee ($columns) values ($values)";

		return $this->db->queryInset($sql);	

	}

	public function getAllEmployee($value='')
	{
		
	$sql = " SELECT *  FROM employee  inner join employeerole on employee.employeeTypeId = employeerole.employeeRoleId";	

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


	public function getEmployeeRole($value='')
	{
		
		$sql = " SELECT employeeRoleId, employeeRoleName FROM employeerole";	

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
	public function getLeaderFromEmployee()
	{

		$sql = " SELECT employeeId, employeeName  FROM employee where employeeTypeId = '1'";	

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
