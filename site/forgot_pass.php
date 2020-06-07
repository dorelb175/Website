<?php
require_once "config.php";

$email_err = '';

function createPass()
{
   $chars = "abcdefghijklmnopqrstuvwxyz23456789";
   $str = "";
   $s = strlen($chars);
   
   for($i = 0; $i < 7; ++$i)
   {
      $str .= $chars[rand(0, $s - 1)];
   }
   return $str;
}

$newPass = createPass();

$mail_to = $_POST['email'];
$sub = "=?UTF-8?B?".base64_encode('סיסמתך החדשה')."?=";
$body = "<html><head>
   <meta http-equiv='content-type' content='text/html; charset=utf-8' />
   <title>$sub</title></head>
   <body dir='rtl' style='text-align: right;'>
   :היא himymtv.tk סיסמתך החדשה לאתר <br /><br /> $newPass <br /><br />
   :על מנת להתחבר לאתר עבור לקישור הזה <br />
   http://www.himymtv.tk/Login.php <br /><br /><br />
   .בתודה,הנהלת האתר
   </body></html>";
$headers = "MIME-Version: 1.0\r\nContent-Type:text/html;charset=utf-8\r\nTo: $mail_to <$mail_to>\r\n";

if(isset($_POST['email']))
{
   if($_POST['secCode'] != $_SESSION['cap'])
   {
      $email_err = "<span style='color:red'>הקוד שגוי</span>";
   }
   else
   {
      $email = mysql_real_escape_string($_POST['email']);
      $check = mysql_query("SELECT * FROM users WHERE email = '".$email."'");
      if(mysql_num_rows($check) == 1)
      {	  
	     mysql_query("UPDATE users SET `pass` = '".md5($newPass)."' WHERE email = '".$email."'");
	     $send_mail = mail($mail_to, $sub, $body, $headers);
	     if($send_mail)
	        $email_err = "<span style='color:green'>סיסמתך החדשה נשלחה לאימייל !</span>";
	     else
	        $email_err = "<span style='color:white'>האימייל לא נשלח עקב בעיה בשרת !</span>";
      }
      else
      {
         $email_err = "<span style='color:red'>אימייל זה אינו קיים</span>";
      }
   }
}
?>
<form method="post" action="">
<b style="color:White">הכנס את האימייל שאיתו נרשמת:</b> <br /><br />
<input type="text" name="email" /> <br ><br />
<img id="secure_code" src="captcha.php" alt="Security Code" /> <img id="reload_captcha" src="images/reload.png" alt="Reload Captcha" /> <br /><br />
הכנס את הקוד שלמעלה: <br /><input type="text" name="secCode" /> <br /><br />
<input type="submit" value="שחזר סיסמה" />
</form>
<br />
<?php echo $email_err; ?>