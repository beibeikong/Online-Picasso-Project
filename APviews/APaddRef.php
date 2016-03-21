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
<title>Add References - <?=PROJECTNAME?></title>
<link rel="stylesheet" href="./APcss/popup.css"/>
<link rel="stylesheet" href="./APcss/addArtworkEntry.css"/>
<script type="text/javascript" src="./APjs/popup.js"></script>
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>


<body>
<table class="HeaderBar" cellspacing="0">
  <tr>
    <td class="Logo"><img src="./images/opp-emblem-corner.png" width="61" height="59" /></td>
    <td class="Title">Add References</td>
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
		  <td class="Active"   id="TabLbl1Side"><a href="javascript:ChangeTabSide(1);"><img src="./images/magnify-text.png"/>Details</a></td>
		  <td class="EmptySpace">&nbsp;</td>
		</tr>
		<tr>
		  <td class="Container" colspan="2">
		  <div id="Tab1Side">
			<table class="DataEntry" cellspacing="2">
			  <tr>	
			    <td class="Label"><label for="title">Author:</label> </td>
				<td><input size="30" id="Author" name="Author" type="text"></td>
			  </tr>
			  
			  <tr>	
			    <td class="Label"><label for="title">Books:</label> </td>
				<td><input size="30" id="Books" name="Books" type="text"></td>
			  </tr>
			  
			  <tr>	
			    <td class="Label"><label for="title">Catalogs:</label> </td>
				<td><input size="30" id="Catalogs" name="Catalogs" type="text"></td>
			  </tr>
			  
                          <tr>	
			    <td class="Label"><label for="title">Exhibitions:</label> </td>
				<td><input size="30" id="Exhibitions" name="Exhibitions" type="text"></td>
			  </tr>
                            
			  <tr>	
			    <td class="Label"><label for="title">Title:</label> </td>
				<td><input size="30" id="Title" name="Title" type="text"></td>
			  </tr>
			  
			  <tr>	
			    <td class="Label"><label for="title">Date:</label> </td>
				<td><input size="30" id="Date" name="Date" type="text"></td>
			  </tr>
			  
			  <tr>	
			    <td class="Label"><label for="title">Publisher:</label> </td>
				<td><input size="30" id="Publisher" name="Publisher" type="text"></td>
			  </tr>
			  
			  <tr>
                <td valign="top" class="Label"><label for="startmonth">Edition:</label></td>
                <td><input size="30" id="Edition" name="Edition" type="text"> </td>
			  </tr>

			  <tr>
                <td valign="top" class="Label"><label for="endmonth">Volume:</label></td>
				<td><input size="30" id="Volume" name="Volume" type="text"></td>
			  </tr>

			  <tr>	
			    <td class="Label"><label for="title">Journal:</label> </td>
				<td><input size="30" id="Journal" name="Journal" type="text"></td>
			  </tr>

			  <tr>
                <td valign="top" class="Label"><label for="endmonth">Issue:</label></td>
				<td><input size="30" id="Issue" name="Issue" type="text"></td>
			  </tr>
			</table>
		  </div>
		  </td>
		</tr>
	  </table>
<!-------------- end left panel --------------------------->			  
	</td>
  </tr>
</table>
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
			<button type="button" onclick="OnSaveForm('AddRefEngine'); return false;" id="SaveButton">Save</button>
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
