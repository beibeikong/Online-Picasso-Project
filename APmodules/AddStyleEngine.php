<?php if ( ! defined('PROJECTNAME')) exit(''); 
if(file_exists('APmodules/checkUser.php'))
    require_once('APmodules/checkUser.php');  // check if it is authenrized user
else
    die('0'); 
	
require_once('Database.php');
require_once('GenericGuideOpp.php');

class addStyleEngine extends Database
{
  private $NewId;
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
	$this->StartYear = $param['StartYear'];
	$this->StartMonth = $param['StartMonth'];
	$this->StartDay = $param['StartDay'];
	$this->EndYear = $param['EndYear'];
	$this->EndMonth = $param['EndMonth'];
	$this->EndDay = $param['EndDay'];
	$this->Intro = trim($param['Intro']);
	$this->Notes = trim($param['Notes']);
  }
    
  public function checkData()  //check all data if legally
  {	  
	if($this->NewId == "") // check title
	  return "Invalid input error: <br>Guide name must not be empty.";
	
	$query = "SELECT count(*) FROM `STYLE` where guidename = '$this->NewId'" ; // check if this new studyname exists
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	if($row[0]!=0) return "The Style '$this->NewId' already exists.";
	
	

	
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
	return "OK";  
  }

  public function saveData()  //operate on database to save data
  {
    $intro = mysql_real_escape_string($this->Intro);
	$notes = mysql_real_escape_string($this->Notes);
	$query = "INSERT INTO `STYLE` (guidename,intro,notes,dateStart,dateEnd) VALUES ('$this->NewId','$intro','$notes',CONCAT('$this->StartYear','-','$this->StartMonth','-','$this->StartDay'),CONCAT('$this->EndYear','-','$this->EndMonth','-','$this->EndDay'))";
	$result = mysql_query($query);
	if($result !== TRUE)
	  return "Add Period failed.";
	  	
	return "OK";
  }

} 
?>