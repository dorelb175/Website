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
   $_SESSION['message'] = 'MustLogin';
   header("location:message.php");
   $output = "<a href='Login.php'>התחבר</a>";
   $sign = "<li><a href='index.php?page=Register'>הירשם</a></li>";
}

if(isset($_POST['Send']))
{
   $sender = mysql_real_escape_string($_SESSION['user']);
   $sub = mysql_real_escape_string($_POST['subject']);
   $msg = mysql_real_escape_string($_POST['message']);
   $sub = strip_tags(htmlspecialchars($sub));
   $msg = strip_tags(htmlspecialchars($msg));
   $date = getDateTime();
   mysql_query("INSERT INTO comments (`send_user`,`subject`,`message`,`date`) VALUES ('".$sender."','".$sub."','".$msg."', '".$date."')");
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
				<script type="text/javascript">
				$(document).ready(function(){
				    $(".comment").fadeIn(1200);
					$("#add_com").click(function(){
					    $("#add_msg").slideToggle('slow');
					});
					$("#show_comments").click(function(){
					    $(".comment").slideToggle('slow');
					});
					$("#smiles").hide();
					$("#showSmiles").click(function(){
					    $("#smiles").show('slow');
					});
					$("#closeWindow").click(function(){
					    $("#smiles").hide('slow');
					});
				});
				
				function checkMsg()
				{
				   var name = document.getElementById('subject').value;
				   var msg = document.getElementById('comment_text').value;
				   if(name == null || name == "" || name == " ")
				   {
				      document.getElementById('comment_err').innerHTML = "<span style='color:red'>אנא הכנס נושא</span>";
					  return false;
				   }
				   else if(msg == null || msg == "" || msg == " ")
				   {
				      document.getElementById('comment_err').innerHTML = "<span style='color:red'>אנא הכנס הודעה</span>";
					  return false;
				   }
				   else
				   {
				      document.getElementById('comment_err').innerHTML = "";
					  return true;
				   }
				}
				
				function addToForm(sign)
				{
				   switch(sign)
				   {
				      case 'B':document.getElementById('comment_text').innerHTML += "<b>מודגש</b>  ";break;
					  case 'I':document.getElementById('comment_text').innerHTML += "<i>נטוי</i>  ";break;
					  case 'U':document.getElementById('comment_text').innerHTML += "<u>קו תחתון</u>  ";break;
					  case 'smile':document.getElementById('comment_text').innerHTML += ":)  ";close();break;
					  case 'happy':document.getElementById('comment_text').innerHTML += ":D  ";close();break;
					  case 'bleh':document.getElementById('comment_text').innerHTML += ":P  ";close();break;
					  case 'blush':document.getElementById('comment_text').innerHTML += ":blush:  ";close();break;
					  case 'cool':document.getElementById('comment_text').innerHTML += ":cool:  ";close();break;
					  case 'sad':document.getElementById('comment_text').innerHTML += ":(  ";close();break;
					  case 'wink':document.getElementById('comment_text').innerHTML += ";)  ";close();break;
					  case 'mad':document.getElementById('comment_text').innerHTML += ":mad:  ";close();break;
					  case 'geek':document.getElementById('comment_text').innerHTML += ":geek:  ";close();break;
					  case 'surprized':document.getElementById('comment_text').innerHTML += ":0  ";close();break;
					  case 'xd':document.getElementById('comment_text').innerHTML += "xd  ";close();break;
				   }				   
				}
				
				function close()
				{
				   $("#smiles").hide('slow');
				}		
				</script>
				<a href="javascript:void(0);" id="add_com"><img src="comments/add.png" />&raquo; הוסף תגובה</a> <br />
				<div id="add_msg">
                <form method="post" action="" onsubmit="return checkMsg()">
				<table>
				   <tr><td><span>נושא:</span></td><td><input type="text" id="subject" name="subject" maxlength="25" /></td></tr>
				   <tr> 
				      <td>אפשרויות:</td>
				      <td id="editing" align="center" colspan="2">  
						    <img src="comments/smile.png" class="smiles" onclick="addToForm('smile')" title="smile" />
						    <img src="comments/mad.png" class="smiles" onclick="addToForm('mad')" title="mad"/>
						    <img src="comments/happy.png" class="smiles" onclick="addToForm('happy')" title="happy2" />
						    <img src="comments/bleh.png" class="smiles" onclick="addToForm('bleh')" title="bleh"  />
						    <img src="comments/blush.png" class="smiles" onclick="addToForm('blush')" title="blush"  />
						    <img src="comments/cool.png"  class="smiles" onclick="addToForm('cool')" title="cool" />
						    <img src="comments/sad.png"  class="smiles" onclick="addToForm('sad')" title="sad" />
							<img src="comments/wink.png" class="smiles" onclick="addToForm('wink')" title="wink"  />
							<img src="comments/geek.png" class="smiles" onclick="addToForm('geek')" title="geek"  />
							<img src="comments/surprized.png" class="smiles" onclick="addToForm('surprized')" title="surprized"  />
							<img src="comments/xd.png" class="smiles" onclick="addToForm('xd')" title="xd"  />						 
					  </td>
				   </tr>
				   <tr><td><span>הודעה:</span></td><td><textarea id="comment_text" name="message" maxlength="250"></textarea></td></tr>
				   <tr>
				      <td colspan="2" align="center">
					     <input type="submit" class="msg_submit" name="Send" value="שלח הודעה" /> &nbsp;
					     <input type="reset" class="msg_submit" value="נקה הודעה" />
					  </td>
				   </tr>
				   <tr><td id="comment_err" colspan="2"></td></tr>
				</table>
                </form>
				</div>
				<br />
				<a href="javascript:void(0);" id="show_comments"><img src="comments/comments.png" /> &raquo; הצג/הסתר תגובות</a> <br /><br />
<?php 
$per_page = 10;
$page = 1;
$pages = '';
$comments = '';
 
if(isset($_GET['page'])) 
{
   $page = intval($_GET['page']);
   if($page < 1) 
      $page = 1;
}

$countPages = mysql_query("SELECT * FROM comments");

if(mysql_num_rows($countPages) > 0)
{
   $start_from = ($page - 1) * $per_page;
 
   $current_items = mysql_query("SELECT * FROM `comments` ORDER BY id ASC LIMIT ".$start_from.", ".$per_page."");
   if(mysql_num_rows($current_items) > 0)
   {
      while($item = mysql_fetch_assoc($current_items))
      {
         $a = $item['message'];
	     $b = wordwrap($a, 70, '<br />', true);
		 
		 $b = str_replace(":)", "<img src='comments/smile.png' alt='smile' title='smile' />", $b);
		 $b = str_replace(":D", "<img src='comments/happy.png' alt='happy' title='happy' />", $b);
		 $b = str_replace(":P", "<img src='comments/bleh.png' alt='bleh' title='bleh' />", $b);
		 $b = str_replace(":blush:", "<img src='comments/blush.png' alt='blush' title='blush' />", $b);
		 $b = str_replace(":cool:", "<img src='comments/cool.png' alt='cool' title='cool' />", $b);
		 $b = str_replace(":(", "<img src='comments/sad.png' alt='sad' title='sad' />", $b);
		 $b = str_replace(";)", "<img src='comments/wink.png' alt='wink' title='wink' />", $b);	 
		 $b = str_replace("xd", "<img src='comments/xd.png' alt='xd' title='xd' />", $b);
		 $b = str_replace("XD", "<img src='comments/xd.png' alt='xd' title='xd' />", $b);
		 $b = str_replace(":mad:", "<img src='comments/mad.png' alt='mad' title='mad' />", $b);
		 $b = str_replace(":0", "<img src='comments/surprized.png' alt='surprized' title='surprized' />", $b);
		 $b = str_replace(":geek:", "<img src='comments/geek.png' alt='geek' title='geek' />", $b);		 
         
		 $comments .= "<div id=\"$item[id]\" class=\"comment\">";
		 $comments .= "<strong>הודעה #$item[id]</strong>&nbsp;";
		 $comments .= "<i class='com_sender'>מאת: </i> ";
		 $comments .= "<span class='com_det'>$item[send_user]</span>"; 
		 $comments .= "<span class='com_date'>$item[date]</span> <br /><br />"; 
		 $comments .= "<i>נושא: </i>";
		 $comments .= "<span class='com_det'>$item[subject]</span> <br /><br />";
		 $comments .= "<span class='com_msg'>$b</span> <br /><br />";
		 $comments .= "</div> <br />";		 
      }
	  echo $comments;
	  
	  // Check Max page 

	  $max_page = 0;
	  if(mysql_num_rows($countPages) > 0) $max_page = 1;
	  if(mysql_num_rows($countPages) > 10) $max_page = 2;  
	  if(mysql_num_rows($countPages) > 20) $max_page = 3;
	  if(mysql_num_rows($countPages) > 30) $max_page = 4;
	  if(mysql_num_rows($countPages) > 40) $max_page = 5;
	  if(mysql_num_rows($countPages) > 50) $max_page = 6;
	  if(mysql_num_rows($countPages) > 60) $max_page = 7;
	  if(mysql_num_rows($countPages) > 70) $max_page = 8;
	  if(mysql_num_rows($countPages) > 80) $max_page = 9;
	  if(mysql_num_rows($countPages) > 90) $max_page = 10;
	  
	  /* Next & Previous pages */
	  
	  //Previous page
	  
	  $prev_page = $_GET['page'];
	  if($prev_page <= 1)
	  {
	     $prev_page = 1;
	  }
	  else
	  {
	     $prev_page = $_GET['page'] - 1;
	  }
	  
	  //Next page
	  
	  $next_page = $_GET['page'];
	  if(empty($next_page))
	  {
	     if($max_page == 1)
		 {
		    $next_page = 1;
		 }
		 else
		 {
		    $next_page = 2;
		 }
	  }
	  else if($next_page == $max_page)
	  {
	     $next_page = $max_page;
	  }
	  else
	  {
	     $next_page = $_GET['page'] + 1;
	  }  
	  
	  //Show Pages
	  
      if(mysql_num_rows($countPages) > 0)
         $pages = '<div id="pages"><a href="comments.php?page='.$prev_page.'"> << הקודם</a> <a href="comments.php?page=1">1</a> ';
      if(mysql_num_rows($countPages) > 10)
         $pages .= '<a href="comments.php?page=2">2</a> ';
      if(mysql_num_rows($countPages) > 20)
         $pages .= '<a href="comments.php?page=3">3</a> ';
      if(mysql_num_rows($countPages) > 30)
         $pages .= '<a href="comments.php?page=4">4</a> ';
      if(mysql_num_rows($countPages) > 40)
         $pages .= '<a href="comments.php?page=5">5</a> ';
      if(mysql_num_rows($countPages) > 50)
         $pages .= '<a href="comments.php?page=6">6</a> ';
      if(mysql_num_rows($countPages) > 60)
         $pages .= '<a href="comments.php?page=7">7</a> ';
	  if(mysql_num_rows($countPages) > 70)
         $pages .= '<a href="comments.php?page=8">8</a> ';
	  if(mysql_num_rows($countPages) > 80)
         $pages .= '<a href="comments.php?page=9">9</a> ';
	  if(mysql_num_rows($countPages) > 90)
         $pages .= '<a href="comments.php?page=10">10</a> ';
		 
      $pages .= '<a href="comments.php?page='.$next_page.'">הבא >> </a> </div>';
	  
    }
    else
    {
       echo '<b>עמוד זה אינו קיים</b> <br />'; 
    }
}
else
{
   echo "<b>אין תגובות</b>";
}
echo $pages;				
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
<div id="footer">
	<p style="font-size:small">&copy; Dor Elbaz</p>
</div>
<!-- end #footer -->
</body>
</html>
