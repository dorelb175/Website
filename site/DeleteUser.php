<?php
require_once "config.php";
$err = "";
if(!empty($_SESSION['user']) || empty($_SESSION['user']))
{
   if($_SESSION['user'] == "admin")
   {
      if(isset($_POST['Delete']))
	  {
	     if(IsExist())
		 {
		    $id = secure('id');
			$cmd = mysql_query("DELETE FROM users WHERE id = '$id'") or die(mysql_error());
			$err = "המשתמש נמחק בהצלחה !";
		 }
		 else
		 {
		    $err = "שם משתמש זה אינו קיים";
		 }
	  }
   }
   else
   {
      $_SESSION['message'] = "MustAdmin";
      header('location:message.php');
   }
}

function isExist()
{
   $id = secure('id');
   $exist = false;
   $sql = mysql_query("SELECT * FROM users WHERE id = '$id'");
   if(mysql_num_rows($sql) == 1)
      $exist = true;
	  
   return $exist;
}
?>
<h3>הקש את ה-ID של המשתמש שברצונך למחוק:</h3> <br />
<form action="" method="post">
<input type="text" name="id" />
<input type="submit" name="Delete" value="מחק" />
</form>
<br /><br />
<?php echo $err; ?>
<br /><br />
<?php
   $sql = mysql_query("SELECT * FROM users");
   $users = "<table style='font-weight:bold;font-size:smaller;' cellspacing='20'>";
   $users .= "<tr style='color:yellow'><td>ID</td><td>שם משתמש</td><td>שם פרטי</td><td>שם משפחה</td><td>אימייל</td><td>תאריך לידה</td><td>מין</td><td>דמות מועדפת</td></tr>";
   while($row = mysql_fetch_array($sql))
   {
      $users .= "<tr style='color:white'><td>$row[id]</td><td>$row[username]</td><td>$row[fname]</td><td>$row[lname]</td><td>$row[email]</td><td>$row[DateOfBirth]</td><td>$row[gender]</td><td>$row[favchar]</td></tr>";
   }
   $users .= "</table>";
   echo $users;
?>