<?php if ( ! defined('PROJECTNAME')) exit(''); 
if(file_exists('APmodules/checkUser.php'))
    require_once('APmodules/checkUser.php');  // check if it is authenrized user
else
    die('0'); 
	
require_once('Database.php');

class deletePoemTermEngine extends Database
{
  private $id;
  
  function __construct($param) 
  {
    parent::__construct(); 
	
	$this->id = $param;
  }

  public function deletePoem()
  {
    $query = "DELETE FROM `WRITINGS_TERMS` WHERE id = $this->id";
    $result = mysql_query($query);
	return "OK";	
  }
    
  
} 
?>