<?php

class Select 
{	
	public static function selected($employeeId, $arrayrRcruiter)
	{			
			if (!count($arrayrRcruiter)) {
				# code...
				return null;
			}

		 return (in_array($employeeId, $arrayrRcruiter))? "selected" : "";
	}

}