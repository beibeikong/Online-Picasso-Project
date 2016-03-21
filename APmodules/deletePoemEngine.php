<?php if ( ! defined('PROJECTNAME')) exit(''); 
if(file_exists('APmodules/checkUser.php'))
    require_once('APmodules/checkUser.php');  // check if it is authenrized user
else
    die('0'); 
	
require_once('Database.php');

class deletePoemEngine extends Database
{
  private $mid;
  
  function __construct($param) 
  {
    parent::__construct(); 
	
	$this->mid = $param;
  }

  public function deletePoem()
  {
    $query = "DELETE A,B,C FROM ((`WRITINGS_POEMS` AS A LEFT JOIN `WRITINGS_PAGES` AS B ON A.mid=B.mid) LEFT JOIN `WRITINGS_LINES` AS C ON B.pid=C.pid) WHERE (A.mid=$this->mid)";
    $result = mysql_query($query);
	return "OK";	
  }
    
  
} 
?>