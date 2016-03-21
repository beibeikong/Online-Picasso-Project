<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class ModifyPoem extends Database
{
  private $mid;
  function __construct($param) 
  {
    parent::__construct(); 
	$this->mid = $param;
  }

  public function getData()  //operate on database to get data
  {
    $query = "SELECT mid, YEAR(dateStart) AS StartYear,MONTH(dateStart) AS StartMonth,DAY(dateStart) AS StartDay,dateStartFlag,YEAR(dateEnd) AS EndYear,MONTH(dateEnd) AS EndMonth,DAY(dateEnd) AS EndDay,dateEndFlag, title, altTitle, abrTitle, siglum, duration FROM `WRITINGS_POEMS` WHERE mid=$this->mid" ;
    $result = mysql_query($query);
	$row = mysql_fetch_array($result);
	return $row;
  }
} 
?>