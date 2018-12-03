<?php 

 function logOut()
{
	session_start();
	session_unset();
	session_destroy();
}

function noOfDays($createdOn) {
      $now = time(); // or your date as well

       $createdOn  =   strtotime($createdOn);

        $datediff =  $now - $createdOn;

  return   round($datediff / (60 * 60 * 24));

      
}


