// this function is for the menu: BIOGRAPHY, ARTWORKS, WRITINGS, COLLECTIONS, REFERENCES, ARCHIVES
function OpenSearchBox(href, target, width, height)
{
	var menuObj = document.getElementById("OPPFloatingMenu");
	var menuContainerObj = document.getElementById("OPPFloatingMenuContainer");
	
	if (menuContainerObj.style.display != "block")
	{
		menuContainerObj.style.visibility = "hidden";
		menuContainerObj.style.display = "block";
		
		var posLeft = (document.documentElement.clientWidth - menuContainerObj.offsetWidth) / 2;
		
		menuObj.src = href;
		menuContainerObj.style.left       = posLeft + "px";
		menuContainerObj.style.visibility = "visible";
	}
	else
		document.getElementById("OPPFloatingMenu").src = href;
}

function SetOnclickPortal(ImgObj)
{
	ImgObj.onclick = NavigateToAuthoringPortal;
	ImgObj.onclick();
}

function NavigateToAuthoringPortal(e)
{
	var eventObj = e ? e : event;
	
	if (eventObj.altKey && eventObj.ctrlKey && eventObj.shiftKey)
		window.location = "AuthorIndex.php";
}

function RefreshPage()
{
	document.location.reload();
}

function addArtwork()
{
	OpenAddWin("AuthorIndex.php?view=addArtwork", "addArtwork", 1000, 650); 
}

function addArchive()
{
	OpenAddWin("AuthorIndex.php?view=addArchive", "addArchive", 1000, 650); 
}
function addBioResource()
{
	OpenAddWin("AuthorIndex.php?view=addBioResource", "addBioResource", 1000, 650); 
}
function addBio()
{
	OpenAddWin("AuthorIndex.php?view=addBiography", "addBio", 1000, 650); 
}
function addPhoto()
{
	OpenAddWin("AuthorIndex.php?view=addPhoto", "addPhoto", 1000, 650); 
}
function addLinkId()
{
	OpenAddWin("AuthorIndex.php?view=addLinkId", "addBio", 700, 650); 
}
function addCol()
{
	OpenAddWin("AuthorIndex.php?view=addCollaborator", "addCol", 700, 650); 
}
function addFrontUser()
{
	OpenAddWin("AuthorIndex.php?view=addFrontUser", "addFrontUser", 700, 650); 
}
function addStyle()
{
	OpenAddWin("AuthorIndex.php?view=addStyle", "addStyle", 1000, 650); 
}
function addTheme()
{
	OpenAddWin("AuthorIndex.php?view=addTheme", "addTheme", 1000, 650); 
}
function addMasterArtwork()
{
	OpenAddWin("AuthorIndex.php?view=addMasterArtwork", "addMasterArtwork", 1000, 650); 
}
function addPoem()
{
	OpenAddWin("AuthorIndex.php?view=addPoem", "addPoem", 700, 650); 
}
function addTerm()
{
	OpenAddWin("AuthorIndex.php?view=addTerm", "addTerm", 600, 550); 
}
function addRef()
{
	OpenAddWin("AuthorIndex.php?view=addRef", "addRef", 700, 650); 
}
function OpenAddWin(address, winName, width, height)
{
	var newLeft = (window.screen.availWidth - width) / 2;
	var objPopup = window.open(address, winName, 'width=' + width + ',height=' + height + ',top=' + 100 + ',left=' + newLeft + ',menubar=no,toolbar=no,scrollbars=yes,resizable=yes,directories=no,status=yes');
	objPopup.focus();
}
function getAjax()
{
	var XmlHttp;
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
			XmlHttp = null;
		}
	}
	//Creating object of XMLHTTP in Mozilla and Safari 
	if(!XmlHttp && typeof XMLHttpRequest != "undefined") 
	{
		XmlHttp = new XMLHttpRequest();
	}
	return XmlHttp;
}

function DeleteEntry(id,view)
{
	if(confirm("Are you sure you want to delete "+id+"?"))
	{
		var req = getAjax();
		url = 'AuthorIndex.php?view='+view+'&opp='+id;
		req.onreadystatechange = function()
    	{
			if (req.readyState == 4)    // If loaded.
			{
				if (req.status == 200)  // If OK.
				{
					if(req.responseText == "OK") // update successfully
					{
				   		alert("Delete successfully.");
						RefreshPage();
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

function DeletePoemEntry(id,title,view)
{
	if(confirm("Are you sure you want to delete all metadata, parts and lines for the poem: "+title))
	{
		var req = getAjax();
		url = 'AuthorIndex.php?view='+view+'&mid='+id;
		req.onreadystatechange = function()
    	{
			if (req.readyState == 4)    // If loaded.
			{
				if (req.status == 200)  // If OK.
				{
					if(req.responseText == "OK") // update successfully
					{
				   		alert("Delete successfully.");
						RefreshPage();
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
function DeletePoemTermEntry(id,term,view)
{
	if(confirm("Are you sure you want to delete all metadata for the term: "+term))
	{
		var req = getAjax();
		url = 'AuthorIndex.php?view='+view+'&id='+id;
		req.onreadystatechange = function()
    	{
			if (req.readyState == 4)    // If loaded.
			{
				if (req.status == 200)  // If OK.
				{
					if(req.responseText == "OK") // update successfully
					{
				   		alert("Delete successfully.");
						RefreshPage();
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


function EditEntryArtwork(id)
{
	OpenAddWin("AuthorIndex.php?view=editArtwork&opp="+id, "editArtwork", 1000, 650); 
}
function EditBiography(id)
{
	OpenAddWin("AuthorIndex.php?view=editBiography&id="+id, "editBiography", 1000, 650); 
}
function EditPhoto(id,no)
{
	OpenAddWin("AuthorIndex.php?view=editPhoto&id="+id+"&no="+no, "editPhoto", 1000, 650); 
}
function EditPoem(id)
{
	OpenAddWin("AuthorIndex.php?view=editPoem&mid="+id, "editPoem", 700, 650); 
}
function EditTerm(id)
{
	OpenAddWin("AuthorIndex.php?view=editTerm&id="+id, "editTerm", 600, 550); 
}
function EditRef(id)
{
	OpenAddWin("AuthorIndex.php?view=editRef&id="+id, "editRef", 700, 650); 
}
function EditCol(id)
{
	OpenAddWin("AuthorIndex.php?view=editCollaborator&id="+id, "editCol", 700, 650); 
}
function EditLinkID(id)
{
	OpenAddWin("AuthorIndex.php?view=editLinkId&id="+id, "editLinkid", 700, 650); 
}
function EditArchive(id)
{
	OpenAddWin("AuthorIndex.php?view=editArchive&id="+id, "editArchive", 1000, 650); 
}
function editBioResource(id)
{
	OpenAddWin("AuthorIndex.php?view=editBioResource&id="+id, "editBioResource", 1000, 650); 
}
function EditStyle(id)
{
	OpenAddWin("AuthorIndex.php?view=editStyle&guidename="+id, "editStyle", 1000, 650); 
}
function EditTheme(id)
{
	OpenAddWin("AuthorIndex.php?view=editTheme&guidename="+id, "editTheme", 1000, 650); 
}
function EditEntryMasterArtwork(id)
{
	OpenAddWin("AuthorIndex.php?view=editMasterArtwork&masteropp="+id, "editMasterArtwork", 1000, 650); 
}
function EditFrontUser(id)
{
	OpenAddWin("AuthorIndex.php?view=editFrontUser&id="+id, "editFrontUser", 700, 650); 
}
function changeyear(href, selectID)
{
	var n = document.getElementById(selectID);
	var year = n.value;
	href = href.replace(/year=\d\d\d\d/, 'year='+year);
	window.location.replace(href);
}
function changeid(href, selectID)
{
	var n = document.getElementById(selectID);
	var linkid = n.value;
	href = href.replace(/id=\d+/, 'id='+linkid);
	window.location.replace(href);
}

function changeletter(href, selectID)
{
	var n = document.getElementById(selectID);
	var letter = n.value;
	href = href.replace(/letter=[A-Z]/, 'letter='+letter);
	window.location.replace(href);
}

