
<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');
require_once('LinkedList.php');

class WritingsConcordance extends Database
{
  private $letter;
  private $language; 
  private $lists; // sorted linked list
  private $LATIN_UC_CHARS;
  private $LATIN_LC_CHARS;
  
  function __construct($param, $UP, $LOW) 
  {
    parent::__construct(); 
	$this->letter = mysql_real_escape_string($param['letter']); // to lower case
	$this->language = mysql_real_escape_string($param['lan']);
	$this->lists = new LinkedList();
	$this->LATIN_UC_CHARS = $UP;
    $this->LATIN_LC_CHARS = $LOW;
  }
  
   public function getData()
   {  	
      $query = "SELECT C.linetext FROM ((`WRITINGS_POEMS` AS A INNER JOIN `WRITINGS_PAGES` AS B ON A.mid=B.mid) INNER JOIN `WRITINGS_LINES` AS C ON B.pid=C.pid) where A.siglum='$this->language'" ;
      $result = mysql_query($query);
	  while($row = mysql_fetch_array($result))
	  {
	    $tokens = explode(" ", $row['linetext']);
		$size = sizeof($tokens);
        for($i=0; $i<$size; $i++)
		{
		  $token = strtoupper(strtr($tokens[$i], $this->LATIN_LC_CHARS, $this->LATIN_UC_CHARS)); // change all characters to upper case
		  if(strpos($token,$this->letter)===0) // this token is starting at specific letter, NOTE we use === instead of ==
		    $this->lists->add($token);
		}
	  }
      return $this->lists;  
   }
} 

?>
