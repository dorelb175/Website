<?php
require_once "config.php";
if(isset($_GET['DirectWatch']))
{
   if($_GET['DirectWatch'] == 'true')
   {
      mysql_query("UPDATE toolbar SET `show` = 1 WHERE `item_num` = 1");
   }
   else if($_GET['DirectWatch'] == 'false')
   {
       mysql_query("UPDATE toolbar SET `show` = 0 WHERE `item_num` = 1");
   }
}
if(isset($_GET['CPanel']))
{
   if($_GET['CPanel'] == 'true')
   {
      mysql_query("UPDATE toolbar SET `show` = 1 WHERE `item_num` = 2");
   }
   else if($_GET['CPanel'] == 'false')
   {
       mysql_query("UPDATE toolbar SET `show` = 0 WHERE `item_num` = 2");
   }
}
if(isset($_GET['comments']))
{
   if($_GET['comments'] == 'true')
   {
      mysql_query("UPDATE toolbar SET `show` = 1 WHERE `item_num` = 3");
   }
   else if($_GET['comments'] == 'false')
   {
       mysql_query("UPDATE toolbar SET `show` = 0 WHERE `item_num` = 3");
   }
}
if(isset($_GET['quiz']))
{
   if($_GET['quiz'] == 'true')
   {
      mysql_query("UPDATE toolbar SET `show` = 1 WHERE `item_num` = 4");
   }
   else if($_GET['quiz'] == 'false')
   {
       mysql_query("UPDATE toolbar SET `show` = 0 WHERE `item_num` = 4");
   }
}
?>