<?php

//Start Session
session_start();

//Requires and Includes
require_once 'fns_database.php';

//Get information from submitted form (post)
$method_name = $_POST['method_name'];
$method_description = $_POST['method_description'];
$method_merchnum = $_POST['method_merchnum'];

//Check for valid user credentials before inserting record to database
if ($_SESSION['admin_user']) {$valid = 1;}
else if (!$_SESSION['$admin_user']) {$valid = 0;}

//Add record to the database if valid user
if ($valid == 1) {
	$query = "INSERT INTO pay_method 
						(paym_name, paym_desc, paym_merchant_num, paym_created) 
						VALUES ('".$method_name."','".$method_description."','".$method_merchnum."',now())";
	$result = dbconnect_newmethod()->query($query);
	header("Location: /zmen/adminroot/pay_method.php" );		//Redirect back to page
}
else {
	echo '<h2>Unable to verify your authorization!</h2>';
	echo '<h4>Please <a href="/zmen/adminroot/start.htm">login</a> and try again</h4>';
}

?>