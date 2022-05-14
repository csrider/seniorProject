<?php 
	//Startup routines
	session_start();
	$admin_user = $_SESSION['admin_user'];
	if(!isset($_SESSION['current_view'])) $_SESSION['current_view'] = 7;

	//Requires and Includes needed for this page
	require_once '../php/fns_display.php';
	require_once '../php/fns_database.php';
	require_once '../php/fns_validate.php';
	
	//Functions
	function get_locs_over($days=7) {
		$query = ('  SELECT cust_id, 
												sa_id, 
												sa_address1, 
												sa_address2, 
												sa_city, 
												sa_state, 
												sa_phone, 
												DATE_FORMAT(sa_created,\'%Y-%m-%d\') sa_created, 
												sa_last_serviced, 
												CURDATE()-sa_last_serviced overdue, 
												sa_status
									 FROM svc_address
									WHERE CURDATE()-sa_last_serviced >= '.$days.'
									   OR sa_status LIKE \'incomplete\'
										 OR sa_status LIKE \'checkout\'
										 OR sa_last_serviced IS NULL
							 GROUP BY svc_address.sa_id
							 ORDER BY sa_last_serviced ASC  ');
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

<body bgcolor="#EEEEEE">
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
					<span style="font-weight:bold; font-size:24px ">Work-Order Management System</span>
				</td>
				<td width="25%" align="right" valign="top">
					<table cellspacing="0" cellpadding="0"><tr><td valign="middle" align="right">Close Work-order Window&nbsp;</td><td valign="middle" align="right"><img onClick="window.close()" src="../images/close_x.jpg" width="18" height="18" /></td></tr></table>
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
					<br /><span style="font-weight:bold; font-size:18px ">Locations Needing Service Today <em>(or soon)</em></span><br />
					<em>(service is normally determined to be needed every 7 days, or if the location is a new customer)</em><br />
					<em>(location will be considered "overdue" if service hasn't been rendered in more than 8 days)</em>
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
				<td align="center" bgcolor="#999999">Cust.</td>
				<td align="center">LocID</td>
				<td align="center">Address</td>
				<td align="center">City</td>
				<td align="center">Phone</td>
				<td align="center">Last Serviced</td>
				<td align="center">Current Status</td>
				<td align="center">Action</td>
			</tr>
			<?php
			//Handle getting the data from the database
				$result = get_locs_over($_SESSION['current_view']);
				$num_rows = $result->num_rows;
				
			//Handle putting the data onto the screen
				for($i=0; $i<$num_rows; $i++) {
					$row = $result->fetch_assoc();
					if ($i % 2)	{	//if there's a remainder of $i / 2 (odd number based off counter variable)
	 					echo '<tr bgcolor="#ffff99">';}	
					else {				//else the counter variable is an even number
						echo '<tr bgcolor="#ffffff">';}
							echo '<td align="center" valign="middle">'.$row['cust_id'].'</td>';
							echo '<td align="center" valign="middle">'.$row['sa_id'].'</td>';
							echo '<td align="left" valign="middle" nowrap>'.$row['sa_address1'].'<br />'.$row['sa_address2'].'</td>';
							echo '<td align="left" valign="middle">'.$row['sa_city'].', '.$row['sa_state'].'</td>';
							echo '<td align="center" valign="middle" nowrap>'.$row['sa_phone'].'</td>';
							echo '<td align="center" valign="middle">';
											if($row['sa_last_serviced']) echo $row['sa_last_serviced'];
											if(!$row['sa_last_serviced']) echo 'Created<br />'.$row['sa_created'];
							echo '</td>';
							
							echo '<td align="center" valign="middle" style="font-weight:bold" nowrap>';
											if ($row['sa_status']=="incomplete")  echo '<span style="color:#cc0000; font-size:15px">INCOMPLETE</span>';
											
											else if ($row['sa_status']=="complete" && $row['overdue']>8)  echo '<span style="color:#000000; font-size:15px">Needs Service</span><br />
																																													<span style="color:#ff0000; font-size:11px; font-weight:normal"><em>(overdue)</em></span>';
											
											else if ($row['sa_status']=="complete" && $row['overdue']<=8)  echo '<span style="color:#000000; font-size:15px">Needs Service</span>';
											
											else if ($row['sa_status']=="checkout" && $row['overdue']>8)  echo '<span style="color:#0000cc; font-size:15px">In Progress</span><br />
																																													<span style="color:#ff0000; font-size:11px; font-weight:normal"><em>(overdue)</em></span>';
											
											else if ($row['sa_status']=="checkout" && $row['overdue']<=8)  echo '<span style="color:#0000cc; font-size:15px">In Progress</span>';
											
											else if (!$row['sa_status'] && !$row['sa_last_serviced'])  echo '<span style="color:#006600; font-size:15px">New Location</span>';
							echo '</td>';
							
							//do NOT change the NAME or VALUE attribute values... they're needed in the proper format for the update SQL to work in action.php
							echo '<td align="center" valign="middle">';
											if($row['sa_status']=="incomplete" || $row['sa_status']=="complete" || !$row['sa_status']) {
												echo '<input type="submit" name="checkout" value="Checkout #'.$row['sa_id'].'" class="checkout">';
											}
											if($row['sa_status']=="checkout") {
												echo '<input type="submit" name="complete" value="#'.$row['sa_id'].' Completed" class="complete">
															<input type="submit" name="incomplete" value="#'.$row['sa_id'].' Not Completed" class="incomplete">';
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
