<?php if ( ! defined('PROJECTNAME')) exit(''); 
if(file_exists('APmodules/checkUser.php'))
    require_once('APmodules/checkUser.php');  // check if it is authenrized user
else
    die('0'); 
	
require_once('Database.php');

class deleteArtworkEngine extends Database
{
  private $opp;
  
  function __construct($param) 
  {
    parent::__construct(); 
	
	$this->opp = $param;
  }
  
  public function IsArtworkReferenced()
  {
    $query = "SELECT COUNT(*) FROM `RLTN_NARR_WORKS` WHERE idArtwork = '$this->opp'" ;
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	if($row[0]!=0) return "Artwork $this->opp cannot be deleted because it is being referenced by one or more biography entries.";
	else return "OK";
  }
  
  public function copyToTrash()
  {
    $query = "INSERT INTO `TRASH_ARTWORK` (oldopp,notVerified,title,location,duration,dateStart,dateEnd,medium,dimension,collection,bookCatalog,notes,commentary,extraImages) SELECT opp,notVerified,title,location,duration,dateStart,dateEnd,medium,dimension,collection,bookCatalog,notes,commentary,extraImages FROM `ARTWORK` WHERE opp ='$this->opp'";
    $result = mysql_query($query);
	if($result != TRUE)
	    return "Add to TRASH_ARTWORK failed. Can't delete $this->opp now.";
	else
	    return "OK";	
  }
  
  public function deleteArtwork()
  {
    $query = "DELETE FROM `ARTWORK` WHERE opp = '$this->opp'";
    $result = mysql_query($query);
	return "OK";	
  }
    
  
} 
?>