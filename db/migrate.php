<?php

$migrations  = get_migrations();
$old_version = get_db_version();
$version     = $old_version;
$error       = false;
$count       = 0;
$total       = count($migrations);

if (!$total){
	echo "Nothing to migrate\n";
	exit;
} 

foreach($migrations as $migration){
	if ($migration['timestamp'] > $old_version){
		require_once($migration['file']);
		$result = call_user_func(array($migration['classname'], 'up'));
		//$result = $migration['classname']::up();
		if ($result){
			echo "# " . $result;
			$version = $migration['timestamp'];
			$count++;
		} else {
			$error = true;
			$classname = $migration['classname'];
			break;
		}
	}
}

echo "$count migration(s) completed\n";
if ($error) echo "===> There were errors in the migration, not all migrations excecuted.
     All migrations starting from `$classname` on were skipped.\n";
elseif($count==0) echo "Everything up to date.\n";

write_db_version($version);
