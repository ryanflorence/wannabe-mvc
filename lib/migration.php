<?php
class Migration {

	public static $types = array(
		'string'  => 'varchar(255)',
		'text'    => 'text',
		'int'     => 'int(11)',
		'date'    => 'datetime',
		'decimal' => 'decimal(8,2)'
	);

	public static function create_table($table, $columns){
		foreach($columns as $key => $col) {
			$col_type = (self::$types[$col]) ? self::$types[$col] : $col;
			$columns[$key] = "`$key` $col_type DEFAULT NULL";
		}
		$columns = implode(", \n	", $columns);
		$sql = "CREATE TABLE `$table` (`id` int(11) NOT NULL AUTO_INCREMENT, $columns, `active` int(1) DEFAULT 1, `created_at` datetime DEFAULT NULL, `updated_at` datetime DEFAULT NULL, PRIMARY KEY (`id`) ) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
		return (DatabaseTransaction::run_query($sql)) ? "Created table : $table\n": false;
	}
	
	public static function drop_table($table){
		$sql = "DROP TABLE IF EXISTS `$table`;";
		return (DatabaseTransaction::run_query($sql)) ? "Dropped table : $table\n": false;
	}
	
	public static function rename_table(){
		return "Pretend like you renamed a table\n";
	}                                  
	                                   
	public static function change_table(){                  
		return "Pretend like you changed a table\n";
	}                                  
	                                   
	public static function add_column($column){
		return "Pretend like you added a column\n";
	}
	
	public static function remove_column($column){
		return "Pretend like you removed a column\n";
	}
	                                   
	public static function change_column($colum){
		return "Pretend like you changed a column\n";
	}
	
	
	
}