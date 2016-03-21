<?php if ( ! defined('PROJECTNAME')) exit(''); 
if(file_exists('APmodules/checkUser.php'))
    require_once('APmodules/checkUser.php');  // check if it is authenrized user
else
    die('0'); 
	
require_once('Database.php');

class ModifyLinkIdEngine extends Database
{
  private $Title;
  private $URL;
  private $category;
  private $id;
  
  function __construct($param) 
  {
    parent::__construct(); 

	$this->Title = mysql_real_escape_string(trim($param['title']));
	$this->URL = mysql_real_escape_string(trim($param['URL']));
	$this->category = mysql_real_escape_string(trim($param['category']));
	$this->id = $param['id'];
  }
    
  public function checkData()  //check all data if legally
  {
	
	if($this->Title == "") // check description
	  return "Invalid input error: <br>Title must not be empty.";  
    if($this->URL == "") // check description
	  return "Invalid input error: <br>URL must not be empty."; 
	
	return "OK";  
  }

  public function saveData()  //operate on database to save data
  {
	$query = "UPDATE `LINK` SET category='$this->category',title='$this->Title',URL='$this->URL' WHERE idLink = $this->id";
	$result = mysql_query($query);
	if($result !== TRUE)
	  return "Edit Reference failed.";
	
	return "OK";
  }

} 
?>