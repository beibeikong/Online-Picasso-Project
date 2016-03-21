<?php if ( ! defined('PROJECTNAME')) exit(''); 
if(file_exists('APmodules/checkUser.php'))
    require_once('APmodules/checkUser.php');  // check if it is authenrized user
else
    die('0'); 
	
require_once('Database.php');

class addBioEngine extends Database
{
  private $description;

  private $StartYear;
  private $StartMonth;
  private $StartDay;
  private $StartDateFlag;
  private $EndYear;
  private $EndMonth;
  private $EndDay;
  private $EndDateFlag;

  private $Event;
  private $Commentary;

  
  function __construct($param) 
  {
    parent::__construct(); 

	$this->description = trim($param['desc']);

	$this->StartYear = $param['StartYear'];
	$this->StartMonth = $param['StartMonth'];
	$this->StartDay = $param['StartDay'];
	$this->StartDateFlag = $param['StartDateFlag'];
	$this->EndYear = $param['EndYear'];
	$this->EndMonth = $param['EndMonth'];
	$this->EndDay = $param['EndDay'];
	$this->EndDateFlag = $param['EndDateFlag'];
	
	$this->Event = trim($param['Event']);
	$this->Commentary = trim($param['Commentary']);
  }
    
  public function checkData()  //check all data if legally
  {
	if($this->description == "") // check description
	  return "Invalid input error: <br>Description must not be empty.";
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
	
        $start = $this->StartYear."-".$this->StartMonth."-".$this->StartDay;
        $end =$this->EndYear."-".$this->EndMonth."-".$this->EndDay;
        if($start>$end)  //check if EndDate is equal to or later than StartDate
            return "Invalid input error: <br>EndDate must be equal to or later than StartDate";
        
	return "OK";  
  }

  public function saveData()  //operate on database to save data
  {
    $commentary = mysql_real_escape_string($this->Commentary);
	$event = mysql_real_escape_string($this->Event);
	
	$query = "INSERT INTO `NARRATIVE` (dateStart,dateStartFlag,dateEnd,dateEndFlag,dateDesc,event,commentary) VALUES (CONCAT('$this->StartYear','-','$this->StartMonth','-','$this->StartDay'),$this->StartDateFlag,CONCAT('$this->EndYear','-','$this->EndMonth','-','$this->EndDay'),$this->EndDateFlag,'$this->description','$event','$commentary')";
	$result = mysql_query($query);
	if($result !== TRUE)
	  return "Add new Biography failed.";
	
	$this->CheckSingleBioEntry();
	
	return "OK";
  }
  
  public function CheckSingleBioEntry()
  {
    $result = mysql_query("SELECT LAST_INSERT_ID()");
	$LastNum = mysql_fetch_row($result);
	$GeneratedKey = $LastNum[0];
	
	
	
	$text = $this->Commentary.$this->Event;
	
	// --- start add record to RTLN_ARTWORK_LINK
	while($startPosition = strpos($text, "<linkId>"))
	{
	  $endPosition = strpos($text, "</linkId>");
	  $tagLength = $endPosition - $startPosition - 8;
	  $tagText = trim(substr($text,$startPosition+8, $tagLength));  // $tagText is the text between <linkId> and </linkId>
	  
	  $query = "INSERT INTO `RLTN_NARR_LINKS` (idNarrative,idLink) VALUES ($GeneratedKey, $tagText)";
      $result = mysql_query($query); 
	  
	  $text = str_replace("<linkId>".$tagText."</linkId>", "", $text);
	}
	// --- end add record to RTLN_ARTWORK_LINK
	
    // --- start add record to RLTN_AC_ARTWORK
	while($startPosition = strpos($text, "<artwork>"))
	{
	  $endPosition = strpos($text, "</artwork>");
	  $tagLength = $endPosition - $startPosition - 9;
	  $tagText = trim(substr($text,$startPosition+9, $tagLength));  // $tagText is the text between <artwork> and </artwork>
	  
	  $query = "INSERT INTO `RLTN_NARR_WORKS` (idNarrative,idArtwork) VALUES ($GeneratedKey, '$tagText')";
      $result = mysql_query($query); 
	  $text = str_replace("<artwork>".$tagText."</artwork>", "", $text);
	}
	// --- end add record to RLTN_AC_ARTWORK
  }


} 
?>