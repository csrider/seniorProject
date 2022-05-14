<?php 
session_start();
require_once 'fns_database.php';
require_once 'fns_display.php';
$customer_online = $_SESSION['user_online_record'];
$customer = $customer_online['cust_id'];

//Query to get the customer information
$result = dbconnect()->query('SELECT * 
																 FROM customer, customer_type 
																 WHERE cust_id = "'.$customer.'" 
																   AND customer.ctype_id = customer_type.ctype_id');
$row = $result->fetch_assoc();

//Query to get the most recent payment info for this customer
$result2 = dbconnect()->query('SELECT * 
																 FROM payment
																 WHERE cust_id = "'.$customer.'"
																   AND pmt_date = (SELECT MAX(pmt_date) FROM payment WHERE cust_id = "'.$customer.'") ');
$row2 = $result2->fetch_assoc();

//Query to get all customer and svc_address information for this customer, sorted by sa_id
$result3 = dbconnect()->query('SELECT * 
																 FROM customer, svc_address
																 WHERE customer.cust_id = "'.$customer.'" 
																	 AND customer.cust_id = svc_address.cust_id
																 ORDER BY svc_address.sa_id');

//Query to get product information for all locations
function svc_id_lookup($sa_id){ 
 	$result6 = dbconnect()->query('SELECT * 
 																	 FROM svc_addr_prod, product 
																	 WHERE svc_addr_prod.prod_id = product.prod_id
																     AND sa_id = "'.$sa_id.'" ');
}

//Query to get the total amount of services the customer is responsible for (should be the total amount that is due... based off payment history)
$result4 = dbconnect()->query(' SELECT sum(prod_price)
																	FROM product, svc_address, svc_addr_prod
																	WHERE svc_address.sa_id = svc_addr_prod.sa_id
																	  AND svc_addr_prod.prod_id = product.prod_id
																		AND cust_id = "'.$customer.'"  ');
$row4 = $result4->fetch_assoc();

//Misc routines
$result6 = $result;

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Invoice Summary</title>
<style type="text/css">
<!--
.style3 {font-size: xx-large}
.header {font-weight:bold; font-variant:small-caps; font-size:14px}
.header1 {font-style:italic; vertical-align:bottom; font-size:14px}
.header2 {font-variant:small-caps;}
-->
</style>
</head>

<body style="font-family:Arial, Helvetica, sans-serif " topmargin="2" leftmargin="2" rightmargin="2">
<table width="100%"  border="0" cellpadding="0" cellspacing="0"><!--table one-->
	<tr>
		<td align="center">
      <table width="100%" border="0" cellpadding="2" cellspacing="0">
         
				<tr>
        	<td width="45%" align="left" valign="top" class="style3" height="15px" bgcolor="#5ca758"><font color="#FFFF00">Z-MEN Lawn Care<br />INVOICE/SUMMARY</font></td>
          <td width="55%" align="right" valign="top" height="15px"  bgcolor="#5ca758"><img src="../images/logo_yellow.gif" width="97" height="59"><br />
          <font color="#FFFF00"><b><?php print date("F   d, Y  ") ?></b></font></td>
        </tr>
				
				<tr>
					<td colspan="2"><hr color="#FFFF00"></td>
				</tr>
        
				<tr>
					<td width="45%" align="left" valign="top">
						<table width="100%"  border="0" align="left" class="header2" cellspacing="0" cellpadding="0" style="font-weight:bold; font-size:16px; color:#004400 ">
            	<tr><td align="left"><?php echo $row['cust_fname'].'&nbsp;'.$row['cust_lname']; ?></td></tr>
              <tr><td align="left"><?php echo $row['cust_address1'].'<br />'.$row['cust_address2']; ?></td></tr>
              <tr><td align="left"><?php echo $row['cust_city'].', '.$row['cust_state'].'&nbsp;&nbsp;'.$row['cust_zip']; ?></td></tr>
            </table>
					</td>
					<td valign="top" width="55%">
			  		<table width="100%" align="right" border="0" cellpadding="0" cellspacing="0">
					  <?php 
						if($row2) {
						 $row6 = $result->fetch_assoc();
						 $paid_date = substr($row['cust_created'],8,2);
						}//end if 
						?>
		  				<tr>
								<?php 
								if(isset($row2['pmt_amount'])) echo'
								<td align="right">
									Last Payment: $'.$row2['pmt_amount'].'&nbsp;<em>('.$row2['pmt_date'].')</em>&nbsp;Thanks!
								</td>
								';
								else echo'
								<td align="right">You Haven\'t Yet Made Any Payments</td>';
								?>
							</tr>
							<tr align="right">
                <td>
									<span style="font-weight:bold; font-size:22px ">
										Total Amount Due: $<?php echo $row4['sum(prod_price)']; ?>
									</span>
									<br />
									<span style="font-weight:normal; font-size:14px; font-style:oblique ">
										<?php if($paid_date <=15){echo 'Payment Due on the 1st of Each Month';} if($paid_date > 15){echo 'Payment Due on the 15th of Each Month';}?>
									</span>
								</td>
              </tr>
			  		</table>
					</td>
        </tr>
						
        <tr>
        	<td colspan="2">
			  		<table width="100%" border="0" align="left" cellpadding="2" cellspacing="0">
							<tr><td colspan="8"><hr color="#5ca758"></td></tr>
							<tr class="header" style="font-size:16px; font-weight:bold ">
								<td align="left" width="20">id</td>
								<td align="left">Address</td>
								<td align="center">City</td>
								<td align="center">State</td>
								<td align="center">Zip</td>
								<td align="center">Phone</td>
							</tr>
							<tr><td colspan="8"><hr color="#5ca758"></td></tr>
						<?php
						if(false) {echo '
							<tr>
								<td colspan="8" align="center">
									<h2>Thanks for choosing Z-MEN Lawn Care!</h2>
									<h3>Your invoice is not yet viewable at this time.<br />This could be because you are a new customer or don\'t have any services configured.</h3>
									<h3>Please check back again or contact us if you have any questions.</h3>
								</td>
							</tr>';
						}//end if
						else {
							for($i=0; $i<$result3->num_rows; $i++){
				 				$row3 = $result3->fetch_assoc();				
								echo '<tr bgcolor="#999999" style="color:#FFFFFF; font-weight:bold">';
								echo '	<td align="left" width="20" valign="top" style="font-weight:bold; color:#FFFF00">' .$row3['sa_id']. '</td>';
								echo '	<td align="left" valign="top" nowrap>' .$row3['sa_address1']. '<br />' .$row3['sa_address2'].'</td>';
								echo '	<td align="center" valign="top">' .$row3['sa_city']. '</td>';
								echo '	<td align="center" valign="top">' .$row3['sa_state']. '</td>';
								echo '	<td align="center" valign="top">' .$row3['sa_zip']. '</td>';
								echo '	<td align="center" valign="top" nowrap>' .$row3['sa_area_code']. '-' .$row3['sa_phone']. '</td>';
								echo '</tr>';
								echo '<tr class="header">';
								echo '	<td colspan="1">&nbsp;</td>';
								echo '	<td align="left"><u>Services</u></td>'; 
								echo '	<td align="left" colspan="3"><u>Description</u></td>'; 
								echo '	<td align="right"><u>Price</u></td>'; 
								echo '</tr>';
								$current_sa_id = $row3['sa_id'];			
								$result6 = dbconnect()->query('SELECT * FROM svc_addr_prod, product 
																								WHERE svc_addr_prod.prod_id = product.prod_id
																									AND sa_id = "'.$current_sa_id.'" ');		
								for($j=0; $j<$result6->num_rows; $j++){
									$row6 = $result6->fetch_assoc();
									echo '<tr class="header1">';
									echo '	<td>&nbsp;</td>';
									echo '	<td align="left" valign="top" nowrap>&bull;&nbsp;' .$row6['prod_name']. '</td>';
									echo '	<td align="left" colspan="3" valign="top">' .$row6['prod_desc']. '</td>';
									echo '	<td align="right" valign="top">' .$row6['prod_price']. '</td>';
									echo '</tr>';
								}//end for
							}//end for
						}//end else
						?>	
						</table>
			  	</td>
				</tr>
			</table>
		  
    </td>
	</tr>
</table>

<table width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<?php display_footer1(); ?>
  </tr>
</table>
</body>
</html>
