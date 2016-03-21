<?php if ( ! defined('PROJECTNAME')) exit(''); 
if(file_exists('APmodules/checkUser.php'))
    require_once('APmodules/checkUser.php');  // check if it is authenrized user
else
    die('0'); 
	
require_once('Database.php');

class deletePhotoEngine extends Database
{
  private $name;
  
  function __construct($param) 
  {
    parent::__construct(); 
	
	$this->name = $param;
	$this->no = stristr($this->name,'_');
	$this->no = substr($this->no,1);
	$this->name = substr($this->name,0,strcspn($this->name,"_"));
	
  }
 
  public function copyToTrash()
  {
    $query = "INSERT INTO TRASH_PHOTO (oldId,no,name,description) SELECT id,no,name,description FROM RLTN_NARR_PHOTO WHERE name='$this->name' AND no=$this->no";
    $result = mysql_query($query);
	if($result != TRUE)
	    return "Add to TRASH_NARRATIVE failed. Can't delete $this->name now.";
	else
	    return "OK";	
  }

  public function deletePhoto()
  {
    $query = "DELETE FROM `RLTN_NARR_PHOTO` WHERE name='$this->name' AND no=$this->no";
    $result = mysql_query($query);
	return "OK";	
  }
    
  
} 
?>