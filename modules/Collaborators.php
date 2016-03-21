<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class Collaborators extends Database
{
  
  function __construct() 
  {
    parent::__construct(); 
	
  }
  
  public function getCategory()  //operate on database to get data
  {
	$query = "SELECT DISTINCT Category FROM `COLLABORATORS` ORDER BY OrderPriority DESC";
	$result = mysql_query($query);
	return $result;
  }

  public function getInfo($c)  //operate on database to get data
  {
	$query = "SELECT Name,Title,Position,Place FROM `COLLABORATORS` WHERE Category = '$c' ORDER BY OrderPriority DESC";
	$result = mysql_query($query);
	return $result;
  }
} 
?>
