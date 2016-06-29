<?php 
	require_once($_SERVER['DOCUMENT_ROOT'] . "/combustion/includes/config.inc");
	require_once(LOGIN_PATH . "/classes/Login.php");
	
	$login = new Login();
	
	if ($login->isUserLoggedIn() != true) {
		foreach ($login->errors as $error) {
            echo $error;
        }
		echo "error not logged in";	
		//header('Location: index.php');
		exit;
	}
	
	require($_SERVER['DOCUMENT_ROOT'] . "/combustion/includes/settings.class.inc");
	
	$settings = new Settings();
	$data = $settings->getSettings(1);
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
		Name: <?=$data['name'];?><br/>
		Email: <?=$data['email'];?><br/>
		Height: <?=$data['height'];?><br/>
		Units: <?=data['units'];?><br/>
		Weight: <?=$data['weight'];?><br/>
		DOB: <?=$data['dob'];?>
		Date Format: <?=$data['date_format'];?>
		
		<a href="settings.php">Edit Settings</a>
	</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</body>
</html>