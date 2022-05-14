<?php

//Start Session
session_start();
$customer_online = $_SESSION['user_online_record'];
$customer_online['cust_id'];


//Requires and Includes
require_once 'fns_database.php';


		$query = "UPDATE customer_bank 
				   SET bat_id = '".$_POST['bat_id']."',
				   custbank_routing = '".$_POST['custbank_routing']."',
				   custbank_account = '".$_POST['custbank_account']."',
				   custbank_address1 = '".$_POST['custbank_address1']."',
				   custbank_address2 = '".$_POST['custbank_address2']."',
				   custbank_city = '".$_POST['custbank_city']."',
				   custbank_state = '".$_POST['custbank_state']."',
				   custbank_zip = '".$_POST['custbank_zip']."',
				   custbank_lastupd_ip = '".$_SERVER['REMOTE_ADDR']."'
				 WHERE cust_id = '".$customer_online['cust_id']."' ";
		$result = dbconnect()->query($query);
	
	
	
	
	
	//Redirect back to the main page when complete
	header("Location: /zmen/index.php" );		//Redirect back to page


?>