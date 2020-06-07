<?php
   $msg = "";
   $pageResource = mysql_query("SELECT * FROM `pages` WHERE `id` = '1'");
   if(mysql_num_rows($pageResource) != 1)
   {
      $msg = 'הדף המבוקש אינו נמצא';
   }
   else
   {
      $page = mysql_fetch_assoc($pageResource);
      $msg = $page['content'];
   }
   echo $msg; 
?>