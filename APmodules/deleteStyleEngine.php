<?php if ( ! defined('PROJECTNAME')) exit(''); 
if(file_exists('APmodules/checkUser.php'))
    require_once('APmodules/checkUser.php');  // check if it is authenrized user
else
    die('0'); 
	
require_once('Database.php');

class deleteStyleEngine extends Database
{
  private $guidename;
  
  function __construct($param) 
  {
    parent::__construct(); 
	
	$this->guidename = $param;
  }
  
  
  public function deleteGuide()
  {		
	$query = "DELETE FROM `STYLE` WHERE guidename = '$this->guidename'";
	$result = mysql_query($query);
	if($result != TRUE)
	    return "Delete from STYLE table failed. Can't delete '$this->guidename' now.";    
	return "OK";	
  }
  
  public function checkdata()
  {
      $query = "Select count(*) FROM `STYLE` WHERE guidename = '$this->guidename'";
	  $result = mysql_query($query);
	  $row = mysql_fetch_array($result);
	  if($row[0]==0) 
		return "The Style '$this->guidename' does not exist.Please reload your page.";
	  else 
	    return "OK";
  }
  
} 
?>