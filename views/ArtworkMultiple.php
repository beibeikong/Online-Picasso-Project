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
require_once(MODULES_PATH.'ArtworkCompare.php');
$obj = new ArtworkCompare();
$left = $obj->getData($_GET['left']);
$left_row = mysql_fetch_array($left);
$right = $obj->getData($_GET['right']);
$right_row = mysql_fetch_array($right);
$c=0; 
$oppArray = explode("_", $_GET['OPPs']);
foreach($oppArray as $opp)
  {
     $yr=substr($opp,4,2);
     $q=substr($opp,7);
     if($yr>73){ $year[$c]=1800+$yr; }
     else { $year[$c]=1900+$yr; }
     $oppImg[$c]="opp".$yr."-".$q;
     $c++;
     $num++;
  }
$yr=substr($_GET['left'],4,2);
$q=substr($_GET['left'],7);
if($yr>73) { $leftyear=1800+$yr; }
else { $leftyear=1900+$yr; }
$leftoppImg="opp".$yr."-".$q;
?>
 <?php
	if (isset($_SESSION['UserType'])) {
	if ($_SESSION['UserType'] == 'admin')
	{?>
<table id="ArtworkCompare" cellspacing="0" align="left">
 <td valign="top">
  <table border="0" align="center"  cellspacing="5">
  <?php $i=0; while($i < $num){
   if($oppImg[$i]==$leftoppImg) $i++; 
   if($i < $num) { ?>
   <tr>
    <td width="120">
     <table class="ThumbGallery">
      <tr>
       <td class="Pic"><a href="index.php?view=zoom&alpha=<?=$oppImg[$i].".jpg"?>&random=<?= $year[$i]*23?>" target="_blank" onclick="OpenWin(this.href, 'ArtworkZoom', 850, 600); return false;"><img src="../graphics/<?= $year[$i]?>/xthumbs/x<?=$oppImg[$i]?>.jpg" class="imageStyle"/></a>
       </td>
      </tr>
     </table>
    </td>
   <?php }?>
    <?php $i++; if($i < $num) { 
     if($oppImg[$i]==$leftoppImg) $i++;
     if($i < $num) { ?>
      <td width="120">
       <table class="ThumbGallery">
        <tr>
         <td class="Pic"><a href="index.php?view=zoom&alpha=<?=$oppImg[$i].".jpg"?>&random=<?= $year[$i]*23?>" target="_blank" onclick="OpenWin(this.href, 'ArtworkZoom', 850, 600); return false;"><img src="../graphics/<?= $year[$i]?>/xthumbs/x<?=$oppImg[$i]?>.jpg" class="imageStyle"/></a>
         </td>
        </tr>
       </table>
      </td>
     <?php }?>
    <?php $i++; } 
     if($i < $num) { 
      if($oppImg[$i]==$leftoppImg) $i++; 
      if($i < $num) { ?>
       <td width="120">
        <table class="ThumbGallery">
         <tr>
          <td class="Pic"><a href="index.php?view=zoom&alpha=<?=$oppImg[$i].".jpg"?>&random=<?= $year[$i]*23?>" target="_blank" onclick="OpenWin(this.href, 'ArtworkZoom', 850, 600); return false;"><img src="../graphics/<?= $year[$i]?>/xthumbs/x<?=$oppImg[$i]?>.jpg" class="imageStyle"/></a>
          </td>
         </tr>
        </table>
       </td>
     <?php }?>
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
  <table border="0" align="center"  cellspacing="5">
  <?php $i=0; while($i < $num){
   if($oppImg[$i]==$leftoppImg) $i++; 
   if($i < $num) { ?>
   <tr>
    <td width="120">
     <table class="ThumbGallery">
      <tr>
       <td class="Pic"><img="index.php?view=zoom&alpha=<?=$oppImg[$i].".jpg"?>&random=<?= $year[$i]*23?>" ><img src="../graphics/<?= $year[$i]?>/xthumbs/x<?=$oppImg[$i]?>.jpg" class="imageStyle"/></a>
       </td>
      </tr>
     </table>
    </td>
   <?php }?>
    <?php $i++; if($i < $num) { 
     if($oppImg[$i]==$leftoppImg) $i++;
     if($i < $num) { ?>
      <td width="120">
       <table class="ThumbGallery">
        <tr>
       <td class="Pic"><img="index.php?view=zoom&alpha=<?=$oppImg[$i].".jpg"?>&random=<?= $year[$i]*23?>" ><img src="../graphics/<?= $year[$i]?>/xthumbs/x<?=$oppImg[$i]?>.jpg" class="imageStyle"/></a>
         </td>
        </tr>
       </table>
      </td>
     <?php }?>
    <?php $i++; } 
     if($i < $num) { 
      if($oppImg[$i]==$leftoppImg) $i++; 
      if($i < $num) { ?>
       <td width="120">
        <table class="ThumbGallery">
         <tr>
       <td class="Pic"><img="index.php?view=zoom&alpha=<?=$oppImg[$i].".jpg"?>&random=<?= $year[$i]*23?>" ><img src="../graphics/<?= $year[$i]?>/xthumbs/x<?=$oppImg[$i]?>.jpg" class="imageStyle"/></a>
          </td>
         </tr>
        </table>
       </td>
     <?php }?>
    <?php $i++; } ?>
   </tr>
  <?php } ?>
  </table>
 </td>
</table>
<?php } }?>
</body>
</html></html>