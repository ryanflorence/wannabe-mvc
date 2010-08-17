<?php

$classname = Inflector::camelize($argv[0]);
$name = Inflector::underscore($argv[0]);
array_shift($argv);

$contents = template('framework/lib/templates/controller.php', array(
	'classname' => $classname, 
	'name' => $name, 
	'actions' => $argv
));

write_file("app/controllers/$name"."_controller.php", $contents);