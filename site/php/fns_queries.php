<?php
//START-UP ROUTINES
	session_start();
	require_once 'fns_database.php';


//GET CUSTOMER'S FIRST & LAST NAMES, BASED ON THEIR LOGIN INFORMATION
function get_cust_name() {
	$user_online_record = $_SESSION['user_online_record'];
	$result = dbconnect()->query('  SELECT cust_fname, cust_lname
																		FROM customer
																	 WHERE cust_id = "'.$user_online_record['cust_id'].'"  ');
	$row = $result->fetch_assoc();
	return $row;
}


//GET A RANDOM TIP (returns the actual tip itself - you will need to echo this function to display it)
//This function will accept an optional parameter for ptype_id. If nothing is specified, default will choose random from ALL tips.
//NOTE: You may also specify the string parameter "auto" to automatically choose, depending on the time of the year (season).
function get_random_tip($ptype_id='all') {
	$flag = 0;
	if ($ptype_id=='auto') {
		if (get_current_prodid() == 'no_result') $flag = 1;		//if no product types match the current season, go to the section that selects from all
		else {
			$result = dbconnect()->query('  SELECT tip_text FROM tip WHERE ptype_id = "'.get_current_prodid().'" ORDER BY rand() LIMIT 1  ');
			$row = $result->fetch_assoc();
			return $row['tip_text'];
		}
	}//end if
	else if ($ptype_id=='all' || $flag==1) {
		$result = dbconnect()->query('  SELECT tip_text FROM tip ORDER BY rand() LIMIT 1  ');
		$row = $result->fetch_assoc();
		return $row['tip_text'];
	}//end else if
	else {
		$result = dbconnect()->query('  SELECT tip_text FROM tip WHERE ptype_id = "'.$ptype_id.'" ORDER BY rand() LIMIT 1  ');
		$row = $result->fetch_assoc();
		return $row['tip_text'];
	}//end else
}


//GET THE PRODUCT ID BASED ON THE CURRENT TIME OF THE YEAR (assumes a season-based product type)
function get_current_prodid() {
	$spring_start = "03-20";		//first day of spring (edit as you see fit)
	$summer_start = "06-20";		//first day of summer (edit as you see fit)
	$autumn_start = "09-07";		//first day of autumn (edit as you see fit)
	$winter_start = "12-21";		//first day of winter (edit as you see fit)
	if 			(date("m-d")>=$winter_start && date("m-d")<$spring_start) $current_season = 'winter';
	else if	(date("m-d")>=$spring_start && date("m-d")<$summer_start) $current_season = 'spring';
	else if (date("m-d")>=$summer_start && date("m-d")<$autumn_start) $current_season = 'summer';
	else if (date("m-d")>=$autumn_start && date("m-d")<$winter_start) $current_season = 'autumn';
	$query = ('  SELECT ptype_id
								 FROM prod_type
								WHERE ptype_type LIKE \'%'.$current_season.'%\'  ');
	$result = dbconnect()->query($query);
	if ($result) {
		$row = $result->fetch_assoc();
		return $row['ptype_id'];
	}
	else return 'no_result';
}


//RETURN STATES AS DROP-DOWN LIST OPTIONS (must be called within a <SELECT> tag)
//This function will accept an optional parameter for state_isactive. If nothing is specified, default will choose ALL states. Parameter should be a 0 or a 1.
	function get_states($active='all') {
		if ($active=='all') $query = (' SELECT state_id, state_name, state_abbrev FROM state ');
		else $query = (' SELECT state_id, state_name, state_abbrev FROM state WHERE state_isactive = "'.$active.'" ');
		$result = dbconnect()->query($query);
		for($i; $i<$result->num_rows; $i++) {
			$row = $result->fetch_assoc();
			echo '<option value="'.$row['state_abbrev'].'">'.$row['state_name'].'</option>';
		}
		unset($query, $result, $row);
	}//end function get_states([int active])


//RETURN CREDIT CARD VENDORS AS DROP-DOWN LIST OPTIONS (must be called within a <SELECT> tag)
	function get_ccv() {
		$query = (' SELECT ccv_id, ccv_name FROM cc_vendor ');
		$result = dbconnect()->query($query);
		for($i; $i<$result->num_rows; $i++) {
			$row = $result->fetch_assoc();
			echo '<option value="'.$row['ccv_id'].'">'.$row['ccv_name'].'</option>';
		}
		unset($query, $result, $row);
	}//end function get_ccv()
	

//RETURN BANK ACCOUNT TYPES AS DROP-DOWN LIST OPTIONS (must be called with a <SELECT> tag)
	function get_bat() {
		$query = (' SELECT bat_id, bat_type FROM bank_acct_type ');
		$result = dbconnect()->query($query);
		for($i; $i<$result->num_rows; $i++) {
			$row = $result->fetch_assoc();
			echo '<option value="'.$row['bat_id'].'">'.$row['bat_type'].'</option>';
		}
		unset($query, $result, $row);
	}//end function get_ccv()
	
	
//RETRIEVE CUSTOMER INFORMATION (from customer table)
	function load_customer($cust_id) {
		$query = (' SELECT * FROM customer WHERE cust_id = '.$cust_id.' ');
		$result = dbconnect()->query($query);
		$row = $result->fetch_assoc();
		return $row;
		unset($query, $result, $row);
	}
	
	
//RETRIEVE CUSTOMER_BANK INFORMATION (from customer_bank table)
	function load_customer_bank($cust_id) {
		$query = (' SELECT * FROM customer_bank WHERE cust_id = '.$cust_id.' ');
		$result = dbconnect()->query($query);
		$row = $result->fetch_assoc();
		return $row;
		unset($query, $result, $row);
	}
	
	
//RETRIEVE CUSTOMER_CC INFORMATION (from customer_cc table)
	function load_customer_cc($cust_id) {
		$query = (' SELECT * FROM customer_cc WHERE cust_id = '.$cust_id.' ');
		$result = dbconnect()->query($query);
		$row = $result->fetch_assoc();
		return $row;
		unset($query, $result, $row);
	}
	
//CALCULATE DATE DIFFERENCE IN DAYS


?>