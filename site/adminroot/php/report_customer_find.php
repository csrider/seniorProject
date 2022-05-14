<?php 
session_start();
require_once 'fns_database.php';
$admin_user = $_SESSION['admin_user'];
require_once 'fns_validate.php';
admin_check($admin_user);

$result = dbconnect_newmethod()->query("SELECT * FROM customer, customer_type, pay_method where '".$_POST['find_cust_hphone']."' = cust_hphone 
																			  and customer.ctype_id = customer_type.ctype_id
																			  and customer.paym_id = pay_method.paym_id");
$num_results = $result->num_rows;

?>

<!-- saved from url=(0022)http://internet.e-mail -->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Customer Report</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.style1 {font-size: 18px}
.style4 {font-size: 14px; font-weight:bold}
.table_content {font-size:12px}
body,td,th {
	color: #000000;
}
body {
	background-color: #FFFFFF;
}
.style6 {font-size: 12px}
-->
</style>
</head>
<body>
<div align="right">
  <table width="100%"  border="0" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
    <tr>
      <td width="50%" height="23"><div align="left"><span class="style6">ADMIN USER :</span>
      <?php
	  	echo $admin_user;
	  ?>
      </div></td>
      <td width="50%"><div align="right" class="style6"><?php print date("d M Y") ?></div></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div align="right" class="style6"><?php print date("g:i") ?></div></td>
    </tr>
  </table>
  <table width="100%"  border="0">
    <tr>
      <td><div align="center" class="style1">Customer Information </div></td>
    </tr>
  </table>
  <p>&nbsp;</p>
</div>
<div align="center" class="style1">
  <table width="100%"  border="0" bordercolor="#FFFFFF" cellpadding="1" cellspacing="0">
    <tr>
      <td width="12%"><span class="style4">Last Name </span></td>
      <td width="13%"><span class="style4">First Name </span></td>
      <td width="11%"><span class="style4"> Type </span></td>
      <td width="20%"><span class="style4">Address</span></td>
      <td width="12%"><p class="style4">City </p>      </td>
      <td width="8%"><p class="style4">State</p>      </td>
      <td width="9%"><span class="style4">Zip Code</span></td>
      <td width="15%"><span class="style4">Home Phone </span></td>
    </tr>
	<tr>
	<td colspan="8"><hr /></td>
	</tr>
	
<?php 
for ($i=0; $i<$num_results; $i++) {
	$row = $result->fetch_assoc();
	$custname = $row['cust_fname'].' '.$row['cust_lname'];

	if ($i % 2)	{	//if there's a remainder of $i / 2 (odd number based off counter variable)
	 echo '<tr bgcolor="#FFFFCC" class="table_content">';}	
	else {				//else the counter variable is an even number
	 echo '<tr class="table_content">';}
    echo '<td nowrap valign="top">' .$row['cust_fname']. '</td>';
	  echo '<td nowrap valign="top">' .$row['cust_lname']. '</td>';
	  echo '<td nowrap valign="top">' .$row['ctype_type']. '</td>';      
	  echo '<td nowrap valign="top">' .$row['cust_address1']. '<br />' .$row['cust_address2']. '</td>';
	  echo '<td nowrap valign="top">' .$row['cust_city']. '</td>';
	  echo '<td nowrap valign="top">' .$row['cust_state']. '</td>';
	  echo '<td nowrap valign="top">' .$row['cust_zip']. '</td>';
	  echo '<td nowrap valign="top">' .$row['cust_hphone']. '</td>';
   echo ' </tr>';
}
?>
  </table>
</div>
<div align="justify"></div>
</body>
</html>