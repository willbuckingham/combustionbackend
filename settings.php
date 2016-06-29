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
	
	if(isset($_POST['userid']){
		//we are getting data from form, so post to DB		
	}
	
	//get user settings from DB
	//$data = 
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
		<form action="settings.php" method="post">
			Name: <input type="text" name="name" value="<?=$data['name'];?>"><br/>
			Email: <input type="text" name="email" value="<?=$data['email'];?>"><br/>
			Height: <input type="text" name="height" value="<?=$data['height'];?>"><br/>
			Height Units: 
				<label><input type="radio" name="height_units" value="feet">Feet</label>
				<label><input type="radio" name="height_units" value="inches">Inches</label>
				<label><input type="radio" name="height_units" value="centimeters">Centimeters</label><br/>
			Weight: <input type="text" name="weight" value="<?=$data['weight'];?>"><br/>
			Weight Units: 
				<label><input type="radio" name="weight_units" value="pounds">Pounds</label>
				<label><input type="radio" name="weight_units" value="kilograms">Kilograms</label>
			DOB: <input type="text" name="dob" value="<?=$data['dob'];?>"><br/>
			Date Format: 
				<label><input type="radio" name="date_format" value="mm/dd/yy">mm/dd/yy</label>
				<label><input type="radio" name="date_format" value="mm/dd/yyyy">mm/dd/yyyy</label>
				<label><input type="radio" name="date_format" value="dd/mm/yy">dd/mm/yy</label>
				<label><input type="radio" name="date_format" value="dd/mm/yyyy">dd/mm/yyyy</label><br/>
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
