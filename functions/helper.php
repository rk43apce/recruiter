<?php 

 function logOut()
{
	session_start();
	session_unset();
	session_destroy();
}