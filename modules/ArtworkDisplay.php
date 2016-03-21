<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class ArtworkDisplay extends Database
{
  private $year;
  private $page; // the # of current page
  private $quarter;
  private $category;
  private $total;
  
  function __construct($param) 
  {
    parent::__construct(); 
	$this->year = $param['year'];
	
	if(isset($param['quarter']))
	  $this->quarter = mysql_real_escape_string($param['quarter']);
	else
      $this->quarter = 1;
	  
	if(isset($param['category']))
	{
	  $this->category = "('" . $param['category'];
	  $this->category .= "')";
	  $this->category = str_replace("_", "','", $this->category);
	}
	else
$this->category="('nothing')";

	if(isset($param['page']))
	  $this->page = $param['page'];
	else
	  $this->page = 1;
  }
    
  public function getData()  //operate on database to get data
  {
    $limitStart = parent::ITEMS_PER_PAGE*($this->page-1);
	$limitEnd = parent::ITEMS_PER_PAGE;
	
	//$query = "select SQL_CALC_FOUND_ROWS opp,notVerified,title from `ARTWORK` where YEAR(dateStart) = $this->year and category in $this->category order by dateStart ASC, dateStartFlag ASC, dateEnd ASC, dateEndFlag ASC limit $limitStart, $limitEnd " ;
	//$query2 = "(select 1 AS sort_col, dateStart, dateStartFlag, dateEnd, dateEndFlag, opp,notVerified,title from `ARTWORK` where YEAR(dateStart) = $this->year and category in $this->category and dateStart NOT LIKE '%00-00' and  dateEnd NOT LIKE '%00-00') UNION (select 2, dateStart, dateStartFlag, dateEnd, dateEndFlag,opp,notVerified,title from `ARTWORK` where YEAR(dateStart) = $this->year and category in $this->category and dateStart LIKE '%00-00' and  dateEnd LIKE '%00-00') order by sort_col asc, dateStart ASC, dateStartFlag ASC, dateEnd ASC, dateEndFlag ASC" ;
	if ($this->quarter == 4)
	  $query2 = "(select 1 AS sort_col, dateStart, dateStartFlag, dateEnd, dateEndFlag, opp,notVerified,title from `ARTWORK` where YEAR(dateStart) = $this->year and category in $this->category and dateStart NOT LIKE '%00-00' and ArtworkQuarter(dateStart, dateStartFlag) = $this->quarter) UNION (select 2, dateStart, dateStartFlag, dateEnd, dateEndFlag,opp,notVerified,title from `ARTWORK` where YEAR(dateStart) = $this->year and category in $this->category and dateStart LIKE '%00-00' and ArtworkQuarter(dateStart, dateStartFlag) = $this->quarter) order by sort_col asc, dateStart ASC, dateStartFlag ASC, dateEnd ASC, dateEndFlag ASC" ;
	else
	  $query2 = "select 1 AS sort_col, dateStart, dateStartFlag, dateEnd, dateEndFlag, opp,notVerified,title from `ARTWORK` where YEAR(dateStart) = $this->year and category in $this->category and ArtworkQuarter(dateStart, dateStartFlag) = $this->quarter order by sort_col asc, dateStart ASC, dateStartFlag ASC, dateEnd ASC, dateEndFlag ASC" ;
	$query = "select SQL_CALC_FOUND_ROWS * from ($query2) A limit $limitStart, $limitEnd";
	$result = mysql_query($query) or die(mysql_error());
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