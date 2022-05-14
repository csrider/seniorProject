<?php 
	//Startup
	session_start();
	$admin_user = $_SESSION['admin_user'];
	require_once 'fns_display.php';
	require_once 'fns_database.php';
	require_once 'fns_lookup.php';
	
	//Code used to store selected record as an array to use to populate fields
	$_SESSION['prod_id'] = $_POST['product_id_toedit'];
	$result = dbconnect_newmethod()->query("SELECT * FROM product, prod_type WHERE prod_id='".$_POST['product_id_toedit']."' AND product.ptype_id=prod_type.ptype_id");
	$num_results = $result->num_rows;
	for ($i=0; $i<$num_results; $i++) $row1 = $result->fetch_assoc();
	require_once 'fns_validate.php';
?>
<?php admin_check($admin_user); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<?php disp_titlebar($admin_user); ?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link REL="StyleSheet" TYPE="text/css" HREF="/zmen/adminroot/css/admin.css">
</head>

<body>
<?php disp_adminheader(); ?>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td width="200" valign="top"><?php disp_adminmenu(); ?></td>
		<td valign="top" align="center">
			
			<!-- Edit follows -->
			<form action="product_edit.php" method="post">
			<table cellpadding="2" cellspacing="0" border="0" width="100%">
				<tr bgcolor="#aaaaaa">
					<td colspan="2"><h4>Edit an Existing Product</h4></td>
				</tr>
				<tr><td><br /></td></tr>
				<tr>
					<td colspan="2">
						<table cellpadding="11" cellspacing="0" border="1">
							<tr bgcolor="#CCCCCC">
								<td align="left">Type</td>
								<td>Name</td>
								<td>Description</td>
								<td>Notes</td>
								<td>Unit Size</td>
								<td>Cost</td>
								<td>Price</td>
								<td>Active</td>
								<td>Record Last Updated</td>
								<td>Record Created</td>
							</tr>
							<tr bgcolor="#ffffcc">
								<?php showprod_edit(); ?>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td><br /></td></tr>
				<tr>
					<td align="right">Change Type:</td>
					<td align="left">
						<select name="ptype_id">
							<option value="<?php echo $row1['ptype_id']; ?>"><?php echo $row1['ptype_type']; ?></option>
							<option value="<?php echo $row1['ptype_id']; ?>">-----------------</option>
							<?php lookup_ptype(); ?>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right">Name:</td>
					<td align="left">
						<input type="text" name="prod_name" maxlength="64" size="65" value="<?php echo $row1['prod_name']; ?>" />
					</td>
				</tr>
				<tr>
					<td align="right" valign="top">Description:<br />(may be published on web)</td>
					<td align="left">
						<textarea rows="5" cols="50" name="prod_desc"><?php echo $row1['prod_desc']; ?></textarea>
					</td>
				</tr>
				<tr>
					<td align="right" valign="top">Notes:</td>
					<td align="left">
						<textarea rows="3" cols="50" name="prod_notes"><?php echo $row1['prod_notes']; ?></textarea>
					</td>
				</tr>
				<tr>
					<td align="right">Unit Size:</td>
					<td align="left">
						<input type="text" name="prod_unit_size" maxlength="32" size="33" value="<?php echo $row1['prod_unit_size']; ?>" />
					</td>
				</tr>
				<tr>
					<td align="right">Cost per unit:</td>
					<td align="left">
						<input type="text" name="prod_cost" maxlength="11" size="12" value="<?php echo $row1['prod_cost']; ?>" />
					</td>
				</tr>
				<tr>
					<td align="right">Price per unit:</td>
					<td align="left">
						<input type="text" name="prod_price" maxlength="11" size="12" value="<?php echo $row1['prod_price']; ?>" />
					</td>
				</tr>
				<tr>
					<td align="right">Change Active:</td>
					<td align="left">
						<input type="hidden" readonly="true" name="prod_is_active" value="<?php $row1['prod_is_active']; ?>" />
						<label><input type="radio" name="prod_is_active" value="1" <?php if ($row1['prod_is_active']==1) echo 'checked'; ?> />Active product</label>&nbsp;&nbsp;
						<label><input type="radio" name="prod_is_active" value="0" <?php if ($row1['prod_is_active']==0) echo 'checked'; ?> />Inactive product</label>
					
					</td>
				</tr>
				
				<tr>
					<td colspan="2" align="center"><input type="submit" value="Submit Changes" /></td>
				</tr>
			</table>
			</form>
			<!-- End tip edit -->
			
		</td>
	</tr>
</table>
<br />
<?php disp_adminfooter(); ?>
</body>

<?php
//Function used to display selected record that will be edited
function showprod_edit() {
	$result = dbconnect_newmethod()->query("SELECT * FROM product, prod_type WHERE prod_id='".$_POST['product_id_toedit']."' AND product.ptype_id=prod_type.ptype_id");
	for ($i=0; $i<$result->num_rows; $i++) {
		$row2 = $result->fetch_assoc();
		echo '<td align="left">'.$row2['ptype_type'].'</td>';
		echo '<td>'.$row2['prod_name'].'</td>';
		echo '<td>'.$row2['prod_desc'].'</td>';
		echo '<td>'.$row2['prod_notes'].'</td>';
		echo '<td>'.$row2['prod_unit_size'].'</td>';
		echo '<td>'.$row2['prod_cost'].'</td>';
		echo '<td>'.$row2['prod_price'].'</td>';
			//code to convert active flag to human-friendly format
			if ($row2['prod_is_active']==0) $row2['prod_is_active']='No';
			else if ($row2['prod_is_active']==1) $row2['prod_is_active']='Yes';
		echo '<td>'.$row2['prod_is_active'].'</td>';
		echo '<td>'.$row2['prod_lastupd'].'</td>';
		echo '<td>'.$row2['prod_created'].'</td>';
	}
}
?>

</html>