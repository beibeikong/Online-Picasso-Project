<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class BioEvent extends Database
{
  
  function __construct() 
  {
    parent::__construct(); 
  }
  
  public function getAcceptedTitle($title)
  // get Accepted title with(information) but without [Alternat Title]
  {
  	if (strpos($title, "[")==FALSE)
		return trim($title);
	else 
	{	
  		if(strpos($title, "(")==FALSE)
		{
	 		$length = strpos($title, "[");
			return trim(substr($title,0,$length));
		}
		else 
		{
			if (strpos($title, "[")< strpos($title, "(")) 
				return trim(substr($title, 0, strpos($title, "[")));
			else 
			{
	  			$sub=$title;
				while(strpos($sub, "(")!==FALSE AND strpos($sub, "[")> strpos($sub, "("))
				{
				$endPosition = strpos($sub, ")");	
				$sub =substr($sub,$endPosition+1);
				if(strpos($sub, "[")==FALSE) return trim($title);
				}
				$sub=substr($sub,strpos($sub,"["));
				return trim(str_replace($sub,'',$title));
			}	
	  	}
	 }
  }
  
  public function parseTextTM($text)
  {
	
	// parse <artwork>
	while(strpos($text, "<artwork>")!==FALSE)
	{
	  $startPosition = strpos($text, "<artwork>");
	  $endPosition = strpos($text, "</artwork>");
	  $tagLength = $endPosition - $startPosition - 9;
	  $tagText = trim(substr($text,$startPosition+9, $tagLength));  // $tagText is the text between <artwork> and </artwork>
	  
	  $query = "SELECT title FROM `ARTWORK` WHERE opp = '$tagText'";
	  $result = mysql_query($query);
	  $row = mysql_fetch_array($result);
	  $acceptedtitle = $this->getAcceptedTitle($row['title']);
	  $htmlLink = "<a href=\"index.php?view=ArtworkInfo&OPPID=$tagText\" class=\"link1\" target=\"_blank\" onclick=\"OpenWin(this.href, 'ArtworkInfo', 740, 550); return false;\">";
	  $htmlText = $htmlLink."<i>".$acceptedtitle."</i></a>";
	  
	  $text = str_replace("<artwork>".$tagText."</artwork>", $htmlText, $text);
	}
	return $text;
  }
  
  public function parseText($text) // the last 3 parameters are for writings
  {
	if(strpos($text, "<p>")===0)
	{
	  $text = substr($text, 3);
	}
	
	$text = str_ireplace("</artisticPeriod>","</span>","$text");
	$text = str_ireplace("<artisticPeriod>","<span class=\"artisticPeriod\">","$text");
	$text = str_ireplace("</changeLocation>","</span>","$text");
	$text = str_ireplace("<changeLocation>","<span class=\"changeLocation\">","$text");
	$text = str_ireplace("</yearPastCategory>","</span>","$text");
	$text = str_ireplace("<yearPastCategory>","<span class=\"yearPastCategory\">","$text");
	$text = str_ireplace("</PicassoQuote>","</span>","$text");
	$text = str_ireplace("<PicassoQuote>","<span class=\"PicassoQuote\">","$text");
	
	// parse <artwork>
	while(strpos($text, "<artwork>")!==FALSE)
	{
	  $startPosition = strpos($text, "<artwork>");
	  $endPosition = strpos($text, "</artwork>");
	  $tagLength = $endPosition - $startPosition - 9;
	  $tagText = trim(substr($text,$startPosition+9, $tagLength));  // $tagText is the text between <artwork> and </artwork>	  	  
	  $query = "SELECT title FROM `ARTWORK` WHERE opp = '$tagText'";
	  $result = mysql_query($query);
	  $row = mysql_fetch_array($result);
	  $acceptedtitle = $this->getAcceptedTitle($row['title']);
	  
	  while(strpos($acceptedtitle, "<artwork>")!==FALSE)
	  {	
	  	$innerstartPosition = strpos($acceptedtitle, "<artwork>");
	  	$innerendPosition = strpos($acceptedtitle, "</artwork>");
	  	$innertagLength = $innerendPosition - $innerstartPosition - 9;
	  	$innertagText = trim(substr($acceptedtitle,$innerstartPosition+9, $innertagLength));  // $tagText is the text between <artwork> and </artwork>
	  
	  	$query = "SELECT title FROM `ARTWORK` WHERE opp = '$innertagText'";
	    $result = mysql_query($query);
	    $row = mysql_fetch_array($result);
	  	$inneracceptedtitle = $this->getAcceptedTitle($row['title']);
		$acceptedtitle = trim(str_replace("<artwork>".$innertagText."</artwork>", $inneracceptedtitle, $acceptedtitle));
	  }
	  	$htmlLink = "<a href=\"index.php?view=ArtworkInfo&OPPID=$tagText\" class=\"link1\" target=\"_blank\" onclick=\"OpenWin(this.href, 'ArtworkInfo', 740, 550); return false;\">";
	 	 $htmlText = "<i>".$acceptedtitle."</i>&nbsp". $htmlLink."[".$tagText."]</a>";
	
	  $text = str_replace("<artwork>".$tagText."</artwork>", $htmlText, $text);
	}
	
	// parse <year>
	while(strpos($text, "<year>")!==FALSE)
	{
	  $startPosition = strpos($text, "<year>");
	  
	  $endPosition = strpos($text, "</year>");
	  $tagLength = 4;
	  $tagText = trim(substr($text,$startPosition+6, $tagLength));  // $tagText is the text between <year> and </year>
	  

	  $htmlLink = "<a href=\"index.php?view=BioIndex&year=$tagText&quarter=1\" class=\"link1\" target=\"OPPMain\">";
	  $htmlText = $htmlLink.$tagText."</a>";
	  
	  $text = str_replace("<year>".$tagText."</year>", $htmlText, $text);
	}

	// parse <writing>
	while($startPosition = strpos($text, "<writing>"))
	{
	  $endPosition = strpos($text, "</writing>");
	  $tagLength = $endPosition - $startPosition - 9;
	  $tagText = trim(substr($text,$startPosition+9, $tagLength));  // $tagText is the text between <writing> and </writing>
	  
	  $query = "SELECT title FROM `WRITINGS_POEMS` WHERE mid = $tagText";
	  $result = mysql_query($query);
	  $row = mysql_fetch_array($result);
	  $htmlLink = "<a href=\"index.php?view=BioWritings&mid=$tagText\" class=\"link1\" target=\"OPPMain\">";
	  $htmlText = "<span style=\"color:maroon\">\"</span>".$htmlLink.$row['title']."</a><span style=\"color:maroon\">\"</span>";
	  
	  $text = str_replace("<writing>".$tagText."</writing>", $htmlText, $text);
	}	
	// parse <linkId>
	while(strpos($text, "<linkId>")!==FALSE)
	{
	  $startPosition = strpos($text, "<linkId>");
	  
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
	  
	  $htmlLink = "<a href=\"$URL\" class=\"link1\" target=\"_blank\" onclick=\"OpenWin(this.href, 'BioSource', 740, 580); return false;\">";
	  $htmlText = $htmlLink.$row['title']."</a>";
	  
	  $text = str_replace("<linkId>".$tagText."</linkId>", $htmlText, $text);
	}

	return $text;
  }  
  
  public function getWritings($StartYear,$StartMonth,$StartDay,$EndYear,$EndMonth,$EndDay)
  {
  	 $query = "SELECT mid from `WRITINGS_POEMS` WHERE YEAR(dateStart)=$StartYear and MONTH(dateStart) = $StartMonth AND DAY(dateStart) = $StartDay AND YEAR(dateEnd)=$EndYear and MONTH(dateEnd) = $EndMonth AND DAY(dateEnd) = $EndDay" ;
	 $result = mysql_query($query);
	 return $result;
  }



} 
?>