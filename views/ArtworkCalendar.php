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
<title>Artwork Calendar of <?=$_GET['year']?> - On-line Picasso Project</title>
<link rel="stylesheet" href="./css/main.css"/>
<link rel="stylesheet" href="./css/ArtworkCalendar.css"/>
<script type="text/javascript" src="./js/main.js"></script>
<script type="text/javascript" src="./js/popup.js"></script>
<script type="text/javascript" src="./js/ArtworkDisplay.js"></script>
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>

<body onload="window.name='OPPMain';">

<center>
<?php include('header.htm'); ?>
<?php
require_once(MODULES_PATH.'ArtworkCalendar.php');
$cal = new Calendar($_GET['year']);

?>
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
				    if($_GET['year']>Picasso_START_YEAR)
					{ 
                      $temp = $_GET['year']-1;  
				      $href = 'index.php?'.$_SERVER['QUERY_STRING'];
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
                       $href = "index.php?".$_SERVER['QUERY_STRING'];
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
	            <td class="Active"><img src="./images/magnify-art.png"/>Artwork Calendar</td>
	            <td class="InactiveEmpty">&nbsp;</td>		
				<td class="InactiveEmpty">&nbsp;</td>		                
				<td class="InactiveEmpty">&nbsp;</td>				
				<td class="EmptySpace">&nbsp;</td>
              </tr>
              <tr>
	            <td class="Container" colspan="5">			

<!---------------------------- starting season  ---------------------------->
<table border="0" align="center">
  <tr>
    <td class="seasonHeader"><?=$cal->getSeason(1)?></td>
	<td>&nbsp;&nbsp;</td>
    <td class="seasonHeader"><?=$cal->getSeason(2)?></td>
	<td>&nbsp;&nbsp;</td>
    <td class="seasonHeader"><?=$cal->getSeason(3)?></td>
	<td>&nbsp;&nbsp;</td>
    <td class="seasonHeader"><?=$cal->getSeason(4)?></td>
	<td>&nbsp;&nbsp;</td>
    <td class="seasonHeader"><?=$cal->getSeason(5)?></td>
  </tr>
</table>
<br />
<!---------------------------- end season  ---------------------------->
<!---------------------------- Start Calendar ---------------------------->
<table border="0" align="center" cellpadding="0" cellspacing="0">
  <tr align="center" valign="top">
    <td><?=$cal->getMonthHTML(1)?></td>
    <td><?=$cal->getMonthHTML(2)?></td>
    <td><?=$cal->getMonthHTML(3)?></td>
  </tr>
  <tr align="center" valign="top">
    <td><?=$cal->getMonthHTML(4)?></td>
    <td><?=$cal->getMonthHTML(5)?></td>
    <td><?=$cal->getMonthHTML(6)?></td>
  </tr>
  <tr align="center" valign="top">
    <td><?=$cal->getMonthHTML(7)?></td>
    <td><?=$cal->getMonthHTML(8)?></td>
    <td><?=$cal->getMonthHTML(9)?></td>
  </tr>
  <tr align="center" valign="top">
    <td><?=$cal->getMonthHTML(10)?></td>
    <td><?=$cal->getMonthHTML(11)?></td>
    <td><?=$cal->getMonthHTML(12)?></td>
  </tr>
</table>

<!---------------------------- End Calendar ---------------------------->
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
