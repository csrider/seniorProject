<?php

//Start Session
session_start();

//Requires and Includes
require_once 'fns_database.php';

//Get information from submitted form (post)
$ctype_id = $_SESSION['ctype_id'];
$ctype_type = $_POST['ctype_type'];
$ctype_desc = $_POST['ctype_desc'];

//Check for valid user credentials before inserting record to database
if ($_SESSION['admin_user']) {$valid = 1;}
else if (!$_SESSION['$admin_user']) {$valid = 0;}

//Add record to the database if valid user
if ($valid == 1) {
	$query = ('UPDATE customer_type
						 SET ctype_id="'.$ctype_id.'",
								 ctype_type="'.$ctype_type.'",
								 ctype_desc="'.$ctype_desc.'"
						 WHERE ctype_id="'.$ctype_id.'"');
	$result = dbconnect_newmethod()->query($query);
	unset($_SESSION['ctype_id']);
	header("Location: /zmen/adminroot/customer_type.php" );		//Redirect back to page
}
else {
	echo '<h2>Unable to verify your authorization!</h2>';
	echo '<h4>Please <a href="/zmen/adminroot/start.htm">login</a> and try again</h4>';
}

?>