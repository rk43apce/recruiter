<?php 

/**
 * 
 */
class Login 
{	
	public $db;

	public $username;
	public $password;
	
	function __construct()
	{
		
		$this->db = Config::getInstance();

	}

	public function queryselect()
	{
	  
	echo  $this->username;
	echo  $this->password;
	   

	} 

}

 ?>