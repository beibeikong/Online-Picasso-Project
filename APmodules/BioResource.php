<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class BioResource extends Database
{
  
  function __construct() 
  {
    parent::__construct(); 
  }

  public function getData()  //operate on database to get data
  {
    $query = "SELECT id,Name,Type,GeneralType,LEFT(XMLCode,120) AS PartialXMLCode FROM BIORESOURCES ORDER BY GeneralType ASC, Type ASC, Name ASC";
	$result = mysql_query($query);
	return $result;
  }
  
  public function getTotalNum()
  {
    $result = mysql_query("SELECT FOUND_ROWS()");
	$totalNum = mysql_fetch_row($result);
    return $totalNum[0];
  }
} 
?>