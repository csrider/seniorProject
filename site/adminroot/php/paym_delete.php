<?php

//Start Session
session_start();

//Requires and Includes
require_once 'fns_database.php';

//Get information from submitted form (post)
$method_id = $_POST['method_id'];
$method_name = $_POST['method_name'];

//Check for valid user credentials before inserting record to database
if ($_SESSION['admin_user']) {$valid = 1;}
else if (!$_SESSION['$admin_user']) {$valid = 0;}

//Add record to the database if valid user
if ($valid == 1) {
	$query = "DELETE FROM pay_method 
						WHERE	paym_id='".$method_id."'
						AND paym_name='".$method_name."'";
	$result = dbconnect_newmethod()->query($query);
	header("Location: /zmen/adminroot/pay_method.php" );		//Redirect back to page
}
else {
	echo '<h2>Unable to verify your authorization!</h2>';
	echo '<h4>Please <a href="/zmen/adminroot/start.htm">login</a> and try again</h4>';
}

?>