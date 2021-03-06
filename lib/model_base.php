<?php
/**
 * 
 *
 * @author Ryan Florence
 **/

/**
 * Base class for all Models, contains basic interactions with MySQL.
 *
 * @author Ryan Florence
 **/

class ModelBase {

	public $properties = array();
	public $error;
	// creates new instance, sets properties
	function __construct($params = array()) {
		$this->properties = YAML::decode_file("db/schemas/$this->table.yml");
		$this->set_properties($params);
	}
	
	public function set_properties($params){
		foreach ($params as $key => $value) $this->$key = $value;
	}
	
	public function __set($name, $value){
		if (in_array($name, array_keys($this->properties))){
			// own column
			$this->properties[$name]['value'] = $value;
		}
		// todo: add has_many, belongs_to, and habtm logic
	}
	
	public function __get($name){
		if (in_array($name, array_keys($this->properties))){
			// own column
			return (isset($this->properties[$name]['value'])) ? $this->properties[$name]['value'] : false;
		}	elseif (isset($this->belongs_to) && in_array($name, $this->belongs_to)){
			// belongs to
			$classname = Inflector::classify($name);
			$column_name = $name . '_id';
			return call_user_func_array(array($classname, 'find'), array($this->column_name));
			//return $classname::find($this->$column_name);
		} elseif(isset($this->has_many) && in_array($name, $this->has_many)){
			// has many
			$classname = Inflector::classify($name);
			return call_user_func_array(array($classname, 'find_all_by'), array(Inflector::singularize($this->table) . "_id", $this->id));
			//return $classname::find_all_by(Inflector::singularize($this->table) . "_id", $this->id);
		}
		// todo add habtm support
		return false;		
	}
	
	public function save(){
		return ($this->id) ? $this->update() : $this->insert();
	}
	
	public function insert(){
		global $mysql;
		$now = date ("Y-m-d H:i:s");
		$this->set_properties(array(
			'created_at' => $now,
			'updated_at' => $now
		));
		$properties = $this->properties;
		$properties = self::slice_data($properties);
		$keys       = implode(', ', $properties['keys']);
		$values     = implode( ', ', $properties['values']);
		$sql        = "INSERT INTO $this->table ($keys) VALUES ($values);";
		if (self::run_query($sql)){
			$this->id = mysql_insert_id();
			return true;
		} else {
			error_log(mysql_error());
			$this->error = mysql_error();
			return false;
		};
	}
	
	public function update(){
		$this->updated_at = date("Y-m-d H:i:s");
		$properties = $this->properties;
		$id = $properties['id']['value'];
		function walk_data(&$value, $key){
			$value = "`$key` = '" . $value['value'] . "'";
		}
		array_walk($properties, 'walk_data');
		$updates = implode(', ', $properties);
		$sql     = "UPDATE $this->table SET $updates WHERE id = $id";
		return self::run_query($sql);
	}
	
	public function destroy(){
		$sql = "DELETE FROM $this->table WHERE id = $this->id";
		return self::run_query($sql);
	}

	public function delete(){
		$this->active = '0';
		return $this->update();
	}
	
	public function restore(){
		$this->active = '1';
		return $this->update();
	}
		
	public static function find($table, $id, $extra = ''){
		if($id == 'all')   return self::find_all($table, $extra);
		if($id == 'first') return self::find_first($table, $extra);
		$result = self::fetch("SELECT * FROM $table WHERE `id` = $id $extra", $table);
		return $result[0];
	}
	
	public static function find_all($table, $extra = '') {
		return self::fetch("SELECT * FROM $table $extra", $table);
	}
	
	public static function find_all_by($table, $field, $value, $extra = ''){
		return self::find_all($table, "WHERE `$field` = '$value' $extra");
	}
	
	public static function find_first($table){
		return self::fetch("SELECT * FROM $table LIMIT 1", $table);
	}
	
	protected static function fetch($sql, $table){
		global $mysql;
		$model = Inflector::classify($table);
		$objects = array();
		if ($result = mysql_query($sql)){
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) $objects[] = new $model($row);
		} else {
			self::log('Error', $sql, mysql_error());
		}
		return $objects;
	}
	
	protected static function run_query($sql){
		self::validate_token();
		global $mysql;
		$result = mysql_query($sql);
		if($result) {
			return true;
		} else {
			//self::log('Error', $sql, mysql_error());
			return false;
		}
	}
	
	protected static function log($type, $query, $error){
		error_log("$type, $query, $error", 0);
	}
	
	private static function slice_data($data){
		$arr = array('keys'=>array(), 'values'=>array());
		foreach($data as $k=>$v){
			$arr['keys'][]   = $k;
			$value = (isset($v['value'])) ? $v['value']: '';
			if ($k == 'active' && $value == '') $value = 1;
			$arr['values'][] = '"' . mysql_real_escape_string($value) . '"';
		}
		return $arr;
	}
	
	private static function validate_token(){
		if(!validate_token($_SESSION['token'])) die ("Unable to validate token, IP address logged for potential attack: " . $_SERVER['REMOTE_ADDR']);
	}
	
	public function headers(){
		// todo figure out a better solution, this is sort of silly, used in a view and that's about it, doesn't belong here.
		$keys = array_keys($this->properties);
		function filter($k){
			return $k != 'id' && $k != 'created_at' && $k != 'active';
		}
		return array_filter($keys, 'filter');
	}
	
}