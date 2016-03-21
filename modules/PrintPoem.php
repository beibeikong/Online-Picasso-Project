<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class PrintPoem extends Database
{
  private $mid;
  
  function __construct($param) 
  {
    parent::__construct(); 
	$this->mid = mysql_real_escape_string($param);
  }

  
  public function getTitleDuration()
  {
    $query = "select title, duration, YEAR(dateStart) as year from `WRITINGS_POEMS` where mid = $this->mid" ;
    $result = mysql_query($query);
	$row = mysql_fetch_array($result);
	return $row;
  }
  
  
  public function getPoem($part)
  {
  	$query = "select linetext, lineno from `WRITINGS_LINES` as A,`WRITINGS_PAGES` as B where B.mid=$this->mid and B.pageseq = $part and A.pid=B.pid order by A.lineno ASC" ;
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
  public function getImage($part)
  {
    $query = "select image from `WRITINGS_PAGES` where mid = $this->mid and pageseq = $part" ;
    $result = mysql_query($query);
	$row = mysql_fetch_array($result);
	return $row['image'];
  }
  
} 
?>
