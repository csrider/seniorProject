<?php 
session_start();
require_once 'fns_database.php';
$admin_user = $_SESSION['admin_user'];
require_once 'fns_validate.php';


//admin_check($admin_user);

$result = dbconnect_newmethod()->query('SELECT svc_address.sa_addr1, svc_address.sa_addr2, svc_address.sa_id, svc_address.sa_city,
											   svc_address.sa_phone, customer.cust_fname, customer.cust_lname, customer.cust_hphone
										FROM customer, svc_address, svc_addr_prod, svc_history
										WHERE customer.cust_id = svc_address.cust_id
										AND svc_address.sa_id = svc_addr_prod.sa_id
										AND svc_addr_prod.sap_id = svc_history.sap_id
										AND (curdate() - sh_performed) > "'.$_POST['lookup_value'].'"');
										
										
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
style1 {font-size: 18px}
style4 {font-size: 14px; font-weight:bold}
table_content {font-size:12px}
body,td,th {
	color: #000000;
}
body {
	background-color: #FFFFFF;
}
style6 {font-size: 12px}
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
      <td><div align="center" class="style1">Customer Information on Addresses Serviced More then <?php echo ' '.$_POST['lookup_value'].' ';?> day(s) ago. </div></td>
    </tr>
  </table>
  <p>&nbsp;</p>
</div>
<div align="center" class="style1">
  <table width="100%"  border="0" bordercolor="#FFFFFF" cellpadding="1" cellspacing="0">
    <tr>
      <td><span class="style4">Service Address </span></td>
	  <td><span class="style4">Service City </span></td>
	  <td><span class="style4">Service Address ID</span></td>
	  <td><span class="style4">Service Address Phone</span></td>
	  <td><span class="style4">First Name </span></td>
      <td><span class="style4">Last Name </span></td>
      <td><span class="style4">Home Phone </span></td>
    </tr>
	<tr>
	<td colspan="8"><hr /></td>
	</tr>
	
<?php 

for ($i=0; $i<$num_results; $i++) {
	$row = $result->fetch_assoc();
	if ($i % 2)	{	//if there's a remainder of $i / 2 (odd number based off counter variable)
	 echo '<tr bgcolor="#FFFFCC" class="table_content">';}	
	else {				//else the counter variable is an even number
	echo '<tr class="table_content">';}
	echo '<td nowrap valign="top">' .$row['sa_addr1']. '<br />' .$row['sa_addr2']. '</td>';
	echo '<td nowrap valign="top">' .$row['sa_city']. '</td>';
	echo '<td nowrap valign="top">' .$row['sa_id']. '</td>';
	echo '<td nowrap valign="top">' .$row['sa_phone']. '</td>';
	echo '<td nowrap valign="top">' .$row['cust_fname']. '</td>';
	echo '<td nowrap valign="top">' .$row['cust_lname']. '</td>';
	echo '<td nowrap valign="top">' .$row['cust_hphone']. '</td>';
   echo ' </tr>';
}
?>
  </table>
</div>
<div align="justify"></div>
</body>
</html>
