<?php if ( ! defined('PROJECTNAME')) exit(''); 
// this is sorted linked list for Writings Concordance

class LinkedList
{
  public $totalNum;  // total number of concordance
  public $head; 
  
  function __construct() 
  {
	$this->totalNum = 0;
	$this->head = NULL;
  }
  
  function add($term)
  {
    if($this->head == NULL)
	{
	  $e = new Element($term);
	  $this->totalNum++;
	  $this->head = $e;
	}
	else  // now sequentially search the sorted linked list and insert it
	{
	  $current = $this->head;
	  $previous = NULL;
	  for($i=1; $i<=$this->totalNum; $i++)
	  {
	    if(strcmp($term, $current->term)==0) // same
		{
		  $current->num++;
		  break;
		}  
		else if(strcmp($term, $current->term)>0) // term is greater than current one
		{
		  $previous = $current;
		  $current = $current->nxt;
		}
		else if(strcmp($term, $current->term)<0) // term is less than current one
		{
		  $e = new Element($term);
		  if($i==1)
		  {
		    $this->head = $e;
			$e->nxt = $current;
			$this->totalNum++;
		  }
		  else
		  {
		    $previous->nxt = $e;
		    $e->nxt = $current;
			$this->totalNum++;
	      }		
		  break;
		}
	  }
	  if($current==NULL) // add to last
	  {
	    $e = new Element($term);
		$previous->nxt = $e;
		$this->totalNum++;
	  }
	}
  }
} 

class Element
{
  public $term;
  public $num; //  the number of this term
  public $nxt; // point to next element
  
  function __construct($t)
  {
    $this->term = $t;
	$this->num = 1;
	$this->nxt = NULL;
  }
}
?>
