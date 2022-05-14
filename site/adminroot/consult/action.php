<?php

//STARTUP STUFF
require_once '../php/fns_database.php';


//VALUES USED IN THE POSTING PAGE
//  "Checkout #0"
//  "#0 Completed"
//  "#0 Not Completed"

//TAKE ACTION, DEPENDING ON WHICH BUTTON THEY CLICKED
if(isset($_POST['checkout'])) {					//if they clicked the "Checkout" button for a location (stored in the posted value)
$query = ('  UPDATE new_customer
								SET nc_status = "checkout"
							WHERE nc_id = "'.substr($_POST['checkout'],10).'"  ');
}

else if(isset($_POST['complete'])) {		//if they clicked the "Completed" button for a location (stored in the posted value)
$strlength = strlen($_POST['complete']);
$query = ('  UPDATE new_customer
								SET nc_updated = "'.date("Y-m-d").'",
										nc_status = "complete"
							WHERE nc_id = "'.substr($_POST['complete'],1,$strlength-11).'"  ');
}

else if(isset($_POST['incomplete'])) {	//if they clicked the "Not Completed" button for a location (stored in the posted value)
$strlength = strlen($_POST['incomplete']);
$query = ('  UPDATE new_customer
								SET nc_status = "incomplete"
							WHERE nc_id = "'.substr($_POST['incomplete'],1,$strlength-15).'"  ');
}


//SUBMIT THE ACTION TO THE DATABASE
$result = dbconnect_newmethod()->query($query);


header("Location: /zmen/adminroot/consult/main.php" );

?>