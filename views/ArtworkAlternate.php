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
<title>Artwork Alternate View - <?=PROJECTNAME?></title>
<link rel="stylesheet" href="./css/popup.css"/>

<script type="text/javascript" src="./js/popup.js"></script>
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>

<body  onresize="resizeNote();">
<table class="HeaderBar" cellspacing="0">
<?php
 require_once(MODULES_PATH.'ArtworkInfo.php');
 $obj = new ArtworkInfo($_GET['OPPID']);
 $result = $obj->getData();
 $row = mysql_fetch_array($result);
 $href = "index.php?".$_SERVER['QUERY_STRING'];
 $href = str_replace("ArtworkAlternate", "AlternateCompare", $href);
 ?>

  <tr>
    <td class="Logo"><img src="./images/opp-emblem-corner.png" width="61" height="59" /></td>
    <td class="Title">Alternate View</td>
    <td class="Toolbar">
      <table cellspacing="0" align="right">
        <tr>
                <td><a id="NtAndComtry" href="<?=$href?>">Comparison</a></td>
                </td>
		  <td><a id="BtnClose" href="javascript:ClosePopup();">Close</a></td>
		</tr>
	  </table>
	</td>
  </tr>
</table>
<!---------------------------- start Artwork Alternate View ---------------------------->
<table id="ArtworkInfo" cellspacing="0" align="center" width="100%" border="0">
   <tr>
   <?php
	if (isset($_SESSION['UserType'])) {
	if ($_SESSION['UserType'] == 'admin' || $_GET['notverified'] == 0)
	{?>
    <td align="center" valign="top" id="ImgHolder"><br /><a href="./index.php?view=zoom&alpha=<?=$_GET['oppImg']?>&random=<?=$_GET['year']*23?>" target="_blank" onclick="OpenWin(this.href, 'ArtworkZoom', 850, 600); return false;"><img src="../graphics/<?=$_GET['year']?>/ythumbs/y<?=$_GET['oppImg']?>.jpg" class="imageStyle" title="<?=$row['title']?>"/></a><br/><small><font color="#808080">Copyright © Estate of Pablo Picasso/<br/>Artists Rights Society (ARS), New York</font></small>
    </td>  
      <?php }
	  else{
	  ?>
	  	<td id="ImgHolder"><br /><img src="https://picasso.shsu.edu/images/yopp-emblem-innershadow.jpg"/><br/><small>Copyright © Estate of Pablo Picasso/<br/>Artists Rights Society (ARS), New York</small>
	  <?php
	  }
	   }?>

   <td align="left" valign="top">
<iframe id="noteiframe"  class="iframeNote"  src ="index.php?<?php echo str_replace("ArtworkAlternate","alternate",$_SERVER['QUERY_STRING'])?>" width="100%"  height="580px" align="left" scrolling="auto" frameborder="0">
</iframe></td>
</tr> 
</table>
</center>
<!---------------------------- end of Artwork Alternate View ---------------------------->
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

