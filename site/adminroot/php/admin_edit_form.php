<?php 
	//Startup
	session_start();
	$admin_user = $_SESSION['admin_user'];
	require_once 'fns_display.php';
	require_once 'fns_database.php';
	$_SESSION['admin_id_toedit'] = $_POST['admin_id_toedit'];
	
	//Code used to store selected record as an array to use to populate fields
	$result = dbconnect_newmethod()->query("SELECT * FROM admin_user WHERE admin_user_id='".$_SESSION['admin_id_toedit']."'");
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
			<form name="admin_edit_form" action="admin_edit.php" method="post">
			<table cellpadding="2" cellspacing="0" border="0" width="100%">
				<tr bgcolor="#aaaaaa">
					<td colspan="2"><h4>Edit an Existing Admin User</h4></td>
				</tr>
				<tr><td colspan="2"><br /></td></tr>
				<tr>
					<td colspan="2">
						<table cellpadding="2" cellspacing="0" border="1">
							<tr bgcolor="#CCCCCC">
								<td align="left">First Name</td>
								<td>Last Name</td>
								<td>Username</td>
								<td>Password</td>
								<td>E-Mail</td>
								<td>Access Level</td>
							</tr>
							<tr bgcolor="#ffffcc">
								<?php showadmin_edit(); ?>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td colspan="2"><br /></td></tr>
				
				
				<tr>
					<td align="right">Change First Name:</td>
					<td align="left">
						<input 
							type="text" 
							name="admin_user_fname" 
							maxlength="32" 
							size="33" 
							value="<?php echo $row1['admin_user_fname']; ?>" />
					</td>
				</tr>
				
				<tr>
					<td align="right">Change Last Name:</td>
					<td align="left">
						<input 
							type="text" 
							name="admin_user_lname" 
							maxlength="14" 
							size="15" 
							value="<?php echo $row1['admin_user_lname']; ?>" />
					</td>
				</tr>
				
				<tr>
					<td align="right">Change Username:</td>
					<td align="left">
						<input 
							type="text" 
							name="admin_user_username" 
							maxlength="13" 
							size="14" 
							value="<?php echo $row1['admin_user_username']; ?>" />
					</td>
				</tr>
				<tr>
					<td align="right">Change Password:</td>
					<td align="left">
						<input 
							type="text" 
							name="admin_user_password" 
							maxlength="13" 
							size="14" 
							value="<?php echo $row1['admin_user_password']; ?>" />
					</td>
				</tr>
				<tr>
					<td align="right">Change E-Mail:</td>
					<td align="left">
						<input 
							type="text" 
							name="admin_user_email" 
							maxlength="64" 
							size="65" 
							value="<?php echo $row1['admin_user_email']; ?>" />
					</td>
				</tr>
				<tr>
					<td align="right">Change Access Level:</td>
					<td align="left">
						<input 
							type="text" 
							name="admin_level" 
							maxlength="13" 
							size="14" 
							value="<?php echo $row1['admin_level']; ?>" />
					</td>
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
function showadmin_edit() {
	$result = dbconnect_newmethod()->query("SELECT * FROM admin_user WHERE admin_user_id ='".$_SESSION['admin_id_toedit']."'");
	$num_results = $result->num_rows;
	for ($i=0; $i<$num_results; $i++) {
		$row2 = $result->fetch_assoc();
		echo '<td align="left">'.$row2['admin_user_fname'].'</td>';
		echo '<td>'.$row2['admin_user_lname'].'</td>';
		echo '<td>'.$row2['admin_user_username'].'</td>';
		echo '<td>'.$row2['admin_user_password'].'</td>';
		echo '<td>'.$row2['admin_user_email'].'</td>';
		echo '<td>'.$row2['admin_level'].'</td>';
	}
}
?>

</html>