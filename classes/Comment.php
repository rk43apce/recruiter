<?php 

class Comment  {
			
	public $db;
	
	function __construct()
	{
		$this->db = new Database();
	}

	public function getComment($candidateId)
	{
			
		$sql = "SELECT notedBy, employee.employeeName, employee.picture, notes, noteAt FROM notes INNER JOIN employee on employee.employeeId = notes.notedBy where candidateId = '$candidateId' order by noteAt desc ";

		$result =  $this->db->querySelect($sql);
		
		if(empty($result)) {
			
			return false;
		}

		if ($this->db->checkResultCountZero($result)) {
			
			return false;
		} 
		
		
		
		return $this->db->processRowSet($result);
		

	}
	
	public function addComment($employeeId, $candidateId,  $comments)
	{
			
		$sql = "INSERT INTO notes (notedBy, candidateId, notes) values ('$employeeId', $candidateId, '$comments')";

		 return	$this->db->queryInset($sql);

	}
	
}
