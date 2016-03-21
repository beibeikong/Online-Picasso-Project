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
  <title></title>
  <link rel="stylesheet" href="./css/ArtworkDisplay.css"/>
  <link rel="stylesheet" href=" ./css/ArtworkInfo.css"/>
  <link rel="stylesheet" href=" ./css/Reference1.css"/>
  <script type="text/javascript" src="./js/popup.js"></script> 
  <link rel="icon" href=" ./images/opp.ico" type="image/x-icon">
  <link rel="shortcut icon" href=" ./images/opp.ico" type="image/x-icon">
 </head>
 <body onload="AutoSizePopup();">
 <?php
 require_once(MODULES_PATH.'ArtworkInfo.php');
 $obj = new ArtworkInfo($_GET['OPPID']);
 $result = $obj->getData();
 $row = mysql_fetch_array($result);
 $mastercount = $obj->countmaster($row['opp']);
 ?>

  
    
   <?php
	if (isset($_SESSION['UserType'])) {
	if ($_SESSION['UserType'] == 'admin' || $_GET['notverified'] == 0)
	{?>
 <table border="0" align="left" cellspacing="5">
 <?php 
   $i=1; 
   while($i <= $_GET['num']){ ?>
   <tr>
    <td width="120">
     <table class="ThumbGallery">
      <tr>
       <td class="Pic"><a href="index.php?view=zoom&alpha=<?=$_GET['oppImg']?>-<?=$i?>&random=<?= $_GET['year']*23?>" target="_blank" onclick="OpenWin(this.href, 'ArtworkZoom', 850, 600); return false;"><img src="../graphics/<?= $_GET['year']?>/xthumbs/x<?=$_GET['oppImg']?>-<?=$i?>.jpg" class="imageStyle"/></a>
       </td>
      </tr>
     </table>
    </td>
    <?php 
     $i++; 
     if($i <= $_GET['num']) { ?>
    <td width="120">
     <table class="ThumbGallery">

      <tr>

       <td class="Pic"><a href="index.php?view=zoom&alpha=<?=$_GET['oppImg']?>-<?=$i?>&random=<?= $_GET['year']*23?>" target="_blank" onclick="OpenWin(this.href, 'ArtworkZoom', 850, 600); return false;"><img src="../graphics/<?= $_GET['year']?>/xthumbs/x<?=$_GET['oppImg']?>-<?=$i?>.jpg" class="imageStyle"/></a>
       </td>
      </tr>
     </table>
    </td>
    <?php 
     $i++; } ?>
    <?php 
     if($i <= $_GET['num']) { ?>
    <td width="120">
     <table class="ThumbGallery">
      <tr> 
       <td class="Pic"><a href="index.php?view=zoom&alpha=<?=$_GET['oppImg']?>-<?=$i?>&random=<?= $_GET['year']*23?>" target="_blank" onclick="OpenWin(this.href, 'ArtworkZoom', 850, 600); return false;"><img src="../graphics/<?= $_GET['year']?>/xthumbs/x<?=$_GET['oppImg']?>-<?=$i?>.jpg" class="imageStyle"/></a>
       </td>
      </tr>
     </table>
    </td>
    <?php 
     $i++; } ?>
   </tr>
 <?php } ?>

 </table>
      <?php } }?>
<!--
<?php
	if (isset($_SESSION['UserType'])) {
	if ($_SESSION['UserType'] == 'user')
	{?>
<table border="0" align="left" cellspacing="5">
 <?php 
   $i=1; 
   while($i <= $_GET['num']){ ?>
   <tr>
    <td width="120">
     <table class="ThumbGallery">
      <tr>
       <td class="Pic"><img="index.php?view=zoom&alpha=<?=$_GET['oppImg']?>-<?=$i?>&random=<?= $_GET['year']*23?>" ><img src="../graphics/<?= $_GET['year']?>/xthumbs/x<?=$_GET['oppImg']?>-<?=$i?>.jpg" class="imageStyle"/></a>
       </td>
      </tr>
     </table>
    </td>
    <?php 
     $i++; 
     if($i <= $_GET['num']) { ?>
    <td width="120">
     <table class="ThumbGallery">

      <tr>

       <td class="Pic"><img="index.php?view=zoom&alpha=<?=$_GET['oppImg']?>-<?=$i?>&random=<?= $_GET['year']*23?>" ><img src="../graphics/<?= $_GET['year']?>/xthumbs/x<?=$_GET['oppImg']?>-<?=$i?>.jpg" class="imageStyle"/></a>
       </td>
      </tr>
     </table>
    </td>
    <?php 
     $i++; } ?>
    <?php 
     if($i <= $_GET['num']) { ?>
    <td width="120">
     <table class="ThumbGallery">
      <tr> 
       <td class="Pic"><img="index.php?view=zoom&alpha=<?=$_GET['oppImg']?>-<?=$i?>&random=<?= $_GET['year']*23?>" ><img src="../graphics/<?= $_GET['year']?>/xthumbs/x<?=$_GET['oppImg']?>-<?=$i?>.jpg" class="imageStyle"/></a>
       </td>
      </tr>
     </table>
    </td>
    <?php 
     $i++; } ?>
   </tr>
 <?php } ?>

 </table>
      <?php } }?>
-->
</body>
</html>