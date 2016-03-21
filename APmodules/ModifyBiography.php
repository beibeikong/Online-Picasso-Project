<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class ModifyBiography extends Database
{
  private $id;
  function __construct($param) 
  {
    parent::__construct(); 
	$this->id = $param;
  }
    
  public function getData()  //operate on database to get data
  {
    $query = "SELECT id,YEAR(dateStart) AS StartYear,MONTH(dateStart) AS StartMonth,DAY(dateStart) AS StartDay,dateStartFlag,YEAR(dateEnd) AS EndYear,MONTH(dateEnd) AS EndMonth,DAY(dateEnd) AS EndDay,dateEndFlag,dateDesc,event,commentary,photo FROM `NARRATIVE` N WHERE id=$this->id" ;
    $result = mysql_query($query);
	$row = mysql_fetch_array($result);
	return $row;
  }
  public function getPhoto()
  {
	  $query = "SELECT * from picasso.RLTN_NARR_PHOTO where id=$this->id";
	  $result = mysql_query($query);
	  return $result;
 }
 public function getOPP()
 {
     $query = "SELECT * from picasso.RLTN_NARR_WORKS where idNarrative=$this->id";
	  $result = mysql_query($query);
	  return $result;
 }
 public function getPhotoDisplay()
  {
	 $photo = array();
	$query = "SELECT name FROM `RLTN_NARR_PHOTO_D` WHERE id=$this->id ";
	$result = mysql_query($query);
	while($record = mysql_fetch_array($result))
	{
	  $temp = $record['name'];
	  $photo[] = $temp;
	}
	return $photo;
 }
 public function getOPPDisplay()
 {
      $opp = array();
	$query = "SELECT idArtwork FROM `RLTN_NARR_WORKS_D` WHERE idNarrative=$this->id ORDER BY idArtwork";
	$result = mysql_query($query);
	while($record = mysql_fetch_array($result))
	{
	  $temp = $record['idArtwork'];
	  $opp[] = $temp;
	}
	return $opp;
 }         
} 
?>