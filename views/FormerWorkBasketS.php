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
<title>Artwork Series - On-line Picasso Project</title>
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
session_start();
require_once(MODULES_PATH.'WorkBasketSummary.php');
$obj = new WorkBasketSummary($_GET,$_SESSION);
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
			    <td width="40" align="center">&nbsp;
				</td>
			    <td><h1>Artwork Series</h1></td>
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
			       <?php 
                        $href = "index.php?".$_SERVER['QUERY_STRING'];
                        $href1 = str_replace("FormerWorkBasketS", "FormerWorkBasketD", $href);
                        $href3 = str_replace("FormerWorkBasketS", "FormerWorkBasketP", $href);
                    ?>
                <td class="Inactive"><a href="<?=$href1?>"><img src="./images/magnify-art.png"/>Basket Display</a></td>
                <td class="Active"><img src="./images/magnify-text.png"/>Basket Summary</td>
                <td class="Inactive"><a href="<?=$href3?>"><img src="./images/magnify-art.png"/>Basket Provenance</a></td>
                <td class="InactiveEmpty">&nbsp;</td>
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
	        <a class="PageButton" href="javascript:;" target="_blank" onclick="window.history.go(-1); return false;" /><img src="./images/icon-addtobasket.gif" width="16" height="16" border="0" alt=""/><br/>Return</a>
          </td>
          <td><a class="PageButton" href="javascript:;" onclick="SubmitWorksBasketRemove('ArtworkList','FormerWorkBasketS');" title="Remove the selected items from the artwork series."><img src="./images/icon-delete.gif" width="16" height="16" border="0" alt=""/><br/>
            Remove</a> </td>
          <td>
	        <a class="PageButton" href="javascript:;" target="_blank" onclick="SubmitWorksCompare('ArtworkList', 'ArtworkCompare'); return false;" title="Add the selected items to the artwork series  comparison."><img src="./images/icon-compare.gif" width="16" height="16" border="0" alt="" title="Add the selected items to the artwork series  comparison."/><br/>Compare</a>
          </td>
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
          <td><a class="PageButton" href="index.php?view=WorkBasketSmall" target="_blank" onclick="if(!PrintWarning()) return false;" title="Print small thumbnails and details."><img src="./images/icon-print.gif" width="16" height="16" border="0"/><br/>
            Small</a> </td>
          <td><a class="PageButton" href="index.php?view=WorkBasketLarge" target="_blank" onclick="if(!PrintWarning()) return false;" title="Print large thumbnails and details."><img src="./images/icon-print.gif" width="16" height="16" border="0"/><br/>
            Large</a> </td>
        </tr>
      </table>
	  <?php } ?></td>
  </tr>
</table>
<br/>
<!---------------------------- end of heading2 ---------------------------->

<!---------------------------- Start Artwork Summary ---------------------------->
<form action="" method="get" name="ArtworkList" id="ArtworkList">
<table width="100%" border="0" align="center" cellpadding="0"  cellspacing="0" style="margin-bottom:20px ">
<?php $i = 1; while($row = mysql_fetch_array($result)){ $AcceptedTitle = $obj->getAcceptedTitle($row['title']);$formercount = $obj->formercollec($row['opp']);?>
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
    <td width="116" height="116" style="padding:4px"><table class="ThumbGallery"><tr><td class="Pic">
        <a href="index.php?view=ArtworkInfo&OPPID=<?=$row['opp']?>" target="_blank" onclick="OpenWin(this.href, 'ArtworkInfo', 748, 550); return false;">
		<?php	if($_SESSION['UserType'] == 'admin' || $row['notVerified'] == 0){
		?><img src="../graphics/<?=$row['year']?>/xthumbs/x<?=$obj->imgName($row['opp'])?>.jpg" class="imageStyle" title="<?=$row['title']?>"/><?php	}
		else{
			?>
			<img src="https://picasso.shsu.edu/images/xopp-emblem-innershadow.jpg"/>
			<?php
		}?></a></td></tr></table>
    </td>
    <td class="Info" height="116" style="padding:4px">
      <span><strong><font color="#800000"><?=$obj->parseTextTM($AcceptedTitle)?>.&nbsp;</font></strong></span><?=$row['location']?>,&nbsp;<?=$row['duration']?>.&nbsp;
      <span class="MediumDim"><?=$obj->parseTextTM($row['medium'])?>.&nbsp;<?=$row['dimension']?>.&nbsp;</span><?=$row['collection']?>.&nbsp;
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
			if ($colonPosition == false)
			  $finalPosition = 5;
			  //$v = substr($words[$q], 0, 5);
			else
			  $finalPosition = $colonPosition;
			  //$v = substr($words[$q], 0, $pos);
		  }
		  else
		  	$finalPosition = $starPosition;
		  $v = substr($words[$q], 0, $finalPosition);
		  echo(" "."<a href=index.php?view=RefSearch&page=1&Keyword1=".$v."&SearchIn1=Books&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$v."</a>");
		  
		  echo(substr($words[$q], $finalPosition, strlen($words[$q])));
		  $j++;
		}
	  }?>
    </td>
    <td width="25" align="center" valign="middle"><input type="checkbox" value="<?=$row['opp']?>" /></td>
</tr>
<?php $i++; } ?>
</table>
</form>
<!---------------------------- End Artwork Summary ---------------------------->
<!---------------------------- Start OPP Customization ----------------->
<center>
  <div class="BoxStateClosed" id="ThisCCCBox">
    <table class="LabelHolder" cellspacing="0">
      <tr>
        <td class="LabelCellHolder">
          <a href="javascript:OpenCloseImportExportBox('ThisCCCBox');" class="Label">
		  <img src="./images/tree-plus.png"  class="Plus"  width="9" height="9" alt="+" title="Click here to reveal the import/Export Options"/>
	      <img src="./images/tree-minus.png" class="Minus" width="9" height="9" alt="-" title="Click here to collapse the import/Export Options"/>
		  Importing/Exporting Options</a>
        </td>
	    <td><hr/></td>
	  </tr>
    </table>
		
    <!-- start catalog choosing table -->				
    <div class="Contents">
    <table width="100%" align="center"  cellspacing="0">
	  <tr>
		<td width="310" valign="top" align="center"><table width="290" border="0" align="center" cellpadding="0" cellspacing="0">
		  <tr><td align="left" width="100%" height="20">
		  <b>Exporting Artworks</b></td></tr>
		  <tr><td align="left" width="100%">
		  You can export the contents of the artwork series by copying the code below and saving it to a text file using your favorite text editor.<br/>
		  <textarea id="ECatalogIDs" class="OPPColumnList"><?php $result = $obj->getAllData();if($row = mysql_fetch_array($result)) echo($row['opp']);while($row = mysql_fetch_array($result)){ echo("\n");echo($row['opp']);} ?></textarea>
		</td></tr></table></td>
        <td width="310" valign="top" align="center"><table width="290" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td align="left" width="100%" height="20">
		  <b>Importing Artworks</b></td></tr>
		  <tr><td align="left" width="100%">
		  You can import a list of artworks onto the artwork series by pasting code you previously exported, or by entering one artwork OPP per line.<br/>
		  <textarea id="ICatalogIDs" class="OPPColumnList"></textarea><br/>
		  <center><button type="button" style="width:80px" onclick="ImportOPP('WorkBasketSummary');">Import</button></center>
		</td></tr></table></td>
	  </tr>
    </table>						
    </div>
      <!-- end catalog choosingg table --> 
  </div>
</center>
<!---------------------------- End OPP Customization ----------------->
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
