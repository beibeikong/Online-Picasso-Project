<?php if ( ! defined('PROJECTNAME')) exit(''); 
if(file_exists('APmodules/checkUser.php'))
    require_once('APmodules/checkUser.php');  // check if it is authenrized user
else
    die('0'); 
	
require_once('Database.php');

class deleteFrontUserEngine extends Database
{
  private $id;
  
  function __construct($param) 
  {
    parent::__construct(); 
	$this->id = $param;
  }

  public function deleteFrontUser()
  {
    $query = "DELETE FROM `FRONTUSERS` WHERE FrontUsername = '$this->id'";
    $result = mysql_query($query);
	return "OK";	
  }
  public function checkdata()
  {
      $query = "Select count(*) FROM `FRONTUSERS` WHERE FrontUsername = '$this->id'";
	  $result = mysql_query($query);
	  $row = mysql_fetch_array($result);
	  if($row[0]==0) 
		return "The Username '$this->id' does not exist.Please reload your page.";
	  else 
	    return "OK";
  }    
  
} 
?>