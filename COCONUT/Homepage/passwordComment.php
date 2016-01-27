<?php
include("../../myDatabase1.php");
$comment = $_POST['comment'];
$ro = new database1();

$ro->coconutDesign();

echo "<Br><Br><br>";
$ro->coconutFormStart("post","passwordComment1.php");
$ro->coconutHidden("comment",$comment);

echo "<br>
<center>
<font color=red size=2> Pls Enter your <b>PASSWORD</b> before your comments/question/message will add </font>";
$ro->coconutBoxStart("500","80");
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<td>Password:&nbsp;</td>";
echo "<td><input type='password' name='password' style='border:1px solid #000; height:30px; width:370px; '>  </td>";
echo "</tr>";
echo "</table>";
echo "<Br>";
$ro->coconutButton("Proceed");
$ro->coconutBoxStop();
$ro->coconutFormStop();

?>
