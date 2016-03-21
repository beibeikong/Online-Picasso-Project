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
<title>Artwork Comparison - <?=PROJECTNAME?></title>
<link rel="stylesheet" href="./css/popup.css"/>
<link rel="stylesheet" href="./css/ArtworkCompare.css"/>
<script type="text/javascript" src="./js/popup.js"></script>
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>

<body <?php if($_GET['flag']==0) echo("onresize=\"resizeNote();\""); else echo("onload=\"AutoSizePopupCompare();\"");?>>  <!---- flag is 0 means resolution is 1280*800 or 1024*768 ---->
<?php
require_once(MODULES_PATH.'ArtworkCompare.php');
$obj = new ArtworkCompare();
$left = $obj->getData($_GET['left']);
$left_row = mysql_fetch_array($left);
$leftAcceptedTitle = $obj->getAcceptedTitle($left_row['title']);
$right = $obj->getData($_GET['right']);
$right_row = mysql_fetch_array($right);
$rightAcceptedTitle = $obj->getAcceptedTitle($right_row['title']);
?>
<table class="HeaderBar" cellspacing="0">
  <tr>
    <td class="Logo"><img src="./images/opp-emblem-corner.png" width="61" height="59" /></td>
    <td class="Title">Comparison</td>
    <td class="Toolbar">
      <table cellspacing="0" align="right">
        <tr>
		 <?php
		if (isset($_SESSION['UserType']) && $_SESSION['UserType'] == 'admin') {
	 ?>
          <td><a id="NtAndComtry" href="index.php?view=multiple&OPPs=<? echo $_GET['OPPs'] ?>&left=<? echo $_GET['left'] ?>&right=<? echo $_GET['right'] ?>&current=<? echo $_GET['current'] ?>&flag=<? echo $_GET['flag'] ?>">Multiple</a></td>
		  <?php 
	  } ?>
		  <td><a id="BtnClose" href="javascript:ClosePopup();">Close</a></td>
		</tr>
	  </table>
	</td>
  </tr>
</table>
<!---------------------------- start Artwork Compare ---------------------------->
<?php if($_GET['flag']==1)  // resolution is above 1280*800
{
?>
<table id="ArtworkCompare" cellspacing="0" align="center">
 <tr>
    <td id="ImgHolder"><a href="index.php?view=ArtworkInfo&OPPID=<?=$left_row['opp']?>" target="_blank" onclick="OpenWin(this.href, 'ArtworkInfo', 748, 550); return false;">
	<?php
	if ($_SESSION['UserType'] == 'admin' || $left_row['notVerified'] == 0){
	?>
	<img src="../graphics/<?=$left_row['startyear']?>/ythumbs/y<?=$obj->imgName($left_row['opp'])?>.jpg" class="imageStyle" title="<?=$left_row['title']?>"/>
	<?php }
	else {
		?>
		<img src="https://picasso.shsu.edu/images/yopp-emblem-innershadow.jpg"/>
		<?php
	} ?>
	</a><br/><small>Copyright © Estate of Pablo Picasso/<br/>Artists Rights Society (ARS), New York</small></td>
    <td id="ImgHolder"><a href="index.php?view=ArtworkInfo&OPPID=<?=$right_row['opp']?>" target="_blank" onclick="OpenWin(this.href, 'ArtworkInfo', 748, 550); return false;">
	<?php
	if ($_SESSION['UserType'] == 'admin' || $right_row['notVerified'] == 0){
	?>
	<img src="../graphics/<?=$right_row['startyear']?>/ythumbs/y<?=$obj->imgName($right_row['opp'])?>.jpg" class="imageStyle" title="<?=$right_row['title']?>"/>
	<?php }
	else {
		?>
		<img src="https://picasso.shsu.edu/images/xopp-emblem-innershadow.jpg"/>
		<?php
	} ?>
	</a><br/><small>Copyright © Estate of Pablo Picasso/<br/>Artists Rights Society (ARS), New York</small></td>
  </tr>

  <tr class="ArtworksInfo">
	<td style="padding-top:5px "><table width="300" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td class="InfoLabel">Title:</td> <td class="Info"><strong><font color="#800000"><?=$obj->parseTextTM($leftAcceptedTitle)?></font></strong></td>
      </tr>
      <tr>
        <td class="InfoLabel">Location:</td> <td class="Info"><?=$left_row['location']?></td>
      </tr>
      <tr>
        <td class="InfoLabel">Date:</td> <td class="Info"><?=$left_row['duration']?></td>
      </tr>
      <tr>
        <td class="InfoLabel">Medium:</td> <td class="Info"><?=$obj->parseTextTM($left_row['medium'])?></td>
      </tr>
      <tr>
        <td class="InfoLabel">Dimension:</td> <td class="Info"><?=$left_row['dimension']?></td>
      </tr>
	  <?php if($left_row['collection']!='') { ?>
      <tr>
		<td class="InfoLabel">Collection:</td> <td class="Info"><?=$left_row['collection']?>.&nbsp;
      	<?php 
			if($left_row['inventory']!='') 
			{ echo $left_row['inventory'];}
		?>
		</td>
      </tr>
      <?php }?>
      <tr>
        <td class="InfoLabel">Catalog:</td> <td class="Info">
		<strong><font color="#800000"><?=$left_row['opp']?></font></strong><?php  $result = $obj->getCatalog($left_row['opp']); foreach($result as $cata) echo("; ".$cata); ?>

      </td>
      </tr>
    </table></td>
	<td style="border-left:1px dotted silver;padding-top:5px"><table width="300" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td class="InfoLabel">Title:</td> <td class="Info"><strong><font color="#800000"><?=$obj->parseTextTM($rightAcceptedTitle)?></font></strong></td>
      </tr>
      <tr>
        <td class="InfoLabel">Location:</td> <td class="Info"><?=$right_row['location']?></td>
      </tr>
      <tr>
        <td class="InfoLabel">Date:</td> <td class="Info"><?=$right_row['duration']?></td>
      </tr>
      <tr>
        <td class="InfoLabel">Medium:</td> <td class="Info"><?=$obj->parseTextTM($right_row['medium'])?></td>
      </tr>
      <tr>
        <td class="InfoLabel">Dimension:</td> <td class="Info"><?=$right_row['dimension']?></td>
      </tr>
	  <?php if($right_row['collection']!='') { ?>
      <tr>
		<td class="InfoLabel">Collection:</td> <td class="Info"><?=$right_row['collection']?>.&nbsp;
      	<?php 
			if($right_row['inventory']!='') 
			{ echo $right_row['inventory'];}
		?>
		</td>
      </tr>
      <?php }?>
      <tr>
        <td class="InfoLabel">Catalog:</td> <td class="Info">
		<strong><font color="#800000"><?=$right_row['opp']?></font></strong><?php  $result = $obj->getCatalog($right_row['opp']); foreach($result as $cata) echo("; ".$cata); ?>

      </td>
      </tr>
    </table></td>
  </tr>
  <tr><td colspan="2" align="center"><hr width="600"></td></tr>
  <tr>
    <td colspan="2" id="AltsHolder" align="center">
	  <center><div>
        <table border="0" cellspacing="5" cellpadding="2" align="center">
		  <tr>
		  <?php
		  $oppArray = explode("_", $_GET['OPPs']);
		  foreach($oppArray as $opp) { ?>
			<td class="singleImage"><?php echo $obj->getOneImage($opp, $_SERVER['QUERY_STRING'], $_GET);?></td>
		  <?php } ?>
		  </tr>
		</table>
	  </div></center>
	</td>
  </tr>
</table>
<?php } else {?>
<iframe id="noteiframe" class="iframeNote" src ="index.php?view=workCompare&OPPs=<?=$_GET['OPPs']?>&left=<?=$_GET['left']?>&right=<?=$_GET['right']?>&current=<?=$_GET['current']?>" width="100%" height="550px"  scrolling="auto" frameborder="0">
</iframe>
<?php } ?>
<!---------------------------- end of Artwork Compare ---------------------------->
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
