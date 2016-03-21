<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');

class MasterCommentary extends Database
{
  private $masterID;
  
  function __construct($masterID) 
  {
    parent::__construct(); 
	
    $this->masterID = mysql_real_escape_string($masterID);
  }
    
  public function getData()  //operate on database to get data
  {
	$query = "SELECT commentary FROM `MASTERARTWORK` WHERE masteropp = '$this->masterID'";
	$result = mysql_query($query);
	return $result;
  }
  
  public function parseText($text)
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
  
} 
?>
