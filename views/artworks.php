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
<link rel="stylesheet" href="./css/biography.css"/>
<script type="text/javascript" src="./js/popup.js"></script>
</head>
<body>
<?php
require_once(MODULES_PATH.'DatedArtworks.php');
$obj = new DatedArtworks($_GET);
$result = $obj->getData();?>
<table cellspacing="7" align="center" style="margin-bottom:20px ">
<?php while($row = mysql_fetch_array($result)){ ?>
<tr>
  <td width="120">
    <table class="ThumbGallery">
      <tr><td class="Pic"><a href="index.php?view=ArtworkInfo&OPPID=<?=$row['opp']?>" target="_blank" onclick="OpenWin(this.href, 'ArtworkInfo', 748, 550); return false;"> <?php
	if (isset($_SESSION['UserType'])) {
	if ($_SESSION['UserType'] == 'admin' || $row['notVerified'] == 0){
	?><img src="../graphics/<?= $_GET['startYear']?>/xthumbs/x<?=$obj->imgName($row['opp'])?>.jpg" class="imageStyle" title="<?=$row['title']?>"/><?php }
	  else{
	  ?><img src="https://picasso.shsu.edu/images/xopp-emblem-innershadow.jpg"/><?php
	  }
	   }?></a></td>
      </tr>
      <tr><td align="center" valign="middle">
	  <span class="OPP"><?=$row['opp']?></span><br />
	  <span class="category"><?=$row['category']?></span>
	  </td>
      </tr>
    </table>
  </td>
  <?php if($row = mysql_fetch_array($result)) { ?>
  <td width="120">
    <table class="ThumbGallery">
      <tr><td class="Pic"><a href="index.php?view=ArtworkInfo&OPPID=<?=$row['opp']?>" target="_blank" onclick="OpenWin(this.href, 'ArtworkInfo', 748, 550); return false;"> <?php
	if (isset($_SESSION['UserType'])) {
	if ($_SESSION['UserType'] == 'admin' || $row['notVerified'] == 0){
	?><img src="../graphics/<?= $_GET['startYear']?>/xthumbs/x<?=$obj->imgName($row['opp'])?>.jpg" class="imageStyle" title="<?=$row['title']?>"/><?php }
	  else{
	  ?><img src="https://picasso.shsu.edu/images/xopp-emblem-innershadow.jpg"/><?php
	  }
	   }?></a></td>
      </tr>
      <tr><td align="center" valign="middle">
	  <span class="OPP"><?=$row['opp']?></span><br />
	  <span class="category"><?=$row['category']?></span>
	  </td>
      </tr>
    </table>
  </td><?php }?>
  <?php if($row = mysql_fetch_array($result)) { ?>
  <td width="120">
    <table class="ThumbGallery">
      <tr><td class="Pic"><a href="index.php?view=ArtworkInfo&OPPID=<?=$row['opp']?>" target="_blank" onclick="OpenWin(this.href, 'ArtworkInfo', 748, 550); return false;"> <?php
	if (isset($_SESSION['UserType'])) {
	if ($_SESSION['UserType'] == 'admin' || $row['notVerified'] == 0){
	?><img src="../graphics/<?= $_GET['startYear']?>/xthumbs/x<?=$obj->imgName($row['opp'])?>.jpg" class="imageStyle" title="<?=$row['title']?>"/><?php }
	  else{
	  ?><img src="https://picasso.shsu.edu/images/xopp-emblem-innershadow.jpg"/><?php
	  }
	   }?></a></td>
      </tr>
      <tr><td align="center" valign="middle">
	  <span class="OPP"><?=$row['opp']?></span><br />
	  <span class="category"><?=$row['category']?></span>
	  </td>
      </tr>
    </table>
  </td><?php } else echo("&nbsp;");?>
  <?php if($row = mysql_fetch_array($result)) { ?>
  <td width="120">
    <table class="ThumbGallery">
      <tr><td class="Pic"><a href="index.php?view=ArtworkInfo&OPPID=<?=$row['opp']?>" target="_blank" onclick="OpenWin(this.href, 'ArtworkInfo', 748, 550); return false;"> <?php
	if (isset($_SESSION['UserType'])) {
	if ($_SESSION['UserType'] == 'admin' || $row['notVerified'] == 0){
	?><img src="../graphics/<?= $_GET['startYear']?>/xthumbs/x<?=$obj->imgName($row['opp'])?>.jpg" class="imageStyle" title="<?=$row['title']?>"/><?php }
	  else{
	  ?><img src="https://picasso.shsu.edu/images/xopp-emblem-innershadow.jpg"/><?php
	  }
	   }?></a></td>
      </tr>
      <tr><td align="center" valign="middle">
	  <span class="OPP"><?=$row['opp']?></span><br />
	  <span class="category"><?=$row['category']?></span>
	  </td>
      </tr>
    </table>
  </td><?php } else echo("&nbsp;");?>
  <?php if($row = mysql_fetch_array($result)) { ?>
  <td width="120">
    <table class="ThumbGallery">
      <tr><td class="Pic"><a href="index.php?view=ArtworkInfo&OPPID=<?=$row['opp']?>" target="_blank" onclick="OpenWin(this.href, 'ArtworkInfo', 748, 550); return false;"> <?php
	if (isset($_SESSION['UserType'])) {
	if ($_SESSION['UserType'] == 'admin' || $row['notVerified'] == 0){
	?><img src="../graphics/<?= $_GET['startYear']?>/xthumbs/x<?=$obj->imgName($row['opp'])?>.jpg" class="imageStyle" title="<?=$row['title']?>"/><?php }
	  else{
	  ?><img src="https://picasso.shsu.edu/images/xopp-emblem-innershadow.jpg"/><?php
	  }
	   }?></a></td>
      </tr>
      <tr><td align="center" valign="middle">
	  <span class="OPP"><?=$row['opp']?></span><br />
	  <span class="category"><?=$row['category']?></span>
	  </td>
      </tr>
    </table>
  </td><?php } else echo("&nbsp;");?>
</tr>
<?php } ?>
</table>

</body>
</html>