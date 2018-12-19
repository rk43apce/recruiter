<?php

class Select 
{	
	public static function selected($value, $arrayData)
	{			
			if (!count($arrayData)) {
				# code...
				return null;
			}

		 return (in_array($value, $arrayData))? "selected" : "";
	}

}