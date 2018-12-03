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

		 $sql = "INSERT INTO employee ($columns) values ($values)";

		return $this->db->queryInset($sql);	

	}



	public  function updateEmployeeProfile($employeeDataToUpdate, $employeeId)
	{

		$out = array();

		foreach ($employeeDataToUpdate as $column => $value) {
			
			array_push($out, "$column='$value'");
		}

		$set = implode(', ', $out);

		$sql = "UPDATE employee SET $set where employeeId = '$employeeId'";	
		
		if (!$this->db->queryUpdate($sql)) {
					
				return false;
			}	

			return true;

	}



	public function getAllEmployee($value='')
	{
		
	$sql = " SELECT *  FROM employee  inner join employeerole on employee.employeeTypeId = employeerole.employeeRoleId ";	

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


		public function getEmployeeById($employeeId)
	{
		
	$sql = " SELECT *  FROM employee inner join(employeerole)  on employeerole.employeeRoleId = employee.employeeTypeId  where employeeId = '$employeeId' ";	

	$result =  $this->db->querySelect($sql);

	if ($this->db->isResultCountOne($result)) {
		# code...
		// return $this->db->processRowSet($result);
		return $this->db->processRowSet($result,true);
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

		public function getRecruiterFromEmployee()
	{

		$sql = " SELECT employeeId, employeeName  FROM employee where employeeTypeId = '2'";	

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

	public function updateEmployeeStatus()
	{

		$sql = " SELECT employeeId, employeeName  FROM employee where employeeTypeId = '2'";	

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
