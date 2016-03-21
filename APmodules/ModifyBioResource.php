<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class ModifyBioResource extends Database
{
  private $id;
  function __construct($param) 
  {
    parent::__construct(); 
	$this->id = $param;
  }

  public function getData()  //operate on database to get data
  {
    $query = "SELECT id,Name,Type,GeneralType,XMLCode FROM BIORESOURCES WHERE id = '$this->id'" ;
    $result = mysql_query($query);
	$row = mysql_fetch_array($result);
	return $row;
  }
  

} 
?>