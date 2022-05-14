<?php

//Start Session
session_start();
$id = $_SESSION['admin_id_toedit'];
//Requires and Includes
require_once 'fns_database.php';

//Get information from submitted form (post)
$admin_user_fname = $_POST['admin_user_fname'];
$admin_user_lname = $_POST['admin_user_lname'];
$admin_user_username = $_POST['admin_user_username'];
$admin_user_password = $_POST['admin_user_password'];
$admin_user_email = $_POST['admin_user_email'];
$admin_level = $_POST['admin_level'];

//Check for valid user credentials before inserting record to database
if ($_SESSION['admin_user']) {$valid = 1;}
else if (!$_SESSION['$admin_user']) {$valid = 0;}

//Add record to the database if valid user
if ($valid == 1) {
	$query = ('UPDATE admin_user
						 SET admin_user_fname="'.$admin_user_fname.'",
								 admin_user_lname="'.$admin_user_lname.'",
								 admin_user_username="'.$admin_user_username.'",
								 admin_user_password="'.$admin_user_password.'",
								 admin_user_email="'.$admin_user_email.'",
								 admin_level="'.$admin_level.'"
						 WHERE admin_user_id="'.$id.'"');
	$result = dbconnect_newmethod()->query($query);
	unset($_SESSION['admin_id_toedit']);
	header("Location: /zmen/adminroot/admin.php" );		//Redirect back to page
}
else {
	echo '<h2>Unable to verify your authorization!</h2>';
	echo '<h4>Please <a href="/zmen/adminroot/start.htm">login</a> and try again</h4>';
}

?>