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
require_once(APMODULES_PATH.'ArtworkDisplay.php');
$obj = new ArtworkDisplay($_GET);
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
			    <td width="40" align="center">
				  <?php 
				    if($_GET['year']>Picasso_START_YEAR)
                    {
                      $temp = $_GET['year']-1;  
				      $href = "AuthorIndex.php?".$_SERVER['QUERY_STRING'];
                      $href = str_replace("year=".$_GET['year'], "year=".$temp, $href);
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
                       $href = "AuthorIndex.php?".$_SERVER['QUERY_STRING'];
                       $href = str_replace("year=".$_GET['year'], "year=".$temp, $href);
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
	            <td class="Inactive"><a href="AuthorIndex.php?view=Biography&year=<?=$_GET['year']?>"><img src="./images/magnify-art.png"/>Biography</a></td>
				<td class="Active"><img src="./images/magnify-art.png"/>Artworks</td>
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
          <td><button type="button" onclick="addArtwork(); return false;"><img src="./images/icon-add.png" width="16" height="16" alt="" title="Add Entry"/> Add</button></td>
        </tr>
      </table></td>
	
	<td>
	  <h2><?=$totalNum?> Catalogued Items</h2>
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
		  <input type="text" name="view" id="view" size="1" value="ArtworkDisplay" style=" display:none"/>
		  <select size="1" name="year"  id="year">
			<option value="1881" selected >1881</option>
			<?php 
				for($i= 1882; $i<=DIED_YEAR; $i++)
				echo("<option value=\"$i\">$i</option>");
			?>
		  </select>&nbsp;&nbsp;&nbsp;&nbsp;
		  Sorting:&nbsp;<select size="1" name="SortBy"><option>OPP</option><option>Chronology</option><option>Title</option><option>Location</option><option>Duration</option><option>Medium</option><option>Dimension</option><option>Collection</option></select>&nbsp;&nbsp;&nbsp;&nbsp;
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
    <td>Catalogs</td>
    <td>Books</td>
    <td>Category</td>
    <td>Details</td>
    <td>Note</td>
    <td>Comm</td>
    <td>Start</td>
    <td>End</td>
  </tr>
<?php $i = 1; while($row = mysql_fetch_array($result)){ ?>  
  <tr <?=($i%2!=0)? "class=\"Even\"" : ""?>>
    <td class="EditBtn"><button type="button" onclick="EditEntryArtwork('<?=$row['opp']?>');"><img src="./images/icon-modify.png" width="16" height="16" alt="" title="Modify Entry" class="aaa"/></button>
	<br /><br />
	<button type="button" onclick="DeleteEntry('<?=$row['opp']?>', 'deleteArtworkEngine');"><img src="./images/icon-delete.png" width="16" height="16" alt="" title="Delete Entry" class="aaa"/></button>
	</td>
    <td class="imageTD"><table class="ThumbGallery"><tr><td class="Pic"><img src="../graphics/<?= $_GET['year']?>/xthumbs/x<?=$obj->imgName($row['opp'])?>.jpg" class="imageStyle"/></td></tr></table></td>
    <td class="Catalogs">
	   <?php { ?><strong><font color="#800000"><?=$row['opp']?></font></strong><?php }  $result1 = $obj->getCatalog($row['opp']); foreach($result1 as $cata) echo("<br>".$cata); ?>
	</td>
    <td class="BookCatalogs"><?php if($row['bookCatalog']!='') echo($obj->sortBooks($row['bookCatalog'])); else echo "&nbsp;";?></td>
    <td class="Category"><?=$row['category']?></td>
    <td class="Details">
	   <span><strong><font color="#800000"><?=$row['title']?>.</font></strong></span><br><?=$row['location']?>,&nbsp;<?=$row['duration']?>.&nbsp;
      <span class="MediumDim"><?=$row['medium']?>.&nbsp;<?=$row['dimension']?>.&nbsp;</span><?=$row['collection']?>.&nbsp;
	   <?php if($row['inventory']!='') { ?> <?=$row['inventory']?>. <?php } ?>
	</td>
    <td class="Checks"><?php if(trim($row['notes'])!="") echo "<span class=\"true\">✔</span>"; else echo "<span class=\"false\">✘</span>"; ?></td>
    <td class="Checks"><?php if(trim($row['commentary'])!="") echo "<span class=\"true\">✔</span>"; else echo "<span class=\"false\">✘</span>"; ?></td>
    <td class="DateSE"><?php if($row['StartMonth']<10) echo "0".$row['StartMonth']."/"; else echo $row['StartMonth']."/"; if($row['StartDay']<10) echo "0".$row['StartDay']; else echo $row['StartDay']; if($row['dateStartFlag']==1) echo("<span class=\"DateFlagUpper\">↑</span>");?></td>
    <td class="DateSE"><?php if($row['EndMonth']<10) echo "0".$row['EndMonth']."/"; else echo $row['EndMonth']."/"; if($row['EndDay']<10) echo "0".$row['EndDay']; else echo $row['EndDay']; if($row['dateEndFlag']==1) echo("<span class=\"DateFlagUpper\">↑</span>");?></td>
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
