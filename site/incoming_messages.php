<h3><i>הודעות נכנסות</i></h3>
<?php
require_once('config.php');
if(!empty($_SESSION['user']))
{
   $num = 0;
   $user = $_SESSION['user'];
   $sql = mysql_query("SELECT * FROM pm WHERE get_username = '$user' AND delete_get = '0'");
   $messages = "";
   $m; 

   while($row = mysql_fetch_array($sql))
   {
      ++$num;
	  $m = $row['id'];
	  if($row['read'] == '1')
	  {
	     $messages .= "<div class='pm'><a href='DeleteIncomingMsg.php?id=$m'><img class='del' src='images/delete.png' alt='הסר הודעה מהודעות נכנסות' name='del_msg' /></a>&nbsp;&nbsp;&nbsp;<img class='read_msg' src='images/read-message.png' alt='הודעה שנקראה' /><b class='pm_num' style='color:white'>$num.</b>&nbsp;<a href='javascript:void(0);' onclick='show($m, 0)'><b>נושא: </b>&nbsp;<em>$row[subject]</em>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>מאת: </b>&nbsp;<em>$row[send_username]</em></a></div><br />";
	  }
	  else
	  {
		 $messages .= "<div class='pm'><a href='DeleteIncomingMsg.php?id=$m'><img class='del' src='images/delete.png' alt='הסר הודעה מהודעות נכנסות' name='del_msg' /></a>&nbsp;&nbsp;<img class='read_msg' src='images/unread-message.png' alt='הודעה שלא נקראה' /><b class='pm_num' style='color:white'>$num.</b>&nbsp;&nbsp;&nbsp;<a href='javascript:void(0);' onclick='show($m, 1)'><b>נושא: </b>&nbsp;<em>$row[subject]</em>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>מאת: </b>&nbsp;<em>$row[send_username]</em></a></div><br />";
	  }
   }
   
    if($messages == "")
      echo "<b>אין הודעות נכנסות</b>";
	else
	   echo $messages;
}
else
{
   $_SESSION['message'] = 'MustLogin';
   header("location:../message.php");
}
?>
<script type="text/javascript">
function show(id, read)
{
   document.getElementById('showpm').src = "pm.php?id=" + id + "&read=" + read;
}
</script>
<br><br>
<iframe name="pm" id="showpm" src="" frameborder="1" width="90%" height="40%" scrolling="auto">

</iframe>





