<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class MasterArtwork extends Database
{
  private $author;
  private $sortby;
  private $p;
  private $page; // the # of current page
  private $total;
 private $ITEMS_PER_PAGE = 30;

  function __construct($param) 
  {
    parent::__construct();
	
	$this->p = $param;
	if(isset($param['author']))
		$this->author = $param['author'];
		$this->author = str_replace("'","\'",$this->author);
		 
	if(isset($param['SortBy']))
		$this->sortby = $param['SortBy'];
	else
		$this->sortby = "Chronology"; 

	if(isset($param['page']))
	  $this->page = $param['page'];
	else
	  $this->page = 1;
	
	
  }
    
  public function getData()  //operate on database to get data
  {
       $limitStart = parent::ITEMS_PER_PAGE*($this->page-1);
	$limitEnd = parent::ITEMS_PER_PAGE;


	$query = "select SQL_CALC_FOUND_ROWS masteropp,title,author,duration,dimension,medium,collection,commentary,YEAR(dateStart) AS StartYear,MONTH(dateStart) AS StartMonth,DAY(dateStart) AS StartDay,dateStartFlag,YEAR(dateEnd) AS EndYear,MONTH(dateEnd) AS EndMonth,DAY(dateEnd) AS EndDay,dateEndFlag  from `MASTERARTWORK`" ;
	//$query2 = "(select 1 AS sort_col, dateStart, dateStartFlag, dateEnd, dateEndFlag, masteropp, title, author, duration, dimension, medium, collection, commentary from 'MASTERARTWORK' where YEAR(dateStart) AS StartYear, MONTH(dateStart) AS StartMonth, DAY(dateStart) AS StartDay and dateStart NOT LIKE '%00-00' and dateEnd NOT LIKE '%00-00') UNION (select 2, dateStart, dateStartFlag, dateEnd, DateEndFlag, masteropp, title, author, duration, dimension, medium, collection, commentary from 'MASTERARTWORK' where YEAR(dateStart) AS StartYear, MONTH(dateStart) AS StartMonth, DAY(dateStart) AS StartDay and dateStart NOT LIKE '%00-00' and dateEnd NOT LIKE '%00-00') order by sort_col asc, dateStart ASC, dateStartFlag ASC, DateEnd ASC, dateEndFlag ASC";
       //$query  "select SQL_CALC_FOUND_ROWS masteropp from 'MASTERARTWORK'  limit $limitStart, $limitEnd";
       if(isset($this->p['author']))
		$constraint = " where author = '$this->author'";
	else
		$constraint = "";
	$query = $query.$constraint;
// === Generate sorting. ===============================================================
if($this->sortby == "Chronology")
{
  $sqlOrderBy = " order by dateOrder(dateStart,dateStartFlag) $this->sortdirection, dateOrder(dateEnd,dateEndFlag) $this->sortdirection";
}
elseif ($this->sortby  == "OPP")	//sort by masteropp
{
  $sqlOrderBy = " order by masteropp $this->sortdirection";
}
else
{
  $sqlOrderBy = " order by $this->sortby $this->sortdirection";
}
// === end Generate sorting. ===============================
    
	$query = $query.$sqlOrderBy."limit $limitStart, $limitEnd";;
    $result = mysql_query($query)or die(mysql_error());
	return $result;
  }
  
  public function getTotalNum()
  {
    $result = mysql_query("SELECT FOUND_ROWS()");
	$totalNum = mysql_fetch_row($result);
	//return $totalNum[0];
       $this->total = $totalNum[0];
	return $this->total;
  }
   public function getTotalPage()
  {
    return ceil($this->total/parent::ITEMS_PER_PAGE);
  }

  public function getOPP($label)
  {
    $opp = array();
	$query = "SELECT opp FROM RLTN_MASTERARTWORK_ARTWORK WHERE masteropp ='$label' ORDER BY opp";
	$result = mysql_query($query);
	while($record = mysql_fetch_array($result))
	{
	  $temp = $record['opp'];
	  $opp[] = $temp;
	}
	return $opp;
  }  

} 
?>