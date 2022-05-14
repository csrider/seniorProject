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
			<!-- Add Tip Form follows -->
			<form action="php/tip_add.php" method="post">
			<table cellpadding="2" cellspacing="0" border="1">
				<tr bgcolor="#aaccaa">
					<td colspan="2"><h4>ADD a Tip to the Database</h4></td>
				</tr>
				<tr>
					<td align="right" valign="top" bgcolor="#CCCCCC">Select Type</td>
					<td><select name="ptype_id"><?php lookup_ptype(); ?></select></td>
				</tr>
				<tr>
					<td align="right" valign="top" bgcolor="#CCCCCC">Enter Tip</td>
					<td><textarea name="tip_text" rows="5" cols="60"></textarea></td>
				</tr>
				<tr>
					<td colspan="2" align="center"><input align="center" type="submit" value="ADD" /></td>
				</tr>
			</table>
			</form>
			<!-- End add tip -->
			
			<br />
			
			<!-- Delete tip Form follows -->
			<form action="php/tip_delete.php" method="post">
			<table cellpadding="2" cellspacing="0" border="1">
				<tr bgcolor="#CCAAAA">
					<td colspan="3"><h4>DELETE a Tip from the Database</h4></td>
				</tr>
				<tr bgcolor="#CCCCCC">
					<td colspan="2">Tip ID</td>
					
				</tr>
				<tr>
					<td><input type="text" name="tip_id" maxlength="3" size="4" /></td>
					
					<td><input type="submit" value="DELETE" /></td>
				</tr>
			</table>
			</form>
			<!-- End delete tip -->
			
			<br />
			<!-- Displays a dynamically generated table containing the information from the tip table -->
			<?php require 'php/tip_view.php'; ?>
					
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