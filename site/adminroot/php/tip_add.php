<?php

//Start Session
session_start();

//Requires and Includes
require_once 'fns_database.php';

//Get information from submitted form (post)
$id = $_POST['tip_id'];
$ptype = $_POST['ptype_id'];
$text = $_POST['tip_text'];

//Check for valid user credentials before inserting record to database
if ($_SESSION['admin_user']) {$valid = 1;}
else if (!$_SESSION['$admin_user']) {$valid = 0;}

//Add record to the database if valid user
if ($valid == 1) {
	$query = "INSERT INTO tip 
						(ptype_id, tip_text, tip_created, tip_last_mod_by) 
						VALUES ('".$ptype."','".$text."',now(), '".$_SESSION['admin_id']."')";
	$result = dbconnect_newmethod()->query($query);
	header("Location: /zmen/adminroot/tip.php" );		//Redirect back to page
}
else {
	echo '<h2>Unable to verify your authorization!</h2>';
	echo '<h4>Please <a href="/zmen/adminroot/start.htm">login</a> and try again</h4>';
}

?>