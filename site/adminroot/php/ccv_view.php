<?php

//Start Session variable
session_start();

//Requires and Includes
require_once 'fns_database.php';
require_once 'fns_validate.php';
admin_check($admin_user);

//Display existing data (read from table)
$result = dbconnect_newmethod()->query('select * from cc_vendor');
$num_results = $result->num_rows;
echo '
	<table border="1" cellpadding="2" cellspacing="0">
		<tr bgcolor="#aaaaaa">
			<td colspan="6"><h4>Current Credit Card Vendors in the Database</h4></td>
		</tr>
		<tr bgcolor="#cccccc">
			<td>ID</td>
			<td align="left">Vendor</td>
			<td>Merchant #</td>
			<td>Phone #</td>
			<td>Record Last Updated</td>
			<td>Record Created</td>
		</tr>';
for ($i=0; $i<$num_results; $i++) {
	$row = $result->fetch_assoc();
	echo '<tr>';
	echo '<td>'.$row['ccv_id'].'</td>';
	echo '<td align="left">'.$row['ccv_name'].'</td>';
	echo '<td>'.$row['ccv_merch_num'].'</td>';
	echo '<td>'.$row['ccv_merch_phone'].'</td>';
	echo '<td>'.$row['ccv_lastupd'].'</td>';
	echo '<td>'.$row['ccv_created'].'</td>';
	echo '</tr>';
}
echo '
	<tr bgcolor="#cccccc">
		<form action="php/ccv_edit_form.php" method="post">
		<td colspan="6" align="left">
			Enter ID to Edit:
			<input type="text" name="vendor_id_toedit" maxlength="3" size="4" />
			<input type="submit" value="EDIT" />
		</td>
		</form>
	</tr>';
echo '</table>';

?>