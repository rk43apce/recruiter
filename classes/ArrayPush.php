<?php

/**
 * 
 */
class ArrayPush 
{
	

	public static  function makeArray($candidateEducationData)
	{

		$arrayrQualification = array();

				
		if (!$candidateEducationData) {
			
			return false;
		}	

		foreach ($candidateEducationData as $key => $qualification) {	 	

			array_push($arrayrQualification, $qualification['degreeId']);
	
		}

		return $arrayrQualification;


	}


}