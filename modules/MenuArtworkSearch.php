<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class MenuArtworkSearch extends Database
{
  function __construct() 
  {
    parent::__construct(); 
  }
    
  public function getData()  //operate on database to get data
  {
	$query = "SELECT Catalog,(SELECT Name FROM `CATALOGS` WHERE Abbr=C.Catalog) AS CatalogName,Volume FROM `CATVOLUMES` C ORDER BY Catalog ASC, VolumeOrder ASC";
	$result = mysql_query($query);
	return $result;
  }
  
} 
?>