function SubmitSummary(viewName)
{
var currenturl = document.URL;
var Variables = currenturl.split("DatedPhotos&");
href = "index.php?view=" + viewName +  "&" + Variables[1];
		window.location.replace(href);
}
function SubmitPhotos(viewName)
{
var currenturl = document.URL;
var Variables = currenturl.split("PhotoSummary&");
href = "index.php?view=" + viewName +  "&" + Variables[1];
		window.location.replace(href);
}

