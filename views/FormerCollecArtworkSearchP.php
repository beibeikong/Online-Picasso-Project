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
<title>Artwork Search Results - On-line Picasso Project</title>
<link rel="stylesheet" href="./css/main.css"/>
<link rel="stylesheet" href="./css/ArtworkSummary.css"/>
<script type="text/javascript" src="./js/main.js"></script>
<script type="text/javascript" src="./js/popup.js"></script>
<script type="text/javascript" src="./js/FormerCollection.js"></script>
<script type="text/javascript">
        function resizeIframe(obj){
        {obj.style.height = 0;};
        {obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';}
        }</script>	
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>

<body onload="window.name='OPPMain';">
<?php
require_once(MODULES_PATH.'FormerCollecArtworkSearch.php');
$obj = new FormerCollecArtworkSearch($_GET);
$result = $obj->getData();
$totalNum = $obj->getTotalNum();
$page = (isset($_GET['page']))? $_GET['page'] : 1;  // current page number
$totalPages = $obj->getTotalPage(); // how many pages totally

$href_temp = 'index.php?'.$_SERVER['QUERY_STRING'];
$href_temp = str_replace("&page=".$_GET['page'], "", $href_temp);
$hrefForSmall = str_replace("ArtworkSearchD", "ArtworkPrintSmall", $href_temp);
$hrefForLarge = str_replace("ArtworkSearchD", "ArtworkPrintLarge", $href_temp);
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
			    <td width="40" align="center"></td>
			    <td><span class="big_year">Former Collector Artwork</span></td>
                <td width="40" align="center"></td>
		      </tr>
	        </table>
	      </td>
        </tr>
        
		<tr>
          <td>
            <table class="TabContainer" id="MenuTabs" cellspacing="0" align="center">
              <tr class="Tabs">
	            <td class="Inactive"><a href="index.php?<?=str_replace("FormerCollecArtworkSearchP","FormerCollecArtworkSearchD",$_SERVER['QUERY_STRING'])?>"><img src="./images/magnify-art.png"/>Artwork Display</a></td>
	            <td class="Inactive"><a href="index.php?<?=str_replace("FormerCollecArtworkSearchP","FormerCollecArtworkSearchS",$_SERVER['QUERY_STRING'])?>"><img src="./images/magnify-art.png"/>Artwork Summary</a></td>		   
				<td class="Active"><img src="./images/magnify-art.png"/>Artwork Provenance</td>
				<td class="EmptySpace">&nbsp;</td>
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
		  <td><a class="PageButton" href="javascript:;" onclick="SubmitWorksBasket('ArtworkList','FormerWorkBasketP');" title="Go to the empty workbasket."><img src="./images/icon-addtobasket.gif" width="16" height="16" border="0" alt=""/><br/>
			Basket</a></td>	
		  <td>
	        <a class="PageButton" href="javascript:;" onclick="SubmitWorksBasketAdd('ArtworkList','FormerWorkBasketP');" title="Add the selected items to the artwork series."><img src="./images/icon-addtobasket.gif" width="16" height="16" border="0" alt=""/><br/>Add</a>
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
	    <tr><td>
	        <a class="PageButton" href="javascript:;" onclick="checkAllButton(document.ArtworkList.check_list);" title="Select / Deselect"><img src="./images/icon-addtobasket.gif" width="16" height="16" border="0" alt=""/><br/><span id="deselect">Select</span></a>
          </td>
          <!--- space for print icon -->
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
<table width="100%" border="0" align="center" cellpadding="0"  cellspacing="0" style="margin-bottom:20px ">
<?php $i = 1; while($row = mysql_fetch_array($result)){ 
$AcceptedTitle = $obj->getAcceptedTitle($row['title']);$formercount = $obj->formercollec($row['opp']);?>
  <tr>
    <td width="85" align="left" valign="top">
      <table cellpadding="0" cellspacing="2">
	<?php
	if (isset($_SESSION['UserType'])) {
	if ($_SESSION['UserType'] == 'admin' || $row['notVerified'] == 0){
            ?><tr><td height="17px">
                <a href="index.php?view=zoom&alpha=<?=$obj->imgName($row['opp'])?>&random=<?=$row['year']*23?>" onclick="OpenWin(this.href, 'ArtworkZoom', 850, 600); return false;" class="SmallControl" target="_blank" title="Zoom Artwork Image"><img src="./images/tinyicon-magnify.png" alt=""/>&nbsp;Zoom</a></td></tr>
      		  <?php 
	 } }?>        
	  <?php if($formercount!=0) { ?><tr><td height="17px">
                <a  href="index.php?view=ArtworkProvenance&OPPID=<?=$row['opp']?>" class="SmallControl" target="_blank" title="View Artwork Provenance"  onclick="OpenWin(this.href, 'ArtworkProvenance', 740, 550); return false;"><img src="./images/tinyicon-text.png" alt=""/>&nbsp;Provenance</a></td></tr>
            <?php } ?><tr><td height="17px">
                <a  href="index.php?view=ArtworkBibliography&OPPID=<?=$row['opp']?>" class="SmallControl" target="_blank" title="View Artwork Literature"  onclick="OpenWin(this.href, 'ArtworkBibliography', 740, 550); return false;"><img src="./images/tinyicon-text.png" alt=""/>&nbsp;Literature</a></td></tr>
	    <?php if(($row['bookCatalog']!='')&& (strpos($row['bookCatalog'],'*') !== false)) { ?> <tr><td height="17px">
                <a href="index.php?view=ArtworkBibliographyExhibited&OPPID=<?=$row['opp']?>" target="_blank" onclick="OpenWin(this.href, 'ArtworkExhibited', 740, 550); return false;"  class="SmallControl" title="View Artwork Exhibited"><img src="./images/tinyicon-text.png" alt=""/>&nbsp;Exhibited</a></td></tr>
          <?php } ?>	 
                    <?php if(trim($row['notes'])!="") { ?><tr><td height="17px">
             <a href="index.php?view=ArtworkNote&OPPID=<?=$row['opp']?>" target="_blank" onclick="OpenWin(this.href, 'ArtworkNote', 740, 550); return false;"  class="SmallControl" title="View Artwork Note"><img src="./images/tinyicon-text.png" alt=""/>&nbsp;Note</a></td></tr>
		  <?php } ?>
          <?php if(trim($row['commentary'])!="") { ?> <tr><td height="17px">
                <a href="index.php?view=ArtworkCommentary&OPPID=<?=$row['opp']?>" target="_blank" onclick="OpenWin(this.href, 'ArtworkCommentary', 740, 550); return false;"  class="SmallControl" title="View Artwork Commentary"><img src="./images/tinyicon-text.png" alt=""/>&nbsp;Commentary</a></td></tr>
          <?php } ?>
                  </table>

      </td>
    <td width="120" valign="top" height="116" style="padding:4px"><table class="ThumbGallery"><tr><td class="Pic"><a href="index.php?view=ArtworkInfo&OPPID=<?=$row['opp']?>" target="_blank" onclick="OpenWin(this.href, 'ArtworkInfo', 748, 600); return false;">
	  <?php
	  if ($_SESSION['UserType'] == 'admin' || $row['notVerified'] == 0){
	  ?>
	  <img src="http://picasso.shsu.edu/graphics/<?= $row['year']?>/xthumbs/x<?=$obj->imgName($row['opp'])?>.jpg" class="imageStyle" title="<?=$row['title']?>"/>
	  <?php
	  }
	  else{
	  	?>
		<img src="https://picasso.shsu.edu/images/xopp-emblem-innershadow.jpg"/>
		<?php
	  }
	  ?></a></td></tr>
	  <tr><td align="center" valign="middle"><input name="check_list"type="checkbox" value="<?=$row['opp']?>" /><span class="OPP"><?=$row['opp']?></span>
	  </td>
      </tr>
	  </table>
    </td>
   
<td align="center" valign="top"><iframe src ="index.php?view=former&OPPID=<?=$row['opp']?><?php if(isset($_GET['highlight'])) echo("&highlight=$_GET[highlight]");?>"  align="center" width="100%" onload="javascript:resizeIframe(this);" scrolling="no" frameborder="0"> </iframe>
    </td>

</tr>
<?php $i++; } ?>
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
