<?php

//Start Session
session_start();

//Extract the form entry (because of possible multiple locations) into the session array of an appropriate size (dependent upon # of locations entered by customer)
//**Example: If there are 2 locations, there will exist-> $_SESSION['sa_address1_loc1'] -and- $_SESSION['sa_address1_loc2'], each storing their respective address1 line
$db = mysqli_connect('localhost','zmen_webuser','password','zmendev');
$result = $db->query('SELECT prod_id, prod_name FROM product');
mysqli_close($db);
for ($i=1; $i<=$_SESSION['numServiceLoc']; $i++) {
	$_SESSION['sa_address1_loc'.$i.''] 	= $_POST['sa_address1_loc'.$i.''];
	$_SESSION['sa_address2_loc'.$i.''] 	= $_POST['sa_address2_loc'.$i.''];
	$_SESSION['sa_city_loc'.$i.''] 			= $_POST['sa_city_loc'.$i.''];
	$_SESSION['sa_state_loc'.$i.''] 		= $_POST['sa_state_loc'.$i.''];
	$_SESSION['sa_zip_loc'.$i.''] 			= $_POST['sa_zip_loc'.$i.''];
	$_SESSION['sa_area_code_loc'.$i.''] = $_POST['sa_area_code_loc'.$i.''];
	$_SESSION['sa_phone_loc'.$i.''] 		= $_POST['sa_phone_loc'.$i.''];
	for ($j=0; $j<$result->num_rows; $j++) {
		$row = $result->fetch_assoc();
		$_SESSION['prod'.$row['prod_id'].'loc'.$i.'']		=	$_POST['prod'.$row['prod_id'].'loc'.$i.''];
	}
}

//Requires and Includes
require_once 'fns_database.php';

//Get admin_user's primary key from the session_variable (will be stored to indicate which user created this customer's record)
$result = dbconnect_newmethod()->query("SELECT admin_user_id FROM admin_user WHERE admin_user_username LIKE '".$_SESSION['admin_user']."'");
for ($i=0; $i<$result->num_rows; $i++) $admin_row = $result->fetch_assoc();


//Add record to the database if the logged-in administrator is indeed a valid currently logged-in user
if ($_SESSION['admin_user']) {
 for($i=1; $i<=$_SESSION['numServiceLoc']; $i++){			//loop service_address insertions for however many service locations were entered
 
 //insert record into svc_address table for each location (represented as $i)
	$query = "INSERT INTO svc_address (
							cust_id,
							sa_address1,
							sa_address2,
							sa_city,
							sa_state,
							sa_zip,
							sa_area_code,
							sa_phone,
							sa_created,
							sa_last_mod_by
						) 
						VALUES (
							'".$_SESSION['cust_id']."',
							'".$_POST['sa_address1_loc'.$i.'']."',
							'".$_POST['sa_address2_loc'.$i.'']."',
							'".$_POST['sa_city_loc'.$i.'']."',
							'".$_POST['sa_state_loc'.$i.'']."',
							'".$_POST['sa_zip_loc'.$i.'']."',
							'".$_POST['sa_area_code_loc'.$i.'']."',
							'".$_POST['sa_phone_loc'.$i.'']."',
							now(),
							'".$admin_row['admin_user_id']."'
						)
					";//end query
	$result = dbconnect_newmethod()->query($query); 	//store this record to the svc_address table
	
 //insert record into svc_addr_prod table for each product in this location
	$result = dbconnect_newmethod()->query("SELECT sa_id FROM svc_address WHERE cust_id='".$_SESSION['cust_id']."' AND sa_address1 LIKE '".$_POST['sa_address1_loc'.$i.'']."'");
	for ($j=0; $j<$result->num_rows; $j++) $sa_id_row = $result->fetch_assoc();
	if (isset($_POST['prodloc'.$i.''])) { //if they checked at least one product
		foreach($_POST['prodloc'.$i.''] as $prod_id_checked) {		//each loop will pull a single check-marked product and insert a record in sap for each one, and will continue until all checked products are done for this location
			$query = 	"INSERT INTO svc_addr_prod (
									sa_id,
									prod_id,
									sap_date_added,
									sap_added_by
								)
								VALUES (
									'".$sa_id_row['sa_id']."',
									'".$prod_id_checked."',
									now(),
									'".$admin_row['admin_user_id']."'
								)
							";//end query
			$result = dbconnect_newmethod()->query($query);		//store this record to the svc_addr_prod table
		}//end foreach (product)
	}//end if (they checked a product)
	
 }//end for (location)
}//end if
else echo '<h2>Unable to verify your authorization! Record will not be saved to database.</h2><h4>Please <a href="/zmen/adminroot/start.htm">login</a> and try again</h4>';

//*probably need to add some sort of routine here that will check to see if the record was save successfully before proceeding*



//-----THE FOLLOWING CODE DETERMINES WHICH COURSE OF ACTION TO TAKE NEXT, DEPENDING ON WHICH PAYMENT OPTION THEY CHOSE-----
//------it needs the $_POST['paym_choice'] variable set to work

//Paper bill & no online account
if ($_SESSION['paym_choice'] == 0) { 
	clear_cust();
	header("Location: /zmen/adminroot/main.php");
}

//Paper bill & create online account
else if ($_SESSION['paym_choice'] == 1) { 
	clear_cust();
	header("Location: /zmen/adminroot/php/cust_online_add_form.php");
}

//Create online account & offer credit card storage
else if ($_SESSION['paym_choice'] == 2) { 
	//do not clear the session information here yet... it will be needed for the credit card information form (auto-fill)
	//***UPDATE THE PREFERRED PAYMENT APPROPRIATELY HERE???***
	header("Location: /zmen/adminroot/php/cust_onlinecc_add_form.php");
}

//Create online account & offer bank account storage
else if ($_SESSION['paym_choice'] == 3) { 
	//do not clear the session information here yet... it will be needed for the bank account information form (auto-fill)
	//***UPDATE THE PREFERRED PAYMENT APPROPRIATELY HERE???***
	header("Location: /zmen/adminroot/php/cust_onlineba_add_form.php");
}

//Function to clear out the session variables that were stored to remember form values (no longer needed at this stage)
function clear_cust() {
	$_SESSION['cust_fname'] 	 =	"";
	$_SESSION['cust_lname'] 	 =	"";
	$_SESSION['cust_minitial'] =  "";
	$_SESSION['cust_suffix'] 	 =	"";
	$_SESSION['cust_address1'] =  "";
	$_SESSION['cust_address2'] =  "";
	$_SESSION['cust_city'] 		 =	"";
	$_SESSION['cust_zip'] 		 =	"";
	$_SESSION['cust_hphone'] 	 =	"";
	$_SESSION['cust_wphone'] 	 =	"";
	$_SESSION['cust_mphone'] 	 =	"";
	$_SESSION['cust_tax_id'] 	 =	"";
}

?>