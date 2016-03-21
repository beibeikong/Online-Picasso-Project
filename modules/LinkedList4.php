<?php if ( ! defined('PROJECTNAME')) exit(''); 
// this is linked list for Writings Search Morph
 
class LinkedList4
{
  public $head; 
  public $last;
  
  function __construct() 
  {
	$this->head = NULL;
	$this->last = NULL;
  }
  
  function add($term,$lan, $n)
  {
	if($this->head == NULL)
	{
	  $e = new Element($term, $n, $lan);
	  $this->head = $e;
	  $this->last = $e;
	}
	else
	{
	  $e = new Element($term, $n, $lan);
	  $this->last->nxt = $e;
	  $this->last = $e;
	}
  }
} 

class Element
{
  public $term;
  public $num; //  the number of this term
  public $nxt; // point to next element
  public $lan;
  
  function __construct($t, $n, $lan)
  {
    $this->term = $t;
	$this->num = $n;
	$this->lan = $lan;
	$this->nxt = NULL;
  }
}
?>
