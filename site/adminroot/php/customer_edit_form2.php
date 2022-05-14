<?php //Startup code
	session_start();
	$admin_user = $_SESSION['admin_user'];
	require_once 'fns_display.php';
	require_once 'fns_lookup.php';
	
	//extract record arrays from the session
	$customer = $_SESSION['customer'];
	$customer_online = $_SESSION['customer_online'];
	$customer_cc = $_SESSION['customer_cc'];
	$customer_bank = $_SESSION['customer_bank'];
	require 'fns_validate.php';
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
			document.cust_form.cust_hphone.value="";
			document.cust_form.cust_hphone.value=pp;
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
				document.cust_menu_form.cust_hphone.value="";
				document.cust_menu_form.cust_hphone.value=pp;
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
				document.cust_menu_form.cust_hphone.value="";
				pp="("+p13+")"+p14+p15;
				document.cust_menu_form.cust_hphone.value=pp;
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
			document.cust_menu_form.cust_hphone.value="";
			document.cust_menu_form.cust_hphone.value=pp;
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
</head>

<body>
<?php disp_adminheader(); ?>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td width="200" valign="top"><?php disp_adminmenu(); ?></td>
		<td valign="middle" align="left">

			<!-- Edit form -->
			<form action="customer_edit.php" method="post" name="add_customer">
			<table border="1"><tr><td>
			 
			 <table>
				<tr><td colspan="2" align="center" bgcolor="#CCCCCC">
					<h3>Update Customer #<?php echo $_SESSION['cust_id']; ?></h3>
					<span class="required" style="font-weight:bold; font-size:14px">Please Note:<br />Only those sections that apply must populate required fields<br />(even if a field indicates that it is required)</span>
				</td></tr>
<!----------------------------------------------------------------------------------------------------------------------------------->				
				<tr><td colspan="2" class="sec_header">Customer Information</td></tr>
				<tr>
					<td align="right" class="required">First Name</td>
					<td align="left"><input type="text" name="cust_fname" maxlength="32" size="33" value="<?php echo $customer['cust_fname']; ?>" /></td>
				</tr>
				<tr>
					<td align="right" class="required">Last Name</td>
					<td align="left"><input type="text" name="cust_lname" maxlength="32" size="33" value="<?php echo $customer['cust_lname']; ?>" /></td>
				</tr>
				<tr>
					<td align="right">Middle Initial</td>
					<td align="left"><input type="text" name="cust_minitial" maxlength="1" size="2" /></td>
				</tr>
				<tr>
					<td align="right">Suffix</td>
					<td align="left"><input type="text" name="cust_suffix" maxlength="32" size="33" value="<?php echo $customer['cust_suffix']; ?>" /></td>
				</tr>
				<tr>
					<td align="right" class="required">Address 1</td>
					<td align="left"><input type="text" name="cust_address1" maxlength="64" size="65" value="<?php echo $customer['cust_address1']; ?>" /></td>
				</tr>
				<tr>
					<td align="right">Address 2</td>
					<td align="left"><input type="text" name="cust_address2" maxlength="64" size="65" value="<?php echo $customer['cust_address2']; ?>" /></td>
				</tr>
				<tr>
					<td align="right" class="required">City</td>
					<td align="left"><input type="text" name="cust_city" maxlength="32" size="33" value="<?php echo $customer['cust_city']; ?>" /></td>
				</tr>
				<tr>
					<td align="right" class="required">State</td>
					<td align="left">
						<select name="cust_state">
							<?php
							if ($customer['cust_state']=='IL')	echo '<option value="IL">Illinois</option><option value="IN">Indiana</option><option value="KY">Kentucky</option>';
							else if ($customer['cust_state']=='IN')	echo '<option value="IN">Indiana</option><option value="IL">Illinois</option><option value="KY">Kentucky</option>';
							else if ($customer['cust_state']=='KY')	echo '<option value="KY">Kentucky</option><option value="IL">Illinois</option><option value="IN">Indiana</option>';
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right" class="required">Zip</td>
					<td align="left"><input type="text" name="cust_zip" maxlength="10" size="11" value="<?php echo $customer['cust_zip']; ?>" /><span class="example">&nbsp;example: 47715-7035</span></td>
				</tr>
				<tr>
					<td align="right" class="required">Home Phone</td>
					<td align="left"><input type="text" name="cust_hphone" maxlength="14" size="15" value="<?php echo $customer['cust_hphone']; ?>" /><span class="example">&nbsp;example: (812)555-1212&nbsp;&nbsp;(typically an evening home phone)</span></td>
				</tr>
				<tr>
					<td align="right">Work Phone</td>
					<td align="left"><input type="text" name="cust_wphone" maxlength="14" size="15" value="<?php echo $customer['cust_wphone']; ?>" /><span class="example">&nbsp;example: (812)555-1212&nbsp;&nbsp;(typically a daytime work phone)</span></td>
				</tr>
				<tr>
					<td align="right">Mobile Phone</td>
					<td align="left"><input type="text" name="cust_mphone" maxlength="14" size="15" value="<?php echo $customer['cust_mphone']; ?>" /><span class="example">&nbsp;example: (812)555-1212</span></td>
				</tr>
				<tr>
					<td align="right">Customer Type</td>
					<td align="left">
						<select name="ctype_id">
							<option value="<?php echo $customer['ctype_id']; ?>"><?php echo $customer['ctype_type']; ?></option> <!--sets current ctype as default-->
							<option value="<?php echo $customer['ctype_id']; ?>">--------------------</option>
							<?php lookup_ctype(); //lists all records in the customer_type table ?>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right">Preferred Payment Method</td>
					<td align="left">
						<select name="paym_id">
							<option value="<?php echo $customer['paym_id']; ?>"><?php echo $customer['paym_name']; ?></option> <!--sets current paym as default-->
							<option value="<?php echo $customer['paym_id']; ?>">--------------------</option>
							<?php lookup_paym(); //lists all records in the pay_method table ?>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right">Tax-exempt Number</td>
					<td align="left"><input type="text" name="cust_tax_id" maxlength="32" size="33" value="<?php echo $customer['cust_tax_id']; ?>" /></td>
				</tr>
				<tr bgcolor="#FFCC00"><td colspan="2" align="center"><input type="checkbox" name="customer_confirm" value="confirm_update" />&nbsp;Place check here to confirm that you wish to update this customer's information</td></tr>
<!----------------------------------------------------------------------------------------------------------------------------------->				
				<tr><td colspan="2" align="center"><hr /></td></tr>
				<tr><td colspan="2" class="sec_header">Online Account Information</td></tr>
				<tr>
					<td align="right" class="required">Username</td>
					<td align="left"><input type="text" name="custo_username" maxlength="16" size="17" value="<?php echo $customer_online['custo_username']; ?>" <?php echo $_SESSION['disable_customer_online']; ?> /><span class="example">&nbsp;maximum of 16 characters</span></td>
				</tr>
				<tr>
					<td align="right" class="required">Password</td>
					<td align="left"><input type="text" name="custo_password" maxlength="16" size="17" value="<?php echo $customer_online['custo_password']; ?>" <?php echo $_SESSION['disable_customer_online']; ?> /><span class="example">&nbsp;maximum of 16 characters</span></td>
				</tr>
				<tr>
					<td align="right" class="required">Email Address</td>
					<td align="left"><input type="text" name="custo_email" maxlength="64" size="65" value="<?php echo $customer_online['custo_email']; ?>" <?php echo $_SESSION['disable_customer_online']; ?> /></td>
				</tr>
				<tr>
					<?php //code to interpret 0 or 1 into human-friendly terms
					if (!isset($customer_online['custo_promotions'])) $ap = '';
					else if ($customer_online['custo_promotions'] == 0) $ap = 'No';
					else if ($customer_online['custo_promotions'] == 1) $ap = 'Yes';
					?>
					<td align="right" class="required">Accept Promotions</td>
					<td align="left">
						<input type="hidden" readonly="true" name="custo_promotions" value="<?php $customer_online['custo_promotions']; ?>" <?php echo $_SESSION['disable_customer_online']; ?> />
						<input type="text" readonly="true" maxlength="3" size="4" value="<?php echo $ap; ?>" <?php echo $_SESSION['disable_customer_online']; ?> />
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(change):
						<label><input type="radio" name="custo_promotions" value="1" <?php echo $_SESSION['disable_customer_online']; ?> />Yes, accept promotions</label>&nbsp;&nbsp;
						<label><input type="radio" name="custo_promotions" value="0" <?php echo $_SESSION['disable_customer_online']; ?> />No, do not accept</label>
					</td>
					<?php unset($ap); ?>
				</tr>
				<tr bgcolor="#FFCC00"><td colspan="2" align="center"><input type="checkbox" name="customer_online_confirm" value="confirm_update" <?php echo $_SESSION['disable_customer_online']; ?> />&nbsp;Place check here to confirm that you wish to update this customer's online account information</td></tr>
<!----------------------------------------------------------------------------------------------------------------------------------->				
				<tr><td colspan="2" align="center"><hr /></td></tr>
				<tr><td colspan="2" class="sec_header">Stored Credit Card Information</td></tr>
				<tr>
					<td align="right" class="required">Credit Card</td>
					<td align="left">
						<select name="ccv_id" <?php echo $_SESSION['disable_customer_cc']; ?>>
							<option value="<?php echo $customer_cc['ccv_id']; ?>"><?php echo $customer_cc['ccv_name']; ?></option>
							<option value="<?php echo $customer_cc['ccv_id']; ?>">--------------------</option>
							<?php lookup_ccv(); ?>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right" class="required">Name on Card</td>
					<td align="left"><input type="text" name="custcc_name" maxlength="32" size="33" value="<?php echo $customer_cc['custcc_name']; ?>" <?php echo $_SESSION['disable_customer_cc']; ?> /></td>
				</tr>
				<tr>
					<td align="right" class="required">Credit Card Number</td>
					<td align="left"><input type="text" name="custcc_number" maxlength="24" size="25" value="<?php echo $customer_cc['custcc_number']; ?>" <?php echo $_SESSION['disable_customer_cc']; ?> /></td>
				</tr>
				<tr>
					<td align="right" class="required">Credit Card Security Code</td>
					<td align="left"><input type="text" name="custcc_cid" maxlength="4" size="5" value="<?php echo $customer_cc['custcc_cid']; ?>" <?php echo $_SESSION['disable_customer_cc']; ?> /><span class="example">&nbsp;3-4 digit security code on back of card</span></td>
				</tr>
				<tr>
					<td align="right" class="required">Expiration Date</td>
					<td align="left"><input type="text" name="custcc_expire" maxlength="5" size="6" value="<?php echo $customer_cc['custcc_expire']; ?>" <?php echo $_SESSION['disable_customer_cc']; ?> /><span class="example">&nbsp;format: mm/yy</span></td>
				</tr>
				<tr>
					<td align="right">Customer Service Phone Number</td>
					<td align="left"><input type="text" name="custcc_cust_svc" maxlength="14" size="15" value="<?php echo $customer_cc['custcc_cust_svc']; ?>" <?php echo $_SESSION['disable_customer_cc']; ?> /><span class="example">&nbsp;this could expedite payments if a problem arises</span></td>
				</tr>
				<tr>
					<td align="right" class="required">Address 1</td>
					<td align="left"><input type="text" name="custcc_address1" maxlength="64" size="65" value="<?php echo $customer_cc['custcc_address1']; ?>" <?php echo $_SESSION['disable_customer_cc']; ?> /></td>
				</tr>
				<tr>
					<td align="right">Address 2</td>
					<td align="left"><input type="text" name="custcc_address2" maxlength="64" size="65" value="<?php echo $customer_cc['custcc_address2']; ?>" <?php echo $_SESSION['disable_customer_cc']; ?> /></td>
				</tr>
				<tr>
					<td align="right" class="required">City</td>
					<td align="left"><input type="text" name="custcc_city" maxlength="32" size="33" value="<?php echo $customer_cc['custcc_city']; ?>" <?php echo $_SESSION['disable_customer_cc']; ?> /></td>
				</tr>
				<tr>
					<td align="right" class="required">State</td>
					<td align="left"><input type="text" name="custcc_state" maxlength="2" size="3" value="<?php echo $customer_cc['custcc_state']; ?>" <?php echo $_SESSION['disable_customer_cc']; ?> /><span class="example">&nbsp;example: IN</span></td>
				</tr>
				<tr>
					<td align="right" class="required">Zip</td>
					<td align="left"><input type="text" name="custcc_zip" maxlength="10" size="11" value="<?php echo $customer_cc['custcc_zip']; ?>" <?php echo $_SESSION['disable_customer_cc']; ?> /><span class="example">&nbsp;example: 47715-7035</span></td>
				</tr>
				<tr bgcolor="#FFCC00"><td colspan="2" align="center"><input type="checkbox" name="customer_cc_confirm" value="confirm_update" <?php echo $_SESSION['disable_customer_cc']; ?> />&nbsp;Place check here to confirm that you wish to update this customer's credit card information</td></tr>
<!----------------------------------------------------------------------------------------------------------------------------------->				
				<tr><td colspan="2" align="center"><hr /></td></tr>
				<tr><td colspan="2" class="sec_header">Stored Bank Account Information</td></tr>
				<tr>
					<td align="right" class="required">Type of Account</td>
					<td align="left">
						<select name="bat_id" <?php echo $_SESSION['disable_customer_bank']; ?>>
							<option value="<?php echo $customer_bank['bat_id']; ?>"><?php echo $customer_bank['bat_type']; ?></option>
							<option value="<?php echo $customer_bank['bat_id']; ?>">--------------------</option>
							<?php lookup_bat(); ?>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right" class="required">Routing Number</td>
					<td align="left"><input type="text" name="custbank_routing" maxlength="16" size="17" value="<?php echo $customer_bank['custbank_routing']; ?>" <?php echo $_SESSION['disable_customer_bank']; ?> /></td>
				</tr>
				<tr>
					<td align="right" class="required">Account Number</td>
					<td align="left"><input type="text" name="custbank_account" maxlength="16" size="17" value="<?php echo $customer_bank['custbank_account']; ?>" <?php echo $_SESSION['disable_customer_bank']; ?> /></td>
				</tr>
				<tr>
					<td align="right" class="required">Address 1</td>
					<td align="left"><input type="text" name="custbank_address1" maxlength="64" size="65" value="<?php echo $customer_bank['custbank_address1']; ?>" <?php echo $_SESSION['disable_customer_bank']; ?> /></td>
				</tr>
				<tr>
					<td align="right">Address 2</td>
					<td align="left"><input type="text" name="custbank_address2" maxlength="64" size="65" value="<?php echo $customer_bank['custbank_address2']; ?>" <?php echo $_SESSION['disable_customer_bank']; ?> /></td>
				</tr>
				<tr>
					<td align="right" class="required">City</td>
					<td align="left"><input type="text" name="custbank_city" maxlength="32" size="33" value="<?php echo $customer_bank['custbank_city']; ?>" <?php echo $_SESSION['disable_customer_bank']; ?> /></td>
				</tr>
				<tr>
					<td align="right" class="required">State</td>
					<td align="left"><input type="text" name="custbank_state" maxlength="2" size="3" value="<?php echo $customer_bank['custbank_state']; ?>" <?php echo $_SESSION['disable_customer_bank']; ?> /><span class="example">&nbsp;example: IN</span></td>
				</tr>
				<tr>
					<td align="right" class="required">Zip</td>
					<td align="left"><input type="text" name="custbank_zip" maxlength="10" size="11" value="<?php echo $customer_bank['custbank_zip']; ?>" <?php echo $_SESSION['disable_customer_bank']; ?> /><span class="example">&nbsp;example: 47715-7035</span></td>
				</tr>
				<tr bgcolor="#FFCC00"><td colspan="2" align="center"><input type="checkbox" name="customer_bank_confirm" value="confirm_update" <?php echo $_SESSION['disable_customer_bank']; ?> />&nbsp;Place check here to confirm that you wish to update this customer's bank account information</td></tr>
<!----------------------------------------------------------------------------------------------------------------------------------->				
				<tr>
					<td colspan="2" align="center" bgcolor="#CCCCCC"><input type="submit" value="Submit Changes" /></td>
				</tr>
			 </table>
<!----------------------------------------------------------------------------------------------------------------------------------->				
			</td></tr></table>
			</form>
			
		</td>
	</tr>
</table>

<br />

<?php disp_adminfooter(); ?>
</body>

</html>