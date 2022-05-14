<?php 
	session_start();
	$admin_user = $_SESSION['admin_user'];
	require_once 'php/fns_validate.php';
	require_once 'php/fns_display.php';
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
		<td valign="top" align="left">
			
			<!-- Add CCV Form follows -->
			<form name="admin_add_form" action="php/admin_add.php" method="post">
			<table cellpadding="2" cellspacing="0" border="1">
				<tr bgcolor="#aaccaa">
					<td colspan="8"><h4>ADD an Administrative User</h4></td>
				</tr>
				<tr bgcolor="#CCCCCC">
					<td>First Name</td>
					<td>Last Name</td>
					<td>Username</td>
					<td>Password</td>
					<td>E-Mail</td>
					<td colspan="2">Access Level</td>
				</tr>
				<tr>
					<td><input type="text" name="admin_user_fname" maxlength="32" size="20" /></td>
					<td><input type="text" name="admin_user_lname" maxlength="32" size="20" /></td>
					<td><input type="text" name="admin_user_username" maxlength="16" size="16" /></td>
					<td><input type="text" name="admin_user_password" maxlength="16" size="16" /></td>
					<td><input type="text" name="admin_user_email" maxlength="64" size="18" /></td>
					<td><input type="text" name="admin_level" maxlength="1" size="2" /></td>
					<td>
						<?php
						if(check_clearance('add')) echo '<input type="submit" value="ADD" />';
						else echo 'Not Enough Clearance';
						?>
					</td>
				</tr>
			</table>
			</form>
			<!-- End add CCV -->
			
			<br />
			
			<!-- Delete CCV Form follows -->
			<form action="php/admin_delete.php" method="post">
			<table cellpadding="2" cellspacing="0" border="1">
				<tr bgcolor="#ccaaaa">
					<td colspan="5"><h4>DELETE an Administrative User</h4></td>
				</tr>
				<tr bgcolor="#CCCCCC">
					<td>Admin ID</td>
					<td colspan="4">Username</td>
				</tr>
				<tr>
					<td><input type="text" name="admin_user_id" maxlength="8" size="8" /></td>
					<td colspan="3"><input type="text" name="admin_user_username" maxlength="32" size="32"/></td>
					<td>
						<?php
						if(check_clearance('delete')) echo '<input type="submit" value="DELETE" />';
						else echo 'Not Enough Clearance';
						?>
					</td>
				</tr>
			</table>
			</form>
			<!-- End delete CCV -->
			<br />
			
			<!-- Displays a dynamically generated table containing the information from the cc_vendor table -->
			<?php 
			if(check_clearance('view')) require 'php/admin_view.php';
			else echo 'You do not have the necessary clearance to view existing records';
			?>
			
		</td>
	</tr>
</table>

<br />

<?php disp_adminfooter(); ?>
</body>

</html>