<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class RefSearch extends Database
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
    $limitStart = parent::ITEMS_PER_PAGE*($this->page-1);
	$limitEnd = parent::ITEMS_PER_PAGE;

// === Generate keyword constraint ======================================================================
$sqlKeywordConstraint = "";

for($i=1;$i<=7;$i++)
{
  $paraName = "Keyword$i";
  $keyword = mysql_real_escape_string(trim($this->p[$paraName]));
  if ($keyword !="")
  {
     $searchInName = "SearchIn$i";
	 $searchIn = mysql_real_escape_string($this->p[$searchInName]);
	 $sqlKeywordConstraint .= strlen($sqlKeywordConstraint)>0 ? " and " : "";
	 $sqlKeywordConstraint .= "$searchIn like '%$keyword%'";
  }	  
}
// ====================================================================================
if(strlen($sqlKeywordConstraint)>0) { $sqlKeywordConstraint = " where ($sqlKeywordConstraint)";}
// =======================================================================================================
// === Generate time constraint =======================================================
// $sqlTimeConstraint = ""; 

$refStartYear = mysql_real_escape_string($this->p['RefStartYear']);
$refEndYear = mysql_real_escape_string($this->p['RefEndYear']);

if (($refStartYear != "") && ($refEndYear != ""))
{
    $sqlTimeConstraint = "Date >= '". $refStartYear. "' and Date <= '" .$refEndYear. "' ";
}
else if (($refStartYear != "") && ($refEndYear = ""))
{
    $sqlTimeConstraint = "Date >= '". $refStartYear. "'";
}
else if  (($refStartYear = "") && ($refEndYear != ""))
{
    $sqlTimeConstraint = "Date <= '" .$refEndYear. "' ";
}
// ====================================================================================
        if (strlen($sqlTimeConstraint) > 0) {
            $sqlTimeConstraint = " and ($sqlTimeConstraint) ";
        }
// =======================================================================================================
	$sqlOrderBy = $this->getOrderby();
	$query = "SELECT SQL_CALC_FOUND_ROWS id,Author,Books,Catalogs,Title,Date,Publisher,Journal,Edition,Issue,Volume,Exhibitions FROM `REFERENCES` " .$sqlKeywordConstraint.$sqlTimeConstraint.$sqlOrderBy. " limit $limitStart, $limitEnd";
	$result = mysql_query($query);
//	$result = die($query);
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
  
  private function getOrderby()
  {
      if($this->p['SortBy1'] == "Author")
      {
          $direction = mysql_real_escape_string($this->p['SortDirection1']);
          $sqlOrderBy = " order by Author $direction";
      }
      else if($this->p['SortBy1'] == 'Title')
      {
          $direction = mysql_real_escape_string($this->p['SortDirection1']);
          $sqlOrderBy = " order by Title $direction";
      }
      else if($this->p['SortBy1'] == "Book No.")
      {
          $direction = mysql_real_escape_string($this->p['SortDirection1']);
          $sqlOrderBy = " order by Books $direction";
      }
      else if ($this->p['SortBy1'] == "Exhibit No.")
      {
          $direction = mysql_real_escape_string($this->p['SortDirection1']);
          $sqlOrderBy = " order by Exhibitions $direction";
      }
      else if ($this->p['SortBy1'] == "Catalog No.")
      {
          $direction = mysql_real_escape_string($this->p['SortDirection1']);
          $sqlOrderBy = " order by Catalogs $direction";
      }
      else if ($this->p['SortBy1'] == "Date")
      {
          $direction = mysql_real_escape_string($this->p['SortDirection1']);
          $sqlOrderBy = " order by Date $direction";
      }
     
    ///// second one //////
      if($this->p['SortBy2']!=$this->p['SortBy1'])
      {
          if($this->p['SortBy2'] == "Author")
          {
            $direction = mysql_real_escape_string($this->p['SortDirection2']);
            $sqlOrderBy .= " ,Author $direction";
          }
          else if($this->p['SortBy2'] == "Title")
          {
            $direction = mysql_real_escape_string($this->p['SortDirection2']);
            $sqlOrderBy .= " ,Title $direction";
          }
          else if($this->p['SortBy2'] == "Book No.")
          {
          $direction = mysql_real_escape_string($this->p['SortDirection2']);
          $sqlOrderBy .= " ,Books $direction";
          }
      else if ($this->p['SortBy2'] == "Exhibit No.")
          {
          $direction = mysql_real_escape_string($this->p['SortDirection2']);
          $sqlOrderBy .= " ,Exhibitions $direction";
          }
      else if ($this->p['SortBy2'] == "Catalog No.")
          {
          $direction = mysql_real_escape_string($this->p['SortDirection2']);
          $sqlOrderBy .= " ,Catalogs $direction";
          }
      else if ($this->p['SortBy2'] == "Date")
          {
          $direction = mysql_real_escape_string($this->p['SortDirection2']);
          $sqlOrderBy .= " ,Date $direction";
          }
     
      }
      
      ////third one///////
      if($this->p['SortBy3']!=$this->p['SortBy2'] && $this->p['SortBy3']!=$this->p['SortBy1'])
      {
          if($this->p['SortBy3'] == "Author")
          {
            $direction = mysql_real_escape_string($this->p['SortDirection3']);
            $sqlOrderBy .= " ,Author $direction";
          }
          else if($this->p['SortBy3'] == "Title")
          {
            $direction = mysql_real_escape_string($this->p['SortDirection3']);
            $sqlOrderBy .= " ,Title $direction";
          }
          else if($this->p['SortBy2'] == "Book No.")
          {
          $direction = mysql_real_escape_string($this->p['SortDirection3']);
          $sqlOrderBy .= " ,Books $direction";
          }
      else if ($this->p['SortBy3'] == "Exhibit No.")
          {
          $direction = mysql_real_escape_string($this->p['SortDirection3']);
          $sqlOrderBy .= " ,Exhibitions $direction";
          }
      else if ($this->p['SortBy3'] == "Catalog No.")
          {
          $direction = mysql_real_escape_string($this->p['SortDirection3']);
          $sqlOrderBy .= " ,Catalogs $direction";
          }
      else if ($this->p['SortBy3'] == "Date")
          {
          $direction = mysql_real_escape_string($this->p['SortDirection3']);
          $sqlOrderBy .= " ,Date $direction";
          }
  }
    return $sqlOrderBy;           
  }
  
  public function getAllExhibitedData()
  {
      $limitStart = parent::ITEMS_PER_PAGE*($this->page-1);
	$limitEnd = parent::ITEMS_PER_PAGE;
        
        $query = "SELECT SQL_CALC_FOUND_ROWS id,Author,Books,Catalogs,Title,Date,Publisher,Journal,Edition,Issue,Volume,Exhibitions FROM `REFERENCES` WHERE Exhibitions Like '%*%' ORDER BY Date, Author limit $limitStart, $limitEnd";
	$result = mysql_query($query);
	//$result = die($query);
	return $result;        
      
  }
  
} 
?>
