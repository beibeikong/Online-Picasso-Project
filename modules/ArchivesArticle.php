<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class ArchivesArticle extends Database
{
  private $id;
  private $photoDscrption;
  private $text;
  
  function __construct($param) 
  {
    parent::__construct(); 
	$this->id = mysql_real_escape_string($param);
	
  }
    
  public function getData()  //operate on database to get data
  {
	
	$query = "SELECT Title,Publisher,YEAR(Date) AS Year,MONTH(Date) AS Month,DAY(Date) AS Day, Images,Text,DateDescription FROM `ARCHIVES` WHERE id = $this->id";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	
	////////// analyze Text to see if contains Photo
if(stripos(trim($row['Text']), "PHOTO:")===0)
{	
	 $photoDes = stripos($row['Text'], "<br/>");
	 $this->photoDscrption = trim(substr($row['Text'],6,$photoDes));
	 $this->text = substr($row['Text'],$photoDes);
}
else
{
	$this->photoDscrption = "";
    $this->text = $row['Text'];
}
	/////////////////////////////////////////
	return  $row;
  }
  
  public function getPhotoDesc()
  {
    return $this->photoDscrption;
  }
  
  public function getText()
  {
    return $this->text;
  }

  public function parsePhotoName($fileName)   //get rid of the file type from file name, eg., from oppf19-003.jpg to oppf19-003
  {
	$cleanFileName = substr($fileName, 0, strrpos($fileName, "."));  //get the file name without file type
	 return $cleanFileName;
  }
 
} 
?>
