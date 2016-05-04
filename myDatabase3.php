<?php
include("myDatabase2.php");

class database3 extends database2 {


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


public function getBalances($date1,$date2,$username,$shift) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }
</style>";


$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select pr.lastName,pr.firstName,rd.registrationNo from patientRecord pr,registrationDetails rd where pr.patientNo = rd.patientNo and (rd.dateUnregistered between '$date1' and '$date2') and balance != '' ") or die("Query fail: " . mysqli_error()); 


echo "<br><br><center>";
echo "<table border=1 cellspacing=0>";
echo "<tr>";
echo "<th>Name</th>";
echo "<th></th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>&nbsp;".$row['lastName'].", ".$row['firstName']."&nbsp;</td>";
echo "<td>&nbsp;<a href='/COCONUT/Cashier/balances1.php?registrationNo=$row[registrationNo]&username=$username&shift=$shift' style='text-decoration:none;'><font color='red' size='2'>View Balance</font></a>&nbsp;</td>";
echo "</tr>";
}

$this->coconutTableStop();

}



public function showPatientViaCount($pxCount,$date,$username) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }
</style>";


$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select pr.lastName,pr.firstName,rd.pxCount,rd.registrationNo,rd.registrationNo from patientRecord pr,registrationDetails rd where pr.patientNo = rd.patientNo and rd.pxCount = '$pxCount' and rd.dateRegistered = '$date' and rd.type='OPD' ") or die("Query fail: " . mysqli_error()); 


echo "<br><br>";
echo "<table border=1 style='border:1px solid #ff0000;' cellspacing=0>";
echo "<tr>";
echo "<th>#</th>";
echo "<th>Name</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
{
echo "<form method='get' action='/COCONUT/patientProfile/patientProfile_handler.php' target='rightFrame'>";
echo "<input type='hidden' name='username' value='$username'>";
echo "<input type='hidden' name='registrationNo' value='$username'>";
echo "<input type='hidden' name='from' value='PHARMACY'>";
echo "<input type='hidden' name='registrationNo' value='$row[registrationNo]'>";
echo "<tr>";
echo "<td>&nbsp;".$row['pxCount']."</td>";
echo "<td>&nbsp;<input style='border:1px solid #0000ff; color:blue;' type='submit' value='".$row['lastName'].", ".$row['firstName']."'>&nbsp;</td>";
echo "</tr>";
echo "</form>";

}

$this->coconutTableStop();

}



public $accounting_purchaseJournal_itemized_total;
public $accounting_purchaseJournal_itemized_purchases;
public $accounting_purchaseJournal_itemized_inputVAT;
public function accounting_purchaseJournal_itemized($siNo) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }
</style>";


$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select description,unitPrice,quantity from salesInvoiceItems where siNo = '$siNo' ") or die("Query fail: " . mysqli_error()); 

$this->accounting_purchaseJournal_itemized_total = 0;
while($row = mysqli_fetch_array($result))
{
$this->accounting_purchaseJournal_itemized_total += ($row['unitPrice'] * $row['quantity']);
}

$lessVAT = number_format(($this->accounting_purchaseJournal_itemized_total / 1.12),2);
$lessVAT_noFormat = ($this->accounting_purchaseJournal_itemized_total / 1.12);
$inputVAT = ($lessVAT_noFormat * 0.12);


$this->accounting_purchaseJournal_itemized_purchases = $lessVAT_noFormat;
$this->accounting_purchaseJournal_itemized_inputVAT = $inputVAT;

echo "<Tr>";
echo "<td>INVENTORY</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;".number_format($this->accounting_purchaseJournal_itemized_purchases,2)."</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

echo "<Tr>";
echo "<td>INPUT VAT</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;".number_format($this->accounting_purchaseJournal_itemized_inputVAT,2)."</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

}


public $accounting_purchaseJournal_accountsPayable;

public function accounting_purchaseJournal($date1,$date2) {

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

tr.border_bottom td {
  border-bottom:1pt solid #CCCCCC;
}

tr.table_header th {
  border-bottom:1pt solid black;
}

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " SELECT invoiceNo,supplier,transactionDate,siNo,terms from salesInvoice where (transactionDate between '$date1' and '$date2') and status = 'Active' ") or die("Query fail: " . mysqli_error()); 


echo "<br>";
echo "<table border=0 width='70%'>";
echo "<tr class='table_header'>";
echo "<th>Account</th>";
echo "<th>Date</th>";
echo "<th>Debit</th>";
echo "<th>Credit</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->coconutTableData("<font size=3><b><a href='/COCONUT/accounting/voucher/accountsPayableVoucher.php?invoiceNo=$row[invoiceNo]' target='_blank' style='text-decoration:none;'>Invoice#:".$row['invoiceNo']."</font></a></b><br><font size=3>".$this->selectNow("supplier","supplierName","supplierCode",$row['supplier'])."</font>");
$this->coconutTableData("<font size=3>".$row['transactionDate']."</font>");
$this->coconutTableData("&nbsp;");
$this->coconutTableData("&nbsp;");
$this->accounting_purchaseJournal_itemized($row['siNo']);
$this->coconutTableRowStop();



/*
$this->getVouchersNo();
$myFile = $this->getReportInformation("homeRoot")."/COCONUT/trackingNo/voucherNo.dat";
$fh = fopen($myFile, 'r');
$voucherNo = fread($fh, 100);
fclose($fh);
$voucherNo1 = "AP".$voucherNo;
*/
$voucherNo1 = $this->selectNow("trackingNo","value","name","voucherNo");
//insert to purchaseJournal
$this->accounting_purchaseJournal_accountsPayable = ( $this->accounting_purchaseJournal_itemized_purchases + $this->accounting_purchaseJournal_itemized_inputVAT );

if( $this->selectNow("purchaseJournal","invoiceNo","siNo",$row['siNo']) == "" ) {
$this->addToPurchaseJournal($voucherNo1,$this->selectNow("salesInvoice","invoiceNo","siNo",$row['siNo']),"INVENTORY",round($this->accounting_purchaseJournal_itemized_purchases,2),"",$row['siNo'],$row['transactionDate']);
$this->addToPurchaseJournal($voucherNo1,$this->selectNow("salesInvoice","invoiceNo","siNo",$row['siNo']),"INPUT VAT",round($this->accounting_purchaseJournal_itemized_inputVAT,2),"",$row['siNo'],$row['transactionDate']);

if( $row['terms'] == "CASH" || $row['terms'] == "C.O.D" || $row['terms'] == "Retail" ) {
$this->addToPurchaseJournal($voucherNo1,$this->selectNow("salesInvoice","invoiceNo","siNo",$row['siNo']),"CASH","",round($this->accounting_purchaseJournal_accountsPayable,2),$row['siNo'],$row['transactionDate']);
}else {
$this->addToPurchaseJournal($voucherNo1,$this->selectNow("salesInvoice","invoiceNo","siNo",$row['siNo']),"ACCOUNTS-PAYABLE","",round($this->accounting_purchaseJournal_accountsPayable,2),$row['siNo'],$row['transactionDate']);
}
$incrementVoucherNo = ($this->selectNow("trackingNo","value","name","voucherNo"));
$this->editNow("trackingNo","name","voucherNo","value",$incrementVoucherNo);
}else {
//do nothing
}

echo "<tr class='border_bottom'>";
if( $row['terms'] == "CASH" || $row['terms'] == "C.O.D" || $row['terms'] == "Retail" ) {
echo "<td>CASH</td>";
}else {
echo "<td>ACCOUNTS PAYABLE</td>";
}
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;".number_format($this->accounting_purchaseJournal_accountsPayable,2)."</td>";
echo "</tr>";
}

$this->coconutTableStop();
}



public $transactionSummary_getPatient_cash_total;
public function transactionSummary_getPatient_cash($date,$date1,$title) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }
</style>";


$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select pr.lastName,pr.firstName,pc.description,pc.cashPaid from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and rd.type = 'OPD' and (pc.datePaid between '$date' and '$date1') and pc.status = 'PAID' and pc.title = '$title' order by pr.lastName asc ") or die("Query fail: " . mysqli_error()); 


echo "<br><br><center>";
echo "<table border=1 cellspacing=0>";
echo "<tr>";
echo "<th>Name</th>";
echo "<th>Exam</th>";
echo "<Th>Amount</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
{
$this->transactionSummary_getPatient_cash_total += $row['cashPaid'];
echo "<tr>";
echo "<td>&nbsp;".$row['lastName'].", ".$row['firstName']."&nbsp;</td>";
echo "<Td>&nbsp;".$row['description']."</td>";
echo "<td>&nbsp;".$row['cashPaid']."</td>";
echo "</tr>";
}
echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;".number_format($this->transactionSummary_getPatient_cash_total,2)."</td>";
echo "</tr>";
$this->coconutTableStop();

}



public $transactionSummary_getPatient_hmo_total;
public function transactionSummary_getPatient_hmo($date,$date1,$title) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }
</style>";


$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select pr.lastName,pr.firstName,pc.description,pc.company,rd.Company from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and pc.status = 'UNPAID' and (rd.dateUnregistered between '$date' and '$date1') and rd.type='OPD' and pc.title = '$title' ") or die("Query fail: " . mysqli_error()); 


echo "<br><br><center>";
echo "<table border=1 cellspacing=0>";
echo "<tr>";
echo "<th>Name</th>";
echo "<th>HMO</th>";
echo "<th>Exam</th>";
echo "<Th>Amount</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
{
$this->transactionSummary_getPatient_hmo_total += $row['company'];
echo "<tr>";
echo "<td>&nbsp;".$row['lastName'].", ".$row['firstName']."&nbsp;</td>";
echo "<Td>&nbsp;".$row['Company']."</td>";
echo "<Td>&nbsp;".$row['description']."</td>";
echo "<td>&nbsp;".$row['company']."</td>";
echo "</tr>";
}
echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;".number_format($this->transactionSummary_getPatient_hmo_total,2)."</td>";
echo "</tr>";
$this->coconutTableStop();

}


public function getDebitPx_discount($date1,$date2) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }
</style>";


$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select pr.lastName,pr.firstName,pc.description,pc.discount from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and (rd.dateUnregistered between '$date1' and '$date2') and pc.discount > 0 order by pr.lastName asc ") or die("Query fail: " . mysqli_error()); 


echo "<br><br><center>";
echo "<table border=1 cellspacing=0>";
echo "<tr>";
echo "<th>Name</th>";
echo "<th>Description</th>";
echo "<th>Discount</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>&nbsp;".$row['lastName'].", ".$row['firstName']."&nbsp;</td>";
echo "<td>&nbsp;".$row['description']."&nbsp;</td>";
echo "<td>&nbsp;".$row['discount']."&nbsp;</td>";
echo "</tr>";
}
echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";
$this->coconutTableStop();

}


public $discountPerTitle;

public function discountPerTitle($title,$date1,$date2) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }
</style>";


$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select pr.lastName,pr.firstName,pc.description,pc.discount from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and (rd.dateUnregistered between '$date1' and '$date2') and pc.discount > 0 and pc.title = '$title' and rd.type='OPD' and pc.status in ('PAID','UNPAID') order by pr.lastName asc ") or die("Query fail: " . mysqli_error()); 


echo "<br><br><center>";
echo "<table border=1 cellspacing=0>";
echo "<tr>";
echo "<th>Name</th>";
echo "<th>Description</th>";
echo "<th>Discount</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
{
$this->discountPerTitle += $row['discount'];
echo "<tr>";
echo "<td>&nbsp;".$row['lastName'].", ".$row['firstName']."&nbsp;</td>";
echo "<td>&nbsp;".$row['description']."&nbsp;</td>";
echo "<td>&nbsp;".$row['discount']."&nbsp;</td>";
echo "</tr>";
}
echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;".number_format($this->discountPerTitle,2)."</td>";
echo "</tr>";
$this->coconutTableStop();

}


public $creditCardPatient_total;

public function creditCardPatient($title,$date1,$date2) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }
</style>";


$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select pr.lastName,pr.firstName,pc.description,pc.amountPaidFromCreditCard from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and (pc.datePaid between '$date1' and '$date2') and pc.paidVia = 'Credit Card' and pc.title = '$title' order by pr.lastName asc ") or die("Query fail: " . mysqli_error()); 


echo "<br><br><center>";
echo "<table border=1 cellspacing=0>";
echo "<tr>";
echo "<th>Name</th>";
echo "<th>Description</th>";
echo "<th>Discount</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
{
$this->creditCardPatient_total += $row['amountPaidFromCreditCard'];
echo "<tr>";
echo "<td>&nbsp;".$row['lastName'].", ".$row['firstName']."&nbsp;</td>";
echo "<td>&nbsp;".$row['description']."&nbsp;</td>";
echo "<td>&nbsp;".$row['amountPaidFromCreditCard']."&nbsp;</td>";
echo "</tr>";
}
echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;".number_format($this->creditCardPatient_total,2)."</td>";
echo "</tr>";
$this->coconutTableStop();

}


public $patientPersonalBalance;

public function patientPersonalBalance($dept,$date,$date1) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select pr.firstName,pr.lastName,pc.description,pc.cashUnpaid from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and rd.type = 'OPD' and (rd.dateUnregistered between '$date' and '$date1') and pc.cashUnpaid > 0 and pc.status in ('PAID','BALANCE') and pc.title = '$dept' ") or die("Query fail: " . mysqli_error()); 

echo "<br><br><center>";
echo "<table border=1 cellspacing=0>";
echo "<tr>";
echo "<th>Name</th>";
echo "<th>Description</th>";
echo "<th>Balance</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
{
$this->patientPersonalBalance += $row['cashUnpaid'];
echo "<tr>";
echo "<Td>&nbsp;".$row['lastName'].", ".$row['firstName']."</tD>";
echo "<td>&nbsp;".$row['description']."</td>";
echo "<td>&nbsp;".$row['cashUnpaid']."</td>";
echo "</tr>";
}
echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;".number_format($this->patientPersonalBalance,2)."</td>";
echo "</tr>";
}





public function addInvoice($invoiceNo,$supplier,$terms,$received,$amount,$dateEncoded,$username) {

/* make your connection */
$sql = new mysqli($this->host,$this->username,$this->password,$this->database);
 
/* we will just create an insert query here, and use it,
normally this would be done by form submission or other means */
$query = "insert into invoices(invoiceNo,supplier,terms,received,amount,dateEncoded,username) values('$invoiceNo','$supplier','$terms','$received','$amount','$dateEncoded','$username')";
 
if ( $sql->query($query) ) {
   //echo "A new entry has been added with the `id`";
} else {
    echo "There was a problem:<br />$query<br />{$sql->error}";
}
 
/* close our connection */
$sql->close();
}


public function addToPurchaseJournal($vouchersCode,$invoiceNo,$accountTitle,$debit,$credit,$siNo,$date) {

/* make your connection */
$sql = new mysqli($this->host,$this->username,$this->password,$this->database);
 
/* we will just create an insert query here, and use it,
normally this would be done by form submission or other means */
$query = "insert into purchaseJournal(vouchersCode,invoiceNo,accountTitle,debit,credit,siNo,date) values('$vouchersCode','$invoiceNo','$accountTitle','$debit','$credit','$siNo','$date')";
 
if ( $sql->query($query) ) {
   //echo "A new entry has been added with the `id`";
} else {
    echo "There was a problem:<br />$query<br />{$sql->error}";
}
 
/* close our connection */
$sql->close();
}


public function payment_voucher_purhcasing($invoiceNo,$checkNo,$bank,$orNo,$paymentMode,$description,$amount,$vattable,$wtax,$vat,$payee,$date,$username,$voucherNo) {

/* make your connection */
$sql = new mysqli($this->host,$this->username,$this->password,$this->database);
 
/* we will just create an insert query here, and use it,
normally this would be done by form submission or other means */
$query = "insert into vouchers(invoiceNo,checkedNo,bank,orNo,paymentMode,description,amount,vattable,wtax,vat,payee,date,user,voucherNo,time) values('$invoiceNo','$checkNo','$bank','$orNo','$paymentMode','$description','$amount','$vattable','$wtax','$vat','$payee','$date','$username','$voucherNo','".date("H:i:s")."')";
 
if ( $sql->query($query) ) {
   //echo "A new entry has been added with the `id`";
} else {
    echo "There was a problem:<br />$query<br />{$sql->error}";
}
 
/* close our connection */
$sql->close();
}

public function invoiceItem($invoiceNo) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }
</style>";


$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select description,quantity from inventory where invoiceNo = '$invoiceNo' ") or die("Query fail: " . mysqli_error()); 


echo "<br><br><center>";
echo "<table border=1 cellspacing=0>";
echo "<tr>";
echo "<th>Description</th>";
echo "<th>QTY</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>&nbsp;".$row['description']."&nbsp;</td>";
echo "<td>&nbsp;".$row['quantity']."&nbsp;</td>";
echo "</tr>";
}
echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";
$this->coconutTableStop();

}



public function updatePricez($registrationNo,$show,$check) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }
</style>";


$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


if( $show == "All" ) {
$result = mysqli_query($connection, " select pc.itemNo,pc.description,pc.sellingPrice,rd.type,rd.registrationNo,pc.title from patientCharges pc,registrationDetails rd where rd.registrationNo = '$registrationNo' and rd.registrationNo = pc.registrationNo and pc.status = 'UNPAID' and pc.title not in ('PROFESSIONAL FEE','Room and Board','SUPPLIES') order by pc.title asc ") or die("Query fail: " . mysqli_error()); 
}else {
$result = mysqli_query($connection, " select pc.itemNo,pc.description,pc.sellingPrice,rd.type,rd.registrationNo,pc.title from patientCharges pc,registrationDetails rd where rd.registrationNo = '$registrationNo' and rd.registrationNo = pc.registrationNo and pc.status = 'UNPAID' and pc.title = '$show' order by pc.title asc ") or die("Query fail: " . mysqli_error()); 
}


echo "<form method='get' action='/COCONUT/patientProfile/updatePrice1.php'>";
echo "<center>";
echo "<table border=1 cellspacing=0>";
echo "<tr>";
echo "<th>&nbsp;</th>";
echo "<th>Description</th>";
echo "<th>Price</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
{
$this->coconutHidden("registrationNo",$row['registrationNo']);
$this->coconutHidden("type",$row['type']);

echo "<tr>";
echo "<td><input type='checkbox' name='itemNo[]' value='$row[itemNo]' $check ></td>";
echo "<td>&nbsp;".$row['description']."<br><a href='/COCONUT/patientProfile/updatePrice.php?registrationNo=$registrationNo&show=$row[title]' style='text-decoration:none; color:red;'><font size=2 color=red>($row[title])</font></a>&nbsp;</td>";
echo "<td>&nbsp;".$row['sellingPrice']."&nbsp;</td>";
echo "</tr>";
}
echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";
$this->coconutTableStop();
echo "<br>";
$this->coconutButton("Proceed");
echo "</form>";
}



public function updatePriceNow_inventory($registrationNo,$itemNo,$sellingPrice,$total) {

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

mysql_query("UPDATE patientCharges SET sellingPrice = '$sellingPrice',total = '$total',cashUnpaid='$total'
WHERE itemNo = '$itemNo' and registrationNo = '$registrationNo' ");

mysql_close($con);

}

public function updatePriceNow_charges($registrationNo,$itemNo,$sellingPrice,$total) {

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

mysql_query("UPDATE patientCharges SET sellingPrice = '$sellingPrice',total = '$total',cashUnpaid='$total'
WHERE itemNo = '$itemNo' and registrationNo = '$registrationNo' ");

mysql_close($con);

}



public function opdTransaction_total($registrationNo,$title) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select sum(total) as total from patientCharges where registrationNo = '$registrationNo' and title = '$title' and status in ('PAID','UNPAID','BALANCE') ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['total'];
}

}

public function opdTransaction_cashPaid($registrationNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select sum(cashPaid) as pd from patientCharges where registrationNo = '$registrationNo' and cashPaid > 0 ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['pd'];
}

}


public function opdTransaction_balance($registrationNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select sum(cashUnpaid) as bal from patientCharges where registrationNo = '$registrationNo' and cashUnpaid > 0 and status not like 'DELETED%%%%%%' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['bal'];
}

}



public function opdTransaction_covered($registrationNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select sum(company) as comp from patientCharges where registrationNo = '$registrationNo' and status = 'UNPAID' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['comp'];
}

}


public function opdTransaction_paidTitle($registrationNo,$title) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select sum(cashPaid) as pd from patientCharges where registrationNo = '$registrationNo' and status = 'PAID' and title = '$title' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['pd'];
}

}


public function opdTransaction_covered_finish($registrationNo,$title) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select sum(pc.company) as compFinish from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and pc.registrationNo = '$registrationNo' and pc.status = 'UNPAID' and pc.title = '$title' and rd.mgh != '' and rd.dateUnregistered != ''  ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['compFinish'];
}

}


public function opdTransaction_cash_balance($registrationNo,$title) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select sum(pc.cashUnpaid) as bal from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and pc.registrationNo = '$registrationNo' and pc.status = 'UNPAID' and pc.title = '$title' and rd.mgh = '' and rd.dateUnregistered = ''  ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['bal'];
}

}


public $opdTransaction_pf;
public $opdTransaction_med;
public $opdTransaction_sup;
public $opdTransaction_lab;
public $opdTransaction_rad;
public $opdTransaction_xray;
public $opdTransaction_utz;
public $opdTransaction_ctscan;
public $opdTransaction_misc;
public $opdTransaction_ecg;
public $opdTransaction_pt;
public $opdTransaction_ot;
public $opdTransaction_st;
public $opdTransaction_paid_pf;

public $opdTransaction_paid_meds;
public $opdTransaction_covered_meds;
public $opdTransaction_cash_balance_meds;


public function opdTransaction($dateRegister,$show) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }

</style>";


$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select pr.lastName,pr.firstName,rd.pxCount,rd.registrationNo,rd.Company,rd.mgh from patientRecord pr,registrationDetails rd where pr.patientNo = rd.patientNo and rd.dateRegistered = '$dateRegister' and rd.pxCount > 0 and rd.type = 'OPD' order by rd.pxCount asc  ") or die("Query fail: " . mysqli_error()); 


echo "<center>";
echo "<table width='auto' border=1 cellspacing=0>";
echo "<tr>";
echo "<th><font size=2>#</font></th>";
echo "<th><font size=2>Patient</font></th>";
echo "<th><font size=2>Doc</font></th>";
echo "<th><font size=2>Med</font></th>";
echo "<th><font size=2>Supp</font></th>";
echo "<th><font size=2>Lab</font></th>";
echo "<th><font size=2>Rad</font></th>";
echo "<th><font size=2>XRAY</font></th>";
echo "<th><font size=2>UTZ</font></th>";
echo "<th><font size=2>CTSCAN</font></th>";
echo "<th><font size=2>Misc</font></th>";
echo "<th><font size=2>ECG</font></th>";
echo "<th><font size=2>PT</font></th>";
echo "<th><font size=2>OT</font></th>";
echo "<th><font size=2>ST</font></th>";
echo "<th><font size=2>ER FEE</font></th>";
echo "<th><font size=2>SPIRO</font></th>";
echo "<th><font size=2>OR/DR/ER</font></th>";
echo "<th><font size=2>Total</font></th>";
echo "<th><font size=2>Balance</font></th>";
echo "<th><font size=2>Paid</font></th>";
echo "<th><font size=2>Covered</font></th>";
echo "<th><font size=2>Company</font></th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
{

$pf = $this->opdTransaction_total($row['registrationNo'],"PROFESSIONAL FEE");
$medicine = $this->opdTransaction_total($row['registrationNo'],"MEDICINE");
$supplies = $this->opdTransaction_total($row['registrationNo'],"SUPPLIES");
$laboratory = $this->opdTransaction_total($row['registrationNo'],"LABORATORY");
$radiology = $this->opdTransaction_total($row['registrationNo'],"RADIOLOGY");
$xray = $this->opdTransaction_total($row['registrationNo'],"XRAY");
$ultrasound = $this->opdTransaction_total($row['registrationNo'],"ULTRASOUND");
$ctscan = $this->opdTransaction_total($row['registrationNo'],"CTSCAN");
$misc = $this->opdTransaction_total($row['registrationNo'],"MISCELLANEOUS");
$ecg = $this->opdTransaction_total($row['registrationNo'],"ECG");
$pt = $this->opdTransaction_total($row['registrationNo'],"PT");
$ot = $this->opdTransaction_total($row['registrationNo'],"OT");
$st = $this->opdTransaction_total($row['registrationNo'],"ST");
$erFee = $this->opdTransaction_total($row['registrationNo'],"ER FEE");
$spirometry = $this->opdTransaction_total($row['registrationNo'],"SPIROMETRY");
$orDr = $this->opdTransaction_total($row['registrationNo'],"OR/DR/ER Fee");

$this->opdTransaction_pf += $pf;
$this->opdTransaction_med += $medicine;
$this->opdTransaction_sup += $supplies;
$this->opdTransaction_lab += $laboratory;
$this->opdTransaction_rad += $radiology;
$this->opdTransaction_xray += $xray;
$this->opdTransaction_utz += $ultrasound;
$this->opdTransaction_ctscan += $ctscan;
$this->opdTransaction_misc += $misc;
$this->opdTransaction_ecg += $ecg;
$this->opdTransaction_pt += $pt;
$this->opdTransaction_ot += $ot;
$this->opdTransaction_st += $st;

$total = ( $pf + $medicine + $supplies + $laboratory + $radiology + $xray + $ultrasound + $ctscan + $misc + $ecg + $pt + $ot + $st + $erFee + $spirometry + $orDr );

echo "<tr>";
echo "<td>&nbsp;<font size=2>".$row['pxCount']."</font>&nbsp;</td>";
if( $row['mgh'] != "" ) {
echo "<td>".$this->coconutImages_return("locked1.jpeg")."&nbsp;<font size=2 color=red>".$row['lastName'].", ".$row['firstName']."</font>&nbsp;</td>";
}else {
echo "<td>&nbsp;<font size=2>".$row['lastName'].", ".$row['firstName']."</font>&nbsp;</td>";
}
echo "<td>&nbsp;<font size=2>".$pf."</font></td>";
echo "<td>&nbsp;<font size=2>".$medicine."</font></td>";
echo "<td>&nbsp;<font size=2>".$supplies."</font></td>";
echo "<td>&nbsp;<font size=2>".$laboratory."</font></td>";
echo "<td>&nbsp;<font size=2>".$radiology."</font></td>";
echo "<td>&nbsp;<font size=2>".$xray."</font></td>";
echo "<td>&nbsp;<font size=2>".$ultrasound."</font></td>";
echo "<td>&nbsp;<font size=2>".$ctscan."</font></td>";
echo "<td>&nbsp;<font size=2>".$misc."</font></td>";
echo "<td>&nbsp;<font size=2>".$ecg."</font></td>";
echo "<td>&nbsp;<font size=2>".$pt."</font></td>";
echo "<td>&nbsp;<font size=2>".$ot."</font></td>";
echo "<td>&nbsp;<font size=2>".$st."</font></td>";
echo "<td>&nbsp;<font size=2>".$erFee."</font></td>";
echo "<td>&nbsp;<font size=2>".$spirometry."</font></td>";
echo "<td>&nbsp;<font size=2>".$orDr."</font></td>";
echo "<td>&nbsp;<font size=2>".number_format($total,2)."</font></td>";

if( $this->opdTransaction_balance($row['registrationNo']) > 0 ) {
echo "<td>&nbsp;<font size=2 color=red>".number_format($this->opdTransaction_balance($row['registrationNo']),2)."</font></td>";
}else {
echo "<td>&nbsp;<font size=2>".number_format($this->opdTransaction_balance($row['registrationNo']),2)."</font></td>";
}
echo "<td>&nbsp;<font size=2>".number_format($this->opdTransaction_cashPaid($row['registrationNo']),2)."</font></td>";
echo "<td>&nbsp;<font size=2>".number_format($this->opdTransaction_covered($row['registrationNo']),2)."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['Company']."</font></td>";
echo "</tr>";
}
if( $show == "yes" ) {
echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<font size=2><b>TOTAL</b></font></td>";
echo "<td>&nbsp;<font size=2>".$this->opdTransaction_pf."</font></td>";
echo "<td>&nbsp;<font size=2>".$this->opdTransaction_med."</font></td>";
echo "<td>&nbsp;<font size=2>".$this->opdTransaction_sup."</font></td>";
echo "<td>&nbsp;<font size=2>".$this->opdTransaction_lab."</font></td>";
echo "<td>&nbsp;<font size=2>".$this->opdTransaction_rad."</font></td>";
echo "<td>&nbsp;<font size=2>".$this->opdTransaction_xray."</font></td>";
echo "<td>&nbsp;<font size=2>".$this->opdTransaction_utz."</font></td>";
echo "<td>&nbsp;<font size=2>".$this->opdTransaction_ctscan."</font></td>";
echo "<td>&nbsp;<font size=2>".$this->opdTransaction_misc."</font></td>";
echo "<td>&nbsp;<font size=2>".$this->opdTransaction_ecg."</font></td>";
echo "<td>&nbsp;<font size=2>".$this->opdTransaction_pt."</font></td>";
echo "<td>&nbsp;<font size=2>".$this->opdTransaction_ot."</font></td>";
echo "<td>&nbsp;<font size=2>".$this->opdTransaction_st."</font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";
}else {
echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<font size=2><b>TOTAL</b></font></td>";
echo "<td>&nbsp;<font size=2></font></td>";
echo "<td>&nbsp;<font size=2></font></td>";
echo "<td>&nbsp;<font size=2></font></td>";
echo "<td>&nbsp;<font size=2></font></td>";
echo "<td>&nbsp;<font size=2></font></td>";
echo "<td>&nbsp;<font size=2></font></td>";
echo "<td>&nbsp;<font size=2></font></td>";
echo "<td>&nbsp;<font size=2></font></td>";
echo "<td>&nbsp;<font size=2></font></td>";
echo "<td>&nbsp;<font size=2></font></td>";
echo "<td>&nbsp;<font size=2></font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";
}

$this->coconutTableStop();
}




public function opdTransaction_float($dateRegister,$show) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }

</style>";


$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select pr.lastName,pr.firstName,rd.pxCount,rd.registrationNo,rd.Company,rd.mgh from patientRecord pr,registrationDetails rd where pr.patientNo = rd.patientNo and rd.dateRegistered = '$dateRegister' and rd.type = 'OPD' and rd.dateUnregistered = '' and rd.mgh = '' order by rd.pxCount asc  ") or die("Query fail: " . mysqli_error()); 


echo "<center>";
echo "<table width='auto' border=1 cellspacing=0>";
echo "<tr>";
echo "<th><font size=2>#</font></th>";
echo "<th><font size=2>Patient</font></th>";
echo "<th><font size=2>Doc</font></th>";
echo "<th><font size=2>Med</font></th>";
echo "<th><font size=2>Supp</font></th>";
echo "<th><font size=2>Lab</font></th>";
echo "<th><font size=2>Rad</font></th>";
echo "<th><font size=2>XRAY</font></th>";
echo "<th><font size=2>UTZ</font></th>";
echo "<th><font size=2>CTSCAN</font></th>";
echo "<th><font size=2>Misc</font></th>";
echo "<th><font size=2>ECG</font></th>";
echo "<th><font size=2>PT</font></th>";
echo "<th><font size=2>OT</font></th>";
echo "<th><font size=2>ER FEE</font></th>";
echo "<th><font size=2>SPIRO</font></th>";
echo "<th><font size=2>OR/DR/ER</font></th>";
echo "<th><font size=2>Total</font></th>";
echo "<th><font size=2>Balance</font></th>";
echo "<th><font size=2>Paid</font></th>";
echo "<th><font size=2>Covered</font></th>";
echo "<th><font size=2>Company</font></th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
{

$pf = $this->opdTransaction_total($row['registrationNo'],"PROFESSIONAL FEE");
$medicine = $this->opdTransaction_total($row['registrationNo'],"MEDICINE");
$supplies = $this->opdTransaction_total($row['registrationNo'],"SUPPLIES");
$laboratory = $this->opdTransaction_total($row['registrationNo'],"LABORATORY");
$radiology = $this->opdTransaction_total($row['registrationNo'],"RADIOLOGY");
$xray = $this->opdTransaction_total($row['registrationNo'],"XRAY");
$ultrasound = $this->opdTransaction_total($row['registrationNo'],"ULTRASOUND");
$ctscan = $this->opdTransaction_total($row['registrationNo'],"CTSCAN");
$misc = $this->opdTransaction_total($row['registrationNo'],"MISCELLANEOUS");
$ecg = $this->opdTransaction_total($row['registrationNo'],"ECG");
$pt = $this->opdTransaction_total($row['registrationNo'],"PT");
$ot = $this->opdTransaction_total($row['registrationNo'],"OT");
$erFee = $this->opdTransaction_total($row['registrationNo'],"ER FEE");
$spirometry = $this->opdTransaction_total($row['registrationNo'],"SPIROMETRY");
$orDr = $this->opdTransaction_total($row['registrationNo'],"OR/DR/ER Fee");

$this->opdTransaction_pf += $pf;
$this->opdTransaction_med += $medicine;
$this->opdTransaction_sup += $supplies;
$this->opdTransaction_lab += $laboratory;
$this->opdTransaction_rad += $radiology;
$this->opdTransaction_xray += $xray;
$this->opdTransaction_utz += $ultrasound;
$this->opdTransaction_ctscan += $ctscan;
$this->opdTransaction_misc += $misc;
$this->opdTransaction_ecg += $ecg;
$this->opdTransaction_pt += $pt;
$this->opdTransaction_ot += $ot;

$total = ( $pf + $medicine + $supplies + $laboratory + $radiology + $xray + $ultrasound + $ctscan + $misc + $ecg + $pt + $ot + $erFee + $spirometry + $orDr );

echo "<tr>";
echo "<td>&nbsp;<font size=2>".$row['pxCount']."</font>&nbsp;</td>";
if( $row['mgh'] != "" ) {
echo "<td>".$this->coconutImages_return("locked1.jpeg")."&nbsp;<font size=2 color=red>".$row['lastName'].", ".$row['firstName']."</font>&nbsp;</td>";
}else {
echo "<td>&nbsp;<font size=2>".$row['lastName'].", ".$row['firstName']."</font>&nbsp;</td>";
}
echo "<td>&nbsp;<font size=2>".$pf."</font></td>";
echo "<td>&nbsp;<font size=2>".$medicine."</font></td>";
echo "<td>&nbsp;<font size=2>".$supplies."</font></td>";
echo "<td>&nbsp;<font size=2>".$laboratory."</font></td>";
echo "<td>&nbsp;<font size=2>".$radiology."</font></td>";
echo "<td>&nbsp;<font size=2>".$xray."</font></td>";
echo "<td>&nbsp;<font size=2>".$ultrasound."</font></td>";
echo "<td>&nbsp;<font size=2>".$ctscan."</font></td>";
echo "<td>&nbsp;<font size=2>".$misc."</font></td>";
echo "<td>&nbsp;<font size=2>".$ecg."</font></td>";
echo "<td>&nbsp;<font size=2>".$pt."</font></td>";
echo "<td>&nbsp;<font size=2>".$ot."</font></td>";
echo "<td>&nbsp;<font size=2>".$erFee."</font></td>";
echo "<td>&nbsp;<font size=2>".$spirometry."</font></td>";
echo "<td>&nbsp;<font size=2>".$orDr."</font></td>";
echo "<td>&nbsp;<font size=2>".number_format($total,2)."</font></td>";

if( $this->opdTransaction_balance($row['registrationNo']) > 0 ) {
echo "<td>&nbsp;<font size=2 color=red>".number_format($this->opdTransaction_balance($row['registrationNo']),2)."</font></td>";
}else {
echo "<td>&nbsp;<font size=2>".number_format($this->opdTransaction_balance($row['registrationNo']),2)."</font></td>";
}
echo "<td>&nbsp;<font size=2>".number_format($this->opdTransaction_cashPaid($row['registrationNo']),2)."</font></td>";
echo "<td>&nbsp;<font size=2>".number_format($this->opdTransaction_covered($row['registrationNo']),2)."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['Company']."</font></td>";
echo "</tr>";
}
if( $show == "yes" ) {
echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<font size=2><b>TOTAL</b></font></td>";
echo "<td>&nbsp;<font size=2>".$this->opdTransaction_pf."</font></td>";
echo "<td>&nbsp;<font size=2>".$this->opdTransaction_med."</font></td>";
echo "<td>&nbsp;<font size=2>".$this->opdTransaction_sup."</font></td>";
echo "<td>&nbsp;<font size=2>".$this->opdTransaction_lab."</font></td>";
echo "<td>&nbsp;<font size=2>".$this->opdTransaction_rad."</font></td>";
echo "<td>&nbsp;<font size=2>".$this->opdTransaction_xray."</font></td>";
echo "<td>&nbsp;<font size=2>".$this->opdTransaction_utz."</font></td>";
echo "<td>&nbsp;<font size=2>".$this->opdTransaction_ctscan."</font></td>";
echo "<td>&nbsp;<font size=2>".$this->opdTransaction_misc."</font></td>";
echo "<td>&nbsp;<font size=2>".$this->opdTransaction_ecg."</font></td>";
echo "<td>&nbsp;<font size=2>".$this->opdTransaction_pt."</font></td>";
echo "<td>&nbsp;<font size=2>".$this->opdTransaction_ot."</font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";
}else {
echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<font size=2><b>TOTAL</b></font></td>";
echo "<td>&nbsp;<font size=2></font></td>";
echo "<td>&nbsp;<font size=2></font></td>";
echo "<td>&nbsp;<font size=2></font></td>";
echo "<td>&nbsp;<font size=2></font></td>";
echo "<td>&nbsp;<font size=2></font></td>";
echo "<td>&nbsp;<font size=2></font></td>";
echo "<td>&nbsp;<font size=2></font></td>";
echo "<td>&nbsp;<font size=2></font></td>";
echo "<td>&nbsp;<font size=2></font></td>";
echo "<td>&nbsp;<font size=2></font></td>";
echo "<td>&nbsp;<font size=2></font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";
}

$this->coconutTableStop();
}

public $expenses_dashboard_total=0;

public function expenses_dashboard($date,$date1) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select controlNo,date,description,amount,payee from vouchers where (date between '$date' and '$date1') and type = 'pettyCash' order by date asc ") or die("Query fail: " . mysqli_error()); 

echo "<br><center><br><br><table width='80%' border=0>";
echo "<tr>";
echo "<th>Date</th>";
echo "<th>Description</th>";
echo "<th>Amount</th>";
echo "<th>Payee</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
{
$this->expenses_dashboard_total += $row['amount'];
echo "<tr>";
echo "<td>&nbsp;$row[date]</td>";
echo "<td>&nbsp;$row[description]</td>";
echo "<td align='center'>".number_format($row['amount'],2)."</td>";
echo "<td>&nbsp;$row[payee]</td>";
echo "</tr>";
}
echo "<tr>";
echo "<td>&nbsp;<font size=2 color=red><b>TOTAL</b></font></td>";
echo "<td align='center'>&nbsp;<font size=2 color=red><b>".number_format($this->expenses_dashboard_total,2)."</b></td>";
echo "<td>&nbsp;</td>";
echo "</tr>";
echo "</table>";
}





public function accumulateBalance($registrationNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select itemNo from patientCharges where registrationNo = '$registrationNo' and status in ('UNPAID','BALANCE')  ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
$this->editNow("patientCharges","itemNo",$row['itemNo'],"cashUnpaid","0");
}

}


public function paidInpatient_hb($registrationNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select sum(cashUnpaid) as pd from patientCharges where registrationNo = '$registrationNo' and title not in ('PROFESSIONAL FEE') and status in ('Discharged','UNPAID') ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['pd'];
}

}


public function paidInpatient_pf($registrationNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select chargesCode,description,cashUnpaid,total,phic,company from patientCharges where registrationNo = '$registrationNo' and title in ('PROFESSIONAL FEE') and status in ('UNPAID')  ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{


$pf = ($row['cashUnpaid'] * $this->selectNow("Doctors","sharez","doctorCode",$row['chargesCode']) );
$hospital = ( $row['cashUnpaid'] - $pf );

echo "<Tr width='20%'>";
echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;<font color=red>".$row['description']."</font></td>";
echo "<td>&nbsp;&nbsp;</td>";
/*
echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;".number_format($row['total'],2)."</td>";
echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;".number_format($row['company'],2)."</td>";
echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;".number_format($row['phic'],2)."</td>";
echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;".number_format($row['cashUnpaid'],2)."</td>";
echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;".number_format($hospital,2)."</td>";
echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;".number_format($pf,2)."</td>";
echo "</tr>";
*/
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total PF</td>";
echo "<td>&nbsp;".number_format($row['total'],2)."</td>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Company/HMO</td>";
echo "<td>&nbsp;".number_format($row['company'],2)."</td>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PhilHealth</td>";
echo "<td>&nbsp;".number_format($row['phic'],2)."</td>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cash</td>";
echo "<td>&nbsp;".number_format($row['cashUnpaid'],2)."</td>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hospital</td>";
echo "<td>&nbsp;".number_format($hospital,2)."</td>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Doctor</td>";
echo "<td>&nbsp;".number_format($pf,2)."</td>";
echo "</tr>";

}

}


public function paidInpatient($date,$date1,$username) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select pr.lastName,pr.firstName,rd.dateUnregistered,pp.amountPaid,rd.registrationNo,rd.discount from patientRecord pr,registrationDetails rd,patientPayment pp where pr.patientNo = rd.patientNo and rd.registrationNo = pp.registrationNo and (pp.datePaid between '$date' and '$date1') and rd.dateUnregistered != '' and rd.mgh != ''  ") or die("Query fail: " . mysqli_error()); 

echo "<Br><br><center>";
echo "<table border=0>";
echo "<tr>";
echo "<th>Patient</th>";
echo "<th>PF</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>&nbsp;<b><a href='/COCONUT/patientProfile/SOAoption/newSOA/detailedTotalOnly_update.php?registrationNo=$row[registrationNo]&username=$username&show=try&chargesCode=off&showdate=1' target='_blank' style='text-decoration:none;'>".$row['lastName'].", ".$row['firstName']."</a></b></td>";
$this->paidInpatient_pf($row['registrationNo']);
}
echo "</table>";
}

public function dailyCashiersReport_pd_ipd($registrationNo,$date,$shift,$username,$paidVia) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

if($shift == "all") {
$result = mysqli_query($connection, " select sum(amountPaid) as pd from patientPayment where registrationNo = '$registrationNo' and datePaid = '$date' and shift in ('1','2','3') and paidVia = '$paidVia' ") or die("Query fail: " . mysqli_error()); 
}else {
$result = mysqli_query($connection, " select sum(amountPaid) as pd from patientPayment where registrationNo = '$registrationNo' and datePaid = '$date' and shift = '$shift' and paidVia = '$paidVia' ") or die("Query fail: " . mysqli_error()); 
}

while($row = mysqli_fetch_array($result))
{
return $row['pd'];
}

}

public $dailyCashiersReport_ipd_total;

public function dailyCashiersReport_ipd_total() {
return $this->dailyCashiersReport_ipd_total;
}

public $dailyCashierReport_ipd_shift1_cash;
public $dailyCashierReport_ipd_shift2_cash;
public $dailyCashierReport_ipd_shift3_cash;
public $dailyCashierReport_ipd_shift1_creditCard;
public $dailyCashierReport_ipd_shift2_creditCard;
public $dailyCashierReport_ipd_shift3_creditCard;

public function dailyCashiersReport_ipd($shift,$date,$username) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

if($shift == "all") {
$result = mysqli_query($connection, " select shift,registrationNo,orNo,amountPaid,paidVia from patientPayment where datePaid = '$date' and shift in ('1','2','3') group by paidVia,registrationNo order by shift,orNo asc ") or die("Query fail: " . mysqli_error()); 
}else {
$result = mysqli_query($connection, " select registrationNo,orNo,amountPaid,paidVia from patientPayment where datePaid = '$date' and shift = '$shift' group by paidVia,registrationNo order by orNo asc ") or die("Query fail: " . mysqli_error()); 
}

while($row = mysqli_fetch_array($result))
{
$this->getPatientProfile($row['registrationNo']);

if($shift == "all") {
$this->dailyCashierReport_ipd_shift1_cash += $this->dailyCashiersReport_pd_ipd($row['registrationNo'],$date,"1",$username,"Cash");
$this->dailyCashierReport_ipd_shift2_cash += $this->dailyCashiersReport_pd_ipd($row['registrationNo'],$date,"2",$username,"Cash");
$this->dailyCashierReport_ipd_shift3_cash += $this->dailyCashiersReport_pd_ipd($row['registrationNo'],$date,"3",$username,"Cash");
$this->dailyCashierReport_ipd_shift1_creditCard += $this->dailyCashiersReport_pd_ipd($row['registrationNo'],$date,"1",$username,"Credit Card");
$this->dailyCashierReport_ipd_shift2_creditCard += $this->dailyCashiersReport_pd_ipd($row['registrationNo'],$date,"2",$username,"Credit Card");
$this->dailyCashierReport_ipd_shift3_creditCard += $this->dailyCashiersReport_pd_ipd($row['registrationNo'],$date,"3",$username,"Credit Card");

}else { }

$this->dailyCashiersReport_ipd_total += $this->dailyCashiersReport_pd_ipd($row['registrationNo'],$date,$shift,$username,$row['paidVia']);

echo "<tr>";
if($shift == "all") {
echo "<td>&nbsp;<font size=2>".$row['shift']."</font></td>";
}
echo "<td>&nbsp;<font size=2>".$date."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['paidVia']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['orNo']."</font></td>";
echo "<td>&nbsp;<font size=2>".$this->getPatientRecord_lastName().", ".$this->getPatientRecord_firstName()."</font></td>";
echo "<td>&nbsp;<font size=2>".number_format($this->dailyCashiersReport_pd_ipd($row['registrationNo'],$date,$shift,$username,$row['paidVia']),2)."</font></td>";
echo "<td>&nbsp;<font size=2>IPD</font></td>";
echo "</tr>";
}

}




public function dailyCashiersReport_pd_opd($registrationNo,$date,$shift,$username) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

if($shift == "all") {
$result = mysqli_query($connection, " select sum(cashPaid) as pd from patientCharges where registrationNo = '$registrationNo' and datePaid = '$date' and reportShift in ('1','2','3') and status in ('PAID','UNPAID') and orNO != '' ") or die("Query fail: " . mysqli_error()); 
}else {
$result = mysqli_query($connection, " select sum(cashPaid) as pd from patientCharges where registrationNo = '$registrationNo' and datePaid = '$date' and reportShift = '$shift' and status in ('PAID','UNPAID') and orNO != '' ") or die("Query fail: " . mysqli_error()); 
}

while($row = mysqli_fetch_array($result))
{
return $row['pd'];
}

}

public function dailyCashiersReport_pd_opd_creditCard($registrationNo,$date,$shift,$username) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

if($shift == "all") {
$result = mysqli_query($connection, " select sum(amountPaidFromCreditCard) as pd,sum(doctorsPF) as pdPF from patientCharges where registrationNo = '$registrationNo' and datePaid = '$date' and reportShift in ('1','2','3') and status = 'PAID' ") or die("Query fail: " . mysqli_error()); 
}else {
$result = mysqli_query($connection, " select sum(amountPaidFromCreditCard) as pd,sum(doctorsPF) as pdPF from patientCharges where registrationNo = '$registrationNo' and datePaid = '$date' and reportShift = '$shift' and status = 'PAID' ") or die("Query fail: " . mysqli_error()); 
}

while($row = mysqli_fetch_array($result))
{
return ($row['pd'] + $row['pdPF']);
}

}


public $dailyCashiersReport_opd_total;

public function dailyCashiersReport_opd_total() {
return $this->dailyCashiersReport_opd_total;
}

public $dailyCashiersReport_opd_shift1_cash;
public $dailyCashiersReport_opd_shift2_cash;
public $dailyCashiersReport_opd_shift3_cash;
public $dailyCashiersReport_opd_shift1_creditCard;
public $dailyCashiersReport_opd_shift2_creditCard;
public $dailyCashiersReport_opd_shift3_creditCard;
public function dailyCashiersReport_opd($shift,$date,$username) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

if($shift == "all") {
$result = mysqli_query($connection, " select reportShift,registrationNo,paidVia,orNO from patientCharges where datePaid = '$date' and reportShift in ('1','2','3') and status IN ('PAID','UNPAID') and orNO != '' group by paidVia,registrationNo order by reportShift asc") or die("Query fail: " . mysqli_error()); 
}else {
$result = mysqli_query($connection, " select registrationNo,paidVia,orNO from patientCharges where datePaid = '$date' and reportShift = '$shift' and status IN ('PAID','UNPAID') and orNO != '' group by paidVia,registrationNo order by orNO asc") or die("Query fail: " . mysqli_error()); 
}

while($row = mysqli_fetch_array($result))
{
$this->getPatientProfile($row['registrationNo']);
if( $row['paidVia'] == "Cash" ) { //CASH

if( $shift == "all" ) {
if($row['reportShift'] == "1") {
$this->dailyCashiersReport_opd_shift1_cash += $this->dailyCashiersReport_pd_opd($row['registrationNo'],$date,"1",$username);
}else if($row['reportShift'] == "2") {
$this->dailyCashiersReport_opd_shift2_cash += $this->dailyCashiersReport_pd_opd($row['registrationNo'],$date,"2",$username);
}else if($row['reportShift'] == "3") {
$this->dailyCashiersReport_opd_shift3_cash += $this->dailyCashiersReport_pd_opd($row['registrationNo'],$date,"3",$username);
}else { }
}else{ }

$this->dailyCashiersReport_opd_total += $this->dailyCashiersReport_pd_opd($row['registrationNo'],$date,$shift,$username);

}else { //CREDIT CARD

if( $shift == "all" ) {
if($row['reportShift'] == "1") {
$this->dailyCashiersReport_opd_shift1_creditCard += $this->dailyCashiersReport_pd_opd_creditCard($row['registrationNo'],$date,"1",$username);
}else if($row['reportShift'] == "2") {
$this->dailyCashiersReport_opd_shift2_creditCard += $this->dailyCashiersReport_pd_opd_creditCard($row['registrationNo'],$date,"2",$username);
}else if($row['reportShift'] == "3") {
$this->dailyCashiersReport_opd_shift3_creditCard += $this->dailyCashiersReport_pd_opd_creditCard($row['registrationNo'],$date,"3",$username);
}else { }
}else { }

$this->dailyCashiersReport_opd_total += $this->dailyCashiersReport_pd_opd_creditCard($row['registrationNo'],$date,$shift,$username);

}
echo "<tr>";

if($shift == "all") {
if($this->selectNow("registrationDetails","dateUnregistered","registrationNo",$row['registrationNo']) == "") {
echo "<td>&nbsp;<font size=2>".$row['reportShift']." - Not Discharged</font></td>";
}else {
echo "<td>&nbsp;<font size=2>".$row['reportShift']."</font></td>";
}

}else { }
echo "<td>&nbsp;<font size=2>".$date."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['paidVia']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['orNO']."</font></td>";
echo "<td>&nbsp;<font size=2>".$this->getPatientRecord_lastName().", ".$this->getPatientRecord_firstName()."</font></td>";
if( $row['paidVia'] == "Cash" ) {
echo "<td>&nbsp;<font size=2>".number_format($this->dailyCashiersReport_pd_opd($row['registrationNo'],$date,$shift,$username),2)."</font></td>";
}else {
echo "<td>&nbsp;<font size=2>".number_format($this->dailyCashiersReport_pd_opd_creditCard($row['registrationNo'],$date,$shift,$username),2)."</font></td>";
}
echo "<td>&nbsp;<font size=2>".$this->getRegistrationDetails_type()."</font></td>";
echo "</tr>";
}

}




public function updatePxNow($registrationNo,$date,$shift) {

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

mysql_query("UPDATE patientCharges SET reportDate = '$date',shift = '$shift'
WHERE registrationNo = '$registrationNo' ");

mysql_close($con);

}

public function updatePx($date) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select pr.lastName,pr.firstName,rd.registrationNo from patientRecord pr,registrationDetails rd where pr.patientNo = rd.patientNo and rd.dateRegistered = '$date' and rd.type = 'OPD' ") or die("Query fail: " . mysqli_error()); 

$this->coconutFormStart("get","/COCONUT/flow/updatePx1.php");
echo "Date";
$this->coconutTextBox("dateReport",date("Y-m-d"));

echo "Shift";
$this->coconutTextBox("shiftReport","1");
echo "<table border=1 cellspacing=0>";
echo "<Tr>";
echo "<th>&nbsp;</th>";
echo "<th>Patient</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td><input type='checkbox' name='registrationNo[]' value='$row[registrationNo]'></td>";
echo "<td>&nbsp;".$row['lastName'].", ".$row['firstName']."</td>";
echo "</tr>";
}
echo "</table>";
echo "<Br>";
$this->coconutButton("Proceed");
$this->coconutFormStop();
}


public function paymentForReport($registrationNo,$reportDate,$reportShift) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select paymentNo,amountPaid,datePaid,orNo from patientPayment where registrationNo = '$registrationNo' ") or die("Query fail: " . mysqli_error()); 


$this->coconutFormStart("get","/COCONUT/patientProfile/reporting3.php");
$this->coconutHidden("registrationNo",$registrationNo);
$this->coconutHidden("reportDate",$reportDate);
$this->coconutHidden("reportShift",$reportShift);
echo "<table border=1 cellspacing=0>";
echo "<Tr>";
echo "<th>&nbsp;</th>";
echo "<th>&nbsp;Paid</th>";
echo "<th>&nbsp;OR#</th>";
echo "<th>Date</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td><input type='checkbox' name='paymentNo[]' value='$row[paymentNo]' checked></td>";
echo "<td>&nbsp;".$row['amountPaid']."</td>";
echo "<td>&nbsp;".$row['orNo']."</td>";
echo "<td>&nbsp;".$row['datePaid']."</td>";
echo "</tr>";
}
echo "</table>";
echo "<Br>";
$this->coconutButton("Proceed");
$this->coconutFormStop();
}


public function chargesForReport($registrationNo,$reportDate,$reportShift) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select itemNo,description,title from patientCharges where status in ('PAID','BALANCE') and registrationNo = '$registrationNo' order by description,title asc ") or die("Query fail: " . mysqli_error()); 


$this->coconutFormStart("get","/COCONUT/patientProfile/reporting2.php");
$this->coconutHidden("registrationNo",$registrationNo);
$this->coconutHidden("reportDate",$reportDate);
$this->coconutHidden("reportShift",$reportShift);
echo "<table border=1 cellspacing=0>";
echo "<Tr>";
echo "<th>&nbsp;</th>";
echo "<th>&nbsp;Description</th>";
echo "<th>Category</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td><input type='checkbox' name='itemNo[]' value='$row[itemNo]' checked></td>";
echo "<td>&nbsp;".$row['description']."</td>";
echo "<td>&nbsp;".$row['title']."</td>";
echo "</tr>";
}
echo "</table>";
echo "<Br>";
$this->coconutButton("Proceed");
$this->coconutFormStop();
}



public function totalPaidForReporting($registrationNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select sum(cashPaid) as pd from patientCharges where registrationNo = '$registrationNo' and status = 'PAID' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['pd'];
}

}

public function totalPaidForReporting_creditCard($registrationNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select sum(amountPaidFromCreditCard) as pd from patientCharges where registrationNo = '$registrationNo' and status = 'PAID' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['pd'];
}

}




public function listCashier($date) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select paidBy from patientCharges where datePaid='$date' and status = 'PAID' group by paidBy ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
echo "<form>";

echo "</form>";
}

}





public function voidItemized_OPD($collectionNo,$itemNo,$username) {

/* make your connection */
$sql = new mysqli($this->host,$this->username,$this->password,$this->database);
 
/* we will just create an insert query here, and use it,
normally this would be done by form submission or other means */
$query = "INSERT INTO collectionReport_void(collectionNo,registrationNo,itemNo,shift,description,amountPaid,orNo,type,paidBy,timePaid,datePaid,paidVia,voidBy)
SELECT collectionNo,registrationNo,itemNo,shift,description,amountPaid,orNo,type,paidBy,timePaid,datePaid,paidVia,'$username' from collectionReport where itemNo = '$itemNo' and collectionNo = '$collectionNo' ";
 
if ( $sql->query($query) ) {
 //echo "A new entry has been added with the `id`";
} else {
    echo "There was a problem:<br />$query<br />{$sql->error}";
}
/* close our connection */
$sql->close();
}

public function editHistory_ipdPayments($paymentNo,$reportDate,$reportShift) {

/* make your connection */
$sql = new mysqli($this->host,$this->username,$this->password,$this->database);
 
/* we will just create an insert query here, and use it,
normally this would be done by form submission or other means */
$query = "INSERT INTO patientPayment_history
SELECT * from patientPayment where paymentNo = '$paymentNo'";
 
if ( $sql->query($query) ) {
 //echo "A new entry has been added with the `id`";
$this->editNow("patientPayment","paymentNo",$paymentNo,"reportDate",$reportDate);
$this->editNow("patientPayment","paymentNo",$paymentNo,"datePaid",$reportDate);
$this->editNow("patientPayment","paymentNo",$paymentNo,"shift",$reportShift);
} else {
echo "There was a problem:<br />$query<br />{$sql->error}";
}
 
/* close our connection */
$sql->close();
}




public function showAllAccountTitle_amountPerTitle($date1,$date2,$title,$type) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      



$result = mysqli_query($connection, " select sum(pc.total) as pd from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and (rd.dateUnregistered between '$date1' and '$date2') and pc.title='$title' and rd.type = '$type' and status in ('UNPAID','Discharged') ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['pd'];
}

}


public function showAllAccountTitle_debit($date1,$date2,$cols,$type,$title) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      



$result = mysqli_query($connection, " select sum(pc.".$cols.") as pdMethod from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and pc.cashPaid < 1 and pc.amountPaidFromCreditCard < 1 and pc.discount < 1 and rd.registrationNo = pc.registrationNo and (rd.dateUnregistered between '$date1' and '$date2') and rd.type = '$type' and pc.status not like 'DELETED%%%%%%' and pc.title ='$title' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['pdMethod'];
}

}


public function showAllAccountTitle_debit_paid($date1,$date2,$cols,$type,$title) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select sum(pc.".$cols.") as pdMethod from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and (pc.datePaid between '$date1' and '$date2') and rd.type = '$type' and pc.status not like 'DELETED%%%%%%' and pc.".$cols." > 1 and pc.title ='$title' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['pdMethod'];
}

}



public function showAllAccountTitle_debit_discount($date1,$date2,$type,$title) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select sum(pc.discount) as discount from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and (rd.dateUnregistered between '$date1' and '$date2') and rd.type = '$type' and pc.status not like 'DELETED%%%%%%' and pc.discount > 1 and pc.title ='$title' and cashPaid < 1 ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['discount'];
}

}


public $showAllAccountTitle_cash;
public $showAllAccountTitle_hmo;
public $showAllAccountTitle_phic;
public $showAllAccountTitle_total;

public function showAllAccountTitle_ipd_total() {
return $this->showAllAccountTitle_total;
}

public function showAllAccountTitle_ipd($date1,$date2) {


echo "<style>

tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }

</style>";



$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select title from patientCharges group by title order by title asc ") or die("Query fail: " . mysqli_error()); 

echo "<table border=0 width='50%'>";
echo "<Tr>";
echo "<th>Inpatient</th>";
echo "<th align='right'>PATIENT</th>";
echo "<th align='right'>HMO</th>";
echo "<th align='right'>PHILHEALTH</td>";
//echo "<th align='right'>COMPUTED</td>";
echo "<th align='right'>TOTAL</th>";
echo "</tr>";
echo "<tr>";

while($row = mysqli_fetch_array($result))
{

$this->showAllAccountTitle_cash += ($this->showAllAccountTitle_debit($date1,$date2,"cashUnpaid","IPD",$row['title']));
$this->showAllAccountTitle_hmo += ($this->showAllAccountTitle_debit($date1,$date2,"company","IPD",$row['title']));
$this->showAllAccountTitle_phic += ($this->showAllAccountTitle_debit($date1,$date2,"phic","IPD",$row['title']));
$this->showAllAccountTitle_total += ($this->showAllAccountTitle_amountPerTitle($date1,$date2,$row['title'],"IPD"));

echo "<tr>";
echo "<td><a href='/COCONUT/billing/patientAccount.php?date=$date1&date1=$date2&type=IPD&title=$row[title]' target='_blank' style='text-decoration:none;'>$row[title]</a></td>";
echo "<td align='right'>&nbsp;".number_format(round($this->showAllAccountTitle_debit($date1,$date2,"cashUnpaid","IPD",$row['title']),2),2)."</td>";
echo "<td align='right'>&nbsp;".number_format(round($this->showAllAccountTitle_debit($date1,$date2,"company","IPD",$row['title']),2),2)."</td>";
echo "<td align='right'>&nbsp;".number_format(round($this->showAllAccountTitle_debit($date1,$date2,"phic","IPD",$row['title']),2),2)."</td>";
echo "<td align='right'>&nbsp;".number_format(round($this->showAllAccountTitle_amountPerTitle($date1,$date2,$row['title'],"IPD"),2),2)."</td>";
/*
echo "<td align='right'>".round( $this->showAllAccountTitle_debit($date1,$date2,"cashUnpaid","IPD",$row['title']) + $this->showAllAccountTitle_debit($date1,$date2,"company","IPD",$row['title']) + $this->showAllAccountTitle_debit($date1,$date2,"phic","IPD",$row['title']) )."</td>";
*/
echo "</tr>";
}
echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td align='right'>&nbsp;<font color=black>".number_format(round($this->showAllAccountTitle_cash,2),2)."</font></td>";
echo "<td align='right'>&nbsp;<font color=black>".number_format(round($this->showAllAccountTitle_hmo,2),2)."</font></td>";
echo "<td align='right'>&nbsp;<font color=black>".number_format(round($this->showAllAccountTitle_phic,2),2)."</font></td>";
echo "<td align='right'>&nbsp;<font color=black>".number_format(round($this->showAllAccountTitle_total,2),2)."</font></td>";
echo "</tr>";
echo "</table>";


}


public $ipdPaymentsz_details_total;

public function ipdPaymentsz_details($date1,$date2,$paidVia,$payFor) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }
</style>";


$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select pr.lastName,pr.firstName,rd.registrationNo,pp.amountPaid from patientRecord pr,registrationDetails rd,patientPayment pp where pr.patientNo = rd.patientNo and rd.registrationNo = pp.registrationNo and (pp.datePaid between '$date1' and '$date2') and pp.paidVia = '$paidVia' and pp.paymentFor = '$payFor'  ") or die("Query fail: " . mysqli_error()); 


echo "<br><br><center>";
echo "<table border=1 cellspacing=0>";
echo "<tr>";
echo "<th>Name</th>";
echo "<th>$paidVia - $payFor</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
{
$this->ipdPaymentsz_details_total += $row['amountPaid'];
echo "<tr>";
echo "<td>&nbsp;".$row['lastName'].", ".$row['firstName']."&nbsp;</td>";
echo "<td>&nbsp;".$row['amountPaid']."&nbsp;</td>";
echo "</tr>";
}
echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;".$this->ipdPaymentsz_details_total."</td>";
echo "</tr>";
$this->coconutTableStop();

}


public function ipdPaymentsz_pdMethod($date,$date1,$paidVia,$payFor) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select sum(amountPaid) as pd from patientPayment where (datePaid between '$date' and '$date1') and paymentFor = '$payFor' and paidVia = '$paidVia' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['pd'];
}

}

public function ipdPaymentsz_discount($date,$date1) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select sum(discount) as disc from registrationDetails where (dateUnregistered between '$date' and '$date1')  and type='IPD' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['disc'];
}

}


public $ipdPaymentsz_discountPatient_total;
public function ipdPaymentsz_discountPatient($date,$date1) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select pr.lastName,pr.firstName,rd.discount from patientRecord pr,registrationDetails rd where pr.patientNo = rd.patientNo and rd.type ='IPD' and (rd.dateUnregistered between '$date' and '$date1') and rd.discount != '' ") or die("Query fail: " . mysqli_error()); 

echo "<table border=0 width='auto'>";
echo "<tr>";
echo "<th>Name</th>";
echo "<th>Discount</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
{
$this->ipdPaymentsz_discountPatient_total += $row['discount'];
echo "<tr>";
echo "<td>&nbsp;".$row['lastName'].", ".$row['firstName']."</td>";
echo "<td>&nbsp;".$row['discount']."</td>";
echo "</tr>";
}
echo "<Tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;".$this->ipdPaymentsz_discountPatient_total."</td>";
echo "</tr>";
echo "</table>";
}


public function ipdPaymentsz($date,$date1) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select paymentFor from patientPayment where (datePaid between '$date' and '$date1') group by paymentFor ") or die("Query fail: " . mysqli_error()); 

echo "<table border=0 width='40%'>";
echo "<tr>";
echo "<th>&nbsp;</th>";
echo "<th>CASH</th>";
echo "<th>CREDIT CARD</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>$row[paymentFor]</td>";
echo "<td align='right'><a href='/COCONUT/billing/transactionSummary_debitPx.php?paidVia=Cash&payFor=$row[paymentFor]&date=$date&date1=$date1' target='_blank' style='text-decoration:none; color:black;'>".number_format($this->ipdPaymentsz_pdMethod($date,$date1,"Cash",$row['paymentFor']),2)."</a></td>";
echo "<td align='right'><a href='/COCONUT/billing/transactionSummary_debitPx.php?paidVia=Credit Card&payFor=$row[paymentFor]&date=$date&date1=$date1' target='_blank' style='text-decoration:none; color:black;'>".number_format($this->ipdPaymentsz_pdMethod($date,$date1,"Credit Card",$row['paymentFor']),2)."</a></td>";
echo "</tr>";
}
echo "<tr>";
echo "<td>Discount</td>";
echo "<td align='right'><a href='/COCONUT/billing/pxDiscount.php?date=$date&date1=$date1' style='text-decoration:none;' target='_blank'>".round($this->ipdPaymentsz_discount($date,$date1))."</a></td>";
echo "</tr>";
echo "</table>";
}





public $_opd_discount;
public $showAllAccountTitle_opd_unpaid;
public $showAllAccountTitle_opd_hmo;
public $showAllAccountTitle_opd_phic;
public $showAllAccountTitle_opd_cash;
public $showAllAccountTitle_opd_creditCard;
public $showAllAccountTitle_opd_discount;
public $_opd_totalz;

public function _opd_totalz() {
return $this->_opd_totalz;
}

public function showAllAccountTitle_opd($date1,$date2) {


echo "<style>

tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }

</style>";



$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select title from patientCharges where title not in ('PROFESSIONAL FEE','OT','ST') group by title order by title asc ") or die("Query fail: " . mysqli_error()); 

echo "<table border=0 width='90%'>";
echo "<Tr>";
echo "<th>Outpatient</th>";
echo "<th align='right'>Discount</th>";
echo "<th align='right'>UNPAID</th>";
echo "<th align='right'>HMO</th>";
echo "<th align='right'>PHIC</td>";
echo "<th align='right'>CASH</td>";
echo "<th align='right'>Cr.CARD</td>";
echo "<th align='right'>TOTAL</th>";
echo "</tr>";
echo "<tr>";

while($row = mysqli_fetch_array($result))
{

$discountz = ( $this->showAllAccountTitle_debit_paid($date1,$date2,"discount","OPD",$row['title']) + $this->showAllAccountTitle_debit_discount($date1,$date2,"OPD",$row['title']) ); //discount from paid + discount from not paid
$disc = round($discountz,2);
$unpaid = round($this->showAllAccountTitle_debit($date1,$date2,"cashUnpaid","OPD",$row['title']),2);
$companyHMO = round($this->showAllAccountTitle_debit($date1,$date2,"company","OPD",$row['title']),2);
$phic = round($this->showAllAccountTitle_debit($date1,$date2,"phic","OPD",$row['title']),2);
$paid = round($this->showAllAccountTitle_debit_paid($date1,$date2,"cashPaid","OPD",$row['title']),2);
$cr = round($this->showAllAccountTitle_debit_paid($date1,$date2,"amountPaidFromCreditCard","OPD",$row['title']),2);
$totalIndividual = ($this->showAllAccountTitle_debit($date1,$date2,"total","OPD",$row['title']) + $this->showAllAccountTitle_debit_paid($date1,$date2,"cashPaid","OPD",$row['title']) + $this->showAllAccountTitle_debit_paid($date1,$date2,"amountPaidFromCreditCard","OPD",$row['title']) + $disc );
$totalIndividual1 = round($totalIndividual,2);

$this->_opd_discount += $disc;
$this->showAllAccountTitle_opd_unpaid += $unpaid;
$this->showAllAccountTitle_opd_hmo += $companyHMO;
$this->showAllAccountTitle_opd_phic += $phic;
$this->showAllAccountTitle_opd_cash += $paid;
$this->showAllAccountTitle_opd_creditCard += $cr;
$this->showAllAccountTitle_opd_discount += $disc;
$this->_opd_totalz += $totalIndividual1;

$_total = ( $this->_opd_discount + $this->showAllAccountTitle_opd_unpaid + $this->showAllAccountTitle_opd_hmo + $this->showAllAccountTitle_opd_phic + $this->showAllAccountTitle_opd_cash + $this->showAllAccountTitle_opd_creditCard  );
$manualTotal = ( $disc + $unpaid + $companyHMO + $phic + $paid + $cr );


echo "<Tr>";
if( $manualTotal != $totalIndividual1 ) {
echo "<td align='left'>&nbsp;<a href='/COCONUT/billing/patientAccount.php?date=$date1&date1=$date2&type=OPD&title=$row[title]' style='text-decoration:none; color:red;' target='_blank'>$row[title]</a></td>";
}else {
echo "<td align='left'>&nbsp;<a href='/COCONUT/billing/patientAccount.php?date=$date1&date1=$date2&type=OPD&title=$row[title]' style='text-decoration:none; color:black;' target='_blank'>$row[title]</a></td>";
}

echo "<td align='right'>&nbsp;".number_format($disc,2)."</td>";
echo "<td align='right'>&nbsp;".number_format($unpaid,2)."</td>";
echo "<td align='right'>&nbsp;".number_format($companyHMO,2)."</td>";
echo "<td align='right'>&nbsp;".number_format($phic,2)."</td>";
echo "<td align='right'>&nbsp;".number_format($paid,2)."</td>";
echo "<td align='right'>&nbsp;".number_format($cr,2)."</td>";
echo "<td align='right'>&nbsp;".number_format($totalIndividual1,2)."</td>";
echo "</tr>";
}
echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td align='right'>&nbsp;<font color=black>".number_format(round($this->_opd_discount,2),2)."</font></td>";
echo "<td align='right'>&nbsp;<font color=black>".number_format(round($this->showAllAccountTitle_opd_unpaid,2),2)."</font></td>";
echo "<td align='right'>&nbsp;<font color=black>".number_format(round($this->showAllAccountTitle_opd_hmo,2),2)."</font></td>";
echo "<td align='right'>&nbsp;<font color=black>".number_format(round($this->showAllAccountTitle_opd_phic,2),2)."</font></td>";
echo "<td align='right'>&nbsp;<font color=black>".number_format(round($this->showAllAccountTitle_opd_cash,2),2)."</font></td>";
echo "<td align='right'>&nbsp;<font color=black>".number_format(round($this->showAllAccountTitle_opd_creditCard,2),2)."</font></td>";
echo "<td align='right'>&nbsp;<font color=black>".number_format(round($this->_opd_totalz,2),2)."</font></td>";
echo "</tr>";
echo "</table>";


}



public $showPFaccounts_creditCard_totalCard;
public $showPFaccounts_creditCard_payables;

public function showPFaccounts_creditCard_totalCard() {
return $this->showPFaccounts_creditCard_totalCard;
}

public function showPFaccounts_creditCard_payables() {
return $this->showPFaccounts_creditCard_payables;
}

public function showPFaccounts_creditCard($date,$date1) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select sum(pc.amountPaidFromCreditCard) as totalCard,sum(pc.doctorsPF) as payables from registrationDetails rd,patientCharges pc where rd.registrationNo = pc.registrationNo and rd.type = 'OPD' and rd.dateUnregistered between '$date' and '$date1' and pc.paidVia = 'Credit Card' and pc.title = 'PROFESSIONAL FEE' and pc.status in ('PAID','UNPAID') ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
$this->showPFaccounts_creditCard_totalCard = $row['totalCard'];
$this->showPFaccounts_creditCard_payables = $row['payables'];
}

}


public $showPFaccounts_total;

public function showPFaccounts_total() {
return $this->showPFaccounts_total;
}

public function showPFaccounts($date,$date1) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select pc.itemNo,pc.registrationNo,sum(pc.discount) as disc,sum(pc.cashUnpaid) as unpaid,sum(pc.company) as hmo,sum(pc.phic) as phic,sum(pc.cashPaid) as cashPaid,sum(amountPaidFromCreditCard) as creditCard,sum(doctorsPF) as pf,sum(pc.total) as totalPF,sum(doctorsPF_payable) as payable from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and ((rd.dateUnregistered between '$date' and '$date1') or (pc.datePaid between '$date' and '$date1')) and pc.title = 'PROFESSIONAL FEE' and rd.type='OPD' and pc.status in ('PAID','UNPAID') ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
$this->showPFaccounts_creditCard($date,$date1);
$this->showPFaccounts_total = ($row['totalPF']);

echo "</tr>";
echo "<td><font size=2><a href='/COCONUT/Reports/doctorReport/transactionSummary_pf.php?date=$date&date1=$date1' style='text-decoration:none; color:black;' target='_blank'>Professional Fee</a></font></td>";
echo "<td align='right'>&nbsp;".number_format(round($row['disc'],2),2)."</td>";
echo "<td align='right'>&nbsp;".number_format(round($row['unpaid'],2),2)."</td>";
echo "<td align='right'>&nbsp;".number_format(round($row['hmo'],2),2)."</td>";
echo "<td align='right'>&nbsp;".number_format(round($row['phic'],2),2)."</td>";
echo "<td align='right'>&nbsp;".number_format(round($row['cashPaid'],2),2)."</td>";
echo "<td align='right'>&nbsp;".number_format(round($row['pf'],2),2)."</td>";
echo "<td align='right'>&nbsp;".number_format(round($row['creditCard'],2),2)."</td>";
echo "<td align='right'>&nbsp;".number_format(round($row['payable'],2),2)."</td>";

if( ($row['disc'] + $row['unpaid'] + $row['hmo'] + $row['phic'] + $row['cashPaid'] + $row['pf'] + $row['creditCard']) == $row['totalPF'] ) {
	echo "<td align='right'>&nbsp;".number_format(round($row['totalPF'],2),2)."</td>";
}else {
	echo "<td align='right'>&nbsp;<font color='red'>".number_format(round($row['totalPF'],2),2)."</font></td>";
}

echo "</tr>";
}

}


public function showTherapyAccounts_pfCash($date,$date1,$title) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, " select sum(otShare) as share from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and ((rd.dateUnregistered between '$date' and '$date1') or (pc.datePaid between '$date' and '$date1')) and pc.title = '$title' and rd.type='OPD' and pc.status in ('PAID','UNPAID') and pc.paidVia = 'Cash' ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
		($row['share'] > 0) ? $x = $row['share'] : $x = 0;
		return $x;
	}
}

public function showTherapyAccounts_pfCreditCard($date,$date1,$title) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, " select sum(otShare) as share from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and ((rd.dateUnregistered between '$date' and '$date1') or (pc.datePaid between '$date' and '$date1')) and pc.title = '$title' and rd.type='OPD' and pc.status in ('PAID','UNPAID') and pc.paidVia = 'Credit Card' ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
		($row['share'] > 0) ? $x = $row['share'] : $x = 0;
		return $x;
	}
}

private $showTherapyAccounts_total;

public function showTherapyAccounts_total() {
	return $this->showTherapyAccounts_total;
}

public function showTherapyAccounts($date,$date1,$title) {

	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


	$result = mysqli_query($connection, " select pc.status,pc.itemNo,pc.registrationNo,sum(pc.discount) as disc,sum(pc.cashUnpaid) as unpaid,sum(pc.company) as hmo,sum(pc.phic) as phic,sum(pc.cashPaid) as cashPaid,sum(amountPaidFromCreditCard) as creditCard,sum(otShare) as pf,sum(pc.total) as total from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and ((rd.dateUnregistered between '$date' and '$date1') or (pc.datePaid between '$date' and '$date1')) and pc.title = '$title' and rd.type='OPD' and pc.status in ('PAID','UNPAID') ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result))
	{
		echo "</tr>";
		echo "<td><font size=2><a href='/COCONUT/billing/patientAccount.php?date=$date&date1=$date1&type=OPD&title=$title' style='text-decoration:none; color:black;' target='_blank'>$title</a></font></td>";
		echo "<td align='right'>&nbsp;".number_format(round($row['disc'],2),2)."</td>";
		echo "<td align='right'>&nbsp;".number_format(round($row['unpaid'],2),2)."</td>";
		echo "<td align='right'>&nbsp;".number_format(round($row['hmo'],2),2)."</td>";
		echo "<td align='right'>&nbsp;".number_format(round($row['phic'],2),2)."</td>";

		if( $row['cashPaid'] > 0 ) {
			echo "<td align='right'>&nbsp;".number_format(round($row['cashPaid'],2),2)."</td>";
			echo "<td align='right'>&nbsp;".number_format(round($this->showTherapyAccounts_pfCash($date,$date1,$title),2),2)."</td>";
		}else {
			echo "<td>&nbsp;</td>";
			echo "<td>&nbsp;</td>";
		}

		if( $row['creditCard'] > 0 ) {
			echo "<td align='right'>&nbsp;".number_format(round($row['creditCard'],2),2)."</td>";
			echo "<td align='right'>&nbsp;".number_format(round(($this->showTherapyAccounts_pfCreditCard($date,$date1,$title)),2),2)."</td>";
		}else {
			echo "<td>&nbsp;</td>";
			echo "<td>&nbsp;</td>";
		}
		if( ($row['disc'] + $row['unpaid'] + $row['hmo'] + $row['phic'] + $row['cashPaid'] + $this->showTherapyAccounts_pfCash($date,$date1,$title) + $row['creditCard']) == $row['total'] ) {
			//ndi dpat ksma ung payables sa total
			echo "<td align='right'>&nbsp;".($row['total'] )."</td>";
		}else {
			//ndi dpat ksma ung payables sa total
			echo "<td align='right'>&nbsp;<font color=red>".($row['total'] )."</font></td>";
		}
		
		echo "</tr>";
		$this->showTherapyAccounts_total = $row['total'];
	}

}




public function testing2($registrationNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

echo "<style>

tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }

</style>";


$result = mysqli_query($connection, " select sum(total) as tot from patientCharges where registrationNo = '$registrationNo' and status not like 'DELETED%%%%%' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['tot'];
}

}

public function testing1($registrationNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

echo "<style>

tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }

</style>";


$result = mysqli_query($connection, " select sum(cashPaid) as pd from patientCharges where registrationNo = '$registrationNo' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['pd'];
}

}




public function removeComma($a) {

     if(is_numeric($a)) {

     $a = preg_replace('/[^0-9,]/','', $a);
     }

     return $a;

}



public function testing() {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

echo "<style>

tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }

</style>";


$result = mysqli_query($connection, " select pr.lastName,pr.firstName,x.DATE,rd.registrationNo,x.TOTAL from patientRecord pr,EXCEL x,registrationDetails rd where pr.manual_patientNo = x.PIN and x.PIN = rd.manual_patientNo and x.DATE = rd.dateRegistered and rd.dateRegistered like '2016-01-01' group by rd.registrationNo ") or die("Query fail: " . mysqli_error()); 
echo "<table border=1>";
echo "<tr>";
echo "<th>Reg#</th>";
echo "<th>Name</th>";
echo "<th>Date Reg</th>";
echo "<th>excel.TOTAL</th>";
echo "<th>system.TOTAL</th>";
echo "<th>Descrepancy</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
{
$descrepancy = ( $this->removeComma($row['TOTAL']) - $this->testing1($row['registrationNo']) );
echo "<tr>";
echo "<td>".$row['registrationNo']."</td>";
echo "<td>".$row['lastName'].", ".$row['firstName']."</td>";
echo "<td>".$row['DATE']."</td>";
echo "<td>".$this->removeComma($row['TOTAL'])."</td>";
echo "<td>".$this->testing1($row['registrationNo'])."</td>";
if( $descrepancy > 0 ) {
echo "<td>".$descrepancy."</td>";
}else { }
echo "</tr>";
}
echo "</table>";
}



public $patientAccount_cashUnpaid;
public $patientAccount_company;
public $patientAccount_phic;
public $patientAccount_total;

public function patientAccount($date,$date1,$type,$title) {


echo "<style>

tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select pr.lastName,pr.firstName,pc.description,pc.sellingPrice,pc.quantity,pc.total,pc.discount,pc.cashUnpaid,pc.company,pc.phic from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and rd.type='$type' and pc.title = '$title' and status not like 'DELETED%%%%%' and (rd.dateUnregistered between '$date' and '$date1') ") or die("Query fail: " . mysqli_error()); 

echo "<br><center>";
echo "<table border=0 width='auto'>";
echo "<tr>";
echo "<th>Patient</th>";
echo "<th>Particulars</th>";
echo "<th>Price</th>";
echo "<th>QTY</th>";
echo "<th>Patient</th>";
echo "<th>HMO</th>";
echo "<th>PHIC</th>";
echo "<th>Total</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
{
$this->patientAccount_cashUnpaid += $row['cashUnpaid'];
$this->patientAccount_company += $row['company'];
$this->patientAccount_phic += $row['phic'];
$this->patientAccount_total += $row['total'];
echo "<tr>";
echo "<td>&nbsp;".$row['lastName'].", ".$row['firstName']."</td>";
echo "<td>&nbsp;".$row['description']."</td>";
echo "<td>&nbsp;".$row['sellingPrice']."</td>";
echo "<td>&nbsp;".$row['quantity']."</td>";
echo "<td align='right'>&nbsp;".round($row['cashUnpaid'])."</td>";
echo "<td align='right'>&nbsp;".round($row['company'])."</td>";
echo "<td align='right'>&nbsp;".round($row['phic'])."</td>";
echo "<td align='right'>&nbsp;".round($row['total'])."</td>";
echo "</tr>";
}
echo "<TR>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td align='right'>&nbsp;".number_format($this->patientAccount_cashUnpaid,2)."</td>";
echo "<td align='right'>&nbsp;".number_format($this->patientAccount_company,2)."</td>";
echo "<td align='right'>&nbsp;".number_format($this->patientAccount_phic,2)."</td>";
echo "<td align='right'>&nbsp;".number_format($this->patientAccount_total,2)."</td>";
echo "</tr>";
echo "</table>";
}




public $patientAccountOPD_discount;
public $patientAccountOPD_unpaid;
public $patientAccountOPD_hmo;
public $patientAccountOPD_phic;
public $patientAccountOPD_cashpaid;
public $patientAccountOPD_creditCard;
public $patientAccountOPD_total;

public function patientAccountOPD_notPaid($date,$date1,$title) {

echo "<style>

tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select pr.lastName,pr.firstName,rd.registrationNo,pc.description,pc.discount,pc.cashUnpaid,pc.company,pc.phic,pc.cashPaid,pc.amountPaidFromCreditCard,pc.total,rd.dateUnregistered,pc.datePaid,pc.otShare from patientRecord pr,registrationDetails rd,patientCharges pc where pc.cashPaid < 1 and pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and (rd.dateUnregistered between '$date' and '$date1') and rd.type='OPD' and pc.title = '$title' and pc.status not like 'DELETED%%%%%' ") or die("Query fail: " . mysqli_error()); 


while($row = mysqli_fetch_array($result))
{

$this->patientAccountOPD_discount += $row['discount'];
$this->patientAccountOPD_unpaid += $row['cashUnpaid'];
$this->patientAccountOPD_hmo += $row['company'];
$this->patientAccountOPD_phic += $row['phic'];
$this->patientAccountOPD_cashpaid += $row['cashPaid'];
$this->patientAccountOPD_creditCard += $row['amountPaidFromCreditCard'];
$this->patientAccountOPD_total += $row['total'];

if($row['title'] == "OT") {
		$manualTotal = ( $row['discount'] + $row['cashUnpaid'] + $row['company'] + $row['phic'] + $row['cashPaid'] + $row['amountPaidFromCreditCard'] + $row['otShare'] );
}else if($row['title'] == "ST") {
		$manualTotal = ( $row['discount'] + $row['cashUnpaid'] + $row['company'] + $row['phic'] + $row['cashPaid'] + $row['amountPaidFromCreditCard'] + $row['otShare'] );
}else {
	$manualTotal = ( $row['discount'] + $row['cashUnpaid'] + $row['company'] + $row['phic'] + $row['cashPaid'] + $row['amountPaidFromCreditCard'] );
}

echo "<tr>";
	echo "<td>&nbsp;".$row['lastName'].", ".$row['firstName']."</td>";
	echo "<td>&nbsp;".$row['description']."</td>";
	echo "<td align='right'>&nbsp;".($row['discount'])."</td>";
	echo "<td align='right'>&nbsp;".($row['cashUnpaid'])."</td>";
	echo "<td align='right'>&nbsp;".($row['company'])."</td>";
	echo "<td align='right'>&nbsp;".($row['phic'])."</td>";
	echo "<td align='right'>&nbsp;".($row['cashPaid'])."</td>";
	echo "<td align='right'>&nbsp;".($row['amountPaidFromCreditCard'])."</td>";
	if($manualTotal != $row['total']) {
		echo "<td align='right'>&nbsp;".$row['registrationNo']."-<font color=red>".($row['total'])."</font></td>";
	}else {
		echo "<td align='right'>&nbsp;".($row['total'])."</td>";
	}
	if($title == "OT") {
		echo "<td align='right'>&nbsp;".($row['total'] - $row['otShare'])."</td>";
		echo "<td align='right'>&nbsp;".$row['otShare']."</td>";
	}else {	
		/*hide*/
	}	
echo "</tr>";
}

}


public function patientAccountOPD_paid($date,$date1,$title) {

echo "<style>

tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select pr.lastName,pr.firstName,rd.registrationNo,pc.description,pc.discount,pc.cashUnpaid,pc.company,pc.phic,pc.cashPaid,pc.amountPaidFromCreditCard,pc.total,rd.dateUnregistered,pc.datePaid,pc.sellingPrice,pc.quantity,pc.otShare,pc.title from patientRecord pr,registrationDetails rd,patientCharges pc where pc.cashPaid > 1 and pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and (pc.datePaid between '$date' and '$date1') and rd.type='OPD' and pc.title = '$title' and pc.status not like 'DELETED%%%%%%' ") or die("Query fail: " . mysqli_error()); 


while($row = mysqli_fetch_array($result))
{

$this->patientAccountOPD_discount += $row['discount'];
$this->patientAccountOPD_unpaid += $row['cashUnpaid'];
$this->patientAccountOPD_hmo += $row['company'];
$this->patientAccountOPD_phic += $row['phic'];
$this->patientAccountOPD_cashpaid += $row['cashPaid'];
$this->patientAccountOPD_creditCard += $row['amountPaidFromCreditCard'];
$this->patientAccountOPD_total += $row['total'];

if($row['title'] == "OT") {
		$manualTotal = ( $row['discount'] + $row['cashUnpaid'] + $row['company'] + $row['phic'] + $row['cashPaid'] + $row['amountPaidFromCreditCard'] + $row['otShare'] );
}else if($row['title'] == "ST") {
		$manualTotal = ( $row['discount'] + $row['cashUnpaid'] + $row['company'] + $row['phic'] + $row['cashPaid'] + $row['amountPaidFromCreditCard'] + $row['otShare'] );
}else {
	$manualTotal = ( $row['discount'] + $row['cashUnpaid'] + $row['company'] + $row['phic'] + $row['cashPaid'] + $row['amountPaidFromCreditCard'] );
}

	echo "<tr>";
		echo "<td>&nbsp;".$row['lastName'].", ".$row['firstName']."</td>";
		echo "<td>&nbsp;".$row['description']."</td>";
		echo "<td align='right'>&nbsp;".($row['discount'])."</td>";
		echo "<td align='right'>&nbsp;".($row['cashUnpaid'])."</td>";
		echo "<td align='right'>&nbsp;".($row['company'])."</td>";
		echo "<td align='right'>&nbsp;".($row['phic'])."</td>";
		echo "<td align='right'>&nbsp;".($row['cashPaid'])."</td>";
		echo "<td align='right'>&nbsp;".($row['amountPaidFromCreditCard'])."</td>";
		if($manualTotal != ($row['sellingPrice'] * $row['quantity'])) {
			echo "<td align='right'>&nbsp;".$row['registrationNo']."-<font color=red>".($row['sellingPrice'] * $row['quantity'])."</font></td>";
		}else {
			echo "<td align='right'>&nbsp;".($row['sellingPrice'] * $row['quantity'])."</td>";
		}

		if($title == "OT") {
			echo "<td align='right'>&nbsp;".($row['total'] - $row['otShare'])."</td>";
			echo "<td align='right'>&nbsp;".$row['otShare']."</td>";
		}else {	
			/*hide*/
		}

	echo "</tr>";
}

}




public $patientAccountOPD_pf_discount;
public $patientAccountOPD_pf_unpaid;
public $patientAccountOPD_pf_hmo;
public $patientAccountOPD_pf_phic;
public $patientAccountOPD_pf_hospital;
public $patientAccountOPD_pf_doctor;
public $patientAccountOPD_pf_creditCard;
public $patientAccountOPD_pf_payables;
public $patientAccountOPD_pf_total;

public function patientAccountOPD_pf($date,$date1) {


echo "<style>

tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }

</style>";


$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select pr.lastName,pr.firstName,rd.registrationNo,rd.dateUnregistered,pc.status,pc.description,pc.discount,pc.company,pc.phic,pc.cashUnpaid,pc.doctorsPF,pc.cashPaid,pc.amountPaidFromCreditCard,pc.total,pc.datePaid,pc.paidVia,pc.reportShift,pc.orNO,pc.doctorsPF_payable from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and ((rd.dateUnregistered between '$date' and '$date1') or (pc.datePaid between '$date' and '$date1')) and rd.type = 'OPD' and pc.status in ('UNPAID','PAID') and pc.title = 'PROFESSIONAL FEE' ") or die("Query fail: " . mysqli_error()); 

echo "<table border=1 width='90%' cellspacing=0>";
echo "<tr>";
echo "<th>Date Pd</th>";
echo "<th>PATIENT</th>";
echo "<th>Doctor</th>";
echo "<th>Disc</th>";
echo "<th>Bal</th>";
echo "<th>HMO</th>";
echo "<th>PHIC</th>";
echo "<th>Cash</th>";
echo "<th>Cr.Card</th>";
echo "<th>TOTAL</th>";
echo "<th style='border:0px;'>&nbsp;</th>";
echo "<Th>Hospital</th>";
echo "<th>Doctor</th>";
echo "<th>Payables</td>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
{
$this->patientAccountOPD_pf_unpaid += $row['cashUnpaid'];
$this->patientAccountOPD_pf_discount += $row['discount'];
$this->patientAccountOPD_pf_hmo += $row['company'];
$this->patientAccountOPD_pf_phic += $row['phic'];
$this->patientAccountOPD_pf_hospital += $row['cashPaid'];
$this->patientAccountOPD_pf_doctor += $row['doctorsPF'];
$this->patientAccountOPD_pf_creditCard += $row['amountPaidFromCreditCard'];
$this->patientAccountOPD_pf_payables += $row['doctorsPF_payable'];
$this->patientAccountOPD_pf_total += $row['total'];


echo "<tr>";
if( $row['cashPaid'] > 0 || $row['amountPaidFromCreditCard'] > 0 ) {
echo "<td>&nbsp;<font size=2>".$row['datePaid']." (".$row['reportShift'].")</font></td>";
}else {
echo "<td>&nbsp;</td>";
}

if($row['cashPaid'] > 0) {
if($row['orNO'] == "") {
echo "<td>&nbsp;<font size=2 color=red>".$row['lastName'].", ".$row['firstName']."</font></td>";
}else if($row['datePaid'] != $row['dateUnregistered']) {
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Reports/doctorReport/fixPF.php?date=$date&date1=$date1&registrationNo=$row[registrationNo]&datePaid=$row[datePaid]' style='text-decoration:none;'><font size=2 color=red>".$row['lastName'].", ".$row['firstName']."</font></a>
<br>
<font size=2 color=red>Date Pd:&nbsp;".$row['datePaid']."</font>
<br>
<font size=2 color=red>Discharged:&nbsp;".$row['dateUnregistered']."</font>
</td>";
}else {
echo "<td>&nbsp;<font size=2>".$row['lastName'].", ".$row['firstName']."</font></td>";
}
}else {
echo "<td>&nbsp;<font size=2>".$row['lastName'].", ".$row['firstName']."</font></td>";
}
echo "<td>&nbsp;<font size=2>".$row['description']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['discount']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['cashUnpaid']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['company']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['phic']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['cashPaid']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['amountPaidFromCreditCard']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['total']."</font></td>";
echo "<td style='border:0px; width:3%;'>&nbsp;</td>";
echo "<td>&nbsp;<font size=2>".($row['cashPaid'] + $row['amountPaidFromCreditCard'])."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['doctorsPF']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['doctorsPF_payable']."</font></td>";
echo "</tr>";
}

echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>".$this->patientAccountOPD_pf_discount."</td>";
echo "<td>".$this->patientAccountOPD_pf_unpaid."</td>";
echo "<td>".$this->patientAccountOPD_pf_hmo."</td>";
echo "<td>".$this->patientAccountOPD_pf_phic."</td>";
echo "<td>".$this->patientAccountOPD_pf_hospital."</td>";
echo "<td>".$this->patientAccountOPD_pf_creditCard."</td>";
echo "<td>".$this->patientAccountOPD_pf_total."</td>";
echo "<td style='border:0px;'>&nbsp;</td>";
echo "<td>&nbsp;".($this->patientAccountOPD_pf_hospital + $this->patientAccountOPD_pf_creditCard)."</td>";
echo "<td>&nbsp;".($this->patientAccountOPD_pf_doctor)."</td>";
echo "<td>&nbsp;".($this->patientAccountOPD_pf_payables)."</td>";
echo "</tr>";


echo "</table>";
}






public function inventoryAdjustment($inventoryCode,$stockCardNo,$accountTitle,$valuez,$debit,$credit,$date) {

/* make your connection */
$sql = new mysqli($this->host,$this->username,$this->password,$this->database);
 
/* we will just create an insert query here, and use it,
normally this would be done by form submission or other means */
$query = "insert into inventoryAdjustment(inventoryCode,stockCardNo,accountTitle,valuez,debit,credit,date) values('$inventoryCode','$stockCardNo','$accountTitle','$valuez','$debit','$credit','$date')";
 
if ( $sql->query($query) ) {
   //echo "A new entry has been added with the `id`";
} else {
    echo "There was a problem:<br />$query<br />{$sql->error}";
}
 
/* close our connection */
$sql->close();
}



public function inventoryAdjustmentReport_itemized($inventoryCode) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }

tr.border_bottom td {
  border-bottom:1pt solid #CCCCCC;
}

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select accountTitle,debit,credit from inventoryAdjustment where inventoryCode = '$inventoryCode'  ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>".$row['accountTitle']."</td>";
echo "<td>&nbsp;</td>";
echo "<td>".$row['debit']."</td>";
echo "<td>".$row['credit']."</td>";
echo "</tr>";
}

}

public function inventoryAdjustmentReport($date,$date1) {

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

tr.border_top td {
  border-top:1pt solid #CCCCCC;
}

tr.table_header th {
  border-bottom:1pt solid black;
}

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select inventoryCode,date from inventoryAdjustment where (date between '$date' and '$date1') group by inventoryCode  ") or die("Query fail: " . mysqli_error()); 

echo "<table border=0 width='70%'>";
echo "<tr class='table_header'>";
echo "<th>Account</th>";
echo "<th>Date</th>";
echo "<th>Debit</th>";
echo "<th>Credit</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
{
echo "<tr class='border_top'>";
echo "<td>&nbsp;<b>".$this->selectNow("inventory","description","inventoryCode",$row['inventoryCode'])."</b></td>";
echo "<td>&nbsp;$row[date]</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

$this->inventoryAdjustmentReport_itemized($row['inventoryCode']);

}
echo "</table>";

}



public function purchaseJournal_items($invoiceNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select description,quantity from inventory where invoiceNo = '$invoiceNo' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td style='border:0px;'>&nbsp;".$row['description']."</td>";
echo "</tr>";
}

}



public function purchaseJournal_acctTitle($invoiceNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select accountTitle,debit,credit from purchaseJournal where invoiceNo = '$invoiceNo' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>&nbsp;".$row['accountTitle']."</td>";
echo "<td>&nbsp;".number_format(round($row['debit'],2),2)."</td>";
echo "<td>&nbsp;".number_format(round($row['credit'],2),2)."</td>";
echo "</tr>";
}

}


public function voucher_items($invoiceNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select description,unitcost,inventoryType,suppliesUNITCOST,quantity from inventory where invoiceNo = '$invoiceNo' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>&nbsp;".$row['description']."</td>";

if( $row['inventoryType'] == "medicine" ) {
echo "<td align='center'>&nbsp;".($row['unitcost'] * $row['quantity'])."</td>";
}else {
echo "<td align='center'>&nbsp;".($row['suppliesUNITCOST'] * $row['quantity'])."</td>";
}

echo "</tr>";
}

}



public function tAccount_journal($invoiceNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select accountTitle,debit,credit from purchaseJournal where invoiceNo = '$invoiceNo' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>&nbsp;".$row['accountTitle']."</td>";
echo "<td>&nbsp;".$row['debit']."</td>";
echo "<td>&nbsp;".$row['credit']."</td>";
echo "</tr>";
}

}



public function purchasingPayablesTotal($siNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select sum(unitPrice*(quantity)) as total from salesInvoiceItems where siNo = '$siNo' and status = 'Active' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['total'];
}

}



public function purchasingPayablesPayment($invoiceNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " SELECT SUM(amount+vat+wtax) AS pd FROM vouchers WHERE invoiceNo='$invoiceNo'  ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['pd'];
}

}


public function purchasingPayables($supplierCode,$username) {


echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }

tr.border_bottom td {
  border-bottom:1pt solid #CCCCCC;
}

</style>";



$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select siNo,invoiceNo,recievedDate,terms from salesInvoice where supplier = '$supplierCode' and status = 'Active'") or die("Query fail: " . mysqli_error()); 

echo "<form method='get' action='/COCONUT/accounting/voucher/addVoucher_purchasing.php'>";
$this->coconutHidden("username",$username);
echo "<br><br><center><table border=1 cellspacing=0>";
echo "<Tr>";
echo "<th>&nbsp;Invoice#</th>";
echo "<th>&nbsp;Received</th>";
echo "<th>&nbsp;Terms</th>";
echo "<th>&nbsp;Total</th>";
echo "<th>&nbsp;</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
{
$totalAmt = $this->purchasingPayablesTotal($row['siNo']);
$this->coconutHidden("invoiceNo",$row['invoiceNo']);
$paid = ( $totalAmt - $this->purchasingPayablesPayment($row['invoiceNo']) );

if( $paid > 0.01 ) {

echo "<tr>";
echo "<td>&nbsp;".$row['invoiceNo']."</td>";
echo "<td>&nbsp;".$row['recievedDate']."</td>";
echo "<td>&nbsp;".$row['terms']."</td>";
echo "<td>&nbsp;".number_format($totalAmt,2)."</td>";
echo "<td>&nbsp;<input type='checkbox' name='siNo[]' value='$row[siNo]'></td>";
echo "</tr>";
}else { /**/ }
}
echo "</table>";
echo "<Br>";
$this->coconutButton("Proceed");
echo "</form>";

}



public function doctorSelection() {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " SELECT doctorCode,Name from Doctors order by Name asc") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
echo "<option value='".$row['doctorCode']."'>".$row['Name']."</option>";
}

}


public $doctorPatient_pf;
public $doctorPatient_hmo;
public $doctorPatient_hospital;
public $doctorPatient_doctor;
public $doctorPatient_patient=0;

public function doctorPatient($docName,$date,$date1,$type) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }

tr.border_bottom td {
  border-bottom:1pt solid #CCCCCC;
}

</style>";


$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select pr.lastName,pr.firstName,rd.registrationNo,rd.dateUnregistered,pc.total,pc.company,pc.cashUnpaid,pc.cashPaid,pc.doctorsPF from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and pc.description = '$docName' and (rd.dateUnregistered between '$date' and '$date1') and rd.type = '$type' and pc.title='PROFESSIONAL FEE' and pc.status in ('PAID','UNPAID') order by rd.dateUnregistered,pc.description asc  ") or die("Query fail: " . mysqli_error()); 


echo "<table border=1 cellspacing=0>";
echo "<tr>";
echo "<th>Date</th>";
echo "<th>Patient</th>";
echo "<th>PF</th>";
echo "<th>HMO</th>";
echo "<th>HOSPITAL</th>";
echo "<th>DOCTOR</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
{

$this->doctorPatient_pf += $row['total'];
$this->doctorPatient_hmo += $row['company'];
$this->doctorPatient_hospital += $row['cashPaid'];
$this->doctorPatient_doctor += $row['doctorsPF'];
$this->doctorPatient_patient++;

echo "<tr>";
echo "<td>&nbsp;".$row['dateUnregistered']."</td>";
echo "<td>&nbsp;".strtoupper($row['lastName']).", ".strtoupper($row['firstName'])."</td>";
echo "<td>&nbsp;".$row['total']."</td>";
echo "<td>&nbsp;".$row['company']."</td>";
echo "<td>&nbsp;".($row['cashPaid'])."</td>";
echo "<td>&nbsp;".$row['doctorsPF']."</td>";
echo "</tr>";
}
echo "<tr>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;Total Patient:&nbsp;".$this->doctorPatient_patient."</td>";
echo "<Td>&nbsp;".number_format($this->doctorPatient_pf,2)."</td>";
echo "<Td>&nbsp;".number_format($this->doctorPatient_hmo,2)."</td>";
echo "<Td>&nbsp;".number_format($this->doctorPatient_hospital,2)."</td>";
echo "<Td>&nbsp;".number_format($this->doctorPatient_doctor,2)."</td>";
echo "</tr>";
echo "</table>";
}




public function inventoryListToExcel($type) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " SELECT description,genericName,quantity from inventory where status not like 'DELETED%%%%%' and quantity > 0 and inventoryType = '$type' order by genericName asc ") or die("Query fail: " . mysqli_error()); 

echo "<table border=1 cellspacing=0 cellpadding=1 id='ReportTable'>";
echo "<tr>";
echo "<th>Generic</th>";
echo "<th>Brand Name</th>";
echo "<th>QTY (system)</th>";
echo "<th>QTY (on hand)</th>";
echo "<th>Variance</th>";
echo "<th>Adjusted QTY</th>";
echo "<th>Unitcost</th>";
echo "<th>Total Cost</th>";
echo "</tr>";

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>&nbsp;".$row['genericName']."</td>";
echo "<td>&nbsp;".$row['description']."</td>";
echo "<td>&nbsp;".$row['quantity']."</td>";
echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
echo "<td></td>";
echo "</tr>";
}
echo "</table>";
}



public function salesCost($maxMin,$stockCardNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " SELECT ".$maxMin."(unitcost) as unitcost from inventory where stockCardNo = '$stockCardNo' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['unitcost'];
}

}


public function countDispense($stockCardNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " SELECT sum(quantity) as qty from patientCharges where stockCardNo = '$stockCardNo' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['qty'];
}

}


public function wrongDischarge($date,$date1) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " SELECT pr.lastName,pr.firstName,rd.registrationNo,rd.dateRegistered,rd.dateUnregistered,rd.type,rd.Company from patientRecord pr,registrationDetails rd where pr.patientNo = rd.patientNo and rd.dateRegistered like '$date%%%%%' and rd.dateUnregistered like '$date1%%%%%%%'  ") or die("Query fail: " . mysqli_error()); 

echo "<table border=1 cellspacing=0>";
echo "<tr>";
echo "<th>Reg#</th>";
echo "<th>Patient</th>";
echo "<th>In</th>";
echo "<th>Out</th>";
echo "<th>Type</th>";
echo "<th>HMO</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>&nbsp;".$row['registrationNo']."</td>";
echo "<td>&nbsp;".$row['lastName'].", ".$row['firstName']."</td>";
echo "<td>&nbsp;".$row['dateRegistered']."</td>";
echo "<td>&nbsp;".$row['dateUnregistered']."</td>";
echo "<td>&nbsp;".$row['type']."</td>";
echo "<td>&nbsp;".$row['Company']."</td>";
echo "</tr>";
}
echo "</table>";
}



public function getDermaPx($date,$date1) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select pr.lastName,pr.firstName,rd.registrationNo,rd.dateRegistered from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and (rd.dateRegistered between '$date' and '$date1') and rd.type = 'OPD' and pc.description like 'Icasiano%%%%%' ") or die("Query fail: " . mysqli_error()); 

echo "<form method='get' action='/COCONUT/Reports/dermaPx1.php'>";
echo "<table border=1 cellspacing=0>";
echo "<tr>";
echo "<th>&nbsp;</th>";
echo "<th>Patient</th>";
echo "<th>Date</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
{
echo "<Tr>";
echo "<td>&nbsp;<input type='checkbox' name='registrationNo[]' value='$row[registrationNo]' checked></td>";
echo "<td>&nbsp;".$row['lastName'].", ".$row['firstName']."</td>";
echo "<td>&nbsp;".$row['dateRegistered']."</td>";
echo "</tr>";
}
echo "</table>";
echo "<br>";
echo "<input type='submit' value='Proceed'>";
echo "</form>";
}

public function updateDermaPx($registrationNo) {

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

mysql_query("UPDATE patientCharges SET title = 'DERMA' where registrationNo = '$registrationNo' and description not like 'medical cer%%%%%%%%' ");

mysql_close($con);

}




public function getDateOfLastPayment($registrationNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " SELECT datePaid from patientPayment where registrationNo = '$registrationNo' order by datePaid desc limit 1 ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['datePaid'];
}

}


public function ipdChecker($dateReg,$dateUnreg) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }

tr.border_bottom td {
  border-bottom:1pt solid #CCCCCC;
}

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select pr.lastName,pr.firstName,rd.registrationNo,rd.dateRegistered,rd.dateUnregistered from patientRecord pr,registrationDetails rd where pr.patientNo = rd.patientNo and rd.type = 'IPD' and rd.dateRegistered like '$dateReg%%%%%' and rd.dateUnregistered like '$dateUnreg%%%%%'  ") or die("Query fail: " . mysqli_error()); 

echo "<form method='get' action='/COCONUT/Reports/ipdChecker1.php'>";
echo "<table border=1 cellspacing=0>";
echo "<tr>";
echo "<th>&nbsp;</th>";
echo "<th>Patient</th>";
echo "<th>Date Pd</th>";
echo "<th>In</th>";
echo "<th>Out</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>&nbsp;<input type='checkbox' name='registrationNo[]' value='$row[registrationNo]' checked></td>";
echo "<td>&nbsp;".$row['lastName'].", ".$row['firstName']."</td>";
echo "<td>&nbsp;".$this->getDateOfLastPayment($row['registrationNo'])."</td>";
echo "<td>&nbsp;".$row['dateRegistered']."</td>";
echo "<td>&nbsp;".$row['dateUnregistered']."</td>";
echo "</tr>";
}
echo "</table>";
echo "<input type='submit' value='Proceed'>";
echo "</form>";
}




/***********STOCK CARD MERGER*********************/

public function stockCardMerge_inventory($stockCardNo) {


$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, "select count(inventoryCode) as total from inventory where stockCardNo = '$stockCardNo'") or die("Query fail: " . mysqli_error()); 


while($row = mysqli_fetch_array($result))
{
return $row['total'];
}

}

public function stockCardMerge_patientCharges($stockCardNo) {


$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, "select count(itemNo) as total from patientCharges where stockCardNo = '$stockCardNo'") or die("Query fail: " . mysqli_error()); 


while($row = mysqli_fetch_array($result))
{
return $row['total'];
}

}

public function stockCardMerge($startLetter) {


$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, "select stockCardNo,description,genericName from inventoryStockCard where inventoryType = 'medicine' and status not like 'DELETED%' and genericName like '$startLetter%%%%%%%%' order by genericName asc") or die("Query fail: " . mysqli_error()); 


while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td><input type='checkbox' name='stockCardNo[]' value='$row[stockCardNo]'></td>";
if( $this->stockCardMerge_inventory($row['stockCardNo']) == 0 && $this->stockCardMerge_patientCharges($row['stockCardNo']) == 0 ) {
echo "<td><font color=red>".$row['stockCardNo']."</font></td>";
}else {
echo "<td>".$row['stockCardNo']."</td>";
}
echo "<td>".$row['description']."</td>";
echo "<td>".$row['genericName']."</td>";
echo "<td>".$this->stockCardMerge_inventory($row['stockCardNo'])."</td>";
echo "<td>".$this->stockCardMerge_patientCharges($row['stockCardNo'])."</td>";
echo "<td><a href='/COCONUT/inventory/stockCard/deleteStockCard.php?stockCardNo=$row[stockCardNo]&startLetter=$startLetter'>DEL</td>";
echo "<td><a href='/COCONUT/inventory/stockCard/rename.php?stockCardNo=$row[stockCardNo]&startLetter=$startLetter'>RENAME</td>";
echo "</tr>";
}

}


/***********STOCK CARD MERGER*********************/



public function editedAmount($itemNo,$registrationNo,$sellingPrice,$quantity,$discount,$total,$cashUnpaid,$company,$phic,$time,$date,$username) {

/* make your connection */
$sql = new mysqli($this->host,$this->username,$this->password,$this->database);
 
/* we will just create an insert query here, and use it,
normally this would be done by form submission or other means */
$query = "insert into editedAmount(itemNo,registrationNo,sellingPrice,quantity,discount,total,cashUnpaid,company,phic,time,date,username) values('$itemNo','$registrationNo','$sellingPrice','$quantity','$discount','$total','$cashUnpaid','$company','$phic','$time','$date','$username')";
 
if ( $sql->query($query) ) {
   //echo "A new entry has been added with the `id`";
} else {
    echo "There was a problem:<br />$query<br />{$sql->error}";
}
 
/* close our connection */
$sql->close();
}


public function editedInventory($stockCardNo,$inventoryNo,$description,$genericName,$quantity,$unitcost,$opdPrice,$ipdPrice,$inventoryType,$time,$date,$username) {

/* make your connection */
$sql = new mysqli($this->host,$this->username,$this->password,$this->database);
 
/* we will just create an insert query here, and use it,
normally this would be done by form submission or other means */
$query = "insert into editedInventory(stockCardNo,inventoryCode,description,genericName,quantity,unitcost,opdPrice,ipdPrice,inventoryType,time,date,username) values('$stockCardNo','$inventoryNo','$description','$genericName','$quantity','$unitcost','$opdPrice','$ipdPrice','$inventoryType','$time','$date','$username')";
 
if ( $sql->query($query) ) {
   //echo "A new entry has been added with the `id`";
} else {
    echo "There was a problem:<br />$query<br />{$sql->error}";
}
 
/* close our connection */
$sql->close();
}



public function addDiscountTypez($discountType) {

/* make your connection */
$sql = new mysqli($this->host,$this->username,$this->password,$this->database);
 
/* we will just create an insert query here, and use it,
normally this would be done by form submission or other means */
$query = "insert into discountType(discountType) values('$discountType')";
 
if ( $sql->query($query) ) {
   //echo "A new entry has been added with the `id`";
} else {
    echo "There was a problem:<br />$query<br />{$sql->error}";
}
 
/* close our connection */
$sql->close();
}



public function listDiscountType() {


$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, "select discountType from discountType") or die("Query fail: " . mysqli_error()); 

echo "<br><br><br><center>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Discount Type");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
{
$this->coconutTableRowStart();
$this->coconutTableData($row['discountType']);
$this->coconutTableRowStop();
}

}


public function chargesEditHistory($itemNo) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }

tr.border_bottom td {
  border-bottom:1pt solid #CCCCCC;
}

</style>";


$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, "select itemNo,date,sellingPrice,quantity,discount,total,cashUnpaid,company,phic,username from editedAmount where itemNo = '$itemNo' order by time,date asc") or die("Query fail: " . mysqli_error()); 

echo "<br><br><br><center>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Date");
$this->coconutTableHeader("Description");
$this->coconutTableHeader("Price");
$this->coconutTableHeader("QTY");
$this->coconutTableHeader("Discount");
$this->coconutTableHeader("Total");
$this->coconutTableHeader("CASH");
$this->coconutTableHeader("HMO");
$this->coconutTableHeader("PHIC");
$this->coconutTableHeader("Edit by");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
{
$this->coconutTableRowStart();
$this->coconutTableData($row['date']);
$this->coconutTableData($this->selectNow("patientCharges","description","itemNo",$row['itemNo']));
$this->coconutTableData($row['sellingPrice']);
$this->coconutTableData($row['quantity']);
$this->coconutTableData($row['discount']);
$this->coconutTableData($row['total']);
$this->coconutTableData($row['cashUnpaid']);
$this->coconutTableData($row['company']);
$this->coconutTableData($row['phic']);
$this->coconutTableData($row['username']);
$this->coconutTableRowStop();
}
$this->coconutTableStop();
echo "<br><br>";

$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Date");
$this->coconutTableHeader("Description");
$this->coconutTableHeader("Price");
$this->coconutTableHeader("QTY");
$this->coconutTableHeader("Discount");
$this->coconutTableHeader("Total");
$this->coconutTableHeader("CASH");
$this->coconutTableHeader("HMO");
$this->coconutTableHeader("PHIC");
$this->coconutTableHeader("&nbsp;");
$this->coconutTableRowStop();
$this->coconutTableRowStart();
$this->coconutTableData("&nbsp;<font color=red>".$this->selectNow("patientCharges","dateCharge","itemNo",$itemNo)."</font>&nbsp;&nbsp;&nbsp;");
$this->coconutTableData($this->selectNow("patientCharges","description","itemNo",$itemNo));
$this->coconutTableData($this->selectNow("patientCharges","sellingPrice","itemNo",$itemNo));
$this->coconutTableData($this->selectNow("patientCharges","quantity","itemNo",$itemNo));
$this->coconutTableData($this->selectNow("patientCharges","discount","itemNo",$itemNo));
$this->coconutTableData($this->selectNow("patientCharges","total","itemNo",$itemNo));
$this->coconutTableData($this->selectNow("patientCharges","cashUnpaid","itemNo",$itemNo));
$this->coconutTableData($this->selectNow("patientCharges","company","itemNo",$itemNo));
$this->coconutTableData($this->selectNow("patientCharges","phic","itemNo",$itemNo));
$this->coconutTableData($this->selectNow("patientCharges","chargeBy","itemNo",$itemNo));
$this->coconutTableRowStop();
$this->coconutTableStop();
}



public function showEditedInventory($inventoryCode) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }

tr.border_bottom td {
  border-bottom:1pt solid #CCCCCC;
}

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, "select description,genericName,quantity,unitcost,opdPrice,ipdPrice,inventoryType,date,username from editedInventory where inventoryCode = '$inventoryCode' ") or die("Query fail: " . mysqli_error()); 

echo "<br><br><br><center>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Date");
$this->coconutTableHeader("Description");
$this->coconutTableHeader("Generic");
$this->coconutTableHeader("QTY");
$this->coconutTableHeader("Unitcost");
$this->coconutTableHeader("OPD");
$this->coconutTableHeader("IPD");
$this->coconutTableHeader("User");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
{
$this->coconutTableRowStart();
$this->coconutTableData($row['date']);
$this->coconutTableData($row['description']);
$this->coconutTableData($row['genericName']);
$this->coconutTableData($row['quantity']);
$this->coconutTableData($row['unitcost']);
$this->coconutTableData($row['opdPrice']);
$this->coconutTableData($row['ipdPrice']);
$this->coconutTableData($row['username']);
$this->coconutTableRowStop();
}
$this->coconutTableStop();
echo "<Br><br>";

$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Date");
$this->coconutTableHeader("Description");
$this->coconutTableHeader("Generic");
$this->coconutTableHeader("QTY");
$this->coconutTableHeader("Unitcost");
$this->coconutTableHeader("OPD");
$this->coconutTableHeader("IPD");
$this->coconutTableHeader("User");
$this->coconutTableRowStop();
$this->coconutTableRowStart();
$this->coconutTableData($this->selectNow("inventory","dateAdded","inventoryCode",$inventoryCode));
$this->coconutTableData($this->selectNow("inventory","description","inventoryCode",$inventoryCode));
$this->coconutTableData($this->selectNow("inventory","genericName","inventoryCode",$inventoryCode));
$this->coconutTableData($this->selectNow("inventory","quantity","inventoryCode",$inventoryCode));
$this->coconutTableData($this->selectNow("inventory","unitcost","inventoryCode",$inventoryCode));
$this->coconutTableData($this->selectNow("inventory","opdPrice","inventoryCode",$inventoryCode));
$this->coconutTableData($this->selectNow("inventory","ipdPrice","inventoryCode",$inventoryCode));
$this->coconutTableData($this->selectNow("inventory","addedBy","inventoryCode",$inventoryCode));
$this->coconutTableRowStop();
$this->coconutTableStop();


}


public function addDailyCashierAttribute($attributeName,$attributeValue,$shift,$date) {

/* make your connection */
$sql = new mysqli($this->host,$this->username,$this->password,$this->database);
 
/* we will just create an insert query here, and use it,
normally this would be done by form submission or other means */
$query = "insert into dailyCashiersAttr(attributeName,attributeValue,shift,date) values('$attributeName','$attributeValue','$shift','$date')";
 
if ( $sql->query($query) ) {
   //echo "A new entry has been added with the `id`";
}else {
    echo "There was a problem:<br />$query<br />{$sql->error}";
}
 
/* close our connection */
$sql->close();
}




public function getDailyCashiersAttribute($shift,$date) {


$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, "select attrNo,attributeName,attributeValue from dailyCashiersAttr where shift='$shift' and date='$date' ") or die("Query fail: " . mysqli_error()); 

echo "<table border=0>";
while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td><a href='http://".$this->getMyUrl()."/COCONUT/Cashier/cashierReport/deleteAttribute.php?attrNo=$row[attrNo]&date=$date&shift=$shift' style='text-decoration:none; color:black;'><font size=3>".$row['attributeName']."</font></a></td>";
echo "<td><font size=2>-------></font></td>";
echo "<td><font size=3>".$row['attributeValue']."</font></td>";
echo "</tr>";
}
echo "</table>";
}


public function addDischargeHistory($registrationNo,$status,$time,$date,$username) {

/* make your connection */
$sql = new mysqli($this->host,$this->username,$this->password,$this->database);
 
/* we will just create an insert query here, and use it,
normally this would be done by form submission or other means */
$query = "insert into dischargeHistory(registrationNo,status,time,date,username) values('$registrationNo','$status','$time','$date','$username')";
 
if ( $sql->query($query) ) {
   //echo "A new entry has been added with the `id`";
}else {
echo "There was a problem:<br />$query<br />{$sql->error}";
}
 
/* close our connection */
$sql->close();
}



public function viewDischargedHistory($registrationNo) {


$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, "select status,time,date,username from dischargeHistory where registrationNo = '$registrationNo' ") or die("Query fail: " . mysqli_error()); 

$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Status");
$this->coconutTableHeader("Time");
$this->coconutTableHeader("Date");
$this->coconutTableHeader("User");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
{
$this->coconutTableRowStart();
$this->coconutTableData($row['status']);
$this->coconutTableData($row['time']);
$this->coconutTableData($row['date']);
$this->coconutTableData($row['username']);
$this->coconutTableRowStop();
}
$this->coconutTableStop();
}



public function getCurrentDiscount_rBanny($registrationNo) {


$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, "SELECT sum(pc.discount) as totalDisc FROM registrationDetails rd,patientCharges pc where rd.registrationNo = '$registrationNo' and rd.registrationNo = pc.registrationNo and pc.discount >0 and status = 'UNPAID' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['totalDisc'];
}

}


public function getHighestTotal_rBanny($registrationNo) {


$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection,"SELECT pc.cashUnpaid,pc.itemNo from patientCharges pc where pc.registrationNo = '$registrationNo' and pc.status = 'UNPAID' and pc.sellingPrice > 0 and pc.discount=0 and pc.title != 'PROFESSIONAL FEE' and pc.title in ('LABORATORY','MEDICINE','XRAY','ULTRASOUND','ECG','OR/DR/ER Fee','SUPPLIES') HAVING MAX(pc.cashUnpaid)") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['cashUnpaid']."_".$row['itemNo'];
}

}



public function getRegistrationCensusChart($type,$date,$date1) {


$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, "SELECT count(registrationNo) as totalPx from registrationDetails where (dateRegistered between '$date' and '$date1') and type = '$type' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['totalPx'];
}

}

public function getCashPaidChart_opd($cols,$date,$date1) {


$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, "SELECT sum(pc.".$cols.") as totalPd from registrationDetails rd,patientCharges pc where rd.registrationNo = pc.registrationNo and rd.type = 'OPD' and (pc.datePaid between '$date' and '$date1') and pc.".$cols." > 0 and pc.status in ('PAID','UNPAID') ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
if($row['totalPd'] > 0) {
return $row['totalPd'];
}else {
return 0;
}
}

}

public function getCashPaidChart_ipd($date,$date1) {


$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, "SELECT sum(pp.amountPaid) as totPd from patientPayment pp where (pp.datePaid between '$date' and '$date1') and pp.paymentFor in ('DEPOSIT','HOSPITAL BILL') ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{

if($row['totPd'] > 0) {
return $row['totPd'];
}else {
return 0;
}

}
}



}



?>
