<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class ModifyPoemPart extends Database
{
  private $mid;
  private $part;
  
  function __construct($param) 
  {
    parent::__construct(); 
	$this->mid = $param['mid'];
	$this->part = $param['part'];
  }

  public function getTitle()  //operate on database to get data
  {
    $query = "SELECT title FROM `WRITINGS_POEMS` WHERE mid=$this->mid" ;
    $result = mysql_query($query);
	$row = mysql_fetch_array($result);
	return $row;
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
  	$query = "select linetext from `WRITINGS_LINES` as A,`WRITINGS_PAGES` as B where B.mid=$this->mid and B.pageseq = $this->part and A.pid=B.pid order by A.lineno ASC" ;
   $result = mysql_query($query);
   // $result = die($query);
	return $result;
  }
  
  public function getCommentary()
  {
    $query = "select commentary from `WRITINGS_PAGES` where mid = $this->mid and pageseq = $this->part" ;
    $result = mysql_query($query);
	$row = mysql_fetch_array($result);
	return $row['commentary'];
  }
  
  public function getTranslation()
  {
    $query = "select translation from `WRITINGS_TRANSLATIONS` as A where pid = (SELECT pid FROM `WRITINGS_PAGES` WHERE mid= $this->mid AND pageseq= $this->part) order by A.lineTNO ASC" ;
    //  $query = "select translation from `WRITINGS_TRANSLATIONS` as A,`WRITINGS_PAGES` as B where B.mid=$this->mid and B.pageseq = $this->part and A.pid=B.pid order by A.lineTNO ASC" ;
    $result = mysql_query($query);
//	$row = mysql_fetch_array($result);
//	return $row['translation'];
     return $result;
  }
  
} 
?>