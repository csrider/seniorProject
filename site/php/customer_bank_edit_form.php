<?php 
session_start();
require_once 'fns_database.php';
require_once 'fns_display.php';

$customer_online = $_SESSION['user_online_record'];
$customer_online['cust_id'];

$query = "SELECT * FROM customer_bank, bank_acct_type 
		   WHERE cust_id = '".$customer_online['cust_id']."' 
		   AND customer_bank.bat_id = bank_acct_type.bat_id ";
		$result = dbconnect()->query($query);
		for ($i=0; $i<$result->num_rows; $i++) $customer_bank = $result->fetch_assoc();
		$_SESSION['customer_online'] = $customer_bank;

//Lookup bank account types
function lookup_bat() {
	$result = dbconnect()->query('SELECT bat_id, bat_type FROM bank_acct_type');
	for ($i=0; $i<$result->num_rows; $i++) {
		$row = $result->fetch_assoc();
		echo '<option value="';
			echo $row['bat_id'];
			echo '">';
			echo $row['bat_type'];
		echo '</option>\n';
	}
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link REL="StyleSheet" TYPE="text/css" HREF="/zmen/adminroot/css/admin.css">
<title>Bank Account Information</title>



<style type="text/css">
<!--
.style3 {font-size: xx-large}
.header {font-weight:bold; font-variant:small-caps;}
.header1 {font-style:italic; vertical-align:bottom;}
.header2 {font-variant:small-caps;}
-->
</style>



</head>

<body bgcolor="#EEEEEE">
<table border="0">
<!--header begin-->
<tr>
<table width="100%"  border="0" cellpadding="0" cellspacing="0"><!--table one-->
      <tr>
        <td align="center">
          <table width="100%"  border="0" cellpadding="0" cellspacing="0">
		  
            <tr>
              <td width="50%" align="left" valign="top" class="style3" height="15px" bgcolor="#5ca758"><font color="#FFFF00">Z-MEN Lawn Care<br />Edit Customer Bank Account Information</font></td>
              <td width="50%" align="right" valign="top" height="15px"  bgcolor="#5ca758"><img src="../images/logo_yellow.gif" width="97" height="59"><br />
              <font color="#FFFF00"><b><?php print date("F   d, Y  ") ?></b></font></td>
            </tr>
		</table>
		</td>
	  </tr>
</table>
</tr>
<tr><hr color="#FFFF00"></tr>
<!--header end-->

<div align="center"><table border="1" bordercolor="#5ca758">

<tr><td align="center">
<!--body begin-->

<form action="customer_bank_edit.php" method="post" name="customer_edit_form">
<table border="0" bordercolorlight="#5ca758" align="center" bgcolor="#FFFFCC">
  <tr>
  	<td colspan="2" align="center"><font size="+2" color="#5ca758">Update Customer Bank Account Information</font></td>
  </tr>
  <tr>
  	<td colspan="2" align="center" class="required">(Required Fields Have Red Labels)</td>
  </tr>
  <tr>
	<td align="right" class="required">Type of Account :&nbsp;</td>
	<td align="left"><select name="bat_id">
							<option value="<?php echo $customer_bank['bat_id']; ?>"><?php echo $customer_bank['bat_type']; ?></option>
							<option value="<?php echo $customer_bank['bat_id']; ?>">--------------------</option>
							<?php lookup_bat(); ?>
						</select></td>
  </tr>
  
  <tr>
	<td align="right" class="required">Routing Number :&nbsp;</td>
	<td align="left"><input type="text" name="custbank_routing" maxlength="16" size="17" value="<?php echo $customer_bank['custbank_routing']; ?>" /></td>
  </tr>
  <tr>
	<td align="right" class="required">Account Number :&nbsp;</td>
	<td align="left"><input type="text" name="custbank_account" maxlength="16" size="17" value="<?php echo $customer_bank['custbank_account']; ?>" /></td>
  </tr>
  <tr><td align="center" colspan="2"><br />The following fields must match what is on file with your financial institution!</td></tr>
	<tr>
	<td align="right" class="required">Address Line 1 : &nbsp;</td>
	<td align="left"><input type="text" name="custbank_address1" maxlength="64" size="65" value="<?php echo $customer_bank['custbank_address1']; ?>" /></td>
  </tr>
  
  <tr>
	<td align="right" class="required">Address Line 2 : &nbsp;</td>
	<td align="left"><input type="text" name="custbank_address2" maxlength="64" size="65" value="<?php echo $customer_bank['custbank_address2']; ?>" /></td>
</tr>
 <tr>
	<td align="right" class="required">Bank City :&nbsp;</td>
	<td align="left"><input type="text" name="custbank_city" maxlength="32" size="33" value="<?php echo $customer_bank['custbank_city']; ?>" /></td>
 </tr>
  
 <tr>
	<td align="right" class="required">Bank State :&nbsp;</td>
	<td align="left"><input type="text" name="custbank_state" maxlength="2" size="3" value="<?php echo $customer_bank['custbank_state']; ?>" />&nbsp;example: IN</td>
 </tr>
  
  <tr>
    <td align="right" class="required">Bank Zip :&nbsp;</td>
	<td align="left"><input type="text" name="custbank_zip" maxlength="10" size="11" value="<?php echo $customer_bank['custbank_zip']; ?>" />&nbsp;example: 47715-7035</td>
  </tr>
  
  <tr height="12"><td></td></tr>
  <tr>
  	<td align="center" colspan="2"><input type="submit" value="Update Bank Account Information" /></td>
  </tr>
	<tr>
		<td align="center" colspan="2"><br /><a href="../index.php" style="font-weight:bold; font-size:14px; color:#0000CC ">Or click here to CANCEL and go back home</a></td>
	</tr>
</table>

<!--body end-->
</td></tr>
</table></div>
</form>

<!--footer-->
<tr>
<?php display_footer1(); ?>
</tr>
<!--footer end-->
</table>
</body>
</html>
