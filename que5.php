<?php
/**
 * isUpperCase - function determines whether the String is in uppercase or not.
 * @string - to check string
 */	

function isUpperCase($string) {
	return ($string == ucfirst($string)) ? true : false ;
}

$string = "Ganesh";

if(isUpperCase($string)){
	echo " \"".$string."\" String starts with uppercase.";
}else{
	echo " \"".$string."\" String dosen't starts with uppercase.";
}

?>