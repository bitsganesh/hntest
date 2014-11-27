<?php
/**
 * concatString function used to concat the string passed in array and prints that string.
 * @arr - array with mulitple string values
 * @seperator - sperator for concat string
 */	

function concatArrayToString($arr = array(),$seperator = ' '){
		echo implode($seperator,$arr);
}

concatArrayToString(array("Ganesh","Patil")," ");

?>