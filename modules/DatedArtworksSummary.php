<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class DatedArtworksSummary extends Database
{
  private $startYear;
  private $startMonth;
  private $startDay;
  private $endYear;
  private $endMonth;
  private $endDay;
  
  function __construct($param) 
  {
    parent::__construct(); 
	
	$this->startYear = mysql_real_escape_string($param['startYear']);
	$this->startMonth = mysql_real_escape_string($param['startMonth']);
	$this->startDay  = mysql_real_escape_string($param['startDay']);
	$this->endYear = mysql_real_escape_string($param['endYear']);
	$this->endMonth = mysql_real_escape_string($param['endMonth']);
	$this->endDay  = mysql_real_escape_string($param['endDay']);
	
  }
    
  public function getData()  //operate on database to get data
  {
	$query = "SELECT opp,notVerified,category,title,duration,collection,inventory,dimension,bookCatalog,medium,location, notes,commentary  FROM `ARTWORK` WHERE YEAR(dateStart)=$this->startYear AND MONTH(dateStart)=$this->startMonth AND DAY(dateStart)=$this->startDay AND YEAR(dateEnd)=$this->endYear AND MONTH(dateEnd)=$this->endMonth AND DAY(dateEnd)=$this->endDay ORDER BY case category when 'painting' then 1 when 'sculpture' then 2 when 'collage' then 3 when 'photograph' then 4 when 'watercolor' then 5 when 'gouache' then 6 when 'pastel' then 7 when 'drawing' then 8 when 'ceramic' then 9 when 'engraving' then 10 when 'lithograph' then 11 else 12 end" ;
	$result = mysql_query($query);
	return $result;
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
	while(strpos($text, "<artwork>")!==FALSE)
	{
	  $startPosition = strpos($text, "<artwork>");
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
  
  public function formercollec($opp)
  {
     $query = "SELECT count(opp) FROM `FORMERLY` WHERE opp ='$opp' ";
     $result = mysql_query($query);
     $record = mysql_fetch_array($result);
     $count3 = $record['count(opp)'];
     return $count3;
  }

} 
?>