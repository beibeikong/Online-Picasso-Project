<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class ArtworkDisplay extends Database
{
  private $year;
  private $p;
  function __construct($param) 
  {
    parent::__construct(); 
	$this->year = $param['year'];
	$this->p = $param;
  }
    
  public function getData()  //operate on database to get data
  {

	$query = "select SQL_CALC_FOUND_ROWS opp,notVerified,title,category,duration,collection,inventory,dimension,bookCatalog,medium,location, notes,commentary, MONTH(dateStart) AS StartMonth,DAY(dateStart) AS StartDay,dateStartFlag, MONTH(dateEnd) AS EndMonth,DAY(dateEnd) AS EndDay,dateEndFlag from `ARTWORK` where YEAR(dateStart) = $this->year " ;
	
// === Generate sorting. ===============================================================
if($this->p['SortBy'] == "Chronology")
{
  $direction = $this->p['SortDirection'];
  $sqlOrderBy = " order by dateOrder(dateStart,dateStartFlag) $direction, dateOrder(dateEnd,dateEndFlag) $direction";
}
else
{
  $sortby = $this->p['SortBy'];
  $direction = $this->p['SortDirection'];
  $sqlOrderBy = " order by $sortby $direction";
}
// === end Generate sorting. ===============================
    
	$query = $query.$sqlOrderBy;
    $result = mysql_query($query);
	return $result;
  }
  
  public function getTotalNum()
  {
    $result = mysql_query("SELECT FOUND_ROWS()");
	$totalNum = mysql_fetch_row($result);
	return $totalNum[0];
  }
  
  public function sortBooks($books)
  {
    $array = explode("; ",$books);
    sort($array);
	if(count($array)==1)
	  return $array[0];
	else
	{
	  $result = $array[0];
	  for($i=1; $i<count($array); $i++)
	  {
	    $result.= "<br>".$array[$i];
		if ($i>=5 && count($array)>6)	//at most list 6 books, no more than 6.
		{
			$result.= "<br>"."etc.";
			break;
		}

	  }
	  return $result;
	}
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
	$query = "SELECT opp FROM RLTN_ARTWORK_ARTWORK WHERE oppmaster ='$label' ORDER BY opp";
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