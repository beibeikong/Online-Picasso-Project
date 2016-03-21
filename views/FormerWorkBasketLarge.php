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
<link rel="stylesheet" href="./css/FormerWorkBasketPrint.css"/>
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
session_start();
require_once(MODULES_PATH.'WorkBasketPrint.php');
$obj = new WorkBasketPrint($_SESSION);
$result = $obj->getData();
?>
<center>
<div class="TitlePage">
  <img src="./images/opp-emblem-whitebackground.png" width="100" height="91" alt=""/>
  <span class="Title"><?=PROJECTNAME?></span>
  <span class="SubTitle">Comprehensive Illustrated Catalogue<br/>Custom Edition</span>
  <span class="Copyright">Copyright&nbsp;&copy;&nbsp;<?=START_YEAR?>-<?=date("Y")?>&nbsp;Prof. Dr. Enrique Mallen</span>
</div>

<?php while($row = mysql_fetch_array($result)){ $AcceptedTitle = $obj->getAcceptedTitle($row['title']);?>
<div class="Page"><center>
 <div class="PageInside">
 
<table width="564" height="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="564" height="auto" align="center" style="padding:1px ">
      <table width="560" height="100%" border="0" cellpadding="0" cellspacing="0" >
	<tr><td style="vertical-align:top;padding-left: 7px" width="20%">
              <table class="ThumbGallery"><tr><td class="Pic">
                <img src="http://picasso.shsu.edu/graphics/<?= $row['year']?>/xthumbs/x<?=$obj->imgName($row['opp'])?>.jpg" class="imageStyle" title="<?=$row['title']?>"/>
                </td></tr>
	        <tr><td align="center" valign="middle"><input type="checkbox" value="<?=$row['opp']?>" /><span class="OPP"><?=$row['opp']?></span>
	        </td></tr>
	      </table>
            </td>
	    <td class="infoLarge1"><table width="440"><tr><td><iframe src ="index.php?view=ArtworkDetailsShort&OPPID=<?=$row['opp']?>" align="center" width="100%" onload="javascript:resizeIframe(this);" scrolling="no" frameborder="0"> </iframe></td></tr>
                    <tr><td><iframe src ="index.php?view=formerShort&OPPID=<?=$row['opp']?>"align="center" width="100%" onload="javascript:resizeIframe(this);" scrolling="no" frameborder="0"> </iframe></td>
                    </tr></table> 
            </td>
        </tr></table>
    </td>
  </tr>
  <tr>
    <td width="564" height="auto" align="center" style="padding:1px "><?php if($row = mysql_fetch_array($result)) { $AcceptedTitle = $obj->getAcceptedTitle($row['title']);?> <div class="Separator"></div>
      <table width="560" height="100%" border="0" cellpadding="0" cellspacing="0" >
	<tr><td style="vertical-align:top;padding-left: 7px" width="20%">
              <table class="ThumbGallery"><tr><td class="Pic">
                <img src="http://picasso.shsu.edu/graphics/<?= $row['year']?>/xthumbs/x<?=$obj->imgName($row['opp'])?>.jpg" class="imageStyle" title="<?=$row['title']?>"/>
                </td></tr>
	        <tr><td align="center" valign="middle"><input type="checkbox" value="<?=$row['opp']?>" /><span class="OPP"><?=$row['opp']?></span>
	        </td></tr>
	      </table>
            </td>
	    <td class="infoLarge1">
                <table width="440"><tr><td><iframe src ="index.php?view=ArtworkDetailsShort&OPPID=<?=$row['opp']?>" align="center" width="100%" onload="javascript:resizeIframe(this);" scrolling="no" frameborder="0"> </iframe></td></tr>
                    <tr><td><iframe src ="index.php?view=formerShort&OPPID=<?=$row['opp']?>"align="center" width="100%" onload="javascript:resizeIframe(this);" scrolling="no" frameborder="0"> </iframe></td>
                    </tr></table> 
            </td>
        </tr></table>
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
