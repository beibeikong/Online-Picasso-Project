<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class WritingSearch extends Database
{
  private $page; // the # of current page
  private $total;
  private $keyword;
  private $LATIN_UC_CHARS;
  private $LATIN_LC_CHARS;
  
  function __construct($param, $UP, $LOW) 
  {
    parent::__construct(); 
	
	$this->total = 0;
	
	if(isset($param['page']))
	  $this->page = mysql_real_escape_string($param['page']);
	else
	  $this->page = 1;
	
	$this->LATIN_UC_CHARS = $UP;
    $this->LATIN_LC_CHARS = $LOW;
	
	$this->keyword = mysql_real_escape_string(strtoupper(strtr(trim($param['Keyword']), $this->LATIN_LC_CHARS, $this->LATIN_UC_CHARS)));
	
  }
    
  public function getData()  //operate on database to get data
  {
    $limitStart = parent::ITEMS_PER_PAGE*($this->page-1);
	$limitEnd = parent::ITEMS_PER_PAGE;
	$query = "select SQL_CALC_FOUND_ROWS A.duration, A.title, A.mid, YEAR(A.dateStart) as year, B.pageseq, C.lineno,C.linetext from `WRITINGS_POEMS` AS A, `WRITINGS_PAGES` AS B, `WRITINGS_LINES` AS C where A.mid=B.mid and B.pid=C.pid and (C.linetext regexp '[^a-zA-Z]".$this->keyword."[^a-zA-Z]' or C.linetext regexp '^".$this->keyword."[^a-zA-Z]' or C.linetext regexp '[^a-zA-Z]".$this->keyword."$') ORDER BY A.dateStart ASC limit $limitStart, $limitEnd" ;

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
  
  public function check($linetext)
  {
    $linetext = strtoupper(strtr($linetext, $this->LATIN_LC_CHARS, $this->LATIN_UC_CHARS));
	
	if(stripos($linetext,$this->keyword) !== FALSE)
	  return true;
	else
	  return false;
	
  }
  

} 
?>
	