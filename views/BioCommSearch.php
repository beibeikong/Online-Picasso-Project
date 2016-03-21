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

<body onload="window.name='OPPMain'; <?php if(isset($_GET['Commentary'])) echo("highlightSearchTerms('$_GET[Commentary]','BioHighlightTarget');");?>">
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
			    <td><span class="big_year">Commentary Search Results</span></td>
                <td width="40" align="center"></td>
		      </tr>
	        </table>
	      </td>
        </tr>
        
		<tr>
          <td>
            <table class="TabContainer" id="MenuTabs" cellspacing="0" align="center">
              <tr class="Tabs">
  	            <td class="Inactive"><a href="index.php?<?=str_replace("BioCommSearch","BioSearch",$_SERVER['QUERY_STRING'])?>"><img src="./images/magnify-text.png"/>Biography</a></td>
				<td class="Active"><img src="./images/magnify-text.png"/>Commentary</td>
				<td class="EmptySpace">&nbsp;</td>				
				<td class="EmptySpace">&nbsp;</td>
				<td class="EmptySpace">&nbsp;</td>
              </tr>
              <tr>
	            <td class="Container" colspan="5">			
<!---------------------------- starting heading2 ---------------------------->
<table width="100%" cellspacing="0" >
  <tr>
    <td width="150px" align="right">
	  <table cellspacing="0" style="clear:none; float:left">
	    <tr>
		  <td>&nbsp; </td>
		  <td>&nbsp; </td>
        </tr>
      </table>
    </td>
	
	<td>&nbsp;</td>
	
	<td width="150px" align="right" >
	  <table cellspacing="0" style="clear:none; float:right">
	    <tr>
          <td>
            <a class="PageButton" href="index.php?<?=str_replace("BioCommSearch", "printBioCommSearch", $_SERVER['QUERY_STRING'])?>" target="_blank" onclick="if(!PrintWarning()) return false;" ><img src="./images/icon-print.gif" width="16" height="16" border="0"/><br/>Print</a>
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
<?php  require_once(MODULES_PATH.'BioCommentary.php'); 
    while($row = mysql_fetch_array($result)){ 
      if(trim($row['commentary'])!="")
	  {
		echo ("<tr><td colspan=\"2\" align=\"center\"><h2>$row[dateDesc], $row[StartYear]</h2></td></tr>");
		
		$obj = new BioCommentary($row['id']);
        $result1 = $obj->getData();
        $row1 = mysql_fetch_array($result1);
		$temp=(string)$row['commentary'];
        $temp= str_replace("&", "&amp;", $temp);

$xmlstring = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<oppNote>
$temp
</oppNote>
XML;

        $xml = simplexml_load_string($xmlstring);
		foreach($xml->DataTable as $DataTable)
        {
          foreach($DataTable->entry as $entry) 
	      {
?>
<tr>
    <td class="commentaryTitle"><?=$entry['title']?>:</td>
    <td class="Info"><?=$obj->parseText($entry->asXML())?></td>
  </tr>
<?php }  } }}?>
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
