<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');

class ArtworkSearch extends Database
{ 
  private $p;
  private $page; // the # of current page
  private $total;
  private $Catalog1;
  private $curntCatalogs;
  private $allCatalogs;
  private $volumesForCatalog1;
  function __construct($param) 
  {
    parent::__construct(); 
	
	$this->p = $param;
	$this->page = $param['page'];
        $this->Catalog1 = $param['Catalog1'];
        if($this->Catalog1 != 'All') {
            if(isset($param['catalog']))
              $this->curntCatalogs = explode("_", mysql_real_escape_string($param['catalog']));
            else
            $this->curntCatalogs = array("OPP","Z","PP","P","DB","DR","LD","Ba","B","MPP","MPB");
            if($this->Catalog1 != "OPP")
            {
              if(in_array($this->Catalog1, $this->curntCatalogs)===false)
                array_push($this->curntCatalogs, $this->Catalog1);
            }

            $this->allCatalogs =  mysql_query("select * from `CATALOGS`");
            $this->volumesForCatalog1 = mysql_query("select * from `CATVOLUMES` where Catalog = '$this->Catalog1'");
        }
  }
    
  public function getData()  //operate on database to get data
  {   
    $limitStart = parent::ITEMS_PER_PAGE*($this->page-1);
	$limitEnd = parent::ITEMS_PER_PAGE;
	$query = "select SQL_CALC_FOUND_ROWS opp,notVerified,title, YEAR(dateStart) as year,duration,collection,inventory,dimension,bookCatalog,medium,location, notes,commentary from `ARTWORK` A where " ;
	
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
			$sqlTimeConstraint = "(".$sqlTimeConstraint.") ";
// =======================================================================================================

// === Generate keyword constraint ======================================================
$sqlKeywordConstraint = "";

for($i=1;$i<=7;$i++)
{
  $paraName = "Keyword$i";
  $keyword = mysql_real_escape_string(trim($this->p[$paraName]));
  if ($keyword !="")
  {
    $searchInName = "SearchIn$i";
	 $searchIn = $this->p[$searchInName];
	 $sqlKeywordConstraint .= strlen($sqlKeywordConstraint)>0 ? "and " : "";
	 if ($searchIn =='Title')
	 {	
		$titleLimited = "(SELECT DISTINCT T.idAT FROM `RLTN_AT_ARTWORK` T WHERE T.idARTWORK IN (SELECT opp FROM `ARTWORK` A WHERE title LIKE '%$keyword%') LIMIT 0,1)";
		for ($j=1;$j<100;$j++)
		{
			 $titleLimited.=",(SELECT DISTINCT T.idAT FROM `RLTN_AT_ARTWORK` T WHERE T.idARTWORK IN (SELECT opp FROM `ARTWORK` A WHERE title LIKE '%$keyword%') LIMIT ".$j.",1)";
		}
	 	$sqlKeywordConstraint .= "(A.title like '%$keyword%' OR A.opp IN ($titleLimited))";	
	 }
	 elseif ( $searchIn =='Medium')
	 {
	 	$mediumLimited ="(SELECT DISTINCT M.idAM FROM `RLTN_AM_ARTWORK` M WHERE M.idARTWORK IN (SELECT opp FROM `ARTWORK` L WHERE title LIKE '%$keyword%') LIMIT 0,1)";
		for ($k=1;$k<100;$k++)
		{
			 $mediumLimited.=",(SELECT DISTINCT M.idAM FROM `RLTN_AM_ARTWORK` M WHERE M.idARTWORK IN (SELECT opp FROM `ARTWORK` L WHERE title LIKE '%$keyword%') LIMIT ".$k.",1)";
		}
	  	$sqlKeywordConstraint .= "(A.medium like '%$keyword%' OR A.opp IN ($mediumLimited))";
	 }
	 else $sqlKeywordConstraint .= "A.$searchIn like '%$keyword%'";
  }	  
}
if(strlen($sqlKeywordConstraint)>0) $sqlKeywordConstraint = " and ($sqlKeywordConstraint) ";
// =======================================================================================================
// === Generate Book constraints. ==================================================
$sqlBookConstraint = "";
$bookauthor = mysql_real_escape_string(trim($this->p['BookAuthor']));
$bookyear = mysql_real_escape_string(trim($this->p['BookYear']));
$bookitem = mysql_real_escape_string(trim($this->p['BookItem']));
if ( ($bookauthor != "") && ($bookyear == "") && ($bookitem != "") )	//since year might be two or three characters
{
	$sqlBookConstraint = "(A.bookCatalog like '%$bookauthor.__:$bookitem%') or (A.bookCatalog like '%$bookauthor.___:$bookitem%')";
}
elseif ( !(($bookauthor == "") && ($bookyear == "") && ($bookitem == "")))
{
	if ( ($bookauthor != "") && ($bookyear == "") && ($bookitem == "") )
		$bookkeyword = $bookauthor.".";
	elseif ( ($bookauthor == "") && ($bookyear == "") && ($bookitem != "") )
		$bookkeyword = ":".$bookitem;
	elseif ( ($bookauthor != "") && ($bookyear != "") && ($bookitem == "") )
		$bookkeyword =$bookauthor.".".$bookyear;
	else
		$bookkeyword =$bookauthor.".".$bookyear.":".$bookitem;

	$sqlBookConstraint .= "A.bookCatalog like '%$bookkeyword%'";
}
			
if(strlen($sqlBookConstraint)>0) $sqlBookConstraint = " and ($sqlBookConstraint) ";
// =======================================================================================================
// === Generate Auction keywords constraints. ==================================================
$sqlAuctionConstraint = "";
if(isset($this->p['NoteAll'])){
$sqlAuctionConstraint = " and (length(A.notes)>0) ";}
else
{

for($i=1;$i<=7;$i++)
{
  $paraName = "AuctionKeyword$i";
  $keyword = mysql_real_escape_string(trim($this->p[$paraName]));
  if ($keyword !="")
  {
    $searchInName = "AuctionSearchIn$i";
    $searchIn = $this->p[$searchInName];
    switch ($searchIn) {
        case "saletitle":
            $sqlAuctionConstraint.=strlen($sqlAuctionConstraint)>0 ? "and " : "";
            $sqlAuctionConstraint .= "ExtractValue(datatable, 'DataTable[1]/entry[@title=\"Sale Title\"]') like '%$keyword%' ";
            break;
        case "source":
            $sqlAuctionConstraint.=strlen($sqlAuctionConstraint)>0 ? "and " : "";
            $sqlAuctionConstraint .= "ExtractValue(datatable, 'DataTable[1]/entry[@title=\"Source\"]') like '%$keyword%' ";
            break;
        case "salenumber":
            $sqlAuctionConstraint.=strlen($sqlAuctionConstraint)>0 ? "and " : "";
            $sqlAuctionConstraint .= "ExtractValue(datatable, 'DataTable[1]/entry[@title=\"Sale Number\"]') like '%$keyword%' ";
            break;
        case "saledate":
            $sqlAuctionConstraint.=strlen($sqlAuctionConstraint)>0 ? "and " : "";
            $sqlAuctionConstraint .= "ExtractValue(datatable, 'DataTable[1]/entry[@title=\"Sale Date\"]') like '%$keyword%' ";
            break;
        case "lotnumber":
            $sqlAuctionConstraint.=strlen($sqlAuctionConstraint)>0 ? "and " : "";
            $sqlAuctionConstraint .= "ExtractValue(datatable, 'DataTable[1]/entry[@title=\"Lot Number\"]') like '%$keyword%' ";
            break;
        case "lottitle":
            $sqlAuctionConstraint.=strlen($sqlAuctionConstraint)>0 ? "and " : "";
           $sqlAuctionConstraint .= "ExtractValue(datatable, 'DataTable[1]/entry[@title=\"Lot Title\"]') like '%$keyword%' ";
            break;
        case "prelot":
             $sqlAuctionConstraint.=strlen($sqlAuctionConstraint)>0 ? "and " : "";
          $sqlAuctionConstraint .= "ExtractValue(datatable, 'DataTable[1]/entry[@title=\"Pre-lot Text\"]') like '%$keyword%' ";
            break;
        case "postlot":
            $sqlAuctionConstraint.=strlen($sqlAuctionConstraint)>0 ? "and " : "";
           $sqlAuctionConstraint .= "ExtractValue(datatable, 'DataTable[1]/entry[@title=\"Post-lot Text\"]') like '%$keyword%' ";
            break;
        case "estimateprice":
            $sqlAuctionConstraint.=strlen($sqlAuctionConstraint)>0 ? "and " : "";
           $sqlAuctionConstraint .= " ExtractValue(datatable, 'DataTable[1]/entry[@title=\"Estimate\"]') like '%$keyword%' ";
            break;
        case "description":
            $sqlAuctionConstraint.=strlen($sqlAuctionConstraint)>0 ? "and " : "";
           $sqlAuctionConstraint .= " ExtractValue(datatable,'DataTable[1]/entry[@title=\"Description\"]/ul/li') like '%$keyword%' ";
            break;
        case "literature":
            $sqlAuctionConstraint.=strlen($sqlAuctionConstraint)>0 ? "and " : "";
           $sqlAuctionConstraint .= " ExtractValue(datatable,'DataTable[1]/entry[@title=\"Literature\"]/ul/li') like '%$keyword%' ";    
            break;
        case "provenance":
            $sqlAuctionConstraint.=strlen($sqlAuctionConstraint)>0 ? "and " : "";
            $sqlAuctionConstraint .= " ExtractValue(datatable,'DataTable[1]/entry[@title=\"Provenance\"]/ul/li') like '%$keyword%' ";
            break;
        case "exhibited":
            $sqlAuctionConstraint.=strlen($sqlAuctionConstraint)>0 ? "and " : "";
           $sqlAuctionConstraint .= " ExtractValue(datatable,'DataTable[1]/entry[@title=\"Exhibited\"]/ul/li') like '%$keyword%' ";    
            break;
    }
  }
}  
if(strlen($sqlAuctionConstraint)>0) {
     $list=$this->getList($sqlAuctionConstraint);
     $sqlAuctionConstraint = " and (A.opp IN ($list ) )";    
  }
}
 
// =======================================================================================================
// =============== Generate commentary constraints. ==================================================
$sqlComConstraint = "";
			if(isset($this->p['Commentaryres']))
			  $sqlComConstraint = " and (length(A.commentary)>0) ";
			else
			{
			  //$Keywords = trim($this->p['Commentary']); 
			  $Keywords = mysql_real_escape_string(trim($this->p['Commentary']));
			  $Keywords =str_replace('(','\\\(',$Keywords);
			  $Keywords =str_replace(')','\\)',$Keywords);
			  $Artworklimited = "(SELECT DISTINCT idAC FROM `RLTN_AC_ARTWORK` WHERE idARTWORK IN ( SELECT opp FROM `ARTWORK` L WHERE title LIKE '%$Keywords%')LIMIT 0,1)";
			  for ($i=1;$i<150;$i++)
			  {
				 $Artworklimited.=",(SELECT DISTINCT idAC FROM `RLTN_AC_ARTWORK` WHERE idARTWORK IN ( SELECT opp FROM `ARTWORK` L WHERE title LIKE '%$Keywords%')LIMIT ".$i.",1)";
			  }
			  			  
			  $Writinglimited = "(SELECT DISTINCT image FROM `WRITINGS_PAGES` WHERE mid IN (SELECT mid FROM `WRITINGS_POEMS` WHERE title LIKE '%$Keywords%')limit 0,1)";
			  for ($i=1;$i<10;$i++)
			  {
				 $Writinglimited.=",(SELECT DISTINCT image FROM `WRITINGS_PAGES` WHERE mid IN (SELECT mid FROM `WRITINGS_POEMS` WHERE title LIKE '%$Keywords%')limit ".$i.",1)";
			  }
			  
			  $Linklimited = "(SELECT DISTINCT RL.idARTWORK FROM `RTLN_ARTWORK_LINK` RL WHERE RL.idLINK IN (SELECT idLink FROM `LINK` L WHERE title LIKE '%$Keywords%')limit 0,1)";
			  for ($i=1;$i<10;$i++)
			  {
				 $Linklimited.=",(SELECT DISTINCT RL.idARTWORK FROM `RTLN_ARTWORK_LINK` RL WHERE RL.idLINK IN (SELECT idLink FROM `LINK` L WHERE title LIKE '%$Keywords%')limit ".$i.",1)";
			  }
			  
			  if ($Keywords!="")
						$sqlComConstraint = "and (A.opp IN ($Linklimited) OR A.opp IN ($Artworklimited) OR A.opp IN ($Writinglimited) OR A.commentary regexp '[^a-zA-Z]".$Keywords."[^a-zA-Z]')";  
			}
// ==================================================================================
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
// === Generate catalog contraints. ====================================================
$sqlcatalogConstraint1 = "";
$sqlcatalogConstraint2 = "";
$sqlcatalogConstraint = "";
if($this->Catalog1 !='All'){
    if($this->Catalog1 =='OPP')
            {
                $sqlcatalogConstraint1  = $this->getSQLForOppSortByOpp();
            }
        else  // if search range catalog other than OPP
            {
              if($this->isSearchedCatalogHasVolume() === true)
                $sqlcatalogConstraint1  = $this->getSQLForVolumedCata();
              else
                $sqlcatalogConstraint1  = $this->getSQLForUnvolumedCata();
            }	
       if(trim($this->p['Suffix1'])!="")
      {
        $sqlcatalogConstraint2 = " and (A.opp IN ( select idArtwork from RLTN_WORKS_CATALOG where Suffix not like '' and ";
        $temp1 = mysql_real_escape_string(trim($this->p['Suffix1']));
        $temp2 = mysql_real_escape_string(trim($this->p['Suffix2']));
        if($temp1 === $temp2) {
        $sqlcatalogConstraint2 .= "Suffix  like '%$temp1%'))";  
        }
        else {
            $sqlcatalogConstraint2 .= "Suffix >= '$temp1' and Suffix <= '$temp2'))";  
        }
      }   

     $sqlcatalogConstraint = " and (opp in ($sqlcatalogConstraint1))".$sqlcatalogConstraint2;
}
// ==================================================================================   
// === Generate sorting and final sql statement. ===============================================================
$flag = $this->analyzeSort(); // if catalog exists in sortby
if($flag == 1) // no catalog in orderby
{
	$sqlOrderBy = $this->generateSorting();    
	$query .= $sqlTimeConstraint.$sqlKeywordConstraint.$sqlBookConstraint.$sqlAuctionConstraint.$sqlComConstraint.$sqlcategoryConstraint.$sqlcatalogConstraint.$sqlOrderBy. " limit $limitStart, $limitEnd";
}
else // there are catalog in orderby
{
  $orderby = $this->getOrderby();
  $catalogorder = $this->getCatalogOrder();
  $query = "select SQL_CALC_FOUND_ROWS distinct opp, A.notVerified,title, YEAR(dateStart) as year,duration,collection,inventory,dimension,bookCatalog,medium,location, notes,commentary from `ARTWORK` A, `RLTN_WORKS_CATALOG` B where $catalogorder and A.opp=B.idArtwork and ". $sqlTimeConstraint.$sqlKeywordConstraint.$sqlBookConstraint.$sqlAuctionConstraint.$sqlComConstraint.$sqlcategoryConstraint.$sqlcatalogConstraint.$orderby. " limit $limitStart, $limitEnd";

}

    $result = mysql_query($query); 
    //$result = die($query); 
	return $result;
  }
////////// end of public function getData() //////////////////////////////////////////////  
private function getCatalogOrder()
{
  if(stripos($this->p['SortBy1'],"Catalog")!==false)
    $c = substr($this->p['SortBy1'], 8);
  else if(stripos($this->p['SortBy2'],"Catalog")!==false)
    $c = substr($this->p['SortBy2'], 8);
  else if(stripos($this->p['SortBy3'],"Catalog")!==false)
    $c = substr($this->p['SortBy3'], 8);

  $s = "B.Catalog = '$c' ";
  
  if($this->p['Volume1']!="All")
  {
    $v  = $this->p['Volume1'];
	$s .= "and B.Volume='$v'";
  }	
  
  return $s;
}


  private function isSearchedCatalogHasVolume()
  {
    $i = 0;
	$hasVolumenInRow = true;
	while($row=mysql_fetch_array($this->volumesForCatalog1)) {
	  if($row['Volume'] === '')
	  	$hasVolumenInRow = false;
	  $i++;
	}
	//echo $i;
	if($i < 1)
	  return false;
	else if($i === 1)
	{
	  if($hasVolumenInRow)
	    return true;
	  else
	    return false;
	}
	else
	  return true;
  }

  public function getSQLForOppSortByOpp()
  {
	$customCatalog = $this->p['Catalog1']; 	//$this->p['Catalog1'] is 'OPP' here
	if($this->p['Volume1']!="All" && trim($this->p['Number1'])!="")
	{
	  $temp = mysql_real_escape_string($this->p['Volume1']);
	  $OPPCatalog1 = $customCatalog.'.'.$temp;
	  $temp = mysql_real_escape_string(trim($this->p['Number1']));
	  $OPPCatalog1 .= ':'.$temp;
	}
	if($this->p['Volume2']!="All" && trim($this->p['Number2'])!="")
	{
	  $temp = mysql_real_escape_string($this->p['Volume2']);
	  $OPPCatalog2 = $customCatalog.'.'.$temp;
	  $temp = mysql_real_escape_string(trim($this->p['Number2']));
	  $OPPCatalog2 .= ':'.$temp;
	}
	if ($this->p['Volume1']!="All")
	{
	  $startYear = mysql_real_escape_string($this->p['Volume1']);
	  if ($startYear <= 73)
	  	$startYear = "19".$startYear;
	  else
	    $startYear = "18".$startYear;  
	}
	if ($this->p['Volume2']!="All")
	{
	  $endYear = mysql_real_escape_string($this->p['Volume2']);
	  if ($endYear <= 73)
	  	$endYear = "19".$endYear;
	  else
	    $endYear = "18".$endYear; 
	}	
	
	$query = "SELECT  AR.opp ";
	$query .= " FROM ARTWORK AR ";
	
	if(isset($startYear) || isset($endYear))
	{
	  
	  if($startYear !== $endYear)
	  {	
	    $query .= " WHERE";
		if (isset($startYear))
		{
		  $query .= " YEAR(AR.dateStart)";
		  if(isset($OPPCatalog1))
		    $query .= " >";
		  else
		    $query .= " >=";
		  $query .=" $startYear";
		}
		if (isset($startYear) && isset($endYear))
		  $query .= " AND"; 
		if (isset($endYear))
		{
		  $query .= " YEAR(AR.dateStart)";
		  if(isset($OPPCatalog2))
		    $query .= " <";
		  else
		    $query .= " <=";
		  $query .=" $endYear";
		}
		
		//We assume if the $startNumber is set, the $startVolume must exists
		if(isset($OPPCatalog1))
		  $query .= " OR (YEAR(AR.dateStart) = $startYear AND AR.opp >= '$OPPCatalog1')";
		
		//We assume if the $endNumber is set, the $endVolume must exists
		if(isset($OPPCatalog2))
		  $query .= " OR (YEAR(AR.dateStart) = $endYear AND AR.opp <= '$OPPCatalog2')";
	
	  }
	  else	//$startYear === $endYear
	  {
	    if(isset($startYear))
		  $query .= " WHERE YEAR(AR.dateStart) = '$startYear'";
		if(isset($OPPCatalog1))	//We assume if the $startNumber is set, the $startVolume must exists
		  $query .= " AND AR.opp >= '$OPPCatalog1'";
		if(isset($OPPCatalog2))	//We assume if the $endNumber is set, the $endVolume must exists
		  $query .= " AND AR.opp <= '$OPPCatalog2'";		
	  }
	}
	
	return $query;
  }
 
  public function getSQLForOppSortByCata()
  {
	$customCatalog = $this->p['Catalog1']; 	//$this->p['Catalog1'] is 'OPP' here
	if($this->p['Volume1']!="All" && trim($this->p['Number1'])!="")
	{
	  $temp = mysql_real_escape_string($this->p['Volume1']);
	  $OPPCatalog1 = $customCatalog.'.'.$temp;
	  $temp = mysql_real_escape_string(trim($this->p['Number1']));
	  $OPPCatalog1 .= ':'.$temp;
	}
	if($this->p['Volume2']!="All" && trim($this->p['Number2'])!="")
	{
	  $temp = mysql_real_escape_string($this->p['Volume2']);
	  $OPPCatalog2 = $customCatalog.'.'.$temp;
	  $temp = mysql_real_escape_string(trim($this->p['Number2']));
	  $OPPCatalog2 .= ':'.$temp;
	}
	if ($this->p['Volume1']!="All")
	{
	  $startYear = mysql_real_escape_string($this->p['Volume1']);
	  if ($startYear <= 73)
	  	$startYear = "19".$startYear;
	  else
	    $startYear = "18".$startYear;  
	}
	if ($this->p['Volume2']!="All")
	{
	  $endYear = mysql_real_escape_string($this->p['Volume2']);
	  if ($endYear <= 73)
	  	$endYear = "19".$endYear;
	  else
	    $endYear = "18".$endYear; 
	}

	$query = "SELECT  AR.opp ";
	$query .= " FROM ARTWORK AR RIGHT JOIN RLTN_WORKS_CATALOG R ON AR.opp = R.idArtwork WHERE";
	if(isset($startYear) || isset($endYear) || isset($OPPCatalog1) || isset($OPPCatalog2))
	{
		$query .= " (";
		if(isset($startYear) || isset($endYear))
		{
		  
		  if($startYear !== $endYear)
		  {		
			if (isset($startYear))
			{
			  $query .= " YEAR(AR.dateStart)";
			  if(isset($OPPCatalog1))
				$query .= " >";
			  else
				$query .= " >=";
			  $query .=" $startYear";
			}
			if (isset($startYear) && isset($endYear))
			  $query .= " AND"; 
			if (isset($endYear))
			{
			  $query .= " YEAR(AR.dateStart)";
			  if(isset($OPPCatalog2))
				$query .= " <";
			  else
				$query .= " <=";
			  $query .=" $endYear";
			}
			
			//We assume if the $startNumber is set, the $startVolume must exists
			if(isset($OPPCatalog1))
			  $query .= " OR (YEAR(AR.dateStart) = $startYear AND AR.opp >= '$OPPCatalog1')";
			
			//We assume if the $endNumber is set, the $endVolume must exists
			if(isset($OPPCatalog2))
			  $query .= " OR (YEAR(AR.dateStart) = $endYear AND AR.opp <= '$OPPCatalog2')";
		
		  }
		  else	//$startYear === $endYear
		  {
			if(isset($startYear))
			  $query .= " YEAR(AR.dateStart) = '$startYear'";
			if(isset($OPPCatalog1))	//We assume if the $startNumber is set, the $startVolume must exists
			  $query .= " AND AR.opp >= '$OPPCatalog1'";
			if(isset($OPPCatalog2))	//We assume if the $endNumber is set, the $endVolume must exists
			  $query .= " AND AR.opp <= '$OPPCatalog2'";		
		  }
		}
		$query .= ")";
	}
	
	return $query;
  }
  
  public function getSQLForVolumedCata()
  {
	if ($this->p['Volume1']!="All")
	  $startVolume = mysql_real_escape_string($this->p['Volume1']);
	if ($this->p['Volume2']!="All")
	  $endVolume = mysql_real_escape_string($this->p['Volume2']);
	  
	if(trim($this->p['Number1'])!="")
	  $startNumber = mysql_real_escape_string(trim($this->p['Number1']));
	if(trim($this->p['Number2'])!="")
	  $endNumber = mysql_real_escape_string(trim($this->p['Number2']));

	$query = "SELECT  AR.opp ";
	$query .= " FROM ARTWORK AR RIGHT JOIN RLTN_WORKS_CATALOG R ON AR.opp = R.idArtwork";
	$query .= " LEFT JOIN CATVOLUMES C ON R.Catalog = C.Catalog and R.Volume = C.Volume WHERE";
	$query .= " R.Catalog = '$this->Catalog1'";
	
	if(isset($startVolume) || isset($endVolume))
	{
	  $query .= " AND (";
	  
	  if($startVolume !== $endVolume)
	  {
	    $query .= " (";
		
		if (isset($startVolume))
		{
		  $query .= " C.VolumeOrder";
		  if(isset($startNumber))
		    $query .= " >";
		  else
		    $query .= " >=";
		  $query .=" (SELECT VolumeOrder FROM CATVOLUMES where Catalog = '$this->Catalog1' and Volume = '$startVolume')";
		}
		if (isset($startVolume) && isset($endVolume))
		  $query .= " AND"; 
		if (isset($endVolume))
		{
		  $query .= " C.VolumeOrder";
		  if(isset($endNumber))
		    $query .= " <";
		  else
		    $query .= " <=";
		  $query .=" (SELECT VolumeOrder FROM CATVOLUMES where Catalog = '$this->Catalog1' and Volume = '$endVolume')";
		}
	    $query .= " )";
		
		//We assume if the $startNumber is set, the $startVolume must exists
		if(isset($startNumber))
		{
		  $query .= " OR (";
		  $query .= " C.VolumeOrder = (SELECT VolumeOrder FROM CATVOLUMES where Catalog = '$this->Catalog1' and Volume = '$startVolume') AND R.Number >= $startNumber";
		  $query .= " )";
		}
		
		//We assume if the $endNumber is set, the $endVolume must exists
		if(isset($endNumber))
		{
		  $query .= " OR (";
		  $query .= " C.VolumeOrder = (SELECT VolumeOrder FROM CATVOLUMES where Catalog = '$this->Catalog1' and Volume = '$endVolume') AND R.Number <= $endNumber";
		  $query .= " )";
		}
	
	  }
	  else	//$startVolume === $endVolume
	  {
		$query .= " C.VolumeOrder = (SELECT VolumeOrder FROM CATVOLUMES where Catalog = '$this->Catalog1' and Volume = '$startVolume')";
		if(isset($startNumber))	//We assume if the $startNumber is set, the $startVolume must exists
		  $query .= " AND R.Number >= $startNumber";
		if(isset($endNumber))	//We assume if the $endNumber is set, the $endVolume must exists
		  $query .= " AND R.Number <= $endNumber";		
	  }  
	  $query .= " )";
	}
	return $query;
  }


  public function getSQLForUnvolumedCata()
  {
	if ($this->p['Volume1']!="All")
	  $startVolume = mysql_real_escape_string($this->p['Volume1']);
	if ($this->p['Volume2']!="All")
	  $endVolume = mysql_real_escape_string($this->p['Volume2']);
	  
	if(trim($this->p['Number1'])!="")
	  $startNumber = mysql_real_escape_string(trim($this->p['Number1']));
	if(trim($this->p['Number2'])!="")
	  $endNumber = mysql_real_escape_string(trim($this->p['Number2']));

	$query = "SELECT  AR.opp ";
	$query .= " FROM ARTWORK AR RIGHT JOIN RLTN_WORKS_CATALOG R ON AR.opp = R.idArtwork";
	$query .= " LEFT JOIN CATVOLUMES C ON R.Catalog = C.Catalog and R.Volume = C.Volume WHERE";
	$query .= " R.Catalog = '$this->Catalog1'";
	
	if(isset($startNumber) || isset($endNumber))
	{
	  if(isset($startNumber))	//We assume i$startVolume is empty
	    $query .= " AND R.Number >= $startNumber";
	  if(isset($endNumber))	//We assume $endVolume is empty
	    $query .= " AND R.Number <= $endNumber";
	}
	return $query;
  }

 

private function getOrderby()
{
if($this->p['SortBy1'] == "Chronology")
{
  $direction = mysql_real_escape_string($this->p['SortDirection1']);
  $sqlOrderBy = " order by dateOrder(dateStart,dateStartFlag) $direction, dateOrder(dateEnd,dateEndFlag) $direction";
}
else if($this->p['SortBy1'] == "OPP")
{
  $direction = mysql_real_escape_string($this->p['SortDirection1']);
  $sqlOrderBy = " order by year(dateStart) $direction, opp $direction ";
}
else if($this->p['SortBy1'] == "Category")
{
  $direction = mysql_real_escape_string($this->p['SortDirection1']);
  $sqlOrderBy = " ORDER BY case category when 'painting' then 1 when 'sculpture' then 2 when 'collage' then 3 when 'photograph' then 4 when 'watercolor' then 5 when 'gouache' then 6 when 'pastel' then 7 when 'drawing' then 8 when 'ceramic' then 9 when 'engraving' then 10 when 'lithograph' then 11 else 12 end ";
}
else if(stripos($this->p['SortBy1'],"Catalog")!==false)
{
  $direction = mysql_real_escape_string($this->p['SortDirection1']);
  //$c = substr($this->p['SortBy1'], 7);
  $sqlOrderBy = " ORDER BY B.Catalog $direction, B.Volume $direction, B.Number $direction, B.Suffix $direction ";
}
else
{
  $sortby = mysql_real_escape_string($this->p['SortBy1']);
  $direction = mysql_real_escape_string($this->p['SortDirection1']);
  $sqlOrderBy = " order by $sortby $direction";
}

///////second one///////
if($this->p['SortBy2']!=$this->p['SortBy1'])
{
  if($this->p['SortBy2'] == "Chronology")
  {
    $direction = mysql_real_escape_string($this->p['SortDirection2']);
    $sqlOrderBy .= " ,dateOrder(dateStart,dateStartFlag) $direction, dateOrder(dateEnd,dateEndFlag) $direction";
  }
  else if($this->p['SortBy2'] == "OPP")
  {
    $direction = mysql_real_escape_string($this->p['SortDirection2']);
    $sqlOrderBy.= " ,year(dateStart) $direction, opp $direction ";
  }
  else if($this->p['SortBy2'] == "Category")
 {
  $direction = mysql_real_escape_string($this->p['SortDirection2']);
  $sqlOrderBy = " ORDER BY case category when 'painting' then 1 when 'sculpture' then 2 when 'collage' then 3 when 'photograph' then 4 when 'watercolor' then 5 when 'gouache' then 6 when 'pastel' then 7 when 'drawing' then 8 when 'ceramic' then 9 when 'engraving' then 10 when 'lithograph' then 11 else 12 end ";
 }
  else if(stripos($this->p['SortBy2'],"Catalog")!==false)
 {
  $direction = mysql_real_escape_string($this->p['SortDirection1']);
  //$c = substr($this->p['SortBy2'], 7);
  $sqlOrderBy .= " ,B.Catalog $direction, B.Volume $direction, B.Number $direction, B.Suffix $direction ";
 }
 else
 {
  $sortby = mysql_real_escape_string($this->p['SortBy2']);
  $direction = mysql_real_escape_string($this->p['SortDirection2']);
  $sqlOrderBy = " order by $sortby $direction";
 }
}
///////third one///////
if($this->p['SortBy3']!=$this->p['SortBy2'] && $this->p['SortBy3']!=$this->p['SortBy1'])
{
  if($this->p['SortBy3'] == "Chronology")
  {
    $direction = mysql_real_escape_string($this->p['SortDirection3']);
    $sqlOrderBy .= " ,dateOrder(dateStart,dateStartFlag) $direction, dateOrder(dateEnd,dateEndFlag) $direction";
  }
  else if($this->p['SortBy3'] == "OPP")
  {
    $direction = mysql_real_escape_string($this->p['SortDirection3']);
    $sqlOrderBy.= " ,year(dateStart) $direction, opp $direction ";
  }
else if($this->p['SortBy3'] == "Category")
{
  $direction = mysql_real_escape_string($this->p['SortDirection3']);
  $sqlOrderBy = " ORDER BY case category when 'painting' then 1 when 'sculpture' then 2 when 'collage' then 3 when 'photograph' then 4 when 'watercolor' then 5 when 'gouache' then 6 when 'pastel' then 7 when 'drawing' then 8 when 'ceramic' then 9 when 'engraving' then 10 when 'lithograph' then 11 else 12 end ";
}
else if(stripos($this->p['SortBy3'],"Catalog")!==false)
{
  $direction = mysql_real_escape_string($this->p['SortDirection1']);
  //$c = substr($this->p['SortBy3'], 7);
  $sqlOrderBy .= " ,B.Catalog $direction, B.Volume $direction, B.Number $direction, B.Suffix $direction ";
}
else
{
  $sortby = mysql_real_escape_string($this->p['SortBy3']);
  $direction = mysql_real_escape_string($this->p['SortDirection3']);
  $sqlOrderBy = " order by $sortby $direction";
}
}
return $sqlOrderBy;
}


private function analyzeSort() // if catalog exists in sortby
{
	if(stripos($this->p['SortBy1'],"Catalog")===false &&stripos($this->p['SortBy2'],"Catalog")===false&&stripos($this->p['SortBy2'],"Catalog")===false)
	  return 1;
	else
	  return 2;
}
 
 
private function generateSorting()
{
	if($this->p['SortBy1'] == "Chronology")
{
  $direction = mysql_real_escape_string($this->p['SortDirection1']);
  $sqlOrderBy = " order by dateOrder(dateStart,dateStartFlag) $direction, dateOrder(dateEnd,dateEndFlag) $direction";
}
else if($this->p['SortBy1'] == "OPP")
{
  $direction = mysql_real_escape_string($this->p['SortDirection1']);
  $sqlOrderBy = " order by year(dateStart) $direction, opp $direction ";
}
else if($this->p['SortBy1'] == "Category")
{
  $direction = mysql_real_escape_string($this->p['SortDirection1']);
  $sqlOrderBy = " ORDER BY case category when 'painting' then 1 when 'sculpture' then 2 when 'collage' then 3 when 'photograph' then 4 when 'watercolor' then 5 when 'gouache' then 6 when 'pastel' then 7 when 'drawing' then 8 when 'ceramic' then 9 when 'engraving' then 10 when 'lithograph' then 11 else 12 end ";
}
else
{
  $sortby = mysql_real_escape_string($this->p['SortBy1']);
  $direction = mysql_real_escape_string($this->p['SortDirection1']);
  $sqlOrderBy = " order by $sortby $direction";
}

///////second one///////
if($this->p['SortBy2']!=$this->p['SortBy1'])
{
  if($this->p['SortBy2'] == "Chronology")
  {
    $direction = mysql_real_escape_string($this->p['SortDirection2']);
    $sqlOrderBy .= " ,dateOrder(dateStart,dateStartFlag) $direction, dateOrder(dateEnd,dateEndFlag) $direction";
  }
  else if($this->p['SortBy2'] == "OPP")
  {
    $direction = mysql_real_escape_string($this->p['SortDirection2']);
    $sqlOrderBy.= " ,year(dateStart) $direction, opp $direction ";
  }
else if($this->p['SortBy2'] == "Category")
{
  $direction = mysql_real_escape_string($this->p['SortDirection2']);
  $sqlOrderBy = " ORDER BY case category when 'painting' then 1 when 'sculpture' then 2 when 'collage' then 3 when 'photograph' then 4 when 'watercolor' then 5 when 'gouache' then 6 when 'pastel' then 7 when 'drawing' then 8 when 'ceramic' then 9 when 'engraving' then 10 when 'lithograph' then 11 else 12 end ";
}
else
{
  $sortby = mysql_real_escape_string($this->p['SortBy2']);
  $direction = mysql_real_escape_string($this->p['SortDirection2']);
  $sqlOrderBy = " order by $sortby $direction";
}
}
///////third one///////
if($this->p['SortBy3']!=$this->p['SortBy2'] && $this->p['SortBy3']!=$this->p['SortBy1'])
{
  if($this->p['SortBy3'] == "Chronology")
  {
    $direction = mysql_real_escape_string($this->p['SortDirection3']);
    $sqlOrderBy .= " ,dateOrder(dateStart,dateStartFlag) $direction, dateOrder(dateEnd,dateEndFlag) $direction";
  }
  else if($this->p['SortBy3'] == "OPP")
  {
    $direction = mysql_real_escape_string($this->p['SortDirection3']);
    $sqlOrderBy.= " ,year(dateStart) $direction, opp $direction ";
  }
else if($this->p['SortBy3'] == "Category")
{
  $direction = mysql_real_escape_string($this->p['SortDirection3']);
  $sqlOrderBy = " ORDER BY case category when 'painting' then 1 when 'sculpture' then 2 when 'collage' then 3 when 'photograph' then 4 when 'watercolor' then 5 when 'gouache' then 6 when 'pastel' then 7 when 'drawing' then 8 when 'ceramic' then 9 when 'engraving' then 10 when 'lithograph' then 11 else 12 end ";
}
else
{
  $sortby = mysql_real_escape_string($this->p['SortBy3']);
  $direction = mysql_real_escape_string($this->p['SortDirection3']);
  $sqlOrderBy = " order by $sortby $direction";
}
}

return $sqlOrderBy;
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
  
  /// for Commentary page
  public function parseText($text)
  {
	$text = str_replace("<entry title=\"Text\">", "", $text);
	$text = str_replace("</entry>", "", $text);
	
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
	  $htmlText = $htmlLink."<i>".$acceptedtitle."</i> [".$tagText."]</a>";
	  
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
  public function getList($string)
  {
    $list = '';
    $query = "SELECT opp FROM NOTE_DATATABLE WHERE ".$string;
    $result = mysql_query($query);
    while($item = mysql_fetch_array($result))
    {
      $temp = '"'.(string)$item['opp'].'",';
      $list .= $temp;
    }
     return substr($list,0,-1);
  }
} 
?>