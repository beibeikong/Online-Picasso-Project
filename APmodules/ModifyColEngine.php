<?php if ( ! defined('PROJECTNAME')) exit(''); 
if(file_exists('APmodules/checkUser.php'))
    require_once('APmodules/checkUser.php');  // check if it is authenrized user
else
    die('0'); 
	
require_once('Database.php');

class ModifyColEngine extends Database
{
  private $Name;
  private $Title;
  private $Position;
  private $Place;
  private $OrderPriority;
  private $Category;
  private $id;

  
  function __construct($param) 
  {
    parent::__construct(); 

	$this->id = $param['id'];
	$this->Name = mysql_real_escape_string(trim($param['Name']));
	$this->Title = mysql_real_escape_string(trim($param['Title']));
	$this->Position = mysql_real_escape_string(trim($param['Position']));
	$this->Place = mysql_real_escape_string(trim($param['Place']));
	$this->OrderPriority = mysql_real_escape_string(trim($param['OrderPriority']));
	$this->Category = mysql_real_escape_string(trim($param['Category']));
  }
    

  public function saveData()  //operate on database to save data
  {
	$query =  "UPDATE `COLLABORATORS` set Name='$this->Name',Title='$this->Title',Position='$this->Position',Place='$this->Place',OrderPriority='$this->OrderPriority',Category='$this->Category' where id=$this->id";

	$result = mysql_query($query);
	if($result !== TRUE)
	  return "Edit Collaborator failed.";
	
	return "OK";
  }

} 
?>