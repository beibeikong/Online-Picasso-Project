<!---------------------------- this is the notes page ---------------------------->
<?php if ( ! defined('PROJECTNAME')) exit(''); 
if(file_exists('./modules/checkFrontUser.php'))
    require_once('./modules/checkFrontUser.php');  // check if it is authenrized user
else
    die('0'); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="./css/commentary.css"/>
<link rel="stylesheet" href="./css/biography.css"/>
<script type="text/javascript" src="./js/main.js"></script>
<script type="text/javascript" src="./js/popup.js"></script>
</head>
<body <?php if(isset($_GET['highlight'])) echo("onload=\"highlightSearchTerms('$_GET[highlight]','commentaryTable');\"");?>>
<?php
require_once(MODULES_PATH.'BioCommentary.php');
$obj = new BioCommentary($_GET['id']);
$result = $obj->getData();
$row = mysql_fetch_array($result);

$temp=(string)$row['commentary'];
$temp= str_replace("&", "&amp;", $temp);

$xmlstring = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<oppNote>
$temp
</oppNote>
XML;

$xml = simplexml_load_string($xmlstring);
?>

<div id="commentaryTable">

<table width="100%"  align="center"> 
<?php 
  foreach($xml->DataTable as $DataTable)
  {
    foreach($DataTable->entry as $entry) 
	{
?>
  <tr>
    <td class="commentaryTitle"><?=$entry['title']?>:</td>
    <td class="Info"><?=$obj->parseText($entry->asXML())?></td>
  </tr>
<?php } echo("<tr><td>&nbsp;</td> <td>&nbsp;</td></tr>"); } ?>
</table>

</div>


</body>
</html>