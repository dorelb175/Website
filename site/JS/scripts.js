$(document).ready(function(){
    
	$("#search_err").hide();
	$("#closeWin").click(function(){
	    $("#search_err").hide('slow');
	});
	
	$("#showClist").click(function(){
	    $("#clist_container").slideToggle('slow');
		$("#clist").slideToggle('slow');
	});
	
	$("#reload_captcha").click(function(){
	    $("#secure_code").attr("src","captcha.php");
	});
	
	$("#regForm").submit(function(){
	   checkReg();
	   return false;
	});
});


//Search

function checkTerm()
{
   var x = document.getElementById('search_term').value;
   if(x != " " && x != null && x != "" && x.length >= 4)
   {
      return true;
   }
   else if(x == " " || x == null || x == "")
   {
	  alert("אנא הכנס טקסט לחיפוש");
      return false;
   }
   else if(x.length < 4)
   {
	  alert("טקסט החיפוש קצר מדי.\nהטקסט יכול לכלול 4 תווים ומעלה.");
	  return false;
   }
}

function checkSearch()
{
   if(checkTerm())
   {  
	  return true;
   }
   else
   {
      return false;
   }
}

function goSearch(searchTerm)
{
    var by = document.getElementsByName('searchBy');
	var searchBy = (by[0].checked) ? "pages" : "content";
	$.get("search_results.php?searchBy="+searchBy+"&q="+searchTerm,function(searchData){
	    $("#search_results").html(searchData);
	});
	
}

//Marquee
var oMarquees = [], oMrunning,
	oMInterv = 25,     //interval between increments
	oMStep = 1,      //number of pixels to move between increments
	oStopMAfter = 30,     //how many seconds should marquees run (0 for no limit)
	oResetMWhenStop = false,  //set to true to allow linewrapping when stopping
	oMDirection = 'right'; //'left' for LTR text, 'right' for RTL text

function doMStop() {
    clearInterval(oMrunning);
    for (var i = 0; i < oMarquees.length; i++) {
        oDiv = oMarquees[i];
        oDiv.mchild.style[oMDirection] = "0px";
        if (oResetMWhenStop) {
            oDiv.mchild.style.cssText = oDiv.mchild.style.cssText.replace(/;white-space:nowrap;/g, '');
            oDiv.mchild.style.whiteSpace = '';
            oDiv.style.height = '';
            oDiv.style.overflow = '';
            oDiv.style.position = '';
            oDiv.mchild.style.position = '';
            oDiv.mchild.style.top = '';
        }
    }
    oMarquees = [];
}
function doDMarquee() {
    if (oMarquees.length || !document.getElementsByTagName) { return; }
    var oDivs = document.getElementsByTagName('div');
    for (var i = 0, oDiv; i < oDivs.length; i++) {
        oDiv = oDivs[i];
        if (oDiv.className && oDiv.className.match(/\bdmarquee\b/)) {
            if (!(oDiv = oDiv.getElementsByTagName('div')[0])) { continue; }
            if (!(oDiv.mchild = oDiv.getElementsByTagName('div')[0])) { continue; }
            oDiv.mchild.style.cssText += ';white-space:nowrap;';
            oDiv.mchild.style.whiteSpace = 'nowrap';
            oDiv.style.height = oDiv.offsetHeight + 'px';
            oDiv.style.overflow = 'hidden';
            oDiv.style.position = 'relative';
            oDiv.mchild.style.position = 'absolute';
            oDiv.mchild.style.top = '0px';
            oDiv.mchild.style[oMDirection] = oDiv.offsetWidth + 'px';
            oMarquees[oMarquees.length] = oDiv;
            i += 2;
        }
    }
    oMrunning = setInterval('aniMarquee()', oMInterv);
    if (oStopMAfter) { setTimeout('doMStop()', oStopMAfter * 1000); }
}
function aniMarquee() {
    var oDiv, oPos;
    for (var i = 0; i < oMarquees.length; i++) {
        oDiv = oMarquees[i].mchild;
        oPos = parseInt(oDiv.style[oMDirection]);
        if (oPos <= -1 * oDiv.offsetWidth) {
            oDiv.style[oMDirection] = oMarquees[i].offsetWidth + 'px';
        } else {
            oDiv.style[oMDirection] = (oPos - oMStep) + 'px';
        }
    }
}
if (window.addEventListener) {
    window.addEventListener('load', doDMarquee, false);
} else if (document.addEventListener) {
    document.addEventListener('load', doDMarquee, false);
} else if (window.attachEvent) {
    window.attachEvent('onload', doDMarquee);
}

//Time

function showTime() {
    var now = new Date();
    var hours = now.getHours();
    var minutes = now.getMinutes();
    var seconds = now.getSeconds()

    var time = "" + ((hours > 12) ? hours - 12 : hours)
    if (time == "0") time = 12
    time += ((minutes < 10) ? ":0" : ":") + minutes
    time += ((seconds < 10) ? ":0" : ":") + seconds
    time += (hours >= 12) ? "   P.M." : "   A.M."
    document.getElementById('clock').innerHTML = time;

    setTimeout('showTime()', 1000);
}

var user = false;
var pass = false;
var fName = false;
var lName = false;
var pass = false;
var mail = false;
var date = false;

function checkReg()
{
   checkUser();
   checkFname();
   checkLname();
   checkPass();
   checkEmail();
   checkDate();
   
   var count = 0;
   count = (user) ? count + 1 : count;
   count = (pass) ? count + 1 : count;
   count = (fName) ? count + 1 : count;
   count = (lName) ? count + 1 : count;
   count = (mail) ? count + 1 : count;
   count = (date) ? count + 1 : count;
   
   if(count == 6)
      document.forms.regForm.submit();
}