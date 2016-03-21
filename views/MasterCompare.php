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
<title>Artist Comparison - <?=PROJECTNAME?></title>
<link rel="stylesheet" href="./css/popup.css"/>
<link rel="stylesheet" href="./css/ArtworkCompare.css"/>
<script type="text/javascript" src="./js/popup.js"></script>
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>

<body onload="AutoSizePopup()" >  <!---- flag is 0 means resolution is 1280*800 or 1024*768 ---->
<?php
require_once(MODULES_PATH.'MasterCompare.php');
$obj = new MasterCompare();
$MasterInfo = $obj->getMasterInfo($_GET['MasterID']);
$left_row = mysql_fetch_array($MasterInfo);
$OPPList = $obj->getOPPs($_GET['MasterID']);
$OPP = (isset($_GET['OPP']))? $_GET['OPP'] : $OPPList[0];  // get opp
$OPPInfo = $obj->getOPPInfo($OPP);
$right_row = mysql_fetch_array($OPPInfo);
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
	if (isset($_SESSION['UserType'])) {
	if ($_SESSION['UserType'] == 'admin'){
	 ?>
		  <td><a id="NtAndComtry" href="index.php?view=MasterArtworkMultiple&MasterID=<? echo $_GET['MasterID'] ?> ">Multiple</a></td>
		  <?php 
	  }} ?>
		  <td><a id="BtnClose" href="javascript:ClosePopup();">Close</a></td>
		</tr>
	  </table>
	</td>
  </tr>
</table>
<!---------------------------- start Artwork Compare ---------------------------->
<table id="ArtworkCompare" cellspacing="0" align="center">
 <tr>
    <td id="ImgHolder"><a href="index.php?view=MasterArtworkInfoNew&MasterID=<?=$left_row['masteropp']?>" target="_blank" onclick="OpenWin(this.href, 'MasterArtworkInfoNew', 740, 550); return false;">
	<?php if ($_SESSION['UserType'] == 'admin' || $left_row['notVerified'] == 0){?>
	<img src="../mastergraphics/<?=substr($left_row['masteropp'],0,7)?>/ythumbs/y<?=$obj->imgName($left_row['masteropp'])?>.jpg" class="imageStyle" title="<?=$left_row['title']?>"/>
	<?php }
	else {?>
	<img src="https://picasso.shsu.edu/images/yopp-emblem-innershadow.jpg"/>
	<?php }?>
	</a><br/><small>Copyright © Artists Rights Society (ARS), New York</small></td>
                <td id="ImgHolder"><a href="index.php?view=ArtworkInfo&OPPID=<?=$right_row['opp']?>" target="_blank" onclick="OpenWin(this.href, 'ArtworkInfo', 740, 550); return false;">
				<?php if ($_SESSION['UserType'] == 'admin' || $right_row['notVerified'] == 0){?>
				<img src="../graphics/<?=$right_row['startyear']?>/ythumbs/y<?=$obj->imgName($right_row['opp'])?>.jpg" class="imageStyle" title="<?=$right_row['title']?>"/>
				<?php }
	else {?>
	<img src="https://picasso.shsu.edu/images/yopp-emblem-innershadow.jpg"/>
	<?php }?>
	</a><br/><small>Copyright © Estate of Pablo Picasso/<br/>Artists Rights Society (ARS), New York</small></td>

  </tr>
	<td style="padding-top:5px "><table width="300" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
        <td class="InfoLabel">Title:</td> <td class="Info"><strong><font color="#800000"><?=$left_row['title']?></font></strong></td>
      </tr>
      <tr>
        <td class="InfoLabel">Author:</td> <td class="Info"><?=$left_row['author']?></td>
      </tr>
      <tr>
        <td class="InfoLabel">Date:</td> <td class="Info"><?=$left_row['duration']?></td>
      </tr>
      <tr>
        <td class="InfoLabel">Medium:</td> <td class="Info"><?=$left_row['medium']?></td>
      </tr>
      <tr>
        <td class="InfoLabel">Dimension:</td> <td class="Info"><?=$left_row['dimension']?></td>
      </tr>
	  <?php if($left_row['collection']!='') { ?>
      <tr>
		<td class="InfoLabel">Collection:</td> <td class="Info"><?=$left_row['collection']?>.</td>
      </tr>
      <?php }?>
      <tr>
        <td class="InfoLabel">&nbsp;</td> <td class="Info">&nbsp;</td>
      </tr>
  
    </table></td>
	<td style="border-left:1px dotted silver;padding-top:5px"><table width="300" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td class="InfoLabel">Title:</td> <td class="Info"><strong><font color="#800000"><?=$obj->parseTextTM($rightAcceptedTitle)?></font></strong></td>
      </tr>
      <tr>
        <td class="InfoLabel">Author:</td> <td class="Info">Pablo Ruiz Picasso</td>
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
        <td class="InfoLabel">Catalog:</td> <td class="Info"><strong><font color="#800000"><?=$right_row['opp']?></font></strong><?php $result = $obj->getCatalog($right_row['opp']); foreach($result as $cata) echo("; ".$cata); ?>

      </td>
      </tr>
</table></td>
  </tr>
  <tr><td colspan="2" align="center"><hr width="600"></td></tr>
  <tr>
    <td colspan="2" id="AltsHolder" align="center">
	  <center><div>
	  <?php if($_SESSION['UserType'] == 'admin' || $right_row['notVerified'] == 0) {?>
        <table border="0" cellspacing="5" cellpadding="2" align="center">
		  <tr>
		  <?php $oppArray = explode("_", $_GET['OPPs']);
		  foreach($OPPList as $opp) { ?>
			<td class="singleImage"><?php echo $obj->getOneOPP($opp, $_SERVER['QUERY_STRING'], $_GET);?></td>
		  <?php } ?>
		  </tr>
		</table>
		<?php } ?>
	  </div></center>
	</td>
  </tr>
</table>
<!---------------------------- end of Master compare ---------------------------->
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


