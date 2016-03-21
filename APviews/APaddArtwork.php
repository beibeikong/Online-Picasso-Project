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
<title>Add Artwork - <?=PROJECTNAME?></title>
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
    <td class="Title">Add Artwork</td>
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
<table align="center" cellspacing="3">
  <tr>
    <td align="center" valign="top">
<!-------------- start left panel --------------------------->	
<div style="height:505px;overflow-x:hidden;overflow-y:auto;">
      <table class="TabContainer" id="SideBar" cellspacing="0" align="center">
		<tr class="Tabs">
		  <td class="Active"   id="TabLbl1Side"><a href="javascript:ChangeTabSide(1);"><img src="./images/magnify-text.png"/>Details</a></td>
                  <td class="Inactive" id="TabLbl2Side"><a href="javascript:ChangeTabSide(2);"><img src="./images/magnify-text.png"/>Former</a></td>
		<!-- <td class="EmptySpace">&nbsp;</td> -->
		</tr>
		<tr>
		  <td class="Container" colspan="2">
		  <div id="Tab1Side">
			<table class="DataEntry" cellspacing="2">
			  <tr>	
			    <td class="Label"><label for="catid">OPP:</label> </td>
				<td><input value="" size="15" id="catid" name="CatID" type="text">&nbsp;<input value="yes" id="notVerified" name="NotVerified" type="checkbox"><label for="notVerified">Unverified</label></td>
			  </tr>
			  <tr>	
			    <td class="Label"><label for="title">Title:</label> </td>
				<td><input value="" size="45" id="title" name="Title" type="text"></td>
			  </tr>
			  <tr>	
			    <td class="Label"><label for="location">Location:</label> </td>
			    <td><input value="" size="45" id="location" name="Location" type="text"></td>
			  </tr>
			  <tr>	
			    <td class="Label"><label for="duration">Duration:</label> </td>
				<td><input value="" size="45" id="duration" name="Duration" type="text"></td>
			  </tr>
			  <tr>	
			    <td valign="top" class="Label"><label for="startmonth">Date Start:</label> </td>
				<td>
				  <select id="startmonth" name="StartMonth">
                                      <option value="00">(Unknown)</option>
                                      <option value="01">January</option>
                                      <option value="02">February</option>
                                      <option value="03">March</option>
                                      <option value="04">April</option>
                                      <option value="05">May</option>
                                      <option value="06">June</option>
                                      <option value="07">July</option>
                                      <option value="08">August</option>
                                      <option value="09">September</option>
                                      <option value="10">October</option>
                                      <option value="11">November</option>
                                      <option value="12">December</option>
                                  </select>
				  <select id="startday" name="StartDay">
                                      <option value="00">0</option>
                                      <option value="01">1</option>
                                      <option value="02">2</option>
                                      <option value="03">3</option>
                                      <option value="04">4</option>
                                      <option value="05">5</option>
                                      <option value="06">6</option>
                                      <option value="07">7</option>
                                      <option value="08">8</option>
                                      <option value="09">9</option>
                                      <option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option></select>
				  <select id="startyear" name="StartYear"><?php for($i= 1881; $i<=DIED_YEAR; $i++) echo("<option value=\"$i\">$i</option>"); ?></select>
				  <br/>
				  <input id="StartDateFlagLower" name="StartDateFlag" value="0" type="radio" checked><label for="StartDateFlagLower">Lower <small>(default)</small></label>&nbsp;&nbsp;&nbsp;<input id="StartDateFlagUpper" name="StartDateFlag" value="1" type="radio"><label for="StartDateFlagUpper">Upper</label>
				</td>
			  </tr>
			  <tr>	
			    <td valign="top" class="Label"><label for="endmonth">Date End:</label> </td>
				<td>
				  <select id="endmonth" name="EndMonth" size="1">
                                      <option value="00">(Unknown)</option>
                                      <option value="01">January</option>
                                      <option value="02">February</option>
                                      <option value="03">March</option>
                                      <option value="04">April</option>
                                      <option value="05">May</option>
                                      <option value="06">June</option>
                                      <option value="07">July</option>
                                      <option value="08">August</option>
                                      <option value="09">September</option>
                                      <option value="10">October</option>
                                      <option value="11">November</option>
                                      <option value="12">December</option>
                                  </select>
				  <select id="endday" name="EndDay">
                                      <option value="00">0</option>
                                      <option value="01">1</option>
                                      <option value="02">2</option>
                                      <option value="03">3</option>
                                      <option value="04">4</option>
                                      <option value="05">5</option>
                                      <option value="06">6</option>
                                      <option value="07">7</option>
                                      <option value="08">8</option>
                                      <option value="09">9</option>
                                      <option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option></select>
				  <select id="endyear" name="EndYear"><?php for($i= 1881; $i<=DIED_YEAR; $i++) echo("<option value=\"$i\">$i</option>"); ?></select>
                  <br/>
			      <input id="EndDateFlagLower" name="EndDateFlag" value="0" type="radio" checked><label for="EndDateFlagLower">Lower <small>(default)</small></label>&nbsp;&nbsp;&nbsp;<input id="EndDateFlagUpper" name="EndDateFlag" value="1" type="radio"><label for="EndDateFlagUpper">Upper</label>
				</td>
			  </tr>
			  <tr>	
			    <td class="Label"><label for="medium">Medium:</label> </td>
				<td><input value="" size="45" id="medium" name="Medium" type="text"></td>
			  </tr>
			  <tr>	
			    <td class="Label"><label for="dimension">Dimensions:</label> </td>
				<td><input value="" size="45" id="dimension" name="Dimension" type="text"></td>
			  </tr>
			  <tr>	
			    <td class="Label"><label for="collection">Collection:</label> </td>
				<td><input value="" size="45" id="collection" name="Collection" type="text"></td>
			  </tr>
			  <tr>	
			    <td class="Label"><label for="inventory">Inventory:</label> </td>
				<td><input value="" size="45" id="inventory" name="Inventory" type="text"></td>
			  </tr>
              <tr>	
			    <td class="Label"><label for="category">Category:</label> </td>
				<td><select id="category" name="Category"><option value="painting" selected>painting</option><option value="collage">collage</option><option value="photograph">photograph</option><option value="sculpture">sculpture</option><option value="ceramic">ceramic</option><option value="drawing">drawing</option><option value="watercolor">watercolor</option><option value="gouache">gouache</option><option value="pastel">pastel</option><option value="engraving">engraving</option><option value="lithograph">lithograph</option><option value="other">other</option></select></td>
			  </tr>
              <tr>	
			    <td class="Label"><label for="extraimages">Extra Images:</label> </td>	
				<td><select id="extraimages" name="ExtraImages" size="1"><option selected="true" value="0">0</option><?php for($i= 1; $i<=200; $i++) echo("<option value=\"$i\">$i</option>"); ?></select></td>
			  </tr>
			  <tr>	
			    <td class="Label"><label for="catalog">Catalogs:</label> </td>
				<td><textarea  rows="4" id="catalog" name="Catalog" style="width:120px " ></textarea></td>
                            
			  </tr>
                            <tr>
                                 <td class="Label"><label for="bookCatalog">Books:</label> </td>
                                <td><textarea name="BookCatalog" id="bookCatalog" rows="4" style="width:120px "></textarea></td>
                            </tr> 
                             <tr>
                                <td class="Label"><label for="exhibition">Exhibitions:</label> </td>
                                <td><textarea name="Exhibitions" id="exhibition" rows="4" style="width:120px "></textarea></td>
                            </tr> 
                            
			</table>
		  </div>
                  <div id="Tab2Side" >
		  <table class="DataEntry" cellpadding="0"  cellspacing="0" >
		  	<tr><td>&nbspOrder&nbsp&nbsp</td><td>&nbspCollector Name</td><td>&nbspLocation</td><td>&nbspDate</td><td>&nbspAmount</td><td>#</td>
			</tr>
		 
			 <?php for($i=1;$i<=25;$i++) { ?>	
				<tr>	
			      <td class="Label"><label for="title"><? echo $i.' :';?></label> </td>
				  <td><input value="" size="20" id="collector<? echo $i;?>" name="Collector<? echo $i;?>" type="text"></td>
				  <td><input value="" size="5" id="location<? echo $i;?>" name="Location<? echo $i;?>" type="text"></td>
				  <td><input value="" size="5" id="date<? echo $i;?>" name="Date<? echo $i;?>" type="text"></td>
				  <td><input value="" size="7" id="amount<? echo $i;?>" name="Amount<? echo $i;?>" type="text"></td> 
				  <td><input value="" size="1" id="number<? echo $i;?>" name="Number<? echo $i;?>" type="text"></td> 
				<?php } ?>
		  </table> 
		</div>
		  </td>
		</tr>
	  </table>
   </div>
<!-------------- end left panel --------------------------->			  
	</td>

	<td align="center" valign="top">
<!-------------- start right panel --------------------------->	
 <table class="TabContainer" cellspacing="0" align="center">
	    <tr class="Tabs">
		  <td class="Active"   id="TabLbl1"><a href="javascript:ChangeTab(1);"><img src="./images/magnify-art.png" />Thumbnails</a></td>
		  <td class="Inactive" id="TabLbl2"><a href="javascript:ChangeTab(2);"><img src="./images/magnify-text.png"/>Notes</a></td>
		  <td class="Inactive" id="TabLbl3"><a href="javascript:ChangeTab(3);"><img src="./images/magnify-text.png"/>Commentary</a></td>
		  <td class="EmptySpace">&nbsp;</td>
		</tr>
		<tr>
		  <td class="Container" colspan="4">
		    <div id="Tab1"><center>Thumbnails are not available when adding a new artwork entry.</center></div>
		    <div id="Tab2"><textarea name="Notes" id="Notes" rows="24" cols="63"></textarea></div>
		    <div id="Tab3"><textarea name="Commentary" id="Commentary" rows="24" cols="63"></textarea></div>
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
			<button type="button" onclick="OnSaveForm('addArtworkEngine'); return false;" id="SaveButton">Save</button>
		  </td>
		</tr>
	  </table>
	</div>
	</td>
	<td>
	<div>
	  <button type="button" onclick="PreviewEntry(this.form, 'ArtworkInfo', 'ArtworkInfo', 740, 427)">Preview</button>
	  <button type="button" onclick="PreviewEntry(this.form, 'ArtworkNote', 'ArtworkNote', 740, 550)">Preview Notes</button>
	  <button type="button" onclick="PreviewEntry(this.form, 'ArtworkCommentary', 'ArtworkCommentary', 740, 550)">Preview Commentary</button>
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
