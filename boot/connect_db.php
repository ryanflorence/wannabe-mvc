<?php
// connect database
$db_conf = YAML::decode_file('config/database.yml');
$mysql = mysql_connect(
	$db_conf[ENV]['host'] . ':' . $db_conf[ENV]['port'],
	$db_conf[ENV]['user'],
	$db_conf[ENV]['pass']
) or die('Could not connect: ' . mysql_error());
mysql_select_db($db_conf[ENV]['database']) or die('Could not select database');
