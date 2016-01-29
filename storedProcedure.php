<?php
include("myDatabase.php");


class storedProcedure extends database {

public $myHost;
public $username;
public $password;
public $database;

public function __construct() {
$this->myHost = $_SERVER['DB_HOST'];
$this->username = $_SERVER['DB_USER'];
$this->password = $_SERVER['DB_PASS'];
$this->database = $_SERVER['DB_DB'];
}


public function getTransactionPatient($m,$d,$y,$fromTime_hour,$fromTime_minutes,$fromTime_seconds,$toTime_hour,$toTime_minutes,$toTime_seconds,$module,$branch,$username) {

$dateSelected = $m."_".$d."_".$y;
$fromTime = $fromTime_hour.":".$fromTime_minutes.":".$fromTime_seconds;
$toTime = $toTime_hour.":".$toTime_minutes.":".$toTime_seconds;

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a { text-decoration:none; color:black; }
</style>";

$connection = mysqli_connect($this->myHost,$this->username,$this->password,$this->database);      


if( $module == "PHARMACY" ) {
$result = mysqli_query($connection, "CALL transactionPatient_pharmacy('$dateSelected','$fromTime','$toTime','$module','$branch') ") or die("Query fail: " . mysqli_error()); 
}else if( $module == "LABORATORY" ) {
$result = mysqli_query($connection, "CALL transactionPatient_laboratory('$dateSelected','$fromTime','$toTime','$module','$branch') ") or die("Query fail: " . mysqli_error()); 
}else {
$result = mysqli_query($connection, "CALL transactionPatient_others('$dateSelected','$fromTime','$toTime','$module','$branch') ") or die("Query fail: " . mysqli_error()); 
}


while($row = mysqli_fetch_array($result))
  {

echo "<tr>";

if($row['type'] == "IPD") {
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/Department/patientDepartmentProfile.php?registrationNo=$row[registrationNo]&module=$module&month=$m&day=$d&year=$y&fromTime_hour=$fromTime_hour&fromTime_minutes=$fromTime_minutes&fromTime_seconds=$fromTime_seconds&toTime_hour=$toTime_hour&toTime_minutes=$toTime_minutes&toTime_seconds=$toTime_seconds&username=$username&module=$module' target='patientCharges'><font size='2' color=blue>".$row['lastName']." ".$row['firstName']."</font></a>&nbsp;</td>";
}else if( $row['type'] == "ER" ) {
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/Department/patientDepartmentProfile.php?registrationNo=$row[registrationNo]&module=$module&month=$m&day=$d&year=$y&fromTime_hour=$fromTime_hour&fromTime_minutes=$fromTime_minutes&fromTime_seconds=$fromTime_seconds&toTime_hour=$toTime_hour&toTime_minutes=$toTime_minutes&toTime_seconds=$toTime_seconds&username=$username&module=$module' target='patientCharges'><font size='2' color=red>".$row['lastName']." ".$row['firstName']."</font></a>&nbsp;</td>";
}
else {
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/Department/patientDepartmentProfile.php?registrationNo=$row[registrationNo]&module=$module&month=$m&day=$d&year=$y&fromTime_hour=$fromTime_hour&fromTime_minutes=$fromTime_minutes&fromTime_seconds=$fromTime_seconds&toTime_hour=$toTime_hour&toTime_minutes=$toTime_minutes&toTime_seconds=$toTime_seconds&username=$username&module=$module' target='patientCharges'><font size='2'>".$row['lastName']." ".$row['firstName']."</font></a>&nbsp;</td>";
}


if($row['grandTotal'] > 0) {

if( $module == "RADIOLOGY" ) {
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Reports/radiologyReport/radioReportSettings.php?description=$row[description]&itemNo=$row[itemNo]&registrationNo=$row[registrationNo]&branch=Pagadian' target='patientCharges'>".number_format($row['grandTotal'],2)."</a>&nbsp;</td>";
}else {
echo "<td>&nbsp;".number_format($row['grandTotal'],2)."&nbsp;</td>";
}
}else {
echo "<td>&nbsp;</td>";
}
echo "</tr>";

}

}


public function addCharges_cash1z($status,$registrationNo,$chargesCode,$description,$sellingPrice,$discount,$total,$cashUnpaid,$phic,$company,$timeCharge,$dateCharge,$chargeBy,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$branch,$room) {

/* make your connection */
$sql = new mysqli($this->myHost,$this->username,$this->password,$this->database);
 
/* we will just create an insert query here, and use it,
normally this would be done by form submission or other means */
$query = "INSERT INTO patientCharges (itemNo,status,registrationNo,chargesCode,description,sellingPrice,discount,total,cashUnpaid,phic,company,timeCharge,dateCharge,chargeBy,
service,title,paidVia,cashPaid,batchNo,quantity,inventoryFrom,branch,control_dateCharge,control_datePaid) VALUES (NULL,'$status','$registrationNo','$chargesCode','$description','$sellingPrice','$discount','$total','$cashUnpaid','$phic','$company',
'$timeCharge','$dateCharge','$chargeBy','$service','$title','$paidVia','$cashPaid','$batchNo','$quantity','$inventoryFrom','$branch','".date("Y-m-d")."','');";
 
if ( $sql->query($query) ) {
    echo "A new entry has been added with the `id` of {$sql->insert_id}.";
} else {
    echo "There was a problem:<br />$query<br />{$sql->error}";
}
 
/* close our connection */
$sql->close();


if($title == "LABORATORY" || $title == "RADIOLOGY") { 

echo "
<script type='text/javascript'>
window.location='http://".$this->getMyUrl()."/COCONUT/availableCharges/searchCharges.php?registrationNo=$registrationNo&username=$chargeBy&room=$room&batchNo=$batchNo';
</script>";


}else if($title == "MEDICINE") {
$this->getPatientProfile($registrationNo);
$this->transactionPatient($registrationNo,$chargesCode,$this->getPatientRecord_lastName().", ".$this->getPatientRecord_firstName(),$cashUnpaid,$this->getSynapseTime(),date("M_d_Y"),$chargeBy,"");
/*
echo "
<script type='text/javascript'>
window.location='http://".$this->getMyUrl()."/COCONUT/availableMedicine/searchMedicine.php?registrationNo=$registrationNo&username=$chargeBy&inventoryFrom=$inventoryFrom&room=$room&batchNo=$batchNo';
</script>";
*/
}else if($title == "SUPPLIES") {

echo "
<script type='text/javascript'>
window.location='http://".$this->getMyUrl()."/COCONUT/availableSupplies/searchSupplies.php?registrationNo=$registrationNo&username=$chargeBy&inventoryFrom=$inventoryFrom&room=$room&batchNo=$batchNo';
</script>";

}

else if($title == "PROFESSIONAL FEE") {
echo "
<script type='text/javascript'>
window.location='http://".$this->getMyUrl()."/COCONUT/Doctor/searchDoctor.php?registrationNo=$registrationNo&username=$chargeBy&room=$room&batchNo=$batchNo';
</script>";
}

else {
echo "";
}

}








public function getTransactionPatient_chunk($m,$d,$y,$fromTime_hour,$fromTime_minutes,$fromTime_seconds,$toTime_hour,$toTime_minutes,$toTime_seconds,$module,$branch,$username) {

$dateSelected = $m."_".$d."_".$y;
$fromTime = $fromTime_hour.":".$fromTime_minutes.":".$fromTime_seconds;
$toTime = $toTime_hour.":".$toTime_minutes.":".$toTime_seconds;

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a { text-decoration:none; color:black; }
</style>";

$connection = mysqli_connect($this->myHost,$this->username,$this->password,$this->database);      



$result = mysqli_query($connection, " select registrationNo,sum(cashUnpaid) as grandTotal from patientCharges where dateCharge = '$dateSelected' and (timeCharge between '$fromTime' and '$toTime') and inventoryFrom = 'PHARMACY' and departmentStatus not like 'dispensedBy_%%%' and status not like 'DELETED_%%%%%' group by registrationNo ") or die("Query fail: " . mysqli_error()); 


while($row = mysqli_fetch_array($result))
  {
$this->getPatientProfile($row['registrationNo']);
echo "<tr>";
echo "<td>&nbsp;<a href='#'><font size=2>".$this->getPatientRecord_completeName()."</font></a></td>";
echo "<td>".$row['grandTotal']."</td>";
echo "</tr>";

}

}


public function searchTransactionPatient($patientName,$month,$day,$year,$fromTime_hour,$fromTime_minutes,$fromTime_seconds,$toTime_hour,$toTime_minutes,$toTime_seconds,$username) {

$fromTime = $fromTime_hour.":".$fromTime_minutes.":".$fromTime_seconds;
$toTime = $toTime_hour.":".$toTime_minutes.":".$toTime_seconds;

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a { text-decoration:none; color:black; }
</style>";

$connection = mysqli_connect($this->myHost,$this->username,$this->password,$this->database);      

$dateCharge = $month."_".$day."_".$year;

$result = mysqli_query($connection, " SELECT rd.type,rd.registrationNo,upper(pr.lastName) as lastName,upper(pr.firstName) as firstName,sum(pc.cashUnpaid) as grandTotal FROM patientRecord pr,registrationDetails rd,patientCharges pc WHERE pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and pr.lastName like '$patientName%%%%%' and pc.dateCharge = '$dateCharge' and (pc.timeCharge between '$fromTime' and '$toTime') and pc.inventoryFrom='PHARMACY' and pc.departmentStatus not like 'dispensedBy%%%%' and rd.mgh_date = '' and pc.status not like 'DELETED_%%%%%%' group by rd.registrationNo order by pr.lastName asc ") or die("Query fail: " . mysqli_error()); 

echo "<table border=1 cellspacing=0>";
echo "<tr>";
echo "<th><font size=2>Name</font></th>";
echo "<th><font size=2>Amount</font></th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {
$this->getPatientProfile($row['registrationNo']);
echo "<tr>";
echo "<td>&nbsp;<a href='/Department/patientDepartmentProfile.php?registrationNo=$row[registrationNo]&module=PHARMACY&month=$month&day=$day&year=$year&fromTime_hour=$fromTime_hour&fromTime_minutes=$fromTime_minutes&fromTime_seconds=$fromTime_seconds&toTime_hour=$toTime_hour&toTime_minutes=$toTime_minutes&toTime_seconds=$toTime_seconds&username=$username' target='patientCharges'><font size=2>".$this->getPatientRecord_completeName()."</font></a></td>";
echo "<td><font size=2>".$row['grandTotal']."</font></td>";
echo "</tr>";
}
echo "</table>";
}








public function lockedAccountItems($registrationNo,$details,$username) {

/* make your connection */
$sql = new mysqli($this->myHost,$this->username,$this->password,$this->database);
 
/* we will just create an insert query here, and use it,
normally this would be done by form submission or other means */
$query = "insert into patientCharges_locked(itemNo,status,registrationNo,chargesCode,description,sellingPrice,quantity,discount,total,cashUnpaid,phic,company,timeCharge,dateCharge,chargeBy,service,title,paidVia,cashPaid,orNO,batchNo,inventoryFrom,departmentStatus,departmentStatus_time,datePaid,timePaid,paidBy,branch,hmoPrice,dispensedNo,control_dateCharge,control_datePaid,remarks,details,lockedBy) select itemNo,status,registrationNo,chargesCode,description,sellingPrice,quantity,discount,total,cashUnpaid,phic,company,timeCharge,dateCharge,chargeBy,service,title,paidVia,cashPaid,orNO,batchNo,inventoryFrom,departmentStatus,departmentStatus_time,datePaid,timePaid,paidBy,branch,hmoPrice,dispensedNo,control_dateCharge,control_datePaid,remarks,'$details','$username' from patientCharges where registrationNo = $registrationNo";
 
if ( $sql->query($query) ) {
    echo "A new entry has been added with the `id` of {$sql->insert_id}.";
} else {
    echo "There was a problem:<br />$query<br />{$sql->error}";
}
 
/* close our connection */
$sql->close();


}



public function request2admin($description,$qty,$price,$total,$requestBy,$ip,$time,$date) {

/* make your connection */
$sql = new mysqli($this->myHost,$this->username,$this->password,$this->database);
 
/* we will just create an insert query here, and use it,
normally this would be done by form submission or other means */
$query = "insert into admin2request(description,qty,price,total,requestBy,encodedIn,time,date) values('$description','$qty','$price','$total','$requestBy','$ip','$time','$date')";
 
if ( $sql->query($query) ) {
  // echo "A new entry has been added with the `id`";
} else {
  //  echo "There was a problem:<br />$query<br />{$sql->error}";
}
 

/* close our connection */
$sql->close();
}



public $requestLog_username;
public $requestLog_password;

public function requestLog_username() {
return $this->requestLog_username;
}
public function requestLog_password() {
return $this->requestLog_password;
}
public function requestLog($username,$password) {

$connection = mysqli_connect($this->myHost,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select username,password from registeredUser where username = '$username' and password = '$password' ") or die("Query fail: " . mysqli_error()); 


while($row = mysqli_fetch_array($result))
  {
$this->requestLog_username = $row['username'];
$this->requestLog_password = $row['password'];
}


}



/*
affected files
table.php - /COCONUT/ADMIN/request/
getTable.php - /COCONUT/ADMIN/request/
*/
public function getTable_admin($date,$username) {


echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a { text-decoration:none; color:black; }
</style>


";



$connection = mysqli_connect($this->myHost,$this->username,$this->password,$this->database);      



$result = mysqli_query($connection, " select requestNo,description,qty,price,total,requestBy from admin2request where date='$date' and status = '' ") or die("Query fail: " . mysqli_error()); 


$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Description");
$this->coconutTableHeader("QTY");
$this->coconutTableHeader("Price");
$this->coconutTableHeader("Total");
$this->coconutTableHeader("Request");
$this->coconutTableHeader("");
$this->coconutTableHeader("");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->coconutTableData($row['description']);
$this->coconutTableData($row['qty']);
$this->coconutTableData(number_format($row['price'],2));
$this->coconutTableData(number_format($row['total'],2));
$this->coconutTableData($row['requestBy']);
//$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/ADMIN/request/approved.php?username=jun&requestNo=$row[requestNo]&date=$date'><font color=blue>Approved</font> | <font color=red>Cancel</font></a>");
echo "<td>";
echo "<form method='post' id='#myForm' action='http://".$this->getMyUrl()."/COCONUT/ADMIN/request/table.php'>";
echo "<input type='submit' id='submitButton' style='border:1px solid blue; height:10%;' value='Approved'>";
echo "<input type='hidden' id='username' name='username' value='$username'>";
echo "<input type='hidden' id='requestNo' name='requestNo' value='$row[requestNo]'>";
echo "<input type='hidden' id='date' name='date' value='$date'>";
echo "<input type='hidden' id='status' name='status' value='APPROVED'>";
echo "<input type='hidden' id='makeDo' name='makeDo' value='putStatus'>";
echo "</form>";
echo "</td>";

echo "<td>";
echo "<form method='post' action='http://".$this->getMyUrl()."/COCONUT/ADMIN/request/table.php'>";
echo "<input type='submit' style='border:1px solid blue; height:10%;' value='  Cancel  '>";
echo "<input type='hidden' name='username' value='$username'>";
echo "<input type='hidden' name='requestNo' value='$row[requestNo]'>";
echo "<input type='hidden' name='date' value='$date'>";
echo "<input type='hidden' name='status' value='CANCEL'>";
echo "<input type='hidden' id='makeDo' name='makeDo' value='putStatus'>";
echo "</form>";
echo "</td>";

$this->coconutTableRowStop();
}
$this->coconutTableRowStop();

}


/*
affected files
totalApproved.php - /COCONUT/ADMIN/request/
*/


/*
affected files
getTable.php
*/




/*
affected files
viewApprovedRequest.php - /COCONUT/ADMIN/request/
*/





/*
affected files
requestStatus.php - /COCONUT/ADMIN/request/
*/




public function uploadedFilesInformation($fileName,$fileUrl,$fileOwner,$itemNo,$registrationNo) {

/* make your connection */
$sql = new mysqli($this->myHost,$this->username,$this->password,$this->database);
 
/* we will just create an insert query here, and use it,
normally this would be done by form submission or other means */
$query = "insert into uploadedFiles(fileName,fileUrl,fileOwner,dateUploaded,timeUploaded,itemNo,registrationNo) values('$fileName','$fileUrl','$fileOwner','".date("Y-m-d")."','".date("H:i:s")."','$itemNo','$registrationNo')";
 
if ( $sql->query($query) ) {
   echo "A new entry has been added with the `id`";
} else {
    echo "There was a problem:<br />$query<br />{$sql->error}";
}
 

/* close our connection */
$sql->close();
}





}



?>
