<?php if ( ! defined('PROJECTNAME')) exit(''); 
if(file_exists('APmodules/checkUser.php'))
    require_once('APmodules/checkUser.php');  // check if it is authenrized user
else
    die('0'); 
	
require_once('Database.php');

class AddTermEngine extends Database
{
  private $Term;
  private $Siglum;
  private $Category;
  private $Morph;
  private $Translation;
  private $relatedFreTerms;
  private $relatedSpaTerms;

  function __construct($param) 
  {
    parent::__construct(); 

	$this->Term = trim($param['Term']);
	$this->Siglum = $param['Siglum'];
	$this->Category = $param['Category'];
	$this->Morph = $param['Morph'];
	$this->Translation = $param['Translation'];
	$this->relatedFreTerms = $param['relatedFreTerms'];
	$this->relatedSpaTerms = $param['relatedSpaTerms'];
	$this->Term = str_replace("'","\'",$this->Term);
  }
    
  public function checkData()  //check all data if legally
  {
	if($this->Term == "") // check description
	  return "Invalid input error: <br>Term must not be empty.";
	if($this->Morph == "") // check description
	  return "Invalid input error: <br>Morph must not be empty.";  
	  
	return "OK";  
  }

  public function saveData()  //operate on database to save data
  {
	$query = "INSERT INTO `WRITINGS_TERMS` (term, siglum, category, morph, translation, relatedFreTerms, relatedSpaTerms) VALUES ('$this->Term','$this->Siglum','$this->Category','$this->Morph','$this->Translation','$this->relatedFreTerms','$this->relatedSpaTerms')";
	$result = mysql_query($query);
	if($result !== TRUE)
	  return "Add Term failed.";
	
	return "OK";
  }

} 
?>