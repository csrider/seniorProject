<?php //Startup code
	session_start();
	$admin_user = $_SESSION['admin_user'];
	require_once 'fns_display.php';
	require_once 'fns_database.php';
	require_once 'fns_validate.php';
?>
<?php admin_check($admin_user); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<?php disp_titlebar($admin_user); ?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link REL="StyleSheet" TYPE="text/css" HREF="/zmen/adminroot/css/admin.css">
<script type='text/javascript'>
	var n;
	var p;
	var p1;
	function ValidatePhone() {
		p=p1.value
		if(p.length==3) {
			//d10=p.indexOf('(')
			pp=p;
			d4=p.indexOf('(')
			d5=p.indexOf(')')
			if(d4==-1) {pp="("+pp;}
			if(d5==-1) {pp=pp+")";}
			//pp="("+pp+")";
			document.add_service_address_to_existing_customer.cust_hphone.value="";
			document.add_service_address_to_existing_customer.cust_hphone.value=pp;
		}
		if(p.length>3) {
			d1=p.indexOf('(')
			d2=p.indexOf(')')
			if (d2==-1) {
				l30=p.length;
				p30=p.substring(0,4);
				//alert(p30);
				p30=p30+")"
				p31=p.substring(4,l30);
				pp=p30+p31;
				//alert(p31);
			document.add_service_address_to_existing_customer.cust_hphone.value="";
			document.add_service_address_to_existing_customer.cust_hphone.value=pp;
			}
		}
		if(p.length>5) {
			p11=p.substring(d1+1,d2);
			if(p11.length>3) {
				p12=p11;
				l12=p12.length;
				l15=p.length
				//l12=l12-3
				p13=p11.substring(0,3);
				p14=p11.substring(3,l12);
				p15=p.substring(d2+1,l15);
				document.add_service_address_to_existing_customer.cust_hphone.value="";
				pp="("+p13+")"+p14+p15;
				document.add_service_address_to_existing_customer.cust_hphone.value=pp;
				//obj1.value="";
				//obj1.value=pp;
			}
		l16=p.length;
		p16=p.substring(d2+1,l16);
		l17=p16.length;
		if(l17>3&&p16.indexOf('-')==-1) {
			p17=p.substring(d2+1,d2+4);
			p18=p.substring(d2+4,l16);
			p19=p.substring(0,d2+1);
			//alert(p19);
			pp=p19+p17+"-"+p18;
			document.add_service_address_to_existing_customer.cust_hphone.value="";
			document.add_service_address_to_existing_customer.cust_hphone.value=pp;
			//obj1.value="";
			//obj1.value=pp;
		}
	}
	setTimeout(ValidatePhone,100)
	}
	
	function getIt(m) {
		n=m.name;
		//p1=document.forms[0].elements[n]
		p1=m
		ValidatePhone()
	}
	
	function testphone(obj1) {
		p=obj1.value
		//alert(p)
		p=p.replace("(","")
		p=p.replace(")","")
		p=p.replace("-","")
		p=p.replace("-","")
		//alert(isNaN(p))
		if (isNaN(p)==true) {
			alert("Check phone");
			return false;
		}
	}
</script>
<link href="../css/admin.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php disp_adminheader(); ?>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<!--menu nav-->
		<td width="200" valign="top"><?php disp_adminmenu(); ?></td>
		
		<!--body-->
		<td valign="top" align="left">		
			<form action="existing_cust_add_sa.php" method="post" name="add_service_address_to_existing_customer">
			
			
			<table border="1" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC">
				<tr><td colspan="2">
				<table border="0" cellpadding="1" cellspacing="1">
					<tr><td colspan="2" bgcolor="#CCCCCC" height="35" align="center"><h3>Add Service Address/Location To An Existing Customer</h3></td></tr>
					<tr><td colspan="2" class="sec_header" align="center">Enter existing customer's primary phone (usually evening home)<br />to store this new location for them.</td></tr>
					
					<tr>
						<td align="right" class="required"><strong>CUSTOMER'S HOME PHONE :</strong> &nbsp; </td>
						<td align="left">
							<input type="text" value="<?php echo $_SESSION['cust_hphone']; ?>" name="cust_hphone" onfocus="javascript:getIt(this)" maxlength="13" />&nbsp;&nbsp;
							<span class="example">(might differ from the location's phone)</span>
						</td>
					</tr>
					<tr><td align="center" colspan="2"><hr /></td></tr>
					<tr>
						<td align="right" class="required">Location's Address 1: &nbsp; </td>
						<td align="left"><input type="text" name="sa_addr1" maxlength="64" size="65" /></td>
					</tr>
					<tr>
						<td align="right">Location's Address 2: &nbsp; </td>
						<td align="left"><input type="text" name="sa_addr2" maxlength="64" size="65" /></td>
					</tr>
					<tr>
						<td align="right" class="required">Location's City : &nbsp; </td>
						<td align="left"><input type="text" name="sa_city" maxlength="32" size="33" /></td>
					</tr>
					<tr>
						<td align="right" class="required">Location's State: &nbsp; </td>
						<td align="left">
							<select name="sa_state">
								<option value="">- SELECT -</option>
								<option value="IL">Illinois</option>
								<option value="IN">Indiana</option>
								<option value="KY">Kentucky</option>
					 		</select>
						</td>
					</tr>
					<tr>
						<td align="right" class="required">Location's Zip : &nbsp; </td>
						<td align="left"><input type="text" name="sa_zip" maxlength="10" size="11" /></td>
					</tr>
					<tr>
						<td align="right" class="required">Location's Area Code : &nbsp; </td>
						<td align="left"><input type="text" name="sa_area_code" maxlength="3" size="4" /></td>
					</tr>
					<tr>
						<td align="right" class="required">Location's Phone Number: &nbsp; </td>
						<td align="left">
							<input type="text" name="sa_phone" maxlength="13" size="14" />&nbsp;&nbsp;
							<span class="example">(might differ from the customer's (billing) phone)</span>
						</td>
					</tr>
					<tr>
						<td colspan="2" bgcolor="#CCCCCC" align="center" height="35"><h4>Choose Service(s) For The Above New Location</h4></td>
					</tr>
					<?php // <tr> looped here
						$result = dbconnect_newmethod()->query('SELECT prod_id, prod_name FROM product');
						for ($j=0; $j<$result->num_rows; $j++) {	//loop to display products in the database
							$row = $result->fetch_assoc();
							echo '<tr>';
							echo '<td align="right"><input type="checkbox" name="prodid[]" value="'.$row['prod_id'].'" /></td>';
							echo '<td align="left">'.$row['prod_name'].'</td>';
							echo '</tr>';
						}//end for	
					?>
					<tr>
						<td colspan="2" bgcolor="#FFFFFF"><font color="#FFFFFF">a</font></td>
					</tr>
					<tr>
						<td colspan="2" bgcolor="#CCCCCC" align="center" height="35"><input type="submit" value="Submit Service Address" /></td>
					</tr>	
				</table>
			</td></tr>
			</table>
							
			</form>
		</td>
	
	</tr>
</table>

<br />

<?php disp_adminfooter(); ?>
</body>

</html>