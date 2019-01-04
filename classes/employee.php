<?php 

/**
 * 
 */
class Employee extends Assingment {
			
	public $db;
	
	function __construct()
	{

		$this->db = new Database();

	}

		public function checkEmployeeExits($employeeEmailId)
	{	
		
	 $sql = " SELECT employeeEmailId FROM employee  where employeeEmailId = '$employeeEmailId'";	

		$result =  $this->db->querySelect($sql);


		return  $this->db->isResultCountOne($result);

	
	}

	public function addNewEmployee($employeeData='')
	{	
		
		$employeeEmailId =  $employeeData['employeeEmailId'];
		
		if (empty($employeeEmailId)) {
				
			return false;
		}	

		if ($this->checkEmployeeExits($employeeEmailId)) {

			Session::put('errorMsg', 'Email id is already used!');
			return false;
		}

		$columns = "";
		$values = "";	
			
		foreach ($employeeData as $column => $value) {
		    $columns .= ($columns == "") ? "" : ", ";
		    $columns .= $column;
		    $values .= ($values == "") ? "" : ", ";
		    $values .= "'" . $value . "'";
		}
	
			
		$sql = "INSERT INTO employee ($columns) values ($values)";


		if (!$this->db->queryInset($sql)) {
			
			Session::put('errorMsg', 'Sorry!, fail to add new employee');

			return false;
		}

		return true;			

	}
	
	public function picture ($picture, $employeeId) 
	{
		
		$sql = "UPDATE employee SET picture = '$picture' where employeeId = '$employeeId'";	
		
		if (!$this->db->queryUpdate($sql)) {
					
				return false;
			}	

			return true;
		
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

		if (empty($employeeId)) {
				
				return false;
			}		

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


	public function getRecruiterFromEmployee($spocId)
	{

		$sql = " SELECT employeeId, employeeName  FROM employee where isActive = 'Active'";	

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

		$sql = " SELECT employeeId, employeeName  FROM employee where isActive = 'Active' ";	

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


	public static  function isActive($isActive)
	{

	 return	($isActive == 'Active')? "<span class='text-success'>".$isActive. "</span>" : "<span class='text-secondary'>".$isActive. "</span>";

	}

		public function getEmployeeStatus($employeeId)
	{

		$sql = " SELECT isActive  FROM employee  where employeeId = '$employeeId' ";	

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



	public function updateEmployeeStatus($employeeId)
	{	


		if (!$employeeDaTa = $this->getEmployeeStatus(escape($employeeId))) {

			return false;
		}

		$isActive = $employeeDaTa['isActive'];		

		if (empty($isActive)) {
			# code...
			return false;
		}

		if ($isActive == 'Inactive') {	

		$sql = " UPDATE employee SET isActive = 'Active'  where employeeId = $employeeId ";		

		return  $this->db->queryUpdate($sql);			

		}

		if ($isActive == 'Active') {	

		$sql = " UPDATE employee SET isActive = 'Inactive'  where employeeId = $employeeId ";		

		return  $this->db->queryUpdate($sql);			

		}

	}



}
