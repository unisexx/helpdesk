function wm_centerElementInViewport(pElmID){
	var element = document.getElementById(pElmID);
	
	var viewport_dimensions = wm_getViewPortDimensions();
	var viewport_width = viewport_dimensions.Width
	var viewport_height = viewport_dimensions.Height;
	var elmWidth = element.offsetWidth;
	var elmHeight = element.offsetHeight;
	
	var leftTarget = Math.floor((viewport_width - elmWidth) / 2);
	var topTarget = Math.floor((viewport_height - elmHeight) / 2);
	leftTarget = leftTarget + wm_scroll().X;
	topTarget = topTarget + wm_scroll().Y;
	
	element.style.left = leftTarget + "px";
	element.style.top = topTarget + "px";
}

function wm_centerElementOverElement(pElementToCenter, pBaseElement){
	var coordinates_base = wm_coordinates(pBaseElement).viewport;
	var height_diff = Math.floor((pBaseElement.offsetHeight - pElementToCenter.offsetHeight) / 2);
	var width_diff = Math.floor((pBaseElement.offsetWidth - pElementToCenter.offsetWidth) / 2);
	var top = coordinates_base.Y + height_diff + wm_getScrolling().Y;
	var left = coordinates_base.X + width_diff;
	pElementToCenter.style.top = top + "px";
	pElementToCenter.style.left = left + "px";
}

function wm_centerElementInParent(pElmID){
}

function wm_getMousePosition(pEvt){
	var evt = (pEvt) ? pEvt : window.event;

	var X = 0, Y = 0;
	if (evt.pageX){
		X = evt.pageX;
		Y = evt.pageY;
	}
	else if (evt.clientX){
		X = evt.clientX + ((document.documentElement.scrollLeft) ? document.documentElement.scollLeft : document.body.scrollLeft);
		Y = evt.clientY + ((document.documentElement.scrollTop) ? document.documentElement.scrollTop : document.body.scrollTop);
	}
	else{
		X = Y = 0;
	}
	
	return {"X":X,"Y":Y};
}

function wm_centerElementUnderMousePointer(pElmID){
	/*
	This function will ONLY work if wm_createMouse is added as an eventhandler to the event that also led
	to this function - that is: if clicking a thumbnail images means that an ajax loader should show until 
	the big image are loaded and that ajax loader should display centered under the mouse, then the mouse
	clicking event on the thumbnail image should have added the eventhandler wm_createMouse.
	*/
	var elm = document.getElementById(pElmID);
	elm.style.left = wm_mouse.viewport.X + (elm.offsetWidth / 2) + "px";
	elm.style.top = wm_mouse.viewport.Y + (elm.offsetTop / 2) + "px";
}

var wm_mouse = {
	"viewport" : {"X":0,"Y":0},
	"document" : {"X":0, "Y":0}
}

function wm_createMouse(e){
	//FF will autotransport the event as an argument to the eventhandler (so the mousemove event will be transported as an argument for the eventhandler for eg. document.onmousemove)
	var ev = (e) ? e : window.event;
	var ev_X_viewport = (ev.pageX) ? ev.pageX - wm_scroll().X : ev.clientX;
	var ev_Y_viewport = (ev.pageY) ? ev.pageY - wm_scroll().Y : ev.clientY;
	var ev_X_document = (ev.pageX) ? ev.pageX : ev.clientX + wm_scroll().X;
	var ev_Y_document = (ev.pageY) ? ev.pageY : ev.clientY + wm_scroll().Y;
//	var ev_X_viewport = ev.pageX - wm_scroll().X || ev.clientX;
//			var ev_Y_viewport = ev.pageY - wm_scroll().Y || ev.clientY;
//			var ev_X_document = ev.pageX || ev.clientX + wm_scroll().X;
//			var ev_Y_document = ev.pageY || ev.clientY + wm_scroll().Y;
	wm_mouse.viewport.X = ev_X_viewport;
	wm_mouse.viewport.Y = ev_Y_viewport;
	wm_mouse.document.X = ev_X_document;
	wm_mouse.document.Y = ev_Y_document;
}

function wm_scroll(pElm){
	if (pElm){
		var scrollLeft = (pElm.scrollLeft) ? pElm.scrollLeft : 0;
		var scrollTop = (pElm.scrollTop) ? pElm.scrollTop : 0;
		return {"X":scrollLeft,"Y":scrollTop};
	}
	else if (document.documentElement && document.documentElement.scrollTop){
		return {"X":document.documentElement.scrollLeft,"Y":document.documentElement.scrollTop};
	}
	else if (document.body){
		return {"X":document.body.scrollLeft,"Y":document.body.scrollTop};
	}
	else if (window.pageXOffset){
		return {"X":window.pageXOffset,"Y":window.pageYOffset};
	}
	else{
		//old browsers and minor browsers
		return {"X":0,"Y":0};
	}
	
	//here could be setScroll method
	this.setX = function(pElm, pPixels){
	
	}
	this.setY = function(pElm, pPixels){
	
	}
}



function wm_holdPopupWithinViewport(pElmID){
	var element = document.getElementById(pElmID);
	var elmCoordinates = wm_coordinates(element);
	var elmWidth = element.offsetWidth;
	var elmHeight = element.offsetHeight;
	var elmLeft = elmCoordinates.document.X;
	var elmTop = elmCoordinates.document.Y;
	var viewportWidth = wm_getViewPortWidth();
	var viewportHeight = wm_getViewPortHeight();
	var scrolling = wm_getScrolling();
	var maxLeft = viewportWidth - elmWidth + scrolling.X;
	var maxTop = viewportHeight - elmHeight + scrolling.Y;
	if (maxLeft < scrolling.X){maxLeft = scrolling.X;}
	if (maxTop < scrolling.Y){maxTop = scrolling.Y;}
	
	var targetLeft = elmLeft;
	var targetTop = elmTop;
	if (elmLeft > maxLeft){
		targetLeft = maxLeft;
	}
	if (elmTop > maxTop){
		targetTop = maxTop;
	}
	if (elmLeft < scrolling.X){
		targetLeft = scrolling.X;
	}
	if (elmTop < scrolling.Y){
		targetTop = scrolling.Y;
	}
	
	element.style.left = targetLeft + "px";
	element.style.top = targetTop + "px";
}

function wm_getViewPortDimensions(){
	var x,y;
	if (self.innerHeight) // all except Explorer
	{
		x = self.innerWidth;
		y = self.innerHeight;
	}
	else if (document.documentElement && document.documentElement.clientHeight)
		// Explorer 6 Strict Mode
	{
		x = document.documentElement.clientWidth;
		y = document.documentElement.clientHeight;
	}
	else if (document.body) // other Explorers
	{
		x = document.body.clientWidth;
		y = document.body.clientHeight;
	}
	return {"Width":x,"Height":y};	
}

function wm_getViewPortHeight(){
	var x,y;
	if (self.innerHeight) // all except Explorer
	{
		x = self.innerWidth;
		y = self.innerHeight;
	}
	else if (document.documentElement && document.documentElement.clientHeight)
		// Explorer 6 Strict Mode
	{
		x = document.documentElement.clientWidth;
		y = document.documentElement.clientHeight;
	}
	else if (document.body) // other Explorers
	{
		x = document.body.clientWidth;
		y = document.body.clientHeight;
	}
	return y;	
}
	
function wm_getViewPortWidth(){
	var x,y;
	if (document.documentElement && document.documentElement.clientHeight)
		// Explorer 6 Strict Mode & FF
	{
		x = document.documentElement.clientWidth;
		y = document.documentElement.clientHeight;
	}
	else if (self.innerHeight) // all except Explorer
	{
		//FF will return the width & height inclusive any scrollbars, which is quite unlucky since we are almost always interested in the available space
		x = self.innerWidth;
		y = self.innerHeight;
	}
	else if (document.body) // other Explorers
	{
		x = document.body.clientWidth;
		y = document.body.clientHeight;
	}
	return x;	
}

function wm_coordinates(pElm, pContainer){
	//if pContainer is undefined then document.body is pContainer
	//if pContainer is defined then pContainer must be positioned as offsetParent is relative to positioned parent
	var elm = pElm;
	var pageOffsetX = viewportOffsetX = parentX = elm.offsetLeft;
	var pageOffsetY = viewportOffsetY = parentY = elm.offsetTop;
	while (elm = elm.offsetParent){
		if (elm == pContainer){break;}
		if (elm.offsetParent == null){break;}//avoiding sending document element to wm_getScrolling twice (first time then document is the parent and second time as document.parent (null), because wm_getScrolling will regard null as document)
		pageOffsetX += elm.offsetLeft;
		pageOffsetY += elm.offsetTop;
		viewportOffsetX += elm.offsetLeft - wm_getScrolling(elm.offsetParent).X;//it is ok to send null or undefined to wm_scroll
		viewportOffsetY += elm.offsetTop - wm_getScrolling(elm.offsetParent).Y;
	}

	var coordinates = {}
	coordinates.viewport = {"X":viewportOffsetX,"Y":viewportOffsetY};
	coordinates.document = {"X":pageOffsetX,"Y":pageOffsetY};

	return coordinates;
}

function wm_getScrolling(pElm){//supply null for document scrolling
	var scrollLeft = 0;
	var scrollTop = 0;
	
	if (pElm){
		scrollLeft = (pElm.scrollLeft) ? pElm.scrollLeft : 0;
		scrollTop = (pElm.scrollTop) ? pElm.scrollTop : 0;
	}
	else if (document.documentElement && (document.documentElement.scrollTop || document.documentElement.scrollLeft)){
		scrollLeft = document.documentElement.scrollLeft;
		scrollTop = document.documentElement.scrollTop;
	}
	else if (document.body){
		scrollLeft = document.body.scrollLeft;
		scrollTop = document.body.scrollTop;
	}
	else if (window.pageXOffset){
		scrollLeft = window.pageXOffset;
		scrollTop = window.pageYOffset;
	}
	else{
		//old browsers and minor browsers
	}
	
	return {"X":scrollLeft,"Y":scrollTop};
}

function wm_getCoordinatesForViewPortCentering(pElm){
	this.getViewportDimensions = function(){
		var width = 0;
		var height = 0;
		
		if (document.documentElement && document.documentElement.clientWidth){//IE6 in strict
			width = document.documentElement.clientWidth;
			height = document.documentElement.clientHeight;
		}
		else if (self.innerWidth){//all except IE
			width = self.innerWidth;
			height = self.innerHeight;
		}
		else if (document.body){//IE7 lands here
			width = document.body.clientWidth;
			height = document.body.clientHeight;
		}
		
		return {"Width":width,"Height":height};
	}

	var elm = pElm;
	var documentScroll = wm_getScrolling(null);
	var viewportDimensions = this.getViewportDimensions();
	var elmLeft = ((viewportDimensions.Width - elm.offsetWidth) / 2) + documentScroll.X;
	var elmTop = ((viewportDimensions.Height - elm.offsetHeight) / 2) + documentScroll.Y;
	
	return {"Left":elmLeft,"Top":elmTop};
}
