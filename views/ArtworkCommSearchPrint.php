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
<title>Commentary Print - On-line Picasso Project</title>
<link rel="stylesheet" href="./css/BiographyPrint.css"/>
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>

<body>
<?php
require_once(MODULES_PATH.'ArtworkSearchPrint.php');
$obj = new ArtworkSearchPrint($_GET);
$result = $obj->getData();
?>
<center><div class="TitlePage">
  <img src="./images/opp-emblem-whitebackground.png" width="100" height="91" alt=""/>
  <span class="Title"><?=PROJECTNAME?></span>
  <span class="SubTitle">Commentary Print</span>
  <span class="Copyright">Copyright&nbsp;&copy;&nbsp;<?=START_YEAR?>-<?=date("Y")?>&nbsp;Prof. Dr. Enrique Mallen</span>
</div>

<div class="Page"><center>
 <div class="PageInside">
<table width="100%" border="0" align="center" cellspacing="2">
<?php
    while($row = mysql_fetch_array($result)){ 
      if(trim($row['commentary'])!="")
	  {
		echo ("<tr><td colspan=\"2\" align=\"center\"><h2>$row[opp]</h2></td></tr>");

		$temp=(string)$row['commentary'];
        $temp= str_replace("&", "&amp;", $temp);

$xmlstring = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<oppNote>
$temp
</oppNote>
XML;

        $xml = simplexml_load_string($xmlstring);
		foreach($xml->DataTable as $DataTable)
        {
          foreach($DataTable->entry as $entry) 
	      {
?>
<tr>
    <td class="commentaryTitle"><?=$entry['title']?>:</td>
    <td class="Info"><?=$obj->parseText($entry->asXML())?></td>
  </tr>
<?php }  } }}?>
</table>
 </div>
</center>
</div>
</center></body>
</html>
