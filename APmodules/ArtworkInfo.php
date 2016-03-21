<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class ArtworkInfo extends Database
{
  
  function __construct() 
  {
    parent::__construct(); 
  }
  
  public function getCatalog($opp)
  {
    $catalog = array();
	$query = "SELECT Catalog, Volume, Number, Suffix FROM RLTN_WORKS_CATALOG WHERE idArtwork='$opp' ORDER BY Catalog ASC, Volume ASC, Number ASC, Suffix ASC";
	$result = mysql_query($query);
	while($cata = mysql_fetch_array($result))
	{
	  $temp = $cata['Catalog'];
	  $temp.= ($cata['Volume']!='')? ".$cata[Volume]":"";
	  if($cata['Catalog']=="PP")
	  {
	    if($cata['Number'] < 10) $temp.= ":00$cata[Number]";
		elseif($cata['Number'] < 100) $temp.= ":0$cata[Number]";
		else $temp.= ":$cata[Number]";
	  }
	  else
	    $temp.= ":$cata[Number]";
	  $temp.= $cata['Suffix'];
	  $catalog[] = $temp;
	}
	return $catalog;
  }
  
  public function sortBooks($books)
  {
    $array = explode("; ",$books);
    sort($array);
	if(count($array)==1)
	  return $array[0];
	else
	{
	  $result = $array[0];
	  for($i=1; $i<count($array); $i++)
	  {
	    $result.= "; ".$array[$i];
	  }
	  return $result;
	}
  }
} 
?>
