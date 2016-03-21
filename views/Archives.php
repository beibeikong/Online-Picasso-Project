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
<title>Archives of <?=$_GET['year']?> - On-line Picasso Project</title>
<link rel="stylesheet" href="./css/main.css"/>
<link rel="stylesheet" href="./css/archives.css"/>
<script type="text/javascript" src="./js/main.js"></script>
<script type="text/javascript" src="./js/popup.js"></script>
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>

<body onload="window.name='OPPMain';">
<?php
require_once(MODULES_PATH.'Archives.php');
$obj = new Archives($_GET);
$result = $obj->getData();
$w=0;
$cnt=0;
$c="__";
$yr="__";
$store = $_GET['page'];
$totalNum = $obj->getTotalNum();
$page=$w+1;
while($w<=$totalNum/30)
{
while($row = mysql_fetch_array($result)){$qw=$row['id'];$yp=$row['Year'];$c=$c.$qw."_";$yr=$yr.$yp."_";$cnt++;}// edit
$_GET['page']=$w+1;
$obj = new Archives($_GET);
$result = $obj->getData();
$w++;
}
$page = (isset($_GET['page']))? $_GET['page'] : 1;  // current page number
$totalPages = $obj->getTotalPage(); // how many pages totally
$obj = new Archives($_GET);
$result = $obj->getData();
$_GET['page'] = $store;
require_once(MODULES_PATH.'Archives.php');
$obj = new Archives($_GET);
$result = $obj->getData();
$totalNum = $obj->getTotalNum();
$page = (isset($_GET['page']))? $_GET['page'] : 1;  // current page number
$totalPages = $obj->getTotalPage(); // how many pages totally
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
			    <td width="40" align="center">&nbsp;</td>
			    <td><span class="big_year"><?=$_GET['year']?></span></td>
                <td width="40" align="center">&nbsp;</td>
		      </tr>
	        </table>
	      </td>
        </tr>

		<tr>
          <td>
            <table class="TabContainer" id="MenuTabs" cellspacing="0" align="center">
              <tr class="Tabs">
  	            <td class="Active"><img src="./images/magnify-text.png"/>Archives</td>
				<td class="InactiveEmpty">&nbsp;</td>
				<td class="InactiveEmpty">&nbsp;</td>
				<td class="InactiveEmpty">&nbsp;</td>
				<td class="EmptySpace">&nbsp;</td>
              </tr>
              <tr>
	            <td class="Container" colspan="5">
<!---------------------------- starting heading2 ---------------------------->
<table cellspacing="0" width="100%">
  <tbody><tr>

    <td align="right" width="141">&nbsp;</td>
     <td width="407">

	   <h2><?=$totalNum?> Articles</h2>
	   <?
	      $initial = ($page-1)*ITEMS_PER_PAGE+1;
	      $final = min($page*ITEMS_PER_PAGE, $totalNum);
	      $difference = $final - $initial +1;
	   ?>

	   <h3>Viewing Article <?php echo(($page-1)*ITEMS_PER_PAGE+1)?> through <?php echo(min($page*ITEMS_PER_PAGE, $totalNum))?></h3>
	  </td>
<?$t=0;$concat="__";$year="__";while($row = mysql_fetch_array($result)){ $a=$row['id'];$y=$row['Year'];$t++;$concat=$concat.$a."_";$year=$year.$y."_";}?>

   	  <td align="right" width="69"><a class="PageButton" href="<?=$hrefForPrint."index.php?view=ArchivePrintPY&a=".$concat."&yy=".$year."&totalNum=".$difference?>" target="_blank"  onclick="if(!PrintWarning()) return false;" title="Print this article."><img src="./images/icon-print.gif" width="16" height="16" border="0"/><br/>PrintP</a></td>
   	  <td align="right" width="56"><a class="PageButton" href="<?=$hrefForPrint."index.php?view=ArchivePrintPY&a=".$c."&yy=".$yr."&totalNum=".$cnt?>" target="_blank"  onclick="if(!PrintWarning()) return false;" title="Print this article."><img src="./images/icon-print.gif" width="16" height="16" border="0"/><br/>PrintY</a></td>
	  <td align="right" width="9">&nbsp;</td>
 </tr>
</tbody></table>
<br>
<!---------------------------- end of heading2 ---------------------------->

<!---------------------------- starting Category  ---------------------------->
<table align="center" cellpadding="3" cellspacing="0" style="border-width:1px; border-color: silver; border-style: solid;">
  <tr height="20" align="left" valign="middle">
    <td><input type="checkbox" <?=(stripos($_SERVER['QUERY_STRING'], "Language"))? "checked":"" ?> onclick="refreshArchive(window.location.href, 'Language'); return false;"/>&nbsp;Language&nbsp;&nbsp;</td>
    <td><input type="checkbox" <?=(stripos($_SERVER['QUERY_STRING'], "Title"))? "checked":"" ?> onclick="refreshArchive(window.location.href, 'Title'); return false;"/>Title&nbsp;&nbsp;</td>
    <td><input type="checkbox" <?=(stripos($_SERVER['QUERY_STRING'], "Publisher"))? "checked":"" ?> onclick="refreshArchive(window.location.href, 'Publisher'); return false;"/>Publisher&nbsp;</td>
  </tr>
</table>
<br/>
<!---------------------------- end of Category  ---------------------------->
<!---------------------------- Start Archives ---------------------------->
<table align="center" cellpadding="0" cellspacing="0" class="Archives">
<?php

$obj = new Archives($_GET);
$result = $obj->getData();
while($row = mysql_fetch_array($result)){ ?>
  <tr>
    <td width="20" align="left"><img src="./images/languagepin-<?php echo $row['Language']?>.png"/></td>
    <td width="300" align="left"><a href="index.php?<?=str_replace("Archives","ArchiveArticle",$_SERVER['QUERY_STRING'])?>&id=<?=$row['id']?>" target="_blank" class="ArticleLink" onclick="OpenWin(this.href, 'ArchiveArticle', 748, 800); return false;" ><?php echo $row['Title']?></a></td>
    <td class="Publisher" ><?php echo $row['Publisher']?></td>
    <td class="Date" >

	<?php
	  if($row['Month']>0 && $row['Month']<10)
	    echo "0".$row['Month']."/";
	  else if($row['Month']>=10)
	    echo $row['Month']."/";
	  else
	    echo "- -/";


	  if($row['Day']>0 && $row['Day']<10)
	    echo "0".$row['Day']."/";
	  else if($row['Day']>=10)
	    echo $row['Day']."/";
	  else
	    echo "- -/";

	echo substr($row['Year'],2,2);
	?>

	</td>
  </tr>
<?php } ?>
</table>
<!---------------------------- End Archives ---------------------------->
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