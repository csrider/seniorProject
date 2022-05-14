<?php 
	session_start();
	$admin_user = $_SESSION['admin_user'];
	require_once 'php/fns_display.php';
	require_once 'php/fns_validate.php';
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
			

			<!-- Add BAT Form follows -->
			<form action="php/bat_add.php" method="post">
			<table cellpadding="2" cellspacing="0" border="1">
				<tr bgcolor="#aaccaa">
					<td colspan="4"><h4>ADD a Bank Account Type to the Database</h4></td>
				</tr>
				<tr bgcolor="#CCCCCC">
					<td>Account Type</td>
					<td colspan="2">Description</td>
				</tr>
				<tr>
					<td><input type="text" name="bat_type" maxlength="32" size="33" /></td>
					<td><input type="text" name="bat_desc" maxlength="64" size="65" /></td>
					<td><input align="left" type="submit" value="ADD" /></td>
				</tr>
			</table>
			</form>
			<!-- End add BAT -->
			
			<br />
			
			<!-- Delete CCV Form follows -->
			<form action="php/bat_delete.php" method="post">
			<table cellpadding="2" cellspacing="0" border="1">
				<tr bgcolor="#CCAAAA">
					<td colspan="3"><h4>DELETE a Bank Account Type from the Database</h4></td>
				</tr>
				<tr bgcolor="#CCCCCC">
					<td>ID</td>
					<td colspan="2">Type</td>
				</tr>
				<tr>
					<td><input type="text" name="bat_id" maxlength="3" size="4" /></td>
					<td><input type="text" name="bat_type" maxlength="32" size="33" /></td>
					<td><input type="submit" value="DELETE" /></td>
				</tr>
			</table>
			</form>
			<!-- End delete CCV -->
			
			<br />
			<!-- Displays a dynamically generated table containing the information from the cc_vendor table -->
			<?php require 'php/bat_view.php'; ?>
			
			

		</td>
	</tr>
</table>

<br />

<?php disp_adminfooter(); ?>
</body>

</html>