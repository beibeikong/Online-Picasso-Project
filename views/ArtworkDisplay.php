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
<title>Artwork of <?=$_GET['year']?> - On-line Picasso Project</title>
<link rel="stylesheet" href="./css/main.css"/>
<link rel="stylesheet" href="./css/ArtworkDisplay.css"/>
<script type="text/javascript" src="./js/main.js"></script>
<script type="text/javascript" src="./js/popup.js"></script>
<script type="text/javascript" src="./js/ArtworkDisplay.js"></script>
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>

<body onload="window.name='OPPMain';">
<?php
if(isset($_GET['quarter'])) $q = $_GET['quarter']; else $q = 1; // get quarter
require_once(MODULES_PATH.'ArtworkDisplay.php');
$obj = new ArtworkDisplay($_GET);
$result = $obj->getData();
$totalNum = $obj->getTotalNum();
$page = (isset($_GET['page']))? $_GET['page'] : 1;  // current page number
$totalPages = $obj->getTotalPage(); // how many pages totally

$href_temp = 'index.php?'.$_SERVER['QUERY_STRING'];
if(isset($_GET['page'])) $href_temp = str_replace("&page=".$_GET['page'], "", $href_temp);

$hrefForSmall = str_replace("ArtworkDisplay", "ArtworkSmall", $href_temp);
$hrefForLarge = str_replace("ArtworkDisplay", "ArtworkLarge", $href_temp);
?>
<center>
<?php include('header.htm'); ?>

<table width="760" border="0" cellspacing="0" cellpadding="0" class="main_body">
  <tr>
    <td align="center" style="padding:15px 15px 15px 15px">
	  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center" valign="middle">
		    <table border="0" align="center" cellpadding="0" cellspacing="0">
		      <tr>
			    <td width="40" align="center">
				  <?php
				    if($_GET['year']>Picasso_START_YEAR)
					{
                                          $temp = $_GET['year']-1;
				          $href = 'index.php?'.$_SERVER['QUERY_STRING'];
                                          if(isset($_GET['page'])) $href = str_replace("&page=".$_GET['page'], "", $href);
                                          $href = str_replace("year=".$_GET['year'], "year=".$temp, $href);
										  $href = str_replace("quarter=".$_GET['quarter'],"quarter=1", $href);
					  echo("<a href=\"$href\" title=\"Previous Year\"><img src=\"./images/arrow-left.png\" width=\"23\" height=\"20\" border=\"0\" /></a>");
				    }
				  ?>
				</td>
			    <td><span class="big_year"><?=$_GET['year']?></span><span class="age">[<?=$_GET['year']-BORN_YEAR?>]</span></td>
                <td width="40" align="center">
				  <?php
				     if($_GET['year']<DIED_YEAR)
					 {
					   $temp = $_GET['year']+1;
                                           $href = "index.php?".$_SERVER['QUERY_STRING'];
                                          if(isset($_GET['page']))  $href = str_replace("&page=".$_GET['page'], "", $href);
                                           $href = str_replace("year=".$_GET['year'], "year=".$temp, $href);
										   $href = str_replace("quarter=".$_GET['quarter'],"quarter=1", $href);
					   echo("<a href=\"$href\" title=\"Next Year\"><img src=\"./images/arrow-right.png\" width=\"23\" height=\"20\" border=\"0\" /></a>");
				     }
				  ?>
			    </td>
		      </tr>
	        </table>
	      </td>
        </tr>

		<tr>
          <td>
            <table class="TabContainer" id="MenuTabs" cellspacing="0" align="center">
              <tr class="Tabs">
  	            <td class="Inactive"><a href="index.php?view=BioIndex&year=<?=$_GET['year']?>&quarter=<?=$q?>"><img src="./images/magnify-text.png"/>Biography</a></td>
	            <td class="Active"><img src="./images/magnify-art.png"/>Artwork Display</td>
                    <?php
                        $href = "index.php?".$_SERVER['QUERY_STRING'];
                        $href = str_replace("ArtworkDisplay", "ArtworkSummary", $href);
                    ?>
	            <td class="Inactive"><a href="<?=$href?>"><img src="./images/magnify-text.png"/>Artwork Summary</a></td>
	           <?php
			                           $href = "index.php?".$_SERVER['QUERY_STRING'];
			                           $href = str_replace("ArtworkDisplay", "ArtworkConcordance", $href);
                    ?>
	           <td class="Inactive"><a href="<?=$href."&page=1"?>"><img src="./images/magnify-text.png" alt="Artwork Catalog Concordance"/>Concordance</a></td>
				<td class="EmptySpace">&nbsp;</td>
              </tr>
              <tr>
	            <td class="Container" colspan="5">
<!---------------------------- starting heading2 ---------------------------->
<table width="100%" cellspacing="0">
  <tr>
    <td width="150px" align="right">
	  <table cellspacing="0" style="clear:none; float:left">
	    <tr>
		  <td>
	        <a class="PageButton" href="javascript:;" onclick="SubmitWorksBasket('ArtworkList','WorkBasketDisplay');" title="Go to the empty workbasket."><img src="./images/icon-addtobasket.gif" width="16" height="16" border="0" alt=""/><br/>Basket</a>
          </td>
		  <td>
	        <a class="PageButton" href="javascript:;" onclick="SubmitWorksBasketAdd('ArtworkList','WorkBasketDisplay');" title="Add the selected items to the artwork series."><img src="./images/icon-addtobasket.gif" width="16" height="16" border="0" alt=""/><br/>Add</a>
          </td>
		  <td>
	        <a class="PageButton" href="javascript:;" target="_blank" onclick="SubmitWorksCompare('ArtworkList', 'ArtworkCompare'); return false;" title="Add the selected items to the artwork series  comparison."><img src="./images/icon-compare.gif" width="16" height="16" border="0" alt="" title="Add the selected items to the artwork series  comparison."/><br/>Compare</a>
          </td>
        </tr>
      </table>
    </td>

	<td>
	  <h2><?=$totalNum?> Catalogued Items</h2>
	  <h3>Viewing items <?php echo(($page-1)*ITEMS_PER_PAGE+1)?> through <?php echo(min($page*ITEMS_PER_PAGE, $totalNum))?></h3>
	</td>

	<td width="150px" align="right" >
			 <?php
	  if ($_SESSION['UserType'] == 'admin' ){
	  ?>
      <table cellspacing="0" style="clear:none; float:right">
	<tr>
          <td><a class="PageButton" href="javascript:;" onclick="checkAllButton(document.ArtworkList.check_list);" title="Select / Deselect"><img src="./images/icon-addtobasket.gif" width="16" height="16" border="0" alt=""/><br/><span id="deselect">Select</span></a></td>
          <td><a class="PageButton" href="<?=$hrefForSmall?>" target="_blank" onclick="if(!PrintWarning()) return false;" title="Print small thumbnails and details."><img src="./images/icon-print.gif" width="16" height="16" border="0"/><br/>Small</a></td>
          <td><a class="PageButton" href="<?=$hrefForLarge?>" target="_blank" onclick="if(!PrintWarning()) return false;" title="Print large thumbnails and details."><img src="./images/icon-print.gif" width="16" height="16" border="0"/><br/>Large</a></td>
	</tr>
      </table>
	  <?php } ?>
	</td>
  </tr>
</table>
<br/>
<!---------------------------- end of heading2 ---------------------------->
<!---------------------------- starting QUARTERS  ---------------------------->
<table align="center" cellpadding="0" cellspacing="0" style="border-width:1px; border-color: silver; border-style: solid;">
  <tr align="left" valign="middle">
    <td height="15" style="padding-right:20px "><input name="quarter" type="radio" value="1" <?php if($q==1) echo("checked=\"checked\"");?> onclick="refreshQuarter(window.location.href, 1); return false;" /><?php if($q==1) echo("<strong>First Quarter</strong>"); else echo ("First Quarter");?></td>
    <td height="15" style="padding-right:20px "><input name="quarter" type="radio" value="2" <?php if($q==2) echo("checked=\"checked\"");?> onclick="refreshQuarter(window.location.href, 2); return false;" /><?php if($q==2) echo("<strong>Second Quarter</strong>"); else echo ("Second Quarter");?></td>
    <td height="15" style="padding-right:20px "><input name="quarter" type="radio" value="3" <?php if($q==3) echo("checked=\"checked\"");?> onclick="refreshQuarter(window.location.href, 3); return false;" /><?php if($q==3) echo("<strong>Third Quarter</strong>"); else echo ("Third Quarter");?></td>
    <td height="15" style="padding-right:5px "><input name="quarter" type="radio" value="4" <?php if($q==4) echo("checked=\"checked\"");?>  onclick="refreshQuarter(window.location.href, 4); return false;" /><?php if($q==4) echo("<strong>Fourth Quarter</strong>"); else echo ("Fourth Quarter");?></td>
  </tr>
</table>
<br/>
<!---------------------------- end of QUARTERS  ---------------------------->
<!---------------------------- starting Category  ---------------------------->
<table width="595" align="center" cellpadding="0" cellspacing="0" style="border-width:1px; border-color: silver; border-style: solid;">
  <tr height="20" align="left" valign="middle">
    <td width="27" >&nbsp;</td>
    <td width="95" ><input type="checkbox" <?=(stripos($_SERVER['QUERY_STRING'], "painting"))? "checked":"" ?> onclick="refresh(window.location.href, 'painting'); return false;"/>painting</td>
    <td width="95" ><input type="checkbox" <?=(stripos($_SERVER['QUERY_STRING'], "drawing"))? "checked":"" ?> onclick="refresh(window.location.href, 'drawing'); return false;"/>drawing</td>
    <td width="95" ><input type="checkbox" <?=(stripos($_SERVER['QUERY_STRING'], "gouache"))? "checked":"" ?> onclick="refresh(window.location.href, 'gouache'); return false;"/>gouache</td>
    <td width="95" ><input type="checkbox" <?=(stripos($_SERVER['QUERY_STRING'], "pastel"))? "checked":"" ?> onclick="refresh(window.location.href, 'pastel'); return false;"/>pastel</td>
    <td width="95" ><input type="checkbox" <?=(stripos($_SERVER['QUERY_STRING'], "watercolor"))? "checked":"" ?> onclick="refresh(window.location.href, 'watercolor'); return false;"/>watercolor</td>
    <td width="109" ><input type="checkbox" <?=(stripos($_SERVER['QUERY_STRING'], "sculpture"))? "checked":"" ?> onclick="refresh(window.location.href, 'sculpture'); return false;"/>sculpture
    &nbsp;&nbsp;<input type="checkbox" <input type="checkbox" <?=(stripos($_SERVER['QUERY_STRING'], "category"))? "checked":"" ?> onclick="refreshAll(window.location.href); return false;"/></td>
  </tr>
  <tr height="20" align="left" valign="middle">
    <td width="27" >&nbsp;</td>
    <td width="95" ><input type="checkbox" <?=(stripos($_SERVER['QUERY_STRING'], "collage"))? "checked":"" ?> onclick="refresh(window.location.href, 'collage'); return false;"/>collage</td>
    <td width="95" ><input type="checkbox" <?=(stripos($_SERVER['QUERY_STRING'], "photograph"))? "checked":"" ?> onclick="refresh(window.location.href, 'photograph'); return false;"/>photograph</td>
    <td width="95" ><input type="checkbox" <?=(stripos($_SERVER['QUERY_STRING'], "engraving"))? "checked":"" ?> onclick="refresh(window.location.href, 'engraving'); return false;"/>engraving</td>
    <td width="95" ><input type="checkbox" <?=(stripos($_SERVER['QUERY_STRING'], "lithograph"))? "checked":"" ?> onclick="refresh(window.location.href, 'lithograph'); return false;"/>lithograph</td>
    <td width="95" ><input type="checkbox" <?=(stripos($_SERVER['QUERY_STRING'], "ceramic"))? "checked":"" ?> onclick="refresh(window.location.href, 'ceramic'); return false;"/>ceramic</td>
    <td width="109" ><input type="checkbox" <?=(stripos($_SERVER['QUERY_STRING'], "other"))? "checked":"" ?> onclick="refresh(window.location.href, 'other'); return false;"/>other</td>
  </tr>
</table>
<br/>
<!---------------------------- end of Category  ---------------------------->
<!---------------------------- Start Thumbnail Gallery ---------------------------->
<form action="" method="get" name="ArtworkList" id="ArtworkList">
<table width="620" cellspacing="7" align="center" style="margin-bottom:20px ">
<?php while($row = mysql_fetch_array($result)){ ?>
<tr>
  <td width="20%">
    <table class="ThumbGallery">
      <tr><td class="Pic"><a href="index.php?view=ArtworkInfo&OPPID=<?=$row['opp']?>" target="_blank" onclick="OpenWin(this.href, 'ArtworkInfo', 748, 550); return false;"><?php
	  if ($_SESSION['UserType'] == 'admin' || $row['notVerified'] == 0){
	  ?>
	  <img src="../graphics/<?= $_GET['year']?>/xthumbs/x<?=$obj->imgName($row['opp'])?>.jpg" class="imageStyle" title="<?=$row['title']?>"/>
	  <?php
	  }
	  else{
	  	?>
		<img src="https://picasso.shsu.edu/images/xopp-emblem-innershadow.jpg" class="imageStyle" title="<?=$row['title']?>"/>
		<?php
	  }
	  ?></a></td>
      </tr>
      <tr><td align="center" valign="middle"><input name="check_list" type="checkbox" value="<?=$row['opp']?>" />
	  <span class="OPP"><?=$row['opp']?></span>
	  </td>
      </tr>
    </table>
  </td>

  <td width="20%"><?php if($row = mysql_fetch_array($result)) { ?>
    <table class="ThumbGallery">
      <tr><td class="Pic"><a href="index.php?view=ArtworkInfo&OPPID=<?=$row['opp']?>" target="_blank" onclick="OpenWin(this.href, 'ArtworkInfo', 748, 550); return false;"><?php
	  if ($_SESSION['UserType'] == 'admin' || $row['notVerified'] == 0){
	  ?>
	  <img src="../graphics/<?= $_GET['year']?>/xthumbs/x<?=$obj->imgName($row['opp'])?>.jpg" class="imageStyle" title="<?=$row['title']?>"/>
	  <?php
	  }
	  else{
	  	?>
		<img src="https://picasso.shsu.edu/images/xopp-emblem-innershadow.jpg" class="imageStyle" title="<?=$row['title']?>"/>
		<?php
	  }
	  ?></a></td>
      </tr>
      <tr><td align="center" valign="middle"><input name="check_list" type="checkbox" value="<?=$row['opp']?>" />
	  <span class="OPP"><?=$row['opp']?></span>
	  </td>
      </tr>
    </table>
  <?php } else echo("&nbsp;");?>
  </td>
  <td width="20%"><?php if($row = mysql_fetch_array($result)) { ?>
    <table class="ThumbGallery">
      <tr><td class="Pic"><a href="index.php?view=ArtworkInfo&OPPID=<?=$row['opp']?>" target="_blank" onclick="OpenWin(this.href, 'ArtworkInfo', 748, 550); return false;"><?php
	  if ($_SESSION['UserType'] == 'admin' || $row['notVerified'] == 0){
	  ?>
	  <img src="../graphics/<?= $_GET['year']?>/xthumbs/x<?=$obj->imgName($row['opp'])?>.jpg" class="imageStyle" title="<?=$row['title']?>"/>
	  <?php
	  }
	  else{
	  	?>
		<img src="https://picasso.shsu.edu/images/xopp-emblem-innershadow.jpg" class="imageStyle" title="<?=$row['title']?>"/>
		<?php
	  }
	  ?></a></td>
      </tr>
      <tr><td align="center" valign="middle"><input name="check_list" type="checkbox" value="<?=$row['opp']?>" />
	  <span class="OPP"><?=$row['opp']?></span>
	  </td>
      </tr>
    </table>
  <?php } else echo("&nbsp;");?>
  </td>
  <td width="20%"><?php if($row = mysql_fetch_array($result)) { ?>
    <table class="ThumbGallery">
      <tr><td class="Pic"><a href="index.php?view=ArtworkInfo&OPPID=<?=$row['opp']?>" target="_blank" onclick="OpenWin(this.href, 'ArtworkInfo', 748, 550); return false;"><?php
	  if ($_SESSION['UserType'] == 'admin' || $row['notVerified'] == 0){
	  ?>
	  <img src="../graphics/<?= $_GET['year']?>/xthumbs/x<?=$obj->imgName($row['opp'])?>.jpg" class="imageStyle" title="<?=$row['title']?>"/>
	  <?php
	  }
	  else{
	  	?>
		<img src="https://picasso.shsu.edu/images/xopp-emblem-innershadow.jpg" class="imageStyle" title="<?=$row['title']?>"/>
		<?php
	  }
	  ?></a></td>
      </tr>
      <tr><td align="center" valign="middle"><input name="check_list" type="checkbox" value="<?=$row['opp']?>" />
	  <span class="OPP"><?=$row['opp']?></span>
	  </td>
      </tr>
    </table>
  <?php } else echo("&nbsp;");?>
  </td>
  <td width="20%"><?php if($row = mysql_fetch_array($result)) { ?>
    <table class="ThumbGallery">
      <tr><td class="Pic"><a href="index.php?view=ArtworkInfo&OPPID=<?=$row['opp']?>" target="_blank" onclick="OpenWin(this.href, 'ArtworkInfo', 748, 550); return false;"><?php
	  if ($_SESSION['UserType'] == 'admin' || $row['notVerified'] == 0){
	  ?>
	  <img src="../graphics/<?= $_GET['year']?>/xthumbs/x<?=$obj->imgName($row['opp'])?>.jpg" class="imageStyle" title="<?=$row['title']?>"/>
	  <?php
	  }
	  else{
	  	?>
		<img src="https://picasso.shsu.edu/images/xopp-emblem-innershadow.jpg" class="imageStyle" title="<?=$row['title']?>"/>
		<?php
	  }
	  ?></a></td>
      </tr>
      <tr><td align="center" valign="middle"><input name="check_list" type="checkbox" value="<?=$row['opp']?>" />
	  <span class="OPP"><?=$row['opp']?></span>
	  </td>
      </tr>
    </table>
  <?php } else echo("&nbsp;");?>
  </td>
</tr>
<?php } ?>
</table>
</form>
<!---------------------------- End Thumbnail Gallery ---------------------------->
<!---------------------------- Start Page Navigator ---------------------------->
<?php
require_once(MODULES_PATH.'PageNavigator.php');
$obj = new PageNavigator($totalPages, $page, $_SERVER['QUERY_STRING']);
$obj->showPgNavigator();
?>
<!---------------------------- End Page Navigator ---------------------------->
				</td>
              </tr>
            </table>
		  </td>
        </tr>
      </table>
	</td>
  </tr>
</table>
<?php include('footer.php'); ?>
</center>
</body>
</html>
