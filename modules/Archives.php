<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class Archives extends Database
{
  private $year;
  private $page; // the # of current page
  private $total;
  private $sortby;
  
  function __construct($param) 
  {
    parent::__construct(); 
	$this->year = $param['year'];
	
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

	$sort = "";
	if($this->sortby != "")
	  foreach($this->sortby as $s)
	    $sort .= $s." Asc , ";
	
	$sort .= " DateOrder(Date,DateFlag) DESC ";
	
	
	
	$query = "SELECT SQL_CALC_FOUND_ROWS id,Title,Publisher,YEAR(Date) AS Year,MONTH(Date) AS Month,DAY(Date) AS Day,Language FROM `ARCHIVES` WHERE YEAR(Date) = $this->year ORDER BY $sort limit $limitStart, $limitEnd";
	$result = mysql_query($query);
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
