<?php if ( ! defined('PROJECTNAME')) exit(''); 
if(file_exists('APmodules/checkUser.php'))
    require_once('APmodules/checkUser.php');  // check if it is authenrized user
else
    die('0'); 
	
require_once('Database.php');

class AddFrontUserEngine extends Database
{
  private $UserName;
  private $Password;
  private $UserType;

  
  function __construct($param) 
  {
    parent::__construct(); 

	$this->UserName = mysql_real_escape_string(trim($param['UserName']));
	$this->Password = mysql_real_escape_string(trim($param['Password']));
	$this->Password2 = mysql_real_escape_string(trim($param['Password2']));
	$this->UserType = mysql_real_escape_string(trim($param['UserType']));


  }
  
   public function checkData()  //check all data if legally
  {	  
	if($this->Password != $this->Password2) return "Password are not same, please retype the password";
	
	  $query = "SELECT count(*) FROM `FRONTUSERS` where FrontUsername='$this->UserName'" ; // check if this new studyname exists
	  $result = mysql_query($query);
	  $row = mysql_fetch_array($result);
	  if($row[0]!=0) return "The Username '$this->UserName' already exists.";
	  
	// --- End checking, if not problem, return "OK"----------------------------------------  
	return "OK";  
  }       

  public function saveData()  //operate on database to save data
  {
	$query =  "INSERT INTO `FRONTUSERS` (FrontUsername,FrontPasswordSHA,UserType) VALUES ('$this->UserName',SHA1('$this->Password'),'$this->UserType')";

	$result = mysql_query($query);
	if($result !== TRUE)
	  return "Add Collaborator failed.";
	
	return "OK";
  }

} 
?>