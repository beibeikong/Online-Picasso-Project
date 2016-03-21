<?php if ( ! defined('PROJECTNAME')) exit(''); 
// this is linked list for Writings Concordance Occurrence
 
class LinkedList2
{
  public $head; 
  public $last;
  
  function __construct() 
  {
	$this->head = NULL;
	$this->last = NULL;
  }
  
  function add($term,$index)
  {
	if($this->head == NULL)
	{
	  $e = new Element($term, $index);
	  $this->head = $e;
	  $this->last = $e;
	}
	else
	{
	  $e = new Element($term, $index);
	  $this->last->nxt = $e;
	  $this->last = $e;
	}
  }
} 

class Element
{
  public $row;
  public $nxt; // point to next element
  public $index;
  
  function __construct($t, $i)
  {
    $this->row = $t;
	$this->nxt = NULL;
	$this->index = $i;
  }
}
?>
