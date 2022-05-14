<?php

//Start Session variable
session_start();

//Requires and Includes
require_once 'fns_database.php';
require_once 'fns_validate.php';
admin_check($admin_user);

//Display existing data (read from table)

$result = dbconnect_newmethod()->query('SELECT * FROM product, prod_type WHERE product.ptype_id=prod_type.ptype_id ORDER BY prod_id ASC');
$num_results = $result->num_rows;
echo '
	<table border="1" cellpadding="2" cellspacing="0">
		<tr bgcolor="#aaaaaa">
			<td colspan="11"><h4>Current Products in the Database</h4></td>
		</tr>
		<tr bgcolor="#cccccc">
			<td>ID</td>
			<td align="left">ProdType</td>
			<td>Name</td>
			<td>Description</td>
			<td>Notes</td>
			<td>Unit Size</td>
			<td>Cost</td>
			<td>Price</td>
			<td>Active</td>
			<td>Product Lastup</td>
			<td>Product Created</td>
		</tr>';
for ($i=0; $i<$num_results; $i++) {
	$row = $result->fetch_assoc();
	echo '<tr>';
	echo '<td>'.$row['prod_id'].'</td>';
	echo '<td align="left">'.$row['ptype_type'].'</td>';
	echo '<td>'.$row['prod_name'].'</td>';
	echo '<td>'.$row['prod_desc'].'</td>';
	echo '<td>'.$row['prod_notes'].'</td>';
	echo '<td>'.$row['prod_unit_size'].'</td>';
	echo '<td>'.$row['prod_cost'].'</td>';
	echo '<td>'.$row['prod_price'].'</td>';
		//following code converts active flag to human-friendly format
		if ($row['prod_is_active']==0) $row['prod_is_active']='No';
		else if ($row['prod_is_active']==1) $row['prod_is_active']='Yes';
	echo '<td>'.$row['prod_is_active'].'</td>';
	echo '<td>'.$row['prod_lastupd'].'</td>';
	echo '<td>'.$row['prod_created'].'</td>';
	echo '</tr>';
}
echo '
	<tr bgcolor="#cccccc">
		<form action="php/product_edit_form.php" method="post">
		<td colspan="11" align="left">
			Enter ID to Edit:
			<input type="text" name="product_id_toedit" maxlength="3" size="4" />
			<input type="submit" value="EDIT" />
		</td>
		</form>
	</tr>';
echo '</table>';

?>