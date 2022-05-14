<?php

//Start Session
session_start();

//Requires and Includes
require_once 'fns_database.php';

//Get information from submitted form (post)
$ptype_id = $_POST['ptype_id'];
$prod_name = $_POST['prod_name'];
$prod_desc = $_POST['prod_desc'];
$prod_notes = $_POST['prod_notes'];
$prod_unit_size = $_POST['prod_unit_size'];
$prod_cost = $_POST['prod_cost'];
$prod_price = $_POST['prod_price'];
$prod_is_active = $_POST['prod_is_active'];

//Check for valid user credentials before inserting record to database
if ($_SESSION['admin_user']) {$valid = 1;}
else if (!$_SESSION['$admin_user']) {$valid = 0;}

//Add record to the database if valid user
if ($valid == 1) {
	$query = "INSERT INTO product 
						(ptype_id, prod_name, prod_desc, prod_notes, prod_unit_size, prod_cost, prod_price, prod_is_active, prod_created) 
						VALUES ('".$ptype_id."','".$prod_name."','".$prod_desc."','".$prod_notes."','".$prod_unit_size."','".$prod_cost."','".$prod_price."', '".$prod_is_active."',now())";
	$result = dbconnect_newmethod()->query($query);
	header("Location: /zmen/adminroot/main.php" );		//Redirect back to page
}
else {
	echo '<h2>Unable to verify your authorization!</h2>';
	echo '<h4>Please <a href="/zmen/adminroot/start.htm">login</a> and try again</h4>';
}

?>