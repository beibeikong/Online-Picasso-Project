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
<title>Add Archive - <?=PROJECTNAME?></title>
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
    <td class="Title">Add Archive</td>
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
<form action="OPPAuthorV2WorksModifyDB" method="post" name="EntryForm" id="EntryForm" target="_blank">
<table align="center" cellspacing="3">
  <tr>
    <td align="center" valign="top">
<!-------------- start left panel --------------------------->		
      <table class="TabContainer" id="SideBar" cellspacing="0" align="center">
		<tr class="Tabs">
		  <td class="Active"   id="TabLbl1Side"><a href="javascript:ChangeTabSide(1);"><img src="./images/magnify-text.png"/>Details</a></td>
		  <td class="Inactive" id="TabLbl2Side"><a href="javascript:ChangeTabSide(2);"><img src="./images/magnify-text.png"/>Images</a></td>
		  <td class="EmptySpace">&nbsp;</td>
		</tr>
		<tr>
		  <td class="Container" colspan="3">
		  <div id="Tab1Side">
			<table class="DataEntry" cellspacing="2">
			  <tr>	
			    <td class="Label"><label for="location">Publisher:</label> </td>
			    <td><input value="" size="30" id="Publisher" name="Publisher" type="text"></td>
			  </tr>
			  <tr>	
			    <td class="Label"><label for="title">Title:</label> </td>
				<td><input value="" size="30" id="title" name="Title" type="text"></td>
			  </tr>
			  <tr>	
			    <td valign="top" class="Label"><label for="startmonth">Date:</label> </td>
				<td>
				  <select id="startmonth" name="Month">
				    <option value="0">(Unknown)</option><option value="1">January</option><option value="2">February</option><option value="3">March</option><option value="4">April</option><option value="5">May</option><option value="6">June</option><option value="7">July</option><option value="8">August</option><option value="9">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option></select>
				  <select id="startday" name="Day">
				    <option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option></select>
				  <select id="startyear" name="Year"><?php for($i= 1930; $i<=date("Y"); $i++) echo("<option value=\"$i\">$i</option>"); ?>
				  </select>
				  <br/>
				  <input id="DateFlagLower" name="DateFlag" value="0" type="radio" checked><label for="StartDateFlagLower">Lower <small>(default)</small></label>&nbsp;&nbsp;&nbsp;<input id="DateFlagUpper" name="DateFlag" value="1" type="radio"><label for="StartDateFlagUpper">Upper</label>
				</td>
			  </tr>
			  <tr>	
			    <td class="Label"><label for="medium">Description:</label> </td>
				<td><input value="" size="30" id="Description" name="Description" type="text"></td>
			  </tr>
              <tr>	
			    <td valign="top" class="Label"><label for="extraimages">Language:</label> </td>	
				<td>
						<table border="0" cellpadding="0" cellspacing="3">
							<tr><td><input name="Lan" type="radio" id="LanEN" value="en" checked="checked"/><img src="./images/languagepin-en.png" width="16" height="16" alt="" title="English"   /> English</td></tr>
							<tr><td><input type="radio" name="Lan" id="LanES" value="es"/> <img src="./images/languagepin-es.png" width="16" height="16" alt="" title="Spanish"   /> Spanish</td></tr>
							<tr><td><input type="radio" name="Lan" id="LanFR" value="fr"/> <img src="./images/languagepin-fr.png" width="16" height="16" alt="" title="French"    /> French</td></tr>
							<tr><td><input type="radio" name="Lan" id="LanDE" value="de"/> <img src="./images/languagepin-de.png" width="16" height="16" alt="" title="German"    /> German</td></tr>
							<tr><td><input type="radio" name="Lan" id="LanIT" value="it"/> <img src="./images/languagepin-it.png" width="16" height="16" alt="" title="Italian"   /> Italian</td></tr>
							<tr><td><input type="radio" name="Lan" id="LanPT" value="pt"/> <img src="./images/languagepin-pt.png" width="16" height="16" alt="" title="Portuguese"/> Portuguese</td></tr>
							<tr><td><input type="radio" name="Lan" id="LanCA" value="ca"/> <img src="./images/languagepin-ca.png" width="16" height="16" alt="" title="Catalan"   /> Catalan</td></tr>
							<tr><td><input type="radio" name="Lan" id="LanJA" value="ja"/> <img src="./images/languagepin-ja.png" width="16" height="16" alt="" title="Japanese"  /> Japanese</td></tr>
							<tr><td><input type="radio" name="Lan" id="LanRU" value="ru"/> <img src="./images/languagepin-ru.png" width="16" height="16" alt="" title="Russian"   /> Russian</td></tr>
							<tr><td><input type="radio" name="Lan" id="LanNL" value="nl"/> <img src="./images/languagepin-nl.png" width="16" height="16" alt="" title="Dutch"     /> Dutch</td></tr>
							<tr><td><input type="radio" name="Lan" id="LanSV" value="sv"/> <img src="./images/languagepin-sv.png" width="16" height="16" alt="" title="Swedish"   /> Swedish</td></tr>
							<tr><td><input type="radio" name="Lan" id="LanNO" value="no"/> <img src="./images/languagepin-no.png" width="16" height="16" alt="" title="Norwegian" /> Norwegian</td></tr>
					  </table>
				</td>
			  </tr>
			</table>
		  </div>
		  <div id="Tab2Side">
		  	<center>
			<div class="ImgHolder">
				<table border="0" cellpadding="0" cellspacing="2">
					<?php for($i=1; $i<=50; $i++) { ?>
						<tr>
							<td align="right">
								<?=$i?>. <input value="" size="30" id="img<?=$i?>" name="img<?=$i?>" type="text">
							</td>
						</tr>
					<?php } ?>
				</table>
			</div>
			</center>		  
		  </div>
		  </td>
		</tr>
	  </table>
<!-------------- end left panel --------------------------->			  
	</td>

	<td align="center" valign="top">
<!-------------- start right panel --------------------------->	
 <table class="TabContainer" cellspacing="0" align="center">
	    <tr class="Tabs">
		  <td class="Active"   id="TabLbl1"><img src="./images/magnify-art.png" />Text</td>
		  <td class="EmptySpace">&nbsp;</td>
		</tr>
		<tr>
		  <td class="Container" colspan="2">
		    <div id="Tab1"><textarea name="text" id="text" rows="24" cols="63"></textarea></div>
		  </td>
		</tr>
	  </table>
<!-------------- end right panel --------------------------->	
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
			<button type="button" onclick="OnSaveForm('addArchiveEngine'); return false;" id="SaveButton">Save</button>
		  </td>
		</tr>
	  </table>
	</div>
	</td>
	<td>
	<div>
	  <button type="button" name="preButton" value="preview" onclick="PreviewEntryFullPage(this.form, 'ArchiveArticle')">Preview</button>
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
