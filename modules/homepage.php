<?php if ( ! defined('PROJECTNAME')) exit(''); 
require_once('Database.php');

// homepage class: get number of itmes from database
class Homepage extends Database
{
  function __construct() 
  {
    parent::__construct(); 
  }
    
  public function getData()  //operate on database to get data
  {
    //$result = mysql_query("SELECT (SELECT COUNT(1) FROM `ARTWORK`) AS ArtworkCount,(SELECT COUNT(1) FROM `NARRATIVE`) AS NarrativeCount,(SELECT COUNT(DISTINCT collection) FROM `ARTWORK`) AS CollectionsCount,(SELECT COUNT(1) FROM `REFERENCES`) AS RefsCount,(SELECT COUNT(1) FROM `ARCHIVES`) AS ArchivesCount, (SELECT COUNT(DISTINCT commentary) FROM `NARRATIVE`) AS NarrativeCommentaryCount, (SELECT COUNT(DISTINCT notes) FROM `ARTWORK`) AS ArtworkNoteCount, (SELECT COUNT(DISTINCT commentary) FROM `ARTWORK`) AS ArtworkCommentaryCount");
	$result = mysql_query("SELECT (SELECT COUNT(1) FROM `ARTWORK`) AS ArtworkCount,
(SELECT COUNT(1) FROM `NARRATIVE`) AS NarrativeCount,
((SELECT COUNT(DISTINCT collection) FROM `ARTWORK`) +
(SELECT COUNT(DISTINCT collector) FROM `FORMERLY`) )  AS CollectionsCount,
(SELECT COUNT(1) FROM `REFERENCES`) AS RefsCount,
(SELECT COUNT(1) FROM `ARCHIVES`) AS ArchivesCount, 
(SELECT COUNT(commentary) FROM `NARRATIVE` where commentary != '') AS NarrativeCommentaryCount, 
(SELECT COUNT(notes) FROM `ARTWORK` where notes != '') AS ArtworkNoteCount, 
(SELECT COUNT(commentary) FROM `ARTWORK` where commentary != '') AS ArtworkCommentaryCount");
	return $result;
  }
} 
?>