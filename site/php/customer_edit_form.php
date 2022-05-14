<?php 
session_start();
require_once 'fns_database.php';
require_once 'fns_display.php';

$customer_online = $_SESSION['user_online_record'];
$customer_online['cust_id'];

$query = "SELECT * FROM customer, customer_type, pay_method 
							WHERE cust_id = '".$customer_online['cust_id']."' 
							AND customer.ctype_id = customer_type.ctype_id 
							AND customer.paym_id = pay_method.paym_id
						 ";
		$result = dbconnect()->query($query);
		for ($i=0; $i<$result->num_rows; $i++) $customer = $result->fetch_assoc();
		$_SESSION['customer'] = $customer;
	
//Lookup customer types
function lookup_ctype() {
	$result = dbconnect()->query('SELECT ctype_id, ctype_type FROM customer_type');
	for ($i=0; $i<$result->num_rows; $i++) {
		$row = $result->fetch_assoc();
		echo '<option value="'.$row['ctype_id'].'">'.$row['ctype_type'].'</option>';
	}
}

//Lookup payment methods
function lookup_paym() {
	$result = dbconnect()->query('SELECT paym_id, paym_name FROM pay_method');
	for ($i=0; $i<$result->num_rows; $i++) {
		$row = $result->fetch_assoc();
		echo '<option value="'.$row['paym_id'].'">'.$row['paym_name'].'</option>';
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
              <td align="left" valign="top" class="style3" height="15px" bgcolor="#5ca758"><font color="#FFFF00">Z-MEN Lawn Care<br />Edit Customer Information</font></td>
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

<form action="customer_edit.php" method="post" name="customer_edit_form">
<div align="center"><table border="1" bordercolor="#5ca758">

<tr><td align="center">
<!--body begin-->

<table border="0" bordercolorlight="#5ca758" align="center" bgcolor="#FFFFCC">
  <tr>
  	<td colspan="2" align="center"><font size="+2" color="#5ca758">Update Customer Information</font></td>
  </tr>
  <tr>
  	<td colspan="2" align="center" class="required">(Required Fields Have Red Labels)</td>
  </tr>
  <tr>
	<td align="right" class="required">First Name :&nbsp;</td>
	<td align="left"><input type="text" name="cust_fname" maxlength="32" size="33" value="<?php echo $customer['cust_fname']; ?>" /></td>
  </tr>
  <tr>
	<td align="right" class="required">Last Name :&nbsp;</td>
	<td align="left"><input type="text" name="cust_lname" maxlength="32" size="33" value="<?php echo $customer['cust_lname']; ?>" /></td>
  </tr>
  <tr>
	<td align="right">Middle Initial : &nbsp;</td>
	<td align="left"><input type="text" name="cust_minitial" maxlength="1" size="2" value="<?php echo $customer['cust_minitial']; ?>" /></td>
  </tr>
  <tr>
	<td align="right">Suffix : &nbsp;</td>
    <td align="left"><input type="text" name="cust_suffix" maxlength="32" size="33" value="<?php echo $customer['cust_suffix']; ?>" /></td>
  </tr>
  <tr>
	<td align="right" class="required">Billing Address : &nbsp;</td>
	<td align="left"><input type="text" name="cust_address1" maxlength="64" size="65" value="<?php echo $customer['cust_address1']; ?>" /></td>
  </tr>
  <tr>
	<td align="right">Billing Address (line 2) : &nbsp;</td>
	<td align="left"><input type="text" name="cust_address2" maxlength="64" size="65" value="<?php echo $customer['cust_address2']; ?>" /></td>
  </tr>
  <tr>
	<td align="right" class="required">City : &nbsp;</td>
	<td align="left"><input type="text" name="cust_city" maxlength="32" size="33" value="<?php echo $customer['cust_city']; ?>" /></td>
  </tr>
  <tr>
	<td align="right" class="required">State : &nbsp;</td>
	<td align="left"><select name="cust_state">
		<?php
			if ($customer['cust_state']=='IL')	echo '<option value="IL">Illinois</option><option value="IN">Indiana</option><option value="KY">Kentucky</option>';
	   else if ($customer['cust_state']=='IN')	echo '<option value="IN">Indiana</option><option value="IL">Illinois</option><option value="KY">Kentucky</option>';
	   else if ($customer['cust_state']=='KY')	echo '<option value="KY">Kentucky</option><option value="IL">Illinois</option><option value="IN">Indiana</option>';
	   else if ($customer['cust_state']=='')	echo '<option value="">-SELECT-</option><option value="IL">Illinois</option><option value="KY">Kentucky</option><option value="IN">Indiana</option>';
		?>
					</select>
	</td>
  </tr>
  <tr>
	<td align="right" class="required">Zip : &nbsp;</td>
	<td align="left"><input type="text" name="cust_zip" maxlength="10" size="11" value="<?php echo $customer['cust_zip']; ?>" /></td>
  </tr>
  <tr>
	<td align="right" class="required">Home Phone : &nbsp;</td>
	<td align="left"><input type="text" name="cust_hphone" maxlength="14" size="15" value="<?php echo $customer['cust_hphone']; ?>" />
		<span class="example">&nbsp;example: (812)555-1212&nbsp;&nbsp;(typically an evening home phone)</span></td>
  </tr>
  <tr>
	<td align="right">Work Phone : &nbsp;</td>
	<td align="left"><input type="text" name="cust_wphone" maxlength="14" size="15" value="<?php echo $customer['cust_wphone']; ?>" />
		<span class="example">&nbsp;example: (812)555-1212&nbsp;&nbsp;(typically a daytime work phone)</span></td>
  </tr>
  <tr>
	<td align="right">Mobile Phone : &nbsp;</td>
	<td align="left"><input type="text" name="cust_mphone" maxlength="14" size="15" value="<?php echo $customer['cust_mphone']; ?>" />
		<span class="example">&nbsp;example: (812)555-1212</span></td>
  </tr>
  <tr>
	<td align="right">Customer Type : &nbsp;</td>
	<td align="left"><select name="ctype_id">
			<option value="<?php echo $customer['ctype_id']; ?>"><?php echo $customer['ctype_type']; ?></option> <!--sets current ctype as default-->
			<option value="<?php echo $customer['ctype_id']; ?>">--------------------</option>
			<?php lookup_ctype(); //lists all records in the customer_type table ?>
					</select>
	</td>
  </tr>
  <tr>
	<td align="right">Preferred Payment Method : &nbsp; </td>
	<td align="left"><select name="paym_id">
			<option value="<?php echo $customer['paym_id']; ?>"><?php echo $customer['paym_name']; ?></option> <!--sets current paym as default-->
			<option value="<?php echo $customer['paym_id']; ?>">--------------------</option>
			<?php lookup_paym(); //lists all records in the pay_method table ?>
					 </select>
	</td>
  </tr>
  <tr>
	<td align="right">Tax-exempt Number : &nbsp;</td>
	<td align="left"><input type="text" name="cust_tax_id" maxlength="32" size="33" value="<?php echo $customer['cust_tax_id']; ?>" /></td>
  </tr>
  <tr height="12"></tr>
  <tr>
  	<td align="center" colspan="2"><input type="submit" value="Update Customer Information" /></td>
  </tr>
	<tr>
		<td align="center" colspan="2"><br /><a href="../index.php" style="font-weight:bold; font-size:14px; color:#0000CC ">Or click here to CANCEL and go back home</a></td>
	</tr>
</table>

<!--body end-->
</td></tr>
</table></div>
</form>
<tr><?php display_footer1(); ?></tr>
</table>
</body>
</html>
