<?php if ( ! defined('PROJECTNAME')) exit(''); 
if(file_exists('APmodules/checkUser.php'))
    require_once('APmodules/checkUser.php');  // check if it is authenrized user
else
    die('0'); 
	
require_once('Database.php');

class deleteRefEngine extends Database
{
  private $id;
  
  function __construct($param) 
  {
    parent::__construct(); 
	$this->id = $param;
  }

  public function copyToTrash()
  {
    $query = "INSERT INTO `TRASH_REFERENCES` (oldId,Author,Title,Date,Publisher,Journal,Edition,Issue,Volume) SELECT id,Author,Title,Date,Publisher,Journal,Edition,Issue,Volume FROM `REFERENCES` WHERE id = $this->id";
    $result = mysql_query($query);
	if($result != TRUE)
	    return "Add to TRASH_REFERENCES failed. Can't delete $this->id now.";
	else
	    return "OK";	
  }

  public function deleteBio()
  {
    $query = "DELETE FROM `REFERENCES` WHERE id = $this->id";
    $result = mysql_query($query);
	return "OK";	
  }
    
  
} 
?>