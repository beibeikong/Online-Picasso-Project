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
  <title>Master - On-line Picasso Project</title>
  <link rel="stylesheet" href="./css/main.css"/>

  <link rel="stylesheet" href="./css/ArtworkSummary.css"/>
<script type="text/javascript" src=" ./js/popup.js"></script>

  <script type="text/javascript" src="./js/main.js"></script>
  <link rel="icon" href="./images/opp.ico" type="image/x-icon">
  <link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
 </head>

 <body onload="window.name='OPPMain';">
  <?php
   require_once(MODULES_PATH.'MasterArtwork.php');
   $obj = new MasterArtwork($_GET);
   $result = $obj->getData();
   $totalNum = $obj->getTotalNum();
   $page = (isset($_GET['page']))? $_GET['page'] : 1;  // current page number
$totalPages = $obj->getTotalPage(); // how many pages totally
$href_temp = 'index.php?'.$_SERVER['QUERY_STRING'];
if(isset($_GET['page'])) $href_temp = str_replace("&page=".$_GET['page'], "", $href_temp);
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
          <td><h1><center>Artist Artwork</center></h1><h2><?php if(isset($_GET['author'])) echo $_GET['author']; ?></h2><br/></td>
          <td width="40" align="center">&nbsp;</td>
         </tr>
        </table>
	</td>
      </tr>   
      <tr>
       <td>
        <table class="TabContainer" id="MenuTabs" cellspacing="0" align="center">
         <tr class="Tabs">
	   <td class="Active"><img src="./images/magnify-art.png"/>Artist Artworks</td>
	   <td class="Inactive"><a href="index.php?view=GuideMaster"/><img src="./images/magnify-art.png"/>Artists</a></td>		                
	   <td class="InactiveEmpty">&nbsp;</td>		
	   <td class="InactiveEmpty">&nbsp;</td>				
	   <td class="EmptySpace">&nbsp;</td>
         </tr>
         <tr>
	   <td class="Container" colspan="5">			
<!---------------------------- starting heading2 ---------------------------->
   <table width="100%" cellspacing="0">
  <tr>
	<td>
	  <h2><?=$totalNum?> Catalogued Items</h2>
	  <?php if($totalNum==0) {echo "The master "; echo $_GET['author']; echo " has no artwork!";} ?>
	  <h3>Viewing items <?php echo(($page-1)*ITEMS_PER_PAGE+1)?> through <?php echo(min($page*ITEMS_PER_PAGE, $totalNum))?></h3>
	</td>
  </tr>
</table>
<table width="100%" cellspacing="0" class="SearchForm">
  <tr>
	<td>
	  <form method="get" action="index.php" target="OPPMain">
		  <input type="text" name="view" id="view" size="1" value="MasterArtwork" style=" display:none"/>
		  <input type="text" name="author" id="author" size="1" value="<?=$_GET['author']?>" style=" display:none"/>
		  Sorting:&nbsp;<select size="1" name="SortBy"><option>Chronology</option><option>Title</option><option>OPP</option><option>Duration</option><option>Medium</option><option>Dimension</option><option>Collection</option></select>&nbsp;&nbsp;&nbsp;&nbsp;
		  <input type="radio" value="Asc"  name="SortDirection" id="Order1a" checked="true"/><label for="Order1a">Ascending</label>
		  <input type="radio" value="Desc" name="SortDirection" id="Order1d"               /><label for="Order1d">Descending</label>&nbsp;&nbsp;&nbsp;&nbsp;
		  <input name="Go" type="submit" value="Go" class="subbutton"/>		  
	  </form>
	</td>
  </tr>
</table>
<br/>
<!---------------------------- end of heading2 ---------------------------->
<!---------------------------- Start Artwork Summary ---------------------------->
           <table width="100%" class="EntriesList" align="center" cellpadding="0"  cellspacing="0" border="0">
            <?php $i = 1; while($row = mysql_fetch_array($result)){ ?>  
            <tr <?=($i%2!=0)? "class=\"Even\"" : ""?>>

<td width="85" align="left" valign="middle">
      <a href="index.php?view=MasterArtworkInfoNew&MasterID=<?=$row['masteropp']?>"  class="SmallControl" target="_blank" title="View Artwork Details" onclick="OpenWin(this.href, 'MasterArtworkInfoNew', 740, 550); return false;"><img src="./images/tinyicon-text.png" alt=""/>&nbsp;Details</a><br><br>
     <?php
	if (isset($_SESSION['UserType'])) {
	if ($_SESSION['UserType'] == 'admin')
	{?>
	 <a href="index.php?view=Masterzoom&alpha=<?=$obj->imgName($row['masteropp'])?>" target="_blank" onclick="OpenWin(this.href, 'MasterZoom', 850, 600); return false;"  class="SmallControl"  title="Zoom Artwork Image"><img src="./images/tinyicon-magnify.png" alt=""/>&nbsp;Zoom</a><br><br>
           <?php } }?>
	 <a href="index.php?view=MasterCompare&MasterID=<?=$row['masteropp']?>" target="_blank" onclick="OpenWin(this.href, 'MasterCompare', 850, 800); return false;"  class="SmallControl"  title="Zoom Artwork Image"><img src="./images/tinyicon-magnify.png" alt=""/>&nbsp;Compare</a>

       
          <?php if(trim($row['commentary'])!="") { ?> <br><br>
		  <a href="index.php?view=MasterCommentary&MasterID=<?=$row['masteropp']?>" target="_blank" onclick="OpenWin(this.href, 'ArtworkCommentary', 740, 550); return false;"  class="SmallControl" title="View Artwork Commentary"><img src="./images/tinyicon-text.png" alt=""/>&nbsp;Commentary</a>
          <?php } ?>


      </td>
             
<td  width="140" class="imageTD" ><table class="ThumbGallery" border="0"><tr><td class="Pic"><a href="index.php?view=MasterArtworkInfoNew&MasterID=<?=$row['masteropp']?>" target="_blank" onclick="OpenWin(this.href, 'MasterArtworkInfoNew', 740, 550); return false;"><img src="../mastergraphics/<?=substr($row['masteropp'],0,7)?>/xthumbs/x<?=$obj->imgName($row['masteropp'])?>.jpg" class="imageStyle"/></a> </td></tr></table></td>
             <td align="left" class="Details" >
	      <span><strong><font color="#800000"><?=$row['title']?>.</font></strong></span><br><?=$row['duration']?>.&nbsp;
	            <span class="MediumDim"><?=$row['medium']?>.&nbsp;<?=$row['dimension']?>.&nbsp;</span><?=$row['collection']?>.

</td>
            </tr>
            <?php $i++; } ?>
           </table>
<!---------------------------- End Artwork Summary ---------------------------->
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
