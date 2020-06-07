<?php
require_once "config.php";
$selectChar = '
<center><h2>פינת דיונים</h2> <br /><br />
<b>בחר דמות מועדפת:</b></center> <br />
<form method="post" action="">
<table>
   <tr><td><input type="radio" name="char" value="ted" />טד</td></tr>
   <tr><td><input type="radio" name="char" value="robin" />רובין</td></tr>
   <tr><td><input type="radio" name="char" value="marshall" />מרשל</td></tr>
   <tr><td><input type="radio" name="char" value="lily" />לילי</td></tr>
   <tr><td><input type="radio" name="char" value="barney" />ברני</td></tr>
   <tr><td><input type="submit" name="SelectChar" value="אישור" /></td></tr>
</table>
</form>';
if($_SESSION['SelectChar'] == 'false')
{
   echo $selectChar;
   if(isset($_POST['SelectChar']))
   {
      $c = $_POST['char'];
	  $s = mysql_query("SELECT * FROM favchar WHERE id = '1'");
	  $val;
	  $v;
	  while($r = mysql_fetch_assoc($s))
	  {
	     $val = $r[$c];
	     $v = $val + 1;
	  }
	  mysql_query("UPDATE favchar SET ".$c." = '$v'");
	  $_SESSION['SelectChar'] = "true";
	  header("location: discussions.php?d=FavoriteCharacter");
   }
}
else
{
   getVotes();
   $disc = '
   <b>מיהי הדמות המועדפת עליך ?</b><br />
   <form method="post" action="">
   שם: <input type="text" name="name" /><br />
   <textarea name="message" maxlength="200"></textarea><br />
   <input type="submit" name="Send" />
   </form><p /><br />';
   echo $disc;
   if(isset($_POST['Send']))
   {
      if(empty($_POST['name']))
	  {
	     echo "אנא הכנס שם";
	  }
	  else if(empty($_POST['message']))
	  {
	     echo "אנא הכנס הודעה";
	  }
	  else
	  {
	     $name = secure('name');
		 $msg = secure('message');
		 mysql_query("INSERT INTO discussions (`subject`,`name`,`message`) VALUES('FavChar','$name','$msg')");
	  }
   }
   echo "<div dir='rtl' style='background-color:white;color:red;font-weight:bold;padding:5px;'>";
   getMessages();
   echo "</div>";
}

function getVotes()
{
   $ted;$robin;$marshall;$lily;$barney;
   $sql = mysql_query("SELECT * FROM favchar WHERE id = '1'");
   while($row = mysql_fetch_assoc($sql))
   {
      $ted = '<em>טד:</em><b> '.$row['ted'].' קולות</b>';
	  $robin = '<em>רובין:</em><b> '.$row['robin'].' קולות</b>';
	  $marshall = '<em>מרשל:</em><b> '.$row['marshall'].' קולות</b>';
	  $lily = '<em>לילי:</em><b> '.$row['lily'].' קולות</b>';
	  $barney = '<em>ברני:</em><b> '.$row['barney'].' קולות</b>';
   }
   echo "<center><h2>פינת דיונים</h2></center><br /><h3><i>הקולות:</i></h3><br />";
   echo "$ted<br /><br />$robin<br /><br />$marshall<br /><br />$lily<br /><br />$barney<p /><br /><br />";
}

function getMessages()
{
   $messages = "";
   $s = mysql_query("SELECT * FROM discussions WHERE `subject` = 'FavChar'");
   while($arr = mysql_fetch_assoc($s))
   {
      $a = $arr['message'];$b = $arr['name'];
	  $n = wordwrap($b , 50 , "<br />\n" , true);
	  $m = wordwrap($a , 50, "<br />\n" , true);
      $messages .= "<span>שם: $n<br />$m</span><br /><br />";
   }
   echo $messages;
}
?>

