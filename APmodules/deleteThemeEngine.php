<?php if ( ! defined('PROJECTNAME')) exit(''); 
if(file_exists('APmodules/checkUser.php'))
    require_once('APmodules/checkUser.php');  // check if it is authenrized user
else
    die('0'); 
	
require_once('Database.php');

class deleteThemeEngine extends Database
{
  private $guidename;
  
  function __construct($param) 
  {
    parent::__construct(); 
	
	$this->guidename = $param;
  }
  
  
  public function deleteGuide()
  {
	$query = "DELETE FROM `RLTN_THEME_ARTWORK` WHERE guidename = '$this->guidename'";
    $result = mysql_query($query);
	if($result != TRUE)
	    return "Delete from RLTN_THEME_ARTWORK failed. Can't delete '$this->guidename' now.";
		
	$query = "DELETE FROM `THEME` WHERE guidename = '$this->guidename'";
    $result = mysql_query($query);
	return "OK";	
  }
  
  public function checkdata()
  {
      $query = "Select count(*) FROM `THEME` WHERE guidename = '$this->guidename'";
	  $result = mysql_query($query);
	  $row = mysql_fetch_array($result);
	  if($row[0]==0) 
		return "The Theme '$this->guidename' does not exist.Please reload your page.";
	  else 
	    return "OK";
  }
  
} 
?>