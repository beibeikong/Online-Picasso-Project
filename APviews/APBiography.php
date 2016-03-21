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
<link rel="stylesheet" href="./APcss/Biography.css"/>
<script type="text/javascript" src="./APjs/main.js"></script>
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>

<body onload="window.name='OPPMain';">
<?php
require_once(APMODULES_PATH.'Biography.php');
$obj = new Biography($_GET);
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
				    if($_GET['year']>1881)
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
	            <td class="Active"><img src="./images/magnify-art.png"/>Biography</td>
				<td class="Inactive"><a href="AuthorIndex.php?view=ArtworkDisplay&year=<?=$_GET['year']?>&SortBy=OPP&SortDirection=Asc"><img src="./images/magnify-art.png"/>Artworks</a></td>
				<td class="Inactive"><a href="AuthorIndex.php?view=Photograph&year=<?=$_GET['year']?>&SortBy=name"><img src="./images/magnify-art.png"/>Photograph</a></td>	                
				<td class="Inactive"><a href="AuthorIndex.php?view=BioResource"><img src="./images/magnify-art.png"/>BioResource</a></td>
				<td class="Inactive"><a href="AuthorIndex.php?view=LinkId&id=3"><img src="./images/magnify-art.png"/>LinkId</a></td>
              </tr>
              <tr>
	            <td class="Container" colspan="5">			
<!---------------------------- starting heading2 ---------------------------->
<table width="100%" cellspacing="0">
  <tr>
    <td width="150px" align="left">
	  <table cellspacing="0" class="NavBar" align="left">
        <tr>
          <td><button type="button" onclick="addBio(); return false;"><img src="./images/icon-add.png" width="16" height="16" alt="" title="Add Entry"/> Add</button></td>
          <td style="padding-left:10px "><select size="1" name="year"  id="year" class="Yearselect" onchange="changeyear(window.location.href,'year');">
			<option value="1881" selected >1881</option>
			<?php 
				for($i= 1881; $i<=DIED_YEAR; $i++)
				if($i == $_GET['year'])
				  echo("<option value=\"$i\" selected>$i</option>");
				else
				  echo("<option value=\"$i\">$i</option>");
			?>
		  </select></td>
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
<br/>
<!---------------------------- end of heading2 ---------------------------->
<!---------------------------- Start Biography ---------------------------->
<table width="100%" class="EntriesList" align="center" cellpadding="0"  cellspacing="0">
  <tr class="Header">
    <td><small>Modify</small></td>
    <td><small>Delete</small></td>
    <td>Date</td>
    <td>Start</td>
    <td>End</td>
    <td>Event</td>
    <td>Comm</td>
    <td>Art</td>
    <td>Pic</td>
    <td>Des</td>
    <td>Dis</td>
  </tr>
<?php $i = 1; while($row = mysql_fetch_array($result)){ 
	$no = $obj->getPhoto($row['id']);?>  
  <tr <?=($i%2!=0)? "class=\"Even\"" : ""?>>
    <td class="EditBtn"><button type="button" onclick="EditBiography('<?=$row['id']?>');"><img src="./images/icon-modify.png" width="16" height="16" alt="" title="Modify Entry" class="aaa"/></button></td>
    <td class="EditBtn"><button type="button" onclick="DeleteEntry('<?=$row['id']?>','deleteBioEngine');"><img src="./images/icon-delete.png" width="16" height="16" alt="" title="Delete Entry" class="aaa"/></button></td> 
    <td class="Date"><?=$row['dateDesc']?></td>
	<td class="DateSE"><?php if($row['StartMonth']<10) echo "0".$row['StartMonth']."/"; else echo $row['StartMonth']."/"; if($row['StartDay']<10) echo "0".$row['StartDay']; else echo $row['StartDay']; if($row['dateStartFlag']==1) echo("<span class=\"DateFlagUpper\">↑</span>");?></td>
    <td class="DateSE"><?php if($row['EndMonth']<10) echo "0".$row['EndMonth']."/"; else echo $row['EndMonth']."/"; if($row['EndDay']<10) echo "0".$row['EndDay']; else echo $row['EndDay']; if($row['dateEndFlag']==1) echo("<span class=\"DateFlagUpper\">↑</span>");?></td>
	<td class="Event"><?php $temp=trim($row['eventCut']); $temp=str_replace("&","&amp;",$temp);$temp=str_replace("<","&lt;",$temp);$temp=str_replace(">","&gt;",$temp); echo $temp;?></td>
	<td class="Checks"><?php if(trim($row['commentary'])!="") echo "<span class=\"true\">✔</span>"; else echo "<span class=\"false\">✘</span>"; ?></td>
	<td class="Checks"><?php if($row['DatedArtworks']>0) echo "<span class=\"true\">✔</span>"; else echo "<span class=\"false\">✘</span>"; ?></td>
	<td class="Checks"><?php if($obj->getPhoto($row['id'])>0) echo "<span class=\"true\">✔</span>"; else echo "<span class=\"false\">✘</span>"; ?></td>
	<td class="Checks"><?php if($obj->getPhoto($row['id']) >0) echo "<span class=\"true\">✔</span>"; else echo "<span class=\"false\">✘</span>"; ?></td>
        <td class="Checks"><?php if(($obj->getPhoto_D($row['id'])>0 or $obj->getOpp_D($row['id']))>0) echo "<span class=\"true\">✔</span>"; else echo "<span class=\"false\">✘</span>"; ?></td>
  </tr>
<?php $i++; } ?>
</table>

<!---------------------------- End Biography ---------------------------->
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
