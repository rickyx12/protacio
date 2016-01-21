<?php
include("../../myDatabase.php");
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
$labNoz = $_GET['labNoz'];
$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];
$ro = new database();

?>

<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS.css" />

<?php

echo "
<style type='text/css'>

.examName {
	border: 1px solid #000;
	color: #000;
	height: 30px;
	width: 200px;
	padding:4px 4px 4px 5px;
}

.examResult {
	border: 1px solid #000;
	color: #000;
	height: 30px;
	width: 100px;
	padding:4px 4px 4px 5px;
}

.txtArea {
	border: 1px solid #000;
	color: #000;
	height: 120px;
	width: 550px;
	padding:4px 4px 4px 5px;
}

</style>

";
echo "<form method='get' action='resultInsert.php'>";
echo "<input type=hidden name='labNoz' value='$labNoz'>";
echo "<input type=hidden name='itemNo' value='$itemNo'>";
echo "<input type=hidden name='registrationNo' value='$registrationNo'>";
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
echo "<center><br>";
echo "<font size=4><b>$description</b></font>";
echo "<div style='border:1px solid #000000; width:600px; height:595px; border-color:black black black black;'>";
echo "<br>";
echo "<table border=0>";
echo "<tr>";
echo "<th>Examination Name</th>";
echo "<th>Result</th>";
echo "<th>Flag</th>";
echo "<th>Normal Values</th>";
echo "</tr>";
echo "<tr>";
echo "<td><input name='examName1' type=text class='examName'></td>";
echo "<td><input name='examResult1' type=text class='examResult'></td>";
echo "<td><select class='comboBoxShort' name='flag1'>";
echo "<option value=''>&nbsp;</option>";
echo "<option value='C'>C</option>";
echo "<option value='H'>H</option>";
echo "<option value='L'>L</option>";
echo "</select></td>";
echo "<td><input name='examValues1' type=text class='examName'></td>";
echo "</tr>";
echo "<tr>";
echo "<td><input name='examName2' type=text class='examName'></td>";
echo "<td><input name='examResult2' type=text class='examResult'></td>";
echo "<td><select class='comboBoxShort' name='flag2'>";
echo "<option value=''>&nbsp;</option>";
echo "<option value='C'>C</option>";
echo "<option value='H'>H</option>";
echo "<option value='L'>L</option>";
echo "</select></td>";
echo "<td><input name='examValues2' type=text class='examName'></td>";
echo "</tr>";
echo "<tr>";
echo "<td><input name='examName3' type=text class='examName'></td>";
echo "<td><input name='examResult3' type=text class='examResult'></td>";
echo "<td><select class='comboBoxShort' name='flag3'>";
echo "<option value=''>&nbsp;</option>";
echo "<option value='C'>C</option>";
echo "<option value='H'>H</option>";
echo "<option value='L'>L</option>";
echo "</select></td>";
echo "<td><input name='examValues3' type=text class='examName'></td>";
echo "</tr>";
echo "<tr>";
echo "<td><input name='examName4' type=text class='examName'></td>";
echo "<td><input name='examResult4' type=text class='examResult'></td>";
echo "<td><select class='comboBoxShort' name='flag4'>";
echo "<option value=''>&nbsp;</option>";
echo "<option value='C'>C</option>";
echo "<option value='H'>H</option>";
echo "<option value='L'>L</option>";
echo "</select></td>";
echo "<td><input name='examValues4' type=text class='examName'></td>";
echo "</tr>";
echo "<tr>";
echo "<td><input name='examName5' type=text class='examName'></td>";
echo "<td><input name='examResult5' type=text class='examResult'></td>";
echo "<td><select class='comboBoxShort' name='flag5'>";
echo "<option value=''>&nbsp;</option>";
echo "<option value='C'>C</option>";
echo "<option value='H'>H</option>";
echo "<option value='L'>L</option>";
echo "</select></td>";
echo "<td><input name='examValues5' type=text class='examName'></td>";
echo "</tr>";
echo "<tr>";
echo "<td><input name='examName6' type=text class='examName'></td>";
echo "<td><input name='examResult6' type=text class='examResult'></td>";
echo "<td><select class='comboBoxShort' name='flag6'>";
echo "<option value=''>&nbsp;</option>";
echo "<option value='C'>C</option>";
echo "<option value='H'>H</option>";
echo "<option value='L'>L</option>";
echo "</select></td>";
echo "<td><input name='examValues6' type=text class='examName'></td>";
echo "</tr>";
echo "<tr>";
echo "<td><input name='examName7' type=text class='examName'></td>";
echo "<td><input name='examResult7' type=text class='examResult'></td>";
echo "<td><select class='comboBoxShort' name='flag7'>";
echo "<option value=''>&nbsp;</option>";
echo "<option value='C'>C</option>";
echo "<option value='H'>H</option>";
echo "<option value='L'>L</option>";
echo "</select></td>";
echo "<td><input name='examValues7' type=text class='examName'></td>";
echo "</tr>";
echo "<tr>";
echo "<td><input name='examName8' type=text class='examName'></td>";
echo "<td><input name='examResult8' type=text class='examResult'></td>";
echo "<td><select class='comboBoxShort' name='flag8'>";
echo "<option value=''>&nbsp;</option>";
echo "<option value='C'>C</option>";
echo "<option value='H'>H</option>";
echo "<option value='L'>L</option>";
echo "</select></td>";
echo "<td><input name='examValues8' type=text class='examName'></td>";
echo "</tr>";
echo "<tr>";
echo "<td><input name='examName9' type=text class='examName'></td>";
echo "<td><input name='examResult9' type=text class='examResult'></td>";
echo "<td><select class='comboBoxShort' name='flag9'>";
echo "<option value=''>&nbsp;</option>";
echo "<option value='C'>C</option>";
echo "<option value='H'>H</option>";
echo "<option value='L'>L</option>";
echo "</select></td>";
echo "<td><input name='examValues9' type=text class='examName'></td>";
echo "</tr>";
echo "<tr>";
echo "<td><input name='examName10' type=text class='examName'></td>";
echo "<td><input name='examResult10' type=text class='examResult'></td>";
echo "<td><select class='comboBoxShort' name='flag10'>";
echo "<option value=''>&nbsp;</option>";
echo "<option value='C'>C</option>";
echo "<option value='H'>H</option>";
echo "<option value='L'>L</option>";
echo "</select></td>";
echo "<td><input name='examValues10' type=text class='examName'></td>";
echo "</tr>";
echo "</table>";
echo "<br><br>";
echo "<font size=2>Comments/Remarks</font><br>";
echo "<textarea class='txtArea' name='remarks'></textarea>";
echo "<br><br><input type=submit value='Proceed'>";
echo "</div>";
echo "</form>";
?>
