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
<title>Master Commentary - <?=PROJECTNAME?></title>
<link rel="stylesheet" href="./css/popup.css"/>
<link rel="stylesheet" href="./css/ArtworkNote.css"/>
<script type="text/javascript" src="./js/popup.js"></script>
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>

<body onresize="resizeNote();">
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
          <td><a id="BtnZoom" href="index.php?view=Masterzoom&alpha=<?=$obj->imgName($_GET['MasterID'])?>" target="_blank" onclick="OpenWin(this.href, 'MasterZoom', 850, 600); return false;">Zoom</a></td>
          <?php if(trim($row['commentary'])!="") { ?>
<td><a id="NtAndComtry" href="index.php?view=MasterArtworkInfo&MasterID=<?=$row['masteropp']?>" target="_self"  return false;">Artwork</a></td>
          <?php } ?>
		  <td><a id="BtnClose" href="javascript:ClosePopup();">Close</a></td>
		</tr>
	  </table>
	</td>
  </tr>
</table>
<!---------------------------- start Artwork Details ---------------------------->
<table id="ArtworkInfo" cellspacing="0" align="center" width="100%" border="0">
  <tr>
   <td  align="center" valign="top"   id="ImgHolder"><br /><a href="index.php?view=Masterzoom&alpha=<?=$obj->imgName($_GET['MasterID'])?>" target="_blank" onclick="OpenWin(this.href, 'ArtworkZoom', 850, 600); return false;"><img src="../mastergraphics/<?=substr($row['masteropp'],0,7)?>/ythumbs/y<?=$obj->imgName($row['masteropp'])?>.jpg" class="imageStyle" title="<?=$row['title']?>"/></a><br/><small><font color="#808080">Copyright © Estate of Pablo Picasso/<br/>Artists Rights Society (ARS), New York</font></small>
   </td>
<td  align="left" valign="top"> 
<iframe id="noteiframe" class="iframeNote" src ="index.php?view=mcommentary&MasterID=<?=$_GET['MasterID']?>" width="100%" height="440px"  scrolling="auto" frameborder="0">
</iframe>
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
