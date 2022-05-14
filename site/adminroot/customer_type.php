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
			<!-- Add customer type Form follows -->
			<form action="php/ctype_add.php" method="post">
			<table cellpadding="2" cellspacing="0" border="1">
				<tr bgcolor="#aaccaa">
					<td colspan="3"><h4>ADD a Customer Type to the Database</h4></td>
				</tr>
				<tr bgcolor="#CCCCCC">
					<td>Type Name</td>
					<td colspan="2">Customer Type Description</td>
				</tr>
				<tr>
					<td><input type="text" name="ctype_type" maxlength="32" size="33" /></td>
					<td><input type="text" name="ctype_desc" maxlength="128" size="30" /></td>
					<td><input align="left" type="submit" value="ADD" /></td>
				</tr>
			</table>
			</form>
			<!-- End add customer type -->
			
			<br />
			
			<!-- Delete customer type Form follows -->
			<form action="php/ctype_delete.php" method="post">
			<table cellpadding="2" cellspacing="0" border="1">
				<tr bgcolor="#ccaaaa">
					<td colspan="3"><h4>DELETE a Customer Type from the Database</h4></td>
				</tr>
				<tr bgcolor="#CCCCCC">
					<td>Type ID</td>
					<td colspan="2">Type Name</td>
				</tr>
				<tr>
					<td><input type="text" name="ctype_id" maxlength="3" size="9" /></td>
					<td><input type="text" name="ctype_type" maxlength="32" size="33" /></td>
					<td><input type="submit" value="DELETE" /></td>
				</tr>
			</table>
			</form>
			<!-- End delete customer type -->
			
			<br />
			<!-- Displays a dynamically generated table containing the information from the customer_type table -->
			<?php require 'php/ctype_view.php'; ?>
						
		</td>
	</tr>
</table>

<br />

<?php disp_adminfooter(); ?>
</body>

</html>