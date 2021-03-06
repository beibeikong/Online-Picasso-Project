<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class ArtworkCaleSearchD extends Database
{
  private $p;
  private $page; // the # of current page
  private $total;
  
  function __construct($param) 
  {
    parent::__construct(); 
	$this->p = $param;
	/*
	if(isset($param['category']))
	{
	  $this->category = "('" . $param['category'];
	  $this->category .= "')";
	  $this->category = str_replace("_", "','", $this->category);
	}
	else
	  $this->category="('nothing')";
	*/  
	if(isset($param['page']))
	  $this->page = $param['page'];
	else
	  $this->page = 1;
  }
    
  public function getData()  //operate on database to get data
  {
    $limitStart = 20*($this->page-1);
	$limitEnd = 20;
	$query = "SELECT SQL_CALC_FOUND_ROWS opp,notVerified,title,YEAR(dateStart) AS StartYear,MONTH(dateStart) AS StartMonth,DAY(dateStart) AS StartDay,YEAR(dateEnd) AS EndYear,MONTH(dateEnd) AS EndMonth,DAY(dateEnd) AS EndDay from `ARTWORK` A where " ;
	
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
			  $sqlConstraint .= " and (N.id IN (SELECT DISTINCT RW.idNarrative FROM `RLTN_NARR_WORKS` RW WHERE RW.idArtwork IN (SELECT opp FROM `ARTWORK` A WHERE title LIKE '%$Keywords%')) OR N.id IN (SELECT DISTINCT RL.idNarrative FROM `RLTN_NARR_LINKS` RL WHERE RL.idLink IN (SELECT idLink FROM `LINK` L WHERE title LIKE '%$Keywords%')) OR N.event like '%$Keywords%')";
			}
// =====================================================================================
// =============== Generate commentary constraints. ==================================================
			if(isset($this->p['Commentaryres']))
			  $sqlConstraint .= " and (length(commentary)>0)";
			else
			{
			  $Keywords = mysql_real_escape_string(trim($this->p['Commentary']));
			  if ($Keywords!="")
			    $sqlConstraint .= " and (N.commentary like '%$Keywords%')";  // a little proble, can't find links inside of commentary
			}
// ==================================================================================
// ===================== Generate sorting order. =========================================================
			$sqlConstraint .= " ORDER BY dateOrder(dateStart,dateStartFlag) ".mysql_real_escape_string($this->p['Sort']).", dateOrder(dateEnd,dateEndFlag) ".mysql_real_escape_string($this->p['Sort']);
// =====================================================================================

    $query .= $sqlConstraint. " limit $limitStart, $limitEnd";
	$result = mysql_query($query);
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

} 
?>