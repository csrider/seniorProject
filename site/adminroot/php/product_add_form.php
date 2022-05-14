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
<script type='text/javascript'>

function validate() {
	if (document.add_product.ptype_id.value=="SELECT") 		window.alert("Please Select Product Type!");
	if (document.add_product.prod_name.value=="") 		window.alert("Please enter a Product Name!");
	if (document.add_product.prod_desc.value=="") 		window.alert("Please enter a Product Description!");
	if (document.add_product.prod_unit_size.value=="") 		window.alert("Please enter a Unit Size!");
	if (document.add_product.prod_price.value=="") 		window.alert("Please enter a Price!");
	true;
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
			<form action="product_add.php" method="post" name="add_product">
			<table border="1"><tr><td>
			 <table>
				<tr bgcolor="#CCCCCC"><td colspan="2" align="center"><h3>New Product</h3></td></tr>
				<tr><td colspan="2" align="center"><span class="required">(Fields marked red are required)</span></td></tr>
				<tr>
					<td align="right" class="required">Product Type:</td>
					<td align="left">
						<select name="ptype_id">
							<option value="SELECT">- SELECT -</option>
							<?php lookup_ptype(); ?>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right" class="required">Name:</td>
					<td align="left">
						<input type="text" name="prod_name" maxlength="64" size="65" />
					</td>
				</tr>
				<tr>
					<td align="right" valign="top" class="required">Description:<br /><span class="example">(may be published on web)</span></td>
					<td align="left">
						<textarea rows="5" cols="50" name="prod_desc"></textarea>
					</td>
				</tr>
				<tr>
					<td align="right" valign="top">Notes:</td>
					<td align="left">
						<textarea rows="3" cols="50" name="prod_notes"></textarea>
					</td>
				</tr>
				<tr>
					<td align="right" class="required">Unit Size:</td>
					<td align="left">
						<input type="text" name="prod_unit_size" maxlength="32" size="33" />
					</td>
				</tr>
				<tr>
					<td align="right">Cost per unit:</td>
					<td align="left">
						<input type="text" name="prod_cost" maxlength="11" size="12" />
					</td>
				</tr>
				<tr>
					<td align="right" class="required">Price per unit:</td>
					<td align="left">
						<input type="text" name="prod_price" maxlength="11" size="12" />
					</td>
				</tr>
				<tr>
					<td align="right" class="required">May customer choose this product?</td>
					<td align="left">
						<label><input type="radio" name="prod_is_active" value="1" checked />Active product</label>&nbsp;&nbsp;
						<label><input type="radio" name="prod_is_active" value="0" />Inactive product</label>
					</td>
				</tr>
				<tr bgcolor="#CCCCCC">
					<td colspan="2" align="center"><input name="submit" type="submit" value="Enter New Product" onmousedown="validate()" /></td>
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