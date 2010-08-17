<?php

$stamp = date('YmdHis');
$camelized = Inflector::camelize($argv[0]);
$underscored = Inflector::underscore($argv[0]);
abort_if_migration_exists($camelized);

// create template
$contents = template('framework/lib/templates/migration.php', array(
	'classname' => $camelized
));

// write the file todo: check if this migration already exists
$filename = "db/migrate/$stamp"."_".$underscored.".php";
write_file($filename, $contents);
