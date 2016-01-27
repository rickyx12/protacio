<?php
include("../../myDatabase.php");
$registrationNo = $_GET['registrationNo'];
$username = $_GET['username'];
$labNo = $_GET['labNo'];
$pathologist = $_GET['pathologist'];
$medTech = $_GET['medTech'];
$dateReceived = $_GET['dateReceived'];
$dateReleased = $_GET['dateReleased'];
$description = $_GET['description'];
$ro = new database();

?>

<link rel="stylesheet" type="text/css" href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/myCSS/coconutCSS.css" />


<?php
echo "<center>";
$ro->getExamResults_result($registrationNo,$labNo,$username,$description);

?>



