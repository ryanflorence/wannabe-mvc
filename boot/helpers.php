<?php

// links and stuff

function link_to($text, $href, $attrs = '', $echo = true){
	$attr_str = '';
	if ($attrs) {
		foreach($attrs as $k=>$v) $attr_str .= " $k=\"$v\"";
	}
	$str = "<a href=\"$href\"$attr_str>$text</a>";
	if ($echo) echo $str;
	return $str;
}

function add_path($model){
	return get_path($model, 'add');
}

function create_path($model){
	return get_path($model, 'create');
}

function index_path($model){
	return get_path($model, 'index');
}

function deleted_path($model){
	return get_path($model, 'deleted');
}

function show_path($model){
	return get_path($model->table, 'show', $model->id);
}

function edit_path($model){
	return get_path($model->table, 'edit', $model->id);
}

function update_path($model){
	return get_path($model->table, 'update', $model->id);
}

function delete_path($model){
	return get_path($model->table, 'delete', $model->id);
}

function restore_path($model){
	return get_path($model->table, 'restore', $model->id);
}

function destroy_path($model){
	return get_path($model->table, 'destroy', $model->id);
}

// other junk

function form_field($key, $model){
	$text     = array('int(11)', 'varchar(255)', 'timestamp');
	$textarea = array('tinytext', 'text');
	$hidden   = array('id');
	$bool     = array('int(1)', 'tinyint(1)');
	$value    = $model->$key;
	$name     = Inflector::singularize($model->table) . "[$key]";
	$type     = $model->properties[$key]['Type'];
	
	if (in_array($key, $hidden)){
		echo '<input type="hidden" name="' . $name . '" value="' . $value . '">'; return; 
	}
	if (in_array($type, $text)){
		echo '<input type="text" size="70" name="' . $name . '" value="' . $value . '">'; return; 
	}
	if (in_array($type, $textarea)){
		echo '<textarea rows="5" cols="40" name="' . $name . '">' . $value . '</textarea>'; return; 
	}
	if (in_array($type, $bool)){
		$value   = ($value == '') ? '1' : $value; // new or existing record
		$active  = ($value == '1') ? ' checked' : '';
		$deleted = ($value == '0') ? ' checked' : '';
		echo '<label><input type="radio" value="1" name="' . $name . '" ' . $active . '> true</label><br>' . "\n";
		echo '<label><input type="radio" value="0" name="' . $name . '" ' . $deleted . '> false</label>';
	}
	echo "\n";
}

function belongs_to_select_field($model, $collection, $display){
	$foreign_key = Inflector::singularize($collection[0]->table) . '_id';
	$name = Inflector::singularize($model->table) . "[$foreign_key]";
	echo "<select name=\"$name\">";
	foreach($collection as $item){
		$selected = ($model->$foreign_key == $item->id) ? 'selected': '';
		$text = $item->$display;
		echo "<option value=\"$item->id\"$selected>$text</option>\n";
	}
	echo "</select>\n";
}


function h($str){
	echo htmlspecialchars($str);
}

function all_controllers(){
	$dir = "app/controllers/";
	$dh = opendir($dir) ;
	$controllers = array();
	while (($file = readdir($dh)) !== false){
		if (filetype($dir . $file) == 'file') $controllers[] = Inflector::classify(str_replace('.php','',$file));
	}
	closedir($dh);
	return $controllers;
}

function rand_alphanumeric() {
	$subsets[0] = array('min' => 48, 'max' => 57); 
	$subsets[1] = array('min' => 65, 'max' => 90);
	$subsets[2] = array('min' => 97, 'max' => 122);
	$s = rand(0, 2);
	$ascii_code = rand($subsets[$s]['min'], $subsets[$s]['max']);
	return chr( $ascii_code );
}

function make_token() {
	$str = "";
	for ($i=0; $i<7; $i++) $str .= rand_alphanumeric();
	$pos = rand(0, 24);
	$str .= chr(65 + $pos);
	return $str . substr(md5($str . SECRET), $pos, 8);
}

function validate_token($str) {
  $rs = substr($str, 0, 8);
  return $str == $rs . substr(md5($rs . SECRET), ord($str[7])-65, 8);
}

function flash($type, $message=null){
	if (isset($message)){
		$_SESSION[$type] = $message;
	} else {
		$msg = $_SESSION[$type];
		$_SESSION[$type] = null;
		return $msg;		
	}
}

function check_flash($type){
	return (isset($_SESSION[$type])) ? $_SESSION[$type] != '' : false;
}
