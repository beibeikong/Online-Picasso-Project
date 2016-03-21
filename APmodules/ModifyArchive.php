<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class ModifyArchive extends Database
{
  private $id;
  function __construct($param) 
  {
    parent::__construct(); 
	$this->id = $param;
  }

  public function getData()  //operate on database to get data
  {
    $query = "SELECT Title,Publisher,YEAR(Date) as StartYear, MONTH(Date) AS StartMonth, DAY(Date) AS StartDay, DateFlag,DateDescription,Language,Images,Text FROM `ARCHIVES` WHERE id = $this->id" ;
    $result = mysql_query($query);
	$row = mysql_fetch_array($result);
	return $row;
  }
  

} 
?>