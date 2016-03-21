<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class ArtworkBibliography extends Database
{
  private $oppID;
  
  function __construct($oppID) 
  {
    parent::__construct(); 
	
    $this->oppID = $oppID;
  }
    
  public function getData()  //operate on database to get data
  {
	$query = "SELECT opp,notVerified,title,location,duration,medium,dimension,collection,inventory,extraImages,bookCatalog,notes,commentary,YEAR(dateStart) as startyear FROM `ARTWORK` WHERE opp = '$this->oppID'";
	$result = mysql_query($query);
	//$result = die($query);
	return $result;
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
  
 public function getRef($keywords1,$keywords2)
  { 
  	$query = "SELECT SQL_CALC_FOUND_ROWS id,Author,Books,Catalogs,Title,Date,Publisher,Journal,Edition,Issue,Volume,Exhibitions FROM `REFERENCES` WHERE ";
	if ( trim($keywords1) != '') {
  	$words= explode(" ", trim($keywords1));
		for($q=0;$q<count($words);$q++){
		  $starPosition = strpos($words[$q],'*');
		  $colonPosition = strpos($words[$q],':');
		  if ($starPosition == false){
			if ($colonPosition == false)
			  $finalPosition = 5;
			  
			else
			  $finalPosition = $colonPosition;
			  
		  }
		  else
		  	$finalPosition = $starPosition;
		  $bookNum = "[".substr($words[$q], 0, $finalPosition)."]";
                  $exhibitionNum = "[".substr($words[$q], 0, $finalPosition + 1)."]";
		  if ($q==0)
     	  	$query.= "Books = '$bookNum' OR Exhibitions = '$exhibitionNum'";
		  else 
		  	$query.= "OR Books = '$bookNum' OR Exhibitions = '$exhibitionNum'";
		} 
	}
	else {}
        
        
	$cata= explode(" ", trim($keywords2));
	    for($p=0;$p<count($cata);$p++){
		  $CataNum = "(".$cata[$p].")";
		  if ($p==0) {
		  	if ( $keywords1 == '')
				$query.= "Catalogs = '$CataNum'";
			else
				$query.= "OR Catalogs = '$CataNum'";	
			}
		  else 
		  	$query.= "OR Catalogs = '$CataNum'";
		}
		
		$query.= "ORDER BY Author ASC,Date,Title" ;
	$result1 = mysql_query($query);
	//$result = die($query);
	
	return $result1;
  
  }
   public function getVolumePage($q)
   {
    $q=trim($q);
    $pagelist = array();
	$query = "SELECT Catalog, Volume, Number, Suffix FROM `RLTN_WORKS_CATALOG` WHERE idArtwork='$this->oppID' AND Catalog='$q' ORDER BY Volume ASC, Number ASC, Suffix ASC";
	$result = mysql_query($query);
	while($cata = mysql_fetch_array($result))
	{
	  $temp= ($cata['Volume']!='')? "$cata[Volume]:":"";
	  if($cata['Catalog']=="PP")
	  {
	    if($cata['Number'] < 10) $temp.= "00$cata[Number]";
		elseif($cata['Number'] < 100) $temp.= "0$cata[Number]";
		else $temp.= "$cata[Number]";
	  }
	  else
	    $temp.= "$cata[Number]";
	  $temp.= $cata['Suffix'];
	  $pagelist[] = "(".$temp.") ";
	}
	return $pagelist;
   }
   
   public function getPage($q,$v)
   {
    $q=trim($q);
    $v=trim($v);
    $pagelist = array();
	$query = "SELECT Catalog,Volume, Number, Suffix FROM `RLTN_WORKS_CATALOG` WHERE idArtwork='$this->oppID' AND Catalog='$q' AND Volume='$v' ORDER BY Number ASC, Suffix ASC";
	$result = mysql_query($query);
	while($cata = mysql_fetch_array($result))
	{
      $temp= ($cata['Volume']!='')? "$cata[Volume]:":"";
	  $temp.= "$cata[Number]";
	  $temp.= $cata['Suffix'];
	  $pagelist[] = "(".$temp.") ";
	}
	return $pagelist;
   }
   
   public function parseText($text)
  {
	$text = str_replace("<entry title=\"Text\">", "", $text);
	$text = str_replace("</entry>", "", $text);
	
	// parse <artwork>
	while($startPosition = strpos($text, "<artwork>"))
	{
	  $endPosition = strpos($text, "</artwork>");
	  $tagLength = $endPosition - $startPosition - 9;
	  $tagText = trim(substr($text,$startPosition+9, $tagLength));  // $tagText is the text between <artwork> and </artwork>
	  
	  $query = "SELECT title FROM `ARTWORK` WHERE opp = '$tagText'";
	  $result = mysql_query($query);
	  $row = mysql_fetch_array($result);
	  $htmlLink = "<a href=\"index.php?view=ArtworkInfo&OPPID=$tagText\" class=\"link1\" target=\"_blank\" onclick=\"OpenWin(this.href, 'ArtworkInfo', 740, 427); return false;\">";
	  $htmlText = $htmlLink.$row['title']."</a>"."&nbsp;[".$htmlLink.$tagText."</a>"."]";
	  
	  $text = str_replace("<artwork>".$tagText."</artwork>", $htmlText, $text);
	}
	
	// parse <writing>
	while($startPosition = strpos($text, "<writing>"))
	{
	  $endPosition = strpos($text, "</writing>");
	  $tagLength = $endPosition - $startPosition - 9;
	  $tagText = trim(substr($text,$startPosition+9, $tagLength));  // $tagText is the text between <writing> and </writing>
	  
	  $query = "SELECT title,YEAR(dateStart) as year FROM `WRITINGS_POEMS` WHERE mid = $tagText";
	  $result = mysql_query($query);
	  $row = mysql_fetch_array($result);
	  $htmlLink = "<a href=\"index.php?view=WritingsInfo&mid=$tagText&year=$row[year]\" class=\"link1\" target=\"OPPMain\">";
	  $htmlText = "<span style=\"color:maroon\">\"</span>".$htmlLink.$row['title']."</a><span style=\"color:maroon\">\"</span>";
	  
	  $text = str_replace("<writing>".$tagText."</writing>", $htmlText, $text);
	}	
	
	// parse <linkId>
	while($startPosition = strpos($text, "<linkId>"))
	{
	  $endPosition = strpos($text, "</linkId>");
	  $tagLength = $endPosition - $startPosition - 8;
	  $tagText = trim(substr($text,$startPosition+8, $tagLength));  // $tagText is the text between <linkId> and </linkId>
	  
	  $query = "SELECT title,URL FROM `LINK` WHERE idLink = $tagText";
	  $result = mysql_query($query);
	  $row = mysql_fetch_array($result);
	  
	  // start parse URL
	  if($startPosition = strpos($row['URL'], "OPP%/"))
	  {
		$URL = str_replace("%OPP%/BioResource?","index.php?view=BioResource&",$row['URL']);
	  }
	  else
	    $URL = $row['URL'];
      // End parse URL
	  
	  $htmlLink = "<a href=\"$URL\" class=\"link1\" target=\"_blank\" onclick=\"OpenWin(this.href, 'BioSource', 740, 750); return false;\">";
	  $htmlText = $htmlLink.$row['title']."</a>";
	  
	  $text = str_replace("<linkId>".$tagText."</linkId>", $htmlText, $text);
	}

	
	
	return $text;
  }
  
   
 public function getExhibited($keywords1,$keywords2)
  { 
  	$query = "SELECT SQL_CALC_FOUND_ROWS id,Author,Books,Catalogs,Title,Date,Publisher,Journal,Edition,Issue,Volume,Exhibitions FROM `REFERENCES` WHERE ";
	if ( trim($keywords1) != '') {
  	$words= explode(" ", trim($keywords1));
		for($q=0;$q<count($words);$q++){
		  $starPosition = strpos($words[$q],'*');
		  $colonPosition = strpos($words[$q],':');
		  if ($starPosition == false){
			if ($colonPosition == false)
			  $finalPosition = 5;
			  
			else
			  $finalPosition = $colonPosition;
			  
		  }
		  else
		  	$finalPosition = $starPosition;
	//	  $bookNum = "[".substr($words[$q], 0, $finalPosition)."]";
                  $exhibitionNum = "[".substr($words[$q], 0, $finalPosition + 1)."]";
		  if ($q==0)
     	  	$query.= "Exhibitions = '$exhibitionNum'";
		  else 
		  	$query.= "OR Exhibitions = '$exhibitionNum'";
		} 
	}
	else {}
        
        
/*	$cata= explode(" ", trim($keywords2));
	    for($p=0;$p<count($cata);$p++){
		  $CataNum = "(".$cata[$p].")";
		  if ($p==0) {
		  	if ( $keywords1 == '')
				$query.= "Catalogs = '$CataNum'";
			else
				$query.= "OR Catalogs = '$CataNum'";	
			}
		  else 
		  	$query.= "OR Catalogs = '$CataNum'";
		}
		
		$query.= "ORDER BY Author ASC,Date,Title" ; */
	$query.= "ORDER BY Date,Author,Exhibitions,Title" ;
        $result1 = mysql_query($query);
	//$result = die($query);
	
	return $result1;
  
  }
 
  
}
?>