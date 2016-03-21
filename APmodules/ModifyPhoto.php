<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class ModifyPhoto extends Database
{
  private $id;
  private $no;
  function __construct($param1,$param2) 
  {
    parent::__construct(); 
	$this->id = $param1;
	$this->no = $param2;
  }
    
  public function getData()  //operate on database to get data
  {
    $query = "SELECT id,no,name,description FROM `RLTN_NARR_PHOTO` WHERE id=$this->id and no=$this->no" ;
    $result = mysql_query($query);
	$row = mysql_fetch_array($result);
	//$result = die($query);
	return $row;
  }
  public function getBioDate()
  {
	  $query = "SELECT id,dateDesc,YEAR(dateStart) AS StartYear from NARRATIVE where id=$this->id";
	  $result = mysql_query($query);
	  $row = mysql_fetch_array($result);
	  return $row;
	  }
} 
?>