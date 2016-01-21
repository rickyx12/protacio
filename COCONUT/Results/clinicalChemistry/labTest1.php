<?php
include("../../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$itemNo = $_GET['itemNo'];
$labTest = $_GET['labTest'];
$branch = $_GET['branch'];
$desc = $_GET['desc'];
$result = $_GET['result'];
$normalValues = $_GET['normalValues'];
$logNo = $_GET['logNo'];
$pathologist = $_GET['pathologist'];
$medtech = $_GET['medTech'];

$desc1 = count($desc);
$result1 = count($result);
$normalValues1 = count($result);

$ro = new database();

for($d=0,$r=0,$n=0;$d<$desc1,$r<$result1,$n<$normalValues1;$d++,$r++,$n++) {

$ro->addLabResult($logNo,$registrationNo,$itemNo,$desc[$d],$result[$r],$normalValues[$n],$labTest,$pathologist,$medtech);

}

?>
