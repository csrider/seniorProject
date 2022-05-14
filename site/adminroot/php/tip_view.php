<?php

//Start Session variable
session_start();

//Requires and Includes
require_once 'fns_database.php';
require_once 'fns_validate.php';
admin_check($admin_user);

//Display existing data (read from table)

$result = dbconnect_newmethod()->query('SELECT *
  FROM tip
  LEFT JOIN prod_type ON tip.ptype_id = prod_type.ptype_id
  WHERE prod_type.ptype_id IS NULL
    OR prod_type.ptype_id = tip.ptype_id
	ORDER BY tip.tip_id ASC');
$num_results = $result->num_rows;
echo '
	<table border="1" cellpadding="2" cellspacing="0">
		<tr bgcolor="#aaaaaa">
			<td colspan="6"><h4>Current Tips in the Database</h4></td>
		</tr>
		<tr bgcolor="#cccccc">
			<td>ID</td>
			<td align="left">Type</td>
			<td>Description</td>
			<td width="125">Record Last Updated</td>
			<td width="125">Record Created</td>
			<td>Last Modified By</td>
		</tr>';
for ($i=0; $i<$num_results; $i++) {
	$row = $result->fetch_assoc();
	echo '<tr>';
	echo '<td>'.$row['tip_id'].'</td>';
	echo '<td align="left">'.$row['ptype_type'].'</td>';
	echo '<td>'.$row['tip_text'].'</td>';
	echo '<td width="125">'.$row['tip_lastupd'].'</td>';
	echo '<td width="125">'.$row['tip_created'].'</td>';
	echo '<td>'.$row['tip_last_mod_by'].'</td>';
	echo '</tr>';
}
echo '
	<tr bgcolor="#cccccc">
		<form action="php/tip_edit_form.php" method="post">
		<td colspan="6" align="left">
			Enter ID to Edit:
			<input type="text" name="tip_id_toedit" maxlength="3" size="4" />
			<input type="submit" value="EDIT" />
		</td>
		</form>
	</tr>';
echo '</table>';

?>