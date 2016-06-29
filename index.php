<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/combustion/includes/config.inc");
	require_once(LOGIN_PATH . "/classes/Login.php");
	
	$login = new Login();
	
	if ($login->isUserLoggedIn() == true) {
		header('Location: profile.php');
		exit;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Combustion Group Assignment</title>

</head>
<body>

	<header>
		<h1>Combustion Group Assignment</h1>
	</header>
	
	<section>
		<h3>Login or <a href="register.php">Sign Up</a></h3>
		<form action="profile.php" method="post">
			<label>User Name: <input type="text" name="user_name"></label>
			<label>Password: <input type="password" name="user_password"></label><br/>
			<input type="submit" name="submit" value="Submit" />
		</form>
	</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</body>
</html>
