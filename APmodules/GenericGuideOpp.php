<?php if ( ! defined('PROJECTNAME')) exit(''); 
// this is linked list for Writings OPP occurence in STUDY
 
class GenericOpp
{
  public $head; 
  public $last;
  public $Opp;

  
  function __construct() 
  {
	$this->head = NULL;
	$this->last = NULL;
	$this->Opp ="";
  }
  
  public function add($s)
  {
	$this->parseOppString($s);  //check the format of OPP and eliminate  whitespace from the beginning and end of a OPPstring
	
	if($this->head == NULL)
	{
	  $e = new Element($this->Opp);
	  $this->head = $e;
	  $this->last = $e;
	}
	else
	{
	  $e = new Element($this->Opp);
	  $this->last->nxt = $e;
	  $this->last = $e;
	}
  }
  //////////////////////////////////////////////////////////////////////////////////////
  public function parseOppString($OppString)
  {
	$OppString = trim($OppString);
	if(!preg_match("/^OPP+\.\d\d+\:\d\d\d$/", $OppString))  // check OPP number
	  die("Invalid input error: <br>OPP '$OppString' format is invalid.");
	$this->Opp=$OppString;
  }
} 

class Element
{
  public $Opp;
  public $nxt; // point to next element
  
  function __construct($s)
  {
    $this->Opp = $s;
	$this->nxt = NULL;
  }
}
?>
