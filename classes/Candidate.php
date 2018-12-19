<?php

class Candidate extends Degree {
	public $db;
	public $candidateId;
	public $candiateDegrees;

	function __construct() {

		$this->db = new Database();

	}

	
	/*=============================  check Email availability ==========================================*/

	public function checkEmailAvailability( $candidateEmail ) {

		$sql = " SELECT *  FROM candidate	
			
		where candidateEmail = '$candidateEmail' ";

		$result = $this->db->querySelect( $sql );

		if ( !$this->db->isResultCountOne( $result ) ) {
			return false;
		}

		return true;

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

	public function addEducation( $candidateId, $candiateDegrees ) {

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


	/*============================= Update candidate profile  ==========================================*/

	public function updateCandidateProfile( $candidateData, $candidateId ) {
		
		$out = array();
		
		foreach ( $candidateData as $column => $value ) {
			array_push( $out, "$column='$value'" );
		}
		
		$set = implode( ', ', $out );
		
		$sql = "UPDATE candidate SET $set where candidateId = '$candidateId'";

		// var_dump($this->db->queryUpdate($sql));

		if ( !$this->db->queryUpdate( $sql ) ) {
			return false;
		}
		
		return true;

	}


	/*============================= Update candidate profile  ==========================================*/

	public function updateWorkExperience($workExperienceData, $candidateId ) {
		
		$out = array();
		
		foreach ( $workExperienceData as $column => $value ) {
			array_push( $out, "$column='$value'" );
		}
		
		$set = implode( ', ', $out );
			
		echo "<br>====================================================================<br>";	

	 	$sql = "UPDATE workExperience SET $set where candidateId = '$candidateId'";



		if ( !$this->db->queryUpdate( $sql ) ) {
			return false;
		}
		
		return true;

	}


	/*============================= Update candidate profile  ==========================================*/

	public function updateEducationHistory( $dropDegrees, $candidateId ) {


	 $sql  = "UPDATE `education` SET `isDrop` = 'Yes', dropOn = NOW() WHERE degreeId IN ( '" . implode( "', '" , $dropDegrees ) . "' ) AND candidateId = '$candidateId' ";

			if (!$this->db->queryUpdate($sql)) {

			return false;	

		}		

		 return true;	

	}




		/*============================= Get  all candidates  from database  ==========================================*/

	public function getAllCandidates() {

		$sql = "SELECT candidate.candidateId, candidateFullName,candidateEmail, candidateMobileNo, candidateOrganisation, candidateDesignation, functionalareaName, candidateFunctionalAreaId, candidateWorkExp, candidateSalary,candidateNoticePeriod
		FROM candidate 
		INNER JOIN workExperience on workExperience.candidateId = candidate.candidateId 
		INNER JOIN functionalareas on functionalareas.functionalareaId = workExperience.candidateFunctionalAreaId";

		
		$result =  $this->db->querySelect($sql);

		if (!$result) {
			
			return false;
		}

		if ($this->db->checkResultCountZero($result)) {
		
			return false;

		}

		return $this->db->processRowSet($result);

	}



	/*============================= add get candidate by candidate id  ==========================================*/

	public function getCandidatebyId( $candidateId ) {

		$sql = " SELECT *  FROM candidate	
			
		where candidateId = '$candidateId' ";

		$result = $this->db->querySelect( $sql );

		if ( !$this->db->isResultCountOne( $result ) ) {
			return false;
		}

		return $this->db->processRowSet( $result, true );

	}	


	/*============================= add get candidate by candidate id  ==========================================*/

	public function getEducation($candidateId)
	{

		$sql = " SELECT *  FROM education  inner join(degree) on degree.degreeId = education.degreeId  where candidateId = '$candidateId' AND isDrop = 'No' ";

		$result =  $this->db->querySelect($sql);

		if ($this->db->checkResultCountZero($result)) {

			return false;
		} 

		return $this->db->processRowSet($result);
	}


	/*============================= add get candidate by candidate id  ==========================================*/

	public function getWorkExperience($candidateId)
	{

		$sql = " SELECT *  FROM workExperience inner join(functionalareas) on functionalareas.functionalareaId = workExperience.candidateFunctionalAreaId where candidateId = '$candidateId' ";

		$result =  $this->db->querySelect($sql);

		if ( !$this->db->isResultCountOne( $result ) ) {
		return false;
		}

		return $this->db->processRowSet($result, true);
	}




} // end of class 