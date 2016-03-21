
<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');
require_once('LinkedList4.php');

class WritingsSearchMorph extends Database
{
  private $morph;
  private $lists; // sorted linked list
  private $page; // the # of current page
  private $LATIN_UC_CHARS;
  private $LATIN_LC_CHARS;
  private $total;
  
  function __construct($param, $UP, $LOW) 
  {
    parent::__construct(); 
	
	$this->morph = mysql_real_escape_string($param['morph']); 
	$this->page = mysql_real_escape_string($param['page']);
	$this->lists = new LinkedList4();
	$this->LATIN_UC_CHARS = $UP;
    $this->LATIN_LC_CHARS = $LOW;
  }

   public function getData()
   {  	
	  $spanishArray = array();
	  $frenchArray = array();
	  
	  // generate Spanish term 
	  $query = "select C.linetext from `WRITINGS_POEMS` AS A, `WRITINGS_PAGES` AS B, `WRITINGS_LINES` AS C where A.siglum='spa' and A.mid=B.mid and B.pid=C.pid" ;
      $result = mysql_query($query); 
	  while($row = mysql_fetch_array($result))
	  {
	    $tokens = explode(" ", $row['linetext']);
		$size = sizeof($tokens);
        for($i=0; $i<$size; $i++)
		{
		  $token = strtolower(strtr($tokens[$i], $this->LATIN_UC_CHARS, $this->LATIN_LC_CHARS)); // change all characters to lower case
		  if (array_key_exists($token, $spanishArray))
		    $spanishArray[$token]++;
		  else
		    $spanishArray[$token] = 1;
		}
	  }
	  // end of generating Spanish term
	  
	  // generate French term 
	  $query = "select C.linetext from `WRITINGS_POEMS` AS A, `WRITINGS_PAGES` AS B, `WRITINGS_LINES` AS C where A.siglum='fre' and A.mid=B.mid and B.pid=C.pid" ;
      $result = mysql_query($query); 
	  while($row = mysql_fetch_array($result))
	  {
	    $tokens = explode(" ", $row['linetext']);
		$size = sizeof($tokens);
        for($i=0; $i<$size; $i++)
		{
		  $token = strtolower(strtr($tokens[$i], $this->LATIN_UC_CHARS, $this->LATIN_LC_CHARS)); // change all characters to lower case
		  if (array_key_exists($token, $frenchArray))
		    $frenchArray[$token]++;
		  else
		    $frenchArray[$token] = 1;
		}
	  }
	  // end of generating French term
	  
	  
	  $limitStart = 100*($this->page-1);
	  $limitEnd = 100;
	  $query = "SELECT SQL_CALC_FOUND_ROWS term, siglum from `WRITINGS_TERMS` where morph like '%$this->morph%' order by siglum DESC, term ASC limit $limitStart, $limitEnd" ;
      $result = mysql_query($query);
	  while($row = mysql_fetch_array($result))
	  {
			if(strcmp($row['siglum'], "spa")===0)
			{
			  if(array_key_exists($row['term'], $spanishArray))
			    $num = $spanishArray[$row['term']];
			  else
			    $num = 0;
			}
			else
			{
			  if(array_key_exists($row['term'], $frenchArray))
			    $num = $frenchArray[$row['term']];
			  else
			    $num = 0;
			}
			$t = strtoupper(strtr($row['term'], $this->LATIN_LC_CHARS, $this->LATIN_UC_CHARS)); // change all characters to upper case
			$this->lists->add($t, $row['siglum'], $num);
	  }
      return $this->lists;  
   }
   
  public function getTotalNum()
  {
    $result = mysql_query("SELECT FOUND_ROWS()");
	$totalNum = mysql_fetch_row($result);
	$this->total = $totalNum[0];
	return $this->total;
  }
  
} 

?>
