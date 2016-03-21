<?php if ( ! defined('PROJECTNAME')) exit(''); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Artworks Search - <?=PROJECTNAME?></title>
<link rel="stylesheet" href="./css/menu.css"/>
<script type="text/javascript" src="./js/menu.js"></script>
</head>

<body onload="Initialize('Biography Year Index'); AutoSizePopup();">
<?php


$SearchInOptions = "<option value=\"Title\">French Title</option><option value=\"Location\">Location</option><option value=\"Medium\">Medium</option><option value=\"Dimension\">Dimension</option><option value=\"Duration\">Duration</option>";

echo ("<script type=\"text/javascript\"> \n var Volumes = new Array();\n");

for($y=1889; $y<=1973; $y++) {$temp=$y%100; if($temp<10) $temp='0'.$temp; echo("'$temp',");}

echo ("];\n</script>");
mysql_data_seek ( $result, 0);
?>
<table class="HeaderBar" cellspacing="0">
  <tr>
    <td class="Logo"><img src="./images/opp-emblem-corner.png" width="61" height="59" /></td>
    <td class="Title">Lists Search</td>
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
	<td class="Active"><img src="./images/magnify-text.png"/>Search</td>
	<td class="EmptySpace">&nbsp;</td><td class="EmptySpace">&nbsp;</td><td class="EmptySpace">&nbsp;</td>
  </tr>

  <tr>
	<td class="Container" colspan="4">
	<!----------------------- start search form----------------------->
<form method="get" action="index.php" target="OPPMain" name="ArtworkSearchForm" id="ArtworkSearchForm">
	<input type="text" name="view" id="view" size="1" value="ArtworkList" style=" display:none"/>
	<input type="text" name="page" id="page" size="1" value="1" style=" display:none"/>
	<table class="SearchForm" id="WorkSearch" cellspacing="0" align="center" border="0">

    <!-- Starts catalog search -->
	<tr><td class="fieldLabel">Categories: </td>
		<td class="fieldCtrls">
			<table cellspacing="0">
				<tr>
                     <td width="82"><input name="CategorySearchIn1" id="CategorySearchIn1" type="checkbox" value="painting" checked="checked"  />
                     painting</td>
                     <td><input name="CategorySearchIn6" id="CategorySearchIn6" type="checkbox" value="drawing" checked="checked"  />
                     drawing</td>
                     <td><input name="CategorySearchIn8" id="CategorySearchIn8" type="checkbox" value="gouache" checked="checked"  />
                     gouache</td>
              	     <td><input name="CategorySearchIn9" id="CategorySearchIn9" type="checkbox" value="pastel" checked="checked"  />
              	     pastel</td><td><input type="checkbox" onchange="checkAll(this)" checked="checked" align="right"/></td>
             </tr>
             <tr>
                     <td><input name="CategorySearchIn7" id="CategorySearchIn7" type="checkbox" value="watercolor" checked="checked"  />
                     watercolor</td>
                     <td width="82"><input name="CategorySearchIn4" id="CategorySearchIn4" type="checkbox" value="sculpture" checked="checked"  />
                     sculpture</td>
                     <td width="82"><input name="CategorySearchIn2" id="CategorySearchIn2" type="checkbox" value="collage" checked="checked"  />
                     collage</td>
                     <td width="82"><input name="CategorySearchIn3" id="CategorySearchIn3" type="checkbox" value="photograph" checked="checked"  />
                     photograph</td>
              </tr>
              <tr>
                     <td><input name="CategorySearchIn10" id="CategorySearchIn10" type="checkbox" value="engraving" checked="checked"  />
                     engraving</td>
                     <td><input name="CategorySearchIn11" id="CategorySearchIn11" type="checkbox" value="lithograph" checked="checked"  />
                     lithograph</td>
                     <td><input name="CategorySearchIn5" id="CategorySearchIn5" type="checkbox" value="ceramic" checked="checked"  />
                     ceramic</td>
                     <td><input name="CategorySearchIn12" id="CategorySearchIn12" type="checkbox" value="other" checked="checked"  />
                     other</td>
         	</tr>			
			</table>
		</td>
	</tr>
	<!-- Ends catalog search -->

	<!-- Starts created search -->
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
					<td>Starting:</td>
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
					<td><select size="1" name="StartYear"  id="StartYear">
							<option value="1881" selected>1881</option>
							<?php
							for($i= 1882; $i<=DIED_YEAR; $i++)
							  echo("<option value=\"$i\">$i</option>");
							?>
						</select>
                    </td>
				</tr>
				<tr>
					<td>Ending:</td>
                    <td><select size="1" name="EndSeason" style=" display:none" disabled="true" >
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
							<option value="1973" selected="selected">1973</option>
						</select>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<!-- Ends created search -->

	<!-- Starts sorting 
	<tr><td class="fieldLabel">Sorting: </td>
		<td class="fieldCtrls">
			<table cellspacing="0">
				<tr><td>1. </td>
					<td>	<select size="1" name="SortBy1"><option>OPP</option><option>Chronology</option><option>Title</option><option>Location</option><option>Medium</option><option>Dimension</option><option>Collection</option><option>Category</option></select>
						<select size="1" name="CatalogSort1" id="CatalogSort1" style="display:none">
							<?php
							while($row = mysql_fetch_array($result))
							{
							  if($row['Catalog']!=$catalog)  // new catalog
							  {
							    $catalog = $row['Catalog'];
								echo("<option value=\"$catalog\" title=\"$row[CatalogName]\">$catalog</option>");
							  }
							}
							mysql_data_seek ( $result, 0);
							?>
						</select>
					</td>
					<td>	<input type="radio" value="Asc"  name="SortDirection1" id="Order1a" checked="true"/> <label for="Order1a"> Ascending</label>&nbsp;</td>
					<td>	<input type="radio" value="Desc" name="SortDirection1" id="Order1d"               /> <label for="Order1d"> Descending</label>	</td>
				</tr>
				<tr><td>2. </td>
					<td>	<select size="1" name="SortBy2"><option>OPP</option><option>Chronology</option><option>Title</option><option>Location</option><option>Medium</option><option>Dimension</option><option>Collection</option><option>Category</option></select>
					    <select size="1" name="CatalogSort2" id="CatalogSort2" style=" display:none">
							<?php
							while($row = mysql_fetch_array($result))
							{
							  if($row['Catalog']!=$catalog)  // new catalog
							  {
							    $catalog = $row['Catalog'];
								echo("<option value=\"$catalog\" title=\"$row[CatalogName]\">$catalog</option>");
							  }
							}
							mysql_data_seek ( $result, 0);
							?>
						</select>


					</td>
					<td>	<input type="radio" value="Asc"  name="SortDirection2" id="Order2a" checked="true"/> <label for="Order2a"> Ascending</label>&nbsp;	</td>
					<td>	<input type="radio" value="Desc" name="SortDirection2" id="Order2d"               /> <label for="Order2d"> Descending</label>	</td>
				</tr>
				<tr><td>3. </td>
					<td>	<select size="1" name="SortBy3"><option>OPP</option><option>Chronology</option><option>Title</option><option>Location</option><option>Medium</option><option>Dimension</option><option>Collection</option><option>Category</option></select>
					   <select size="1" name="CatalogSort3" id="CatalogSort3" style=" display:none">
							<?php
							while($row = mysql_fetch_array($result))
							{
							  if($row['Catalog']!=$catalog)  // new catalog
							  {
							    $catalog = $row['Catalog'];
								echo("<option value=\"$catalog\" title=\"$row[CatalogName]\">$catalog</option>");
							  }
							}
							mysql_data_seek ( $result, 0);
							?>
					  </select>


					</td>
					<td>	<input type="radio" value="Asc"  name="SortDirection3" id="Order3a" checked="true"/> <label for="Order3a"> Ascending</label>&nbsp;	</td>
					<td>	<input type="radio" value="Desc" name="SortDirection3" id="Order3d"               /> <label for="Order3d"> Descending</label>	</td>
				</tr>
			</table>
		</td>
	</tr>
	 Ends sorting -->

	<!-- Starts submit -->
	<tr><td class="submitArea" colspan="2">
			<input type="submit" value="Search" id="FormSubmit"/>
			<input type="reset"  value="Reset"  id="FormReset"/>
		</td>
	</tr>
	<!-- Ends submit -->

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
