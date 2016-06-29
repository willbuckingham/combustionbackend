<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/combustionbackend/includes/config.inc");
require_once($_SERVER['DOCUMENT_ROOT'] . "/combustionbackend/includes/php-pdo-wrapper-class/class.db.php");

class Settings {
	//private $id;
	private $db;

	public function __construct() { //$id
		//$this->id = $id;
		$this->db = new db("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS); //port=8889;
		$this->db->setErrorCallbackFunction("myErrorHandler");
	}
	
	public function getSettings(){
		$bind = array(
			":user_id" => $_SESSION['user_id']
		);		
		$result = $this->db->select("user_settings", "user_id=:user_id", $bind, "*");
		return $result;
	}
	
	public function updateSettings($data){
		//convert date to timestamp
		$date_parts = explode("/", $data['dob']);
		switch($data['date_format']){
			case "mm/dd/yy":
			case "mm/dd/yyyy":
				//risky assumption of 2 digit year
				$dob = mktime(0,0,0, $date_parts[0], $date_parts[1], $date_parts[2]);
				break;
			case "dd/mm/yy":
			case "dd/mm/yyyy":
				//risky assumption of 2 digit year
				$dob = mktime(0,0,0, $date_parts[1], $date_parts[0], $date_parts[2]);
				break;
			
		}
		
		//convert height and weight units to storage units
		//height stored in inches
		switch($data['height_units']){
			case "feet":
				$height = $data['height'] * 12;
				break;
			case "inches":
				$height = $data['height'] * 1;
				break;
			case "centimeters":
				$height = $data['height'] / 2.54;
				break;
		}
		
		//weight stored in pounds
		switch($data['weight_units']){
			case "pounds":
				$weight = $data['weight'] * 1;
				break;
			case "kilograms":
				$weight = $data['weight'] * 2.20462;
				break;
		}
		
		$info = array(
			"user_id" => $_SESSION['user_id'],
			"height" => $height,
			"height_units" => $data['height_units'],
			"weight" => $weight,
			"weight_units" => $data['weight_units'],
			"dob" => $dob,
			"date_format" => $data['date_format'],
		);
		
		if($data['action'] == "new"){
			echo "doing new  ";
			$result = $this->db->insert("user_settings", $info);
		}else if($data['action'] == "edit"){
			$bind = array(
				":user_id" => $_SESSION['user_id'],
			);
			$result = $this->db->update("user_settings", $info, "user_id=:user_id", $bind); //$table, $info, $where, $bind
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