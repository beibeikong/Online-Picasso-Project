
<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');
class ArtworkConcordance extends Database
{
  private $year;
  private $page; // the # of current page
  private $total;
  private $curntCatalogs;
  private $allCatalogs;
  private $sortby;
  function __construct($param) 
  {
    parent::__construct(); 
	
	if(isset($param['year']))
	  $this->year = mysql_real_escape_string($param['year']);
	else
	  $this->year = 1881;
	  
	
	if(isset($param['page']))
	  $this->page = mysql_real_escape_string($param['page']);
	else
	  $this->page = 1;
					  
    if(isset($param['catalog']))
	  $this->curntCatalogs = explode("_", mysql_real_escape_string($param['catalog']));
	else
      $this->curntCatalogs = array("OPP","Z","PP","P","DB","DR","LD","Ba","B","MPP","MPB");
	  
	if(isset($param['sortby']))
	  $this->sortby = mysql_real_escape_string($param['sortby']);
	else
      $this->sortby = "OPP";
	  
	$this->allCatalogs =  mysql_query("select * from `CATALOGS`");
  }
    
  public function getData()  //operate on database to get data
  {
    if($this->sortby=="OPP")
      $query = $this->getSQLSortbyOPP();
	else
	  $query = $this->getSQLSortbyOther();
	  
	$result = mysql_query($query) or die(mysql_error());
	return $result;
  }
  
  public function getSQLSortbyOther()
  {
    $limitStart = 100*($this->page-1);
	$limitEnd = 100;
	$query = "select SQL_CALC_FOUND_ROWS R.idArtwork as OPP";
	
	$year = substr($this->year,2);
	foreach($this->curntCatalogs as $cata)
	{
	  if($cata!="OPP")
	  {
	    if($cata==$this->sortby)
		  $query .= ", GetCatalogSortby(R.idArtwork,'$cata',R.Catalog,R.Volume,R.Number,R.Suffix)  as $cata";
		else
		  $query .= ", GetCatalog(R.idArtwork,'$cata') as $cata" ;
	  }
	}
	$query .= " from RLTN_WORKS_CATALOG R where R.idArtwork like '%$year:%' and R.Catalog = '$this->sortby' order by R.Catalog ASC, R.Volume ASC, R.Number ASC, R.Suffix ASC limit $limitStart, $limitEnd";
	
	return $query;
    
  }
  
  public function getSameCataOPP($opp)
  {
    $query = "select distinct a.idArtwork from RLTN_WORKS_CATALOG a, RLTN_WORKS_CATALOG b where b.idArtwork='$opp' and a.idArtwork<>'$opp' and a.Catalog=b.Catalog and a.Volume=b.Volume and a.Number=b.Number and a.Suffix=b.Suffix;";
 	$result = mysql_query($query) or die(mysql_error());
	$s='';
	while(($row = mysql_fetch_array($result)))
		$s .= "<br>&nbsp;<a href=\"index.php?view=ArtworkInfo&OPPID=$row[0]\" target=\"_blank\" class=\"opplink1\" onclick=\"OpenWin(this.href, 'ArtworkInfo', 740, 550); return false;\">$row[0]</a>";
		
	$s .= "</td>";
	return $s;
  }

  
  public function getSQLSortbyOPP()
  {
    $limitStart = 100*($this->page-1);
	$limitEnd = 100;
	$query = "select SQL_CALC_FOUND_ROWS 1";
	foreach($this->curntCatalogs as $cata)
	{
	  if($cata!="OPP")
	    $query .= ", GetCatalog(opp,'$cata') as $cata" ;
	  else
	    $query .= ", opp as OPP";
	}
	$query .= " from ARTWORK  where YEAR(dateStart) = $this->year order by opp ASC limit $limitStart, $limitEnd";
	
	return $query;
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
  
  public function getAvailCatalog()
  { 
     $ac = array(); // ac means available catalogs
	 $found = false;
	 mysql_data_seek($this->allCatalogs, 0);
	 while($row = mysql_fetch_array($this->allCatalogs))
	 {
	    $found = false;
		foreach($this->curntCatalogs as $cata)
	   {
	     if($row['Abbr'] == $cata)
		 {
		   $found = true; break;
		 }
	   }
	   if($found == false)
	     $ac[$row['Abbr']] = $row['Name'];
	 }
	 asort($ac);
	 return $ac;
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
  

} 
?>