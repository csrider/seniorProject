<?php

//Start Session
session_start();

$customer_online = $_SESSION['user_online_record'];
$customer_online['cust_id'];

//Requires and Includes
require_once 'fns_database.php';


		$query = ('UPDATE customer 
									SET ctype_id 			= '.$_POST['ctype_id'].',
											cust_lname 		= "'.$_POST['cust_lname'].'",
											cust_fname 		= "'.$_POST['cust_fname'].'",
											cust_minitial = "'.$_POST['cust_minitial'].'",
											cust_suffix 	= "'.$_POST['cust_suffix'].'",
											cust_address1 = "'.$_POST['cust_address1'].'",
											cust_address2 = "'.$_POST['cust_address2'].'",
											cust_city 		= "'.$_POST['cust_city'].'",
											cust_state 		= "'.$_POST['cust_state'].'",
											cust_zip 			= "'.$_POST['cust_zip'].'",
											cust_wphone 	= "'.$_POST['cust_wphone'].'",
											cust_hphone 	= "'.$_POST['cust_hphone'].'",
											cust_mphone 	= "'.$_POST['cust_mphone'].'",
											paym_id 			= '.$_POST['paym_id'].',
											cust_tax_id 	= "'.$_POST['cust_tax_id'].'"
								WHERE cust_id = '.$customer_online['cust_id'].'  ');
						 
						 //echo $query;
		$result = dbconnect()->query($query);
	
	
	
	
	
	//Redirect back to the main page when complete
	header("Location: /zmen/index.php" );		//Redirect back to page


?>