<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
	<title></title>
	<link type="text/css" rel="stylesheet" href="./css/tree.css">
	<script type="text/javascript" src="./js/tree.js"></script>
</head>
<body>
<?php
require_once(APMODULES_PATH.'linkIdTree.php');
$obj = new linkIdTree();
?>
	<div class="Hidden">
	    <table class="TreeStructure" cellspacing="0"><tbody><tr><td class="OpenClose"><img onclick="this.onclick = doClickTree; this.onclick(window.event);" title="" alt="+" class="Plus" src="./images/blank.gif" width="9" height="9"></td><td class="Content">People [3]</td></tr></tbody></table>
	    <blockquote>
		<?php $result = $obj->getData(3); while($row = mysql_fetch_array($result)) {  ?>
			<div class="Hidden"><table class="TreeStructure" cellspacing="0"><tbody><tr><td class="OpenClose"><div class="ExpandMate">&nbsp;</div></td><td class="Content"><?php echo $row['title']." [".$row['idLink']."]"?></td></tr></tbody></table></div>
	    <?php } ?>
		    <div class="Hidden"><table class="TreeStructure" cellspacing="0"><tbody><tr><td class="OpenClose"><div class="ExpandMate">&nbsp;</div></td><td class="Content"> </td></tr></tbody></table></div>
		</blockquote>
	</div>
	
	<div class="Hidden">
	    <table class="TreeStructure" cellspacing="0"><tbody><tr><td class="OpenClose"><img onclick="this.onclick = doClickTree; this.onclick(window.event);" title="" alt="+" class="Plus" src="./images/blank.gif" width="9" height="9"></td><td class="Content">Location (City) [8]</td></tr></tbody></table>
	    <blockquote>
		<?php $result = $obj->getData(8); while($row = mysql_fetch_array($result)) {  ?>			
			<div class="Hidden"><table class="TreeStructure" cellspacing="0"><tbody><tr><td class="OpenClose"><div class="ExpandMate">&nbsp;</div></td><td class="Content"><?php echo $row['title']." [".$row['idLink']."]"?></td></tr></tbody></table></div>
	    <?php } ?>	 
			<div class="Hidden"><table class="TreeStructure" cellspacing="0"><tbody><tr><td class="OpenClose"><div class="ExpandMate">&nbsp;</div></td><td class="Content"> </td></tr></tbody></table></div>   
		</blockquote>
	</div>
	
	<div class="Hidden">
	    <table class="TreeStructure" cellspacing="0"><tbody><tr><td class="OpenClose"><img onclick="this.onclick = doClickTree; this.onclick(window.event);" title="" alt="+" class="Plus" src="./images/blank.gif" width="9" height="9"></td><td class="Content">Location (Street, Plaza, etc.) [2]</td></tr></tbody></table>
		<blockquote>
		<?php $result = $obj->getData(2); while($row = mysql_fetch_array($result)) {  ?>			
			<div class="Hidden"><table class="TreeStructure" cellspacing="0"><tbody><tr><td class="OpenClose"><div class="ExpandMate">&nbsp;</div></td><td class="Content"><?php echo $row['title']." [".$row['idLink']."]"?></td></tr></tbody></table></div>
	    <?php } ?>	 
		    <div class="Hidden"><table class="TreeStructure" cellspacing="0"><tbody><tr><td class="OpenClose"><div class="ExpandMate">&nbsp;</div></td><td class="Content"> </td></tr></tbody></table></div>		   
		</blockquote>
	</div>
	
	<div class="Hidden">
	    <table class="TreeStructure" cellspacing="0"><tbody><tr><td class="OpenClose"><img onclick="this.onclick = doClickTree; this.onclick(window.event);" title="" alt="+" class="Plus" src="./images/blank.gif" width="9" height="9"></td><td class="Content">Museum [9]</td></tr></tbody></table>
	    <blockquote>
		<?php $result = $obj->getData(9); while($row = mysql_fetch_array($result)) {  ?>			
			<div class="Hidden"><table class="TreeStructure" cellspacing="0"><tbody><tr><td class="OpenClose"><div class="ExpandMate">&nbsp;</div></td><td class="Content"><?php echo $row['title']." [".$row['idLink']."]"?></td></tr></tbody></table></div>
	    <?php } ?>	 
			<div class="Hidden"><table class="TreeStructure" cellspacing="0"><tbody><tr><td class="OpenClose"><div class="ExpandMate">&nbsp;</div></td><td class="Content"> </td></tr></tbody></table></div>   
		</blockquote>
	</div>
	
	<div class="Hidden">
	    <table class="TreeStructure" cellspacing="0"><tbody><tr><td class="OpenClose"><img onclick="this.onclick = doClickTree; this.onclick(window.event);" title="" alt="+" class="Plus" src="./images/blank.gif" width="9" height="9"></td><td class="Content">Bibliography [1]</td></tr></tbody></table>
		<blockquote>
		<?php $result = $obj->getData(1); while($row = mysql_fetch_array($result)) {  ?>			
			<div class="Hidden"><table class="TreeStructure" cellspacing="0"><tbody><tr><td class="OpenClose"><div class="ExpandMate">&nbsp;</div></td><td class="Content"><?php echo $row['title']." [".$row['idLink']."]"?></td></tr></tbody></table></div>
	    <?php } ?>	 
			<div class="Hidden"><table class="TreeStructure" cellspacing="0"><tbody><tr><td class="OpenClose"><div class="ExpandMate">&nbsp;</div></td><td class="Content"> </td></tr></tbody></table></div>
		</blockquote>
	</div>
	
	<div class="Hidden">
	    <table class="TreeStructure" cellspacing="0"><tbody><tr><td class="OpenClose"><img onclick="this.onclick = doClickTree; this.onclick(window.event);" title="" alt="+" class="Plus" src="./images/blank.gif" width="9" height="9"></td><td class="Content">Text [4]</td></tr></tbody></table>
		<blockquote>
		<?php $result = $obj->getData(4); while($row = mysql_fetch_array($result)) {  ?>			
			<div class="Hidden"><table class="TreeStructure" cellspacing="0"><tbody><tr><td class="OpenClose"><div class="ExpandMate">&nbsp;</div></td><td class="Content"><?php echo $row['title']." [".$row['idLink']."]"?></td></tr></tbody></table></div>
	    <?php } ?>	
			<div class="Hidden"><table class="TreeStructure" cellspacing="0"><tbody><tr><td class="OpenClose"><div class="ExpandMate">&nbsp;</div></td><td class="Content"> </td></tr></tbody></table></div>    
		</blockquote>
	</div>
	
	<div class="Hidden">
	    <table class="TreeStructure" cellspacing="0"><tbody><tr><td class="OpenClose"><img onclick="this.onclick = doClickTree; this.onclick(window.event);" title="" alt="+" class="Plus" src="./images/blank.gif" width="9" height="9"></td><td class="Content">Artworks (non-OPP) [5]</td></tr></tbody></table>
		<blockquote>
		<?php $result = $obj->getData(5); while($row = mysql_fetch_array($result)) {  ?>			
			<div class="Hidden"><table class="TreeStructure" cellspacing="0"><tbody><tr><td class="OpenClose"><div class="ExpandMate">&nbsp;</div></td><td class="Content"><?php echo $row['title']." [".$row['idLink']."]"?></td></tr></tbody></table></div>
	    <?php } ?>		
			<div class="Hidden"><table class="TreeStructure" cellspacing="0"><tbody><tr><td class="OpenClose"><div class="ExpandMate">&nbsp;</div></td><td class="Content"> </td></tr></tbody></table></div>
		</blockquote>
	</div>
	
	<div class="Hidden">
		<table class="TreeStructure" cellspacing="0"><tbody><tr><td class="OpenClose"><img onclick="this.onclick = doClickTree; this.onclick(window.event);" title="" alt="+" class="Plus" src="./images/blank.gif" width="9" height="9"></td><td class="Content">Objects [10]</td></tr></tbody></table>
		<blockquote>
		<?php $result = $obj->getData(10); while($row = mysql_fetch_array($result)) {  ?>			
			<div class="Hidden"><table class="TreeStructure" cellspacing="0"><tbody><tr><td class="OpenClose"><div class="ExpandMate">&nbsp;</div></td><td class="Content"><?php echo $row['title']." [".$row['idLink']."]"?></td></tr></tbody></table></div>
	    <?php } ?>
			<div class="Hidden"><table class="TreeStructure" cellspacing="0"><tbody><tr><td class="OpenClose"><div class="ExpandMate">&nbsp;</div></td><td class="Content"> </td></tr></tbody></table></div>
		</blockquote>
	</div>
	
	<div class="Hidden">
		<table class="TreeStructure" cellspacing="0"><tbody><tr><td class="OpenClose"><img onclick="this.onclick = doClickTree; this.onclick(window.event);" title="" alt="+" class="Plus" src="./images/blank.gif" width="9" height="9"></td><td class="Content">Other [0]</td></tr></tbody></table>
		<blockquote>
		<?php $result = $obj->getData(0); while($row = mysql_fetch_array($result)) {  ?>
			<div class="Hidden"><table class="TreeStructure" cellspacing="0"><tbody><tr><td class="OpenClose"><div class="ExpandMate">&nbsp;</div></td><td class="Content"><?php echo $row['title']." [".$row['idLink']."]"?></td></tr></tbody></table></div>
	    <?php } ?>		
			<div class="Hidden"><table class="TreeStructure" cellspacing="0"><tbody><tr><td class="OpenClose"><div class="ExpandMate">&nbsp;</div></td><td class="Content"> </td></tr></tbody></table></div>
		</blockquote>
	</div>
</body></html>