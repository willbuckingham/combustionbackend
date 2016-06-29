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
	$data = $settings->getSettings()[0];
	
	//convert base units to display units
	switch($data['height_units']){
		case "feet":
			$height = $data['height'] / 12;
			break;
		case "inches":
			$height = $data['height'] / 1;
			break;
		case "centimeters":
			$height = $data['height'] * 2.54;
			break;
	}
	
	switch($data['weight_units']){
		case "pounds":
			$weight = $data['weight'] / 1;
			break;
		case "kilograms":
			$weight = $data['weight'] / 2.20462;
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
		<h1>Combustion Group Assignment - Profile</h1>
	</header>
	
	<section>
		Name: <?=$_SESSION['user_name'];?><br/>
		Email: <?=$_SESSION['user_email']?><br/>
		Height: <?=$height;?> <?=$data['height_units'];?><br/>
		Weight: <?=$data['weight'];?> <?=$data['weight_units'];?><br/>
		DOB: <?=$data['dob'];?> (<?=$data['date_format'];?>)<br/><br/>		
		<a href="settings.php">Edit Settings</a>
	</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</body>
</html>