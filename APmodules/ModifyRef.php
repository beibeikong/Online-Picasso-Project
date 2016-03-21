<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class ModifyRef extends Database
{
  private $id;
  function __construct($param) 
  {
    parent::__construct(); 
	$this->id = $param;
  }

  public function getData()  //operate on database to get data
  {
    $query = "SELECT Author,Books,Catalogs,Title,Date,Publisher,Journal,Edition,Issue,Volume,Exhibitions FROM `REFERENCES` WHERE id = $this->id" ;
    $result = mysql_query($query);
	$row = mysql_fetch_array($result);
	return $row;
  }
  
  public function escapeStringToHtmlAttributeValue($s)
  {
    $s = str_replace("\"", "&#34;", $s);
	return $s;
  }
} 
?>