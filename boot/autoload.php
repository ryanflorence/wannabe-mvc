<?php
/**
 * Auto loads classes based on rails naming conventions:
 *   filename: some_class.php (under_score)
 *   classname: SomeClass (TitleizedCamelCase)
 * 
 *
 * @author Ryan Florence
 * @version $Id$
 * @copyright RA FLORENCE LLC, 14 August, 2010
 * @package Wannabe MVC
 **/

/**
 * Classes must be placed is conventional lib directories
 **/
$wannabe_lib_directories = array(
	'app/models',
	'app/controllers',
	'framework/lib',
	'framework/lib/vendor',
	'lib',
	'lib/vendor',
	'db'
);

function __autoload($class){
	global $wannabe_lib_directories;
	$class = strtolower(preg_replace('/[^A-Z^a-z^0-9]+/','_',
  	preg_replace('/([a-zd])([A-Z])/','$1_$2',
  	preg_replace('/([A-Z]+)([A-Z][a-z])/','$1_$2', $class))));
	foreach($wannabe_lib_directories as $dir) if (is_file("$dir/$class.php")) require_once("$dir/$class.php");
}
