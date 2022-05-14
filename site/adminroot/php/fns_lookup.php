<?php

//MAYBE A BETTER WAY TO HAVE DONE THIS WOULD HAVE BEEN TO RETURN THE $result OBJECT... LOOPING IT OUT IN THE CALLING FILE...
//THAT WAY, YOU WOULDN'T BE RESTRICTED TO HAVING TO USE THESE FUNCTIONS IN A <select> TAG.

//Requires & Includes
require_once 'fns_database.php';

//Lookup customer types
function lookup_ctype() {
	$result = dbconnect_newmethod()->query('SELECT ctype_id, ctype_type FROM customer_type');
	for ($i=0; $i<$result->num_rows; $i++) {
		$row = $result->fetch_assoc();
		echo '<option value="'.$row['ctype_id'].'">'.$row['ctype_type'].'</option>';
	}
}

//Lookup payment methods
function lookup_paym() {
	$result = dbconnect_newmethod()->query('SELECT paym_id, paym_name FROM pay_method');
	for ($i=0; $i<$result->num_rows; $i++) {
		$row = $result->fetch_assoc();
		echo '<option value="'.$row['paym_id'].'">'.$row['paym_name'].'</option>';
	}
}

//Lookup credit card vendors
function lookup_ccv() {
	$result = dbconnect_newmethod()->query('SELECT ccv_id, ccv_name FROM cc_vendor');
	for ($i=0; $i<$result->num_rows; $i++) {
		$row = $result->fetch_assoc();
		echo '<option value="';
			echo $row['ccv_id'];
			echo '">';
			echo $row['ccv_name'];
		echo '</option>\n';
	}
}

//Lookup bank account types
function lookup_bat() {
	$result = dbconnect_newmethod()->query('SELECT bat_id, bat_type FROM bank_acct_type');
	for ($i=0; $i<$result->num_rows; $i++) {
		$row = $result->fetch_assoc();
		echo '<option value="';
			echo $row['bat_id'];
			echo '">';
			echo $row['bat_type'];
		echo '</option>\n';
	}
}

//Lookup product types
function lookup_ptype() {
	$result = dbconnect_newmethod()->query('SELECT ptype_id, ptype_type FROM prod_type');
	for ($i=0; $i<$result->num_rows; $i++) {
		$row = $result->fetch_assoc();
		echo '<option value="';
			echo $row['ptype_id'];
			echo '">';
			echo $row['ptype_type'];
		echo '</option>\n';
	}
}

?>