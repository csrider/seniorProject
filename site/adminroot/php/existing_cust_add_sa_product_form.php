<?php //Startup code
	session_start();
	$admin_user = $_SESSION['admin_user'];
	require_once 'fns_display.php';
	require_once 'fns_database.php';
	require_once 'fns_validate.php';
?>
<?php admin_check($admin_user); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<?php disp_titlebar($admin_user); ?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link REL="StyleSheet" TYPE="text/css" HREF="/zmen/adminroot/css/admin.css">
<link href="../css/admin.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php disp_adminheader(); ?>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<!--menu nav-->
		<td width="200" valign="top"><?php disp_adminmenu(); ?></td>
		
		<!--body-->
		<td valign="top" align="left">		
			<form action="existing_customer_sa_update.php" method="post" name="add_service_address_to_existing_customer">
<?php 
	$result = dbconnect_newmethod()->query("SELECT * FROM svc_address WHERE svc_address.sa_phone LIKE '".$_POST['find_cust_phone']."'");
	for ($i=0; $i<$result->num_rows; $i++) $row1 = $result->fetch_assoc();
	$_SESSION['sa_id'] = $row1['sa_id'];
	//result1 = dbconnect_newmethod()->query("SELECT prod_id FROM svc_addr_prod WHERE svc_address.sa_id = '".$_POST['find_cust_phone']."' and svc_address.sa_id = svc_addr_prod.sa_id");
	//for ($i=0; $i<$result->num_rows; $i++) $row2 = $result->fetch_assoc();
?>
			
			<table border="1" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC">
				<tr><td colspan="2">
				<table border="0" cellpadding="1" cellspacing="1">
					<tr><td colspan="2" bgcolor="#CCCCCC" height="35" align="center"><h2>Service Address/Location Information/Products</h2></td></tr>
					<tr><td align="center" colspan="2" ><h4>View/Edit Address Info</h4></td></tr>
					<?php if(!isset($row1)) echo '<tr><td colspan="2" align="center" style="color:#cc0000; font-size:16px; font-weight:bold; background-color:#ffff66">This location does not appear to have any current products or services<br /><em>(it may not be a valid location)</em><br /></td></tr>'; ?>
					<tr>
						<td align="right" class="required">Location's Address 1: &nbsp; </td>
						<td align="left"><input type="text" name="sa_addr1" maxlength="64" size="65" value ="<?php echo $row1['sa_address1']; ?>" /></td>
					</tr>
					<tr>
						<td align="right">Location's Address 2: &nbsp; </td>
						<td align="left"><input type="text" name="sa_addr2" maxlength="64" size="65" value ="<?php echo $row1['sa_address2']; ?>"/></td>
					</tr>
					<tr>
						<td align="right" class="required">Location's City : &nbsp; </td>
						<td align="left"><input type="text" name="sa_city" maxlength="32" size="33" value ="<?php echo $row1['sa_city']; ?>"/></td>
					</tr>
					<tr>
						<td align="right" class="required">Location's State: &nbsp; </td>
						<td align="left">
							<select name="sa_state">
								<option value="<?php echo $row1['sa_state']; ?>"><?php echo $row1['sa_state']; ?></option>
								<option value="IL">Illinois</option>
								<option value="IN">Indiana</option>
								<option value="KY">Kentucky</option>
					 		</select>
						</td>
					</tr>
					<tr>
						<td align="right" class="required">Location's Zip : &nbsp; </td>
						<td align="left"><input type="text" name="sa_zip" maxlength="10" size="11" value ="<?php echo $row1['sa_zip']; ?>"/></td>
					</tr>
					<tr>
						<td align="right" class="required">Location's Area Code : &nbsp; </td>
						<td align="left"><input type="text" name="sa_area_code" maxlength="3" size="4" value ="<?php echo $row1['sa_area_code']; ?>"/></td>
					</tr>
					<tr>
						<td align="right" class="required">Location's Phone Number: &nbsp; </td>
						<td align="left">
							<input type="text" name="sa_phone" maxlength="13" size="14" value ="<?php echo $row1['sa_phone']; ?>"/>&nbsp;&nbsp;
							<span class="example">(might differ from the customer's (billing) phone)</span>
						</td>
					</tr>
					<tr><td colspan="2" align="center"><input type="checkbox" name="verify_edit" value = "true"/>Check Here to Confirm Above Address Changes</td></tr>
					<tr>
						<td colspan="2" bgcolor="#CCCCCC" align="center" height="35"><h4>Service(s) For The Above Existing Location</h4></td>
					</tr>
					<tr><td colspan="2" align="center"><h4>View/Add Products and/or Services</h4></td></tr>
					<?php // <tr> looped here
						$result = dbconnect_newmethod()->query('SELECT prod_id, prod_name FROM product');
						for ($j=0; $j<$result->num_rows; $j++) {	//loop to display products in the database
							$row = $result->fetch_assoc();
						$result2 = dbconnect_newmethod()->query("SELECT prod_id FROM svc_addr_prod WHERE prod_id = '".$row['prod_id']."' and sa_id = '".$row1['sa_id']."'");
						$row2 = $result2->fetch_assoc();
							echo '<tr>';
							echo '<td align="right"><input type="checkbox" name="prodid[]" value="'.$row['prod_id'].'" ';     
								if(isset($row2['prod_id'])){
									echo 'checked disabled';
									
								}							
							echo '/></td>';
							echo '<td align="left">'.$row['prod_name'].'</td>';
							echo '</tr>';
						}//end for	
					?>
					<tr>
						<td colspan="2" bgcolor="#FFFFFF"><font color="#FFFFFF">a</font></td>
					</tr>
					<tr>
						<td colspan="2" bgcolor="#CCCCCC" align="center" height="35"><input type="submit" value="Submit Service Address" /></td>
					</tr>	
				</table>
			</td></tr>
			</table>
							
			</form>
		</td>
	
	</tr>
</table>

<br />

<?php disp_adminfooter(); ?>
</body>

</html>
