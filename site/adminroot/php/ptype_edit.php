<?php

//Start Session
session_start();

//Requires and Includes
require_once 'fns_database.php';

//Get information from submitted form (post)
$ptype_id = $_SESSION['ptype_id'];
$ptype_type = $_POST['ptype_type'];
$ptype_desc = $_POST['ptype_desc'];

//Check for valid user credentials before inserting record to database
if ($_SESSION['admin_user']) {$valid = 1;}
else if (!$_SESSION['$admin_user']) {$valid = 0;}

//Add record to the database if valid user
if ($valid == 1) {
	$query = ('UPDATE prod_type
						 SET ptype_id="'.$ptype_id.'",
								 ptype_type="'.$ptype_type.'",
								 ptype_desc="'.$ptype_desc.'"
						 WHERE ptype_id="'.$ptype_id.'"');
	$result = dbconnect_newmethod()->query($query);
	unset($_SESSION['ptype_id']);
	header("Location: /zmen/adminroot/prod_type.php" );		//Redirect back to page
}
else {
	echo '<h2>Unable to verify your authorization!</h2>';
	echo '<h4>Please <a href="/zmen/adminroot/start.htm">login</a> and try again</h4>';
}

?>