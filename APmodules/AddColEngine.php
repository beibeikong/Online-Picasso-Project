<?php if ( ! defined('PROJECTNAME')) exit(''); 
if(file_exists('APmodules/checkUser.php'))
    require_once('APmodules/checkUser.php');  // check if it is authenrized user
else
    die('0'); 
	
require_once('Database.php');

class AddColEngine extends Database
{
  private $Name;
  private $Title;
  private $Position;
  private $Place;
  private $OrderPriority;
  private $Category;

  
  function __construct($param) 
  {
    parent::__construct(); 

	$this->Name = mysql_real_escape_string(trim($param['Name']));
	$this->Title = mysql_real_escape_string(trim($param['Title']));
	$this->Position = mysql_real_escape_string(trim($param['Position']));
	$this->Place = mysql_real_escape_string(trim($param['Place']));
	$this->OrderPriority = mysql_real_escape_string(trim($param['OrderPriority']));
	$this->Category = mysql_real_escape_string(trim($param['Category']));
  }
    

  public function saveData()  //operate on database to save data
  {
	$query =  "INSERT INTO `COLLABORATORS` (Name,Title,Position,Place,OrderPriority,Category) VALUES ('$this->Name','$this->Title','$this->Position','$this->Place','$this->OrderPriority','$this->Category')";

	$result = mysql_query($query);
	if($result !== TRUE)
	  return "Add Collaborator failed.";
	
	return "OK";
  }

} 
?>