<?php
// connect database
$db_conf = YAML::decode_file('config/database.yml');
$mysql = mysql_connect(
	$db_conf[ENVIRONMENT]['host'] . ':' . $db_conf[ENVIRONMENT]['port'],
	$db_conf[ENVIRONMENT]['user'],
	$db_conf[ENVIRONMENT]['pass']
) or die('Could not connect: ' . mysql_error());
mysql_select_db($db_conf[ENVIRONMENT]['database']) or die('Could not select database');
