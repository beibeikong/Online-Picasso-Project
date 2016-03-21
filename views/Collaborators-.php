<?php if ( ! defined('PROJECTNAME')) exit(''); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Collaborators - <?=PROJECTNAME?></title>
<link rel="stylesheet" href="./css/popup.css"/>
<link rel="stylesheet" href="./css/Collaborators.css"/>
<script type="text/javascript" src="./js/popup.js"></script>
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>

<body onload="AutoSizePopup();">
<?php
require_once(MODULES_PATH.'Collaborators.php');
$obj = new Collaborators();
$Category = $obj->getCategory();
//$row = mysql_fetch_array($result);
?>
<table class="HeaderBar" cellspacing="0">
  <tr>
    <td class="Logo"><img src="./images/opp-emblem-corner.png" width="61" height="59" /></td>
    <td class="Title">Collaborators</td>
    <td class="Toolbar">
      <table cellspacing="0" align="right">
        <tr>
		  <td><a id="BtnClose" href="javascript:ClosePopup();">Close</a></td>
		</tr>
	  </table>
	</td>
  </tr>
</table>
<!---------------------------- start Collaborators Details ---------------------------->
<div class="TextField">
<?php while($row = mysql_fetch_array($Category)){ ?>
<h2><?=$row['Category']?></h2>
<blockquote>
<ul>
<?php $info = $obj->getInfo($row['Category']); while($row1 = mysql_fetch_array($info)){ ?>
  <li>
    <b><?=$row1['Title']?>&nbsp;<?=$row1['Name']?></b>,&nbsp;<?=$row1['Position']?>,&nbsp;<?=$row1['Place']?>
  </li>
<?php } ?>
</ul>
</blockquote>
<?php } ?>

</div>
<!---------------------------- end Collaborators Details ---------------------------->
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
