<?php

//Start Session
session_start();

//Requires and Includes
require_once 'fns_database.php';

//Check for valid user credentials before inserting record to database
if ($_SESSION['admin_user']) {$valid = 1;}
else if (!$_SESSION['$admin_user']) {$valid = 0;}

//Add record to the database if valid user
if ($valid == 1) {
	$query = ('UPDATE tip
						 SET ptype_id="'.$_POST['tip_type'].'",
								 tip_text="'.$_POST['tip_text'].'",
								 tip_last_mod_by="'.$_SESSION['admin_id'].'"
						 WHERE tip_id="'.$_SESSION['tip_id'].'"');
	$result = dbconnect_newmethod()->query($query);
	unset($_SESSION['tip_id']);
	header("Location: /zmen/adminroot/tip.php" );		//Redirect back to page
}
else {
	echo '<h2>Unable to verify your authorization!</h2>';
	echo '<h4>Please <a href="/zmen/adminroot/start.htm">login</a> and try again</h4>';
}

?>