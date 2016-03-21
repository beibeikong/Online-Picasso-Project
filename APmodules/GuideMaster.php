<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class GuideMasters extends Database
{ 
  
  private $page; // the # of current page
  private $masternumber; //total 
  private $MASTER_PER_PAGE = 100; //the number of master that wanna to be shown in one page.\
  
  
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
    $limitStart = $this->MASTER_PER_PAGE*($this->page-1);
	$limitEnd = $this->MASTER_PER_PAGE;	
	
	$query = "SELECT SQL_CALC_FOUND_ROWS DISTINCT author, COUNT(*) FROM `MASTERARTWORK` GROUP BY author ORDER BY author limit $limitStart, $limitEnd";
	$result = mysql_query($query);
	return $result;
  }
  
  public function getTotalMasterNum() //get how many author in the MASTERARTWORK table
  {
    $result = mysql_query("SELECT FOUND_ROWS()");
	$totalNum = mysql_fetch_row($result);
	$this->masternumber = $totalNum[0];
	return $this->masternumber;
  }  
  
  public function getTotalPage()
  {
    return ceil($this->masternumber/$this->MASTER_PER_PAGE);
  }  

} 
?>
