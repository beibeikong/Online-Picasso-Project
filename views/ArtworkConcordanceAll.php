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
<title>Artwork Catalog Concordance of <?=$_GET['year']?> - On-line Picasso Project</title>
<link rel="stylesheet" href="./css/main.css"/>
<link rel="stylesheet" href="./css/Concordance.css"/>
<script type="text/javascript" src="./js/main.js"></script>
<script type="text/javascript" src="./js/Concordance.js"></script>
<script type="text/javascript" src="./js/popup.js"></script>
<script type="text/javascript" src="./js/ArtworkDisplay.js"></script>

<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>

<body onload="window.name='OPPMain';" >
<?php
require_once(MODULES_PATH.'DatedConcordanceArtworks.php');
$_GET['startYear']=$_GET['year'];
$_GET['endYear']=$_GET['year'];
$obj = new DatedConcordanceArtworks($_GET);
$result = $obj->getData();
$painting="_";
$watercolor="_";
$gouache="_";
$collage="_";
$photograph="_";
$pastel="_";
$sculpture="_";
$engraving="_";
$ceramic="_";
$lithograph="_";
$drawing="_";
$other="_";
$chain="_";


while($row = mysql_fetch_array($result))
{
if($row['category']==='painting')
  {
    $painting=$painting."_".$row['opp'];
  }


if($row['category']==='watercolor')
  {
    $watercolor=$watercolor."_".$row['opp'];
  }


if($row['category']==='gouache')
  {
    $gouache=$gouache."_".$row['opp'];
  }


if($row['category']==='collage')
  {
    $collage=$collage."_".$row['opp'];
  }


if($row['category']==='photograph')
  {
    $photograph=$photograph."_".$row['opp'];
  }


if($row['category']==='pastel')
  {
    $pastel=$pastel."_".$row['opp'];
  }


if($row['category']==='sculpture')
  {
    $sculpture=$sculpture."_".$row['opp'];
  }


if($row['category']==='engraving')
  {
    $engraving=$engraving."_".$row['opp'];
  }


if($row['category']==='ceramic')
  {
    $ceramic=$ceramic."_".$row['opp'];
  }


if($row['category']==='lithograph')
  {
    $lithograph=$lithograph."_".$row['opp'];
  }


if($row['category']==='drawing')
  {
    $drawing=$drawing."_".$row['opp'];
  }


if($row['category']==='other')
  {
    $other=$other."_".$row['opp'];
  }
}

 if(stripos($_SERVER['QUERY_STRING'], "painting"))
 {
   $chain=$chain."_".$painting;
 }

 if(stripos($_SERVER['QUERY_STRING'], "watercolor"))
  {
   $chain=$chain."_".$watercolor;
  }

 if(stripos($_SERVER['QUERY_STRING'], "gouache"))
  {
   $chain=$chain."_".$gouache;
  }

  if(stripos($_SERVER['QUERY_STRING'], "collage"))
  {
   $chain=$chain."_".$collage;
  }

  if(stripos($_SERVER['QUERY_STRING'], "photograph"))
   {
   $chain=$chain."_".$photograph;
   }

  if(stripos($_SERVER['QUERY_STRING'], "pastel"))
   {
   $chain=$chain."_".$pastel;
   }

   if(stripos($_SERVER['QUERY_STRING'], "sculpture"))
    {
   $chain=$chain."_".$sculpture;
    }


  if(stripos($_SERVER['QUERY_STRING'], "engraving"))
  {
     $chain=$chain."_".$engraving;
  }

  if(stripos($_SERVER['QUERY_STRING'], "ceramic"))
   {
     $chain=$chain."_".$ceramic;
   }

  if(stripos($_SERVER['QUERY_STRING'], "lithograph"))
   {
     $chain=$chain."_".$lithograph;
   }


   if(stripos($_SERVER['QUERY_STRING'], "drawing"))
      {
     $chain=$chain."_".$drawing;
      }

     if(stripos($_SERVER['QUERY_STRING'], "other"))
      {
         $chain=$chain."_".$other;
      }

     $ex = explode(":",$chain);
     $counter=-1;
     foreach($ex as $cn)
     {
       $counter++;
     }
require_once(MODULES_PATH.'ArtworkConcordanceAll.php');
$obj = new ArtworkConcordance($_GET);
$page = (isset($_GET['page']))? $_GET['page'] : 1;  // current page number
$crntCatalog = $obj->getCurrentCatalog(); // get current catalogs list   using reset() -
if(isset($_GET['sortby']))
  $sortby = $_GET['sortby'];
else
  $sortby = "OPP";

$result = $obj->getData();
$totalNum = $obj->getTotalNum();
$totalPages = $obj->getTotalPage(); // how many pages totally
$i =($page-1)*100+1;

$href = 'index.php?'.$_SERVER['QUERY_STRING'];
if(isset($_GET['page'])) $href = str_replace("&page=".$_GET['page'], "", $href);

if(isset($_GET['sortby'])) $href2 = str_replace("&sortby=".$_GET['sortby'], "", $href);
else $href2 = $href;
?>
<center>
<?php include('headerConcordanceAll.htm'); ?>

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
                      $href1 = str_replace("year=".$_GET['year'], "year=".$temp, $href);
					  echo("<a href=\"$href1\" title=\"Previous Year\"><img src=\"./images/arrow-left.png\" width=\"23\" height=\"20\" border=\"0\" /></a>");
				    }
				  ?>
				</td>
			    <td><span class="big_year"><?=$_GET['year']?></span><span class="age">[<?=$_GET['year']-BORN_YEAR?>]</span></td>
                <td width="40" align="center">
				  <?php
				     if($_GET['year']<DIED_YEAR)
					 {
					   $temp = $_GET['year']+1;
                       $href1 = str_replace("year=".$_GET['year'], "year=".$temp, $href);
					   echo("<a href=\"$href1\" title=\"Next Year\"><img src=\"./images/arrow-right.png\" width=\"23\" height=\"20\" border=\"0\" /></a>");
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
	            <td class="Active"><img src="./images/magnify-text.png" alt="Artwork Catalog Concordance"/>Concordance</td>
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
    <td width="150px" align="right">
	  <table cellspacing="0" style="clear:none; float:left">
	    <tr>
		  <td><a class="PageButton" href="javascript:;" onclick="SubmitWorksBasketAdd('ArtworkList','WorkBasketSummary');" title="Add the selected items to the artwork series."><img src="./images/icon-addtobasket.gif" width="16" height="16" border="0" alt=""/><br/>
            Add</a> </td>
		  <td>
	        <a class="PageButton" href="javascript:;" target="_blank" onclick="SubmitWorksCompare('ArtworkList', 'ArtworkCompare'); return false;" title="Add the selected items to the artwork series  comparison."><img src="./images/icon-compare.gif" width="16" height="16" border="0" alt="" title="Add the selected items to the artwork series  comparison."/><br/>Compare</a>
          </td>
        </tr>
      </table>
	</td>

	<td>
	  <h2><?=$counter?> Catalogued Items</h2>
	  <h3>Viewing items <?php echo(($page-1)*100+1)?> through <?php echo(min($page*100, $totalNum))?></h3>
	</td>
      <td width="150px" align="right" >
          <table cellspacing="0" style="clear:none; float:right">
                <tr>
          <td><a class="PageButton" href="javascript:;" onclick="checkAllButton(document.ArtworkList.check_list);" title="Select / Deselect"><img src="./images/icon-addtobasket.gif" width="16" height="16" border="0" alt=""/><br/><span id="deselect">Select</span></a></td>
          <td><a class="PageButton" href="javascript:;" target="_self" onclick="SubmitWorksBack('ArtworkList','ArtworkConcordance');" return false;" title="Show partial Artwork concordance."><img src="./images/icon-addtobasket.gif" width="16" height="16" border="0" alt=""/><br/>Partial</a></td>
           </tr>
            </table>

       </td>

  </tr>
</table>
<!---------------------------- end of heading2 ---------------------------->

<!---------------------------- starting Category  ---------------------------->
<table width="595" align="center" cellpadding="0" cellspacing="0" style="border-width:1px; border-color: silver; border-style: solid;">
  <tr height="20" align="left" valign="middle">
    <td width="27" >&nbsp;</td>
    <td width="95" ><input type="checkbox" <?=(stripos($_SERVER['QUERY_STRING'], "painting"))? "checked":"" ?> onclick="refresh(window.location.href, 'painting'); return false;"/>painting</td>
    <td width="95" ><input type="checkbox" <?=(stripos($_SERVER['QUERY_STRING'], "drawing"))? "checked":"" ?> onclick="refresh(window.location.href, 'drawing'); return false;"/>drawing</td>
    <td width="95" ><input type="checkbox" <?=(stripos($_SERVER['QUERY_STRING'], "gouache"))? "checked":"" ?> onclick="refresh(window.location.href, 'gouache'); return false;"/>gouache</td>
    <td width="95" ><input type="checkbox" <?=(stripos($_SERVER['QUERY_STRING'], "pastel"))? "checked":"" ?> onclick="refresh(window.location.href, 'pastel'); return false;"/>pastel</td>
    <td width="95" ><input type="checkbox" <?=(stripos($_SERVER['QUERY_STRING'], "watercolor"))? "checked":"" ?> onclick="refresh(window.location.href, 'watercolor'); return false;"/>watercolor</td>
    <td width="95" ><input type="checkbox" <?=(stripos($_SERVER['QUERY_STRING'], "sculpture"))? "checked":"" ?> onclick="refresh(window.location.href, 'sculpture'); return false;"/>sculpture</td>
  </tr>
  <tr height="20" align="left" valign="middle">
    <td width="27" >&nbsp;</td>
    <td width="95" ><input type="checkbox" <?=(stripos($_SERVER['QUERY_STRING'], "collage"))? "checked":"" ?> onclick="refresh(window.location.href, 'collage'); return false;"/>collage</td>
    <td width="95" ><input type="checkbox" <?=(stripos($_SERVER['QUERY_STRING'], "photograph"))? "checked":"" ?> onclick="refresh(window.location.href, 'photograph'); return false;"/>photograph</td>
    <td width="95" ><input type="checkbox" <?=(stripos($_SERVER['QUERY_STRING'], "engraving"))? "checked":"" ?> onclick="refresh(window.location.href, 'engraving'); return false;"/>engraving</td>
    <td width="95" ><input type="checkbox" <?=(stripos($_SERVER['QUERY_STRING'], "lithograph"))? "checked":"" ?> onclick="refresh(window.location.href, 'lithograph'); return false;"/>lithograph</td>
    <td width="95" ><input type="checkbox" <?=(stripos($_SERVER['QUERY_STRING'], "ceramic"))? "checked":"" ?> onclick="refresh(window.location.href, 'ceramic'); return false;"/>ceramic</td>
    <td width="95" ><input type="checkbox" <?=(stripos($_SERVER['QUERY_STRING'], "other"))? "checked":"" ?> onclick="refresh(window.location.href, 'other'); return false;"/>other</td>
  </tr>
</table>
<br/>
<!---------------------------- end of Category  ---------------------------->

<br/>
<!---------------------------- Start Corcondance ---------------------------->
<form action="" method="get" name="ArtworkList" id="ArtworkList">
<table width="100px" align="center" cellpadding="0" cellspacing="0" border="0" style="border-width:1px 1px 0px 1px; border-color: #eeeeee; border-style: solid;">
  <tr>
    <td>
	<table class="ArtworkConcordance" cellspacing="0" align="center">
  <tr class="Header">
    <td class="order">&nbsp;</td>  <!--column for check box-->
    <td> </td>
	 <?php
	   while($c = current($crntCatalog))
	   {
	     if(key($crntCatalog)==$sortby)
		 {
	 ?>
	<td class="SortSelected")><?=key($crntCatalog)?></td>
	<?php
	     }
		 else
		 {
	?>
	<td><a href="<?=$href2?>&sortby=<?=key($crntCatalog)?>" title="<?=$c?>"><?=key($crntCatalog)?></a></td>
	<?php
	     }
		 next($crntCatalog);
	  }
	  reset($crntCatalog);
	?>
  </tr>
  <?php while(($row = mysql_fetch_array($result))) { ?>
  <tr class="<?php if($i%2==0) { echo("Even"); } else { echo("Odd");} ?>">
      <td class="ckbox"><input type="checkbox" name="check_list" class="smallcheck" value="<?=$row[key($crntCatalog)]?>" /></td>
      <td class="RowNumber"><?php echo $i; $i++; ?>.</td>
	  <?php
	    while($c = current($crntCatalog))
		{
		  if(key($crntCatalog)=="OPP")
		  {
		    if($sortby=="OPP")
		     {
		       if(stripos($chain,$row[key($crntCatalog)]))
		         {
			  echo("<td><a href=\"index.php?view=ArtworkInfo&OPPID=".$row[key($crntCatalog)]."\" target=\"_blank\" class=\"opplink\" onclick=\"OpenWin(this.href, 'ArtworkInfo', 740, 550); return false;\">".$row[key($crntCatalog)]."</a>&nbsp;&nbsp;".$obj->getSameCataOPP($row[key($crntCatalog)]));
			     }
			     else
			        echo("<td><a>".$row[key($crntCatalog)]."</a>&nbsp;&nbsp;".$obj->getSameCataOPP($row[key($crntCatalog)]));
			 }
		    else
		      if(stripos($chain,$row[key($crntCatalog)]))
		       {
			  echo("<td><a href=\"index.php?view=ArtworkInfo&OPPID=".$row[key($crntCatalog)]."\" target=\"_blank\" class=\"footer_link\" onclick=\"OpenWin(this.href, 'ArtworkInfo', 740, 550); return false;\">".$row[key($crntCatalog)]."</a>&nbsp;&nbsp;</td>");
			   }
			   else
			     echo("<td><a>".$row[key($crntCatalog)]."</a>&nbsp;&nbsp;</td>");

		  }
		  elseif(key($crntCatalog)==$sortby)
		    echo("<td class=\"redSortby\">".$row[key($crntCatalog)]."&nbsp;"."</td>");
		  else
		    echo("<td>".$row[key($crntCatalog)]."&nbsp;"."</td>");
		  next($crntCatalog);
		}
		reset($crntCatalog);
	  ?>
  </tr>
  <?php } ?>
  </table></td>
  </tr>
</table>
 </form>
<!---------------------------- End Corcondance ---------------------------->
<!---------------------------- Start legend ---------------------------->
<table width="595" align="center" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top:15px;">
  <tr>
    <td>
	  <table border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="50%" valign="bottom">
		    <table width="100%" height="15" cellpadding="0" cellspacing="0" style="border-width:1px 0px 0px 1px; border-color: silver; border-style: solid;">
              <tr><td>&nbsp;</td></tr>
            </table>
          </td>
          <td width="60" height="30" align="center" valign="middle"><h3>Legend</h3></td>
          <td width="50%" valign="bottom">
		    <table width="100%" height="15" cellpadding="0" cellspacing="0" style="border-width:1px 1px 0px 0px; border-color: silver; border-style: solid;">
              <tr><td>&nbsp;</td></tr>
            </table>
		  </td>
        </tr>
      </table>
    </td>
  </tr>

  <tr>
    <td>
	  <table  cellspacing="0" cellpadding="0" style="border-width:0px 1px 1px 1px; border-color: silver; border-style: solid; ">
      <?php
	    $name = $obj->getName();
		while($n = current($name)) { ?>
		<tr>
          <td class="cataname"><b><?=key($name)?></b>&nbsp;=&nbsp;<?php echo $n; next($name); ?></td>
		  <td class="cataname">
		  <?php if($n = current($name))
		        { echo("<b>"); echo(key($name)); echo("</b>&nbsp;=&nbsp;");echo $n; next($name); }
				else  { echo("&nbsp;"); next($name); }
		  ?>
		  </td>
		  <td class="cataname">
		  <?php if($n = current($name))
		        { echo("<b>"); echo(key($name)); echo("</b>&nbsp;=&nbsp;");echo $n; next($name); }
				else  { echo("&nbsp;"); next($name); }
		  ?>
		  </td>
		  <td class="cataname">
		  <?php if($n = current($name))
		         { echo("<b>"); echo(key($name)); echo("</b>&nbsp;=&nbsp;");echo $n; next($name); }
				else  { echo("&nbsp;"); next($name); }
		  ?>
		  </td>
		  <td class="cataname">
		  <?php if($n = current($name))
		         { echo("<b>"); echo(key($name)); echo("</b>&nbsp;=&nbsp;");echo $n; next($name); }
				else  { echo("&nbsp;"); next($name); }
		  ?>
		  </td>
        </tr>
		<?php } ?>
      </table>
    </td>
  </tr>
</table>
<!---------------------------- End legend ---------------------------->

<!---------------------------- Start Page Navigator ---------------------------->
<br/>
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
<?php include('footerConcordanceAll.php'); ?>
</center>
</body>
</html>