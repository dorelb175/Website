<html>
<head>
   <title></title>
<script type="text/javascript" src="JS/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $("#calc").click(function(){
	    var a = $("#a").val();
	    var b = $("#b").val();
	    var c = $("#c").val();
		if(a >= 0 && b >= 0 && c >=0)
		{
		   calc(a,b,c);
		}
		else
		{
		   $("#results").css("color","red");
		   $("#results").html("הכנס מספרים");
		}
	});
});

function calc(a,b,c)
{
	var x1,x2;
	
	if((b * b) - 4 * a * c >= 0)
	{
	   x1 = (-b + Math.sqrt((b * b) - 4 * a * c)) / 2 * a;
	   x2 = (-b - Math.sqrt((b * b) - 4 * a * c)) / 2 * a;
	   $("#results").css("color","black");
	   document.getElementById('results').innerHTML = "X1 = " + x1 + "<br /><br />X2 = " + x2;
	}
	else
	{
	   $("#results").css("color","red");
	   document.getElementById('results').innerHTML = "ביטוי חסר משמעות !";
	}	
}
</script>
</head>
<body dir="rtl">
<form method="post" action="">
A:<input type="text" id="a" name="a" /> <br />
B:<input type="text" id="b" name="b" /> <br />
C:<input type="text" id="c" name="c" /> <br />
<input type="button" id="calc" value="חשב תוצאות" />
</form>
<b>תוצאות:</b>
<div id="results">

</div>
</body>
</html>