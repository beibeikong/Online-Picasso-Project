<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');

class BioResourcePreview
{
  
  function __construct() 
  {
  }
  public function generateImgViewer($photoFileName, $thumbnailFileName)
  {
    //  <photo photoFileName="../WorksInfo?CatID=OPP.02:014" thumbnailFileName="../graphics/1902/xthumbs/xopp02-014.jpg">
	if(strpos($photoFileName, "WorksInfo")!==FALSE) // the format above
	{
	  $year = substr($thumbnailFileName, 12, 4);
	  $jpgPos = strpos($thumbnailFileName, "jpg")-1;
	  $imgNameLength = $jpgPos - 26;
	  $imgName = substr($thumbnailFileName, 26, $imgNameLength);
	  $link = "href=\"index.php?view=zoom&img=$imgName&year=$year\" target=\"_blank\" onclick=\"OpenWin(this.href, 'ArtworkZoom', 850, 600); return false;\"";
	}
	else
	{
	  $imgName = substr($photoFileName, 2);
	  
	  $link = "href=\"index.php?view=BioPhotoZoom&img=$imgName\" target=\"_blank\" onclick=\"OpenWin(this.href, 'BioZoom', 850, 650); return false;\"";
    
	}
	
 
    return $link;
  }	


  
  public function parseText1($text)
  {
	$text = str_replace("<entry title=\"Text\">", "", $text);
	$text = str_replace("</entry>", "", $text);
	
	// parse <artwork>
	while($startPosition = strpos($text, "<artwork>"))
	{
	  $endPosition = strpos($text, "</artwork>");
	  $tagLength = $endPosition - $startPosition - 9;
	  $tagText = trim(substr($text,$startPosition+9, $tagLength));  // $tagText is the text between <artwork> and </artwork>
	  
	  $query = "SELECT title FROM `ARTWORK` WHERE opp = '$tagText'";
	  $result = mysql_query($query);
	  $row = mysql_fetch_array($result);
	  $htmlLink = "<a href=\"index.php?view=ArtworkInfo&OPPID=$tagText\" class=\"link1\" target=\"_blank\" onclick=\"OpenWin(this.href, 'ArtworkInfo', 740, 427); return false;\">";
	  $htmlText = $htmlLink.$row['title']."</a>"."&nbsp;[".$htmlLink.$tagText."</a>"."]";
	  
	  $text = str_replace("<artwork>".$tagText."</artwork>", $htmlText, $text);
	}
	
	// parse <writing>
	while($startPosition = strpos($text, "<writing>"))
	{
	  $endPosition = strpos($text, "</writing>");
	  $tagLength = $endPosition - $startPosition - 9;
	  $tagText = trim(substr($text,$startPosition+9, $tagLength));  // $tagText is the text between <writing> and </writing>
	  
	  $query = "SELECT title,YEAR(dateStart) as year FROM `WRITINGS_POEMS` WHERE mid = $tagText";
	  $result = mysql_query($query);
	  $row = mysql_fetch_array($result);
	  $htmlLink = "<a href=\"index.php?view=WritingsInfo&mid=$tagText&year=$row[year]\" class=\"link1\" target=\"OPPMain\">";
	  $htmlText = "<span style=\"color:maroon\">\"</span>".$htmlLink.$row['title']."</a><span style=\"color:maroon\">\"</span>";
	  
	  $text = str_replace("<writing>".$tagText."</writing>", $htmlText, $text);
	}	
	
	// parse <linkId>
	while($startPosition = strpos($text, "<linkId>"))
	{
	  $endPosition = strpos($text, "</linkId>");
	  $tagLength = $endPosition - $startPosition - 8;
	  $tagText = trim(substr($text,$startPosition+8, $tagLength));  // $tagText is the text between <linkId> and </linkId>
	  
	  $query = "SELECT title,URL FROM `LINK` WHERE idLink = $tagText";
	  $result = mysql_query($query);
	  $row = mysql_fetch_array($result);
	  
	  // start parse URL
	  if($startPosition = strpos($row['URL'], "OPP%/"))
	  {
		$URL = str_replace("%OPP%/BioResource?","index.php?view=BioResource&",$row['URL']);
	  }
	  else
	    $URL = $row['URL'];
      // End parse URL
	  
	  $htmlLink = "<a href=\"$URL\" class=\"link1\" target=\"_blank\" onclick=\"OpenWin(this.href, 'BioSource', 670, 427); return false;\">";
	  $htmlText = $htmlLink.$row['title']."</a>";
	  
	  $text = str_replace("<linkId>".$tagText."</linkId>", $htmlText, $text);
	}

	
	
	return $text;
  }
  
  public function getTitle($s)
  {
    $start = strpos($s,"\">")+2;
	$end = strripos($s, "</photo>");
	$text = substr($s,$start,$end-$start);

    $text = str_replace("?id=","index.php?view=BioResource&id=",$text);
	
	return $text;
  }
  
} 
?>
