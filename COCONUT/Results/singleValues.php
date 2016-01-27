<?php
include("../../myDatabase.php");
$valuesNo = $_GET['valuesNo'];
$examName = $_GET['examName'];
$examResult = $_GET['examResult'];
$flag = $_GET['flag'];
$examValues = $_GET['examValues'];

$labNo = $_GET['labNo'];
$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];
$description = $_GET['description'];
$pathologist = $_GET['pathologist'];
$medTech = $_GET['medTech'];
$receivedMonth = $_GET['receivedMonth'];
$receivedDay = $_GET['receivedDay'];
$receivedYear = $_GET['receivedYear'];
$releasedMonth = $_GET['releasedMonth'];
$releasedDay = $_GET['releasedDay'];
$releasedYear = $_GET['releasedYear'];
$branch = $_GET['branch'];

$ro = new database();

?>

<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS.css" />

<?php

echo "<form method='get' action='editResultNow.php'>";
echo "<input type=hidden name='valuesNo' value='$valuesNo'>";
echo "<input type=hidden name='labNo' value='$labNo'>";
echo "<input type=hidden name='registrationNo' value='$registrationNo'>";
echo "<input type=hidden name='itemNo' value='$itemNo'>";
echo "<input type=hidden name='description' value='$description'>";
echo "<input type=hidden name='pathologist' value='$pathologist'>";
echo "<input type=hidden name='medTech' value='$medTech'>";
echo "<input type=hidden name='receivedMonth' value='$receivedMonth'>";
echo "<input type=hidden name='receivedDay' value='$receivedDay'>";
echo "<input type=hidden name='receivedYear' value='$receivedYear'>";
echo "<input type=hidden name='releasedMonth' value='$releasedMonth'>";
echo "<input type=hidden name='releasedDay' value='$releasedDay'>";
echo "<input type=hidden name='releasedYear' value='$releasedYear'>";
echo "<input type=hidden name='branch' value='$branch'>";


echo "<br><center><font size=2>Examination Value's Edit</font><center><div style='border:1px solid #000000; width:500px; height:210px; border-color:black black black black;'>";
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<td><font class='labelz'>Exam Name</font></td>";
echo "<td><input type=text name='examName' class='txtBox' value='$examName'></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>Exam Result</font></td>";
echo "<td><input type=text name='examResult' class='txtBox' value='$examResult'></td>";
echo "</tr>";
echo "<tr>";
echo "<td><font class='labelz'>Flag</font></td>";
echo "<td><select name='flag' class='comboBoxShort'>";
echo "<option value='$flag'>$flag</option>";
echo "<option value=''>&nbsp;</option>";
echo "<option value='C'>C</option>";
echo "<option value='H'>H</option>";
echo "<option value='L'>L</option>";
echo "</select></td>";
echo "<tr>";
echo "<td><font class='labelz'>Exam Values</font></td>";
echo "<td><input type=text name='examValues' class='txtBox' value='$examValues'></td>";
echo "</tr>";
echo "</tr>";
echo "</table>";
echo "<br><br>";
echo "<input type=submit value='Edit'>";
echo "<div>";
echo "</form>";
?>
