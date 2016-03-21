<?php if ( ! defined('PROJECTNAME')) exit(''); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Contact - <?=PROJECTNAME?></title>
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
    <td class="Title">Contact</td>
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
		  <td class="Active"   id="TabLbl1"><img src="./images/magnify-art.png" />Contact Info</td>
		  <td class="EmptySpace">&nbsp;</td>
		</tr>
		<tr>
		  <td class="Container1" colspan="2">
<div id="Tab1">
<div id="ContactCard">
	<b><a href="./mallen/PUBLICATIONS.html" onclick="OpenWin(this.href, this.target, 780, 600); return false;">Professor Dr. Enrique Mallen</a></b><br/>
	Director & General Editor, <b>Online Picasso Project</b><br/>
	E-mail:&nbsp;<a href="mailto:online.picasso.project@gmail.com">online.picasso.project@gmail.com</a>
</div>
</div>
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
