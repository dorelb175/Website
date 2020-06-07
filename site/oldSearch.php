<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once "config.php";
?>
<script type="text/javascript" src="JS/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $("#search_err").hide();
});

function checkTerm()
{
   var x = document.getElementById('search-text').value;
   if(x != " " && x != null && x != "" && x.length >= 4)
   {
      document.getElementById('search_err').innerHTML = "";
      return true;
   }
   else if(x == " " || x == null || x == "")
   {
      document.getElementById('search_err').innerHTML = "אנא הכנס טקסט לחיפוש";
	  $("#search_err").show('slow');
      return false;
   }
   else if(x.length < 4)
   {
	  document.getElementById('search_err').innerHTML = "טקסט החיפוש קצר מדי.<br />הטקסט יכול לכלול 4 תווים ומעלה.";
      $("#search_err").show('slow');
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
      return false;
}

function clearSearch()
{
   document.getElementById('search-text').value = "";
   document.getElementById('search_err').innerHTML = "";
}
</script>
<div id="search">
	<form id="search-form" action="index.php?page=search_results" method="post">
	<div>
		<input type="text" id="search-text" name="s" title="חיפוש באתר" onkeyup="return checkSearch()" onblur="clearSearch()" /> <b dir="rtl">חיפוש: </b>
		<br />
		<div id="search_by">חפש לפי:
		   <input type="radio" name="searchBy" value="pages" checked="checked" />דפים 
		   <input type="radio" name="searchBy" value="content" />תוכן
		   <br />(הקש אנטר על מנת לחפש)
		</div>
	</div>	
	<div id="search_err"></div>
	</form>
</div>
