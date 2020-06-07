<?php
session_start();
$ip = $_SERVER['REMOTE_ADDR'];
$file = file_get_contents("banned_list.txt");

if(strstr($file,$ip)) 
{
   $_SESSION['message'] = 'Banned';
   header("location: message.php");
}
else
{
   echo "You are not banned !";
}
?>