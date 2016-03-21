<?php if ( ! defined('PROJECTNAME')) exit(''); 
if(file_exists('APmodules/checkUser.php'))
    require_once('APmodules/checkUser.php');  // check if it is authenrized user
else
    die('0'); 
	
require_once('Database.php');

class ModifyPhotoEngine extends Database
{
  private $id;
  private $Datedesc;
  private $year;
  private $no;
  private $name;
  private $description;

  
  function __construct($param) 
  {
    parent::__construct(); 

	$this->id = $param['id'];
	$this->Datedesc = trim($param['desc']);
	$this->year = $param['year'];
	$this->no = $param['no'];
	$this->name = $param['name'];
	$this->name = str_replace("\\","\\\\",$this->name);
	$this->name = str_replace("'","\'",$this->name);
	$this->description = $param['description'];
	$this->description = str_replace("\\","\\\\",$this->description);
	$this->description = str_replace("'","\'",$this->description);
	$this->description =str_replace('(','\\(',$this->description);
   	$this->description =str_replace(')','\\)',$this->description);
  }
	 
  public function checkData()  //check all data if legally
  {
	$query = "SELECT id from `NARRATIVE` WHERE Datedesc='$this->Datedesc' AND YEAR(dateStart)=$this->year";
	 $result = mysql_query($query);
	 $row = mysql_fetch_array($result);
	if($this->Datedesc == "") // check description
	  return "Invalid input error: <br>Date description must not be empty.";
	if(!is_numeric($this->year))   // check StartYear
	  return "Invalid input error: <br>Year must be number."; 
	 if($this->name == "") // check description
	  return "Invalid input error: <br>Name must not be empty.";
	  if($this->description == "") // check description
	  return "Invalid input error: <br>Description must not be empty.";
	  if($row['id']=='')
	  return "Can not find Date description from Biography.";
	return "OK";  
  }

  public function saveData()  //operate on database to save data
  {
	$query = "SELECT id from `NARRATIVE` WHERE Datedesc='$this->Datedesc' AND YEAR(dateStart)=$this->year";
	 $result = mysql_query($query);
	 $row = mysql_fetch_array($result);
	if($row['id']==$this->id)
	{
		$query = "UPDATE `RLTN_NARR_PHOTO` SET name='$this->name',description='$this->description' WHERE id='$this->id' and no='$this->no'";
	$result = mysql_query($query);
	if($result !== TRUE)
	  return "Modify Photo failed.";
	}
	else{
	$newid = $row['id'];
	$query = "SELECT Max(no) from `RLTN_NARR_PHOTO` WHERE id=$newid";
	$result = mysql_query($query);
	$norow = mysql_fetch_row($result);
	$newno = $norow[0]+1;
	$query = "INSERT INTO `RLTN_NARR_PHOTO`(id,no,name,description) values($newid,$newno,'$this->name','$this->description')";
	$result = mysql_query($query);
	if($result !== TRUE)
	  return "Modify Photo failed.";

	$query = "DELETE FROM `RLTN_NARR_PHOTO` WHERE id=$this->id AND no=$this->no";
	$result = mysql_query($query);
	}
	return "OK";
  }


} 
?>