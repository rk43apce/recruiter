<?php 

class Interview 
{
	public $db;
	
	function __construct()
	{

		$this->db = new Database();

	}
	
	//  add interview
	
	public function viewInterview()
	{
			
//		$sql = "SELECT notedBy, employee.employeeName, notes, noteAt FROM notes INNER JOIN employee on employee.employeeId = notes.notedBy where candidateId = '$candidateId' order by noteAt desc ";
		
		$sql = "SELECT *  from interview order by createdAt desc";		

		$result =  $this->db->querySelect($sql);
		
		if(empty($result)) {
			
			return false;
		}

		if ($this->db->checkResultCountZero($result)) {
			
			return false;
		}
		
		return $this->db->processRowSet($result);		

	}
	
	
	//  add interview

	public function addInterview($interviewData)
	{			
		$columns = "";
		$values = "";

		foreach ($interviewData as $column => $value ) {

			$columns .= ( $columns == "" ) ? "" : ", ";
			$columns .= $column;
			$values .= ( $values == "" ) ? "" : ", ";
			$values .= "'" . $value . "'";
		}

		$sql = "INSERT INTO interview ($columns) values ($values)";			

		return $this->db->queryInset( $sql );
		
	}
	
	
		//  delete interview

	public function deleteInterview($interviewId)
	{			
		
		$sql = "DELETE FROM interview WHERE interviewId = '$interviewId'";		
		
		return $this->db->queryDelet( $sql );
		
	}
}