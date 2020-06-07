<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
require_once "config.php";

$ip = $_SERVER['REMOTE_ADDR'];
$list = file_get_contents("banned_list.txt");

if(strlen(strstr($list,$ip)) > 0)
{
   $_SESSION['message'] = "Banned";
   header("location:message.php");
}


if($_SESSION['user'] != "admin")
{
   $_SESSION['message'] = 'MustAdmin';
   header("location: message.php");
}

/* Pages */

$msg = "";
$current_text = '';

if(isset($_POST['content']) && trim($_POST['content']) != '')
{
  if(isset($_GET['id']) && ctype_digit($_GET['id']))
  {
     $c = secure('content');
	 $t = secure('title');
	 $u = secure('url');
	 $des = secure('desc');
	 $k = secure('keywords');
     mysql_query("UPDATE `pages` SET `title` = '".$t."',`content` = '".$c."',`url` = '".$u."',`description` = '".$des."',`keywords` = '".$k."' WHERE `id` = " . $_GET['id']);
     $msg = "<a style='color:yellow' href='show.php?id=".$_GET['id']."'><b>העמוד אחרי עריכה</b></a>";
  }
  else
  {
     $c = secure('content');
	 $t = secure('title');
	 $u = secure('url');
	 $des = secure('desc');
	 $k = secure('keywords');
     mysql_query("INSERT INTO `pages` (`title`,`content`,`url`,`description`,`keywords`)VALUES ('".$t."','".$c."','".$u."','".$des."','".$k."')");
     $msg = "<a style='color:yellow' href='show.php?id=".mysql_insert_id()."'><b>העמוד החדש</b></a>";
  }
}

$page_title = '';
$page_url = '';
$page_desc = '';
$page_key = '';

if(isset($_GET['id']) && ctype_digit($_GET['id']))
{
  $pageResource = mysql_query("SELECT * FROM `pages` WHERE `id`=".$_GET['id']);

  if(mysql_num_rows($pageResource) == 1)
  {
     $page = mysql_fetch_assoc($pageResource);
     $current_text = $page['content'];
	 $page_title = $page['title'];
	 $page_url = $page['url'];
	 $page_desc = $page['description'];
	 $page_key = $page['keywords'];
  }
}

//show pages
$all_pages = '<table dir="rtl" border="0" cellpadding="10" style="color:white;font-size:smaller">';
$all_pages .= "<tr style=color:yellow;><td>ID</td><td>כותרת</td><td>קישור לדף</td></tr>";
$pages_query = mysql_query("SELECT * FROM `pages`");

while($allPages = mysql_fetch_assoc($pages_query))
{
   $all_pages .= "<tr><td class='page_id'>$allPages[id]</td><td class='page_title'><a href='manage.php?id=$allPages[id]'><b>$allPages[title]</b></a></td><td class='page_url'><a href='$allPages[url]'><b>קישור לדף</b></a></td></tr>";
}
$all_pages .= "</table>";


/* Files */

$filename = '';
$file_ext = '';
$file_content = '';

if(isset($_POST['filename']))
{
   if(isset($_POST['Send_File']))
   {
      $filename = $_POST['filename'];
      $file_ext = $_POST['extension'];
	  $file_content = $_POST['file_content'];
	  $name = $filename.'.'.$file_ext;
	  $fp = fopen($name,"w+");
	  fwrite($fp,$file_content);
   }
   else
   {
	  $filename = $_POST['filename'];
      $file_ext = $_POST['extension'];
	  $name = $filename.'.'.$file_ext;
      if(file_exists($name))
      {
         $fp = fopen($name,"r");
         $file_content = fread($fp,filesize($name));
      }
      else
      {
         $file_err = "הקובץ אינו קיים";
      }
   }
}

//Get file list
$file_list = '';
$dir = scandir("./");
for($i = 0; $i < count($dir); $i++)
{
    $ext_file = end(explode(".", $dir[$i]));
	if(!($dir[$i] == "." || $dir[$i] == ".." || $dir[$i] == "Thumbs.db") && ($ext_file == "php" || $ext_file == "html" || $ext_file == "txt" || $ext_file == "js"))
	{    
       $file_list .= $dir[$i]."<br /><br />";
    }
}


/* Database */


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="How I Met Your Mother" />
<meta name="description" content="How I Met Your Mother" />
<meta name="author" content="Dor Elbaz" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>How I Met Your Mother</title>
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
<link rel="icon" href="images/Browser.ico" />
<style type="text/css">
body
{
    margin:0 30px;
	float:right;
	direction:rtl;
}
</style>
<script type="text/javascript" src="JS/jquery.js"></script>
<script type="text/javascript" src="JS/manage.js"></script>
</head>
<body>
<a href="AdminCP.php"><b style="color:#fff;text-decoration:underline;">חזור ללוח בקרה</b></a>
<center><h2>ניהול אתר</h2></center> <br /><br />
<div id="manage_error"><?php echo $msg; ?></div>
<br />
<center style="width:948px" id="manage_tools">
   <button id="go_manage_page">ניהול דפים</button> || 
   <button id="go_manage_files">ניהול קבצים</button> ||
   <button id="go_manage_db">ניהול מסד</button>
</center>
<br /><br />
<div id="main_manage">
<div id="page_manage">
<center><h3>ניהול דפים</h3></center>
<form name="edit_page_form" method="post" action="">
  <b>כותרת: </b> <input type="text" name="title" value="<?php echo $page_title;?>" /> <br />
  <b>כתובת: </b> <input type="text" name="url" value="<?php echo $page_url;?>" /> <br /><br />
  <b>תיאור הדף: </b> <textarea name="desc" cols="30" rows="3"><?php echo $page_desc;?></textarea> <br /><br />
  <b>מילות מפתח: </b> <textarea name="keywords" cols="30" rows="5"><?php echo $page_key;?></textarea> <br /><br /><br />
  <div class="edit_options">
     <a href="javascript:edit('b');">B</a>
	 <a href="javascript:edit('i');"><i>I</i></a>
	 <a href="javascript:edit('u');"><u>U</u></a>
	 <a href="javascript:edit('title');">title</a>
	 <a href="javascript:edit('center');">center</a>
	 <a href="javascript:edit('div');">div</a>
	 <a href="javascript:edit('span');">span</a>
	 <a href="javascript:edit('a');">a</a>
	 <a href="javascript:edit('p');">p</a>
	 <a href="javascript:edit('img');">img</a>
	 <a href="javascript:edit('table');">table</a>
     <a href="javascript:edit('form');">form</a>
	 <a href="javascript:edit('input');">input</a>
	 <a href="javascript:edit('textarea');">textarea</a>	 
	 <a href="javascript:edit('option');">Other tag</a>
  </div>
  <b>תוכן הדף: </b> 
  <textarea dir="ltr" id="page_content" name="content" rows="35" cols="113" onselect="setCaret(this);" onclick="setCaret(this);" onkeyup="setCaret(this);"><?php echo $current_text; ?></textarea>
  <br />
  <a href="javascript:void(0);" id="showPrev" target="_blank" onclick="prev()"><b style="color:#fff;text-decoration:underline;">תצוגה מקדימה</b></a>

  <center> <input type="submit" class="submit_page" /> <input type="button" class="submit_page" value="ביטול" onclick="cancel();" /> </center>
</form>
<br /><br /><h3>רשימת הדפים:</h3>
<span id="page_list"><?php echo $all_pages; ?></span>
</div>
<!-- Manage Files -->
<div id="file_manage">
<center><h3>ניהול קבצים</h3></center>
<span style="color:Red"><?php echo $file_err; ?></span>
<div id="manage_file_error"></div>
<br /><br />
<form name="edit_file_form" method="post" action="" onsubmit="return checkFile();">
<b>שם הקובץ: </b> <input type="text" id="filename" name="filename" value="<?php echo $filename; ?>" /> <br />
<b>סיומת: </b> <input type="text" id="extension" name="extension" value="<?php echo $file_ext; ?>" /> <br />
<br /> <br /> 
<button class="submit_page" id="load_file">טען קובץ</button>
<input type="button" class="submit_page" id="del_file" value="מחק קובץ" />
<br /><br />
<b>תוכן הקובץ:</b> <br />
<div class="edit_options" style="margin:0 0 1px 20px">
     <a href="javascript:editFile('b');">B</a>
	 <a href="javascript:editFile('i');"><i>I</i></a>
	 <a href="javascript:editFile('u');"><u>U</u></a>
	 <a href="javascript:editFile('title');">title</a>
	 <a href="javascript:editFile('center');">center</a>
	 <a href="javascript:editFile('div');">div</a>
	 <a href="javascript:editFile('span');">span</a>
	 <a href="javascript:editFile('a');">a</a>
	 <a href="javascript:editFile('p');">p</a>
	 <a href="javascript:editFile('img');">img</a>
	 <a href="javascript:editFile('table');">table</a>
     <a href="javascript:editFile('form');">form</a>
	 <a href="javascript:editFile('input');">input</a>
	 <a href="javascript:editFile('textarea');">textarea</a>	 
	 <a href="javascript:editFile('option');">Other tag</a>
</div>
<textarea dir="ltr" id="file_content" name="file_content" rows="35" cols="113" onselect="setCaret(this);" onclick="setCaret(this);" onkeyup="setCaret(this);"><?php echo $file_content; ?></textarea> <br />
<center> 
   <input type="submit" name="Send_File" class="submit_page" /> 
   <input type="button" class="submit_page" value="ביטול" onclick="cancel();" /> 
</center>
</form>
<br />
<center><h3>רשימת הקבצים: </h3></center> <br />
<span id="file_list"><?php echo $file_list; ?></span>
</div>
<!-- Tables Manage -->
<div id="db_manage">
<center><h3>ניהול מסד נתונים</h3>
<h4>רשימת טבלאות במסד:</h4> 
<?php echo getTablesAs('database'); ?>
<br>
<span id="table_message"></span>
</center>
</div>
</div>
<form name="p" method="post" action="page_preview.php">
<textarea id="pre" name="pre" cols="60" rows="3" style="visibility:hidden;"></textarea>
</form>
</body>
</html>

