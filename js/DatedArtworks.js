function SubmitSummary(viewName)
{
var currenturl = document.URL;
var Variables = currenturl.split("DatedArtworks&");
href = "index.php?view=" + viewName +  "&" + Variables[1];
		window.location.replace(href);
}
function SubmitArtworks(viewName)
{
var currenturl = document.URL;
var Variables = currenturl.split("DatedArtworksSummary&");
href = "index.php?view=" + viewName +  "&" + Variables[1];
		window.location.replace(href);
}

