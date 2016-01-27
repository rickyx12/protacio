<?php
include("../../../myDatabase.php");
$labTest = $_GET['labTest'];
$itemNo = $_GET['itemNo'];
$registrationNo = $_GET['registrationNo'];
$branch = $_GET['branch'];
$description = $_GET['description'];

$logNo = $_GET['logNo'];
$medTech = $_GET['medTech'];
$pathologist = $_GET['pathologist'];

$ro = new database();
$ro->coconutDesign();
$ro->getPatientProfile($registrationNo);

echo "<br><br>&nbsp;&nbsp;<font size=3>Name:</font>&nbsp;<input type=text name='patientName' style='border-bottom:1px solid #000;
border-top:0px solid #000;
border-left:0px solid #000;
border-right:0px solid #000; 
height: 30px; width: 320px;
 ' value='".$ro->getPatientRecord_lastName().", ".$ro->getPatientRecord_firstName()."'>";


echo "<Br>";
echo "&nbsp;&nbsp;<font size=4>Log No:</font>&nbsp;";
echo "&nbsp;<input type=text name='logNo' style='border-bottom:1px solid #000;
border-top:0px solid #000;
border-left:0px solid #000;
border-right:0px solid #000; 
height: 30px; width: 320px;' value='$logNo'>";


echo "<Br>";
echo "&nbsp;&nbsp;<font size=4>Pathologist:</font>&nbsp;";
echo "&nbsp;<input type=text name='pathologist' style='border-bottom:1px solid #000;
border-top:0px solid #000;
border-left:0px solid #000;
border-right:0px solid #000; 
height: 30px; width: 320px;' value='$pathologist'>";

echo "<Br>";
echo "&nbsp;&nbsp;<font size=4>Med Tech:</font>&nbsp;";
echo "&nbsp;<input type=text name='medTech' style='border-bottom:1px solid #000;
border-top:0px solid #000;
border-left:0px solid #000;
border-right:0px solid #000; 
height: 30px; width: 320px;' value='$medTech'>";


$ro->getLabHeader($labTest,$itemNo,$registrationNo,$branch,$logNo,$medTech,$pathologist);
?>
