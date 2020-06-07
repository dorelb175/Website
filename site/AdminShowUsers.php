<?php
require_once('config.php');
if($_SESSION['user'] == "admin")
{
    if(isset($_POST['Show']))
	  {
	     $display = $_POST['radio'];
		 $sql = "";
		 if($display == "id")
		    $sql = mysql_query("SELECT * FROM users ORDER BY id ASC");
		 else if($display == "username")
		    $sql = mysql_query("SELECT * FROM users ORDER BY username");
		 else if($display == "fname")
		    $sql = mysql_query("SELECT * FROM users ORDER BY fname");
		 else if($display == "lname")
		    $sql = mysql_query("SELECT * FROM users ORDER BY lname");
		 else if($display == "email")
		    $sql = mysql_query("SELECT * FROM users ORDER BY email");	
		 else if($display == "date")
		    $sql = mysql_query("SELECT * FROM users ORDER BY DateOfBirth");	
		 else if($display == "gender")
		    $sql = mysql_query("SELECT * FROM users ORDER BY gender");	
		 else if($display == "favchar")
		    $sql = mysql_query("SELECT * FROM users ORDER BY favchar");	
		
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
<h3>מיין לפי:</h3> <br />
<form action="" method="post">
<table>
<tr><td><input type="radio" value="id" name="radio" checked="checked" />ID</td></tr>
<tr><td><input type="radio" value="username" name="radio" />שם משתמש</td></tr>
<tr><td><input type="radio" value="fname" name="radio" />שם פרטי</td></tr>
<tr><td><input type="radio" value="lname" name="radio" />שם משפחה</td></tr>
<tr><td><input type="radio" value="email" name="radio" />אימייל</td></tr>
<tr><td><input type="radio" value="date" name="radio" />תאריך לידה</td></tr>
<tr><td><input type="radio" value="gender" name="radio" />מין</td></tr>
<tr><td><input type="radio" value="favchar" name="radio" />דמות מועדפת</td></tr>
<tr><td align="center"><input type="submit" value="הצג" name="Show" /></td></tr>
</table>
</form>
<br /><br />
<?php echo $users; ?>