<?php if ( ! defined('PROJECTNAME')) exit(''); 
if(file_exists('APmodules/checkUser.php'))
    require_once('APmodules/checkUser.php');  // check if it is authenrized user
else
    die('0'); 
	
require_once('Database.php');
require_once('GenericGuideOpp.php');

class addThemeEngine extends Database
{
  private $NewId;
  private $Guidetype;
  private $StartYear;
  private $StartMonth;
  private $StartDay;
  private $EndYear;
  private $EndMonth;
  private $EndDay;
  private $Notes;
  private $Intro;
  private $Opps;
  
  private $OppList;
  
  function __construct($param) 
  {
    parent::__construct(); 
	
	$this->OppList = new GenericOpp();
	
	$this->NewId = trim($param['Guideid']);
	$this->Guidetype = trim($param['Guidetype']);
	$this->StartYear = $param['StartYear'];
	$this->StartMonth = $param['StartMonth'];
	$this->StartDay = $param['StartDay'];
	$this->EndYear = $param['EndYear'];
	$this->EndMonth = $param['EndMonth'];
	$this->EndDay = $param['EndDay'];
	$this->Intro = trim($param['Intro']);
	$this->Opps = trim($param['Opps']);
	$this->Notes = trim($param['Notes']);
  }
    
  public function checkData()  //check all data if legally
  {	  
	if($this->NewId == "") // check title
	  return "Invalid input error: <br>Guide name must not be empty.";
	
	$query = "SELECT count(*) FROM `THEME` where guidename = '$this->NewId'" ; // check if this new studyname exists
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	if($row[0]!=0) return "The Theme '$this->NewId' already exists.";
	
	

	
	if(!is_numeric($this->StartYear))   // check StartYear
	  return "Invalid input error: <br>StartYear must be number."; 
	if(!is_numeric($this->StartMonth))   // check StartMonth
	  return "Invalid input error: <br>StartMonth must be number."; 
	if(!is_numeric($this->StartDay))   // check StartDay
	  return "Invalid input error: <br>StartDay must be number."; 
	if(!is_numeric($this->EndYear))   // check EndYear
	  return "Invalid input error: <br>EndYear must be number."; 
	if(!is_numeric($this->EndMonth))   // check EndMonth
	  return "Invalid input error: <br>EndMonth must be number."; 
	if(!is_numeric($this->EndDay))   // check EndDay
	  return "Invalid input error: <br>EndDay must be number."; 
	
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
	// --- End checking, if not problem, return "OK"----------------------------------------  
	return "OK";  
  }

  public function saveData()  //operate on database to save data
  {
    $intro = mysql_real_escape_string($this->Intro);
	$notes = mysql_real_escape_string($this->Notes);
	$query = "INSERT INTO `THEME` (guidename,intro,notes,dateStart,dateEnd) VALUES ('$this->NewId','$intro','$notes',CONCAT('$this->StartYear','-','$this->StartMonth','-','$this->StartDay'),CONCAT('$this->EndYear','-','$this->EndMonth','-','$this->EndDay'))";
	$result = mysql_query($query);
	if($result !== TRUE)
	  return "Add Theme failed.";
	  
	//Add OPPs information to RLTN_THEME_ARTWORK;

	$current = $this->OppList->head;
	while($current!=NULL)
	{
	  $query = "INSERT INTO `RLTN_THEME_ARTWORK` (guidename, opp) VALUES ('$this->NewId', '$current->Opp')";
	  $result = mysql_query($query);
	  if($result !== TRUE)
	    return "Add OPPs failed";
		
	  $current = $current->nxt;	
	}
	// --- End Add OPPs entries to RLTN_THEME_ARTWORK----------------------------------------    
	
	return "OK";
  }

} 
?>