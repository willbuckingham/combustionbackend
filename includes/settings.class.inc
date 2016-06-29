<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/config.inc");
require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/php-pdo-wrapper-class/class.db.php");

class Settings {
	//private $id;
	private $db;

	public function __construct() { //$id
		//$this->id = $id;
		$this->db = new db("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS); //port=8889;
		$this->db->setErrorCallbackFunction("myErrorHandler");
	}
	
	public function getSettings($user_id){
		$bind = array(
			":user_id" => $user_id
		);		
		$result = $this->db->select("user_settings", "user_id=:user_id", $bind, "*");
		return $result;
	}
	
	public function updateSettings($data){
		//convert date to timestamp
		$date = strtotime($data['date_taken']);
		
		//convert height and weight units to storage units
		$height = 0; //temp
		$weight = 0; //temp
		
		$info = array(
			"height" => $height,
			"height_units" => $data['height_units'],
			"weight" => $weight,
			"weight_units" => $data['weight_units'],
			"dob" => $data['dob'],
			"date_format" => $data['date_format'],
		);
		
		if($data['action'] == "new"){
			$result = $this->db->insert("panos", $info);
		}else if($data['action'] == "edit"){
			$bind = array(
				":user_id" => $data['user_id'],
			);
			$result = $this->db->update("panos", $info, "user_id=:user_id", $bind); //$table, $info, $where, $bind
		}
		
		return $result;
	}
	
	
	public function myErrorHandler($error){
		var_dump($error);
	}
}

function myErrorHandler($error){
	var_dump($error);
}
?>