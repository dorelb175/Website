<?php
if(isset($_GET['filename']))
{
   $output = '';
   $file = $_GET['filename'];
   if(file_exists($file))
   {
      unlink($file);
	  $output = "<span style=color:green>File deleted successfully!</span>";
   }
   else
   {
      $output = "<span style=color:red>File doesn't exist!</span>";
   }
   echo $output;
}
?>