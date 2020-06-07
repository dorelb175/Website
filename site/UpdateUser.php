<?php
require_once('config.php');
$username;
$fname;
$lname;
$pass;
$email;
$gender;
$favchar;
if(empty($_SESSION['user']) || !empty($_SESSION['user']))
{
   if($_SESSION['user'] == "admin")
   {
      if(isset($_POST['Update']) && !empty($_SESSION['Update']))
	  {
	     $_SESSION['Update'] = $_POST['user'];
		 $username = mysql_real_escape_string($_SESSION['Update']);
	     $sql = mysql_query("SELECT * FROM users WHERE username = '$username'");
		 $row = mysql_fetch_array($sql);
		 $fname = mysql_real_escape_string($row[fname]);
         $lname = mysql_real_escape_string($row[lname]);
         $pass = mysql_real_escape_string($row[pass]);
         $email = mysql_real_escape_string($row[email]);
	  }
	  if(isset($_POST['Update2']))
	  {
	     $username = mysql_real_escape_string($_SESSION['Update']);
		 $fname = secure('Fname');
         $lname = secure('Lname');
         $pass = secure('pass');
         $email = secure('email');
         $dob = secure('DayOfBirth')."/".secure('MonthOfBirth')."/".secure('YearOfBirth');
         $gender = secure('gender');
         $favchar = secure('FavChar');
		 
		 $checkEmail = mysql_query("SELECT email FROM users WHERE email = '" .$email. "'");
	     if(mysql_num_rows($checkEmail) > 0)
	     {
	        echo "האימייל שהזנת כבר קיים";
	     }
	     else
	     {
	        mysql_query("UPDATE users set fname = '$fname',lname = '$lname',email = '$email',DateOfBirth = '$dob',gender = '$gender',favchar = '$favchar' WHERE username = '$username'");
			$_SESSION['Update'] = null;
	     }
	  }
   }
   else
   {
      $_SESSION['message'] = "MustAdmin";
      header('location:message.php');
   }
}
?>
<script type="text/javascript">	
	function CheckFname() {
        var x = document.getElementById("Fname").value;
        var y = 0;

        if (x.length > 2)
            for (var i = 0; i < x.length; i++)
                if ((x[i] >= 'a' && x[i] <= 'z') || (x[i] >= 'A' && x[i] <= 'Z'))
                    y++;
        if (y == x.length && x.length != 0)
            return true;
        else
            return false;
    }

    function WriteFname() {
        var x = document.getElementById("Fname").value;
        var y = 0;

        if (x.length == 0) {
            document.getElementById('FnameErr').innerHTML = "<span style='color:red'>נא הכנס שם</span>";
        }
        else if (x.length < 3) {
            document.getElementById('FnameErr').innerHTML = "<span style='color:red'>השם קצר מדי</span>";
        }
        else if (x.length > 0) {
            for (var i = 0; i < x.length; i++) {
                if ((x[i] >= 'a' && x[i] <= 'z') || (x[i] >= 'A' && x[i] <= 'Z'))
                    y++;
                if (y == x.length) {
                    document.getElementById('FnameErr').innerHTML = "<span style='color:green'>השם תקין</span>";
                }
                else if (i == x.length - 1) {
                    document.getElementById('FnameErr').innerHTML = "<span style='color:red'>נא לרשום שם בלי מספרים ובאותיות אנגלית בלבד</span>";
                }
            }
        }
    }

    function CheckLname() {
        var x = document.getElementById("Lname").value;
        var y = 0;

        if (x.length > 2)
            for (var i = 0; i < x.length; i++)
                if ((x[i] >= 'a' && x[i] <= 'z') || (x[i] >= 'A' && x[i] <= 'Z'))
                    y = y + 1;
        if (y == x.length && x.length != 0)
            return true;
        else
            return false;
    }

    function WriteLname() {
        var x = document.getElementById("Lname").value;
        var y = 0;

        if (x.length == 0) {
            document.getElementById('LnameErr').innerHTML = "<span style='color:red'>נא להכניס שם משפחה</span>";
        }
        else if (x.length < 3) {
            document.getElementById('LnameErr').innerHTML = "<span style='color:red'>השם קצר מדי</span>";
        }
        else if (x.length > 0) {
            for (var i = 0; i < x.length; i++) {
                if ((x[i] >= 'a' && x[i] <= 'z') || (x[i] >= 'A' && x[i] <= 'Z'))
                    y = y + 1;
                if (y == x.length) {
                    document.getElementById('LnameErr').innerHTML = "<span style='color:green'>שם המשפחה תקין</span>";
                }
                else if (i == x.length - 1) {
                    document.getElementById('LnameErr').innerHTML = "<span style='color:red'>נא לרשום שם בלי מספרים ובאותיות אנגלית בלבד</span>";
                }
            }
        }
    }

    function CheckEmail() {
        var x = document.getElementById("email").value;

        for (var i = 0; i < x.length; i++) {
            if ((x[i] <= 'z' && x[i] >= 'a') || x[i] >= 0 || x[i] == '@' || x[i] == '.')
                var a = 0;
            else {
                return false;
            }
        }
        if (x.length == 0) {
            return false;
        }
        else if (x.indexOf('@') == -1) {
            return false;
        }
        else if (x.indexOf('.') == -1) {
            return false;
        }
        else if (x.indexOf('@') >= x.indexOf('.')) {
            return false;
        }
        else if (x.indexOf('@') + 3 > x.indexOf('.')) {
            return false;
        }
        else if (x.indexOf('@') <= 3) {
            return false;
        }
        else if (x.indexOf('.') + 2 >= x.length) {
            return false;
        }
        else if (x.indexOf('@') > 3 && x.indexOf('.') > x.indexOf('@') && x.indexOf('.') < document.getElementById("email").value.length) {
            return true;
        }
    }

    function WriteEmail() {
        var x = document.getElementById("email").value;

        for (var i = 0; i < x.length; i++) {
            if ((x[i] <= 'z' && x[i] >= 'a') || x[i] >= 0 || x[i] == '@' || x[i] == '.')
                var a = 0;
            else {
                document.getElementById('MailErr').innerHTML = "<span style='color:red'>האימייל לא תקין</span>";
            }
        }
        if (x.length == 0) {
            document.getElementById('MailErr').innerHTML = "<span style='color:red'>נא להכניס אימייל</span>";
        }
        else if (x.indexOf('@') == -1) {
            document.getElementById('MailErr').innerHTML = "<span style='color:red'>חסר שטרודל</span>";
        }
        else if (x.indexOf('.') == -1) {
            document.getElementById('MailErr').innerHTML = "<span style='color:red'>חסרה נקודה</span>";
        }
        else if (x.indexOf('@') >= x.indexOf('.')) {
            document.getElementById('MailErr').innerHTML = "<span style='color:red'>הנקודה או הנקודות לא נמצאות במקומות המתאימים</span>";
        }
        else if (x.indexOf('@') + 3 > x.indexOf('.')) {
            document.getElementById('MailErr').innerHTML = "<span style='color:red'>האימייל לא אפשרי</span>";
        }
        else if (x.indexOf('@') <= 3) {
            document.getElementById('MailErr').innerHTML = "<span style='color:red'>האימייל לא תקין</span>";
        }
        else if (x.indexOf('.') + 2 >= x.length) {
            document.getElementById('MailErr').innerHTML = "<span style='color:red'>האימייל לא תקין</span>";
        }
        else if (x.indexOf('@') > 3 && x.indexOf('.') > x.indexOf('@') && x.indexOf('.') < x.length) {
            document.getElementById('MailErr').innerHTML = "<span style='color:green'>האימייל תקין</span>";
        }
    }

    function CheckDate() {
        var day = document.getElementById("DayOfBirth");
        var month = document.getElementById("MonthOfBirth");
        var year = document.getElementById("YearOfBirth");
        if (day.selectedIndex != 0 && month.selectedIndex != 0 && year.selectedIndex != 0)
            return true;
        return false;
    }

    function WriteDate() {
        var day = document.getElementById("DayOfBirth");
        var month = document.getElementById("MonthOfBirth");
        var year = document.getElementById("YearOfBirth");

        if (day.selectedIndex != 0 && month.selectedIndex != 0 && year.selectedIndex != 0)
            document.getElementById('DateErr').innerHTML = "<span style='color:green'>תאריך תקין</span>";
        else
            document.getElementById('DateErr').innerHTML = "<span style='color:red'>נא לבחור יום חודש ושנה</span>";
    }

    function CheckUp() {
        if (CheckUser() && CheckFname() && CheckLname() && CheckPass() && CheckEmail() && CheckFavoChar() && CheckDate())
            return true;
        else {
            WriteUser();
            WriteFname();
            WriteLname();
            WritePass();
            WriteEmail();
            WriteFavoChar();
            WriteDate();
            return false;
        }
    }
</script>
<b><a href="ShowUsers.php" target="_blank">טבלת המשתמשים</a></b><p />
<h3>הקש את שם המשתמש שברצונך לעדכן:</h3> <br />
<form action="" method="post">
<input type="text" name="user" />
<input type="submit" name="Update" value="עדכן" />
</form>
<br /><br />
<!-- Update Details -->
<div style="color:Red;font-size:medium">עדכון פרטים:</div> 
<form method="post" action="" onsubmit="return CheckUp()">
<table>
  <tr><td>שם משתמש: </td><td><input type="text" id="username" name="username" disabled="disabled" value="<?php echo $username; ?>" /></td></tr>
  <tr><td>שם פרטי: </td><td><input type="text" id="Fname" name="Fname" value="<?php echo $username; ?>" /></td><td><p id="FnameErr"></p></td></tr> 
  <tr><td>שם משפחה: </td><td><input type="text" id="Lname" name="Lname" onfocus="WriteFname()" value="<?php echo $username; ?>" /></td><td><p id="LnameErr"></p></td></tr>
  <tr><td>סיסמה: </td><td><input type="password" id="pass" name="pass" onfocus="WriteLname()" value="" /></td><td><p id="PassErr"></p></td></tr> 
  <tr><td>אימות סיסמה: </td><td><input type="password" id="pass2" name="pass2" value="" /></td><td><p id="Pass2Err"></p></td></tr> 
  <tr><td>אימייל: </td><td><input type="text" id="email" name="email" onfocus="WritePass()" value="<?php echo $email; ?>" /></td><td><p id="MailErr"></p></td></tr> 
  <tr>
    <td>תאריך לידה: </td>
    <td>
<select id="DayOfBirth" name="DayOfBirth" onfocus="WriteEmail()">
<option value="0" selected="selected">יום</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
<option value="25">25</option>
<option value="26">26</option>
<option value="27">27</option>
<option value="28">28</option>
<option value="29">29</option>
<option value="30">30</option>
<option value="31">31</option>
</select>

<select id="MonthOfBirth" name="MonthOfBirth">
<option value="0" selected="selected">חודש</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
</select>

<select  id="YearOfBirth" name="YearOfBirth" style="width:60px">
<option value="0" selected="selected" >שנה</option>
<option value="2005" >2005</option>
<option value="2004">2004</option>
<option value="2003">2003</option>
<option value="2002">2002</option>
<option value="2001">2001</option>
<option value="2000">2000</option>
<option value="1999">1999</option>
<option value="1998">1998</option>
<option value="1997">1997</option>
<option value="1996">1996</option>
<option value="1995">1995</option>
<option value="1994">1994</option>
<option value="1993">1993</option>
<option value="1992">1992</option>
<option value="1991">1991</option>
<option value="1990">1990</option>
<option value="1989">1989</option>
<option value="1988">1988</option>
<option value="1987">1987</option>
<option value="1986">1986</option>
<option value="1985">1985</option>
<option value="1984">1984</option>
<option value="1983">1983</option>
<option value="1982">1982</option>
<option value="1981">1981</option>
<option value="1980">1980</option>
<option value="1979">1979</option>
<option value="1978">1978</option>
<option value="1977">1977</option>
<option value="1976">1976</option>
<option value="1975">1975</option>
<option value="1974">1974</option>
<option value="1973">1973</option>
<option value="1972">1972</option>
<option value="1971">1971</option>
<option value="1970">1970</option>
<option value="1969">1969</option>
<option value="1968">1968</option>
<option value="1967">1967</option>
<option value="1966">1966</option>
<option value="1965">1965</option>
<option value="1964">1964</option>
<option value="1963">1963</option>
<option value="1962">1962</option>
<option value="1961">1961</option>
<option value="1960">1960</option>
<option value="1959">1959</option>
<option value="1958">1958</option>
<option value="1957">1957</option>
<option value="1956">1956</option>
<option value="1955">1955</option>
<option value="1954">1954</option>
<option value="1953">1953</option>
<option value="1952">1952</option>
<option value="1951">1951</option>
<option value="1950">1950</option>
<option value="1949">1949</option>
<option value="1948">1948</option>
<option value="1947">1947</option>
<option value="1946">1946</option>
<option value="1945">1945</option>
<option value="1944">1944</option>
<option value="1943">1943</option>
<option value="1942">1942</option>
<option value="1941">1941</option>
<option value="1940">1940</option>
</select>
    </td>
    <td><p id="DateErr"></p></td>
  </tr>
  <tr><td>&nbsp;</td></tr>
  <tr>
    <td>מין: </td>
    <td>
      <input type="radio" id="gen" name="gen" value="Male" checked="checked" />זכר
      <input type="radio" id="gen2" name="gen" value="Female" />נקבה
    </td>
  </tr>
  <tr><td>&nbsp;</td></tr>
  <tr>
    <td>דמות מועדפת: </td>
    <td>
      <input type="checkbox" id="FavChar1" name="FavChar" value="Ted" />טד
      <input type="checkbox" id="FavChar2" name="FavChar" value="Robin" />רובין
      <input type="checkbox" id="FavChar3" name="FavChar" value="Barney" />ברני
      <input type="checkbox" id="FavChar4" name="FavChar" value="Marshall" />מרשל
      <input type="checkbox" id="FavChar5" name="FavChar" value="Lily" />לילי
    </td>
    <td><p id="CharErr"></p></td>
  </tr>
    <tr><td>&nbsp;</td></tr>
  <tr>
      <td>&nbsp;</td>
      <td>
        <input type="submit" id="Update2" name="Update2" value="עדכן" />
        <input type="reset" value="נקה" />
      </td>
    </tr>
</table>
</form>