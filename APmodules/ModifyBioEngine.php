<?php if ( ! defined('PROJECTNAME')) exit(''); 
if(file_exists('APmodules/checkUser.php'))
    require_once('APmodules/checkUser.php');  // check if it is authenrized user
else
    die('0'); 
	
require_once('Database.php');
require_once('GenericOpp.php');

class ModifyBioEngine extends Database
{
  private $id;
  private $description;
  private $StartYear;
  private $StartMonth;
  private $StartDay;
  private $StartDateFlag;
  private $EndYear;
  private $EndMonth;
  private $EndDay;
  private $EndDateFlag;

  private $Event;
  private $Commentary;
  private $Opps;    
  private $OppList;  
  private $Photos;
  private $PhotoList;
  
  function __construct($param) 
  {
    parent::__construct(); 
        $this->OppList = new GenericOpp();
	$this->id = $param['id'];
	$this->description = trim($param['desc']);
	$this->StartYear = $param['StartYear'];
	$this->StartMonth = $param['StartMonth'];
	$this->StartDay = $param['StartDay'];
	$this->StartDateFlag = $param['StartDateFlag'];
	$this->EndYear = $param['EndYear'];
	$this->EndMonth = $param['EndMonth'];
	$this->EndDay = $param['EndDay'];
	$this->EndDateFlag = $param['EndDateFlag'];
	
	$this->Event = trim($param['Event']);
	$this->Commentary = trim($param['Commentary']);
        $this->Opps = trim($param['Opps']);
        $this->Photos = trim($param['Photos']);
  }
    
  public function checkData()  //check all data if legally
  {
	if($this->description == "") // check description
	  return "Invalid input error: <br>Description must not be empty.";
	if(!is_numeric($this->StartYear))   // check StartYear
	  return "Invalid input error: <br>StartYear must be number."; 
	if(!is_numeric($this->StartMonth))   // check StartMonth
	  return "Invalid input error: <br>StartMonth must be number."; 
	if(!is_numeric($this->StartDay))   // check StartDay
	  return "Invalid input error: <br>StartDay must be number."; 
	if(!is_numeric($this->StartDateFlag))   // check StartDateFlag
	  return "Invalid input error: <br>StartDateFlag must be number."; 
	if(!is_numeric($this->EndYear))   // check EndYear
	  return "Invalid input error: <br>EndYear must be number."; 
	if(!is_numeric($this->EndMonth))   // check EndMonth
	  return "Invalid input error: <br>EndMonth must be number."; 
	if(!is_numeric($this->EndDay))   // check EndDay
	  return "Invalid input error: <br>EndDay must be number."; 
	if(!is_numeric($this->EndDateFlag))   // check EndDateFlag
	  return "Invalid input error: <br>EndDateFlag must be number.";  
        
        $start = $this->StartYear."-".$this->StartMonth."-".$this->StartDay;
        $end =$this->EndYear."-".$this->EndMonth."-".$this->EndDay;
        if($start>$end)  //check if EndDate is equal to or later than StartDate
            return "Invalid input error: <br>EndDate must be equal to or later than StartDate";
        
        // --- Check for proper format and existance of Opps ---------------
	$this->Opps = preg_replace('/\r\n/', "\n", $this->Opps);  
	$this->Opps = preg_replace('/\n\n+/', "\n", $this->Opps);  
	$this->Opps = preg_replace('/^\n/', "", $this->Opps); 
	$this->Opps = preg_replace('/^;/', "", $this->Opps); 
	$this->Opps = preg_replace('/\n$/', "", $this->Opps); 
	$this->Opps = preg_replace('/;$/', "", $this->Opps); 
	if(strlen($this->Opps)>0)
	{		
		$array = explode(";",$this->Opps);
		
		// check if this OPP exists and if one OPP appears more than one time in the "OPPS" text.
		for($i=0; $i<count($array); $i++)
	    {
			if (trim($array[$i])!="")
			{
				$this->OppList->add($array[$i]);
	    		$opp = $this->OppList->Opp;
				
				 // check if this OPP exists
				$query = "SELECT count(*) FROM `ARTWORK` where opp = '$opp'" ;
				$result = mysql_query($query);
				$row = mysql_fetch_array($result);
				if ($row[0]==0) 
					return "The OPP '$opp' does not exist.";				
				
				// check if one OPP appears more than one time in the "OPPs" text
				$count = substr_count($this->Opps,$opp);
				if ($count >1)
					return "The OPP '$opp' appears more than one time in OPPs area.";
			}	
		}
	} 
	// -------------finish checking OPPs-----------------------------------
        
        // --- Check for proper format and existance of Photos ---------------
	
	if(strlen($this->Photos)>0)
	{	
               
		$array = explode(";",$this->Photos);
		
		// check if this Photo exists and if one Photo appears more than one time in the "PhotoS" text.
		for($i=0; $i<count($array); $i++)
	    {
			if (trim($array[$i])!="")
			{				
	    		$Photo = trim($array[$i]);			
				 // check if this Photo exists
				$query = "SELECT count(*) FROM `RLTN_NARR_PHOTO` where name = '$Photo'" ;
				$result = mysql_query($query);
				$row = mysql_fetch_array($result);
				if ($row[0]==0) 
					return "The Photo '$Photo' does not exist.";				
				
				// check if one Photo appears more than one time in the "Photos" text
				$count = substr_count($this->Photos,$Photo);
				if ($count >1)
					return "The Photo '$Photo' appears more than one time in Photos area.";
			}	
		}
                $this->PhotoList = $array;
	} 
	// -------------finish checking Photos-----------------------------------
	
	return "OK";  
  }

  public function saveData()  //operate on database to save data
  {
    $commentary = mysql_real_escape_string($this->Commentary);
	$event = mysql_real_escape_string($this->Event);

	$query = "UPDATE `NARRATIVE` SET dateStart=CONCAT('$this->StartYear','-','$this->StartMonth','-','$this->StartDay'),dateStartFlag=$this->StartDateFlag,dateEnd=CONCAT('$this->EndYear','-','$this->EndMonth','-','$this->EndDay'),dateEndFlag=$this->EndDateFlag,dateDesc='$this->description',event='$event',commentary='$commentary' WHERE id = $this->id";
	$result = mysql_query($query);
	if($result !== TRUE)
	  return "Modify Biography failed.";
	
	$this->CheckSingleBioEntry();
	
	return "OK";
  }
  
  public function CheckSingleBioEntry()
  {
	
    $query = "DELETE FROM `RLTN_NARR_LINKS` WHERE idNarrative = $this->id";
    $result = mysql_query($query);
	
	$text = $this->Commentary.$this->Event;
	
	// --- start add record to RTLN_ARTWORK_LINK
	while($startPosition = strpos($text, "<linkId>"))
	{
	  $endPosition = strpos($text, "</linkId>");
	  $tagLength = $endPosition - $startPosition - 8;
	  $tagText = trim(substr($text,$startPosition+8, $tagLength));  // $tagText is the text between <linkId> and </linkId>
	  
	  $query = "INSERT INTO `RLTN_NARR_LINKS` (idNarrative,idLink) VALUES ($this->id, $tagText)";
      $result = mysql_query($query); 
	  
	  $text = str_replace("<linkId>".$tagText."</linkId>", "", $text);
	}
	// --- end add record to RTLN_ARTWORK_LINK
        
    $query = "DELETE FROM `RLTN_NARR_WORKS` WHERE idNarrative = $this->id";
    $result = mysql_query($query);	
    // --- start add record to RLTN_NARR_ARTWORK
	while($startPosition = strpos($text, "<artwork>"))
	{
	  $endPosition = strpos($text, "</artwork>");
	  $tagLength = $endPosition - $startPosition - 9;
	  $tagText = trim(substr($text,$startPosition+9, $tagLength));  // $tagText is the text between <artwork> and </artwork>
	  
	  $query = "INSERT INTO `RLTN_NARR_WORKS` (idNarrative,idArtwork) VALUES ($this->id, '$tagText')";
      $result = mysql_query($query); 
	  $text = str_replace("<artwork>".$tagText."</artwork>", "", $text);
	}
	// --- end add record to RLTN_NARR_ARTWORK
      
    $query = "DELETE FROM `RLTN_NARR_WORKS_D` WHERE idNarrative = $this->id";
    $result = mysql_query($query);   
        // --- start add record to RLTN_NARR_WORKS_D----------------------------------------    
	
	$current = $this->OppList->head;
	while($current!=NULL)
	{
          $opp=$current->Opp;
          $queryopp = "SELECT title,YEAR(dateStart)as year FROM `ARTWORK` where opp ='$opp'";
          $resultopp = mysql_query($queryopp);
          $rowopp = mysql_fetch_array($resultopp);
          $imgname=$this->imgName($opp);         
          $path = "<a href=\"index.php?view=ArtworkInfo&OPPID=".$opp."\" target=\"_blank\" onclick=\"OpenWin(this.href, 'ArtworkInfo', 748, 550); return false;\"><img src=\"../graphics/".$rowopp['year']."/xthumbs/x".$imgname.".jpg\" style=\"border-style:none;\" /></a>";
	  $path=mysql_real_escape_string(trim($path));
          $query = "INSERT INTO `RLTN_NARR_WORKS_D` (idNarrative,idArtwork,path) VALUES ('$this->id', '$opp','$path')";
	  $result = mysql_query($query);
	  if($result !== TRUE)
	    return "Update Display OPPs failed";
		
	  $current = $current->nxt;	
	}
	// --- End Add OPPs entries to RLTN_NARR_WORKS_D----------------------------------------    
    
    $query = "DELETE FROM `RLTN_NARR_PHOTO_D` WHERE id = $this->id";
    $result = mysql_query($query);   
        // --- start add record to RLTN_NARR_PHOTO_D----------------------------------------    
	$array = $this->PhotoList;
	for($i=0; $i<count($array); $i++)
	{
         if (trim($array[$i])!=""){
          $Photo = trim($array[$i]);  
          $queryphoto="SELECT id,(SELECT YEAR(dateStart) FROM `NARRATIVE`WHERE id= $this->id) as year,no from `RLTN_NARR_PHOTO` WHERE name='$Photo'";
	  $resultphoto = mysql_query($queryphoto);
          $rowphoto = mysql_fetch_array($resultphoto); 
          $path = "<a href=\"index.php?view=Photo&year=".$rowphoto['year']."&id=".$this->id."&no=".$rowphoto['no']."\" target=\"_blank\" onclick=\"OpenWin(this.href, 'Photo', 748, 650); return false;\"><img src=\"../photos/".$rowphoto['year']."/xthumbs/x".$Photo."\" style=\"border-style:none;\"/>";         
          $path=mysql_real_escape_string(trim($path));
	  $query = "INSERT INTO `RLTN_NARR_PHOTO_D` (id,name,path) VALUES ('$this->id', '$Photo','$path')";
	  $result = mysql_query($query);
	  if($result !== TRUE)
	    return "Update Display Photos failed";
            }
	}
	// --- End Add photos entries to RLTN_NARR_PHOTO_D----------------------------------------    
        
        
  }


} 
?>