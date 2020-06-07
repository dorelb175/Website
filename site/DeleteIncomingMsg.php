<?php
session_start();
require_once('config.php');
$id = $_GET['id'];
$val = 1;
mysql_query("UPDATE pm set delete_get = $val WHERE id='$id'") or die("מחיקת ההודעה נכשלה עקב בעיה מסוימת");
$msg = "ההודעה נמחקה !";
$msg .= "<br /><br /><br />"."<a href='User.php?act=Incoming_Messages'>חזור להודעות נכנסות</a>";
header("location:UserCP.php?page=Incoming_Messages");
echo $msg;
?>