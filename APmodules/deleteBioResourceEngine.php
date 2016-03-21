<?php if ( ! defined('PROJECTNAME')) exit(''); 
if(file_exists('APmodules/checkUser.php'))
    require_once('APmodules/checkUser.php');  // check if it is authenrized user
else
    die('0'); 
	
require_once('Database.php');

class deleteBioResourceEngine extends Database
{
  private $id;
  
  function __construct($param) 
  {
    parent::__construct(); 
	
	$this->id = $param;
  }

  public function copyToTrash()
  {
    $query = "INSERT INTO `TRASH_BIORESOURCES` (oldId,Name,Type,GeneralType,XMLCode) SELECT id,Name,Type,GeneralType,XMLCode FROM `BIORESOURCES` WHERE id= '$this->id'";
    $result = mysql_query($query);
	if($result != TRUE)
	    return "Add to TRASH_BIORESOURCES failed. Can't delete $this->id now.";
	else
	    return "OK";	
  }

  public function deleteArc()
  {
    $query = "DELETE FROM  `BIORESOURCES` WHERE id = '$this->id'";
    $result = mysql_query($query);
	return "OK";	
  }
    
} 
?>