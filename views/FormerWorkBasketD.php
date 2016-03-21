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
<title>Artwork Series - On-line Picasso Project</title>
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
session_start();
require_once(MODULES_PATH.'WorkBasketDisplay.php');
$obj = new WorkBasketDisplay($_GET,$_SESSION);
$result = $obj->getData();
$totalNum = $obj->getTotalNum();
$page = (isset($_GET['page']))? $_GET['page'] : 1;  // current page number
$totalPages = $obj->getTotalPage(); // how many pages totally
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
				</td>
			    <td><h1>Artwork Series</h1></td>
                <td width="40" align="center">
			    </td>
		      </tr>
	        </table>
	      </td>
        </tr>
        
		<tr>
          <td>
            <table class="TabContainer" id="MenuTabs" cellspacing="0" align="center">
              <tr class="Tabs">
                    <?php 
                        $href = "index.php?".$_SERVER['QUERY_STRING'];
                        $href2 = str_replace("FormerWorkBasketD", "FormerWorkBasketS", $href);
                        $href3 = str_replace("FormerWorkBasketD", "FormerWorkBasketP", $href);
                    ?>
                <td class="Active"><img src="./images/magnify-text.png"/>Basket Display</td>    
                <td class="Inactive"><a href="<?=$href2?>"><img src="./images/magnify-art.png"/>Basket Summary</a></td>               
                <td class="Inactive"><a href="<?=$href3?>"><img src="./images/magnify-art.png"/>Basket Provenance</a></td>
		<td class="InactiveEmpty">&nbsp;</td>
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
	        <a class="PageButton" href="javascript:;" target="_blank" onclick="window.history.go(-1); return false;" /><img src="./images/icon-addtobasket.gif" width="16" height="16" border="0" alt=""/><br/>Return</a>
          </td>
		  <td>
	        <a class="PageButton" href="javascript:;" onclick="SubmitWorksBasketRemove('ArtworkList','FormerWorkBasketD');" title="Remove the selected items from the artwork series."><img src="./images/icon-delete.gif" width="16" height="16" border="0" alt=""/><br/>Remove</a>
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
          <td>
	        <a class="PageButton" href="index.php?view=WorkBasketSmall" target="_blank" onclick="if(!PrintWarning()) return false;" title="Print small thumbnails and details."><img src="./images/icon-print.gif" width="16" height="16" border="0"/><br/>Small</a>
		  </td>
          <td>
            <a class="PageButton" href="index.php?view=WorkBasketLarge" target="_blank" onclick="if(!PrintWarning()) return false;" title="Print large thumbnails and details."><img src="./images/icon-print.gif" width="16" height="16" border="0"/><br/>Large</a>
		  </td>
		</tr>
      </table>
	  <?php } ?>
	</td>
  </tr>
</table>
<br/>
<!---------------------------- end of heading2 ---------------------------->

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
	  <img src="../graphics/<?= $row['year']?>/xthumbs/x<?=$obj->imgName($row['opp'])?>.jpg" class="imageStyle" title="<?=$row['title']?>"/>
	  <?php
	  }
	  else{
	  	?>
		<img src="https://picasso.shsu.edu/images/xopp-emblem-innershadow.jpg"/>
		<?php
	  }
	  ?></a></td>
      </tr>
      <tr><td align="center" valign="middle"><input type="checkbox" value="<?=$row['opp']?>" /><span class="OPP"><?=$row['opp']?></span>
	  </td>
      </tr>
    </table>
  </td>
  
  <td width="20%"><?php if($row = mysql_fetch_array($result)) { ?>
    <table class="ThumbGallery">
      <tr><td class="Pic"><a href="index.php?view=ArtworkInfo&OPPID=<?=$row['opp']?>" target="_blank" onclick="OpenWin(this.href, 'ArtworkInfo', 748, 550); return false;"><?php
	  if ($_SESSION['UserType'] == 'admin' || $row['notVerified'] == 0){
	  ?>
	  <img src="../graphics/<?= $row['year']?>/xthumbs/x<?=$obj->imgName($row['opp'])?>.jpg" class="imageStyle" title="<?=$row['title']?>"/>
	  <?php
	  }
	  else{
	  	?>
		<img src="https://picasso.shsu.edu/images/xopp-emblem-innershadow.jpg"/>
		<?php
	  }
	  ?></a></td>
      </tr>
      <tr><td align="center" valign="middle"><input type="checkbox" value="<?=$row['opp']?>" /><span class="OPP"><?=$row['opp']?></span>
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
	  <img src="../graphics/<?= $row['year']?>/xthumbs/x<?=$obj->imgName($row['opp'])?>.jpg" class="imageStyle" title="<?=$row['title']?>"/>
	  <?php
	  }
	  else{
	  	?>
		<img src="https://picasso.shsu.edu/images/xopp-emblem-innershadow.jpg"/>
		<?php
	  }
	  ?></a></td>
      </tr>
      <tr><td align="center" valign="middle"><input type="checkbox" value="<?=$row['opp']?>" /><span class="OPP"><?=$row['opp']?></span>
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
	  <img src="../graphics/<?= $row['year']?>/xthumbs/x<?=$obj->imgName($row['opp'])?>.jpg" class="imageStyle" title="<?=$row['title']?>"/>
	  <?php
	  }
	  else{
	  	?>
		<img src="https://picasso.shsu.edu/images/xopp-emblem-innershadow.jpg"/>
		<?php
	  }
	  ?></a></td>
      </tr>
      <tr><td align="center" valign="middle"><input type="checkbox" value="<?=$row['opp']?>" /><span class="OPP"><?=$row['opp']?></span>
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
	  <img src="../graphics/<?= $row['year']?>/xthumbs/x<?=$obj->imgName($row['opp'])?>.jpg" class="imageStyle" title="<?=$row['title']?>"/>
	  <?php
	  }
	  else{
	  	?>
		<img src="https://picasso.shsu.edu/images/xopp-emblem-innershadow.jpg"/>
		<?php
	  }
	  ?></a></td>
      </tr>
      <tr><td align="center" valign="middle"><input type="checkbox" value="<?=$row['opp']?>" /><span class="OPP"><?=$row['opp']?></span>
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

<!---------------------------- Start OPP Customization ----------------->
<center>
  <div class="BoxStateClosed" id="ThisCCCBox">
    <table class="LabelHolder" cellspacing="0">
      <tr>
        <td class="LabelCellHolder">
          <a href="javascript:OpenCloseImportExportBox('ThisCCCBox');" class="Label">
		  <img src="./images/tree-plus.png"  class="Plus"  width="9" height="9" alt="+" title="Click here to reveal the import/Export Options"/>
	      <img src="./images/tree-minus.png" class="Minus" width="9" height="9" alt="-" title="Click here to collapse the import/Export Options"/>
		  Importing/Exporting Options</a>
        </td>
	    <td><hr/></td>
	  </tr>
    </table>
		
    <!-- start catalog choosing table -->				
    <div class="Contents">
    <table width="100%" align="center"  cellspacing="0">
	  <tr>
		<td width="310" valign="top" align="center"><table width="290" border="0" align="center" cellpadding="0" cellspacing="0">
		  <tr><td align="left" width="100%" height="20">
		  <b>Exporting Artworks</b></td></tr>
		  <tr><td align="left" width="100%">
		  You can export the contents of the artwork series by copying the code below and saving it to a text file using your favorite text editor.<br/>
		  <textarea id="ECatalogIDs" class="OPPColumnList"><?php $result = $obj->getAllData();if($row = mysql_fetch_array($result)) echo($row['opp']);while($row = mysql_fetch_array($result)){ echo("\n");echo($row['opp']);} ?></textarea>
		</td></tr></table></td>
        <td width="310" valign="top" align="center"><table width="290" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td align="left" width="100%" height="20">
		  <b>Importing Artworks</b></td></tr>
		  <tr><td align="left" width="100%">
		  You can import a list of artworks onto the artwork series by pasting code you previously exported, or by entering one artwork OPP per line.<br/>
		  <textarea id="ICatalogIDs" class="OPPColumnList"></textarea><br/>
		  <center><button type="button" style="width:80px" onclick="ImportOPP('WorkBasketDisplay');">Import</button></center>
		</td></tr></table></td>
	  </tr>
    </table>						
    </div>
      <!-- end catalog choosingg table --> 
  </div>
</center>
<!---------------------------- End OPP Customization----------------->
	  
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
