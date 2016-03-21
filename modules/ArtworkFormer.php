<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class ArtworkFormer extends Database
{
  private $oppID;
  
  function __construct($oppID) 
  {
    parent::__construct(); 
	
    $this->oppID = mysql_real_escape_string($oppID);
  }
    
  public function getData()  //operate on database to get data
  {
	$query = "SELECT * FROM `FORMERLY` WHERE opp = '$this->oppID' ORDER BY OrderPriority";
	$result = mysql_query($query);
	//$result = die($query);
	return $result;
  }

} 
?>
