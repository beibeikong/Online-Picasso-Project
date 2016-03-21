<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class linkIdTree extends Database
{
  function __construct() 
  {
    parent::__construct(); 
  }
    
  public function getData($c)  //operate on database to get data
  {

	$query = "SELECT * FROM `LINK` WHERE category = $c ORDER BY title ASC" ;
    $result = mysql_query($query);
	return $result;
  }
  
} 
?>