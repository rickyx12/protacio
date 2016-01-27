<?php
include("../../myDatabase3.php");
$date = $_GET['date'];
$date1 = $_GET['date1'];
$type = $_GET['type'];
$title = $_GET['title'];

$ro = new database3();

echo $date."<Br>";
echo $date1."<Br>";
echo $title."-".$type;
echo "<br><br>";
if($type == "IPD" ) {
$ro->patientAccount($date,$date1,$type,$title);
}else {
$ro->patientAccountOPD($date,$date1,$title);
}

?>
