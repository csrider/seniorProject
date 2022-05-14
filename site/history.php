<?php
//START-UP ROUTINES
	session_start();

//REQUIRES & INCLUDES
	require_once 'php/fns_queries.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Z-Men v1.dwt.php" codeOutsideHTMLIsLocked="true" -->

<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Z-MEN Lawn Care</title>
<!-- InstanceEndEditable -->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link REL="StyleSheet" TYPE="text/css" HREF="css/public_general.css" />
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

function mmLoadMenus() {
  if (window.mm_menu_0328165336_0) return;
  window.mm_menu_0328165336_0 = new Menu("root",67,18,"Arial, Helvetica, sans-serif",12,"#000000","#000000","#5ca758","#ffff00","left","middle",3,0,500,-5,7,true,true,true,0,false,true);
  //                                Menu(label ,mw,mh,fnt                           ,fs,fclr     ,fhclr    ,bg      ,bgh     ,halgn ,valgn,pad,space,to,sx,sy,srel,opq ,vert,idt,aw ,ah  );
	mm_menu_0328165336_0.addMenuItem("<a href='vision.php' class='menulink_plain'>Vision</a>");
  mm_menu_0328165336_0.addMenuItem("<a href='history.php' class='menulink_plain'>History</a>");
  mm_menu_0328165336_0.addMenuItem("<a href='equipment.php' class='menulink_plain'>Equipment</a>");
   mm_menu_0328165336_0.hideOnMouseOut=true;
   mm_menu_0328165336_0.menuBorder=1;									//width of the borders
   mm_menu_0328165336_0.menuLiteBgColor='#5ca758';		//color of the top/left (next to outside) borders
   mm_menu_0328165336_0.menuBorderBgColor='#333333';	//color of the outside exterior border (on ALL sides)
   mm_menu_0328165336_0.bgColor='#5ca758';						//color of the bottom/right (next to outside) and interior (cell) borders

  mm_menu_0328165336_0.writeMenus();
} // mmLoadMenus()
//-->
</script>
<script language="JavaScript1.2" type="text/javascript" src="javascript/mm_menu.js"></script>
<!-- InstanceBeginEditable name="head" -->
<!--editable header region-->
<!-- InstanceEndEditable --><!-- InstanceParam name="title_bar_shadow" type="boolean" value="false" --><!-- InstanceParam name="body_topgreen" type="boolean" value="true" --><!-- InstanceParam name="body_bottomgreen" type="boolean" value="true" -->
</head>

<body bgcolor="#999999" background="images/rpt_bg.gif" leftmargin="0" topmargin="0" rightmargin="0" bottommargin="0" onload="MM_preloadImages('images/buttons/prices_btn_f2.gif','images/buttons/home_btn_f2.gif','images/buttons/svcs_btn_f2.gif','images/buttons/zmen_r5_c12_f2.gif','images/buttons/contact_btn_f2.gif','images/buttons/testimonial_btn_f2.gif')">
<script language="JavaScript1.2" type="text/javascript">mmLoadMenus();</script>
<!--MAIN WEB-PAGE TABLE (serves mainly to align the page content on the screen)-->
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td align="left" valign="top">

	<!--Main Page Table (optimized for 800x600 resolutions) (responsible for the format of the page)-->
	<table width="750" cellpadding="0" cellspacing="0">
	
		<!--Main Header Row-->
		<tr><td width="750">
			<!--Table to format the header-->
			<table width="750" cellpadding="0" cellspacing="0">
				<tr>
					<td height="7" width="750" colspan="13" bgcolor="#5CA758" background="images/1x1_green.gif"></td>
				</tr>
				<tr>
					<td height="125" width="750" colspan="13" background="images/title_grass.jpg"></td>
				</tr>
				<tr>
					<td height="4" width="750" colspan="13" bgcolor="#5CA758" background="images/1x1_green.gif"></td>
				</tr>
				<tr>
					<td width="1" height="23" bgcolor="#5CA758" background="images/1x1_green.gif"></td>
					<td width="75" height="23" align="left"><a href="index.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('home','','images/buttons/home_btn_f2.gif',1)"><img src="images/buttons/home_btn.gif" alt="Home" name="home" width="75" height="23" border="0" id="home" /></a></td>
					<td width="4" height="23" bgcolor="#5CA758" background="images/1x1_green.gif"></td>
					<td width="75" height="23" align="left"><a href="services.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('services','','images/buttons/svcs_btn_f2.gif',1)"><img src="images/buttons/svcs_btn.gif" alt="Services" name="services" width="75" height="23" border="0" id="services" /></a></td>
					<td width="4" height="23" bgcolor="#5CA758" background="images/1x1_green.gif"></td>
					<td width="75" height="23" align="left"><a href="prices.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('links','','images/buttons/prices_btn_f2.gif',1)"><img src="images/buttons/prices_btn.gif" alt="Prices" name="links" width="75" height="23" border="0" id="links" /></a></td>
					<td width="4" height="23" bgcolor="#5CA758" background="images/1x1_green.gif"></td>
					<td width="75" height="23" align="left"><a href="testimonials.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('testimonials','','images/buttons/testimonial_btn_f2.gif',1)"><img src="images/buttons/testimonial_btn.gif" alt="Testimonials" name="testimonials" width="75" height="23" border="0" id="testimonials" /></a></td>
					<td width="4" height="23" bgcolor="#5CA758" background="images/1x1_green.gif"></td>
					<td width="75" height="23" align="left"><a onmouseout="MM_swapImgRestore();MM_startTimeout();" onmouseover="MM_showMenu(window.mm_menu_0328165336_0,319,158,null,'zmen_r5_c12');MM_swapImage('about','','images/buttons/zmen_r5_c12_f2.gif',1)"><img src="images/buttons/zmen_r5_c12.gif" alt="About Us" name="about" width="75" height="23" border="0" id="about" /></a></td>
					<td width="4" height="23" bgcolor="#5CA758" background="images/1x1_green.gif"></td>
					<td width="75" height="23" align="left"><a href="contact_us.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('contact','','images/buttons/contact_btn_f2.gif',1)"><img src="images/buttons/contact_btn.gif" alt="Contact Us" name="contact" width="75" height="23" border="0" id="contact" /></a></td>
					<td width="279" height="23" align="left"><img src="images/your_grass.gif" width="279" height="23" /></td>
				</tr>
				<tr>
					<td height="3" width="471" colspan="12" align="left" bgcolor="#5CA759" background="images/1x1_green.gif"></td>
					<td height="3" width="279"><img src="images/your_grass2.gif" width="279" height="3" /></td>
				</tr>
				
				<!--The following code will display the white bar beneath the menus-->
				<tr>
					<td height="20" width="750" colspan="13" bgcolor="#FFFFFF">
						<?php
						if (isset($_SESSION['user_online_record'])) {						//IF the user is currently logged-in, display customized welcome/logout info
							$user_online_record = $_SESSION['user_online_record'];	//extracts customer_online record from array created at login
							if (!isset($cust_name)) $cust_name = get_cust_name();		//IF we don't have their name, get it from database. ELSE no need to (prevents a redunandant connection to the DB)
							echo '
								<table cellpadding="0" cellspacing="0" border="0" width="100%"><tr>
									<td align="left" valign="middle" class="welcome_name">
										&nbsp;Welcome '.$cust_name['cust_fname'].', you are currently logged in as "'.$user_online_record['custo_username'].'."
									</td>
									<td align="right" valign="middle">
										<a class="welcome_logout" href="php/logout.php">&nbsp;[LOGOUT]&nbsp;</a>
									</td>
								</tr></table>
							';//end echo
						}//end if
						?>
					</td>
				</tr>
        
			  <!--The following code will display the shadow if the page is setup to display it in the <HEAD> section-->
				
				
			</table>
			<!--END header format table-->
		</td></tr>
		<!--END Main Header Row-->
	
		<!--Main Body Row-->
		<tr>
			<td width="750" valign="top" align="left">
				
				<!--Main Body Table-->
				<table width="100%" bgcolor="#FFFFFF" border="0" cellpadding="0" cellspacing="0">
					
					<tr>
						<td colspan="3" bgcolor="#5CA758" background="images/1x1_green.gif">&nbsp;</td>
					</tr>
					
					<tr>
						<td width="75" bgcolor="#5CA758" background="images/1x1_green.gif"></td>
						<td width="600" height="350" align="left" valign="top" class="main_body_cell">
							<!-- InstanceBeginEditable name="body" -->
			<table width="100%" cellpadding="4" cellspacing="0" border="0">
				<tr>
					<td width="100%">
						<p align="center" class="section_title">Z-MEN History</p>
						<p align="left">
					      It all started with a young boy, his family, and
						      a dream. Z-MEN Lawn Care sprouted up during the early
						      90&#8217;s in the
						      small Southern Illinois town of Fairfield. Using
						      an old beat-up, hand me down push mower and determination,
						      Josh was on his way to living
						      out his dream. Josh has been helped and guided
						      along the way by his brother, Justin, and the seasoned
						      veteran father, John.<br />
				        </p>						<p align="left">Although the equipment was not the best in the beginning,
						  Z-MEN pushed their way to the top by providing excellent service to each
						  and every customer. Each yard and customer was given individual attention
						  to meet and exceed their specific needs.<br />
					    </p>
						<p align="left">Averaging 20 yards a year, Z-MEN stays busy. Although
						  they do not have as many yards as the bigger competitors, they provide
						  what bigger businesses can not provide; individual attention. It is important
						  for Z-MEN to build and maintain a personal and business relationship
						  with each customer, and that is what they do. Whether it is doing occasional
						  odd jobs or having a glass of lemonade with the customer, Z-MEN makes
						  sure they know their customers on a person level. <br />
					    </p>
						<p align="left">Over the years, Z-MEN has been recognized throughout
						  the community for their outstanding service. In 2000,
						  Josh received the Young Entrepreneur Award for his
						  hard work and innovative spirit in building
						  a small business from the ground up. Some of Z-MEN&#8217;s clients have
						  received Fairfield&#8217;s Yard-of-the-Month award. <br />
                          <br />
                          For almost 15 years Z-MEN has been providing a service
                          that has been hard to match by others. They plan to
                          continue to have a limited customer base so they can
                        focus on individual needs. </p>
						<p align="center">
					    <strong>Z-MEN Lawn Care &#8220;Your Grass Is Ours!&#8221;</strong></p>
						<p align="center"><img src="images/elders.jpg" width="150" height="97" /><br />
                          <br />
                      </p></td>
				</tr>
			</table>
							<!-- InstanceEndEditable -->
						</td>
						<td width="75" bgcolor="#5CA758" background="images/1x1_green.gif"></td>
					</tr>
					
					<tr>
						<td colspan="3" bgcolor="#5CA758" background="images/1x1_green.gif">&nbsp;</td>
					</tr>
					
				</table>
				<!--End Main Body Table-->			</td>
		</tr>
		<!--END Main Body Row-->
	
		<!--Main Footer Row-->
		<tr><td width="750" align="center">
			<table align="center"><tr><td align="center" style="color:#000000 ">Copyright &copy;2005 Z-MEN Lawn Care<br />All Rights Reserved</td></tr></table>
		</td></tr>
		<!--END Main Footer Row-->
	
		<!--Spacer row beneath footer-->
		<tr><td width="750" height="150">&nbsp;
		</td></tr>
		<!--END spacer Row-->
	
	</table>
	<!--END Main Page Table-->

</td>
</tr>
</table>
<!--END MAIN WEB-PAGE TABLE-->
</body>
<!-- InstanceEnd --></html>

<?php
//CLEAN-UP ROUTINES
	//unset();
?>