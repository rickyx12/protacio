<?php
include("../../../myDatabase.php");
$percentageNo = $_GET['percentageNo'];
$description = $_GET['description'];
$percentageAmount = $_GET['percentageAmount'];
$username=$_GET['username'];


$ro = new database();
?>

<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS.css" />

<?php
echo "<form method='post' action='editPercentage1.php'>";
echo "<input type=hidden name='username' value='$username'>";
echo "<input type=hidden name='percentageNo' value='$percentageNo'>";
echo "<br><center><div style='border:1px solid #000000; width:520px; height:180px; border-color:black black black black;'>";
echo "<br>";
echo "<table border=0 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<td><font class='labelz'>Description:</font>&nbsp;</td>";
echo "<td><textarea width='50' name='description' class='txtArea'>$description</textarea></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>Percentage Amount:</font>&nbsp;</td>";
echo "<td><input type=text name='amount' class='shortField' value='$percentageAmount'></td>";
echo "</tr>";
echo "</table>";
echo "<br><br>";
echo "<input type=submit value='Proceed'>";
echo "</div>";
echo "</form>";

?>


