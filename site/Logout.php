<?php
require_once "config.php";
if(!empty($_COOKIE['user']) || !empty($_SESSION['user']))
{
   //setcookie('user','',time()+1);
   //$now = getDateTime();
   //mysql_query("UPDATE `login` SET `isLogin` = '0',`logout_at` = '".$now."' WHERE `user` = '".mysql_real_escape_string($_SESSION['user'])."'");
   session_destroy();
   echo "<h4>מנותק.</h4><br />";
   echo "<p /><a href='index.php'><b>עבור לדף הבית</b></a>";
}
else
{
   echo "<div dir='rtl'>אל תנסה להתחכם !<br />אתה לא מחובר.</div>";
   echo "<p /><a href='index.php'><b>עבור לדף הבית</b></a>";
}
?>