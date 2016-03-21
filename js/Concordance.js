function OpenCloseImportExportBox(BoxName)
{
	var boxObj = document.getElementById(BoxName);
	
	if (boxObj.className == "BoxStateClosed")
		boxObj.className = "BoxStateOpen";
	else
		boxObj.className = "BoxStateClosed";
}

function AddCatalog()
{
	var counter = 0;
	var availCatalog = document.getElementById("AvailCatalogList");
	var currentCatalog = document.getElementById("CurrentColumnList");
	if(currentCatalog.options.length==11) {alert("You can not have more than 11 catalogs in the concordance table."); return 0;}
	for (counter = 0; counter < availCatalog.options.length; counter++)
	{
		if (availCatalog.options[counter].selected)
		{
			var option = document.createElement("option");
			try
			{
				currentCatalog.add(option, null);
			}
			catch (e)
			{
				currentCatalog.add(option, currentCatalog.length);
			}
			currentCatalog.options[currentCatalog.options.length - 1].value = availCatalog.options[counter].value;
			currentCatalog.options[currentCatalog.options.length - 1].text  = availCatalog.options[counter].text;
			availCatalog.remove(counter); counter=-1; 
		}
	}
}

function RemoveCatalog()
{
	var counter = 0;
	var currentCatalog = document.getElementById("CurrentColumnList");
	var availCatalog = document.getElementById("AvailCatalogList");
	
	for (counter = 0; counter < currentCatalog.options.length; counter++)
	{
		if (currentCatalog.options[counter].selected)
		{
			if(currentCatalog.options[counter].value=="OPP") { alert("The primary catalog 'OPP' can not be removed."); return 0;}
			
			var option = document.createElement("option");
			try
			{
				availCatalog.add(option, null);
			}
			catch (e)
			{
				availCatalog.add(option, availCatalog.length)
			}
			availCatalog.options[availCatalog.options.length - 1].value = currentCatalog.options[counter].value;
			availCatalog.options[availCatalog.options.length - 1].text  = currentCatalog.options[counter].text;
			sortAvailCatalog();
			currentCatalog.remove(counter); counter=-1; 
		}
	}
}

function sortAvailCatalog()
{   
      var   s   =   document.getElementById("AvailCatalogList").options;   
      var   ar   =   new   Array();   
      for(var   i=0;i<s.length;i++)   
          ar[i]   =   new   Array(s[i].text,s[i].value);   
      key   =   0;   
      ar.sort(cmd);   
      for(var   i=0;i<ar.length;i++)   
          s[i]   =   new   Option(ar[i][0],ar[i][1]);   
}   
  
function  cmd(a,b)   
{   
      if(a[key]   ==   b[key])   return   0;   
      return   a[key]>b[key]?1:-1;   
} 


function Move(step)
{
	var listObj = document.getElementById("CurrentColumnList");
	var counter = 0;
	var selected = -1;
	var tempValue = null;
	var tempText = null;
	var gradualStep = 0;
	
	for (counter = 0; counter < listObj.options.length; counter++)
	{
		if (listObj.options[counter].selected)
		{
				selected = counter;
		}
	}
	
	if ((selected + step >= 0) && (selected + step < listObj.options.length))
	{
		gradualStep = step < 0 ? -1 : 1;
		
		tempValue = listObj.options[selected].value;
		tempText  = listObj.options[selected].text;
		for (counter = selected; Math.abs(counter - (selected + step)) > 0; counter += gradualStep)
		{
			listObj.options[counter].value = listObj.options[counter + gradualStep].value;
			listObj.options[counter].text  = listObj.options[counter + gradualStep].text;
		}
		listObj.options[selected + step].value = tempValue;
		listObj.options[selected + step].text  = tempText;
		
		listObj.options[selected + step].selected = true;
		listObj.options[selected].selected = false;
	}
}

function SubmitCustomizeColumnsForm(href)
{
	//href = href.replace(/&page=\d\d/, '');
	//href = href.replace(/&page=\d/, '');
	
	var currentCatalog = document.getElementById("CurrentColumnList");
	
	catalogHref = currentCatalog.options[0].value;
	for (counter = 1; counter < currentCatalog.options.length; counter++)
	{
		catalogHref = catalogHref + '_' + currentCatalog.options[counter].value;
	}
	
	if(href.indexOf('&catalog')==-1) // not include the catalog this time
	{
	    href = href + '&catalog=' + catalogHref;
	}
	else
	{
       href = href.replace(/&catalog=[\S]+&/, '');
	   href = href.replace(/&catalog=[\S]+$/, '');
	   href = href + '&catalog=' + catalogHref;
	}
	
	window.location.replace(href);
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

function SubmitWorksAll(listFormName, viewName)
{
	var artworksFormObj = document.getElementById(listFormName);
       var strQueryString = "";
       var hasQueryString = document.URL.indexOf('?')
       if(hasQueryString != -1)
             {
                 strQueryString = document.URL.substring(hasQueryString+1, document.URL.length);
             } 
              var Variables = strQueryString.split("&");
		href = "index.php?view=" + viewName +  "&" + Variables[1];
              href = href + '&category=painting_watercolor_collage_gouache_photograph_pastel_sculpture_engraving_ceramic_lithograph_drawing_other';
		window.location.replace(href);
	
}

function SubmitWorksBack(listFormName, viewName)
{
	var artworksFormObj = document.getElementById(listFormName);
       var strQueryString = "";
       var hasQueryString = document.URL.indexOf('?')
       if(hasQueryString != -1)
             {
                 strQueryString = document.URL.substring(hasQueryString+1, document.URL.length);
             } 
              var Variables = strQueryString.split("&");
		href = "index.php?view=" + viewName +  "&" + Variables[1];
              href = href + '&category=painting_watercolor_collage_gouache_photograph_pastel_sculpture_engraving_ceramic_lithograph_drawing_other';
		window.location.replace(href);
	
}
