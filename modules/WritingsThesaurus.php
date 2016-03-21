
<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');
require_once('LinkedList3.php');

class WritingsConcordance extends Database
{
  private $letter;
  private $lists; // sorted linked list
  private $LATIN_UC_CHARS;
  private $LATIN_LC_CHARS;

  
  function __construct($l, $UP, $LOW) 
  {
    parent::__construct(); 
	
	$this->letter = mysql_real_escape_string($l); 
	$this->lists = new LinkedList3();
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
	  
	  
	   
	  $query = "SELECT distinct term, siglum, translation, morph, category from `WRITINGS_TERMS`" ;
      $result = mysql_query($query);
	  while($row = mysql_fetch_array($result))
	  {
	    $tokens = explode(",", $row['translation']);
		$size = sizeof($tokens);
        for($i=0; $i<$size; $i++)
		{
		  $token = trim(strtoupper(strtr($tokens[$i], $this->LATIN_LC_CHARS, $this->LATIN_UC_CHARS))); // change all characters to upper case
		  if(strpos($token,$this->letter)===0) // this token is starting at specific letter, NOTE we use === instead of ==
		  {
			if(strcmp($row['siglum'], "spa")===0)
			{
			  if(array_key_exists($row['term'], $spanishArray))
			  {
			    $num = $spanishArray[$row['term']];
				//$spanishArray[$row['term']] = 0;
			  }
			  else
			    $num = 0;
			}
			else
			{
			  if(array_key_exists($row['term'], $frenchArray))
			  {
			    $num = $frenchArray[$row['term']];
				//$frenchArray[$row['term']] = 0;
			  }
			  else
			    $num = 0;
			}
			$this->lists->add($token, $num);
		  }  
		}
	  }
      return $this->lists;  
   }
   

} 

?>
