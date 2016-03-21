<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class ModifyArtwork extends Database
{
  private $masteropp;
  function __construct($param) 
  {
    parent::__construct(); 
	$this->masteropp = $param;
  }
    
  public function getData()  //operate on database to get data
  {
	$query = "select masteropp,title,author,duration,medium,dimension,collection,commentary, YEAR(dateStart) as StartYear, MONTH(dateStart) AS StartMonth,DAY(dateStart) AS StartDay,dateStartFlag, YEAR(dateEnd)as EndYear,MONTH(dateEnd) AS EndMonth,DAY(dateEnd) AS EndDay,dateEndFlag from `MASTERARTWORK` where masteropp='$this->masteropp'" ;
    $result = mysql_query($query);
	$row = mysql_fetch_array($result);
	return $row;
  }
  
  public function getOPP($label)
  {
    $opp = array();
	$query = "SELECT opp FROM `RLTN_MASTERARTWORK_ARTWORK` WHERE masteropp ='$label' ORDER BY opp";
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