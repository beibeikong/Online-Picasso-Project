<?php if ( ! defined('PROJECTNAME')) exit(''); 
if(file_exists('APmodules/checkUser.php'))
    require_once('APmodules/checkUser.php');  // check if it is authenrized user
else
    die('0'); 
	
require_once('Database.php');

class AddPoemEngine extends Database
{
  private $title;
  private $altTitle;
  private $abrTitle;
  private $duration;
  private $Siglum;
  
  private $StartYear;
  private $StartMonth;
  private $StartDay;
  private $StartDateFlag;
  private $EndYear;
  private $EndMonth;
  private $EndDay;
  private $EndDateFlag;


  
  function __construct($param) 
  {
    parent::__construct(); 

	$this->title = mysql_real_escape_string(trim($param['title']));
	$this->altTitle = trim($param['altTitle']);
	$this->abrTitle = trim($param['abrTitle']);
	$this->duration = mysql_real_escape_string(trim($param['duration']));
	$this->Siglum = $param['Siglum'];
	
	
	$this->StartYear = $param['StartYear'];
	$this->StartMonth = $param['StartMonth'];
	$this->StartDay = $param['StartDay'];
	$this->StartDateFlag = $param['StartDateFlag'];
	$this->EndYear = $param['EndYear'];
	$this->EndMonth = $param['EndMonth'];
	$this->EndDay = $param['EndDay'];
	$this->EndDateFlag = $param['EndDateFlag'];
  }
    
  public function checkData()  //check all data if legally
  {
	if($this->title == "") // check description
	  return "Invalid input error: <br>title must not be empty.";
	if($this->duration == "") // check description
	  return "Invalid input error: <br>duration must not be empty.";  
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
	
	return "OK";  
  }

  public function saveData()  //operate on database to save data
  {
	$query = "INSERT INTO `WRITINGS_POEMS` (title, altTitle, abrTitle, siglum, dateStart, dateStartFlag, dateEnd, dateEndFlag, duration) VALUES ('$this->title','$this->altTitle','$this->abrTitle','$this->Siglum',CONCAT('$this->StartYear','-','$this->StartMonth','-','$this->StartDay'),$this->StartDateFlag,CONCAT('$this->EndYear','-','$this->EndMonth','-','$this->EndDay'),$this->EndDateFlag,'$this->duration')";
	$result = mysql_query($query);
	if($result !== TRUE)
	  return "Add Poem failed.";
	
	return "OK";
  }

} 
?>