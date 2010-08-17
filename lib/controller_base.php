<?php

/**
 * Base Controller Class
 *
 * @author Ryan Florence
 * @version $Id$
 * @copyright __MyCompanyName__, 14 August, 2010
 * @package default
 **/

/**
 * Define DocBlock
 **/


class ControllerBase {
	
	function __construct($action) {
		$this->action_name = $action;
	}
	
	public function render(){
		require_once("app/views/$this->controller_name/$this->action_name.php");
	}
	
	public function redirect_to($action){
		header((is_object($action)) ?
			"location: /?controller=$action->table&action=show&id=$action->id" :
			"location: /?controller=$this->controller_name&action=$action");
	}
	
	public function redirect_back_or_default($default){
		if ($_SERVER['HTTP_REFERER']) header("location: " . $_SERVER['HTTP_REFERER']);
		else $this->redirect_to($default);
	}

}