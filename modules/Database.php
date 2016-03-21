<?php if ( ! defined('PROJECTNAME')) exit(''); 
  
// all modules will extend this class
  
class Database
{
  protected $link = "";
  const ITEMS_PER_PAGE = 30;
  
  function __construct() 
  {
	$link = mysql_pconnect("localhost", "edm012");
    mysql_select_db("picasso", $link);
	mysql_query("set names utf8");
  }
  
  public function imgName($opp)  // convert opp to image name
  {
    $opp = strtolower($opp);
    $opp = str_replace(".", "", $opp);
    $opp = str_replace(":", "-", $opp);
	return $opp;
  }
  
  public function escapeStringToHtmlText($temp)
  {
    $temp=trim($temp); 
	$temp=str_replace("&","&amp;",$temp);
	$temp=str_replace("\n"," ",$temp);
	$temp=str_replace("\r"," ",$temp);
	$temp=str_replace("<","&lt;",$temp);
	$temp=str_replace(">","&gt;",$temp);
	$temp=str_replace("\"", "&#34;",$temp);
	
	return $temp;
  }
}
  
?>
