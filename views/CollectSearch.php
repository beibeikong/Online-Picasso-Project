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
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>

<body onload="window.name='OPPMain';">
<?php
require_once(MODULES_PATH.'CollectSearch.php');
$obj = new CollectSearch($_GET);
$result = $obj->getData();
$totalNum = $obj->getTotalNum();
$middle = ceil($totalNum/2);
$position = strpos($_SERVER['QUERY_STRING'],'&CategorySearch');
$listlink= "ListArtworkSearchS&page=1".substr($_SERVER['QUERY_STRING'],$position);
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
			    <td><span class="big_year">Collections Search Results</span></td>
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
    <td width="150px" align="right">&nbsp;</td>
	<td>
	<table class="YearIndex" align="center">
                    <tr>
        <td><a href="index.php?view=Collections&letter=A" target="OPPMain">A</a></td>
        <td><a href="index.php?view=Collections&letter=B" target="OPPMain">B</a></td>
        <td><a href="index.php?view=Collections&letter=C" target="OPPMain">C</a></td>
        <td><a href="index.php?view=Collections&letter=D" target="OPPMain">D</a></td>
        <td><a href="index.php?view=Collections&letter=E" target="OPPMain">E</a></td>
        <td><a href="index.php?view=Collections&letter=F" target="OPPMain">F</a></td>
        <td><a href="index.php?view=Collections&letter=G" target="OPPMain">G</a></td>
        <td><a href="index.php?view=Collections&letter=H" target="OPPMain">H</a></td>
        <td><a href="index.php?view=Collections&letter=I" target="OPPMain">I</a></td>
        <td><a href="index.php?view=Collections&letter=J" target="OPPMain">J</a></td>
		<td><a href="index.php?view=Collections&letter=K" target="OPPMain">K</a></td>
		<td><a href="index.php?view=Collections&letter=L" target="OPPMain">L</a></td>
		<td><a href="index.php?view=Collections&letter=M" target="OPPMain">M</a></td>
		<td><a href="index.php?view=Collections&letter=N" target="OPPMain">N</a></td>
		<td><a href="index.php?view=Collections&letter=O" target="OPPMain">O</a></td>
		<td><a href="index.php?view=Collections&letter=P" target="OPPMain">P</a></td>
		<td><a href="index.php?view=Collections&letter=Q" target="OPPMain">Q</a></td>
		<td><a href="index.php?view=Collections&letter=R" target="OPPMain">R</a></td>
		<td><a href="index.php?view=Collections&letter=S" target="OPPMain">S</a></td>
		<td><a href="index.php?view=Collections&letter=T" target="OPPMain">T</a></td>
		<td><a href="index.php?view=Collections&letter=U" target="OPPMain">U</a></td>
		<td><a href="index.php?view=Collections&letter=V" target="OPPMain">V</a></td>
		<td><a href="index.php?view=Collections&letter=W" target="OPPMain">W</a></td>
		<td><a href="index.php?view=Collections&letter=X" target="OPPMain">X</a></td>
		<td><a href="index.php?view=Collections&letter=Y" target="OPPMain">Y</a></td>
		<td><a href="index.php?view=Collections&letter=Z" target="OPPMain">Z</a></td>
                    </tr>
                  </table>

	  <h2><?=$totalNum?> Matched Collections</h2>
	  <h3>Viewing Collections 1 through <?=$totalNum?></h3>
	  </td>
	<td width="150px" align="right" >&nbsp;</td>
  </tr>
</table>
<br/>
<!---------------------------- end of heading2 ---------------------------->
<!---------------------------- Start Collections ---------------------------->
<table width="100%" align="center" cellpadding="0"  cellspacing="0">
  <tr>
    <!-- start column 1 -->
    <td width="50%" valign="top">
	  <table width="98%" class="EntriesList" align="center" cellpadding="1"  cellspacing="0">
          <?php $i=1; while(($i <= $middle) && ($row = mysql_fetch_array($result))) { ?>
	    <tr <?=($i%2!=0)? "class=\"Even\"" : ""?>>
    	   <td class="authors" align="left" valign="top" ><b><a href="index.php?view=<?=$listlink?>&Keyword=<?=urlencode($row['collection'])?>&SearchIn=Collection&page=1" class="collection"><?=$row['collection']?></a></b></td>
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
    	  <td class="authors" align="left" valign="top" ><b><a href="index.php?view=<?=$listlink?>&Keyword=<?=urlencode($row['collection'])?>&SearchIn=Collection" class="collection"><?=$row['collection']?></a></b></td>
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
