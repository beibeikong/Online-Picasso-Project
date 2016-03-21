<?php if ( ! defined('PROJECTNAME')) exit(''); 
if(file_exists('./APmodules/checkUser.php'))
    require_once('./APmodules/checkUser.php');  // check if it is authenrized user
else
    die('0'); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Authoring Portal - On-line Picasso Project</title>
<link rel="stylesheet" href="./APcss/main.css"/>
<link rel="stylesheet" href="./APcss/ArtworkSummary.css"/>
<script type="text/javascript" src="./APjs/main.js"></script>
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>

<body onload="window.name='OPPMain';">
<?php
require_once(APMODULES_PATH.'MasterArtwork.php');
$obj = new MasterArtwork($_GET);
$result = $obj->getData();
$totalNum = $obj->getTotalNum();
?>
<center>
<?php include('APheader.htm'); ?>

<table width="990" border="0" cellspacing="0" cellpadding="0" class="main_body">
  <tr>
    <td align="center" style="padding:15px 15px 15px 15px">
	  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center" valign="middle">	
		    <table border="0" align="center" cellpadding="0" cellspacing="0">
		      <tr>
			    <td width="40" align="center">&nbsp;</td>
			    <td><span class="big_year">Artist Artwork</span><h2><?php if(isset($_GET['author'])) echo "<br>".$_GET['author']; ?></h2></td>
                <td width="40" align="center">&nbsp;</td>
		      </tr>
	        </table>
	      </td>
        </tr>
        
		<tr>
          <td>
            <table class="TabContainer" id="MenuTabs" cellspacing="0" align="center">
              <tr class="Tabs">
				<td class="Active"><img src="./images/magnify-art.png"/>Artist Artworks</td>
				<td class="Inactive"><a href="AuthorIndex.php?view=GuideMaster"/><img src="./images/magnify-art.png"/>Artists</a></td>		                
				<td class="InactiveEmpty">&nbsp;</td>		
				<td class="InactiveEmpty">&nbsp;</td>				
				<td class="EmptySpace">&nbsp;</td>
              </tr>
              <tr>
	            <td class="Container" colspan="5">			
<!---------------------------- starting heading2 ---------------------------->
<table width="100%" cellspacing="0">
  <tr>
    <td width="150px" align="left">
	  <table cellspacing="0" class="NavBar" align="left">
        <tr>
          <td><button type="button" onclick="addMasterArtwork(); return false;"><img src="./images/icon-add.png" width="16" height="16" alt="" title="Add Entry"/> Add</button></td>
        </tr>
      </table></td>
	
	<td>
	  <h2><?=$totalNum?> Catalogued Items</h2>
	  <?php if($totalNum==0) {echo "The master "; echo $_GET['author']; echo " has no artwork!";} ?>
	</td>
	
	<td width="150px" align="right" >
	  <table cellspacing="0" class="NavBar" align="right">
        <tr>
          <td><button type="button" onclick="RefreshPage();"><img src="./images/icon-reload.png" width="16" height="16" alt="" title="Reload List"/> Reload</button></td>
        </tr>
      </table></td>
  </tr>
</table>
<table width="100%" cellspacing="0" class="SearchForm">
  <tr>
	<td>
	  <form method="get" action="AuthorIndex.php" target="OPPMain">
		  <input type="text" name="view" id="view" size="1" value="MasterArtwork" style=" display:none"/>
		  <input type="text" name="author" id="author" size="1" value="<?=$_GET['author']?>" style=" display:none"/>
		  Sorting:&nbsp;<select size="1" name="SortBy"><option>OPP</option><option>Chronology</option><option>Title</option><option>Duration</option><option>Medium</option><option>Dimension</option><option>Collection</option></select>&nbsp;&nbsp;&nbsp;&nbsp;
		  <input type="radio" value="Asc"  name="SortDirection" id="Order1a" checked="true"/><label for="Order1a">Ascending</label>
		  <input type="radio" value="Desc" name="SortDirection" id="Order1d"               /><label for="Order1d">Descending</label>&nbsp;&nbsp;&nbsp;&nbsp;
		  <input name="Go" type="submit" value="Go" class="subbutton"/>		  
	  </form>
	</td>
  </tr>
</table>
<br/>
<!---------------------------- end of heading2 ---------------------------->
<!---------------------------- Start Artwork Summary ---------------------------->
<table width="100%" class="EntriesList" align="center" cellpadding="0"  cellspacing="0">
  <tr class="Header">
    <td><small>M/D</small></td>
    <td>Picture</td>
    <td>OPP<sub>M</sub></td>
    <td>Author</td>
    <td>Details</td>
    <td>OPPs</td>
    <td>Comm</td>
    <td>Start</td>
    <td>End</td>
  </tr>
<?php $i = 1; while($row = mysql_fetch_array($result)){ ?>  
  <tr <?=($i%2!=0)? "class=\"Even\"" : ""?>>
    <td class="EditBtn"><button type="button" onclick="EditEntryMasterArtwork('<?=$row['masteropp']?>');"><img src="./images/icon-modify.png" width="16" height="16" alt="" title="Modify Entry" class="aaa"/></button>
	<br /><br />
	<button type="button" onclick="DeleteEntry('<?=$row['masteropp']?>', 'deleteMasterArtworkEngine');"><img src="./images/icon-delete.png" width="16" height="16" alt="" title="Delete Entry" class="aaa"/></button>
	</td>
    <td class="imageTD"><table class="ThumbGallery"><tr><td class="Pic"><img src="../mastergraphics/<?=substr($row['masteropp'],0,7)?>/xthumbs/x<?=$obj->imgName($row['masteropp'])?>.jpg" class="imageStyle"/></td></tr></table></td>
	<td class="Catalogs"><?php echo $row['masteropp'];?></td>
	<td class="BookCatalogs"><?php echo $row['author'];?></td>
    <td class="Details">
	   <span><strong><font color="#800000"><?=$row['title']?>.</font></strong></span><br><?=$row['duration']?>.&nbsp;
      <span class="MediumDim"><?=$row['medium']?>.&nbsp;<?=$row['dimension']?>.&nbsp;</span><?=$row['collection']?>.
	</td>
    <td class="Checks">
		<?php $result1 = $obj->getOPP($row['masteropp']); if(count($result1)!=0) echo "<span class=\"true\">✔</span>"; else echo "<span class=\"false\">✘</span>"; ?>	
	</td>
    <td class="Checks"><?php if(trim($row['commentary'])!="") echo "<span class=\"true\">✔</span>"; else echo "<span class=\"false\">✘</span>"; ?></td>	
    <td class="DateSE"><?php echo $row['StartYear']."/";if($row['StartMonth']<10) echo "0".$row['StartMonth']."/"; else echo $row['StartMonth']."/"; if($row['StartDay']<10) echo "0".$row['StartDay']; else echo $row['StartDay']; if($row['dateStartFlag']==1) echo("<span class=\"DateFlagUpper\">↑</span>");?></td>
    <td class="DateSE"><?php echo $row['EndYear']."/";if($row['EndMonth']<10) echo "0".$row['EndMonth']."/"; else echo $row['EndMonth']."/"; if($row['EndDay']<10) echo "0".$row['EndDay']; else echo $row['EndDay']; if($row['dateEndFlag']==1) echo("<span class=\"DateFlagUpper\">↑</span>");?></td>
  </tr>
<?php $i++; } ?>
</table>

<!---------------------------- End Artwork Summary ---------------------------->
				</td>
              </tr>
            </table>
		  </td>
        </tr>
      </table>
	</td>
  </tr>
</table>
<?php include('APfooter.php'); ?>
</center>
</body>
</html>
