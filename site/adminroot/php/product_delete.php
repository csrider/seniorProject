<?php

//Start Session
session_start();

//Requires and Includes
require_once 'fns_database.php';

//Get information from submitted form (post)
$id = $_POST['prod_id'];

//Check for valid user credentials before inserting record to database
if ($_SESSION['admin_user']) {$valid = 1;}
else if (!$_SESSION['$admin_user']) {$valid = 0;}

//Add record to the database if valid user
if ($valid == 1) {
	$query = "DELETE FROM product WHERE	prod_id='".$id."'";
	$result = dbconnect_newmethod()->query($query);
	header("Location: /zmen/adminroot/product.php" );		//Redirect back to page
}
else {
	echo '<h2>Unable to verify your authorization!</h2>';
	echo '<h4>Please <a href="/zmen/adminroot/start.htm">login</a> and try again</h4>';
}

?>