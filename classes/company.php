<?php 

/**
 * 
 */
class Company extends City  {
			
	public $db;

	public $companyId;
	
	function __construct()
	{

		$this->db = new Database();

	}


		public function addNewCompany($companyData='')
	{	
		# code...
		$columns = "";
		$values = "";

		foreach ($companyData as $column => $value) {
		    $columns .= ($columns == "") ? "" : ", ";
		    $columns .= $column;
		    $values .= ($values == "") ? "" : ", ";
		    $values .= "'" . $value . "'";
		}

		echo $sql = "INSERT INTO company ($columns) values ($values)";

		 return $this->db->queryInset($sql);	

	}



	public function getAllCompany($value='')
	{
			
		$sql = " SELECT *  FROM company";

		// $sql = " SELECT *  FROM company inner join cities on company.companyCity = cities.";	

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

	public function getCompanyById($companyId)
	{	
		
		// $sql = " SELECT companyId, companyName, companyCity  FROM company where companyId ='$companyId'";

		$sql = " SELECT companyId, companyName, cityName  FROM company inner join cities on company.companyCity = cities.cityId where companyId ='$companyId'";	

		$result =  $this->db->querySelect($sql);

		if ($this->db->isResultCountOne($result)) {	
			
			return $this->db->processRowSet($result, true);	

		} else {

			return false;
		}

	}

}
