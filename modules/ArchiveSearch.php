<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class ArchiveSearch extends Database
{
  private $p;
  private $page; // the # of current page
  private $total;
  private $sortby;
  
  function __construct($param) 
  {
    parent::__construct(); 
	$this->p = $param;
	
	if(isset($param['page']))
	  $this->page = $param['page'];
	else
	  $this->page = 1;
	 
	if(isset($param['sortby'])) 
	  $this->sortby = explode("_", mysql_real_escape_string($param['sortby']));
	else
	  $this->sortby = "";
  }
    
  public function getData()  //operate on database to get data
  {
    $limitStart = parent::ITEMS_PER_PAGE*($this->page-1);
	$limitEnd = parent::ITEMS_PER_PAGE;
	
// === Generate order by constraint =======================================================
	$sort = " order by ";
	if($this->sortby != "")
	  foreach($this->sortby as $s)
	    $sort .= $s." Asc , ";
	
	$sort .= " DateOrder(Date,DateFlag) DESC ";
// ========================================================================================
// === Generate Title constraint =======================================================
$sqlConstraint = "";
$Title = mysql_real_escape_string(trim($this->p['Title']));
if ($Title!="")
{
	$sqlConstraint = " where (MATCH title AGAINST ( '+\"$Title\"' IN BOOLEAN MODE)) ";
}
// ========================================================================================
// === Generate keywords constraint =======================================================
$Keywords = mysql_real_escape_string(trim($this->p['Keywords']));
if ($Keywords!="")
{
	if($sqlConstraint != "")
    	$sqlConstraint .= " and (MATCH text AGAINST ('+\"$Keywords\"' IN BOOLEAN MODE))  ";
    else
		$sqlConstraint = " where (MATCH text AGAINST ('+\"$Keywords\"' IN BOOLEAN MODE)) ";
}
// ========================================================================================
// === Generate time constraint =======================================================
if(isset($this->p['RestrictByYear']))
{
  $startYear = mysql_real_escape_string($this->p['YearStart']);
  $endYear = mysql_real_escape_string($this->p['YearEnd']);
  if($this->p['DateType'] == "in") $timeConstraint = " YEAR(Date) = $startYear ";
  else if($this->p['DateType'] == "before") $timeConstraint = " YEAR(Date) < $startYear ";
  else if($this->p['DateType'] == "after") $timeConstraint = " YEAR(Date) > $startYear ";
  else $timeConstraint = " YEAR(Date) >= $startYear and YEAR(Date) <= $endYear ";
  
  if($sqlConstraint != "")
    $sqlConstraint .= " and $timeConstraint ";
  else
    $sqlConstraint = " where $timeConstraint ";
}
// ========================================================================================
// === Generate publisher constraint =======================================================
if(isset($this->p['RestrictByPub']))
{
  $Keywords = mysql_real_escape_string(trim($this->p['Pub']));
  if ($Keywords!="")
  {
	$sqlPublisherConstraint = " Publisher LIKE '%$Keywords%' "; 
	
  if($sqlConstraint != "")
    $sqlConstraint .= " and $sqlPublisherConstraint ";
  else
    $sqlConstraint = " where $sqlPublisherConstraint ";
  }
}
// ========================================================================================
// === Generate language constraint =======================================================
if(isset($this->p['RestrictByLan']))
{
  $LanguageConstraint = "('ok'";
  if(isset($this->p['LanEN']))
    $LanguageConstraint .= ",'en'";
  if(isset($this->p['LanIT']))
    $LanguageConstraint .= ",'it'";
  if(isset($this->p['LanRU']))
    $LanguageConstraint .= ",'ru'";
  if(isset($this->p['LanES']))
    $LanguageConstraint .= ",'es'";
  if(isset($this->p['LanPT']))
    $LanguageConstraint .= ",'pt'";
  if(isset($this->p['LanNL']))
    $LanguageConstraint .= ",'nl'";
  if(isset($this->p['LanFR']))
    $LanguageConstraint .= ",'fr'";
  if(isset($this->p['LanCA']))
    $LanguageConstraint .= ",'ca'";
  if(isset($this->p['LanSV']))
    $LanguageConstraint .= ",'sv'";
  if(isset($this->p['LanDE']))
    $LanguageConstraint .= ",'de'";
  if(isset($this->p['LanJA']))
    $LanguageConstraint .= ",'ja'";
  if(isset($this->p['LanNO']))
    $LanguageConstraint .= ",'no'";
	
  $LanguageConstraint .= ")";
  
  if($LanguageConstraint !="('ok')")
  {
    if($sqlConstraint != "")
      $sqlConstraint .= " and Language in $LanguageConstraint ";
    else
      $sqlConstraint = " where Language in $LanguageConstraint ";
  } 
}
// ========================================================================================
	
	
	$query = "SELECT SQL_CALC_FOUND_ROWS id,Title,Publisher,YEAR(Date) AS Year,MONTH(Date) AS Month,DAY(Date) AS Day,Language FROM `ARCHIVES` $sqlConstraint $sort limit $limitStart, $limitEnd";
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
  
  

} 
?>
