<?php

require_once 'fns_database.php';


//Function to check whether the user is logged in properly
function admin_check($admin_user){
	if(!$admin_user){
		header("Location: /zmen/adminroot/start.htm");
	}//end if
}//end function admin_check
		
		
//Function to check an admin-user's clearance level
function check_clearance($option) {
	//get admin-user's access level from the database
		$result = dbconnect_newmethod()->query('SELECT admin_level FROM admin_user WHERE admin_user_username LIKE "'.$_SESSION['admin_user'].'"');
		$row = $result->fetch_assoc();
		unset($result);
	//test for delete priv
		if ($option=='delete' && $row['admin_level']<=1) return true;
		else if ($option=='delete' && $row['admin_level']>1) return false;
	//test for edit priv
		else if ($option=='edit' && $row['admin_level']<=2) return true;
		else if ($option=='edit' && $row['admin_level']>2) return false;
	//test for add priv
		else if ($option=='add' && $row['admin_level']<=3) return true;
		else if ($option=='add' && $row['admin_level']>3) return false;
	//test for view priv
		else if ($option=='view' && $row['admin_level']<=4) return true;
		else if ($option=='view' && $row['admin_level']>4) return false;
	//else fail out completely
		else echo'ERROR IN FUNCTION "check_clearance"... check parameters and try again.';
	//cleanup
		unset($row, $admin_user, $option);
}//end function check_clearance


?>