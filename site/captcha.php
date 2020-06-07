<?php
session_start();

function random($length)
{
   $chars = "abcdefghijklmnopqrstuvwxyz23456789";
   $str = "";
   $s = strlen($chars);
   
   for($i = 0; $i < $length; ++$i)
   {
      $str .= $chars[rand(0, $s - 1)];
   }
   return $str;
}

$cap = random(7);
$_SESSION['cap'] = $cap;

$image = imagecreate(100, 40);
$bg = imagecolorallocate($image, 0, 0, 0); //Black
$fg = imagecolorallocate($image, 255, 255, 255); //White
$font = 7;
imagestring($image, $font, 17, 8, $cap, $fg);
header("Content-type: image/jpeg");
imagejpeg($image);
imagedestroy($image);
?>