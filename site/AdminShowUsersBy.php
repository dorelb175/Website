<?php
require_once('config.php');
if($_SESSION['user'] == "admin")
{
      if(isset($_POST['Show']))
	  {
	     $showBy = $_POST['showBy'];
		 $gender = $_POST['gender2'];
		 $favchar = $_POST['favchar2'];
		 $sql = "";
		 if($showBy == "gender")
		    $sql = mysql_query("SELECT * FROM users WHERE gender = '$gender'");
	     else if($showBy == "favchar")
		    $sql = mysql_query("SELECT * FROM users WHERE favchar = '$favchar'");
		 else if($showBy == "gender,favchar" || $showBy == "favchar,gender")
		    $sql = mysql_query("SELECT * FROM users WHERE gender = '$gender' AND favchar = '$favchar'");
			
		 $users = "<table border='0' style='font-weight:bold;font-size:smaller' cellspacing='20'>";
		 $users .= "<tr style='color:yellow'><td>ID</td><td>שם משתמש</td><td>שם פרטי</td><td>שם משפחה</td><td>אימייל</td><td>תאריך לידה</td><td>מין</td><td>דמות מועדפת</td></tr>";		 
		 while($row = mysql_fetch_array($sql))
		 {
		    $users .= "<tr style='color:white'><td>$row[id]</td><td>$row[username]</td><td>$row[fname]</td><td>$row[lname]</td><td>$row[email]</td><td>$row[DateOfBirth]</td><td>$row[gender]</td><td>$row[favchar]</td></tr>";
		 }
		 $users .= "</table>";
	  }
}
else
{
      $_SESSION['message'] = "MustAdmin";
      header('location:message.php');
}
?>
<script type="text/javascript">
    function checkF() {
        var x = document.getElementsByName("showBy");
        if (x[0].checked == true || x[1].checked == true)
            return true;
        else {
            document.getElementById('error1').innerHTML = "<span style='color:red'>סמן משהו אחד לפחות</span>";
            document.getElementById('error2').innerHTML = "<span style='color:red'>סמן משהו אחד לפחות</span>";
            return false;
        }
    }
</script>
<h3>הצג משתמשים לפי:</h3> 
<form method="post" action="" onsubmit="return checkF()">
<table>
  <tr><td><input type="checkbox" name="showBy" value="gender" />מין</td><td><select name="gender2"><option value="Male">זכר</option><option value="Female">נקבה</option></select></td><td id="error1"></td></tr>
  <tr><td><input type="checkbox" name="showBy" value="favchar" />דמות מועדפת</td><td><select name="favchar2"><option value="Ted">טד</option><option value="Robin">רובין</option><option value="Marshall">מרשל</option><option value="Lily">לילי</option><option value="Barney">ברני</option></select></td><td id="error2"></td></tr>
  <tr><td align="center"><input type="submit" name="Show" value="הצג" /></td></tr>
</table>
</form>
<br /><br />
<?php echo $users; ?>


