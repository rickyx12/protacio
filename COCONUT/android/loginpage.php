<?php
include("../../myDatabase2.php");
$module = $_GET['module'];
$ro = new database2();
$ro->coconutDesign();
echo "<link rel='stylesheet' type='text/css' href='css/default.css' />";
echo "<center><br><br>";

echo "
<header class='clearfix'>
<center><span><font size=4><i>Synapse System</i></font></span>
</header>
";
echo "<br>";
$ro->coconutFormStart("post","http://".$ro->getMyUrl()."/LOGINPAGE/loginpage_check.php");
$ro->coconutHidden("module",$module);
echo "<div style='background:#47a3da; height:200px; width:450px; border-radius:15px;'>";
echo "<Br><font color='white'><b><i>".$module."</i></b></font><bR><br>";
echo "<table border=0>";
echo "<tr>";
echo "<td><font color='white'><b>Username</b></font></td>";
echo "<td>";
$ro->coconutTextBox("username","");
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td><font color='white'><b>Password</b></font></td>";
echo "<td>".$ro->coconutPasswordBox_return("password","")."</td>";
echo "</tr>";
echo "</table>";
echo "<br>";
echo "<button>Log In</button>";
echo "</div>";
$ro->coconutFormStop();
?>
