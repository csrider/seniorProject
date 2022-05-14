<?php

//Start session and allow use of session variables
session_start();
$admin_user = $_SESSION['admin_user'];

//Requires & Includes
require_once 'fns_display.php';

//Check to make sure there is a current session active
if ($admin_user) {
	session_destroy();
	logout_successful(1);
}
else {
	logout_successful(0);
}

?>