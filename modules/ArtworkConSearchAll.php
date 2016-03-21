<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');
//require_once('MenuArtworkSearch.php');
class ArtworkConSearchAll extends Database
{
  private $CatalogID;	//searched catalog
  private $page; // the # of current page
  private $total;
  private $curntCatalogs;
  private $allCatalogs;
  private $volumesForCatalogID;
  private $sortby;	//sortby get from url
  private $rawSortby; //when you sort by catalog other than OPP, we need to get rid of "Catalog" in front of the real catalog ID.
  function __construct($param) 
  {
    parent::__construct(); 
	
	$this->p = $param;
	
	$this->CatalogID = $param['CatalogID'];
	if(isset($param['page']))
	  $this->page = $param['page'];
	else
	  $this->page = 1;

	if(isset($param['SortBy']))
	{
	  $this->sortby = mysql_real_escape_string($param['SortBy']);
	  if(stripos($param['SortBy'],"Catalog")!==false)
	  {
		$this->rawSortby = substr($this->sortby, strlen("Catalog "));
	  }
	}
	else
      $this->sortby = "OPP";
	  
    $this->curntCatalogs = array("OPP","Z","PP","P","DB","DR","LD","Ba","B","MPP","MPB","AR","CC","M","FM","C","MPM","MPA","GC","WS");
	  
	if($this->CatalogID != "OPP")
	{
	  if(in_array($this->CatalogID, $this->curntCatalogs)===false)
	    array_push($this->curntCatalogs, $this->CatalogID);
	}

	$this->allCatalogs =  mysql_query("select * from `CATALOGS`");
	$this->volumesForCatalogID = mysql_query("select * from `CATVOLUMES` where Catalog = '$this->CatalogID'");
  }
    
  private function isSearchedCatalogHasVolume()
  {
    $i = 0;
	$hasVolumenInRow = true;
	while($row=mysql_fetch_array($this->volumesForCatalogID)) {
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
	
  public function getData()  //operate on database to get data
  {
	// if search range catalog is OPP
	if($this->p['CatalogID']=='OPP')
	{
	  if (stripos($this->p['SortBy'],"Catalog")!==false)	//if sortby or catalog other than OPP
	    $query = $this->getSQLForOppSortByCata();
	  else	// if sortby OPP related attribute, like OPP, medium, title, etc...
	    $query = $this->getSQLForOppSortByOpp();
	}
    else  // if search range catalog other than OPP
	{
	  if($this->isSearchedCatalogHasVolume() === true)
	    $query = $this->getSQLForVolumedCata();
	  else
	    $query = $this->getSQLForUnvolumedCata();
	} 
	$result = mysql_query($query) or die(mysql_error());
	return $result;
  }

   public function getSuffixConstrain()
  {
    $suffixConstraint='';
    if(trim($this->p['Suffix1'])!="")
    {
     $suffixConstraint = " and opp IN ( select idArtwork from RLTN_WORKS_CATALOG where Suffix not like '' and ";
     $temp1 = mysql_real_escape_string(trim($this->p['Suffix1']));
     $temp2 = mysql_real_escape_string(trim($this->p['Suffix2']));
     $suffixConstraint .= "Suffix >= '$temp1' and Suffix <= '$temp2')";  
    }
    return $suffixConstraint;
  }
  
  public function getSQLForOppSortByOpp()
  {
    $limitStart = 100*($this->page-1);
	$limitEnd = 100;
	
	$customCatalog = $this->p['CatalogID']; 	//$this->p['CatalogID'] is 'OPP' here
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
	
	$query = "SELECT SQL_CALC_FOUND_ROWS A.category";
	foreach($this->curntCatalogs as $cata)
	{
	  if($cata!="OPP")
	    $query .= ", GetCatalog(A.opp,'$cata') AS $cata" ;
	  else
	    $query .= ", A.opp AS OPP";
	}
	$query .= " FROM ARTWORK A ";
	
	if(isset($startYear) || isset($endYear))
	{
	  
	  if($startYear !== $endYear)
	  {	
	    $query .= " WHERE";
		if (isset($startYear))
		{
		  $query .= " YEAR(A.dateStart)";
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
		  $query .= " YEAR(A.dateStart)";
		  if(isset($OPPCatalog2))
		    $query .= " <";
		  else
		    $query .= " <=";
		  $query .=" $endYear";
		}
		
		//We assume if the $startNumber is set, the $startVolume must exists
		if(isset($OPPCatalog1))
		  $query .= " OR (YEAR(A.dateStart) = $startYear AND A.opp >= '$OPPCatalog1')";
		
		//We assume if the $endNumber is set, the $endVolume must exists
		if(isset($OPPCatalog2))
		  $query .= " OR (YEAR(A.dateStart) = $endYear AND A.opp <= '$OPPCatalog2')";
	
	  }
	  else	//$startYear === $endYear
	  {
	    if(isset($startYear))
		  $query .= " WHERE YEAR(A.dateStart) = '$startYear'";
		if(isset($OPPCatalog1))	//We assume if the $startNumber is set, the $startVolume must exists
		  $query .= " AND A.opp >= '$OPPCatalog1'";
		if(isset($OPPCatalog2))	//We assume if the $endNumber is set, the $endVolume must exists
		  $query .= " AND A.opp <= '$OPPCatalog2'";		
	  }
	}
	$query .= $this->getSuffixConstrain();
	$sqlOrderBy = $this->generateSorting();
	$query .= $sqlOrderBy;
	$query .= " limit $limitStart, $limitEnd";
	return $query;
  }
 
  public function getSQLForOppSortByCata()
  {
    $limitStart = 100*($this->page-1);
	$limitEnd = 100;
	
	$customCatalog = $this->p['CatalogID']; 	//$this->p['CatalogID'] is 'OPP' here
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

	$query = "SELECT SQL_CALC_FOUND_ROWS A.opp as OPP, A.category";
	foreach($this->curntCatalogs as $cata)
	{
	  if($cata!="OPP")
	  {
	    if($cata==$this->rawSortby)
		  $query .= ", GetCatalogSortby(R.idArtwork,'$cata',R.Catalog,R.Volume,R.Number,R.Suffix)  as $cata";
		else
		  $query .= ", GetCatalog(R.idArtwork,'$cata') as $cata" ;
	  }
	}
	$query .= " FROM ARTWORK A RIGHT JOIN RLTN_WORKS_CATALOG R ON A.opp = R.idArtwork WHERE";
	if(isset($startYear) || isset($endYear) || isset($OPPCatalog1) || isset($OPPCatalog2))
	{
		$query .= " (";
		if(isset($startYear) || isset($endYear))
		{
		  
		  if($startYear !== $endYear)
		  {		
			if (isset($startYear))
			{
			  $query .= " YEAR(A.dateStart)";
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
			  $query .= " YEAR(A.dateStart)";
			  if(isset($OPPCatalog2))
				$query .= " <";
			  else
				$query .= " <=";
			  $query .=" $endYear";
			}
			
			//We assume if the $startNumber is set, the $startVolume must exists
			if(isset($OPPCatalog1))
			  $query .= " OR (YEAR(A.dateStart) = $startYear AND A.opp >= '$OPPCatalog1')";
			
			//We assume if the $endNumber is set, the $endVolume must exists
			if(isset($OPPCatalog2))
			  $query .= " OR (YEAR(A.dateStart) = $endYear AND A.opp <= '$OPPCatalog2')";
		
		  }
		  else	//$startYear === $endYear
		  {
			if(isset($startYear))
			  $query .= " YEAR(A.dateStart) = '$startYear'";
			if(isset($OPPCatalog1))	//We assume if the $startNumber is set, the $startVolume must exists
			  $query .= " AND A.opp >= '$OPPCatalog1'";
			if(isset($OPPCatalog2))	//We assume if the $endNumber is set, the $endVolume must exists
			  $query .= " AND A.opp <= '$OPPCatalog2'";		
		  }
		}
		$query .= ") AND";
	}
	$query .= " R.Catalog = '$this->rawSortby' "; 	
        $query .= $this->getSuffixConstrain();
	$sqlOrderBy = $this->generateSorting();
	$query .= $sqlOrderBy;
	$query .= " limit $limitStart, $limitEnd";
	return $query;
  }
  
  public function getSQLForVolumedCata()
  {
    $limitStart = 100*($this->page-1);
	$limitEnd = 100;
	
	if ($this->p['Volume1']!="All")
	  $startVolume = mysql_real_escape_string($this->p['Volume1']);
	if ($this->p['Volume2']!="All")
	  $endVolume = mysql_real_escape_string($this->p['Volume2']);
	  
	if(trim($this->p['Number1'])!="")
	  $startNumber = mysql_real_escape_string(trim($this->p['Number1']));
	if(trim($this->p['Number2'])!="")
	  $endNumber = mysql_real_escape_string(trim($this->p['Number2']));

	$query = "SELECT SQL_CALC_FOUND_ROWS A.opp as OPP, A.category";
	foreach($this->curntCatalogs as $cata)
	{
	  if($cata!="OPP")
	  {
	    if($cata==$this->rawSortby)
		  $query .= ", GetCatalogSortby(R.idArtwork,'$cata',R.Catalog,R.Volume,R.Number,R.Suffix)  as $cata";
		else
		  $query .= ", GetCatalog(R.idArtwork,'$cata') as $cata" ;
	  }
	}
	$query .= " FROM ARTWORK A RIGHT JOIN RLTN_WORKS_CATALOG R ON A.opp = R.idArtwork";
	$query .= " LEFT JOIN CATVOLUMES C ON R.Catalog = C.Catalog and R.Volume = C.Volume WHERE";
	$query .= " R.Catalog = '$this->CatalogID'";
	
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
		  $query .=" (SELECT VolumeOrder FROM CATVOLUMES where Catalog = '$this->CatalogID' and Volume = '$startVolume')";
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
		  $query .=" (SELECT VolumeOrder FROM CATVOLUMES where Catalog = '$this->CatalogID' and Volume = '$endVolume')";
		}
	    $query .= " )";
		
		//We assume if the $startNumber is set, the $startVolume must exists
		if(isset($startNumber))
		{
		  $query .= " OR (";
		  $query .= " C.VolumeOrder = (SELECT VolumeOrder FROM CATVOLUMES where Catalog = '$this->CatalogID' and Volume = '$startVolume') AND R.Number >= $startNumber";
		  $query .= " )";
		}
		
		//We assume if the $endNumber is set, the $endVolume must exists
		if(isset($endNumber))
		{
		  $query .= " OR (";
		  $query .= " C.VolumeOrder = (SELECT VolumeOrder FROM CATVOLUMES where Catalog = '$this->CatalogID' and Volume = '$endVolume') AND R.Number <= $endNumber";
		  $query .= " )";
		}
	
	  }
	  else	//$startVolume === $endVolume
	  {
		$query .= " C.VolumeOrder = (SELECT VolumeOrder FROM CATVOLUMES where Catalog = '$this->CatalogID' and Volume = '$startVolume')";
		if(isset($startNumber))	//We assume if the $startNumber is set, the $startVolume must exists
		  $query .= " AND R.Number >= $startNumber";
		if(isset($endNumber))	//We assume if the $endNumber is set, the $endVolume must exists
		  $query .= " AND R.Number <= $endNumber";		
	  }  
	  $query .= " )";
	}
        $query .= $this->getSuffixConstrain();
	$sqlOrderBy = $this->generateSorting();
	$query .= $sqlOrderBy;
	$query .= " limit $limitStart, $limitEnd";
	return $query;
  }


  public function getSQLForUnvolumedCata()
  {
    $limitStart = 100*($this->page-1);
	$limitEnd = 100;
	
	if ($this->p['Volume1']!="All")
	  $startVolume = mysql_real_escape_string($this->p['Volume1']);
	if ($this->p['Volume2']!="All")
	  $endVolume = mysql_real_escape_string($this->p['Volume2']);
	  
	if(trim($this->p['Number1'])!="")
	  $startNumber = mysql_real_escape_string(trim($this->p['Number1']));
	if(trim($this->p['Number2'])!="")
	  $endNumber = mysql_real_escape_string(trim($this->p['Number2']));

	$query = "SELECT SQL_CALC_FOUND_ROWS A.opp as OPP, A.category";
	foreach($this->curntCatalogs as $cata)
	{
	  if($cata!="OPP")
	  {
	    if($cata==$this->rawSortby)
		  $query .= ", GetCatalogSortby(R.idArtwork,'$cata',R.Catalog,R.Volume,R.Number,R.Suffix)  as $cata";
		else
		  $query .= ", GetCatalog(R.idArtwork,'$cata') as $cata" ;
	  }
	}
	$query .= " FROM ARTWORK A RIGHT JOIN RLTN_WORKS_CATALOG R ON A.opp = R.idArtwork";
	$query .= " LEFT JOIN CATVOLUMES C ON R.Catalog = C.Catalog and R.Volume = C.Volume WHERE";
	$query .= " R.Catalog = '$this->CatalogID'";
	
	if(isset($startNumber) || isset($endNumber))
	{
	  if(isset($startNumber))	//We assume i$startVolume is empty
	    $query .= " AND R.Number >= $startNumber";
	  if(isset($endNumber))	//We assume $endVolume is empty
	    $query .= " AND R.Number <= $endNumber";
	}
        $query .= $this->getSuffixConstrain();
	$sqlOrderBy = $this->generateSorting();
	$query .= $sqlOrderBy;
	$query .= " limit $limitStart, $limitEnd";
	return $query;
  }

  private function generateSorting()
  {
	if($this->sortby == "Chronology")
	{
	  $direction = mysql_real_escape_string($this->p['SortDirection']);
	  $sqlOrderBy = " order by dateOrder(A.dateStart,A.dateStartFlag) $direction, dateOrder(A.dateEnd,A.dateEndFlag) $direction";
	}
	else if($this->sortby == "OPP")
	{
	  $direction = mysql_real_escape_string($this->p['SortDirection']);
	  $sqlOrderBy = " order by year(A.dateStart) $direction, A.opp $direction ";
	}
	else if($this->sortby == "Category")
	{
	  $direction = mysql_real_escape_string($this->p['SortDirection']);
	  $sqlOrderBy = " ORDER BY case A.category when 'painting' then 1 when 'sculpture' then 2 when 'collage' then 3 when 'photograph' then 4 when 'watercolor' then 5 when 'gouache' then 6 when 'pastel' then 7 when 'drawing' then 8 when 'ceramic' then 9 when 'engraving' then 10 when 'lithograph' then 11 else 12 end ";
	}
	else if(stripos($this->sortby,"Catalog")!==false)
	{
	  $direction = mysql_real_escape_string($this->p['SortDirection']);
	  $sqlOrderBy = " ORDER BY R.Catalog $direction, R.Volume $direction, R.Number $direction, R.Suffix $direction ";
	}
	else
	{
	  $sortby = mysql_real_escape_string($this->p['SortBy']);
	  $direction = mysql_real_escape_string($this->p['SortDirection']);
	  $sqlOrderBy = " order by A.$sortby $direction";
	}
	return $sqlOrderBy;
  }

  public function getSameCataOPP($opp)
  {
    $query = "select distinct a.idArtwork from RLTN_WORKS_CATALOG a, RLTN_WORKS_CATALOG b where b.idArtwork='$opp' and a.idArtwork<>'$opp' and a.Catalog=b.Catalog and a.Volume=b.Volume and a.Number=b.Number and a.Suffix=b.Suffix;";
 	$result = mysql_query($query) or die(mysql_error());
	$s='';
	while(($row = mysql_fetch_array($result)))
		$s .= "<br>&nbsp;<a href=\"index.php?view=ArtworkInfo&OPPID=$row[0]\" target=\"_blank\" class=\"opplink1\" onclick=\"OpenWin(this.href, 'ArtworkInfo', 740, 427); return false;\">$row[0]</a>";
		
	$s .= "</td>";
	return $s;
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
    return ceil($this->total/100);
  }
  
  public function getCurrentCatalog()
  {
	 $cc = array(); // cc means current catalogs
	 foreach($this->curntCatalogs as $cata)
	 {
	   if($cata=="OPP") {$cc[$cata]="Enrique Mallen"; continue; }
	   mysql_data_seek($this->allCatalogs, 0);
	   while($row = mysql_fetch_array($this->allCatalogs))
	   {
	     if($row['Abbr'] == $cata)
		 {
		   $cc[$cata] = $row['Name'];
		   break;
		 }
	   }
	 }
	 return $cc;
  }
  
  public function getName()
  {
	 $ccn = array(); // cc means current catalogs 
	 foreach($this->curntCatalogs as $cata)
	 {
	   if($cata=="OPP") {$ccn[$cata]="Mallen"; continue; }
	   mysql_data_seek($this->allCatalogs, 0);
	   while($row = mysql_fetch_array($this->allCatalogs))
	     if($row['Abbr'] == $cata)
		 {
		   $ccn[$cata] = $row['Authors'];
		   break;
		 }
	 }
	 return $ccn;
  }

  // get the sort catalog when click front end column header
  public function getFrontEndColumnSortBy($catalog)
  {
	 if ($catalog == "OPP")
	   return $catalog;
	 else
	 {
	   $result = urlencode("Catalog ".$catalog);
	   return $result;
	 }
  }

} 
?>