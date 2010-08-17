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
		$columns = self::get_columns($columns);
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
	                                   
	public static function add_column($table, $column, $type){
		$type = self::get_type($type);
		$sql = "ALTER TABLE `$table` ADD `$column` $type";
		return (DatabaseTransaction::run_query($sql)) ? "Added column `$column` to $table\n": false;
	}
	
	public static function remove_column($table, $column){
		$sql = "ALTER TABLE `$table` DROP `$column`";
		return (DatabaseTransaction::run_query($sql)) ? "Dropped column `$column` from $table\n": false;
	}
	                                   
	public static function change_column($colum){
		return "Pretend like you changed a column\n";
	}
	
	
	protected static function get_type($type){
		return (self::$types[$col]) ? self::$types[$col] : $col;
	}
	
	protected static function get_columns($columns){
		foreach($columns as $key => $col) {
			$col_type = self::get_type($col);
			$columns[$key] = "`$key` $col_type DEFAULT NULL";
		}
		return implode(", \n	", $columns);
	}
	
	
	
}