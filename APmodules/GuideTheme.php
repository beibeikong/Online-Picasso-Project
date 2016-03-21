<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class GuideThemes extends Database
{
  private $p;  
  function __construct($param) 
  {
    parent::__construct(); 
	$this->p = $param; 
  }

  public function getData()  //operate on database to get data
  {
	$query = "SELECT SQL_CALC_FOUND_ROWS guidename,LEFT(intro,110) AS 'introCut',notes,MONTH(dateStart) AS StartMonth,DAY(dateStart) AS StartDay,YEAR(dateStart) AS StartYear,MONTH(dateEnd) AS EndMonth,DAY(dateEnd) AS EndDay,YEAR(dateEnd) AS EndYear FROM `THEME`";
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
	$query = "SELECT opp FROM RLTN_THEME_ARTWORK WHERE guidename ='$label' ORDER BY opp";
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
