<?php if ( ! defined('PROJECTNAME')) exit(''); 
if(file_exists('APmodules/checkUser.php'))
    require_once('APmodules/checkUser.php');  // check if it is authenrized user
else
    die('0'); 
	
require_once('Database.php');

class AddRefEngine extends Database
{
  private $Author;
  private $Books;
  private $Catalogs;
  private $Title;
  private $Date;
  private $Publisher;
  private $Journal;
  private $Edition;
  private $Issue;
  private $Volume;
  private $Exhibitions;
  
  function __construct($param) 
  {
    parent::__construct(); 

	$this->Author = mysql_real_escape_string(trim($param['Author']));
	$this->Books = mysql_real_escape_string(trim($param['Books']));
	$this->Catalogs = mysql_real_escape_string(trim($param['Catalogs']));
	$this->Title = mysql_real_escape_string(trim($param['Title']));
	$this->Date = mysql_real_escape_string(trim($param['Date']));
	$this->Publisher = mysql_real_escape_string(trim($param['Publisher']));
	$this->Journal = mysql_real_escape_string(trim($param['Journal']));
	$this->Edition = mysql_real_escape_string(trim($param['Edition']));
	$this->Issue = mysql_real_escape_string(trim($param['Issue']));
	$this->Volume = mysql_real_escape_string(trim($param['Volume']));
        $this->Exhibitions = mysql_real_escape_string(trim($param['Exhibitions']));
  }
    
  public function checkData()  //check all data if legally
  {
	if($this->Author == "") // check description
	  return "Invalid input error: <br>Author must not be empty.";
	if($this->Title == "") // check description
	  return "Invalid input error: <br>Title must not be empty.";  
    if($this->Date == "") // check description
	  return "Invalid input error: <br>Date must not be empty."; 
	
	return "OK";  
  }

  public function saveData()  //operate on database to save data
  {
	$query =  "INSERT INTO `REFERENCES` (Author,Books,Catalogs,Title,Date,Publisher,Journal,Edition,Issue,Volume,Exhibitions) VALUES ('$this->Author','$this->Books','$this->Catalogs','$this->Title','$this->Date','$this->Publisher','$this->Journal','$this->Edition','$this->Issue','$this->Volume','$this->Exhibitions')";

	$result = mysql_query($query);
	if($result !== TRUE)
	  return "Add Reference failed.";
	
	return "OK";
  }

} 
?>