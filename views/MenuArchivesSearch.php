<?php if ( ! defined('PROJECTNAME')) exit(''); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>References Letter Index - <?=PROJECTNAME?></title>
<link rel="stylesheet" href="./css/menu.css"/>
<script type="text/javascript" src="./js/menu.js"></script>
</head>

<body onload="Initialize('Archives Search'); AutoSizePopup();">
<table class="HeaderBar" cellspacing="0">
  <tr>
    <td class="Logo"><img src="./images/opp-emblem-corner.png" width="61" height="59" /></td>
    <td class="Title">Archives</td>
    <td class="Toolbar">
      <table cellspacing="0" align="right">
        <tr>
		  <td><a id="BtnExtrn" href="#" onclick="OpenWin(this.href,'OPPMenu',550,320); return false;">External Pop-Up</a></td>
		  <td><a id="BtnClose" href="javascript:ClosePopup();">Close</a></td>
		</tr>
	  </table>
	</td>
  </tr>
</table>
<center>
<table class="TabContainer" id="MenuTabs" cellspacing="0" align="center">
  <tr class="Tabs">
  	<td class="Inactive"><a href="index.php?view=MenuArchivesYear"><img src="./images/magnify-art.png"/>Chronology</a></td>
	<td class="Active"><img src="./images/magnify-text.png"/>Search</td>
	<td class="EmptySpace">&nbsp;</td>
  </tr>
  
  <tr>
	<td class="Container" colspan="3">

<form method="get" action="index.php" target="OPPMain" name="ArchivesSearchForm" id="ArchivesSearchForm">
	<input type="text" name="view" id="view" size="1" value="ArchiveSearch" style=" display:none"/>
	<input type="text" name="page" id="page" size="1" value="1" style=" display:none"/>
	  <table class="SearchForm" id="ArchivesSearch" cellspacing="0" align="center">
		<tr>
			<td class="fieldLabel"><strong>Title:</strong></td>
			<td class="fieldCtrls"><input type="text" name="Title" id="Title" size="40"/></td>
		</tr>
		
		<tr>
			<td class="fieldLabel"><strong>Keywords:</strong></td>
			<td class="fieldCtrls"><input type="text" name="Keywords" id="Keywords" size="40"/></td>
		</tr>
		
		
        <tr>
		    <td class="fieldLabel">Restrict by:</td>
			<td class="fieldCtrls">
						<input type="checkbox" name="RestrictByYear" id="RestrictByYear" value="yes" onclick="CheckYear(this.form);"/>
						Year: 
						<select size="1" name="DateType" id="DateType" onclick="CheckDateType(this.form);">
							<option selected="true">in</option>
							<option>before</option>
							<option>after</option>
							<option>between</option>
						</select>
						
						<select size="1" name="YearStart" id="YearStart">
							<?php 
							    for($i= 1930; $i<= date("Y"); $i++)
							      echo("<option value=\"$i\">$i</option>");
							  ?>
						</select>
						 <span id="AndText"> and </span>
						<select size="1" name="YearEnd"   id="YearEnd">
							<?php 
							    for($i= 1930; $i<= date("Y"); $i++)
							      echo("<option value=\"$i\">$i</option>");
							  ?>
						</select>
						
						<br/><br/>
						
						<input type="checkbox" name="RestrictByPub" id="RestrictByPub" value="yes" onclick="CheckPublisher(this.form);"/>
						Publisher: 
						<input type="text" name="Pub" id="Pub" size="25"/>
						
						<br/><br/>
						
						<input type="checkbox" name="RestrictByLan" id="RestrictByLan" value="yes" onclick="CheckLang(this.form);"/>
						Language:
						<table cellspacing="3" id="LanguageList">
							<tr>
								<td><input type="checkbox" name="LanEN" id="LanEN" value="yes"/> <img src="./images/languagepin-en.png" width="16" height="16" alt="" title="English"   /> English</td>
								<td><input type="checkbox" name="LanIT" id="LanIT" value="yes"/> <img src="./images/languagepin-it.png" width="16" height="16" alt="" title="Italian"   /> Italian</td>
								<td><input type="checkbox" name="LanRU" id="LanRU" value="yes"/> <img src="./images/languagepin-ru.png" width="16" height="16" alt="" title="Russian"   /> Russian</td>
							</tr>
							<tr>
								<td><input type="checkbox" name="LanES" id="LanES" value="yes"/> <img src="./images/languagepin-es.png" width="16" height="16" alt="" title="Spanish"   /> Spanish</td>
								<td><input type="checkbox" name="LanPT" id="LanPT" value="yes"/> <img src="./images/languagepin-pt.png" width="16" height="16" alt="" title="Portuguese"/> Portuguese</td>
								<td><input type="checkbox" name="LanNL" id="LanNL" value="yes"/> <img src="./images/languagepin-nl.png" width="16" height="16" alt="" title="Dutch"     /> Dutch</td>
							</tr>
							<tr>
								<td><input type="checkbox" name="LanFR" id="LanFR" value="yes"/> <img src="./images/languagepin-fr.png" width="16" height="16" alt="" title="French"    /> French</td>
								<td><input type="checkbox" name="LanCA" id="LanCA" value="yes"/> <img src="./images/languagepin-ca.png" width="16" height="16" alt="" title="Catalan"   /> Catalan</td>
								<td><input type="checkbox" name="LanSV" id="LanSV" value="yes"/> <img src="./images/languagepin-sv.png" width="16" height="16" alt="" title="Swedish"   /> Swedish</td>
							</tr>
							<tr>
								<td><input type="checkbox" name="LanDE" id="LanDE" value="yes"/> <img src="./images/languagepin-de.png" width="16" height="16" alt="" title="German"    /> German</td>
								<td><input type="checkbox" name="LanJA" id="LanJA" value="yes"/> <img src="./images/languagepin-ja.png" width="16" height="16" alt="" title="Japanese"  /> Japanese</td>
								<td><input type="checkbox" name="LanNO" id="LanNO" value="yes"/> <img src="./images/languagepin-no.png" width="16" height="16" alt="" title="Norwegian" /> Norwegian</td>
							</tr>
							<tr>
							</tr>
						</table>
						
						<br/>
					</td>
				</tr>		
		
		
		
		
		
	    <tr>
		    <td class="submitArea" colspan="2"><input type="submit" value="Search" id="FormSubmit"/><input type="reset"  value="Reset"  id="FormReset"/></td>
	    </tr>
	  </table>
	
	</form>
	
	
	</td>
  </tr>
</table>
</center>

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
