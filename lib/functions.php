<?php

function template($template, $args) {
	extract($args);
	ob_start();
	include($template);
	$result = ob_get_contents();
	ob_end_clean();
	return $result;
}

function write_file($filename, $contents){
	if (is_file($filename)){
		// todo: check diff here
		fwrite(STDOUT, "File exists: $filename\n==> overwrite? (y/n/a) : ");
		$answer = strtolower(trim(fgets(STDIN)));
		if ($answer == 'n' || $answer == 'no') return false;
		if ($answer == 'a' || $answer == 'abort') exit;
	}
	file_put_contents($filename, $contents);
	echo "# created: $filename\n";
}

function get_migrations(){
	$dir = "db/migrate/";
	$migrations = array();
	if (is_dir($dir)) {
		if ($dh = opendir($dir)) {
			while (($file = readdir($dh)) !== false) {
				if (filetype($dir . $file) == 'file'){
					if (preg_match('/^[0-9]+/', $file, $matches)){
						$timestamp = $matches[0];
						$classname = str_replace($timestamp . "_", '', str_replace('.php', '', $file));
						$migrations[$timestamp] = array(
							'classname' => Inflector::camelize($classname),
							'file'      => $dir . $file,
							'timestamp' => $timestamp
						);
					}
				}
			}
			closedir($dh);
		}
	}
	ksort($migrations);
	return $migrations;
}

function abort_if_migration_exists($classname){
	function map($arr){
		return $arr['classname'];
	}
	$migrations = array_map('map', get_migrations());
	if (in_array($classname, $migrations)) {
		echo "A migration named `$classname` already exists. Aborting.\n";
		exit;
	}	
}

function write_db_version($version){
	file_put_contents('db/version', $version);
}

function get_db_version(){
	$file = 'db/version';
	return (is_file($file)) ? file_get_contents('db/version') : '00000000000000';
}