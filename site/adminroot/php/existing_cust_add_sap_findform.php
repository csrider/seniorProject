<?php //Startup code
	session_start();
	$admin_user = $_SESSION['admin_user'];
	require_once 'fns_display.php';
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
		<!--menu nav-->
		<td width="200" valign="top"><?php disp_adminmenu(); ?></td>
		
		<!--body-->
		<td valign="top" align="left">			
			
			<form action="existing_cust_add_sa_product_form.php" method="post" name="find_sa">
			<table border="1"><tr><td>
			 
			 <table>
				<tr><td align="center" colspan="2" bgcolor="#CCCCCC"><h3>Search for Existing Service Address to Edit / Add Products To</h3></td></tr>
				<tr>
					<td align="right" class="required">Service Address Phone :</td>
					<td align="left"><input type="text" name="find_cust_phone" maxlength="8" size="9" /><span class="example">&nbsp;(example: 555-1212)</span></td>
				</tr>
				<tr><td align="center" colspan="2" bgcolor="#CCCCCC"><input type="submit" name="submit" value="Find Service Address" /></td></tr>
			 </table>
			
			</td></tr></table>
			</form>
		
		</td>
	
	</tr>
</table>

<br />

<?php disp_adminfooter(); ?>
</body>

</html>