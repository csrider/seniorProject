<?php 
	//Startup
	session_start();
	$admin_user = $_SESSION['admin_user'];
	require_once 'fns_display.php';
	require_once 'fns_database.php';
	
	//Code used to store selected record as an array to use to populate fields
	$result = dbconnect_newmethod()->query("SELECT * FROM pay_method WHERE paym_id='".$_POST['method_id_toedit']."'");
	$num_results = $result->num_rows;
	for ($i=0; $i<$num_results; $i++) $row1 = $result->fetch_assoc();
	
	//Store the current record being edited's ID in the session to carry to the next page
	$_SESSION['paym_id'] = $_POST['method_id_toedit'];
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
			<form action="paym_edit.php" method="post">
			<table cellpadding="2" cellspacing="0" border="0" width="100%">
				<tr bgcolor="#aaaaaa">
					<td colspan="2"><h4>Edit an Existing Payment Method</h4></td>
				</tr>
				<tr><td colspan="2"><br /></td></tr>
				<tr>
					<td colspan="2">
						<table cellpadding="2" cellspacing="0" border="1">
							<tr bgcolor="#CCCCCC">
								<td align="left">Method</td>
								<td>Description</td>
								<td>Merchant #</td>
								<td>Record Last Updated</td>
								<td>Record Created</td>
							</tr>
							<tr bgcolor="#ffffcc">
								<?php showpaym_edit(); ?>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td colspan="2"><br /></td></tr>
				<tr>
					<td align="right">Change Method Name:</td>
					<td align="left">
						<input 
							type="text" 
							name="paym_name" 
							maxlength="20" 
							size="21" 
							value="<?php echo $row1['paym_name']; ?>" 
						/>
					</td>
				</tr>
				<tr>
					<td align="right">Change Method Description:</td>
					<td align="left">
						<input 
							type="text" 
							name="paym_desc" 
							maxlength="64" 
							size="65" 
							value="<?php echo $row1['paym_desc']; ?>" 
						/>
					</td>
				</tr>
				<tr>
					<td align="right">Change Method Merchant #:</td>
					<td align="left">
						<input 
							type="text" 
							name="paym_merchant_num" 
							maxlength="64" 
							size="65" 
							value="<?php echo $row1['paym_merchant_num']; ?>" 
						/>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center"><input type="submit" value="Submit Changes" /></td>
				</tr>
			</table>
			</form>
			<!-- End edit -->
			
		</td>
	</tr>
</table>
<br />
<?php disp_adminfooter(); ?>
</body>

<?php
//Function used to display selected record that will be edited
function showpaym_edit() {
	$result = dbconnect_newmethod()->query("SELECT * FROM pay_method WHERE paym_id='".$_POST['method_id_toedit']."'");
	$num_results = $result->num_rows;
	for ($i=0; $i<$num_results; $i++) {
		$row2 = $result->fetch_assoc();
		echo '<td align="left">'.$row2['paym_name'].'</td>';
		echo '<td>'.$row2['paym_desc'].'</td>';
		echo '<td>'.$row2['paym_merchant_num'].'</td>';
		echo '<td>'.$row2['paym_lastupd'].'</td>';
		echo '<td>'.$row2['paym_created'].'</td>';
	}
}
?>

</html>