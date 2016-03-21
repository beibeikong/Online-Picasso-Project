<?php if ( ! defined('PROJECTNAME')) exit(''); 
if(file_exists('APmodules/checkUser.php'))
    require_once('APmodules/checkUser.php');  // check if it is authenrized user
else
    die('0'); 
	
require_once('Database.php');

class deleteColEngine extends Database
{
  private $id;
  
  function __construct($param) 
  {
    parent::__construct(); 
	$this->id = $param;
  }

  public function deleteCol()
  {
    $query = "DELETE FROM `COLLABORATORS` WHERE id = $this->id";
    $result = mysql_query($query);
	return "OK";	
  }
    
  
} 
?>