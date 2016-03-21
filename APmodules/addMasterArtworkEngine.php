<?php if ( ! defined('PROJECTNAME')) exit(''); 
if(file_exists('APmodules/checkUser.php'))
    require_once('APmodules/checkUser.php');  // check if it is authenrized user
else
    die('0'); 
	
require_once('Database.php');
require_once('GenericGuideOpp.php');

class addArtworkEngine extends Database
{
  private $NewId;
  private $Author;  
  private $Title;
  private $Duration;
  private $StartYear;
  private $StartMonth;
  private $StartDay;
  private $StartDateFlag;
  private $EndYear;
  private $EndMonth;
  private $EndDay;
  private $EndDateFlag;
  private $Medium;
  private $Dimension;
  private $Collection;
  private $Commentary;
  private $Opps;  
  
  private $OppList;  
  
  function __construct($param) 
  {
    parent::__construct(); 
	
	$this->OppList = new GenericOpp();
	
	$this->NewId = trim($param['Masteropp']);  
	$this->Author = mysql_real_escape_string(trim($param['Author']));
	$this->Title = mysql_real_escape_string(trim($param['Title']));
	$this->Duration = mysql_real_escape_string(trim($param['Duration']));
	$this->StartYear = $param['StartYear'];
	$this->StartMonth = $param['StartMonth'];
	$this->StartDay = $param['StartDay'];
	$this->StartDateFlag = $param['StartDateFlag'];
	$this->EndYear = $param['EndYear'];
	$this->EndMonth = $param['EndMonth'];
	$this->EndDay = $param['EndDay'];
	$this->EndDateFlag = $param['EndDateFlag'];
	$this->Medium = mysql_real_escape_string(trim($param['Medium']));
	$this->Dimension = mysql_real_escape_string(trim($param['Dimension']));
	$this->Collection = mysql_real_escape_string(trim($param['Collection']));;
	$this->Commentary = trim($param['Commentary']);
	$this->Opps = trim($param['Opps']);	
  }
    
  public function checkData()  //check all data if legally
  {
	if(!preg_match("/^[a-zA-Z0-9]{7}+\:\d\d\d$/", $this->NewId))  // check OPP number
	  return "Invalid input error: <br>MasterOPP format is invalid.";
	  
	$query = "SELECT count(*) FROM `MASTERARTWORK` where masteropp = '$this->NewId'" ; // check if this new OPP exists
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	if($row[0]!=0) return "The Master Artwork of '$this->NewId' already exists.";
	
	if($this->Title == "") // check title
	  return "Invalid input error: <br>Title must not be empty.";
	if($this->Author == "") // check title
	  return "Invalid input error: <br>Author must not be empty.";	  
	if($this->Duration == "") // check Duration
	  return "Invalid input error: <br>Duration must not be empty."; 
	if(!is_numeric($this->StartYear))   // check StartYear
	  return "Invalid input error: <br>StartYear must be number."; 
	if(!is_numeric($this->StartMonth))   // check StartMonth
	  return "Invalid input error: <br>StartMonth must be number."; 
	if(!is_numeric($this->StartDay))   // check StartDay
	  return "Invalid input error: <br>StartDay must be number."; 
	if(!is_numeric($this->StartDateFlag))   // check StartDateFlag
	  return "Invalid input error: <br>StartDateFlag must be number."; 
	if(!is_numeric($this->EndYear))   // check EndYear
	  return "Invalid input error: <br>EndYear must be number."; 
	if(!is_numeric($this->EndMonth))   // check EndMonth
	  return "Invalid input error: <br>EndMonth must be number."; 
	if(!is_numeric($this->EndDay))   // check EndDay
	  return "Invalid input error: <br>EndDay must be number."; 
	if(!is_numeric($this->EndDateFlag))   // check EndDateFlag
	  return "Invalid input error: <br>EndDateFlag must be number."; 
	if($this->Medium == "") // check Medium
	  return "Invalid input error: <br>Medium must not be empty.";
	if($this->Dimension == "") // check Dimension
	  return "Invalid input error: <br>Dimension must not be empty.";  
	if($this->Collection == "") // check Collection
	  return "Invalid input error: <br>Collection must not be empty.";    

	// --- Check for proper format and existance of Opps ---------------
	$this->Opps = preg_replace('/\r\n/', "\n", $this->Opps);  
	$this->Opps = preg_replace('/\n\n+/', "\n", $this->Opps);  
	$this->Opps = preg_replace('/^\n/', "", $this->Opps); 
	$this->Opps = preg_replace('/^;/', "", $this->Opps); 
	$this->Opps = preg_replace('/\n$/', "", $this->Opps); 
	$this->Opps = preg_replace('/;$/', "", $this->Opps); 
	if(strlen($this->Opps)>0)
	{		
		$array = explode(";",$this->Opps);
		
		// check if this OPP exists and if one OPP appears more than one time in the "OPPS" text.
		for($i=0; $i<count($array); $i++)
	    {
			if (trim($array[$i])!="")
			{
				$this->OppList->add($array[$i]);
	    		$opp = $this->OppList->Opp;
				
				 // check if this OPP exists
				$query = "SELECT count(*) FROM `ARTWORK` where opp = '$opp'" ;
				$result = mysql_query($query);
				$row = mysql_fetch_array($result);
				if ($row[0]==0) 
					return "The OPP '$opp' does not exist.";				
				
				// check if one OPP appears more than one time in the "OPPs" text
				$count = substr_count($this->Opps,$opp);
				if ($count >1)
					return "The OPP '$opp' appears more than one time in OPPs area.";
			}	
		}
	} 
	// -------------finish checking OPPs-----------------------------------
	
	return "OK";  
  }

  public function saveData()  //operate on database to save data
  {
    $commentary = mysql_real_escape_string($this->Commentary);
	$query = "INSERT INTO `MASTERARTWORK` (masteropp,title,author,duration,dateStart,dateStartFlag,dateEnd,dateEndFlag,medium,dimension,collection,commentary) VALUES ('$this->NewId','$this->Title','$this->Author','$this->Duration',CONCAT('$this->StartYear','-','$this->StartMonth','-','$this->StartDay'),$this->StartDateFlag,CONCAT('$this->EndYear','-','$this->EndMonth','-','$this->EndDay'),$this->EndDateFlag,'$this->Medium','$this->Dimension','$this->Collection','$commentary')";
	$result = mysql_query($query);
	if($result !== TRUE)
	  return "Add new Artwork failed.";
	  //return $query;
	  
	//Add OPPs information to RLTN_MASTERARTWORK_ARTWORK;
	$current = $this->OppList->head;
	while($current!=NULL)
	{
	  $query = "INSERT INTO `RLTN_MASTERARTWORK_ARTWORK` (masteropp, opp) VALUES ('$this->NewId', '$current->Opp')";
	  $result = mysql_query($query);
	  if($result !== TRUE)
	    return "Add OPPs failed";
		
	  $current = $current->nxt;	
	}
	// --- End Add OPPs entries to RLTN_MASTERARTWORK_ARTWORK----------------------------------------  
	
	return "OK";

  }

} 
?>