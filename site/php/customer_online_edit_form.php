<?php 
session_start();
require_once 'fns_database.php';
require_once 'fns_display.php';
$_SESSION['customer_id'] = 1;

$customer_online = $_SESSION['user_online_record'];
$customer_online['cust_id'];

$query = "SELECT * FROM customer_online 
     		WHERE cust_id = '".$customer_online['cust_id']."' ";
		$result = dbconnect()->query($query);
		for ($i=0; $i<$result->num_rows; $i++) $customer_online = $result->fetch_assoc();
		$_SESSION['customer_online'] = $customer_online;



?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link REL="StyleSheet" TYPE="text/css" HREF="/zmen/adminroot/css/admin.css">
<title>Update Customer Information</title>



<style type="text/css">
<!--
.style3 {font-size: xx-large}
.header {font-weight:bold; font-variant:small-caps;}
.header1 {font-style:italic; vertical-align:bottom;}
.header2 {font-variant:small-caps;}
-->
</style>



</head>

<body bgcolor="#EEEEEE">
<table border="0">
<!--header begin-->
<tr>
<table width="100%"  border="0" cellpadding="0" cellspacing="0"><!--table one-->
      <tr>
        <td align="center">
          <table border="0" cellpadding="0" cellspacing="0" width="100%">
		  
            <tr>
              <td align="left" valign="top" class="style3" height="15px" bgcolor="#5ca758"><font color="#FFFF00">Z-MEN Lawn Care<br />Edit Customer Online Information</font></td>
              <td width="150" align="right" valign="top" height="15px"  bgcolor="#5ca758"><img src="../images/logo_yellow.gif" width="97" height="59"><br />
              <font color="#FFFF00"><b><?php print date("F   d, Y  ") ?></b></font></td>
            </tr>
		</table>
		</td>
	  </tr>
</table>
</tr>
<tr><hr color="#FFFF00"></tr>
<!--header end-->

<form action="customer_online_edit.php" method="post" name="customer_edit_form">
<div align="center"><table border="1" bordercolor="#5ca758">

<tr><td align="center">
<!--body begin-->

<table border="0" bordercolorlight="#5ca758" align="center" bgcolor="#FFFFCC">
  <tr>
  	<td colspan="2" align="center"><font size="+2" color="#5ca758">Update Online Account Access</font></td>
  </tr>
  <tr>
  	<td colspan="2" align="center" class="required">(Required Fields Have Red Labels)</td>
  </tr>
  <tr>
	<td align="right" class="required">Username :&nbsp;</td>
	<td align="left"><input type="text" name="custo_username" maxlength="16" size="17" value="<?php echo $customer_online['custo_username']; ?>"  />&nbsp;maximum of 16 characters</td>
  </tr>
  
  <tr>
	<td align="right" class="required">Password :&nbsp;</td>
	<td align="left"><input type="text" name="custo_password" maxlength="16" size="17" value="<?php echo $customer_online['custo_password']; ?>" />&nbsp;maximum of 16 characters</td>
  </tr>
  
  <tr>
	<td align="right">E-Mail Address : &nbsp;</td>
	<td align="left"><input type="text" name="custo_email" maxlength="64" size="50" value="<?php echo $customer_online['custo_email']; ?>" /></td>
  </tr>
  
  		<?php //code to interpret 0 or 1 into human-friendly terms
					if (!isset($customer_online['custo_promotions'])) $ap = '';
					else if ($customer_online['custo_promotions'] == 0) $ap = 'No';
					else if ($customer_online['custo_promotions'] == 1) $ap = 'Yes';
		?>
  
  <tr>
	<td align="right" class="required">Accept Promotions : &nbsp;</td>
	<td align="left" valign="top"><input type="hidden" readonly="true" name="custo_promotions" value="<?php $customer_online['custo_promotions']; ?>" />
					 <strong><?php echo $ap; ?></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(change):
				<label><input type="radio" name="custo_promotions" value="1" <?php echo $_SESSION['disable_customer_online']; ?> />Yes, accept promotions</label>&nbsp;&nbsp;
				<label><input type="radio" name="custo_promotions" value="0" <?php echo $_SESSION['disable_customer_online']; ?> />No, do not accept</label></td>
  </tr>
  
  <tr height="12"></tr>
  <tr>
  	<td align="center" colspan="2"><input type="submit" value="Update Customer Information" /></td>
  </tr>
	<tr>
		<td align="center" colspan="2"><br /><a href="../index.php" style="font-weight:bold; font-size:14px; color:#0000CC ">Or click here to CANCEL and go back home</a></td>
	</tr>
  
</table>

<!--body end-->
</td></tr>
</table></div>
</form>

<!--footer-->
<tr>
<?php display_footer1(); ?>
</tr>
<!--footer end-->
</table>
</body>
</html>
