<?php 

// put whatever functions you want here.


// if you change the htaccess file, upate this function
function get_path($controller, $action, $id = false){
	$str = "/$controller/$action";
	if ($id) $str .= "/$id";
	return $str;
}

/*
// use this if you're not using htaccess at all
function get_path($controller, $action, $id = false){
	$str = "/?controller=$controller&action=$action";
	if ($id) $str .= "&id=$id";
	return $str;
}
*/
