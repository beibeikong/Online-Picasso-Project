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
<link rel="stylesheet" href="./css/ArtworkPrint.css"/>
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>

<body>
<?php
require_once(MODULES_PATH.'ArtworkPrint.php');
$obj = new ArtworkPrint($_GET);
$result = $obj->getData();
?>
<center>
<div class="TitlePage">
  <img src="./images/opp-emblem-whitebackground.png" width="100" height="91" alt=""/>
  <span class="Title"><?=PROJECTNAME?></span>
  <span class="SubTitle">Comprehensive Illustrated Catalogue<br/><?=$_GET['year']?></span>
  <span class="Copyright">Copyright&nbsp;&copy;&nbsp;<?=START_YEAR?>-<?=date("Y")?>&nbsp;Prof. Dr. Enrique Mallen</span>
</div>

<?php while($row = mysql_fetch_array($result)){ 
$AcceptedTitle = $obj->getAcceptedTitle($row['title']);?>
<div class="Page"><center>
 <div class="PageInside">
 
<table width="564" height="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="564" height="400" align="center" style="padding:1px ">
	  <table width="560" height="100%" border="0" cellpadding="0" cellspacing="0" >
	    <tr><td class="Thumbnail"><img src="../graphics/<?= $_GET['year']?>/ythumbs/y<?=$obj->imgName($row['opp'])?>.jpg" title="<?=$row['title']?>"/></td>
		<td class="infoLarge1">
	   <span><strong><font color="#800000"><?=$obj->parseTextTM($AcceptedTitle)?></font></strong></span>. 
	   <?=$row['location']?>.  
	   <?=$row['duration']?>. 
	   <span class="MediumDim"><?=$obj->parseTextTM($row['medium'])?>. 
	   <?=$row['dimension']?>.</span> 
	   <?=$row['collection']?>. 
	   <?php if($row['inventory']!='') { ?> <?=$row['inventory']?>.<?php } ?>
	   <hr width="150" align="left"/>
 	<strong><font color="#800000"><?=$row['opp']?></font></strong><?php  $result1 = $obj->getCatalog($row['opp']); foreach($result1 as $cata) echo("; ".$cata); if($row['bookCatalog']!='') echo("; ".$obj->sortBooks($row['bookCatalog']));?>
	  </td></tr></table>
	</td>
  </tr>
  <tr>
	<td width="564" height="400" align="center" style="padding:1px "><?php if($row = mysql_fetch_array($result)) { $AcceptedTitle = $obj->getAcceptedTitle($row['title']);?> <div class="Separator"></div>
	 <table width="560" height="100%" border="0" cellpadding="0" cellspacing="0" >
	    <tr><td class="infoLarge2">
	   <span><strong><font color="#800000"><?=$obj->parseTextTM($AcceptedTitle)?></font></strong></span>.
	   <?=$row['location']?>. 
	   <?=$row['duration']?>. 
	   <span class="MediumDim"><?=$obj->parseTextTM($row['medium'])?>. 
	   <?=$row['dimension']?>.</span> 
	   <?=$row['collection']?>. 
	   <?php if($row['inventory']!='') { ?> <?=$row['inventory']?>.<?php } ?>
	   <hr width="150" align="left"/>
	<strong><font color="#800000"><?=$row['opp']?></font></strong><?php  $result1 = $obj->getCatalog($row['opp']); foreach($result1 as $cata) echo("; ".$cata); if($row['bookCatalog']!='') echo("; ".$obj->sortBooks($row['bookCatalog']));?>
	  </td>
	  <td class="Thumbnail"><img src="../graphics/<?= $_GET['year']?>/ythumbs/y<?=$obj->imgName($row['opp'])?>.jpg" title="<?=$row['title']?>"/></td></tr></table>
	  <?php } else echo("&nbsp;");?>
	</td>
  </tr>
</table>
 
 </div>
</center>
  <div class="PageFooter" align="center">Copyright&nbsp;&copy;&nbsp;<?=START_YEAR?>-<?=date("Y")?>&nbsp;Prof. Dr. Enrique Mallen</div>
</div>
<?php } ?>

</center></body>
</html>
