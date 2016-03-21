<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class ModifyArtwork extends Database
{
  private $opp;
  function __construct($param) 
  {
    parent::__construct(); 
	$this->opp = $param;
  }
    
  public function getData()  //operate on database to get data
  {
	$query = "select SQL_CALC_FOUND_ROWS opp,notVerified,title,category,duration,collection,extraImages,inventory,dimension,bookCatalog,exhibition,medium,location, notes,commentary, YEAR(dateStart) as StartYear, MONTH(dateStart) AS StartMonth,DAY(dateStart) AS StartDay,dateStartFlag, YEAR(dateEnd)as EndYear,MONTH(dateEnd) AS EndMonth,DAY(dateEnd) AS EndDay,dateEndFlag from `ARTWORK` where opp='$this->opp'" ;
    $result = mysql_query($query);
	$row = mysql_fetch_array($result);
	return $row;
  }
  
  public function getCatalog($opp)
  {
    $catalog = array();
	$query = "SELECT Catalog, Volume, Number, Suffix FROM RLTN_WORKS_CATALOG WHERE idArtwork='$opp' ORDER BY Catalog ASC, Volume ASC, Number ASC, Suffix ASC";
	$result = mysql_query($query);
	while($cata = mysql_fetch_array($result))
	{
	  $temp = $cata['Catalog'];
	  $temp.= ($cata['Volume']!='')? ".$cata[Volume]":"";
	  if($cata['Catalog']=="PP")
	  {
	    if($cata['Number'] < 10) $temp.= ":00$cata[Number]";
		elseif($cata['Number'] < 100) $temp.= ":0$cata[Number]";
		else $temp.= ":$cata[Number]";
	  }
	  else
	    $temp.= ":$cata[Number]";
	  $temp.= $cata['Suffix'];
	  $catalog[] = $temp;
	}
	return $catalog;
  }

  public function getOPP($label)
  {
    $opp = array();
	$query = "SELECT opp FROM `RLTN_ARTWORK_ARTWORK` WHERE oppmaster ='$label' ORDER BY opp";
	$result = mysql_query($query);
	while($record = mysql_fetch_array($result))
	{
	  $temp = $record['opp'];
	  $opp[] = $temp;
	}
	return $opp;
  }	
  
  public function getFormer($opp)
  {
  	$query = "SELECT * FROM `FORMERLY` WHERE opp ='$opp' ORDER BY OrderPriority ";
  	$result = mysql_query($query);
	return $result;
  }
  	
} 
?>