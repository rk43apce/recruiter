<?php
class Data {
	
	public static function checkData($data) {

		if(!$data) {
			
			include 'errorBox.php';
			die();	
		}

	}	

}
