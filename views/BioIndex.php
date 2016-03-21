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
<title>Biography of <?=$_GET['year']?> - On-line Picasso Project</title>
<link rel="stylesheet" href="./css/main.css"/>
<link rel="stylesheet" href="./css/biography.css"/>
<script type="text/javascript" src="./js/main.js"></script>
<script type="text/javascript" src="./js/popup.js"></script>
<script type="text/javascript" src="./js/Biography.js"></script>
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>

<body onload="window.name='OPPMain';">
<?php
if(isset($_GET['quarter'])) $q = $_GET['quarter']; else $q = 1; // get quarter
$NumberofItemsOnePage = 20;

require_once(MODULES_PATH.'BioIndex.php');
$obj = new BioIndex($_GET);
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
			    <td width="40" align="center">
				  <?php
				    if($_GET['year']>1881)
					{
                       $temp = $_GET['year']-1;
					  echo("<a href=\"index.php?view=BioIndex&year=$temp&quarter=1\" title=\"Previous Year\"><img src=\"./images/arrow-left.png\" width=\"23\" height=\"20\" border=\"0\" /></a>");
				    }
				  ?>
				</td>
			    <td><span class="big_year"><?=$_GET['year']?></span><span class="age">[<?=$_GET['year']-BORN_YEAR?>]</span></td>
                <td width="40" align="center">
				  <?php
				     if($_GET['year']<DIED_YEAR)
					 {
					   $temp = $_GET['year']+1;
                       echo("<a href=\"index.php?view=BioIndex&year=$temp&quarter=1\" title=\"Next Year\"><img src=\"./images/arrow-right.png\" width=\"23\" height=\"20\" border=\"0\" /></a>");
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
  	            <td class="Active"><img src="./images/magnify-text.png"/>Biography</td>
	            <td class="Inactive"><a href="index.php?view=ArtworkDisplay&year=<?=$_GET['year']?>&category=painting_collage_photograph_sculpture_ceramic_drawing_watercolor_gouache_pastel_engraving_lithograph_other&quarter=<?=$q?>"><img src="./images/magnify-art.png"/>Artwork Display</a></td>
	            <td class="Inactive"><a href="index.php?view=ArtworkSummary&year=<?=$_GET['year']?>&category=painting_collage_photograph_sculpture_ceramic_drawing_watercolor_gouache_pastel_engraving_lithograph_other&quarter=<?=$q?>"><img src="./images/magnify-text.png"/>Artwork Summary</a></td>
	            <td class="Inactive"><a href="index.php?view=ArtworkConcordance&year=<?=$_GET['year']?>&category=painting_collage_photograph_sculpture_ceramic_drawing_watercolor_gouache_pastel_engraving_lithograph_other"><img src="./images/magnify-text.png" alt="Artwork Catalog Concordance"/>Concordance</a></td>
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
	  <h2><?=$totalNum?> Entries</h2>
	  <h3>Viewing entry <?php echo(($page-1)*$NumberofItemsOnePage+1)?> through <?php echo(min($page*$NumberofItemsOnePage, $totalNum))?></h3>
	</td>

	<td width="150px" align="right" >
	  <table cellspacing="0" style="clear:none; float:right">
	    <tr>
          <td>
	        <a class="PageButton" href="index.php?view=printBio&year=<?=$_GET['year']?>&quarter=<?php if(isset($_GET['quarter'])) echo $_GET['quarter']; else echo 1;?>" target="_blank" onclick="if(!PrintWarning()) return false;" title="Print narrative notes of a quarter."><img src="./images/icon-print.gif" width="16" height="16" border="0"/><br/>PrintQ</a>
		  </td>
          <td>
            <a class="PageButton" href="index.php?view=printBio&year=<?=$_GET['year']?>" target="_blank" onclick="if(!PrintWarning()) return false;" title="Print narrative notes of a year."><img src="./images/icon-print.gif" width="16" height="16" border="0"/><br/>PrintY</a>
		  </td>
		</tr>
      </table>
	</td>
  </tr>
</table>
<br/>
<!---------------------------- end of heading2 ---------------------------->

<!---------------------------- starting Category  ---------------------------->
<table align="center" cellpadding="0" cellspacing="0" style="border-width:1px; border-color: silver; border-style: solid;">
  <tr align="left" valign="middle">
    <td height="15" style="padding-right:20px "><input name="quarter" type="radio" value="1" <?php if($q==1) echo("checked=\"checked\"");?> onclick="refresh(window.location.href, 1); return false;" /><?php if($q==1) echo("<strong>First Quarter</strong>"); else echo ("First Quarter");?></td>
    <td height="15" style="padding-right:20px "><input name="quarter" type="radio" value="2" <?php if($q==2) echo("checked=\"checked\"");?> onclick="refresh(window.location.href, 2); return false;" /><?php if($q==2) echo("<strong>Second Quarter</strong>"); else echo ("Second Quarter");?></td>
    <td height="15" style="padding-right:20px "><input name="quarter" type="radio" value="3" <?php if($q==3) echo("checked=\"checked\"");?> onclick="refresh(window.location.href, 3); return false;" /><?php if($q==3) echo("<strong>Third Quarter</strong>"); else echo ("Third Quarter");?></td>
    <td height="15" style="padding-right:5px "><input name="quarter" type="radio" value="4" <?php if($q==4) echo("checked=\"checked\"");?>  onclick="refresh(window.location.href, 4); return false;" /><?php if($q==4) echo("<strong>Fourth Quarter</strong>"); else echo ("Fourth Quarter");?></td>
  </tr>
</table>
<br/>
<!---------------------------- end of Category  ---------------------------->
<!---------------------------- Start ---------------------------->
<table width="695" border="0" align="center" cellspacing="2">
<?php while($row = mysql_fetch_array($result)){ ?>
  <tr>
    <td class="duration"><?=$row['dateDesc']?>:
	 <?php if(trim($row['commentary'])!="") { ?>
	   <br />
	   <a  href="index.php?view=BioCommentary&id=<?=$row['id']?>&year=<?=$_GET['year']?>&dateDesc=<?=$row['dateDesc']?>" class="Biotab" target="_blank" title="Open commentary in a pop-up window"  onclick="OpenWin(this.href, 'BioCommentary', 748, 550); return false;">Commentary</a>
     <?php } ?>

	 <?php if($row['dateDesc']!="Year-Forth") {?>
			 <?php if($row['DatedArtworks']>0 && $row['DatedArtworks']<=5) { ?>
			   <a  href="index.php?view=DatedArtworksSummary&startYear=<?=$row['StartYear']?>&startMonth=<?=$row['StartMonth']?>&startDay=<?=$row['StartDay']?>&endYear=<?=$row['EndYear']?>&endMonth=<?=$row['EndMonth']?>&endDay=<?=$row['EndDay']?>" class="Biotab" target="_blank" title="View Artworks made during this timeframe"  onclick="OpenWin(this.href, 'artwork', 748, 550); return false;">Artwork</a>
			 <?php } ?>

			 <?php if($row['DatedArtworks']>5) { ?>
			   <a  href="index.php?view=DatedArtworksSummary&startYear=<?=$row['StartYear']?>&startMonth=<?=$row['StartMonth']?>&startDay=<?=$row['StartDay']?>&endYear=<?=$row['EndYear']?>&endMonth=<?=$row['EndMonth']?>&endDay=<?=$row['EndDay']?>" class="Biotab" target="_blank" title="View Artworks made during this timeframe"  onclick="OpenWin(this.href, 'artwork', 748, 550); return false;">Artwork</a>
			 <?php } ?>
	 <?php } ?>

	 <?php if($row['DatedText']>0)
	       { $writingsResult =  $obj->getWritings($row['StartYear'],$row['StartMonth'],$row['StartDay'],$row['EndYear'],$row['EndMonth'],$row['EndDay']);
	         while($writingsRow = mysql_fetch_array($writingsResult)) {
	 ?>
	   <a  href="index.php?view=BioWritings&mid=<?=$writingsRow['mid']?>&year=<?=$_GET['year']?>" class="Biotab" target="_blank" onclick="OpenWin(this.href, 'Writing', 748, 800); return false;"title="View Writings made during this timeframe">Writings</a>
     <?php } } ?>

	 <!--------------- start to generate Photo button-------------------------->
	 <?php
	 	$photoid = $obj->getPhoto($row['id']);
		if($photoid!=''){
	?>
    
		<a  href="index.php?view=DatedPhotos&year=<?=$_GET['year']?>&id=<?=$photoid['id']?>" target="_blank" onclick="OpenWin(this.href, 'BioPhoto', 748, 550);  return false;" class="Biotab" title="<?="View Photos made during this timeframe"?>">Photograph</a>
	<?php
			}
		
	?>
	<!--------------- end generating Photo button-------------------------->
	</td>
    <td class="title">
        <?php
        $photo_d = $obj->getPhoto_D($row['id']);
        $opp_d = $obj->getOPP_D($row['id']);
        $noVerified = $obj->getOPP_D($row['notVerified']);
        
        if (isset($_SESSION['UserType'])) {
	if ($_SESSION['UserType'] == 'admin' || $noVerified == 0){
                ?>
        <table class="ImageStrip" cellspacing="7">
        <?php
		while($row1 = mysql_fetch_array($photo_d)){
                    ?>   <tr><td align="center"><?=$row1[path]?></td></tr>
	<?php } 
		while($row2 = mysql_fetch_array($opp_d)){
                    ?>   <tr><td align="center"><?=$row2[path]?></td></tr>
	<?php } ?></table>
    <?=$obj->parseText($row['event'],$_GET['year'],$q,$page)?></td>
  <?php }
  else {
      ?>
      <table class="ImageStrip" cellspacing="7"><img src="https://picasso.shsu.edu/images/yopp-emblem-innershadow.jpg"/></table>
      <?php } 
       ?>
  <?php }
   ?>
  </tr>
<?php } ?>
</table>
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
