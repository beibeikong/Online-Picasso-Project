
function beginDrag(evt)
{
	var eventObj = evt ? evt : window.event;
	var thisObj = eventObj.srcElement ? eventObj.srcElement : this;
	
	thisObj.dragMousePosY = eventObj.clientY - thisObj.offsetTop;
	thisObj.dragMousePosX = eventObj.clientX - thisObj.offsetLeft;
	thisObj.style.cursor = "move";
	thisObj.isDragging = true;
	
	thisObj.onmouseup   = releaseDrag;
	
	if (evt)
	{
		thisObj.onmousemove = dragImg;
		evt.preventDefault();
	}
	else
	{
		thisObj.ondrag = dragImgIE;
		//window.event.cancelBubble = true;
		//window.event.returnValue = false;
	}
}

function releaseDrag(evt)
{
	var eventObj = evt ? evt : window.event;
	var thisObj = eventObj.srcElement ? eventObj.srcElement : this;
	
	thisObj.isDragging = false;
	thisObj.style.cursor = "default";
	
	if (evt)
	{
		thisObj.onmousemove = null;
		thisObj.onmouseup   = null;
	}
}

function dragImg(evt)
{
	var eventObj = evt ? evt : window.event;
	var thisObj = eventObj.srcElement ? eventObj.srcElement : this;
	
	thisObj.style.top  = (eventObj.clientY - thisObj.dragMousePosY) + "px";
	thisObj.style.left = (eventObj.clientX - thisObj.dragMousePosX) + "px";
	
	if (imgObj.imgTail)
	{
		imgObj.imgTail.style.top  = (eventObj.clientY - thisObj.dragMousePosY) + "px";
		imgObj.imgTail.style.left = (eventObj.clientX - thisObj.dragMousePosX) + "px";
	}
}

function dragImgIE(obj)
{
	var thisObj = window.event.srcElement;
	
	if (thisObj.isDragging)
	{
		thisObj.style.top  = (window.event.clientY - thisObj.dragMousePosY) + "px";
		thisObj.style.left = (window.event.clientX - thisObj.dragMousePosX) + "px";
		
		if (imgObj.imgTail)
		{
			imgObj.imgTail.style.top  = (window.event.clientY - thisObj.dragMousePosY) + "px";
			imgObj.imgTail.style.left = (window.event.clientX - thisObj.dragMousePosX) + "px";
		}
	}
}

