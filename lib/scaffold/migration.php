<?php
// create the vars for template
// split key:value string pairs to array
$cols = array();
foreach($argvc as $col){
	$arr = split(':', $col);
	$col_type = str_replace('[', '(', str_replace(']', ')', $arr[1]));
	$cols[] = "'$arr[0]' => '$col_type'";
}

$columns = implode(", \n			", $cols);

// create template
$contents = template('framework/lib/templates/scaffold/migration.php', array(
	'plural'       => $plural,
	'model_plural' => $model_plural,
	'columns'      => $columns
));
// write the file todo: check if this migration already exists
// todo: date here is in two places (other migration script)
abort_if_migration_exists("Create$model_plural");
$filename = 'db/migrate/' . date('YmdHis') . "_create_$plural.php";
write_file($filename, $contents);
