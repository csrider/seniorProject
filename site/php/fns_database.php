<?php

//Create a connection to the database for a public user, and return as an object
function dbconnect() {
	$db = mysqli_connect('localhost','zmen_webuser','password','zmendev');
	if(!$db) {
		echo 'Error, could not connect to zmendev database. Please try again later.';
		exit;
	}
	return $db;
	mysqli_close($db);
}

?>