<?php if ( ! defined('PROJECTNAME')) exit(''); 
if(file_exists('./APmodules/checkUser.php'))
    require_once('./APmodules/checkUser.php');  // check if it is authenrized user
else
    die('0'); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Authoring Portal - On-line Picasso Project</title>
<link rel="stylesheet" href="./APcss/main.css"/>
<link rel="stylesheet" href="./APcss/Reference.css"/>
<script type="text/javascript" src="./APjs/main.js"></script>
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>

<body onload="window.name='OPPMain';">
<?php
require_once(APMODULES_PATH.'BioResource.php');
$obj = new BioResource();
$result = $obj->getData();
$totalNum = $obj->getTotalNum();
?>
<center>
<?php include('APheader.htm'); ?>

<table width="990" border="0" cellspacing="0" cellpadding="0" class="main_body">
  <tr>
    <td align="center" style="padding:15px 15px 15px 15px">
	  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center" valign="middle">	
		    <table border="0" align="center" cellpadding="0" cellspacing="0">
		      <tr>
			    <td width="40" align="center">&nbsp;</td>
			    <td>&nbsp;</td>
                <td width="40" align="center">&nbsp;
			    </td>
		      </tr>
	        </table>
	      </td>
        </tr>
        
		<tr>
          <td>
            <table class="TabContainer" id="MenuTabs" cellspacing="0" align="center">
              <tr class="Tabs">
	            <td class="Active"><img src="./images/magnify-art.png"/>BioResource</td>
				<td class="Inactive"><a href="AuthorIndex.php?view=LinkId&id=3"><img src="./images/magnify-art.png"/>LinkId</a></td>
				<td class="InactiveEmpty">&nbsp;</td>		                
				<td class="InactiveEmpty">&nbsp;</td>				
				<td class="EmptySpace">&nbsp;</td>
              </tr>
              <tr>
	            <td class="Container" colspan="5">			
<!---------------------------- starting heading2 ---------------------------->
<table width="100%" cellspacing="0">
  <tr>
    <td width="150px" align="left">
	  <table cellspacing="0" class="NavBar" align="left">
        <tr>
          <td><button type="button" onclick="addBioResource(); return false;"><img src="./images/icon-add.png" width="16" height="16" alt="" title="Add Entry"/> Add</button></td>
		</tr>
      </table></td>
	
	<td>
	  <h2><?=$totalNum?> Catalogued Items</h2>
	</td>
	
	<td width="150px" align="right" >
	  <table cellspacing="0" class="NavBar" align="right">
        <tr>
          <td><button type="button" onclick="RefreshPage();"><img src="./images/icon-reload.png" width="16" height="16" alt="" title="Reload List"/> Reload</button></td>
        </tr>
      </table></td>
  </tr>
</table>
<br/>
<!---------------------------- end of heading2 ---------------------------->
<!---------------------------- Start Archive ---------------------------->
<table width="100%" class="EntriesList" align="center" cellpadding="0"  cellspacing="0">
  <tr class="Header">
    <td class="EditBtn"><small>Modify</small></td>
    <td class="EditBtn"><small>Delete</small></td>
	<td class="BioRes_id">id</td>
    <td class="BioRes_name">Name</td>
    <td class="BioRes_type">Type</td>
    <td class="BioRes_type">General<br>Type</td>
    <td class="Text">XML Code</td>
  </tr>
<?php $i = 1; while($row = mysql_fetch_array($result)){ ?>  
  <tr <?=($i%2!=0)? "class=\"Even\"" : ""?>>
    <td class="EditBtn"><button type="button" onclick="editBioResource('<?=$row['id']?>');"><img src="./images/icon-modify.png" width="16" height="16" alt="" title="Modify Entry" class="aaa"/></button></td>
    <td class="EditBtn"><button type="button" onclick="DeleteEntry('<?=$row['id']?>','deleteBioResourceEngine');"><img src="./images/icon-delete.png" width="16" height="16" alt="" title="Delete Entry" class="aaa"/></button></td> 
    <td class="BioRes_id"><?=$obj->escapeStringToHtmlText($row['id'])?></td>
	<td class="BioRes_name"><?=$obj->escapeStringToHtmlText($row['Name'])?></td>
	<td class="BioRes_type"><?=$obj->escapeStringToHtmlText($row['Type'])?></td>
	<td class="BioRes_type"><?=$obj->escapeStringToHtmlText($row['GeneralType'])?></td>
	<td class="Text"><div class="TextView"><?=$obj->escapeStringToHtmlText($row['PartialXMLCode'])?></div></td>
  </tr>
<?php $i++; } ?>
</table>

<!---------------------------- End Archive ---------------------------->
				</td>
              </tr>
            </table>
		  </td>
        </tr>
      </table>
	</td>
  </tr>
</table>
<?php include('APfooter.php'); ?>
</center>
</body>
</html>