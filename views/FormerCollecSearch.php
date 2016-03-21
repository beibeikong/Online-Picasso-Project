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
<title>Museums &amp; Collections - On-line Picasso Project</title>
<link rel="stylesheet" href="./css/main.css"/>
<link rel="stylesheet" href="./css/Reference.css"/>
<link rel="stylesheet" href="./css/GuideList.css"/>
<link rel="stylesheet" href="./css/Guide.css"/>
<link rel="stylesheet" href="./css/Collections.css"/>
<script type="text/javascript" src="./js/main.js"></script>
<script type="text/javascript" src="./js/popup.js"></script>
<script type="text/javascript" src="./js/FormerCollection.js"></script>
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>

<body onload="window.name='OPPMain';">
<?php
require_once(MODULES_PATH.'FormerCollecSearch.php');
$obj = new FormerCollecSearch($_GET);
$result = $obj->getData();
$totalNum = $obj->getTotalNum();
$middle = ceil($totalNum/2);
$position = strpos($_SERVER['QUERY_STRING'],'&Location');
$listlink= "FormerCollecArtworkSearchP&page=1".substr($_SERVER['QUERY_STRING'],$position);
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
			    <td><span class="big_year">Former Collections Search Results</span></td>
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
  	            <td class="Active"><img src="./images/magnify-text.png"/>Collections</td>
				<td class="InactiveEmpty">&nbsp;</td>				
				<td class="InactiveEmpty">&nbsp;</td>				
				<td class="InactiveEmpty">&nbsp;</td>				
				<td class="EmptySpace">&nbsp;</td>
              </tr>
              <tr>
	            <td class="Container" colspan="5">			
<!---------------------------- starting heading2 ---------------------------->
<table width="100%" cellspacing="0">
  <tr>
    
	<td colspan="3">
	<table width="450px"class="YearIndex" align="center">
                    <tr>
        <td><a href="index.php?view=FormerCollections&letter=A" target="OPPMain">A</a></td>
        <td><a href="index.php?view=FormerCollections&letter=B" target="OPPMain">B</a></td>
        <td><a href="index.php?view=FormerCollections&letter=C" target="OPPMain">C</a></td>
        <td><a href="index.php?view=FormerCollections&letter=D" target="OPPMain">D</a></td>
        <td><a href="index.php?view=FormerCollections&letter=E" target="OPPMain">E</a></td>
        <td><a href="index.php?view=FormerCollections&letter=F" target="OPPMain">F</a></td>
        <td><a href="index.php?view=FormerCollections&letter=G" target="OPPMain">G</a></td>
        <td><a href="index.php?view=FormerCollections&letter=H" target="OPPMain">H</a></td>
        <td><a href="index.php?view=FormerCollections&letter=I" target="OPPMain">I</a></td>
        <td><a href="index.php?view=FormerCollections&letter=J" target="OPPMain">J</a></td>
		<td><a href="index.php?view=FormerCollections&letter=K" target="OPPMain">K</a></td>
		<td><a href="index.php?view=FormerCollections&letter=L" target="OPPMain">L</a></td>
		<td><a href="index.php?view=FormerCollections&letter=M" target="OPPMain">M</a></td>
		<td><a href="index.php?view=FormerCollections&letter=N" target="OPPMain">N</a></td>
		<td><a href="index.php?view=FormerCollections&letter=O" target="OPPMain">O</a></td>
		<td><a href="index.php?view=FormerCollections&letter=P" target="OPPMain">P</a></td>
		<td><a href="index.php?view=FormerCollections&letter=Q" target="OPPMain">Q</a></td>
		<td><a href="index.php?view=FormerCollections&letter=R" target="OPPMain">R</a></td>
		<td><a href="index.php?view=FormerCollections&letter=S" target="OPPMain">S</a></td>
		<td><a href="index.php?view=FormerCollections&letter=T" target="OPPMain">T</a></td>
		<td><a href="index.php?view=FormerCollections&letter=U" target="OPPMain">U</a></td>
		<td><a href="index.php?view=FormerCollections&letter=V" target="OPPMain">V</a></td>
		<td><a href="index.php?view=FormerCollections&letter=W" target="OPPMain">W</a></td>
		<td><a href="index.php?view=FormerCollections&letter=X" target="OPPMain">X</a></td>
		<td><a href="index.php?view=FormerCollections&letter=Y" target="OPPMain">Y</a></td>
		<td><a href="index.php?view=FormerCollections&letter=Z" target="OPPMain">Z</a></td>
                    </tr>
                  </table>
	  </td>
  </tr>
    <tr>
    <td width="150px" align="right">
	  <table cellspacing="0" style="clear:none; float:left">
	    <tr>
          <td>
	       <a class="PageButton" href="javascript:;" onclick="checkAllButton(document.FormerList.check_list);" title="Select / Deselect"><img src="./images/icon-addtobasket.gif" width="16" height="16" border="0" alt=""/><br/><span id="deselect">Select</span></a>
          </td>
		  <td>
	        <a class="PageButton" href="javascript:;" onclick="SubmitWorksBasketAdd('FormerList','FormerWorkBasketP');" title="Add the selected items to the artwork series."><img src="./images/icon-addtobasket.gif" width="16" height="16" border="0" alt=""/><br/>Add</a>
          </td>
		  <td>	        
          </td>
        </tr>
      </table>
    </td>
	<td>
	  <h2><?=$totalNum?> Former Collections</h2>
	  <h3>Viewing Collections 1 through <?=$totalNum?></h3>
	  </td>
	<td width="150px" align="right" >&nbsp;</td>
         <td>
             <a class="PageButton" href="javascript:;" onclick="SubmitWorksBasket('FormerList','FormerWorkBasketP');" title="Go to the empty workbasket."><img src="./images/icon-addtobasket.gif" width="16" height="16" border="0" alt=""/><br/>Basket</a>
          </td> 
  </tr>
</table>
<br/>
<!---------------------------- end of heading2 ---------------------------->
<!---------------------------- Start Collections ---------------------------->
<form action="" method="post" name="FormerList" id="FormerList">
<table width="100%" align="center" cellpadding="0"  cellspacing="0">
  <tr>
    <!-- start column 1 -->
    <td width="50%" valign="top">
	  <table width="98%" class="EntriesList" align="center" cellpadding="1"  cellspacing="0">
          <?php $i=1; while(($i <= $middle) && ($row = mysql_fetch_array($result))) { ?>
	    <tr <?=($i%2!=0)? "class=\"Even\"" : ""?>>
                <td width="10" align="left" valign="top"><input type="checkbox" name="check_list" value="<?=$obj->getOPPString($row['collector'])?>" /></td>
    	  <td class="authors" align="left" valign="top" ><b><a href="index.php?view=<?=$listlink?>&Keyword=<?=urlencode($row['collector'])?>" class="collection"><?=$row['collector']?></a></b></td>
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
                <td width="10" align="left" valign="top"><input type="checkbox"name="check_list" value="<?=$obj->getOPPString($row['collector'])?>" /></td>
    	  <td class="authors" align="left" valign="top" ><b><a href="index.php?view=<?=$listlink?>&Keyword=<?=urlencode($row['collector'])?>" class="collection"><?=$row['collector']?></a></b></td>
		  <td width="10" align="left" valign="top" ><span class="number"><?=$row['n']?></span></td>
		</tr>
	  <?php $i++;  } ?>
	  </table>
	</td>    
    <!-- end column 2 -->
  </tr>
</table></form>
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
