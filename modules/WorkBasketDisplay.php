<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class WorkBasketDisplay extends Database
{
  private $page; // the # of current page
  private $opps;
  private $total;
  
  function __construct($param, &$session) 
  {
    parent::__construct(); 

	if(isset($session['OPPs']))
	{
	  if($param['action'] == "add") // add new opp
	    $session['OPPs'] .= "_".$param['OPPs'];
	  elseif($param['action'] == "remove") // remove opp
	    $this->removeOPPs($session['OPPs'], $param['OPPs']);
	  elseif($param['action'] == "import") 
	    $session['OPPs'] .= "_".$param['OPPs'];
	}  
	else
	  $session['OPPs'] = $param['OPPs'];

	
	if(isset($param['page']))
	  $this->page = $param['page'];
	else
	  $this->page = 1;
	  
	  
	$this->opps = "('" . mysql_real_escape_string($session['OPPs']);
	$this->opps .= "')";
	$this->opps = str_replace("_", "','", $this->opps);
  }
    
  public function removeOPPs(&$s, $p)
  {
    $temp = explode("_",$p);
	foreach($temp as $data)
	{
	  $s = str_replace($data."_", "", $s);
	  $s = str_replace("_".$data, "", $s);
	  $s = str_replace($data, "", $s);
	}
  }
  
  public function getData()  //operate on database to get data
  {
    $limitStart = parent::ITEMS_PER_PAGE*($this->page-1);
	$limitEnd = parent::ITEMS_PER_PAGE;
	$query = "select SQL_CALC_FOUND_ROWS opp,notVerified,title, YEAR(dateStart) as year from `ARTWORK` where opp in $this->opps order by dateStart ASC, dateStartFlag ASC, dateEnd ASC, dateEndFlag ASC limit $limitStart, $limitEnd " ;
	$result = mysql_query($query);
	return $result;
  }
  
  public function getAllData()
  {
    $query = "select opp from `ARTWORK` where opp in $this->opps order by dateStart ASC, dateStartFlag ASC, dateEnd ASC, dateEndFlag ASC" ;
	$result = mysql_query($query);
	return $result;
  }
  
  public function getTotalNum()
  {
    $result = mysql_query("SELECT FOUND_ROWS()");
	$totalNum = mysql_fetch_row($result);
	$this->total = $totalNum[0];
	return $this->total;
  }
  
  public function getTotalPage()
  {
    return ceil($this->total/parent::ITEMS_PER_PAGE);
  }
  

} 
?>