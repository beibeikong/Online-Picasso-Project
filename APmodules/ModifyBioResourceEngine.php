<?php if ( ! defined('PROJECTNAME')) exit(''); 
if(file_exists('APmodules/checkUser.php'))
    require_once('APmodules/checkUser.php');  // check if it is authenrized user
else
    die('0'); 
	
require_once('Database.php');

class ModifyBioResourceEngine extends Database
{
  private $id;
  private $Name;
  private $Type;
  private $GeneralType;
  private $XMLCode;
  
  function __construct($param) 
  {
    parent::__construct(); 

	$this->id = $param['ids'];
	$this->Name = mysql_real_escape_string(trim($param['Name']));
	$this->Type = mysql_real_escape_string(trim($param['Type']));
	$this->GeneralType = mysql_real_escape_string(trim($param['GeneralType']));
	$this->XMLCode = mysql_real_escape_string(trim($param['XMLCode']));
  }


  public function saveData()  //operate on database to save data
  {
	$query = "UPDATE `BIORESOURCES` SET Name='$this->Name',Type='$this->Type',GeneralType='$this->GeneralType',XMLCode='$this->XMLCode' WHERE id='$this->id'";
	$result = mysql_query($query);
	if($result !== TRUE)
	  return "Edit Biography Resource failed.";
	
	return "OK";
  }

} 
?>