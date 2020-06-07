<?php
session_start();
require_once('config.php');
$id = $_GET['id'];
$val = 1;
mysql_query("UPDATE pm set delete_send = $val WHERE id='$id'") or die("מחיקת ההודעה נכשלה עקב בעיה מסוימת");
$msg = "ההודעה נמחקה !";
$msg .= "<br /><br /><br />"."<a href='UserCP.php?act=Outgoing_Messages'>חזור להודעות יוצאות</a>";
header("location:UserCP.php?page=Outgoing_Messages");
echo $msg;
?>
