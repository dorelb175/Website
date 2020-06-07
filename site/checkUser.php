<?php
require_once "config.php";
if(isset($_GET['u']))
{
   $u = secure('u');
   $sql = mysql_query("SELECT * FROM `users` WHERE `username` = '".$u."'");
   if(mysql_num_rows($sql) == 1)
   {
      echo "<span style='color:red'>שם משתמש זה כבר קיים</span>";
   }
   else
   {
      echo "<span style='color:green'>שם משתמש פנוי</span>";
   }
}
if(isset($_GET['e']))
{
   $e = secure('e');
   $sql = mysql_query("SELECT * FROM `users` WHERE `email` = '".$e."'");
   if(mysql_num_rows($sql) == 1)
   {
      echo "<span style='color:red'>אימייל זה כבר קיים</span>";
   }
   else
   {
      echo "<span style='color:green'>האימייל פנוי</span>";
   }
}
?>