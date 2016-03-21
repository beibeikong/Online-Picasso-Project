<?php if ( ! defined('PROJECTNAME')) exit(''); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>References Letter Index - <?=PROJECTNAME?></title>
<link rel="stylesheet" href="./css/menu.css"/>
<script type="text/javascript" src="./js/menu.js"></script>
</head>

<body onload="Initialize('Biography Year Index'); AutoSizePopup();">
<table class="HeaderBar" cellspacing="0">
  <tr>
    <td class="Logo"><img src="./images/opp-emblem-corner.png" width="61" height="59" /></td>
    <td class="Title">References</td>
    <td class="Toolbar">
      <table cellspacing="0" align="right">
        <tr>
		  <td><a id="BtnExtrn" href="#" onclick="OpenWin(this.href,'OPPMenu',550,320); return false;">External Pop-Up</a></td>
		  <td><a id="BtnClose" href="javascript:ClosePopup();">Close</a></td>
		</tr>
	  </table>
	</td>
  </tr>
</table>
<center>
<table class="TabContainer" id="MenuTabs" cellspacing="0" align="center">
  <tr class="Tabs">
  	<td class="Active"><img src="./images/magnify-art.png"/>Letter Index</td>
	<td class="Inactive"><a href="index.php?view=MenuReferencesSearch"><img src="./images/magnify-text.png"/>Literature</a></td>
        <td class="Inactive"><a href="index.php?view=MenuExhibitedSearch"><img src="./images/magnify-text.png"/>Exhibited</a></td>
<!--	<td class="EmptySpace">&nbsp;</td> -->
  </tr>
  
  <tr>
	<td class="Container" colspan="3">
	<table class="YearIndex" align="center">
      <tr>
        <td><a href="index.php?view=Reference&letter=A" target="OPPMain">A</a></td>
        <td><a href="index.php?view=Reference&letter=B" target="OPPMain">B</a></td>
        <td><a href="index.php?view=Reference&letter=C" target="OPPMain">C</a></td>
        <td><a href="index.php?view=Reference&letter=D" target="OPPMain">D</a></td>
        <td><a href="index.php?view=Reference&letter=E" target="OPPMain">E</a></td>
        <td><a href="index.php?view=Reference&letter=F" target="OPPMain">F</a></td>
        <td><a href="index.php?view=Reference&letter=G" target="OPPMain">G</a></td>
        <td><a href="index.php?view=Reference&letter=H" target="OPPMain">H</a></td>
        <td><a href="index.php?view=Reference&letter=I" target="OPPMain">I</a></td>
        <td><a href="index.php?view=Reference&letter=J" target="OPPMain">J</a></td>
		<td><a href="index.php?view=Reference&letter=K" target="OPPMain">K</a></td>
		<td><a href="index.php?view=Reference&letter=L" target="OPPMain">L</a></td>
		<td><a href="index.php?view=Reference&letter=M" target="OPPMain">M</a></td>
		<td><a href="index.php?view=Reference&letter=N" target="OPPMain">N</a></td>
		<td><a href="index.php?view=Reference&letter=O" target="OPPMain">O</a></td>
		<td><a href="index.php?view=Reference&letter=P" target="OPPMain">P</a></td>
		<td><a href="index.php?view=Reference&letter=Q" target="OPPMain">Q</a></td>
		<td><a href="index.php?view=Reference&letter=R" target="OPPMain">R</a></td>
		<td><a href="index.php?view=Reference&letter=S" target="OPPMain">S</a></td>
		<td><a href="index.php?view=Reference&letter=T" target="OPPMain">T</a></td>
		<td><a href="index.php?view=Reference&letter=U" target="OPPMain">U</a></td>
		<td><a href="index.php?view=Reference&letter=V" target="OPPMain">V</a></td>
		<td><a href="index.php?view=Reference&letter=W" target="OPPMain">W</a></td>
		<td><a href="index.php?view=Reference&letter=X" target="OPPMain">X</a></td>
		<td><a href="index.php?view=Reference&letter=Y" target="OPPMain">Y</a></td>
		<td><a href="index.php?view=Reference&letter=Z" target="OPPMain">Z</a></td>
      </tr>
    </table></td>
  </tr>
</table>
</center>

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
