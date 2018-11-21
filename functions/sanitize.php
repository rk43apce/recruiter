<?php

function escape($string) {
    return   htmlentities(trim($string), ENT_QUOTES, 'UTF-8');
}

function varDump($string) {
	
	echo '<pre>';			
	var_dump($string);
	echo '<pre>';
		
}