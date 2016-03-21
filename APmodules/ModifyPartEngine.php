<?php if ( ! defined('PROJECTNAME')) exit(''); 
if(file_exists('APmodules/checkUser.php'))
    require_once('APmodules/checkUser.php');  // check if it is authenrized user
else
    die('0'); 
	
require_once('Database.php');

class ModifyPartEngine extends Database
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
	$this->translation =  mysql_real_escape_string(trim($param['Translation']));
  //      $this->translation = trim($param['Translation']);
        $this->translation = preg_replace('/\r\n/', "\n", $this->translation);  
	$this->translation = preg_replace('/\n\n+/', "\n", $this->translation);  
	$this->translation = preg_replace('/^\n/', "", $this->translation); 
	$this->translation = preg_replace('/\n$/', "", $this->translation); 
	$this->image = trim($param['opps']);
  }
    

  public function saveData()  //operate on database to save data
  {
	
	//******* delete the old lines *******
	$query = "DELETE FROM `WRITINGS_LINES` WHERE pid = (SELECT pid FROM `WRITINGS_PAGES` WHERE mid= $this->mid AND pageseq= $this->part)";
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
	
	//******* update poem part metadata *******
	$query = "UPDATE `WRITINGS_PAGES` SET image = '$this->image', commentary = '$this->commentary' WHERE (mid = $this->mid AND pageseq = $this->part)";
    $result = mysql_query($query);
	/////////////////////////commentary end///////////
	
	
	
	//////////////delete the old translation///
	$query = "DELETE FROM `WRITINGS_TRANSLATIONS` WHERE pid = (SELECT pid FROM `WRITINGS_PAGES` WHERE mid= $this->mid AND pageseq= $this->part)";
    $result = mysql_query($query);
	
	if ($this->translation != "")
	{
	///insert the new translation///
        $lineArrayTranslation = explode("\n",$this->translation);
	for($j=0; $j<count($lineArrayTranslation); $j++)
	{
		$lineTNO = $j+1;
		$lineTranslation = str_replace("<line>", "", $lineArrayTranslation[$j]);
		$lineTranslation = str_replace("</line>", "", $lineTranslation);
                $lineTranslation = mysql_real_escape_string($lineTranslation);
//	$query = "INSERT INTO `WRITINGS_TRANSLATIONS` (pid, translation) VALUES ( ( SELECT pid from `WRITINGS_PAGES` where mid= $this->mid AND pageseq= $this->part) ,'$this->translation')";
	        $query = "INSERT INTO `WRITINGS_TRANSLATIONS` (pid, lineTNO, translation ) VALUES ( ( SELECT pid from `WRITINGS_PAGES` where mid= $this->mid AND pageseq= $this->part), $lineTNO, '$lineTranslation' )";
                $result = mysql_query($query);
	}
       }
	
            if($result !== TRUE) {
            return "Edit Poem Part failed.";
        }


        return "OK";
  }
} 
?>  