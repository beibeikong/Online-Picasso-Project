<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class FormerCollections extends Database
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
	$query = "SELECT SQL_CALC_FOUND_ROWS collector, count(Distinct opp) as n from `FORMERLY` WHERE UPPER(SUBSTRING(collector,1,1)) = '$this->letter' group by collector ORDER BY collector asc";
	$result = mysql_query($query);
	return $result;
  }
  public function getOPPString($collector){
      $query = "SELECT opp FROM `FORMERLY` WHERE collector ='$collector'";
      $result=  mysql_query($query);
      $oppstring='';
      while($row = mysql_fetch_array($result)){
          $oppstring.="_".$row['opp'];
      }
      return $oppstring;
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
