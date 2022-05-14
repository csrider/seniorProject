<?php 
	//Startup routines
	session_start();
	$admin_user = $_SESSION['admin_user'];

	//Requires and Includes needed for this page
	require_once '../php/fns_display.php';
	require_once '../php/fns_database.php';
	require_once '../php/fns_validate.php';
	
	//Functions
	function get_consults() {
		$query = ('  SELECT nc_id, 
												nc_fname, 
												nc_lname,
												nc_address1, 
												nc_address2, 
												nc_city, 
												nc_state, 
												nc_dphone, 
												nc_email,
												nc_contact_method,
												DATE_FORMAT(nc_created,\'%m/%d/%y\') nc_created, 
												DATE_FORMAT(nc_updated,\'%m/%d/%y\') nc_updated, 
												nc_status
									 FROM new_customer
									WHERE nc_status LIKE \'incomplete\'
										 OR nc_status LIKE \'checkout\'
										 OR nc_status IS NULL 
										 OR nc_updated IS NULL
							 ORDER BY nc_created ASC  ');
		$result = dbconnect_newmethod()->query($query);
		return $result;
	}	

	//Check that they are properly logged-in before loading this page	
	admin_check($admin_user);
	
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
<title>Z-Men Work-Order System --><?php echo $admin_user; ?><--</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link REL="StyleSheet" TYPE="text/css" HREF="/zmen/adminroot/css/admin.css">
</head>

<body bgcolor="#EEEEEE" leftmargin="1" rightmargin="1" topmargin="1">
<table width="100%">

<!--Page Header Information-->
<tr><td>
		<table width="100%">
			<tr>
				<td width="25%" align="left" valign="top">
					<?php echo date("F j, Y"); ?><br />
					<?php echo date("g:i a"); ?>&nbsp;<em>(last refreshed)</em>
				</td>
				<td width="50%" align="center">
					<span style="font-weight:bold; font-size:32px ">Z-MEN Lawn Care</span><br />
					<span style="font-weight:bold; font-size:24px ">Consultation Management System</span>
				</td>
				<td width="25%" align="right" valign="top">
					<table cellspacing="0" cellpadding="0"><tr><td valign="middle" align="right">Close Window&nbsp;</td><td valign="middle" align="right"><img onClick="window.close()" src="../images/close_x.jpg" width="18" height="18" /></td></tr></table>
					<em>LOGGED IN:</em>&nbsp;&nbsp;<?php echo $admin_user; ?>
				</td>
			</tr>
		</table>
</td></tr>

<!--Page Heading/Title-->
<tr><td>
		<table width="100%">
			<tr>
				<td align="center">
					<br /><span style="font-weight:bold; font-size:18px ">Consultation Requests</span><br />
				</td>
			</tr>
		</table>
</td></tr>

<!--Queue-->
<tr><td align="center">
		<form action="action.php" method="post">
		<table border="1"><tr><td>
		<table cellpadding="1" cellspacing="0" border="1">
			<tr bgcolor="#000000" style="font-weight:bold; color:#FFFFFF; font-size:14px ">
				<td align="center">ID</td>
				<td align="center">Name</td>
				<td align="center">Address</td>
				<td align="center">Location</td>
				<td align="center">Contact</td>
				<td align="center">Created</td>
				<td align="center">Updated</td>
				<td align="center">Status</td>
				<td align="center">Action</td>
			</tr>
			<?php
			//Handle getting the data from the database
				$result = get_consults();
				$num_rows = $result->num_rows;
				
			//Handle putting the data onto the screen
				for($i=0; $i<$num_rows; $i++) {
					$row = $result->fetch_assoc();
					if ($i % 2)	{	//if there's a remainder of $i / 2 (odd number based off counter variable)
	 					echo '<tr bgcolor="#ffff99">';}	
					else {				//else the counter variable is an even number
						echo '<tr bgcolor="#ffffff">';}
							echo '<td align="center" valign="middle">'.$row['nc_id'].'</td>';
							echo '<td align="left" valign="middle">'.$row['nc_fname'].'<br />'.$row['nc_lname'].'</td>';
							echo '<td align="left" valign="middle" nowrap>'.$row['nc_address1'].'<br />'.$row['nc_address2'].'</td>';
							echo '<td align="center" valign="middle" nowrap>'.$row['nc_city'].'<br />'.$row['nc_state'].'</td>';
							echo '<td align="center" valign="middle" nowrap>';
								if($row['nc_contact_method']=='phone') echo '<span style="font-weight:bold; color:#0000AA">'.$row['nc_dphone'].'</span></td>';
								if($row['nc_contact_method']=='email') echo '<a href="mailto:'.$row['nc_email'].'" style="font-weight:bold; color:#0000AA">'.$row['nc_email'].'</a></td>';
							echo '<td align="center" valign="middle" nowrap>'.$row['nc_created'].'</td>';
							echo '<td align="center" valign="middle" nowrap>'.$row['nc_updated'].'</td>';
							echo '<td align="center" valign="middle" style="font-weight:bold">';
								if (!$row['nc_status'])  echo '<span style="color:#006600; font-size:14px">New</span>';
								if ($row['nc_status']=='incomplete') echo '<span style="color:#CC0000; font-size:14px">Incomplete</span>';
								if ($row['nc_status']=='checkout') echo '<span style="color:#0000AA; font-size:14px">In Progress</span>';
							echo '</td>';
						//do NOT change the NAME or VALUE attribute values... they're needed in the proper format for the update SQL to work in action.php
							echo '<td align="center" valign="middle">';
								if($row['nc_status']=="incomplete" || $row['nc_status']=="complete" || !$row['nc_status']) {
									echo '<input type="submit" name="checkout" value="Checkout #'.$row['nc_id'].'" class="checkout">';
								}
								if($row['nc_status']=="checkout") {
									echo '<input type="submit" name="complete" value="#'.$row['nc_id'].' Completed" class="complete">
												<input type="submit" name="incomplete" value="#'.$row['nc_id'].' Not Completed" class="incomplete">';
								}
							echo '</td>';
							
						echo '</tr>';
				}//end for
			?>
		</table>
		</td></tr></table>
		</form>
</td></tr>

<!--Page Footer Information-->
<tr><td>
</td></tr>

</table>
</body>

</html>
