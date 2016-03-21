<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class MasterArtworkInfo extends Database
{
  private $masterID;
  
  function __construct($masterID) 
  {
    parent::__construct(); 
	
    $this->masterID = $masterID;
  }
    
  public function getData()  //operate on database to get data
  {
	$query = "SELECT masteropp,title,author,duration,medium,dimension,collection,commentary,YEAR(dateStart) as startyear FROM `MASTERARTWORK` WHERE masteropp = '$this->masterID'";
	$result = mysql_query($query);
	return $result;
  }
  
} 
?>
