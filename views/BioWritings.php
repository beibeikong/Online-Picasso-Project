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
<title>Writing Details - On-line Picasso Project</title>
<link rel="stylesheet" href="./css/main.css"/>
<link rel="stylesheet" href="./css/WritingsInfo.css"/>
<link rel="stylesheet" href="./css/popup.css"/>
<script type="text/javascript" src="./js/main.js"></script>
<script type="text/javascript" src="./js/popup.js"></script>
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>

<body onresize="resizeNote();">
<table class="HeaderBar" cellspacing="0">
  <tr>
    <td class="Logo"><img src="./images/opp-emblem-corner.png" width="61" height="59" /></td>
    <td class="Title">Writing</td>
    <td class="Toolbar">
      <table cellspacing="0" align="right">
        <tr>
		  <td><a id="BtnClose" href="javascript:ClosePopup();">Close</a></td>
		</tr>
	  </table>
	</td>
  </tr>
</table>
<?php
require_once(MODULES_PATH.'WritingsInfo.php');
$obj = new WritingsInfo($_GET);
$result = $obj->getTitleDuration();
$row = mysql_fetch_array($result);
$part = (isset($_GET['part']))? $_GET['part'] : 1;  // current part number
?>
<div style="height:88vh;overflow-x:hidden;overflow-y:auto;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" >
  <tr>
    <td align="center" style="padding:15px 15px 15px 15px">
        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
          <td>
             <table align="center" cellspacing="0" class="TabContainer" id="MenuTabs">
            <tr class="Tabs">
  	            
				<td class="Active"><img src="./images/magnify-text.png"/>Text</td>
				<?php $i=2; if(trim($obj->getCommentary())!="") { ?>
				<td class="Inactive"><a href="index.php?view=WritingsComntry&year=<?php echo($_GET['year']); if(isset($_GET['page'])) echo("&page=".$_GET['page']);if(isset($_GET['part'])) echo("&part=".$_GET['part']);?>&mid=<?=$_GET['mid']?>"><img src="./images/magnify-text.png"/>Commentary</a></td>
				<?php $i--;}  if(trim($obj->getTranslation())!="") { ?>
				<td class="Inactive"><a href="index.php?view=BioWritingsTranslation&year=<?php echo($_GET['year']); if(isset($_GET['page'])) echo("&page=".$_GET['page']);if(isset($_GET['part'])) echo("&part=".$_GET['part']);?>&mid=<?=$_GET['mid']?>"><img src="./images/magnify-text.png"/>Translation</a></td>
				<?php $i--;}
				for($j=1;$j<=$i;$j++)
				  echo ("<td class=\"InactiveEmpty\">&nbsp;</td>");
				?>	
			
				<td class="EmptySpace">&nbsp;</td>
              </tr>
            <tr width="100%" border-width = 1px border-color= rgb(225,200,200);>
	        <td class="Container" colspan="4">
<!---------------------------- starting title ---------------------------->
<table width="100%" cellspacing="0">
  <tr>
    <td width="150px" align="right">
	  <table cellspacing="0" style="clear:none; float:left"><tr><td><!--for future --></td><td><!--for future --></td></tr></table>
    </td>
	<td align="center">
	  <span class="poemTitle"><?=$row['title']?></span>
	  <span class="Duration"><?=$row['duration']?>,<?=$row['year']?>&nbsp;-&nbsp;Part: <?=$part?></span>
	</td>
	<td width="150px" align="right" >
	  <table cellspacing="0" style="clear:none; float:left"><tr><td><!--for future --></td><td><!--for future --></td></tr></table>
	</td>
  </tr>
</table>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="titleDura">&nbsp;</td>
  </tr>
</table>
<!---------------------------- end of title ---------------------------->
<!---------------------------- Start displaying poems ---------------------------->
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="top">
	<?php $result=$obj->getPoem(); $image=$obj->getImage();
	while($row = mysql_fetch_array($result))
	if($row['linetext']!="")
	  echo("<p id=\"pline\">".$row['linetext']."</p>");
	else
	  echo("<br>");
	?>
	</td>
    <?php  if($image!="") {?><td align="center" valign="top" id="itd" width="200" style="padding-left:50px ">
<a href="index.php?view=zoom&random=<?=substr($image,4,2)*23+1900*23?>&alpha=<?=$obj->imgName($image)?>.jpg" target="_blank" onclick="OpenWin(this.href, 'ArtworkZoom', 850, 600); return false;">
	<img src="../graphics/19<?=substr($image,4,2)?>/ythumbs/y<?=$obj->imgName($image)?>.jpg" border="0"/></a>
	<span class="small">Copyright © Estate of Pablo Picasso/<br/>
	Artists Rights Society (ARS), New York</span>
	</td><?php } ?>
  </tr>
</table>
<!---------------------------- End displaying poems ---------------------------->
<!---------------------------- Start part Navigator ---------------------------->
<?php
$totalParts = $obj->getTotalNum();
require_once(MODULES_PATH.'PartNavigator.php');
$obj = new PartNavigator($totalParts, $part, $_SERVER['QUERY_STRING']);
$obj->showPgNavigator();
?>
<!---------------------------- End part Navigator ---------------------------->
				</td>
      
        </tr>
          </table>
               </td>
        </tr>
      </table>
	</td>
  </tr>
</table>
</div>    
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
