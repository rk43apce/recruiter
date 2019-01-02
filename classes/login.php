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

	public static function isUserLoggedIn($userType)
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

	public static function isUservalid($userType)
	{
	
		  if (!Login::isUserLoggedIn($userType)) {
        # code...
        Redirect::to('./index.php');

    	}
	}


	public function checkUser($username, $password)
	{

		$sql = "SELECT * FROM user where email = '$username' AND  password = '$password'";

		$result =  $this->db->querySelect($sql);

		if($this->db->isResultCountOne($result)) {

			$resultArray = $this->db->processRowSet($result, true);	

			Session::put("userId", $resultArray['userId']);
			Session::put("userType",$resultArray['userType']);
			Session::put("employeeName",$resultArray['name']);
			return true;
				
		}else {
			return false;
		}


	}
	
	public function loginEmployee($username, $password)
	{

		$sql = "SELECT employeeId, employeeName, employeeTypeId FROM employee where employeeEmailId = '$username' AND  employeePassword = '$password'";

		$result =  $this->db->querySelect($sql);

		if($this->db->isResultCountOne($result)) {

			$resultArray = $this->db->processRowSet($result, true);	
			Session::put("employeeId", $resultArray['employeeId']);	
			Session::put("employeeTypeId", $resultArray['employeeTypeId']);	
			Session::put("employeeName", $resultArray['employeeName']);	
					
			return true;
				
		}else {
			return false;
		}


	}

	public function checkEmployeeExits($employeeEmailId = null, $employeeId = null )
	{	
		
		$sql = " SELECT employeeId, isActive 
		FROM employee  
		where 
		employeeEmailId = '$employeeEmailId' or employeeId = '$employeeId' ";

		
		if(!$result =  $this->db->querySelect($sql)) {

			return false;
		}

		if(!$this->db->isResultCountOne($result)) {

			return false;
		}

		return $this->db->processRowSet($result, true);
	
	}

	public static function auth($value)
	{
		if(!Session::exists($value)) {

			Redirect::to(baseUrl);
			exit();
		   
		   }
		return true;
	}

	public function saveOTP($employeeId, $otp)	
	{	

		$sql = " INSERT INTO otpTracker ( employeeId, otp, createAt) VALUES ('$employeeId', '$otp', NOW())";

		return $this->db->queryInset($sql);

	}


	public function sendOTP($username, $otp)	
	{	

		$to = $username; 
		$subject = 'OTP to Login'; 
		$messageBody = "One Time Password for login authentication is:<br/><br/>" . $otp;

		// Set content-type for sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		// Additional headers
		$headers .= 'From: Theblueyed<otp@theblueyed.com>' . "\r\n";
		// Send email
		// mail($to,$subject,$messageBody,$headers);

		//  mail($to,$subject,$messageBody,$headers);
		 
		 return mail($to,$subject,$messageBody,$headers);

	}

	// public function verifyOTP($employeeId, $otp)
	// {
	// 	 $sql = "SELECT * FROM otpTracker  
	// 	WHERE otp='$otp' 
	// 	AND isExpired!=1 
	// 	AND NOW() <= DATE_ADD(createAt, INTERVAL 15 MINUTE)";
		
	// 	$result = $this->db->querySelect($sql);
		
	// 	if(empty($result)) {
			
	// 		Session::put('errorMsg', 'Sorry!. Fail to validate your otp. Try again');
			
	// 	}
		
	// 	return $this->db->isResultCountOne($result);
		
	// }


	public function verifyOTP($employeeId, $otp)
	{
		$sql = "SELECT * FROM otpTracker  
		WHERE 
		employeeId = '$employeeId'
		AND otp='$otp' 
		AND isExpired!=1 
		AND NOW() <= DATE_ADD(createAt, INTERVAL 15 MINUTE)";
		
		$result = $this->db->querySelect($sql);
		
		if(empty($result)) {
			
			return false;
			
		}
		
		return $this->db->isResultCountOne($result);
		
	}


		public function getEmployee($employeeId)
	{

		$sql = "SELECT employeeId, employeeName, employeeTypeId 
		FROM employee
		where 
		employeeId = '$employeeId' ";

		$result =  $this->db->querySelect($sql);

		if($this->db->isResultCountOne($result)) {

			$resultArray = $this->db->processRowSet($result, true);	
			Session::put("employeeId", $resultArray['employeeId']);	
			Session::put("employeeTypeId", $resultArray['employeeTypeId']);	
			Session::put("employeeName", $resultArray['employeeName']);	
					
			return true;
				
		}else {
			return false;
		}


	}


	public function destroyOTP($employeeId)
	{
		 $sql = " UPDATE otpTracker set isExpired = '1' where employeeId = '$employeeId'";

		 return $this->db->queryUpdate($sql);
		
		
	}

}
