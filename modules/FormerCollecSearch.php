<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class FormerCollecSearch extends Database
{
  private $p;
  private $total;
  
  function __construct($param) 
  {
    parent::__construct();
	$this->p = $param; 
	
  }

  public function getData()  //operate on database to get data
  {
  // === Generate keywords constraints. ==================================================
  	$limited='';
  	$Keyword = mysql_real_escape_string(trim($this->p['Keyword']));
	if($Keyword !="")
		$limited.="F.collector like '%$Keyword%'";
	$Location  = mysql_real_escape_string(trim($this->p['Location']));
	if($Location !="")
	{
		$limited.= strlen($limited)>0 ? " and " : "";
		$limited.="F.location like '%$Location%'";	
	}	
	$Date = mysql_real_escape_string(trim($this->p['Date']));
	if($Date !="")
	{
		$limited.= strlen($limited)>0 ? " and " : "";
		$limited.="F.date like '%$Date%'";	
	}
	$Amount = mysql_real_escape_string(trim($this->p['Amount']));
	if($Amount !="")
	{
		$limited.= strlen($limited)>0 ? " and " : "";
		$limited.="F.amount like '%$Amount%'";	
	}
        $Constraint=$this->getConstraint();
	if($limited !='')
	{
		$query = "SELECT SQL_CALC_FOUND_ROWS collector, count(Distinct F.opp) as n from `ARTWORK` A,`FORMERLY` F  where A.opp=F.opp AND ".$limited.$Constraint."group by collector ORDER BY collector asc";
	}
	else 
	{
		$query = "SELECT SQL_CALC_FOUND_ROWS collector, count(Distinct F.opp) as n from `ARTWORK` A,`FORMERLY` F  where A.opp=F.opp ".$Constraint."group by collector ORDER BY collector asc";
	}	
	 
    $result = mysql_query($query);
	//$result = die($query); 
	return $result;
  }
////////// end of public function getData() //////////////////////////////////////////////  	

private function getConstraint(){
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
return $sqlTimeConstraint.$sqlcategoryConstraint;                 
}
// ==================================================================================
  
 
 
///////////////////////////////some functions for time constraints//////////////////////////////////////////////////// 
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
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  
 public function getOPPString($collector){
     
        $limited="F.collector like '$collector'";
	$Location  = mysql_real_escape_string(trim($this->p['Location']));
	if($Location !="")
		$limited.=" and F.location like '%$Location%'";	
	$Date = mysql_real_escape_string(trim($this->p['Date']));
	if($Date !="")
		$limited.=" and F.date like '%$Date%'";	
	$Amount = mysql_real_escape_string(trim($this->p['Amount']));
	if($Amount !="")
		$limited.=" and F.amount like '%$Amount%'";	
        $Constraint=$this->getConstraint();
	$query = "SELECT Distinct F.opp from `ARTWORK` A,`FORMERLY` F  where A.opp=F.opp AND ".$limited.$Constraint;
      $result=  mysql_query($query);
      $oppstring='';
      while($row = mysql_fetch_array($result)){
          $oppstring.="_".$row['opp'];
      }
      return $oppstring;
  }
        
  public function getTotalNum()
  {
    $result = mysql_query("SELECT FOUND_ROWS()");
	$totalNum = mysql_fetch_row($result);
	$this->total = $totalNum[0];
	return $this->total;
  }
  
} 
?>
