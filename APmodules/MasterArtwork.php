<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class MasterArtwork extends Database
{
  private $author;
  private $sortby;
  private $sortdirection;
  private $p;
  function __construct($param) 
  {
    parent::__construct();
	
	$this->p = $param;
	if(isset($param['author']))
		$this->author = $param['author'];
		$this->author = str_replace("'","\'",$this->author);
		 
	if(isset($param['SortBy']))
		$this->sortby = $param['SortBy'];
	else
		$this->sortby = "OPP"; 
		
	if(isset($param['SortDirection']))
		$this->sortdirection = $param['SortDirection']; 
	else
		$this->sortdirection = "Asc";
  }
    
  public function getData()  //operate on database to get data
  {
	$query = "select SQL_CALC_FOUND_ROWS masteropp,title,author,duration,dimension,medium,collection,commentary,YEAR(dateStart) AS StartYear,MONTH(dateStart) AS StartMonth,DAY(dateStart) AS StartDay,dateStartFlag,YEAR(dateEnd) AS EndYear,MONTH(dateEnd) AS EndMonth,DAY(dateEnd) AS EndDay,dateEndFlag from `MASTERARTWORK`" ;
	if(isset($this->p['author']))
		$constraint = " where author = '$this->author'";
	else
		$constraint = "";
	$query = $query.$constraint;
	
// === Generate sorting. ===============================================================
if($this->sortby == "Chronology")
{
  $sqlOrderBy = " order by dateOrder(dateStart,dateStartFlag) $this->sortdirection, dateOrder(dateEnd,dateEndFlag) $this->sortdirection";
}
elseif ($this->sortby  == "OPP")	//sort by masteropp
{
  $sqlOrderBy = " order by masteropp $this->sortdirection";
}
else
{
  $sqlOrderBy = " order by $this->sortby $this->sortdirection";
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
	$query = "SELECT opp FROM RLTN_MASTERARTWORK_ARTWORK WHERE masteropp ='$label' ORDER BY opp";
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