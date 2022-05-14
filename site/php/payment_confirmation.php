<?php
//START-UP ROUTINES
	session_start();
	require_once 'fns_database.php';
	require_once 'fns_queries.php';
	require_once 'fns_display.php';
	
//Extract this customer's online info from the session (stored when they logged-in)
	$customer_online = $_SESSION['user_online_record'];

//Query the database for additional information about this customer
	//customer table
		$result = dbconnect()->query('  SELECT * FROM customer WHERE cust_id = '.$customer_online['cust_id'].'  ');
		$customer = $result->fetch_assoc();

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
	.go_home			{
								text-decoration:none;
								color:#006600
								}
	.go_home:hover{
								text-decoration:none;
								color:#006600;
								background-color:#FFFF00
								}
</style>
</head>

<body bgcolor="#FFFFFF">
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
<h3>You may print this page for your records</h3>
<table border="1" cellpadding="3" width="500"><tr><td>
 <table width="100%">
		<tr>
			<td align="right" style="font-weight:bold ">Customer #&nbsp;</td>
			<td align="left"><?php echo $customer_online['cust_id']; ?></td>
		</tr>
		<tr>
			<td align="right" style="font-weight:bold ">Name:&nbsp;</td>
			<td align="left"><?php echo $customer['cust_fname'].'&nbsp;'.$customer['cust_lname']; ?></td>
		</tr>
 <?php
 	if($_SESSION['pay_type'] == 'bank') {
		echo'
		<tr>
			<td align="right" style="font-weight:bold ">Address 1:&nbsp;</td>
			<td align="left">'.$_SESSION['custbank_address1'].'</td>
		</tr>
		<tr>
			<td align="right" style="font-weight:bold ">Address 2:&nbsp;</td>
			<td align="left">'.$_SESSION['custbank_address2'].'</td>
		</tr>
		<tr>
			<td align="right" style="font-weight:bold ">City:&nbsp;</td>
			<td align="left">'.$_SESSION['custbank_city'].'</td>
		</tr>
		<tr>
			<td align="right" style="font-weight:bold ">State:&nbsp;</td>
			<td align="left">'.$_SESSION['custbank_state'].'</td>
		</tr>
		<tr>
			<td align="right" style="font-weight:bold ">Zip:&nbsp;</td>
			<td align="left">'.$_SESSION['custbank_zip'].'</td>
		</tr>
		<tr>
			<td align="right" style="font-weight:bold ">Bank Name:&nbsp;</td>
			<td align="left">'.$_SESSION['custbank_bank'].'</td>
		</tr>
		<tr>
			<td align="right" style="font-weight:bold ">Bank Account Type:&nbsp;</td>
			<td align="left">'; bat_type($_SESSION['bat_id']); echo'</td>
		</tr>
		<tr>
			<td align="right" style="font-weight:bold ">Routing #:&nbsp;</td>
			<td align="left">'.$_SESSION['custbank_routing'].'</td>
		</tr>
		<tr>
			<td align="right" style="font-weight:bold ">Account #:&nbsp;</td>
			<td align="left">'.$_SESSION['custbank_account'].'</td>
		</tr>
		';//end echo
	}//end if
	
	else if($_SESSION['pay_type'] == 'cc') {
		echo'
		<tr>
			<td align="right" style="font-weight:bold ">Address 1:&nbsp;</td>
			<td align="left">'.$_SESSION['custcc_address1'].'</td>
		</tr>
		<tr>
			<td align="right" style="font-weight:bold ">Address 2:&nbsp;</td>
			<td align="left">'.$_SESSION['custcc_address2'].'</td>
		</tr>
		<tr>
			<td align="right" style="font-weight:bold ">City:&nbsp;</td>
			<td align="left">'.$_SESSION['custcc_city'].'</td>
		</tr>
		<tr>
			<td align="right" style="font-weight:bold ">State:&nbsp;</td>
			<td align="left">'.$_SESSION['custcc_state'].'</td>
		</tr>
		<tr>
			<td align="right" style="font-weight:bold ">Zip:&nbsp;</td>
			<td align="left">'.$_SESSION['custcc_zip'].'</td>
		</tr>
		<tr>
			<td align="right" style="font-weight:bold ">Credit Card Company:&nbsp;</td>
			<td align="left">'; ccv_name($_SESSION['ccv_id']); echo'</td>
		</tr>
		<tr>
			<td align="right" style="font-weight:bold ">Name on Credit Card:&nbsp;</td>
			<td align="left">'.$_SESSION['custcc_name'].'</td>
		</tr>
		';//end echo
	}//end else-if
 ?>
		<tr>
			<td align="right" style="font-weight:bold ">Amount Paid:&nbsp;</td>
			<td align="left">$<?php echo $_SESSION['amount_paid']; ?></td>
		</tr>
		<tr>
			<td align="right" style="font-weight:bold ">Date Submitted:&nbsp;</td>
			<td align="left"><?php echo date("F   d, Y  "); ?></td>
		</tr>
 </table>
</td></tr></table>
<h2 align="center"><a href="../index.php" class="go_home">Go Back Home</a></h2>
</div>

<?php display_footer1(); ?>

</body>

</html>
