<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class Archive extends Database
{
  private $year;
  
  function __construct($param) 
  {
    parent::__construct(); 
	$this->year = $param;
  }

  public function getData()  //operate on database to get data
  {
    $query = "SELECT id,Title,Publisher,MONTH(Date) AS Month,DAY(Date) AS Day,DateFlag,DateDescription,Language,LEFT(Text,120) AS PartialText FROM `ARCHIVES` WHERE YEAR(Date) = $this->year ORDER BY DateOrder(Date,DateFlag) DESC";
	$result = mysql_query($query);
	return $result;
  }
  
  public function getTotalNum()
  {
    $result = mysql_query("SELECT FOUND_ROWS()");
	$totalNum = mysql_fetch_row($result);
    return $totalNum[0];
  }
  
  public function getLanguageName($l)
  {
    $lanName = "";
	switch ($l) 
	{
    	case "en":
        	$lanName = "English";
        	break;
    	case "it":
        	$lanName = "Italian";
        	break;
		case "ru":
        	$lanName = "Russian";
        	break;
    	case "es":
        	$lanName = "Spanish";
        	break;
		case "pt":
        	$lanName = "Portuguese";
        	break;
    	case "nl":
        	$lanName = "Dutch";
        	break;
		case "fr":
        	$lanName = "French";
        	break;
    	case "ca":
        	$lanName = "Catalan";
        	break;
		case "sv":
        	$lanName = "Swedish";
        	break;
    	case "de":
        	$lanName = "German";
        	break;
		case "ja":
        	$lanName = "Japanese";
        	break;
    	case "no":
        	$lanName = "Norwegian";
        	break;
	}
	return $lanName;
  }
} 
?>