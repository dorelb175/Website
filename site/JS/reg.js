function checkUser()
{
   var msg = "";
   var x = document.getElementById('user').value;
   var patt = /^[A-z0-9]+$/;
   if(x.length >= 6 && x.length <= 12)
   {
      if(patt.test(x))
      {
	     $.get("checkUser.php?u="+x, function(data){
             msg = "";
		     $("#UserErr").html(data);
         });
	     user = true;
      }
      else
      {
         msg = "<span style=color:red;font-size:small;>השם חייב לכלול אותיות באנגלית ומספרים בלבד</span>"; 
		 user = false;
      }
   }
   else
   {
      msg = "<span style=color:red;font-size:small;>השם יכול להיות בין 6-12 תווים</span>";
	  user = false;
   }
   document.getElementById('UserErr').innerHTML = msg;
}

function checkFname()
{
   var msg = "";
   var x = document.getElementById('Fname').value;
   var patt = /^[A-z]+$/;
   if(x.length >= 3 && x.length <= 12)
   {
      if(patt.test(x))
      {
         msg = "<span style=color:green>השם תקין</span>";
	     fName = true;
      }
      else
      {
         msg = "<span style=color:red;font-size:small;>השם חייב לכלול אותיות באנגלית בלבד</span>";
		 fName = false;
      }
   }
   else
   {
      msg = "<span style=color:red;font-size:small;>השם יכול להיות בין 3-12 תווים</span>";
	  fName = false;
   }
   document.getElementById('FnameErr').innerHTML = msg;
}

function checkLname()
{
   var msg = "";
   var x = document.getElementById('Lname').value;
   var patt = /^[A-z]+$/;
   if(x.length >= 3 && x.length <= 12)
   {
      if(patt.test(x))
      {
         msg = "<span style=color:green>השם תקין</span>";
	     lName = true;
      }
      else
      {
         msg = "<span style=color:red;font-size:small;>השם חייב לכלול אותיות באנגלית בלבד</span>";
		 lName = false;
      }
   }
   else
   {
      msg = "<span style=color:red;font-size:small;>השם יכול להיות בין 3-12 תווים</span>";
	  lName = false;
   }
   document.getElementById('LnameErr').innerHTML = msg;
}

function checkPass()
{
   var msg = "";
   var pass1 = document.getElementById('pass').value;
   var pass2 = document.getElementById('pass2').value;
   var patt = /^[A-z0-9\W]+$/;
   if(pass1.length >= 6 && pass1.length <= 18)
   {
      if(patt.test(pass1))
      {
         if(pass1 == pass2)
	     {
	        msg = "<span style=color:green>הסיסמאות תקינות</span>";
			document.getElementById('Pass2Err').innerHTML = "";
		    pass = true;
	     }
	     else
	     {
	        document.getElementById('Pass2Err').innerHTML = "<span style=color:red>הסיסמאות אינן תואמות</span>";
			pass = false;
	     }
      }
      else
      {
         msg = "<span style=color:red;font-size:smaller;>הסיסמה חייבת לכלול אותיות באנגלית,מספרים וסימנים בלבד</span>";
		 pass = false;
      }
   }
   else
   {
      msg = "<span style=color:red;font-size:smaller;>הסיסמה יכולה להיות בין 6-18 תווים</span>";
	  pass = false;
   }
   document.getElementById('PassErr').innerHTML = msg;
}

function checkEmail()
{
   var msg = "";
   var x = document.getElementById('email').value;
   var patt = /(.+)\@(.+)\.(.+)/;
   if(patt.test(x))
   {
      msg = "";
	  $.get("checkUser.php?e="+x, function(data){
          $("#MailErr").html(data);
      });
	  mail = true;
   }
   else
   {
      msg = "<span style=color:red>האימייל אינו תקין</span>";
	  mail = false;
   }
   document.getElementById('MailErr').innerHTML = msg;
}

function checkDate()
{
   var msg = "";
   var day = document.getElementById("DayOfBirth").value;
   var month = document.getElementById("MonthOfBirth").value;
   var year = document.getElementById("YearOfBirth").value;
   
   if(day != "0" && month != "0" && year != "0")
   {
      msg = "<span style=color:green>החודש תקין</span>";
	  date = true;
   }
   else
   {
      msg = "<span style=color:red>יש לבחור יום,חודש ושנה</span>";
	  date = false;
   }
   document.getElementById('DateErr').innerHTML = msg;
}