<?php

//Start Session
session_start();

$customer_online = $_SESSION['user_online_record'];
$customer_online['cust_id'];

//Requires and Includes
require_once 'fns_database.php';


		$query = "UPDATE customer_online 
							SET custo_username = '".$_POST['custo_username']."',
									custo_password = '".$_POST['custo_password']."',
									custo_email = '".$_POST['custo_email']."',
									custo_promotions = '".$_POST['custo_promotions']."'
									WHERE cust_id = '".$customer_online['cust_id']."'
						 ";
		$result = dbconnect()->query($query);
	
	
	
	
	
	//Redirect back to the main page when complete
	header("Location: /zmen/index.php" );		//Redirect back to page


?>