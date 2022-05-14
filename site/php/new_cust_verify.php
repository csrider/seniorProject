<?php
//startup
session_start();
require_once 'fns_queries.php';

//temporarily store all the posted values into the session
$_SESSION['nc_fname'] = $_POST['nc_fname'];
$_SESSION['nc_lname'] = $_POST['nc_lname'];
$_SESSION['nc_address1'] = $_POST['nc_address1'];
$_SESSION['nc_address2'] = $_POST['nc_address2'];
$_SESSION['nc_city'] = $_POST['nc_city'];
$_SESSION['nc_state'] = $_POST['nc_state'];
$_SESSION['nc_dphone'] = $_POST['nc_dphone'];
$_SESSION['nc_email'] = $_POST['nc_email'];
$_SESSION['nc_contact_method'] = $_POST['nc_contact_method'];
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
<title>Z-MEN Lawn Care - Verify Contact Information</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/public_general.css" rel="stylesheet" type="text/css">
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
			document.verify.nc_dphone.value="";
			document.verify.nc_dphone.value=pp;
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
				document.verify.nc_dphone.value="";
				document.verify.nc_dphone.value=pp;
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
				document.verify.nc_dphone.value="";
				pp="("+p13+")"+p14+p15;
				document.verify.nc_dphone.value=pp;
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
			document.verify.nc_dphone.value="";
			document.verify.nc_dphone.value=pp;
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
<div align="center">
<form action="new_cust_add.php" method="post" name="verify">
<h2>Please Verify Your Information Below</h2>
<table width="600" height="350" class="main_body_cell">
	<tr><td colspan="2"></td></tr>
	<tr>
		<td align="right">First Name</td>
		<td align="left">
			<input type="text" value="<?php echo $_SESSION['nc_fname']; ?>" name="nc_fname" maxlength="32" size="33" />
		</td>
	</tr>
	<tr>
		<td align="right">Last Name</td>
		<td align="left">
			<input type="text" value="<?php echo $_SESSION['nc_lname']; ?>" name="nc_lname" maxlength="32" size="33" />
		</td>
	</tr>
	<tr>
		<td align="right">Street Address Line 1</td>
		<td align="left">
			<input type="text" value="<?php echo $_SESSION['nc_address1']; ?>" name="nc_address1" maxlength="64" size="50" />
		</td>
	</tr>
	<tr>
		<td align="right">Street Address Line 2</td>
		<td align="left">
			<input type="text" value="<?php echo $_SESSION['nc_address2']; ?>" name="nc_address2" maxlength="64" size="50" />
		</td>
	</tr>
	<tr>
		<td align="right">City</td>
		<td align="left">
			<input type="text" value="<?php echo $_SESSION['nc_city']; ?>" name="nc_city" maxlength="32" size="33" />
		</td>
	</tr>
	<tr>
		<td align="right">State</td>
		<td align="left">
			<select name="nc_state">
				<option name="nc_state" value="<?php echo $_SESSION['nc_state']; ?>"><?php echo $_SESSION['nc_state']; ?></option>
				<option name="nc_state" value="<?php echo $_SESSION['nc_state']; ?>">-------------</option>
				<?php get_states(1); ?>
			</select>
		</td>
	</tr>
	<tr>
		<td align="right">Daytime Phone Number</td>
		<td align="left">
			<input value="<?php echo $_SESSION['nc_dphone']; ?>" name="nc_dphone" type="text" maxlength="13" size="14" onfocus="javascript:getIt(this)" />
		</td>
	</tr>
	<tr>
		<td align="right">Email Address</td>
		<td align="left">
			<input value="<?php echo $_SESSION['nc_email']; ?>" name="nc_email" type="text" maxlength="64" size="50" />
		</td>
	</tr>
	<tr>
		<td align="right" nowrap>How may we contact you?</td>
		<td align="left">
			<?php
			if ($_SESSION['nc_contact_method']=="phone") {
				echo '
					<label><input type="radio" name="nc_contact_method" value="phone" checked>Telephone</label>
					<label><input type="radio" name="nc_contact_method" value="email">Email</label>
				';
			}
			else if ($_SESSION['nc_contact_method']=="email") {
				echo '
					<label><input type="radio" name="nc_contact_method" value="phone">Telephone</label>
					<label><input type="radio" name="nc_contact_method" value="email" checked>Email</label>
				';
			}
			?>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center"><input name="submit" type="submit" value="Submit Verified Information" /></td>
	</tr>
</table>
</form>
</div>
</body>

</html>
