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
<link rel="stylesheet" href="./APcss/Guide.css"/>
<script type="text/javascript" src="./APjs/main.js"></script>
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>

<body onload="window.name='OPPMain';">
<?php
require_once(APMODULES_PATH.'GuideStyle.php');
$obj = new GuideStyles($_GET);
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
			    <td><span class="big_year">Overview</span></td>
                <td width="40" align="center">&nbsp;
			    </td>
		      </tr>
	        </table>
	      </td>
        </tr>
        
		<tr>
          <td>
            <table class="TabContainer" id="MenuTabs" cellspacing="0" align="center">
              <tr class="Tabs">
	            <td class="Active"><img src="./images/magnify-art.png"/>Period</td>
				<td class="Inactive"><a href="AuthorIndex.php?view=GuideTheme&SortBy=Label&SortDirection=Asc"/><img src="./images/magnify-art.png"/>Theme</a></td>		                
				<td class="Inactive"><a href="AuthorIndex.php?view=GuideMaster"/><img src="./images/magnify-art.png"/>Artists</a></td>				
				<td class="EmptySpace">&nbsp;</td>
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
          <td><button type="button" onclick="addStyle(); return false;"><img src="./images/icon-add.png" width="16" height="16" alt="" title="Add Entry"/> Add</button></td>
        </tr>
      </table></td>
	
	<td>
   	  <h2><?=$totalNum?> Period</h2>	
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
		  <input type="text" name="view" id="view" size="1" value="GuideStyle" style=" display:none"/>
		  Sorting:&nbsp;<select size="1" name="SortBy"><option>Time</option><option>Label</option></select>&nbsp;&nbsp;&nbsp;&nbsp;
		  <input type="radio" value="Asc"  name="SortDirection" id="Order1a" checked="true"/><label for="Order1a">Ascending</label>
		  <input type="radio" value="Desc" name="SortDirection" id="Order1d"               /><label for="Order1d">Descending</label>&nbsp;&nbsp;&nbsp;&nbsp;
		  <input name="Go" type="submit" value="Go" class="subbutton"/>
	  </form>
	</td>
  </tr>
</table>
<br/>
<!---------------------------- end of heading2 ---------------------------->
<!---------------------------- Start Guide ---------------------------->
<table width="100%" class="EntriesList" align="center" cellpadding="0"  cellspacing="0">
  <tr class="Header">
	<td><small>M/D</small></td>
    <td class="label">Label</td>
	<td class="label">Startdate</td>
    <td class="label">Enddate</td>
    <td class="intro">Intro</td>
    <td class="opps">OPPS</td>
	<td class="notes">Notes</td>
  </tr>
 
<?php $i = 1; while($row = mysql_fetch_array($result)){ ?>  
  <tr <?=($i%2!=0)? "class=\"Even\"" : ""?>>
    <td class="EditBtn"><button type="button" onclick="EditStyle('<?=urlencode($row['guidename'])?>');"><img src="./images/icon-modify.png" width="16" height="16" alt="" title="Modify Entry" class="aaa"/></button>
    <br />
	<button type="button" onclick="DeleteEntry('<?=$row['guidename']?>', 'deleteStyleEngine');"><img src="./images/icon-delete.png" width="16" height="16" alt="" title="Delete Entry" class="aaa"/></button></td> 
    <td class="label"><?=$row['guidename']?></td>
	<td class="DateSE">
		<?php if($row['StartMonth']<10) echo "0".$row['StartMonth']."/"; else echo $row['StartMonth']."/"; if($row['StartDay']<10) echo "0".$row['StartDay']."/"; else echo $row['StartDay']."/"; echo $row['StartYear'];?>
	</td>
    <td class="DateSE">
		<?php if($row['EndMonth']<10) echo "0".$row['EndMonth']."/"; else echo $row['EndMonth']."/"; if($row['EndDay']<10) echo "0".$row['EndDay']."/"; else echo $row['EndDay']."/"; echo $row['EndYear'];?>
	</td>
	<td class="intro"><?=$row['introCut']?></td>
	<td class="opps">
		<?php 
		$result1 = $obj->getOPP($row['guidename']); 
		$j=0;
		foreach($result1 as $opp) //only display three opp in the display
		{
			if ($j>=6){	echo("etc."); break;}
			echo($opp."; "); 
			$j++;
		}
		?>	
	</td>
	<td class="Checks"><?php if(trim($row['notes'])!="") echo "<span class=\"true\">✔</span>"; else echo "<span class=\"false\">✘</span>"; ?></td>
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
