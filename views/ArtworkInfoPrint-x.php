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
<title>Print of <?=$_GET['OPPID']?> - On-line Picasso Project</title>
<link rel="stylesheet" href="./css/ArtworkPrint.css"/>
<link rel="stylesheet" href="./css/note.css"/>
<link rel="stylesheet" href="./css/commentary.css"/>
<link rel="stylesheet" href="./css/main.css"/>
<link rel="stylesheet" href="./css/Reference.css"/>
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>

<body>
<?php
require_once(MODULES_PATH.'ArtworkInfoPrint.php');
$obj = new ArtworkInfoPrint($_GET['OPPID']);
$result = $obj->getData();
?>
<center>
<div class="TitlePage">
  <img src="./images/opp-emblem-whitebackground.png" width="100" height="91" alt=""/>
  <span class="Title"><?=PROJECTNAME?></span>
  </br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
  <span class="Titlepage.Copyright">Copyright&nbsp;&copy;&nbsp;<?=START_YEAR?>-<?=date("Y")?>&nbsp;Prof. Dr. Enrique Mallen</span>
</div>
<!---------------------------- start Artwork Details ---------------------------->
<?php while($row = mysql_fetch_array($result)){ ?>
<div class="InfoPage">
 <div class="InfoPageInside">
 <table width="564" height="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="564" height="400" align="center" style="padding:1px ">
 <table align="center" width="560" height="100%" border="0" cellpadding="0" cellspacing="0" >
 <?php if (isset($_SESSION['UserType'])) {
	if ($_SESSION['UserType'] == 'admin' || $row['notVerified'] == 0){
	 ?>
	    <tr><td class="Thumbnail"><img src="../graphics/<?= $row['startyear']?>/ythumbs/y<?=$obj->imgName($row['opp'])?>.jpg" title="<?=$row['title']?>"/></td>
        <?php 
	  }
	   else{
	  ?>
	  	<td id="ImgHolder"><br /><img src="https://picasso.shsu.edu/images/yopp-emblem-innershadow.jpg"/><br/><small>Copyright © Estate of Pablo Picasso/<br/>Artists Rights Society (ARS), New York</small>
	  <?php
	  }} ?>
		<td class="infoLarge1">
	   <span><strong><font color="#800000"><?=$row['title']?></font></strong></span>. 
	   <?=$row['location']?>.  
	   <?=$row['duration']?>. 
	   <span class="MediumDim"><?=$row['medium']?>. 
	   <?=$row['dimension']?>.</span> 
	   <?=$row['collection']?>. 
	   <?php if($row['inventory']!='') { ?> <?=$row['inventory']?>.<?php } ?>
	   <hr width="150" align="left"/>
 	<strong><font color="#800000"><?=$row['opp']?></font></strong><?php  $result1 = $obj->getCatalog($row['opp']); foreach($result1 as $cata) echo("; ".$cata); if($row['bookCatalog']!='') echo("; ".$obj->sortBooks($row['bookCatalog']));?>
	  </td></tr></table>
      
        </td></tr>
        <!---------------------------- start Notes Details ---------------------------->
        <td></br><strong><font color="#800000"></font></strong></td>        

		<?php if((string)$row['notes'] != ''){ ?>
       
        <?php $notetemp=(string)$row['notes'];
$notetemp= str_replace("&", "&amp;", $notetemp);
$xmlstring = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<oppNote>
$notetemp
</oppNote>
XML;

$xml = simplexml_load_string($xmlstring);
		
  foreach($xml->DataTable as $DataTable)
  {
    foreach($DataTable->entry as $entry) 
	{
?>
  <tr>
	 <table width="100%" cellpadding="0" cellspacing="0">


    <td class="noteTitle"><?=$entry['title']?>:</td>
    <td class="Info"><?=$entry->asXML()?></td>
    
  </table>
<?php } echo("<tr><td>&nbsp;</td> <td>&nbsp;</td></tr>"); }} ?></table>

	<!---------------------------- end of Notes Details ---------------------------->
    <!---------------------------- start Commentary Details ------------------------>
       
	<?php if((string)$row['commentary'] != ''){ ?>
       
       <?php $temp=(string)$row['commentary'];
$temp= str_replace("&", "&amp;", $temp);

$xmlstring = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<oppNote>
$temp
</oppNote>
XML;

$xml = simplexml_load_string($xmlstring);
?>
<?php 
  foreach($xml->DataTable as $DataTable)
  {
    foreach($DataTable->entry as $entry) 
	{
?>
  <tr>
    
	 <table width="100%" cellpadding="0" cellspacing="0">

    <td class="commentaryTitle"><?=$entry['title']?>:</td>
    <td class="Info"><?=$obj->parseText($entry->asXML())?></td>
</table>
        
<?php } echo("<tr><td>&nbsp;</td> <td>&nbsp;</td></tr>"); }}?>
   
   <!---------------------------- end of Commentary Details ------------------------->
   <!---------------------------- start Reference Details ------------------------>
    
  <?php if($row['bookCatalog'] !='') { ?>
         
		 
          
       <?php $a=$obj->sortBooks($row['bookCatalog']);
		$words= explode(" ", $a );
		$j=0;
		for($q=0;$q<count($words);$q++){
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
		  $bookNum = substr($words[$q], 0, $finalPosition);
		  
		  ?>
		  <?php $ref=$obj->getRef($bookNum);
		  	while($row = mysql_fetch_array($ref)) { ?>
			<table width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td width="15" align="left" valign="top" style="border-top:1px dotted silver;"><img src="./images/bullet.png"/></td>
    <td align="left" valign="top" style="border-top:1px dotted silver;">
	<?php 
	$Booksletter = ($row['Books'][6]==']')?'':$row['Books'][6];
	$Catalogspart = "";
	$Catalogsvolume = "All";
	if($row['Catalogs'][2]!='.')
	{
		for($i=1;$i<strlen($row['Catalogs'])-1;$i++)
		{
			$Catalogspart .= $row['Catalogs'][$i];
		}
	}
	else if($row['Catalogs'][4]==')')
		{
			$Catalogspart .= $row['Catalogs'][1];
			$Catalogsvolume = $row['Catalogs'][3]; 
		}
	else if($row['Catalogs'][5]==')')
		{
			$Catalogspart .= $row['Catalogs'][1];
			$Catalogsvolume = $row['Catalogs'][3].$row['Catalogs'][4]; 
		}
	else
		{
			$Catalogspart .= $row['Catalogs'][1];
			$Catalogsvolume = $row['Catalogs'][3].$row['Catalogs'][4].$row['Catalogs'][5]; 
		}
	?>
	  <?php
	  if($row['Journal']=="" && $row['Volume']=="")
	  {
    	$count = preg_match('#\((.*?)\)#', $row['Author'], $c_match);
		$matches = array();
		$matchcount = trim(preg_match_all('/\[([^\]]*)\]/ ', $row['Author'], $matches));
		if($matchcount>0 && $count > 0){
			$item_inside_brackets = $matches[1][0];
			$pieces = explode("[", $row['Author']);
			$c_piece = explode(".", $c_match[1]);
			$c_match[1] = $c_piece[0];
			if($c_piece[1] == NULL)
			{
				$volume = "All";
			}
			else
			{
       			$volume = $c_piece[1];
       			$dot = ".";
			}
			?>
			<span class="Author"><?php if($row['Author']=="") echo "N/A"; else echo $pieces[0]; echo "[<b><a href=index.php?view=ArtworkSearchS&page=1&Keyword1=".$matches[1][0]."&SearchIn1=bookCatalog&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&CategorySearchIn1=painting&CategorySearchIn2=collage&CategorySearchIn3=relief&CategorySearchIn4=sculpture&CategorySearchIn5=ceramic&CategorySearchIn6=drawing&CategorySearchIn7=watercolor&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=year&StartYear=1881&EndYear=1973&SortBy1=OPP&SortDirection1=Asc&SortBy2=OPP&SortDirection2=Asc&SortBy3=OPP&SortDirection3=Asc>".$matches[1][0]."</a></b>]";?></span>
			<span class="Author"><?php if($row['Author']=="") echo "N/A"; else echo "(<b><a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=".$c_match[1]."&Volume1=".$volume."&Number1=&Suffix1=&CategorySearchIn1=painting&CategorySearchIn2=collage&CategorySearchIn3=relief&CategorySearchIn4=sculpture&CategorySearchIn5=ceramic&CategorySearchIn6=drawing&CategorySearchIn7=watercolor&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=year&StartYear=1881&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc>".$c_match[1].$dot.$c_piece[1]."</a></b>)";?></span>.
		<?
		}

		if($matchcount>0 && $count < 1)
		{
			$item_inside_brackets = $matches[1][0];
	    	$pieces = explode("[", $row['Author']);
			?>
			<span class="Author"><?php if($row['Author']=="") echo "N/A"; else echo $pieces[0]; echo "[<b><a href=index.php?view=ArtworkSearchS&page=1&Keyword1=".$matches[1][0]."&SearchIn1=bookCatalog&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&CategorySearchIn1=painting&CategorySearchIn2=collage&CategorySearchIn3=relief&CategorySearchIn4=sculpture&CategorySearchIn5=ceramic&CategorySearchIn6=drawing&CategorySearchIn7=watercolor&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=year&StartYear=1881&EndYear=1973&SortBy1=OPP&SortDirection1=Asc&SortBy2=OPP&SortDirection2=Asc&SortBy3=OPP&SortDirection3=Asc>".$matches[1][0]."</a></b>]";?></span>.
		<?
		}
		if($matchcount<1 && $count > 0){
		    $pieces = explode("(", $row['Author']);
            //$pieces = explode(".", $pieces[0]);
            //$matches[1][0] = $pieces[0];
			?>
			<span class="Author"><?php if($row['Author']=="") echo "N/A"; else echo $pieces[0]; echo "(<b><a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=".$c_match[1]."&Volume1=All&Number1=&Suffix1=&CategorySearchIn1=painting&CategorySearchIn2=collage&CategorySearchIn3=relief&CategorySearchIn4=sculpture&CategorySearchIn5=ceramic&CategorySearchIn6=drawing&CategorySearchIn7=watercolor&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=year&StartYear=1881&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc>".$c_match[1]."</a></b>)";?></span>.		
		<?
		}
		if($matchcount < 1 && $count < 1) {
			?>
			<span class="Author"><?php if($row['Author']=="") echo "N/A"; else echo $row['Author']?></span>.
		<?
		}
		?>
		<span class="Books"><?php if($row['Books']=="") echo ""; else echo ("<a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&BookAuthor=".$row['Books'][1].$row['Books'][2]."&BookYear=".$row['Books'][4].$row['Books'][5].$Booksletter."&BookItem=&CategorySearchIn1=painting&CategorySearchIn6=drawing&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn7=watercolor&CategorySearchIn4=sculpture&CategorySearchIn2=collage&CategorySearchIn3=relief&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn5=ceramic&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=monthday&StartMonth=1&StartDay=1&StartYear=1881&EndMonth=12&EndDay=31&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc>".$row['Books']."</a>"); ?></span>
		<span class="Catalogs"><?php if($row['Catalogs']=="") echo ""; else echo ("<a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=".$Catalogspart."&Volume1=".$Catalogsvolume."&Number1=&Suffix1=&BookAuthor=&BookYear=&BookItem=&CategorySearchIn1=painting&CategorySearchIn6=drawing&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn7=watercolor&CategorySearchIn4=sculpture&CategorySearchIn2=collage&CategorySearchIn3=relief&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn5=ceramic&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=monthday&StartMonth=1&StartDay=1&StartYear=1881&EndMonth=12&EndDay=31&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc>".$row['Catalogs']."</a>"); ?></span>		
		<span class="Date"><?php if($row['Date']=="") echo "N/A"; else echo $row['Date']; ?></span>.		
		<span class="Titles"><?php if($row['Title']=="") echo "N/A"; else echo $row['Title']; ?></span>.
		<span class="Publisher"><?php if($row['Publisher']=="") echo "N/A"; else echo $row['Publisher']; ?></span>.
	  <?php
	  }
	  else if($row['Journal']!="")
	  {
	  	$count = preg_match('#\((.*?)\)#', $row['Author'].$row['Journal'], $c_match);
		$matches = array();
		$matchcount = trim(preg_match_all('/\[([^\]]*)\]/ ', $row['Author'].$row['Journal'], $matches));
		if($matchcount>0 && $count > 0)
		{
			$item_inside_brackets = $matches[1][0];
			$pieces = explode("[", $row['Author'].$row['Journal']);
			$c_piece = explode(".", $c_match[1]);
			$c_match[1] = $c_piece[0];
			if($c_piece[1] == NULL)
			{
				$volume = "All";
			}
			else
			{
				$volume = $c_piece[1];
				$dot = ".";
			}
			?>
			
			<span class="Author"><?php if($row['Author']=="") echo "N/A"; else echo $pieces[0]; echo "[<b><a href=index.php?view=ArtworkSearchS&page=1&Keyword1=".$matches[1][0]."&SearchIn1=bookCatalog&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&CategorySearchIn1=painting&CategorySearchIn2=collage&CategorySearchIn3=relief&CategorySearchIn4=sculpture&CategorySearchIn5=ceramic&CategorySearchIn6=drawing&CategorySearchIn7=watercolor&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=year&StartYear=1881&EndYear=1973&SortBy1=OPP&SortDirection1=Asc&SortBy2=OPP&SortDirection2=Asc&SortBy3=OPP&SortDirection3=Asc>".$matches[1][0]."</a></b>]"?></span>
			<span class="Author"><?php if($row['Author']=="") echo "N/A"; else echo "(<b><a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=".$c_match[1]."&Volume1=All&Number1=&Suffix1=&CategorySearchIn1=painting&CategorySearchIn2=collage&CategorySearchIn3=relief&CategorySearchIn4=sculpture&CategorySearchIn5=ceramic&CategorySearchIn6=drawing&CategorySearchIn7=watercolor&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=year&StartYear=1881&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc>".$c_match[1]."</a></b>)";?></span>.
			
		<?
		}
		
		if($matchcount>0 && $count < 1)
		{
			$item_inside_brackets = $matches[1][0];
			$pieces = explode("[", $row['Author'].$row['Journal']);
			$pieces = explode(".", $pieces[0]);
			
			?>
			<span class="Author"><?php if($row['Author']=="") echo "N/A"; else echo trim($pieces[0])." "; echo "[<b><a href=index.php?view=ArtworkSearchS&page=1&Keyword1=".$matches[1][0]."&SearchIn1=bookCatalog&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&CategorySearchIn1=painting&CategorySearchIn2=collage&CategorySearchIn3=relief&CategorySearchIn4=sculpture&CategorySearchIn5=ceramic&CategorySearchIn6=drawing&CategorySearchIn7=watercolor&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=year&StartYear=1881&EndYear=1973&SortBy1=OPP&SortDirection1=Asc&SortBy2=OPP&SortDirection2=Asc&SortBy3=OPP&SortDirection3=Asc>".$matches[1][0]."</a></b>]";?></span>.
		<?
		}
		
		if($matchcount<1 && $count > 0)
		{
			$pieces = explode("(", $row['Author']);
			//$pieces = explode(".", $pieces[0]);
			//$matches[1][0] = $pieces[0];

			?>
			<span class="Author"><?php if($row['Author']=="") echo "N/A"; else echo $pieces[0]; echo "(<b><a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=".$c_match[1]."&Volume1=All&Number1=&Suffix1=&CategorySearchIn1=painting&CategorySearchIn2=collage&CategorySearchIn3=relief&CategorySearchIn4=sculpture&CategorySearchIn5=ceramic&CategorySearchIn6=drawing&CategorySearchIn7=watercolor&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=year&StartYear=1881&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc>".$c_match[1]."</a></b>)";?></span>.		
					
		<?
		}
		
		if($matchcount<1 && $count < 1) 
		{
		?>
			<span class="Author"><?php if($row['Author']=="") echo "N/A"; else echo $row['Author']?></span>.
			
		<?
		}
	  ?>
	  
	  <span class="Books"><?php if($row['Books']=="") echo ""; else echo ("<a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&BookAuthor=".$row['Books'][1].$row['Books'][2]."&BookYear=".$row['Books'][4].$row['Books'][5].$Booksletter."&BookItem=&CategorySearchIn1=painting&CategorySearchIn6=drawing&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn7=watercolor&CategorySearchIn4=sculpture&CategorySearchIn2=collage&CategorySearchIn3=relief&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn5=ceramic&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=monthday&StartMonth=1&StartDay=1&StartYear=1881&EndMonth=12&EndDay=31&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc>".$row['Books']."</a>"); ?></span>
	  <span class="Catalogs"><?php if($row['Catalogs']=="") echo ""; else echo ("<a index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=".$Catalogspart."&Volume1=".$Catalogsvolume."&Number1=&Suffix1=&BookAuthor=&BookYear=&BookItem=&CategorySearchIn1=painting&CategorySearchIn6=drawing&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn7=watercolor&CategorySearchIn4=sculpture&CategorySearchIn2=collage&CategorySearchIn3=relief&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn5=ceramic&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=monthday&StartMonth=1&StartDay=1&StartYear=1881&EndMonth=12&EndDay=31&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc>".$row['Catalogs']."</a>"); ?></span>		
	  <span class="Date"><?php if($row['Date']=="") echo "N/A"; else echo $row['Date']; ?></span>.
	  <span class="Title"><?php if($row['Title']=="") echo "N/A"; else echo $row['Title']; ?></span>.
	  <span class="Journal"><?php if($row['Journal']=="") echo "N/A"; else echo $row['Journal']; ?></span>.
	  <span class="Issue"><?php if($row['Issue']=="") echo "N/A"; else echo $row['Issue']; ?></span>.
	  
	  <?php
	  }
	  else if($row['Volume']!="")
	  {
	  	$count = preg_match('#\((.*?)\)#', $row['Author'].$row['Volume'], $c_match);
		
		$matches = array();
		$matchcount = trim(preg_match_all('/\[([^\]]*)\]/ ', $row['Author'].$row['Volume'], $matches));
		if($matchcount>0 && $count > 0)
		{
			$item_inside_brackets = $matches[1][0];
			$pieces = explode("[", $row['Author'].$row['Volume']);
			$c_piece = explode(".", $c_match[1]);
			$c_match[1] = $c_piece[0];
			if($c_piece[1] == NULL)
			{
				$volume = "All";
			}
			else
			{
				$volume = $c_piece[1];
				$dot = ".";
			}
			
			?>
			<span class="Author"><?php if($row['Author']=="") echo "N/A"; else echo $pieces[0]; echo "[<b><a href=index.php?view=ArtworkSearchS&page=1&Keyword1=".$matches[1][0]."&SearchIn1=bookCatalog&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&CategorySearchIn1=painting&CategorySearchIn2=collage&CategorySearchIn3=relief&CategorySearchIn4=sculpture&CategorySearchIn5=ceramic&CategorySearchIn6=drawing&CategorySearchIn7=watercolor&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=year&StartYear=1881&EndYear=1973&SortBy1=OPP&SortDirection1=Asc&SortBy2=OPP&SortDirection2=Asc&SortBy3=OPP&SortDirection3=Asc>".$matches[1][0]."</a></b>]"?></span>
			<span class="Author"><?php if($row['Author']=="") echo "N/A"; else echo "(<b><a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=".$c_match[1]."&Volume1=All&Number1=&Suffix1=&CategorySearchIn1=painting&CategorySearchIn2=collage&CategorySearchIn3=relief&CategorySearchIn4=sculpture&CategorySearchIn5=ceramic&CategorySearchIn6=drawing&CategorySearchIn7=watercolor&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=year&StartYear=1881&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc>".$c_match[1]."</a></b>)";?></span>.
			
		<?
		}
		if($matchcount>0 && $count < 1){
			$item_inside_brackets = $matches[1][0];
			$pieces = explode("[", $row['Author']);
			$pieces = explode(".", $pieces[0]);
			
			?>
			<span class="Author"><?php if($row['Author']=="") echo "N/A"; else echo $pieces[0]; echo "[<b><a href=index.php?view=ArtworkSearchS&page=1&Keyword1=".$matches[1][0]."&SearchIn1=bookCatalog&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&CategorySearchIn1=painting&CategorySearchIn2=collage&CategorySearchIn3=relief&CategorySearchIn4=sculpture&CategorySearchIn5=ceramic&CategorySearchIn6=drawing&CategorySearchIn7=watercolor&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=year&StartYear=1881&EndYear=1973&SortBy1=OPP&SortDirection1=Asc&SortBy2=OPP&SortDirection2=Asc&SortBy3=OPP&SortDirection3=Asc>".$matches[1][0]."</a></b>]";?></span>.
		
		<?
		}
		if($matchcount<1 && $count > 0){
			$pieces = explode("(", $row['Author']);
			//$pieces = explode(".", $pieces[0]);
			//$matches[1][0] = $pieces[0];
			
			?>
			<span class="Author"><?php if($row['Author']=="") echo "N/A"; else echo $pieces[0];echo "(<b><a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=".$c_match[1]."&Volume1=All&Number1=&Suffix1=&CategorySearchIn1=painting&CategorySearchIn2=collage&CategorySearchIn3=relief&CategorySearchIn4=sculpture&CategorySearchIn5=ceramic&CategorySearchIn6=drawing&CategorySearchIn7=watercolor&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=year&StartYear=1881&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc>".$c_match[1]."</a></b>)";?></span>.
			
		<?
		}
		if($matchcount<1 && $count < 1) {
			?>
			<span class="Author"><?php if($row['Author']=="") echo "N/A"; else echo $row['Author']; ?></span>.
	    <?
		}		
	  ?>
	  <span class="Books"><?php if($row['Books']=="") echo ""; else echo ("<a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&BookAuthor=".$row['Books'][1].$row['Books'][2]."&BookYear=".$row['Books'][4].$row['Books'][5].$Booksletter."&BookItem=&CategorySearchIn1=painting&CategorySearchIn6=drawing&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn7=watercolor&CategorySearchIn4=sculpture&CategorySearchIn2=collage&CategorySearchIn3=relief&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn5=ceramic&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=monthday&StartMonth=1&StartDay=1&StartYear=1881&EndMonth=12&EndDay=31&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc>".$row['Books']."</a>"); ?></span>
	  <span class="Catalogs"><?php if($row['Catalogs']=="") echo ""; else echo ("<a index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=".$Catalogspart."&Volume1=".$Catalogsvolume."&Number1=&Suffix1=&BookAuthor=&BookYear=&BookItem=&CategorySearchIn1=painting&CategorySearchIn6=drawing&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn7=watercolor&CategorySearchIn4=sculpture&CategorySearchIn2=collage&CategorySearchIn3=relief&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn5=ceramic&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=monthday&StartMonth=1&StartDay=1&StartYear=1881&EndMonth=12&EndDay=31&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc>".$row['Catalogs']."</a>"); ?></span>		
	  <span class="Date"><?php if($row['Date']=="") echo "N/A"; else echo $row['Date']; ?></span>.
	  <span class="Title"><?php if($row['Title']=="") echo "N/A"; else echo $row['Title']; ?></span>.
	  <span class="Volume"><?php if($row['Volume']=="") echo "N/A"; else echo $row['Volume']; ?></span>.
	  <span class="Edition"><?php if($row['Edition']=="") echo "N/A"; else echo $row['Edition']; ?></span>.
	  <span class="Publisher"><?php if($row['Publisher']=="") echo "N/A"; else echo $row['Publisher']; ?></span>.
	</td></table>	
	<?php
	}
	?>
	
  </tr>
<?php } ?>
		 
	  
		<?php }
	  } }?>  
  
  
   <!---------------------------- end of Reference Details ------------------------->
   <!---------------------------- end of Artwork Details ---------------------------->
      </div>
	</div>
     </center>
</body>
</html>