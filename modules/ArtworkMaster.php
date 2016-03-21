<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class ArtworkMaster extends Database
{
  
  function __construct() 
  {
    parent::__construct(); 
  }
    
  public function getOPPInfo($oppID)  //operate on database to get data
  {
	$opp = mysql_real_escape_string($oppID);
	$query = "SELECT opp,notVerified,title,location,duration,medium,dimension,collection,inventory,bookCatalog,YEAR(dateStart) as startyear FROM `ARTWORK` WHERE opp = '$opp'";
	$result = mysql_query($query);
	return $result;
  }
  
  public function getMasters($oppID)  //operate on database to get data
  {
	$opp = mysql_real_escape_string($oppID);
	$query = "SELECT masteropp FROM `RLTN_MASTERARTWORK_ARTWORK` WHERE opp = '$opp'";
	$result = mysql_query($query);
	$result_array=array();
	while($rows=mysql_fetch_assoc($result)){
	//print_r($rows);
		array_push($result_array,$rows['masteropp']);
	}
	//print_r($result_array);
	return $result_array;
  }
   public function getMasterInfo($MasterOPPID)  //operate on database to get data
  {
	$master = mysql_real_escape_string($MasterOPPID);
	$query = "SELECT masteropp,title,author,duration,medium,dimension,collection,YEAR(dateStart) as startyear FROM `MASTERARTWORK` WHERE masteropp = '$master'";
	$result = mysql_query($query);
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
	    if((int)$cata['Number'] < (int)10) $temp.= ":00$cata[Number]";
		elseif((int)$cata['Number'] < (int)100) $temp.= ":0$cata[Number]";
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
 
  public function getOneMaster($masterID, $href, $param)
  {
  	$master = mysql_real_escape_string($masterID);
	$query = "SELECT masteropp,title FROM `MASTERARTWORK` WHERE masteropp = '$master'";
    $result = mysql_query($query);
	$row = mysql_fetch_array($result);
	$href = "index.php?".$href;
	//$href = str_replace(" ", "+", $href);
	if(isset($param['MasterOPP']))
	{  
	  $href = str_replace("MasterOPP=".$param['MasterOPP'], "MasterOPP=".$master, $href);
	}
	else
	{
	  $href = $href."&MasterOPP=".$master;
	}
	$imageNme = parent::imgName($masterID);

	$result = "<a href=\"$href\" target=\"_self\"><img src=\"../mastergraphics/".substr($row['masteropp'],0,7)."/xthumbs/x$imageNme.jpg\" title=\"$row[title]\"/></a>";

	//$result = $master;  
	return $result;
  }
    public function getAcceptedTitle($title)
  // get Accepted title with(information) but without [Alternat Title]
  {
  	if (strpos($title, "[")==FALSE)
		return trim($title);
	else 
	{	
  		if(strpos($title, "(")==FALSE)
		{
	 		$length = strpos($title, "[");
			return trim(substr($title,0,$length));
		}
		else 
		{
			if (strpos($title, "[")< strpos($title, "(")) 
				return trim(substr($title, 0, strpos($title, "[")));
			else 
			{
	  			$sub=$title;
				while(strpos($sub, "(")!==FALSE AND strpos($sub, "[")> strpos($sub, "("))
				{
				$endPosition = strpos($sub, ")");	
				$sub =substr($sub,$endPosition+1);
				if(strpos($sub, "[")==FALSE) return trim($title);
				}
				$sub=substr($sub,strpos($sub,"["));
				return trim(str_replace($sub,'',$title));
			}	
	  	}
	 }
  }
  
  
  public function parseTextTM($text)
  {
	
	// parse <artwork>
	while(strpos($text, "<artwork>")!==FALSE)
	{
	  $startPosition = strpos($text, "<artwork>");
	  $endPosition = strpos($text, "</artwork>");
	  $tagLength = $endPosition - $startPosition - 9;
	  $tagText = trim(substr($text,$startPosition+9, $tagLength));  // $tagText is the text between <artwork> and </artwork>	  
	  $query = "SELECT title FROM `ARTWORK` WHERE opp = '$tagText'";
	  $result = mysql_query($query);
	  $row = mysql_fetch_array($result);
	  $acceptedtitle = $this->getAcceptedTitle($row['title']);
          $htmlLink = "<a href=\"index.php?view=ArtworkInfo&OPPID=$tagText\" class=\"link1\" target=\"_blank\" onclick=\"OpenWin(this.href, 'ArtworkInfo', 740, 550); return false;\">";
         if(strpos($acceptedtitle, "<artwork>")!==FALSE){
              $subStartPosistion = strpos($acceptedtitle,"<artwork>");
              $subEndPosition = strpos($acceptedtitle,"</artwork>");
              $subTagLength = $subEndPosition - $subStartPosition - 9;
	      $subTagText = trim(substr($acceptedtitle,$subStartPosition+9, $subTagLength));
              $query1 = "SELECT title FROM `ARTWORK` WHERE opp = '$subTagText'";
	      $result1 = mysql_query($query1);
	      $row1 = mysql_fetch_array($result1);
	      $subAcceptedtitle = $this->getAcceptedTitle($row1['title']);
              $left = substr($acceptedtitle,0,$subStartPosition);
              $right = substr($acceptedtitle,$subEndPosition+10);
              $htmlText = $htmlLink."<i>".$left.$subAcceptedtitle.$right."</i></a>";
          }
          else{
            $htmlText = $htmlLink."<i>".$acceptedtitle."</i></a>";
          }
          
          $text = str_replace("<artwork>".$tagText."</artwork>", $htmlText, $text);
           
        }   
	return $text;
        
  }
  
   public function parseText($text)
  {
	
	// parse <artwork>
	while($startPosition = strpos($text, "<artwork>"))
	{
	  $endPosition = strpos($text, "</artwork>");
	  $tagLength = $endPosition - $startPosition - 9;
	  $tagText = trim(substr($text,$startPosition+9, $tagLength));  // $tagText is the text between <artwork> and </artwork>
	  
	  $query = "SELECT title FROM `ARTWORK` WHERE opp = '$tagText'";
	  $result = mysql_query($query);
	  $row = mysql_fetch_array($result);
	  $htmlLink = "<a href=\"index.php?view=ArtworkInfo&OPPID=$tagText\" class=\"link1\" target=\"_blank\" onclick=\"OpenWin(this.href, 'ArtworkInfo', 740, 550); return false;\">";
	  $htmlText = $htmlLink."<i>".$row['title']."</i> [".$tagText."]</a>";
	  
	  $text = str_replace("<artwork>".$tagText."</artwork>", $htmlText, $text);
	}
	return $text;
  }
} 
?>
