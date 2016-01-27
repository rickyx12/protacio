<?php
include("../../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$ro = new database();

?>

<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS.css" />

<?php
echo "<form method='get' action='addCreditLimit1.php'>";
echo "<br><center><div style='border:1px solid #000000; width:600px; height:auto; border-color:black black black black;'>";
echo "<br>";
echo "<Table border=0>";
echo "<tr>";
echo "<Td><font class='labelz' class='txtBox'>Limit To</font></tD>";
echo "<Td>";
echo "<select name='limitTo' class='comboBox'>";
echo "<option value='PATIENT'>PATIENT</option>";
$ro->showOption("Category","Category");
echo "</select>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<tD><font class='labelz'>Limit Via</font></tD>";
echo "<td>";
echo "<select name='limitVia' class='comboBox'>";
echo "<option value='cashUnpaid'>Cash Unpaid</option>";
echo "<option value='hmo'>HMO</option>";
echo "<option value='phic'>PhilHealth</option>";
echo "</select>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<tD><font class='labelz'>Amount Limit</font></tD>";
echo "<td><input type=text name='amountLimit' value='' class='shortField'></td>";
echo "</tr>";
echo "</table>";
echo "<Br>	";
echo "<input type=submit value='Proceed' style='border:1px solid #000; background-color:#3b5998; color:white'>";
echo "</div>";
echo "<input type=hidden name='registrationNo' value='$registrationNo'>";
echo "<input type=hidden name='username' value='$username'>";
echo "</form>";

?>
