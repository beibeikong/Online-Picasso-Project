<?php if ( ! defined('PROJECTNAME')) exit(''); 
if(file_exists('APmodules/checkUser.php'))
    require_once('APmodules/checkUser.php');  // check if it is authenrized user
else
    die('0'); 
	
require_once('Database.php');

class ArchiveArticle extends Database
{

  private $imgs;
  private $desc;
  private $text;
  
  function __construct($param) 
  {
    parent::__construct(); 
	
	$this->imgs = "";
	for($i=1;$i<=40;$i++)
	{
  		$paraName = "img$i";
  		$keyword = mysql_real_escape_string(trim($param[$paraName]));
  		if ($keyword !="")
  		{
     		if($this->imgs == "") $this->imgs = $keyword;
			else $this->imgs .= ";".$keyword;
  		}	  
	}
	
	////////// analyze Text to see if contains Photo
	if(stripos(trim($param['text']), "PHOTO:")===0)
	{	
		$photoDes = stripos($param['text'], "<br/>");
	 	$this->desc = trim(substr($param['text'],6,$photoDes));
	 	$this->text = substr($param['text'],$photoDes);
	}
	else
	{
		$this->desc = "";
    	$this->text = $param['text'];
	}
	/////////////////////////////////////////
  }
    
  public function getImgs()  //check all data if legally
  {
	return $this->imgs;
  }
  
  public function getPhotoDesc()  //check all data if legally
  {
	return $this->desc;
  }
  
  public function getText()  //check all data if legally
  {
	return $this->text;
  }


} 
?>