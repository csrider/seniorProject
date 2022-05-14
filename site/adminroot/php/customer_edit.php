<?php

//Start Session
session_start();

//Requires and Includes
require_once 'fns_database.php';

//Check if the admin user is valid
if ($_SESSION['admin_user']) {

	//ADD RECORD(S) AS NEEDED
	/*
	if () {
		
	}
	*/

	//UPDATE RECORD(S) AS NEEDED
	//Update customer table if applicable
	if ($_POST['customer_confirm'] == 'confirm_update') {
		$query = "UPDATE customer 
							SET ctype_id 			= '".	$_POST['ctype_id']			."',
									cust_lname 		= '".	$_POST['cust_lname']		."',
									cust_fname 		= '".	$_POST['cust_fname']		."',
									cust_minitial = '".	$_POST['cust_minitial']	."',
									cust_suffix 	= '".	$_POST['cust_suffix']		."',
									cust_address1 = '".	$_POST['cust_address1']	."',
									cust_address2 = '".	$_POST['cust_address2']	."',
									cust_city 		= '".	$_POST['cust_city']			."',
									cust_state 		= '".	$_POST['cust_state']		."',
									cust_zip 			= '".	$_POST['cust_zip']			."',
									cust_wphone 	= '".	$_POST['cust_wphone']		."',
									cust_hphone 	= '".	$_POST['cust_hphone']		."',
									cust_mphone 	= '".	$_POST['cust_mphone']		."',
									paym_id 			= '".	$_POST['paym_id']				."',
									cust_tax_id 	= '".	$_POST['cust_tax_id']		."',
									admin_id 			= '".	$_SESSION['admin_id']		."'
							WHERE cust_id = '".$_SESSION['cust_id']."'
						 ";
		$result = dbconnect_newmethod()->query($query);
	}
	//Update customer_online table if applicable
	if ($_POST['customer_online_confirm'] == 'confirm_update') {
		$query = "UPDATE customer_online 
							SET custo_username 				= '".	$_POST['custo_username']		."',
									custo_password 				= '".	$_POST['custo_password']		."',
									custo_email 					= '".	$_POST['custo_email']				."',
									custo_promotions 			= '".	$_POST['custo_promotions']	."',
									custo_last_update_ip 	= '".	$_SERVER['REMOTE_ADDR']			."',
									custo_last_mod_by 		= '".	$_SESSION['admin_user']			."'
							WHERE cust_id = '".$_SESSION['cust_id']."'
						 ";
		$result = dbconnect_newmethod()->query($query);
	}
	//Update customer_cc table if applicable
	if ($_POST['customer_cc_confirm'] == 'confirm_update') {
		$query = "UPDATE customer_cc 
							SET custcc_address1 		= '".	$_POST['custcc_address1']	."',
									custcc_address2 		= '".	$_POST['custcc_address2']	."',
									custcc_city 				= '".	$_POST['custcc_city']			."',
									custcc_state 				= '".	$_POST['custcc_state']		."',
									custcc_zip 					= '".	$_POST['custcc_zip']			."',
									ccv_id 							= '".	$_POST['ccv_id']					."',
									custcc_name 				= '".	$_POST['custcc_name']			."',
									custcc_number 			= '".	$_POST['custcc_number']		."',
									custcc_cid 					= '".	$_POST['custcc_cid']			."',
									custcc_expire 			= '".	$_POST['custcc_expire']		."',
									custcc_cust_svc 		= '".	$_POST['custcc_cust_svc']	."',
									custcc_lastupd_ip 	= '".	$_SERVER['REMOTE_ADDR']		."',
									custcc_last_mod_by 	= '".	$_SESSION['admin_user']		."'
							WHERE cust_id = '".$_SESSION['cust_id']."'
						 ";
		$result = dbconnect_newmethod()->query($query);
	}
	//Update customer_bank table if applicable
	if ($_POST['customer_bank_confirm'] == 'confirm_update') {
		$query = "UPDATE customer_bank 
							SET bat_id = '".$_POST['bat_id']."',
									custbank_routing 			= '".	$_POST['custbank_routing']	."',
									custbank_account 			= '".	$_POST['custbank_account']	."',
									custbank_address1 		= '".	$_POST['custbank_address1']	."',
									custbank_address2 		= '".	$_POST['custbank_address2']	."',
									custbank_city 				= '".	$_POST['custbank_city']			."',
									custbank_state 				= '".	$_POST['custbank_state']		."',
									custbank_zip 					= '".	$_POST['custbank_zip']			."',
									custbank_lastupd_ip 	= '".	$_SERVER['REMOTE_ADDR']			."',
									custbank_last_mod_by 	= '".	$_SESSION['admin_user']			."'
							WHERE cust_id = '".$_SESSION['cust_id']."'
						 ";
		$result = dbconnect_newmethod()->query($query);
	}
	
	//Clear appropriate variables
	unset($_SESSION['disable_customer_online'], $_SESSION['disable_customer_cc'], $_SESSION['disable_customer_bank']);
	
	//Redirect back to the main page when complete
	header("Location: /zmen/adminroot/main.php" );		//Redirect back to page
}

else {
	echo '<h2>Unable to verify your authorization!</h2>';
	echo '<h4>Please <a href="/zmen/adminroot/start.htm">login</a> and try again</h4>';
}



?>