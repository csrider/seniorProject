<?php 
session_start();
require_once 'fns_database.php';
$admin_user = $_SESSION['admin_user'];
require_once 'fns_validate.php';
admin_check($admin_user);

$result = dbconnect_newmethod()->query("SELECT * 
																					FROM customer, customer_type 
																					WHERE customer.ctype_id = customer_type.ctype_id
																					ORDER BY customer.cust_lname ASC");
$num_results = $result->num_rows;

?>

<!-- saved from url=(0022)http://internet.e-mail -->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Customer Report</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link REL="StyleSheet" TYPE="text/css" HREF="/zmen/adminroot/css/reports.css">
</head>
<body>

<table width="100%" border="0" bgcolor="#FFFFFF" class="page_head">
  <tr>
    <td width="50%" height="23" align="left">ADMIN USER :<?php echo $admin_user; ?></td>
    <td width="50%" align="right"><?php print date("d M Y") ?><br /><?php print date("g:i") ?></td>
  </tr>
</table>
  
<table width="100%" border="0">
  <tr>
  	<td align="center" class="rpt_name">Customer Information<br /><br /></td>
  </tr>
</table>

<div align="center">
  <table width="100%"  border="0" cellpadding="1" cellspacing="0">
    
		<tr class="col_head">
      <td width="12%">Last Name</td>
      <td width="13%">First Name</td>
      <td width="11%">Type</td>
      <td width="20%">Address</td>
      <td width="12%">City</td>
      <td width="8%">State</td>
      <td width="9%">Zip Code</td>
      <td width="15%">Home Phone</td>
    </tr>
	
		<tr>
			<td colspan="8"><hr /></td>
		</tr>
	
		<?php 
		for ($i=0; $i<$num_results; $i++) {
			$row = $result->fetch_assoc();
			if ($i % 2)	{	//if there's a remainder of $i / 2 (odd number based off counter variable)
	 			echo '<tr bgcolor="#FFFFCC" class="table_content">';
			}//end if
			else {				//else the counter variable is an even number
	 			echo '<tr class="table_content">';
			}//end else
    	echo '<td nowrap valign="top">' .$row['cust_lname']. '</td>';
	  	echo '<td nowrap valign="top">' .$row['cust_fname']. '</td>';
	  	echo '<td nowrap valign="top">' .$row['ctype_type']. '</td>';      
	  	echo '<td nowrap valign="top">' .$row['cust_address1']. '<br />' .$row['cust_address2']. '</td>';
	  	echo '<td nowrap valign="top">' .$row['cust_city']. '</td>';
	  	echo '<td nowrap valign="top">' .$row['cust_state']. '</td>';
	  	echo '<td nowrap valign="top">' .$row['cust_zip']. '</td>';
	  	echo '<td nowrap valign="top">' .$row['cust_hphone']. '</td>';
   		echo ' </tr>';
			}//end for
			?>
  </table>
</div>

</body>
</html>