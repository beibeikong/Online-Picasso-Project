<?php if ( ! defined('PROJECTNAME')) exit(''); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Biography Search - <?=PROJECTNAME?></title>
<link rel="stylesheet" href="./css/menu.css"/>
<script type="text/javascript" src="./js/menu.js"></script>
</head>

<body onload="Initialize('Biography Year Index'); AutoSizePopup();">
<table class="HeaderBar" cellspacing="0">
  <tr>
    <td class="Logo"><img src="./images/opp-emblem-corner.png" width="61" height="59" /></td>
    <td class="Title">Biography</td>
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
  	<td class="Inactive"><a href="index.php?view=MenuBiographyYear"><img src="./images/magnify-art.png"/>Chronology</a></td>
	<td class="Active"><img src="./images/magnify-text.png"/>Search</td>
	<td class="Inactive"><a href="index.php?view=GuideList" target="_top"><img src="./images/magnify-text.png"/>Overview</a></td>
	<td class="Inactive"><a href="index.php?view=MenuBiographyCalendar"><img src="./images/magnify-text.png"/>Calendar</a></td>
	<td class="EmptySpace">&nbsp;</td>
  </tr>
  
  <tr>
	<td class="Container" colspan="4">
	  <!----------------------- start search form----------------------->
	<form method="get" action="index.php" target="OPPMain" name="BiographySearchForm" id="BiographySearchForm">
	<input type="text" name="view" id="view" size="1" value="BioSearch" style=" display:none"/>
	<input type="text" name="page" id="page" size="1" value="1" style=" display:none"/>
	  <table class="SearchForm" id="BioSearch" cellspacing="0" align="center">
		<tr>
			<td class="fieldLabel"><strong>Keywords:</strong></td>
			<td class="fieldCtrls"><input type="text" name="Keywords" id="Keywords" size="35"/></td>
		</tr>
		<tr>
			<td class="fieldLabel"><label for="Keywords">Commentary:</label></td>
			<td class="fieldCtrls"><input type="text" name="Commentary" id="Commentary" size="28"/><input type="checkbox" name="Commentaryres" id="Commentaryres" value="yes"  onclick="disableCommentary(this.form)" /> any</td>		
		</tr>

		<tr>
			<td class="fieldLabel">Timeframe: </td>
			<td class="fieldCtrls">Search 
				<select size="1" name="SearchStyle" onchange="changeSearchBy(this.form);">
					<option value="Continuous" selected="true">continuously</option>
					<option value="Periodic">periodically</option>
				</select>
				by
				<select size="1" name="SearchBy" id="SearchBy" onchange="changeSearchBy(this.form)">
					<option value="monthday">month &amp; day</option>
					<option value="year">year</option>
					<option value="season">season</option>
					<option value="month">month</option>
				</select>
			<br/>
				<table cellspacing="2">
                  <tr>
                    <td align="right">Starting:</td>
                    <td><select size="1" name="StartSeason" style=" display:none" disabled="true" >
                        <option value="0">Early</option>
                        <option value="1">Spring</option>
                        <option value="2">Summer</option>
                        <option value="3">Autumn</option>
                        <option value="4">Winter</option>
                      </select>
                        <select size="1" name="StartMonth" id="StartMonth" onchange="resetMonth(this, 1)">
                          <option value="1">January</option>
                          <option value="2">February</option>
                          <option value="3">March</option>
                          <option value="4">April</option>
                          <option value="5">May</option>
                          <option value="6">June</option>
                          <option value="7">July</option>
                          <option value="8">August</option>
                          <option value="9">September</option>
                          <option value="10">October</option>
                          <option value="11">November</option>
                          <option value="12">December</option>
                        </select>
                        <select size="1" name="StartDay"   id="StartDay">
                          <option value="1"> 1</option>
                          <option value="2"> 2</option>
                          <option value="3"> 3</option>
                          <option value="4"> 4</option>
                          <option value="5"> 5</option>
                          <option value="6"> 6</option>
                          <option value="7"> 7</option>
                          <option value="8"> 8</option>
                          <option value="9"> 9</option>
                          <option value="10">10</option>
                          <option value="11">11</option>
                          <option value="12">12</option>
                          <option value="13">13</option>
                          <option value="14">14</option>
                          <option value="15">15</option>
                          <option value="16">16</option>
                          <option value="17">17</option>
                          <option value="18">18</option>
                          <option value="19">19</option>
                          <option value="20">20</option>
                          <option value="21">21</option>
                          <option value="22">22</option>
                          <option value="23">23</option>
                          <option value="24">24</option>
                          <option value="25">25</option>
                          <option value="26">26</option>
                          <option value="27">27</option>
                          <option value="28">28</option>
                          <option value="29">29</option>
                          <option value="30">30</option>
                          <option value="31">31</option>
                        </select>
                    </td>
                    <td>	<select size="1" name="StartYear"  id="StartYear">
							  <option value="1881" selected>1881</option>
							   <?php 
							    for($i= 1882; $i<=DIED_YEAR; $i++)
							      echo("<option value=\"$i\">$i</option>");
							  ?>
							</select>
                    </td>
                  </tr>
                  <tr>
                    <td align="right">Ending:</td>
                    <td><select size="1" name="EndSeason" style=" display:none" disabled="true">
                        <option value="0">Early</option>
                        <option value="1">Spring</option>
                        <option value="2">Summer</option>
                        <option value="3">Autumn</option>
                        <option value="4">Winter</option>
                      </select>
                        <select size="1" name="EndMonth" id="EndMonth" onchange="resetMonth(this, 2)">
                          <option value="1">January</option>
                          <option value="2">February</option>
                          <option value="3">March</option>
                          <option value="4">April</option>
                          <option value="5">May</option>
                          <option value="6">June</option>
                          <option value="7">July</option>
                          <option value="8">August</option>
                          <option value="9">September</option>
                          <option value="10">October</option>
                          <option value="11">November</option>
                          <option value="12" selected="selected">December</option>
                        </select>
                        <select size="1" name="EndDay"   id="EndDay">
                          <option value="1"> 1</option>
                          <option value="2"> 2</option>
                          <option value="3"> 3</option>
                          <option value="4"> 4</option>
                          <option value="5"> 5</option>
                          <option value="6"> 6</option>
                          <option value="7"> 7</option>
                          <option value="8"> 8</option>
                          <option value="9"> 9</option>
                          <option value="10">10</option>
                          <option value="11">11</option>
                          <option value="12">12</option>
                          <option value="13">13</option>
                          <option value="14">14</option>
                          <option value="15">15</option>
                          <option value="16">16</option>
                          <option value="17">17</option>
                          <option value="18">18</option>
                          <option value="19">19</option>
                          <option value="20">20</option>
                          <option value="21">21</option>
                          <option value="22">22</option>
                          <option value="23">23</option>
                          <option value="24">24</option>
                          <option value="25">25</option>
                          <option value="26">26</option>
                          <option value="27">27</option>
                          <option value="28">28</option>
                          <option value="29">29</option>
                          <option value="30">30</option>
                          <option value="31" selected="selected">31</option>
                        </select>
                    </td>
                    <td><select size="1" name="EndYear"  id="EndYear">
							<?php 
							  for($i= BORN_YEAR; $i<DIED_YEAR; $i++)
							    echo("<option value=\"$i\">$i</option>");
							?>
							<option value="1973" selected>1973</option>
						</select>
                    </td>
                  </tr>
                </table></td>
	</tr>
	<tr>
		<td class="fieldLabel">Sorting: </td>
		<td class="fieldCtrls">
			<input type="radio" value="asc"  name="Sort" id="SortAsc" checked="true"/><label for="SortAsc">Ascending</label>&nbsp;&nbsp;&nbsp;<input type="radio" value="desc" name="Sort" id="SortDesc"/><label for="SortDesc">Descending</label>
		</td>
	</tr>
	<tr>
		<td class="submitArea" colspan="2">
			<input type="submit" value="Search" id="FormSubmit"/>
			<input type="reset"  value="Reset"  id="FormReset"/>
		</td>
	</tr>
	</table>
	
	</form>
	  <!----------------------- end of search form----------------------->
	
	
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
