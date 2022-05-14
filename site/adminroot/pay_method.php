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
		
			<!-- Add Payment Method Form follows -->
			<form name="paym_add_form" action="php/paym_add.php" method="post">
			<table cellpadding="2" cellspacing="0" border="1">
				<tr bgcolor="#aaccaa">
					<td colspan="4"><h4>ADD a Payment Method to the Database</h4></td>
				</tr>
				<tr bgcolor="#CCCCCC">
					<td>Method Name</td>
					<td>Method Description</td>
					<td colspan="2">Merchant #</td>
				</tr>
				<tr>
					<td><input type="text" name="method_name" maxlength="20" size="21" /></td>
					<td><input type="text" name="method_description" maxlength="64" size="40" /></td>
					<td><input type="text" name="method_merchnum" maxlength="64" size="21" /></td>
					<td><input align="left" type="submit" value="ADD" /></td>
				</tr>
			</table>
			</form>
			<!-- End add payment method -->
			
			<br />
			
			<!-- Delete payment method Form follows -->
			<form action="php/paym_delete.php" method="post">
			<table cellpadding="2" cellspacing="0" border="1">
				<tr bgcolor="#ccaaaa">
					<td colspan="3"><h4>DELETE a Payment Method from the Database</h4></td>
				</tr>
				<tr bgcolor="#CCCCCC">
					<td>Method ID</td>
					<td colspan="2">Method Name</td>
				</tr>
				<tr>
					<td><input type="text" name="method_id" maxlength="3" size="9" /></td>
					<td><input type="text" name="method_name" maxlength="20" size="21" /></td>
					<td><input type="submit" value="DELETE" /></td>
				</tr>
			</table>
			</form>
			<!-- End delete payment method -->
			
			
			<br />
			<!-- Displays a dynamically generated table containing the information from the pay_method table -->
			<?php require 'php/paym_view.php'; ?>
		

			
		</td>
	</tr>
</table>

<br />

<?php disp_adminfooter(); ?>
</body>

</html>