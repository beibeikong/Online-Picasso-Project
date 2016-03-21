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
<link rel="stylesheet" href="./APcss/LinkId.css"/>
<script type="text/javascript" src="./APjs/main.js"></script>
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>

<body onload="window.name='OPPMain';">
<?php
require_once(APMODULES_PATH.'linkIdTree.php');
$obj = new linkIdTree();
$result = $obj->getData($_GET['id']);
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
 	<td class="Inactive"><a href="AuthorIndex.php?view=BioResource"><img src="./images/magnify-art.png"/>BioResource</a></td>
	            <td class="Active"><img src="./images/magnify-art.png"/>LinkIds</td>
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
          <td><button type="button" onclick="addLinkId(); return false;"><img src="./images/icon-add.png" width="16" height="16" alt="" title="Add Entry"/> Add</button></td>
        </tr>
      </table></td>
	
	<td>
	  <select size="1" name="linkid"  id="linkid" class="Yearselect" onchange="changeid(window.location.href,'linkid');">
			<option value="3" <?php if($_GET['id']==3) echo("selected");?> >People [3]</option>
			<option value="8" <?php if($_GET['id']==8) echo("selected");?> >Location (City) [8]</option>
			<option value="2" <?php if($_GET['id']==2) echo("selected");?> >Location (Street, Plaza, etc.) [2]</option>
			<option value="9" <?php if($_GET['id']==9) echo("selected");?> >Museum [9]</option>
			<option value="1" <?php if($_GET['id']==1) echo("selected");?> >Bibliography [1]</option>
			<option value="4" <?php if($_GET['id']==4) echo("selected");?> >Text [4]</option>
			<option value="5" <?php if($_GET['id']==5) echo("selected");?> >Artworks (non-OPP) [5]</option>
			<option value="10" <?php if($_GET['id']==10) echo("selected");?> >Objects [10]</option>
			<option value="0" <?php if($_GET['id']==0) echo("selected");?> >Other [0]</option>
		  </select>
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
<!---------------------------- Start Artwork Summary ---------------------------->
<table width="100%" class="EntriesList" align="center" cellpadding="0"  cellspacing="0">
  <tr class="Header">
    <td class="EditBtn"><small>Modify</small></td>
    <td class="EditBtn"><small>Delete</small></td>
	<td class="Linkid">id</td>
    <td class="title">Title</td>
    <td class="url">URL</td>
  </tr>
<?php $i = 1; while($row = mysql_fetch_array($result)){ ?>  
  <tr <?=($i%2!=0)? "class=\"Even\"" : ""?>>
    <td class="EditBtn"><button type="button" onclick="EditLinkID('<?=$row['idLink']?>');"><img src="./images/icon-modify.png" width="16" height="16" alt="" title="Modify Entry" class="aaa"/></button></td>
    <td class="EditBtn"><button type="button" onclick="DeleteEntry('<?=$row['idLink']?>', 'deleteLinkIDEngine');"><img src="./images/icon-delete.png" width="16" height="16" alt="" title="Delete Entry" class="aaa"/></button></td> 
	<td class="Linkid"><?=$row['idLink']?></td>
    <td class="title"><?=$row['title']?></td>
    <td class="url"><?
		$str = $row['URL'];
		if (strlen($str) > 120)
			$str= substr($str, 0, 120)."...";
		echo $str;
	?></td>
  </tr>
<?php $i++; } ?>
</table>

<!---------------------------- End Artwork Summary ---------------------------->
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
