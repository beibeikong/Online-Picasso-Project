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
<title>Art Relations - <?=PROJECTNAME?></title>
<link rel="stylesheet" href="./css/popup.css"/>
<link rel="stylesheet" href="./css/ArtworkCompare.css"/>
<script type="text/javascript" src="./js/popup.js"></script>
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>

<body onresize="resizeNote()" >  <!---- flag is 0 means resolution is 1280*800 or 1024*768 ---->
<?php
require_once(MODULES_PATH.'ArtworkInfo.php');
 $obj = new ArtworkInfo($_GET['OPPID']);
 $result = $obj->getData();
 $row = mysql_fetch_array($result);
$thishref = "index.php?".$_SERVER['QUERY_STRING'];
$href = str_replace("AlternateCompare","ArtworkAlternate",  $thishref);
?>
<table class="HeaderBar" cellspacing="0">
  <tr>
    <td class="Logo"><img src="./images/opp-emblem-corner.png" width="61" height="59" /></td>
    <td class="Title">Alternate Comparison</td>
    <td class="Toolbar">
      <table cellspacing="0" align="right">
        <tr>
          <?php if ($_SESSION['UserType'] == 'admin' ){?>
		  <td><a id="NtAndComtry" href="<?=$href?>">Multiple</a></td>
		  <?php }?>
		  <td><a id="BtnClose" href="javascript:ClosePopup();">Close</a></td>
		</tr>
	  </table>
	</td>
  </tr>
</table>
<!---------------------------- start Artwork Compare ---------------------------->
<table id="ArtworkCompare" cellspacing="0" align="center">
 <tr>
    <td id="ImgHolder"><a href="index.php?view=ArtworkInfo&OPPID=<?=$row['opp']?>" target="_blank" onclick="OpenWin(this.href, 'ArtworkInfo', 740, 550); return false;">
	<?php if ($_SESSION['UserType'] == 'admin' || $row['notVerified'] == 0){?>
	<img src="../graphics/<?=$row['startyear']?>/ythumbs/y<?=$obj->imgName($row['opp'])?>.jpg" class="imageStyle" title="<?=$row['title']?>"/>
	<?php }
	else {?>
	<img src="https://picasso.shsu.edu/images/yopp-emblem-innershadow.jpg"/>
	<?php }?>
	</a><br/><small>Copyright © Estate of Pablo Picasso/<br/>Artists Rights Society (ARS), New York</small></td>
    <td id="ImgHolder"><a href="index.php?view=zoom&alpha=<?=$_GET['oppImg']?>-<?=$_GET['n']?>&random=<?= $_GET['year']*23?>" target="_blank" onclick="OpenWin(this.href, 'ArtworkZoom', 850, 600); return false;">
            <img src="../graphics/<?= $_GET['year']?>/ythumbs/y<?=$_GET['oppImg']?>-<?=$_GET['n']?>.jpg" class="imageStyle"/></a><br/>
            <small>Copyright © Estate of Pablo Picasso/<br/>Artists Rights Society (ARS), New York</small></td>
  </tr>
  <tr class="ArtworksInfo">
	<td style="padding-top:5px" colspan="2"><table width="550" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td class="InfoLabel">Title:</td> <td class="Info"><strong><font color="#800000"><?=$obj->parseTextTM($row['title'])?></font></strong></td>
      </tr>
      <tr>
        <td class="InfoLabel">Date:</td> <td class="Info"><?=$row['duration']?></td>
      </tr>
      <tr>
        <td class="InfoLabel">Medium:</td> <td class="Info"><?=$obj->parseTextTM($row['medium'])?></td>
      </tr>
      <tr>
        <td class="InfoLabel">Dimension:</td> <td class="Info"><?=$row['dimension']?></td>
      </tr>
	  <?php if($row['collection']!='') { ?>
      <tr>
		<td class="InfoLabel">Collection:</td> <td class="Info"><?=$row['collection']?>.&nbsp;
      	<?php 
			if($row['inventory']!='') 
			{ echo $row['inventory'];}
		?>
		</td>
      </tr>
      <?php }?>
      <tr>
        <td class="InfoLabel">Catalog:</td> <td class="Info"><strong><font color="#800000"><?=$row['opp']?></font></strong><?php  $result = $obj->getCatalog($row['opp']); foreach($result as $cata) echo("; ".$cata); ?>

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
		  <?php $i=1; 
                  while($i <= $_GET['num']){ ?>
			<td class="singleImage"><a href="<?=substr($thishref,0,strpos($thishref,"n=")+2).$i?>"><img src="../graphics/<?= $_GET['year']?>/xthumbs/x<?=$_GET['oppImg']?>-<?=$i?>.jpg" class="imageStyle"/></a>
       </td>
		  <?php  $i++; } ?>
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

