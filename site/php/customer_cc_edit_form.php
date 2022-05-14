<?php 
session_start();
require_once 'fns_database.php';
require_once 'fns_display.php';
$_SESSION['customer_id'] = 1;
$customer_online = $_SESSION['user_online_record'];
$customer_online['cust_id'];

$query = "SELECT * FROM customer_cc, cc_vendor 
		  WHERE cust_id = '".$customer_online['cust_id']."' 
		  AND customer_cc.ccv_id = cc_vendor.ccv_id";
		$result = dbconnect()->query($query);
		for ($i=0; $i<$result->num_rows; $i++) $customer_cc = $result->fetch_assoc();
		$_SESSION['customer_online'] = $customer_cc;

//Lookup credit card vendors
function lookup_ccv() {
	$result = dbconnect()->query('SELECT ccv_id, ccv_name FROM cc_vendor');
	for ($i=0; $i<$result->num_rows; $i++) {
		$row = $result->fetch_assoc();
		echo '<option value="';
			echo $row['ccv_id'];
			echo '">';
			echo $row['ccv_name'];
		echo '</option>\n';
	}
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link REL="StyleSheet" TYPE="text/css" HREF="/zmen/adminroot/css/admin.css">
<title>Update Customer Information</title>



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
              <td align="left" valign="top" class="style3" height="15px" bgcolor="#5ca758"><font color="#FFFF00">Z-MEN Lawn Care<br />Edit Customer Credit Card Information</font></td>
              <td width="150" align="right" valign="top" height="15px"  bgcolor="#5ca758"><img src="../images/logo_yellow.gif" width="97" height="59"><br />
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

<form action="customer_cc_edit.php" method="post" name="customer_edit_form">
<table border="0" bordercolorlight="#5ca758" align="center" bgcolor="#FFFFCC">
  <tr>
  	<td colspan="2" align="center"><font size="+2" color="#5ca758">Update Customer Credit Card Information</font></td>
  </tr>
  <tr>
  	<td colspan="2" align="center" class="required">(Required Fields Have Red Labels)</td>
  </tr>
  <tr>
	<td align="right" class="required">Credit Card :&nbsp;</td>
	<td align="left"><select name="ccv_id">
							<option value="<?php echo $customer_cc['ccv_id']; ?>"><?php echo $customer_cc['ccv_name']; ?></option>
							<option value="<?php echo $customer_cc['ccv_id']; ?>">--------------------</option>
							<?php lookup_ccv(); ?>
					 </select></td>
  </tr>
  
  <tr>
	<td align="right" class="required">Name on Credit Card :&nbsp;</td>
	<td align="left"><input type="text" name="custcc_name" maxlength="32" size="33" value="<?php echo $customer_cc['custcc_name']; ?>" /></td>
  </tr>
  
  <tr>
	<td align="right" class="required">Credit Card Number : &nbsp;</td>
	<td align="left"><input type="text" name="custcc_number" maxlength="24" size="25" value="<?php echo $customer_cc['custcc_number']; ?>" /></td>
  </tr>
  
  <tr>
	<td align="right" class="required">Credit Card Security Code : &nbsp;</td>
	<td align="left"><input type="text" name="custcc_cid" maxlength="4" size="5" value="<?php echo $customer_cc['custcc_cid']; ?>" />&nbsp;3-4 digit security code on back of card</td>
</tr>
 <tr>
	<td align="right" class="required">Expiration Date :&nbsp;</td>
	<td align="left"><input type="text" name="custcc_expire" maxlength="5" size="6" value="<?php echo $customer_cc['custcc_expire']; ?>" /> &nbsp;format: mm/yy</td>
 </tr>
 <tr>
	<td align="right" class="required">Customer Service Phone Number :&nbsp;</td>
	<td align="left"><input type="text" name="custcc_cust_svc" maxlength="14" size="15" value="<?php echo $customer_cc['custcc_cust_svc']; ?>" />&nbsp;this could expedite payments if a problem arises</td>
 </tr>
  <tr><td align="center" colspan="2"><br />The following fields must match what is on file with your financial institution!</td></tr>
  <tr>
    <td align="right" class="required">Address :&nbsp;</td>
	<td align="left"><input type="text" name="custcc_address1" maxlength="64" size="65" value="<?php echo $customer_cc['custcc_address1']; ?>" /></td>
  </tr>
  
  <tr>
	<td align="right">Address :&nbsp;</td>
	<td align="left"><input type="text" name="custcc_address2" maxlength="64" size="65" value="<?php echo $customer_cc['custcc_address2']; ?>" /></td>
  </tr>
  <tr>
	<td align="right" class="required">City :&nbsp;</td>
	<td align="left"><input type="text" name="custcc_city" maxlength="32" size="33" value="<?php echo $customer_cc['custcc_city']; ?>" /></td>
  </tr>
  <tr>
  <td align="right" class="required">State :&nbsp;</td>
  <td align="left"><input type="text" name="custcc_state" maxlength="2" size="3" value="<?php echo $customer_cc['custcc_state']; ?>" />&nbsp;example: IN</td>
  </tr>
  <tr>
  <td align="right" class="required">Zip :&nbsp;</td>
  <td align="left"><input type="text" name="custcc_zip" maxlength="10" size="11" value="<?php echo $customer_cc['custcc_zip']; ?>" />&nbsp;example: 47715-7035</td>
				</tr>
  
  <tr height="12"></tr>
  <tr>
  	<td align="center" colspan="2"><input type="submit" value="Update Credit Card Information" /></td>
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
