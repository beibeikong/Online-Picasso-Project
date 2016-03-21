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
require_once(APMODULES_PATH.'GuideMaster.php');
$obj = new GuideMasters($_GET);
$result = $obj->getData();
$totalNum = $obj->getTotalMasterNum();
$page = (isset($_GET['page']))? $_GET['page'] : 1;  // current page number
$totalPages = $obj->getTotalPage(); // how many pages totally
if($totalNum==0) $start = 0; else $start = ($page-1)*100+1;
$end = min($page*100, $totalNum);
if($totalNum==0) $numThispage=0; else $numThispage = $end - $start + 1; // the number of Masters to be displayed this page

if($numThispage==100)
{
  $colum1=50; $colum2=50;
}
else
{
  $colum1=0; $colum2=0;
  $temp = floor($numThispage/2);
  $colum1=$temp; $colum2=$temp;
  $remainder = $numThispage%2;
  if($remainder==1){$colum1++;} 
}
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
	            <td class="Inactive"><a href="AuthorIndex.php?view=GuideStyle&SortBy=Time&SortDirection=Asc"/><img src="./images/magnify-art.png"/>Period</td>
				<td class="Inactive"><a href="AuthorIndex.php?view=GuideTheme&SortBy=Label&SortDirection=Asc"/><img src="./images/magnify-art.png"/>Theme</a></td>                
				<td class="Active"><img src="./images/magnify-art.png"/>Artists</a></td>	
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
          <td><button type="button" onclick="addMasterArtwork(); return false;"><img src="./images/icon-add.png" width="16" height="16" alt="" title="Add Entry"/> Add</button></td>
        </tr>
      </table></td>
	
	<td>
	   	  <h2><?=$totalNum?> Artists</h2>
		  <h3>Viewing items  <?=$start?> through <?=$end?></h3>
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
	</td>
  </tr>
</table>
<br/>
<!---------------------------- end of heading2 ---------------------------->
<!---------------------------- Start Guide ---------------------------->
<table width="100%" align="center" cellpadding="0"  cellspacing="0">
  <tr>
    <!-- start column 1 -->
    <td width="50%" valign="top">
	  <table width="98%" class="EntriesList" align="center" cellpadding="0"  cellspacing="0">
  		<tr class="Header">
    		<td class="authors">Artist Name</td>
    		<td class="authors">Item Amount</td>
  		</tr>
  
		<?php $i = 1; while(($i<=$colum1) && ($row = mysql_fetch_array($result))){ ?>  
  		<tr <?=($i%2!=0)? "class=\"Even\"" : ""?>> 
			<td class="authors"><a href="AuthorIndex.php?view=MasterArtwork&author=<?=urlencode($row['author'])?>" target="_self" class="authorsLink"><?=$row['author']?></td>
			<td align="center"><?=$row['COUNT(*)']?></td>
  		</tr>
		<?php $i++; } ?>
	   </table>
   	</td>
    <!-- start column 2 -->
    <td width="50%" valign="top">
	  <table width="98%" class="EntriesList" align="center" cellpadding="0"  cellspacing="0">
  		<tr class="Header">
    		<td class="authors">Artist Name</td>
    		<td class="authors" >Item Amount</td>
  		</tr>
  
		<?php $i = 1; while(($i<=$colum2) && ($row = mysql_fetch_array($result))){ ?>  
  		<tr <?=($i%2!=0)? "class=\"Even\"" : ""?>>
			<td class="authors"><a href="AuthorIndex.php?view=MasterArtwork&author=<?=urlencode($row['author'])?>" target="_self" class="authorsLink"><?=$row['author']?></td>
			<td align="center"><?=$row['COUNT(*)']?></td>
  		</tr>
		<?php $i++; } ?>
	   </table>
   	</td>
  </tr>
</table>
<br/>
<!---------------------------- End Biography ---------------------------->
<!---------------------------- Start Page Navigator ---------------------------->
<?php
require_once(APMODULES_PATH.'PageNavigator.php');
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
<?php include('APfooter.php'); ?>
</center>
</body>
</html>
