<?php
include("../../myDatabase2.php");
$inventoryCode = $_POST['inventoryCode'];
$description = $_POST['description'];

$month = $_POST['month'];
$year = $_POST['year'];

$monthWord="";

if( $month == "01" ) {
$monthWord = "Jan";
}else if( $month == "02" ) {
$monthWord = "Feb";
}else if( $month == "03" ) {
$monthWord = "Mar";
}else if( $month == "04" ) {
$monthWord = "Apr";
}else if( $month == "05" ) {
$monthWord = "May";
}else if( $month == "06" ) {
$monthWord = "Jun";
}else if( $month == "07" ) {
$monthWord = "Jul";
}else if( $month == "08" ) {
$monthWord = "Aug";
}else if( $month == "09" ) {
$monthWord = "Sep";
}else if( $month == "10" ) {
$monthWord = "Oct";
}else if( $month == "11" ) {
$monthWord = "Nov";
}else if( $month == "12" ) {
$monthWord = "Dec";
}else { }


$ro = new database2();
$totalz=0;
echo "<Center><font size=4><B>$description</b></font><br><font size=2>($monthWord $year)</font> <br>";
echo "<Br><font color=red>Consumed by Patient</font>";
$ro->coconutTableStart();
$ro->coconutTableRowStart();
$ro->coconutTableHeader("Date");
$ro->coconutTableHeader("Quantity");
$ro->coconutTableRowStop();

for( $x=1;$x<32;$x++ ) {

if( $x < 10 ) {
$ro->coconutTableRowStart();
$ro->coconutTableData($monthWord." $x,".$year);
$ro->coconutTableData($ro->getFastMovingChart($month,"0".$x,$year,$description,"All",$inventoryCode)  );
$totalz += $ro->getFastMovingChart($month,"0".$x,$year,$description,"All",$inventoryCode);
$ro->coconutTableRowStop();
}else {
$ro->coconutTableRowStart();
$ro->coconutTableData($monthWord." $x,".$year);
$ro->coconutTableData( $ro->getFastMovingChart($month,$x,$year,$description,"All",$inventoryCode)  );
$totalz += $ro->getFastMovingChart($month,$x,$year,$description,"All",$inventoryCode);
$ro->coconutTableRowStop();
}


}

$ro->coconutTableRowStart();
$ro->coconutTableData("<b>TOTAL</b>");
$ro->coconutTableData($totalz);
$ro->coconutTableRowStop();
$ro->coconutTableStop();


echo "<Br><br><br><br>";


echo "<font color=red>Issued to Other Department</font>";
$ro->coconutTableStart();
$ro->coconutTableRowStart();
$ro->coconutTableHeader("Date");
$ro->coconutTableHeader("Quantity");
$ro->coconutTableRowStop();

for( $x=1;$x<32;$x++ ) {

if( $x < 10 ) {
$ro->coconutTableRowStart();
$ro->coconutTableData($monthWord." $x,".$year);
$ro->coconutTableData( $ro->countDeptIssued($month,"0".$x,$year,$inventoryCode) );
$ro->coconutTableRowStop();
}else {
$ro->coconutTableRowStart();
$ro->coconutTableData($monthWord." $x,".$year);
$ro->coconutTableData( $ro->countDeptIssued($month,$x,$year,$inventoryCode) );
$ro->coconutTableRowStop();
}


}

$ro->coconutTableRowStart();
$ro->coconutTableData("<b>TOTAL</b>");
$ro->coconutTableData("");
$ro->coconutTableRowStop();
$ro->coconutTableStop();



?>
