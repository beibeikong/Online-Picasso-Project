<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class ModifylinkId extends Database
{
  private $id;
  function __construct($i) 
  {
    parent::__construct();
	$this->id = $i; 
  }
    
  public function getData()  //operate on database to get data
  {

	$query = "SELECT * FROM `LINK` WHERE idLink=$this->id" ;
    $result = mysql_query($query);
	$row = mysql_fetch_array($result);
	return $row;
  }
  
} 
?>