<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class BioSearch extends Database
{
  private $p;
  private $page; // the # of current page
  
  function __construct($param) 
  {
    parent::__construct(); 
	
	$this->p = $param;
	
	$this->page = $param['page'];
  }
    
  public function getData()  //operate on database to get data
  {
    $limitStart = 20*($this->page-1);
	$limitEnd = 20;
	$query = "SELECT SQL_CALC_FOUND_ROWS id,YEAR(dateStart) AS StartYear,MONTH(dateStart) AS StartMonth,DAY(dateStart) AS StartDay,YEAR(dateEnd) AS EndYear,MONTH(dateEnd) AS EndMonth,DAY(dateEnd) AS EndDay,dateDesc,event,commentary, (SELECT COUNT(*) FROM `WRITINGS_POEMS` A WHERE MONTH(A.dateStart) = MONTH(N.dateStart) AND DAY(A.dateStart) = DAY(N.dateStart) AND MONTH(A.dateEnd) = MONTH(N.dateEnd) AND DAY(A.dateEnd) = DAY(N.dateEnd) AND YEAR(A.dateStart) = YEAR(N.dateStart)) AS DatedText, (SELECT COUNT(*) FROM `ARTWORK` A WHERE MONTH(A.dateStart) = MONTH(N.dateStart) AND DAY(A.dateStart) = DAY(N.dateStart) AND MONTH(A.dateEnd) = MONTH(N.dateEnd) AND DAY(A.dateEnd) = DAY(N.dateEnd) AND YEAR(A.dateStart) = YEAR(N.dateStart)) AS DatedArtworks FROM `NARRATIVE` N where ";
	
// === Generate time constraint =======================================================
			if ($this->p['SearchStyle']=="Continuous")
			{
				$startDate = mysql_real_escape_string($this->p['StartYear'])."-";
				$endDate   = mysql_real_escape_string($this->p['EndYear'])."-";

				if ($this->p['SearchBy']=="season")
				{
					$startMonth = $this->getStartSeasonMonth($this->p['StartSeason']);
					$startDay = $this->getStartSeasonDay($this->p['StartSeason']);
					$endMonth = $this->getEndSeasonMonth($this->p['EndSeason']);
					$endDay = $this->getEndSeasonDay($this->p['EndSeason']);
					$endYear = $this->p['EndSeason'] == 4 ? $this->p['EndYear']+1 : mysql_real_escape_string($this->p['EndYear']);
					$start = mysql_real_escape_string($this->p['StartYear']) . "-" . $startMonth . "-" . $startDay;
					$end = $endYear . "-" . $endMonth . "-" . $endDay;
					$excep1 =  $endYear . "-" . "00" . "-" . "00";
					$excep2 =  $endYear . "-" . $endMonth . "-" . "00";
					$sqlConstraint = "dateStart >= '" . $start . "' and dateEnd <= '" . $end . "' and dateEnd != '" . $excep1 . "' and dateEnd != '" . $excep2 . "'";
				}
				else if ($this->p['SearchBy']=="year")
				{
					$sqlConstraint = "YEAR(dateStart) >= '" . mysql_real_escape_string($this->p['StartYear']) . "' AND YEAR(dateEnd) <= '" . mysql_real_escape_string($this->p['EndYear']) . "'";
				}
				else if ($this->p['SearchBy']=="month")
				{
					$year_month_start = $this->p['StartYear'] . "-" . (($this->p['StartMonth']>9) ? $this->p['StartMonth'] : "0".$this->p['StartMonth']);
					$year_month_end = $this->p['EndYear'] . "-" . (($this->p['EndMonth']>9) ? $this->p['EndMonth'] : "0".$this->p['EndMonth']);
					$excepYM =  $this->p['EndYear'] . "-" . "00";
					$sqlConstraint = "date_format(dateStart,'%Y-%m') >= '" . $year_month_start . "' and date_format(dateEnd,'%Y-%m') <= '" . $year_month_end  . "' and date_format(dateEnd,'%Y-%m') != '" . $excepYM . "'";
				}
				else if ($this->p['SearchBy']=="monthday")
				{
					$start = $this->p['StartYear'] . "-" . (($this->p['StartMonth']>9) ? $this->p['StartMonth'] : "0".$this->p['StartMonth']) . "-" . (($this->p['StartDay']>9) ? $this->p['StartDay'] : "0".$this->p['StartDay']);
					$end = $this->p['EndYear'] . "-" . (($this->p['EndMonth']>9) ? $this->p['EndMonth'] : "0".$this->p['EndMonth']) . "-" .(($this->p['EndDay']>9) ? $this->p['EndDay'] : "0".$this->p['EndDay']);
					$excep1 =  $this->p['EndYear'] . "-" ."00" . "-" . "00";
					$excep2 =  $this->p['EndYear'] . "-" . (($this->p['EndMonth']>9) ? $this->p['EndMonth'] : "0".$this->p['EndMonth']) . "-" . "00";
					$sqlConstraint = "dateStart >= '" . $start . "' and dateEnd <= '" . $end . "' and dateEnd != '" .$excep1 . "' and dateEnd != '" . $excep2 . "'";
				}
			}
			else
			{
				if ($this->p['SearchBy']=="season")
				{
					$startMonth = $this->getStartSeasonMonth($this->p['StartSeason']);
					$startDay = $this->getStartSeasonDay($this->p['StartSeason']);
					$endMonth = $this->getEndSeasonMonth($this->p['StartSeason']);
					$endDay = $this->getEndSeasonDay($this->p['StartSeason']);

					$startDate1 = $startMonth . "-" . $startDay;
					$endDate1 = $endMonth . "-" . $endDay;

					if($this->p['StartSeason'] != 4)
						$sqlConstraint = "YEAR(dateStart) >= '" . $this->p['StartYear'] . "' and YEAR(dateEnd) <= '" . $this->p['EndYear'] . "' and date_format(dateStart,'%m-%d') >= '" . $startDate1 . "' and date_format(dateEnd,'%m-%d') <= '" . $endDate1 . "'and YEAR(dateStart) = YEAR(dateEnd)";
					else
					{
						$endYear = $this->p['EndYear'] + 1;
						$startYear = $this->p['StartYear'] + 1;
						$sqlConstraint = "(YEAR(dateStart) >= '" . $this->p['StartYear'] . "' and YEAR(dateStart) <= '" .$this->p['EndYear'] . "' and date_format(dateStart,'%m-%d') >= '" . $startDate1 . "' and datediff(dateEnd,dateStart) <= 88 ) or (YEAR(dateStart) >= '" . $startYear . "' and YEAR(dateEnd) <= '" . $endYear . "' and date_format(dateStart,'%m-%d') >= '01-01' and date_format(dateEnd,'%m-%d') <= '03-20' and YEAR(dateStart) = YEAR(dateEnd))";
					}
				}
				else if ($this->p['SearchBy']=="year")
					$sqlConstraint = "YEAR(dateStart) >= '" . $this->p['StartYear'] . "' AND YEAR(dateEnd) <= '" . $this->p['EndYear'] . "'";
				else if ($this->p['SearchBy']=="month")
					$sqlConstraint = "YEAR(dateStart) >= '" . $this->p['StartYear'] . "' AND YEAR(dateEnd) <= '" . $this->p['EndYear'] . "' and MONTH(dateStart) = '" . $this->p['StartMonth'] . "' and MONTH(dateEnd) = '" . $this->p['StartMonth'] . "'";
				else if ($this->p['SearchBy']=="monthday")
				{
					$md = (($this->p['StartMonth']>9) ? $this->p['StartMonth'] : "0".$this->p['StartMonth']) . "-" . (($this->p['StartDay']>9) ? $this->p['StartDay'] : "0".$this->p['StartDay']);
					$sqlConstraint = "YEAR(dateStart) >= '" . $this->p['StartYear'] . "' AND YEAR(dateEnd) <= '" . $this->p['EndYear'] . "' and date_format(dateStart,'%m-%d') = '" . $md . "' and date_format(dateEnd,'%m-%d') = '" . $md . "'";
				}
			}
			$sqlConstraint = "(".$sqlConstraint.")";
// =======================================================================================================
// ===================== Generate keywords constraints. ==================================================
            $Keywords = mysql_real_escape_string(trim($this->p['Keywords']));
			if ($Keywords!="")
			{
			  $sqlConstraint .= " and (N.id IN (SELECT DISTINCT RW.idNarrative FROM `RLTN_NARR_WORKS` RW WHERE RW.idArtwork IN (SELECT opp FROM `ARTWORK` A WHERE title LIKE '%$Keywords%')) OR N.id IN (SELECT DISTINCT RL.idNarrative FROM `RLTN_NARR_LINKS` RL WHERE RL.idLink IN (SELECT idLink FROM `LINK` L WHERE title LIKE '%$Keywords%')) OR N.id IN 
      (
      SELECT DISTINCT id FROM `NARRATIVE` N WHERE event like concat('%<writing>%',(SELECT distinct mid FROM `WRITINGS_POEMS` WHERE title LIKE '%$Keywords%' limit 0,1),'%</writing>%')
      ) OR N.event like '%$Keywords%')";
			}
// =====================================================================================
// =============== Generate commentary constraints. ==================================================
			if(isset($this->p['Commentaryres']))
			  $sqlConstraint .= " and (length(commentary)>0)";
			else
			{
			  $Keywords = mysql_real_escape_string(trim($this->p['Commentary']));
			  if ($Keywords!="")
			    $sqlConstraint .= " and (N.id IN (SELECT DISTINCT RW.idNarrative FROM `RLTN_NARR_WORKS` RW WHERE RW.idArtwork IN (SELECT opp FROM `ARTWORK` A WHERE title LIKE '%$Keywords%')) OR N.id IN (SELECT DISTINCT RL.idNarrative FROM `RLTN_NARR_LINKS` RL WHERE RL.idLink IN (SELECT idLink FROM `LINK` L WHERE title LIKE '%$Keywords%')) OR N.commentary like '%$Keywords%')";  // a little proble, can't find links inside of commentary
			}
// ==================================================================================
// ===================== Generate sorting order. =========================================================
			$sqlConstraint .= " ORDER BY dateOrder(dateStart,dateStartFlag) ".mysql_real_escape_string($this->p['Sort']).", dateOrder(dateEnd,dateEndFlag) ".mysql_real_escape_string($this->p['Sort']);
// =====================================================================================

    $query .= $sqlConstraint. " limit $limitStart, $limitEnd";
	$result = mysql_query($query);
	//$result = die($query);
	return $result;
  }
  
  
////////////////////////////////////////////////some functions for time constraints//////////////////////////////////////////////////// 
    private function getStartSeasonMonth($season)
	{
		$month = "";
		switch ($season)
		{
			case 0: // early
				$month = "01";
				break;
			case 1:	// Spring
				$month = "03";
				break;
			case 2:	// Summer
				$month = "06";
				break;
			case 3:	// Fall
				$month = "09";
				break;
			case 4:	// Winter
				$month = "12";
		}
		return $month;
	}

	private function getStartSeasonDay($season)
	{
		$day = "";
		switch ($season)
		{
			case 0: // early
				$day = "01";
				break;
			case 1:	// Spring
				$day = "20";
				break;
			case 2:	// Summer
				$day = "21";
				break;
			case 3:	// Fall
				$day = "22";
				break;
			case 4:	// Winter
				$day = "21";
		}
		return $day;
	}

	private function getEndSeasonMonth($season)
	{
		$month = "";
		switch ($season)
		{
			case 0: // early
				$month = "03";
				break;
			case 1:	// Spring
				$month = "06";
				break;
			case 2:	// Summer
				$month = "09";
				break;
			case 3:	// Fall
				$month = "12";
				break;
			case 4:	// Winter
				$month = "03";
		}
		return $month;
	}

	private function getEndSeasonDay($season)
	{
		$day = "";
		switch ($season)
		{
			case 0: // early
				$day = "19";
				break;
			case 1:	// Spring
				$day = "20";
				break;
			case 2:	// Summer
				$day = "21";
				break;
			case 3:	// Fall
				$day = "20";
				break;
			case 4:	// Winter
				$day = "19";
		}
		return $day;
	} 
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  
  
  
  
  public function getTotalNum()
  {
    $result = mysql_query("SELECT FOUND_ROWS()");
	$totalNum = mysql_fetch_row($result);
    return $totalNum[0];
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
  
  public function parseText($text, $year, $page) // the last 2 parameters are for writings
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
	  $htmlLink = "<a href=\"index.php?view=BioWritings&mid=$tagText&year=$year\" class=\"link1\" target=\"_blank\" onclick=\"OpenWin(this.href, 'Writings', 748, 800); return false;\">";
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

   ///////for Overview Biography Search///////////////////
 public function getOverviewBioData() 
   {
    $limitStart = 20*($this->page-1);
	$limitEnd = 20;
	$query = "SELECT SQL_CALC_FOUND_ROWS id,YEAR(dateStart) AS StartYear,MONTH(dateStart) AS StartMonth,DAY(dateStart) AS StartDay,YEAR(dateEnd) AS EndYear,MONTH(dateEnd) AS EndMonth,DAY(dateEnd) AS EndDay,dateDesc,event,commentary, (SELECT COUNT(*) FROM `WRITINGS_POEMS` A WHERE MONTH(A.dateStart) = MONTH(N.dateStart) AND DAY(A.dateStart) = DAY(N.dateStart) AND MONTH(A.dateEnd) = MONTH(N.dateEnd) AND DAY(A.dateEnd) = DAY(N.dateEnd) AND YEAR(A.dateStart) = YEAR(N.dateStart)) AS DatedText, (SELECT COUNT(*) FROM `ARTWORK` A WHERE MONTH(A.dateStart) = MONTH(N.dateStart) AND DAY(A.dateStart) = DAY(N.dateStart) AND MONTH(A.dateEnd) = MONTH(N.dateEnd) AND DAY(A.dateEnd) = DAY(N.dateEnd) AND YEAR(A.dateStart) = YEAR(N.dateStart)) AS DatedArtworks FROM `NARRATIVE` N where ";

			
$sqlStyleConstraint = "";


  for($i=0;$i<$this->p['stylenum'];$i++)
{
  $paraName = "StyleSearch$i";	
  if(isset($this->p[$paraName]))
  {
    $stylename = mysql_real_escape_string($this->p[$paraName]);
	$stylequery = "SELECT dateStart, dateEnd FROM `STYLE` WHERE guidename ='$stylename'";
	$styleresult = mysql_query($stylequery);
	$stylerow = mysql_fetch_array($styleresult);
	$tempstartdate = $stylerow['dateStart'];
	$tempenddate = $stylerow['dateEnd'];
	$tempendyear = substr($tempenddate,0,4);
	$tempendmonth = substr($tempenddate,0,7);
	$excep1 =  $tempendyear . "-" ."00" . "-" . "00"; 
	$excep2 =  $tempendmonth . "-" . "00"; 
    if ($sqlStyleConstraint !="")
	  $sqlStyleConstraint .= "OR (dateStart >= '$tempstartdate' and dateEnd <= '$tempenddate' and dateEnd != '$excep1' and dateEnd != '$excep2')";  
    else
     $sqlStyleConstraint = "dateStart >= '$tempstartdate' and dateEnd <= '$tempenddate' and dateEnd != '$excep1' and dateEnd != '$excep2'";
  }    
}
   if(strlen($sqlStyleConstraint)>0) $sqlStyleConstraint = "($sqlStyleConstraint)";
   $sqlStyleConstraint .= " ORDER BY dateOrder(dateStart,dateStartFlag) asc, dateOrder(dateEnd,dateEndFlag) asc"; 



    $query .= $sqlStyleConstraint. " limit $limitStart, $limitEnd";
	//$query = $excep1.$excep2;
   	$result = mysql_query($query);
	return $result;
		}
public function getPhoto($id)
  {
	  $query = "SELECT DISTINCT id FROM `RLTN_NARR_PHOTO` WHERE id=$id";
	  $result = mysql_query($query);
	  $row = mysql_fetch_array($result);
	  return $row;
   }
   public function getPhoto_D($id)
  {
	  $query = "SELECT path FROM `RLTN_NARR_PHOTO_D` WHERE id=$id";
	  $result = mysql_query($query);
	  return $result;
 }    
 
  public function getOPP_D($id)
  {
	  $query = "SELECT path FROM `RLTN_NARR_WORKS_D` WHERE idNarrative=$id";
	  $result = mysql_query($query);
	  return $result;
 } 
  
} 
?>