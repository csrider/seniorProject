<?php

//STARTUP ROUTINES
	session_start();
	$customer_online = $_SESSION['user_online_record'];
	require_once 'fns_database.php';
	$_SESSION['amount_paid'] = $_POST['dueamount'];

//MAIN SECTION
	//If this payment is being made by EFT method (bank account)
	if ($_SESSION['pay_type'] == 'bank') {
		$_SESSION['custbank_address1'] = $_POST['custbank_address1'];
		$_SESSION['custbank_address2'] = $_POST['custbank_address2'];
		$_SESSION['custbank_city'] = $_POST['custbank_city'];
		$_SESSION['custbank_state'] = $_POST['custbank_state'];
		$_SESSION['custbank_zip'] = $_POST['custbank_zip'];
		$_SESSION['custbank_bank'] = $_POST['custbank_bank'];
		$_SESSION['bat_id'] = $_POST['bat_id'];
		$_SESSION['custbank_routing'] = $_POST['custbank_routing'];
		$_SESSION['custbank_account'] = $_POST['custbank_account'];
	 //update the information in the customer_bank table with what they submitted, to ensure latest data
	 	$query = ('  UPDATE customer_bank 
										SET custbank_address1 	= "'.$_POST['custbank_address1'].'",
												custbank_address2 	= "'.$_POST['custbank_address2'].'",
												custbank_city 			= "'.$_POST['custbank_city'].'",
												custbank_state 			= "'.$_POST['custbank_state'].'",
												custbank_zip 				= "'.$_POST['custbank_zip'].'",
												custbank_bank 			= "'.$_POST['custbank_bank'].'",
												bat_id 							= '.$_POST['bat_id'].',
												custbank_routing 		= "'.$_POST['custbank_routing'].'",
												custbank_account 		= "'.$_POST['custbank_account'].'",
												custbank_lastupd_ip = "'.$_SERVER['REMOTE_ADDR'].'"
									WHERE cust_id = '.$customer_online['cust_id'].'  ');//end query
		$result = dbconnect()->query($query);
	 //update the customer's preferred payment method, just to be safe
	 	$query = ('  UPDATE customer
										SET paym_id = '.$_POST['paym_id'].'
									WHERE cust_id = '.$customer_online['cust_id'].'  ');//end query
		$result = dbconnect()->query($query);
	 //record the submitted payment into the payment history table
		$query = ('  INSERT INTO payment 
									(
									cust_id,
									paym_id,
									pmt_amount,
									pmt_date,
									pmt_ip 
									)
								 VALUES 
								  (
								 	'.$customer_online['cust_id'].',
									'.$_POST['paym_id'].',
									"'.$_POST['dueamount'].'",
									curdate(),
									"'.$_SERVER['REMOTE_ADDR'].'"
									)
							');//end query
		$result = dbconnect()->query($query);
	}//end if (for bank payment)


	//If this payment is being made by credit card
	else if ($_SESSION['pay_type'] == 'cc') {
		$_SESSION['custcc_address1'] = $_POST['custcc_address1'];
		$_SESSION['custcc_address2'] = $_POST['custcc_address2'];
		$_SESSION['custcc_city'] = $_POST['custcc_city'];
		$_SESSION['custcc_state'] = $_POST['custcc_state'];
		$_SESSION['custcc_zip'] = $_POST['custcc_zip'];
		$_SESSION['ccv_id'] = $_POST['ccv_id'];
		$_SESSION['custcc_name'] = $_POST['custcc_name'];
		$_SESSION['custcc_number'] = $_POST['custcc_number'];
		$_SESSION['custcc_cid'] = $_POST['custcc_cid'];
		$_SESSION['custcc_expire'] = $_POST['custcc_expire'];
		$_SESSION['custcc_cust_svc'] = $_POST['custcc_cust_svc'];
	 //update the information in the customer_bank table with what they submitted, to ensure latest data
	 	$query = ('  UPDATE customer_cc 
										SET custcc_address1 	= "'.$_POST['custcc_address1'].'",
												custcc_address2 	= "'.$_POST['custcc_address2'].'",
												custcc_city 			= "'.$_POST['custcc_city'].'",
												custcc_state 			= "'.$_POST['custcc_state'].'",
												custcc_zip 				= "'.$_POST['custcc_zip'].'",
												ccv_id 						= '.$_POST['ccv_id'].',
												custcc_name				= "'.$_POST['custcc_name'].'",
												custcc_number			= "'.$_POST['custcc_number'].'",
												custcc_cid				= "'.$_POST['custcc_cid'].'",
												custcc_expire			= "'.$_POST['custcc_expire'].'",
												custcc_cust_svc		= "'.$_POST['custcc_cust_svc'].'",
												custcc_lastupd_ip = "'.$_SERVER['REMOTE_ADDR'].'"
									WHERE cust_id = '.$customer_online['cust_id'].'  ');//end query
		$result = dbconnect()->query($query);
	 //update the customer's preferred payment method, just to be safe
	 	$query = ('  UPDATE customer
										SET paym_id = '.$_POST['paym_id'].'
									WHERE cust_id = '.$customer_online['cust_id'].'  ');//end query
		$result = dbconnect()->query($query);
	 //record the submitted payment into the payment history table
		$query = ('  INSERT INTO payment 
									(
									cust_id,
									paym_id,
									pmt_amount,
									pmt_date,
									pmt_ip 
									)
								 VALUES 
								  (
								 	'.$customer_online['cust_id'].',
									'.$_POST['paym_id'].',
									"'.$_POST['dueamount'].'",
									curdate(),
									"'.$_SERVER['REMOTE_ADDR'].'"
									)
							');//end query
		$result = dbconnect()->query($query);
	}//end if (for cc payment)


	//Else this file can't determine which payment method is being used
	else echo '$_SESSION[\'pay_type\'] is not set correctly.<br />submit_payment.php does not know how to handle the posted data from the previous page.';


//CLEAN-UP ROUTINES
	unset($query, $result);


//FINISH UP
	header("Location: /zmen/php/payment_confirmation.php");
?>