<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class FormerCollecArtworkSearch extends Database
{
  private $p;
  private $page; // the # of current page
  private $total;
  
  function __construct($param) 
  {
    parent::__construct(); 
	
	$this->p = $param;
	$this->page = $param['page'];
  }
  
  
    
  public function getData()  //operate on database to get data
  {
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
					$endYear = $this->p['EndSeason'] == 4 ? $this->p['EndYear']+1 : $this->p['EndYear'];
					$start = $this->p['StartYear'] . "-" . $startMonth . "-" . $startDay;
					$end = $endYear . "-" . $endMonth . "-" . $endDay;
					$excep1 =  $endYear . "-" . "00" . "-" . "00";
					$excep2 =  $endYear . "-" . $endMonth . "-" . "00";
					$sqlTimeConstraint = "dateStart >= '" . $start . "' and dateEnd <= '" . $end . "' and dateEnd != '" . $excep1 . "' and dateEnd != '" . $excep2 . "'";
				}
				else if ($this->p['SearchBy']=="year")
				{
					$sqlTimeConstraint = "YEAR(dateStart) >= '" . $this->p['StartYear'] . "' AND YEAR(dateEnd) <= '" . $this->p['EndYear'] . "'";
					
				}
				else if ($this->p['SearchBy']=="month")
				{
					$year_month_start = $this->p['StartYear'] . "-" . (($this->p['StartMonth']>9) ? $this->p['StartMonth'] : "0".$this->p['StartMonth']);
					$year_month_end = $this->p['EndYear'] . "-" . (($this->p['EndMonth']>9) ? $this->p['EndMonth'] : "0".$this->p['EndMonth']);
					$excepYM =  $this->p['EndYear'] . "-" . "00";
					$sqlTimeConstraint = "date_format(dateStart,'%Y-%m') >= '" . $year_month_start . "' and date_format(dateEnd,'%Y-%m') <= '" . $year_month_end  . "' and date_format(dateEnd,'%Y-%m') != '" . $excepYM . "'";
				}
				else if ($this->p['SearchBy']=="monthday")
				{
					$start = $this->p['StartYear'] . "-" . (($this->p['StartMonth']>9) ? $this->p['StartMonth'] : "0".$this->p['StartMonth']) . "-" . (($this->p['StartDay']>9) ? $this->p['StartDay'] : "0".$this->p['StartDay']);
					$end = $this->p['EndYear'] . "-" . (($this->p['EndMonth']>9) ? $this->p['EndMonth'] : "0".$this->p['EndMonth']) . "-" .(($this->p['EndDay']>9) ? $this->p['EndDay'] : "0".$this->p['EndDay']);
					$excep1 =  $this->p['EndYear'] . "-" ."00" . "-" . "00";
					$excep2 =  $this->p['EndYear'] . "-" . (($this->p['EndMonth']>9) ? $this->p['EndMonth'] : "0".$this->p['EndMonth']) . "-" . "00";
					$sqlTimeConstraint = "dateStart >= '" . $start . "' and dateEnd <= '" . $end . "' and dateEnd != '" .$excep1 . "' and dateEnd != '" . $excep2 . "'";
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
						$sqlTimeConstraint = "YEAR(dateStart) >= '" . $this->p['StartYear'] . "' and YEAR(dateEnd) <= '" . $this->p['EndYear'] . "' and date_format(dateStart,'%m-%d') >= '" . $startDate1 . "' and date_format(dateEnd,'%m-%d') <= '" . $endDate1 . "'and YEAR(dateStart) = YEAR(dateEnd)";
					else
					{
						$endYear = $this->p['EndYear'] + 1;
						$startYear = $this->p['StartYear'] + 1;
						$sqlTimeConstraint = "(YEAR(dateStart) >= '" . $this->p['StartYear'] . "' and YEAR(dateStart) <= '" .$this->p['EndYear'] . "' and date_format(dateStart,'%m-%d') >= '" . $startDate1 . "' and datediff(dateEnd,dateStart) <= 88 ) or (YEAR(dateStart) >= '" . $startYear . "' and YEAR(dateEnd) <= '" . $endYear . "' and date_format(dateStart,'%m-%d') >= '01-01' and date_format(dateEnd,'%m-%d') <= '03-20' and YEAR(dateStart) = YEAR(dateEnd))";
					}
				}
				else if ($this->p['SearchBy']=="year")
					$sqlTimeConstraint = "YEAR(dateStart) >= '" . $this->p['StartYear'] . "' AND YEAR(dateEnd) <= '" . $this->p['EndYear'] . "'";
				else if ($this->p['SearchBy']=="month")
					$sqlTimeConstraint = "YEAR(dateStart) >= '" . $this->p['StartYear'] . "' AND YEAR(dateEnd) <= '" . $this->p['EndYear'] . "' and MONTH(dateStart) = '" . $this->p['StartMonth'] . "' and MONTH(dateEnd) = '" . $this->p['StartMonth'] . "'";
				else if ($this->p['SearchBy']=="monthday")
				{
					$md = (($this->p['StartMonth']>9) ? $this->p['StartMonth'] : "0".$this->p['StartMonth']) . "-" . (($this->p['StartDay']>9) ? $this->p['StartDay'] : "0".$this->p['StartDay']);
					$sqlTimeConstraint = "YEAR(dateStart) >= '" . $this->p['StartYear'] . "' AND YEAR(dateEnd) <= '" . $this->p['EndYear'] . "' and date_format(dateStart,'%m-%d') = '" . $md . "' and date_format(dateEnd,'%m-%d') = '" . $md . "'";
				}
			}
			$sqlTimeConstraint = "AND (".$sqlTimeConstraint.") ";
// =======================================================================================================
  
// === Generate category constraints. ==================================================
$sqlcategoryConstraint = "";

for($i=1;$i<=12;$i++)
{
  $paraName = "CategorySearchIn$i";
  if(isset($this->p[$paraName]))
  {
    $category = mysql_real_escape_string($this->p[$paraName]);
	
    if ($sqlcategoryConstraint !="")
	  $sqlcategoryConstraint .= ",'$category'";  
    else
      $sqlcategoryConstraint = "'$category'"; 
  } 	  
}
if(strlen($sqlcategoryConstraint)>0) $sqlcategoryConstraint = " and (A.category in ($sqlcategoryConstraint)) ";
// ==================================================================================
  // === Generate keywords constraints. ==================================================
  
    $limitStart = parent::ITEMS_PER_PAGE*($this->page-1);
	$limitEnd = parent::ITEMS_PER_PAGE;
	$Keywords = mysql_real_escape_string(trim($this->p['Keyword']));
	$limited ="F.collector like '$Keywords' ";
	$Location  = mysql_real_escape_string(trim($this->p['Location']));
	if($Location !='')
		$limited.="AND  F.location like '%$Location%' ";
	$Date = mysql_real_escape_string(trim($this->p['Date']));
	if($Date !='')
		$limited.= "AND F.date like '%$Date%' ";
	$Amount = mysql_real_escape_string(trim($this->p['Amount']));
	if($Amount !='')
		$limited.= "AND F.amount like '%$Amount%'";
	$query = "select SQL_CALC_FOUND_ROWS DISTINCT A.opp,notVerified,title, YEAR(dateStart) as year,duration,collection,inventory,dimension,bookCatalog,medium,A.location, notes,commentary from `ARTWORK` A,`FORMERLY` F  where A.opp=F.opp AND ".$limited.$sqlTimeConstraint.$sqlcategoryConstraint." order by dateOrder(dateStart,dateStartFlag) asc, dateOrder(dateEnd,dateEndFlag) asc limit $limitStart, $limitEnd";
	$result = mysql_query($query);
	//$result = die($query);
	return $result;
  }
  
	  public function getTotalNum()
  {
    $result = mysql_query("SELECT FOUND_ROWS()");
	$totalNum = mysql_fetch_row($result);
	$this->total = $totalNum[0];
	return $this->total;
  }
  
  public function getTotalPage()
  {
    return ceil($this->total/parent::ITEMS_PER_PAGE);
  }
   ///////for artwork search summary///////////////////
  public function sortBooks($books)
  {
    $array = explode("; ",$books);
    sort($array);
	if(count($array)==1)
	  return $array[0];
	else
	{
	  $result = $array[0];
	  for($i=1; $i<count($array); $i++)
	  {
	    $result.= "; ".$array[$i];
	  }
	  return $result;
	}
  }
  public function formercollec($opp)
  {
     $query = "SELECT count(opp) FROM `FORMERLY` WHERE opp ='$opp' ";
     $result = mysql_query($query);
     $record = mysql_fetch_array($result);
     $count3 = $record['count(opp)'];
     return $count3;
  }
  public function getCatalog($opp)
  {
    $catalog = array();
	$query = "SELECT Catalog, Volume, Number, Suffix FROM RLTN_WORKS_CATALOG WHERE idArtwork='$opp' ORDER BY Catalog ASC, Volume ASC, Number ASC, Suffix ASC";
	$result = mysql_query($query);
	while($cata = mysql_fetch_array($result))
	{
	  $temp = $cata['Catalog'];
	  $temp.= ($cata['Volume']!='')? ".$cata[Volume]":"";
	  if($cata['Catalog']=="PP")
	  {
	    if($cata['Number'] < 10) $temp.= ":00$cata[Number]";
		elseif($cata['Number'] < 100) $temp.= ":0$cata[Number]";
		else $temp.= ":$cata[Number]";
	  }
	  else
	    $temp.= ":$cata[Number]";
	  $temp.= $cata['Suffix'];
	  $catalog[] = $temp;
	}
	return $catalog;
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
         if(strpos($acceptedtitle, "<artwork>")!==FALSE){
              $subStartPosistion = strpos($acceptedtitle,"<artwork>");
              $subEndPosition = strpos($acceptedtitle,"</artwork>");
              $subTagLength = $subEndPosition - $subStartPosition - 9;
	      $subTagText = trim(substr($acceptedtitle,$subStartPosition+9, $subTagLength));
              $query1 = "SELECT title FROM `ARTWORK` WHERE opp = '$subTagText'";
	      $result1 = mysql_query($query1);
	      $row1 = mysql_fetch_array($result1);
	      $subAcceptedtitle = $this->getAcceptedTitle($row1['title']);
              $left = substr($acceptedtitle,0,$subStartPosition);
              $right = substr($acceptedtitle,$subEndPosition+10);
              $htmlText = $htmlLink."<i>".$left.$subAcceptedtitle.$right."</i></a>";
          }
          else{
            $htmlText = $htmlLink."<i>".$acceptedtitle."</i></a>";
          }
          
          $text = str_replace("<artwork>".$tagText."</artwork>", $htmlText, $text);
           
        }   
	return $text;
        
  }
 
} 
?>
	