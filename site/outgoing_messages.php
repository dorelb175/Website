<h3><i>הודעות יוצאות</i></h3>
<?php
require_once('config.php');
if(!empty($_SESSION['user']))
{
   $num = 0;
   $user = $_SESSION['user'];
   $sql = mysql_query("SELECT * FROM pm WHERE send_username = '$user' AND delete_send = '0'");
   $messages = "";

   while($row = mysql_fetch_array($sql))
   {
      ++$num;
	  $m = $row['id'];
      $messages .= "<div class='pm'><a href='DeleteOutgoingMsg.php?id=$m'><img class='del' src='images/delete.png' alt='הסר הודעה מהודעות נכנסות' name='del_msg' /></a>&nbsp;&nbsp;&nbsp;<img class='read_msg' src='images/read-message.png' alt='הודעה שנקראה' /><b class='pm_num' style='color:white'>$num.</b>&nbsp;<a href='javascript:void(0);' onclick='show($m)'><b>נושא: </b>&nbsp;<em>$row[subject]</em>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>אל: </b>&nbsp;<em>$row[get_username]</em></a></div><br />";
   }
   
   if($messages == "")
      echo "<b>אין הודעות יוצאות</b>";
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
function show(id)
{
   document.getElementById('showpm').src = "pm.php?id=" + id;
}
</script>
<br><br>
<iframe name="pm" id="showpm" src="" frameborder="1" width="90%" height="40%" scrolling="auto">

</iframe>
