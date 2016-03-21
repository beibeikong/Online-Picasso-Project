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
<title>Artwork Search Results - On-line Picasso Project</title>
<link rel="stylesheet" href="./css/main.css"/>
<link rel="stylesheet" href="./css/ArtworkSummary.css"/>
<script type="text/javascript" src="./js/main.js"></script>
<script type="text/javascript" src="./js/popup.js"></script>
<script type="text/javascript" src="./js/ArtworkDisplay.js"></script>
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>

<body onload="window.name='OPPMain';">
<?php
require_once(MODULES_PATH.'ListArtworkSearch.php');
$obj = new ListArtworkSearch($_GET);
$result = $obj->getData();
$totalNum = $obj->getTotalNum();
$page = (isset($_GET['page']))? $_GET['page'] : 1;  // current page number
$totalPages = $obj->getTotalPage(); // how many pages totally

$href_temp = 'index.php?'.$_SERVER['QUERY_STRING'];
$href_temp = str_replace("&page=".$_GET['page'], "", $href_temp);
$hrefForSmall = str_replace("ArtworkSearchS", "ArtworkPrintSmall", $href_temp);
$hrefForLarge = str_replace("ArtworkSearchS", "ArtworkPrintLarge", $href_temp);
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
			    <td><span class="big_year">Artwork Search Results</span></td>
                <td width="40" align="center"></td>
		      </tr>
	        </table>
	      </td>
        </tr>

		<tr>
          <td>
            <table class="TabContainer" id="MenuTabs" cellspacing="0" align="center">
              <tr class="Tabs">
	            <td class="Inactive"><a href="index.php?<?=str_replace("ListArtworkSearchS","ListArtworkSearchD",$_SERVER['QUERY_STRING'])?>"><img src="./images/magnify-art.png"/>Artwork Display</a></td>
		     <td class="Active"><img src="./images/magnify-text.png"/>Artwork Summary</td>
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
		  <td>
	        <a class="PageButton" href="javascript:;" onclick="SubmitWorksBasket('ArtworkList','WorkBasketDisplay');" title="Go to the empty workbasket."><img src="./images/icon-addtobasket.gif" width="16" height="16" border="0" alt=""/><br/>
			Basket</a></td>	
          <td><a class="PageButton" href="javascript:;" onclick="SubmitWorksBasketAdd('ArtworkList','WorkBasketSummary');" title="Add the selected items to the artwork series."><img src="./images/icon-addtobasket.gif" width="16" height="16" border="0" alt=""/><br/>
            Add</a> </td>
          <td><a class="PageButton" href="javascript:;" target="_blank" onclick="SubmitWorksCompare('ArtworkList', 'ArtworkCompare'); return false;" title="Add the selected items to the artwork series  comparison."><img src="./images/icon-compare.gif" width="16" height="16" border="0" alt="" title="Add the selected items to the artwork series  comparison."/><br/>
            Compare</a> </td>
        </tr>
      </table></td>

	<td>
	  <h2><?=$totalNum?> Catalogued Items</h2>
	  <h3>Viewing items <?php echo(($page-1)*ITEMS_PER_PAGE+1)?> through <?php echo(min($page*ITEMS_PER_PAGE, $totalNum))?></h3>
	</td>	
		<td width="150px" align="right" >
		 <?php
	  if ($_SESSION['UserType'] == 'admin' ){
	  ?>
	  <table cellspacing="0" style="clear:none; float:right">
        <tr>
            <td><a class="PageButton" href="javascript:;" onclick="checkAllButton(document.ArtworkList.check_list);" title="Select / Deselect"><img src="./images/icon-addtobasket.gif" width="16" height="16" border="0" alt=""/><br/><span id="deselect">Select</span></a>
            </td>
        </tr>
      </table>	  	<?php } ?></td>
  </tr>
</table>
<br/>
<!---------------------------- end of heading2 ---------------------------->

<!---------------------------- Start Artwork Summary ---------------------------->
<form action="" method="get" name="ArtworkList" id="ArtworkList">
<table width="100%" border="0" align="center" cellpadding="0"  cellspacing="0" style="margin-bottom:20px ">
<?php $i = 1; while($row = mysql_fetch_array($result)){ 
$AcceptedTitle = $obj->getAcceptedTitle($row['title']);$formercount = $obj->formercollec($row['opp']);?>
  <tr <?=($i%2==0)? "class=\"Even\"" : ""?>>
    <td width="85" align="left" valign="middle">
        <table cellpadding="0" cellspacing="2">            
	<?php
	if (isset($_SESSION['UserType'])) {
	if ($_SESSION['UserType'] == 'admin' || $row['notVerified'] == 0){
            ?><tr><td height="17px">
                <a href="index.php?view=zoom&alpha=<?=$obj->imgName($row['opp'])?>&random=<?=$row['year']*23?>" onclick="OpenWin(this.href, 'ArtworkZoom', 850, 600); return false;" class="SmallControl" target="_blank" title="Zoom Artwork Image"><img src="./images/tinyicon-magnify.png" alt=""/>&nbsp;Zoom</a></td></tr>
      		  <?php 
	 } }?>        
	  <?php if($formercount!=0) { ?><tr><td height="17px">
                <a  href="index.php?view=ArtworkProvenance&OPPID=<?=$row['opp']?>" class="SmallControl" target="_blank" title="View Artwork Provenance"  onclick="OpenWin(this.href, 'ArtworkProvenance', 740, 550); return false;"><img src="./images/tinyicon-text.png" alt=""/>&nbsp;Provenance</a></td></tr>
            <?php } ?><tr><td height="17px">
                <a  href="index.php?view=ArtworkBibliography&OPPID=<?=$row['opp']?>" class="SmallControl" target="_blank" title="View Artwork Literature"  onclick="OpenWin(this.href, 'ArtworkBibliography', 740, 550); return false;"><img src="./images/tinyicon-text.png" alt=""/>&nbsp;Literature</a></td></tr>
	 <?php if(($row['bookCatalog']!='')&& (strpos($row['bookCatalog'],'*') !== false)) { ?> <tr><td height="17px">
                <a href="index.php?view=ArtworkBibliographyExhibited&OPPID=<?=$row['opp']?>" target="_blank" onclick="OpenWin(this.href, 'ArtworkExhibited', 740, 550); return false;"  class="SmallControl" title="View Artwork Exhibited"><img src="./images/tinyicon-text.png" alt=""/>&nbsp;Exhibited</a></td></tr>
          <?php } ?>	 
                    <?php if(trim($row['notes'])!="") { ?><tr><td height="17px">
             <a href="index.php?view=ArtworkNote&OPPID=<?=$row['opp']?>" target="_blank" onclick="OpenWin(this.href, 'ArtworkNote', 740, 550); return false;"  class="SmallControl" title="View Artwork Note"><img src="./images/tinyicon-text.png" alt=""/>&nbsp;Note</a></td></tr>
		  <?php } ?>
          <?php if(trim($row['commentary'])!="") { ?> <tr><td height="17px">
                <a href="index.php?view=ArtworkCommentary&OPPID=<?=$row['opp']?>" target="_blank" onclick="OpenWin(this.href, 'ArtworkCommentary', 740, 550); return false;"  class="SmallControl" title="View Artwork Commentary"><img src="./images/tinyicon-text.png" alt=""/>&nbsp;Commentary</a></td></tr>
          <?php } ?>
                  </table>

      </td>
    <td width="120" height="116" style="padding:4px"><table class="ThumbGallery"><tr><td class="Pic">
        <?php if ($_SESSION['UserType'] == 'admin' || $row['notVerified'] == 0){
	?>
        <a href="index.php?view=ArtworkInfo&OPPID=<?=$row['opp']?>" target="_blank" onclick="OpenWin(this.href, 'ArtworkInfo', 740, 550); return false;"><img src="http://picasso.shsu.edu/graphics/<?= $row['year']?>/xthumbs/x<?=$obj->imgName($row['opp'])?>.jpg" class="imageStyle" title="<?=$row['title']?>"/></a><?php 
		}
		else 
		{
			?> 
			<a href="index.php?view=ArtworkInfo&OPPID=<?=$row['opp']?>" target="_blank" onclick="OpenWin(this.href, 'ArtworkInfo', 740, 550); return false;"><img src="https://picasso.shsu.edu/images/xopp-emblem-innershadow.jpg"/></a>
			<?php
		}
		?></td></tr></table>
    </td>
    <td class="Info" height="116" style="padding:4px">
      <span><strong><font color="#800000"><?=$obj->parseTextTM($AcceptedTitle)?></font></strong></span>. <?=$row['location']?>. <?=$row['duration']?>. 
      <span class="MediumDim"><?=$obj->parseTextTM($row['medium'])?>. <?=$row['dimension']?>. </span><a href="index.php?view=ArtworkSearchS&page=1&Keyword1=<?=$row['collection']?>&SearchIn1=Collection&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&CategorySearchIn1=painting&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn4=sculpture&CategorySearchIn5=ceramic&CategorySearchIn6=drawing&CategorySearchIn7=watercolor&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=year&StartYear=1881&EndYear=1973&SortBy1=OPP&SortDirection1=Asc&SortBy2=OPP&SortDirection2=Asc&SortBy3=OPP&SortDirection3=Asc"><?=$row['collection']?></a>. 
	   <?php if($row['inventory']!='') { ?> <?=$row['inventory']?>. <?php } ?><br>
      <hr  align="left" width="70"/>
	<strong><font color="#800000"><?=$row['opp']?></font></strong><?php 

	  $result1 = $obj->getCatalog($row['opp']);
	  foreach($result1 as $cata){
	  	if(substr($cata,0,3) === "testing"){
	   		echo("<a href=index.php?view=RefSearch&page=1&Keyword1=MPP&SearchIn1=Catalogs&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,3) === "MPP"){
			echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=MPP&SearchIn1=Catalogs&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,3) === "MPM"){
			 echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=MPM&SearchIn1=Catalogs&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,3) === "MPB"){
			echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=MPB&SearchIn1=Catalogs&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,3) === "MPA"){
		 	 echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=MPA&SearchIn1=Catalogs&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Author&Keyword6=&SearchIn6=Author&Keyword7=&SearchIn7=Author&Keyword7=&SearchIn7=Author target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,4) === "PP.L")
              {
		echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=(PP.L)&SearchIn1=Catalogs&Keyword2=&SearchIn2=Author&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,2) === "PP"){
			echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=(PP)&SearchIn1=Catalogs&Keyword2=&SearchIn2=Author&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,2) === "GC"){
		 	 echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=GC&SearchIn1=Catalogs&Keyword2=&SearchIn2=Author&Keyword3=&SearchIn3=Author&Keyword4=&SearchIn4=Author&Keyword5=&SearchIn5=Author&Keyword6=&SearchIn6=Author&Keyword7=&SearchIn7=Author&Keyword7=&SearchIn7=Author target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,2) === "DB"){
			echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=DB&SearchIn1=Catalogs&Keyword2=&SearchIn2=Author&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}
		 elseif(substr($cata,0,2) === "DR"){
			echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=DR&SearchIn1=Catalogs&Keyword2=&SearchIn2=Author&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,2) === "CC"){
			echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=CC&SearchIn1=Catalogs&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}		
		elseif(substr($cata,0,2) === "Ba"){
			echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=Ba&SearchIn1=Catalogs&Keyword2=&SearchIn2=Author&Keyword3=&SearchIn3=Author&Keyword4=&SearchIn4=Author&Keyword5=&SearchIn5=Author&Keyword6=&SearchIn6=Author&Keyword7=&SearchIn7=Author&Keyword7=&SearchIn7=Author target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,2) === "AR"){
			echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=AR&SearchIn1=Catalogs&Keyword2=&SearchIn2=Author&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,2) === "FM"){
			echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=FM&SearchIn1=Catalogs&Keyword2=&SearchIn2=Author&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,2) === "LD"){
			echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=LD&SearchIn1=Catalogs&Keyword2=&SearchIn2=Author&Keyword3=&SearchIn3=Author&Keyword4=&SearchIn4=Author&Keyword5=&SearchIn5=Author&Keyword6=&SearchIn6=Author&Keyword7=&SearchIn7=Author&Keyword7=&SearchIn7=Author target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,2) === "WS"){
			echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=WS&SearchIn1=Catalogs&Keyword2=&SearchIn2=Author&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,1) === "Z"){
			echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=(Z)&SearchIn1=Catalogs&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,1) === "B"){
			echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=(B)&SearchIn1=Catalogs&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,1) === "M"){
			echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=(M)&SearchIn1=Catalogs&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,1) === "C"){
			echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=(C)&SearchIn1=Catalogs&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}
	   elseif(substr($cata,0,2) === "PS"){
			echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=PS&SearchIn1=Catalogs&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}
	   elseif(substr($cata,0,4) === "P.IV"){
			echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=P.IV&SearchIn1=Catalogs&Keyword2=&SearchIn2=Author&Keyword3=&SearchIn3=Author&Keyword4=&SearchIn4=Author&Keyword5=&SearchIn5=Author&Keyword6=&SearchIn6=Author&Keyword7=&SearchIn7=Author&Keyword7=&SearchIn7=Author target=\"OPPMain\">".$cata."</a>");
		}		
	   elseif(substr($cata,0,5) === "P.III"){
			echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=P.III&SearchIn1=Catalogs&Keyword2=&SearchIn2=Author&Keyword3=&SearchIn3=Author&Keyword4=&SearchIn4=Author&Keyword5=&SearchIn5=Author&Keyword6=&SearchIn6=Author&Keyword7=&SearchIn7=Author&Keyword7=&SearchIn7=Author target=\"OPPMain\">".$cata."</a>");
		}
	   elseif(substr($cata,0,4) === "P.II"){
			echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=P.II&SearchIn1=Catalogs&Keyword2=&SearchIn2=Author&Keyword3=&SearchIn3=Author&Keyword4=&SearchIn4=Author&Keyword5=&SearchIn5=Author&Keyword6=&SearchIn6=Author&Keyword7=&SearchIn7=Author&Keyword7=&SearchIn7=Author target=\"OPPMain\">".$cata."</a>");
		}
	   elseif(substr($cata,0,3) === "P.I"){
			echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=P.I&SearchIn1=Catalogs&Keyword2=&SearchIn2=Author&Keyword3=&SearchIn3=Author&Keyword4=&SearchIn4=Author&Keyword5=&SearchIn5=Author&Keyword6=&SearchIn6=Author&Keyword7=&SearchIn7=Author&Keyword7=&SearchIn7=Author target=\"OPPMain\">".$cata."</a>");
		}
		else {
			echo("; ".$cata);
		}
	  }

	  if($row['bookCatalog']!=''){
	  	echo(";");
		$a=$obj->sortBooks($row['bookCatalog']);
		$words= explode(" ", $a );
		$j=0;
		for($q=0;$q<count($words);$q++){
		  if ($j>=10){	echo(" etc."); break;}
		  $starPosition = strpos($words[$q],'*');
		  $colonPosition = strpos($words[$q],':');
		  if ($starPosition == false){
			if ($colonPosition == false){
			  $finalPosition = 5;
			  //$v = substr($words[$q], 0, 5);
                        }
			else {
			  $finalPosition = $colonPosition;
			  //$v = substr($words[$q], 0, $pos);
                        }
                  $v = substr($words[$q], 0, $finalPosition);
		  echo(" "."<a href=index.php?view=RefSearch&page=1&Keyword1=".$v."&SearchIn1=Books&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$v."</a>");
		  
		  echo(substr($words[$q], $finalPosition, strlen($words[$q])));
		  }
		  else {
		  	$finalPositionExhibited = $starPosition + 1;
                  $e = substr($words[$q], 0, $finalPositionExhibited);
		  echo(" "."<a href=index.php?view=RefSearch&page=1&Keyword1=".$e."&SearchIn1=Exhibitions&Keyword2=&SearchIn2=Author&Keyword3=&SearchIn3=Author&Keyword4=&SearchIn4=Author&Keyword5=&SearchIn5=Author&Keyword6=&SearchIn6=Author&Keyword7=&SearchIn7=Author&Keyword7=&SearchIn7=Author target=\"OPPMain\">".$e."</a>");
		  
		  echo(substr($words[$q], $finalPositionExhibited, strlen($words[$q])));
                  }
                  
		  $j++;
		}
	  }?>
    </td>
    <td width="25" align="center" valign="middle"><input name="check_list" type="checkbox" value="<?=$row['opp']?>" /></td>
</tr>
<?php $i++; } ?>
</table>
</form>
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
