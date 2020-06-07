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

$output;
$sign = "";
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
<title>How I Met Your Mother</title>
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
<link rel="icon" href="images/Browser.ico" />
<script type="text/javascript" src="JS/jquery.js"></script>
<script type="text/javascript" src="JS/scripts.js"></script>
<script type="text/javascript">
    function CheckSubject() {
        var x = document.getElementById("subject");
        if (x.value == "0") 
            return false;
        else
            return true;
    }

    function CheckName() {
        var x = document.getElementById("name").value;
        if (x.length == 0)
            return false;
        else
            return true;
    }

    function CheckEmail() {
        var x = document.getElementById("email").value;
        if (x.length == 0)
            return false;
        else
            return true;
    }

    function CheckText() {
        var x = document.getElementById("text").value;
        if (x.length == 0)
            return false;
        else
            return true;
    }

    function Check() {
        if (CheckSubject() && CheckName() && CheckEmail() && CheckText()) {
            return true;
        }
        else {
            document.getElementById('Error').innerHTML = "<img class='warn' src='images/warning.png' alt='Warning' />&nbsp;<span style='color:red'>נא למלא את כל השדות</span>";        
            return false;
        }
    }

    function load() {
        document.getElementById('Error').innerHTML = "<img id='img' src='images/loader.gif' alt='Loading...' />";
        document.getElementById('img').src = "images/loader.gif";
    }
</script>
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
$msg = "";

if(isset($_POST['Send']))
{
   $to = 'dor_elbaz7@walla.co.il';
   $subject = "=?UTF-8?B?".base64_encode($_POST['subject'])."?=";
   $email = $_POST['email'];
   $name = $_POST['name'] ;
   $message = "<html><head>
   <meta http-equiv='content-type' content='text/html; charset=utf-8' />
   <title>$subject</title></head>
   <body dir='rtl' style='text-align: right;float:right'>שם: $name<br />
   אימייל: $email<br />
   הודעה:{$_POST['text']}</body></html>";
   
   $email_from = "admin@himymtv.tk";
   $headers = "MIME-Version: 1.0\r\nContent-Type:text/html;charset=utf-8\r\nTo: $to <$to>\r\nFrom: $email_from <$email_from>\r\n";
   mail($to, $subject, $message, $headers) or die("האימייל לא נשלח");
   $msg = "<p style='color:green'>האימייל נשלח !</p>";
}
?>
<center><div style="font-size:x-large;color:Purple">צור קשר</div></center>
<form method="post" action="" onsubmit="return Check()">
<table>
  <tr><td>נושא: </td><td>
    <select id="subject" name="subject">
        <option value="0" selected="selected">בחר נושא</option>
		<option value="defective link">לינק פגום</option>
		<option value="complaint">תלונה</option>
		<option value="error">דיווח על תקלה</option>
		<option value="report user">דיווח על משתמש</option>
		<option value="other">אחר</option>
	</select>
  </td></tr>
  <tr><td>שם: </td><td><input type="text" id="name" name="name" /></td> </tr>
  <tr><td>אימייל: </td><td><input type="text" id="email" name="email" /></td> </tr>
  <tr><td>הודעה: </td><td><textarea cols="40" rows="7" id="text" name="text"></textarea></td> </tr>
  <tr><td>&nbsp;</td></tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center">
      <input type="submit" id="Submit" name="Send" value="שלח" onclick="load()" />
      <input type="reset" value="נקה" />
    </td>
  </tr>
  <tr><td>&nbsp;</td></tr>
  <tr><td id="Error" colspan="2"></td></tr>
</table>
</form>
<?php echo $msg; ?>
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
<div id="footer">
	<p style="font-size:small">&copy; Dor Elbaz</p>
</div>
<!-- end #footer -->
</body>
</html>
