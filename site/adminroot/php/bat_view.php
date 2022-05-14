<?php

//Start Session variable
session_start();

//Requires and Includes
require_once 'fns_database.php';
require_once 'fns_validate.php';
admin_check($admin_user);

//Display existing data (read from table)
$result = dbconnect_newmethod()->query('select * from bank_acct_type');
$num_results = $result->num_rows;
echo '
	<table border="1" cellpadding="2" cellspacing="0">
		<tr bgcolor="#aaaaaa">
			<td colspan="6"><h4>Current Bank Account Types in the Database</h4></td>
		</tr>
		<tr bgcolor="#cccccc">
			<td>ID</td>
			<td align="left">Type</td>
			<td>Description</td>
			<td>Record Last Updated</td>
			<td>Record Created</td>
		</tr>';
for ($i=0; $i<$num_results; $i++) {
	$row = $result->fetch_assoc();
	echo '<tr>';
	echo '<td>'.$row['bat_id'].'</td>';
	echo '<td align="left">'.$row['bat_type'].'</td>';
	echo '<td>'.$row['bat_desc'].'</td>';
	echo '<td>'.$row['bat_lastupd'].'</td>';
	echo '<td>'.$row['bat_created'].'</td>';
	echo '</tr>';
}
echo '
	<tr bgcolor="#cccccc">
		<form action="php/bat_edit_form.php" method="post">
		<td colspan="6" align="left">
			Enter ID to Edit:
			<input type="text" name="type_id_toedit" maxlength="3" size="4" />
			<input type="submit" value="EDIT" />
		</td>
		</form>
	</tr>';
echo '</table>';

?>