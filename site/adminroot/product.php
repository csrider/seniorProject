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
					
			<!-- Delete tip Form follows -->
			<form action="php/product_delete.php" method="post">
			<table cellpadding="2" cellspacing="0" border="1">
				<tr bgcolor="#CCAAAA">
					<td colspan="3"><h4>DELETE a Product from the Database</h4></td>
				</tr>
				<tr bgcolor="#CCCCCC">
					<td colspan="3">Product ID</td>
					
				</tr>
				<tr>
					<td colspan="3"><input type="text" name="prod_id" maxlength="3" size="4" />
					
					<input type="submit" value="DELETE" /></td>
				</tr>
			</table>
			</form>
			<!-- End delete tip -->
			
			<br />
			<!-- Displays a dynamically generated table containing the information from the tip table -->
			<?php require 'php/product_view.php'; ?>			
		</td>
	</tr>
</table>

<br />

<?php disp_adminfooter(); ?>
</body>

</html>

<?php
//Lookup product types
function lookup_ptype() {
	$result = dbconnect_newmethod()->query('SELECT ptype_id, ptype_type FROM prod_type');
	for ($i=0; $i<$result->num_rows; $i++) {
		$row = $result->fetch_assoc();
		echo '<option value="';
			echo $row['ptype_id'];
			echo '">';
			echo $row['ptype_type'];
		echo '</option>\n';
	}
}
?>