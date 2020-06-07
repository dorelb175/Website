<?php
require_once "config.php"; 
if(!empty($_SESSION['user']))
{
   if(isset($_POST['Delete']))
   {
      $username = mysql_real_escape_string($_SESSION['user']);
      mysql_query("DELETE FROM users WHERE username = '$username'");
	  session_destroy();
	  header("location:index.php");
   }
}
else
{
   $_SESSION['message'] = "MustLogin";
   header("location:message.php");
}
?>
<script type="text/javascript">

    function checkDelete() {
        var x = document.getElementsByName("Radio");
        if (x[0].checked)
            return true;
        else
            return false;
    }
</script>
<form method="post" action="" onsubmit="return checkDelete();">
<h3>אתה בטוח שברצונך למחוק משתמש זה ?</h3>
<input type="radio" name="Radio" />כן 
<input type="radio" name="Radio" />לא
<br />
<br />
<input type="submit" id="Delete" name="Delete" value="אישור" />
</form>