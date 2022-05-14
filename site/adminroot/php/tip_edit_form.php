<?php 
	//Startup
	session_start();
	$admin_user = $_SESSION['admin_user'];
	require_once 'fns_display.php';
	require_once 'fns_lookup.php';
	
	//Code used to store selected record as an array to use to populate fields
	$_SESSION['tip_id'] = $_POST['tip_id_toedit'];
	$result = dbconnect_newmethod()->query("SELECT * FROM tip WHERE tip_id='".$_POST['tip_id_toedit']."'");
	$num_results = $result->num_rows;
	for ($i=0; $i<$num_results; $i++) $row1 = $result->fetch_assoc();
	
	//Store the current record being edited's ID in the session to carry to the next page
	$_SESSION['tip_id'] = $_POST['tip_id_toedit'];
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
	if (document.tip_edit_form.tip_type.value=="CHANGE")	window.alert("Please choose a type for this tip!");
	if (document.tip_edit_form.tip_text.value=="") window.alert("Please enter text for this tip!\nIf you would like to delete this tip instead, please go to main page.");
}
</script>
</head>

<body>
<?php disp_adminheader(); ?>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td width="200" valign="top"><?php disp_adminmenu(); ?></td>
		<td valign="top" align="center">
			
			<!-- Edit follows -->
			<form action="tip_edit.php" method="post" name="tip_edit_form">
			<table cellpadding="2" cellspacing="0" border="0" width="100%">
				<tr bgcolor="#aaaaaa">
					<td colspan="2"><h4>Edit an Existing Tip</h4></td>
				</tr>
				
				<tr><td colspan="2"><br /></td></tr>
				
				<tr>
					<td colspan="2">
						
						<table cellpadding="2" cellspacing="0" border="1">
							<tr bgcolor="#CCCCCC">
								<td align="left">Type</td>
								<td>Description</td>
								<td>Record Last Updated</td>
								<td>Record Created</td>
							</tr>
							<tr bgcolor="#ffffcc">
								<?php showtip_edit(); ?>
							</tr>
						</table>
					
					</td>
				</tr>
				
				<tr><td colspan="2"><br /></td></tr>
				
				<tr>
					<td colspan="2">
						
						<table cellpadding="0" cellspacing="0" border="0">
							<tr>
								<td align="left">
									Change Tip Type&nbsp;&nbsp;<select name="tip_type"><option value="CHANGE">- CHANGE -</option><?php lookup_ptype(); ?></select>
								</td>
							</tr>
							<tr>
								<td align="left">
									<br />
									Change Tip Description:
									<br />
									<textarea name="tip_text" rows="15" cols="60"><?php echo $row1['tip_text']; ?></textarea>
								</td>
							</tr>
							<tr>
								<td align="center"><input type="submit" value="Submit Changes" onmousedown="validate()" /></td>
							</tr>
						</table>
					
					</td>
				</tr>
							
			</table>
			</form>
			<!-- End tip edit -->
			
		</td>
	</tr>
</table>
<br />
<?php disp_adminfooter(); ?>
</body>

<?php
//Function used to display selected record that will be edited
function showtip_edit() {
	$result = dbconnect_newmethod()->query("SELECT tip.*, prod_type.ptype_type FROM tip, prod_type WHERE tip.tip_id='".$_POST['tip_id_toedit']."' AND tip.ptype_id=prod_type.ptype_id");
	for ($i=0; $i<$result->num_rows; $i++) {
		$row2 = $result->fetch_assoc();
		echo '<td align="left">'.$row2['ptype_type'].'</td>';
		echo '<td>'.$row2['tip_text'].'</td>';
		echo '<td>'.$row2['tip_lastupd'].'</td>';
		echo '<td>'.$row2['tip_created'].'</td>';
	}
}
?>

</html>