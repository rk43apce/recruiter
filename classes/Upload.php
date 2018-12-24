<?php
class Upload {
	
	function __construct() {
		$this->db = new Database();
	}

	public function resume( $uploadData ) {
		# code...
		$columns = "";
		$values = "";

		foreach ( $uploadData as $column => $value ) {
			$columns .= ( $columns == "" ) ? "" : ", ";
			$columns .= $column;
			$values .= ( $values == "" ) ? "" : ", ";
			$values .= "'" . $value . "'";
		}

		echo $sql = "INSERT INTO upload ($columns) values ($values)";

		return $this->db->queryInset( $sql );

	}


		public function jobDescription( $uploadData ) {
		# code...
		$columns = "";
		$values = "";

		foreach ( $uploadData as $column => $value ) {
			$columns .= ( $columns == "" ) ? "" : ", ";
			$columns .= $column;
			$values .= ( $values == "" ) ? "" : ", ";
			$values .= "'" . $value . "'";
		}

		echo $sql = "INSERT INTO jdTracker ($columns) values ($values)";

		return $this->db->queryInset( $sql );

	}


}