<?php
include("../../../myDatabase.php");



$ro = new database();

$ro->coconutDesign();
if(isset($_POST['key'])) {
$key = $_POST['key'];
if($key == "9k7n3m2l921zdke=~!d9cja#=$58&8!<>edDr8@!2Df~~##4@-[9k8j4m9x7ak0m29szla183jd1zxkaj1j4s5ac971k8jt3]") {
echo "<Br><br><bR><br>";
$ro->coconutFormStart("post","addUser1.php");
$ro->coconutBoxStart("500","150");
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<td>Username</td>";
echo "<td>".$ro->coconutTextBox_return("username","")."</td>";
echo "</tr>";
echo "<tr>";
echo "<td>Password</td>";
echo "<td>".$ro->coconutPasswordBox_return("password","")."</td>";
echo "</tr>";

echo "<tr>";
echo "<td>Complete Name</td>";
echo "<td>".$ro->coconutPasswordBox_return("name","")."</td>";
echo "</tr>";

echo "</table>";
echo "<br>";
$ro->coconutButton("Proceed");
$ro->coconutHidden("module","APPROVAL");
$ro->coconutHidden("key",$key);
$ro->coconutBoxStop();
$ro->coconutFormStop();
}else {
echo "<Br><bR><br><Br><BR>";
$ro->coconutBoxStart("500","100");
$ro->coconutFormStart("post",$_SERVER["PHP_SELF"]);
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<td>Key</td>";
echo "<td>".$ro->coconutPasswordBox_return("key","")."</td>";
echo "</table>";
echo "<Br>";
$ro->coconutButton("Proceed");
$ro->coconutFormStop();
$ro->coconutBoxStop();
}

}else {
echo "<Br><bR><br><Br><BR>";
$ro->coconutBoxStart("500","100");
$ro->coconutFormStart("post",$_SERVER["PHP_SELF"]);
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<td>Key</td>";
echo "<td>".$ro->coconutPasswordBox_return("key","")."</td>";
echo "</table>";
echo "<Br>";
$ro->coconutButton("Proceed");
$ro->coconutFormStop();
$ro->coconutBoxStop();

}

?>
