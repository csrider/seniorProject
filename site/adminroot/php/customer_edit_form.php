<?php //Startup code
	session_start();
	$admin_user = $_SESSION['admin_user'];
	unset($_SESSION['disable_customer_online'], $_SESSION['disable_customer_cc'], $_SESSION['disable_customer_bank']);
	require_once 'fns_display.php';
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
			document.find_cust.find_cust_hphone.value="";
			document.find_cust.find_cust_hphone.value=pp;
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
			document.find_cust.find_cust_hphone.value="";
			document.find_cust.find_cust_hphone.value=pp;
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
				document.find_cust.find_cust_hphone.value="";
				pp="("+p13+")"+p14+p15;
				document.find_cust.find_cust_hphone.value=pp;
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
			document.find_cust.find_cust_hphone.value="";
			document.find_cust.find_cust_hphone.value=pp;
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
		<!--menu nav-->
		<td width="200" valign="top"><?php disp_adminmenu(); ?></td>
		
		<!--body-->
		<td valign="top" align="left">			
			
			<form action="customer_edit_find.php" method="post" name="find_cust">
			<table border="1"><tr><td>
			 
			 <table>
				<tr><td align="center" colspan="2" bgcolor="#CCCCCC"><h3>Search for Existing Customer to Edit</h3></td></tr>
				<tr>
					<td align="right">Find by Customer ID</td>
					<td align="left"><input type="text" name="find_cust_id" maxlength="10" size="11" /></td>
				</tr>
				<tr><td colspan="2" align="center" class="sec_header">- OR -</td></tr>
				<tr>
					<td align="right">Find by Home Phone</td>
					<td align="left"><input type="text" name="find_cust_hphone" maxlength="14" size="15" onfocus="javascript:getIt(this)" /></td>
				</tr>
				<tr><td align="center" colspan="2" bgcolor="#CCCCCC"><input type="submit" name="submit" value="Find Customer" /></td></tr>
			 </table>
			
			</td></tr></table>
			</form>
		
		</td>
	
	</tr>
</table>

<br />

<?php disp_adminfooter(); ?>
</body>

</html>