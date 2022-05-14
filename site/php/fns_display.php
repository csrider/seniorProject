<?php

//START-UP ROUTINES

/*
//DISPLAY HEADER CONTAINING THE TITLE BAR AND MENU AREAS (NO SHADOW)
function display_header() {
	echo '
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
					<td width="75" height="23" align="left"><a href="../index.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('home','','images/home_btn_f2.gif',1)"><img src="images/home_btn.gif" alt="Home" name="home" width="75" height="23" border="0" id="home" /></a></td>
					<td width="4" height="23" bgcolor="#5CA758" background="images/1x1_green.gif"></td>
					<td width="75" height="23" align="left"><a href="services.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('services','','images/svcs_btn_f2.gif',1)"><img src="images/svcs_btn.gif" alt="Services" name="services" width="75" height="23" border="0" id="services" /></a></td>
					<td width="4" height="23" bgcolor="#5CA758" background="images/1x1_green.gif"></td>
					<td width="75" height="23" align="left"><a href="links.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('links','','images/links_btn_f2.gif',1)"><img src="images/links_btn.gif" alt="Links" name="links" width="75" height="23" border="0" id="links" /></a></td>
					<td width="4" height="23" bgcolor="#5CA758" background="images/1x1_green.gif"></td>
					<td width="75" height="23" align="left"><a href="testimonials.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('testimonials','','images/testimonial_btn_f2.gif',1)"><img src="images/testimonial_btn.gif" alt="Testimonials" name="testimonials" width="75" height="23" border="0" id="testimonials" /></a></td>
					<td width="4" height="23" bgcolor="#5CA758" background="images/1x1_green.gif"></td>
					<td width="75" height="23" align="left"><a onmouseout="MM_swapImgRestore();MM_startTimeout();" onmouseover="MM_showMenu(window.mm_menu_0328165336_0,319,158,null,'zmen_r5_c12');MM_swapImage('about','','images/zmen_r5_c12_f2.gif',1)"><img src="images/zmen_r5_c12.gif" alt="About Us" name="about" width="75" height="23" border="0" id="about" /></a></td>
					<td width="4" height="23" bgcolor="#5CA758" background="images/1x1_green.gif"></td>
					<td width="75" height="23" align="left"><a href="contact_us.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('contact','','images/contact_btn_f2.gif',1)"><img src="images/contact_btn.gif" alt="Contact Us" name="contact" width="75" height="23" border="0" id="contact" /></a></td>
					<td width="279" height="23" align="left"><img src="images/your_grass.gif" width="279" height="23" /></td>
				</tr>
				<tr>
					<td height="17" width="750" colspan="13"><img height="17" width="750" src="images/white_bar.gif" /></td>
				</tr>
			</table>
	';
}
*/

//DISPLAY LOGGED-IN FOOTER BAR (green one used on payment screens and such)
function display_footer1() {
	echo '
	<table width="100%" cellpadding="0" cellspacing="0" align="center">
		<tr>
		 <hr color="#FFFF00">
	 	 <td valign="bottom" align="center" bgcolor="#5ca758"><font size="+2" color="#FFFF00"><b>THANK YOU</b> For Using Z-MEN Lawn Care Service!</font></td>
   	</tr>
		<tr>	   	  
	  	<td valign="bottom" align="center" bgcolor="#5ca758"><font color="#FFFF00">Contact us at (812) 555-5555</font></td>
   	</tr>
	</table>
	';
}

?>