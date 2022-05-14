<?php

//Display login screen
function disp_login() {
	echo '
		<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td align="center" valign="top">
					<table width="350" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC">
						<tr align="center" valign="top">
							<td height="77" valign="middle">
								<h1 align="center"><font color="#000099">Z-MEN Lawn Care</font></h1>
							</td>
						</tr>
						<tr align="center" valign="top">
							<td height="61" valign="top">
								<p><font face="Arial, Helvetica, sans-serif"><strong>System Administration Interface</strong></font><font face="Arial, Helvetica, sans-serif"><em><br />
								<font size="-1">Version 0.1</font></em></font></p>
							</td>
						</tr>
						<form name="login" method="post" action="/zmen/adminroot/php/login.php">
			  		<tr>
				  		<td align="center" valign="middle">
								<div align="CENTER"><font face="Courier New, Courier, mono">Username</font>&nbsp;
								<input name="username" type="text" id="username" size="17" maxlength="16" />
								</div>
							</td>
						</tr>
	  				<tr>
		 					<td align="center" valign="middle">
								<div align="CENTER"><font face="Courier New, Courier, mono">Password</font>&nbsp;
									<input name="password" type="password" id="password" size="17" maxlength="16" />
								</div>
							</td>
						</tr>
						<tr>
		  				<td height="50" align="center" valign="top">
								<div align="CENTER">&nbsp;
									<input name="login" type="submit" id="login" value="Login" />
								</div>
							</td>
						</tr>
						</form>
					</table>
				</td>
			</tr>
		</table>
	';
}

//Display logout success
function logout_successful($status) {
	if ($status == 1) {		//if they ARE currently logged-in, then proceed to log them out
		echo '
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td align="center">
						<h2>Log-out Successful</h2>
						<h4><a href="/zmen/adminroot/start.htm">[Log back in]</a></h4>
					</td>
				</tr>
			</table>
		';
	}
	else if ($status == 0) {
		echo '
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td align="center">
						<h2>Already logged-out!</h2>
						<h3>Log-out not necessary</h3>
						<h4><a href="/zmen/adminroot/start.htm">[Log in]</a></h4>
					</td>
				</tr>
			</table>
		';
	}
}

//Display header
function disp_adminheader() {
	echo '
		<table border="0" width="100% align="left">
			<tr>
				<td width="25"></td>
				<td width="165">
					<img src="/zmen/adminroot/images/logo_gray.gif" width="72" height="55" />
				</td>
				<td align="left">
					<h1>Z-MEN Lawn Care Administration</h1>
				</td>
			</tr>
		</table>
	';
}

//Display footer
function disp_adminfooter() {
	echo '
		<table border="0" width="100% align="center">
			<tr>
				<td align="center">
					<h4>Copyright &copy;2005 Z-MEN Lawn Care</h4>
					<h5>Version 1.0 alpha</h5>
				</td>
			</tr>
		</table>
	';
}

//Display menu navigation as a formatted table
function disp_adminmenu() {
	echo '<table align="left" cellpadding="1" cellspacing="0">';
	if ($_SESSION['admin_user']) {
		echo '
			<tr bgcolor="#66CC66"><td align="center"><strong>Logged in as '.$_SESSION['admin_user'].'</strong></td></tr>
			<tr bgcolor="#66CC66"><td align="center"><a href="/zmen/adminroot/php/logout.php">[Log-Out]</a></td></tr>
		';
	}
	else {
		echo '
			<tr bgcolor="#FF6666"><td align="center"><strong>You are not logged in!</strong></td></tr>
			<tr bgcolor="#FF6666"><td align="center"><a href="/zmen/adminroot/start.htm">[Log-in]</a></td></tr>
		';
	}
	echo '
			<tr><td>&nbsp;</td></tr>
			
			<tr class="nav_header"><td align="left">Z-MEN Home</td></tr>
				<tr class="nav_content"><td align="left">&bull;&nbsp;<a class="nav_link" href="/zmen/adminroot/main.php">Intranet</a></td></tr>
				<tr class="nav_content"><td align="left">&bull;&nbsp;<a class="nav_link" href="/zmen/index.php" target="_blank">Website</a></td></tr>
			
			<tr height="8"><td></td></tr>
			
			<tr class="nav_header"><td><strong>Administrative</strong></td></tr>
				<tr class="nav_subhead"><td><em>Business Operations</em></td></tr>
					<tr class="nav_content"><td>&bull;&nbsp;<a class="nav_link" href="/zmen/adminroot/wosys/main.php" target="_blank">Work-Order Management</a></td></tr>
					<tr class="nav_content"><td>&bull;&nbsp;<a class="nav_link" href="/zmen/adminroot/consult/main.php" target="_blank">Consultation Management</a></td></tr>
				<tr class="nav_subhead"><td><em>Reports</em></td></tr>
					<tr class="nav_content"><td>&bull;&nbsp;<a class="nav_link" href="/zmen/adminroot/php/report_all_administrator.php" target="_blank">Administrators</a></td></tr>
					<tr class="nav_content"><td>&bull;&nbsp;<a class="nav_link" href="/zmen/adminroot/php/report_all_customer.php" target="_blank">All Customers</a></td></tr>
					<tr class="nav_content"><td>&bull;&nbsp;<a class="nav_link" href="/zmen/adminroot/php/report_customer_lookup.php">Single Customer</a></td></tr>
					<tr class="nav_content"><td>&bull;&nbsp;<a class="nav_link" href="/zmen/adminroot/php/report_customer_type_lookup.php">Customers of Type</a></td></tr>
			
			<tr height="8"><td></td></tr>
			
			<tr class="nav_header"><td><strong>Customers & Locations</strong></td></tr>
				<tr class="nav_content"><td>&bull;&nbsp;<a class="nav_link" href="/zmen/adminroot/php/customer_add_form.php">New Customer Wizard</a></td></tr>
				<tr class="nav_content"><td>&bull;&nbsp;<a class="nav_link" href="/zmen/adminroot/php/customer_edit_form.php">Edit Existing Customer Info.</a></td></tr>
				<tr class="nav_content"><td>&bull;&nbsp;<a class="nav_link" href="/zmen/adminroot/php/existing_cust_add_sa_form.php">Add Service Location</a></td></tr>
				<tr class="nav_content"><td>&bull;&nbsp;<a class="nav_link" href="/zmen/adminroot/php/existing_cust_add_sap_findform.php">Edit Location/Add Products</a></td></tr>
			
			<tr height="8"><td></td></tr>
			
			<tr class="nav_header"><td><strong>Products</strong></td></tr>
				<tr class="nav_content"><td>&bull;&nbsp;<a class="nav_link" href="/zmen/adminroot/php/product_add_form.php">Add New Product</a></td></tr>
				<tr class="nav_content"><td>&bull;&nbsp;<a class="nav_link" href="/zmen/adminroot/product.php">Edit Existing Product</a></td></tr>
			
			<tr height="8"><td></td></tr>
			
			<tr class="nav_header"><td><strong>Edit Database Info.</strong></td></tr>
				<tr class="nav_content"><td>&bull;&nbsp;<a class="nav_link" href="/zmen/adminroot/ba_type.php">Bank Account Types</a></td></tr>
				<tr class="nav_content"><td>&bull;&nbsp;<a class="nav_link" href="/zmen/adminroot/cc_vendor.php">Credit Card Vendors</a></td></tr>
				<tr class="nav_content"><td>&bull;&nbsp;<a class="nav_link" href="/zmen/adminroot/pay_method.php">Payment Methods</a></td></tr>
				<tr class="nav_content"><td>&bull;&nbsp;<a class="nav_link" href="/zmen/adminroot/customer_type.php">Customer Types</a></td></tr>
				<tr class="nav_content"><td>&bull;&nbsp;<a class="nav_link" href="/zmen/adminroot/prod_type.php">Product Types</a></td></tr>
				<tr class="nav_content"><td>&bull;&nbsp;<a class="nav_link" href="/zmen/adminroot/tip.php">Tips</a></td></tr>
				<tr class="nav_content"><td>&bull;&nbsp;<a class="nav_link" href="/zmen/adminroot/admin.php">Administrators</a></td></tr>
		</table>
	';
}

//Display title bar information for admin pages
function disp_titlebar($admin_user) {
	if ($admin_user) {
		echo '<title>|: Z-MEN Lawn Care System Administration -->'.$admin_user.'<-- :|</title>';
	}
	else if (!$admin_user){
		echo '<title>|: UNAUTHORIZED USER :|</title>';
	}
}

?>