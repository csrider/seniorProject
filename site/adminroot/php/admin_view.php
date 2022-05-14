<?php

//Start Session variable
//session_start();

//Requires and Includes
require_once 'fns_database.php';
require_once 'fns_validate.php';
admin_check($admin_user);

//Display existing data (read from table)
$result = dbconnect_newmethod()->query('SELECT * FROM admin_user');
$num_results = $result->num_rows;
echo '
	<table border="1" cellpadding="2" cellspacing="0">
		<tr bgcolor="#aaaaaa">
			<td colspan="8"><h4>Current Administrative Users</h4></td>
		</tr>
		<tr bgcolor="#cccccc">
			<td>ID</td>
			<td align="left">First Name</td>
			<td>Last Name</td>
			<td>Username</td>
			<td>Password</td>
			<td>E-Mail</td>
			<td>Access Level</td>
		</tr>';
for ($i=0; $i<$num_results; $i++) {
	$row = $result->fetch_assoc();
	echo '<tr>';
	echo '<td>'.$row['admin_user_id'].'</td>';
	echo '<td align="left">'.$row['admin_user_fname'].'</td>';
	echo '<td>'.$row['admin_user_lname'].'</td>';
	echo '<td>'.$row['admin_user_username'].'</td>';
	echo '<td>'.$row['admin_user_password'].'</td>';
	echo '<td>'.$row['admin_user_email'].'</td>';
	echo '<td>'.$row['admin_level'].'</td>';
	echo '</tr>';
}
echo '
	<tr bgcolor="#cccccc">
		<form action="php/admin_edit_form.php" method="post">
		<td colspan="8" align="left">
			Enter ID to Edit:
			<input type="text" name="admin_id_toedit" maxlength="3" size="4" />
			<input type="submit" value="EDIT" />
		</td>
		</form>
	</tr>';
echo '</table>';

?>