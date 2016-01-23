<?php
	session_start();
	mysql_connect("localhost","root","");
	mysql_select_db("system");
	
	if (isset($_POST['SUB']))
	{
		$username = $_POST['T1'];
		$password = $_POST['T2'];
		$user = 'user';
		$admin = 'admin';
		
		$RES = mysql_query("SELECT * FROM tbl WHERE username='$username' AND password='$password'");
		$ROW = mysql_fetch_array($RES);
		
		if (mysql_num_rows($RES) == 0)
		{
			print "Invalid User";
		}
		else if (mysql_num_rows($RES) == 1)
		{
			if($ROW['username']==$user)
			{
				$_SESSION['LOGIN']=$ROW['username'];
				header("location: viewing.php");
			}
			
			else if($ROW['username']==$admin)
			{
				$_SESSION['LOGIN']=$ROW['username'];
				header ("location: admin.php");
			}
		}	
	}
?>

<HTML>
<TITLE> Log in </TITLE>
<BODY background="Admin.jpg">
<p>
<form action="" method="post" name="F1" id="F1">
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <table width="49%" border="0" align="center" cellpadding="1">
    <tr> 
      <td width="11%">Username</td>
      <td width="26%"><input name="T1" type="text" id="T18"></td>
      <td width="11%">Password</td>
      <td width="25%"><input name="T2" type="password" id="T2"></td>
      <td width="27%"><input name="SUB" type="submit" id="SUB" value="Log in"></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</form>
<p>&nbsp;</p>
<p>&nbsp; </p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</BODY>
</HTML>