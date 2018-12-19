<?php

class Shortlist {
	public $db;
	public $candidateId;
	public $candiateDegrees;

	function __construct() {
		
		$this->db = new Database();
	}
	
	
/*
check candidate already shortlisted or not 
*/

	public function exists( $assingmentId,  $candidateId) {

	echo	$sql = " SELECT *  FROM shortlist where assingmentId = '$assingmentId' AND candidateId = '$candidateId' ";

		$result = $this->db->querySelect( $sql );
		
		if(empty($result)) {
			
			return false;			
		}

		return $this->db->isResultCountOne( $result );

	}	

	
	
	
/*============================= add shortlist  candidate  ==========================================*/
	public function candidate( $Data) {

		$columns = "";
		$values = "";

		foreach ( $Data as $column => $value ) {

			$columns .= ( $columns == "" ) ? "" : ", ";
			$columns .= $column;
			$values .= ( $values == "" ) ? "" : ", ";
			$values .= "'" . $value . "'";
		}

		$sql = "INSERT INTO shortlist ($columns) values ($values)";	
		
		if ( !$this->db->queryInset( $sql ) ) {
			return false;
		}

		return true;

	}


} // end of class 