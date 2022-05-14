<?php //Database functions

//Connect to zmendev database 
function dbconnect_oldmethod()	{
	@ $db = new mysqli('localhost','zmen_webuser','password','zmendev');
	if (mysqli_connect_errno())	{
		echo 'Error, could not connect to zmendev database. Please try again later.';
		exit;
	}
	return $db;
	mysqli_close($db);
}

//Create a connection to the database
function dbconnect_newmethod() {
	$db = mysqli_connect('localhost','zmen_webuser','password','zmendev');
	if(!$db) {
		echo 'Error, could not connect to zmendev database. Please try again later.';
		exit;
	}
	return $db;
	mysqli_close($db);
}

?>