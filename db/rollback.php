<?php

$migrations = get_migrations();
$version    = get_db_version();
$how_many   = (isset($argv[2])) ? $argv[2]: 1;
$total      = count($migrations);
$error      = false;
$count      = 0;

if ($how_many > $total) $how_many = $total;

if (!$total || $version < 1){
	echo "Nothing to roll back\n";
	exit;
} 

while ($how_many > $count){
	$count++;
	$migration = array_pop($migrations);
	require_once($migration['file']);
	$result = $migration['classname']::down();
	if ($result){
		echo "# " . $result;
		if ($how_many == $count) {
			// last one
			$next = array_pop($migrations);
			$version = (isset($next['timestamp'])) ? $next['timestamp'] : '00000000000000';	
		}
	} else {
		$error = true;
		$classname = $migration['classname'];
		break;
	}
}

echo "Rolled back $count migration(s)\n";
if ($error) echo "===> There were errors in the migration, not all migrations rolled back.
     All migrations starting from `$classname` were not rolled back.\n";

write_db_version($version);
