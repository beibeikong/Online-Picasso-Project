
<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');
require_once('LinkedList2.php');

class WritingsOccurrence extends Database
{
  private $language; 
  private $term;
  private $lists; // sorted linked list
  private $LATIN_UC_CHARS;
  private $LATIN_LC_CHARS;
  
  function __construct($param, $UP, $LOW) 
  {
    parent::__construct(); 
	$this->language = mysql_real_escape_string($param['lan']);
	$this->term = $param['term'];
	$this->lists = new LinkedList2();
	$this->LATIN_UC_CHARS = $UP;
    $this->LATIN_LC_CHARS = $LOW;
  }
  
   public function getData()
   {  	
	  $query = "select A.mid, A.dateStart, A.dateEnd, A.abrTitle, B.pageseq, B.pid, C.linetext, C.lineno from `WRITINGS_POEMS` AS A, `WRITINGS_PAGES` AS B, `WRITINGS_LINES` AS C where A.siglum='$this->language' and A.mid=B.mid and B.pid=C.pid ORDER BY A.dateStart, B.pageseq, C.lineno ASC" ;
      $result = mysql_query($query) or die(mysql_error());
	  
      while($row = mysql_fetch_array($result))
	  {
	    $tokens = explode(" ", $row['linetext']);
		$size = sizeof($tokens);
        for($i=0; $i<$size; $i++)
		{
		  $token = strtoupper(strtr($tokens[$i], $this->LATIN_LC_CHARS, $this->LATIN_UC_CHARS)); // change all characters to upper case
		  if(strcmp($token,$this->term)===0) // this token is starting at specific letter, NOTE we use === instead of ==
		    $this->lists->add($row,$i);
		}
	  }
      return $this->lists;  
   }

   public function getDate($start, $end)
   {
     if(strcmp($start,$end)==0)
	 {
	   $year = substr($start,2,2);
	   $month = substr($start,5,2);
	   $date = substr($start,8,2);
	   return $month."/".$date."/".$year;
	 }
	 else
	 {
	   $Syear = substr($start,2,2);
	   $Smonth = substr($start,5,2);
	   $Sdate = substr($start,8,2);
	   $Eyear = substr($end,2,2);
	   $Emonth = substr($end,5,2);
	   $Edate = substr($end,8,2);
	   
	   if(strcmp($Syear,$Eyear)==0)
	   {
	     if(strcmp($Smonth,$Emonth)==0) // date is different
		   $temp = $Smonth."/".$Sdate."-".$Edate."/".$Eyear;
		 else // month is different
		   $temp = $Smonth."/".$Sdate."-".$Emonth."/".$Edate."/".$Eyear;
	   }
	   else
	     $temp = $Smonth."/".$Sdate."/".$Syear."-".$Emonth."/".$Edate."/".$Eyear;
	   
	   return $temp;
	 }
   }
   
   // generate context
   public function context($s, $index, $lineNO, $pid)
   {
     $tokens = explode(" ", $s);
	 $size = sizeof($tokens);
	 
	 // generate preceding string
	 $n = 0; // count the number of words before keyword
	 $i = $index-1;
	 $preced = "";
	 while($i>=0 && $n<5)
	 {
	   $preced = $tokens[$i]." ".$preced;
	   if(strcmp($tokens[$i],"[")!==0 && strcmp($tokens[$i],"]")!==0) 
		 $n++;
	   $i--;
	 }
	 if($n==5) // find 5 words before keyword
	 {
	   if($i>=0 ||$lineNO >1) $preced = "... ".$preced;
	 }
	 else  // less than 5 words before keyword
	 {
	   if($lineNO > 1) // it is not the first line, need to get some words from previous line
	   {
	     $lookfor = $lineNO-1;
		 $query = "select linetext, lineno from `WRITINGS_LINES` where pid = $pid and lineno = $lookfor" ;
         $result = mysql_query($query);
		 $row = mysql_fetch_array($result);
		 if($row['linetext']!=="")
		 {
		   $tt = explode(" ", $row['linetext']);
		   $i = sizeof($tt) - 1 ;
		   while($i>=0 && $n<5)
	       {
	   		  $preced = $tt[$i]." ".$preced;
	   		  if(strcmp($tt[$i],"[")!==0 && strcmp($tt[$i],"]")!==0) 
		 	  	$n++;
	   	      $i--;
	 	    }
		 }
		 if($i>=0 ||$row['lineno'] >1) $preced = "... ".$preced; 
	   }
	 }
	
	   
	 // generate behind sting
	 $n = 0; // count the number of words before keyword
	 $i = $index+1;
	 $behind = "";
	 while($i<$size && $n<5)
	 {
	   $behind.= " ".$tokens[$i];
	   if(strcmp($tokens[$i],"[")!==0 && strcmp($tokens[$i],"]")!==0) 
		 $n++;
	   $i++;
	 }
	 // 
 	 if($n==5) // find 5 words after keyword
	 {
	   if($i<$size-1) $behind.=" ...";
	 }
	 else  // less than 5 words after keyword
	 {
	     $lookfor = $lineNO+1;
		 $query = "select linetext, lineno from `WRITINGS_LINES` where pid = $pid and lineno = $lookfor" ;
         $result = mysql_query($query);
		 $row = mysql_fetch_array($result);
		 if($row['linetext']!=="")
		 {
		   $tt = explode(" ", $row['linetext']);
		   $s = sizeof($tt);
		   $i = 0;
		   while($i<$s && $n<5)
	       {
	   		  $behind.= " ".$tt[$i];
	   		  if(strcmp($tt[$i],"[")!==0 && strcmp($tt[$i],"]")!==0) 
		 	  	$n++;
	   	      $i++;
	 	    }
		 }
		 if($i<$s-1) $behind.=" ...";
	 }
	 
	 
	 //
	 
	 $context = $preced."<span class=\"Highlight\">".$tokens[$index]."</span>".$behind;
	 return $context;
   }
   
   public function getTranslation()
   {	  
      $temp_term = mysql_real_escape_string($this->term);
	  $query = "SELECT term, morph, translation from `WRITINGS_TERMS` where term = '$temp_term' AND siglum = '$this->language' " ;
      $result = mysql_query($query);
		
	  return $result;
   }
} 
?>