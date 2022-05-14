<?php 
	session_start();
	$admin_user = $_SESSION['admin_user'];
	require_once 'fns_display.php';
	require_once 'fns_lookup.php';
	$_SESSION['numServiceLoc'] = 1;	//sets default number of service locations (auto-filled at the start of wizard)
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
//Begin Phone Validation	
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
			document.add_customer.cust_hphone.value="";
			document.add_customer.cust_hphone.value=pp;
		} //end if
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
				document.add_customer.cust_hphone.value="";
				document.add_customer.cust_hphone.value=pp;
			} //end if
		} //end if
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
				document.add_customer.cust_hphone.value="";
				pp="("+p13+")"+p14+p15;
				document.add_customer.cust_hphone.value=pp;
				//obj1.value="";
				//obj1.value=pp;
			} //end if
		l16=p.length;
		p16=p.substring(d2+1,l16);
		l17=p16.length;
		if(l17>3&&p16.indexOf('-')==-1) {
			p17=p.substring(d2+1,d2+4);
			p18=p.substring(d2+4,l16);
			p19=p.substring(0,d2+1);
			//alert(p19);
			pp=p19+p17+"-"+p18;
			document.add_customer.cust_hphone.value="";
			document.add_customer.cust_hphone.value=pp;
			//obj1.value="";
			//obj1.value=pp;
		} //end if
	} //end if
	setTimeout(ValidatePhone,100)
	} //end function ValidatePhone()
	
	function getIt(m) {
		n=m.name;
		//p1=document.forms[0].elements[n]
		p1=m
		ValidatePhone()
	} //end function getIt(m)
	
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
		} //end if
	} //end function testphone(obj1)
//End Phone Validation

function validate() {
	if (document.add_customer.cust_fname.value=="") 		window.alert("Please enter a first name!");
	if (document.add_customer.cust_lname.value=="") 		window.alert("Please enter a last name!");
	if (document.add_customer.cust_address1.value=="") 	window.alert("Please enter an address!");
	if (document.add_customer.cust_city.value=="") 			window.alert("Please enter a city!");
	if (document.add_customer.cust_state.value=="") 		window.alert("Please select a state!");
	if (document.add_customer.cust_zip.value=="") 			window.alert("Please enter a zip code!");
	if (document.add_customer.cust_hphone.value=="") 		window.alert("Please enter a home phone number!");
	if (document.add_customer.ctype_id.value=="") 			window.alert("Please select a customer type!");
	if (document.add_customer.numServiceLoc.value=="")	window.alert("Please enter the number of service locations you will require!");
}
</script>
</head>

<body>
<?php disp_adminheader(); ?>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td width="200" valign="top"><?php disp_adminmenu(); ?></td>
		<td valign="top" align="left">

			<!-- Add form -->
			<form action="customer_add.php" method="post" name="add_customer">
			<table border="1"><tr><td>
			 <table>
				<tr bgcolor="#CCCCCC"><td colspan="2" align="center"><h3>New Customer Wizard</h3></td></tr>
				<tr><td colspan="2" align="center"><span class="required">(Fields marked red are required)</span></td></tr>
				<tr><td colspan="2" align="left" class="sec_header">Customer Information...</td>
				</tr>
				<tr>
					<td align="right" class="required">First Name</td>
					<td align="left"><input type="text" name="cust_fname" maxlength="32" size="33" value="<?php echo $_SESSION['cust_fname']; ?>" /></td>
				</tr>
				<tr>
					<td align="right" class="required">Last Name</td>
					<td align="left"><input type="text" name="cust_lname" maxlength="32" size="33" value="<?php echo $_SESSION['cust_lname']; ?>" /></td>
				</tr>
				<tr>
					<td align="right">Middle Initial</td>
					<td align="left"><input type="text" name="cust_minitial" maxlength="1" size="2" value="<?php echo $_SESSION['cust_minitial']; ?>" /></td>
				</tr>
				<tr>
					<td align="right">Suffix</td>
					<td align="left"><input type="text" name="cust_suffix" maxlength="32" size="33" value="<?php echo $_SESSION['cust_suffix']; ?>" /></td>
				</tr>
				<tr>
					<td align="right" class="required">Billing Address 1</td>
					<td align="left"><input type="text" name="cust_address1" maxlength="64" size="65" value="<?php echo $_SESSION['cust_address1']; ?>" /></td>
				</tr>
				<tr>
					<td align="right">Billing Address 2</td>
					<td align="left"><input type="text" name="cust_address2" maxlength="64" size="65" value="<?php echo $_SESSION['cust_address2']; ?>" /></td>
				</tr>
				<tr>
					<td align="right" class="required">Billing City</td>
					<td align="left"><input type="text" name="cust_city" maxlength="32" size="33" value="<?php echo $_SESSION['cust_city']; ?>" /></td>
				</tr>
				<tr>
					<td align="right" class="required">Billing State</td>
					<td align="left">
						<select name="cust_state">
							<option value="">- SELECT -</option>
							<option value="IL">Illinois</option>
							<option value="IN">Indiana</option>
							<option value="KY">Kentucky</option>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right" class="required">Billing Zip</td>
					<td align="left"><input type="text" name="cust_zip" maxlength="10" size="11" value="<?php echo $_SESSION['cust_zip']; ?>" /><span class="example">&nbsp;example: 47715-7035</span></td>
				</tr>
				<tr>
					<td align="right" class="required">Primary Phone</td>
					<td align="left"><input type="text" name="cust_hphone" maxlength="13" size="14" value="<?php echo $_SESSION['cust_hphone']; ?>" onfocus="javascript:getIt(this)" /><span class="example">&nbsp;example: (812)555-1212&nbsp;&nbsp;(typically an evening home phone)</span></td>
				</tr>
				<tr>
					<td align="right">Work Phone</td>
					<td align="left"><input type="text" name="cust_wphone" maxlength="13" size="14" value="<?php echo $_SESSION['cust_wphone']; ?>" ><span class="example">&nbsp;example: (812)555-1212&nbsp;&nbsp;(typically a daytime work phone)</span></td>
				</tr>
				<tr>
					<td align="right">Mobile Phone</td>
					<td align="left"><input type="text" name="cust_mphone" maxlength="13" size="14" value="<?php echo $_SESSION['cust_mphone']; ?>" /><span class="example">&nbsp;example: (812)555-1212</span></td>
				</tr>
				<tr><td colspan="2" align="left" class="sec_header"><hr />Service Information...</td></tr>
				<tr>
					<td align="right" class="required"># of Service Locations</td>
					<td align="left"><input type="text" name="numServiceLoc" maxlength="3" size="4" value="<?php echo $_SESSION['numServiceLoc']; ?>" /><span class="example">&nbsp;enter the number of locations you would like us to perform services at</span></td>
				</tr>
				<tr>
					<td align="right" class="required">Includes Billing Address?</td>
					<td align="left">
						<label><input type="radio" name="isBillingServiceLoc" value="1" checked />Yes</label>
						<label><input type="radio" name="isBillingServiceLoc" value="0" />No&nbsp;&nbsp;&nbsp;&nbsp;</label>
						<span class="example">&nbsp;is the above billing address also a service location?</span>
					</td>
				</tr>
				<tr><td colspan="2" align="left" class="sec_header"><hr />Other Required Information...</td></tr>
				<tr>
					<td align="right" class="required">Customer Type</td>
					<td align="left">
						<select name="ctype_id">
							<option value="">- SELECT -</option>
							<?php lookup_ctype(); ?>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right">Tax-exempt ID Number</td>
					<td align="left"><input type="text" name="cust_tax_id" maxlength="32" size="33" value="<?php echo $_SESSION['cust_tax_id']; ?>" /><span class="example">&nbsp;enter only if you are exempt from state sales tax</span></td>
				</tr>
				<tr>
					<td align="right" valign="top" class="required">Payment Options</td>
					<td align="left">
						<label><input type="radio" name="paym_choice" value="0" checked />Paper Bill / DON'T Create Online Account</label><br />
						<label><input type="radio" name="paym_choice" value="1" />Paper Bill / Create Online Account</label><br />
						<label><input type="radio" name="paym_choice" value="2" />Online Payments by Credit Card<span class="example">&nbsp;(you may choose single OR recurring)</span></label><br />
						<label><input type="radio" name="paym_choice" value="3" />Online Payments by Electronic Check<span class="example">&nbsp;(you may choose single OR recurring)</span></label>
					</td>
				</tr>
				<tr bgcolor="#CCCCCC">
					<td colspan="2" align="center"><input name="submit" type="submit" value="Register New Customer" onmousedown="validate()" /></td>
				</tr>
			 </td></tr></table>
			</table>
			</form>
			
		</td>
	</tr>
</table>

<br />

<?php disp_adminfooter(); ?>
</body>

</html>