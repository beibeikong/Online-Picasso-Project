<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class GuideList extends Database
{ 
  public function getTheme()  //operate on database to get data
  {
	$query = "SELECT guidename FROM `THEME` order by guidename";
	$result = mysql_query($query);
	while ($row = mysql_fetch_array($result)){
		$themelist[] = $row[0];
	} 	
	return $themelist;
  }
  
  public function getStyle()  //operate on database to get data
  {
	$query = "SELECT SQL_CALC_FOUND_ROWS guidename FROM `STYLE` order by dateStart $direction, dateEnd ";
	$result = mysql_query($query);
	while ($row = mysql_fetch_array($result)){
		$stylelist[] = $row[0];
	} 	
	return $stylelist;
  }
} 
?>
