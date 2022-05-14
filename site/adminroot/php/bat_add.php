<?php

//Start Session
session_start();

//Requires and Includes
require_once 'fns_database.php';

//Get information from submitted form (post)
$bat_type = $_POST['bat_type'];
$bat_desc = $_POST['bat_desc'];

//Check for valid user credentials before inserting record to database
if ($_SESSION['admin_user']) {$valid = 1;}
else if (!$_SESSION['$admin_user']) {$valid = 0;}

//Add record to the database if valid user
if ($valid == 1) {
	$query = "INSERT INTO bank_acct_type 
						(bat_type, bat_desc, bat_created) 
						VALUES ('".$bat_type."','".$bat_desc."',now())";
	$result = dbconnect_newmethod()->query($query);
	header("Location: /zmen/adminroot/ba_type.php" );		//Redirect back to page
}
else {
	echo '<h2>Unable to verify your authorization!</h2>';
	echo '<h4>Please <a href="/zmen/adminroot/start.htm">login</a> and try again</h4>';
}

?>