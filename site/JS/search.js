$(document).ready(function(){
    $("#search_err").hide();
	$("#closeWin").click(function(){
	    $("#search_err").hide('slow');
	});
});

function checkTerm()
{
   var x = document.getElementById('search_term').value;
   if(x != " " && x != null && x != "" && x.length >= 4)
   {
      document.getElementById('search_err').innerHTML = "";
      return true;
   }
   else if(x == " " || x == null || x == "")
   {
      document.getElementById('err_text').innerHTML = "אנא הכנס טקסט לחיפוש";
	  $("#search_err").show('slow');
      return false;
   }
   else if(x.length < 4)
   {
	  document.getElementById('err_text').innerHTML = ".טקסט החיפוש קצר מדי<br />.הטקסט יכול לכלול 4 תווים ומעלה";
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
   {
      return false;
   }
}