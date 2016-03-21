<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class FrontUsers extends Database
{
  private $page; // the # of current page
  private $total;

  function __construct($param) 
  {
    parent::__construct();
	 
	if(isset($param['page']))
	  $this->page = $param['page'];
	else
	  $this->page = 1;
  }

  public function getData()  //operate on database to get data
  {
    $limitStart = parent::ITEMS_PER_PAGE*($this->page-1);
	$limitEnd = parent::ITEMS_PER_PAGE;
	
	$query = "SELECT SQL_CALC_FOUND_ROWS FrontUsername FROM `FRONTUSERS` ORDER BY FrontUsername limit $limitStart, $limitEnd";
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
