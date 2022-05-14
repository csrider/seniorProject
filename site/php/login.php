<?php

//START-UP ROUTINES
	session_start();
	require_once 'fns_database.php';
	
//RUN A QUERY TO CHECK THEIR LOGIN CREDENTIALS AGAINST THE DATABASE
	$result = dbconnect()->query('  SELECT *
																	  FROM customer_online
																   WHERE custo_username = "'.$_POST['custo_username'].'"
																     AND custo_password = "'.$_POST['custo_password'].'"  ');
	$row = $result->fetch_assoc();
	
//DEPENDING ON THE RESULT, EITHER LOG THEM IN, OR ERR-OUT IN SOME WAY
	if ($row) {																			//IF there was a result from the query (implies correct credentials) THEN...
		$_SESSION['user_online_record'] = $row;							//transfer the record to the session, for use in other pages
		record_login($row);																	//records the last_accessed info, in the customer_online table
		header("Location: ../index.php" );									//redirect to the private index page (only for logged-in users)
	}
	else {																							//ELSE there was no result returned from the query (bad credentials) THEN...
		//could put a routine here, to log any bad login attempts
		login_error();																			//execute the login-error function, offering them options of what to do next
	}

//FUNCTION TO RECORD THE 'LAST ACCESSED' INFORMATION FOR THEIR LOGIN, IN THE CUSTOMER_ONLINE TABLE
	function record_login($row) {
		$result = dbconnect()->query('  UPDATE customer_online
																	     SET custo_last_access = now(),
																			 		 custo_last_access_ip = "'.$_SERVER['REMOTE_ADDR'].'"
																		 WHERE cust_id = "'.$row['cust_id'].'"  ');
	}
	
//FUNCTION TO DEAL WITH A BAD LOGIN ATTEMPT
	function login_error() {
		echo '<script>window.alert("The username/password combination of \"'.$_POST['custo_username'].' / '.$_POST['custo_password'].'\" is not valid.\nPlease click OK to go back and try again.");</script>';
		echo '<h1 align="center"><a href="../index.php">Click Here to Try Again</a></h1>';
	}

//CLEAN-UP ROUTINES
	unset($row, $result);																	//clears out the variables that were used, that are no longer needed

?>