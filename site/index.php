<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
require_once('config.php');

$ip = $_SERVER['REMOTE_ADDR'];
$list = file_get_contents("banned_list.txt");

if(strlen(strstr($list,$ip)) > 0)
{
   $_SESSION['message'] = "Banned";
   header("location:message.php");
}

$output = "";
$sign = "";
$user = "";
$edit = "";
$u = $_COOKIE['user'];
if(!empty($_SESSION['user']))
{
   if($_SESSION['user'] == "admin")
   {
      $output = '<a id="showClist" href="javascript:void(0);"><img id=dropdown src=images/dropdown.gif alt=Dropdown />לוח בקרה</a>
	  <div id="clist_container">
	  <ul id="clist">
	     <li><a href="AdminCP.php?page=UpdateUser">עדכון משתמש</a></li>
         <li><a href="AdminCP.php?page=DeleteUser">מחיקת משתמש</a></li>
         <li><a href="AdminCP.php?page=AdminShowUsers">הצגת משתמשים</a></li>
         <li><a href="AdminCP.php?page=AdminShowUsersBy">הצג משתמשים לפי</a></li>
         <li><a href="comments.php">מערכת תגובות</a></li>
         <li><a href="AdminCP.php?page=Send_PM">שלח הודעה פרטית</a></li>
         <li><a href="AdminCP.php?page=Incoming_Messages">הודעות נכנסות</a></li>
         <li><a href="AdminCP.php?page=Outgoing_Messages">הודעות יוצאות</a></li>
		 <li><a href="manage.php">ניהול אתר</a></li>
         <li><a href="AdminCP.php?page=Logout">התנתק</a></li>
	  </ul>
	  </div>
	  ';
   }
   else
   {
      $output = '<a id="showClist" href="javascript:void(0);"><img id=dropdown src=images/dropdown.gif alt=Dropdown />לוח בקרה</a>
	  <div id="clist_container">
	  <ul id="clist">
	     <li><a href="UserCP.php?page=UpdateAcc">עדכון משתמש</a></li>
         <li><a href="UserCP.php?page=DeleteAcc">מחיקת משתמש</a></li>
         <li><a href="ShowUsers.php">הצגת משתמשים</a></li>
         <li><a href="comments.php">מערכת תגובות</a></li>
         <li><a href="UserCP.php?page=Logout">התנתק</a></li>
	  </ul>
	  </div>
	  ';
   } 
}
else
{
   $output = "<a href='Login.php'>התחבר</a>";
   $sign = "<li><a href='index.php?page=Register'>הירשם</a></li>";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="How I Met Your Mother" />
<meta name="description" content="How I Met Your Mother" />
<meta name="author" content="Dor Elbaz" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>איך פגשתי את אמא</title>
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
<link rel="icon" href="images/Browser.ico" />
<script type="text/javascript" src="JS/jquery.js"></script>
<script type="text/javascript" src="JS/scripts.js"></script>
</head>
<body>
<div id="wrapper">
	<div id="header-wrapper">
		<div id="header">
			<div id="logo">
			   <h2><a href="index.php">איך פגשתי את אמא</a></h2> 
			</div>
			<div id="menu">
			  <form name="Fsearch_form" method="post" action="index.php?page=search_results" onsubmit="return checkSearch()">
				<ul>
                    <li class="current_page_item"><a href="index.php">ראשי</a></li> <li><span class="seperator"></span></li>
					<li><?php echo $output; ?></li> <li><span class="seperator"></span></li>
					<?php echo $sign; ?> <li><span class="seperator"></span></li>
					<li><a href="quiz.php">שאלון</a> <li><span class="seperator"></span></li>
					<li><a href="contact.php">צור קשר</a> <li><span class="seperator"></span></li>
                    <li id="search_form">
					   <strong>חפש:</strong>
                       <input type="text" id="search_term" name="search_term" title="הקש אנטר על מנת לחפש" />					   
                       <span id="searchBy" dir="rtl">חפש לפי:
	                      <input type="radio" name="searchBy" value="pages" checked="checked" />דפים 
	                      <input type="radio" name="searchBy" value="content" />תוכן   			      
                       </span> 					   
					</li>					   
				</ul>
		      </form>
			</div>
		</div>
	</div>
	<!-- end #header -->
	<div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
				<div id="content" dir="rtl" style="background-color:transparent">
				<?php
				$page = secure('page');
				switch($page)
				{
				   /* Default */
				   default:require_once('main.php');break;
				   case 'info':require_once('info.php');break;
				   case 'extras':require_once('extras.php');break;
				   case 'slideshow':require_once('slideshow.php');break;
				   case 'bet':require_once('bet.html');break;
				   case 'links':require_once('links.html');break;
				   case 'Register':require_once('Register.php');break;
				   case 'WrongPage':require_once('WrongPage.html');
				   case 'search_results':require_once('search_results.php');break;
				   case 'comments':require_once('comments.php');break;
				   case 'forgotten_pass':require_once('forgot_pass.php');break;
				   //case '':require_once('.php');break;
				   //case '':require_once('.html');break;
				}
				?>
				</div>
				<!-- end #content -->
				<div id="sidebar">
					<ul>
						<li>
						   <div id="select_ep">
						   <?php require_once "select_ep.php"; ?>
						   </div> 
							<div style="clear: both;">&nbsp;</div>
						</li>
						    <h2>על הסדרה</h2>
							<div class="sidebar_item">
							<ul>
                              <li style="padding-left:130px"><a href="index.php?page=info">מידע</a></li>
                              <li style="padding-left:130px"><a href="characters.php">הדמויות</a></li>
                              <li style="padding-left:110px"><a href="previews.php">תקצירי העונות</a></li>
                              <li style="padding-left:125px"><a href="index.php?page=extras">תוספות</a></li>
                            </ul>
							</div>
							<div style="clear: both;">&nbsp;</div>
							<h2>צפייה ישירה</h2>
							<div class="sidebar_item">
							<ul id="list">
								<li><a href="DirectWatch.php?season=1">עונה 1</a></li>
								<li><a href="DirectWatch.php?season=2">עונה 2</a></li>
								<li><a href="DirectWatch.php?season=3">עונה 3</a></li>
								<li><a href="DirectWatch.php?season=4">עונה 4</a></li>
								<li><a href="DirectWatch.php?season=5">עונה 5</a></li>
								<li><a href="DirectWatch.php?season=6">עונה 6</a></li>
								<li><a href="DirectWatch.php?season=7">עונה 7</a></li>
							</ul>
							</div>
					</ul>
				</div>
				<!-- end #sidebar -->
				<div style="clear: both;">&nbsp;</div>
			</div>
		</div>
	</div>	
	<!-- end #page -->
</div>
<?php echo $edit; ?>
<div id="footer">
	<p style="font-size:small">&copy; Dor Elbaz</p>
</div>
<!-- end #footer -->
<!--
<div id="toolbar_options">
<span id="option_main">
<center><strong>אפשרויות סרגל כלים</strong></center> <br />
<span>הצג בסרגל הכלים:</span> <br /><br />
<input type="checkbox" id="toolbar_item1" name="toolbar_item" value="DirectWatch" />צפייה ישירה <br />
<input type="checkbox" id="toolbar_item2" name="toolbar_item" value="CPanel" />לוח בקרה <br />
<input type="checkbox" id="toolbar_item3" name="toolbar_item" value="comments" />מערכת תגובות <br />
<input type="checkbox" id="toolbar_item4" name="toolbar_item" value="quiz" />שאלון <br />
<center><input type="button" id="saveChanges" value="שמור שינויים &raquo;" /></center>
</span>
</div>
<div id="options_main_toolbar">
<span id="close_bar" title="החבא סרגל כלים"><img src="optionsbar/close.png" alt="Hide" /></span>
<span id="show_bar" title="הצג סרגל כלים"><img src="optionsbar/show.png" alt="Show" /></span>
<form method="post" action="">
<ul id="options_bar_list">
   <li id="option_mainItem"><img src="optionsbar/options.png" alt="Options" /></li>
</ul>
</form>
</div>
-->		
<!-- end options bar -->
</body>
</html>

