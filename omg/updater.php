<?php

class updater {

public $host;
public $username;
public $password;
public $database;

public function __construct() {
$this->host = $_SERVER['DB_HOST'];
$this->username = $_SERVER['DB_USER'];
$this->password = $_SERVER['DB_PASS'];
$this->database = $_SERVER['DB_DB'];
}

public function collectionReportChecker($itemNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select collectionNo from collectionReport where itemNo = '$itemNo' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return TRUE;
}

}


public function voidedPaymentChecker($itemNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select voidNo from voidPayment where item like '$itemNo%%%%' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return TRUE;
}

}


public function collectionReportToTransfer($date,$date1,$shift) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select rd.registrationNo,pc.itemNo,pc.reportShift,pc.cashPaid,pc.orNO,rd.type,pc.paidBy,pc.timePaid,pc.datePaid,pc.paidVia from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and pc.status = 'PAID' and pc.datePaid between '$date' and '$date1' and pc.reportShift = '$shift' ") or die("Query fail: " . mysqli_error()); 

echo "<form method='get' action='collectionUpdater1.php'>";
echo "<table border=1 cellspacing=0>";
echo "<tr>";
echo "<th>&nbsp;</th>";
echo "<th>registrationNo</th>";
echo "<th>itemNo</th>";
echo "<th>shift</th>";
echo "<th>description</th>";
echo "<th>amountPaid</th>";
echo "<th>OR#</th>";
echo "<th>type</th>";
echo "<Th>paidBy</th>";
echo "<th>timePaid</th>";
echo "<th>datePaid</th>";
echo "<th>PaidVia</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
{
if($this->collectionReportChecker($row['itemNo'])) {
//kung meron nsa collectionReport tbl wag n ilabas
}else {
echo "<tr>";
if($this->voidedPaymentChecker($row['itemNo'])) {
echo "<td><input type='checkbox' name='itemNo[]' value='$row[itemNo]'></td>";
}else {
echo "<td><input type='checkbox' name='itemNo[]' value='$row[itemNo]' checked></td>";
}
echo "<td>".$row['registrationNo']."</td>";
echo "<td>".$row['itemNo']."</td>";
echo "<td>".$row['reportShift']."</td>";
echo "<td>OPD</td>";
echo "<td>".$row['cashPaid']."</td>";
echo "<td>".$row['orNO']."</td>";
echo "<td>".$row['type']."</td>";
echo "<td>".$row['paidBy']."</td>";
echo "<td>".$row['timePaid']."</td>";
echo "<td>".$row['datePaid']."</td>";
echo "<td>".$row['paidVia']."</td>";
echo "</tr>";
}
}
echo "</table>";
echo "<Br><input type='submit'>";
echo "</form>";
}


public function transferCollection($registrationNo,$itemNo,$shift,$description,$amountPaid,$orNo,$type,$paidBy,$timePaid,$datePaid,$paidVia) {

/* make your connection */
$sql = new mysqli($this->host,$this->username,$this->password,$this->database);
 
/* we will just create an insert query here, and use it,
normally this would be done by form submission or other means */
$query = "insert into collectionReport(registrationNo,itemNo,shift,description,amountPaid,orNo,type,paidBy,timePaid,datePaid,paidVia) values('$registrationNo','$itemNo','$shift','$description','$amountPaid','$orNo','$type','$paidBy','$timePaid','$datePaid','$paidVia')";
 
if ( $sql->query($query) ) {
   echo "$itemNo ---> [$registrationNo,$itemNo,$shift,$description,$amountPaid,$orNo,$type,$paidBy,$timePaid,$datePaid,$paidVia] inserted<br>";
} else {
    echo "There was a problem:<br />$query<br />{$sql->error}";
}
 
/* close our connection */
$sql->close();
}



}

?>
