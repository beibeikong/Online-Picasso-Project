<?php if ( ! defined('PROJECTNAME')) exit(''); 
if(file_exists('APmodules/checkUser.php'))
    require_once('APmodules/checkUser.php');  // check if it is authorized user
else
    die('0'); 
	
require_once('Database.php');
require_once('GenericCatalog.php');
require_once('GenericOpp.php');

class ModifyArtworkEngine extends Database
{
  private $OldId;
  private $NewId;
  private $NotVerified;
  private $Title;
  private $Location;
  private $Duration;
  private $StartYear;
  private $StartMonth;
  private $StartDay;
  private $StartDateFlag;
  private $EndYear;
  private $EndMonth;
  private $EndDay;
  private $EndDateFlag;
  private $Medium;
  private $Dimension;
  private $Collection;
  private $Inventory;
  private $Category;
  private $ExtraImages;
  private $Catalog;
  private $BookCatalog;
  private $Notes;
  private $Commentary;
  private $Opps; 
  private $FormerList;
  private $CatalogList;
  private $BookCatalogList;
  private $OppList; 
 
  
  function __construct($param) 
  {
    parent::__construct(); 
	$this->FormerList = array();
	$this->CatalogList = new GenericCatalog();
	$this->BookCatalogList = new GenericCatalog();
	$this->OppList = new GenericOpp();
	
	$this->OldId = $param['id'];
	$this->NewId = trim($param['CatID']);
	if(isset($param['NotVerified']) && $param['NotVerified']=="yes")
	  $this->NotVerified = 1;
	else
	  $this->NotVerified = 0;
	  
	$this->Title = mysql_real_escape_string(trim($param['Title']));
	$this->Location = mysql_real_escape_string(trim($param['Location']));
	$this->Duration = mysql_real_escape_string(trim($param['Duration']));
	$this->StartYear = $param['StartYear'];
	$this->StartMonth = $param['StartMonth'];
	$this->StartDay = $param['StartDay'];
	$this->StartDateFlag = $param['StartDateFlag'];
	$this->EndYear = $param['EndYear'];
	$this->EndMonth = $param['EndMonth'];
	$this->EndDay = $param['EndDay'];
	$this->EndDateFlag = $param['EndDateFlag'];
	$this->Medium = mysql_real_escape_string(trim($param['Medium']));
	$this->Dimension = mysql_real_escape_string(trim($param['Dimension']));
	$this->Collection = mysql_real_escape_string(trim($param['Collection']));
	$this->Inventory = mysql_real_escape_string(trim($param['Inventory']));
	$this->Category = $param['Category'];
	$this->ExtraImages = $param['ExtraImages'];
	$this->Catalog = trim($param['Catalog']);
	$this->BookCatalog = trim($param['BookCatalog']);
	$this->Notes = trim($param['Notes']);
	$this->Commentary = trim($param['Commentary']);
	$this->Opps = trim($param['Opps']);	
        for($i=1;$i<=25;$i++) { 
            $parac ="Collector".$i;
            $paral ="Location".$i;
            $parad ="Date".$i;
       	    $paraa ="Amount".$i;
	    $paran ="Number".$i;
            
            $this->FormerList[$i]['name'] = mysql_real_escape_string(trim($param[$parac]));
            $this->FormerList[$i]['location'] = mysql_real_escape_string(trim($param[$paral]));
            $this->FormerList[$i]['date'] = mysql_real_escape_string(trim($param[$parad]));
            $this->FormerList[$i]['amount'] = mysql_real_escape_string(trim($param[$paraa]));
            $this->FormerList[$i]['number'] = mysql_real_escape_string(trim($param[$paran]));
        
        }
  }
    
  public function checkData()  //check all data if legally
  {
	if(!preg_match("/^OPP+\.\d\d+\:\d\d\d$/", $this->NewId))  // check OPP number
	  return "Invalid input error: <br>Catalog format is invalid.";
	  
	$query = "SELECT count(*) FROM `ARTWORK` where opp = '$this->OldId'" ; // check if this new OPP exists
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	if($row[0]==0) return "The Artwork of catalog '$this->OldId' does not exist.";
	
	if($this->NewId != $this->OldId)  // if OPP number is changed
	{
	  $query = "SELECT count(*) FROM `ARTWORK` where opp = '$this->NewId'" ; // check if this new OPP exists
	  $result = mysql_query($query);
	  $row = mysql_fetch_array($result);
	  if($row[0]!=0) return "The Artwork of catalog '$this->NewId' already exists.";
	}  
		
	if($this->Title == "") // check title
	  return "Invalid input error: <br>Title must not be empty.";
	if($this->Location == "") // check Location
	  return "Invalid input error: <br>Location must not be empty.";  
	if($this->Duration == "") // check Duration
	  return "Invalid input error: <br>Duration must not be empty."; 
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
        
	if($this->Medium == "") // check Medium
	  return "Invalid input error: <br>Medium must not be empty.";
	if($this->Dimension == "") // check Dimension
	  return "Invalid input error: <br>Dimension must not be empty.";  
	if($this->Collection == "") // check Collection
	  return "Invalid input error: <br>Collection must not be empty.";  
	if(!is_numeric($this->ExtraImages))   // check ExtraImages
	  return "Invalid input error: <br>ExtraImages must be number.";    
	    
	// --- Just check for proper format in Book Catalogs -------------------
	$this->BookCatalog = preg_replace('/\r\n/', "\n", $this->BookCatalog);  
	$this->BookCatalog = preg_replace('/\n\n+/', "\n", $this->BookCatalog);  
	$this->BookCatalog = preg_replace('/^\n/', "", $this->BookCatalog); 
	$this->BookCatalog = preg_replace('/\n$/', "", $this->BookCatalog); 
	$this->BookCatalog = str_replace("\n", "; ", $this->BookCatalog);
	if(strlen($this->BookCatalog)>0)
	{
	  $array = explode("; ",$this->BookCatalog);
	  for($i=0; $i<count($array); $i++)
	    $this->BookCatalogList->add($array[$i]);
	}
	// ---------------------------------------------------------------------
	
	// --- Check for proper format and existance of Catalogs ---------------
	$this->Catalog = preg_replace('/\r\n/', "\n", $this->Catalog);  
	$this->Catalog = preg_replace('/\n\n+/', "\n", $this->Catalog);  
	$this->Catalog = preg_replace('/^\n/', "", $this->Catalog); 
	$this->Catalog = preg_replace('/\n$/', "", $this->Catalog); 
	if(strlen($this->Catalog)>0)
	{
		$query = "SELECT Catalog,Volume FROM `CATVOLUMES`" ;
		$result = mysql_query($query);
		
		$array = explode("\n",$this->Catalog);
		
		for($i=0; $i<count($array); $i++)
	    {
			mysql_data_seek($result , 0);
			$found = 0;
			$this->CatalogList->add($array[$i]);
	    	$catalog = $this->CatalogList->Catalog;
			while($row = mysql_fetch_array($result))
			{
			  if($row['Catalog'] == $catalog)
			  {  $found = 1; break; }
			}
			if($found == 0) return "The catalog '$catalog' does not exist.";
			
			mysql_data_seek($result , 0);
			$found = 0;
	    	$volume = $this->CatalogList->Volume;
			while($row = mysql_fetch_array($result))
			{
			  if($row['Volume'] == $volume && $row['Catalog'] == $catalog)
			    {  $found = 1; break; }
			}
			if($found == 0) return "The volume '$volume' does not exist in the '$catalog' catalog.";
	  	}
	} 
	// ---------------------------------------------------------------------
	// --- Start Add relationship entries to CATENTRIES----------------------------------------
	$current = $this->CatalogList->head;
	while($current!=NULL)
	{
	  $query = "SELECT COUNT(*) FROM `CATENTRIES`  WHERE Catalog='$current->Catalog' AND Volume='$current->Volume' AND Number=$current->Number AND Suffix='$current->Suffix'";
	  $result = mysql_query($query);
	  $row = mysql_fetch_array($result);
	  if($row[0]==0)
	  {
	    $query = "INSERT INTO `CATENTRIES` (Catalog,Volume,Number,Suffix) VALUES ('$current->Catalog', '$current->Volume', $current->Number, '$current->Suffix')";
	    $result = mysql_query($query);
	    if($result != TRUE)
	      return "Add catalog to CATENTRIES failed";
	  }	  		
	  $current = $current->nxt;	
	}
	// --- End Add relationship entries to CATENTRIES----------------------------------------  
	
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
	return "OK";  
  }

  public function saveData()  //operate on database to save data
  {
    $commentary = mysql_real_escape_string($this->Commentary);
	$note = mysql_real_escape_string($this->Notes);
	$query = "UPDATE `ARTWORK` SET opp='$this->NewId',notVerified=$this->NotVerified,title='$this->Title',location='$this->Location',duration='$this->Duration',dateStart=CONCAT('$this->StartYear','-','$this->StartMonth','-','$this->StartDay'),dateStartFlag=$this->StartDateFlag,dateEnd=CONCAT('$this->EndYear','-','$this->EndMonth','-','$this->EndDay'),dateEndFlag=$this->EndDateFlag,medium='$this->Medium',dimension='$this->Dimension',collection='$this->Collection',bookCatalog='$this->BookCatalog',__catalog='$this->Catalog',extraImages=$this->ExtraImages,commentary='$commentary',notes='$note',inventory='$this->Inventory',category='$this->Category' WHERE opp = '$this->OldId'";
	$result = mysql_query($query);
	if($result !== TRUE)
	  return "Modify Artwork failed.";
	  
	$this->CheckSingleArtworkEntry();

	if($this->NewId != $this->OldId)  // if OPP number is changed
	  $this->ChangeOPPID();

	// --- Start Add relationship entries to RLTN_WORKS_CATALOG----------------------------------------
	$query = "DELETE FROM `RLTN_WORKS_CATALOG` WHERE idArtwork= '$this->NewId'";
	$result = mysql_query($query);
	$current = $this->CatalogList->head;
	while($current!=NULL)
	{
	  $query = "INSERT INTO `RLTN_WORKS_CATALOG` (idArtwork,Catalog,Volume,Number,Suffix,NotVerified) VALUES ('$this->NewId', '$current->Catalog', '$current->Volume', $current->Number, '$current->Suffix', $current->NotVerified)";
	  $result = mysql_query($query);
	  if($result !== TRUE)
	    return "Add catalog failed";
		
	  $current = $current->nxt;	
	}
	// --- End Add relationship OPPs entries to RLTN_WORKS_CATALOG----------------------------------------   
	 
	//Update OPPs information in the database;
	$query = "DELETE FROM `RLTN_ARTWORK_ARTWORK` WHERE oppmaster= '$this->NewId'";
	$result = mysql_query($query);
	
	if($result !== TRUE)
	    return "Update OPPs failed";
	$current = $this->OppList->head;
	while($current!=NULL)
	{
	  $query = "INSERT INTO `RLTN_ARTWORK_ARTWORK` (oppmaster, opp) VALUES ('$this->NewId', '$current->Opp')";
	  $result = mysql_query($query);
	  if($result !== TRUE)
	    return "Update OPPs failed";
		
	  $current = $current->nxt;	
	}
	// --- End Add relationship  OPPs entries to RLTN_ARTWORK_ARTWORK----------------------------------------    
	
	//Update OPPs former collectors 
	$query = "DELETE FROM `FORMERLY` WHERE opp = '$this->OldId'";
    $result = mysql_query($query);
	for($i=1;$i<=25;$i++)
	{
		$collector =$this->FormerList[$i]['name'];
		if ( $collector !=NULL){
                    $location = $this->FormerList[$i]['location'];
                    $date = $this->FormerList[$i]['date'];
                    $amount = $this->FormerList[$i]['amount'];
                    $n = $this->FormerList[$i]['number'];
                
                    $query = "INSERT INTO `FORMERLY` (collector, location, date, amount, num, opp, OrderPriority) VALUES ('$collector','$location','$date', '$amount','$n', '$this->NewId','$i')";
                    $result = mysql_query($query);
		}		
	}
	// --- End update former collectors to FORMERLY ----------------------------
        
       //Update OPPs split note DataTable  
       $query = "DELETE FROM `NOTE_DATATABLE` WHERE opp = '$this->OldId'";
      $i=1;
     while(strpos($note, "<DataTable>")!==FALSE)
      {            
	  $endPosition = strpos($note, "</DataTable>");
	  $entryLength = $endPosition + 12;
	  $entry = trim(substr($note,0, $entryLength));  
          $query = "INSERT INTO `NOTE_DATATABLE` (opp,id,datatable) VALUES ('$this->NewId','$i', '$entry')";
          $result = mysql_query($query);
          $note = str_replace($entry, "", $note);
          $i++;
      } 
    // --- End update OPPs split note DataTable ----------------------------    
        
	return "OK";
  }
  // --- Start change entries of old opp---------------------------------------- 
  public function ChangeOPPID()
  {
    $query = "UPDATE `NARRATIVE` SET event=REPLACE(event,CONCAT('<artwork>','$this->OldId','</artwork>'),CONCAT('<artwork>','$this->NewId','</artwork>')),commentary=REPLACE(commentary,CONCAT('<artwork>','$this->OldId','</artwork>'),CONCAT('<artwork>','$this->NewId','</artwork>')) WHERE INSTR(CONCAT(event,commentary),CONCAT('<artwork>','$this->OldId','</artwork>'))";
    $result = mysql_query($query);
	
	$query = "UPDATE `ARTWORK` SET commentary=REPLACE(commentary,CONCAT('<artwork>','$this->OldId','</artwork>'),CONCAT('<artwork>','$this->NewId','</artwork>')) ,title=REPLACE(title,CONCAT('<artwork>','$this->OldId','</artwork>'),CONCAT('<artwork>','$this->NewId','</artwork>')),medium=REPLACE(medium,CONCAT('<artwork>','$this->OldId','</artwork>'),CONCAT('<artwork>','$this->NewId','</artwork>'))WHERE INSTR(CONCAT(commentary,title,medium),CONCAT('<artwork>','$this->OldId','</artwork>'))";
    $result = mysql_query($query);
	
	$query = "UPDATE `WRITINGS_PAGES` SET commentary=REPLACE(commentary,CONCAT('<artwork>','$this->OldId','</artwork>'),CONCAT('<artwork>','$this->NewId','</artwork>')) WHERE commentary like '%<artwork>$this->OldId</artwork>%'";
    $result = mysql_query($query);
	
	$query = "UPDATE `WRITINGS_PAGES` SET image='$this->NewId' where image='$this->OldId'";
    $result = mysql_query($query);
	
	$query = "UPDATE `RLTN_NARR_PHOTO` SET description=REPLACE(description,CONCAT('<artwork>','$this->OldId','</artwork>'),CONCAT('<artwork>','$this->NewId','</artwork>')) WHERE description like '%<artwork>$this->OldId</artwork>%'";
    $result = mysql_query($query);
	
	$query = "UPDATE `RLTN_MASTERARTWORK_ARTWORK` SET opp='$this->NewId' where opp='$this->OldId'";
    $result = mysql_query($query);
	
	$query = "UPDATE `RLTN_ARTWORK_ARTWORK` SET oppmaster='$this->NewId' where oppmaster='$this->OldId'";
    $result = mysql_query($query);
	
	$query = "UPDATE `RLTN_ARTWORK_ARTWORK` SET opp='$this->NewId' where opp='$this->OldId'";
    $result = mysql_query($query);
	
  }
  // --- End change entries of old opp---------------------------------------- 
  public function CheckSingleArtworkEntry()
  {
    $query = "DELETE FROM `RTLN_ARTWORK_LINK` WHERE idARTWORK = '$this->OldId'";
    $result = mysql_query($query);
    $query = "DELETE FROM `RLTN_AC_ARTWORK` WHERE idAC = '$this->OldId'";
    $result = mysql_query($query);
	$query = "DELETE FROM `RLTN_AT_ARTWORK` WHERE idAT = '$this->OldId'";
    $result = mysql_query($query);
	$query = "DELETE FROM `RLTN_AM_ARTWORK` WHERE idAM = '$this->OldId'";
    $result = mysql_query($query);
	
    $text = $this->Commentary;
	
	// --- start add record to RTLN_ARTWORK_LINK
	while($startPosition = strpos($text, "<linkId>"))
	{
	  $endPosition = strpos($text, "</linkId>");
	  $tagLength = $endPosition - $startPosition - 8;
	  $tagText = trim(substr($text,$startPosition+8, $tagLength));  // $tagText is the text between <linkId> and </linkId>
	  
	  $query = "INSERT INTO `RTLN_ARTWORK_LINK` (idARTWORK,idLINK) VALUES ('$this->NewId', $tagText)";
      $result = mysql_query($query); 
	  
	  $text = str_replace("<linkId>".$tagText."</linkId>", "", $text);
	}
	// --- end add record to RTLN_ARTWORK_LINK
	
    // --- start add record to RLTN_AC_ARTWORK
	while($startPosition = strpos($text, "<artwork>"))
	{
	  $endPosition = strpos($text, "</artwork>");
	  $tagLength = $endPosition - $startPosition - 9;
	  $tagText = trim(substr($text,$startPosition+9, $tagLength));  // $tagText is the text between <artwork> and </artwork>
	  
	  $query = "INSERT INTO `RLTN_AC_ARTWORK` (idAC,idARTWORK) VALUES ('$this->NewId', '$tagText')";
      $result = mysql_query($query); 
	  $text = str_replace("<artwork>".$tagText."</artwork>", "", $text);
	}
	// --- end add record to RLTN_AC_ARTWORK
	
	// --- start add record to RLTN_AT_ARTWORK
   	$title = $this->Title;
	
	while(strpos($title, "<artwork>")!==FALSE)
	{
	  $startPosition = strpos($title, "<artwork>");
	  $endPosition = strpos($title, "</artwork>");
	  $tagLength = $endPosition - $startPosition - 9;
	  $tagText = trim(substr($title,$startPosition+9, $tagLength));  // $tagText is the text between <artwork> and </artwork>
	  
	  $query = "INSERT INTO `RLTN_AT_ARTWORK` (idAT,idARTWORK) VALUES ('$this->NewId', '$tagText')";
      $result = mysql_query($query); 
	  $title = str_replace("<artwork>".$tagText."</artwork>", "", $title);
	}
	// --- end add record to RLTN_AT_ARTWORK
	
	// --- start add record to RLTN_AM_ARTWORK
   	$medium = $this->Medium;
	
	while(strpos($medium,"<artwork>")!==FALSE)
	{ 
	  $startPosition = strpos($medium, "<artwork>");
	  $endPosition = strpos($medium, "</artwork>");
	  $tagLength = $endPosition - $startPosition - 9;
	  $tagText = trim(substr($medium,$startPosition+9, $tagLength));  // $tagText is the text between <artwork> and </artwork>
	  
	  $query = "INSERT INTO `RLTN_AM_ARTWORK` (idAM,idARTWORK) VALUES ('$this->NewId', '$tagText')";
      $result = mysql_query($query); 
	  $medium = str_replace("<artwork>".$tagText."</artwork>", "", $medium);
	}
	// --- end add record to RLTN_AM_ARTWORK	
  }
} 
?>