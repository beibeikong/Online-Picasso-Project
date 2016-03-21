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
<title>Catalogue of <?=$_GET['year']?> - On-line Picasso Project</title>
<link rel="stylesheet" href="./css/ArtworkPrintNew.css"/>
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>

<body>
<?php
require_once(MODULES_PATH.'ArtworkPrint.php');
$obj = new ArtworkPrint($_GET);
$result = $obj->getData();
?>
<center><div class="TitlePage">
  <img src="./images/opp-emblem-whitebackground.png" width="100" height="91" alt=""/>
  <span class="Title"><?=PROJECTNAME?></span>
  <span class="SubTitle">Comprehensive Illustrated Catalogue<br/><?=$_GET['year']?></span>
  <span class="Copyright">Copyright&nbsp;&copy;&nbsp;<?=START_YEAR?>-<?=date("Y")?>&nbsp;Prof. Dr. Enrique Mallen</span>
</div>

<?php while($row = mysql_fetch_array($result)){ ?>
<div class="Page"><center>
 <div class="PageInside">
<table width="100%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
  <td width="120"  height="130" align="left" valign="middle" style="padding:4px">
	  <div class="ThumbGallery"><table class="Pic"><tr><td width="100%"><img src="../graphics/<?= $_GET['year']?>/xthumbs/x<?=$obj->imgName($row['opp'])?>.jpg" title="<?=$row['title']?>"/></td></tr></table>
	  <span class="CatID"><?php echo($row['opp']); ?></span></div>
	</td>
	 <td  height="130" align="center" valign="middle" style="padding:4px ">
	  <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" >
	    <tr><td class="InfoHolder">
	   <span><strong><font color="#800000"><?=$obj->parseTextTM($row['title'])?>.</font></strong></span>
	   <?=$row['location']?>.
	   <?=$row['duration']?>.
	   <span class="MediumDim"><?=$obj->parseTextTM($row['medium'])?>.
	   <?=$row['dimension']?>.</span>
	   <?=$row['collection']?>.
	   <?php if($row['inventory']!='') { ?> <?=$row['inventory']?>. <?php } ?>
	   <br><hr align="left" width="70"/><strong><font color="#800000"><?=$row['opp']?></font></strong><?php  $result1 = $obj->getCatalog($row['opp']); foreach($result1 as $cata) echo("; ".$cata); if($row['bookCatalog']!='') echo("; ".$obj->sortBooks($row['bookCatalog']));?>
	  </td></tr></table>
	</td>
  </tr>
	<tr>
  <td width="120"  height="130" align="left" valign="middle" style="padding:4px"><?php if($row = mysql_fetch_array($result)) { ?>
	  <div class="ThumbGallery"><table class="Pic"><tr><td width="100%"><img src="../graphics/<?= $_GET['year']?>/xthumbs/x<?=$obj->imgName($row['opp'])?>.jpg" title="<?=$row['title']?>"/></td></tr></table>
	  <span class="CatID"><?php echo($row['opp']); ?></span></div>
	</td>
	 <td  height="130" align="center" valign="middle" style="padding:4px ">
	  <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" >
	    <tr><td class="InfoHolder">
	   <span><strong><font color="#800000"><?=$obj->parseTextTM($row['title'])?>.</font></strong></span>
	   <?=$row['location']?>.
	   <?=$row['duration']?>.
	   <span class="MediumDim"><?=$obj->parseTextTM($row['medium'])?>.
	   <?=$row['dimension']?>.</span>
	   <?=$row['collection']?>.
	   <?php if($row['inventory']!='') { ?> <?=$row['inventory']?>. <?php } ?>
	   <br><hr align="left" width="70"/><strong><font color="#800000"><?=$row['opp']?></font></strong><?php  $result1 = $obj->getCatalog($row['opp']); foreach($result1 as $cata) echo("; ".$cata); if($row['bookCatalog']!='') echo("; ".$obj->sortBooks($row['bookCatalog']));?>
	  </td></tr></table>
	</td><?php } else echo("&nbsp;");?>
  </tr>
  
  <tr>
  <td width="120"  height="130" align="left" valign="middle" style="padding:4px"><?php if($row = mysql_fetch_array($result)) { ?>
	  <div class="ThumbGallery"><table class="Pic"><tr><td width="100%"><img src="../graphics/<?= $_GET['year']?>/xthumbs/x<?=$obj->imgName($row['opp'])?>.jpg" title="<?=$row['title']?>"/></td></tr></table>
	  <span class="CatID"><?php echo($row['opp']); ?></span></div>
	</td>
	 <td  height="130" align="center" valign="middle" style="padding:4px ">
	  <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" >
	    <tr><td class="InfoHolder">
	   <span><strong><font color="#800000"><?=$obj->parseTextTM($row['title'])?>.</font></strong></span>
	   <?=$row['location']?>.
	   <?=$row['duration']?>.
	   <span class="MediumDim"><?=$obj->parseTextTM($row['medium'])?>.
	   <?=$row['dimension']?>.</span>
	   <?=$row['collection']?>.
	   <?php if($row['inventory']!='') { ?> <?=$row['inventory']?>. <?php } ?>
	   <br><hr align="left" width="70"/><strong><font color="#800000"><?=$row['opp']?></font></strong><?php  $result1 = $obj->getCatalog($row['opp']); foreach($result1 as $cata) echo("; ".$cata); if($row['bookCatalog']!='') echo("; ".$obj->sortBooks($row['bookCatalog']));?>
	  </td></tr></table>
	</td><?php } else echo("&nbsp;");?>
  </tr>
  <tr>
  <td width="120"  height="130" align="left" valign="middle" style="padding:4px"><?php if($row = mysql_fetch_array($result)) { ?>
	  <div class="ThumbGallery"><table class="Pic"><tr><td width="100%"><img src="../graphics/<?= $_GET['year']?>/xthumbs/x<?=$obj->imgName($row['opp'])?>.jpg" title="<?=$row['title']?>"/></td></tr></table>
	  <span class="CatID"><?php echo($row['opp']); ?></span></div>
	</td>
	 <td  height="130" align="center" valign="middle" style="padding:4px ">
	  <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" >
	    <tr><td class="InfoHolder">
	   <span><strong><font color="#800000"><?=$obj->parseTextTM($row['title'])?>.</font></strong></span>
	   <?=$row['location']?>.
	   <?=$row['duration']?>.
	   <span class="MediumDim"><?=$obj->parseTextTM($row['medium'])?>.
	   <?=$row['dimension']?>.</span>
	   <?=$row['collection']?>.
	   <?php if($row['inventory']!='') { ?> <?=$row['inventory']?>. <?php } ?>
	   <br><hr align="left" width="70"/><strong><font color="#800000"><?=$row['opp']?></font></strong><?php  $result1 = $obj->getCatalog($row['opp']); foreach($result1 as $cata) echo("; ".$cata); if($row['bookCatalog']!='') echo("; ".$obj->sortBooks($row['bookCatalog']));?>
	  </td></tr></table>
	</td><?php } else echo("&nbsp;");?>
  </tr>
  <tr>
  <td width="120"  height="130" align="left" valign="middle" style="padding:4px"><?php if($row = mysql_fetch_array($result)) { ?>
	  <div class="ThumbGallery"><table class="Pic"><tr><td width="100%"><img src="../graphics/<?= $_GET['year']?>/xthumbs/x<?=$obj->imgName($row['opp'])?>.jpg" title="<?=$row['title']?>"/></td></tr></table>
	  <span class="CatID"><?php echo($row['opp']); ?></span></div>
	</td>
	 <td  height="130" align="center" valign="middle" style="padding:4px ">
	  <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" >
	    <tr><td class="InfoHolder">
	   <span><strong><font color="#800000"><?=$obj->parseTextTM($row['title'])?>.</font></strong></span>
	   <?=$row['location']?>.
	   <?=$row['duration']?>.
	   <span class="MediumDim"><?=$obj->parseTextTM($row['medium'])?>.
	   <?=$row['dimension']?>.</span>
	   <?=$row['collection']?>.
	   <?php if($row['inventory']!='') { ?> <?=$row['inventory']?>. <?php } ?>
	   <br><hr align="left" width="70"/><strong><font color="#800000"><?=$row['opp']?></font></strong><?php  $result1 = $obj->getCatalog($row['opp']); foreach($result1 as $cata) echo("; ".$cata); if($row['bookCatalog']!='') echo("; ".$obj->sortBooks($row['bookCatalog']));?>
	  </td></tr></table>
	</td><?php } else echo("&nbsp;");?>
  </tr>
  <tr>
  <td width="120"  height="130" align="left" valign="middle" style="padding:4px"><?php if($row = mysql_fetch_array($result)) { ?>
	  <div class="ThumbGallery"><table class="Pic"><tr><td width="100%"><img src="../graphics/<?= $_GET['year']?>/xthumbs/x<?=$obj->imgName($row['opp'])?>.jpg" title="<?=$row['title']?>"/></td></tr></table>
	  <span class="CatID"><?php echo($row['opp']); ?></span></div>
	</td>
	 <td  height="130" align="center" valign="middle" style="padding:4px ">
	  <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" >
	    <tr><td class="InfoHolder">
	   <span><strong><font color="#800000"><?=$obj->parseTextTM($row['title'])?>.</font></strong></span>
	   <?=$row['location']?>.
	   <?=$row['duration']?>.
	   <span class="MediumDim"><?=$obj->parseTextTM($row['medium'])?>.
	   <?=$row['dimension']?>.</span>
	   <?=$row['collection']?>.
	   <?php if($row['inventory']!='') { ?> <?=$row['inventory']?>. <?php } ?>
	   <br><hr align="left" width="70"/><strong><font color="#800000"><?=$row['opp']?></font></strong><?php  $result1 = $obj->getCatalog($row['opp']); foreach($result1 as $cata) echo("; ".$cata); if($row['bookCatalog']!='') echo("; ".$obj->sortBooks($row['bookCatalog']));?>
	  </td></tr></table>
	</td><?php } else echo("&nbsp;");?>
  </tr>
</table>
</div>
</center>
  <div class="PageFooter" align="center">Copyright&nbsp;&copy;&nbsp;<?=START_YEAR?>-<?=date("Y")?>&nbsp;Prof. Dr. Enrique Mallen</div>
</div>
<?php } ?>

</center></body>
</html>
