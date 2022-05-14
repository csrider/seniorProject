<?php

//Start Session
session_start();
$admin_user = $_SESSION['admin_user'];
require_once 'fns_validate.php';
	
//Requires and Includes
require_once 'fns_database.php';

/*
//Store info to the session temporarily
$_SESSION['cust_hphone'] = $_POST['cust_hphone'];
if (isset($_POST['sa_addr1'])) $_SESSION['sa_addr1'] = $_POST['sa_addr1'];
if (isset($_POST['sa_addr2'])) $_SESSION['sa_addr2'] = $_POST['sa_addr2'];
if (isset($_POST['sa_city'])) $_SESSION['sa_city'] = $_POST['sa_city'];
if (isset($_POST['sa_state'])) $_SESSION['sa_state'] = $_POST['sa_state'];
if (isset($_POST['sa_zip'])) $_SESSION['sa_zip'] = $_POST['sa_zip'];
if (isset($_POST['sa_area_code'])) $_SESSION['sa_area_code'] = $_POST['sa_area_code'];
if (isset($_POST['sa_phone'])) $_SESSION['sa_phone'] = $_POST['sa_phone'];
*/


//Insert a new svc_address record for this particular customer
if(isset($_POST['verify_edit'])){
$query =	'UPDATE svc_address (
				   	cust_id, 
						sa_address1, 
					 	sa_address2, 
					 	sa_city, 
					 	sa_state, 
					 	sa_zip, 
					 	sa_area_code, 
					 	sa_phone, 
					 	sa_created
					) 
					VALUES (
						'.$cust_id.', 
						"'.$_POST['sa_addr1'].'", 
						"'.$_POST['sa_addr2'].'", 
						"'.$_POST['sa_city'].'", 
						"'.$_POST['sa_state'].'", 
						"'.$_POST['sa_zip'].'", 
						"'.$_POST['sa_area_code'].'", 
						"'.$_POST['sa_phone'].'", 
						now()
					)
				';//end query
$result = dbconnect_newmethod()->query($query);
unset($query, $result);
}
//Insert a new svc_addr_prod record for this particular location
if (count($_POST['prodid[]']>0)) { //if they checked at least one product
	foreach ($_POST['prodid'] as $prod_id) {
		$query =	'INSERT INTO svc_addr_prod (
								sa_id,
								prod_id,
								sap_date_added,
								sap_added_by
							)
							VALUES (
								"'.$_SESSION['sa_id'].'",
								'.$prod_id.',
								now(),
								'.$_SESSION['admin_id'].'
							)
						';//end query
		$result = dbconnect_newmethod()->query($query);
	}//end foreach
}//end if	

header("Location: /zmen/adminroot/main.php" );		//Redirect back to page
	
?>
