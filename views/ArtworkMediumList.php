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
<title>Artwork Lists - On-line Picasso Project</title>
<link rel="stylesheet" href="./css/main.css"/>
<link rel="stylesheet" href="./css/Reference.css"/>
<link rel="stylesheet" href="./css/GuideList.css"/>
<link rel="stylesheet" href="./css/Guide.css"/>
<link rel="stylesheet" href="./css/Collections.css"/>
<script type="text/javascript" src="./js/main.js"></script>
<script type="text/javascript" src="./js/popup.js"></script>
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>

<body onload="window.name='OPPMain';">
<?php
require_once(MODULES_PATH.'ArtworkMediumList.php');
$obj = new ArtworkMediumList($_GET);
$result = $obj->getData();
$totalNum = $obj->getTotalNum();
$middle = ceil($totalNum/2);
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
				</td>
			    <td><span class="big_year">Artwork Lists</span></td>
                <td width="40" align="center">
			    </td>
		      </tr>
	        </table>
	      </td>
        </tr>
        
		<tr>
          <td>
            <table class="TabContainer" id="MenuTabs" cellspacing="0" align="center">
              <tr class="Tabs">
			  	<td class="Inactive"><a href="index.php?<?=str_replace("ArtworkMediumList","ArtworkList",$_SERVER['QUERY_STRING'])?>"><img src="./images/magnify-text.png"/>Title</a></td>
				<td class="Inactive"><a href="index.php?<?=str_replace("ArtworkMediumList","ArtworkLocationList",$_SERVER['QUERY_STRING'])?>"><img src="./images/magnify-text.png"/>Location</a></td>
  	            <td class="Active"><img src="./images/magnify-text.png"/>Medium</td>			
				<td class="Inactive"><a href="index.php?<?=str_replace("ArtworkMediumList","ArtworkDimensionList",$_SERVER['QUERY_STRING'])?>"><img src="./images/magnify-text.png"/>Dimension</a></td>				
				<td class="EmptySpace">&nbsp;</td>
              </tr>
              <tr>
	            <td class="Container" colspan="5">			

<!---------------------------- Start Lists ---------------------------->
<table width="100%" align="center" cellpadding="0"  cellspacing="0">
  <tr>
    <!-- start column 1 -->
    <td width="50%" valign="top">
	  <table width="98%" class="EntriesList" align="center" cellpadding="1"  cellspacing="0">
          <?php $i=1; while(($i <= $middle) && ($row = mysql_fetch_array($result))) { ?>
	    <tr <?=($i%2!=0)? "class=\"Even\"" : ""?>>
    	  <td class="authors" align="left" valign="top" ><b><a href="index.php?<?=str_replace("ArtworkMediumList","ListArtworkSearchS",$_SERVER['QUERY_STRING'])?>&Keyword=<?=urlencode($row['medium'])?>&SearchIn=Medium" class="collection"><?=$obj->parseTitle($row['medium'])?></a></b></td>
		  <td width="10" align="left" valign="top" ><span class="number"><?=$row['n']?></span></td>
		</tr>
	  <?php $i++;  } ?>
	  </table>
	</td>
    <!-- end column 1 -->
    <!-- start column 2 -->	
    <td width="50%" valign="top">
	  <table width="98%" class="EntriesList" align="center" cellpadding="1"  cellspacing="0">
	  <?php $i=1; while(($i <= $totalNum) && ($row = mysql_fetch_array($result))) {  ?>
	    <tr <?=($i%2!=0)? "class=\"Even\"" : ""?>>
    	 <td class="authors" align="left" valign="top" ><b><a href="index.php?<?=str_replace("ArtworkMediumList","ListArtworkSearchS",$_SERVER['QUERY_STRING'])?>&Keyword=<?=urlencode($row['medium'])?>&SearchIn=Medium" class="collection"><?=$obj->parseTitle($row['medium'])?></a></b></td>
		  <td width="10" align="left" valign="top" ><span class="number"><?=$row['n']?></span></td>
		</tr>
	  <?php $i++;  } ?>
	  </table>
	</td>    
    <!-- end column 2 -->
  </tr>
</table>
<!---------------------------- End Collections ---------------------------->
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
