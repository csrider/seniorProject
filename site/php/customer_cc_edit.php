<?php

//Start Session
session_start();
$customer_online = $_SESSION['user_online_record'];
$customer_online['cust_id'];

//Requires and Includes
require_once 'fns_database.php';


		$query = "UPDATE customer_cc 
				SET custcc_address1 = '".$_POST['custcc_address1']."',
					custcc_address2	= '".$_POST['custcc_address2']."',
					custcc_city	= '".$_POST['custcc_city']."',
					custcc_state = '".$_POST['custcc_state']."',
					custcc_zip 	= '".$_POST['custcc_zip']."',
					ccv_id	= '".$_POST['ccv_id']."',
					custcc_name	= '".$_POST['custcc_name']."',
					custcc_number = '".$_POST['custcc_number']."',
					custcc_cid = '".$_POST['custcc_cid']."',
					custcc_expire = '".$_POST['custcc_expire']."',
					custcc_cust_svc = '".$_POST['custcc_cust_svc']."'
				WHERE cust_id = '".$customer_online['cust_id']."' ";
		$result = dbconnect()->query($query);
	
	
	
	
	
	//Redirect back to the main page when complete
	header("Location: /zmen/index.php" );		//Redirect back to page


?>