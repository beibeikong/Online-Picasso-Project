<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class MenuArchive extends Database
{
  private $yearIndex;
   
  function __construct() 
  {
    parent::__construct(); 
  }
    
  public function getYearIndex()  //operate on database to get data
  {
	
	$query = "SELECT DISTINCT YEAR(Date) AS Year FROM `ARCHIVES` ORDER BY YEAR(Date) ASC";
	$this->yearIndex = mysql_query($query);
  }
  
  public function checkYear($y)
  {
    $flag = 0; // not found
	while($row = mysql_fetch_array($this->yearIndex))
	{
	  if($row[0]==$y)
	  {
	    $flag=1;
		break;
	  }
	}
	mysql_data_seek($this->yearIndex,0);
	return $flag;
  }
} 
?>
