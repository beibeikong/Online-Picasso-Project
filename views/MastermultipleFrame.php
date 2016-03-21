<!---------------------------- this is the notes page ---------------------------->
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
<title>Multiple View - <?=PROJECTNAME?></title>
<link rel="stylesheet" href="./css/ArtworkNote.css"/>
<link rel="stylesheet" href="./css/ArtworkDisplay.css"/>
<script type="text/javascript" src="./js/popup.js"></script>
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>
<body  onresize="resizeNote();">
<?php
require_once(MODULES_PATH.'ArtworkMaster.php');
$obj = new ArtworkMaster();
$opp = $_GET['OPPID'];

$MasterOPPList = $obj->getMasters($_GET['OPPID']);
?>
<?php
	$yr=substr($opp,4,2);
	$q=substr($opp,7);
	if($yr>73)
	{
		$oppyear=1800+$yr;
	}else{
		$oppyear=1900+$yr;
	}
	$oppImg="opp".$yr."-".$q;
	
	$num=count($MasterOPPList);
	$c=0;
	foreach($MasterOPPList as $master) {
		$mastername[$c]=substr($master,0,7);
		$masternum[$c]=substr($master,8);
		$masterImg[$c]=$mastername[$c]."-".$masternum[$c];
		$c++;
	}
?>
   <?php
	if (isset($_SESSION['UserType'])) {
	if ($_SESSION['UserType'] == 'admin')
	{?>
<table id="ArtworkCompare" cellspacing="0" align="left">
	<td valign="top">
<?php $i=0; while($i < $num){ ?>
<tr>
  <td width="120">
    <table class="ThumbGallery">
      <tr><td class="Pic"><a href="index.php?view=Masterzoom&alpha=<?=$masterImg[$i]?>" target="_blank" onclick="OpenWin(this.href, 'MasterZoom', 850, 600); return false;"><img src="../mastergraphics/<?= $mastername[$i]?>/xthumbs/x<?=$masterImg[$i]?>.jpg" class="imageStyle"/></a></td>
      </tr>
    </table>
  </td>
  <?php $i++; if($i < $num) { ?>
  <td width="120">
    <table class="ThumbGallery">
      <tr><td class="Pic"><a href="index.php?view=Masterzoom&alpha=<?=$masterImg[$i]?>" target="_blank" onclick="OpenWin(this.href, 'MasterZoom', 850, 600); return false;"><img src="../mastergraphics/<?= $mastername[$i]?>/xthumbs/x<?=$masterImg[$i]?>.jpg" class="imageStyle"/></a></td>
      </tr>
    </table>
  </td>
  <?php $i++; } ?>
  <?php if($i < $num) { ?>
  <td width="120">
    <table class="ThumbGallery">
      <tr><td class="Pic"><a href="index.php?view=Masterzoom&alpha=<?=$masterImg[$i]?>" target="_blank" onclick="OpenWin(this.href, 'MasterZoom', 850, 600); return false;"><img src="../mastergraphics/<?= $mastername[$i]?>/xthumbs/x<?=$masterImg[$i]?>.jpg" class="imageStyle"/></a></td>
      </tr>
    </table>
  </td>
  <?php $i++; } ?>

</tr>
<?php } ?>
</table>
 </td>
</table>
      <?php } }?>
<?php
	if (isset($_SESSION['UserType'])) {
	if ($_SESSION['UserType'] == 'user')
	{?>
<table id="ArtworkCompare" cellspacing="0" align="left">
	<td valign="top">
<?php $i=0; while($i < $num){ ?>
<tr>
  <td width="120">
    <table class="ThumbGallery">
      <tr><td class="Pic"><img="index.php?view=Masterzoom&alpha=<?=$masterImg[$i]?>"><img src="../mastergraphics/<?= $mastername[$i]?>/xthumbs/x<?=$masterImg[$i]?>.jpg" class="imageStyle"/></a></td>
      </tr>
    </table>
  </td>
  <?php $i++; if($i < $num) { ?>
  <td width="120">
    <table class="ThumbGallery">
      <tr><td class="Pic"><img="index.php?view=Masterzoom&alpha=<?=$masterImg[$i]?>"><img src="../mastergraphics/<?= $mastername[$i]?>/xthumbs/x<?=$masterImg[$i]?>.jpg" class="imageStyle"/></a></td>
      </tr>
    </table>
  </td>
  <?php $i++; } ?>
  <?php if($i < $num) { ?>
  <td width="120">
    <table class="ThumbGallery">
      <tr><td class="Pic"><img="index.php?view=Masterzoom&alpha=<?=$masterImg[$i]?>"><img src="../mastergraphics/<?= $mastername[$i]?>/xthumbs/x<?=$masterImg[$i]?>.jpg" class="imageStyle"/></a></td>
      </tr>
    </table>
  </td>
  <?php $i++; } ?>

</tr>
<?php } ?>
</table>
 </td>
</table>
      <?php } }?>
</body>
</html>