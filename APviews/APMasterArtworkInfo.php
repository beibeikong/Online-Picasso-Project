<?php if ( ! defined('PROJECTNAME')) exit(''); 
if(file_exists('./APmodules/checkUser.php'))
    require_once('./APmodules/checkUser.php');  // check if it is authenrized user
else
    die('0'); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Source Artwork Details - <?=PROJECTNAME?></title>
<link rel="stylesheet" href="./css/popup.css"/>
<link rel="stylesheet" href="./css/ArtworkInfo.css"/>
<script type="text/javascript" src="./js/popup.js"></script>
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>

<body onload="AutoSizePopup();">
<?php
require_once(APMODULES_PATH.'ArtworkInfo.php');
$obj = new ArtworkInfo();
?>
<table class="HeaderBar" cellspacing="0">
  <tr>
    <td class="Logo"><img src="./images/opp-emblem-corner.png" width="61" height="59" /></td>
    <td class="Title">Artwork Details</td>
    <td class="Toolbar">
      <table cellspacing="0" align="right">
        <tr>     
		  <td><a id="BtnClose" href="javascript:ClosePopup();">Close</a></td>
		</tr>
	  </table>
	</td>
  </tr>
</table>
<!---------------------------- start Artwork Details ---------------------------->
<table id="ArtworkInfo" cellspacing="0" align="center">
  <tr>
    <td id="ImgHolder"><img src="../mastergraphics/<?=substr($_POST['Masteropp'],0,7)?>/ythumbs/y<?=$obj->imgName($_POST['Masteropp'])?>.jpg" class="imageStyle" /><br/><small>Copyright © Estate of Pablo Picasso/<br/>Artists Rights Society (ARS), New York</small></td>
	<td id="InfoHolder">
	<table class="TabContainer" id="MenuTabs" cellspacing="0" align="center">
  <tr class="Tabs">
  	<td class="Active"><img src="./images/magnify-text.png"/>Details</td>
	<td class="EmptySpace">&nbsp;</td>
  </tr>
  <tr>
	<td class="Container" colspan="2"><table width="100%" cellpadding="0" cellspacing="0">
      <tr>
        <td class="InfoLabel">Title:</td> <td class="Info"><strong><font color="#800000"><?=$_POST['Title']?></font></strong></td>
      </tr>
      <tr>
        <td class="InfoLabel">Author:</td> <td class="Info"><?=$_POST['Author']?></td>
      </tr>
      <tr>
        <td class="InfoLabel">Date:</td> <td class="Info"><?=$_POST['Duration']?></td>
      </tr>
      <tr>
        <td class="InfoLabel">Medium:</td> <td class="Info"><?=$_POST['Medium']?></td>
      </tr>
      <tr>
        <td class="InfoLabel">Dimension:</td> <td class="Info"><?=$_POST['Dimension']?></td>
      </tr>
      <?php if($_POST['Collection']!='') { ?>
      <tr>
        <td class="InfoLabel">Collection:</td> <td class="Info"><?=$_POST['Collection']?></td>
      </tr>
      <?php }?>
      <tr> 
        <td class="InfoLabel">OPP<sub>M</sub></td> <td class="Info"><?=$_POST['Masteropp']?></td>
      </tr>
    </table></td>
  </tr>
</table>
	
	</td>
  </tr>	
</table>
<!---------------------------- end of Artwork Details ---------------------------->
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
