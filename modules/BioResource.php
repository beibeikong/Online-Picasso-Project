<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');

class BioResource extends Database
{
  private $ID;
  
  function __construct($ID) 
  {
    parent::__construct(); 
	
    $this->ID = mysql_real_escape_string($ID);
  }
  
  //this is a function to parse the raw bioPhotoZoom image path to url form, so that we can hide the raw image path in url.
  //Every file use views/bioPhotoZoom.php should copy this function in its module file.
  private function parseImagePath($imagePath)
  {	
    //$imagePath here is like "/photo/1953/xxx.jpg"
    $fileName = substr($imagePath, strrpos($imagePath, "/")+1);  //get the file name
	$cleanFileName = substr($fileName, 0, strrpos($fileName, "."));  //get the file name without file type

	$firstSlashPos = strpos($imagePath, "/");
	$secondSlashPos = strpos($imagePath, "/",$firstSlashPos+1);
	$firstLayerFolder = substr($imagePath, $firstSlashPos+1, $secondSlashPos-$firstSlashPos-1);	//get the string between first two "/"

	if ($firstLayerFolder == "maps") {	//map url is "/maps/xxx.jpg"
	  $type = "map";
	  $url = "type=".$type."&img=".$cleanFileName;
	}
	else if ($firstLayerFolder == "archives"){	//archive url is "/archives/1983/xxx.jpg"
	  $type = "archive";
	  $thirdSlashPos = strpos($imagePath, "/",$secondSlashPos+1);
	  $year = substr($imagePath, $secondSlashPos+1, $thirdSlashPos-$secondSlashPos-1);
	  $url = "type=".$type."&year=".$year."&img=".$cleanFileName;
	}
	else if ($firstLayerFolder == "photos"){
	  $thirdSlashPos = strpos($imagePath, "/",$secondSlashPos+1);
	  $secondLayerFolder = substr($imagePath, $secondSlashPos+1, $thirdSlashPos-$secondSlashPos-1); //get the string between second and third "/"
	  if ($secondLayerFolder == "people") {
	    $type = "people";
		$url = "type=".$type."&img=".$cleanFileName;
	  }
	  else if ($secondLayerFolder == "locations"){
	    $type = "location";
		$url = "type=".$type."&img=".$cleanFileName;
	  }
	  else if ($secondLayerFolder == "documents"){
	    $type = "document";
		$url = "type=".$type."&img=".$cleanFileName;
	  }
	  else if ($secondLayerFolder == "others"){
	    $type = "other";
		$url = "type=".$type."&img=".$cleanFileName;
	  }
	  else{  //for the image stored in "/photo/year/xxx.jpg"
	    $type = "photo";
		$year = $secondLayerFolder;
		$url = "type=".$type."&year=".$year."&img=".$cleanFileName;
	  }
	}
    return $url;
  }
  
  public function generateImgViewer($photoFileName, $thumbnailFileName)
  {
    //  <photo photoFileName="../WorksInfo?CatID=OPP.02:014" thumbnailFileName="../graphics/1902/xthumbs/xopp02-014.jpg">
	if(strpos($photoFileName, "WorksInfo")!==FALSE) // the format above
	{
	  $year = substr($thumbnailFileName, 12, 4);
	  $jpgPos = strpos($thumbnailFileName, "jpg")-1;
	  $imgNameLength = $jpgPos - 26;
	  $imgName = substr($thumbnailFileName, 26, $imgNameLength);
	  //$link = "href=\"index.php?view=zoom&img=$imgName&year=$year\" target=\"_blank\" onclick=\"OpenWin(this.href, 'ArtworkZoom', 850, 600); return false;\"";
	  $rndm=$year*23;
	  $al=$imgName.".jpg";
	  $link = "href=\"index.php?view=zoom&random=$rndm&alpha=$al\" target=\"_blank\" onclick=\"OpenWin(this.href, 'ArtworkZoom', 850, 600); return false;\"";
	}
	else
	{
	  $imgName = substr($photoFileName, 2);
	  $parsedImgName = $this->parseImagePath($imgName);
	  $link = "href=\"index.php?view=BioPhotoZoom&$parsedImgName\" target=\"_blank\" onclick=\"OpenWin(this.href, 'BioZoom', 850, 650); return false;\"";
	}
    return $link;
  }	

  public function getData()  //operate on database to get data
  {
	$query = "SELECT Name,Type,GeneralType,XMLCode FROM `BIORESOURCES` WHERE id = '$this->ID'";
	$result = mysql_query($query);
	return $result;
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
	  
	  $htmlLink = "<a href=\"$URL\" class=\"link1\" target=\"_blank\" onclick=\"OpenWin(this.href, 'BioSource', 670, 427); return false;\">";
	  $htmlText = $htmlLink.$row['title']."</a>";
	  
	  $text = str_replace("<linkId>".$tagText."</linkId>", $htmlText, $text);
	}
	
	
	return $text;
  }
  
  public function getTitle($s)
  {
    $start = strpos($s,"\">")+2;
	$end = strripos($s, "</photo>");
	$text = substr($s,$start,$end-$start);

    $text = str_replace("?id=","index.php?view=BioResource&id=",$text);
	
	return $text;
  }
  
} 
?>
