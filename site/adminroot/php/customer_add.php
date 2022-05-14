<?php

//Start Session
session_start();

//Store what was entered into the session variable (for auto-fills and for later routines)
$_SESSION['cust_fname'] 	 				=	$_POST['cust_fname'];						//subject to the clear_cust() function
$_SESSION['cust_lname'] 	 				=	$_POST['cust_lname'];						//subject to the clear_cust() function
$_SESSION['cust_minitial'] 				=	$_POST['cust_minitial'];				//subject to the clear_cust() function
$_SESSION['cust_suffix'] 	 				=	$_POST['cust_suffix'];					//subject to the clear_cust() function
$_SESSION['cust_address1'] 				= $_POST['cust_address1'];				//subject to the clear_cust() function
$_SESSION['cust_address2'] 				= $_POST['cust_address2'];				//subject to the clear_cust() function
$_SESSION['cust_city'] 		 				=	$_POST['cust_city'];						//subject to the clear_cust() function
$_SESSION['cust_state'] 		 			=	$_POST['cust_state'];						//subject to the clear_cust() function
$_SESSION['cust_zip'] 		 				=	$_POST['cust_zip'];							//subject to the clear_cust() function
$_SESSION['cust_hphone'] 	 				=	$_POST['cust_hphone'];					//subject to the clear_cust() function
$_SESSION['cust_wphone'] 	 				=	$_POST['cust_wphone'];					//subject to the clear_cust() function
$_SESSION['cust_mphone'] 	 				=	$_POST['cust_mphone'];					//subject to the clear_cust() function
$_SESSION['cust_tax_id'] 	 				=	$_POST['cust_tax_id'];					//subject to the clear_cust() function
$_SESSION['numServiceLoc'] 				=	$_POST['numServiceLoc'];				//this is so sa_add_form.php knows how many forms to create
$_SESSION['isBillingServiceLoc'] 	= $_POST['isBillingServiceLoc'];	//this is so we know whether to auto-fill one of the locations
$_SESSION['paym_choice']	 				=	$_POST['paym_choice'];					//this is so sa_add.php knows where to send them at the end of that file
$_SESSION['derived_area_code']		= substr($_POST['cust_hphone'],1,3);
$_SESSION['derived_phone_num']		= substr($_POST['cust_hphone'],5,8);

//Requires and Includes
require_once 'fns_database.php';

//Get admin_user's primary key from the session_variable (will be stored to indicate which user created this customer's record)
$result = dbconnect_newmethod()->query("SELECT admin_user_id FROM admin_user WHERE admin_user_username LIKE '".$_SESSION['admin_user']."'");
for ($i=0; $i<$result->num_rows; $i++) $admin_row = $result->fetch_assoc();

//Check for their information already existing before inserting, to prevent duplicate records
$result = dbconnect_newmethod()->query("SELECT cust_id FROM customer WHERE cust_hphone LIKE '".$_SESSION['cust_hphone']."' AND cust_lname LIKE '".$_SESSION['cust_lname']."'");
for ($i=0; $i<$result->num_rows; $i++) $custid_row = $result->fetch_assoc();
if(isset($custid_row['$cust_id'])) $_SESSION['customer_already_inserted'] = true;
else $_SESSION['customer_already_inserted'] = false;

//Add record to the database if the logged-in administrator is indeed a valid currently logged-in user
if ($_SESSION['admin_user']) {
 if ($_SESSION['customer_already_inserted'] == false) {
	$query = "INSERT INTO customer (
							ctype_id,
							cust_lname,
							cust_fname,
							cust_minitial,
							cust_suffix,
							cust_address1,
							cust_address2,
							cust_city,
							cust_state,
							cust_zip,
							cust_wphone,
							cust_hphone,
							cust_mphone,
							cust_tax_id,
							admin_id,
							cust_created,
							paym_id
						) 
						VALUES (
							'".$_POST['ctype_id']."',
							'".$_POST['cust_lname']."',
							'".$_POST['cust_fname']."',
							'".$_POST['cust_minitial']."',
							'".$_POST['cust_suffix']."',
							'".$_POST['cust_address1']."',
							'".$_POST['cust_address2']."',
							'".$_POST['cust_city']."',
							'".$_POST['cust_state']."',
							'".$_POST['cust_zip']."',
							'".$_POST['cust_wphone']."',
							'".$_POST['cust_hphone']."',
							'".$_POST['cust_mphone']."',
							'".$_POST['cust_tax_id']."',
							'".$admin_row['admin_user_id']."',
							now(),
							1
						)
					";		//**the "1" is default for paper bill - needed for ref. integ. too
	$result = dbconnect_newmethod()->query($query); 	//store this record to the customer table
 }
}
else echo '<h2>Unable to verify your authorization! Record will not be saved to database.</h2><h4>Please <a href="/zmen/adminroot/start.htm">login</a> and try again</h4>';

//Store the newly created cust_id in the session AND pull their name to use for display in the forms that follow
	$result = dbconnect_newmethod()->query("SELECT cust_id FROM customer WHERE cust_hphone LIKE '".$_POST['cust_hphone']."' AND cust_lname LIKE '".$_POST['cust_lname']."'");
	for ($i=0; $i<$result->num_rows; $i++) $custid_row = $result->fetch_assoc();
	$_SESSION['cust_id'] = $custid_row['cust_id'];													//session variable that will store this customer's ID (so all customer tables are associated correctly)
	$_SESSION['cust_name'] = $_POST['cust_fname'].' '.$_POST['cust_lname']; //session variable that will store this customer's name (for display in proceeding forms)


//Check their service information to determine how to handle things from here on
	//if they entered only 1 location and indicated billing is it
	if ($_POST['numServiceLoc'] == 1 && $_POST['isBillingServiceLoc'] == 1) {
		$_SESSION['sa_flag'] = 0;	//set flag to: Use existing session information from form to automatically insert their billing address as a service location (bypass the SA form).
		header("Location: /zmen/adminroot/php/sa_add_form.php");
	}
	//if they entered only 1 location and indicated that billing is NOT it
	else if ($_POST['numServiceLoc'] == 1 && $_POST['isBillingServiceLoc'] == 0) {
		$_SESSION['sa_flag'] = 3; //set flag to: Create a blank form... do NOT fill it in with session information
		header("Location: /zmen/adminroot/php/sa_add_form.php");
	}
	//if they entered more than 1 location and indicated billing is one of them
	else if ($_POST['numServiceLoc'] > 1 && $_POST['isBillingServiceLoc'] == 1) {
		$_SESSION['sa_flag'] = 1;	//set flag to: Provide appropriate number of location forms, and auto-fill the first form with the billing address information contained in session.
		header("Location: /zmen/adminroot/php/sa_add_form.php");
	}
	//if they entered more than 1 location and indicated billing is NOT one of them
	else if ($_POST['numServiceLoc'] > 1 && $_POST['isBillingServiceLoc'] == 0) {
		$_SESSION['sa_flag'] = 2;	//set flag to: Provide appropriate number of location forms, and don't auto-fill billing as any of them.
		header("Location: /zmen/adminroot/php/sa_add_form.php");
	}
	else {
		echo '<script>window.alert("Service Information Error!");</script>';
		echo '<h2>You did not correctly complete the "Service Information" section</h2><h4><a href="/zmen/adminroot/php/customer_add_form.php">Click here to correct this problem</h4>';
		//header("Location: /zmen/adminroot/php/customer_add_form.php");
	}

//*probably need to add some sort of function here that will check to see if the record was save successfully created before proceeding (call it before moving on)

//*probably need to kill all the POST variables here????

?>