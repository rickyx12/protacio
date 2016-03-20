<?php
include($_SERVER['DOCUMENT_ROOT']."/coreClass/database/dbAuthenticate.php");


class inventoryMovement {

public function inventoryMovement_list_forEnding($year,$title,$medType,$username) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }
</style>";

$connection = mysqli_connect(dbAuthenticate::$dbHost,dbAuthenticate::$dbUsername,dbAuthenticate::$dbPassword,dbAuthenticate::$dbName);      


if( $medType == "all" ) {
$result = mysqli_query($connection, " select i.inventoryCode,isc.description,isc.stockCardNo,i.Added,i.unitcost,i.quantity,i.suppliesUNITCOST from inventoryStockCard isc,inventory i where isc.stockCardNo = i.stockCardNo and isc.inventoryType = '$title' and i.status != 'DELETED' group by isc.stockCardNo order by isc.description asc ") or die("Query fail: " . mysqli_error()); 
}else {
$result = mysqli_query($connection, " select i.inventoryCode,isc.description,isc.stockCardNo,i.Added,i.unitcost,i.quantity,i.suppliesUNITCOST from inventoryStockCard isc,inventory i,inventoryMovement im where isc.stockCardNo = i.stockCardNo and i.stockCardNo = im.stockCardNo and im.medicineType = '$medType' and isc.inventoryType = '$title' and i.status != 'DELETED' group by isc.stockCardNo order by isc.description asc ") or die("Query fail: " . mysqli_error());
}


echo "<form method='post' action='inventoryMovement_ending1.php'>";
echo "<input type='hidden' name='medicineType' value='$medType'>";
echo "<input type='hidden' name='type' value='$title'>";
echo "<input type='hidden' name='year' value='$year'>";
echo "<input type='hidden' name='username' value='$username'>";
echo "<table border=1 cellpadding=1 cellspacing=0>";
echo "<Tr>";
echo "<th></th>";
echo "<th>&nbsp;<font size=2>Name of $title</font></th>";
echo "<th>QTY</th>";
echo "<th>Unitcost</th>";
//echo "<th>DispensedQTY</th>";
echo "<th>Ending</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
{

$endingInvty_med = ( $row['quantity'] * $row['unitcost'] );
$endingInvty_sup = ( $row['quantity'] * $row['suppliesUNITCOST'] );

echo "<tr>";
echo "<td><input type='checkbox' name='inventoryCode' value='".$row['inventoryCode']."' ></td>";
echo "<td>".$row['description']."</td>";
echo "<td>".$row['quantity']."</td>";

if( $title == "medicine" ) {
echo "<td>".$row['unitcost']."</td>";
//echo "<td>&nbsp;".$this->checkDispenseQTY($row['inventoryCode'])."</td>";
echo "<td><input type='checkbox' name='endingInvty[]' value='$row[stockCardNo]_$endingInvty_med' checked> &nbsp;".$endingInvty_med."</td>";
}else {
echo "<td>".$row['suppliesUNITCOST']."</td>";
//echo "<td>&nbsp;".$this->checkDispenseQTY($row['inventoryCode'])."</td>";
echo "<td><input type='checkbox' name='endingInvty[]' value='$row[stockCardNo]_$endingInvty_sup' checked> &nbsp;".$endingInvty_sup."</td>";
}
echo "</tr>";
}
echo "</table>";
echo "<input type='submit' value='Proceed'>";
echo "</form>";
}

public function addEndingInvty3($stockCardNo,$endingInvty) {

/* make your connection */
$sql = new mysqli(dbAuthenticate::$dbHost,dbAuthenticate::$dbUsername,dbAuthenticate::$dbPassword,dbAuthenticate::$dbName);
 
/* we will just create an insert query here, and use it,
normally this would be done by form submission or other means */
$query = "insert into inventoryMovement(stockCardNo,endingInventory2) values('$stockCardNo','$endingInvty')";


 
if ( $sql->query($query) ) {
//echo "A new entry has been added with the `id`";
//$this->gotoPage("http://".$this->getMyUrl()."/COCONUT/android/doctor/mobileAddCharges_medicine.php?registrationNo=$registrationNo&batchNo=$batchNo&room=$room&username=$username");
} else {
    echo "There was a problem:<br />$query<br />{$sql->error}";
}

/* close our connection */
$sql->close();
}




public function inventoryMovement_latestUnitcost($stockCardNo,$type) {

$connection = mysqli_connect(dbAuthenticate::$dbHost,dbAuthenticate::$dbUsername,dbAuthenticate::$dbPassword,dbAuthenticate::$dbName);      

if( $type == "medicine" ) {
$result = mysqli_query($connection, " select (unitcost) as unitcost from inventory where stockCardNo = '$stockCardNo' order by inventoryCode desc limit 1 ") or die("Query fail: " . mysqli_error()); 
}else {
$result = mysqli_query($connection, " select (suppliesUNITCOST) as unitcost from inventory where stockCardNo = '$stockCardNo' order by inventoryCode desc limit 1 ") or die("Query fail: " . mysqli_error()); 
}

while($row = mysqli_fetch_array($result))
{
return $row['unitcost'];
}
$result->close();
}


public function inventoryMovement_latestEncoded($inventoryCode,$stockCardNo) {

$connection = mysqli_connect(dbAuthenticate::$dbHost,dbAuthenticate::$dbUsername,dbAuthenticate::$dbPassword,dbAuthenticate::$dbName);      

$result = mysqli_query($connection, " select beginningQTY from inventory where inventoryCode = '$inventoryCode' and stockCardNo = '$stockCardNo' order by inventoryCode desc limit 1 ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['beginningQTY'];
}
$result->close();
}


public function inventoryMovement_returnItems($inventoryCode,$stockCardNo,$title) {

$connection = mysqli_connect(dbAuthenticate::$dbHost,dbAuthenticate::$dbUsername,dbAuthenticate::$dbPassword,dbAuthenticate::$dbName);      

$result = mysqli_query($connection, " select sum(quantity) as returnz from patientCharges where chargesCode = '$inventoryCode' and stockCardNo = '$stockCardNo' and title = '$title' and returnFlag = 'return' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['returnz'];
}
$result->close();
}

public $inventoryMovement_listReturnItems_total;

public function inventoryMovement_listReturnItems($inventoryCode,$stockCardNo,$title) {

$connection = mysqli_connect(dbAuthenticate::$dbHost,dbAuthenticate::$dbUsername,dbAuthenticate::$dbPassword,dbAuthenticate::$dbName);      

$result = mysqli_query($connection, " select pr.lastName,pr.firstName,pc.description,pc.quantity from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and pc.chargesCode = '$inventoryCode' and pc.stockCardNo='$stockCardNo' and pc.title='$title' and returnFlag = 'return' ") or die("Query fail: " . mysqli_error()); 

echo "<Table border=1 cellpadding=1 cellspacing=0>";
echo "<Tr>";
echo "<th>Patient</th>";
echo "<th>Items</th>";
echo "<th>Return QTY</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
{
$this->inventoryMovement_listReturnItems_total += $row['quantity'];
echo "<tr>";
echo "<td>&nbsp;".$row['lastName'].", ".$row['firstName']."</td>";
echo "<td>&nbsp;".$row['description']."</td>";
echo "<td>&nbsp;".$row['quantity']."</td>";
echo "</tr>";
}
echo "<tr>";
echo "<td>&nbsp;<font size=2><b>TOTAL</b></font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;".$this->inventoryMovement_listReturnItems_total."</td>";
echo "</tr>";
echo "</table>";
$result->close();
}


public function inventoryMovement_dispensedItems($inventoryCode,$stockCardNo,$title) {

$connection = mysqli_connect(dbAuthenticate::$dbHost,dbAuthenticate::$dbUsername,dbAuthenticate::$dbPassword,dbAuthenticate::$dbName);      

$result = mysqli_query($connection, "  select sum(pc.dispenseQTY) as dispense from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and pc.chargesCode = '$inventoryCode' and pc.stockCardNo='$stockCardNo' and pc.title='$title' and dispenseFlag='dispense' and status != 'PAID' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['dispense'];
}
$result->close();
}


public $inventoryMovement_showDispensed_total;

public function inventoryMovement_showDispensed($inventoryCode,$stockCardNo,$title) {

$connection = mysqli_connect(dbAuthenticate::$dbHost,dbAuthenticate::$dbUsername,dbAuthenticate::$dbPassword,dbAuthenticate::$dbName);      

$result = mysqli_query($connection, "  select pr.lastName,pr.firstName,pc.description,pc.dispenseQTY,pc.dateCharge,rd.type,rd.dateRegistered,rd.dateUnregistered from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and pc.chargesCode = '$inventoryCode' and pc.stockCardNo = '$stockCardNo' and pc.title = '$title' and dispenseFlag = 'dispense' and status != 'PAID' ") or die("Query fail: " . mysqli_error()); 

echo "<table border=1 cellspacing=0>";
echo "<tr>";
echo "<th>Patient</th>";
echo "<th>Description</th>";
echo "<th>QTY</th>";
echo "<th>Charge</th>";
echo "<th>Type</th>";
echo "<th>In</th>";
echo "<th>Out</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
{

$this->inventoryMovement_showDispensed_total += $row['dispenseQTY'];

echo "<tr>";
echo "<td>".$row['lastName'].", ".$row['firstName']."</td>";
echo "<td>".$row['description']."</td>";
echo "<td>".$row['dispenseQTY']."</td>";
echo "<td>".$row['dateCharge']."</td>";
echo "<td>".$row['type']."</td>";
echo "<td>&nbsp;".$row['dateRegistered']."</td>";
echo "<td>&nbsp;".$row['dateUnregistered']."</td>";
echo "</tr>";
}
echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;".$this->inventoryMovement_showDispensed_total."</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";
echo "</table>";
$result->close();
}



public function inventoryMovement_soldItems($stockCardNo,$type) {

$connection = mysqli_connect(dbAuthenticate::$dbHost,dbAuthenticate::$dbUsername,dbAuthenticate::$dbPassword,dbAuthenticate::$dbName);      

$result = mysqli_query($connection, " select sum(pc.quantity) as qty from patientCharges pc where pc.stockCardNo = '$stockCardNo' and pc.title='$type' and pc.status = 'PAID' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['qty'];
}
$result->close();
}

public $inventoryMovement_listSoldItems_total;
public $inventoryMovement_listSoldItems_amountPdtotal;

public function inventoryMovement_listSoldItems($stockCardNo,$title) {

$connection = mysqli_connect(dbAuthenticate::$dbHost,dbAuthenticate::$dbUsername,dbAuthenticate::$dbPassword,dbAuthenticate::$dbName);      

$result = mysqli_query($connection, " select pr.lastName,pr.firstName,pc.description,pc.quantity,pc.datePaid,pc.orNO,pc.cashPaid from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and pc.stockCardNo = '$stockCardNo' and pc.title='$title' and pc.status = 'PAID' ") or die("Query fail: " . mysqli_error()); 


echo "<table border=1 cellspacing=0>";
echo "<tr>";
echo "<th>Patient</th>";
echo "<th>Description</th>";
echo "<th> QTY</th>";
echo "<th>Date Pd</th>";
echo "<th>OR#</th>";
echo "<th>Amount Pd</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
{
$this->inventoryMovement_listSoldItems_total += $row['quantity'];
$this->inventoryMovement_listSoldItems_amountPdtotal += $row['cashPaid'];
echo "<Tr>";
echo "<td>".$row['lastName'].", ".$row['firstName']."</td>";
echo "<td>".$row['description']."</td>";
echo "<td>".$row['quantity']."</td>";
echo "<td>".$row['datePaid']."</td>";
echo "<td>".$row['orNO']."</td>";
echo "<td>".$row['cashPaid']."</td>";
echo "</tr>";
}
echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>".$this->inventoryMovement_listSoldItems_total."</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;".number_format($this->inventoryMovement_listSoldItems_amountPdtotal,2)."</td>";
echo "</tr>";
echo "</table>";
}


public function showInventoryForMovement($type,$inventoryLocation) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }
</style>";

$connection = mysqli_connect(dbAuthenticate::$dbHost,dbAuthenticate::$dbUsername,dbAuthenticate::$dbPassword,dbAuthenticate::$dbName);      


$result = mysqli_query($connection, " select inventoryCode,stockCardNo,description,genericName,preparation,unitcost,phicPrice,companyPrice,quantity,expiration,addedBy,dateAdded,timeAdded,inventoryLocation,inventoryType,branch,transition,remarks,phic,Added,criticalLevel,accountTitle,supplier,autoDispense,status,beginningCapital,beginningQTY,suppliesUNITCOST,from_inventoryCode,classification,ipdPrice,opdPrice,invoiceNo,fgQuantity,unitOfMeasure,end,endBy,endDate,lastEnd_QTY,encodedQTY from inventory where status not like 'DELETED%%%%%%' and inventoryType = '$type' and revision = 'beta2' and inventoryLocation = '$inventoryLocation' order by description asc ") or die("Query fail: " . mysqli_error()); 


echo "<table border=1 cellpadding=1 cellspacing=0>";
echo "<Tr>";
echo "<th>&nbsp;</th>";
echo "<th>&nbsp;<font size=2>Item Description</font></th>";
echo "<th>&nbsp;<font size=2>Unit of<br>Measure</font></th>";
echo "<th>&nbsp;<font size=2>Unitcost</font></th>";
echo "<th>&nbsp;<font size=2>BI</font></th>";
echo "<th>&nbsp;<font size=2>Supplier</font></th>";
echo "<th>&nbsp;<font size=2>In(Return)</font></th>";
echo "<th>&nbsp;<font size=2>Out</font></th>";
echo "<th>&nbsp;<font size=2>Sold</font></th>";
echo "<th>&nbsp;<font size=2>Use</font></th>";
echo "<th>&nbsp;<font size=2>EI</font></th>";
echo "<th>&nbsp;<font size=2></font></th>";
echo "<th>&nbsp;<font size=2></font></th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
{
$inventoryCode = $row['inventoryCode'];
$stockCardNo = $row['stockCardNo'];
$description = $row['description'];
$genericName = $row['genericName'];
$preparation = $row['preparation'];
$unitcost = $row['unitcost'];
$phicPrice = $row['phicPrice'];
$companyPrice = $row['companyPrice'];
$quantity = $row['quantity'];
$expiration = $row['expiration'];
$addedBy = $row['addedBy'];
$dateAdded = $row['dateAdded'];
$timeAdded = $row['timeAdded'];
$inventoryLocation = $row['inventoryLocation'];
$inventoryType = $row['inventoryType'];
$branch = $row['branch'];
$transition = $row['transition'];
$remarks = $row['remarks'];
$phic = $row['phic'];
$added = $row['Added'];
$criticalLevel = $row['criticalLevel'];
$accountTitle = $row['accountTitle'];
$supplier = $row['supplier'];
$autoDispense = $row['autoDispense'];
$status = $row['status'];
$beginningCapital = $row['beginningCapital'];
$beginningQTY = $row['beginningQTY'];
$suppliesUNITCOST = $row['suppliesUNITCOST'];
$from_inventoryCode = $row['from_inventoryCode'];
$classification = $row['classification'];
$ipdPrice = $row['ipdPrice'];
$opdPrice = $row['opdPrice'];
$invoiceNo = $row['invoiceNo'];
$fgQuantity = $row['fgQuantity'];
$unitOfMeasure = $row['unitOfMeasure'];

$beginningInvty = $row['lastEnd_QTY'];
$latestUnitcost = $row['unitcost'];
$latestEncoded = $row['beginningQTY'];
$returnItems = $this->inventoryMovement_returnItems($row['inventoryCode'],$row['stockCardNo'],$type);
$dispensedItems = $this->inventoryMovement_dispensedItems($row['inventoryCode'],$row['stockCardNo'],$type);
$soldItems = $this->inventoryMovement_soldItems($row['stockCardNo'],$type);
$endingInvty = ( (($latestEncoded - $dispensedItems) - $soldItems) + $returnItems + $beginningInvty );


echo "<tr>";
echo "<td><input type='checkbox' name='data[]' value=''></td>";
echo "<td>&nbsp;<font size=2>".$row['description']."</font><br>&nbsp;
<a href='/COCONUT/Reports/inventoryReport/inventoryMovement_pricelist.php?stockCardNo=$row[stockCardNo]&inventoryType=medicine' style='text-decoration:none; color:red'><font color=red size=2>See Price List</font></a></a></td>";
echo "<td>&nbsp;<font size=2>".$row['unitOfMeasure']."</font></td>";
echo "<td>&nbsp;<font size=2>".$latestUnitcost."</font></td>";
echo "<td>&nbsp;<font size=2>".$beginningInvty."</font></td>";
echo "<td>&nbsp;<font size=2>".$latestEncoded."</font></td>";
echo "<td>&nbsp;<a href='/COCONUT/inventory/inventoryMovement/listReturnItems.php?inventoryCode=$row[inventoryCode]&stockCardNo=$row[stockCardNo]&type=$type' target='_blank'><font size=2>".$returnItems."</font></a></td>";
echo "<td>&nbsp;<a href='/COCONUT/inventory/inventoryMovement/listDispensedItems.php?inventoryCode=$row[inventoryCode]&stockCardNo=$row[stockCardNo]&type=".strtoupper($type)."' style='text-decoration:none; color:black;' target='_blank'><font size=2>".$dispensedItems."</font></a></td>";
echo "<td>&nbsp;<font size=2><a href='/COCONUT/inventory/inventoryMovement/soldItems.php?stockCardNo=$row[stockCardNo]&title=$type' style='text-decoration:none;'>".$soldItems."</a></font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<font size=2>".$endingInvty."</font></td>";
echo "<td>&nbsp;<a href='/COCONUT/inventory/inventoryMovement/endInventory.php?inventoryCode=$inventoryCode&stockCardNo=$stockCardNo&description=$description&genericName=$genericName&preparation=$preparation&unitcost=$unitcost&phicPrice=$phicPrice&companyPrice=$companyPrice&quantity=$quantity&expiration=$expiration&addedBy=$addedBy&dateAdded=$dateAdded&timeAdded=$timeAdded&inventoryLocation=$inventoryLocation&inventoryType=$inventoryType&branch=$branch&transition=$transition&remarks=$remarks&phic=$phic&added=$added&criticalLevel=$criticalLevel&accountTitle=$accountTitle&supplier=$supplier&autoDispense=$autoDispense&status=$status&beginningCapital=$beginningCapital&beginningQTY=$beginningQTY&suppliesUNITCOST=$suppliesUNITCOST&from_inventoryCode=$from_inventoryCode&classification=$classification&ipdPrice=$ipdPrice&opdPrice=$opdPrice&invoiceNo=$invoiceNo&fgQuantity=$fgQuantity&unitOfMeasure=$unitOfMeasure' style='text-decoration:none; color:red;'>END</a></td>";
echo "<td><a href='#' style='text-decoration:none; color:blue;'>ADJ</a></td>";
echo "</tr>";
}
echo "</table>";
$result->close();
}


public function getStockCardNo($chargesCode) {

$connection = mysqli_connect(dbAuthenticate::$dbHost,dbAuthenticate::$dbUsername,dbAuthenticate::$dbPassword,dbAuthenticate::$dbName);      

$result = mysqli_query($connection, "select stockCardNo from inventory where inventoryCode='$chargesCode' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['stockCardNo'];
}

}


public function updateStockCardNo($chargesCode,$stockCardNo) {

$con = mysql_connect(dbAuthenticate::$dbHost,dbAuthenticate::$dbUsername,dbAuthenticate::$dbPassword);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db(dbAuthenticate::$dbName, $con);

mysql_query("UPDATE patientCharges SET stockCardNo='$stockCardNo' where chargesCode = '$chargesCode' ");

mysql_close($con);

}

public function inventoryMovement_updateStockCardNo($date,$date1,$title) {

$connection = mysqli_connect(dbAuthenticate::$dbHost,dbAuthenticate::$dbUsername,dbAuthenticate::$dbPassword,dbAuthenticate::$dbName);      

$result = mysqli_query($connection, "select pc.chargesCode,pc.stockCardNo,pc.itemNo,pc.description from patientCharges pc where (pc.dateCharge between '$date' and '$date1') and pc.title = '$title' ") or die("Query fail: " . mysqli_error()); 


echo "<table border=1>";
echo "<tr>";
echo "<th>ITEMNO</th>";
echo "<th>stockcardNo</th>";
echo "<th>Description</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
{
//$this->updateStockCardNo($row['chargesCode'],$this->getStockCardNo($row['chargesCode']));
echo "<Tr>";
echo "<td>".$row['itemNo']."</td>";
echo "<td>".$row['stockCardNo']."</td>";
echo "<td>".$row['description']."</td>";
echo "</tr>";
}
echo "</table>";
}



public function showEnding($username,$status,$stockCardNo,$description,$genericName) {

$connection = mysqli_connect(dbAuthenticate::$dbHost,dbAuthenticate::$dbUsername,dbAuthenticate::$dbPassword,dbAuthenticate::$dbName);      

$result = mysqli_query($connection, "select inventoryCode,description,genericName,quantity,endDate,endBy from inventory where stockCardNo = '$stockCardNo' and end='yes' order by endDate desc ") or die("Query fail: " . mysqli_error()); 


echo "<br><center>";
echo "<table border=1 cellspacing=0>";
echo "<tr>";
echo "<th>Description</th>";
echo "<th>QTY</th>";
echo "<th>End Date</th>";
echo "<th>End By</th>";
echo "<th>&nbsp;</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
{
//$this->updateStockCardNo($row['chargesCode'],$this->getStockCardNo($row['chargesCode']));
echo "<Tr>";
echo "<td>".$row['description']." - ".$row['genericName']."</td>";
echo "<td>".$row['quantity']."</td>";
echo "<td>".$row['endDate']."</td>";
echo "<td>".$row['endBy']."</td>";
echo "<td><a href='/COCONUT/inventory/addInventory.php?username=$username&status=$status&stockCardNo=$stockCardNo&description=$description&genericName=$genericName&biQTY=$row[quantity]&biInventoryCode=$row[inventoryCode]' style='text-decoration:none;'><font size=2 color=red>SELECT</font></a></td>";
echo "</tr>";
}
echo "</table>";
}



public function endInventory($stockCardNo,$description,$generic,$unitcost,$quantity,$expiration,$addedBy,$dateAdded,$timeAdded,$inventoryLocation,$inventoryType,$branch,$transition,$remarks,$preparation,$phic,$added,$criticalLevel,$supplier,$begCapital,$begQTY,$suppliesUNITCOST,$autoDispense,$status,$classification,$from_inventoryCode,$ipdPrice,$opdPrice,$unitOfMeasure,$end,$endBy,$endDate) {

$con = mysql_connect(dbAuthenticate::$dbHost,dbAuthenticate::$dbUsername,dbAuthenticate::$dbPassword);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db(dbAuthenticate::$dbName, $con);

$sql="INSERT INTO inventory (stockCardNo,description,genericName,unitcost,quantity,expiration,addedBy,dateAdded,timeAdded,inventoryLocation,inventoryType,branch,transition,remarks,preparation,phic,Added,criticalLevel,supplier,beginningCapital,beginningQTY,suppliesUNITCOST,autoDispense,classification,from_inventoryCode,ipdPrice,opdPrice,unitOfMeasure,end,endBy,endDate)
VALUES
('$stockCardNo','$description','$generic','$unitcost','$quantity','$expiration','$addedBy','$dateAdded','$timeAdded','$inventoryLocation','$inventoryType','$branch','$transition','$remarks','$preparation','$phic','$added','$criticalLevel','$supplier','$begCapital','$begQTY','$suppliesUNITCOST','$autoDispense','$classification','$from_inventoryCode','$ipdPrice','$opdPrice','$unitOfMeasure','$end','$endBy','$endDate')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

echo "</script>";

mysql_close($con);

}



public function endInventory_removeMainItem($inventoryCode,$username,$date) {


// Create connection
$conn = new mysqli(dbAuthenticate::$dbHost,dbAuthenticate::$dbUsername,dbAuthenticate::$dbPassword,dbAuthenticate::$dbName);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE inventory SET end='yes',endBy='$username',endDate='$date',status='DELETED_".$username."' WHERE inventoryCode=$inventoryCode";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();

}


public $getAdmissionKit_total;
public $getAdmissionKit_No;

public function getAdmissionKit($date,$date1) {

$connection = mysqli_connect(dbAuthenticate::$dbHost,dbAuthenticate::$dbUsername,dbAuthenticate::$dbPassword,dbAuthenticate::$dbName);      

$result = mysqli_query($connection, "select pr.lastName,pr.firstName,pc.description,pc.quantity,rd.dateRegistered from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and pc.chargesCode = '348' and pc.title = 'SUPPLIES' and (pc.dateCharge between '$date' and '$date1') order by rd.dateRegistered,pr.lastName asc") or die("Query fail: " . mysqli_error()); 


echo "<table border=1 cellspacing=0>";
echo "<tr>";
echo "<th>&nbsp;</th>";
echo "<th>Patient</th>";
echo "<th>Desc</th>";
echo "<th>QTY</th>";
echo "<th>In</th>";
echo "</tr>";

$this->getAdmissionKit_No = 1;

while($row = mysqli_fetch_array($result))
{
$this->getAdmissionKit_total += $row['quantity'];

echo "<Tr>";
echo "<td>&nbsp;".$this->getAdmissionKit_No++."</td>";
echo "<td>&nbsp;".$row['lastName'].", ".$row['firstName']."</td>";
echo "<td>&nbsp;".$row['description']."</td>";
echo "<td>&nbsp;".$row['quantity']."</td>";
echo "<td>&nbsp;".$row['dateRegistered']."</td>";
echo "</tr>";
}
echo "<Tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;".number_format($this->getAdmissionKit_total)."</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";
echo "</table>";
}






}


?>
