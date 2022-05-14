<?php 
	session_start();
	$admin_user = $_SESSION['admin_user'];
	require_once 'fns_display.php';
	require_once 'fns_lookup.php';
	$cust_name = $_SESSION['cust_name'];
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
		<td valign="top" align="left">

			<!-- Add form -->
			<form action="sa_add.php" method="post" name="add_service_address">
			<table border="1"><tr><td>
			 <table border="0">
				
<!-- start address template... loop and/or fill according to the flag set at the end of customer_add.php -->
	<?php
	
	//Non-looping form creator for only one location and it is the billing as well
	if ($_SESSION['sa_flag'] == 0) {
		$i = 1;
		echo '
			<tr bgcolor="#CCCCCC"><td colspan="3" align="center"><h3>Confirm Service Location for "'.$_SESSION['cust_name'].'"</h3></td></tr>
			<tr><td colspan="3" align="center"><span class="required">(Fields marked red are required)</span></td></tr>
			<tr><td colspan="3" align="left" class="sec_header">Service Location #'.$i.' (same as billing address)</td>
			<tr>
				<td align="right" class="required">Address 1</td>
				<td align="left"><input type="text" name="sa_address1_loc'.$i.'" maxlength="64" size="65" value="'.$_SESSION['cust_address1'].'" /></td>
				<td align="left" valign="top" rowspan="7">
		';
					$db = mysqli_connect('localhost','zmen_webuser','password','zmendev');
					$result = $db->query('SELECT prod_id, prod_name FROM product');
					mysqli_close($db);
					for ($j=0; $j<$result->num_rows; $j++) {	//loop to display products in the database
						$row = $result->fetch_assoc();
						echo '<input type="checkbox" name="prodloc'.$i.'[]" value="'.$row['prod_id'].'" />'.$row['prod_name'].'<br />';
					}
		echo '		
				</td>
			</tr>
			<tr>
				<td align="right">Address 2</td>
				<td align="left"><input type="text" name="sa_address2_loc'.$i.'" maxlength="64" size="65" value="'.$_SESSION['cust_address2'].'" /></td>
			</tr>
			<tr>
				<td align="right" class="required">City</td>
				<td align="left"><input type="text" name="sa_city_loc'.$i.'" maxlength="32" size="33" value="'.$_SESSION['cust_city'].'" /></td>
			</tr>
			<tr>
				<td align="right" class="required">State</td>
				<td align="left"><input type="text" name="sa_state_loc'.$i.'" maxlength="2" size="3" value="'.$_SESSION['cust_state'].'" /></td>
			</tr>
			<tr>
				<td align="right" class="required">Zip</td>
				<td align="left"><input type="text" name="sa_zip_loc'.$i.'" maxlength="10" size="11" value="'.$_SESSION['cust_zip'].'" /><span class="example">&nbsp;example: 47715-7035</span></td>
			</tr>
			<tr>
				<td align="right" class="required">Area Code</td>
				<td align="left"><input type="text" name="sa_area_code_loc'.$i.'" maxlength="3" size="4" value="'.$_SESSION['derived_area_code'].'" /><span class="example">&nbsp;example: 812</span></td>
			</tr>
			<tr>
				<td align="right" class="required">Phone</td>
				<td align="left"><input type="text" name="sa_phone_loc'.$i.'" maxlength="8" size="9" value="'.$_SESSION['derived_phone_num'].'" /><span class="example">&nbsp;example: 555-1212</span></td>
			</tr>
			<tr bgcolor="#CCCCCC">
				<td colspan="3" align="center"><input name="submit" type="submit" value="Confirm Service Location for '.$_SESSION['cust_name'].'" onmousedown="validate()" /></td>
			</tr>
		';//end echo
	}//end if
	
	//Non-looping form creator for only one location and it is NOT the billing
	if ($_SESSION['sa_flag'] == 3) {
		$i = 1;
		echo '
			<tr bgcolor="#CCCCCC"><td colspan="3" align="center"><h3>Confirm Service Location for "'.$_SESSION['cust_name'].'"</h3></td></tr>
			<tr><td colspan="3" align="center"><span class="required">(Fields marked red are required)</span></td></tr>
			<tr><td colspan="3" align="left" class="sec_header">Service Location #1 (different than billing address)</td>
			<tr>
				<td align="right" class="required">Address 1</td>
				<td align="left"><input type="text" name="sa_address1_loc'.$i.'" maxlength="64" size="65" value="" /></td>
				<td align="left" valign="top" rowspan="7">
		';
					$db = mysqli_connect('localhost','zmen_webuser','password','zmendev');
					$result = $db->query('SELECT prod_id, prod_name FROM product');
					mysqli_close($db);
					for ($j=0; $j<$result->num_rows; $j++) {	//loop to display products in the database
						$row = $result->fetch_assoc();
						echo '<input type="checkbox" name="prodloc'.$i.'[]" value="'.$row['prod_id'].'" />'.$row['prod_name'].'<br />';
					}
		echo '		
				</td>
			</tr>
			<tr>
				<td align="right">Address 2</td>
				<td align="left"><input type="text" name="sa_address2_loc'.$i.'" maxlength="64" size="65" value="" /></td>
			</tr>
			<tr>
				<td align="right" class="required">City</td>
				<td align="left"><input type="text" name="sa_city_loc'.$i.'" maxlength="32" size="33" value="" /></td>
			</tr>
			<tr>
				<td align="right" class="required">State</td>
				<td align="left"><input type="text" name="sa_state_loc'.$i.'" maxlength="2" size="3" value="" /></td>
			</tr>
			<tr>
				<td align="right" class="required">Zip</td>
				<td align="left"><input type="text" name="sa_zip_loc'.$i.'" maxlength="10" size="11" value="" /><span class="example">&nbsp;example: 47715-7035</span></td>
			</tr>
			<tr>
				<td align="right" class="required">Area Code</td>
				<td align="left"><input type="text" name="sa_area_code_loc'.$i.'" maxlength="3" size="4" value="" /><span class="example">&nbsp;example: 812</span></td>
			</tr>
			<tr>
				<td align="right" class="required">Phone</td>
				<td align="left"><input type="text" name="sa_phone_loc'.$i.'" maxlength="8" size="9" value="" /><span class="example">&nbsp;example: 555-1212</span></td>
			</tr>
			<tr bgcolor="#CCCCCC">
				<td colspan="3" align="center"><input name="submit" type="submit" value="Confirm Service Location for '.$_SESSION['cust_name'].'" onmousedown="validate()" /></td>
			</tr>
		';//end echo
	}//end if
	
	//Looping form creator for more than one location and billing IS one of them... number of forms (loops) determined by how many service locations they entered
	if ($_SESSION['sa_flag'] == 1) {
		$tempaddr1 = $_SESSION['cust_address1'];
		$tempaddr2 = $_SESSION['cust_address2'];
		$tempcity = $_SESSION['cust_city'];
		$tempstate = $_SESSION['cust_state'];
		$tempzip = $_SESSION['cust_zip'];
		$temparea = $_SESSION['derived_area_code'];
		$tempphone = $_SESSION['derived_phone_num'];
		echo '<tr bgcolor="#CCCCCC"><td colspan="3" align="center"><h3>Confirm and Add Service Locations for "'.$_SESSION['cust_name'].'"</h3></td></tr>';
		echo '<tr><td colspan="3" align="center"><span class="required">(Fields marked red are required)</span></td></tr>';
		for ($i=1; $i<=$_SESSION['numServiceLoc']; $i++) {
			echo '
				<tr><td colspan="2" align="left" class="sec_header">Service Location #'.$i.'</td>
				</tr>
				<tr>
					<td align="right" class="required">Address 1</td>
					<td align="left"><input type="text" name="sa_address1_loc'.$i.'" maxlength="64" size="65" value="'.$tempaddr1.'" /></td>
					<td align="left" valign="top" rowspan="7">
			';
					$db = mysqli_connect('localhost','zmen_webuser','password','zmendev');
					$result = $db->query('SELECT prod_id, prod_name FROM product');
					mysqli_close($db);
					for ($j=0; $j<$result->num_rows; $j++) {	//loop to display products in the database
						$row = $result->fetch_assoc();
						echo '<input type="checkbox" name="prodloc'.$i.'[]" value="'.$row['prod_id'].'" />'.$row['prod_name'].'<br />';
					}
			echo '		
					</td>
				</tr>
				<tr>
					<td align="right">Address 2</td>
					<td align="left"><input type="text" name="sa_address2_loc'.$i.'" maxlength="64" size="65" value="'.$tempaddr2.'" /></td>
				</tr>
				<tr>
					<td align="right" class="required">City</td>
					<td align="left"><input type="text" name="sa_city_loc'.$i.'" maxlength="32" size="33" value="'.$tempcity.'" /></td>
				</tr>
				<tr>
					<td align="right" class="required">State</td>
					<td align="left">
			';
					if ($tempstate!="") echo '<input type="text" name="sa_state_loc'.$i.'" maxlength="2" size="3" value="'.$tempstate.'" />';
					if ($tempstate=="") echo '
						<select name="sa_state_loc'.$i.'">
							<option value="">- SELECT -</option>
							<option value="IL">Illinois</option>
							<option value="IN">Indiana</option>
							<option value="KY">Kentucky</option>
						</select>';
			echo'
					</td>
				</tr>
				<tr>
					<td align="right" class="required">Zip</td>
					<td align="left"><input type="text" name="sa_zip_loc'.$i.'" maxlength="10" size="11" value="'.$tempzip.'" /><span class="example">&nbsp;example: 47715-7035</span></td>
				</tr>
				<tr>
					<td align="right" class="required">Area Code</td>
					<td align="left"><input type="text" name="sa_area_code_loc'.$i.'" maxlength="3" size="4" value="'.$temparea.'" /><span class="example">&nbsp;example: 812</span></td>
				</tr>
				<tr>
					<td align="right" class="required">Phone</td>
					<td align="left"><input type="text" name="sa_phone_loc'.$i.'" maxlength="8" size="9" value="'.$tempphone.'" /><span class="example">&nbsp;example: 555-1212</span></td>
				</tr>
				<tr><td colspan="3" align="left"><hr /></td></tr>
			';//end echo
		$tempaddr1 = "";	//cleared so the rest of the forms (loops) won't be auto-filled
		$tempaddr2 = "";	//cleared so the rest of the forms (loops) won't be auto-filled
		$tempcity = "";		//cleared so the rest of the forms (loops) won't be auto-filled
		$tempstate = "";	//cleared so the rest of the forms (loops) won't be auto-filled
		$tempzip = "";		//cleared so the rest of the forms (loops) won't be auto-filled
		$temparea = "";		//cleared so the rest of the forms (loops) won't be auto-filled
		$tempphone = "";	//cleared so the rest of the forms (loops) won't be auto-filled
		}//end for
				echo '
				<tr bgcolor="#CCCCCC">
					<td colspan="3" align="center">
						<input name="submit" type="submit" value="Submit Service Locations for '.$_SESSION['cust_name'].'" onmousedown="validate()" />
					</td>
				</tr>
				';
	}//end if
	
	//Looping form creator for more than one location and billing is NOT one of them... number of forms (loops) determined by how many service locations they entered
	if ($_SESSION['sa_flag'] == 2) {	
		echo '<tr bgcolor="#CCCCCC"><td colspan="3" align="center"><h3>Add Service Locations for "'.$_SESSION['cust_name'].'"</h3></td></tr>';
		echo '<tr><td colspan="3" align="center"><span class="required">(Fields marked red are required)</span></td></tr>';
		for ($i=1; $i<=$_SESSION['numServiceLoc']; $i++) {
			echo '
				<tr><td colspan="3" align="left" class="sec_header">Service Location #'.$i.'</td>
				</tr>
				<tr>
					<td align="right" class="required">Address 1</td>
					<td align="left"><input type="text" name="sa_address1_loc'.$i.'" maxlength="64" size="65" value="" /></td>
					<td align="left" valign="top" rowspan="7">
			';
					$db = mysqli_connect('localhost','zmen_webuser','password','zmendev');
					$result = $db->query('SELECT prod_id, prod_name FROM product');
					mysqli_close($db);
					for ($j=0; $j<$result->num_rows; $j++) {	//loop to display products in the database
						$row = $result->fetch_assoc();
						echo '<input type="checkbox" name="prodloc'.$i.'[]" value="'.$row['prod_id'].'" />'.$row['prod_name'].'<br />';
					}
			echo '		
					</td>
				</tr>
				<tr>
					<td align="right">Address 2</td>
					<td align="left"><input type="text" name="sa_address2_loc'.$i.'" maxlength="64" size="65" value="" /></td>
				</tr>
				<tr>
					<td align="right" class="required">City</td>
					<td align="left"><input type="text" name="sa_city_loc'.$i.'" maxlength="32" size="33" value="" /></td>
				</tr>
				<tr>
					<td align="right" class="required">State</td>
					<td align="left">
						<select name="sa_state_loc'.$i.'">
							<option value="">- SELECT -</option>
							<option value="IL">Illinois</option>
							<option value="IN">Indiana</option>
							<option value="KY">Kentucky</option>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right" class="required">Zip</td>
					<td align="left"><input type="text" name="sa_zip_loc'.$i.'" maxlength="10" size="11" value="" /><span class="example">&nbsp;example: 47715-7035</span></td>
				</tr>
				<tr>
					<td align="right" class="required">Area Code</td>
					<td align="left"><input type="text" name="sa_area_code_loc'.$i.'" maxlength="3" size="4" value="" /><span class="example">&nbsp;example: 812</span></td>
				</tr>
				<tr>
					<td align="right" class="required">Phone</td>
					<td align="left"><input type="text" name="sa_phone_loc'.$i.'" maxlength="8" size="9" value="" /><span class="example">&nbsp;example: 555-1212</span></td>
				</tr>
				<tr><td colspan="3" align="left"><hr /></td></tr>
			';//end echo
		}//end for
				echo '
				<tr bgcolor="#CCCCCC">
					<td colspan="3" align="center">
						<input name="submit" type="submit" value="Submit Service Locations for '.$_SESSION['cust_name'].'" onmousedown="validate()" />
					</td>
				</tr>
				';
	}//end if
	
	?>
<!-- end address template loop-->

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