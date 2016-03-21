<?php if ( ! defined('PROJECTNAME')) exit(''); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Terms & Conditions - <?=PROJECTNAME?></title>
<link rel="stylesheet" href="./css/popup.css"/>
<link rel="stylesheet" href="./css/Collaborators.css"/>
<script type="text/javascript" src="./js/popup.js"></script>
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>

<body onload="AutoSizePopup();">
<table class="HeaderBar" cellspacing="0">
  <tr>
    <td class="Logo"><img src="./images/opp-emblem-corner.png" width="61" height="59" /></td>
    <td class="Title">Terms of Use</td>
    <td class="Toolbar">
      <table cellspacing="0" align="right">
        <tr>
		  <td><a id="BtnClose" href="javascript:ClosePopup();">Close</a></td>
		</tr>
	  </table>
	</td>
  </tr>
</table>
<!---------------------------- start Copyright Details ---------------------------->
<center>
	<table class="TabContainer" cellspacing="0" align="center">
	    <tr class="Tabs">
		  <td class="Active"   id="TabLbl1"><a href="javascript:ChangeTab(1);"><img src="./images/magnify-art.png" />Disclaimer</a></td>
		  <td class="Inactive" id="TabLbl2"><a href="javascript:ChangeTab(2);"><img src="./images/magnify-text.png"/>ARS</a></td>
		  <td class="EmptySpace">&nbsp;</td>
		</tr>
		<tr>
		  <td class="Container" colspan="3">
		    <div id="Tab1">
			<h2>Important Note</h2>
		<p>The <b>Online Picasso Project</b>, established in April 1997, is an <u>academic publication</u> supported by research and development grants from the College of Humanities and Social Sciences at <b><a href="http://www.shsu.edu" target="_blank">SAM HOUSTON STATE UNIVERSITY</a></b>.</p>
		<p>Login access to the <b>Online Picasso Project</b> may be granted upon request on an individual basis.</p>
		<p>Sharing of the username/password with any individual other than the one it was assigned to will result in the permanent cancellation of the registration.</p>
		<p>Your login access to and use of the <b>Online Picasso Project</b> is subject to the following Terms and Conditions and all applicable laws.  By logging in to the <b>Online Picasso Project</b>, you accept, without limitation or qualification, the stated Terms and Conditions.</p>
		<h2>Terms and Conditions</h2>
		<p>The <b>Online Picasso Project</b> <u>must be referenced in your bibliography</u> as:</p>
               <p><font size="4">Mallen, Enrique, ed. Online Picasso Project. Sam Houston State University. Accessed 2014</font>.</p> 
                <p>Your use of the <b>Online Picasso Project</b> must be <u>restricted to educational and academic purposes</u> and <u>may not be used</u> for commercial purposes.</p>
                <p>The <b>Online Picasso Project</b> <u>neither warrants nor represents the authenticity of any or all of the artworks displayed</u> on the <b>Online Picasso Project</b>.</p>
                <p>You acknowledge that information published on the <b>Online Picasso Project</b> may contain inaccuracies or errors and we expressly exclude liability for any such inaccuracies or errors to the fullest extent permitted by law. Your use of any information published on the <b>Online Picasso Project</b> is entirely at your own risk, for which we shall not be liable. It shall be your own responsibility to ensure that any information available through the <b>Online Picasso Project</b> meet your specific requirements. </p>
                <p>You are <u>not permitted</u> to distribute, modify, transmit, reuse, repost, or use any text or graphic material published on the <b>Online Picasso Project</b> for public or commercial purposes, without the written permission of the <b>Online Picasso Project</b> and <a href="javascript:ChangeTab(2);AutoSizePopup();"><b>Artists Rights Society</b></a> (ARS).</p>
		</div>
		    <div id="Tab2"><center>
			<h2>Artists Rights Society</h2>
		<blockquote>
		<big><center>
			65 Bleecker Street<br/>
			New York, NY  10012<br/>
			(212) 420-9160<br/>
			
			<a href="http://www.arsny.com" target="_blank">http://www.arsny.com</a>
			</center>
		</big>
		</blockquote>
		
		</center></div>
		  </td>
		</tr>
	  </table>
</center>
<!---------------------------- end Copyright Details ---------------------------->
<center>
	<div class="Copyright" id="Copyright">
		<table width="100%" height="37" cellspacing="0">
			<tr>
				<td align="left" style="PADDING-LEFT: 10px">
					<font style="font-variant:small-caps; font-weight:bold"><?=PROJECTNAME?></font>
				</td>
				<td align="right" style="PADDING-RIGHT: 10px">
					© <?=START_YEAR?>-<?=date("Y")?>&nbsp;<?=COPYRIGHT?>
				</td>
			</tr>
	  </table>
	</div>
</center>

</body>
</html>
