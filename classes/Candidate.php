<?php

class Candidate extends Degree {
	public $db;
	public $candidateId;
	public $candiateDegrees;

	function __construct() {

		$this->db = new Database();

	}

	/*============================= add candidate  ==========================================*/
	public function addNewCandidate( $candidateData = '' ) {

		$columns = "";
		$values = "";

		foreach ( $candidateData as $column => $value ) {
			$columns .= ( $columns == "" ) ? "" : ", ";
			$columns .= $column;
			$values .= ( $values == "" ) ? "" : ", ";
			$values .= "'" . $value . "'";
		}

		$sql = "INSERT INTO candidate ($columns) values ($values)";

		if ( !$this->db->queryInset( $sql ) ) {
			return false;
		}

		if ( empty( $this->candiateDegrees ) ) {
			Session::put( 'erroMsg', 'Candidate successfully added in Database!' );
			Session::put( 'erroMsgEducation', 'Please add education history' );
			return true;
		}

		/*Calling add education function here*/

		if ( !$this->addCandidateEducation() ) {
			return false;
		}
		return true;

	}

	/*============================= add education  ==========================================*/

	public function addCandidateEducation() {
		foreach ( $this->candiateDegrees as $degreeId ) {
			$sql = "INSERT INTO education (candidateId, degreeId) values ($this->candidateId, '$degreeId')";
			if ( !$this->db->queryInset( $sql ) ) {
				return false;
			}
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

	public function updateCandidateProfile( $candidateData, $candidateId, $assingmentId ) {

		$out = array();

		foreach ( $candidateData as $column => $value ) {

			array_push( $out, "$column='$value'" );
		}

		$set = implode( ', ', $out );

		$sql = "UPDATE candidate SET $set where candidateId = '$candidateId' AND assingmentId = '$assingmentId' ";




		var_dump( $this->db->queryUpdate( $sql ) );

		//	if (!$this->db->queryUpdate($sql)) {
		//
		//			return false;
		//		}	
		//
		//		return true;

	}

}