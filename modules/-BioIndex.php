<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class BioIndex extends Database
{
  private $year;
  private $page; // the # of current page
  private $quarter;
  
  function __construct($param) 
  {
    parent::__construct(); 
	$this->year = mysql_escape_string($param['year']);

	if(isset($param['quarter']))
	  $this->quarter = mysql_real_escape_string($param['quarter']);
	else
      $this->quarter = 1;
	
	if(isset($param['page']))
	  $this->page = $param['page'];
	else
	  $this->page = 1;
  }
    
  public function getData()  //operate on database to get data
  {
    $limitStart = 20*($this->page-1);
	$limitEnd = 20;
	$query = "SELECT SQL_CALC_FOUND_ROWS id,YEAR(dateStart) AS StartYear,MONTH(dateStart) AS StartMonth,DAY(dateStart) AS StartDay,YEAR(dateEnd) AS EndYear,MONTH(dateEnd) AS EndMonth,DAY(dateEnd) AS EndDay,dateDesc,event,commentary,photo, (SELECT COUNT(*) FROM `WRITINGS_POEMS` A WHERE MONTH(A.dateStart) = MONTH(N.dateStart) AND DAY(A.dateStart) = DAY(N.dateStart) AND MONTH(A.dateEnd) = MONTH(N.dateEnd) AND DAY(A.dateEnd) = DAY(N.dateEnd) AND YEAR(A.dateStart) = YEAR(N.dateStart)) AS DatedText, (SELECT COUNT(*) FROM `ARTWORK` A WHERE MONTH(A.dateStart) = MONTH(N.dateStart) AND DAY(A.dateStart) = DAY(N.dateStart) AND MONTH(A.dateEnd) = MONTH(N.dateEnd) AND DAY(A.dateEnd) = DAY(N.dateEnd) AND YEAR(A.dateStart) = YEAR(N.dateStart)) AS DatedArtworks FROM `NARRATIVE` N WHERE YEAR(dateStart) = $this->year AND BiographyQuarter(dateStart, dateStartFlag) = $this->quarter ORDER BY dateOrder(dateStart,dateStartFlag) ASC, dateOrder(dateEnd,dateEndFlag) ASC limit $limitStart, $limitEnd" ;
	$result = mysql_query($query);
	//$result = die($query);
	return $result;
  }
  
  public function getTotalNum()
  {
    $result = mysql_query("SELECT FOUND_ROWS()");
	$totalNum = mysql_fetch_row($result);
    return $totalNum[0];
  }
  
  
  public function parseText($text, $year, $quarter, $page) // the last 3 parameters are for writings
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
	  $htmlLink = "<a href=\"index.php?view=ArtworkInfo&OPPID=$tagText\" class=\"link1\" target=\"_blank\" onclick=\"OpenWin(this.href, 'ArtworkInfo', 740, 550); return false;\">";
	  $htmlText = $htmlLink."<i>".$row['title']."</i> [".$tagText."]</a>";
	  
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
	  $htmlLink = "<a href=\"index.php?view=BioWritings&mid=$tagText&year=$year&quarter=$quarter&page=$page\" class=\"link1\" target=\"OPPMain\">";
	  $htmlText = $htmlLink."<i>".$row['title']."</i></a>";
	  
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
	  
	  $htmlLink = "<a href=\"$URL\" class=\"link1\" target=\"_blank\" onclick=\"OpenWin(this.href, 'BioSource', 940, 680); return false;\">";
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

  public function parsePhotoName($fileName)   //get rid of the file type from file name, eg., from oppf19-003.jpg to oppf19-003
  {
	$cleanFileName = substr($fileName, 0, strrpos($fileName, "."));  //get the file name without file type
	 return $cleanFileName;
  }

} 
?>