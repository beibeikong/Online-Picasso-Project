<?php if ( ! defined('PROJECTNAME')) exit(''); 
if(file_exists('APmodules/checkUser.php'))
    require_once('APmodules/checkUser.php');  // check if it is authenrized user
else
    die('0'); 
	
require_once('Database.php');

class deleteMasterArtworkEngine extends Database
{
  private $masteropp;
  
  function __construct($param) 
  {
    parent::__construct(); 
	
	$this->masteropp = $param;
  }
  
  public function deleteMasterArtwork()
  {
	$query = "DELETE FROM `RLTN_MASTERARTWORK_ARTWORK` WHERE masteropp = '$this->masteropp'";
    $result = mysql_query($query);
	if($result != TRUE)
	    return "Delete from RLTN_MASTERARTWORK_ARTWORK failed. Can't delete '$this->masteropp' now.";
		
	$query = "DELETE FROM `MASTERARTWORK` WHERE masteropp = '$this->masteropp'";
    $result = mysql_query($query);
	return "OK";	
  }
  
  public function checkdata()
  {
      $query = "Select count(*) FROM `MASTERARTWORK` WHERE masteropp = '$this->masteropp'";
	  $result = mysql_query($query);
	  $row = mysql_fetch_array($result);
	  if($row[0]==0) 
		return "The Master OPP '$this->masteropp' does not exist.Please reload your page.";
	  else 
	    return "OK";
  }
  
} 
?>