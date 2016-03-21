<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class WorkBasketSummary extends Database
{
  private $page; // the # of current page
  private $opps;
  private $total;
  
  function __construct($param, &$session) 
  {
    parent::__construct(); 

	if(isset($session['OPPs']))
	{
	  if($param['action'] == "add") // add new opp
	    $session['OPPs'] .= "_".$param['OPPs'];
	  elseif($param['action'] == "remove") // remove opp
	    $this->removeOPPs($session['OPPs'], $param['OPPs']);
	  elseif($param['action'] == "import") 
	    $session['OPPs'] .= "_".$param['OPPs'];
	}  
	else
	  $session['OPPs'] = $param['OPPs'];

	
	if(isset($param['page']))
	  $this->page = $param['page'];
	else
	  $this->page = 1;
	  
	  
	$this->opps = "('" . mysql_real_escape_string($session['OPPs']);
	$this->opps .= "')";
	$this->opps = str_replace("_", "','", $this->opps);
  }
    
  public function removeOPPs(&$s, $p)
  {
    $temp = explode("_",$p);
	foreach($temp as $data)
	{
	  $s = str_replace($data."_", "", $s);
	  $s = str_replace("_".$data, "", $s);
	  $s = str_replace($data, "", $s);
	}
  }
  
  public function getData()  //operate on database to get data
  {
    $limitStart = parent::ITEMS_PER_PAGE*($this->page-1);
	$limitEnd = parent::ITEMS_PER_PAGE;
	$query = "select SQL_CALC_FOUND_ROWS opp,notVerified,title,duration,collection,inventory,dimension,bookCatalog,medium,location, notes,commentary,YEAR(dateStart) as year from `ARTWORK` where opp in $this->opps order by dateStart ASC, dateStartFlag ASC, dateEnd ASC, dateEndFlag ASC limit $limitStart, $limitEnd " ;
	$result = mysql_query($query);
	return $result;
  }
  
  public function getAllData()
  {
    $query = "select opp from `ARTWORK` where opp in $this->opps order by dateStart ASC, dateStartFlag ASC, dateEnd ASC, dateEndFlag ASC" ;
	$result = mysql_query($query);
	return $result;
  }
  
  public function getTotalNum()
  {
    $result = mysql_query("SELECT FOUND_ROWS()");
	$totalNum = mysql_fetch_row($result);
	$this->total = $totalNum[0];
	return $this->total;
  }
  
  public function getTotalPage()
  {
    return ceil($this->total/parent::ITEMS_PER_PAGE);
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
  
  public function formercollec($opp)
  {
     $query = "SELECT count(opp) FROM `FORMERLY` WHERE opp ='$opp' ";
     $result = mysql_query($query);
     $record = mysql_fetch_array($result);
     $count3 = $record['count(opp)'];
     return $count3;
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

} 
?>