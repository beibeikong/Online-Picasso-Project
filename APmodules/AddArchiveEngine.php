<?php if ( ! defined('PROJECTNAME')) exit(''); 
if(file_exists('APmodules/checkUser.php'))
    require_once('APmodules/checkUser.php');  // check if it is authenrized user
else
    die('0'); 
	
require_once('Database.php');

class AddArchiveEngine extends Database
{
  private $Title;
  private $Publisher;
  private $Year;
  private $Month;
  private $Day;
  private $DateFlag;

  private $Description;
  private $Lan;
  private $Text;
  private $imgs;
  
  function __construct($param) 
  {
    parent::__construct(); 

	$this->Title = mysql_real_escape_string(trim($param['Title']));
	$this->Publisher = mysql_real_escape_string(trim($param['Publisher']));
	
	$this->Year = mysql_real_escape_string(trim($param['Year']));
	$this->Month = mysql_real_escape_string(trim($param['Month']));
	$this->Day = mysql_real_escape_string(trim($param['Day']));
	$this->DateFlag = mysql_real_escape_string(trim($param['DateFlag']));
	
	$this->Description = mysql_real_escape_string(trim($param['Description']));
	$this->Lan = mysql_real_escape_string(trim($param['Lan']));
	$this->Text = mysql_real_escape_string(trim($param['text']));
	
	$this->imgs = "";
	for($i=1;$i<=50;$i++)
	{
  		$paraName = "img$i";
  		$keyword = mysql_real_escape_string(trim($param[$paraName]));
  		if ($keyword !="")
  		{
     		if($this->imgs == "") $this->imgs = $keyword;
			else $this->imgs .= ";".$keyword;
  		}	  
	}
  }
    
  public function checkData()  //check all data if legally
  {
	if($this->Publisher == "") // check description
	  return "Invalid input error: <br>Publisher must not be empty.";
	if($this->Title == "") // check description
	  return "Invalid input error: <br>Title must not be empty.";  
	if($this->Text == "") // check description
	  return "Invalid input error: <br>Text must not be empty."; 
	
	return "OK";  
  }

  public function saveData()  //operate on database to save data
  {
	$query =  "INSERT INTO `ARCHIVES` (Title,Publisher,Date,DateFlag,DateDescription,Language,Images,Text) VALUES ('$this->Title','$this->Publisher',CONCAT('$this->Year','-','$this->Month','-','$this->Day'),$this->DateFlag,'$this->Description','$this->Lan','$this->imgs','$this->Text')";

	$result = mysql_query($query);
	if($result !== TRUE)
	  return "Add Reference failed.";
	
	return "OK";
  }

} 
?>