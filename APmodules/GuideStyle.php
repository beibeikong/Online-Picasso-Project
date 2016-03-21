<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class GuideStyles extends Database
{
  private $p;  
  function __construct($param) 
  {
    parent::__construct(); 
	$this->p = $param; 
  }

  public function getData()  //operate on database to get data
  {
	$query = "SELECT SQL_CALC_FOUND_ROWS guidename,LEFT(intro,110) AS 'introCut',notes,MONTH(dateStart) AS StartMonth,DAY(dateStart) AS StartDay,YEAR(dateStart) AS StartYear,MONTH(dateEnd) AS EndMonth,DAY(dateEnd) AS EndDay,YEAR(dateEnd) AS EndYear FROM `STYLE`";
// === Generate sorting. ===============================================================
if($this->p['SortBy'] == "Time")
{
  $direction = $this->p['SortDirection'];
  $sqlOrderBy = " order by dateStart $direction, dateEnd $direction";
}
else
{
  $direction = $this->p['SortDirection'];
  $sqlOrderBy = " order by guidename $direction";
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
  
  public function getOPP($label)
  {
    $opp = array();
	$query = "SELECT opp FROM `ARTWORK` A, `STYLE` B WHERE guidename ='$label' AND A.dateStart >= B.dateStart AND A.dateEnd <= B.dateEnd  ORDER BY year(A.dateStart) Asc, opp Asc";
	$result = mysql_query($query);
	while($record = mysql_fetch_array($result))
	{
	  $temp = $record['opp'];
	  $opp[] = $temp;
	}
	return $opp;
  }
} 
?>
