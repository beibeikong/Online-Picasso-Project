<?php if ( ! defined('PROJECTNAME')) exit(''); 
if(file_exists('APmodules/checkUser.php'))
    require_once('APmodules/checkUser.php');  // check if it is authenrized user
else
    die('0'); 
	
require_once('Database.php');

class addLinkIdEngine extends Database
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
  }

  public function saveData()  //operate on database to save data
  {
	$query = "Insert Into `LINK` (category,title,URL) values ('$this->category','$this->Title','$this->URL')";
	$result = mysql_query($query);
	if($result !== TRUE)
	  return "Add LinkId failed.";
	
	return "OK";
  }

} 
?>