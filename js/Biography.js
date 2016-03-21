

function refresh(href, quarter)
{
	href = href.replace(/&page=\d\d/, '');
	href = href.replace(/&page=\d/, '');
	
	href = href.replace(/&quarter=\d/, '');

	href = href + '&quarter=' + quarter;
	
	window.location.replace(href);
}
