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
<title>Add Term - <?=PROJECTNAME?></title>
<link rel="stylesheet" href="./APcss/popup.css"/>
<link rel="stylesheet" href="./APcss/addTermEntry.css"/>
<script type="text/javascript" src="./APjs/popup.js"></script>
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>


<body>
<?php
require_once(APMODULES_PATH.'ModifyTerm.php');
$obj = new ModifyTerm($_GET['id']);
$row = $obj->getData();
?>
<table class="HeaderBar" cellspacing="0">
  <tr>
    <td class="Logo"><img src="./images/opp-emblem-corner.png" width="61" height="59" /></td>
    <td class="Title">Edit Term</td>
    <td class="Toolbar">
      <table cellspacing="0" align="right">
        <tr>
		  <td><a id="BtnClose" href="javascript:ClosePopup();">Close</a></td>
		</tr>
	  </table>
	</td>
  </tr>
</table>
<!------------------------------------------- start Add Artwork ----------------------------------------------->
<form action="OPPAuthorV2WorksModifyDB" method="post" name="EntryForm" id="EntryForm">
<input value="<?=$_GET['id']?>" id="id" name="id" type="hidden">
<table align="center" cellspacing="3">
  <tr>
    <td align="center" valign="top">
<!-------------- start left panel --------------------------->		
      <table class="TabContainer" id="SideBar" cellspacing="0" align="center">
		<tr class="Tabs">
		  <td class="Active"   id="TabLbl1Side"><img src="./images/magnify-text.png"/>Details</td>
		  <td class="EmptySpace">&nbsp;</td>
		</tr>
		<tr>
		  <td class="Container" colspan="2">
			<table class="DataEntry" cellspacing="2">
			  <tr>	
			    <td class="Label"><label for="title">Term:</label> </td>
				<td><input value="<?=$row['term']?>" size="30" id="Term" name="Term" type="text"></td>
			  </tr>
			  
			  <tr>	
			    <td class="Label"><label for="title">Siglum:</label> </td>
				<td><input type="radio" value="spa"  name="Siglum" id="spa" <?php if($row['siglum']=='spa') echo "checked"; ?>/>Spanish&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" value="fre" name="Siglum" id="fre" <?php if($row['siglum']=='fre') echo "checked"; ?>/>French</td>
			  </tr>
			  
			  <tr>	
			    <td class="Label"><label for="title">Category:</label> </td>
				<td><select id="Category" name="Category">
				  <option value="v" <?php if($row['category']=='v') echo "selected"; ?>>v</option>
				  <option value="n" <?php if($row['category']=='n') echo "selected"; ?>>n</option>
				  <option value="a" <?php if($row['category']=='a') echo "selected"; ?>>a</option>
				  <option value="i" <?php if($row['category']=='i') echo "selected"; ?>>i</option>
				  <option value="p" <?php if($row['category']=='p') echo "selected"; ?>>p</option>
				  <option value="o" <?php if($row['category']=='o') echo "selected"; ?>>o</option>
				  <option value="c" <?php if($row['category']=='c') echo "selected"; ?>>c</option>
				  <option value="e" <?php if($row['category']=='e') echo "selected"; ?>>e</option>
                </select></td>
			  </tr>
			  <tr>	
			    <td class="Label"><label for="title">Morph:</label> </td>
				<td><input value="<?=$row['morph']?>" size="30" id="Morph" name="Morph" type="text" /></td>
			  </tr>
			  <tr>	
			    <td class="Label"><label for="title">Translation:</label> </td>
				<td><input value="<?=$row['translation']?>" size="30" id="Translation" name="Translation" type="text" /></td>
			  </tr>
			  <tr>
                <td valign="top" class="Label"><label for="title">Related<br />French Terms:</label></td>
                <td><input value="<?=$row['relatedFreTerms']?>" size="30" id="relatedFreTerms" name="relatedFreTerms" type="text" /></td>
			  </tr>
			  <tr>
                <td valign="top" class="Label"><label for="title">Related<br />Spanish Terms:</label></td>
                <td><input value="<?=$row['relatedSpaTerms']?>" size="30" id="relatedSpaTerms" name="relatedSpaTerms" type="text" /></td>
			  </tr>
			</table>
		  </td>
		</tr>
	  </table>
<!-------------- end left panel --------------------------->			  
	</td>
  </tr>
</table>
<br />
<!--------------------- start bottom buttons----------------->
<table class="ActionButtons" cellspacing="0" align="center">
  <tr>
    <td>
    <div>
	  <table class="StatusHolder" cellspacing="0">
		<tr>
		  <div class="Hidden"><img src="./images/statusicon-idle.gif" alt=""/><img src="./images/statusicon-busy.gif" alt=""/><img src="./images/statusicon-error.gif" alt=""/><img src="./images/statusicon-success.gif" alt=""/></div>
		  <td class="ImageHolder"><img src="./images/statusicon-idle.gif" alt="" id="StatusImage"/></td>
		  <td id="StatusMessage">Idle</td>
		  <td>
			<button type="button" onclick="OnSaveModifiedForm('ModifyTermEngine'); return false;" id="SaveButton">Save</button>
		  </td>
		</tr>
	  </table>
	</div>
	</td>
  </tr>
</table>
<!--------------------- end bottom buttons----------------->
</form>
<!------------------------------------------ end of Add Artwork ----------------------------------------------->
<center>
	<div class="Copyright" id="Copyright">
		<table width="100%" height="37" cellspacing="0">
			<tr>
				<td align="left" style="PADDING-LEFT: 10px">
					<font style="font-variant:small-caps; font-weight:bold"><?=PROJECTNAME?></font>
				</td>
				<td align="right" style="PADDING-RIGHT: 10px">
					© <?=START_YEAR?>-<?=date("Y")?>&nbsp;<?=COPYRIGHT?>
				</td>
			</tr>
	  </table>
	</div>
</center>
</body>
</html>
