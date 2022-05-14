<?php
//START-UP ROUTINES
	session_start();
	require_once 'fns_database.php';
	require_once 'fns_queries.php';
	require_once 'fns_display.php';
	$customer_online = $_SESSION['user_online_record'];
	$cust_id = $customer_online['cust_id'];
	
//Extract this customer's online info from the session (stored when they logged-in)
	$customer_online = $_SESSION['user_online_record'];

//Query the database for additional information about this customer
	//customer table
		$result = dbconnect()->query('  SELECT * FROM customer WHERE cust_id = '.$cust_id.'  ');
		$customer = $result->fetch_assoc();
	//customer_cc table
		$result = dbconnect()->query('  SELECT * FROM customer_cc WHERE cust_id = '.$cust_id.'  ');
		$customer_cc = $result->fetch_assoc();
	//customer_bank table
		$result = dbconnect()->query('  SELECT * FROM customer_bank WHERE cust_id = '.$cust_id.'  ');
		$customer_bank = $result->fetch_assoc();

//Various functions
	function get_dueamount() {
		$customer_online = $_SESSION['user_online_record'];
		$cust_id = $customer_online['cust_id'];
	//Query to get the total amount they pay for their services and locations
		$result = dbconnect()->query('  SELECT sum(prod_price)
																			FROM product, svc_address, svc_addr_prod
																			WHERE svc_address.sa_id = svc_addr_prod.sa_id
																				AND svc_addr_prod.prod_id = product.prod_id
																				AND cust_id = '.$cust_id.'  ');
		$row = $result->fetch_assoc();
	//Query to get their last payment information
		$result2 = dbconnect()->query('  SELECT pmt_amount, pmt_date 
																			FROM payment 
																			WHERE cust_id = '.$cust_id.' 
																			  AND pmt_date = (SELECT MAX(pmt_date) 
																													FROM payment 
																													WHERE cust_id = '.$cust_id.')  ');
		$row2 = $result2->fetch_assoc();
	//Algorithm to derive their amount due, if it's due
		$last_paid_date = $row2['pmt_date'];
		$last_paid_amount = $row2['pmt_amount'];
		$bill_amount = $row['sum(prod_price)'];
		if($last_paid_amount<$bill_amount && $last_paid_amount>0) $amount_due = $bill_amount+($bill_amount-$last_paid_amount);
		if($last_paid_amount==0) $amount_due = $bill_amount;
		if($last_paid_amount>$bill_amount) $amount_due = $bill_amount-($last_paid_amount-$bill_amount);
		if($last_paid_amount==$bill_amount) $amount_due = $bill_amount;
		$todays_date = date(Y.'-'.m.'-'.d);
		if($last_paid_date) $days_since_last_payment = intval((strtotime($todays_date) - strtotime($last_paid_date)) / 86400);
		else $days_since_last_payment = 13;
		$_SESSION['num_days_since_payment'] = $days_since_last_payment;
	//Return the current amount due	
		if($days_since_last_payment>=13) {
			return $amount_due;
		}//end if
		else return 0;
	}//end function
 
 	function get_duedate() {
		$myformat = getdate($customer['cust_created']);
		$date_started = substr($myformat,8,2);
		if($date_started <= 15) return '1st of Each Month';
		else if($date_started > 15 && $date_started < 32) return '15th of Each Month';
		else return 'error';
 	}//end function

	function state_name($abbrev) {
		$result = dbconnect()->query(' SELECT state_name FROM state WHERE state_abbrev LIKE "'.$abbrev.'" ');
		$row = $result->fetch_assoc();
		echo $row['state_name'];
	}//end function
	
	function ccv_name($ccv_id) {
		$result = dbconnect()->query(' SELECT ccv_name FROM cc_vendor WHERE ccv_id = '.$ccv_id.' ');
		$row = $result->fetch_assoc();
		echo $row['ccv_name'];
	}//end function
	
	function bat_type($bat_id) {
		$result = dbconnect()->query(' SELECT bat_type FROM bank_acct_type WHERE bat_id = '.$bat_id.' ');
		$row = $result->fetch_assoc();
		echo $row['bat_type'];
	}//end function
	
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
<title>Z-MEN Pay Account</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
	body					{
								font-family:Arial, Helvetica, sans-serif
								}
	.notice				{
								font-size:19px;
								font-weight:bold;
								color:#0000CC
								}
	.sub_notice		{
								font-size:16px;
								font-weight:bold;
								color:#0000CC
								}
	.not_required	{
								color:#000000;
								font-size:12px;
								font-weight:bold
								}
	.required			{
								color:#AA3333;
								font-size:12px;
								font-weight:bold
								}
	.example			{
								font-style: italic;
								font-size:11px
								}
</style>
</head>

<body bgcolor="#EEEEEE">
<table width="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="75%" align="left" valign="top" height="15px" bgcolor="#5ca758" style="color:#FFFF00; font-size:xx-large ">Z-MEN Lawn Care<br />Online Account Payment</td>
		<td width="25%" align="right" valign="top" height="15px"  bgcolor="#5ca758"><img src="../images/logo_yellow.gif" width="97" height="59"><br />
		<span style="color:#FFFF00; font-weight:bold"><?php print date("F   d, Y  ") ?></span></td>
	</tr>
	<tr>
		<td colspan="2"><hr color="#FFFF00"></td>
	</tr>
</table>

<div align="center">
<table border="0" cellspacing="0" style="font-size:20px ">
	<tr>
		<?php $dueamount = get_dueamount(); ?>
		<td align="right">Current Amount Due:&nbsp;&nbsp;</td>
		<td align="left">$<?php echo $dueamount;?></td>
	</tr>
	<tr>
		<td align="right">Due Date:&nbsp;&nbsp;</td>
		<td align="left"><?php echo get_duedate(); ?></td>
	</tr>
</table>

<br />

<table border="1" cellpadding="3" bgcolor="#FFFFCC" width="500"><tr><td>
	<?php
	if(!get_dueamount()==0){
	 if(isset($customer_bank['cust_id'])) {
		echo '<span class="notice">Your File Contains Stored Bank Account Information<br />';
		echo '<span class="sub_notice">Please review / correct before submitting payment</span>';
	 }//end else-if
	 else if(isset($customer_cc['cust_id'])) {
		echo '<span class="notice">Your File Contains Stored Credit Card Information</span><br />';
		echo '<span class="sub_notice">Please review / correct before submitting payment</span>';
	 }//end else-if
	 else {
		echo '<span class="notice">Your account is not configured for online payments!</span><br /><br />';
		echo '<span class="sub_notice">Please contact Z-MEN to configure your account for online payment.<br /><br />';
		echo '<table width="100%" border="0">
            <tr><td height="17" nowrap="nowrap"><div align="center" class="style3"> RR 4 box 581&nbsp; </div></td></tr>
            <tr><td nowrap="nowrap"><div align="center" class="style3">Fairfield, IL 62837</div></td></tr>
            <tr><td nowrap="nowrap"><div align="center" class="style3">(618) 204-9292 </div></td></tr>
            <tr><td nowrap="nowrap"><div align="center" class="style3"> <a href="mailto:jzur55@hotmail.com">jzur55@hotmail.com</a> </div></td></tr>
						<tr><td colspan="2" align="center"><a href="../index.php" style="font-weight:bold; font-size:14px; color:#0000CC ">Go Back Home</a></td></tr>
					</table>
		';
	 }//end else
	}//end main if
	else {
		echo '<span class="notice">You\'re Paid Up!<br />';
		echo '<span class="sub_notice">It\'s only been '.$_SESSION['num_days_since_payment'].' days since your last payment...</span>';
		echo '<br /><span class="sub_notice">please check back again soon.</span>';
	}//end main else
	?>
</td></tr></table>

<br />

<?php
if(!get_dueamount()==0){
	//If customer has stored bank information only
		if(isset($customer_bank['cust_id'])) {
			$_SESSION['pay_type'] = 'bank';
			echo '
			<form method="post" action="submit_payment.php">
			<input type="hidden" name="paym_id" value="'.$customer['paym_id'].'" />
			<input type="hidden" name="dueamount" value="'.$dueamount.'" />
			<table border="1" cellspacing="1" cellpadding="2" bgcolor="#FFFFCC" width="500"><tr><td>
 			 <table border="0" cellspacing="1" cellpadding="2">
				<tr><td colspan="3" align="center" style="font-weight:bold">To expedite payment, please ensure that all information matches what is on file with your financial institution.</td></tr>
				<tr><td colspan="3">&nbsp;</td></tr>
				<tr>
					<td align="right" class="required">Address Line 1</td>
					<td colspan="2" align="left">
						<input type="text" name="custbank_address1" value="'.$customer_bank['custbank_address1'].'" size="33" maxlength="64" />
					</td>
				</tr>
				<tr>
					<td align="right" class="not_required">Address Line 2</td>
					<td colspan="2" align="left">
						<input type="text" name="custbank_address2" value="'.$customer_bank['custbank_address2'].'" size="33" maxlength="64" />
					</td>
				</tr>
				<tr>
					<td align="right" class="required">City</td>
					<td colspan="2" align="left">
						<input type="text" name="custbank_city" value="'.$customer_bank['custbank_city'].'" size="33" maxlength="32" />
					</td>
				</tr>
				<tr>
					<td align="right" class="required">State</td>
					<td colspan="2" align="left">
						<select name="custbank_state">
							<option value="'.$customer_bank['custbank_state'].'">'; state_name($customer_bank['custbank_state']); echo'</option>';
							get_states(); 
						echo'</select>
					</td>
				</tr>
				<tr>
					<td align="right" class="required">Zip</td>
					<td colspan="2" align="left">
						<input type="text" name="custbank_zip" value="'.$customer_bank['custbank_zip'].'" size="11" maxlength="10" />
						<span class="example">&nbsp;Example: 47715-7035 (-xxxx optional)</span>
					</td>
				</tr>
				<tr>
					<td align="right" class="required">Bank Name</td>
					<td colspan="2" align="left">
						<input type="text" name="custbank_bank" value="'.$customer_bank['custbank_bank'].'" size="33" maxlength="32" />
					</td>
				</tr>
				<tr>
					<td align="right" class="required">Type of Account</td>
					<td colspan="2" align="left">
						<select name="bat_id">
							<option value="'.$customer_bank['bat_id'].'">'; bat_type($customer_bank['bat_id']); echo'</option>';
							get_bat(); 
						echo'</select>
					</td>
				</tr>
				<tr>
					<td align="right" class="required">Routing Number</td>
					<td align="left">
						<input type="text" name="custbank_routing" value="'.$customer_bank['custbank_routing'].'" size="10" maxlength="16" />
					</td>
					<td rowspan="2" align="left"><img src="../images/check.gif" height="55" width="170" /></td>
				</tr>
				<tr>
					<td align="right" class="required">Account Number</td>
					<td align="left">
						<input type="text" name="custbank_account" value="'.$customer_bank['custbank_account'].'" size="10" maxlength="16" />
					</td>
				</tr>
				<tr><td colspan="3">&nbsp;</td></tr>
				<tr><td colspan="3" align="center" style="font-size:11px">This will be treated like a single, one-time payment.<br />We will not automatically bill your account unless you have made arrangements for us to do so.</td></tr>
				<tr>
					<td colspan="3" align="center"><input type="submit" value="Submit Payment of $'; echo get_dueamount(); echo'" /></td>
				</tr>
				<tr><td colspan="3" align="center" style="font-size:12px">Please click button only once!</td></tr>
				<tr><td colspan="3" align="center"><a href="../index.php" style="font-weight:bold; font-size:14px; color:#0000CC ">Or click here to CANCEL and go back home</a></td></tr>
 			 </table>
			</td></tr></table>
			</form>
			';//end echo
		}//end if
	
	//If customer has stored credit card information only
		else if(isset($customer_cc['cust_id'])) {
			$_SESSION['pay_type'] = 'cc';
			echo '
			<form method="post" action="submit_payment.php">
			<input type="hidden" name="paym_id" value="'.$customer['paym_id'].'" />
			<input type="hidden" name="dueamount" value="'.$dueamount.'" />
			<table border="1" cellspacing="0" cellpadding="2" bgcolor="#FFFFCC" width="500"><tr><td>
 			 <table border="0" cellspacing="0" cellpadding="2">
				<tr><td colspan="2" align="center" style="font-weight:bold">To expedite payment, please ensure that all information matches what is on file with your financial institution.</td></tr>
				<tr><td colspan="2">&nbsp;</td></tr>
				<tr>
					<td align="right" class="required">Cardholder\'s Name</td>
					<td align="left">
						<input type="text" name="custcc_name" value="'.$customer_cc['custcc_name'].'" size="25" maxlength="40" />
						<span class="example">&nbsp;Name that appears on the card</span>
					</td>
				</tr>
				<tr>
					<td align="right" class="required">Address Line 1</td>
					<td align="left">
						<input type="text" name="custcc_address1" value="'.$customer_cc['custcc_address1'].'" size="33" maxlength="64" />
					</td>
				</tr>
				<tr>
					<td align="right" class="not_required">Address Line 2</td>
					<td align="left">
						<input type="text" name="custcc_address2" value="'.$customer_cc['custcc_address2'].'" size="33" maxlength="64" />
					</td>
				</tr>
				<tr>
					<td align="right" class="required">City</td>
					<td align="left">
						<input type="text" name="custcc_city" value="'.$customer_cc['custcc_city'].'" size="33" maxlength="32" />
					</td>
				</tr>
				<tr>
					<td align="right" class="required">State</td>
					<td align="left">
						<select name="custcc_state">
							<option value="'.$customer_cc['custcc_state'].'">'; state_name($customer_cc['custcc_state']); echo'</option>';
							get_states(); 
						echo'</select>
					</td>
				</tr>
				<tr>
					<td align="right" class="required">Zip</td>
					<td align="left">
						<input type="text" name="custcc_zip" value="'.$customer_cc['custcc_zip'].'" size="11" maxlength="10" />
						<span class="example">&nbsp;Example: 47715-7035 (-xxxx optional)</span>
					</td>
				</tr>
				<tr>
					<td align="right" class="required">Credit Card Company</td>
					<td align="left">
						<select name="ccv_id">
							<option value="'.$customer_cc['ccv_id'].'">'; ccv_name($customer_cc['ccv_id']); echo'</option>';
							get_ccv(); 
						echo'</select>
					</td>
				</tr>
				<tr>
					<td align="right" class="required">Credit Card Number</td>
					<td align="left">
						<input type="text" name="custcc_number" value="'.$customer_cc['custcc_number'].'" size="25" maxlength="24" />
						<span class="example">&nbsp;No dashes please</span>
					</td>
				</tr>
				<tr>
					<td align="right" class="required">CID/Security Code</td>
					<td align="left">
						<input type="text" name="custcc_cid" value="'.$customer_cc['custcc_cid'].'" size="4" maxlength="3" />
						<span class="example">&nbsp;Last 3 digits on back of card</span>
					</td>
				</tr>
				<tr>
					<td align="right" class="required">Expiration Date</td>
					<td align="left">
						<input type="text" name="custcc_expire" value="'.$customer_cc['custcc_expire'].'" size="6" maxlength="5" />
						<span class="example">&nbsp;Example: 09/05</span>
					</td>
				</tr>
				<tr>
					<td align="right" class="not_required">Customer Svc. Phone</td>
					<td align="left">
						<input type="text" name="custcc_cust_svc" value="'.$customer_cc['custcc_cust_svc'].'" size="15" maxlength="14" />
						<span class="example">&nbsp;To help out if there\'s a problem</span>
					</td>
				</tr>
				<tr><td colspan="2">&nbsp;</td></tr>
				<tr><td colspan="2" align="center" style="font-size:11px">This will be treated like a single, one-time payment.<br />We will not automatically bill your account unless you have made arrangements for us to do so.</td></tr>
				<tr>
					<td colspan="2" align="center"><input type="submit" value="Submit Payment of $'; echo get_dueamount(); echo'" /></td>
				</tr>
				<tr><td colspan="2" align="center" style="font-size:12px">Please click button only once!</td></tr>
				<tr><td colspan="2" align="center"><a href="../index.php" style="font-weight:bold; font-size:14px; color:#0000CC ">Or click here to CANCEL and go back home</a></td></tr>
 			 </table>
			</td></tr></table>
			</form>
			';//end echo
		}//end else-if
}
else{ echo'
			<table border="1" cellspacing="0" cellpadding="2" bgcolor="#FFFFCC" width="500"><tr><td>
 			 <table border="0" cellspacing="0" cellpadding="2">
				<tr><td colspan="2" align="center"><a href="../index.php" style="font-weight:bold; font-size:14px; color:#0000CC ">Click here to go back home</a></td></tr>
 			 </table>
			</td></tr></table>
';}
?>
	
</div>

<?php display_footer1(); ?>

</body>

</html>
