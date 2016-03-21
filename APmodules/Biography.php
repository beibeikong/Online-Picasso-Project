<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class Biography extends Database
{
  private $year;
  
  function __construct($param) 
  {
    parent::__construct(); 
	$this->year = $param['year'];
  }
    
  public function getData()  //operate on database to get data
  {
    $query = "SELECT SQL_CALC_FOUND_ROWS id,YEAR(dateStart) AS StartYear,MONTH(dateStart) AS StartMonth,DAY(dateStart) AS StartDay,dateStartFlag,YEAR(dateEnd) AS EndYear,MONTH(dateEnd) AS EndMonth,DAY(dateEnd) AS EndDay,dateEndFlag,dateDesc,LEFT(event,120) AS 'eventCut',commentary, (SELECT COUNT(*) FROM `ARTWORK` A WHERE MONTH(A.dateStart) = MONTH(N.dateStart) AND DAY(A.dateStart) = DAY(N.dateStart) AND MONTH(A.dateEnd) = MONTH(N.dateEnd) AND DAY(A.dateEnd) = DAY(N.dateEnd) AND YEAR(A.dateStart) = YEAR(N.dateStart)) AS DatedArtworks FROM `NARRATIVE` N WHERE YEAR(dateStart) = $this->year ORDER BY dateOrder(dateStart,dateStartFlag) ASC, dateOrder(dateEnd,dateEndFlag) ASC" ;
	$result = mysql_query($query);
	return $result;
  }
  
  public function getTotalNum()
  {
    $result = mysql_query("SELECT FOUND_ROWS()");
	$totalNum = mysql_fetch_row($result);
    return $totalNum[0];
  }
  
  function getPhoto($id)
  {
	$photoquery = "SELECT * FROM `RLTN_NARR_PHOTO` WHERE id = $id";  
	$photoresult = mysql_query($photoquery);
	$result = mysql_fetch_row($photoresult);
	//$result = die($photoquery);
	return $result;	
  }
  public function getPhoto_D($id)
  {
	  $query = "SELECT * FROM `RLTN_NARR_PHOTO_D` WHERE id=$id";
	  $photoresult = mysql_query($query);
          $result = mysql_fetch_row($photoresult);
	  return $result;
 }    
 
  public function getOPP_D($id)
  {
	  $query = "SELECT path FROM `RLTN_NARR_WORKS_D` WHERE idNarrative=$id";
	  $oppresult = mysql_query($query);
          $result = mysql_fetch_row($oppresult);
	  return $result;
  } 
        
} 
?>