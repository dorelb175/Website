<?php
session_start();
require_once('config.php');
error_reporting(E_ALL ^ E_NOTICE);

$ip = $_SERVER['REMOTE_ADDR'];
$list = file_get_contents("banned_list.txt");

if(strlen(strstr($list,$ip)) > 0)
{
   $_SESSION['message'] = "Banned";
   header("location:message.php");
}

$output;
$sign = "";
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
   if($_SESSION['LoginFailed'] == 'true' || $_COOKIE['Login'] == sha1('Failed'))
   {
      $_SESSION['message'] = "LoginFailed";
	  header("location:message.php");
   }
}

$message = "";
if(isset($_POST['Login'])) 
{
    if(0!=0)//$_SESSION['cap'] != $_POST['image']
    {
	   $message = "הקוד שגוי";
    }	
	else 
	{
	    $ip = mysql_real_escape_string($_SERVER['REMOTE_ADDR']);
		$username = secure('username');
	    $checkLogin = mysql_query("SELECT * FROM `login` WHERE `user` = '$username'");
		$row = mysql_fetch_assoc($checkLogin);
		if($row['isLogin'] == '1')
        {
		   //$_SESSION['message'] = 'AlreadyLogin';
		   //header("location:message.php");
		   exit;
        }
        else 
        {		
           $pass = mysql_real_escape_string(md5($_POST['pass']));  
           $rem = $_POST['remember'];		
           $checkUser = mysql_query("SELECT * FROM users WHERE username = '".$username."' AND pass = '".$pass."'");

           if(mysql_num_rows($checkUser) > 0) 
	       {
              $_SESSION['user'] = $username;
		  	  $_SESSION['SelectChar'] = 'false';
			  $_SESSION['loginTry'] = 0;
			  $_SESSION['LoginFailed'] = 'false';
			  if(isset($rem))
			  {
			     setcookie('user', sha1($username . $salt), time()+3600*24);
			  }
			  $date = getDateTime();
			  //mysql_query("INSERT INTO `login` (`user`,`last_ip`,`isLogin`,`login_at`,`logout_at`) VALUES ('".$username."','".$ip."','0','".$date."','logged in') ON DUPLICATE KEY UPDATE `last_ip` = '".$ip."',`isLogin` = '0',`login_at` = '".$date."',`logout_at` = 'logged in'");
			  mysql_query("INSERT INTO `login` (`user`,`ip`,`time`) VALUES ('".$username."','".$ip."','".$date."')");
			  //header("location:index.php");
			  $message = "<span style=color:green;font-weight:bold;>התחברת בהצלחה!<br>עבור ל<a href=index.php>עמוד הבית</a></span>";
           } 
		   else 
		   {
		      $_SESSION['loginTry'] = $_SESSION['loginTry'] + 1;
			  if($_SESSION['loginTry'] == 5)
			  {
			     $_SESSION['message'] = "LoginFailed";
				 $_SESSION['LoginFailed'] = 'true';
				 setcookie('Login',sha1('Failed'),time()+600);
				 header("location:message.php");
			  }
			  else
			  {
			     $tries = 5 - $_SESSION['loginTry'];
		         $message = "<span style='color:red'>שם משתמש שגוי<br />נשארו לך {$tries} ניסיונות התחברות</span>";
              }
		   } 
        }		
    }
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
function checkLogin()
{
   var user = document.getElementById('username').value;
   var pass = document.getElementById('pass').value;
   
   if((user.length != 0 && user != null && user != "") && (pass.length != 0 && pass != null && pass != ""))
   {
      document.getElementById('LoginErr').innerHTML = "";
	  return true;
   }
   else if(user.length == 0 || user == null || user == "")
   {
      document.getElementById('LoginErr').innerHTML = "אנא הכנס שם משתמש";
	  return false;
   }
   else if(pass.length == 0 || pass == null || pass == "")
   {
      document.getElementById('LoginErr').innerHTML = "אנא הכנס סיסמה";
	  return false;
   }
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
<div style="color:Red;font-size:xx-large">התחברות</div>
<br /><br />
<form method="post" action="" onsubmit="return checkLogin()">
  <table>
    <tr><td>שם משתמש: </td><td><input type="text" id="username" name="username" /></td></tr>
    <tr><td>סיסמה: </td><td><input type="password" id="pass" name="pass" /></td></tr>
	<!--<tr><td colspan="2" align="center"><img src="captcha.php" id="captcha" alt="Captcha" /></td></tr>
	<tr><td colspan="2" align="center">הכנס קוד: <input type="text" name="image" /></td></tr>
    <tr><td colspan="2" align="center"><input type="checkbox" name="remember" />זכור אותי</td></tr>-->
	<tr>
      <td>&nbsp;</td>
      <td>
        <input type="submit" id="Login" name="Login" value="שלח" />
        <input type="reset" value="נקה" />
      </td>
    </tr>
    <tr><td colspan="2" align="center">לא משתמש רשום? <a href="index.php?page=Register" style="color:Yellow">הירשם</a></td></tr>
  </table>
</form>
<br />
<a href="index.php?page=forgotten_pass"><b>שכחתי סיסמה</b></a>
<br /><br />
<div id="LoginErr" style="color:red"><?php echo $message; ?></div>
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
	<p style="font-size:small"> Dor Elbaz</p>
</div>
<!-- end #footer -->
</body>
</html>

