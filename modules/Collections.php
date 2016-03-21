<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class Collections extends Database
{
  private $letter;
  private $total;
  
  function __construct($param) 
  {
    parent::__construct(); 
	$this->letter = mysql_escape_string($param);
  }

  public function getData()  //operate on database to get data
  {
	$query = "SELECT SQL_CALC_FOUND_ROWS collection, count(opp) as n from `ARTWORK` WHERE UPPER(SUBSTRING(collection,1,1)) = '$this->letter' group by collection ORDER BY collection asc";
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
  
} 
?>
