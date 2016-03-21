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
<title>Print of <?=$_GET['OPPID']?> - On-line Picasso Project</title>
<link rel="stylesheet" href="./css/ArtworkPrint.css"/>
<script type="text/javascript">
        function resizeIframe(obj){
        {obj.style.height = 0;};
        {obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';}
        }</script>	
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">		
</head>
<body>
<?php
require_once(MODULES_PATH.'ArtworkInfo.php');
$obj = new ArtworkInfo($_GET['OPPID']);
$result = $obj->getData();
$formercount = $obj->formercollec($row['opp']);
 

?>
<center>
<div class="TitlePage">
  <br/><br/><br/><br/>
  <img src="./images/opp-emblem-whitebackground.png" width="100" height="91" alt=""/>
  <span class="Title"><?=PROJECTNAME?></span>
  <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
  <span class="Copyright">Copyright&nbsp;&copy;&nbsp;<?=START_YEAR?>-<?=date("Y")?>&nbsp;Prof. Dr. Enrique Mallen</span>
</div>
<!---------------------------- start Artwork Details ---------------------------->
<?php while($row = mysql_fetch_array($result)){ ?>
<div class="Page"><br/><br/><br/><br/>
  <div class="PageImg" style="background-image: url(http://picasso.shsu.edu/artworks20131218/<?=$row['startyear']?>/<?=$obj->imgName($row['opp'])?>.jpg);">
		<img src="./images/blank.gif" width="100%" height="100%"/>
   </div>
   <br/><small><font color="#808080">Copyright © Estate of Pablo Picasso/<br/>Artists Rights Society (ARS), New York</font></small>
</div>
<div class="InfoPage">
<br/>
 <table width="100%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
	<td align="center" valign="top"><iframe id="noteiframe" class="iframeNote" src ="index.php?view=ArtworkDetails&OPPID=<?=$_GET['OPPID']?><?php if(isset($_GET['highlight'])) echo("&highlight=$_GET[highlight]");?>" align="center" width="100%" onload="javascript:resizeIframe(this);" scrolling="no" frameborder="0"> </iframe>
    </td>
   </tr>
	</table><br/>
	</div>   
   <!---------------------------- start Provenance Details ---------------------------->
 <?php if($formercount!=0) { ?>		
<div class="InfoPage">
<br/>
 <table width="100%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
	<td align="center" valign="top"><iframe id="noteiframe" class="iframeNote" src ="index.php?view=former&OPPID=<?=$_GET['OPPID']?><?php if(isset($_GET['highlight'])) echo("&highlight=$_GET[highlight]");?>" align="center" width="100%" onload="javascript:resizeIframe(this);" scrolling="no" frameborder="0"> </iframe>
    </td>
   </tr>
  </table>
 </div>
   <?php } ?>
   	<!---------------------------- end of Provenance Details ---------------------------->

<div class="InfoPage"> 
<br/>
   <!---------------------------- start Reference Details ------------------------>
<table width="100%" cellpadding="0" cellspacing="0">
  <tr>
	<td align="center" valign="top"><iframe id="noteiframe" class="iframeNote" src ="index.php?view=bibliography&OPPID=<?=$_GET['OPPID']?><?php if(isset($_GET['highlight'])) echo("&highlight=$_GET[highlight]");?>" align="center" width="100%" onload="javascript:resizeIframe(this);" scrolling="no" frameborder="0"> </iframe>
    </td>
  </tr>   
</table>	   
</div>   
  <!---------------------------- end of Reference Details ------------------------->
  <!---------------------------- start Exhibited Details ------------------------>
 <?php if(($row['bookCatalog']!='')&& (strpos($row['bookCatalog'],'*') !== false)) { ?>
  <div class="InfoPage">   
 <br/>
  <table width="100%" cellpadding="0" cellspacing="0">
  <tr>
	<td align="center" valign="top"><iframe id="noteiframe" class="iframeNote" src ="index.php?view=exhibitedPrint&OPPID=<?=$_GET['OPPID']?><?php if(isset($_GET['highlight'])) echo("&highlight=$_GET[highlight]");?>" align="center" width="100%" onload="javascript:resizeIframe(this);" scrolling="no" frameborder="0"> </iframe>
    </td>
  </tr> 
</table>
</div>
<?php } ?>
  <!---------------------------- end of Exhibited Details ------------------------->
        <!---------------------------- start Notes Details ---------------------------->
<?php if((string)$row['notes'] != ''){ ?>		
<div class="InfoPage">
<br/>
 <table width="100%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
	<td align="center" valign="top"><iframe id="noteiframe" class="iframeNote" src ="index.php?view=note&OPPID=<?=$_GET['OPPID']?><?php if(isset($_GET['highlight'])) echo("&highlight=$_GET[highlight]");?>" align="center" width="100%" onload="javascript:resizeIframe(this);" scrolling="no" frameborder="0"> </iframe>
    </td>
   </tr>
  </table>
 </div>
   <?php } ?>
   	<!---------------------------- end of Notes Details ---------------------------->
    <!---------------------------- start Commentary Details ------------------------>
<?php if((string)$row['commentary'] != ''){ ?>	
<div class="InfoPage">
<br/>
 <table width="100%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
	<td align="center" valign="top"><iframe id="noteiframe" class="iframeNote" src ="index.php?view=commentary&OPPID=<?=$_GET['OPPID']?><?php if(isset($_GET['highlight'])) echo("&highlight=$_GET[highlight]");?>" align="center" width="100%" onload="javascript:resizeIframe(this);" scrolling="no" frameborder="0"> </iframe>
    </td>
   </tr>     
  </table>
 </div>
<?php } ?>	
   <!---------------------------- end of Commentary Details ------------------------->
   <!---------------------------- end of Artwork Details ---------------------------->
 
</div>
<?php  }?>	
 </center>
</body>
</html>