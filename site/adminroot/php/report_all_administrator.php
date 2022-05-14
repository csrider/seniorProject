<?php 
session_start();
require_once 'fns_database.php';
$admin_user = $_SESSION['admin_user'];
//require_once 'fns_validate.php';
//admin_check($admin_user);

$result = dbconnect_newmethod()->query("SELECT * FROM admin_user");
$num_results = $result->num_rows;

?>

<!-- saved from url=(0022)http://internet.e-mail -->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Administrators Report</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.style1 {font-size: 18px}
.style4 {font-size: 14px}
body,td,th {
	color: #000000;
}
body {
	background-color: #FFFFFF;
}
.pager_header {font-size: 12px}
-->
</style>
</head>
<body>
<div align="right">
  <table width="100%"  border="0" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
    <tr>
      <td width="50%" height="23"><div align="left"><span class="pager_header">ADMIN USER :</span>
      <?php
	  	echo $admin_user;
	  ?>
      </div></td>
      <td width="50%"><div align="right" class="pager_header"><?php print date("d M Y") ?></div></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div align="right" class="pager_header"><?php print date("g:i") ?></div></td>
    </tr>
  </table>
  <table width="100%"  border="0">
    <tr>
      <td><div align="center" class="style1">Management Report</div></td>
    </tr>
  </table>
  <p>&nbsp;</p>
</div>
<div align="center">
  <table width="100%"  border="0" bordercolor="#FFFFFF" cellspacing="0">
    <tr>
      <td width="12%"><span class="style4">Last Name </span></td>
      <td width="13%"><span class="style4">First Name </span></td>
      <td width="11%"><span class="style4"> Username </span></td>
      <td width="20%"><span class="style4">Password</span></td>
      <td width="12%"><p class="style4">E-mail </p></td>
      <td width="8%"><p class="style4">Level</p></td>
    </tr>
	<tr>
	<td colspan="6"><hr /></td>
	</tr>
	
<?php 
for ($i=0; $i<$num_results; $i++) {
	$row = $result->fetch_assoc();
	if ($i % 2)	{	//if there's a remainder of $i / 2 (odd number based off counter variable)
	 echo '<tr bgcolor="#FFFFCC">';}	
	else {				//else the counter variable is an even number
	 echo '<tr>';}
    echo '<td nowrap>' .$row['admin_user_fname']. '</td>';
	  echo '<td nowrap>' .$row['admin_user_lname']. '</td>';
	  echo '<td nowrap>' .$row['admin_user_username']. '</td>';      
	  echo '<td nowrap>' .$row['admin_user_password']. '</td>';
	  echo '<td nowrap>' .$row['admin_user_email']. '</td>';
	  echo '<td nowrap>' .$row['admin_level']. '</td>';
   echo ' </tr>';
 }
?>
  </table>
</div>
<div align="justify"></div>
</body>
</html>