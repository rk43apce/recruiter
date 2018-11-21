<?php 

class Login 
{	
	public $db;
	private $username;
	private $password;	

	function __construct()
	{

		$this->db = new Database();

	}

	public function isUserLoggedIn($userType)
	{	
		

		if (Session::get('userId') && Session::get('userType')) {
			# code...

			if (Session::get('userType') === $userType) {
				# code...
				return true;
				
			}

			return false;
			
		}

		return false;

	}


	public function checkUser($username, $password)
	{

		$sql = "SELECT * FROM user where email = '$username' AND  password = '$password'";

		$result =  $this->db->querySelect($sql);

		if($this->db->isResultCountOne($result)) {

			$resultArray = $this->db->processRowSet($result, true);	

			Session::put("userId", $resultArray['userId']);
			Session::put("userType",$resultArray['userType']);

			return true;
				
		}else {
			return false;
		}


	}

}
