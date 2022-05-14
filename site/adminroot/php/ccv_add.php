<?php

//Start Session
session_start();

//Requires and Includes
require_once 'fns_database.php';

//Get information from submitted form (post)
$vendor_name = $_POST['vendor_name'];
$vendor_num = $_POST['vendor_num'];
$vendor_phone = $_POST['vendor_phone'];

//Check for valid user credentials before inserting record to database
if ($_SESSION['admin_user']) {$valid = 1;}
else if (!$_SESSION['$admin_user']) {$valid = 0;}

//Add record to the database if valid user
if ($valid == 1) {
	$query = "INSERT INTO cc_vendor 
						(ccv_name, ccv_merch_num, ccv_merch_phone, ccv_created) 
						VALUES ('".$vendor_name."','".$vendor_num."','".$vendor_phone."',now())";
	$result = dbconnect_newmethod()->query($query);
	header("Location: /zmen/adminroot/cc_vendor.php" );		//Redirect back to page
}
else {
	echo '<h2>Unable to verify your authorization!</h2>';
	echo '<h4>Please <a href="/zmen/adminroot/start.htm">login</a> and try again</h4>';
}

?>