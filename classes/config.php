<?php 
class Config
{

    //Connection Variable
    private static $_instance = null;

    public $mysqli;
    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $db = 'recruiter';

    public function __construct()
    {   
        try {

            $this->mysqli = new mysqli($this->host, $this->user, $this->pass, $this->db); 

        } catch (Exception $e) {

            // echo 'Caught exception: ',  $e->getMessage(), "\n";

             die($e->getMessage());         
        }

    }


    public static function getInstance() 
    {
        if(!isset(self::$_instance)) {

            self::$_instance = new Config();

        }

        return self::$_instance;
    }

} 


?>