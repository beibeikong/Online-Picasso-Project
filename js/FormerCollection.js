/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



function refresh(href, param)
{
	href = href.replace(/&page=\d\d/, '');
	href = href.replace(/&page=\d/, '');
	if(href.indexOf(param)==-1) // include the category this time
	{
	  if(href.indexOf('category')==-1)
	    href = href + '&category=' + param;
	  else
	    href = href.replace(/&category=/, '&category=' + param + '_');
	    //href = href + '_' + param;
	}
	else
	{
       href = href.replace('_'+param, '');
	   href = href.replace(param+'_', '');
	   href = href.replace(param, '');
	   if(href.lastIndexOf('=')+1 == href.length)
	    href = href.replace(/&category=/, '');
	}
	
	window.location.replace(href);
}

function refreshQuarter(href, quarter)
{
	href = href.replace(/&page=\d\d/, '');
	href = href.replace(/&page=\d/, '');
	
	href = href.replace(/&quarter=\d/, '');

	href = href + '&quarter=' + quarter;
	
	window.location.replace(href);
}

function SubmitWorksBasketAdd(listFormName, viewName)
{
	var artworksFormObj = document.getElementById(listFormName);
	var OPPString = "";
	var counter = 0;
	var href = "";
	
	for (counter = 0; counter < artworksFormObj.elements.length; counter++)
	{
		if (artworksFormObj.elements.item(counter).checked)
		{
			OPPString += (OPPString.length > 0 ? "_" : "") + artworksFormObj.elements.item(counter).value;
		}
	}
	
	if (OPPString.length > 0)
	{
		href = "index.php?view=" + viewName + "&action=add&OPPs=" + OPPString;
		window.location.assign(href);
	}
	else
	{
		alert("You have not selected any artworks to add to the artwork series.");
	}
}

function SubmitWorksBasket(listFormName, viewName)
{
	var artworksFormObj = document.getElementById(listFormName);
	var OPPString = "";
	var counter = 0;
	var href = "index.php?view=" + viewName + "&action=add&OPPs=" + OPPString;
	window.location.assign(href);
}

function SubmitWorksBasketRemove(listFormName, viewName)
{
	var artworksFormObj = document.getElementById(listFormName);
	var OPPString = "";
	var counter = 0;
	var href = "";
	
	for (counter = 0; counter < artworksFormObj.elements.length; counter++)
	{
		if (artworksFormObj.elements.item(counter).checked)
		{
			OPPString += (OPPString.length > 0 ? "_" : "") + artworksFormObj.elements.item(counter).value;
		}
	}
	
	if (OPPString.length > 0)
	{
		href = "index.php?view=" + viewName + "&action=remove&OPPs=" + OPPString;
		window.location.replace(href);
	}
	else
	{
		alert("You have not selected any artworks to remove from the artwork series.");
	}
	
}

function OpenCloseImportExportBox(BoxName)
{
	var boxObj = document.getElementById(BoxName);
	
	if (boxObj.className == "BoxStateClosed")
		boxObj.className = "BoxStateOpen";
	else
		boxObj.className = "BoxStateClosed";
}

function ImportOPP(viewName)
{
	var ICatalog = document.getElementById("ICatalogIDs");
	var href = "";
	var OPPString = "";
	
	OPPString = ICatalog.value;
	OPPString = OPPString.replace(/\n/g, '_');

	
	if (OPPString.length > 0)
	{
		href = "index.php?view=" + viewName + "&action=import&OPPs=" + OPPString;
	    window.location.replace(href);
	}
	else
	{
		alert("You have not imported any artworks to the artwork series.");
	}
} 



function SubmitWorksCompare(listFormName, viewName)
{
	var artworksFormObj = document.getElementById(listFormName);
	var OPPString = "";
	var counter = 0;
	var href = "";
	var left = "";
	var right = "";
	var num = 0;
	var flag = 0;
	
	for (counter = 0; counter < artworksFormObj.elements.length; counter++)
	{
		if (artworksFormObj.elements.item(counter).checked)
		{
			num++;
			OPPString += (OPPString.length > 0 ? "_" : "") + artworksFormObj.elements.item(counter).value;
			if(num == 1)
			  left = artworksFormObj.elements.item(counter).value;
			else if(num == 2)
			  right = artworksFormObj.elements.item(counter).value;
		}
	}
	
	if(OPPString.length<13)
	{
		alert("You must select at least two artworks to be compared.");
		return false;
	}
	else
	{
		if( window.screen.height>820)
		  flag = 1; // resolution is above 1280*800
		else
		  flag = 0; // resolution is 1280*800 or 1024*768
		  
		href = "index.php?view=" + viewName + "&OPPs=" + OPPString + "&left=" + left + "&right=" + right + "&current=left&flag=" + flag;
		OpenWin(href, 'ArtworkCompare', 740, 700); return true;
	}

}
function checkAllButton(chk)
{  
    var text = document.getElementById("deselect").innerHTML;
	if (text=='Select') {
            if(chk.length>1){
                for (i = 0; i < chk.length; i++)
                {
                  chk[i].checked = true ;
                }
            }    
            else { chk.checked = true; }    
            document.getElementById("deselect").innerHTML='Deselect';
     } 
	 else
	 {
            if(chk.length>1){
                for (i = 0; i < chk.length; i++)
                {
                    chk[i].checked = false ;
                 } 
             }    
            else { chk.checked = false; }         
           document.getElementById("deselect").innerHTML='Select'; 
	 }
		 
}
function checkAll(ele,chk)
{  
	if (ele.checked) {
            for (i = 0; i < chk.length; i++)
            {
                chk[i].checked = true ;
            }

     } 
	 else
	 {
            for (i = 0; i < chk.length; i++)
            {
                chk[i].checked = false ;
            } 
	 }
		 
}
