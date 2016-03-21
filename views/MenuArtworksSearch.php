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
require_once(MODULES_PATH.'MenuArtworkSearch.php');
$obj = new MenuArtworkSearch();
$result = $obj->getData();

$SearchInOptions = "<option value=\"Title\">French Title</option><option value=\"Location\">Location</option><option value=\"Medium\">Medium</option><option value=\"Dimension\">Dimension</option><option value=\"Collection\">Collection</option><option value=\"inventory\">Inventory</option><option value=\"bookCatalog\">Books</option>";
$SearchAuctionOptions = "<option value=\"saletitle\">Sale Title</option><option value=\"source\">Source</option><option value=\"saledate\">Sale Date</option><option value=\"salenumber\">Sale Number</option><option value=\"lotnumber\">Lot Number</option><option value=\"lottitle\">Lot Title</option><option value=\"prelot\">Pre-Lot Text</option><option value=\"postlot\">Post-Lot Text</option><option value=\"estimateprice\">Estimate</option><option value=\"description\">Description</option><option value=\"literature\">Literature</option><option value=\"provenance\">Provenance</option><option value=\"exhibited\">Exhibited</option>";

echo ("<script type=\"text/javascript\"> \n var Volumes = new Array();\n");
$catalog = "";
$i=0;
while($row = mysql_fetch_array($result)){
 if($row['Volume']!="") {
  if($row['Catalog']!=$catalog)  // new catalog
  {
    if($i!=0) echo ("];\n"); else $i = 1;
	$catalog = $row['Catalog'];
	echo ("Volumes['$catalog'] = ['$row[Volume]'");
  }
  else
  {
    echo (",'$row[Volume]'");
  }
 }
}
echo ("];\nVolumes['OPP'] = [");
for($y=1889; $y<=1973; $y++) {$temp=$y%100; if($temp<10) $temp='0'.$temp; echo("'$temp',");}

echo ("];\n</script>");
mysql_data_seek ( $result, 0);
?>
<table class="HeaderBar" cellspacing="0">
  <tr>
    <td class="Logo"><img src="./images/opp-emblem-corner.png" width="61" height="59" /></td>
    <td class="Title">Artworks</td>
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
  	<td class="Inactive"><a href="index.php?view=MenuArtworksYear&category=painting_collage_photograph_sculpture_ceramic_drawing_watercolor_gouache_pastel_engraving_lithograph_other#"><img src="./images/magnify-art.png"/>Chronology</a></td>
	<td class="Active"><img src="./images/magnify-text.png"/>Search</td>
	<td class="Inactive"><a href="index.php?view=MenuArtworksConcordance&category=painting_watercolor_collage_gouache_photograph_pastel_sculpture_engraving_ceramic_lithograph_drawing_other"><img src="./images/magnify-text.png"/>Concordance</a></td>
	<td class="Inactive"><a href="index.php?view=MenuArtworksCalendar"><img src="./images/magnify-text.png"/>Calendar</a></td>
  </tr>

  <tr>
	<td class="Container" colspan="4">
	<!----------------------- start search form----------------------->
<form method="get" action="index.php" target="OPPMain" name="ArtworkSearchForm" id="ArtworkSearchForm">
	<input type="text" name="view" id="view" size="1" value="ArtworkCommSearch" style=" display:none"/>
	<input type="text" name="page" id="page" size="1" value="1" style=" display:none"/>
	<table class="SearchForm" id="WorkSearch" cellspacing="0" align="center" border="0">
	<!-- Starts keyword search -->
	<tr><td class="fieldLabel">Keywords: </td>
		<td class="fieldCtrls">
			<div class="ScrollArea" id="ArtworkKeywords">
				<table cellspacing="0" >
					<tr><td>1.</td>	<td><input type="text" name="Keyword1" id="Keyword1" size="25"/> in <select size="1" name="SearchIn1" id="SearchIn1" style="width:85px"><?=$SearchInOptions?></select></td></tr>
					<tr><td>2.</td>	<td><input type="text" name="Keyword2" id="Keyword2" size="25"/> in <select size="1" name="SearchIn2" id="SearchIn2" style="width:85px"><?=$SearchInOptions?></select></td></tr>
					<tr><td>3.</td>	<td><input type="text" name="Keyword3" id="Keyword3" size="25"/> in <select size="1" name="SearchIn3" id="SearchIn3" style="width:85px"><?=$SearchInOptions?></select></td></tr>
					<tr><td>4.</td>	<td><input type="text" name="Keyword4" id="Keyword4" size="25"/> in <select size="1" name="SearchIn4" id="SearchIn4" style="width:85px"><?=$SearchInOptions?></select></td></tr>
					<tr><td>5.</td>	<td><input type="text" name="Keyword5" id="Keyword5" size="25"/> in <select size="1" name="SearchIn5" id="SearchIn5" style="width:85px"><?=$SearchInOptions?></select></td></tr>
					<tr><td>6.</td>	<td><input type="text" name="Keyword6" id="Keyword6" size="25"/> in <select size="1" name="SearchIn6" id="SearchIn6" style="width:85px"><?=$SearchInOptions?></select></td></tr>
					<tr><td>7.</td>	<td><input type="text" name="Keyword7" id="Keyword7" size="25"/> in <select size="1" name="SearchIn7" id="SearchIn7" style="width:85px"><?=$SearchInOptions?></select></td></tr>
				</table>
			</div>
		</td> 
	</tr>
	<!-- Ends keyword search -->
	<!-- Starts auction search -->
	<tr><td class="fieldLabel">Notes: </td>
		<td class="fieldCtrls">
			<div class="ScrollArea" id="ArtworkKeywords">
			        <table cellspacing="0">
					<tr><td>1.</td>	<td><input type="text" name="AuctionKeyword1" id="AuctionKeyword1" size="25"/> in <select size="1" name="AuctionSearchIn1" id="AuctionSearchIn1" style="width:85px"><?=$SearchAuctionOptions?></select></td><td><input type="checkbox" name="NoteAll" id="NoteAll" value="yes"  onclick="disableNote(this.form)" align="right"/></td></tr>   
					<tr><td>2.</td>	<td><input type="text" name="AuctionKeyword2" id="AuctionKeyword2" size="25"/> in <select size="1" name="AuctionSearchIn2" id="AuctionSearchIn2" style="width:85px"><?=$SearchAuctionOptions?></select></td></tr>
					<tr><td>3.</td>	<td><input type="text" name="AuctionKeyword3" id="AuctionKeyword3" size="25"/> in <select size="1" name="AuctionSearchIn3" id="AuctionSearchIn3" style="width:85px"><?=$SearchAuctionOptions?></select></td></tr>
					<tr><td>4.</td>	<td><input type="text" name="AuctionKeyword4" id="AuctionKeyword4" size="25"/> in <select size="1" name="AuctionSearchIn4" id="AuctionSearchIn4" style="width:85px"><?=$SearchAuctionOptions?></select></td></tr>
					<tr><td>5.</td>	<td><input type="text" name="AuctionKeyword5" id="AuctionKeyword5" size="25"/> in <select size="1" name="AuctionSearchIn5" id="AuctionSearchIn5" style="width:85px"><?=$SearchAuctionOptions?></select></td></tr>
					<tr><td>6.</td>	<td><input type="text" name="AuctionKeyword6" id="AuctionKeyword6" size="25"/> in <select size="1" name="AuctionSearchIn6" id="AuctionSearchIn6" style="width:85px"><?=$SearchAuctionOptions?></select></td></tr>
					<tr><td>7.</td>	<td><input type="text" name="AuctionKeyword7" id="AuctionKeyword7" size="25"/> in <select size="1" name="AuctionSearchIn7" id="AuctionSearchIn7" style="width:85px"><?=$SearchAuctionOptions?></select></td></tr>
                                       
				</table>
                           
                </div>
                   
	</td>
        <!--    <tr>
                    
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="NoteAll" id="NoteAll" value="yes"  onclick="disableNote(this.form)" align="right"/></td>
                    
             </tr>  */-->
	</tr>

	<!-- Ends auction search -->
	<!-- Starts commentary search -->
	<tr><td class="fieldLabel">Commentary: </td>
		<td class="fieldCtrls">
			<table cellspacing="0">
			<tr>
			<td >&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="Commentary" id="Commentary" size="35"/></td>
			<td><input type="checkbox" name="Commentaryres" id="Commentaryres" value="yes"  onclick="disableCommentary(this.form)" />
			  any</td>
			</tr>
			</table>
		</td>
	</tr>
	<!-- Ends commentary search -->

	<!-- Starts catalog search -->
	<tr><td class="fieldLabel">Catalogs: </td>
		<td class="fieldCtrls">
			<table cellspacing="0">				<tr><td>ID </td>
					<td><select size="1" name="Catalog1" id="Catalog1" onchange="RefreshConcordanceVolumes(this.value, this.form.Volume1, this.form.Volume2, this.form.Number1, this.form.Number2, this.form.SortBy1);">
							<option value="OPP">All</option>
							<?php
							while($row = mysql_fetch_array($result))
							{
							  if($row['Catalog']!=$catalog)  // new catalog
							  {
							    $catalog = $row['Catalog'];
								echo("<option value=\"$catalog\" title=\"$row[CatalogName]\">$catalog</option>");
								if($catalog=='MPP') echo("<option value=\"OPP\" title=\"Online Picasso Project\">OPP</option>");
							  }
							}

							mysql_data_seek ( $result, 0);
							?>
						</select>&nbsp;&nbsp;
					</td>
					<td>Volume <select size="1" name="Volume1" id="Volume1" onchange="EnableConcordanceNumber(this.value, this.form.Catalog1.value, this.form.Number1);SynEnd(this.value,this.form.Volume2);"><option value="All">All</option></select>&nbsp;&nbsp;</td>
					<td>Number <input name="Number1" type="text"  size="1" maxlength="5" onchange="SynEnd(this.value,this.form.Number2);" />&nbsp;&nbsp;  </td>
                                        <td>Suffix <input name="Suffix1" type="text"  size="2" onchange="SynEnd(this.value,this.form.Suffix2);"/></td>
				</tr>
				<tr><td></td>
					<td>&nbsp;&nbsp;</td>
					<td>Volume <select size="1" name="Volume2" id="Volume2" onchange="EnableConcordanceNumber(this.value, this.form.Catalog1.value, this.form.Number2);"><option value="All">All</option></select>&nbsp;&nbsp; </td> 
					<td>Number <input name="Number2" type="text"  size="1" maxlength="5" />&nbsp;&nbsp; </td>
                                        <td>Suffix <input name="Suffix2" type="text"  size="2" /></td>

				</tr>
			</table>
		</td>
	</tr>
	<!-- Ends catalog search -->

	<!-- Starts book search -->
	<tr><td class="fieldLabel">Books: </td>
		<td class="fieldCtrls">
			<table cellspacing="0">
				<tr>
					<td>ID <input name="BookAuthor" type="text"  size="1" />&nbsp;&nbsp;</td>
					<td>Year   <input name="BookYear" type="text"  size="1" />&nbsp;&nbsp;</td>
					<td>Item   <input name="BookItem" type="text"  size="2" /></td>
				</tr>
			</table>
		</td>
	</tr>
	<!-- Ends book search -->	

       <!-- Starts category search -->
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
	<!-- Ends category search -->

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

	<!-- Starts sorting -->
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
	<!-- Ends sorting -->

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
