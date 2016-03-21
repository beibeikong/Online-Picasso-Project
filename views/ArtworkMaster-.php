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
<title>Master Artwork - <?=PROJECTNAME?></title>
<link rel="stylesheet" href="./css/popup.css"/>
<link rel="stylesheet" href="./css/ArtworkCompare.css"/>
<script type="text/javascript" src="./js/popup.js"></script>
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>

<body onresize="resizeNote()" >  <!---- flag is 0 means resolution is 1280*800 or 1024*768 ---->
<?php
require_once(MODULES_PATH.'ArtworkMaster.php');
$obj = new ArtworkMaster();
$OPPInfo = $obj->getOPPInfo($_GET['OPPID']);
$left_row = mysql_fetch_array($OPPInfo);
$MasterOPPList = $obj->getMasters($_GET['OPPID']);
$MasterOPP = (isset($_GET['MasterOPP']))? $_GET['MasterOPP'] : $MasterOPPList[0];  // get masteropp
$MasterInfo = $obj->getMasterInfo($MasterOPP);
$right_row = mysql_fetch_array($MasterInfo);
?>
<table class="HeaderBar" cellspacing="0">
  <tr>
    <td class="Logo"><img src="./images/opp-emblem-corner.png" width="61" height="59" /></td>
    <td class="Title">Master</td>
    <td class="Toolbar">
      <table cellspacing="0" align="right">
        <tr>
          <td><a id="NtAndComtry" href="index.php?view=Mastermultiple&OPPID=<? echo $_GET['OPPID'] ?> ">Multiple</a></td>
		  <td><a id="BtnClose" href="javascript:ClosePopup();">Close</a></td>
		</tr>
	  </table>
	</td>
  </tr>
</table>
<!---------------------------- start Artwork Compare ---------------------------->
<table id="ArtworkCompare" cellspacing="0" align="center">
 <tr>
    <td id="ImgHolder"><a href="index.php?view=ArtworkInfo&OPPID=<?=$left_row['opp']?>" target="_blank" onclick="OpenWin(this.href, 'ArtworkInfo', 740, 550); return false;"><img src="../graphics/<?=$left_row['startyear']?>/ythumbs/y<?=$obj->imgName($left_row['opp'])?>.jpg" class="imageStyle" title="<?=$left_row['title']?>"/></a><br/><small>Copyright © Estate of Pablo Picasso/<br/>Artists Rights Society (ARS), New York</small></td>
    <td id="ImgHolder"><a href="index.php?view=MasterArtworkInfoNew&MasterID=<?=$right_row['masteropp']?>" target="_blank" onclick="OpenWin(this.href, 'MasterArtworkInfoNew', 740, 550); return false;"><img src="../mastergraphics/<?=substr($right_row['masteropp'],0,7)?>/ythumbs/y<?=$obj->imgName($right_row['masteropp'])?>.jpg" class="imageStyle" title="<?=$right_row['title']?>"/></a><br/><small>Copyright © Artists Rights Society (ARS), New York</small></td>
  </tr>

  <tr class="ArtworksInfo">
	<td style="padding-top:5px "><table width="300" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td class="InfoLabel">Title:</td> <td class="Info"><strong><font color="#800000"><?=$left_row['title']?></font></strong></td>
      </tr>
      <tr>
        <td class="InfoLabel">Author:</td> <td class="Info">Pablo Ruiz Picasso</td>
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
		<td class="InfoLabel">Collection:</td> <td class="Info"><?=$left_row['collection']?>.&nbsp;
      	<?php 
			if($left_row['inventory']!='') 
			{ echo $left_row['inventory'];}
		?>
		</td>
      </tr>
      <?php }?>
      <tr>
        <td class="InfoLabel">Catalog:</td> <td class="Info"><?php if($left_row['notVerified']==1) {?>
	  <strong><font color="#800000">[<?=$left_row['opp']?>]</font></strong>
	  <?php } else { ?><strong><font color="#800000"><?=$left_row['opp']?></font></strong><?php } $result = $obj->getCatalog($left_row['opp']); foreach($result as $cata) echo("; ".$cata); ?>

      </td>
      </tr>
    </table></td>
	<td style="border-left:1px dotted silver;padding-top:5px"><table width="300" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td class="InfoLabel">Title:</td> <td class="Info"><strong><font color="#800000"><?=$right_row['title']?></font></strong></td>
      </tr>
      <tr>
        <td class="InfoLabel">Author:</td> <td class="Info"><?=$right_row['author']?></td>
      </tr>
      <tr>
        <td class="InfoLabel">Date:</td> <td class="Info"><?=$right_row['duration']?></td>
      </tr>
      <tr>
        <td class="InfoLabel">Medium:</td> <td class="Info"><?=$right_row['medium']?></td>
      </tr>
      <tr>
        <td class="InfoLabel">Dimension:</td> <td class="Info"><?=$right_row['dimension']?></td>
      </tr>
	  <?php if($right_row['collection']!='') { ?>
      <tr>
		<td class="InfoLabel">Collection:</td> <td class="Info"><?=$right_row['collection']?>.</td>
      </tr>
      <?php }?>
      <tr>
        <td class="InfoLabel">&nbsp;</td> <td class="Info">&nbsp;</td>
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
		  foreach($MasterOPPList as $master) { ?>
			<td class="singleImage"><?php echo $obj->getOneMaster($master, $_SERVER['QUERY_STRING'], $_GET);?></td>
		  <?php } ?>
		  </tr>
		</table>
	  </div></center>
	</td>
  </tr>
</table>
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
