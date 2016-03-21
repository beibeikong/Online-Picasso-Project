<?php if ( ! defined('PROJECTNAME')) exit('');
if(file_exists('./modules/checkFrontUser.php'))
    require_once('./modules/checkFrontUser.php');  // check if it is authenrized user
else
    die('0');
?>
<?php
$hightlightString = "";
for($i=1;$i<=7;$i++)
{
  $paraName = "Keyword$i";
  $keyword = trim($_GET[$paraName]);
  $keyword = str_replace("'","\'",$keyword);
  if ($keyword !="")
  {
    $hightlightString .= "highlightSearchTerms('$keyword','RefHighlightTarget');";
  }
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Literature Search Result - On-line Picasso Project</title>
<link rel="stylesheet" href="./css/main.css"/>
<link rel="stylesheet" href="./css/Reference.css"/>
<script type="text/javascript" src="./js/main.js"></script>
<script type="text/javascript" src="./js/popup.js"></script>
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>

<body onload="window.name='OPPMain'; <?=$hightlightString?>">
<?php
require_once(MODULES_PATH.'ExhibitSearch.php');
$obj = new RefSearch($_GET);
$result = $obj->getData();
$totalNum = $obj->getTotalNum();
$page = $_GET['page'];  // current page number
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
			    <td width="40" align="center">
				</td>
			    <td><span class="big_year">Exhibited Search Results</span></td>
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
                                <td class="Active"><img src="./images/magnify-text.png"/>Exhibited</td>                                
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
        <td><a href="index.php?view=Reference&letter=A" target="OPPMain">A</a></td>
        <td><a href="index.php?view=Reference&letter=B" target="OPPMain">B</a></td>
        <td><a href="index.php?view=Reference&letter=C" target="OPPMain">C</a></td>
        <td><a href="index.php?view=Reference&letter=D" target="OPPMain">D</a></td>
        <td><a href="index.php?view=Reference&letter=E" target="OPPMain">E</a></td>
        <td><a href="index.php?view=Reference&letter=F" target="OPPMain">F</a></td>
        <td><a href="index.php?view=Reference&letter=G" target="OPPMain">G</a></td>
        <td><a href="index.php?view=Reference&letter=H" target="OPPMain">H</a></td>
        <td><a href="index.php?view=Reference&letter=I" target="OPPMain">I</a></td>
        <td><a href="index.php?view=Reference&letter=J" target="OPPMain">J</a></td>
		<td><a href="index.php?view=Reference&letter=K" target="OPPMain">K</a></td>
		<td><a href="index.php?view=Reference&letter=L" target="OPPMain">L</a></td>
		<td><a href="index.php?view=Reference&letter=M" target="OPPMain">M</a></td>
		<td><a href="index.php?view=Reference&letter=N" target="OPPMain">N</a></td>
		<td><a href="index.php?view=Reference&letter=O" target="OPPMain">O</a></td>
		<td><a href="index.php?view=Reference&letter=P" target="OPPMain">P</a></td>
		<td><a href="index.php?view=Reference&letter=Q" target="OPPMain">Q</a></td>
		<td><a href="index.php?view=Reference&letter=R" target="OPPMain">R</a></td>
		<td><a href="index.php?view=Reference&letter=S" target="OPPMain">S</a></td>
		<td><a href="index.php?view=Reference&letter=T" target="OPPMain">T</a></td>
		<td><a href="index.php?view=Reference&letter=U" target="OPPMain">U</a></td>
		<td><a href="index.php?view=Reference&letter=V" target="OPPMain">V</a></td>
		<td><a href="index.php?view=Reference&letter=W" target="OPPMain">W</a></td>
		<td><a href="index.php?view=Reference&letter=X" target="OPPMain">X</a></td>
		<td><a href="index.php?view=Reference&letter=Y" target="OPPMain">Y</a></td>
		<td><a href="index.php?view=Reference&letter=Z" target="OPPMain">Z</a></td>
                    </tr>
                  </table>
	  <h2><?=$totalNum?> Matched References</h2>
	  <h3>Viewing Reference <?php echo(($page-1)*ITEMS_PER_PAGE+1)?> through <?php echo(min($page*ITEMS_PER_PAGE, $totalNum))?></h3></td>
	<td width="150px" align="right" >&nbsp;</td>
  </tr>
</table>
<br/>
<!---------------------------- end of heading2 ---------------------------->
<!---------------------------- Start Reference ---------------------------->
<div id="RefHighlightTarget">

<table width="620" border="0" align="center" cellpadding="1" cellspacing="0">
<?php while($row = mysql_fetch_array($result)){ ?>
  <tr>
    <td width="10" align="left" valign="top" style="border-bottom:1px dotted silver;"></td>
    <td align="left" valign="top" style="border-bottom:1px dotted silver;">
	<ul><li>
	<?php 
//	$Booksletter = ($row['Books'][6]==']')?'':$row['Books'][6];
        if (($row['Books'][6] == ']') or ( $row['Books'][6] == '*')) {
                $Booksletter = ':';
            } else {
                $Booksletter = $row['Books'][6].':';
            }
         if ($row['Exhibitions'][6]=='*') {
                $ExhibitedLetter = $row['Exhibitions'][6];
            }
            else {
                $ExhibitedLetter = $row['Exhibitions'][6].'*';
            }
	$Catalogspart = "";
	$Catalogsvolume = "All";
	if($row['Catalogs']=='(PP.L)')
	{
			$Catalogspart = 'PP';
			$Catalogsvolume = 'L'; 
	}
	else if($row['Catalogs'][2]!='.')
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
    	$count = preg_match('#\((.*?)\)#', $row['Author'], $c_match);	//number of book
		$matches = array();
		$matchcount = trim(preg_match_all('/\[([^\]]*)\]/ ', $row['Author'], $matches));	//number of catelog
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
                        <span class="TitlesBold"><?php if($row['Title']=="") echo "N/A"; else echo $row['Title']; ?></span>.
                        <span class="Books"><?php if($row['Books']=="") echo ""; else echo ("<a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&BookAuthor=".$row['Books'][1].$row['Books'][2]."&BookYear=".$row['Books'][4].$row['Books'][5].$Booksletter."&BookItem=&CategorySearchIn1=painting&CategorySearchIn6=drawing&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn7=watercolor&CategorySearchIn4=sculpture&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn5=ceramic&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=monthday&StartMonth=1&StartDay=1&StartYear=1881&EndMonth=12&EndDay=31&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc>".$row['Books']."</a>"); ?></span>
                        <span class="Exhibitions"><?php if($row['Exhibitions']=="") echo ""; else echo ("<a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&BookAuthor=".$row['Exhibitions'][1].$row['Exhibitions'][2]."&BookYear=".$row['Exhibitions'][4].$row['Exhibitions'][5].$ExhibitedLetter."&BookItem=&CategorySearchIn1=painting&CategorySearchIn6=drawing&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn7=watercolor&CategorySearchIn4=sculpture&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn5=ceramic&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=monthday&StartMonth=1&StartDay=1&StartYear=1881&EndMonth=12&EndDay=31&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc>".$row['Exhibitions']."</a>"); ?></span>
			<span class="AuthorNoBold">Texts: <?php if($row['Author']=="") echo "N/A"; else echo $pieces[0]; echo "[<b><a href=index.php?view=ArtworkSearchS&page=1&Keyword1=".$matches[1][0]."&SearchIn1=bookCatalog&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&Catalog2=All&Volume2=All&Number2=&Suffix2=&CategorySearchIn1=painting&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn4=sculpture&CategorySearchIn5=ceramic&CategorySearchIn6=drawing&CategorySearchIn7=watercolor&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=year&StartYear=1881&EndYear=1973&SortBy1=OPP&SortDirection1=Asc&SortBy2=OPP&SortDirection2=Asc&SortBy3=OPP&SortDirection3=Asc>".$matches[1][0]."</a></b>]";?></span>
			<span class="AuthorNoBold">Texts: <?php if($row['Author']=="") echo "N/A"; else echo "(<b><a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=".$c_match[1]."&Volume1=".$volume."&Number1=&Suffix1=&Catalog2=All&Volume2=".$volume."&Number2=&Suffix2=&CategorySearchIn1=painting&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn4=sculpture&CategorySearchIn5=ceramic&CategorySearchIn6=drawing&CategorySearchIn7=watercolor&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=year&StartYear=1881&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc>".$c_match[1].$dot.$c_piece[1]."</a></b>)";?></span>.
		<?
		}
		if($matchcount>0 && $count < 1)
		{
			$item_inside_brackets = $matches[1][0];
	    	$pieces = explode("[", $row['Author']);
			?>
                        <span class="TitlesBold"><?php if($row['Title']=="") echo "N/A"; else echo $row['Title']; ?></span>.
                        <span class="Books"><?php if($row['Books']=="") echo ""; else echo ("<a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&BookAuthor=".$row['Books'][1].$row['Books'][2]."&BookYear=".$row['Books'][4].$row['Books'][5].$Booksletter."&BookItem=&CategorySearchIn1=painting&CategorySearchIn6=drawing&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn7=watercolor&CategorySearchIn4=sculpture&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn5=ceramic&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=monthday&StartMonth=1&StartDay=1&StartYear=1881&EndMonth=12&EndDay=31&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc>".$row['Books']."</a>"); ?></span>
                        <span class="Exhibitions"><?php if($row['Exhibitions']=="") echo ""; else echo ("<a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&BookAuthor=".$row['Exhibitions'][1].$row['Exhibitions'][2]."&BookYear=".$row['Exhibitions'][4].$row['Exhibitions'][5].$ExhibitedLetter."&BookItem=&CategorySearchIn1=painting&CategorySearchIn6=drawing&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn7=watercolor&CategorySearchIn4=sculpture&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn5=ceramic&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=monthday&StartMonth=1&StartDay=1&StartYear=1881&EndMonth=12&EndDay=31&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc>".$row['Exhibitions']."</a>"); ?></span>
			<span class="AuthorNoBold">Texts: <?php if($row['Author']=="") echo "N/A"; else echo $pieces[0]; echo "[<b><a href=index.php?view=ArtworkSearchS&page=1&Keyword1=".$matches[1][0]."&SearchIn1=bookCatalog&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&Catalog2=All&Volume2=All&Number2=&Suffix2=&CategorySearchIn1=painting&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn4=sculpture&CategorySearchIn5=ceramic&CategorySearchIn6=drawing&CategorySearchIn7=watercolor&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=year&StartYear=1881&EndYear=1973&SortBy1=OPP&SortDirection1=Asc&SortBy2=OPP&SortDirection2=Asc&SortBy3=OPP&SortDirection3=Asc>".$matches[1][0]."</a></b>]";?></span>.
		<?
		}
		if($matchcount<1 && $count > 0){
		    $pieces = explode("(", $row['Author']);
            //$pieces = explode(".", $pieces[0]);
            //$matches[1][0] = $pieces[0];
			?>
                        <span class="TitlesBold"><?php if($row['Title']=="") echo "N/A"; else echo $row['Title']; ?></span>.
		        <span class="Books"><?php if($row['Books']=="") echo ""; else echo ("<a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&BookAuthor=".$row['Books'][1].$row['Books'][2]."&BookYear=".$row['Books'][4].$row['Books'][5].$Booksletter."&BookItem=&CategorySearchIn1=painting&CategorySearchIn6=drawing&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn7=watercolor&CategorySearchIn4=sculpture&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn5=ceramic&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=monthday&StartMonth=1&StartDay=1&StartYear=1881&EndMonth=12&EndDay=31&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc>".$row['Books']."</a>"); ?></span>
                        <span class="Exhibitions"><?php if($row['Exhibitions']=="") echo ""; else echo ("<a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&BookAuthor=".$row['Exhibitions'][1].$row['Exhibitions'][2]."&BookYear=".$row['Exhibitions'][4].$row['Exhibitions'][5].$ExhibitedLetter."&BookItem=&CategorySearchIn1=painting&CategorySearchIn6=drawing&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn7=watercolor&CategorySearchIn4=sculpture&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn5=ceramic&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=monthday&StartMonth=1&StartDay=1&StartYear=1881&EndMonth=12&EndDay=31&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc>".$row['Exhibitions']."</a>"); ?></span>
			<span class="AuthorNoBold">Texts: <?php if($row['Author']=="") echo "N/A"; else echo $pieces[0]; echo "(<b><a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=".$c_match[1]."&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&CategorySearchIn1=painting&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn4=sculpture&CategorySearchIn5=ceramic&CategorySearchIn6=drawing&CategorySearchIn7=watercolor&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=year&StartYear=1881&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc>".$c_match[1]."</a></b>)";?></span>.		
		<?
		}
		if($matchcount < 1 && $count < 1) {
			?>
                        <span class="TitlesBold"><?php if($row['Title']=="") echo "N/A"; else echo $row['Title']; ?></span>.
                        <span class="Books"><?php if($row['Books']=="") echo ""; else echo ("<a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&BookAuthor=".$row['Books'][1].$row['Books'][2]."&BookYear=".$row['Books'][4].$row['Books'][5].$Booksletter."&BookItem=&CategorySearchIn1=painting&CategorySearchIn6=drawing&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn7=watercolor&CategorySearchIn4=sculpture&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn5=ceramic&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=monthday&StartMonth=1&StartDay=1&StartYear=1881&EndMonth=12&EndDay=31&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc>".$row['Books']."</a>"); ?></span>
                        <span class="Exhibitions"><?php if($row['Exhibitions']=="") echo ""; else echo ("<a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&BookAuthor=".$row['Exhibitions'][1].$row['Exhibitions'][2]."&BookYear=".$row['Exhibitions'][4].$row['Exhibitions'][5].$ExhibitedLetter."&BookItem=&CategorySearchIn1=painting&CategorySearchIn6=drawing&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn7=watercolor&CategorySearchIn4=sculpture&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn5=ceramic&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=monthday&StartMonth=1&StartDay=1&StartYear=1881&EndMonth=12&EndDay=31&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc>".$row['Exhibitions']."</a>"); ?></span>
			<span class="AuthorNoBold">Texts: <?php if($row['Author']=="") echo "N/A"; else echo $row['Author']?></span>.
		<?
		}
		?>
                
                <span class="Catalogs"><?php if($row['Catalogs']=="") echo ""; else echo ("<a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=".$Catalogspart."&Volume1=".$Catalogsvolume."&Number1=&Suffix1=&Catalog2=All&Volume2=".$Catalogsvolume."&Number2=&Suffix2=&BookAuthor=&BookYear=&BookItem=&CategorySearchIn1=painting&CategorySearchIn6=drawing&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn7=watercolor&CategorySearchIn4=sculpture&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn5=ceramic&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=monthday&StartMonth=1&StartDay=1&StartYear=1881&EndMonth=12&EndDay=31&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc>".$row['Catalogs']."</a>"); ?></span>		
		<span class="Publisher"><?php if($row['Publisher']=="") echo "N/A"; else echo $row['Publisher']; ?></span>.
		<span class="Date"><?php if($row['Date']=="") echo "N/A"; else echo $row['Date']; ?></span>.	
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
			<span class="TitlesBold"><?php if($row['Title']=="") echo "N/A"; else echo $row['Title']; ?></span>.
                        <span class="Books"><?php if($row['Books']=="") echo ""; else echo ("<a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&BookAuthor=".$row['Books'][1].$row['Books'][2]."&BookYear=".$row['Books'][4].$row['Books'][5].$Booksletter."&BookItem=&CategorySearchIn1=painting&CategorySearchIn6=drawing&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn7=watercolor&CategorySearchIn4=sculpture&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn5=ceramic&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=monthday&StartMonth=1&StartDay=1&StartYear=1881&EndMonth=12&EndDay=31&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc>".$row['Books']."</a>"); ?></span>
                        <span class="Exhibitions"><?php if($row['Exhibitions']=="") echo ""; else echo ("<a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&BookAuthor=".$row['Exhibitions'][1].$row['Exhibitions'][2]."&BookYear=".$row['Exhibitions'][4].$row['Exhibitions'][5].$ExhibitedLetter."&BookItem=&CategorySearchIn1=painting&CategorySearchIn6=drawing&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn7=watercolor&CategorySearchIn4=sculpture&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn5=ceramic&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=monthday&StartMonth=1&StartDay=1&StartYear=1881&EndMonth=12&EndDay=31&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc>".$row['Exhibitions']."</a>"); ?></span>
			<span class="AuthorNoBold">Texts: <?php if($row['Author']=="") echo "N/A"; else echo $pieces[0]; echo "[<b><a href=index.php?view=ArtworkSearchS&page=1&Keyword1=".$matches[1][0]."&SearchIn1=bookCatalog&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&Catalog2=All&Volume2=All&Number2=&Suffix2=&CategorySearchIn1=painting&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn4=sculpture&CategorySearchIn5=ceramic&CategorySearchIn6=drawing&CategorySearchIn7=watercolor&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=year&StartYear=1881&EndYear=1973&SortBy1=OPP&SortDirection1=Asc&SortBy2=OPP&SortDirection2=Asc&SortBy3=OPP&SortDirection3=Asc>".$matches[1][0]."</a></b>]"?></span>
			<span class="AuthorNoBold">Texts: <?php if($row['Author']=="") echo "N/A"; else echo "(<b><a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=".$c_match[1]."&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&CategorySearchIn1=painting&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn4=sculpture&CategorySearchIn5=ceramic&CategorySearchIn6=drawing&CategorySearchIn7=watercolor&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=year&StartYear=1881&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc>".$c_match[1]."</a></b>)";?></span>.
			
		<?
		}
		
		if($matchcount>0 && $count < 1)
		{
			$item_inside_brackets = $matches[1][0];
			$pieces = explode("[", $row['Author'].$row['Journal']);
			$pieces = explode(".", $pieces[0]);
			
			?>
                        <span class="TitlesBold"><?php if($row['Title']=="") echo "N/A"; else echo $row['Title']; ?></span>.
                        <span class="Books"><?php if($row['Books']=="") echo ""; else echo ("<a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&BookAuthor=".$row['Books'][1].$row['Books'][2]."&BookYear=".$row['Books'][4].$row['Books'][5].$Booksletter."&BookItem=&CategorySearchIn1=painting&CategorySearchIn6=drawing&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn7=watercolor&CategorySearchIn4=sculpture&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn5=ceramic&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=monthday&StartMonth=1&StartDay=1&StartYear=1881&EndMonth=12&EndDay=31&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc>".$row['Books']."</a>"); ?></span>
                        <span class="Exhibitions"><?php if($row['Exhibitions']=="") echo ""; else echo ("<a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&BookAuthor=".$row['Exhibitions'][1].$row['Exhibitions'][2]."&BookYear=".$row['Exhibitions'][4].$row['Exhibitions'][5].$ExhibitedLetter."&BookItem=&CategorySearchIn1=painting&CategorySearchIn6=drawing&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn7=watercolor&CategorySearchIn4=sculpture&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn5=ceramic&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=monthday&StartMonth=1&StartDay=1&StartYear=1881&EndMonth=12&EndDay=31&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc>".$row['Exhibitions']."</a>"); ?></span>
			<span class="AuthorNoBold">Texts: <?php if($row['Author']=="") echo "N/A"; else echo trim($pieces[0])." "; echo "[<b><a href=index.php?view=ArtworkSearchS&page=1&Keyword1=".$matches[1][0]."&SearchIn1=bookCatalog&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&Catalog2=All&Volume2=All&Number2=&Suffix2=&CategorySearchIn1=painting&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn4=sculpture&CategorySearchIn5=ceramic&CategorySearchIn6=drawing&CategorySearchIn7=watercolor&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=year&StartYear=1881&EndYear=1973&SortBy1=OPP&SortDirection1=Asc&SortBy2=OPP&SortDirection2=Asc&SortBy3=OPP&SortDirection3=Asc>".$matches[1][0]."</a></b>]";?></span>.
		<?
		}
		
		if($matchcount<1 && $count > 0)
		{
			$pieces = explode("(", $row['Author']);
			//$pieces = explode(".", $pieces[0]);
			//$matches[1][0] = $pieces[0];

			?>
                        <span class="TitlesBold"><?php if($row['Title']=="") echo "N/A"; else echo $row['Title']; ?></span>.
                        <span class="Books"><?php if($row['Books']=="") echo ""; else echo ("<a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&BookAuthor=".$row['Books'][1].$row['Books'][2]."&BookYear=".$row['Books'][4].$row['Books'][5].$Booksletter."&BookItem=&CategorySearchIn1=painting&CategorySearchIn6=drawing&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn7=watercolor&CategorySearchIn4=sculpture&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn5=ceramic&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=monthday&StartMonth=1&StartDay=1&StartYear=1881&EndMonth=12&EndDay=31&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc>".$row['Books']."</a>"); ?></span>
                        <span class="Exhibitions"><?php if($row['Exhibitions']=="") echo ""; else echo ("<a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&BookAuthor=".$row['Exhibitions'][1].$row['Exhibitions'][2]."&BookYear=".$row['Exhibitions'][4].$row['Exhibitions'][5].$ExhibitedLetter."&BookItem=&CategorySearchIn1=painting&CategorySearchIn6=drawing&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn7=watercolor&CategorySearchIn4=sculpture&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn5=ceramic&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=monthday&StartMonth=1&StartDay=1&StartYear=1881&EndMonth=12&EndDay=31&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc>".$row['Exhibitions']."</a>"); ?></span>
			<span class="AuthorNoBold">Texts: <?php if($row['Author']=="") echo "N/A"; else echo $pieces[0]; echo "(<b><a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=".$c_match[1]."&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&CategorySearchIn1=painting&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn4=sculpture&CategorySearchIn5=ceramic&CategorySearchIn6=drawing&CategorySearchIn7=watercolor&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=year&StartYear=1881&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc>".$c_match[1]."</a></b>)";?></span>.		
					
		<?
		}
		
		if($matchcount<1 && $count < 1) 
		{
		?>
		<span class="TitlesBold"><?php if($row['Title']=="") echo "N/A"; else echo $row['Title']; ?></span>.
		<span class="Books"><?php if($row['Books']=="") echo ""; else echo ("<a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&BookAuthor=".$row['Books'][1].$row['Books'][2]."&BookYear=".$row['Books'][4].$row['Books'][5].$Booksletter."&BookItem=&CategorySearchIn1=painting&CategorySearchIn6=drawing&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn7=watercolor&CategorySearchIn4=sculpture&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn5=ceramic&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=monthday&StartMonth=1&StartDay=1&StartYear=1881&EndMonth=12&EndDay=31&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc>".$row['Books']."</a>"); ?></span>
                <span class="Exhibitions"><?php if($row['Exhibitions']=="") echo ""; else echo ("<a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&BookAuthor=".$row['Exhibitions'][1].$row['Exhibitions'][2]."&BookYear=".$row['Exhibitions'][4].$row['Exhibitions'][5].$ExhibitedLetter."&BookItem=&CategorySearchIn1=painting&CategorySearchIn6=drawing&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn7=watercolor&CategorySearchIn4=sculpture&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn5=ceramic&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=monthday&StartMonth=1&StartDay=1&StartYear=1881&EndMonth=12&EndDay=31&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc>".$row['Exhibitions']."</a>"); ?></span>	
                <span class="AuthorNoBold">Texts: <?php if($row['Author']=="") echo "N/A"; else echo $row['Author']?></span>.
			
		<?
		}
	  ?>
	  <span class="Catalogs"><?php if($row['Catalogs']=="") echo ""; else echo ("<a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=".$Catalogspart."&Volume1=".$Catalogsvolume."&Number1=&Suffix1=&Catalog2=All&Volume2=".$Catalogsvolume."&Number2=&Suffix2=&BookAuthor=&BookYear=&BookItem=&CategorySearchIn1=painting&CategorySearchIn6=drawing&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn7=watercolor&CategorySearchIn4=sculpture&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn5=ceramic&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=monthday&StartMonth=1&StartDay=1&StartYear=1881&EndMonth=12&EndDay=31&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc>".$row['Catalogs']."</a>"); ?></span>	
	  <span class="Journal"><?php if($row['Journal']=="") echo "N/A"; else echo $row['Journal']; ?></span>.
	  <span class="Issue"><?php if($row['Issue']=="") echo "N/A"; else echo $row['Issue']; ?></span>.
	  <span class="Date"><?php if($row['Date']=="") echo "N/A"; else echo $row['Date']; ?></span>.
	  	  
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
                        <span class="TitlesBold"><?php if($row['Title']=="") echo "N/A"; else echo $row['Title']; ?></span>.
                        <span class="Books"><?php if($row['Books']=="") echo ""; else echo ("<a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&BookAuthor=".$row['Books'][1].$row['Books'][2]."&BookYear=".$row['Books'][4].$row['Books'][5].$Booksletter."&BookItem=&CategorySearchIn1=painting&CategorySearchIn6=drawing&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn7=watercolor&CategorySearchIn4=sculpture&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn5=ceramic&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=monthday&StartMonth=1&StartDay=1&StartYear=1881&EndMonth=12&EndDay=31&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc>".$row['Books']."</a>"); ?></span>
                        <span class="Exhibitions"><?php if($row['Exhibitions']=="") echo ""; else echo ("<a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&BookAuthor=".$row['Exhibitions'][1].$row['Exhibitions'][2]."&BookYear=".$row['Exhibitions'][4].$row['Exhibitions'][5].$ExhibitedLetter."&BookItem=&CategorySearchIn1=painting&CategorySearchIn6=drawing&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn7=watercolor&CategorySearchIn4=sculpture&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn5=ceramic&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=monthday&StartMonth=1&StartDay=1&StartYear=1881&EndMonth=12&EndDay=31&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc>".$row['Exhibitions']."</a>"); ?></span>
			<span class="AuthorNoBold">Texts: <?php if($row['Author']=="") echo "N/A"; else echo $pieces[0]; echo "[<b><a href=index.php?view=ArtworkSearchS&page=1&Keyword1=".$matches[1][0]."&SearchIn1=bookCatalog&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&Catalog2=All&Volume2=All&Number2=&Suffix2=&CategorySearchIn1=painting&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn4=sculpture&CategorySearchIn5=ceramic&CategorySearchIn6=drawing&CategorySearchIn7=watercolor&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=year&StartYear=1881&EndYear=1973&SortBy1=OPP&SortDirection1=Asc&SortBy2=OPP&SortDirection2=Asc&SortBy3=OPP&SortDirection3=Asc>".$matches[1][0]."</a></b>]"?></span>
			<span class="AuthorNoBold">Texts: <?php if($row['Author']=="") echo "N/A"; else echo "(<b><a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=".$c_match[1]."&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&CategorySearchIn1=painting&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn4=sculpture&CategorySearchIn5=ceramic&CategorySearchIn6=drawing&CategorySearchIn7=watercolor&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=year&StartYear=1881&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc>".$c_match[1]."</a></b>)";?></span>.
			
		<?
		}
		if($matchcount>0 && $count < 1){

			$item_inside_brackets = $matches[1][0];
			$pieces = explode("[", $row['Author']);
			$pieces = explode(".", $pieces[0]);
			
			?>
                        <span class="TitlesBold"><?php if($row['Title']=="") echo "N/A"; else echo $row['Title']; ?></span>.
                        <span class="Books"><?php if($row['Books']=="") echo ""; else echo ("<a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&BookAuthor=".$row['Books'][1].$row['Books'][2]."&BookYear=".$row['Books'][4].$row['Books'][5].$Booksletter."&BookItem=&CategorySearchIn1=painting&CategorySearchIn6=drawing&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn7=watercolor&CategorySearchIn4=sculpture&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn5=ceramic&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=monthday&StartMonth=1&StartDay=1&StartYear=1881&EndMonth=12&EndDay=31&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc>".$row['Books']."</a>"); ?></span>
                        <span class="Exhibitions"><?php if($row['Exhibitions']=="") echo ""; else echo ("<a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&BookAuthor=".$row['Exhibitions'][1].$row['Exhibitions'][2]."&BookYear=".$row['Exhibitions'][4].$row['Exhibitions'][5].$ExhibitedLetter."&BookItem=&CategorySearchIn1=painting&CategorySearchIn6=drawing&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn7=watercolor&CategorySearchIn4=sculpture&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn5=ceramic&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=monthday&StartMonth=1&StartDay=1&StartYear=1881&EndMonth=12&EndDay=31&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc>".$row['Exhibitions']."</a>"); ?></span>
			<span class="AuthorNoBold">Texts: <?php if($row['Author']=="") echo "N/A"; else echo $pieces[0]; echo "[<b><a href=index.php?view=ArtworkSearchS&page=1&Keyword1=".$matches[1][0]."&SearchIn1=bookCatalog&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&Catalog2=All&Volume2=All&Number2=&Suffix2=&CategorySearchIn1=painting&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn4=sculpture&CategorySearchIn5=ceramic&CategorySearchIn6=drawing&CategorySearchIn7=watercolor&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=year&StartYear=1881&EndYear=1973&SortBy1=OPP&SortDirection1=Asc&SortBy2=OPP&SortDirection2=Asc&SortBy3=OPP&SortDirection3=Asc>".$matches[1][0]."</a></b>]";?></span>.
		
		<?
		}
		if($matchcount<1 && $count > 0){
			$pieces = explode("(", $row['Author']);
			//$pieces = explode(".", $pieces[0]);
			//$matches[1][0] = $pieces[0];
			
			?>
			<span class="TitlesBold"><?php if($row['Title']=="") echo "N/A"; else echo $row['Title']; ?></span>.
                        <span class="Books"><?php if($row['Books']=="") echo ""; else echo ("<a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&BookAuthor=".$row['Books'][1].$row['Books'][2]."&BookYear=".$row['Books'][4].$row['Books'][5].$Booksletter."&BookItem=&CategorySearchIn1=painting&CategorySearchIn6=drawing&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn7=watercolor&CategorySearchIn4=sculpture&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn5=ceramic&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=monthday&StartMonth=1&StartDay=1&StartYear=1881&EndMonth=12&EndDay=31&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc>".$row['Books']."</a>"); ?></span>
                        <span class="Exhibitions"><?php if($row['Exhibitions']=="") echo ""; else echo ("<a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&BookAuthor=".$row['Exhibitions'][1].$row['Exhibitions'][2]."&BookYear=".$row['Exhibitions'][4].$row['Exhibitions'][5].$ExhibitedLetter."&BookItem=&CategorySearchIn1=painting&CategorySearchIn6=drawing&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn7=watercolor&CategorySearchIn4=sculpture&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn5=ceramic&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=monthday&StartMonth=1&StartDay=1&StartYear=1881&EndMonth=12&EndDay=31&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc>".$row['Exhibitions']."</a>"); ?></span>
                        <span class="AuthorNoBold">Texts: <?php if($row['Author']=="") echo "N/A"; else echo $pieces[0];echo "(<b><a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=".$c_match[1]."&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&CategorySearchIn1=painting&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn4=sculpture&CategorySearchIn5=ceramic&CategorySearchIn6=drawing&CategorySearchIn7=watercolor&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=year&StartYear=1881&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc>".$c_match[1]."</a></b>)";?></span>.
			
		<?
		}
		if($matchcount<1 && $count < 1) {
			?>
                        <span class="TitlesBold"><?php if($row['Title']=="") echo "N/A"; else echo $row['Title']; ?></span>.
                        <span class="Books"><?php if($row['Books']=="") echo ""; else echo ("<a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&BookAuthor=".$row['Books'][1].$row['Books'][2]."&BookYear=".$row['Books'][4].$row['Books'][5].$Booksletter."&BookItem=&CategorySearchIn1=painting&CategorySearchIn6=drawing&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn7=watercolor&CategorySearchIn4=sculpture&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn5=ceramic&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=monthday&StartMonth=1&StartDay=1&StartYear=1881&EndMonth=12&EndDay=31&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc>".$row['Books']."</a>"); ?></span>
                        <span class="Exhibitions"><?php if($row['Exhibitions']=="") echo ""; else echo ("<a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&BookAuthor=".$row['Exhibitions'][1].$row['Exhibitions'][2]."&BookYear=".$row['Exhibitions'][4].$row['Exhibitions'][5].$ExhibitedLetter."&BookItem=&CategorySearchIn1=painting&CategorySearchIn6=drawing&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn7=watercolor&CategorySearchIn4=sculpture&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn5=ceramic&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=monthday&StartMonth=1&StartDay=1&StartYear=1881&EndMonth=12&EndDay=31&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc>".$row['Exhibitions']."</a>"); ?></span>
			<span class="AuthorNoBold">Texts: <?php if($row['Author']=="") echo "N/A"; else echo $row['Author']; ?></span>.
	    <?
		}		
	  ?>
	  <span class="Catalogs"><?php if($row['Catalogs']=="") echo ""; else echo ("<a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=".$Catalogspart."&Volume1=".$Catalogsvolume."&Number1=&Suffix1=&Catalog2=All&Volume2=".$Catalogsvolume."&Number2=&Suffix2=&BookAuthor=&BookYear=&BookItem=&CategorySearchIn1=painting&CategorySearchIn6=drawing&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn7=watercolor&CategorySearchIn4=sculpture&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn5=ceramic&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=monthday&StartMonth=1&StartDay=1&StartYear=1881&EndMonth=12&EndDay=31&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc>".$row['Catalogs']."</a>"); ?></span>			  
	  <span class="Volume"><?php if($row['Volume']=="") echo "N/A"; else echo $row['Volume']; ?></span>.
	  <span class="Edition"><?php if($row['Edition']=="") echo "N/A"; else echo $row['Edition']; ?></span>.
	  <span class="Publisher"><?php if($row['Publisher']=="") echo "N/A"; else echo $row['Publisher']; ?></span>.
	  <span class="Date"><?php if($row['Date']=="") echo "N/A"; else echo $row['Date']; ?></span>.
	</li></ul></td>
	<?php
	}
	?>
  </tr>
<?php } ?>
</table>
</div>
<!---------------------------- End Reference ---------------------------->
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
