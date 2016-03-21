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
<title>Biography Search Results - On-line Picasso Project</title>
<link rel="stylesheet" href="./css/main.css"/>
<link rel="stylesheet" href="./css/biography.css"/>
<script type="text/javascript" src="./js/main.js"></script>
<script type="text/javascript" src="./js/popup.js"></script>
<script type="text/javascript" src="./js/Biography.js"></script>
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>

<body onload="window.name='OPPMain'; <?php if(trim($_GET['Keywords'])!='') echo("highlightSearchTerms('$_GET[Keywords]','BioHighlightTarget');");?>">
<?php
$NumberofItemsOnePage = 20;

require_once(MODULES_PATH.'BioSearch.php');
$obj = new BioSearch($_GET);
$result = $obj->getData();
$totalNum = $obj->getTotalNum();
$page = (isset($_GET['page']))? $_GET['page'] : 1;  // current page number
$totalPages = ceil($totalNum/$NumberofItemsOnePage);; // how many pages totally
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
			    <td><span class="big_year">Biography Search Results</span></td>
                <td width="40" align="center"></td>
		      </tr>
	        </table>
	      </td>
        </tr>
        
		<tr>
          <td>
            <table class="TabContainer" id="MenuTabs" cellspacing="0" align="center">
              <tr class="Tabs">
  	            <td class="Active"><img src="./images/magnify-text.png"/>Biography</td>
				<td class="Inactive"><a href="index.php?<?=str_replace("BioSearch","BioCommSearch",$_SERVER['QUERY_STRING'])?>"><img src="./images/magnify-text.png"/>Commentary</a></td>
				<td class="EmptySpace">&nbsp;</td>	
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
		  <td>&nbsp; </td>
		  <td>&nbsp; </td>
        </tr>
      </table>
    </td>
	
	<td>
	  <h2><?=$totalNum?> Matched Entries</h2>
	  <h3>Viewing entry <?php echo(($page-1)*$NumberofItemsOnePage+1)?> through <?php echo(min($page*$NumberofItemsOnePage, $totalNum))?></h3>
	</td>
	
	<td width="150px" align="right" >
	  <table cellspacing="0" style="clear:none; float:right">
	    <tr>
          <td>
            <a class="PageButton" href="index.php?<?=str_replace("BioSearch", "printBioSearch", $_SERVER['QUERY_STRING'])?>" target="_blank" onclick="if(!PrintWarning()) return false;" ><img src="./images/icon-print.gif" width="16" height="16" border="0"/><br/>Print</a>
		  </td>
		</tr>
      </table>
	</td>
  </tr>
</table>
<br/>
<!---------------------------- end of heading2 ---------------------------->
<!---------------------------- Start ---------------------------->
<div id="BioHighlightTarget">
<table width="695" border="0" align="center" cellspacing="2">
<?php $currentYear=0; while($row = mysql_fetch_array($result)){ 
      if($currentYear!=$row['StartYear'])
	  {
	    $currentYear = $row['StartYear'];
		echo ("<tr><td colspan=\"2\" align=\"center\"><h2>$currentYear</h2></td></tr>");
	  }
?>
  <tr>
    <td class="duration"><?=$row['dateDesc']?>:
	 <?php if(trim($row['commentary'])!="") { ?>
	   <br />
	   <a  href="index.php?view=BioCommentary&id=<?=$row['id']?>&year=<?=$row['StartYear']?>&dateDesc=<?=$row['dateDesc']?><?php if(trim($_GET['Commentary'])!=="") echo("&highlight=$_GET[Commentary]");?>" class="Biotab" target="_blank" title="Open commentary in a pop-up window"  onclick="OpenWin(this.href, 'BioCommentary', 660, 550); return false;">Commentary</a>
     <?php } ?>
	 
	 <?php if($row['dateDesc']!="Year-Forth") {?>
			 <?php if($row['DatedArtworks']>0 && $row['DatedArtworks']<=5) { ?>
			   <a  href="index.php?view=DatedArtworks&startYear=<?=$row['StartYear']?>&startMonth=<?=$row['StartMonth']?>&startDay=<?=$row['StartDay']?>&endYear=<?=$row['EndYear']?>&endMonth=<?=$row['EndMonth']?>&endDay=<?=$row['EndDay']?>" class="Biotab" target="_blank" title="View Artworks made during this timeframe"  onclick="OpenWin(this.href, 'artwork', 660, 320); return false;">Artwork</a>
			 <?php } ?>
			 
			 <?php if($row['DatedArtworks']>5) { ?>
			   <a  href="index.php?view=DatedArtworks&startYear=<?=$row['StartYear']?>&startMonth=<?=$row['StartMonth']?>&startDay=<?=$row['StartDay']?>&endYear=<?=$row['EndYear']?>&endMonth=<?=$row['EndMonth']?>&endDay=<?=$row['EndDay']?>" class="Biotab" target="_blank" title="View Artworks made during this timeframe"  onclick="OpenWin(this.href, 'artwork', 660, 550); return false;">Artwork</a>
			 <?php } ?>
	 <?php } ?>		
	 
	 <?php if($row['DatedText']>0) 
	       { $writingsResult =  $obj->getWritings($row['StartYear'],$row['StartMonth'],$row['StartDay'],$row['EndYear'],$row['EndMonth'],$row['EndDay']);
	         while($writingsRow = mysql_fetch_array($writingsResult)) {
	 ?>
	   <a  href="index.php?view=BioWritings&mid=<?=$writingsRow['mid']?>&year=<?=$row['StartYear']?>" class="Biotab" target="_blank" onclick="OpenWin(this.href, 'Writing', 748, 800); return false;"title="View Writings made during this timeframe">Writings</a>
     <?php } } ?>
	 
	 <!--------------- start to generate Photo button-------------------------->
	 <?php
	 	$photoid = $obj->getPhoto($row['id']);
		if($photoid!=''){
	?>
    
		<a  href="index.php?view=PhotoSummary&year=<?=$row['StartYear']?>&id=<?=$photoid['id']?>" target="_blank" onclick="OpenWin(this.href, 'BioPhoto', 748, 550);  return false;" class="Biotab" title="<?="View Photo"?>">Photograph</a>
	<?php
			}
		
	?>
	<!--------------- end generating Photo button-------------------------->
	</td> 
    <td class="title" id="bioContent">
         <?php
        $photo_d = $obj->getPhoto_D($row['id']);
        $opp_d = $obj->getOPP_D($row['id']);?>
        <table class="ImageStrip" cellspacing="7">
        <?php
		while($row1 = mysql_fetch_array($photo_d)){
                    ?>   <tr><td align="center"><?=$row1[path]?></td></tr>
	<?php } 
		while($row2 = mysql_fetch_array($opp_d)){
                    ?>   <tr><td align="center"><?=$row2[path]?></td></tr>
	<?php } ?></table>               
        <?=$obj->parseText($row['event'],$row['StartYear'],$page)?></td>
  </tr>
<?php } ?>
</table>
</div>
<!---------------------------- End  ---------------------------->
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
