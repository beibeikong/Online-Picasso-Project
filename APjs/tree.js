
function doClickTree(e)
{
	var objParent = this.parentNode.parentNode.parentNode.parentNode.parentNode;
	
	if (objParent.className == "Visible")
	{
		this.className = "Plus";
		this.alt = "+";
		objParent.className = "Hidden";
	}
	else
	{
		this.className = "Minus";
		this.alt = "-";
		objParent.className = "Visible";
	}
	
	if (e || window.event)
	{
		if (!e) var e = window.event;
		e.cancelBubble = true;
		if (e.stopPropagation) e.stopPropagation();
	}
	
	/*if (document.all)
		document.recalc();*/
}