<?php if ( ! defined('PROJECTNAME'))
exit('');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Artwork Zoom - <?=PROJECTNAME?></title>
<link rel="stylesheet" href="./css/popup.css"/>
<link rel="stylesheet" href="./css/imgviewer.css"  type="text/css" />
<script type="text/javascript" src="./js/imgviewer.js" ></script>
<script type="text/javascript" src="./js/drag.js" ></script>
<script type="text/javascript" src="./js/popup.js"></script>
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>

<body onload="OnBodyLoad();">
<table class="HeaderBar" cellspacing="0">
  <tr>
    <td class="Logo"><img src="./images/opp-emblem-corner.png" width="61" height="59" /></td>
    <td class="Title">Artwork Zoom</td>
    <td class="Toolbar">
      <table cellspacing="0" align="right">
        <tr>
		  <td class="ZoomControls">
				<b>Zoom:</b>&nbsp;&nbsp;
				<select id="ZoomPercent" size="1">
					<option value="-1" selected="true">Auto Fit</option>
					<option value="100">100%</option>
					<option value="75"> 75%</option>
					<option value="50"> 50%</option>
				</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  </td>
		  <td><a id="BtnClose" href="javascript:ClosePopup();">Close</a></td>
		</tr>
	  </table>
	</td>
  </tr>
</table>
<? include("html_encoder_1.9.php");?>

<!---------------------------- start photo ---------------------------->
	<div id="ImgHolder">
		<img src="./images/blank.gif" id="FullSizeImageTail"/>
        <img src="http://picasso.shsu.edu/masterartworks/<?=substr($_GET['alpha'],0,7)?>/<?= $_GET['alpha']?>" id="FullSizeImage"/>
    </div>
<!---------------------------- end photo ---------------------------->

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