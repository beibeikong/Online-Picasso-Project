<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');

	/* 
		This is a class to parse the BioPhotoZoom.php, to hide the original image path in url
		(1) For the linkIds
		Maps are stored in /maps
		People are stored in /photos/people
		Photos of places are stored in /photos/locations
		Photos of documents are stored in /photos/documents
		(2) For the photo links on the left margin
		Photos are stored in photos/YEAR/
		(3) For the Archives
		Photos are stored in /archives
	*/

class BioPhoto extends Database
{
  private $imageID;
  private $year;
  private $img;
  private $type;
  
  function __construct($arg) 
  {
    parent::__construct(); 
	/*
	$find = strpos($this->imageID, ".");
	$this->year = substr($this->imageID, $find+1, 2);		//get the last two digit of the year
	$this->imageID = substr_replace($this->imageID, '', $find, 1);
	$find2 = strpos($this->imageID, ".");
	$this->imageID = substr_replace($this->imageID, '-', $find2, 1);
	*/
	if(isset($arg['year']))
	  $this->year =$arg['year'];
	$this->img = $arg['img'];
	$this->type = $arg['type'];
  }

  //function to get the original image path from url
  public function getImagePath()
  {	
    if ($this->type == "map")
	  $path = "/maps/";
	else if ($this->type == "archive")
	  $path = "/archives/".$this->year."/";
	else if ($this->type == "photo")
	  $path = "/photos/".$this->year."/";
	else if ($this->type == "people")
	  $path = "/photos/people/";
	else if ($this->type == "location")
	  $path = "/photos/locations/";
	else if ($this->type == "document")
	  $path = "/photos/documents/";
	else if ($this->type == "other")
	  $path = "/documents/others/";
	$path = $path.$this->img;
	return $path;
  }
  
  
  public function getImageShort()   //get the photo file name
  {
	return $this->img;
  }
  
  public function getData()  //operate on database to get data
  {
	$query = "SELECT photo FROM `NARRATIVE` WHERE photo like '%<photo>$this->img%'";
	$result = mysql_query($query);
	return $result;
  }

}