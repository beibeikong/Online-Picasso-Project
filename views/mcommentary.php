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
  <link rel="stylesheet" href=" ./css/ArtworkCommentaryNew.css"/>

<link rel="stylesheet" href="./css/commentary.css"/>
<script type="text/javascript" src="./js/popup.js"></script>
<script type="text/javascript" src="./js/main.js"></script>
</head>
<body>
<?php
require_once(MODULES_PATH.'MasterCommentary.php');
$obj = new MasterCommentary($_GET['MasterID']);
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
<tr>
  <td  id="InfoHolder">
    <table class="TabContainer" id="MenuTabs" cellspacing="0" align="center">
      <tr class="Tabs">
       <td class="Active"><img src="./images/magnify-text.png"/>Details</td>
        <td class="EmptySpace">&nbsp;</td>
      </tr>


<?php 
  foreach($xml->DataTable as $DataTable)
  {
    foreach($DataTable->entry as $entry) 
	{
?>
  <tr>
<tr>
    <td class="Container" colspan="2">
	 <table width="100%" cellpadding="0" cellspacing="0">

    <td class="commentaryTitle"><?=$entry['title']?>:</td>
    <td class="Info"><?=$obj->parseText($entry->asXML())?></td>
  </table>
      </td>


<?php } echo("<tr><td>&nbsp;</td> <td>&nbsp;</td></tr>"); } ?>
</table>
</td>
 </tr>

</table>

</div>
</body>
</html>