<?php

class DatabaseTransaction {
	
	public static function fetch($sql, $table){
		global $mysql;
		$arr = array();
		if ($result = mysql_query($sql)){
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) $objects[] = $row;
		} else {
			self::log('Error', $sql, mysql_error());
		}
		return $arr;
	}
	
	public static function run_query($sql){
		global $mysql;
		$result = mysql_query($sql);
		if($result) {
			return $result;
		} else {
			self::log('Error', $sql, mysql_error());
			return false;
		}
	}
	
	protected static function log($type, $query, $error){
		error_log("$type, $query, $error", 0);
	}
	
}