<?php 
error_reporting(0);

//$con = mysql_connect("localhost","quitex_db","AhdyxO8o") or die(mysql_error());
//mysql_select_db("quitex_db",$con) or die(mysql_error());

$con = mysql_connect("localhost","root","") or die(mysql_error());
mysql_select_db("database",$con) or die(mysql_error());
mysql_query("SET NAMES 'UTF8'");

function secure($name)
{
    return mysql_real_escape_string($_REQUEST[$name]);
}

function getDateTime()
{
   $now = new DateTime();
   return mysql_real_escape_string($now->format("d/m/Y , H:i:s"));
}

function getIp()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

$key = "hjkrc7$%^*0axt4ajd2#!@masp!&dasn";
$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC));

function encrypt($text, $key, $iv)
{
   return mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $text, MCRYPT_MODE_CBC, $iv);
}

function decrypt($encrypted_text, $key, $iv)
{  
   return mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $encrypted_text, MCRYPT_MODE_CBC, $iv);
}

function sendMail($to, $subject, $body)
{
   $to = (!$to) ? "dor_elbaz7@walla.co.il" : $to;
   $subject = "=?UTF-8?B?".base64_encode($subject)."?=";
   $message = "<html>
   <head>
      <title>{$subject}</title>
	  <meta http-equiv=content-type content=text/html; charset=utf8 />
   </head>
   <body dir=rtl style=float:rigt;text-align:right>
   {$body}
   </body></html>";
   
   $email_from = "admin@himymtv.tk";
   $headers = "MIME-Version: 1.0\r\nContent-Type:text/html;charset=utf-8\r\nFrom: $email_from <$email_from>";
   mail($to, $subject, $message, $headers);
}

function getDBs()
{
   $output = '';
   $con = mysql_connect("localhost", "root", "");
   $db_list = mysql_list_dbs($con);
   while($db = mysql_fetch_object($db_list))
   {
      $output .= "<p><center><b style=color:red;font-size:x-large;>Database: ".$db->Database."</b></center><br><b style=color:green;font-size:large;>Tables:</b><br>";
      $result = mysql_list_tables($db->Database);
      $num_rows = mysql_num_rows($result);
      for ($i = 0; $i < $num_rows; $i++) 
      {
         $output .= mysql_tablename($result, $i) . "<br>";
      }
	  $output .= "</p><hr />";
   }

   return $output;
   mysql_free_result($result);
}

function getTablesFrom($db)
{
   $output = '';
   $con = mysql_connect("localhost", "root", "");
   $result = mysql_list_tables($db, $con);
   $num_rows = mysql_num_rows($result);
   for ($i = 0; $i < $num_rows; $i++) 
   {
      $output .= mysql_tablename($result, $i) . "<br>";
   }
   return $output;
}

function getTablesAs($db)
{
   $data = "<table>";
   $conn = mysql_connect("localhost", "root", "");
   $result = mysql_list_tables($db, $conn);
   $num_rows = mysql_num_rows($result);
   for ($i = 0; $i < $num_rows; $i++) 
   {
      $data .= "<tr><td><img src='images/delete.png' alt='Delete Table' class='delete' title='הסר טבלה' onclick=deleteTable('".mysql_tablename($result, $i)."'); /></td><td><a href=showTable.php?name=".mysql_tablename($result, $i).">&raquo; ".mysql_tablename($result, $i)."</a></td></tr>";
   }
   $data .= "</table>";
   
   return $data;
}

function getFieldsFrom($table) 
{
    $result = mysql_query("SELECT * FROM $table LIMIT 1");
    $describe = mysql_query("SHOW COLUMNS FROM $table");
    $num = mysql_num_fields($result);
    $output = array();
    for ($i = 0; $i < $num; ++$i) 
	{
       $field = mysql_fetch_field($result, $i);
       $field->len = mysql_field_len($result, $i);
       $output[$field->name] = $field;
    }
	
    return $output;
}

function getDataFrom($table)
{
   $output = "<table border=1 cellpadding=2px cellspacing=1px><tr>";
   $table = mysql_real_escape_string($table);
   
   $fields = getFieldsFrom($table);
   foreach ($fields as $key => $field) 
   {
      $output .= "<td>".$field->name."</td>";
   }
   $output .= "</tr>";
   
   $query = mysql_query("SELECT * FROM `$table`");
   if(mysql_num_rows($query) > 0)
   { 
      while($r = mysql_fetch_assoc($query))
      {
         $output .= "<tr>";
		 foreach($fields as $key => $f)
		 {
			$output .= "<td>".$r[$f->name]."</td>";
		 }
		 $output .= "</tr>";
      }
	  $output .= "</table>";
   }
   else
   {
      $output = "No Data at table $table.";
   }
   
   return $output;
}

function selectDataFrom($table, $field)
{
   $output = "<p>";
   $table = mysql_real_escape_string($table);
   $query = mysql_query("SELECT * FROM `$table`");
   if(mysql_num_rows($query) > 0)
   {
      while($r = mysql_fetch_assoc($query))
      {
         $output .= $r[$field] . "<br>";
      }
      $output .= "</p>";
   }
   else
   {
      $output = "No Rows.";
   }
   
   return $output;
}
?>


