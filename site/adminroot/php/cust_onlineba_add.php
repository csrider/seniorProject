<?php

//Start Session
session_start();

//Store what was entered into the session variable (to prevent having to fill out the form all over again if they have to go back)
//***Later, you can probably put all these into a nested array within the session array*** (makes it easier to clear the variables when done)
$_SESSION['custo_username'] 	=	$_POST['custo_username'];
$_SESSION['custo_password'] 	=	$_POST['custo_password'];
$_SESSION['custo_email'] 			= $_POST['custo_email'];
$_SESSION['custo_promotions'] =	$_POST['custo_promotions'];

//Requires and Includes
require_once 'fns_database.php';

//Get ADMIN user's primary key from the session_variable (admin_user string - we need the number)
$result = dbconnect_newmethod()->query("SELECT admin_user_id FROM admin_user WHERE admin_user_username LIKE '".$_SESSION['admin_user']."'");
for ($i=0; $i<$result->num_rows; $i++) $admin_row = $result->fetch_assoc();
	
//Add record to the database if valid user
if ($_SESSION['admin_user']) {
	$query = "INSERT INTO customer_online (
							cust_id,
							custo_username,
							custo_password,
							custo_email,
							custo_promotions,
							custo_created,
							custo_create_ip,
							custo_last_mod_by
						) 
						VALUES (
							'".$_SESSION['cust_id']."',
							'".$_POST['custo_username']."',
							'".$_POST['custo_password']."',
							'".$_POST['custo_email']."',
							'".$_POST['custo_promotions']."',
							now(),
							'".$_SERVER['REMOTE_ADDR']."',
							'".$admin_row['admin_user_id']."'
						)
					";
	$result = dbconnect_newmethod()->query($query);
	if ($_POST['bat_id'] != 0) {	//value of "0" means they didn't want to store any bank account information (didn't select a type)
		$query = "INSERT INTO customer_bank (
		          	cust_id,
								custbank_address1,
								custbank_address2,
								custbank_city,
								custbank_state,
								custbank_zip,
								custbank_bank,
								bat_id,
								custbank_routing,
								custbank_account,
								custbank_created,
								custbank_created_ip,
								custbank_last_mod_by
							)
							VALUES (
								'".$_SESSION['cust_id']."',
								'".$_POST['custbank_address1']."',
								'".$_POST['custbank_address2']."',
								'".$_POST['custbank_city']."',
								'".$_POST['custbank_state']."',
								'".$_POST['custbank_zip']."',
								'".$_POST['custbank_bank']."',
								'".$_POST['bat_id']."',
								'".$_POST['custbank_routing']."',
								'".$_POST['custbank_account']."',
								now(),
								'".$_SERVER['REMOTE_ADDR']."',
								'".$admin_row['admin_user_id']."'
							)
						";
		$result = dbconnect_newmethod()->query($query);
	}
}
else echo '<h2>Unable to verify your authorization! Record will not be saved to database.</h2><h4>Please <a href="/zmen/adminroot/start.htm">login</a> and try again</h4>';

//Clear session information, because record should have been successfully stored & go back to menu
clear_cust();
header("Location: /zmen/adminroot/main.php");


function clear_cust() {
	$_SESSION['custo_username'] 	=	"";
	$_SESSION['custo_password'] 	=	"";
	$_SESSION['custo_email'] 			= "";
	$_SESSION['custo_promotions'] =	"";
	$_SESSION['cust_fname'] 	 =	"";
	$_SESSION['cust_lname'] 	 =	"";
	$_SESSION['cust_minitial'] =  "";
	$_SESSION['cust_suffix'] 	 =	"";
	$_SESSION['cust_address1'] =  "";
	$_SESSION['cust_address2'] =  "";
	$_SESSION['cust_city'] 		 =	"";
	$_SESSION['cust_state'] 		=	"";
	$_SESSION['cust_zip'] 		 =	"";
	$_SESSION['cust_hphone'] 	 =	"";
	$_SESSION['cust_wphone'] 	 =	"";
	$_SESSION['cust_mphone'] 	 =	"";
	$_SESSION['cust_tax_id'] 	 =	"";
}
?>