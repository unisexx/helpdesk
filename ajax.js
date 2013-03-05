// JavaScript Document
/***********************************************
* Dynamic Ajax Content- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

var loadedobjects=""
var rootdomain="http://"+window.location.hostname

 function urlEncode(inputString, encodeAllCharacter){
       var outputString = '';
       if (inputString != null){
         for (var i = 0; i < inputString.length; i++ ){
            var charCode = inputString.charCodeAt(i);
            var tempText = "";
            if (charCode < 128) {
                if (encodeAllCharacter)
                {
                  var hexVal = charCode.toString(16);
                  outputString += '%' + ( hexVal.length < 2 ? '0' : '' ) + hexVal.toUpperCase();  
                } else {
                  outputString += String.fromCharCode(charCode);
                }
                            
            } else if((charCode > 127) && (charCode < 2048)) {
                tempText += String.fromCharCode((charCode >> 6) | 192);
                tempText += String.fromCharCode((charCode & 63) | 128);
                outputString += escape(tempText);
            } else {
                tempText += String.fromCharCode((charCode >> 12) | 224);
                tempText += String.fromCharCode(((charCode >> 6) & 63) | 128);
                tempText += String.fromCharCode((charCode & 63) | 128);
                outputString += escape(tempText);
            }
         }
       }
       return outputString;
    }



				function ajaxpage(url, containerid){
				var page_request = false
				if (window.XMLHttpRequest) // if Mozilla, Safari etc
				page_request = new XMLHttpRequest()
				else if (window.ActiveXObject){ // if IE
				try {
				page_request = new ActiveXObject("Msxml2.XMLHTTP")
				} 
				catch (e){
				try{
				page_request = new ActiveXObject("Microsoft.XMLHTTP")
				}
				catch (e){}
				}
				}
				else
				return false
				page_request.onreadystatechange=function(){
				loadpage(page_request, containerid)
				}
				page_request.open('GET', url, true)
				page_request.send(null)
				}	
				
				function ajaxpageContinue(url, containerid){
				var page_request = false
				if (window.XMLHttpRequest) // if Mozilla, Safari etc
				page_request = new XMLHttpRequest()
				else if (window.ActiveXObject){ // if IE
				try {
				page_request = new ActiveXObject("Msxml2.XMLHTTP")
				} 
				catch (e){
				try{
				page_request = new ActiveXObject("Microsoft.XMLHTTP")
				}
				catch (e){}
				}
				}
				else
				return false
				page_request.onreadystatechange=function(){
				loadpageContinue(page_request, containerid)
				}
				page_request.open('GET', url, true)
				page_request.send(null)
				}	

				function ReloadWorkGroup(url, pSectionID, containerid){
				var page_request = false
				if (window.XMLHttpRequest) // if Mozilla, Safari etc
				page_request = new XMLHttpRequest()
				else if (window.ActiveXObject){ // if IE
				try {
				page_request = new ActiveXObject("Msxml2.XMLHTTP")
				} 
				catch (e){
				try{
				page_request = new ActiveXObject("Microsoft.XMLHTTP")
				}
				catch (e){}
				}
				}
				else
				return false
				page_request.onreadystatechange=function(){
				loadpage(page_request, containerid)
				}
				querystring =url+'?id='+ pSectionID ;
				//alert(querystring);				
				page_request.open('GET', querystring  , true)
				page_request.send(null)
				}
				
				function ReloadAssetData(url, pSearchAsset, pAssetTypeID, containerid, pPageNo, cindex){
				var page_request = false
				if (window.XMLHttpRequest) // if Mozilla, Safari etc
				page_request = new XMLHttpRequest()
				else if (window.ActiveXObject){ // if IE
				try {
				page_request = new ActiveXObject("Msxml2.XMLHTTP")
				} 
				catch (e){
				try{
				page_request = new ActiveXObject("Microsoft.XMLHTTP")
				}
				catch (e){}
				}
				}
				else
				return false
				page_request.onreadystatechange=function(){
				loadpage(page_request, containerid)
				}
				querystring =url+'?type='+pAssetTypeID+'&search='+ pSearchAsset+'&page='+pPageNo+'&cindex='+cindex;
				querystring = urlEncode(querystring,false);
				//alert(querystring);
				page_request.open('GET', querystring  , true)
				page_request.send(null)
				}
				
				function GenBudgetType(url,pPID, pType,containerid)
				{
					var page_request = false
					if (window.XMLHttpRequest) // if Mozilla, Safari etc
					page_request = new XMLHttpRequest()
					else if (window.ActiveXObject){ // if IE
					try {
					page_request = new ActiveXObject("Msxml2.XMLHTTP")
					} 
					catch (e){
					try{
					page_request = new ActiveXObject("Microsoft.XMLHTTP")
					}
					catch (e){}
					}
					}
					else
					return false
					page_request.onreadystatechange=function(){
					loadpage(page_request, containerid)
					}
					querystring =url+'?type='+pType+'&pid='+ pPID;
					querystring = urlEncode(querystring,false);
					//alert(querystring);
					page_request.open('GET', querystring  , true)
					page_request.send(null)
				}
				
				

function loadpage(page_request, containerid){
if (page_request.readyState == 4 && (page_request.status==200 || window.location.href.indexOf("http")==-1))
document.getElementById(containerid).innerHTML=page_request.responseText
}

function loadpageContinue(page_request, containerid){
if (page_request.readyState == 4 && (page_request.status==200 || window.location.href.indexOf("http")==-1))
document.getElementById(containerid).innerHTML +=page_request.responseText
}
