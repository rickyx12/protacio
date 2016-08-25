<?php
include("myDatabase.php");

class database1 extends database  {

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


public function getTotalPx($month,$day,$year,$month1,$day1,$year1,$type) {


$date = $year."-".$month."-".$day;
$date1 = $year1."-".$month1."-".$day1;


($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . $this->database));


//$con = mysql_connect($this->host,$this->username,$this->password);
//if (!$con)
  //{
  //die('Could not connect: ' . mysql_error());
  //}

//mysql_select_db($this->database, $con);

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(registrationNo) as regNo FROM registrationDetails WHERE (dateRegistered between '$date' and '$date1') and type = '$type'  ");

while($row = mysqli_fetch_array($result))
  {
return $row['regNo'];
  }

}




public function showPieGraph() {

$myImage = ImageCreate(300,300);

$white = ImageColorAllocate ($myImage, 255, 255, 255);
$red  = ImageColorAllocate ($myImage, 255, 0, 0);
$green = ImageColorAllocate ($myImage, 0, 255, 0);
$blue = ImageColorAllocate ($myImage, 0, 0, 255);
$lt_red = ImageColorAllocate($myImage, 255, 150, 150);
$lt_green = ImageColorAllocate($myImage, 150, 255, 150);
$lt_blue = ImageColorAllocate($myImage, 150, 150, 255);

for ($i = 120;$i > 100;$i--) {
    ImageFilledArc ($myImage, 100, $i, 200, 150, 0, 90, $lt_red, IMG_ARC_PIE);
    ImageFilledArc ($myImage, 100, $i, 200, 150, 90, 360, $lt_blue, IMG_ARC_PIE);
  //  ImageFilledArc ($myImage, 100, $i, 200, 150, 180, 360, $lt_blue, IMG_ARC_PIE);
}

ImageFilledArc($myImage, 100, 100, 200, 150, 0, 90, $red, IMG_ARC_PIE);
ImageFilledArc($myImage, 100, 100, 200, 150, 90, 360 , $blue, IMG_ARC_PIE);
//ImageFilledArc($myImage, 100, 100, 200, 150, 180, 360 , $blue, IMG_ARC_PIE);

header ("Content-type: image/png");
ImagePNG($myImage);

ImageDestroy($myImage);



}




public function phicTransmit($registrationNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$sql="INSERT INTO phicTransmit (registrationNo)
VALUES
('$registrationNo')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

echo "<script type='text/javascript' >";
echo "alert('$service was Successfully Added to the List of Service in $category');";
echo  "window.location='http://".$this->getMyUrl()."/Maintenance/addService.php?username=$username'";
echo "</script>";
((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}


//// Aug 6 ,2012

public function addVoucher($voucherNo,$paymentMode,$description,$amount,$payee,$date,$time,$accountTitle,$user,$type) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$sql="INSERT INTO vouchers (voucherNo,paymentMode,description,amount,payee,date,time,accountTitle,user,type)
VALUES
('".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $voucherNo) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."','".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $paymentMode) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."','".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $description) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."','".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $amount) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."','".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $payee) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."','".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $date) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."','".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $time) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."','".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $accountTitle) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."','".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $user) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."','$type')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

echo "<script type='text/javascript' >";
echo "alert('Voucher Added');";
echo  "window.location='http://".$this->getMyUrl()."/COCONUT/accounting/voucher/addVoucher.php?username=$user'";
echo "</script>";

((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}

// Aug 6 2012


public $cashDisbursement_total;

public function cashDisbursement($month,$day,$year,$month1,$day1,$year1,$user,$payee) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow;color:black;}

a { text-decoration:none; color:black; }
</style>";

$date = $year."-".$month."-".$day;
$date1 = $year1."-".$month1."_".$day1;

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

if( $payee == "" ) {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM vouchers WHERE (date between '$date' and '$date1') order by date desc  ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM vouchers WHERE (date between '$date' and '$date1') and payee = '$payee' order by date desc  ");
}

echo "<centeR><br>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Voucher#");
$this->coconutTableHeader("Type");
$this->coconutTableHeader("Description");
$this->coconutTableHeader("Amount");
$this->coconutTableHeader("Payee");
$this->coconutTableHeader("Date");
$this->coconutTableHeader("Time");
$this->coconutTableHeader("<font size=2>Account Title</font>");
$this->coconutTableHeader("User");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->cashDisbursement_total += $row['amount'];
$this->coconutTableData($row['voucherNo']);
$this->coconutTableData($row['paymentMode']);
$this->coconutTableData($row['description']);
$this->coconutTableData(number_format($row['amount'],2));
$this->coconutTableData($row['payee']);
$this->coconutTableData($row['date']);
$this->coconutTableData($row['time']);
$this->coconutTableData($row['accountTitle']);
$this->coconutTableData($row['user']);
$this->coconutTableRowStop();
  }
$this->coconutTableRowStart();
$this->coconutTableData("<b>Grand Total</b>");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("".number_format($this->cashDisbursement_total,2));
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableRowStop();
$this->coconutTableStop();

}

//Aug 6
public function addSupplier($supplierName,$address,$contactPerson,$contactNo,$description) {


//$con = mysqli_connect($this->host,$this->username,$this->password);
$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$sql="INSERT INTO supplier (supplierName,address,description,contactPerson,contactNo,status)
VALUES
('".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $supplierName) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."','".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $address) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."','".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $contactPerson) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."','".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $contactNo) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."','".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $description) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."','Active')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

echo "<script type='text/javascript' >";
echo "alert('Supplier Added');";
echo  "window.location='http://".$this->getMyUrl()."/Maintenance/addSupplier.php'";
echo "</script>";
((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}


//aug 6
public $getMasterListSupplier_total;

public function getMasterListSupplier($username) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow;color:black;}

a { text-decoration:none; color:black; }
</style>";


$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM supplier order by supplierName asc  ");

echo "<centeR><br>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Supplier Name");
$this->coconutTableHeader("Address");
$this->coconutTableHeader("Contact Person");
$this->coconutTableHeader("Contact No");
$this->coconutTableHeader("Description");
$this->coconutTableHeader("");
$this->coconutTableHeader("");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->getMasterListSupplier_total++;
$this->coconutTableData($row['supplierName']);
$this->coconutTableData($row['address']);
$this->coconutTableData($row['contactPerson']);
$this->coconutTableData($row['contactNo']);
$this->coconutTableData($row['description']);

echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/masterfile/EDIT/editSupplier.php?supplierName=$row[supplierName]&address=$row[address]&contactPerson=$row[contactPerson]&contactNo=$row[contactNo]&description=$row[description]&supplierCode=$row[supplierCode]&username=$username'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/pencil.jpeg'></a>&nbsp;</td>";
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/masterfile/DELETE/deleteSupplier.php?supplierName=$row[supplierName]&supplierCode=$row[supplierCode]&username=$username'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/delete.jpeg'></a>&nbsp;</td>";

$this->coconutTableRowStop();
  }
$this->coconutTableRowStart();
$this->coconutTableData("<b><font size=2>Supplier&nbsp;  ".$this->getMasterListSupplier_total."</font></b>");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableRowStop();
$this->coconutTableStop();

}




public function chargesAlready($desc,$date,$registrationNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT description FROM patientCharges WHERE description = '$desc' and dateCharge = '$date' and registrationNo = '$registrationNo'");

return mysqli_num_rows($result);

}

/******************TRIAL BALANCE**********************************/

public function sumAccountTitle($accountTitle,$month,$year) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(amount) as amount FROM vouchers WHERE date like '$month%%%%$year' and accountTitle = '$accountTitle'  ");

while($row = mysqli_fetch_array($result))
  {
return $row['amount'];
}

}

public function sumPaymentMode($month,$year,$paymentMode) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(amount) as amount FROM vouchers WHERE date like '$month%%%%$year' and paymentMode = '$paymentMode'  ");

while($row = mysqli_fetch_array($result))
  {
return $row['amount'];
}

}


public $trialBalance_debit;
public $trialBalance_credit;

public function trialBalance($month,$year) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow;color:black;}

a { text-decoration:none; color:black; }
</style>";


$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));


$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM vouchers WHERE date like '$month%%%%$year' group by accountTitle order by accountTitle asc  ");

echo "<centeR>";
$this->coconutTableStart();
$this->coconutTableRowStart();
echo "<Br>";
echo "<th>&nbsp;Account Title&nbsp;</th>";
echo "<th>&nbsp;Debit&nbsp;</th>";
echo "<th>&nbsp;Credit&nbsp;</th>";
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->trialBalance_debit += $this->sumAccountTitle($row['accountTitle'],$month,$year);

$this->coconutTableData("&nbsp;".$row['accountTitle']."&nbsp;");
$this->coconutTableData("&nbsp;".number_format($this->sumAccountTitle($row['accountTitle'],$month,$year),2)."&nbsp;");
$this->coconutTableData("");
$this->coconutTableRowStop();
  }
$this->coconutTableRowStart();
$this->coconutTableData("Cash");
$this->coconutTableData("");
$this->coconutTableData("".number_format($this->sumPaymentMode($month,$year,"cash"),2));
$this->coconutTableRowStop();

$this->coconutTableRowStart();
$this->coconutTableData("Check");
$this->coconutTableData("");
$this->coconutTableData("".number_format($this->sumPaymentMode($month,$year,"check"),2));
$this->coconutTableRowStop();

$this->coconutTableRowStart();
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableRowStop();


$this->coconutTableRowStart();
$this->coconutTableData("<b>Total</b>");
$this->coconutTableData("".number_format($this->trialBalance_debit,2));
$this->coconutTableData("".number_format($this->sumPaymentMode($month,$year,"cash") + $this->sumPaymentMode($month,$year,"check"),2));
$this->coconutTableRowStop();
$this->coconutTableStop();

}



/******MONTH REGISTRATION CENSUS*******************/
public function getPxCensusMonth($month,$day,$year,$type) {


$date = $year."-".$month."-".$day;

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

if( $type == "IPD" ) {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(registrationNo) as regNo FROM registrationDetails WHERE dateRegistered = '$date' and type IN ('IPD','ER','ICU','OR/DR')  ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(registrationNo) as regNo FROM registrationDetails WHERE dateRegistered = '$date' and type = '$type'  ");
}

while($row = mysqli_fetch_array($result))
  {
return $row['regNo'];
  }

}

/***************MONTH REGISTRATION CENSUS*********************/



/****************ANNUAL REGISTRATION CENSUS*********************/

public function getPxCensusAnnual($month,$year,$type) {


$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

if( $type == "IPD" ) {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(registrationNo) as regNo FROM registrationDetails WHERE dateRegistered like '$year-$month%%%' and type IN ('IPD','ICU','ER','OR/DR')  ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(registrationNo) as regNo FROM registrationDetails WHERE dateRegistered like '$year-$month%%%' and type = '$type'  ");
}

while($row = mysqli_fetch_array($result))
  {
return $row['regNo'];
  }

}
/***************************ANNUAL REGISTRATION CENSUS**********/



/******************DAILY REVENUE OPD**************************/
public function getPxRevenueDaily_opd($month,$day,$year) {

$date = $year."-".$month."-".$day;

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(cashPaid) as cashPaid FROM registrationDetails rd,patientCharges pc WHERE rd.registrationNo = pc.registrationNo and rd.type = 'OPD' and pc.datePaid = '$date'   ");

while($row = mysqli_fetch_array($result))
  {
return $row['cashPaid'];
  }

}

/*****************DAILY REVENUE OPD***********************/




/******************DAILY REVENUE OPD (BY DEPT)**************************/
public function getPxRevenueDaily_opd_dept($month,$day,$year,$title) {

$date = $year."-".$month."-".$day;

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(cashPaid) as cashPaid FROM registrationDetails rd,patientCharges pc WHERE rd.registrationNo = pc.registrationNo and rd.type = 'OPD' and pc.datePaid = '$date' and pc.title = '$title'  ");

while($row = mysqli_fetch_array($result))
  {
return $row['cashPaid'];
  }

}

/*****************DAILY REVENUE OPD (BY DEPT)***********************/


/******************DAILY REVENUE IPD**************************/
public function getPxRevenueDaily_ipd($month,$day,$year) {

$date = $year."-".$month."-".$day;

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(pp.amountPaid) as amountPaid,sum(pf) as pf,sum(admitting) as admitting FROM registrationDetails rd,patientPayment pp WHERE rd.registrationNo = pp.registrationNo and rd.type = 'IPD' and pp.datePaid = '$date'  ");

while($row = mysqli_fetch_array($result))
  {
return ($row['amountPaid'] );
  }

}

/*****************DAILY REVENUE IPD***********************/



/**********ANNUAL REVENUE/COLLECTION***************/
public function getAnnualRevenue_opd($month,$year) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(cashPaid) as cashPaid FROM registrationDetails rd,patientCharges pc WHERE rd.registrationNo = pc.registrationNo and rd.type = 'OPD' and pc.datePaid like '$year-$month%%%'   ");

while($row = mysqli_fetch_array($result))
  {
return $row['cashPaid'] / 1000;
  }

}
/**********************************************/



/**********ANNUAL REVENUE/COLLECTION**********************/
public function getAnnualRevenue_ipd($month,$year) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(amountPaid) as amountPaid FROM registrationDetails rd,patientPayment pp WHERE rd.registrationNo = pp.registrationNo and rd.type = 'IPD' and pp.datePaid like '$year-$month%%%'  ");

while($row = mysqli_fetch_array($result))
  {
return $row['amountPaid'] / 1000;
  }

}
/*******************************************************/


public function getGenderDaily($month,$day,$year,$gender,$type) {


$date = $year."-".$month."-".$day;

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(rd.registrationNo) as regNo FROM registrationDetails rd,patientRecord pr WHERE pr.patientNo = rd.patientNo and rd.dateRegistered IN ('$date') and rd.type = '$type' and pr.Gender = '$gender' ");

while($row = mysqli_fetch_array($result))
  {
return $row['regNo'];
  }

}

/******************************************************/



public function getGenderAnnual($month,$year,$gender,$type) {


$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(rd.registrationNo) as regNo FROM registrationDetails rd,patientRecord pr WHERE pr.patientNo = rd.patientNo and rd.dateRegistered like '$year-$month%%%' and rd.type = '$type' and pr.Gender = '$gender' ");

while($row = mysqli_fetch_array($result))
  {
return $row['regNo'];
  }

}

/********************************************************/



/********PHIC RECEIVABLE NON-PACKAGE**********************/
public function getPHICReceivablesMonthly($month,$day,$year) { //BASED ON TRANSMITTED NA

$date = $year."-".$month."-".$day;

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));


$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(pc.phic) as totalPHIC FROM registrationDetails rd,patientCharges pc WHERE rd.registrationNo = pc.registrationNo and rd.dateUnregistered IN ('$date') ");



while($row = mysqli_fetch_array($result))
  {
 return $row['totalPHIC']; 
}
}

/*********************************************************/



/********PHIC RECEIVABLE PACKAGE**********************/
public function getPHICReceivablesMonthly_package($month,$day,$year) { //BASED ON TRANSMITTED NA

$date = $month."_".$day."_".$year;

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));


$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(pt.package) as totalPackage FROM registrationDetails rd,phicTransmit pt WHERE rd.dateUnregistered IN ('$date') and rd.registrationNo = pt.registrationNo and pt.package > 0   ");


while($row = mysqli_fetch_array($result))
  {
 return $row['totalPackage']; 
}
}

/*********************************************************/


/********PHIC RECEIVABLE NON-PACKAGE Annual**********************/
public function getPHICReceivablesAnnual($month,$year) { //BASED ON TRANSMITTED NA

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));


$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(pc.phic) as totalPHIC FROM registrationDetails rd,patientCharges pc,phicTransmit pt WHERE rd.registrationNo = pc.registrationNo and rd.dateUnregistered like '$month%%%%$year' and rd.registrationNo = pt.registrationNo and pt.package = 0   ");



while($row = mysqli_fetch_array($result))
  {
 return $row['totalPHIC']; 
}
}

/*********************************************************/




/********PHIC RECEIVABLE PACKAGE**********************/
public function getPHICReceivablesAnnual_package($month,$year) { //BASED ON TRANSMITTED NA


$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));


$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(pt.package) as totalPackage FROM registrationDetails rd,phicTransmit pt WHERE rd.dateUnregistered like '$month%%%%$year' and rd.registrationNo = pt.registrationNo and pt.package > 0   ");


while($row = mysqli_fetch_array($result))
  {
 return $row['totalPackage']; 
}
}

/*********************************************************/



/*************MONTHLY EXPENSES*****************************/
public function getMonthlyExpenses($month,$day,$year) {

$date = $year."-".$month."-".$day;

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(amount) as amount FROM vouchers WHERE date IN ('$date')   ");

while($row = mysqli_fetch_array($result))
  {
return $row['amount'] / 1000;
  }

}

/**********************************************************/


/*************ANNUAL EXPENSES*****************************/
public function getAnnualExpenses($month,$year) {


$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(amount) as amount FROM vouchers WHERE date like '$year-$month%%%'   ");

while($row = mysqli_fetch_array($result))
  {
return $row['amount'] / 1000;
  }

}

/**********************************************************/




/*************MONTHLY DISCOUNT GIVEN*****************************/
public function getMonthlyDiscount_ipd($month,$day,$year) {

$date = $month."_".$day."_".$year;

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(discount) as discount FROM registrationDetails WHERE dateUnregistered IN ('$date') and discount NOT IN('',0) and type = 'IPD'   ");

while($row = mysqli_fetch_array($result))
  {
return $row['discount'];
  }

}

/**********************************************************/




/*************MONTHLY DISCOUNT GIVEN*****************************/
public function getMonthlyDiscount_opd($month,$day,$year) {

$date = $month."_".$day."_".$year;

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(pc.discount) as discountz FROM registrationDetails rd,patientCharges pc WHERE rd.registrationNo = pc.registrationNo and pc.dateCharge IN ('$date') and pc.discount NOT IN('',0) and rd.type = 'OPD'   ");

while($row = mysqli_fetch_array($result))
  {
return $row['discountz'];
  }

}

/**********************************************************/



/*************ANNUAL DISCOUNT GIVEN*****************************/
public function getAnnualDiscount_ipd($month,$year) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(discount) as discount FROM registrationDetails WHERE dateUnregistered like '$month%%%%$year' and discount NOT IN('',0) and type = 'IPD'   ");

while($row = mysqli_fetch_array($result))
  {
return $row['discount'] / 1000;
  }

}

/**********************************************************/



/*************MONTHLY DISCOUNT GIVEN*****************************/
public function getAnnualDiscount_opd($month,$year) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(pc.discount) as discountz FROM registrationDetails rd,patientCharges pc WHERE rd.registrationNo = pc.registrationNo and pc.dateCharge like '$month%%%%$year' and pc.discount NOT IN('',0) and rd.type = 'OPD'   ");

while($row = mysqli_fetch_array($result))
  {
return $row['discountz'] / 1000;
  }

}

/**********************************************************/


/*************MONTHLY SENIOR*****************************/
public function getMonthlySenior($month,$day,$year,$type) {

$date = $year."-".$month."-".$day;

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(registrationNo) as regNo FROM registrationDetails WHERE dateRegistered IN ('$date') and type = '$type'   ");

while($row = mysqli_fetch_array($result))
  {
return $row['regNo'];
  }

}

/**********************************************************/


/*************ANNUAL SENIOR*****************************/
public function getAnnualSenior($month,$year,$type) {


$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT count(rd.registrationNo) as regNo FROM registrationDetails rd,patientRecord pr WHERE pr.patientNo=rd.patientNo and rd.dateRegistered like '$year-$month%%%' and rd.type = '$type' and pr.Senior like 'YES%%%%'   ");

while($row = mysqli_fetch_array($result))
  {
return $row['regNo'];
  }

}

/**********************************************************/



/*************BEST SELLING*****************************/
public $getBestSelling_opd_total;
public function getBestSelling_opd($month,$year,$title) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow;color:black;}

a { text-decoration:none; color:black; }
</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "select pc.description,sum(pc.cashPaid) as totalPaid from patientCharges pc,registrationDetails rd WHERE pc.registrationNo = rd.registrationNo and type ='OPD' and pc.datePaid  like '$year-$month%%%' and pc.title = '$title' and pc.status='PAID' group by pc.description order by totalPaid desc limit 20 ");

echo "<Center>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Top");
$this->coconutTableHeader("Description");
$this->coconutTableHeader("Sale's");
$this->coconutTableHeader("");
$this->coconutTableRowStop();
$x=1;
while($row = mysqli_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->getBestSelling_opd_total += $row['totalPaid'];
$this->coconutTableData("".$x++);
$this->coconutTableData($row['description']);
$this->coconutTableData(number_format($row['totalPaid'],2));
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/graphicalReport/bestSelling/redirect.php?month=$month&year=$year&description=$row[description]'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/arrow1.jpeg'></a>");
$this->coconutTableRowStop();
  }
$this->coconutTableRowStart();
$this->coconutTableStop();

}

/**********************************************************/


/*************BEST SELLING*****************************/
public $getBestSelling_ipd_total;
public function getBestSelling_ipd($month,$year,$title) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow;color:black;}

a { text-decoration:none; color:black; }
</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "select pc.description,sum(pc.total) as totalPaid from patientCharges pc,registrationDetails rd,patientPayment pp WHERE pc.registrationNo = rd.registrationNo and pc.registrationNo = pp.registrationNo and rd.type ='IPD' and pp.datePaid like '$year-$month%%%' and pc.title = '$title' group by pc.description order by totalPaid desc limit 20");

echo "<Center>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Top");
$this->coconutTableHeader("Description");
$this->coconutTableHeader("Sale's");
$this->coconutTableHeader("");
$this->coconutTableRowStop();
$x=1;
while($row = mysqli_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->getBestSelling_ipd_total += $row['totalPaid'];
$this->coconutTableData("".$x++);
$this->coconutTableData($row['description']);
$this->coconutTableData(number_format($row['totalPaid'],2));
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/graphicalReport/bestSelling/redirect_ipd.php?month=$month&year=$year&description=$row[description]'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/arrow1.jpeg'></a>");
$this->coconutTableRowStop();
  }
$this->coconutTableStop();

}

/**********************************************************/


/*************FAST MOVING ITEMS*****************************/
public function getFastMovingItems($month,$year,$title,$type) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow;color:black;}

a { text-decoration:none; color:black; }
</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

if( $type == "All" ) {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "select pc.chargesCode,pc.description,sum(pc.quantity) as qtyDispensed from patientCharges pc,registrationDetails rd WHERE pc.registrationNo = rd.registrationNo and pc.dateCharge like '$year-$month%%%' and pc.title = '$title' and pc.departmentStatus like 'dispensedBy%%%%' and pc.status not like 'DELETED_%%%%%%' group by pc.description order by qtyDispensed desc ");
}else {

if( $type == "IPD" ) {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "select pc.chargesCode,pc.description,sum(pc.quantity) as qtyDispensed from patientCharges pc,registrationDetails rd WHERE pc.registrationNo = rd.registrationNo and rd.type IN ('IPD','ER','ICU','OR/DR') and pc.dateCharge like '$year-$month%%%' and pc.title = '$title' and pc.departmentStatus like 'dispensedBy%%%%' and pc.status not like 'DELETED_%%%%%%' group by pc.description order by qtyDispensed desc ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "select pc.chargesCode,pc.description,sum(pc.quantity) as qtyDispensed from patientCharges pc,registrationDetails rd WHERE pc.registrationNo = rd.registrationNo and rd.type ='$type' and pc.dateCharge like '$year-$month%%%' and pc.title = '$title' and pc.departmentStatus like 'dispensedBy%%%%' and pc.status not like 'DELETED_%%%%%%' group by pc.description order by qtyDispensed desc ");
}

}

echo "<Center>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Top");
$this->coconutTableHeader("Description");
$this->coconutTableHeader("QTY Dispensed");
$this->coconutTableHeader("");
$this->coconutTableRowStop();
$x=1;
while($row = mysqli_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->coconutTableData("".$x++);
$this->coconutTableData($row['description']);
$this->coconutTableData("&nbsp;&nbsp;".number_format($row['qtyDispensed'])."");
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/graphicalReport/bestSelling/redirect_fastMoving.php?month=$month&year=$year&description=$row[description]&type=$type&chargesCode=$row[chargesCode]'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/arrow1.jpeg'></a>");
$this->coconutTableRowStop();
  }
$this->coconutTableStop();

}

/**********************************************************/


/*************BEST SELLING CHART*****************************/
public function getBestSellingChart_opd($month,$day,$year,$description) {

$date = $month."_".$day."_".$year;

echo "
<style type='text/css'>
tr:hover { background-color:yellow;color:black;}

a { text-decoration:none; color:black; }
</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(pc.cashPaid) as totalPaid from patientCharges pc,registrationDetails rd WHERE pc.registrationNo = rd.registrationNo and type ='OPD' and pc.datePaid IN ('$date') and pc.description = '$description' and pc.status='PAID' ");


while($row = mysqli_fetch_array($result))
  {
return $row['totalPaid'];
  }

}

/**********************************************************/


/*************BEST SELLING CHART*****************************/
public function getBestSellingChart_ipd($month,$day,$year,$description) {

$date = $month."_".$day."_".$year;

echo "
<style type='text/css'>
tr:hover { background-color:yellow;color:black;}

a { text-decoration:none; color:black; }
</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(pc.total) as totalPaid from patientCharges pc,registrationDetails rd,patientPayment pp WHERE pc.registrationNo = rd.registrationNo and pc.registrationNo = pp.registrationNo and rd.type ='IPD' and pp.datePaid = '$date' and pc.description='$description' ");


while($row = mysqli_fetch_array($result))
  {
return $row['totalPaid'];
  }

}

/**********************************************************/

/*************FAST MOVING ITEMS*****************************/
public function getFastMovingChart($month,$day,$year,$description,$type,$chargesCode) {

$date = $year."-".$month."-".$day;

echo "
<style type='text/css'>
tr:hover { background-color:yellow;color:black;}

a { text-decoration:none; color:black; }
</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

if( $type == "All" ) {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(pc.quantity) as qtyDispensed from patientCharges pc,registrationDetails rd WHERE pc.registrationNo = rd.registrationNo and pc.dateCharge = '$date' and pc.description = '$description' and pc.chargesCode = '$chargesCode' and pc.departmentStatus like 'dispensedBy%%%%'  ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "select sum(pc.quantity) as qtyDispensed from patientCharges pc,registrationDetails rd WHERE pc.registrationNo = rd.registrationNo and rd.type ='$type' and pc.dateCharge  = '$date' and pc.chargesCode = '$chargesCode' and pc.description = '$description' and pc.departmentStatus like 'dispensedBy%%%%' ");
}

while($row = mysqli_fetch_array($result))
  {
return $row['qtyDispensed'];
  }


}

/**********************************************************/



public function voidOPD_payment($registrationNo,$user) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow;color:black;}

a { text-decoration:none; color:black; }
</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));


$result = mysqli_query($GLOBALS["___mysqli_ston"], "select pc.itemNo,pc.description,pc.total,pc.datePaid,pc.cashPaid,pc.orNO,pc.paidVia,pc.amountPaidFromCreditCard,doctorsPF,doctorsPF_payable from patientCharges pc,registrationDetails rd WHERE pc.registrationNo = rd.registrationNo and pc.registrationNo = '$registrationNo' and (pc.cashPaid > 0 or pc.amountPaidFromCreditCard > 0) and pc.status in ('PAID','UNPAID') order by pc.orNO asc ");

$this->coconutFormStart("get","http://".$this->getMyUrl()."/COCONUT/patientProfile/voidPayment/voidNow.php");
echo "<Center>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("");
$this->coconutTableHeader("OR#");
$this->coconutTableHeader("Description");
$this->coconutTableHeader("Date Paid");
$this->coconutTableHeader("Paid");
if($this->selectNow("patientCharges","paidVia","registrationNo",$registrationNo) == "Cash") {
$this->coconutTableHeader("PF");
}else {
$this->coconutTableHeader("PayablesPF");
}
$this->coconutTableHeader("PaidVia");
$this->coconutTableRowStop();
$x=1;
while($row = mysqli_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->coconutHidden("registrationNo",$registrationNo);
$this->coconutHidden("username",$user);
$this->coconutTableData("<input type='checkbox' name='itemNo[]' value='".$row['itemNo']."' >");
$this->coconutTableData($row['orNO']);
$this->coconutTableData($row['description']);
$this->coconutTableData($row['datePaid']);
if($row['paidVia'] == "Cash"){
  $this->coconutTableData($row['cashPaid']);
  $this->coconutTableData($row['doctorsPF']);
}else {
  $this->coconutTableData($row['amountPaidFromCreditCard']);
  $this->coconutTableData($row['doctorsPF_payable']);
}
$this->coconutTableData($row['paidVia']);
$this->coconutTableRowStop();
}
$this->coconutTableStop();
echo "<Br>";
$this->coconutButton("Void Payment");
$this->coconutFormStop();

}

/**********************************************************/



public function AddVoidPayment($patientName,$item,$amount,$time,$date,$user) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$sql="INSERT INTO voidPayment (patientName,item,amount,timeVoid,dateVoid,voidBy)
VALUES
('".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $patientName) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."','".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $item) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."','".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $amount) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."','".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $time) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."','".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $date) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."','".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $user) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }
/*
echo "<script type='text/javascript' >";
echo "alert('Supplier Added');";
echo  "window.location='http://".$this->getMyUrl()."/Maintenance/addSupplier.php'";
echo "</script>";
*/
((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}





/****************** SHOW MGH *******************************/

public function showMGH($month,$day,$year) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow;color:black;}

a { text-decoration:none; color:black; }
</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$datez = $month."_".$day."_".$year;

if( $day == "All" ) {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "select pr.lastName,pr.firstName,pr.middleName,rd.mgh,rd.registrationNo from patientRecord pr,registrationDetails rd WHERE pr.patientNo = rd.patientNo and rd.mgh_date like '%%%$month%%%%' order by pr.lastName asc ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "select pr.lastName,pr.firstName,pr.middleName,rd.mgh,rd.registrationNo from patientRecord pr,registrationDetails rd WHERE pr.patientNo = rd.patientNo and rd.mgh_date = '$datez' order by pr.lastName asc ");
}


$this->coconutFormStart("get","http://".$this->getMyUrl()."/COCONUT/patientProfile/MGH/disable_MGH.php");
$this->coconutHidden("month",$month);
$this->coconutHidden("day",$day);
$this->coconutHidden("year",$year);
echo "<Center><Br><Br>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("");
$this->coconutTableHeader("Last Name");
$this->coconutTableHeader("First Name");
$this->coconutTableHeader("Middle Name");
$this->coconutTableHeader("MGH by");
$this->coconutTableHeader("");
$this->coconutTableRowStop();
$x=1;
while($row = mysqli_fetch_array($result))
  {
echo "<tr>";
//$mgh = preg_split ("/\_/", $row['mgh']); 
$this->coconutTableData("&nbsp;<input type=checkbox name='registrationNo[]' value='$row[registrationNo]'>&nbsp;");
$this->coconutTableData("&nbsp;".$row['lastName']."&nbsp;");
$this->coconutTableData("&nbsp;".$row['firstName']."&nbsp;");
$this->coconutTableData("&nbsp;".$row['middleName']."&nbsp;");
$this->coconutTableData("&nbsp;".$row['mgh']."&nbsp;");
$this->coconutTableData("&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/soaOption.php?registrationNo=$row[registrationNo]&username=' target='_blank'><font size=2 color=red>View S.O.A</font></a>&nbsp;");
$this->coconutTableRowStop();
  }
$this->coconutTableStop();
echo "<Br>";
$this->coconutButton("Disable MGH");
$this->coconutFormStop();

}

/**********************************************************/

//kuhain Lahat ng naibayad ng patient at i-sum 
public function getAllPatientPayment($registrationNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(pp.amountPaid) as amountPaid  FROM patientPayment pp WHERE pp.registrationNo = '$registrationNo'  ");

while($row = mysqli_fetch_array($result))
  {
return $row['amountPaid'];
  }

}


//get and sum all cashUnpaid of the patient
public function getCashUnpaid($registrationNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(pc.cashUnpaid) as cashUnpaid  FROM patientCharges pc WHERE pc.registrationNo = '$registrationNo'  ");

while($row = mysqli_fetch_array($result))
  {
return $row['cashUnpaid'];
  }

}


public function may_naibayad_naba_ang_patient($registrationNo) {

if( $this->selectNow("patientPayment","amountPaid","registrationNo",$registrationNo) != "" ) {
$patientBalance = ($this->getCashUnpaid($registrationNo) - $this->getAllPatientPayment($registrationNo));
}else {
$patientBalance = $this->getCashUnpaid($registrationNo);
}
return $patientBalance;
}






public function checkingStop($patientNo,$dateRegister) {


//$date = $month."_".$day."_".$year;
//$date1 = $month1."_".$day1."_".$year1;

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT registrationNo FROM registrationDetails WHERE patientNo = '$patientNo' and dateRegistered = '$dateRegister' ");


while($row = mysqli_fetch_array($result))
  {
return $row['registrationNo'];
  }  

}


public function searchRecord($name,$username) {

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover{ background-color:yellow; color:black; }
</style>
";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pr.patientNo,(pr.completeName) as completeName,pr.Birthdate,pr.Gender,pr.lastName,pr.firstName,pr.middleName,pr.contactNo,pr.Birthdate,pr.Gender,pr.Senior,pr.PHIC,pr.civilStatus,pr.Address,pr.phicType,rd.registrationNo,rd.dateRegistered FROM patientRecord pr,registrationDetails rd where pr.patientNo = rd.patientNo and pr.completeName like '$name%%%%%%%' order by rd.registrationNo desc ");

echo "<br>&nbsp;  <table border=1 cellpadding=0 cellspacing=0 rules=all>";
echo "<tr>";
echo  "<th bgcolor='#3b5998'>&nbsp;<font color=white>Reg#</font>&nbsp;</th>";
echo  "<th bgcolor='#3b5998'>&nbsp;<font color=white>Patient's Name</font>&nbsp;</th>";
echo  "<th bgcolor='#3b5998'>&nbsp;<font color=white>Date Registered</font>&nbsp;</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {
echo "<tr>";
echo "<td>&nbsp;".$row['registrationNo']."&nbsp;</td>";
echo "<td>&nbsp;<a href='/Department/redirect.php?username=$username&registrationNo=$row[registrationNo]'>".$row['completeName']."</a>&nbsp;</td>";
echo "<td>&nbsp;".$row['dateRegistered']."&nbsp;</td>";
echo "</tr>";
  }
echo "</table>";

}



public function getPHIC_supplies($registrationNo) {


//$date = $month."_".$day."_".$year;
//$date1 = $month1."_".$day1."_".$year1;

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(pc.phic) as totalPHIC FROM registrationDetails rd,patientCharges pc where rd.registrationNo = '$registrationNo' and rd.registrationNo = pc.registrationNo and pc.phic >0 and pc.title = 'SUPPLIES' ");


while($row = mysqli_fetch_array($result))
  {
return $row['totalPHIC'];
  }  

}


public function getInventoryPrice($inventoryCode) {


//$date = $month."_".$day."_".$year;
//$date1 = $month1."_".$day1."_".$year1;

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT Added,unitcost FROM inventory WHERE inventoryCode = '$inventoryCode' ");


while($row = mysqli_fetch_array($result))
  {
if( $this->selectNow("inventory","inventoryType","inventoryCode",$inventoryCode) == "medicine" ) {
$price = preg_split ("/\_/", $row['Added']); 
return $price[1];
  }else {
return $row['unitcost'];
}  


}
}


private $getPhilHealthReceivables_lab;
private $getPhilHealthReceivables_xray;
private $getPhilHealthReceivables_utz;
private $getPhilHealthReceivables_ctscan;
private $getPhilHealthReceivables_ecg;
private $getPhilHealthReceivables_pt;
private $getPhilHealthReceivables_ot;
private $getPhilHealthReceivables_st;
private $getPhilHealthReceivables_others;
private $getPhilHealthReceivables_erFee;
private $getPhilHealthReceivables_misc;
private $getPhilHealthReceivables_nursery;
private $getPhilHealthReceivables_ordr;
private $getPhilHealthReceivables_spiro;
private $getPhilHealthReceivables_med;
private $getPhilHealthReceivables_sup;
private $getPhilHealthReceivables_room;
private $getPhilHealthReceivables_total;
private $getPhilHealthReceivables_grandTotal;
private $getPhilHealthReceivables_totalPaid;

public function getPhilHeealthReceivables($fromMonth,$fromDay,$fromYear,$toMonth,$toDay,$toYear,$type) {


echo "

<script type='text/javascript' src='http://".$this->getMyUrl()."/jquery.js'></script>
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";


$date = $fromYear."-".$fromMonth."-".$fromDay;
$date1 = $toYear."-".$toMonth."-".$toDay;

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

if( $type == "All" ) {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pr.lastName,pr.firstName,rd.registrationNo,rd.dateUnregistered FROM registrationDetails rd,patientCharges pc,patientRecord pr WHERE pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and (rd.dateUnregistered between '$date' and '$date1') group by rd.registrationNo order by pr.lastName asc ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pr.lastName,pr.firstName,rd.registrationNo,rd.dateUnregistered FROM registrationDetails rd,patientCharges pc,patientRecord pr WHERE pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and (rd.dateUnregistered between '$date' and '$date1') and rd.type = '$type' group by rd.registrationNo order by pr.lastName asc ");
}

?>

<script type="text/javascript">

$(function(){	   


	$("#exportToExcel").click(function() {									   
		var data='<table>'+$("#ReportTable").html().replace(/<a\/?[^>]+>/gi, '')+'</table>';
		$('body').prepend("<form method='post' action='/export-to-excel/exporttoexcel.php' style='display:none' id='ReportTableData'><input type='text' name='tableData' value='"+data+"' ></form>");
		 $('#ReportTableData').submit().remove();
		 return false;
	});

});
</script>
<a href="#" id="exportToExcel" style="text-decoration:none; color:black; ">export</a>
<?
echo "<Table cellspacing=0 rule=all border=1 cellpadding=0 id='ReportTable'>";
$this->coconutTableRowStart();
echo "<th>Reg#</th>";
echo "<th>Discharged</th>";
echo "<th>Patient</th>";
echo "<th>Laboratory</th>";
echo "<th>XRAY</th>";
echo "<th>UTZ</th>";
echo "<th>CTSCAN</th>";
echo "<th>ECG</th>";
echo "<th>PT</th>";
echo "<th>OT</th>";
echo "<th>ST</th>";
echo "<th>OTHERS</th>";
echo "<th>ER FEE</th>";
echo "<th>Misc</th>";
echo "<th>Nursery</th>";
echo "<th>OR/DR</th>";
echo "<th>SPIRO</th>";
echo "<th>Medicine</th>";
echo "<th>Supplies</th>";
echo "<th>Room</th>";
echo "<th>Total</th>";
/*
echo "<th>Paid</th>";
echo "<th>Refno</th>";
echo "<th>Date</th>";
echo "<th>Remarks</th>";
*/
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->coconutTableData($row['registrationNo']);
$this->coconutTableData($row['dateUnregistered']);
$this->coconutTableData($row['lastName'].", ".$row['firstName']);

$this->getPhilHealthReceivables_lab += $this->getCurrentPHIC_check($row['registrationNo'],"LABORATORY");

$this->getPhilHealthReceivables_xray += $this->getCurrentPHIC_check($row['registrationNo'],"XRAY");

$this->getPhilHealthReceivables_utz += $this->getCurrentPHIC_check($row['registrationNo'],"ULTRASOUND");

$this->getPhilHealthReceivables_ctscan += $this->getCurrentPHIC_check($row['registrationNo'],"CTSCAN");

$this->getPhilHealthReceivables_ecg += $this->getCurrentPHIC_check($row['registrationNo'],"ECG");

$this->getPhilHealthReceivables_pt += $this->getCurrentPHIC_check($row['registrationNo'],"PT");

$this->getPhilHealthReceivables_ot += $this->getCurrentPHIC_check($row['registrationNo'],"OT");

$this->getPhilHealthReceivables_st += $this->getCurrentPHIC_check($row['registrationNo'],"ST");

$this->getPhilHealthReceivables_others += $this->getCurrentPHIC_check($row['registrationNo'],"OTHERS");

$this->getPhilHealthReceivables_erFee += $this->getCurrentPHIC_check($row['registrationNo'],"ER FEE");

$this->getPhilHealthReceivables_misc += $this->getCurrentPHIC_check($row['registrationNo'],"MISCELLANEOUS");

$this->getPhilHealthReceivables_nursery += $this->getCurrentPHIC_check($row['registrationNo'],"NURSERY");

$this->getPhilHealthReceivables_ordr += $this->getCurrentPHIC_check($row['registrationNo'],"OR/DR/ER Fee");

$this->getPhilHealthReceivables_spiro += $this->getCurrentPHIC_check($row['registrationNo'],"SPIROMETRY");

$this->getPhilHealthReceivables_med += $this->getCurrentPHIC_check($row['registrationNo'],"MEDICINE");

$this->getPhilHealthReceivables_sup += $this->getPHIC_supplies($row['registrationNo']);

$this->getPhilHealthReceivables_room += $this->getCurrentPHIC_check($row['registrationNo'],"Room And Board");


$this->getPhilHealthReceivables_total = ( 
  $this->getCurrentPHIC_check($row['registrationNo'],"LABORATORY") + 
  $this->getCurrentPHIC_check($row['registrationNo'],"XRAY") +
  $this->getCurrentPHIC_check($row['registrationNo'],"ULTRASOUND") +
  $this->getCurrentPHIC_check($row['registrationNo'],"CTSCAN") + 
  $this->getCurrentPHIC_check($row['registrationNo'],"ECG") +
  $this->getCurrentPHIC_check($row['registrationNo'],"PT") +
  $this->getCurrentPHIC_check($row['registrationNo'],"OT") +
  $this->getCurrentPHIC_check($row['registrationNo'],"ST") +
  $this->getCurrentPHIC_check($row['registrationNo'],"OTHERS") +
  $this->getCurrentPHIC_check($row['registrationNo'],"ER FEE") +
  $this->getCurrentPHIC_check($row['registrationNo'],"MISCELLANEOUS") +
  $this->getCurrentPHIC_check($row['registrationNo'],"NURSERY") +
  $this->getCurrentPHIC_check($row['registrationNo'],"OR/DR/ER Fee") +
  $this->getCurrentPHIC_check($row['registrationNo'],"SPIROMETRY") +
  $this->getCurrentPHIC_check($row['registrationNo'],"MEDICINE") + 
  $this->getPHIC_supplies($row['registrationNo']) + 
  $this->getCurrentPHIC_check($row['registrationNo'],"Room And Board")
  );

$this->getPhilHealthReceivables_grandTotal += $this->getPhilHealthReceivables_total;

if( $this->getCurrentPHIC_check($row['registrationNo'],"LABORATORY") == 0 ) {
$this->coconutTableData("");
}else {
$this->coconutTableData(number_format($this->getCurrentPHIC_check($row['registrationNo'],"LABORATORY"),2));
}

if( $this->getCurrentPHIC_check($row['registrationNo'],"XRAY") == 0 ) {
$this->coconutTableData("");
}else {
$this->coconutTableData(number_format($this->getCurrentPHIC_check($row['registrationNo'],"XRAY"),2));
}

if( $this->getCurrentPHIC_check($row['registrationNo'],"ULTRASOUND") == 0 ) {
$this->coconutTableData("");
}else {
$this->coconutTableData(number_format($this->getCurrentPHIC_check($row['registrationNo'],"ULTRASOUND"),2));
}

if( $this->getCurrentPHIC_check($row['registrationNo'],"CTSCAN") == 0 ) {
$this->coconutTableData("");
}else {
$this->coconutTableData(number_format($this->getCurrentPHIC_check($row['registrationNo'],"CTSCAN"),2));
}

if( $this->getCurrentPHIC_check($row['registrationNo'],"ECG") == 0 ) {
$this->coconutTableData("");
}else {
$this->coconutTableData(number_format($this->getCurrentPHIC_check($row['registrationNo'],"ECG"),2));
}

if( $this->getCurrentPHIC_check($row['registrationNo'],"PT") == 0 ) {
$this->coconutTableData("");
}else {
$this->coconutTableData(number_format($this->getCurrentPHIC_check($row['registrationNo'],"PT"),2));
}

if( $this->getCurrentPHIC_check($row['registrationNo'],"OT") == 0 ) {
$this->coconutTableData("");
}else {
$this->coconutTableData(number_format($this->getCurrentPHIC_check($row['registrationNo'],"OT"),2));
}

if( $this->getCurrentPHIC_check($row['registrationNo'],"ST") == 0 ) {
$this->coconutTableData("");
}else {
$this->coconutTableData(number_format($this->getCurrentPHIC_check($row['registrationNo'],"ST"),2));
}

if( $this->getCurrentPHIC_check($row['registrationNo'],"OTHERS") == 0 ) {
$this->coconutTableData("");
}else {
$this->coconutTableData(number_format($this->getCurrentPHIC_check($row['registrationNo'],"OTHERS"),2));
}

if( $this->getCurrentPHIC_check($row['registrationNo'],"ER FEE") == 0 ) {
$this->coconutTableData("");
}else {
$this->coconutTableData(number_format($this->getCurrentPHIC_check($row['registrationNo'],"ER FEE"),2));
}

if( $this->getCurrentPHIC_check($row['registrationNo'],"MISCELLANEOUS") == 0 ) {
$this->coconutTableData("");
}else {
$this->coconutTableData(number_format($this->getCurrentPHIC_check($row['registrationNo'],"MISCELLANEOUS"),2));
}

if( $this->getCurrentPHIC_check($row['registrationNo'],"NURSERY") == 0 ) {
$this->coconutTableData("");
}else {
$this->coconutTableData(number_format($this->getCurrentPHIC_check($row['registrationNo'],"NURSERY"),2));
}

if( $this->getCurrentPHIC_check($row['registrationNo'],"OR/DR/ER Fee") == 0 ) {
$this->coconutTableData("");
}else {
$this->coconutTableData(number_format($this->getCurrentPHIC_check($row['registrationNo'],"OR/DR/ER Fee"),2));
}

if( $this->getCurrentPHIC_check($row['registrationNo'],"SPIROMETRY") == 0 ) {
$this->coconutTableData("");
}else {
$this->coconutTableData(number_format($this->getCurrentPHIC_check($row['registrationNo'],"SPIROMETRY"),2));
}

if( $this->getCurrentPHIC_check($row['registrationNo'],"MEDICINE") == 0 ) {
$this->coconutTableData("");
}else {
$this->coconutTableData(number_format($this->getCurrentPHIC_check($row['registrationNo'],"MEDICINE"),2));
}

if( $this->getPHIC_supplies($row['registrationNo']) == 0 ) {
$this->coconutTableData("");
}else {
$this->coconutTableData(number_format($this->getPHIC_supplies($row['registrationNo']),2));
}


if( $this->getCurrentPHIC_check($row['registrationNo'],"Room And Board") == 0 ) {
$this->coconutTableData("");
}else {
$this->coconutTableData(number_format($this->getCurrentPHIC_check($row['registrationNo'],"Room And Board"),2));
}


if( $this->getPhilHealthReceivables_total == 0 ) {
$this->coconutTableData("");
}else {
$this->coconutTableData(number_format($this->getPhilHealthReceivables_total,2));
}

/*
if( $this->selectNow("phicReconcile","amount","registrationNo",$row['registrationNo']) == 0 ) {
$this->coconutTableData("");
}else {
$this->coconutTableData(number_format($this->selectNow("phicReconcile","amount","registrationNo",$row['registrationNo']),2));
}
*/
/*
$this->coconutTableData($this->selectNow("phicReconcile","refno","registrationNo",$row['registrationNo']));
$this->coconutTableData($this->selectNow("phicReconcile","date","registrationNo",$row['registrationNo']));
$this->coconutTableData($this->selectNow("phicReconcile","remarks","registrationNo",$row['registrationNo']));
*/
$this->coconutTableRowStop();
  }  
$this->coconutTableRowStart();
$this->coconutTableData("<b>Total</b>");
$this->coconutTableData("&nbsp;");
$this->coconutTableData("&nbsp;");
$this->coconutTableData( number_format($this->getPhilHealthReceivables_lab,2));
$this->coconutTableData( number_format($this->getPhilHealthReceivables_xray,2));
$this->coconutTableData( number_format($this->getPhilHealthReceivables_utz,2));
$this->coconutTableData( number_format($this->getPhilHealthReceivables_ctscan,2));
$this->coconutTableData( number_format($this->getPhilHealthReceivables_ecg,2));
$this->coconutTableData( number_format($this->getPhilHealthReceivables_pt,2));
$this->coconutTableData( number_format($this->getPhilHealthReceivables_ot,2));
$this->coconutTableData( number_format($this->getPhilHealthReceivables_st,2));
$this->coconutTableData( number_format($this->getPhilHealthReceivables_others,2));
$this->coconutTableData( number_format($this->getPhilHealthReceivables_erFee,2));
$this->coconutTableData( number_format($this->getPhilHealthReceivables_misc,2));
$this->coconutTableData( number_format($this->getPhilHealthReceivables_nursery,2));
$this->coconutTableData( number_format($this->getPhilHealthReceivables_ordr,2));
$this->coconutTableData( number_format($this->getPhilHealthReceivables_spiro,2));
$this->coconutTableData( number_format($this->getPhilHealthReceivables_med,2));
$this->coconutTableData( number_format($this->getPhilHealthReceivables_sup,2));
$this->coconutTableData( number_format($this->getPhilHealthReceivables_room,2));
$this->coconutTableData( number_format($this->getPhilHealthReceivables_grandTotal,2) );
/*
$this->coconutTableData("&nbsp;".number_format($this->getPhilHealthReceivables_totalPaid));
$this->coconutTableData("&nbsp;");
$this->coconutTableData("&nbsp;");
$this->coconutTableData("&nbsp;");
*/
$this->coconutTableRowStop();
$this->coconutTableStop();
}




public function updatePrice_inventory($registrationNo,$username,$type,$status) {


$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));


//if( $type == "PhilHealth" ) {
//$result = mysql_query(" SELECT pc.quantity,pc.description,pc.sellingPrice,pc.total,pc.cashUnpaid,pc.phic,pc.company,pc.itemNo FROM patientCharges pc,registrationDetails rd,inventory i WHERE rd.registrationNo = '$registrationNo' and rd.registrationNo = pc.registrationNo and pc.chargesCode = i.inventoryCode and (pc.title = 'MEDICINE' or pc.title = 'SUPPLIES' or pc.title = 'LABORATORY' or pc.title = 'RADIOLOGY') order by description asc ");
//}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], " SELECT pc.quantity,pc.description,pc.sellingPrice,pc.total,pc.cashUnpaid,pc.phic,pc.company,pc.itemNo FROM patientCharges pc,registrationDetails rd WHERE rd.registrationNo = '$registrationNo' and rd.registrationNo = pc.registrationNo and (pc.title = 'MEDICINE' or pc.title = 'SUPPLIES' or pc.title='LABORATORY' or pc.title = 'RADIOLOGY') order by description asc ");
//}


$this->coconutFormStart("get","updatePriceNow.php");
$this->coconutHidden("registrationNo",$registrationNo);
$this->coconutHidden("username",$username);
$this->coconutHidden("type",$type);
echo "<center>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("");
$this->coconutTableHeader("Description");
$this->coconutTableHeader("Selling Price");
$this->coconutTableHeader("QTY");
$this->coconutTableHeader("Total");
$this->coconutTableHeader("Cash");
$this->coconutTableHeader("PhilHealth");
$this->coconutTableHeader("Company");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
$this->coconutTableRowStart();
if( $status == "yes" ) {
$this->coconutTableData("<input type='checkbox' name='itemNo[]' value='".$row['itemNo']."' checked>");
}else {
$this->coconutTableData("<input type='checkbox' name='itemNo[]' value='".$row['itemNo']."' >");
}
$this->coconutTableData($row['description']);
$this->coconutTableData($row['sellingPrice']);
$this->coconutTableData($row['quantity']);
$this->coconutTableData($row['total']);
$this->coconutTableData($row['cashUnpaid']);
$this->coconutTableData($row['phic']);
$this->coconutTableData($row['company']);
$this->coconutTableRowStop();
  }
$this->coconutTableStop();  
echo "<br>";
$this->coconutButton("Update to $type Price");
$this->coconutFormStop();
}




public function radioReportInsert($registrationNo,$itemNo,$date,$physician,$radioReport,$hospitalName,$hospitalAddress,$time,$approved,$approvedDate,$approvedTime,$approvedBy,$radtech) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$sql="INSERT INTO radioSavedReport (registrationNo,itemNo,date,physician,radioReport,hospitalName,hospitalAddress,time,approved,approvedDate,approvedTime,approvedBy,performed)
VALUES
('$registrationNo','$itemNo','$date','$physician','".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $radioReport) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."','$hospitalName','$hospitalAddress','$time','$approved','$approvedDate','$approvedTime','$approvedBy','$radtech')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

//echo "<script type='text/javascript' >";
//echo "alert('$service was Successfully Added to the List of Service in $category');";
//echo  "window.location='http://".$this->getMyUrl()."/Maintenance/addService.php?username=$username'";
//echo "</script>";
((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}




public function radioHeading($hospitalName,$hospitalAddress) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$sql="INSERT INTO radioHeading (hospital,address)
VALUES
('".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $hospitalName) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."','".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $hospitalAddress) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

//echo "<script type='text/javascript' >";
//echo "alert('$service was Successfully Added to the List of Service in $category');";
//echo  "window.location='http://".$this->getMyUrl()."/Maintenance/addService.php?username=$username'";
//echo "</script>";
((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}


public function addRadioTemplate($title,$template) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$sql="INSERT INTO radioReportList (title,report)
VALUES
('".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $title) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."','".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $template) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

//echo "<script type='text/javascript' >";
//echo "alert('$service was Successfully Added to the List of Service in $category');";
//echo  "window.location='http://".$this->getMyUrl()."/Maintenance/addService.php?username=$username'";
//echo "</script>";
((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}




public function getMasterListHospitalHeading($username) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM radioHeading order by hospital asc ");

echo "
<style type='text/css'>
tr:hover { background-color:yellow;color:black;}

a { text-decoration:none; color:black; }
</style>";

echo "<center>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Hospital");
$this->coconutTableHeader("Address");
$this->coconutTableHeader("");
$this->coconutTableHeader("");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->coconutTableData($row['hospital']);
$this->coconutTableData($row['address']);

echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Results/Radiology/editHospital.php?username=$username&hospital=$row[hospital]&address=$row[address]&headingNo=$row[headingNo]'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/pencil.jpeg'></a>&nbsp;</td>";
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Results/Radiology/deleteHospital.php?headingNo=$row[headingNo]&hospital=$row[hospital]&username=$username'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/delete.jpeg'></a>&nbsp;</td>";

$this->coconutTableRowStop();
  }

$this->coconutTableStop();
}



public function getMasterListReportTemplate($username) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM radioReportList order by title asc ");

echo "
<style type='text/css'>
tr:hover { background-color:yellow;color:black;}

a { text-decoration:none; color:black; }
</style>";

echo "<center>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Title");
$this->coconutTableHeader("");
$this->coconutTableHeader("");
$this->coconutTableHeader("");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->coconutTableData($row['title']);

echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Results/Radiology/editRadioTemplate.php?username=$username&title=$row[title]&report=$row[report]&reportNo=$row[reportNo]'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/pencil.jpeg'></a>&nbsp;</td>";
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Results/Radiology/deleteTemplate.php?username=$username&reportNo=$row[reportNo]&title=$row[title]'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/delete.jpeg'></a>&nbsp;</td>";
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Results/Radiology/reportPreview.php?reportNo=$row[reportNo]' style='text-decoration:none;'><font size=2 color=red>View</font></a>&nbsp;</td>";
$this->coconutTableRowStop();
  }

$this->coconutTableStop();
}




public function getMedtechName($username) {



$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT completeName FROM registeredUser WHERE username = '$username' ");


while($row = mysqli_fetch_array($result))
  {
return $row['completeName'];
}
}

//ADD LABORATORY RESULT TEMPLATE


public function addLaboratoryTemplate($title,$template) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$sql="INSERT INTO labResultList (title,template)
VALUES
('".mysql_real_escape_String($title)."','".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $template) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }


echo "<script type='text/javascript' >";
echo "alert('$title is now Added in the list of Laboratory Result Format');";
echo  "window.location='http://".$this->getMyUrl()."/COCONUT/Laboratory/resultList/addResultForm.php '";
echo "</script>";



((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}



public function getMasterFileLaboratoryTemplate() {

echo "
<style type='text/css'>
tr:hover { background-color:yellow;color:black;}

a { text-decoration:none; color:black; }
</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT templateNo,title,template FROM labResultList order by title asc ");

echo "<br>";
echo "<Center>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Title");
$this->coconutTableHeader("");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->coconutTableData("&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Laboratory/resultList/editResultForm.php?templateNo=$row[templateNo]&title=$row[title]'>".$row['title']."</a>&nbsp;");
$this->coconutTableData(" <a href='http://".$this->getMyUrl()."/COCONUT/Laboratory/resultList/deleteTemplate.php?templateNo=$row[templateNo]'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/delete.jpeg'></a> ");
$this->coconutTableRowStop();
}
$this->coconutTableStop();
}



public function getLabFormList($username,$registrationNo,$itemNo,$chargesCode) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow;color:black;}

a { text-decoration:none; color:black; }
</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT templateNo,title,template FROM labResultList order by title asc ");

echo "<br>";
echo "<Center>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Title");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->coconutTableData("&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Laboratory/resultList/resultFormTemplate.php?username=$username&registrationNo=$registrationNo&chargesCode=$chargesCode&itemNo=$itemNo&templateNo=$row[templateNo]'>".$row['title']."</a>&nbsp;");
$this->coconutTableRowStop();
}
$this->coconutTableStop();
}


public function addLaboratoryResultChecker($registrationNo,$itemNo) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$sql="INSERT INTO core2_laboratoryResultChecker (registrationNo,itemNo)
VALUES
('$registrationNo','$itemNo')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

/*
echo "<script type='text/javascript' >";
echo "alert('$description was Successfully Added to the List of Charges in $category');";
echo  "window.location='http://".$this->getMyUrl()."/Maintenance/addCharges.php?module=$category&username=$username '";
echo "</script>";
*/


((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}


public function addLaboratoryResultInPatient($registrationNo,$itemNo,$chargesCode,$medtech,$date,$result,$time,$remarks,$morphology,$patientName) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$sql="INSERT INTO labSavedResult (registrationNo,itemNo,chargesCode,medtech,date,result,time,remarks,morphology,patientName)
VALUES
('$registrationNo','$itemNo','$chargesCode','$medtech','$date','".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $result) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."','$time','$remarks','$morphology','$patientName')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }


/*
echo "<script type='text/javascript' >";
echo "alert('$title is now Added in the list of Laboratory Result Format');";
echo  "window.location='http://".$this->getMyUrl()."/COCONUT/Laboratory/resultList/addResultForm.php '";
echo "</script>";
*/


((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}




public function addPromisorryNote($registrationNo,$amount,$note,$date,$dueDate,$username) {

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$sql="INSERT INTO promisorryNote (registrationNo,amount,note,startDate,dueDate,postedBy)
VALUES
('$registrationNo','$amount','".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $note) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."','$date','$dueDate','$username')";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }


/*
echo "<script type='text/javascript' >";
echo "alert('$title is now Added in the list of Laboratory Result Format');";
echo  "window.location='http://".$this->getMyUrl()."/COCONUT/Laboratory/resultList/addResultForm.php '";
echo "</script>";
*/


((is_null($___mysqli_res = mysqli_close($con))) ? false : $___mysqli_res);

}



public $getVoidPayments_total;

public function getVoidPayments($month,$day,$year,$month1,$day1,$year1,$type,$username) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow;color:black;}

a { text-decoration:none; color:black; }
</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$date = $year."-".$month."-".$day;
$date1 = $year1."-".$month1."-".$day1;

if( $type == "IPD" ) {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM voidPayment WHERE item like 'IPD%%%' and (dateVoid between '$date' and '$date1') order by patientName asc ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM voidPayment WHERE item not like 'IPD%%%' and (dateVoid between '$date' and '$date1') order by patientName asc ");
}


echo "<br>";
echo "<Center>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Patient");
$this->coconutTableHeader("Description");
$this->coconutTableHeader("Amount");
$this->coconutTableHeader("Time Void");
$this->coconutTableHeader("Date Void");
$this->coconutTableHeader("voidBy");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
$this->getVoidPayments_total += $row['amount'];
$px = preg_split ("/\_/", $row['patientName']); 
$this->coconutTableRowStart();
$this->coconutTableData($px[1]);
$this->coconutTableData($row['item']);
$this->coconutTableData(number_format($row['amount'],2));
$this->coconutTableData($row['timeVoid']);
$this->coconutTableData($row['dateVoid']);
$this->coconutTableData($row['voidBy']);
$this->coconutTableRowStop();
}
$this->coconutTableData("<b>Total</b>");
$this->coconutTableData("");
$this->coconutTableData(number_format($this->getVoidPayments_total,2));
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableStop();
}






public function getIndividualPayments($registrationNo,$username,$checkz,$batchNo) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow;color:black;}

a { text-decoration:none; color:black; }
</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));


if( $batchNo != "" ) {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT itemNo,description,quantity,sellingPrice,cashUnpaid,dateCharge,discount FROM patientCharges WHERE registrationNo = '$registrationNo' and batchNo = '$batchNo' and status = 'UNPAID' and (phic = 0 or company = 0) order by description asc ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT itemNo,description,quantity,sellingPrice,cashUnpaid,dateCharge,discount FROM patientCharges WHERE registrationNo = '$registrationNo' and status = 'UNPAID' and (phic = 0 or company = 0) order by description asc ");
}


echo "<br>";
echo "<Center>";
$this->coconutFormStart("get","http://".$this->getMyUrl()."/COCONUT/patientProfile/individualPayment/showSelectedMeds.php");
$this->coconutHidden("registrationNo",$registrationNo);
$this->coconutHidden("username",$username);
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Paid");
$this->coconutTableHeader("Date");
$this->coconutTableHeader("Description");
$this->coconutTableHeader("QTY");
$this->coconutTableHeader("Price");
$this->coconutTableHeader("Discount");
$this->coconutTableHeader("Total");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {

$this->coconutTableRowStart();
if( $checkz == "no" ) {
$this->coconutTableData("&nbsp;<input type=checkbox name='itemNo[]' value='".$row['itemNo']."'>");
}else {
$this->coconutTableData("&nbsp;<input type=checkbox name='itemNo[]' value='".$row['itemNo']."' checked>");
}
$this->coconutTableData($row['dateCharge']);
$this->coconutTableData($row['description']);
$this->coconutTableData($row['quantity']);
$this->coconutTableData($row['sellingPrice']);
$this->coconutTableData($row['discount']);
$this->coconutTableData($row['cashUnpaid']);
$this->coconutTableRowStop();
}
$this->coconutTableStop();
echo "<br>";
$this->coconutButton("Proceed");
$this->coconutFormStop();
}





public function getReturnMeds($registrationNo,$username) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow;color:black;}

a { text-decoration:none; color:black; }
</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));



$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT description,itemNo FROM patientCharges WHERE registrationNo = '$registrationNo' and status = 'Return' order by description asc ");



echo "<br>";
echo "<Center>";
$this->coconutFormStart("get","http://".$this->getMyUrl()."/COCONUT/patientProfile/returnMeds/returnMeds1.php");
$this->coconutHidden("registrationNo",$registrationNo);
$this->coconutHidden("username",$username);
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("");
$this->coconutTableHeader("Description");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {

$this->coconutTableRowStart();
$this->coconutTableData("&nbsp;<input type=checkbox name='itemNo[]' value='".$row['itemNo']."' checked>");
$this->coconutTableData($row['description']);
$this->coconutTableRowStop();
}
$this->coconutTableStop();
echo "<br>";
$this->coconutButton("Proceed");
$this->coconutFormStop();
}




public function getMasterListMisc($registrationNo,$username,$room,$batchNo) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow;color:black;}

a { text-decoration:none; color:black; }
</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

//$room = preg_split ("/\_/", $room); 

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT chargesCode,Description,(OPD) as sellingPrice FROM availableCharges WHERE Category = 'MISCELLANEOUS' order by Description asc ");



echo "<br>";
echo "<Center>";

$this->coconutHidden("registrationNo",$registrationNo);
$this->coconutHidden("username",$username);
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Description");
$this->coconutTableHeader("Price");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {

$this->coconutTableRowStart();
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/availableMisc/quantityMisc.php?status=UNPAID&registrationNo=$registrationNo&chargesCode=$row[chargesCode]&description=$row[Description]&sellingPrice=$row[sellingPrice]&discount=0&timeCharge=".$this->getSynapseTime()."&room=".$this->selectNow("registrationDetails","room","registrationNo",$registrationNo)."&chargeBy=$username&service=Examination&title=MISCELLANEOUS&paidVia=Cash&cashPaid=0&batchNo=$batchNo&username=$username&inventoryFrom='>".$row['Description']."</a>");
$this->coconutTableData("&nbsp;".$row['sellingPrice']."&nbsp;");
$this->coconutTableRowStop();
}
$this->coconutTableStop();
}



public $getCollectionPerDept_total;
public $getCollectionPerDept_phic;
public $getCollectionPerDept_company;

public function getCollectionPerDept($username,$month,$day,$year,$dept) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow;color:black;}

a { text-decoration:none; color:black; }
</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$date = $month."_".$day."_".$year;

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pr.lastName,pr.firstName,pc.description,pc.cashUnpaid,pc.phic,pc.company,pc.cashPaid FROM patientCharges pc,patientRecord pr,registrationDetails rd,patientPayment pp WHERE pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and rd.registrationNo = pp.registrationNo and pc.title = '$dept' and (rd.dateUnregistered = '$date') and cashUnpaid > 0 order by pr.lastName asc");



echo "<br>";
echo "<Center>";

//$this->coconutTableStart();
//$this->coconutTableRowStart();
//$this->coconutTableHeader("Patient");
//$this->coconutTableHeader("Description");
//$this->coconutTableHeader("Balance");
//$this->coconutTableHeader("PhilHealth");
//$this->coconutTableHeader("Company");
//$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
$this->getCollectionPerDept_total += $row['cashUnpaid'];
$this->getCollectionPerDept_phic += $row['phic'];
$this->getCollectionPerDept_company += $row['company'];


$this->coconutTableRowStart();
$this->coconutTableData($row['lastName'].", ".$row['firstName']);
$this->coconutTableData($row['description']);
$this->coconutTableData($row['cashUnpaid']);
$this->coconutTableData($row['phic']);
$this->coconutTableData($row['company']);
$this->coconutTableRowStop();
}
//$this->coconutTableRowStart();
//$this->coconutTableData("<b>Total</b>");
//$this->coconutTableData("");
//$this->coconutTableData(number_format($this->getCollectionPerDept_total,2));
//$this->coconutTableData(number_format($this->getCollectionPerDept_phic,2));
//$this->coconutTableData(number_format($this->getCollectionPerDept_company,2));
//$this->coconutTableRowStop();
//$this->coconutTableStop();

}




public function getCollectionPerDept1($username,$month,$day,$year,$dept) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow;color:black;}

a { text-decoration:none; color:black; }
</style>";

$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$date = $month."_".$day."_".$year;

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT pc.cashPaid,pr.lastName,pr.firstName,pc.description,pc.cashUnpaid,pc.phic,pc.company,pc.cashPaid FROM patientCharges pc,patientRecord pr,registrationDetails rd WHERE pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and pc.title = '$dept' and (pc.datePaid = '$date') order by pr.lastName asc");



echo "<br>";
echo "<Center>";

//$this->coconutTableStart();
//$this->coconutTableRowStart();
//$this->coconutTableHeader("Patient");
//$this->coconutTableHeader("Description");
//$this->coconutTableHeader("Balance");
//$this->coconutTableHeader("PhilHealth");
//$this->coconutTableHeader("Company");
//$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
$this->getCollectionPerDept_total += $row['cashPaid'];
$this->getCollectionPerDept_phic += $row['phic'];
$this->getCollectionPerDept_company += $row['company'];


$this->coconutTableRowStart();
$this->coconutTableData($row['lastName'].", ".$row['firstName']);
$this->coconutTableData($row['description']);
$this->coconutTableData($row['cashPaid']);
$this->coconutTableData($row['phic']);
$this->coconutTableData($row['company']);
$this->coconutTableRowStop();
}
//$this->coconutTableRowStart();
//$this->coconutTableData("<b>Total</b>");
//$this->coconutTableData("");
//$this->coconutTableData(number_format($this->getCollectionPerDept_total,2));
//$this->coconutTableData(number_format($this->getCollectionPerDept_phic,2));
//$this->coconutTableData(number_format($this->getCollectionPerDept_company,2));
//$this->coconutTableRowStop();
//$this->coconutTableStop();

}





public function getAnnualInventory($month,$year,$description,$inventoryCode,$type) {


$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(pc.quantity) as totalQTY FROM patientCharges pc,registrationDetails rd WHERE rd.registrationNo = pc.registrationNo and pc.dateCharge like '$year-$month%%%' and pc.departmentStatus like 'dispensedBy%%%%%%' and pc.description = '$description' and pc.chargesCode = '$inventoryCode' and rd.type='$type'  ");

while($row = mysqli_fetch_array($result))
  {
return $row['totalQTY'];
  }

}



public function getDeletedMeds($batchNo,$registrationNo) {


$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

if( $batchNo != "" ) {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT status,description,quantity from patientCharges WHERE registrationNo='$registrationNo' and dispensedNo = '$batchNo' and status like 'DELETED%%%%%' ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT status,description,quantity from patientCharges WHERE registrationNo='$registrationNo' and status like 'DELETED%%%%%' ");
}


while($row = mysqli_fetch_array($result))
  {
echo "<tr>";
echo "<td>&nbsp;<Font color=red>".$row['description']."</font></tD>";
echo "<td>&nbsp;<font color=red>".$row['quantity']."</font></tD>";
echo "<Td>&nbsp;<font color=red>".$row['status']."</font></tD>";
echo "<td>&nbsp;</tD>";
echo "</tr>";
  }

}


public function getBatchMeds($registrationNo,$dispensedNo) {


$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT status,description,quantity,chargeBy,departmentStatus FROM patientCharges pc WHERE pc.registrationNo = '$registrationNo' and pc.dispensedNo = '$dispensedNo' and (title = 'MEDICINE' or title = 'SUPPLIES') and status not like 'DELETED_%%%%%%' order by description  ");

echo "<table border=1 cellpadding=1 cellspacing=0>";
echo "<tr>";
echo "<th>Particulars</th>";
echo "<th>QTY</th>";
echo "<th>Requested</th>";
echo "<th>Dispensed</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {
$deptStat = preg_split ("/\_/", $row['departmentStatus']); 
echo "<tr>";
if( $row['status'] == "PAID" ) {
echo "<td><b>(Pd)</b>".$row['description']."</td>";
}else if( $row['status'] == "Return" ) {
echo "<td><b>(R)</b>".$row['description']."</td>";
}
else {
echo "<td>&nbsp;".$row['description']."</td>";
}
echo "<td>&nbsp;".$row['quantity']."</td>";
echo "<td>&nbsp;".$row['chargeBy']."</td>";
echo "<td>&nbsp;".$deptStat[1]."</tD>";
echo "</tr>";
  }
echo "<Tr>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "</tr>";
$this->getDeletedMeds($dispensedNo,$registrationNo);
echo "</table>";

}



public function getTotal_paidVia($registrationNo,$paidVia) {


$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum($paidVia) as total FROM patientCharges where registrationNo = '$registrationNo'  ");

while($row = mysqli_fetch_array($result))
  {
return $row['total'];
  }

}


public function showVoucherList($month,$day,$year,$month1,$day1,$year1,$show) {


$con = ($GLOBALS["___mysqli_ston"] = mysqli_connect($this->host, $this->username, $this->password));
if (!$con)
  {
  die('Could not connect: ' . ((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false)));
  }

((bool)mysqli_query( $con, "USE " . $this->database));

$date = $month."_".$day."_".$year;
$date1 =$month1."_".$day1."_".$year1;

if( $show == "admin" ) {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT controlNo,checkedNo,payee,amount,date FROM vouchers WHERE (date between '$date' and '$date1') and checkedNo != '' order by date,description ");
}else {
$result = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT controlNo,checkedNo,payee,amount,date FROM vouchers WHERE (date between '$date' and '$date1') and checkedNo = '' and user = 'cris' order by date,description ");
}


echo "<Br><Br><center>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Check#");
$this->coconutTableHeader("Payee");
$this->coconutTableHeader("amount");
$this->coconutTableHeader("date");
$this->coconutTableHeader("");
$this->coconutTableHeader("");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/accounting/voucher/printableVoucher.php?checkedNo=$row[checkedNo]' style='text-decoration:none; color:black;' target='_blank'>".$row['checkedNo']."</a>");
$this->coconutTableData($row['payee']);
$this->coconutTableData($row['amount']);
$this->coconutTableData($row['date']);
$this->coconutTableData(" <a href='http://".$this->getMyUrl()."/COCONUT/accounting/voucher/editVoucher.php?controlNo=$row[controlNo]'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/pencil.jpeg'></a> ");
$this->coconutTableData(" <a href='http://".$this->getMyUrl()."/COCONUT/accounting/voucher/deleteVoucher.php?controlNo=$row[controlNo]'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/delete.jpeg'></a> ");
$this->coconutTableRowStop();
  }
$this->coconutTableStop();

}


public $clinicalCoverSheet_atteding_no;

public function clinicalCoverSheet_atteding($registrationNo) {

echo "
<style type='text/css'>

.attendingPhy {
border-color:transparent transparent black transparent;
font-size:17px;
width:76%;
}

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " SELECT description from patientCharges where registrationNo = '$registrationNo' and title = 'PROFESSIONAL FEE' and service = 'ATTENDING'  ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
  {

$this->clinicalCoverSheet_atteding_no++;

echo "<tr>";
if( $this->clinicalCoverSheet_atteding_no != 1 ) {
echo "<td><font color='white'>Attending Physician:</font><input type='text' value='".$row['description']."' class='attendingPhy'> </td>";
}else {
echo "<td>Attending Physician: <input type='text' value='".$row['description']."' class='attendingPhy'> </td>";
}
echo "</tr>";
}

}



public function clinicalCoverSheet_finalDiagnosis($registrationNo) {

echo "
<style type='text/css'>

.attendingPhy {
border-color:transparent transparent black transparent;
font-size:17px;
width:76%;
}

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " SELECT diagnosis from patientICD where registrationNo = '$registrationNo'  ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
  {

$result_array[] = $row['diagnosis'];

}
return implode(",",$result_array);
}




public function clinicalCoverSheet_icdCode($registrationNo) {

echo "
<style type='text/css'>

.attendingPhy {
border-color:transparent transparent black transparent;
font-size:17px;
width:76%;
}

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " SELECT icdCode from patientICD where registrationNo = '$registrationNo'  ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
  {

$result_array[] = $row['icdCode'];

}
return implode(",",$result_array);
}




}


?>
