<?php

//Start Session
session_start();

//Requires and Includes
require_once 'fns_database.php';

//Get information from submitted form (post)
$method_id = $_SESSION['paym_id'];
$method_name = $_POST['paym_name'];
$method_desc = $_POST['paym_desc'];
$method_merchnum = $_POST['paym_merchant_num'];

//Check for valid user credentials before inserting record to database
if ($_SESSION['admin_user']) {$valid = 1;}
else if (!$_SESSION['$admin_user']) {$valid = 0;}

//Add record to the database if valid user
if ($valid == 1) {
	$query = ('UPDATE pay_method
						 SET paym_id="'.$method_id.'",
								 paym_name="'.$method_name.'",
								 paym_desc="'.$method_desc.'",
								 paym_merchant_num="'.$method_merchnum.'"
						 WHERE paym_id="'.$method_id.'"');
	$result = dbconnect_newmethod()->query($query);
	unset($_SESSION['paym_id']);
	header("Location: /zmen/adminroot/pay_method.php" );		//Redirect back to page
}
else {
	echo '<h2>Unable to verify your authorization!</h2>';
	echo '<h4>Please <a href="/zmen/adminroot/start.htm">login</a> and try again</h4>';
}

?>