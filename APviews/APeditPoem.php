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
<title>Edit Poem - <?=PROJECTNAME?></title>
<link rel="stylesheet" href="./APcss/popup.css"/>
<link rel="stylesheet" href="./APcss/addArtworkEntry.css"/>
<script type="text/javascript" src="./APjs/popup.js"></script>
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>


<body>
<?php
require_once(APMODULES_PATH.'ModifyPoem.php');
$obj = new ModifyPoem($_GET['mid']);
$row = $obj->getData();
?>
<table class="HeaderBar" cellspacing="0">
  <tr>
    <td class="Logo"><img src="./images/opp-emblem-corner.png" width="61" height="59" /></td>
    <td class="Title">Edit Poem</td>
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
<input value="<?=$_GET['mid']?>" id="mid" name="mid" type="hidden">
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
			    <td class="Label"><label for="title">Title:</label> </td>
				<td><input value="<?=$row['title']?>" size="30" id="title" name="title" type="text"></td>
			  </tr>
			  
			  <tr>	
			    <td class="Label"><label for="title">Alt Title:</label> </td>
				<td><input value="<?=$row['altTitle']?>" size="30" id="altTitle" name="altTitle" type="text"></td>
			  </tr>
			  
			  <tr>	
			    <td class="Label"><label for="title">Abr Title:</label> </td>
				<td><input value="<?=$row['abrTitle']?>" size="30" id="abrTitle" name="abrTitle" type="text"></td>
			  </tr>
			  
			  <tr>	
			    <td class="Label"><label for="title">Duration:</label> </td>
				<td><input value="<?=$row['duration']?>" size="30" id="duration" name="duration" type="text"></td>
			  </tr>
			  
			  <tr>	
			    <td class="Label"><label for="title">Siglum:</label> </td>
				<td><select id="Siglum" name="Siglum">
                    <option value="SPA" <?php if($row['siglum']=="SPA") echo "selected";?>>Spanish</option>
                    <option value="FRE" <?php if($row['siglum']=="FRE") echo "selected";?>>French</option>
                  </select></td>
			  </tr>
			  
			  <tr>
                <td valign="top" class="Label"><label for="startmonth">Date Start:</label>
                </td>
                <td><select id="startmonth" name="StartMonth">
                    <option value="0" <?php if($row['StartMonth']==0) echo "selected";?>>(Unknown)</option>
                    <option value="1" <?php if($row['StartMonth']==1) echo "selected";?>>January</option>
                    <option value="2" <?php if($row['StartMonth']==2) echo "selected";?>>February</option>
                    <option value="3" <?php if($row['StartMonth']==3) echo "selected";?>>March</option>
                    <option value="4" <?php if($row['StartMonth']==4) echo "selected";?>>April</option>
                    <option value="5" <?php if($row['StartMonth']==5) echo "selected";?>>May</option>
                    <option value="6" <?php if($row['StartMonth']==6) echo "selected";?>>June</option>
                    <option value="7" <?php if($row['StartMonth']==7) echo "selected";?>>July</option>
                    <option value="8" <?php if($row['StartMonth']==8) echo "selected";?>>August</option>
                    <option value="9" <?php if($row['StartMonth']==9) echo "selected";?>>September</option>
                    <option value="10" <?php if($row['StartMonth']==10) echo "selected";?>>October</option>
                    <option value="11" <?php if($row['StartMonth']==11) echo "selected";?>>November</option>
                    <option value="12" <?php if($row['StartMonth']==12) echo "selected";?>>December</option>
                  </select>
                    <select id="startday" name="StartDay">
                      <option value="0" <?php if($row['StartDay']==0) echo "selected";?>>0</option>
                      <option value="1" <?php if($row['StartDay']==1) echo "selected";?>>1</option>
                      <option value="2" <?php if($row['StartDay']==2) echo "selected";?>>2</option>
                      <option value="3" <?php if($row['StartDay']==3) echo "selected";?>>3</option>
                      <option value="4" <?php if($row['StartDay']==4) echo "selected";?>>4</option>
                      <option value="5" <?php if($row['StartDay']==5) echo "selected";?>>5</option>
                      <option value="6" <?php if($row['StartDay']==6) echo "selected";?>>6</option>
                      <option value="7" <?php if($row['StartDay']==7) echo "selected";?>>7</option>
                      <option value="8" <?php if($row['StartDay']==8) echo "selected";?>>8</option>
                      <option value="9" <?php if($row['StartDay']==9) echo "selected";?>>9</option>
                      <option value="10" <?php if($row['StartDay']==10) echo "selected";?>>10</option>
                      <option value="11" <?php if($row['StartDay']==11) echo "selected";?>>11</option>
                      <option value="12" <?php if($row['StartDay']==12) echo "selected";?>>12</option>
                      <option value="13" <?php if($row['StartDay']==13) echo "selected";?>>13</option>
                      <option value="14" <?php if($row['StartDay']==14) echo "selected";?>>14</option>
                      <option value="15" <?php if($row['StartDay']==15) echo "selected";?>>15</option>
                      <option value="16" <?php if($row['StartDay']==16) echo "selected";?>>16</option>
                      <option value="17" <?php if($row['StartDay']==17) echo "selected";?>>17</option>
                      <option value="18" <?php if($row['StartDay']==18) echo "selected";?>>18</option>
                      <option value="19" <?php if($row['StartDay']==19) echo "selected";?>>19</option>
                      <option value="20" <?php if($row['StartDay']==20) echo "selected";?>>20</option>
                      <option value="21" <?php if($row['StartDay']==21) echo "selected";?>>21</option>
                      <option value="22" <?php if($row['StartDay']==22) echo "selected";?>>22</option>
                      <option value="23" <?php if($row['StartDay']==23) echo "selected";?>>23</option>
                      <option value="24" <?php if($row['StartDay']==24) echo "selected";?>>24</option>
                      <option value="25" <?php if($row['StartDay']==25) echo "selected";?>>25</option>
                      <option value="26" <?php if($row['StartDay']==26) echo "selected";?>>26</option>
                      <option value="27" <?php if($row['StartDay']==27) echo "selected";?>>27</option>
                      <option value="28" <?php if($row['StartDay']==28) echo "selected";?>>28</option>
                      <option value="29" <?php if($row['StartDay']==29) echo "selected";?>>29</option>
                      <option value="30" <?php if($row['StartDay']==30) echo "selected";?>>30</option>
                      <option value="31" <?php if($row['StartDay']==31) echo "selected";?>>31</option>
                    </select>
                    <select id="startyear" name="StartYear">
                      <?php for($i= 1881; $i<=DIED_YEAR; $i++) { echo("<option value=\"$i\" "); if($row['StartYear']==$i) echo "selected"; echo(">$i</option>");}?>
                    </select>
                    <br/>
                    <input id="StartDateFlagLower" name="StartDateFlag" value="0" type="radio" <?php if($row['dateStartFlag']==0) echo "checked";?> />
                    <label for="StartDateFlagLower">Lower <small>(default)</small></label>
                &nbsp;&nbsp;&nbsp;
                    <input id="StartDateFlagUpper" name="StartDateFlag" value="1" type="radio" <?php if($row['dateStartFlag']==1) echo "checked";?> />
                    <label for="StartDateFlagUpper">Upper</label>
                </td>
			    </tr>
			  <tr>
                <td valign="top" class="Label"><label for="endmonth">Date End:</label>
                </td>
                <td><select id="endmonth" name="EndMonth" size="1">
                    <option value="0" <?php if($row['EndMonth']==0) echo "selected";?>>(Unknown)</option>
                    <option value="1" <?php if($row['EndMonth']==1) echo "selected";?>>January</option>
                    <option value="2" <?php if($row['EndMonth']==2) echo "selected";?>>February</option>
                    <option value="3" <?php if($row['EndMonth']==3) echo "selected";?>>March</option>
                    <option value="4" <?php if($row['EndMonth']==4) echo "selected";?>>April</option>
                    <option value="5" <?php if($row['EndMonth']==5) echo "selected";?>>May</option>
                    <option value="6" <?php if($row['EndMonth']==6) echo "selected";?>>June</option>
                    <option value="7" <?php if($row['EndMonth']==7) echo "selected";?>>July</option>
                    <option value="8" <?php if($row['EndMonth']==8) echo "selected";?>>August</option>
                    <option value="9" <?php if($row['EndMonth']==9) echo "selected";?>>September</option>
                    <option value="10" <?php if($row['EndMonth']==10) echo "selected";?>>October</option>
                    <option value="11" <?php if($row['EndMonth']==11) echo "selected";?>>November</option>
                    <option value="12" <?php if($row['EndMonth']==12) echo "selected";?>>December</option>
                  </select>
                    <select id="endday" name="EndDay">
                      <option value="0" <?php if($row['EndDay']==0) echo "selected";?>>0</option>
                      <option value="1" <?php if($row['EndDay']==1) echo "selected";?>>1</option>
                      <option value="2" <?php if($row['EndDay']==2) echo "selected";?>>2</option>
                      <option value="3" <?php if($row['EndDay']==3) echo "selected";?>>3</option>
                      <option value="4" <?php if($row['EndDay']==4) echo "selected";?>>4</option>
                      <option value="5" <?php if($row['EndDay']==5) echo "selected";?>>5</option>
                      <option value="6" <?php if($row['EndDay']==6) echo "selected";?>>6</option>
                      <option value="7" <?php if($row['EndDay']==7) echo "selected";?>>7</option>
                      <option value="8" <?php if($row['EndDay']==8) echo "selected";?>>8</option>
                      <option value="9" <?php if($row['EndDay']==9) echo "selected";?>>9</option>
                      <option value="10" <?php if($row['EndDay']==10) echo "selected";?>>10</option>
                      <option value="11" <?php if($row['EndDay']==11) echo "selected";?>>11</option>
                      <option value="12" <?php if($row['EndDay']==12) echo "selected";?>>12</option>
                      <option value="13" <?php if($row['EndDay']==13) echo "selected";?>>13</option>
                      <option value="14" <?php if($row['EndDay']==14) echo "selected";?>>14</option>
                      <option value="15" <?php if($row['EndDay']==15) echo "selected";?>>15</option>
                      <option value="16" <?php if($row['EndDay']==16) echo "selected";?>>16</option>
                      <option value="17" <?php if($row['EndDay']==17) echo "selected";?>>17</option>
                      <option value="18" <?php if($row['EndDay']==18) echo "selected";?>>18</option>
                      <option value="19" <?php if($row['EndDay']==19) echo "selected";?>>19</option>
                      <option value="20" <?php if($row['EndDay']==20) echo "selected";?>>20</option>
                      <option value="21" <?php if($row['EndDay']==21) echo "selected";?>>21</option>
                      <option value="22" <?php if($row['EndDay']==22) echo "selected";?>>22</option>
                      <option value="23" <?php if($row['EndDay']==23) echo "selected";?>>23</option>
                      <option value="24" <?php if($row['EndDay']==24) echo "selected";?>>24</option>
                      <option value="25" <?php if($row['EndDay']==25) echo "selected";?>>25</option>
                      <option value="26" <?php if($row['EndDay']==26) echo "selected";?>>26</option>
                      <option value="27" <?php if($row['EndDay']==27) echo "selected";?>>27</option>
                      <option value="28" <?php if($row['EndDay']==28) echo "selected";?>>28</option>
                      <option value="29" <?php if($row['EndDay']==29) echo "selected";?>>29</option>
                      <option value="30" <?php if($row['EndDay']==30) echo "selected";?>>30</option>
                      <option value="31" <?php if($row['EndDay']==31) echo "selected";?>>31</option>
                    </select>
                    <select id="endyear" name="EndYear">
                      <?php for($i= 1881; $i<=DIED_YEAR; $i++) { echo("<option value=\"$i\" "); if($row['EndYear']==$i) echo "selected"; echo(">$i</option>");}?>
                    </select>
                    <br/>
                    <input id="EndDateFlagLower" name="EndDateFlag" value="0" type="radio" <?php if($row['dateEndFlag']==0) echo "checked";?> />
                    <label for="EndDateFlagLower">Lower <small>(default)</small></label>
                &nbsp;&nbsp;&nbsp;
                    <input id="EndDateFlagUpper" name="EndDateFlag" value="1" type="radio" <?php if($row['dateEndFlag']==1) echo "checked";?> />
                    <label for="EndDateFlagUpper">Upper</label>
                </td>
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
			<button type="button" onclick="OnSaveModifiedForm('ModifyPoemEngine'); return false;" id="SaveButton">Save</button>
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
