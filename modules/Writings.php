<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class Writings extends Database
{
  private $year;
  private $page; // the # of current page
  private $total;
  
  function __construct($param) 
  {
    parent::__construct(); 
	$this->year = mysql_real_escape_string($param['year']);
	
	if(isset($param['page']))
	  $this->page = mysql_real_escape_string($param['page']);
	else
	  $this->page = 1;
  }
    
  public function getData()  //operate on database to get data
  {
    $limitStart = parent::ITEMS_PER_PAGE*($this->page-1);
	$limitEnd = parent::ITEMS_PER_PAGE;
	$query = "select SQL_CALC_FOUND_ROWS duration, YEAR(dateStart) as year, mid, title from `WRITINGS_POEMS` where YEAR(dateStart) = $this->year order by dateStart ASC limit $limitStart, $limitEnd " ;
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
  
  public function getNextAvailYear($year) // get next available year
  {
  	$query = "select YEAR(dateStart) as year from `WRITINGS_POEMS` where YEAR(dateStart) > $year order by dateStart ASC limit 0, 1 " ;
    $result = mysql_query($query);
	return $result;
  }
  
  public function getPreAvailYear($year) // get previous available year
  {
  	$query = "select YEAR(dateStart) as year from `WRITINGS_POEMS` where YEAR(dateStart) < $year order by dateStart DESC limit 0, 1 " ;
    $result = mysql_query($query);
	return $result;
  }
  

} 
?>
