<?php
error_reporting(E_ALL ^ E_NOTICE);

class user
{
   private $username;
   private $password;
   
   public function __construct($user,$pass)
   {
      $this->username = $user;
	  $this->password = $pass;
   }
   
   public function setUsername($user)
   {
      $this->username = $user;
   }
   
   public function getUsername()
   {
      return "Username: ".$this->username;
   }
   
   public function setPassword($pass)
   {
      $this->password = $pass;
   }
   
   public function getPassword()
   {
      return "Password: ".$this->password;
   }
}

$user = "";
$username = '';
$pass = '';
if(isset($_POST['Reg']))
{
   $username = mysql_escape_string($_POST['user']);
   $pass = mysql_escape_string($_POST['pass']);
   $user = new user($username,$pass);
}
if(isset($_POST['Update']))
{
   $username2 = mysql_escape_string($_POST['user2']);
   $pass2 = mysql_escape_string($_POST['pass2']); 
   $user = new user($username2,$pass2);
}
?>
<form method="post" action="">
<table>
   <tr>
      <td>Create New User:</td>
	  <td>&nbsp;</td><td>&nbsp;</td>
	  <td>Update User Details</td>
   </tr>
   <tr>
      <td>Username:<input type="text" name="user" /></td>
	  <td>&nbsp;</td><td>&nbsp;</td>
	  <td>Username:<input type="text" name="user2" value="<?php echo $username; ?>" /></td>
   </tr>
   <tr>
      <td>Password:<input type="text" name="pass" /></td>
	  <td>&nbsp;</td><td>&nbsp;</td>
	  <td>Password:<input type="text" name="pass2" value="<?php echo $pass; ?>" /></td>
   </tr>
   <tr>
      <td align="center"><input type="submit" name="Reg" /></td>
	  <td>&nbsp;</td><td>&nbsp;</td>
	  <td align="center"><input type="submit" name="Update" /></td>
   </tr>
</table> 
</form>
<?php
if(!empty($user))
{
   echo $user->getUsername().'<br />';
   echo $user->getPassword();
}
?>



