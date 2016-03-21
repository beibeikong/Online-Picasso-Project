<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class WritingsInfo extends Database
{
  private $year;
  private $part; 
  private $total;
  private $mid;
  
  function __construct($param) 
  {
    parent::__construct(); 
	
    if(isset($param['year']))
	  $this->year = $param['year'];
	else
	  $this->year = 1935;	
	
	
	if(isset($param['part']))
	  $this->part = $param['part'];
	else
	  $this->part = 1;
	
	$this->mid = $param['mid'];
	
  }

  
  public function getTitleDuration()
  {
    $query = "select title, duration, YEAR(dateStart) as year from `WRITINGS_POEMS` where mid = $this->mid" ;
    $result = mysql_query($query);
	return $result;
  }
  
  public function getCommentary()
  {
    $query = "select commentary from `WRITINGS_PAGES` where mid = $this->mid and pageseq = $this->part" ;
    $result = mysql_query($query);
	$row = mysql_fetch_array($result);
	return $row['commentary'];
  }
  
  
  public function getNextAvailYear($year) // get next available year
  {
  	$query = "select YEAR(dateStart) as year from `WRITINGS_POEMS` where YEAR(dateStart) > $year order by dateStart ASC limit 0, 1 " ;
    $result = mysql_query($query);
	return $result;
  }
  
  public function getPreAvailYear($year) // get previous available year
  {
  	$query = "select YEAR(dateStart) as year from `WRITINGS_POEMS` where YEAR(dateStart) < $year order by dateStart DESC limit 0, 1 " ;
    $result = mysql_query($query);
	return $result;
  }
  
  public function getImage()
  {
    $query = "select image from `WRITINGS_PAGES` where mid = $this->mid and pageseq = $this->part" ;
    $result = mysql_query($query);
	$row = mysql_fetch_array($result);
	return $row['image'];
  }
  
  public function getPoem()
  {
  	$query = "select linetext, lineno from `WRITINGS_LINES` as A,`WRITINGS_PAGES` as B where B.mid=$this->mid and B.pageseq = $this->part and A.pid=B.pid order by A.lineno ASC" ;
    $result = mysql_query($query);
	return $result;
  }
  
  public function getTotalNum() // get total number of parts
  {
    $query = "select count(1) from `WRITINGS_PAGES` where mid = $this->mid" ;
    $result = mysql_query($query);
	$row = mysql_fetch_array($result);
	return $row[0];
  }
  
  public function getTranslation()
  {
    $query = "select translation from `WRITINGS_TRANSLATIONS` WHERE pid = (SELECT pid FROM `WRITINGS_PAGES` WHERE mid= $this->mid AND pageseq= $this->part)" ;
    $result = mysql_query($query);
	$row = mysql_fetch_array($result);
	return $row['translation'];
  }
} 
?>
