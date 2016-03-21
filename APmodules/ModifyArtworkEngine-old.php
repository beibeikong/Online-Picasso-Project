<?php if ( ! defined('PROJECTNAME')) exit(''); 
if(file_exists('APmodules/checkUser.php'))
    require_once('APmodules/checkUser.php');  // check if it is authenrized user
else
    die('0'); 
	
require_once('Database.php');
require_once('GenericCatalog.php');

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
  
  private $CatalogList;
  private $BookCatalogList;
  
  function __construct($param) 
  {
    parent::__construct(); 
	
	$this->CatalogList = new GenericCatalog();
	$this->BookCatalogList = new GenericCatalog();
	
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
	return "OK";  
  }

  public function saveData()  //operate on database to save data
  {
    $commentary = mysql_real_escape_string($this->Commentary);
	$note = mysql_real_escape_string($this->Notes);
	$query = "UPDATE `ARTWORK` SET opp='$this->NewId',notVerified=$this->NotVerified,title='$this->Title',location='$this->Location',duration='$this->Duration',dateStart=CONCAT('$this->StartYear','-','$this->StartMonth','-','$this->StartDay'),dateStartFlag=$this->StartDateFlag,dateEnd=CONCAT('$this->EndYear','-','$this->EndMonth','-','$this->EndDay'),dateEndFlag=$this->EndDateFlag,medium='$this->Medium',dimension='$this->Dimension',collection='$this->Collection',bookCatalog='$this->BookCatalog',extraImages=$this->ExtraImages,commentary='$commentary',notes='$note',inventory='$this->Inventory',category='$this->Category' WHERE opp = '$this->OldId'";
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
	// --- End Add relationship entries to RLTN_WORKS_CATALOG----------------------------------------    
	
	return "OK";
  }
  
  public function ChangeOPPID()
  {
    $query = "UPDATE `NARRATIVE` SET event=REPLACE(event,CONCAT('<artwork>','$this->OldId','</artwork>'),CONCAT('<artwork>','$this->NewId','</artwork>')),commentary=REPLACE(commentary,CONCAT('<artwork>','$this->OldId','</artwork>'),CONCAT('<artwork>','$this->NewId','</artwork>')) WHERE INSTR(CONCAT(event,commentary),CONCAT('<artwork>','$this->OldId','</artwork>'))";
    $result = mysql_query($query);
	
	$query = "UPDATE `ARTWORK` SET commentary=REPLACE(commentary,CONCAT('<artwork>','$this->OldId','</artwork>'),CONCAT('<artwork>','$this->NewId','</artwork>')) WHERE commentary like '%<artwork>$this->OldId</artwork>%'";
    $result = mysql_query($query);
	
	$query = "UPDATE `WRITINGS_PAGES` SET commentary=REPLACE(commentary,CONCAT('<artwork>','$this->OldId','</artwork>'),CONCAT('<artwork>','$this->NewId','</artwork>')) WHERE commentary like '%<artwork>$this->OldId</artwork>%'";
    $result = mysql_query($query);
	
	$query = "UPDATE `WRITINGS_PAGES` SET image='$this->NewId' where image='$this->OldId'";
    $result = mysql_query($query);
  }
  
  public function CheckSingleArtworkEntry()
  {
    $query = "DELETE FROM `RTLN_ARTWORK_LINK` WHERE idARTWORK = '$this->OldId'";
    $result = mysql_query($query);
    $query = "DELETE FROM `RLTN_AC_ARTWORK` WHERE idAC = '$this->OldId'";
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
  }


} 
?>