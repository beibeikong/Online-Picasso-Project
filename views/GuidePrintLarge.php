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
<title>Custom Catalogue - On-line Picasso Project</title>
<link rel="stylesheet" href="./css/ArtworkPrint.css"/>
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>

<body>
<?php
require_once(MODULES_PATH.'GuideSearchPrint.php');
$obj = new ArtworkSearchPrint($_GET);
$result = $obj->getData();
?>
<center>
<div class="TitlePage">
  <img src="./images/opp-emblem-whitebackground.png" width="100" height="91" alt=""/>
  <span class="Title"><?=PROJECTNAME?></span>
  <span class="SubTitle">Comprehensive Illustrated Catalogue<br/>Custom Edition</span>
  <span class="Copyright">Copyright&nbsp;&copy;&nbsp;<?=START_YEAR?>-<?=date("Y")?>&nbsp;Prof. Dr. Enrique Mallen</span>
</div>

<?php while($row = mysql_fetch_array($result)){ ?>
<div class="Page"><center>
 <div class="PageInside">
 
<table width="564" height="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="564" height="400" align="center" style="padding:1px ">
	  <table width="560" height="100%" border="0" cellpadding="0" cellspacing="0" >
	    <tr><td class="Thumbnail"><img src="http://picasso.shsu.edu/graphics/<?=$row['year']?>/ythumbs/y<?=$obj->imgName($row['opp'])?>.jpg" title="<?=$row['title']?>"/></td>
		<td class="infoLarge1">
	   <span><strong><font color="#800000"><?=$row['title']?></font></strong></span><br/>
	   <?=$row['location']?>.  
	   <?=$row['duration']?>.<br/> 
	   <span class="MediumDim"><?=$row['medium']?>.<br/> 
	   <?=$row['dimension']?>.</span><br/>
	   <?=$row['collection']?>. 
	   <?php if($row['inventory']!='') { ?> <?=$row['inventory']?>.<br/><?php } ?>
	   <hr width="150" align="left"/>
 	<strong><font color="#800000"><?=$row['opp']?></font></strong><?php  $result1 = $obj->getCatalog($row['opp']); foreach($result1 as $cata) echo("; ".$cata); if($row['bookCatalog']!='') echo("; ".$obj->sortBooks($row['bookCatalog']));?>
	  </td></tr></table>
	</td>
  </tr>
  <tr>
	<td width="564" height="400" align="center" style="padding:1px "><?php if($row = mysql_fetch_array($result)) { ?> <div class="Separator"></div>
	 <table width="560" height="100%" border="0" cellpadding="0" cellspacing="0" >
	    <tr><td class="infoLarge2">
	   <span><strong><font color="#800000"><?=$row['title']?></font></strong></span><br/>
	   <?=$row['location']?>.  
	   <?=$row['duration']?>.<br/> 
	   <span class="MediumDim"><?=$row['medium']?>.<br/> 
	   <?=$row['dimension']?>.</span><br/>
	   <?=$row['collection']?>. 
	   <?php if($row['inventory']!='') { ?> <?=$row['inventory']?>.<br/><?php } ?>
	   <hr width="150" align="right"/>
	<strong><font color="#800000"><?=$row['opp']?></font></strong><?php  $result1 = $obj->getCatalog($row['opp']); foreach($result1 as $cata) echo("; ".$cata); if($row['bookCatalog']!='') echo("; ".$obj->sortBooks($row['bookCatalog']));?>
	  </td>
	  <td class="Thumbnail"><img src="http://picasso.shsu.edu/graphics/<?=$row['year']?>/ythumbs/y<?=$obj->imgName($row['opp'])?>.jpg" title="<?=$row['title']?>"/></td></tr></table>
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
