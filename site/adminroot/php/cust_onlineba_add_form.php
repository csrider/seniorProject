<?php 
	session_start();
	$admin_user = $_SESSION['admin_user'];
	require_once 'fns_display.php';
	require_once 'fns_lookup.php';
	require_once 'fns_validate.php';
?>
<?php admin_check($admin_user); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<?php disp_titlebar($admin_user); ?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link REL="StyleSheet" TYPE="text/css" HREF="/zmen/adminroot/css/admin.css">
<script type="text/javascript">
function validate() {
	if (document.add_customerba_online.custo_username.value=="") 		window.alert("Please enter a username!");
	if (document.add_customerba_online.custo_password.value=="") 		window.alert("Please enter a password!");
	if (document.add_customerba_online.custo_email.value=="") 	window.alert("Please enter an email address!");
	if (document.add_customerba_online.custo_email_retype.value=="") 			window.alert("Please retype email address!");
}
</script>
</head>

<body>
<?php disp_adminheader(); ?>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td width="200" valign="top"><?php disp_adminmenu(); ?></td>
		<td valign="top" align="left">

			<!-- Add form -->
			<form action="cust_onlineba_add.php" method="post" name="add_customerba_online">
			<table border="1"><tr><td>
			 <table>
				<tr bgcolor="#CCCCCC"><td colspan="2" align="center"><h3>Add New Online Account for <?php echo $_SESSION['cust_name']; ?></h3></td></tr>
				<tr><td colspan="2" align="center"><span class="required">(Fields marked red are required)</span></td></tr>
				<tr>
					<td align="right" class="required">Username</td>
					<td align="left"><input type="text" name="custo_username" maxlength="16" size="17" /><span class="example">&nbsp;maximum of 16 characters</span></td>
				</tr>
				<tr>
					<td align="right" class="required">Password</td>
					<td align="left"><input type="text" name="custo_password" maxlength="16" size="17" /><span class="example">&nbsp;maximum of 16 characters</span></td>
				</tr>
				<tr>
					<td align="right" class="required">Email Address</td>
					<td align="left"><input type="text" name="custo_email" maxlength="64" size="64" /></td>
				</tr>
				<tr>
					<td align="right" class="required">Re-Type Email Address</td>
					<td align="left"><input type="text" name="custo_email_retype" maxlength="64" size="64" /><span class="example">&nbsp;verify</span></td>
				</tr>
				<tr>
					<td align="right">Accept Promotions?</td>
					<td align="left">
						<label><input checked type="radio" name="custo_promotions" value="1" checked />Yes</label>&nbsp;&nbsp;
						<label><input type="radio" name="custo_promotions" value="0" />No</label>&nbsp;&nbsp;&nbsp;
						<span class="example">&nbsp;(choose whether customer would like to receive email from us)</span>
					</td>
				</tr>
				<tr><td colspan="2" align="center"><hr /></td></tr>
				<tr><td colspan="2" align="center" bgcolor="#CCCCCC"><h4>(Optional) Store Your Bank Account Information</h4></td></tr>
				<tr><td colspan="2" align="center">(Please be sure that this information matches what's on file with your financial institution)</td></tr>
				<tr>
					<td align="right" class="required">Type of Account</td>
					<td align="left">
						<select name="bat_id">
							<option value="0">- SELECT -</option> <!--if value=0, we know NOT to add a record to the CUSTOMER_CC table for this customer-->
							<?php lookup_bat(); ?>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right" class="required">Routing Number</td>
					<td align="left"><input type="text" name="custbank_routing" maxlength="16" size="17" /></td>
				</tr>
				<tr>
					<td align="right" class="required">Account Number</td>
					<td align="left"><input type="text" name="custbank_account" maxlength="16" size="17" /></td>
				</tr>
				<tr>
					<td align="right" class="required">Financial Institution Name</td>
					<td align="left"><input type="text" name="custbank_bank" maxlength="32" size="33" /></td>
				</tr>
				<tr>
					<td align="right" class="required">Address Line 1</td>
					<td align="left"><input type="text" name="custbank_address1" maxlength="64" size="65" value="<?php echo $_SESSION['cust_address1']; ?>" /></td>
				</tr>
				<tr>
					<td align="right">Address Line 2</td>
					<td align="left"><input type="text" name="custbank_address2" maxlength="64" size="65" value="<?php echo $_SESSION['cust_address2']; ?>" /></td>
				</tr>
				<tr>
					<td align="right" class="required">City</td>
					<td align="left"><input type="text" name="custbank_city" maxlength="32" size="33" value="<?php echo $_SESSION['cust_city']; ?>" /></td>
				</tr>
				<tr>
					<td align="right" class="required">State Abbreviation</td>
					<td align="left"><input type="text" name="custbank_state" maxlength="2" size="3" value="<?php echo $_SESSION['cust_state']; ?>" /><span class="example">&nbsp;example: IN</span></td>
				</tr>
				<tr>
					<td align="right" class="required">Zip</td>
					<td align="left"><input type="text" name="custbank_zip" maxlength="10" size="11" value="<?php echo $_SESSION['cust_zip']; ?>" /><span class="example">&nbsp;example: 47715-7035</span></td>
				</tr>
				<tr bgcolor="#CCCCCC">
					<td colspan="2" align="center"><input name="submit" type="submit" value="Create Online Account" onmousedown="validate()" /></td>
				</tr>
			 </td></tr></table>
			</table>
			</form>
			
		</td>
	</tr>
</table>

<br />

<?php disp_adminfooter(); ?>
</body>

</html>