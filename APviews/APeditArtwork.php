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
<title>Modify Artwork - <?=PROJECTNAME?></title>
<link rel="stylesheet" href="./APcss/popup.css"/>
<link rel="stylesheet" href="./APcss/addArtworkEntry.css"/>
<script type="text/javascript" src="./APjs/popup.js"></script>
<link rel="icon" href="./images/opp.ico" type="image/x-icon">
<link rel="shortcut icon" href="./images/opp.ico" type="image/x-icon">
</head>

<body>
<?php
require_once(APMODULES_PATH.'ModifyArtwork.php');
$obj = new ModifyArtwork($_GET['opp']);
$row = $obj->getData();
?>
<table class="HeaderBar" cellspacing="0">
  <tr>
    <td class="Logo"><img src="./images/opp-emblem-corner.png" width="61" height="59" /></td>
    <td class="Title">Modify Artwork</td>
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
<form action="OPPAuthorV2WorksModifyDB" method="post" name="EntryForm" id="EntryForm" target="artwork" >
<input value="<?=$_GET['opp']?>" id="id" name="id" type="hidden">
<table align="center" cellspacing="3">
  <tr>
    <td align="center" valign="top">
<!-------------- start left panel --------------------------->	
<div style="height:505px;overflow-x:hidden;overflow-y:auto;">

      <table class="TabContainer" id="SideBar" cellspacing="0" align="center">
		<tr class="Tabs">
		  <td class="Active"   id="TabLbl1Side"><a href="javascript:ChangeTabSide(1);"><img src="./images/magnify-text.png"/>Details</a></td>
		  <td class="Inactive" id="TabLbl2Side"><a href="javascript:ChangeTabSide(2);"><img src="./images/magnify-text.png"/>LinkID</a></td>
		  <td class="Inactive" id="TabLbl3Side"><a href="javascript:ChangeTabSide(3);"><img src="./images/magnify-text.png"/>Former</a></td>
		</tr>
		<tr>
		  <td class="Container" colspan="3">
		  <div id="Tab1Side">
			<table class="DataEntry" cellspacing="2">
			  <tr>	
			    <td class="Label"><label for="catid">OPP:</label> </td>
				<td><input value="<?=$row['opp']?>" size="13" id="catid" name="CatID" type="text">
				&nbsp;<input value="yes" id="notVerified" name="NotVerified" type="checkbox" <?php if($row['notVerified']==1) echo "checked";?>><label for="notVerified">Unverified</label></td>
			  </tr>
			  <tr>	
			    <td class="Label"><label for="title">Title:</label> </td>
				<td><input value="<?=$row['title']?>" size="45" id="title" name="Title" type="text"></td>
			  </tr>
			  <tr>	
			    <td class="Label"><label for="location">Location:</label> </td>
			    <td><input value="<?=$row['location']?>" size="45" id="location" name="Location" type="text"></td>
			  </tr>
			  <tr>	
			    <td class="Label"><label for="duration">Duration:</label> </td>
				<td><input value="<?=$row['duration']?>" size="45" id="duration" name="Duration" type="text"></td>
			  </tr>
			  <tr>	
			    <td valign="top" class="Label"><label for="startmonth">Date Start:</label> </td>
				<td>
				  <select id="startmonth" name="StartMonth">
                                      <option value="00" <?php if($row['StartMonth']==0) echo "selected";?>>(Unknown)</option>
                                      <option value="01" <?php if($row['StartMonth']==1) echo "selected";?>>January</option>
                                      <option value="02" <?php if($row['StartMonth']==2) echo "selected";?>>February</option>
                                      <option value="03" <?php if($row['StartMonth']==3) echo "selected";?>>March</option>
                                      <option value="04" <?php if($row['StartMonth']==4) echo "selected";?>>April</option>
                                      <option value="05" <?php if($row['StartMonth']==5) echo "selected";?>>May</option>
                                      <option value="06" <?php if($row['StartMonth']==6) echo "selected";?>>June</option>
                                      <option value="07" <?php if($row['StartMonth']==7) echo "selected";?>>July</option>
                                      <option value="08" <?php if($row['StartMonth']==8) echo "selected";?>>August</option>
                                      <option value="09" <?php if($row['StartMonth']==9) echo "selected";?>>September</option>
                                      <option value="10" <?php if($row['StartMonth']==10) echo "selected";?>>October</option>
                                      <option value="11" <?php if($row['StartMonth']==11) echo "selected";?>>November</option>
                                      <option value="12" <?php if($row['StartMonth']==12) echo "selected";?>>December</option>
                                  </select>
				 
				  <select id="startday" name="StartDay">
                                      <option value="00" <?php if($row['StartDay']==0) echo "selected";?>>0</option>
                                      <option value="01" <?php if($row['StartDay']==1) echo "selected";?>>1</option>
                                      <option value="02" <?php if($row['StartDay']==2) echo "selected";?>>2</option>
                                      <option value="03" <?php if($row['StartDay']==3) echo "selected";?>>3</option>
                                      <option value="04" <?php if($row['StartDay']==4) echo "selected";?>>4</option>
                                      <option value="05" <?php if($row['StartDay']==5) echo "selected";?>>5</option>
                                      <option value="06" <?php if($row['StartDay']==6) echo "selected";?>>6</option>
                                      <option value="07" <?php if($row['StartDay']==7) echo "selected";?>>7</option>
                                      <option value="08" <?php if($row['StartDay']==8) echo "selected";?>>8</option>
                                      <option value="09" <?php if($row['StartDay']==9) echo "selected";?>>9</option>
                                      <option value="10" <?php if($row['StartDay']==10) echo "selected";?>>10</option>
				  <option value="11" <?php if($row['StartDay']==11) echo "selected";?>>11</option><option value="12" <?php if($row['StartDay']==12) echo "selected";?>>12</option><option value="13" <?php if($row['StartDay']==13) echo "selected";?>>13</option><option value="14" <?php if($row['StartDay']==14) echo "selected";?>>14</option><option value="15" <?php if($row['StartDay']==15) echo "selected";?>>15</option><option value="16" <?php if($row['StartDay']==16) echo "selected";?>>16</option><option value="17" <?php if($row['StartDay']==17) echo "selected";?>>17</option><option value="18" <?php if($row['StartDay']==18) echo "selected";?>>18</option><option value="19" <?php if($row['StartDay']==19) echo "selected";?>>19</option><option value="20" <?php if($row['StartDay']==20) echo "selected";?>>20</option>
				  <option value="21" <?php if($row['StartDay']==21) echo "selected";?>>21</option><option value="22" <?php if($row['StartDay']==22) echo "selected";?>>22</option><option value="23" <?php if($row['StartDay']==23) echo "selected";?>>23</option><option value="24" <?php if($row['StartDay']==24) echo "selected";?>>24</option><option value="25" <?php if($row['StartDay']==25) echo "selected";?>>25</option><option value="26" <?php if($row['StartDay']==26) echo "selected";?>>26</option><option value="27" <?php if($row['StartDay']==27) echo "selected";?>>27</option><option value="28" <?php if($row['StartDay']==28) echo "selected";?>>28</option><option value="29" <?php if($row['StartDay']==29) echo "selected";?>>29</option><option value="30" <?php if($row['StartDay']==30) echo "selected";?>>30</option><option value="31" <?php if($row['StartDay']==31) echo "selected";?>>31</option></select>
				  
				  <select id="startyear" name="StartYear"><?php for($i= 1881; $i<=DIED_YEAR; $i++) { echo("<option value=\"$i\" "); if($row['StartYear']==$i) echo "selected"; echo(">$i</option>");}?></select>
				  <br/>
				  <input id="StartDateFlagLower" name="StartDateFlag" value="0" type="radio" <?php if($row['dateStartFlag']==0) echo "checked";?>><label for="StartDateFlagLower">Lower <small>(default)</small></label>&nbsp;&nbsp;&nbsp;<input id="StartDateFlagUpper" name="StartDateFlag" value="1" type="radio" <?php if($row['dateStartFlag']==1) echo "checked";?>><label for="StartDateFlagUpper">Upper</label>
				</td>
			  </tr>
			  <tr>	
			    <td valign="top" class="Label"><label for="endmonth">Date End:</label> </td>
				<td>
				  <select id="endmonth" name="EndMonth" size="1">
                                      <option value="00" <?php if($row['EndMonth']==0) echo "selected";?>>(Unknown)</option>
                                      <option value="01" <?php if($row['EndMonth']==1) echo "selected";?>>January</option>
                                      <option value="02" <?php if($row['EndMonth']==2) echo "selected";?>>February</option>
                                      <option value="03" <?php if($row['EndMonth']==3) echo "selected";?>>March</option>
                                      <option value="04" <?php if($row['EndMonth']==4) echo "selected";?>>April</option>
                                      <option value="05" <?php if($row['EndMonth']==5) echo "selected";?>>May</option>
                                      <option value="06" <?php if($row['EndMonth']==6) echo "selected";?>>June</option>
                                      <option value="07" <?php if($row['EndMonth']==7) echo "selected";?>>July</option>
                                      <option value="08" <?php if($row['EndMonth']==8) echo "selected";?>>August</option>
                                      <option value="09" <?php if($row['EndMonth']==9) echo "selected";?>>September</option>
                                      <option value="10" <?php if($row['EndMonth']==10) echo "selected";?>>October</option>
                                      <option value="11" <?php if($row['EndMonth']==11) echo "selected";?>>November</option>
                                      <option value="12" <?php if($row['EndMonth']==12) echo "selected";?>>December</option>
                                  </select>
				 
				  <select id="endday" name="EndDay">
                                      <option value="00" <?php if($row['EndDay']==0) echo "selected";?>>0</option>
                                      <option value="01" <?php if($row['EndDay']==1) echo "selected";?>>1</option>
                                      <option value="02" <?php if($row['EndDay']==2) echo "selected";?>>2</option>
                                      <option value="03" <?php if($row['EndDay']==3) echo "selected";?>>3</option>
                                      <option value="04" <?php if($row['EndDay']==4) echo "selected";?>>4</option>
                                      <option value="05" <?php if($row['EndDay']==5) echo "selected";?>>5</option>
                                      <option value="06" <?php if($row['EndDay']==6) echo "selected";?>>6</option>
                                      <option value="07" <?php if($row['EndDay']==7) echo "selected";?>>7</option>
                                      <option value="08" <?php if($row['EndDay']==8) echo "selected";?>>8</option>
                                      <option value="09" <?php if($row['EndDay']==9) echo "selected";?>>9</option>
                                      <option value="10" <?php if($row['EndDay']==10) echo "selected";?>>10</option>
				  <option value="11" <?php if($row['EndDay']==11) echo "selected";?>>11</option><option value="12" <?php if($row['EndDay']==12) echo "selected";?>>12</option><option value="13" <?php if($row['EndDay']==13) echo "selected";?>>13</option><option value="14" <?php if($row['EndDay']==14) echo "selected";?>>14</option><option value="15" <?php if($row['EndDay']==15) echo "selected";?>>15</option><option value="16" <?php if($row['EndDay']==16) echo "selected";?>>16</option><option value="17" <?php if($row['EndDay']==17) echo "selected";?>>17</option><option value="18" <?php if($row['EndDay']==18) echo "selected";?>>18</option><option value="19" <?php if($row['EndDay']==19) echo "selected";?>>19</option><option value="20" <?php if($row['EndDay']==20) echo "selected";?>>20</option>
				  <option value="21" <?php if($row['EndDay']==21) echo "selected";?>>21</option><option value="22" <?php if($row['EndDay']==22) echo "selected";?>>22</option><option value="23" <?php if($row['EndDay']==23) echo "selected";?>>23</option><option value="24" <?php if($row['EndDay']==24) echo "selected";?>>24</option><option value="25" <?php if($row['EndDay']==25) echo "selected";?>>25</option><option value="26" <?php if($row['EndDay']==26) echo "selected";?>>26</option><option value="27" <?php if($row['EndDay']==27) echo "selected";?>>27</option><option value="28" <?php if($row['EndDay']==28) echo "selected";?>>28</option><option value="29" <?php if($row['EndDay']==29) echo "selected";?>>29</option><option value="30" <?php if($row['EndDay']==30) echo "selected";?>>30</option><option value="31" <?php if($row['EndDay']==31) echo "selected";?>>31</option></select>
				 
				  <select id="endyear" name="EndYear"><?php for($i= 1881; $i<=DIED_YEAR; $i++) { echo("<option value=\"$i\" "); if($row['EndYear']==$i) echo "selected"; echo(">$i</option>");}?></select>
                  <br/>
			      <input id="EndDateFlagLower" name="EndDateFlag" value="0" type="radio" <?php if($row['dateEndFlag']==0) echo "checked";?>><label for="EndDateFlagLower">Lower <small>(default)</small></label>&nbsp;&nbsp;&nbsp;<input id="EndDateFlagUpper" name="EndDateFlag" value="1" type="radio" <?php if($row['dateEndFlag']==1) echo "checked";?>><label for="EndDateFlagUpper">Upper</label>
				</td>
			  </tr>
			  <tr>	
			    <td class="Label"><label for="medium">Medium:</label> </td>
				<td><input value="<?=$row['medium']?>" size="45" id="medium" name="Medium" type="text"></td>
			  </tr>
			  <tr>	
			    <td class="Label"><label for="dimension">Dimensions:</label> </td>
				<td><input value="<?=$row['dimension']?>" size="45" id="dimension" name="Dimension" type="text"></td>
			  </tr>
			  <tr>	
			    <td class="Label"><label for="collection">Collection:</label> </td>
				<td><input value="<?=$row['collection']?>" size="45" id="collection" name="Collection" type="text"></td>
			  </tr>
			  <tr>	
			    <td class="Label"><label for="inventory">Inventory:</label> </td>
				<td><input value="<?=$row['inventory']?>" size="45" id="inventory" name="Inventory" type="text"></td>
			  </tr>
              <tr>	
			    <td class="Label"><label for="category">Category:</label> </td>
				<td><select id="category" name="Category">
				<option value="painting" <?php if($row['category']=="painting") echo "selected";?>>painting</option>
				<option value="collage" <?php if($row['category']=="collage") echo "selected";?>>collage</option>
				<option value="photograph" <?php if($row['category']=="photograph") echo "selected";?>>photograph</option>
				<option value="sculpture" <?php if($row['category']=="sculpture") echo "selected";?>>sculpture</option>
				<option value="ceramic" <?php if($row['category']=="ceramic") echo "selected";?>>ceramic</option>
				<option value="drawing" <?php if($row['category']=="drawing") echo "selected";?>>drawing</option>
				<option value="watercolor" <?php if($row['category']=="watercolor") echo "selected";?>>watercolor</option>
				<option value="gouache" <?php if($row['category']=="gouache") echo "selected";?>>gouache</option>
				<option value="pastel" <?php if($row['category']=="pastel") echo "selected";?>>pastel</option>
				<option value="engraving" <?php if($row['category']=="engraving") echo "selected";?>>engraving</option>
				<option value="lithograph" <?php if($row['category']=="lithograph") echo "selected";?>>lithograph</option>
				<option value="other" <?php if($row['category']=="other") echo "selected";?>>other</option></select></td>
			  </tr>
              <tr>	
			    <td class="Label"><label for="extraimages">Extra Images:</label> </td>	
				<td><select id="extraimages" name="ExtraImages" size="1"><?php for($i=0; $i<=200; $i++) { echo("<option value=\"$i\" "); if($row['extraImages']==$i) echo "selected"; echo(">$i</option>");}?></select></td>
			  </tr>
			  <tr>	
			    <td class="Label"><label for="catalog">Catalogs:</label> </td>
				<td><textarea  rows="4" id="catalog" name="Catalog" style="width:120px " ><?php $result1 = $obj->getCatalog($row['opp']); foreach($result1 as $cata) if(trim($cata)!="") echo("\n".$cata);?></textarea></td>
			  </tr>
                            <tr>
                                 <td class="Label"><label for="bookCatalog">Books:</label> </td>
                                <td><textarea name="BookCatalog" id="bookCatalog" rows="4" style="width:120px "><?php if($row['bookCatalog']!='') echo str_ireplace("; ", "\n", $row['bookCatalog']);?></textarea></td>
                            </tr> 
                             <tr>
                                <td class="Label"><label for="Exhibitions">Exhibitions:</label> </td>
                                <td><textarea name="Exhibitions" id="exhibition" rows="4" style="width:120px "><?php if($row['exhibition']!='') echo str_ireplace("; ", "\n", $row['exhibition']);?></textarea></td>
                            </tr> 
			</table>
		  </div>
		  <div id="Tab2Side">
			  <iframe id="noteiframe" class="iframeNote" src="AuthorIndex.php?view=linkIdTree"  width="270px" height="420px"  scrolling="auto" frameborder="0"></iframe>
		</div>
		<div id="Tab3Side" >
		  <table class="DataEntry" cellpadding="0"  cellspacing="0" >
		  	<tr><td>&nbspOrder&nbsp&nbsp</td><td>&nbspCollector Name</td><td>&nbspLocation</td><td>&nbspDate</td><td>&nbspAmount</td><td>#</td>
			</tr>
		  <?php $result2 = $obj->getFormer($row['opp']);
			$i=1;
			  while ($row2 = mysql_fetch_array($result2)) {?>
				<tr>	
			      <td class="Label"><label for="title"><? echo $i.' :';?></label> </td>
				  <td><input value="<?=$row2['collector']?>" size="20" id="collector<? echo $i;?>" name="Collector<? echo $i;?>" type="text"></td>
				  <td><input value="<?=$row2['location']?>" size="5" id="location<? echo $i;?>" name="Location<? echo $i;?>" type="text"></td>
				  <td><input value="<?=$row2['date']?>" size="5" id="date<? echo $i;?>" name="Date<? echo $i;?>" type="text"></td>
				  <td><input value="<?=$row2['amount']?>" size="7" id="amount<? echo $i;?>" name="Amount<? echo $i;?>" type="text"></td>
				  <td><input value="<?=$row2['num']?>" size="1" id="number<? echo $i;?>" name="Number<? echo $i;?>" type="text"></td>
			    </tr> 
			   <?php $i++;}
			   for($i;$i<=25;$i++) { ?>	
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
		  <td class="Inactive" id="TabLbl4"><a href="javascript:ChangeTab(4);"><img src="./images/magnify-text.png"/>OPPs</a></td>
		</tr>
		<tr>
		  <td class="Container" colspan="4">
		    <div id="Tab1">
			<table align="center" cellspacing="5">
			  <tr align="left" valign="top">
				<td>X-Thumbnail:</td>
				<td>Y-Thumbnail:</td>
			  </tr>
			  <tr align="left" valign="top">
				<td><a href="./AuthorIndex.php?view=zoom&random=<?=$row['StartYear']*23?>&alpha=<?=$obj->imgName($row['opp'])?>.jpg" target="_blank" onclick="PreviewEntry(this.form, 'zoom', 'zoom', 850, 600)"><img src="../graphics/<?=$row['StartYear']?>/xthumbs/x<?=$obj->imgName($row['opp'])?>.jpg" class="imageStyle"/></td>
				<td><a href="./AuthorIndex.php?view=zoom&random=<?=$row['StartYear']*23?>&alpha=<?=$obj->imgName($row['opp'])?>.jpg" target="_blank" onclick="PreviewEntry(this.form, 'zoom', 'zoom', 850, 600)"><img src="../graphics/<?=$row['StartYear']?>/ythumbs/y<?=$obj->imgName($row['opp'])?>.jpg" class="imageStyle"/></td>
			  </tr>
			</table>
			</div>
		    <div id="Tab2"><textarea name="Notes" id="Notes" rows="24" cols="63"><?=$row['notes']?></textarea></div>
		    <div id="Tab3"><textarea name="Commentary" id="Commentary" rows="24" cols="63"><?=$row['commentary']?></textarea></div>
			<div id="Tab4"><textarea name="Opps" id="Opps" rows="24" cols="63"><?php $result1 = $obj->getOPP($row['opp']); foreach($result1 as $opp) echo($opp."; "); ?></textarea></div>
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
			<button type="button" onclick="OnSaveModifiedArtworkForm('ModifyArtworkEngine'); return false;" id="SaveButton">Save</button>
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
