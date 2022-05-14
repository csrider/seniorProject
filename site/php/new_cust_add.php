<?php

require_once 'fns_database.php';

$query = (' INSERT INTO new_customer (
							nc_fname,
							nc_lname,
							nc_address1,
							nc_address2,
							nc_city,
							nc_state,
							nc_dphone,
							nc_email,
							nc_contact_method,
							nc_created,
							nc_created_ip
						)
						VALUES (
							"'.$_POST['nc_fname'].'",
							"'.$_POST['nc_lname'].'",
							"'.$_POST['nc_address1'].'",
							"'.$_POST['nc_address2'].'",
							"'.$_POST['nc_city'].'",
							"'.$_POST['nc_state'].'",
							"'.$_POST['nc_dphone'].'",
							"'.$_POST['nc_email'].'",
							"'.$_POST['nc_contact_method'].'",
							now(),
							"'.$_SERVER['REMOTE_ADDR'].'"
						)
					');//end query

$result = dbconnect()->query($query);

if (!$result) echo 'Error submitting to database';

else if ($result) {
	unset( 	$_SESSION['nc_fname'],
					$_SESSION['nc_lname'],
					$_SESSION['nc_address1'],
					$_SESSION['nc_address2'],
					$_SESSION['nc_city'],
					$_SESSION['nc_state'],
					$_SESSION['nc_dphone'],
					$_SESSION['nc_email'],
					$_SESSION['nc_contact_method'],
					$result
			 );//end unset
	header("Location: new_cust_thanks.php");
}//end else-if
	

?>