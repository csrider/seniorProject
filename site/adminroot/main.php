<?php 
	//Startup routines
	session_start();
	$admin_user = $_SESSION['admin_user'];
	
	//Requires and Includes needed for this page
	require_once 'php/fns_display.php';
	require_once 'php/fns_database.php';
	require_once 'php/fns_validate.php';
	
	//Check that they are properly logged-in before loading this page	
	admin_check($admin_user);
	
	//Code used to store selected record as an array to use as dynamic elements in this page
	$result = dbconnect_newmethod()->query("SELECT * FROM admin_user WHERE admin_user_username='".$admin_user."'");
	for ($i=0; $i<$result->num_rows; $i++) $row1 = $result->fetch_assoc();		//results are stored as an array called $row1[]
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<?php disp_titlebar($admin_user); ?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link REL="StyleSheet" TYPE="text/css" HREF="/zmen/adminroot/css/admin.css">
</head>

<body>

<?php disp_adminheader();?>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td width="200" valign="top"><?php disp_adminmenu(); ?></td>
		<td valign="top" align="left">
			<h3>Welcome <?php echo $row1['admin_user_fname']; ?></h3>
			<h5>The intranet site is currently undergoing extensive development while Z-Men creates its new web-presence and database system.</h5>
			<h5>Please select an option from the menu.</h5>
			<!-- Start Weather -->
				<table border="0" width="100%"><tr><td align="left">
					<table border="1" bgcolor="#CCCCCC"><tr><td>
					<a href="http://www.weatherforyou.com/weather/Indiana/Evansville.html" target="_blank">
					<img src="http://www.weatherforyou.net/fcgi-bin/hw3/hw3.cgi?config=png&forecast=zone&alt=hwizone7day5&place=Evansville&state=in&hwvbg=transparent&hwvtc=black&hwvdisplay=Evansville+Tri-State+Area&daysonly=1&maxdays=7" border="0" width="500" height="200" alt="Weather magnet currently unavailable. Hit refresh or click here to see the weather instead"></a>
					</td></tr></table>
				</td></tr></table>
			<!-- End Weather -->
		</td>
	</tr>
</table>

<br />

<?php disp_adminfooter(); ?>

</body>

</html>