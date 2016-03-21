<!---------------------------- this is the notes page ---------------------------->
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
<title></title>
<link rel="stylesheet" href="./css/main.css"/>
<link rel="stylesheet" href="./css/ArtworkSummary.css"/>
<link rel="stylesheet" href="./css/ArtworkDisplay.css"/>
<link rel="stylesheet" href="./css/biography.css"/>
<script type="text/javascript" src="./js/popup.js"></script>
</head>
<body>
<?php
require_once(MODULES_PATH.'DatedArtworksSummary.php');
$obj = new DatedArtworksSummary($_GET);
$result = $obj->getData();?>
<!---------------------------- Start Artwork Summary ---------------------------->
<form action="" method="get" name="ArtworkList" id="ArtworkList">
<table width="100%" border="0" align="center" cellpadding="0"  cellspacing="0" style="margin-bottom:20px ">
<?php $i = 0; while($row = mysql_fetch_array($result)){ 
$AcceptedTitle = $obj->getAcceptedTitle($row['title']);
$formercount = $obj->formercollec($row['opp']);?>
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

     <td width="120" height="116" style="padding:4px">
		<table class="ThumbGallery">
		<tr><td class="Pic">
         	<a href="index.php?view=ArtworkInfo&OPPID=<?=$row['opp']?>" target="_blank" onclick="OpenWin(this.href, 'ArtworkInfo', 748, 550); return false;"> <?php
	if (isset($_SESSION['UserType'])) {
	if ($_SESSION['UserType'] == 'admin' || $row['notVerified'] == 0){
	?>
			<img src="../graphics/<?= $_GET['startYear']?>/xthumbs/x<?=$obj->imgName($row['opp'])?>.jpg" class="imageStyle" title="<?=$row['title']?>"/><?php }
	  else{
	  ?><img src="https://picasso.shsu.edu/images/xopp-emblem-innershadow.jpg"/><?php
	  }
	   }?>

			</a>
		    </td></tr>
		</table>
     </td>
     <td valign="top" height="116" style="padding:4px">
      <span><strong><font color="#800000"><?=$obj->parseTextTM($AcceptedTitle)?></font></strong></span>. <?=$row['location']?>. <?=$row['duration']?>. 
      <span class="MediumDim"><?=$obj->parseTextTM($row['medium'])?>. <?=$row['dimension']?>. </span><a href="index.php?view=ArtworkSearchS&page=1&Keyword1=<?=$row['collection']?>&SearchIn1=Collection&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&CategorySearchIn1=painting&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn4=sculpture&CategorySearchIn5=ceramic&CategorySearchIn6=drawing&CategorySearchIn7=watercolor&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=year&StartYear=1881&EndYear=1973&SortBy1=OPP&SortDirection1=Asc&SortBy2=OPP&SortDirection2=Asc&SortBy3=OPP&SortDirection3=Asc" <?php echo("target=\"OPPMain\">".$row['collection']);?></a>.&nbsp;
	   <?php if($row['inventory']!='') { ?> <?=$row['inventory']?>. <?php } ?><br>
      <hr  align="left" width="70"/>
 	<strong><font color="#800000"><?=$row['opp']?></font></strong><?php 
      	 
 $result1 = $obj->getCatalog($row['opp']);
	 foreach($result1 as $cata){
	  	if(substr($cata,0,3) === "testing")
              {
	   	echo("<a href=index.php?view=RefSearch&page=1&Keyword1=MPP&SearchIn1=Catalogs&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,3) === "MPP")
              {
		echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=MPP&SearchIn1=Catalogs&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,3) === "MPM")
              {
	       echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=MPM&SearchIn1=Catalogs&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,3) === "MPB")
              {
	       echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=MPB&SearchIn1=Catalogs&Keyword2=&SearchIn2=Author&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,3) === "MPA")
              {
		echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=MPA&SearchIn1=Catalogs&Keyword2=&SearchIn2=Author&Keyword3=&SearchIn3=Author&Keyword4=&SearchIn4=Author&Keyword5=&SearchIn5=Author&Keyword6=&SearchIn6=Author&Keyword7=&SearchIn7=Author&Keyword7=&SearchIn7=Author target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,4) === "PP.L")
              {
		echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=(PP.L)&SearchIn1=Catalogs&Keyword2=&SearchIn2=Author&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,2) === "PP")
              {
		echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=(PP)&SearchIn1=Catalogs&Keyword2=&SearchIn2=Author&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,2) === "GC")
              {
		echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=GC&SearchIn1=Catalogs&Keyword2=&SearchIn2=Author&Keyword3=&SearchIn3=Author&Keyword4=&SearchIn4=Author&Keyword5=&SearchIn5=Author&Keyword6=&SearchIn6=Author&Keyword7=&SearchIn7=Author&Keyword7=&SearchIn7=Author target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,2) === "DB")
              {
	       echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=DB&SearchIn1=Catalogs&Keyword2=&SearchIn2=Author&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,2) === "DR")
              {
		echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=DR&SearchIn1=Catalogs&Keyword2=&SearchIn2=Author&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,2) === "CC")
              {
		echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=CC&SearchIn1=Catalogs&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}		
		elseif(substr($cata,0,2) === "Ba")
              {
		echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=Ba&SearchIn1=Catalogs&Keyword2=&SearchIn2=Author&Keyword3=&SearchIn3=Author&Keyword4=&SearchIn4=Author&Keyword5=&SearchIn5=Author&Keyword6=&SearchIn6=Author&Keyword7=&SearchIn7=Author&Keyword7=&SearchIn7=Author target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,2) === "AR")
              {
		echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=AR&SearchIn1=Catalogs&Keyword2=&SearchIn2=Author&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,2) === "FM")
              {
		echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=FM&SearchIn1=Catalogs&Keyword2=&SearchIn2=Author&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,2) === "LD")
              {
		echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=LD&SearchIn1=Catalogs&Keyword2=&SearchIn2=Author&Keyword3=&SearchIn3=Author&Keyword4=&SearchIn4=Author&Keyword5=&SearchIn5=Author&Keyword6=&SearchIn6=Author&Keyword7=&SearchIn7=Author&Keyword7=&SearchIn7=Author target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,2) === "WS")
              {
		echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=WS&SearchIn1=Catalogs&Keyword2=&SearchIn2=Author&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,1) === "Z")
              {
		echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=(Z)&SearchIn1=Catalogs&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,1) === "B")
              {
		echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=(B)&SearchIn1=Catalogs&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,1) === "M")
              {
		echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=(M)&SearchIn1=Catalogs&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}
		elseif(substr($cata,0,1) === "C")
              {
		echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=(C)&SearchIn1=Catalogs&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}
	       elseif(substr($cata,0,2) === "PS")
              {
		echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=PS&SearchIn1=Catalogs&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$cata."</a>");
		}
	       elseif(substr($cata,0,4) === "P.IV")
              {
		echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=P.IV&SearchIn1=Catalogs&Keyword2=&SearchIn2=Author&Keyword3=&SearchIn3=Author&Keyword4=&SearchIn4=Author&Keyword5=&SearchIn5=Author&Keyword6=&SearchIn6=Author&Keyword7=&SearchIn7=Author&Keyword7=&SearchIn7=Author target=\"OPPMain\">".$cata."</a>");
		}		
	       elseif(substr($cata,0,5) === "P.III")
              {
		echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=P.III&SearchIn1=Catalogs&Keyword2=&SearchIn2=Author&Keyword3=&SearchIn3=Author&Keyword4=&SearchIn4=Author&Keyword5=&SearchIn5=Author&Keyword6=&SearchIn6=Author&Keyword7=&SearchIn7=Author&Keyword7=&SearchIn7=Author target=\"OPPMain\">".$cata."</a>");
		}
	       elseif(substr($cata,0,4) === "P.II")
              {
		echo("; "."<a href=index.php?view=RefSearch&page=1&Keyword1=P.II&SearchIn1=Catalogs&Keyword2=&SearchIn2=Author&Keyword3=&SearchIn3=Author&Keyword4=&SearchIn4=Author&Keyword5=&SearchIn5=Author&Keyword6=&SearchIn6=Author&Keyword7=&SearchIn7=Author&Keyword7=&SearchIn7=Author target=\"OPPMain\">".$cata."</a>");
		}
	       elseif(substr($cata,0,3) === "P.I")
              {
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
			else
			  $finalPosition = $colonPosition;
		  }
		  else
		  	$finalPosition = $starPosition;
		  $v = substr($words[$q], 0, $finalPosition);
		  echo(" "."<a href=index.php?view=RefSearch&page=1&Keyword1=".$v."&SearchIn1=Books&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&Keyword7=&SearchIn7=Title target=\"OPPMain\">".$v."</a>");
		  
		  echo(substr($words[$q], $finalPosition, strlen($words[$q])));
		  $j++;
		}
	  }
?>


     </td>

</tr>
<?php $i++; } ?>
</table>
</form>
<!---------------------------- End Artwork Summary ---------------------------->
</body>
</html>