<?php 
	//Startup
	session_start();
	$admin_user = $_SESSION['admin_user'];
	require_once 'fns_display.php';
	require_once 'fns_database.php';
	
	//Code used to store selected record as an array to use to populate fields
	$result = dbconnect_newmethod()->query("SELECT * FROM cc_vendor WHERE ccv_id='".$_POST['vendor_id_toedit']."'");
	$num_results = $result->num_rows;
	for ($i=0; $i<$num_results; $i++) $row1 = $result->fetch_assoc();
	
	//Store the current record being edited's ID in the session to carry to the next page
	$_SESSION['ccv_id'] = $_POST['vendor_id_toedit'];
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
			document.ccv_edit_form.ccv_merchphone.value="";
			document.ccv_edit_form.ccv_merchphone.value=pp;
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
				document.ccv_edit_form.ccv_merchphone.value="";
				document.ccv_edit_form.ccv_merchphone.value=pp;
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
				document.ccv_edit_form.ccv_merchphone.value="";
				pp="("+p13+")"+p14+p15;
				document.ccv_edit_form.ccv_merchphone.value=pp;
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
			document.ccv_edit_form.ccv_merchphone.value="";
			document.ccv_edit_form.ccv_merchphone.value=pp;
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
		<td valign="top" align="center">
			
			<!-- Edit follows -->
			<form name="ccv_edit_form" action="ccv_edit.php" method="post">
			<table cellpadding="2" cellspacing="0" border="0" width="100%">
				<tr bgcolor="#aaaaaa">
					<td colspan="2"><h4>Edit an Existing Credit Card Vendor</h4></td>
				</tr>
				<tr><td colspan="2"><br /></td></tr>
				<tr>
					<td colspan="2">
						<table cellpadding="2" cellspacing="0" border="1">
							<tr bgcolor="#CCCCCC">
								<td align="left">Vendor</td>
								<td>Merchant #</td>
								<td>Phone #</td>
								<td>Record Last Updated</td>
								<td>Record Created</td>
							</tr>
							<tr bgcolor="#ffffcc">
								<?php showccv_edit(); ?>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td colspan="2"><br /></td></tr>
				<tr>
					<td align="right">Change Vendor Name:</td>
					<td align="left">
						<input 
							type="text" 
							name="ccv_name" 
							maxlength="32" 
							size="33" 
							value="<?php echo $row1['ccv_name']; ?>" 
						/>
					</td>
				</tr>
				<tr>
					<td align="right">Change Vendor Merchant Account #:</td>
					<td align="left">
						<input 
							type="text" 
							name="ccv_merchnum" 
							maxlength="14" 
							size="15" 
							value="<?php echo $row1['ccv_merch_num']; ?>" 
						/>
					</td>
				</tr>
				<tr>
					<td align="right">Change Vendor Phone #:</td>
					<td align="left">
						<input 
							type="text" 
							name="ccv_merchphone" 
							maxlength="13" 
							size="14" 
							value="<?php echo $row1['ccv_merch_phone']; ?>" 
							onfocus="javascript:getIt(this)" 
						/>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center"><input type="submit" value="Submit Changes" /></td>
				</tr>
			</table>
			</form>
			<!-- End edit -->
			
		</td>
	</tr>
</table>
<br />
<?php disp_adminfooter(); ?>
</body>

<?php
//Function used to display selected record that will be edited
function showccv_edit() {
	$result = dbconnect_newmethod()->query("SELECT * FROM cc_vendor WHERE ccv_id='".$_POST['vendor_id_toedit']."'");
	$num_results = $result->num_rows;
	for ($i=0; $i<$num_results; $i++) {
		$row2 = $result->fetch_assoc();
		echo '<td align="left">'.$row2['ccv_name'].'</td>';
		echo '<td>'.$row2['ccv_merch_num'].'</td>';
		echo '<td>'.$row2['ccv_merch_phone'].'</td>';
		echo '<td>'.$row2['ccv_lastupd'].'</td>';
		echo '<td>'.$row2['ccv_created'].'</td>';
	}
}
?>

</html>