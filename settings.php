<?php 
	require_once($_SERVER['DOCUMENT_ROOT'] . "/combustionbackend/includes/config.inc");
	require_once(LOGIN_PATH . "/classes/Login.php");
	
	$login = new Login();
	
	if ($login->isUserLoggedIn() != true) {
		foreach ($login->errors as $error) {
            echo $error;
        }
		//echo "error not logged in";	
		header('Location: index.php');
		exit;
	}
	
	require($_SERVER['DOCUMENT_ROOT'] . "/combustionbackend/includes/settings.class.inc");
	$settings = new Settings();
	
	if(isset($_POST['action'])){
		$settings->updateSettings($_POST); //sanitized by pdo lib
	}
	
	//get user settings from DB
	$data = $settings->getSettings()[0];
	if($data = $settings->getSettings()[0]){
		$action = "edit";
	}else{
		$action = "new";
	}
	
	//convert base units to display units
	switch($data['height_units']){
		case "feet":
			$height = round($data['height'] / 12, 2);
			break;
		case "inches":
			$height = round($data['height'] / 1, 2);
			break;
		case "centimeters":
			$height = round($data['height'] * 2.54, 2);
			break;
	}
	
	switch($data['weight_units']){
		case "pounds":
			$weight = round($data['weight'] / 1, 2);
			break;
		case "kilograms":
			$weight = round($data['weight'] / 2.20462, 2);
			break;
	}
	
	switch($data['date_format']){
		case "mm/dd/yy":
			$dob = date("m/d/y", $data['dob']);
			break;
		case "mm/dd/yyyy":
			$dob = date("m/d/Y", $data['dob']);
			break;
		case "dd/mm/yy":
			$dob = date("d/m/y", $data['dob']);
			break;
		case "dd/mm/yyyy":
			$dob = date("d/m/Y", $data['dob']);
			break;
		
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Combustion Group Assignment</title>

</head>
<body>

	<header>
		<h1>Combustion Group Assignment - Settings</h1>
	</header>
	
	<section>
		<form action="settings.php" method="post">
			<input type="hidden" name="action" value="<?=$action;?>">
			
			<!--Name: <input type="text" name="name" value="<?=$data['name'];?>"><br/>
			Email: <input type="text" name="email" value="<?=$data['email'];?>"><br/>-->
			Height: <input type="text" name="height" data-baseheight="<?=$data['height'];?>" value="<?=$height;?>"><br/>
			Height Units: 
				<label><input type="radio" name="height_units" value="feet" <?=$data['height_units']=="feet"?"checked":"";?>>Feet</label>
				<label><input type="radio" name="height_units" value="inches" <?=$data['height_units']=="inches"?"checked":"";?>>Inches</label>
				<label><input type="radio" name="height_units" value="centimeters" <?=$data['height_units']=="centimeters"?"checked":"";?>>Centimeters</label><br/>
			
			Weight: <input type="text" name="weight" data-baseweight="<?=$data['weight'];?>" value="<?=$weight;?>"><br/>
			Weight Units: 
				<label><input type="radio" name="weight_units" value="pounds" <?=$data['weight_units']=="pounds"?"checked":"";?>>Pounds</label>
				<label><input type="radio" name="weight_units" value="kilograms" <?=$data['weight_units']=="kilograms"?"checked":"";?>>Kilograms</label><br/>
				
			DOB: <input type="text" name="dob" value="<?=$dob;?>"><br/>
			Date Format: 
				<label><input type="radio" name="date_format" value="mm/dd/yy" <?=$data['date_format']=="mm/dd/yy"?"checked":"";?>>mm/dd/yy</label>
				<label><input type="radio" name="date_format" value="mm/dd/yyyy" <?=$data['date_format']=="mm/dd/yyyy"?"checked":"";?>>mm/dd/yyyy</label>
				<label><input type="radio" name="date_format" value="dd/mm/yy" <?=$data['date_format']=="dd/mm/yy"?"checked":"";?>>dd/mm/yy</label>
				<label><input type="radio" name="date_format" value="dd/mm/yyyy" <?=$data['date_format']=="dd/mm/yyyy"?"checked":"";?>>dd/mm/yyyy</label><br/>
			<input type="submit" name="submit" value="Submit" disabled>
		</form>
	</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
<!--
	jQuery(document).ready(function(){
		$("input").on("change", function(evt){
			$("input[type=submit]").removeAttr("disabled");
		});
		$("input[name=height_units").on("change", function(evt){
			convertHeight(evt.value);			
		});
	});
	
	function convertHeight(units){
		switch(units){
			case "feet":
				
				break;
				
			case "inches":
			
				break;
				
			case "centimeters":
			
				break;
		}
		//update textbox
	}
//-->
</script>
</body>
</html>
