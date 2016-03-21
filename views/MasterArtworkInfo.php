<?php if ( ! defined('PROJECTNAME')) exit('');
if(file_exists('./modules/checkFrontUser.php'))
    require_once('./modules/checkFrontUser.php');  // check if it is authenrized user
else
    die('0');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Artist Details - <?=PROJECTNAME?></title>
<link rel="stylesheet" href=" ./css/popup.css"/>
<link rel="stylesheet" href=" ./css/ArtworkInfo.css"/>
<link rel="stylesheet" href=" ./css/Reference1.css"/>
<script type="text/javascript" src=" ./js/popup.js"></script>
<link rel="icon" href=" ./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href=" ./images/opp.ico" type="image/x-icon">
</head>

<body onload="AutoSizePopup();">
<?php
require_once(MODULES_PATH.'MasterArtworkInfo.php');
$obj = new MasterArtworkInfo($_GET['MasterID']);
$result = $obj->getData();
$row = mysql_fetch_array($result);
?>
<table class="HeaderBar" cellspacing="0">
  <tr>
    <td class="Logo"><img src="./images/opp-emblem-corner.png" width="61" height="59" /></td>
    <td class="Title">Master Details</td>
    <td class="Toolbar">
      <table cellspacing="0" align="right">
        <tr>
	<?php
	if (isset($_SESSION['UserType'])) {
	if ($_SESSION['UserType'] == 'admin')
	{?>
          <td><a id="BtnZoom" href="index.php?view=Masterzoom&alpha=<?=$obj->imgName($_GET['MasterID'])?>" target="_blank" onclick="OpenWin(this.href, 'MasterZoom', 850, 600); return false;">Zoom</a></td>
                <?php } }?>         
	 <?php if(trim($row['commentary'])!="") { ?>
		  <td><a id="NtAndComtry" href="index.php?view=MasterCommentary&MasterID=<?=$_GET['MasterID']?>" target="_self"  return false;">Commentary</a></td>
          <?php } ?>
		  <td><a id="BtnClose" href="javascript:ClosePopup();">Close</a></td>
		</tr>
	  </table>
	</td>
  </tr>
</table>
<!---------------------------- start Artwork Details ---------------------------->
<table id="ArtworkInfo" cellspacing="0" align="center">
  <tr>
	<?php
	if (isset($_SESSION['UserType'])) {
	if ($_SESSION['UserType'] == 'admin')
	{?>
    <td id="ImgHolder"><br /><a href="index.php?view=Masterzoom&alpha=<?=$obj->imgName($_GET['MasterID'])?>" target="_blank" onclick="OpenWin(this.href, 'ArtworkZoom', 850, 600); return false;"><img src="../mastergraphics/<?=substr($row['masteropp'],0,7)?>/ythumbs/y<?=$obj->imgName($row['masteropp'])?>.jpg" class="imageStyle" title="<?=$row['title']?>"/></a><br/><small>Copyright © Artists Rights Society (ARS), New York</small></td>
	      <?php } }?>
	<?php
	if (isset($_SESSION['UserType'])) {
	if ($_SESSION['UserType'] == 'user')
	{?>	
    <td id="ImgHolder"><br /><img="index.php?view=Masterzoom&alpha=<?=$obj->imgName($_GET['MasterID'])?>" ><img src="../mastergraphics/<?=substr($row['masteropp'],0,7)?>/ythumbs/y<?=$obj->imgName($row['masteropp'])?>.jpg" class="imageStyle" title="<?=$row['title']?>"/></a><br/><small>Copyright © Artists Rights Society (ARS), New York</small></td>
	      <?php } }?>
<td id="InfoHolder">
		<table class="TabContainer" id="MenuTabs" cellspacing="0" align="center">
  			<tr class="Tabs">
  				<td class="Active"><img src="./images/magnify-text.png"/>Details</td>
				<td class="EmptySpace">&nbsp;</td>
  			</tr>
  			<tr>
				<td class="Container" colspan="2">
					<table width="100%" cellpadding="0" cellspacing="0">
      					<tr>
        					<td class="InfoLabel">Title:</td>
							<td class="Info"><strong><font color="#800000"><?=$row['title']?></font></strong></td>
      					</tr>
      					<tr>
        					<td class="InfoLabel">Author:</td> <td class="Info"><?=$row['author']?></td>
      					</tr>
      					<tr>
        					<td class="InfoLabel">Date:</td> <td class="Info"><?=$row['duration']?></td>
      					</tr>
      					<tr>
        					<td class="InfoLabel">Medium:</td> <td class="Info"><?=$row['medium']?></td>
      					</tr>
      					<tr>
        					<td class="InfoLabel">Dimension:</td> <td class="Info"><?=$row['dimension']?></td>
      					</tr>
      					<tr>
       	 					<td class="InfoLabel">Collection:</td> <td class="Info"><?=$row['collection']?></td>
      					</tr>    				</table>
				</td>
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

