 <!---------------------------- this is the bibliography page ---------------------------->
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
<link rel="stylesheet" href=" ./css/ArtworkBibliographyNew.css"/>
<link rel="stylesheet" href="./css/commentary.css"/>
<link rel="stylesheet" href="./css/Reference.css"/>
<script type="text/javascript" src="./js/popup.js"></script>
<script type="text/javascript" src="./js/main.js"></script>
</head>
 
<body>
<?php
require_once(MODULES_PATH.'ArtworkBibliography.php');
$obj = new ArtworkBibliography($_GET['OPPID']);
$result = $obj->getData();
while($row = mysql_fetch_array($result)){ ?>

<?php   $catalog ="OPP";
		$result1 = $obj->getCatalog($row['opp']); foreach($result1 as $cata) {
	  	if(substr($cata,0,3) === "testing")
              {
		}
		elseif(substr($cata,0,3) === " MPP")
              {
		 $catalog.=" MPP";		   	
		}
		elseif(substr($cata,0,3) === "MPM")
              {
	       $catalog.=" MPM";	
		}
		elseif(substr($cata,0,3) === "MPB")
              {
	    $catalog.=" MPB";	
		}
		elseif(substr($cata,0,3) === "MPA")
              {
		$catalog.=" MPA";	
		}
		elseif(substr($cata,0,4) === "PP.L")
              {
		$catalog.=" PP.L";	
		}
		elseif(substr($cata,0,2) === "PP")
              {
		$catalog.=" PP";	
		}
		elseif(substr($cata,0,2) === "GC")
              {
		$catalog.=" GC";	
		}
		elseif(substr($cata,0,2) === "DB")
              {
	    $catalog.=" DB";	
		}
		elseif(substr($cata,0,2) === "DR")
              {
		$catalog.=" DR";	
		}
		elseif(substr($cata,0,2) === "CC")
              {
		$catalog.=" CC";	
		}		
		elseif(substr($cata,0,2) === "Ba")
              {
		$catalog.=" Ba";	
		}
		elseif(substr($cata,0,2) === "AR")
              {
		$catalog.=" AR";	
		}
		elseif(substr($cata,0,2) === "FM")
              {
		$catalog.=" FM";	
		}
		elseif(substr($cata,0,2) === "LD")
              {
		$catalog.=" LD";	
		}
		elseif(substr($cata,0,2) === "WS")
              {
		$catalog.=" WS";	
		}
		elseif(substr($cata,0,1) === "Z")
              {
		$catalog.=" Z";	
		}
		elseif(substr($cata,0,1) === "B")
              {
		$catalog.=" B";	
		}
		elseif(substr($cata,0,1) === "M")
              {
		$catalog.=" M";	
		}
		elseif(substr($cata,0,1) === "C")
              {
		$catalog.=" C";	
		}
	       elseif(substr($cata,0,2) === "PS")
              {
		$catalog.=" PS";	
		}
	       elseif(substr($cata,0,4) === "P.IV")
              {
		$catalog.=" P.IV";	
		}		
	       elseif(substr($cata,0,5) === "P.III")
              {
		$catalog.=" P.III";	
		}
	       elseif(substr($cata,0,4) === "P.II")
              {
		$catalog.=" P.II";	
		}
	       elseif(substr($cata,0,3) === "P.I")
              {
		$catalog.=" P.I";	
		}
	}?> 
<div id="commentaryTable">
<table width="100%"  align="center" border="0">
<tr>
  <td  id="InfoHolder">
    <table class="TabContainer" id="MenuTabs" cellspacing="0" align="center">
      <tr class="Tabs">
       <td class="Active"><img src="./images/magnify-text.png"/>Literature</td>
       <td class="EmptySpace">&nbsp;</td>
      </tr>
	  <tr>
       <td class="Container" colspan="2">
      <?php $books=$obj->sortBooks($row['bookCatalog']);
		   $ref=$obj->getRef($books,$catalog);
		  	while($row = mysql_fetch_array($ref)) { ?>
			<table width="100%" cellpadding="1" cellspacing="0">
  <tr>
    <td width="15" align="left" valign="top" style="border-top:1px dotted silver;"></td>
    <td align="left" valign="top" style="border-top:1px dotted silver;" style="font-size:11px">
	<ul><li>
	<?php 
         if (($row['Books'][6] == ']') or ( $row['Books'][6] == '*')) {
                $Booksletter = ':';
            } else {
                $Booksletter = $row['Books'][6].':';
            }
//	$Booksletter = ($row['Books'][6]==']')?'':$row['Books'][6];
           
            if ($row['Exhibitions'][6]=='*') {
                $ExhibitedLetter = $row['Exhibitions'][6];
            }
            else {
                $ExhibitedLetter = $row['Exhibitions'][6].'*';
            }
//	$Booksletter = ($row['Books'][6]==']')?'':$row['Books'][6];
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
			<span class="Author"><?php if($row['Author']=="") echo "N/A"; else echo $pieces[0]; echo "[<b><a href=index.php?view=ArtworkSearchS&page=1&Keyword1=".$matches[1][0]."&SearchIn1=bookCatalog&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&CategorySearchIn1=painting&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn4=sculpture&CategorySearchIn5=ceramic&CategorySearchIn6=drawing&CategorySearchIn7=watercolor&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=year&StartYear=1881&EndYear=1973&SortBy1=OPP&SortDirection1=Asc&SortBy2=OPP&SortDirection2=Asc&SortBy3=OPP&SortDirection3=Asc target=\"OPPMain\">".$matches[1][0]."</a></b>]";?></span>
			<span class="Author"><?php if($row['Author']=="") echo "N/A"; else echo "(<b><a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=".$c_match[1]."&Volume1=".$volume."&Number1=&Suffix1=&CategorySearchIn1=painting&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn4=sculpture&CategorySearchIn5=ceramic&CategorySearchIn6=drawing&CategorySearchIn7=watercolor&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=year&StartYear=1881&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc target=\"OPPMain\">".$c_match[1].$dot.$c_piece[1]."</a></b>)";?></span>.
		<?
		}

		if($matchcount>0 && $count < 1)
		{
			$item_inside_brackets = $matches[1][0];
	    	$pieces = explode("[", $row['Author']);
			?>
			<span class="Author"><?php if($row['Author']=="") echo "N/A"; else echo $pieces[0]; echo "[<b><a href=index.php?view=ArtworkSearchS&page=1&Keyword1=".$matches[1][0]."&SearchIn1=bookCatalog&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&CategorySearchIn1=painting&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn4=sculpture&CategorySearchIn5=ceramic&CategorySearchIn6=drawing&CategorySearchIn7=watercolor&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=year&StartYear=1881&EndYear=1973&SortBy1=OPP&SortDirection1=Asc&SortBy2=OPP&SortDirection2=Asc&SortBy3=OPP&SortDirection3=Asc target=\"OPPMain\">".$matches[1][0]."</a></b>]";?></span>.
		<?
		}
		if($matchcount<1 && $count > 0){
		    $pieces = explode("(", $row['Author']);
            //$pieces = explode(".", $pieces[0]);
            //$matches[1][0] = $pieces[0];
			?>
			<span class="Author"><?php if($row['Author']=="") echo "N/A"; else echo $pieces[0]; echo "(<b><a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=".$c_match[1]."&Volume1=All&Number1=&Suffix1=&CategorySearchIn1=painting&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn4=sculpture&CategorySearchIn5=ceramic&CategorySearchIn6=drawing&CategorySearchIn7=watercolor&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=year&StartYear=1881&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc target=\"OPPMain\">".$c_match[1]."</a></b>)";?></span>.		
		<?
		}
		if($matchcount < 1 && $count < 1) {
			?>
			<span class="Author"><?php if($row['Author']=="") echo "N/A"; else echo $row['Author']?></span>.
		<?
		}
		?>
		<span class="Books"><?php if($row['Books']=="") echo ""; else echo ("<a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&BookAuthor=".$row['Books'][1].$row['Books'][2]."&BookYear=".$row['Books'][4].$row['Books'][5].$Booksletter."&BookItem=&CategorySearchIn1=painting&CategorySearchIn6=drawing&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn7=watercolor&CategorySearchIn4=sculpture&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn5=ceramic&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=monthday&StartMonth=1&StartDay=1&StartYear=1881&EndMonth=12&EndDay=31&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc target=\"OPPMain\">".$row['Books']."</a>"); ?></span>
		<span class="Exhibitions"><?php if($row['Exhibitions']=="") echo ""; else echo ("<a href=index.php?view=ArtworkSearchS&page=1&Keyword1=".$row['Exhibitions'][1].$row['Exhibitions'][2].$row['Exhibitions'][3].$row['Exhibitions'][4].$row['Exhibitions'][5].$ExhibitedLetter."&SearchIn1=bookCatalog&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=OPP&Volume1=All&Number1=&Suffix1=&Volume2=All&Number2=&Suffix2=&BookAuthor=&BookYear=&BookItem=&CategorySearchIn1=painting&CategorySearchIn6=drawing&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn7=watercolor&CategorySearchIn4=sculpture&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn5=ceramic&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=monthday&StartMonth=1&StartDay=1&StartYear=1881&EndMonth=12&EndDay=31&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc target=\"OPPMain\">".$row['Exhibitions']."</a>");?></span>
                <span class="Catalogs"><?php if($row['Catalogs']=="") echo ""; else echo ("<a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=".$Catalogspart."&Volume1=".$Catalogsvolume."&Number1=&Suffix1=&BookAuthor=&BookYear=&BookItem=&CategorySearchIn1=painting&CategorySearchIn6=drawing&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn7=watercolor&CategorySearchIn4=sculpture&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn5=ceramic&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=monthday&StartMonth=1&StartDay=1&StartYear=1881&EndMonth=12&EndDay=31&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc target=\"OPPMain\">".$row['Catalogs']."</a>"); ?></span>		
		<span class="Titles"><?php if($row['Title']=="") echo "N/A"; else echo $row['Title']; ?></span>.
		<span class="Publisher"><?php if($row['Publisher']=="") echo "N/A"; else echo $row['Publisher']; ?></span>.
	        <span class="Date"><?php if($row['Date']=="") echo "N/A"; else echo $row['Date']; ?></span>.		
		<span class="PageNumber"><?php 
		if($row['Catalogs']!="") {
			$q=substr($row['Catalogs'],1,-1);
			
			if ($q=="P.I") {
				$q="P";
				$v="I";
				$result2 = $obj->getPage($q,$v); foreach($result2 as $page) echo $page;
			}
			else if ($q=="P.II") {
				$q="P";
				$v="II";
				$result2 = $obj->getPage($q,$v); foreach($result2 as $page) echo $page;
			}
			else if ($q=="P.III") {
				$q="P";
				$v="III";
				$result2 = $obj->getPage($q,$v); foreach($result2 as $page) echo $page;
			}
			else if ($q=="P.IV") {
				$q="P";
				$v="IV";
				$result2 = $obj->getPage($q,$v); foreach($result2 as $page) echo $page;
			}
			else if ($q=="PP.L") {
				$q="PP";
				$v="L";
				$result2 = $obj->getPage($q,$v); foreach($result2 as $page) echo $page;
			}
			else if ($q=="OPP") {
				 echo '('.substr($_GET['OPPID'],4).')';
			}
			else  {
            	$result2 = $obj->getVolumePage($q); foreach($result2 as $page) echo $page;
			}
		}	
		else if($row['Books']!="") {
			$q=substr($row['Books'],1,-1);
			$p = strpos($books,$q);
			if ($books[$p+5]==':')$b=$p+6;
			else if ($books[$p+6]==':')$b=$p+7;
				else $b=$p+8;
			$e=$b;	
			while ($e<strlen($books)) {			
				if ($books[$e]==';') { break 1;}
				$e=$e+1;	
			}		
			echo '('.substr($books,$b,$e-$b).')';
	    }
            else if (($row['Exhibitions']!="") && ($row['Books']=="") ){
                        $qEx=substr($row['Exhibitions'],1,-1);
			$pEx = strpos($books,$qEx);
			if ($books[$pEx+6]==':')$bEx=$pEx+7;
			else if ($books[$pEx+7]==':')$bEx=$pEx+8;
				else $bEx=$pEx+9;
			$eEx=$bEx;	
			while ($eEx<strlen($books)) {			
				if ($books[$eEx]==';') { break 1;}
				$eEx=$eEx+1;	
			}		
			echo '('.substr($books,$bEx,$eEx-$bEx).')';
            };
	  ?></span>
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
			
			<span class="Author"><?php if($row['Author']=="") echo "N/A"; else echo $pieces[0]; echo "[<b><a href=index.php?view=ArtworkSearchS&page=1&Keyword1=".$matches[1][0]."&SearchIn1=bookCatalog&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&CategorySearchIn1=painting&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn4=sculpture&CategorySearchIn5=ceramic&CategorySearchIn6=drawing&CategorySearchIn7=watercolor&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=year&StartYear=1881&EndYear=1973&SortBy1=OPP&SortDirection1=Asc&SortBy2=OPP&SortDirection2=Asc&SortBy3=OPP&SortDirection3=Asc target=\"OPPMain\">".$matches[1][0]."</a></b>]"?></span>
			<span class="Author"><?php if($row['Author']=="") echo "N/A"; else echo "(<b><a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=".$c_match[1]."&Volume1=All&Number1=&Suffix1=&CategorySearchIn1=painting&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn4=sculpture&CategorySearchIn5=ceramic&CategorySearchIn6=drawing&CategorySearchIn7=watercolor&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=year&StartYear=1881&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc target=\"OPPMain\">".$c_match[1]."</a></b>)";?></span>.
			
		<?
		}
		
		if($matchcount>0 && $count < 1)
		{
			$item_inside_brackets = $matches[1][0];
			$pieces = explode("[", $row['Author'].$row['Journal']);
			$pieces = explode(".", $pieces[0]);
			
			?>
			<span class="Author"><?php if($row['Author']=="") echo "N/A"; else echo trim($pieces[0])." "; echo "[<b><a href=index.php?view=ArtworkSearchS&page=1&Keyword1=".$matches[1][0]."&SearchIn1=bookCatalog&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&CategorySearchIn1=painting&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn4=sculpture&CategorySearchIn5=ceramic&CategorySearchIn6=drawing&CategorySearchIn7=watercolor&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=year&StartYear=1881&EndYear=1973&SortBy1=OPP&SortDirection1=Asc&SortBy2=OPP&SortDirection2=Asc&SortBy3=OPP&SortDirection3=Asc target=\"OPPMain\">".$matches[1][0]."</a></b>]";?></span>.
		<?
		}
		
		if($matchcount<1 && $count > 0)
		{
			$pieces = explode("(", $row['Author']);
			//$pieces = explode(".", $pieces[0]);
			//$matches[1][0] = $pieces[0];

			?>
			<span class="Author"><?php if($row['Author']=="") echo "N/A"; else echo $pieces[0]; echo "(<b><a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=".$c_match[1]."&Volume1=All&Number1=&Suffix1=&CategorySearchIn1=painting&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn4=sculpture&CategorySearchIn5=ceramic&CategorySearchIn6=drawing&CategorySearchIn7=watercolor&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=year&StartYear=1881&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc target=\"OPPMain\">".$c_match[1]."</a></b>)";?></span>.		
					
		<?
		}
		
		if($matchcount<1 && $count < 1) 
		{
		?>
			<span class="Author"><?php if($row['Author']=="") echo "N/A"; else echo $row['Author']?></span>.
			
		<?
		}
	  ?>
	  
	  <span class="Books"><?php if($row['Books']=="") echo ""; else echo ("<a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&BookAuthor=".$row['Books'][1].$row['Books'][2]."&BookYear=".$row['Books'][4].$row['Books'][5].$Booksletter."&BookItem=&CategorySearchIn1=painting&CategorySearchIn6=drawing&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn7=watercolor&CategorySearchIn4=sculpture&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn5=ceramic&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=monthday&StartMonth=1&StartDay=1&StartYear=1881&EndMonth=12&EndDay=31&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc target=\"OPPMain\">".$row['Books']."</a>"); ?></span>
	  <span class="Exhibitions"><?php if($row['Exhibitions']=="") echo ""; else echo ("<a href=index.php?view=ArtworkSearchS&page=1&Keyword1=".$row['Exhibitions'][1].$row['Exhibitions'][2].$row['Exhibitions'][3].$row['Exhibitions'][4].$row['Exhibitions'][5].$ExhibitedLetter."&SearchIn1=bookCatalog&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=OPP&Volume1=All&Number1=&Suffix1=&Volume2=All&Number2=&Suffix2=&BookAuthor=&BookYear=&BookItem=&CategorySearchIn1=painting&CategorySearchIn6=drawing&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn7=watercolor&CategorySearchIn4=sculpture&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn5=ceramic&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=monthday&StartMonth=1&StartDay=1&StartYear=1881&EndMonth=12&EndDay=31&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc target=\"OPPMain\">".$row['Exhibitions']."</a>");?></span>
          <span class="Catalogs"><?php if($row['Catalogs']=="") echo ""; else echo ("<a index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=".$Catalogspart."&Volume1=".$Catalogsvolume."&Number1=&Suffix1=&BookAuthor=&BookYear=&BookItem=&CategorySearchIn1=painting&CategorySearchIn6=drawing&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn7=watercolor&CategorySearchIn4=sculpture&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn5=ceramic&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=monthday&StartMonth=1&StartDay=1&StartYear=1881&EndMonth=12&EndDay=31&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc target=\"OPPMain\">".$row['Catalogs']."</a>"); ?></span>		
	  <span class="Title"><?php if($row['Title']=="") echo "N/A"; else echo $row['Title']; ?></span>.
	  <span class="Journal"><?php if($row['Journal']=="") echo "N/A"; else echo $row['Journal']; ?></span>.
	  <span class="Issue"><?php if($row['Issue']=="") echo "N/A"; else echo $row['Issue']; ?></span>.
          <span class="Date"><?php if($row['Date']=="") echo "N/A"; else echo $row['Date']; ?></span>.
	  <span class="PageNumber"><?php 
		if($row['Catalogs']!="") {
			$q=substr($row['Catalogs'],1,-1);
			
			if ($q=="P.I") {
				$q="P";
				$v="I";
				$result2 = $obj->getPage($q,$v); foreach($result2 as $page) echo $page;
			}
			else if ($q=="P.II") {
				$q="P";
				$v="II";
				$result2 = $obj->getPage($q,$v); foreach($result2 as $page) echo $page;
			}
			else if ($q=="P.III") {
				$q="P";
				$v="III";
				$result2 = $obj->getPage($q,$v); foreach($result2 as $page) echo $page;
			}
			else if ($q=="P.IV") {
				$q="P";
				$v="IV";
				$result2 = $obj->getPage($q,$v); foreach($result2 as $page) echo $page;
			}
			else if ($q=="OPP") {
				 echo '('.substr($_GET['OPPID'],4).')';
			}
			else  {
            	$result2 = $obj->getVolumePage($q); foreach($result2 as $page) echo $page;
			}
		}	
		else if($row['Books']!="") {
			$q=substr($row['Books'],1,-1);
			$p = strpos($books,$q);
			if ($books[$p+5]==':')$b=$p+6;
			else if ($books[$p+6]==':')$b=$p+7;
				else $b=$p+8;
			$e=$b;	
			while ($e<strlen($books)) {			
				if ($books[$e]==';') { break 1;}
				$e=$e+1;	
			}		
			echo '('.substr($books,$b,$e-$b).')';
	    }
                    else if (($row['Exhibitions']!="") && ($row['Books']=="") ){
                        $qEx=substr($row['Exhibitions'],1,-1);
			$pEx = strpos($books,$qEx);
			if ($books[$pEx+6]==':')$bEx=$pEx+7;
			else if ($books[$pEx+7]==':')$bEx=$pEx+8;
				else $bEx=$pEx+9;
			$eEx=$bEx;	
			while ($eEx<strlen($books)) {			
				if ($books[$eEx]==';') { break 1;}
				$eEx=$eEx+1;	
			}		
			echo '('.substr($books,$bEx,$eEx-$bEx).')';
            };
	  ?></span>
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
			<span class="Author"><?php if($row['Author']=="") echo "N/A"; else echo $pieces[0]; echo "[<b><a href=index.php?view=ArtworkSearchS&page=1&Keyword1=".$matches[1][0]."&SearchIn1=bookCatalog&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&CategorySearchIn1=painting&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn4=sculpture&CategorySearchIn5=ceramic&CategorySearchIn6=drawing&CategorySearchIn7=watercolor&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=year&StartYear=1881&EndYear=1973&SortBy1=OPP&SortDirection1=Asc&SortBy2=OPP&SortDirection2=Asc&SortBy3=OPP&SortDirection3=Asc target=\"OPPMain\">".$matches[1][0]."</a></b>]"?></span>
			<span class="Author"><?php if($row['Author']=="") echo "N/A"; else echo "(<b><a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=".$c_match[1]."&Volume1=All&Number1=&Suffix1=&CategorySearchIn1=painting&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn4=sculpture&CategorySearchIn5=ceramic&CategorySearchIn6=drawing&CategorySearchIn7=watercolor&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=year&StartYear=1881&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc target=\"OPPMain\">".$c_match[1]."</a></b>)";?></span>.
			
		<?
		}
		if($matchcount>0 && $count < 1){
			$item_inside_brackets = $matches[1][0];
			$pieces = explode("[", $row['Author']);
			$pieces = explode(".", $pieces[0]);
			
			?>
			<span class="Author"><?php if($row['Author']=="") echo "N/A"; else echo $pieces[0]; echo "[<b><a href=index.php?view=ArtworkSearchS&page=1&Keyword1=".$matches[1][0]."&SearchIn1=bookCatalog&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&Catalog2=All&Volume2=All&Number2=&Suffix2=&CategorySearchIn1=painting&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn4=sculpture&CategorySearchIn5=ceramic&CategorySearchIn6=drawing&CategorySearchIn7=watercolor&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=year&StartYear=1881&EndYear=1973&SortBy1=OPP&SortDirection1=Asc&SortBy2=OPP&SortDirection2=Asc&SortBy3=OPP&SortDirection3=Asc target=\"OPPMain\">".$matches[1][0]."</a></b>]";?></span>.
		
		<?
		}
		if($matchcount<1 && $count > 0){
			$pieces = explode("(", $row['Author']);
			//$pieces = explode(".", $pieces[0]);
			//$matches[1][0] = $pieces[0];
			
			?>
			<span class="Author"><?php if($row['Author']=="") echo "N/A"; else echo $pieces[0];echo "(<b><a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=".$c_match[1]."&Volume1=All&Number1=&Suffix1=&CategorySearchIn1=painting&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn4=sculpture&CategorySearchIn5=ceramic&CategorySearchIn6=drawing&CategorySearchIn7=watercolor&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=year&StartYear=1881&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc target=\"OPPMain\">".$c_match[1]."</a></b>)";?></span>.
			
		<?
		}
		if($matchcount<1 && $count < 1) {
			?>
			<span class="Author"><?php if($row['Author']=="") echo "N/A"; else echo $row['Author']; ?></span>.
	    <?
		}		
	  ?>
	  <span class="Books"><?php if($row['Books']=="") echo ""; else echo ("<a href=index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=All&Volume1=All&Number1=&Suffix1=&BookAuthor=".$row['Books'][1].$row['Books'][2]."&BookYear=".$row['Books'][4].$row['Books'][5].$Booksletter."&BookItem=&CategorySearchIn1=painting&CategorySearchIn6=drawing&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn7=watercolor&CategorySearchIn4=sculpture&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn5=ceramic&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=monthday&StartMonth=1&StartDay=1&StartYear=1881&EndMonth=12&EndDay=31&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc target=\"OPPMain\">".$row['Books']."</a>"); ?></span>
	  <span class="Exhibitions"><?php if($row['Exhibitions']=="") echo ""; else echo ("<a href=index.php?view=ArtworkSearchS&page=1&Keyword1=".$row['Exhibitions'][1].$row['Exhibitions'][2].$row['Exhibitions'][3].$row['Exhibitions'][4].$row['Exhibitions'][5].$ExhibitedLetter."&SearchIn1=bookCatalog&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=OPP&Volume1=All&Number1=&Suffix1=&Volume2=All&Number2=&Suffix2=&BookAuthor=&BookYear=&BookItem=&CategorySearchIn1=painting&CategorySearchIn6=drawing&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn7=watercolor&CategorySearchIn4=sculpture&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn5=ceramic&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=monthday&StartMonth=1&StartDay=1&StartYear=1881&EndMonth=12&EndDay=31&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc target=\"OPPMain\">".$row['Exhibitions']."</a>");?></span>
          <span class="Catalogs"><?php if($row['Catalogs']=="") echo ""; else echo ("<a index.php?view=ArtworkSearchS&page=1&Keyword1=&SearchIn1=Title&Keyword2=&SearchIn2=Title&Keyword3=&SearchIn3=Title&Keyword4=&SearchIn4=Title&Keyword5=&SearchIn5=Title&Keyword6=&SearchIn6=Title&Keyword7=&SearchIn7=Title&AuctionKeyword1=&AuctionSearchIn1=saletitle&AuctionKeyword2=&AuctionSearchIn2=saletitle&AuctionKeyword3=&AuctionSearchIn3=saletitle&AuctionKeyword4=&AuctionSearchIn4=saletitle&AuctionKeyword5=&AuctionSearchIn5=saletitle&AuctionKeyword6=&AuctionSearchIn6=saletitle&AuctionKeyword7=&AuctionSearchIn7=saletitle&Commentary=&Catalog1=".$Catalogspart."&Volume1=".$Catalogsvolume."&Number1=&Suffix1=&BookAuthor=&BookYear=&BookItem=&CategorySearchIn1=painting&CategorySearchIn6=drawing&CategorySearchIn8=gouache&CategorySearchIn9=pastel&CategorySearchIn7=watercolor&CategorySearchIn4=sculpture&CategorySearchIn2=collage&CategorySearchIn3=photograph&CategorySearchIn10=engraving&CategorySearchIn11=lithograph&CategorySearchIn5=ceramic&CategorySearchIn12=other&SearchStyle=Continuous&SearchBy=monthday&StartMonth=1&StartDay=1&StartYear=1881&EndMonth=12&EndDay=31&EndYear=1973&SortBy1=OPP&CatalogSort1=AR&SortDirection1=Asc&SortBy2=OPP&CatalogSort2=AR&SortDirection2=Asc&SortBy3=OPP&CatalogSort3=AR&SortDirection3=Asc target=\"OPPMain\">".$row['Catalogs']."</a>"); ?></span>		
	  <span class="Title"><?php if($row['Title']=="") echo "N/A"; else echo $row['Title']; ?></span>.
	  <span class="Volume"><?php if($row['Volume']=="") echo "N/A"; else echo $row['Volume']; ?></span>.
	  <span class="Edition"><?php if($row['Edition']=="") echo "N/A"; else echo $row['Edition']; ?></span>.
	  <span class="Publisher"><?php if($row['Publisher']=="") echo "N/A"; else echo $row['Publisher']; ?></span>.
	  <span class="Date"><?php if($row['Date']=="") echo "N/A"; else echo $row['Date']; ?></span>.
	  <span class="PageNumber"><?php 
		if($row['Catalogs']!="") {
			$q=substr($row['Catalogs'],1,-1);
			
			if ($q=="P.I") {
				$q="P";
				$v="I";
				$result2 = $obj->getPage($q,$v); foreach($result2 as $page) echo $page;
			}
			else if ($q=="P.II") {
				$q="P";
				$v="II";
				$result2 = $obj->getPage($q,$v); foreach($result2 as $page) echo $page;
			}
			else if ($q=="P.III") {
				$q="P";
				$v="III";
				$result2 = $obj->getPage($q,$v); foreach($result2 as $page) echo $page;
			}
			else if ($q=="P.IV") {
				$q="P";
				$v="IV";
				$result2 = $obj->getPage($q,$v); foreach($result2 as $page) echo $page;
			}
			else if ($q=="OPP") {
				 echo '('.substr($_GET['OPPID'],4).')';
			}
			else  {
            	$result2 = $obj->getVolumePage($q); foreach($result2 as $page) echo $page;
			}
		}	
		else if ($row['Books']!="") {
			$q=substr($row['Books'],1,-1);
			$p = strpos($books,$q);
			if ($books[$p+5]==':')$b=$p+6;
			else if ($books[$p+6]==':')$b=$p+7;
				else $b=$p+8;
			$e=$b;	
			while ($e<strlen($books)) {			
				if ($books[$e]==';') { break 1;}
				$e=$e+1;	
			}		
			echo '('.substr($books,$b,$e-$b).')';
	    }
               else if (($row['Exhibitions']!="") && ($row['Books']=="") ){
                        $qEx=substr($row['Exhibitions'],1,-1);
			$pEx = strpos($books,$qEx);
			if ($books[$pEx+6]==':')$bEx=$pEx+7;
			else if ($books[$pEx+7]==':')$bEx=$pEx+8;
				else $bEx=$pEx+9;
			$eEx=$bEx;	
			while ($eEx<strlen($books)) {			
				if ($books[$eEx]==';') { break 1;}
				$eEx=$eEx+1;	
			}		
			echo '('.substr($books,$bEx,$eEx-$bEx).')';
            };
	  ?></span>
	<?php
	}
	?>
	</li></ul>
		
</td></tr>
	</table>	
  
<?php }  }?>  
</td></tr></table>
</td></tr></table>
</div>
</body>
</html>