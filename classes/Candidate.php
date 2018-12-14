<?php

class Candidate extends Degree {
	public $db;
	public $candidateId;
	public $candiateDegrees;

	function __construct() {

		$this->db = new Database();

	}

	/*============================= add candidate  ==========================================*/
	public function addCandidate( $candidatePersonalData = '' ) {

		$columns = "";
		$values = "";

		foreach ( $candidatePersonalData as $column => $value ) {
			$columns .= ( $columns == "" ) ? "" : ", ";
			$columns .= $column;
			$values .= ( $values == "" ) ? "" : ", ";
			$values .= "'" . $value . "'";
		}

		$sql = "INSERT INTO candidate ($columns) values ($values)";

		if ( !$this->db->queryInset( $sql ) ) {
			return false;
		}

		return true;

	}
	
	/*============================= add education  ==========================================*/

	public function addEducation($candidateId, $candiateDegrees) {
		foreach ( $candiateDegrees as $degreeId ) {
			$sql = "INSERT INTO education (candidateId, degreeId) values ($candidateId, '$degreeId')";
			if ( !$this->db->queryInset( $sql ) ) {
				return false;
			}
		}
		return true;
	}

	/*============================= add work Experiecne  ==========================================*/

	public function addWorkExperience($candidateId, $candidateWorkExperience) {
		$columns = "";
		$values = "";

		foreach ( $candidateWorkExperience as $column => $value ) {
			$columns .= ( $columns == "" ) ? "" : ", ";
			$columns .= $column;
			$values .= ( $values == "" ) ? "" : ", ";
			$values .= "'" . $value . "'";
		}

		$sql = "INSERT INTO workExperience ($columns) values ($values)";

		if ( !$this->db->queryInset( $sql ) ) {
			return false;
		}
		
		return true;

	}
	

	

	/*============================= add get candidate by candidate id  ==========================================*/

	public function getCandidatebyId( $candidateId ) {

		$sql = " SELECT *  FROM candidate	
		inner join(functionalareas) on  functionalareas.functionalareaId = candidate.candidateFunctionalAreaId	
		where candidateId = '$candidateId' ";

		$result = $this->db->querySelect( $sql );

		if ( !$this->db->isResultCountOne( $result ) ) {
			return false;
		}

		return $this->db->processRowSet( $result, true );

	}


	/*============================= Update candidate profile  ==========================================*/

	public function updateCandidateProfile($candidateData, $candidateId ) {
		
		$out = array();
		
		foreach ( $candidateData as $column => $value ) {
			array_push( $out, "$column='$value'" );
		}
		
		$set = implode( ', ', $out );
		
		$sql = "UPDATE candidate SET $set where candidateId = '$candidateId'";

		if (!$this->db->queryUpdate($sql)) {
			return false;
		}
		
		return true;

	}

}