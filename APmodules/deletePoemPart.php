<?php if ( ! defined('PROJECTNAME')) exit(''); 
if(file_exists('APmodules/checkUser.php'))
    require_once('APmodules/checkUser.php');  // check if it is authenrized user
else
    die('0'); 
	
require_once('Database.php');

class deletePoemPart extends Database
{
  private $mid;
  private $part;

  
  function __construct($param) 
  {
    parent::__construct(); 
	
	$this->mid = $param['mid'];
	$this->part = $param['part'];
  }

  public function delete()
  {

	//delete specified part
	$query = "DELETE B,C FROM (`WRITINGS_PAGES` AS B LEFT JOIN `WRITINGS_LINES` AS C ON B.pid=C.pid) WHERE (B.mid=$this->mid AND B.pageseq= $this->part)";
    $result = mysql_query($query);
	
	//shift the rest of the parts
	$query = "UPDATE `WRITINGS_PAGES` set pageseq= (pageseq-1) WHERE (mid = $this->mid AND pageseq > $this->part)";
	$result = mysql_query($query);
	
	return "OK";
  }
    
  
} 
?>