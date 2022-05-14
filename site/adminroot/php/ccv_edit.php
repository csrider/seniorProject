<?php

//Start Session
session_start();

//Requires and Includes
require_once 'fns_database.php';

//Get information from submitted form (post)
$ccv_id = $_SESSION['ccv_id'];
$ccv_name = $_POST['ccv_name'];
$ccv_merchnum = $_POST['ccv_merchnum'];
$ccv_merchphone = $_POST['ccv_merchphone'];

//Check for valid user credentials before inserting record to database
if ($_SESSION['admin_user']) {$valid = 1;}
else if (!$_SESSION['$admin_user']) {$valid = 0;}

//Add record to the database if valid user
if ($valid == 1) {
	$query = ('UPDATE cc_vendor
						 SET ccv_id="'.$ccv_id.'",
								 ccv_name="'.$ccv_name.'",
								 ccv_merch_num="'.$ccv_merchnum.'",
								 ccv_merch_phone="'.$ccv_merchphone.'"
						 WHERE ccv_id="'.$ccv_id.'"');
	$result = dbconnect_newmethod()->query($query);
	unset($_SESSION['ccv_id']);
	header("Location: /zmen/adminroot/cc_vendor.php" );		//Redirect back to page
}
else {
	echo '<h2>Unable to verify your authorization!</h2>';
	echo '<h4>Please <a href="/zmen/adminroot/start.htm">login</a> and try again</h4>';
}

?>