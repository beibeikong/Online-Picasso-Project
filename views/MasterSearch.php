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
<link rel="stylesheet" href="./css/MasterSearch.css"/>
<link rel="stylesheet" href="./css/Guide.css"/>
<script type="text/javascript" src="./js/main.js"></script>
<script type="text/javascript" src="./js/popup.js"></script>

<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>

<body onload="window.name='OPPMain';">
 <table class="HeaderBar" cellspacing="0">
  <tr>
    <td class="Logo"><img src="./images/opp-emblem-corner.png" width="61" height="59" /></td>
    <td class="Title">Artist List <?=$row['Type']?></td>
    <td class="Toolbar">
      <table cellspacing="0" align="right">
        <tr>
		  <td><a id="BtnClose" href="javascript:ClosePopup();">Close</a></td>
		</tr>
	  </table>
	</td>
  </tr>
</table>
<?php
require_once(MODULES_PATH.'GuideMaster.php');
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
<table width="710" border="0" cellspacing="0" cellpadding="0" class="main_body">
  <tr>
    <td align="center" style="padding:15px 15px 15px 15px">
	  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center" valign="middle">	
		    <table border="0" align="center" cellpadding="0" cellspacing="0">
		      <tr>
			    <td align="center"><h1><center>Artist List</center></h1></td>
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
	            	<td class="Active"><img src="./images/magnify-text.png"/>Artists</a></td>	
				<td class="EmptySpace">&nbsp;</td>	
				<td class="EmptySpace">&nbsp;</td>					
				<td class="EmptySpace">&nbsp;</td>
				<td class="EmptySpace">&nbsp;</td>

              </tr>
              <tr>
	            <td class="Container" colspan="5">			
<!---------------------------- starting heading2 ---------------------------->
<table width="100%" cellspacing="0">
  <tr>
	<td>
	   	  <h2><?=$totalNum?> Artists</h2>
		  <h3>Viewing items  <?=$start?> through <?=$end?></h3>
	</td>
  </tr>
</table>
<br/>
<!---------------------------- end of heading2 ---------------------------->
<!---------------------------- Start Guide ---------------------------->
<table width="90%" align="center" cellpadding="0"  cellspacing="0">
  <tr>
    <!-- start column 1 -->
    <td width="50%" valign="top">
	  <table width="98%" class="EntriesList" align="center" cellpadding="0"  cellspacing="0">
  		<tr class="Header">
    		<td class="authors">Artist Name</td>
  		</tr>
  
		<?php $i = 1; while(($i<=$colum1) && ($row = mysql_fetch_array($result))){ ?>  
  		<tr <?=($i%2!=0)? "class=\"Even\"" : ""?>> 
			<td class="authors"><a href="index.php?view=MasterArtworkSearch&author=<?=urlencode($row['author'])?>" target="_self" class="authorsLink"><?=$row['author']?></td>
  		</tr>
		<?php $i++; } ?>
	   </table>
   	</td>
    <!-- start column 2 -->
    <td width="50%" valign="top">
	  <table width="98%" class="EntriesList" align="center" cellpadding="0"  cellspacing="0">
  		<tr class="Header">
    		<td class="authors">Artist Name</td>
  		</tr>
  
		<?php $i = 1; while(($i<=$colum2) && ($row = mysql_fetch_array($result))){ ?>  
  		<tr <?=($i%2!=0)? "class=\"Even\"" : ""?>>
			<td class="authors"><a href="index.php?view=MasterArtworkSearch&author=<?=urlencode($row['author'])?>" target="_self" class="authorsLink"><?=$row['author']?></td>
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
require_once(MODULES_PATH.'PageNavigator.php');
$obj = new PageNavigator($totalPages, $page, $_SERVER['QUERY_STRING']);
$obj->showPgNavigator();
?>
<!---------------------------- End Page Navigator ---------------------------->
