function OpenWin(address, winName, width, height)
{
	var newLeft = (window.screen.availWidth - width) / 2;
	var objPopup = window.open(address, winName, 'width=' + width + ',height=' + height + ',top=' + 100 + ',left=' + newLeft + ',menubar=no,toolbar=no,scrollbars=yes,resizable=yes,directories=no,status=yes');
	objPopup.focus();
}

function AutoSizePopup()
{
	var viewableHeight = 0;
	var counter = 0;
		// Workaround fix for Firefox 1.0.x (not necessary for v1.5)
	for (counter = 1; counter <= 50; counter++)
		window.resizeBy(0, (document.body.scrollHeight - document.documentElement.clientHeight) / 2);
	window.resizeBy(0, document.body.scrollHeight - document.documentElement.clientHeight);
}

function AutoSizePopupCompare()
{
	var viewableHeight = 0;
	var counter = 0;
		// Workaround fix for Firefox 1.0.x (not necessary for v1.5)
if(document.body.scrollWidth==740)
{
	for (counter = 1; counter <= 50; counter++)
		window.resizeBy(0, (document.body.scrollHeight - document.documentElement.clientHeight) / 2);
	window.resizeBy(0, document.body.scrollHeight - document.documentElement.clientHeight);
}
}

function ClosePopup()
{
	window.close();
}
function resizeBioTree()
{
document.getElementById('noteiframe').height = document.documentElement.clientHeight -200;

var MasterPanelObj = document.getElementById("MasterPanel");
MasterPanelObj.style.height = (document.documentElement.clientHeight - 130) + "px";
}

function ChangePanel(PanelNum)
{
	var counter = 0;
	var panelCount = 0;
	
	for (counter = 1, panelCount = 0; counter <= 10; counter++)
		if (document.getElementById("Panel" + counter))
			panelCount++;
	
	for (counter = 1; counter <= panelCount; counter++)
	{
		document.getElementById("Panel" + counter).style.display = (counter == PanelNum ? "block" : "none");
		document.getElementById("Bull" + counter).style.visibility = (counter == PanelNum ? "visible" : "hidden");
	}
}
function trim(str)
{
 s = str.replace(/^(\s)*/, '');
 s = s.replace(/(\s)*$/, '');
 return s;
}
function ChangeTabSide(TabNum)
{
	var counter = 0;
	var tabCount = 0;
	while (document.getElementById("Tab" + (tabCount + 1) + "Side"))
		tabCount++;

	for (counter = 1; counter <= tabCount; counter++)
	{
		if (counter == TabNum)
		{
			document.getElementById("Tab" + counter + "Side").style.display = "block";
			document.getElementById("TabLbl" + counter + "Side").className = "Active";
		}
		else
		{
			document.getElementById("Tab" + counter + "Side").style.display = "none";
			document.getElementById("TabLbl" + counter + "Side").className = "Inactive";
		}
	}
}

function ChangeTab(TabNum)
{
	var counter = 0;
	var tabCount = 0;

	while (document.getElementById("Tab" + (tabCount + 1)))
		tabCount++;

	for (counter = 1; counter <= tabCount; counter++)
	{
		if (counter == TabNum)
		{
			document.getElementById("Tab" + counter).style.display = "block";
			document.getElementById("TabLbl" + counter).className = "Active";
		}
		else
		{
			document.getElementById("Tab" + counter).style.display = "none";
			document.getElementById("TabLbl" + counter).className = "Inactive";
		}
	}
}
function getAjax()
{
	var XmlHttp = false;
	
	//Creating object of XMLHTTP in IE
	try
	{
		XmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
	}
	catch(e)
	{
		try
		{
			XmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
		} 
		catch(oc)
		{
			XmlHttp = false;
		}
	}
	//Creating object of XMLHTTP in Mozilla and Safari 
	if(!XmlHttp && typeof XMLHttpRequest != "undefined") 
	{
		XmlHttp = new XMLHttpRequest();
	}
if (!XmlHttp) 
         alert('Cannot create XMLHTTP instance');
	return XmlHttp;
}

function getAjaxdddd()
{
	var XmlHttp;
	
	if (window.XMLHttpRequest) // code for IE7+, Firefox, Chrome, Opera, Safari
	  	XmlHttp = new XMLHttpRequest();
	else if (window.ActiveXObject) // code for IE6, IE5 
   		XmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
	else 
	{
		alert ("Your browser does not support AJAX!");
  		XmlHttp = null;
	}
	
	 if (XmlHttp.overrideMimeType) {
         	// set type accordingly to anticipated content type
            //http_request.overrideMimeType('text/xml');
            http_request.overrideMimeType('text/html');
         }

	return XmlHttp;

}
////////////////////// save button ////////////////////
function OnSaveForm(n)  /// use Ajax to save form
{
	
	var req = getAjax();
	var counter = 0;
	var urlEncodeStr = "";
	var currentElmt;
	var form = document.getElementById('EntryForm'); 
	
	/////////// start generate param string ///////////////////////
	for (counter = 0; counter < form.elements.length; counter++)
	{
		currentElmt = form.elements.item(counter);
		if ((currentElmt.type != "radio" || (currentElmt.type == "radio" && currentElmt.checked)) && !(currentElmt.type == "checkbox" && !currentElmt.checked))
		{
			if (urlEncodeStr.length > 0)
				urlEncodeStr += "&";
				
			urlEncodeStr += encodeURIComponent(currentElmt.name) + "=" + encodeURIComponent(currentElmt.value);
		}
	}

	req.onreadystatechange = function()
    {
		if (req.readyState == 4)    // If loaded.
		{
			if (req.status == 200)  // If OK.
			{
				if(req.responseText == "OK") // update successfully
				{
				    updateStatus("ok", "Update successfully");  
					document.getElementById('SaveButton').disabled = true;
				}
				else
				{
			    	updateStatus("error", req.responseText);
					document.getElementById('SaveButton').disabled = false;
				}
			}
			else
			{
				errorMsg = "Communication with the server failed.";
				updateStatus("error", errorMsg);
				document.getElementById('SaveButton').disabled = false;
			}
		}
	}
	
	updateStatus("busy", "Please wait...");
	document.getElementById('SaveButton').disabled = true;
	req.open('POST', 'AuthorIndex.php?view='+n, true);
	req.setRequestHeader("Content-Type","application/x-www-form-urlencoded;"); 
	req.send(urlEncodeStr);
}
function OnSaveModifiedForm(n)  /// use Ajax to save modified form
{
	var req = getAjax();
	var counter = 0;
	var urlEncodeStr = "";
	var currentElmt;
	var form = document.getElementById('EntryForm'); 
	
	/////////// start generate param string ///////////////////////
	for (counter = 0; counter < form.elements.length; counter++)
	{
		currentElmt = form.elements.item(counter);
		if ( (currentElmt.type != "radio" || (currentElmt.type == "radio" && currentElmt.checked)) && !(currentElmt.type == "checkbox" && !currentElmt.checked))
		{
			if (urlEncodeStr.length > 0)
				urlEncodeStr += "&";
				
			urlEncodeStr += currentElmt.name + "=" + encodeURIComponent(currentElmt.value);
		}
	}
	
	
	
	req.onreadystatechange = function()
    {
		if (req.readyState == 4)    // If loaded.
		{
			if (req.status == 200)  // If OK.
			{
				if(req.responseText == "OK") // update successfully
				{
				    updateStatus("ok", "Update successfully");  
					document.getElementById('SaveButton').disabled = false;
				}
				else
				{
			    	updateStatus("error", req.responseText);
					document.getElementById('SaveButton').disabled = false;
				}
			}
			else
			{
				errorMsg = req.status;
				updateStatus("error", errorMsg);
				document.getElementById('SaveButton').disabled = false;
			}
		}
	}
	
	updateStatus("busy", "Please wait...");
	document.getElementById('SaveButton').disabled = true;
	
	req.open('POST', 'AuthorIndex.php?view='+n, true);
	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    req.setRequestHeader("Content-length", urlEncodeStr.length);
    req.setRequestHeader("Connection", "close");
	req.send(urlEncodeStr);
}
function OnSaveModifiedPhotoForm(n)  /// use Ajax to save modify form for Artwork
{
	var req = getAjax();
	var counter = 0;
	var urlEncodeStr = "";
	var currentElmt;
	var form = document.getElementById('EntryForm'); 
	
	/////////// start generate param string ///////////////////////
	for (counter = 0; counter < form.elements.length; counter++)
	{
		currentElmt = form.elements.item(counter);
		if ((currentElmt.type != "radio" || (currentElmt.type == "radio" && currentElmt.checked)) && !(currentElmt.type == "checkbox" && !currentElmt.checked))
		{
			if (urlEncodeStr.length > 0)
				urlEncodeStr += "&";
				
			urlEncodeStr += encodeURIComponent(currentElmt.name) + "=" + encodeURIComponent(trim(currentElmt.value));
		}
	}

	req.onreadystatechange = function()
    {
		if (req.readyState == 4)    // If loaded.
		{
			if (req.status == 200)  // If OK.
			{
				if(req.responseText == "OK") // update successfully
				{
				    updateStatus("ok", "Update successfully");  
					oldID = document.getElementById("id");
  					newID = document.getElementById("catid");
  					oldID.value = newID.value;
					document.getElementById('SaveButton').disabled = false;
				}
				else
				{
			    	updateStatus("error", req.responseText);
					document.getElementById('SaveButton').disabled = false;
				}
			}
			else
			{
				errorMsg = "Communication with the server failed.";
				updateStatus("error", errorMsg);
				document.getElementById('SaveButton').disabled = false;
			}
			
			document.getElementById('SaveButton').disabled = false;
		}
	}
	
	document.getElementById('SaveButton').disabled = true;
	updateStatus("busy", "Please wait...");
	
	req.open('POST', 'AuthorIndex.php?view='+n, true);
	req.setRequestHeader("Content-Type","application/x-www-form-urlencoded;"); //设置服务器响应请求体参数
	req.send(urlEncodeStr); 
}

function OnSaveModifiedArtworkForm(n)  /// use Ajax to save modify form for Artwork
{
	var req = getAjax();
	var counter = 0;
	var urlEncodeStr = "";
	var currentElmt;
	var form = document.getElementById('EntryForm'); 
	
	/////////// start generate param string ///////////////////////
	for (counter = 0; counter < form.elements.length; counter++)
	{
		currentElmt = form.elements.item(counter);
		if ((currentElmt.type != "radio" || (currentElmt.type == "radio" && currentElmt.checked)) && !(currentElmt.type == "checkbox" && !currentElmt.checked))
		{
			if (urlEncodeStr.length > 0)
				urlEncodeStr += "&";
				
			urlEncodeStr += encodeURIComponent(currentElmt.name) + "=" + encodeURIComponent(trim(currentElmt.value));
		}
	}

	req.onreadystatechange = function()
    {
		if (req.readyState == 4)    // If loaded.
		{
			if (req.status == 200)  // If OK.
			{
				if(req.responseText == "OK") // update successfully
				{
				    updateStatus("ok", "Update successfully");  
					oldID = document.getElementById("id");
  					newID = document.getElementById("catid");
  					oldID.value = newID.value;
					document.getElementById('SaveButton').disabled = false;
				}
				else
				{
			    	updateStatus("error", req.responseText);
					document.getElementById('SaveButton').disabled = false;
				}
			}
			else
			{
				errorMsg = "Communication with the server failed.";
				updateStatus("error", errorMsg);
				document.getElementById('SaveButton').disabled = false;
			}
			
			document.getElementById('SaveButton').disabled = false;
		}
	}
	
	document.getElementById('SaveButton').disabled = true;
	updateStatus("busy", "Please wait...");
	
	req.open('POST', 'AuthorIndex.php?view='+n, true);
	req.setRequestHeader("Content-Type","application/x-www-form-urlencoded;"); //设置服务器响应请求体参数
	req.send(urlEncodeStr); 
}

function OnSaveModifiedGuideForm(n)  /// use Ajax to save modify form for Study
{
	var req = getAjax();
	var counter = 0;
	var urlEncodeStr = "";
	var currentElmt;
	var form = document.getElementById('EntryForm'); 
	
	/////////// start generate param string ///////////////////////
	for (counter = 0; counter < form.elements.length; counter++)
	{
		currentElmt = form.elements.item(counter);
		if ((currentElmt.type != "radio" || (currentElmt.type == "radio" && currentElmt.checked)) && !(currentElmt.type == "checkbox" && !currentElmt.checked))
		{
			if (urlEncodeStr.length > 0)
				urlEncodeStr += "&";
				
			urlEncodeStr += encodeURIComponent(currentElmt.name) + "=" + encodeURIComponent(trim(currentElmt.value));
		}
	}

	req.onreadystatechange = function()
    {
		if (req.readyState == 4)    // If loaded.
		{
			if (req.status == 200)  // If OK.
			{
				if(req.responseText == "OK") // update successfully
				{
				    updateStatus("ok", "Update successfully");  
					oldID = document.getElementById("id");
  					newID = document.getElementById("guideid");
  					oldID.value = newID.value;
					document.getElementById('SaveButton').disabled = false;
				}
				else
				{
			    	updateStatus("error", req.responseText);
					document.getElementById('SaveButton').disabled = false;
				}
			}
			else
			{
				errorMsg = "Communication with the server failed.";
				updateStatus("error", errorMsg);
				document.getElementById('SaveButton').disabled = false;
			}
			
			document.getElementById('SaveButton').disabled = false;
		}
	}
	
	document.getElementById('SaveButton').disabled = true;
	updateStatus("busy", "Please wait...");
	
	req.open('POST', 'AuthorIndex.php?view='+n, true);
	req.setRequestHeader("Content-Type","application/x-www-form-urlencoded;"); //设置服务器响应请求体参数
	req.send(urlEncodeStr); 
}



function updateStatus(statusType, message)
{
	if (statusType == "ok")
	{
		document.getElementById('StatusImage').src   = "./images/statusicon-success.gif";
		document.getElementById('StatusMessage').innerHTML = message;
	}
	else if (statusType == "error")
	{
		document.getElementById('StatusImage').src   = "./images/statusicon-error.gif";
		document.getElementById('StatusMessage').innerHTML = message;
	}
	else if (statusType == "busy")
	{
		document.getElementById('StatusImage').src   = "./images/statusicon-busy.gif";
		document.getElementById('StatusMessage').innerHTML = message;
	}
}

function DeletePoemPart(id,title,part,view)
{
	if(confirm("Are you sure you want to delete all metadata and lines for part "+part + "of the poem: "+title))
	{
		var req = getAjax();
		url = 'AuthorIndex.php?view='+view+'&mid='+id+'&part='+part;
		req.onreadystatechange = function()
    	{
			if (req.readyState == 4)    // If loaded.
			{
				if (req.status == 200)  // If OK.
				{
					if(req.responseText == "OK") // update successfully
					{
				   		alert("Delete successfully.");
						window.close();
					}
					else
			    		alert("ERROR: "+req.responseText);
				}
				else
				{
					alert("Communication with the server failed.");
				}
			}
		}
		req.open( 'GET', encodeURI(url), true );
    	req.send( null );
	}
}

function PreviewEntry(formObj, viewFile, winName, w, h)
{
	formObj.action='AuthorIndex.php?view='+viewFile; 
	OpenWin('AuthorIndex.php?view='+viewFile, winName,w,h);
	formObj.target = winName;
	formObj.submit();
}
function PreviewEntryFullPage(formObj, viewFile)
{
	formObj.action='AuthorIndex.php?view='+viewFile; 
	formObj.submit();
}