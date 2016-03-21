function Initialize(PageName)
{
	var formObj;
	var controlObj;
	if (window.name != "OPPFloatingMenu")
		document.getElementById("Copyright").style.display = "block";
	if (PageName == "Biography Search")
	{
		formObj = document.getElementById("BiographySearchForm");
		controlObj = document.getElementById("Keywords");
		changeSearchBy(formObj);
		controlObj.focus();
	}
	else if (PageName == "Artwork Search")
	{
		formObj = document.getElementById("ArtworkSearchForm");
		controlObj = document.getElementById("Keyword1");
		var cat1Obj = document.getElementById("Catalog1");
		var cat2Obj = document.getElementById("Catalog2");
		RefreshVolumes(cat1Obj.value, formObj.Volume1);
		RefreshVolumes(cat2Obj.value, formObj.Volume2);
		changeSearchBy(formObj);
		controlObj.focus();
	}
	else if (PageName == "Archives Search")
	{
		formObj = document.getElementById("ArchivesSearchForm");
		controlObj = document.getElementById("Keywords");
		CheckYear(formObj);
		CheckPublisher(formObj);
		CheckLang(formObj);
		CheckDateType(formObj);
		controlObj.focus();
	}
	else if (PageName == "References Search")
	{
		document.getElementById("Keyword1").focus();
	}
}




function AutoSizePopup()
{
	var viewableHeight = 0;
	var counter = 0;
	
	if (window.name == "OPPFloatingMenu")
		window.parent.document.getElementById("OPPFloatingMenu").style.height = (document.body.scrollHeight - 40) + "px";
	else
	{
		// Workaround fix for Firefox 1.0.x (not necessary for v1.5)
		for (counter = 1; counter <= 50; counter++)
			window.resizeBy(0, (document.body.scrollHeight - document.documentElement.clientHeight) / 2);
		window.resizeBy(0, document.body.scrollHeight - document.documentElement.clientHeight);
	}
}

function OpenWin(address, winName, width, height)
{
	var newLeft = (window.screen.availWidth - width) / 2;
	var objPopup = window.open(address, winName, 'width=' + width + ',height=' + height + ',top=' + 100 + ',left=' + newLeft + ',menubar=no,toolbar=no,scrollbars=yes,resizable=yes,directories=no,status=yes');
	objPopup.focus();
}

function ClosePopup()
{
	if (window.name == "OPPFloatingMenu")
	{
		window.parent.document.getElementById("OPPFloatingMenuContainer").style.display = "none";
		window.parent.document.getElementById("OPPFloatingMenu").src = "";
	}
	else
		window.close();
}

function check()
{
	var Mlink = document.getElementById("MWClink");
	var tempID;
	var i;
	var form = document.getElementById("form1");
	if(form.language[0].checked==true)
	{ 
	  for(i=1;i<=56;i++)
	  { tempID="MWClink"+i;
	    Mlink=document.getElementById(tempID);
		Mlink.href = Mlink.href.replace("&lan=spa", '');
		Mlink.href = Mlink.href.replace("&lan=fre", '');
	    Mlink.href = Mlink.href + "&lan=spa";
	  }
	}
	else if(form.language[1].checked==true)
	{ 
	  for(i=1;i<=56;i++)
	  { tempID="MWClink"+i;
	    Mlink=document.getElementById(tempID);
		Mlink.href = Mlink.href.replace("&lan=spa", '');
		Mlink.href = Mlink.href.replace("&lan=fre", '');
	    Mlink.href = Mlink.href + "&lan=fre";
	  }
	}
}

function resetMonth(thisObj, Num)
{
	var i = 0;
	var amountDays = 0;
	var selectObj;
	var formObj = thisObj.form;
	var what    = thisObj.value;
	
	if (what == 1 || what == 3 || what == 5 ||
	    what == 7 || what == 8 || what == 10 ||
	    what == 12)
		amountDays = 31;
	else if (what == 2)
		amountDays = 29;
	else
		amountDays = 30;
	
	selectObj = (Num == 1) ? formObj.StartDay : formObj.EndDay;
	selectObj.length = amountDays;
	
	for (i = 1; i <= amountDays; i++)
		selectObj.options[i - 1].text = i;
}

function changeSearchBy(formObj)
{
	var bySeason         = (formObj.SearchBy.value == "season");
	var byMonth          = (formObj.SearchBy.value == "month");
	var byMonthDay       = (formObj.SearchBy.value == "monthday");
	var searchContinuous = (formObj.SearchStyle.value == "Continuous");
	var searchSeason     = (formObj.SearchStyle.value == "Periodic");
	
	// Starting date controls.
	Disp(formObj.StartSeason, bySeason);
	Disp(formObj.StartMonth,  (byMonth || byMonthDay));
	Disp(formObj.StartDay,    byMonthDay);
	
	// Ending date controls.
	Disp(formObj.EndSeason, (searchContinuous && bySeason));
	Disp(formObj.EndMonth,  (searchContinuous && (byMonth || byMonthDay)));
	Disp(formObj.EndDay,    (searchContinuous && byMonthDay));
}
function Disp(inputObj, YesOrNo)
{
	inputObj.disabled = !YesOrNo;
	inputObj.style.display = (YesOrNo ? "inline" : "none");
}

function disableCommentary(formObj)
{
	var flag = formObj.Commentaryres.checked;
	  DisC(formObj.Commentary, flag);

}
function DisC(inputObj, YesOrNo)
{
	  inputObj.disabled = YesOrNo;
}

function RefreshVolumes(catalogName, optionObject)
{
	
	var counter = 0;
	
	if (Volumes[catalogName])
		if (Volumes[catalogName].length > 0)
		{
			optionObject.length = Volumes[catalogName].length + 1;
			
			for (counter = 0; counter <= Volumes[catalogName].length - 1; counter++)
				optionObject.options[counter + 1].text = Volumes[catalogName][counter];
			return;
		}
	
	optionObject.length = 1;
	optionObject.options[0].text = "All";
	optionObject.options[0].value = "All";
}

function check1(formObj)
{
	var K = document.getElementById("BioSearchK");
	var M = document.getElementById("BioSearchM");
	var KField = document.getElementById("Keyword");
	var MField = document.getElementById("morph");
	var view = document.getElementById("view");
	var form = document.getElementById("BiographySearchForm");
	
	
	if(form.searchType[0].checked==true)
	{ 
       M.style.display = "none";
	   K.style.display = "inline";
	   KField.disabled = false;
	   MField.disabled = true;
	   view.value = "WritingSearch";
	}
	else if(form.searchType[1].checked==true)
	{ 
	  K.style.display = "none";
	  M.style.display = "inline";
	   KField.disabled = true;
	   MField.disabled = false;
	   view.value = "WritingsSearchMorph";
	}

}