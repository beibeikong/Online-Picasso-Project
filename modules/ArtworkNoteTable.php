<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');


class ArtworkNoteTable extends Database
{
    private $p;
    private $oppID;
  
  function __construct($param) 
  {
    parent::__construct(); 
    $this->p = $param;
    $this->oppID = mysql_real_escape_string($param['OPPID']);
  }
    
  public function getData()  //operate on database to get data
  {
      $sqlAuctionConstraint = "";
 if(isset($this->p['NoteAll'])){
$query = "SELECT id,datatable FROM NOTE_DATATABLE WHERE opp like '$this->oppID' order by opp";}

else
{
for($i=1;$i<=7;$i++)
{
  $paraName = "AuctionKeyword$i";
  $keyword = mysql_real_escape_string(trim($this->p[$paraName]));
  if ($keyword !="")
  {
    $searchInName = "AuctionSearchIn$i";
    $searchIn = $this->p[$searchInName];
    switch ($searchIn) {
        case "saletitle":
            $sqlAuctionConstraint.=strlen($sqlAuctionConstraint)>0 ? "and " : "";
            $sqlAuctionConstraint .= "ExtractValue(datatable, 'DataTable[1]/entry[@title=\"Sale Title\"]') like '%$keyword%' ";
            break;
        case "source":
            $sqlAuctionConstraint.=strlen($sqlAuctionConstraint)>0 ? "and " : "";
            $sqlAuctionConstraint .= "ExtractValue(datatable, 'DataTable[1]/entry[@title=\"Source\"]') like '%$keyword%' ";
            break;
        case "salenumber":
            $sqlAuctionConstraint.=strlen($sqlAuctionConstraint)>0 ? "and " : "";
            $sqlAuctionConstraint .= "ExtractValue(datatable, 'DataTable[1]/entry[@title=\"Sale Number\"]') like '%$keyword%' ";
            break;
        case "saledate":
            $sqlAuctionConstraint.=strlen($sqlAuctionConstraint)>0 ? "and " : "";
            $sqlAuctionConstraint .= "ExtractValue(datatable, 'DataTable[1]/entry[@title=\"Sale Date\"]') like '%$keyword%' ";
            break;
        case "lotnumber":
            $sqlAuctionConstraint.=strlen($sqlAuctionConstraint)>0 ? "and " : "";
            $sqlAuctionConstraint .= "ExtractValue(datatable, 'DataTable[1]/entry[@title=\"Lot Number\"]') like '%$keyword%' ";
            break;
        case "lottitle":
            $sqlAuctionConstraint.=strlen($sqlAuctionConstraint)>0 ? "and " : "";
           $sqlAuctionConstraint .= "ExtractValue(datatable, 'DataTable[1]/entry[@title=\"Lot Title\"]') like '%$keyword%' ";
            break;
        case "prelot":
             $sqlAuctionConstraint.=strlen($sqlAuctionConstraint)>0 ? "and " : "";
          $sqlAuctionConstraint .= "ExtractValue(datatable, 'DataTable[1]/entry[@title=\"Pre-lot Text\"]') like '%$keyword%' ";
            break;
        case "postlot":
            $sqlAuctionConstraint.=strlen($sqlAuctionConstraint)>0 ? "and " : "";
           $sqlAuctionConstraint .= "ExtractValue(datatable, 'DataTable[1]/entry[@title=\"Post-lot Text\"]') like '%$keyword%' ";
            break;
        case "estimateprice":
            $sqlAuctionConstraint.=strlen($sqlAuctionConstraint)>0 ? "and " : "";
           $sqlAuctionConstraint .= " ExtractValue(datatable, 'DataTable[1]/entry[@title=\"Estimate\"]') like '%$keyword%' ";
            break;
        case "description":
            $sqlAuctionConstraint.=strlen($sqlAuctionConstraint)>0 ? "and " : "";
           $sqlAuctionConstraint .= " ExtractValue(datatable,'DataTable[1]/entry[@title=\"Description\"]/ul/li') like '%$keyword%' ";
            break;
        case "literature":
            $sqlAuctionConstraint.=strlen($sqlAuctionConstraint)>0 ? "and " : "";
           $sqlAuctionConstraint .= " ExtractValue(datatable,'DataTable[1]/entry[@title=\"Literature\"]/ul/li') like '%$keyword%' ";    
            break;
        case "provenance":
            $sqlAuctionConstraint.=strlen($sqlAuctionConstraint)>0 ? "and " : "";
            $sqlAuctionConstraint .= " ExtractValue(datatable,'DataTable[1]/entry[@title=\"Provenance\"]/ul/li') like '%$keyword%' ";
            break;
        case "exhibited":
            $sqlAuctionConstraint.=strlen($sqlAuctionConstraint)>0 ? "and " : "";
           $sqlAuctionConstraint .= " ExtractValue(datatable,'DataTable[1]/entry[@title=\"Exhibited\"]/ul/li') like '%$keyword%' ";    
            break;
    }
    $query = "SELECT id,datatable FROM NOTE_DATATABLE WHERE opp like '$this->oppID' AND ".$sqlAuctionConstraint."group by opp";
  }
  
//  else if ($keyword == "")

//  {
 //    $query = "SELECT id,datatable FROM NOTE_DATATABLE WHERE opp like '$this->oppID' group by opp";
  //   $query = "SELECT id,datatable FROM NOTE_DATATABLE WHERE opp like '$this->oppID' order by opp";
  }

  
}     

 
    $result = mysql_query($query);
      //$result = die($query); 
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
  
  
  public function parseText($text)
  {
	$text = str_replace("<entry title=\"Text\">", "", $text);
	$text = str_replace("</entry>", "", $text);
	
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
	  
	  while(strpos($acceptedtitle, "<artwork>")!==FALSE)
	  {	
	  	$innerstartPosition = strpos($acceptedtitle, "<artwork>");
	  	$innerendPosition = strpos($acceptedtitle, "</artwork>");
	  	$innertagLength = $innerendPosition - $innerstartPosition - 9;
	  	$innertagText = trim(substr($acceptedtitle,$innerstartPosition+9, $innertagLength));  // $tagText is the text between <artwork> and </artwork>
	  
	  	$query = "SELECT title FROM `ARTWORK` WHERE opp = '$innertagText'";
	    $result = mysql_query($query);
	    $row = mysql_fetch_array($result);
	  	$inneracceptedtitle = $this->getAcceptedTitle($row['title']);
		$acceptedtitle = str_replace("<artwork>".$innertagText."</artwork>", $inneracceptedtitle, $acceptedtitle);
	  }
	  	$htmlLink = "<a href=\"index.php?view=ArtworkInfo&OPPID=$tagText\" class=\"link1\" target=\"_blank\" onclick=\"OpenWin(this.href, 'ArtworkInfo', 740, 550); return false;\">";
	 	 $htmlText = "<i>".$acceptedtitle."</i>&nbsp;". $htmlLink."[".$tagText."]</a>";
	
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
	  
	  $htmlLink = "<a href=\"$URL\" class=\"link1\" target=\"_blank\" onclick=\"OpenWin(this.href, 'BioSource', 940, 680); return false;\">";
	  $htmlText = $htmlLink.$row['title']."</a>";
	  
	  $text = str_replace("<linkId>".$tagText."</linkId>", $htmlText, $text);
	}

	
	
	return $text;
  }
  
} 
?>
