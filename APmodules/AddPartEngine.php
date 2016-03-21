<?php if ( ! defined('PROJECTNAME')) exit(''); 
if(file_exists('APmodules/checkUser.php'))
    require_once('APmodules/checkUser.php');  // check if it is authenrized user
else
    die('0'); 
	
require_once('Database.php');

class AddPartEngine extends Database
{
  private $mid;
  private $part;
  private $text;
  private $commentary;
  private $image;
  private $translation;
  
  function __construct($param) 
  {
    parent::__construct(); 

	$this->mid = $param['mid'];
	$this->part = $param['part'];
	$this->text = trim($param['text']);
	
	$this->text = preg_replace('/\r\n/', "\n", $this->text);  
	$this->text = preg_replace('/\n\n+/', "\n", $this->text);  
	$this->text = preg_replace('/^\n/', "", $this->text); 
	$this->text = preg_replace('/\n$/', "", $this->text); 
	
	$this->commentary = mysql_real_escape_string(trim($param['Commentary']));
//	$this->translation =  mysql_real_escape_string(trim($param['Translation']));
        
        $this->translation = trim($param['Translation']);
        
        $this->translation = preg_replace('/\r\n/', "\n", $this->translation);  
	$this->translation = preg_replace('/\n\n+/', "\n", $this->translation);  
	$this->translation = preg_replace('/^\n/', "", $this->translation); 
	$this->translation = preg_replace('/\n$/', "", $this->translation); 
	$this->image = trim($param['opps']);
  }
  
  public function checkData()  
  {
	if($this->text == "") // check Collection
	  return "Invalid input error: <br>Text must not be empty."; 
	 else if($this->translation == "")
          return "Invalid input error: <br>Text must not be empty."; 
	return "OK";  
  }

  public function saveData()  //operate on database to save data
  {
	
	//******* shift the rest of the parts *******
	$query = "UPDATE `WRITINGS_PAGES` set pageseq= (pageseq+1) WHERE (mid = $this->mid AND pageseq >= $this->part)";
    $result = mysql_query($query);
	
	
	//******* insert new poem part metadata *******
	$query = "INSERT INTO `WRITINGS_PAGES` (mid, pageseq, image, commentary) VALUES ($this->mid,$this->part,'$this->image','$this->commentary')";
    $result = mysql_query($query);
	
	//******* insert the new lines *******
	$lineArray = explode("\n",$this->text);
	for($i=0; $i<count($lineArray); $i++)
	{
		$lineNO = $i+1;
		$lineText = str_replace("<line>", "", $lineArray[$i]);
		$lineText = str_replace("</line>", "", $lineText);
		$lineText = mysql_real_escape_string($lineText);
		$query = "INSERT INTO `WRITINGS_LINES` (pid,lineno,linetext) VALUES ( ( SELECT pid from `WRITINGS_PAGES` where mid= $this->mid AND pageseq= $this->part) , $lineNO , '$lineText')";
		$result = mysql_query($query);
	}
	
	///insert the new translation///
//	if ($this->translation != "")
//	{
        $lineArrayTranslation = explode("\n",$this->translation);
	for($j=0; $j<count($lineArrayTranslation); $j++)
	{
		$lineTNO = $j+1;
		$lineTranslation = str_replace("<line>", "", $lineArrayTranslation[$j]);
		$lineTranslation = str_replace("</line>", "", $lineTranslation);
                $lineTranslation = mysql_real_escape_string($lineTranslation);
//	$query = "INSERT INTO `WRITINGS_TRANSLATIONS` (pid, translation,) VALUES ( ( SELECT pid from `WRITINGS_PAGES` where mid= $this->mid AND pageseq= $this->part) ,'$this->translation')";
                $query = "INSERT INTO `WRITINGS_TRANSLATIONS` (pid, lineTNO, translation) VALUES ( ( SELECT pid from `WRITINGS_PAGES` where mid= $this->mid AND pageseq= $this->part) , $lineTNO, '$lineTranslation')";
	        $result = mysql_query($query);
	}
        
  //      }
	
	return "OK";
  }

} 
?>