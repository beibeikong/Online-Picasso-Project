<?php if ( ! defined('PROJECTNAME')) exit(''); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Exhibited Search - <?=PROJECTNAME?></title>
<link rel="stylesheet" href="./css/menu.css"/>
<script type="text/javascript" src="./js/menu.js"></script>
</head>

<body onload="Initialize('Biography Year Index'); AutoSizePopup();">
<?php 
$SearchInOptions = "<option value=\"Title\">Title<option value=\"Date\">Date<option value=\"Exhibitions\">Exhibit No.<option value=\"Books\">Book No.<option value=\"Catalogs\">Catalog No.</option></option><option value=\"Author\">Author</option><option value=\"Publisher\">Publisher</option><option value=\"Edition\">Edition</option><option value=\"Volume\">Volume</option><option value=\"Journal\">Journal</option><option value=\"Issue\">Issue</option>";
?>
<table class="HeaderBar" cellspacing="0">
  <tr>
    <td class="Logo"><img src="./images/opp-emblem-corner.png" width="61" height="59" /></td>
    <td class="Title">Exhibited</td>
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
  	<td class="Inactive"><a href="index.php?view=MenuReferencesLetter"><img src="./images/magnify-art.png"/>Letter Index</a></td>
	<td class="Inactive"><a href="index.php?view=MenuReferencesSearch"><img src="./images/magnify-text.png"/>Literature</a></td>
        <td class="Active"><img src="./images/magnify-text.png"/>Exhibited</a></td>
<!---	<td class="EmptySpace">&nbsp;</td> -->
  </tr>
  
  <tr>
	<td class="Container" colspan="3">

<form method="get" action="index.php" target="OPPMain" name="BiographySearchForm" id="BiographySearchForm">
	<input type="text" name="view" id="view" size="1" value="ExhibitSearch" style=" display:none"/>
	<input type="text" name="page" id="page" size="1" value="1" style=" display:none"/>
	  <table class="SearchForm" id="BioSearch" cellspacing="0" align="center">
		<tr>
			<td class="fieldLabel"><strong>Keywords:</strong></td>
			<td class="fieldCtrls">
			
			<table align="center" cellspacing="0">
					<tr><td>1.</td>	<td><input type="text" name="Keyword1" id="Keyword1" size="18"/> in <select size="1" name="SearchIn1" id="SearchIn1"><?=$SearchInOptions?></select></td></tr>
					<tr><td>2.</td>	<td><input type="text" name="Keyword2" id="Keyword2" size="18"/> in <select size="1" name="SearchIn2" id="SearchIn2"><?=$SearchInOptions?></select></td></tr>
					<tr><td>3.</td>	<td><input type="text" name="Keyword3" id="Keyword3" size="18"/> in <select size="1" name="SearchIn3" id="SearchIn3"><?=$SearchInOptions?></select></td></tr>
					<tr><td>4.</td>	<td><input type="text" name="Keyword4" id="Keyword4" size="18"/> in <select size="1" name="SearchIn4" id="SearchIn4"><?=$SearchInOptions?></select></td></tr>
					<tr><td>5.</td>	<td><input type="text" name="Keyword5" id="Keyword5" size="18"/> in <select size="1" name="SearchIn5" id="SearchIn5"><?=$SearchInOptions?></select></td></tr>
					<tr><td>6.</td>	<td><input type="text" name="Keyword6" id="Keyword6" size="18"/> in <select size="1" name="SearchIn6" id="SearchIn6"><?=$SearchInOptions?></select></td></tr>
					<tr><td>7.</td>	<td><input type="text" name="Keyword7" id="Keyword7" size="18"/> in <select size="1" name="SearchIn7" id="SearchIn7"><?=$SearchInOptions?></select></td></tr>
					<tr><td>8.</td>	<td><input type="text" name="Keyword7" id="Keyword7" size="18"/> in <select size="1" name="SearchIn7" id="SearchIn7"><?=$SearchInOptions?></select></td></tr>				
				</table>
			
			
			
			
			</td>
		</tr>
              <!-- Starts sorting -->
	<tr><td class="fieldLabel">Sorting: </td>
		<td class="fieldCtrls">
			<table cellspacing="0">
				<tr><td>1. </td>
					<td>	<select size="1" name="SortBy1"><option>Title</option><option>Date</option><option>Book No.</option><option>Exhibit No.</option><option>Catalog No.</option><option>Author</option></select>
						<select size="1" name="CatalogSort1" id="CatalogSort1" style="display:none">
						</select>
					</td>
					<td>	<input type="radio" value="Asc"  name="SortDirection1" id="Order1a" checked="true"/> <label for="Order1a"> Ascending</label>&nbsp;</td>
					<td>	<input type="radio" value="Desc" name="SortDirection1" id="Order1d"               /> <label for="Order1d"> Descending</label>	</td>
				</tr>
				<tr><td>2. </td>
					<td>	<select size="1" name="SortBy2"><option>Title</option><option>Date</option><option>Book No.</option><option>Exhibit No.</option><option>Catalog No.</option><option>Author</option></select>
					    <select size="1" name="CatalogSort2" id="CatalogSort2" style=" display:none">
							
						</select>


					</td>
					<td>	<input type="radio" value="Asc"  name="SortDirection2" id="Order2a" checked="true"/> <label for="Order2a"> Ascending</label>&nbsp;	</td>
					<td>	<input type="radio" value="Desc" name="SortDirection2" id="Order2d"               /> <label for="Order2d"> Descending</label>	</td>
				</tr>
                            <tr><td>3. </td>
					<td>	<select size="1" name="SortBy3"><option>Title</option><option>Date</option><option>Book No.</option><option>Exhibit No.</option><option>Catalog No.</option><option>Author</option></select>
					   <select size="1" name="CatalogSort3" id="CatalogSort3" style=" display:none">
							
					  </select>


					</td>
					<td>	<input type="radio" value="Asc"  name="SortDirection3" id="Order3a" checked="true"/> <label for="Order3a"> Ascending</label>&nbsp;	</td>
					<td>	<input type="radio" value="Desc" name="SortDirection3" id="Order3d"               /> <label for="Order3d"> Descending</label>	</td>
				</tr>
				
			</table>
		</td>
	</tr>
	<!-- Ends sorting -->
        
        
	<!-- Starts book search -->
	<tr><td class="fieldLabel">Date Range: </td>
		<td class="fieldCtrls">
			<table cellspacing="0">
				<tr>					
					<td>Start Year <input name="RefStartYear" id="RefStartYear" type="text"  size="4" />&nbsp;&nbsp;</td>
					<td>End Year   <input name="RefEndYear" id="RefEndYear" type="text"  size="4" /></td>
				</tr>
			</table>
		</td>
	</tr>
	<!-- Ends book search -->
	<tr>
		<td class="submitArea" colspan="2">
			<input type="submit" value="Search" id="FormSubmit"/>
			<input type="reset"  value="Reset"  id="FormReset"/>
		</td>
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
