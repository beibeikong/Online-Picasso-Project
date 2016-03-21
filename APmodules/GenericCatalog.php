<?php if ( ! defined('PROJECTNAME')) exit(''); 
// this is linked list for Writings Concordance Occurrence
 
class GenericCatalog
{
  public $head; 
  public $last;
  public $Catalog;
  public $Volume; 
  public $Number;
  public $Suffix;
  public $NotVerified;
  
  function __construct() 
  {
	$this->head = NULL;
	$this->last = NULL;
	$this->Catalog ="";
    $this->Volume=""; 
    $this->Number=0;
    $this->Suffix="";
    $this->NotVerified=0;
  }
  
  public function add($s)
  {
	$this->parseCatalogString($s);
	
	if($this->head == NULL)
	{
	  $e = new Element($this->Catalog, $this->Volume, $this->Number, $this->Suffix,$this->NotVerified);
	  $this->head = $e;
	  $this->last = $e;
	}
	else
	{
	  $e = new Element($this->Catalog, $this->Volume, $this->Number, $this->Suffix,$this->NotVerified);
	  $this->last->nxt = $e;
	  $this->last = $e;
	}
  }
  //////////////////////////////////////////////////////////////////////////////////////
  public function parseCatalogString($CatalogString)
  {
	 $candidateCatalog = "";
	 $candidateVolume  = "";
	 $candidateNumber  = 0;
	 $candidateSuffix  = "";
	 $candidateAuthenticityNotVerified = 0;
		
	 $counter = 0;
	 $step = 1;
	 $someChar = '\0';
	 $firstNumPos = 0;
		
		
	 $CatalogString = trim($CatalogString);
		
	 if (strpos($CatalogString, "[") === 0 && strpos($CatalogString, "]") === strlen($CatalogString)-1)
	 {
		$candidateAuthenticityNotVerified = 1;
		$CatalogString = substr($CatalogString,1,strlen($CatalogString)-2);
	 }
		
	 while ($counter < strlen($CatalogString))
	 {
		 $someChar = substr($CatalogString,$counter,1);
			
		 if ($someChar == ":" || $someChar == ".")
		 {
			 $candidateCatalog = substr($CatalogString,0,$counter);
			 $step += $someChar == "." ? 1 : 2;
			 $counter++;
			 break;
		 }
		 $counter++;
	 }
		
	 if($step == 1)
		die("The catalog '$CatalogString' is invalid; the catalog delimiter is missing.");
	 else if (strlen($candidateCatalog) == 0)
		die("The catalog '$CatalogString' is invalid; a catalog name must be specified.");
		
	 if($step == 2)
	 {
		 while ($counter < strlen($CatalogString))
		 {
			 $someChar = substr($CatalogString,$counter,1);
				
			 if ($someChar == ":")
			 {
				 $candidateVolume = substr($CatalogString,strlen($candidateCatalog)+1,$counter-strlen($candidateCatalog)-1);
				 $step++;
				 $counter++;
				break;
			 }
			 $counter++;
		 }
			
		 if ($step == 2)
			die("The catalog '$CatalogString' is invalid; the volume delimiter is missing.");
		 else if (strlen($candidateVolume) == 0)
			die("The catalog '$CatalogString' is invalid; a volume name must be specified.");
	 }
		
	 $firstNumPos = $counter;
		
	 while($counter < strlen($CatalogString))
	 {
		 if(substr($CatalogString,$counter,1) < '0' || substr($CatalogString,$counter,1) > '9')
			break;
		 $counter++;
	 }

	 $candidateNumber = substr($CatalogString,$firstNumPos,$counter-$firstNumPos);

		
	if ($counter < strlen($CatalogString))
			$candidateSuffix = substr($CatalogString,$counter);
		
	$this->Catalog = $candidateCatalog;
    $this->Volume = $candidateVolume; 
    $this->Number = $candidateNumber;
    $this->Suffix = $candidateSuffix;
    $this->NotVerified = $candidateAuthenticityNotVerified;
  }
} 

class Element
{
  public $Catalog;
  public $Volume; 
  public $Number;
  public $Suffix;
  public $NotVerified;
  public $nxt; // point to next element
  
  function __construct($c, $v, $n, $s, $nv)
  {
    $this->Catalog = $c;
	$this->Volume = $v;
	$this->Number = $n;
	$this->Suffix = $s;
	$this->NotVerified = $nv;
	$this->nxt = NULL;
  }
}
?>
