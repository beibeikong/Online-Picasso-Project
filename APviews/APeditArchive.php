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
<title>Edit Archive - <?=PROJECTNAME?></title>
<link rel="stylesheet" href="./APcss/popup.css"/>
<link rel="stylesheet" href="./APcss/addArtworkEntry.css"/>
<script type="text/javascript" src="./APjs/popup.js"></script>
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>


<body>
<?php
require_once(APMODULES_PATH.'ModifyArchive.php');
$obj = new ModifyArchive($_GET['id']);
$row = $obj->getData();
?>
<table class="HeaderBar" cellspacing="0">
  <tr>
    <td class="Logo"><img src="./images/opp-emblem-corner.png" width="61" height="59" /></td>
    <td class="Title">Edit Archive</td>
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
<input value="<?=$_GET['id']?>" id="id" name="id" type="hidden">
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
			    <td><input value="<?=$row['Publisher']?>" size="30" id="Publisher" name="Publisher" type="text"></td>
			  </tr>
			  <tr>	
			    <td class="Label"><label for="title">Title:</label> </td>
				<td><input value="<?=$row['Title']?>" size="30" id="title" name="Title" type="text"></td>
			  </tr>
			  <tr>	
			    <td valign="top" class="Label"><label for="startmonth">Date:</label> </td>
				<td>
				  <select id="startmonth" name="Month">
				    <option value="0" <?php if($row['StartMonth']==0) echo "selected";?>>(Unknown)</option><option value="1" <?php if($row['StartMonth']==1) echo "selected";?>>January</option><option value="2" <?php if($row['StartMonth']==2) echo "selected";?>>February</option><option value="3" <?php if($row['StartMonth']==3) echo "selected";?>>March</option><option value="4" <?php if($row['StartMonth']==4) echo "selected";?>>April</option><option value="5" <?php if($row['StartMonth']==5) echo "selected";?>>May</option><option value="6" <?php if($row['StartMonth']==6) echo "selected";?>>June</option><option value="7" <?php if($row['StartMonth']==7) echo "selected";?>>July</option><option value="8" <?php if($row['StartMonth']==8) echo "selected";?>>August</option><option value="9" <?php if($row['StartMonth']==9) echo "selected";?>>September</option>
				  	<option value="10" <?php if($row['StartMonth']==10) echo "selected";?>>October</option><option value="11" <?php if($row['StartMonth']==11) echo "selected";?>>November</option><option value="12" <?php if($row['StartMonth']==12) echo "selected";?>>December</option>
				  </select>
				  <select id="startday" name="Day">
				    <option value="0" <?php if($row['StartDay']==0) echo "selected";?>>0</option><option value="1" <?php if($row['StartDay']==1) echo "selected";?>>1</option><option value="2" <?php if($row['StartDay']==2) echo "selected";?>>2</option><option value="3" <?php if($row['StartDay']==3) echo "selected";?>>3</option><option value="4" <?php if($row['StartDay']==4) echo "selected";?>>4</option><option value="5" <?php if($row['StartDay']==5) echo "selected";?>>5</option><option value="6" <?php if($row['StartDay']==6) echo "selected";?>>6</option><option value="7" <?php if($row['StartDay']==7) echo "selected";?>>7</option><option value="8" <?php if($row['StartDay']==8) echo "selected";?>>8</option><option value="9" <?php if($row['StartDay']==9) echo "selected";?>>9</option><option value="10" <?php if($row['StartDay']==10) echo "selected";?>>10</option>
				  	<option value="11" <?php if($row['StartDay']==11) echo "selected";?>>11</option><option value="12" <?php if($row['StartDay']==12) echo "selected";?>>12</option><option value="13" <?php if($row['StartDay']==13) echo "selected";?>>13</option><option value="14" <?php if($row['StartDay']==14) echo "selected";?>>14</option><option value="15" <?php if($row['StartDay']==15) echo "selected";?>>15</option><option value="16" <?php if($row['StartDay']==16) echo "selected";?>>16</option><option value="17" <?php if($row['StartDay']==17) echo "selected";?>>17</option><option value="18" <?php if($row['StartDay']==18) echo "selected";?>>18</option><option value="19" <?php if($row['StartDay']==19) echo "selected";?>>19</option><option value="20" <?php if($row['StartDay']==20) echo "selected";?>>20</option>
				  	<option value="21" <?php if($row['StartDay']==21) echo "selected";?>>21</option><option value="22" <?php if($row['StartDay']==22) echo "selected";?>>22</option><option value="23" <?php if($row['StartDay']==23) echo "selected";?>>23</option><option value="24" <?php if($row['StartDay']==24) echo "selected";?>>24</option><option value="25" <?php if($row['StartDay']==25) echo "selected";?>>25</option><option value="26" <?php if($row['StartDay']==26) echo "selected";?>>26</option><option value="27" <?php if($row['StartDay']==27) echo "selected";?>>27</option><option value="28" <?php if($row['StartDay']==28) echo "selected";?>>28</option><option value="29" <?php if($row['StartDay']==29) echo "selected";?>>29</option><option value="30" <?php if($row['StartDay']==30) echo "selected";?>>30</option><option value="31" <?php if($row['StartDay']==31) echo "selected";?>>31</option>
				  </select>
				  <select id="startyear" name="Year"><?php for($i= 1930; $i<=date("Y"); $i++) { echo("<option value=\"$i\" "); if($row['StartYear']==$i) echo "selected"; echo(">$i</option>");} ?>
				  </select>
				  <br/>
				  <input id="DateFlagLower" name="DateFlag" value="0" type="radio" <?php if($row['DateFlag']==0) echo "checked";?>><label for="StartDateFlagLower">Lower <small>(default)</small></label>&nbsp;&nbsp;&nbsp;<input id="DateFlagUpper" name="DateFlag" value="1" type="radio" <?php if($row['DateFlag']==1) echo "checked";?>><label for="StartDateFlagUpper">Upper</label>
				</td>
			  </tr>
			  <tr>	
			    <td class="Label"><label for="medium">Description:</label> </td>
				<td><input value="<?=$row['DateDescription']?>" size="30" id="Description" name="Description" type="text"></td>
			  </tr>
              <tr>	
			    <td valign="top" class="Label"><label for="extraimages">Language:</label> </td>	
				<td>
						<table border="0" cellpadding="0" cellspacing="3">
							<tr><td><input name="Lan" type="radio" id="LanEN" value="en" <?php if($row['Language']=="en") echo "checked";?>/><img src="./images/languagepin-en.png" width="16" height="16" alt="" title="English"   /> English</td></tr>
							<tr><td><input type="radio" name="Lan" id="LanES" value="es" <?php if($row['Language']=="es") echo "checked";?>/> <img src="./images/languagepin-es.png" width="16" height="16" alt="" title="Spanish"   /> Spanish</td></tr>
							<tr><td><input type="radio" name="Lan" id="LanFR" value="fr" <?php if($row['Language']=="fr") echo "checked";?>/> <img src="./images/languagepin-fr.png" width="16" height="16" alt="" title="French"    /> French</td></tr>
							<tr><td><input type="radio" name="Lan" id="LanDE" value="de" <?php if($row['Language']=="de") echo "checked";?>/> <img src="./images/languagepin-de.png" width="16" height="16" alt="" title="German"    /> German</td></tr>
							<tr><td><input type="radio" name="Lan" id="LanIT" value="it" <?php if($row['Language']=="it") echo "checked";?>/> <img src="./images/languagepin-it.png" width="16" height="16" alt="" title="Italian"   /> Italian</td></tr>
							<tr><td><input type="radio" name="Lan" id="LanPT" value="pt" <?php if($row['Language']=="pt") echo "checked";?>/> <img src="./images/languagepin-pt.png" width="16" height="16" alt="" title="Portuguese"/> Portuguese</td></tr>
							<tr><td><input type="radio" name="Lan" id="LanCA" value="ca" <?php if($row['Language']=="ca") echo "checked";?>/> <img src="./images/languagepin-ca.png" width="16" height="16" alt="" title="Catalan"   /> Catalan</td></tr>
							<tr><td><input type="radio" name="Lan" id="LanJA" value="ja" <?php if($row['Language']=="ja") echo "checked";?>/> <img src="./images/languagepin-ja.png" width="16" height="16" alt="" title="Japanese"  /> Japanese</td></tr>
							<tr><td><input type="radio" name="Lan" id="LanRU" value="ru" <?php if($row['Language']=="ru") echo "checked";?>/> <img src="./images/languagepin-ru.png" width="16" height="16" alt="" title="Russian"   /> Russian</td></tr>
							<tr><td><input type="radio" name="Lan" id="LanNL" value="nl" <?php if($row['Language']=="nl") echo "checked";?>/> <img src="./images/languagepin-nl.png" width="16" height="16" alt="" title="Dutch"     /> Dutch</td></tr>
							<tr><td><input type="radio" name="Lan" id="LanSV" value="sv" <?php if($row['Language']=="sv") echo "checked";?>/> <img src="./images/languagepin-sv.png" width="16" height="16" alt="" title="Swedish"   /> Swedish</td></tr>
							<tr><td><input type="radio" name="Lan" id="LanNO" value="no" <?php if($row['Language']=="no") echo "checked";?>/> <img src="./images/languagepin-no.png" width="16" height="16" alt="" title="Norwegian" /> Norwegian</td></tr>
					  </table>
				</td>
			  </tr>
			</table>
		  </div>
		  <div id="Tab2Side">
		  	<center>
			<div class="ImgHolder">
				<table border="0" cellpadding="0" cellspacing="2">
					<?php $start = 1; 
						$imageArray = explode(";", $row['Images']);
						foreach($imageArray as $image) {
					?>
						<tr>
							<td align="right">
								<?=$start?>. <input value="<?=$image?>" size="30" id="img<?=$start?>" name="img<?=$start?>" type="text">
							</td>
						</tr>
				
				
					<?php $start++; }
					for($i=$start; $i<=50; $i++) { ?>
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
		    <div id="Tab1"><textarea name="text" id="text" rows="24" cols="63"><?=$row['Text']?></textarea></div>
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
			<button type="button" name="saveButton" value="save" onclick="OnSaveModifiedForm('ModifyArchiveEngine'); return false;" id="SaveButton">Save</button>
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
