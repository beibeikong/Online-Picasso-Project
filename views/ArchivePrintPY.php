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
<title>Archive Article - On-line Picasso Project</title>
<link rel="stylesheet" href="./css/BiographyPrint.css"/>
<link rel="stylesheet" href="./css/archives.css"/>
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
<?php

$q=0;
$kq=0;
$aArray = explode("_", $_GET['a']);

$yyArray = explode("_", $_GET['yy']);

$q=2;
for($p=0;$p<$_GET["totalNum"];$p++)
{
require_once(MODULES_PATH.'ArchivesArticle.php');

$obj = new ArchivesArticle($aArray[$q]);
$result = $obj->getData();
?>
  </head>
  <body>
  <center>
  <?if($p<1){?>
  <div class="TitlePage">
  <img src="./images/opp-emblem-whitebackground.png" width="100" height="91" alt=""/>
  <span class="Title"><?=PROJECTNAME?></span>
  <span class="SubTitle">Archive Print</span>
  <span class="Copyright">Copyright&nbsp;&copy;&nbsp;<?=START_YEAR?>-<?=date("Y")?>&nbsp;Prof. Dr. Enrique Mallen</span>
</div>
<? }?>
<div class="Page"><center>
 <div class="PageInside">
 <table width="100%" cellspacing="0">
  <tr>
	<td><i><font size="5"><?=$result['Publisher']?></font></i></td>
  </tr>
  <tr>
    <td align="center">

        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td align="center"><h2><?=$result['Title']?></h2></td></tr>
          <tr>
</table>
        <table width="100%" border="0" cellpadding="20" cellspacing="0">
    	  <tr>
	    <td align="left"><i><?=$result['DateDescription']?></i></td>
          </tr>
        </table>
</td>
	</tr>
</table>
<!---------------------------- Start Archive Article ---------------------------->
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>

<!-------- div start -------->
<div id="ArticleBody">
	<?php if($result['Images']!= "") { ?>
		<table class="ImageStrip" cellspacing="7">
		<?php $imageArray = explode(";", $result['Images']);
		      foreach($imageArray as $image) {
		?>
			<tr>
				<td><a href="index.php?view=BioPhotoZoom&type=archive&year=<?=$yyArray[$q]?>&img=<?=$obj->parsePhotoName($image)?>" target="_blank" onclick="OpenWin(this.href, 'BioZoom', 850, 650); return false;" ><img src="../archives/<?= $yyArray[$q]?>/thumbnails/x<?=$image?>"/></a></td>
			</tr>
	    <?php  }  ?>
	<?php
	  $photoDesc = $obj->getPhotoDesc();
	  if($photoDesc != "") {
	?>
 			<tr  class="PhotoDescription">
               <td ><?=$photoDesc?></td>
            </tr>
     <?php } ?>
	    </table>
	<?php } ?>
	<?=$obj->getText()?>

</div>
<!-------- div end -------->

	</td>
  </tr>
</table>
<!---------------------------- End Archive Article ---------------------------->
 </div>
</center>
</div>


</center>
<?php $q++;
 } ?>
</body>
</html>
