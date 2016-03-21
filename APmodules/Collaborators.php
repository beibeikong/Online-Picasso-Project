<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class Collaborators extends Database
{
  
  function __construct() 
  {
    parent::__construct(); 
  }

  public function getData()  //operate on database to get data
  {
	$query = "SELECT * FROM `COLLABORATORS` ORDER BY OrderPriority DESC";
	$result = mysql_query($query);
	return $result;
  }
} 
?>
