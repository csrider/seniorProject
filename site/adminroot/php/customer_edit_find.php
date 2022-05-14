<?php 

//Start Session
session_start();

//Requires and Includes
require_once 'fns_database.php';



//***THE FOLLOWING CODE SIMPLY DECIDES WHICH TYPE OF SEARCH TO RUN, BASED ON WHAT CRITERIA THEY ARE SEARCHING FOR, and forwards the results to the session***

//Customer-ID Based
if ($_POST['find_cust_id'] && !$_POST['find_cust_hphone']) {
	
	//check that their search actually exists before proceeding
	$result = dbconnect_newmethod()->query("SELECT cust_id FROM customer WHERE cust_id='".$_POST['find_cust_id']."'");
	for ($i=0; $i<$result->num_rows; $i++) $customer = $result->fetch_assoc();
	if (!$customer['cust_id']) header('Location: /zmen/adminroot/php/customer_edit_form.php');
	else {
	$_SESSION['cust_id'] = $customer['cust_id'];
	
	//search table: customer
		$query = "SELECT * FROM customer, customer_type, pay_method 
							WHERE cust_id = '".$_SESSION['cust_id']."' 
							AND customer.ctype_id = customer_type.ctype_id 
							AND customer.paym_id = pay_method.paym_id
						 ";
		$result = dbconnect_newmethod()->query($query);
		for ($i=0; $i<$result->num_rows; $i++) $customer = $result->fetch_assoc();
		$_SESSION['customer'] = $customer;
		$_SESSION['cust_id'] = $customer['cust_id'];
	
	//search table: customer_online
		$query = "SELECT * FROM customer_online 
							WHERE cust_id = '".$_SESSION['cust_id']."'
						 ";
		$result = dbconnect_newmethod()->query($query);
		for ($i=0; $i<$result->num_rows; $i++) $customer_online = $result->fetch_assoc();
		$_SESSION['customer_online'] = $customer_online;
		if (!isset($customer_online['cust_id'])) $_SESSION['disable_customer_online'] = 'disabled';
	
	//search table: customer_cc
		$query = "SELECT * FROM customer_cc, cc_vendor 
							WHERE cust_id = '".$_SESSION['cust_id']."' 
							AND customer_cc.ccv_id = cc_vendor.ccv_id
						 ";
		$result = dbconnect_newmethod()->query($query);
		for ($i=0; $i<$result->num_rows; $i++) $customer_cc = $result->fetch_assoc();
		$_SESSION['customer_cc'] = $customer_cc;
		if (!isset($customer_cc['cust_id'])) $_SESSION['disable_customer_cc'] = 'disabled';
	
	//search table: customer_bank
		$query = "SELECT * FROM customer_bank, bank_acct_type 
							WHERE cust_id = '".$_SESSION['cust_id']."' 
							AND customer_bank.bat_id = bank_acct_type.bat_id
						 ";
		$result = dbconnect_newmethod()->query($query);
		for ($i=0; $i<$result->num_rows; $i++) $customer_bank = $result->fetch_assoc();
		$_SESSION['customer_bank'] = $customer_bank;
		if (!isset($customer_bank['cust_id'])) $_SESSION['disable_customer_bank'] = 'disabled';
		
	header('Location: /zmen/adminroot/php/customer_edit_form2.php');
	}
}



//Home-Phone Based
else if (!$_POST['find_cust_id'] && $_POST['find_cust_hphone']) {
	
	//check that their search actually exists before proceeding
	$result = dbconnect_newmethod()->query("SELECT cust_id FROM customer WHERE cust_hphone='".$_POST['find_cust_hphone']."'");
	for ($i=0; $i<$result->num_rows; $i++) $customer = $result->fetch_assoc();
	if (!$customer['cust_id']) header('Location: /zmen/adminroot/php/customer_edit_form.php');
	else {
	$_SESSION['cust_id'] = $customer['cust_id'];
	
	//search table: customer
		$query = "SELECT * FROM customer, customer_type, pay_method 
							WHERE cust_id = '".$_SESSION['cust_id']."' 
							AND customer.ctype_id = customer_type.ctype_id 
							AND customer.paym_id = pay_method.paym_id
						 ";
		$result = dbconnect_newmethod()->query($query);
		for ($i=0; $i<$result->num_rows; $i++) $customer = $result->fetch_assoc();
		$_SESSION['customer'] = $customer;
		$_SESSION['cust_id'] = $customer['cust_id'];
	
	//search table: customer_online
		$query = "SELECT * FROM customer_online 
							WHERE cust_id='".$_SESSION['cust_id']."'
						 ";
		$result = dbconnect_newmethod()->query($query);
		for ($i=0; $i<$result->num_rows; $i++) $customer_online = $result->fetch_assoc();
		$_SESSION['customer_online'] = $customer_online;
		if (!isset($customer_online['cust_id'])) $_SESSION['disable_customer_online'] = 'disabled';
	
	//search table: customer_cc
		$query = "SELECT * FROM customer_cc, cc_vendor 
							WHERE cust_id = '".$_SESSION['cust_id']."' 
							AND customer_cc.ccv_id = cc_vendor.ccv_id
						 ";
		$result = dbconnect_newmethod()->query($query);
		for ($i=0; $i<$result->num_rows; $i++) $customer_cc = $result->fetch_assoc();
		$_SESSION['customer_cc'] = $customer_cc;
		if (!isset($customer_cc['cust_id'])) $_SESSION['disable_customer_cc'] = 'disabled';
	
	//search table: customer_bank
		$query = "SELECT * FROM customer_bank, bank_acct_type 
							WHERE cust_id = '".$_SESSION['cust_id']."' 
							AND customer_bank.bat_id = bank_acct_type.bat_id
						 ";
		$result = dbconnect_newmethod()->query($query);
		for ($i=0; $i<$result->num_rows; $i++) $customer_bank = $result->fetch_assoc();
		$_SESSION['customer_bank'] = $customer_bank;
		if (!isset($customer_bank['cust_id'])) $_SESSION['disable_customer_bank'] = 'disabled';
	
	header('Location: /zmen/adminroot/php/customer_edit_form2.php');
	}
}



//Catch if they didn't enter any search criteria
else if (!$_POST['find_cust_id'] && !$_POST['find_cust_hphone']) {
	header('Location: /zmen/adminroot/php/customer_edit_form.php');
}



//Catch if they entered more than one search criteria
else {
	echo '<h2>Only one search criteria may be used!</h2><h4><a href="/zmen/adminroot/php/customer_edit_form.php">Click here to try again</h4>';
}


?>
