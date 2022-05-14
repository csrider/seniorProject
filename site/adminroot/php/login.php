<?php

//Start session and allow use of session variables
session_start();

//Includes & Requires
require_once 'fns_database.php';	//contains the database connection funtion used to run query
require_once 'fns_display.php';	//contains the display functions that will display the login form should they error while logging in

//Check what the user entered with database records (validate user)
if ($_POST['username'] && $_POST['password']) {		//checks to see if user entered username and password
	$username = $_POST['username'];
	$password = $_POST['password'];
	$result = dbconnect_newmethod()->query("SELECT * FROM admin_user 
											WHERE admin_user_username='$username' 
											AND admin_user_password='$password'");
	if ($result->num_rows>0) {
		for ($i=0; $i<$result->num_rows; $i++) $row = $result->fetch_assoc();
		$_SESSION['admin_user'] = $row['admin_user_username'];	//store the admin username in the session
		$_SESSION['admin_id'] = $row['admin_user_id'];	//store the admin user ID in the session
		header("Location: /zmen/adminroot/main.php" );	//take user to main administration page
	}
	else { 
		echo '
			<script language="javascript1.1" type="text/javascript">
				window.alert("The information you entered is invalid");
			</script>
		';
		disp_login();
	}
}
else {
	echo '
		<script language="javascript1.1" type="text/javascript">
			window.alert("You must enter a matching username and password");
		</script>
	';
	disp_login();
}

?>