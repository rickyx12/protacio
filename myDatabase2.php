<?php
include("myDatabase1.php");

class database2 extends database1 {


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

function ENCRYPT_DECRYPT($Str_Message) {
    $Len_Str_Message=STRLEN($Str_Message);
    $Str_Encrypted_Message="";
    FOR ($Position = 0;$Position<$Len_Str_Message;$Position++){
        // long code of the function to explain the algoritm
        //this function can be tailored by the programmer modifyng the formula
        //to calculate the key to use for every character in the string.
        $Key_To_Use = (($Len_Str_Message+$Position)*230); // (+5 or *3 or ^2)

        //after that we need a module division because can´t be greater than 255
        //$Key_To_Use = (255+$Key_To_Use) % 255;
	$Key_To_Use = (168+$Key_To_Use) % 168;

        $Byte_To_Be_Encrypted = SUBSTR($Str_Message, $Position, 1);
        $Ascii_Num_Byte_To_Encrypt = ORD($Byte_To_Be_Encrypted);
        $Xored_Byte = $Ascii_Num_Byte_To_Encrypt ^ $Key_To_Use;  //xor operation
        $Encrypted_Byte = CHR($Xored_Byte);
        $Str_Encrypted_Message .= $Encrypted_Byte;
       
        //short code of  the function once explained
        //$str_encrypted_message .= chr((ord(substr($str_message, $position, 1))) ^ ((255+(($len_str_message+$position)+1)) % 255));
    }
    RETURN $Str_Encrypted_Message;
}


public function formatDate($date) {
  $date1 = preg_split ("/\-/", $date); 
  $month = ['01'=>'Jan','02'=>'Feb','03'=>'Mar','04'=>'Apr','05'=>'May','06'=>'Jun','07'=>'Jul','08'=>'Aug','09'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dec'];
  return $month[$date1[1]]." ".$date1[2].", ".$date1[0];
}



//********************** LAB RESULT **************************//

public function listLaboratory_done($month,$day,$year) {

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";

$date = $year."-".$month."-".$day;


$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$result = mysql_query("SELECT referred,savedNo,registrationNo,itemNo,chargesCode,medtech,date,time FROM labSavedResult WHERE date = '$date' and status not like 'DELETED_%%%%%%%%%%' order by time desc ");
//echo "<table border=1 cellspacing=0 rules=all>";
//echo "<tr>";
//echo "<Th>Patient</th>";
//echo "<Th>Result</th>";
//echo "<th>Realesed</th>";
//echo "</tr>";
while($row = mysql_fetch_array($result))
  {
$this->getPatientProfile($row['registrationNo']);
echo "<tr>";
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Laboratory/testDone/referredUser.php?savedNo=$row[savedNo]'><font size=2>".$this->getPatientRecord_lastName().", ".$this->getPatientRecord_firstName()."</font></a></td>";

if($row['referred'] != "") {
echo "<td>&nbsp;<font size=2>".$this->selectNow("patientCharges","description","itemNo",$row['itemNo'])."</font><br>&nbsp;<Font size=1 color=red>(Referred)</font></td>";
}else {
echo "<td>&nbsp;<font size=2>".$this->selectNow("patientCharges","description","itemNo",$row['itemNo'])."</font></td>";
}

echo "<td>&nbsp;<font size=2>".$row['time']."</font></td>";
echo "<Td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Laboratory/resultList/resultForm_output.php?registrationNo=$row[registrationNo]&itemNo=$row[itemNo]' target='_blank'><font size=2 color=red>View</font></a>&nbsp;</td>";
echo "</tr>";

  }
//echo "</table>";

}




public function listLaboratory_done_search($month,$day,$year,$name) {

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";

$date = $year."-".$month."-".$day;


$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$result = mysql_query("SELECT lsr.referred,lsr.savedNo,lsr.registrationNo,lsr.itemNo,lsr.chargesCode,lsr.medtech,lsr.date,lsr.time FROM labSavedResult lsr,patientRecord pr,registrationDetails rd,patientCharges pc WHERE pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and pc.itemNo = lsr.itemNo and lsr.date = '$date' and pr.completeName like '".mysql_real_escape_string($name)."%%%%%' order by lsr.time desc ");
//echo "<table border=1 cellspacing=0 rules=all>";
//echo "<tr>";
//echo "<Th>Patient</th>";
//echo "<Th>Result</th>";
//echo "<th>Realesed</th>";
//echo "</tr>";
while($row = mysql_fetch_array($result))
  {
$this->getPatientProfile($row['registrationNo']);
echo "<tr>";
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Laboratory/testDone/referredUser.php?savedNo=$row[savedNo]'><font size=2>".$this->getPatientRecord_lastName().", ".$this->getPatientRecord_firstName()."</font></a></td>";

if($row['referred'] != "") {
echo "<td>&nbsp;<font size=2>".$this->selectNow("patientCharges","description","itemNo",$row['itemNo'])."</font><br>&nbsp;<Font size=1 color=red>(Referred)</font></td>";
}else {
echo "<td>&nbsp;<font size=2>".$this->selectNow("patientCharges","description","itemNo",$row['itemNo'])."</font></td>";
}

echo "<td>&nbsp;<font size=2>".$row['time']."</font></td>";
echo "<Td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Laboratory/resultList/resultForm_output.php?registrationNo=$row[registrationNo]&itemNo=$row[itemNo]' target='_blank'><font size=2 color=red>View</font></a>&nbsp;</td>";
echo "</tr>";

  }
//echo "</table>";

}



//**************** END OF LAB RESULT **********************************//



public function getPatientCharges_paid($registrationNo,$username,$show,$desc) {

$this->getPatientProfile($registrationNo);

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

.data {
font-size:12px;
}
</style>";

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

if($show == "All") {
$result = mysql_query("SELECT * FROM patientCharges where registrationNo = '$registrationNo' and (cashPaid > 0 or amountPaidFromCreditCard > 0)  and status in ('PAID','UNPAID') order by dateCharge,timeCharge desc ");
}else {
$result = mysql_query("SELECT * FROM patientCharges where registrationNo = '$registrationNo' and (cashPaid > 0 or amountPaidFromCreditCard > 0) and status in ('PAID','UNPAID') and description like '$desc%%%%%%' order by description asc ");
}


while($row = mysql_fetch_array($result))
  {
//$this->getMyResults($this->getResult_labNo($row['itemNo']),$username);
//$price = preg_split ("/\//", $row['sellingPrice']); 
$deptStatus = preg_split ("/\_/", $row['departmentStatus']); 
echo "<tr>";

/*********STRPOS*************/
if (strpos($row['sellingPrice'],'/') !== false) {
$price = preg_split ("/\//", $row['sellingPrice']); 
}else { 
$price[0] = $row['sellingPrice'];
$price[1] = "0.00";
} 
/***************************/

$this->patientChargez_cashUnpaid+=$row['cashUnpaid'];
$this->patientChargez_company+=$row['company'];
$this->patientChargez_phic+=$row['phic'];
$this->patientChargez_disc+=$row['discount'];
$this->patientChargez_total+=$row['total'];
$this->patientChargez_paid+=$row['cashPaid'];

$myDesc = $this->getPatientRecord_lastName().", ".$this->getPatientRecord_firstName()." - ".$row['description'];

echo "<Td>&nbsp;<img src='http://".$this->getMyUrl()."/COCONUT/myImages/locked1.jpeg' />&nbsp;</tD>";

if($deptStatus[0] == "dispensedBy") {
echo "<td>&nbsp;<font class='data'><a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/editCharges.php?itemNo=$row[itemNo]&username=$username&show=$show&desc=$desc'>".$row['description']." &nbsp;(<font size=1 color=red>Dispensed @ $row[departmentStatus_time] by $deptStatus[1] </font>)</a></font>&nbsp;</td>";
}else if($this->checkIfLabResultExist($row['itemNo']) > 0 && $row['title'] == "LABORATORY" ) {

if($this->checkIfLabResultExist($row['itemNo']) > 0) {

echo "<td>&nbsp;<font class='data'><a href='#'>".$row['description']."</a><br>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Laboratory/resultList/resultForm_output.php?registrationNo=$row[registrationNo]&itemNo=$row[itemNo]'>(<font color=red size=1>Test Done</font>)</font></a>&nbsp;</td>";


}else {
echo "<td>&nbsp;<font class='data'><a href='http://".$this->getMyUrl()."/COCONUT/Laboratory/resultList/resultList.php?registrationNo=$row[registrationNo]&username=$username&chargesCode=$row[chargesCode]&itemNo=$row[itemNo]'>".$row['description']."</a></font>&nbsp;</td>";
}

}else if($this->checkIfRadResultExist($row['itemNo']) > 0 && $row['title'] == "RADIOLOGY" ) {
echo "<td>&nbsp;<font class='data'><a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/editCharges.php?itemNo=$row[itemNo]&username=$username&show=$show&desc=$desc'>".$row['description']."</a><br>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Reports/radiologyReport/radioReport_output.php?itemNo=$row[itemNo]&registrationNo=$row[registrationNo]&description=$row[description]'>(<font color=red size=1>Test Done</font>)</font></a>&nbsp;</td>";
}else if($this->checkIfSoapExist($row['itemNo']) > 0 && $row['title'] == "PROFESSIONAL FEE" ) {
echo "<td>&nbsp;<font class='data'><a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/editCharges.php?itemNo=$row[itemNo]&username=$username&show=$show&desc=$desc'>".$row['description']."</a><br>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Doctor/doctorModule/soapView.php?itemNo=$row[itemNo]&registrationNo=$row[registrationNo]&username=$username'>(<font color=red size=1>S.O.A.P</font>)</font></a>&nbsp;</td>";
}

else if( $this->selectNow("registrationDetails","mgh","registrationNo",$row['registrationNo']) != "") {
echo "<td>&nbsp;<font class='data'><a href='#'>".$row['description']."</a></font>&nbsp;</td>";
}

else  {
echo "<td>&nbsp;<font class='data'><a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/editCharges.php?itemNo=$row[itemNo]&username=$username&show=$show&desc=$desc'>".$row['description']."</a></font>&nbsp;</td>";
}


if($row['title']=="PROFESSIONAL FEE") {
echo "<td><font class='data'>".number_format($price[0],2)."</font>/<font class='data'>".$price[1]."</font>&nbsp;</td>";
}else if( $row['title'] == "MEDICINE" || $row['title'] == "SUPPLIES"  ) {

if( $this->selectNow("registeredUser","module","username",$username) == "PHILHEALTH" || $this->selectNow("registeredUser","module","username",$username) == "HMO" || $this->selectNow("registeredUser","module","username",$username) == "PHARMACY" || $this->selectNow("registeredUser","module","username",$username) == "BILLING" || $this->selectNow("registeredUser","module","username",$username) == "CASHIER" ) { //allowed to view the price
echo "<td><font class='data'>".number_format($row['sellingPrice'],2)."</font>&nbsp;</td>";
}else { // not allowed to view the price
echo "<td><font size=2 color=red>Confidential</font></td>";
}

}
else {
echo "<td><font class='data'>".number_format($row['sellingPrice'],2)."</font>&nbsp;</td>";
}

echo "<td>&nbsp;<font class='data'>".$row['quantity']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['discount']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".number_format($row['total'],2)."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['timeCharge']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['dateCharge']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['chargeBy']."</font>&nbsp;</td>";

if($row['inventoryFrom'] != "none") {
echo "<td>&nbsp;<font class='data'>".$row['service']."</font><br><font class='data'>".$row['inventoryFrom']."</font>&nbsp;</td>";
}else if($row['inventoryFrom'] == "") {
echo "<td>&nbsp;<font class='data'>".$row['service']."</font>&nbsp;</td>";
}else if($row['title'] == "LABORATORY") {

if( $this->checkIfLabResultExist($row['itemNo']) > 0 ) {
echo "<td>&nbsp;<a href='#'><font class='data'>".$row['service']."</font></a>&nbsp;</td>";
}else {
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Laboratory/resultList/resultList.php?itemNo=$row[itemNo]&registrationNo=$row[registrationNo]&chargesCode=$row[chargesCode]&username=$username'><font class='data'>".$row['service']."</font></a>&nbsp;</td>";
}

}else if($row['title'] == "RADIOLOGY") {
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Reports/radiologyReport/radioReportSettings.php?description=$row[description]&registrationNo=$registrationNo&itemNo=$row[itemNo]&branch=$row[branch]'><font class='data'>".$row['service']."</font></a>&nbsp;</td>";
}else if($row['title'] == "PROFESSIONAL FEE") {
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Doctor/doctorModule/soap.php?registrationNo=$registrationNo&itemNo=$row[itemNo]&username=$username'><font class='data'>".$row['service']."</font></a>&nbsp;</td>";
}else {
echo "<td>&nbsp;<font class='data'>".$row['service']."</font>&nbsp;</td>";
}

if($row['status']=="PAID" ) {
echo "<td>&nbsp;<font class='data' color=blue>".$row['status']."</font>&nbsp;</td>";
}else {
echo "<td>&nbsp;<font class='data'>".$row['status']."</font>&nbsp;</td>";
}

if( $row['paidVia'] == "Cash" ) {
echo "<td>&nbsp;<font class='data' color=red>".$row['paidVia']."</font>&nbsp;</td>";
}else {
echo "<td><font class='data' color=red>".$row['paidVia']."</font><br><font class='data' color='blue'>(".$row['cardType'].")</font></td>";
}

echo "<td>&nbsp;<center><font class='data'>".number_format($row['cashUnpaid'],2)."</font></centeR>&nbsp;</td>";
echo "<td>&nbsp;<center><font class='data'>".number_format($row['company'],2)."</font></center>&nbsp;</td>";
echo "<td>&nbsp;<center><font class='data'>".number_format($row['phic'],2)."</font></center>&nbsp;</td>";



if( $row['paidVia'] == "Cash" ) {
echo "<td>&nbsp;<font class='data'>".$row['cashPaid']."</font><bR><font size=1 color=red>OR#:".$row['orNO']."</font>&nbsp;</td>";
}else {
echo "<td>&nbsp;<font class='data'>".$row['amountPaidFromCreditCard']."</font>&nbsp;</td>";
}
echo "<td>&nbsp;<font class='data'>".$row['branch']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['title']."</font>&nbsp;</td>";
echo "</tr>";
  }


//row after looping d2 ippkta ung total ng "balance","Company","hmo"
echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td><center><b>TOTAL</b></center></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";

if( $this->selectNow("registeredUser","module","username",$username) == "PHILHEALTH" || $this->selectNow("registeredUser","module","username",$username) == "HMO" || $this->selectNow("registeredUser","module","username",$username) == "PHARMACY" || $this->selectNow("registeredUser","module","username",$username) == "CASHIER" || $this->selectNow("registeredUser","module","username",$username) == "BILLING" ) {
echo "<td><center><font class='data' color=red>".number_format($this->patientChargez_disc,2)."</center></td>";
echo "<td><center><font class='data' color=red>".number_format($this->patientChargez_total,2)."</center></td>";
}else {
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
}

echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";

if( $this->selectNow("registeredUser","module","username",$username) == "PHILHEALTH" || $this->selectNow("registeredUser","module","username",$username) == "HMO" || $this->selectNow("registeredUser","module","username",$username) == "PHARMACY" || $this->selectNow("registeredUser","module","username",$username) == "CASHIER" || $this->selectNow("registeredUser","module","username",$username) == "BILLING" ) {

echo "<td><center><font class='data' color=red>".number_format($this->patientChargez_cashUnpaid,2)."</center></td>";
echo "<td><center><font class='data' color=red>".number_format($this->patientChargez_company,2)."</center></td>";
echo "<td><center><font class='data' color=red>".number_format($this->patientChargez_phic,2)."</center></td>";
echo "<td><center><font class='data' color=red>".number_format($this->patientChargez_paid,2)."</center></td>";
}else {
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";

}

echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";


}


/**************************************************************************************/

public function getPatientCharges_noDialysis($registrationNo,$username,$show,$desc) {

$this->getPatientProfile($registrationNo);

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

.data {
font-size:12px;
}
</style>";

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);


$result = mysql_query("SELECT * FROM patientCharges where registrationNo = '$registrationNo' and (title = 'MEDICINE' or title = 'SUPPLIES' or title = 'LABORATORY' or title = 'RADIOLOGY' or title = 'ECG' or title = 'NURSING-CHARGES' or title = 'MISCELLANEOUS' or title = 'OR/DR/ER FEE' or title = 'REHAB' or title = 'OXYGEN' or title='NBS') order by dateCharge,timeCharge asc ");



while($row = mysql_fetch_array($result))
  {
//$this->getMyResults($this->getResult_labNo($row['itemNo']),$username);
//$price = preg_split ("/\//", $row['sellingPrice']); 
$deptStatus = preg_split ("/\_/", $row['departmentStatus']); 
echo "<tr>";

/*********STRPOS*************/
if (strpos($row['sellingPrice'],'/') !== false) {
$price = preg_split ("/\//", $row['sellingPrice']); 
}else { 
$price[0] = $row['sellingPrice'];
$price[1] = "0.00";
} 
/***************************/

$this->patientChargez_cashUnpaid+=$row['cashUnpaid'];
$this->patientChargez_company+=$row['company'];
$this->patientChargez_phic+=$row['phic'];
$this->patientChargez_disc+=$row['discount'];
$this->patientChargez_total+=$row['total'];
$this->patientChargez_paid+=$row['cashPaid'];

$myDesc = $this->getPatientRecord_lastName().", ".$this->getPatientRecord_firstName()." - ".$row['description'];
if( $this->selectNow("forDeletion","itemNo","itemNo",$row['itemNo']) > 0 ) {
echo "<Td>&nbsp;<img src='http://".$this->getMyUrl()."/COCONUT/myImages/locked1.jpeg' />&nbsp;</tD>";
}else if( $row['title'] == "Room And Board" ) {
echo "<Td>&nbsp;<img src='http://".$this->getMyUrl()."/COCONUT/myImages/locked1.jpeg' />&nbsp;</tD>";
}else if( $row['batchNo'] == "package" ) {
echo "<Td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/verifyDelete_pass.php?registrationNo=$registrationNo&itemNo=$row[itemNo]&description=$myDesc&quantity=$row[quantity]&username=$username&show=$show&desc=$desc'><font size=2 color=red>Px</font></a>&nbsp;</tD>";
}else if( $this->selectNow("registrationDetails","mgh","registrationNo",$row['registrationNo']) != "") {
echo "<Td>&nbsp;<font size=2 color=red>MGH</font>&nbsp;</tD>";
}else if( $row['status'] == "Return" ) {
echo "<Td>&nbsp;<img src='http://".$this->getMyUrl()."/COCONUT/myImages/locked1.jpeg' />&nbsp;</tD>";
}
else {
//$myDesc = $this->getPatientRecord_lastName().", ".$this->getPatientRecord_firstName()." - ".$row['description'];
echo "<td><a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/verifyDelete_pass.php?registrationNo=$registrationNo&itemNo=$row[itemNo]&description=$myDesc&quantity=$row[quantity]&username=$username&show=$show&desc=$desc'>
<img src='http://".$this->getMyUrl()."/COCONUT/myImages/delete.jpeg' />
</a></td>";
}


if($deptStatus[0] == "dispensedBy") {
echo "<td>&nbsp;<font class='data'><a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/editCharges.php?itemNo=$row[itemNo]&username=$username&show=$show&desc=$desc'>".$row['description']." &nbsp;(<font size=1 color=red>Dispensed @ $row[departmentStatus_time] by $deptStatus[1] </font>)</a></font>&nbsp;</td>";
}else if($this->checkIfLabResultExist($row['itemNo']) > 0 && $row['title'] == "LABORATORY" ) {

if($this->checkIfLabResultExist($row['itemNo']) > 0) {

echo "<td>&nbsp;<font class='data'><a href='#'>".$row['description']."</a><br>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Laboratory/resultList/resultForm_output.php?registrationNo=$row[registrationNo]&itemNo=$row[itemNo]'>(<font color=red size=1>Test Done</font>)</font></a>&nbsp;</td>";


}else {
echo "<td>&nbsp;<font class='data'><a href='http://".$this->getMyUrl()."/COCONUT/Laboratory/resultList/resultList.php?registrationNo=$row[registrationNo]&username=$username&chargesCode=$row[chargesCode]&itemNo=$row[itemNo]'>".$row['description']."</a></font>&nbsp;</td>";
}

}else if($this->checkIfRadResultExist($row['itemNo']) > 0 && $row['title'] == "RADIOLOGY" ) {
echo "<td>&nbsp;<font class='data'><a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/editCharges.php?itemNo=$row[itemNo]&username=$username&show=$show&desc=$desc'>".$row['description']."</a><br>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Reports/radiologyReport/radioReport_output.php?itemNo=$row[itemNo]&registrationNo=$row[registrationNo]&description=$row[description]'>(<font color=red size=1>Test Done</font>)</font></a>&nbsp;</td>";
}else if($this->checkIfSoapExist($row['itemNo']) > 0 && $row['title'] == "PROFESSIONAL FEE" ) {
echo "<td>&nbsp;<font class='data'><a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/editCharges.php?itemNo=$row[itemNo]&username=$username&show=$show&desc=$desc'>".$row['description']."</a><br>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Doctor/doctorModule/soapView.php?itemNo=$row[itemNo]&registrationNo=$row[registrationNo]&username=$username'>(<font color=red size=1>S.O.A.P</font>)</font></a>&nbsp;</td>";
}

else if( $this->selectNow("registrationDetails","mgh","registrationNo",$row['registrationNo']) != "") {
echo "<td>&nbsp;<font class='data'><a href='#'>".$row['description']."</a></font>&nbsp;</td>";
}

else  {
echo "<td>&nbsp;<font class='data'><a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/editCharges.php?itemNo=$row[itemNo]&username=$username&show=$show&desc=$desc'>".$row['description']."</a></font>&nbsp;</td>";
}


if($row['title']=="PROFESSIONAL FEE") {
echo "<td><font class='data'>".number_format($price[0],2)."</font>/<font class='data'>".$price[1]."</font>&nbsp;</td>";
}else if( $row['title'] == "MEDICINE" || $row['title'] == "SUPPLIES"  ) {

if( $this->selectNow("registeredUser","module","username",$username) == "PHILHEALTH" || $this->selectNow("registeredUser","module","username",$username) == "HMO" || $this->selectNow("registeredUser","module","username",$username) == "PHARMACY" || $this->selectNow("registeredUser","module","username",$username) == "BILLING" || $this->selectNow("registeredUser","module","username",$username) == "CASHIER" ) { //allowed to view the price
echo "<td><font class='data'>".number_format($row['sellingPrice'],2)."</font>&nbsp;</td>";
}else { // not allowed to view the price
echo "<td><font size=2 color=red>Confidential</font></td>";
}

}
else {
echo "<td><font class='data'>".number_format($row['sellingPrice'],2)."</font>&nbsp;</td>";
}

echo "<td>&nbsp;<font class='data'>".$row['quantity']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['discount']."</font>&nbsp;</td>";


if( $row['title'] == "MEDICINE" || $row['title'] == "SUPPLIES" ) {

if( $this->selectNow("registeredUser","module","username",$username) == "PHILHEALTH" || $this->selectNow("registeredUser","module","username",$username) == "HMO" || $this->selectNow("registeredUser","module","username",$username) == "BILLING" || $this->selectNow("registeredUser","module","username",$username) == "CASHIER" || $this->selectNow("registeredUser","module","username",$username) == "PHARMACY" ) { //allowed to view the price
echo "<td>&nbsp;<font class='data'>".number_format($row['total'],2)."</font>&nbsp;</td>";
}else { //not allowed to view the price
echo "<td><font size=2 color=red>Confidential</font></td>";
}

}else {
echo "<td>&nbsp;<font class='data'>".number_format($row['total'],2)."</font>&nbsp;</td>";
}

echo "<td>&nbsp;<font class='data'>".$row['timeCharge']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['dateCharge']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['chargeBy']."</font>&nbsp;</td>";

if($row['inventoryFrom'] != "none") {
echo "<td>&nbsp;<font class='data'>".$row['service']."</font><br><font class='data'>".$row['inventoryFrom']."</font>&nbsp;</td>";
}else if($row['inventoryFrom'] == "") {
echo "<td>&nbsp;<font class='data'>".$row['service']."</font>&nbsp;</td>";
}else if($row['title'] == "LABORATORY") {
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Results/addResults.php?description=$row[description]&registrationNo=$registrationNo&itemNo=$row[itemNo]&branch=$row[branch]'><font class='data'>".$row['service']."</font></a>&nbsp;</td>";
}else if($row['title'] == "RADIOLOGY") {
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Reports/radiologyReport/radioReportSettings.php?description=$row[description]&registrationNo=$registrationNo&itemNo=$row[itemNo]&branch=$row[branch]'><font class='data'>".$row['service']."</font></a>&nbsp;</td>";
}else if($row['title'] == "PROFESSIONAL FEE") {
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Doctor/doctorModule/soap.php?registrationNo=$registrationNo&itemNo=$row[itemNo]&username=$username'><font class='data'>".$row['service']."</font></a>&nbsp;</td>";
}else {
echo "<td>&nbsp;<font class='data'>".$row['service']."</font>&nbsp;</td>";
}

if($row['status']=="PAID" ) {
echo "<td>&nbsp;<font class='data' color=blue>".$row['status']."</font>&nbsp;</td>";
}
else if($row['status']=="BALANCE" || $row['status']=="APPROVED") {
echo "<td>&nbsp;<font class='data' color=red>".$row['status']."</font>&nbsp;</td>";
}
else {
echo "<td>&nbsp;<font class='data'>".$row['status']."</font>&nbsp;</td>";
}
if($row['paidVia']=="Company") {
echo "<td>&nbsp;<font class='data' color=red>".$row['paidVia']."</font>&nbsp;</td>";
}else {
echo "<td>&nbsp;<font class='data' color=blue>".$row['paidVia']."</font>&nbsp;</td>";
}


if($row['title'] == "PROFESSIONAL FEE") {
echo "<td>&nbsp;<center><font class='data'>".number_format($row['cashUnpaid'],2)."</font></centeR>&nbsp;</td>";
}else if( $row['title'] == "MEDICINE" || $row['title'] == "SUPPLIES" ) {

if( $this->selectNow("registeredUser","module","username",$username) == "PHILHEALTH" || $this->selectNow("registeredUser","module","username",$username) == "HMO" || $this->selectNow("registeredUser","module","username",$username) == "BILLING" || $this->selectNow("registeredUser","module","username",$username) == "CASHIER" || $this->selectNow("registeredUser","module","username",$username) == "PHARMACY"  ) { //allowed to view the price
echo "<td>&nbsp;<center><font class='data'>".number_format($row['cashUnpaid'],2)."</font></centeR>&nbsp;</td>";
}else { // not allowed to view the price
echo "<td> <font size=2 color=red>Confidential</font></td>";
}

}else {
echo "<td>&nbsp;<center><font class='data'>".number_format($row['cashUnpaid'],2)."</font></centeR>&nbsp;</td>";
}


if( $row['title'] == "MEDICINE" || $row['title'] == "SUPPLIES" ) {

if( $this->selectNow("registeredUser","module","username",$username) == "PHILHEALTH" || $this->selectNow("registeredUser","module","username",$username) == "HMO" || $this->selectNow("registeredUser","module","username",$username) == "PHARMACY" || $this->selectNow("registeredUser","module","username",$username) == "CASHIER" || $this->selectNow("registeredUser","module","username",$username) == "BILLING" ) {
echo "<td>&nbsp;<center><font class='data'>".number_format($row['company'],2)."</font></center>&nbsp;</td>";
echo "<td>&nbsp;<center><font class='data'>".number_format($row['phic'],2)."</font></center>&nbsp;</td>";
}else {
echo "<td><font size=2 color=red>Confidential</font></td>";
echo "<td><font size=2 color=red>Confidential</font></td>";
}
}else {

echo "<td>&nbsp;<center><font class='data'>".number_format($row['company'],2)."</font></center>&nbsp;</td>";
echo "<td>&nbsp;<center><font class='data'>".number_format($row['phic'],2)."</font></center>&nbsp;</td>";

}

if($this->checkBalanceItem($row['itemNo']) > 0 ) {
echo "<td>&nbsp;<font class='data'>".number_format(($row['cashPaid'] + $this->getBalancePaid($row['itemNo'])),2)."</font>&nbsp;</td>";
}else {
echo "<td>&nbsp;<font class='data'>".$row['cashPaid']."</font>&nbsp;</td>";
}
echo "<td>&nbsp;<font class='data'>".$row['branch']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font class='data'>".$row['title']."</font>&nbsp;</td>";
echo "</tr>";
  }


//row after looping d2 ippkta ung total ng "balance","Company","hmo"
echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td><center><b>TOTAL</b></center></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";

if( $this->selectNow("registeredUser","module","username",$username) == "PHILHEALTH" || $this->selectNow("registeredUser","module","username",$username) == "HMO" || $this->selectNow("registeredUser","module","username",$username) == "PHARMACY" || $this->selectNow("registeredUser","module","username",$username) == "CASHIER" || $this->selectNow("registeredUser","module","username",$username) == "BILLING" ) {
echo "<td><center><font class='data' color=red>".number_format($this->patientChargez_disc,2)."</center></td>";
echo "<td><center><font class='data' color=red>".number_format($this->patientChargez_total,2)."</center></td>";
}else {
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
}

echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";

if( $this->selectNow("registeredUser","module","username",$username) == "PHILHEALTH" || $this->selectNow("registeredUser","module","username",$username) == "HMO" || $this->selectNow("registeredUser","module","username",$username) == "PHARMACY" || $this->selectNow("registeredUser","module","username",$username) == "CASHIER" || $this->selectNow("registeredUser","module","username",$username) == "BILLING" ) {

echo "<td><center><font class='data' color=red>".number_format($this->patientChargez_cashUnpaid,2)."</center></td>";
echo "<td><center><font class='data' color=red>".number_format($this->patientChargez_company,2)."</center></td>";
echo "<td><center><font class='data' color=red>".number_format($this->patientChargez_phic,2)."</center></td>";
echo "<td><center><font class='data' color=red>".number_format($this->patientChargez_paid,2)."</center></td>";
}else {
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";

}

echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";


}

/*************************************************************************************/









public $getDoctorsFee_atteding_total;
public $getDoctorsFee_atteding_cashUnpaid;
public $getDoctorsFee_atteding_phic;
public $getDoctorsFee_atteding_company;
public $getDoctorsFee_atteding_cashPaid;

public function getDoctorsFee_atteding_total() {
return $this->getDoctorsFee_atteding_total;
}
public function getDoctorsFee_atteding_cashUnpaid() {
return $this->getDoctorsFee_atteding_cashUnpaid;
}
public function getDoctorsFee_atteding_phic() {
return $this->getDoctorsFee_atteding_phic;
}
public function getDoctorsFee_atteding_company() {
return $this->getDoctorsFee_atteding_company;
}
public function getDoctorsFee_atteding_cashPaid() {
return $this->getDoctorsFee_atteding_cashPaid;
}

public function getDoctorsFee_attending($registrationNo) {

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$result = mysql_query("SELECT cashPaid,status,total,cashUnpaid,phic,company FROM patientCharges WHERE registrationNo='$registrationNo' and service='ATTENDING' and title = 'PROFESSIONAL FEE' ");

while($row = mysql_fetch_array($result))
  {
$this->getDoctorsFee_atteding_total = $row['total'];
if( $row['status'] == "UNPAID" ) {
$this->getDoctorsFee_atteding_cashUnpaid = $row['cashUnpaid'];
}else {
$this->getDoctorsFee_atteding_cashUnpaid = $row['cashPaid'];
}

$this->getDoctorsFee_atteding_phic = $row['phic'];
$this->getDoctorsFee_atteding_company = $row['company'];
$this->getDoctorsFee_atteding_cashPaid = $row['cashPaid'];
  }

}


public $getDoctorsFee_anesth_total;
public $getDoctorsFee_anesth_phic;
public $getDoctorsFee_anesth_company;
public $getDoctorsFee_anesth_cashUnpaid;
public $getDoctorsFee_anesth_cashPaid;

public function getDoctorsFee_anesth_total() {
return $this->getDoctorsFee_anesth_total;
}
public function getDoctorsFee_anesth_phic() {
return $this->getDoctorsFee_anesth_phic;
}
public function getDoctorsFee_anesth_company() {
return $this->getDoctorsFee_anesth_company;
}
public function getDoctorsFee_anesth_cashUnpaid() {
return $this->getDoctorsFee_anesth_cashUnpaid;
}
public function getDoctorsFee_anesth_cashPaid() {
return $this->getDoctorsFee_anesth_cashPaid;
}

public function getDoctorsFee_anesth($registrationNo) {

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$result = mysql_query("SELECT status,cashPaid,total,cashUnpaid,phic,company FROM patientCharges pc,Doctors d WHERE pc.chargesCode = d.doctorCode and pc.registrationNo='$registrationNo' and d.Specialization1 = 'ANESTHESIOLOGIST' and pc.title = 'PROFESSIONAL FEE' ");

while($row = mysql_fetch_array($result))
  {
$this->getDoctorsFee_anesth_total = $row['total'];
if( $row['status'] == "UNPAID" ) {
$this->getDoctorsFee_anesth_cashUnpaid = $row['cashUnpaid'];
}else {
$this->getDoctorsFee_anesth_cashUnpaid = $row['cashPaid'];
}
$this->getDoctorsFee_anesth_phic = $row['phic'];
$this->getDoctorsFee_anesth_company = $row['company']; 
$this->getDoctorsFee_anesth_cashPaid = $row['cashPaid'];   
}

}



public function addPayment_new($registrationNo,$amountPaid,$datePaid,$timePaid,$paidBy,$paymentFor,$orNo,$paidVia,$pf,$control_datePaid,$receiptType,$creditCardNo,$shift,$collectionFor) {

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$sql="INSERT INTO patientPayment (registrationNo,amountPaid,datePaid,timePaid,paidBy,paymentFor,orNo,paidVia,pf,control_datePaid,receiptType,creditCardNo,shift,patientType)
VALUES
('$registrationNo','$amountPaid','$datePaid','$timePaid','$paidBy','$paymentFor','$orNo','$paidVia','$pf','$control_datePaid','$receiptType','$creditCardNo','$shift','$collectionFor')";

echo "PAYMENT ADDED";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }


/*
echo "<script type='text/javascript' >";
echo  "window.location='http://".$this->getMyUrl()."/COCONUT/patientProfile/patientProfile_handler.php?username=$paidBy&registrationNo=$registrationNo '";
echo "</script>";
*/
mysql_close($con);

}




public function getPF_notAdmitting($registrationNo) { 

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);


$result = mysql_query("SELECT sum(cashUnpaid) as total from patientCharges where registrationNo = '$registrationNo' and title = 'PROFESSIONAL FEE' and status = 'UNPAID' and service != 'ADMITTING' ");


while($row = mysql_fetch_array($result))
  {
return $row['total'];
}


}



public function getPF_Admitting($registrationNo) { 

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);


$result = mysql_query("SELECT sum(cashUnpaid) as total from patientCharges where registrationNo = '$registrationNo' and title = 'PROFESSIONAL FEE' and status = 'UNPAID' and service = 'ADMITTING' ");


while($row = mysql_fetch_array($result))
  {
return $row['total'];
}


}


public function removeRoom($registrationNo,$username) {

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

mysql_query("UPDATE patientCharges SET status='DELETED_".date("Y-m-d")."_".date("H:i:s")."_".$username."'
WHERE title = 'Room and Board' and registrationNo = '$registrationNo' ");

mysql_close($con);

}



public $getPatientRoomCount;

public function getPatientRoom($registrationNo) { 

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);


$result = mysql_query("SELECT description,sellingPrice,quantity from patientCharges where registrationNo = '$registrationNo' and title = 'Room And Board' ");


while($row = mysql_fetch_array($result))
  {
$room = preg_split ("/\-/", $row['description']); 
$this->getPatientRoomCount++;
echo "<tr>";
if( $this->getPatientRoomCount == 1 ) {
echo "<td>Room</td>";
}else {
echo "<td><font color=white>Room</font></td>";
}
echo "<td>&nbsp;<font size=2>".$room[0]." @ ".$row['sellingPrice']."/day x ".$row['quantity']."</font><br></td>";
echo "</tr>";
}


}


public function deleteUnclearCharges($registrationNo,$title) {

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

mysql_query("DELETE FROM patientCharges WHERE registrationNo = '$registrationNo' and title = '$title' and departmentStatus = '' and status ='UNPAID'  ");

mysql_close($con);

}




public function sumPartial_new($registrationNo) {

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$result = mysql_query("SELECT (amountPaid + pf + admitting) as total FROM patientPayment WHERE registrationNo = '$registrationNo' ");

while($row = mysql_fetch_array($result))
  {
return $row['total'];
  }

}



public function discharged_inventory($registrationNo,$title) {

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$result = mysql_query("SELECT sum(phic) as totalPHIC FROM patientCharges WHERE registrationNo = '$registrationNo' and title='$title' ");

while($row = mysql_fetch_array($result))
  {
return $row['totalPHIC'];
  }


}


public $discharged_name_medicine;
public $discharged_name_supplies;

public function discharged_name_medicine() {
return $this->discharged_name_medicine;
}
public function discharged_name_supplies() {
return $this->discharged_name_supplies;
}

public function discharged_name($month,$day,$year,$month1,$day1,$year1) {

echo "<style type='text/css'>";
echo "tr:hover { background-color:yellow;color:black;}";
echo "</style>";

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$discharged = $month."_".$day."_".$year;
$discharged1 = $month1."_".$day1."_".$year1;

$result = mysql_query("SELECT pr.lastName,pr.firstName,rd.registrationNo,rd.dateUnregistered FROM patientRecord pr,registrationDetails rd WHERE pr.patientNo = rd.patientNo and (rd.dateUnregistered between '$discharged' and '$discharged1') order by dateUnregistered asc  ");

while($row = mysql_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->discharged_name_medicine += $this->discharged_inventory($row['registrationNo'],"MEDICINE");
$this->discharged_name_supplies += $this->discharged_inventory($row['registrationNo'],"SUPPLIES");
$this->coconutTableData($row['dateUnregistered']);
$this->coconutTableData($row['lastName'].", ".$row['firstName']);
$this->coconutTableData(  number_format($this->discharged_inventory($row['registrationNo'],"MEDICINE"),2)  );
$this->coconutTableData(  number_format($this->discharged_inventory($row['registrationNo'],"SUPPLIES"),2)  );
$this->coconutTableRowStop();
  }


}




public function printLabRequest($registrationNo,$dateCharge) {

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$result = mysql_query("SELECT description,timeCharge,remarks,chargeBy,status from patientCharges WHERE registrationNo = '$registrationNo' and departmentStatus = '' and title = 'LABORATORY' and status not like 'DELETED_%%%%%%' and dateCharge = '$dateCharge' ");

echo "<table border=1 cellspacing=0>";
echo "<tr>";
echo "<th>Description</th>";
echo "<th>Time</th>";
echo "<th>Remarks</th>";
echo "<th>N.O.D</th>";
echo "</tr>";
while($row = mysql_fetch_array($result))
  {
echo "<tr>";
if( $row['status'] == "PAID" ) {
echo "<td><b>(Pd)</b>&nbsp;".$row['description']."&nbsp;</tD>";
}else {
echo "<td>&nbsp;".$row['description']."&nbsp;</tD>";
}
echo "<td>&nbsp;".$row['timeCharge']."&nbsp;</tD>";
echo "<td>&nbsp;".$row['remarks']."&nbsp;</tD>";
echo "<td>&nbsp;".$row['chargeBy']."&nbsp;</tD>";
echo "</tr>";
  }
echo "</table>";


}


public $cashCollection_name_laboratory;
public $cashCollection_name_radiology;
public $cashCollection_name_medicine;
public $cashCollection_name_supplies;
public $cashCollection_name_bloodBank;
public $cashCollection_name_nbs;
public $cashCollection_name_misc;
public $cashCollection_name_nursingCare;
public $cashCollection_name_ecg;

public function cashCollection_name_laboratory() {
return $this->cashCollection_name_laboratory;
}
public function cashCollection_name_radiology() {
return $this->cashCollection_name_radiology;
}
public function cashCollection_name_medicine() {
return $this->cashCollection_name_medicine;
}
public function cashCollection_name_supplies() {
return $this->cashCollection_name_supplies;
}
public function cashCollection_name_bloodBank() {
return $this->cashCollection_name_bloodBank;
}
public function cashCollection_name_nbs() {
return $this->cashCollection_name_nbs;
}
public function cashCollection_name_misc() {
return $this->cashCollection_name_misc;
}
public function cashCollection_name_nursingCare() {
return $this->cashCollection_name_nursingCare;
}
public function cashCollection_name_ecg() {
return $this->cashCollection_name_ecg;
}

public function cashCollection_name($month,$day,$year,$month1,$day1,$year1,$type,$control,$username) {

echo "<style type='text/css'>";
echo "tr:hover { background-color:yellow;color:black;}";
echo "</style>";

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$discharged = $month."_".$day."_".$year;
$discharged1 = $month1."_".$day1."_".$year1;

if( $control != "All" ) {
$result = mysql_query("SELECT pr.lastName,pr.firstName,rd.registrationNo,rd.dateUnregistered FROM patientRecord pr,registrationDetails rd,patientPayment pp WHERE pr.patientNo = rd.patientNo and pp.registrationNo = rd.registrationNo and (rd.dateUnregistered between '$discharged' and '$discharged1') and rd.type='$type' and pp.paidBy = '$username' order by dateUnregistered asc  ");
}else {
$result = mysql_query("SELECT pr.lastName,pr.firstName,rd.registrationNo,rd.dateUnregistered FROM patientRecord pr,registrationDetails rd,patientPayment pp WHERE pr.patientNo = rd.patientNo and pp.registrationNo = rd.registrationNo and (rd.dateUnregistered between '$discharged' and '$discharged1') and rd.type='$type' order by dateUnregistered asc  ");
}


while($row = mysql_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->discharged_name_medicine += $this->discharged_inventory($row['registrationNo'],"MEDICINE");
$this->discharged_name_supplies += $this->discharged_inventory($row['registrationNo'],"SUPPLIES");

$this->cashCollection_name_laboratory += $this->getTotal("cashUnpaid","LABORATORY",$row['registrationNo']);
$this->cashCollection_name_radiology  += $this->getTotal("cashUnpaid","RADIOLOGY",$row['registrationNo']);
$this->cashCollection_name_medicine +=  $this->getTotal("cashUnpaid","MEDICINE",$row['registrationNo']);
$this->cashCollection_name_supplies +=  $this->getTotal("cashUnpaid","SUPPLIES",$row['registrationNo']);
$this->cashCollection_name_bloodBank +=  $this->getTotal("cashUnpaid","BLOODBANK",$row['registrationNo']);
$this->cashCollection_name_nbs +=  $this->getTotal("cashUnpaid","NBS",$row['registrationNo']);
$this->cashCollection_name_misc +=  $this->getTotal("cashUnpaid","MISCELLANEOUS",$row['registrationNo']);
$this->cashCollection_name_nursingCare +=  $this->getTotal("cashUnpaid","NURSING-CHARGES",$row['registrationNo']);
$this->cashCollection_name_ecg += $this->getTotal("cashUnpaid","ECG",$row['registrationNo']);

$this->coconutTableData($row['dateUnregistered']);
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/currentPatient/patientInterface1.php?username=&registrationNo=$row[registrationNo]' style='text-decoration:none; color:black;' target='_blank'><font size=2>".$row['lastName'].", ".$row['firstName']."</font></a>");
$this->coconutTableData("&nbsp;".number_format($this->getTotal("cashUnpaid","LABORATORY",$row['registrationNo']),2 ));
$this->coconutTableData("&nbsp;".number_format($this->getTotal("cashUnpaid","RADIOLOGY",$row['registrationNo']),2 ));
$this->coconutTableData("&nbsp;".number_format($this->getTotal("cashUnpaid","MEDICINE",$row['registrationNo']),2 ));
$this->coconutTableData("&nbsp;".number_format($this->getTotal("cashUnpaid","SUPPLIES",$row['registrationNo']),2 ));
$this->coconutTableData("&nbsp;".number_format($this->getTotal("cashUnpaid","BLOODBANK",$row['registrationNo']),2 ));
$this->coconutTableData("&nbsp;".number_format($this->getTotal("cashUnpaid","NBS",$row['registrationNo']),2 ));
$this->coconutTableData("&nbsp;".number_format($this->getTotal("cashUnpaid","MISCELLANEOUS",$row['registrationNo']),2 ));
$this->coconutTableData("&nbsp;".number_format($this->getTotal("cashUnpaid","NURSING-CHARGES",$row['registrationNo']),2 ));
$this->coconutTableData("&nbsp;".number_format($this->getTotal("cashUnpaid","ECG",$row['registrationNo']),2 ));
$this->coconutTableRowStop();
  }


}





public function cashCollection_paid($registrationNo,$title,$datePaid) {

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$result = mysql_query("SELECT sum(cashPaid) as cashPaid from patientCharges WHERE registrationNo = '$registrationNo' and datePaid = '$datePaid' and title='$title' ");


while($row = mysql_fetch_array($result))
  {
return $row['cashPaid'];
  }

}

public $cashCollection_name1_laboratory;
public $cashCollection_name1_radiology;
public $cashCollection_name1_medicine;
public $cashCollection_name1_supplies;
public $cashCollection_name1_bloodBank;
public $cashCollection_name1_nbs;
public $cashCollection_name1_misc;
public $cashCollection_name1_nursingCare;
public $cashCollection_name1_ecg;

public function cashCollection_name1_laboratory() {
return $this->cashCollection_name1_laboratory;
}
public function cashCollection_name1_radiology() {
return $this->cashCollection_name1_radiology;
}
public function cashCollection_name1_medicine() {
return $this->cashCollection_name1_medicine;
}
public function cashCollection_name1_supplies() {
return $this->cashCollection_name1_supplies;
}
public function cashCollection_name1_bloodBank() {
return $this->cashCollection_name1_bloodBank;
}
public function cashCollection_name1_nbs() {
return $this->cashCollection_name1_nbs;
}
public function cashCollection_name1_misc() {
return $this->cashCollection_name1_misc;
}
public function cashCollection_name1_nursingCare() {
return $this->cashCollection_name1_nursingCare;
}
public function cashCollection_name1_ecg() {
return $this->cashCollection_name1_ecg;
}

public function cashCollection_name1($month,$day,$year,$month1,$day1,$year1,$type,$control,$username) {

echo "<style type='text/css'>";
echo "tr:hover { background-color:yellow;color:black;}";
echo "</style>";

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$discharged = $month."_".$day."_".$year;
$discharged1 = $month1."_".$day1."_".$year1;


if( $control != "All" ) {
$result = mysql_query("SELECT pr.lastName,pr.firstName,rd.registrationNo,pc.datePaid FROM patientCharges pc,patientRecord pr,registrationDetails rd WHERE pr.patientNo=rd.patientNo and rd.registrationNo=pc.registrationNo and (pc.datePaid between '$discharged' and '$discharged1') group by rd.registrationNo and pc.paidBy = '$username' order by pc.datePaid asc  ");
}else {
$result = mysql_query("SELECT pr.lastName,pr.firstName,rd.registrationNo,pc.datePaid FROM patientCharges pc,patientRecord pr,registrationDetails rd WHERE pr.patientNo=rd.patientNo and rd.registrationNo=pc.registrationNo and (pc.datePaid between '$discharged' and '$discharged1') group by rd.registrationNo order by pc.datePaid asc  ");
}


while($row = mysql_fetch_array($result))
  {

$this->coconutTableRowStart();

$this->cashCollection_name1_laboratory += $this->cashCollection_paid($row['registrationNo'],"LABORATORY",$row['datePaid']);
$this->cashCollection_name1_radiology  += $this->cashCollection_paid($row['registrationNo'],"RADIOLOGY",$row['datePaid']);
$this->cashCollection_name1_medicine += $this->cashCollection_paid($row['registrationNo'],"MEDICINE",$row['datePaid']);
$this->cashCollection_name1_supplies += $this->cashCollection_paid($row['registrationNo'],"SUPPLIES",$row['datePaid']);
$this->cashCollection_name1_bloodBank += $this->cashCollection_paid($row['registrationNo'],"BLOODBANK",$row['datePaid']);
$this->cashCollection_name1_nbs += $this->cashCollection_paid($row['registrationNo'],"NBS",$row['datePaid']);
$this->cashCollection_name1_misc += $this->cashCollection_paid($row['registrationNo'],"MISCELLANEOUS",$row['datePaid']);
$this->cashCollection_name1_nursingCare += $this->cashCollection_paid($row['registrationNo'],"NURSING-CHARGES",$row['datePaid']);
$this->cashCollection_name1_ecg += $this->cashCollection_paid($row['registrationNo'],"ECG",$row['datePaid']);


$this->coconutTableData($row['datePaid']);
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/currentPatient/patientInterface1.php?username=&registrationNo=$row[registrationNo]' style='text-decoration:none; color:black;' target='_blank'><font size=2>".$row['lastName'].", ".$row['firstName']."</font></a>");
$this->coconutTableData("&nbsp;".number_format($this->cashCollection_paid($row['registrationNo'],"LABORATORY",$row['datePaid']),2 ));
$this->coconutTableData("&nbsp;".number_format($this->cashCollection_paid($row['registrationNo'],"RADIOLOGY",$row['datePaid']),2 ));
$this->coconutTableData("&nbsp;".number_format($this->cashCollection_paid($row['registrationNo'],"MEDICINE",$row['datePaid']),2 ));
$this->coconutTableData("&nbsp;".number_format($this->cashCollection_paid($row['registrationNo'],"SUPPLIES",$row['datePaid']),2 ));

$this->coconutTableData("&nbsp;".number_format($this->cashCollection_paid($row['registrationNo'],"BLOODBANK",$row['datePaid']),2 ));

$this->coconutTableData("&nbsp;".number_format($this->cashCollection_paid($row['registrationNo'],"NBS",$row['datePaid']),2 ));

$this->coconutTableData("&nbsp;".number_format($this->cashCollection_paid($row['registrationNo'],"MISCELLANEOUS",$row['datePaid']),2 ));

$this->coconutTableData("&nbsp;".number_format($this->cashCollection_paid($row['registrationNo'],"NURSING-CHARGES",$row['datePaid']),2 ));
$this->coconutTableData("&nbsp;".number_format($this->cashCollection_paid($row['registrationNo'],"ECG",$row['datePaid']),2 ));

$this->coconutTableRowStop();
  }


}


public function requestCart($batchNo,$username) {

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$result = mysql_query("SELECT description,quantity,verificationNo FROM inventoryManager where batchNo='$batchNo' and requestingUser='$username' ");

$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Description");
$this->coconutTableHeader("QTY");
$this->coconutTableHeader("");
$this->coconutTableRowStop();
while($row = mysql_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->coconutTableData("&nbsp;".$row['description']);
$this->coconutTableData("&nbsp;".$row['quantity']);
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/requestition/batchRequest/deleteRequest.php?verificationNo=$row[verificationNo]&batchNo=$batchNo&username=$username'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/delete.jpeg' /></a>");
$this->coconutTableRowStop();
  }
$this->coconutTableStop();

}





public function getTransmitted_selected($transmitNo) {
$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);



$result = mysql_query("SELECT rd.registrationNo,rd.PIN,pr.lastName,pr.firstName,pr.age,pr.gender,rd.dateRegistered,rd.dateUnregistered,pt.registrationNo from registrationDetails rd,patientRecord pr,phicTransmit pt where pr.patientNo = rd.patientNo and pt.registrationNo = rd.registrationNo and pt.transmitNo = '$transmitNo' group by pt.registrationNo order by pr.lastName asc ");


while($row = mysql_fetch_array($result))
  {
echo "<tr>";
echo "<td><font size=3>".$row['PIN']."</font></tD>"; // header [ PHIC NUMBER ]
echo "<Td><font size=3>".$row['lastName'].", ".$row['firstName']."</font></td>"; // header [ NAME/RELATIONSHIP ] 
echo "<td><font size=3>".$row['dateRegistered']." - ".$row['dateUnregistered']."</font></tD>"; // header [ Confinement Period ]
if( $this->getPatientICD_diagnosis_transmittal_check($row['registrationNo']) > 0 ) {
$this->getPatientICD_diagnosis_transmittal($row['registrationNo']); // header [ ICD - FINAL DIAGNOSIS ] 
}else {
echo "<td>&nbsp;</td>";
}
echo "</tr>";  
}

}




public function availableForDiscount($registrationNo) {

echo "<style type='text/css'>
tr:hover { background-color:yellow; color:black; }
.data{
font-size:14px;
}
</style>";

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$result = mysql_query("SELECT itemNo,description,sellingPrice FROM patientCharges WHERE registrationNo = '$registrationNo' and (title = 'LABORATORY' or title = 'MEDICINE' or title = 'XRAY' or title = 'ULTRASOUND' or title = 'ECG' or title = 'OR/DR/ER Fee' or title = 'SUPPLIES') and discount < 1 and phic < 1 and status = 'UNPAID' ");

echo "<center>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("");
$this->coconutTableHeader("Description");
$this->coconutTableHeader("Price");
$this->coconutTableRowStop();
$this->coconutFormStart("get","http://".$this->getMyUrl()."/COCONUT/patientProfile/discount/discount1.php");
$this->coconutHidden("registrationNo",$registrationNo);
while($row = mysql_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->coconutTableData("<input type=checkbox name='itemNo[]' value='$row[itemNo]'>");
$this->coconutTableData("&nbsp;".$row['description']);
$this->coconutTableData("&nbsp;".$row['sellingPrice']);
$this->coconutTableRowStop();
  }
$this->coconutButton("Proceed");
$this->coconutFormStop();
$this->coconutTableStop();
}



/*
public function getPatient_in_the_room($room) {

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$result = mysql_query("SELECT pr.lastName,pr.firstName,rd.dateRegistered,rd.registrationNo from patientRecord pr,registrationDetails rd WHERE rd.room = '$room' and rd.dateUnregistered = '' and pr.patientNo = rd.patientNo and rd.dateRegistered not like 'DELETED%%%%%%%%' ");


while($row = mysql_fetch_array($result))
  {
return "&nbsp;<font size=1 color=black>$row[registrationNo]-".$row['lastName'].", ".$row['firstName']." </font>";
  }

}
*/
public $listRoom_total;

public function listRoom_total() {
return $this->listRoom_total;
}

public function listRoom($floor) {

echo "<style type='text/css'>
tr:hover { background-color:yellow; color:black; }
.data{
font-size:14px;
}
</style>";

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$result = mysql_query("SELECT Description FROM room WHERE floor = '$floor' order by Description asc ");
/*
echo "<center>";
echo "<table border=1 cellspacing=0 rules=all width='15%'>";
echo "<tr>";
echo "<th><b>Beds</b></th>";
echo "</tr>";
*/
while($row = mysql_fetch_array($result))
  {
//$descz = preg_split ("/_/", $row['Description']); 
echo "<tr>";

if( $this->getPatient_in_the_room($row['Description']) != "" ) {
echo "<td>&nbsp;<font size=1 color=red>".$row['Description']."</font><br>
".$this->getPatient_in_the_room($row['Description'])."
</td>";
$this->listRoom_total++;
}else {
echo "<td>&nbsp;<font size=1 color=blue>".$row['Description']."</font></tD>";
}

/*
if( $row['status'] == "Vacant" ) {
$this->coconutTableData("&nbsp;<font color=green size=1>".$row['status']."</font>");
}else {
$this->coconutTableData("&nbsp;<font color=red size=1>".$row['status']."</font>");
}
*/
//$this->coconutTableData("&nbsp;".$this->getPatient_in_the_room($row['Description'])."");
echo "</tr>";
  }
/*
echo "<Tr>";
echo "<td>&nbsp;<font size=2><b>".$this->listRoom_total." Patients</b></font></tD>";
echo "</tr>";
$this->coconutTableStop();
*/
}






public $dispensedMonitor_qty;

public function dispensedMonitor_qty() {
return $this->dispensedMonitor_qty;
}

public function dispensedMonitor($chargesCode,$month,$day,$year,$month1,$day1,$year1) {

echo "<style type='text/css'>
tr:hover { background-color:yellow; color:black; }
.data{
font-size:14px;
}
</style>";

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$date = $year."-".$month."-".$day;
$date1 = $year1."-".$month1."-".$day1;

$result = mysql_query("SELECT pr.lastName,pr.firstName,pc.quantity,pc.dateCharge,pc.departmentStatus_time,rd.registrationNo,pc.dispensedNo FROM patientCharges pc,registrationDetails rd,patientRecord pr WHERE pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and (pc.dateCharge between '$date' and '$date1')  and pc.chargesCode = '$chargesCode' and pc.departmentStatus like 'dispensedBy_%%%%%%' ");

echo "<Br><center>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Patient");
$this->coconutTableHeader("QTY");
$this->coconutTableHeader("Dispensed");
$this->coconutTableHeader("Reg#");
$this->coconutTableHeader("Batch#");
$this->coconutTableHeader("Attending");
echo "</tr>";
while($row = mysql_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->dispensedMonitor_qty += $row['quantity'];
$this->coconutTableData("&nbsp;".$row['lastName'].", ".$row['firstName']);
$this->coconutTableData("&nbsp;".$row['quantity']);
$this->coconutTableData("&nbsp;".$row['dateCharge']."@".$row['departmentStatus_time']);
$this->coconutTableData("&nbsp;".$row['registrationNo']);
$this->coconutTableData("&nbsp;".$row['dispensedNo']);
$this->coconutTableData("&nbsp;".$this->getAttendingDoc($row['registrationNo'],"Attending"));
$this->coconutTableRowStop();
  }
$this->coconutTableRowStart();
$this->coconutTableData("&nbsp;<b>TOTAL</b>");
$this->coconutTableData("&nbsp;".$this->dispensedMonitor_qty);
$this->coconutTableData("&nbsp;");
$this->coconutTableData("&nbsp;");
$this->coconutTableData("&nbsp;");
$this->coconutTableRowStop();
$this->coconutTableStop();
}






public $showExpenses_total;

public function showExpenses_total() {
return $this->showExpenses_total;
}

public function showExpenses($month,$day,$year,$username) {

echo "<style type='text/css'>
tr:hover { background-color:yellow; color:black; }
.data{
font-size:14px;
}
</style>";

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$date = $year."-".$month."-".$day;

if( $this->selectNow("registeredUser","module","username",$username) == "ADMIN" ) {
$result = mysql_query("SELECT amount,payee,date,user,description FROM vouchers WHERE date = '$date' ");
}else {
$result = mysql_query("SELECT amount,payee,date,user,description FROM vouchers WHERE date = '$date' and user = '$username' ");
}

while($row = mysql_fetch_array($result))
  {
echo "<tr>";
$this->showExpenses_total += $row['amount'];
echo "<td>&nbsp; ".$row['payee']." </td>";
echo "<td>&nbsp; ".$row['description']."</td>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<td>&nbsp; ".$row['user']."</td>";
echo "<td>&nbsp; ".number_format($row['amount'],2)."</td>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "</tr>";
  }
echo "<Tr>";
echo "<td>&nbsp;</td>";
echo "<td><center><b>Total</b></center></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<b>".number_format($this->showExpenses_total)."</b></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

}









public function getPatient_OR($registrationNo) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow;color:black;}

a { text-decoration:none; color:black; }
</style>";

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$result = mysql_query("SELECT orNO,description,quantity,cashPaid,paidBy,datePaid FROM patientCharges WHERE registrationNo='$registrationNo' and orNO != '' and status = 'PAID' ");

echo "<br><Center>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("OR#");
$this->coconutTableHeader("Particulars");
$this->coconutTableHeader("QTY");
$this->coconutTableHeader("Paid");
$this->coconutTableHeader("Date Paid");
$this->coconutTableHeader("paidBy");
$this->coconutTableRowStop();
while($row = mysql_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->coconutTableData("&nbsp;".$row['orNO']);
$this->coconutTableData("&nbsp;".$row['description']);
$this->coconutTableData("&nbsp;".$row['quantity']);
$this->coconutTableData("&nbsp;".$row['cashPaid']);
$this->coconutTableData("&nbsp;".$row['datePaid']);
$this->coconutTableData("&nbsp;".$row['paidBy']);
$this->coconutTableRowStop();
  }
$this->coconutTableStop();

}






///////////  CUTOFF REPORT   //////////////////////////////



public $partial_cutoff;
public $getPartialReport_hb_cutoff;
public $getPartialReport_pf_cutoff;
public $getPartialReport_admitting_cutoff;

public function partial_cutoff() {
return $this->partial_cutoff;
}
public function getPartialReport_hb_cutoff() {
return $this->getPartialReport_hb_cutoff;
}
public function getPartialReport_pf_cutoff() {
return $this->getPartialReport_pf_cutoff;
}
public function getPartialReport_admitting_cutoff() {
return $this->getPartialReport_admitting_cutoff;
}

public function getPartialReport_cutoff($month,$day,$year,$fromTime_hour,$fromTime_minutes,$fromTime_seconds,$toTime_hour,$toTime_minutes,$toTime_seconds,$username,$status) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a { text-decoration:none; color:black; }
</style>";

$dateSelected = $month."_".$day."_".$year;
$fromTimez = $fromTime_hour.":".$fromTime_minutes.":".$fromTime_seconds;
$toTimez = $toTime_hour.":".$toTime_minutes.":".$toTime_seconds;


$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

if( $this->selectNow("registeredUser","module","username",$username) == "ADMIN" ) {
$result = mysql_query("SELECT rd.registrationNo,pp.paidVia,upper(pr.completeName) as completeName,pp.paymentFor,pp.paidBy,pp.datePaid,pp.amountPaid,pp.pf,pp.admitting FROM patientPayment pp,patientRecord pr,registrationDetails rd,patientCharges pc WHERE pr.patientNo = rd.patientNo and pp.registrationNo = rd.registrationNo and rd.registrationNo = pc.registrationNo and pp.datePaid = '$dateSelected' and (pp.timePaid between '$fromTimez' and '$toTimez') and paymentFor in ('CUT-OFF HOSPITAL BILL') group by paymentNo order by completeName asc ");
}else {
$result = mysql_query("SELECT rd.registrationNo,pp.paidVia,upper(pr.completeName) as completeName,pp.paymentFor,pp.paidBy,pp.datePaid,pp.amountPaid,pp.pf,pp.admitting FROM patientPayment pp,patientRecord pr,registrationDetails rd,patientCharges pc WHERE pr.patientNo = rd.patientNo and pp.registrationNo = rd.registrationNo and rd.registrationNo = pc.registrationNo and pp.datePaid = '$dateSelected' and (pp.timePaid between '$fromTimez' and '$toTimez') and paymentFor in ('CUT-OFF HOSPITAL BILL') and pp.paidBy='$username' group by paymentNo order by completeName asc ");
}

//$this->collection_salesTotal=0;
//$this->collection_salesUnpaid=0;
//$this->collection_salesPaid=0;
while($row = mysql_fetch_array($result))
  {
$this->partial_cutoff +=$row['amountPaid'];
$this->getPartialReport_hb_cutoff += $row['amountPaid'];
$this->getPartialReport_pf_cutoff += $row['pf'];
$this->getPartialReport_admitting_cutoff += $row['admitting'];
//$price = preg_split ("/\//", $row['sellingPrice']); 


echo "<tr>";
echo "<td>&nbsp;<font color=red>".$row['completeName']."</font>&nbsp;</td>";
echo "<td>&nbsp;".$row['paymentFor']."&nbsp;</td>";
echo "<td>&nbsp;".number_format(($row['amountPaid'] + $row['pf']) + $row['admitting'],2)."&nbsp;</td>";
//echo "<td>&nbsp;".number_format("1",2)."&nbsp;</td>";// header [QTY]
//echo "<td>&nbsp;".number_format("0",2)."&nbsp;</td>";// header [DISC]
echo "<td>&nbsp;".number_format(($row['amountPaid'] + $row['pf']) + $row['admitting'],2)."&nbsp;</td>";
//echo "<td>&nbsp;".number_format("0",2)."&nbsp;</td>"; //header [Balance]
echo "<td>&nbsp;".(($row['amountPaid']+$row['pf'])+$row['admitting'])." - (".$row['paidVia'].")&nbsp;</td>";
echo "<td>&nbsp;".$row['paidBy']."&nbsp;</td>";
echo "<tD>&nbsp;".number_format($row['amountPaid'],2)."&nbsp;</tD>";
echo "<tD>&nbsp;".number_format($row['pf'],2)."&nbsp;</tD>";
echo "<tD>&nbsp;".$this->getAttendingDoc($row['registrationNo'],"Attending")."&nbsp;</tD>";
echo "<tD>&nbsp;".number_format($row['admitting'],2)."&nbsp;</tD>";
//$this->collection_salesTotal+=$row['total'];
//$this->collection_salesUnpaid+=$row['cashUnpaid'];
//$this->collection_salesPaid+=$row['cashPaid'];
/*
if($row['paidVia'] == "Cash") {
$this->collection_cash += $row['cashPaid'];
}else {
$this->collection_creditCard += $row['cashPaid'];
}
*/
echo "</tr>";
  }


					
}




//////////  CUTOFF REPORT   //////////////////////////////







//check kung mei laboratory result n?
public function checkIfTitleExist($registrationNo,$title) {

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$result = mysql_query("SELECT title from patientCharges where registrationNo = '$registrationNo' and title = '$title'  ");

while($row = mysql_fetch_array($result))
  {
return mysql_num_rows($result);
  }

}






public function checkBalance($registrationNo) {

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);


$result = mysql_query("SELECT sum(cashUnpaid) as balance FROM patientCharges where registrationNo = '$registrationNo' ");



while($row = mysql_fetch_array($result))
  {
return $row['balance'];
  }

mysql_close($con);


}





public function addCashCollection($title,$amount,$date,$type,$fromOR,$toOR) {

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$sql="INSERT INTO cashCollection (title,amount,date,control_date,type,fromOR,toOR)
VALUES
('$title','$amount','$date','".date("Y-m-d")."','$type','$fromOR','$toOR')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

//echo "<script type='text/javascript' >";
//echo  "window.location='http://".$this->getMyUrl()."/Maintenance/addUser.php?username=$addedBy '";
//echo "</script>";

mysql_close($con);

}




public function cashCollectionDetails($month,$day,$year) {

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$date = $year."-".$month."-".$day;
$result = mysql_query("SELECT title,amount,type,fromOR,toOR,collectionNo FROM cashCollection where date = '$date' order by title asc ");


$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Title");
$this->coconutTableHeader("Amount");
$this->coconutTableHeader("OR#");
$this->coconutTableHeader("Type");
$this->coconutTableHeader("&nbsp;");
$this->coconutTableRowStop();
while($row = mysql_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->coconutTableData($row['title']);
$this->coconutTableData($row['amount']);
$this->coconutTableData("<font size=2>".$row['fromOR']."-".$row['toOR']."</font>");
$this->coconutTableData($row['type']);
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/Cashier/cashCollection/cashCollectionDetails_delete.php?collectionNo=$row[collectionNo]&month=$month&day=$day&year=$year'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/delete.jpeg' /></a>");
$this->coconutTableRowStop();
  }
$this->coconutTableStop();

mysql_close($con);


}


public $hmo_meds_qty;
public $hmo_meds_actualCharges;
public $hmo_meds_cover;

public function hmo_meds_qty() {
return $this->hmo_meds_qty;
}
public function hmo_meds_actualCharges() {
return $this->hmo_meds_actualCharges;
}
public function hmo_meds_cover() {
return $this->hmo_meds_cover;
}




public function hmo_meds_group($registrationNo,$chargesCode) {

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$result = mysql_query("SELECT sum(pc.quantity) as qty,sum(pc.total) as total,sum(pc.company) as totalCover from patientCharges pc WHERE pc.registrationNo='$registrationNo' and pc.chargesCode = '$chargesCode' and pc.title = 'MEDICINE' and pc. status = 'UNPAID'   "); 

while($row = mysql_fetch_array($result))
  {
$this->hmo_meds_qty = $row['qty'];
$this->hmo_meds_actualCharges = $row['total'];
$this->hmo_meds_cover = $row['totalCover'];
  }


}




/*********HMO OTHERS********************/

public $hmo_others_qty;
public $hmo_others_actualCharges;
public $hmo_others_cover;

public function hmo_others_qty() {
return $this->hmo_others_qty;
}
public function hmo_others_actualCharges() {
return $this->hmo_others_actualCharges;
}
public function hmo_others_cover() {
return $this->hmo_others_cover;
}




public function hmo_others_group($registrationNo,$chargesCode) {

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$result = mysql_query("SELECT sum(pc.quantity) as qty,sum(pc.total) as total,sum(pc.company) as totalCover from patientCharges pc WHERE pc.registrationNo='$registrationNo' and pc.chargesCode = '$chargesCode' and pc.title IN ('LABORATORY','RADIOLOGY','SUPPLIES') and pc. status = 'UNPAID'   "); 

while($row = mysql_fetch_array($result))
  {
$this->hmo_others_qty = $row['qty'];
$this->hmo_others_actualCharges = $row['total'];
$this->hmo_others_cover = $row['totalCover'];
  }


}

/*********HMO OTHERS*******************/



public $hmo_meds_total;
public $hmo_meds_excess;

public function hmo_meds_total() {
return $this->hmo_meds_total;
}




public function hmo_meds($registrationNo) {

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}


.editable{
	border: 1px solid #000;
	color: #000;
	height: 25px;
	width: 80px;
	border-color:white white white white;
	font-size:16px;
	text-align:center;
}


</style>";

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);


$result = mysql_query("SELECT company,phic,hmoPrice,description,chargesCode,sellingPrice FROM patientCharges where registrationNo = '$registrationNo' and title = 'MEDICINE' and status = 'UNPAID' and hmoPrice > 0 group by description order by description asc ");



while($row = mysql_fetch_array($result))
  {
$this->hmo_meds_group($registrationNo,$row['chargesCode']);
$this->hmo_meds_total += ( $row['hmoPrice'] * $this->hmo_meds_qty() );
echo "<tr>";
echo "<td>&nbsp;".$row['description']."</td>";
echo "<td>&nbsp;<input type='text' class='editable' value='".$this->hmo_meds_qty()."'>&nbsp;</tD>";
echo "<td>&nbsp;<input type='text' class='editable' value='".$row['hmoPrice']."'>&nbsp;</tD>";
echo "<td>&nbsp;<input type='text' class='editable' value='".number_format( ( $row['hmoPrice'] * $this->hmo_meds_qty() ) ,2)."'></tD>";
echo "<td>&nbsp;&nbsp;</tD>";
echo "<td>&nbsp;&nbsp;</tD>";
echo "</tr>";
  }


mysql_close($con);


}


public $hmo_others_total;

public function hmo_others_total() {
return $this->hmo_others_total;
}

public function hmo_others($registrationNo) {

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);


$result = mysql_query("SELECT hmoPrice,description,chargesCode,sellingPrice FROM patientCharges where registrationNo = '$registrationNo' and title IN ('LABORATORY','RADIOLOGY','SUPPLIES') and status ='UNPAID' and hmoPrice > 0 group by description order by description asc ");



while($row = mysql_fetch_array($result))
  {
$this->hmo_others_group($registrationNo,$row['chargesCode']);
$this->hmo_others_total += ( $row['hmoPrice'] * $this->hmo_others_qty() );
echo "<tr>";
echo "<td>&nbsp;".$row['description']."</td>";
echo "<td>&nbsp;".$this->hmo_others_qty()."&nbsp;</tD>";
echo "<td>&nbsp;".$row['hmoPrice']."&nbsp;</tD>";
echo "<td>&nbsp;&nbsp;".number_format( ( $row['hmoPrice'] * $this->hmo_others_qty() ) ,2)."</tD>";
echo "<td>&nbsp;&nbsp;</tD>";
echo "<td>&nbsp;&nbsp;</tD>";
echo "</tr>";
  }


mysql_close($con);


}










/**********************TRANSMITAL RECONCILE*******************************/




public function getTransmitted_reconcile($dateDischarged,$dateDischarged1,$package,$type,$switch) {

echo "<style type='text/css'>";

echo "

.member{
	border: 1px solid #000;
	color: #000;
	height: 28px;
	width: 130px;
	border-color:white white white white;
	font-size:13px;

}

";

echo "</style>";

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);


if( $type == "All"  ) {
$result = mysql_query("SELECT pr.religion,rd.registrationNo,rd.PIN,UPPER(pr.lastName) as lastName,UPPER(pr.firstName) as firstName,pr.age,pr.gender,rd.dateRegistered,rd.dateUnregistered,pt.transmitNo from registrationDetails rd,patientRecord pr,phicTransmit pt where pr.patientNo = rd.patientNo and (rd.dateUnregistered between '$dateDischarged' and '$dateDischarged1') and pr.PHIC = 'YES' and pt.reconciled != 'yes' and pt.registrationNo = rd.registrationNo group by pt.registrationNo order by pr.lastName asc ");
}else {
$result = mysql_query("SELECT pr.religion,rd.registrationNo,rd.PIN,pr.lastName,pr.firstName,pr.age,pr.gender,rd.dateRegistered,rd.dateUnregistered,pt.transmitNo from registrationDetails rd,patientRecord pr,phicTransmit pt where pr.patientNo = rd.patientNo and (rd.dateUnregistered between '$dateDischarged' and '$dateDischarged1') and pr.phicType like '$type%' and pt.reconciled != 'yes' and pt.registrationNo = rd.registrationNo group by pt.registrationNo order by pr.lastName asc ");
}

$this->coconutFormStart("get","reconcile.php");

echo "<br>";
echo "<center>";
echo "Date Reconcile&nbsp;";
$this->coconutComboBoxStart_short("month");
echo "<option value='".date("m")."'>".date("M")."</option>";
echo "<option value='01'>Jan</option>";
echo "<option value='02'>Feb</option>";
echo "<option value='03'>Mar</option>";
echo "<option value='04'>Apr</option>";
echo "<option value='05'>May</option>";
echo "<option value='06'>Jun</option>";
echo "<option value='07'>Jul</option>";
echo "<option value='08'>Aug</option>";
echo "<option value='09'>Sep</option>";
echo "<option value='10'>Oct</option>";
echo "<option value='11'>Nov</option>";
echo "<option value='12'>Dec</option>";
$this->coconutComboBoxStop();
echo "-";
$this->coconutComboBoxStart_short("day");

for( $x=1;$x<32;$x++ ) {
echo "<option value='".date("d")."'>".date("d")."</option>";
if( $x < 10 ) {
echo "<option value='0$x'>0$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}

}
$this->coconutComboBoxStop();

echo "-";

$this->coconutTextBox_short("year",date("Y"));
echo "<center>";


echo "<br>";
echo "<center>";
echo "Checked No.";
$this->coconutTextBox("checkedNo","");
echo "</centeR>";
echo "<br>";

while($row = mysql_fetch_array($result))
  {
echo "<tr>";
echo "<td><font size=3>".$row['PIN']."</font></tD>"; // header [ PHIC NUMBER ]
echo "<Td><font size=3>".$row['lastName'].", ".$row['firstName']."</font></td>"; // header [ NAME/RELATIONSHIP ] 
echo "<td><input type='checkbox' name='registrationNo[]' value='$row[registrationNo]'></tD>";
echo "</tr>";
}
echo "<center>";
$this->coconutButton("Reconcile");
echo "</center>";
$this->coconutFormStop();


}


/**********************TRANSMITAL RECONCILE*******************************/




public function getReconciled($month,$day,$year) { 

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$date = $year."-".$month."-".$day;
$result = mysql_query("SELECT pt.checkedNo,rd.registrationNo,pr.lastName,pr.firstName,pr.middleName from patientRecord pr,registrationDetails rd,phicTransmit pt where pr.patientNo = rd.patientNo and rd.registrationNo = pt.registrationNo and pt.date = '$date' order by pr.lastName asc ");

echo "<center>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Reg#");
$this->coconutTableHeader("Patient");
$this->coconutTableHeader("Checked#");
$this->coconutTableHeader("");
$this->coconutTableRowStop();
while($row = mysql_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->coconutTableData($row['registrationNo']);
$this->coconutTableData($row['lastName'].", ".$row['firstName']);
$this->coconutTableData($row['checkedNo']);
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/SOAoption/summary.php?registrationNo=$row[registrationNo]' target='_blank'><font size=2 color=red>View S.O.A</font></a>");
$this->coconutTableRowStop();
}
$this->coconutTableStop();


}




public function addVoucher_acct($voucherNo,$checkedNo,$paymentMode,$description,$amount,$payee,$date,$time,$accountTitle,$user) {

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$sql="INSERT INTO vouchers (voucherNo,checkedNo,paymentMode,description,amount,payee,date,time,accountTitle,user)
VALUES
('".mysql_real_escape_string($voucherNo)."','".mysql_real_escape_string($checkedNo)."','".mysql_real_escape_string($paymentMode)."','".mysql_real_escape_string($description)."','".mysql_real_escape_string($amount)."','".mysql_real_escape_string($payee)."','".mysql_real_escape_string($date)."','".mysql_real_escape_string($time)."','".mysql_real_escape_string($accountTitle)."','".mysql_real_escape_string($user)."')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

echo "<script type='text/javascript' >";
echo "alert('Voucher Added');";
echo  "window.location='http://".$this->getMyUrl()."/COCONUT/accounting/voucher/addVoucher_acct.php?username=$user'";
echo "</script>";

mysql_close($con);

}






/************NUMBER TO WORDS****************************/


public function convert_number_to_words($number) {
   
    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'One',
        2                   => 'Two',
        3                   => 'Three',
        4                   => 'Four',
        5                   => 'Five',
        6                   => 'Six',
        7                   => 'Seven',
        8                   => 'Eight',
        9                   => 'Nine',
        10                  => 'Ten',
        11                  => 'Eleven',
        12                  => 'Twelve',
        13                  => 'Thirteen',
        14                  => 'Fourteen',
        15                  => 'Fifteen',
        16                  => 'Sixteen',
        17                  => 'Seventeen',
        18                  => 'Eighteen',
        19                  => 'Nineteen',
        20                  => 'Twenty',
        30                  => 'Thirty',
        40                  => 'Fourty',
        50                  => 'Fifty',
        60                  => 'Sixty',
        70                  => 'Seventy',
        80                  => 'Eighty',
        90                  => 'Ninety',
        100                 => 'Hundred',
        1000                => 'Thousand',
        1000000             => 'Million',
        1000000000          => 'Billion',
        1000000000000       => 'Trillion',
        1000000000000000    => 'Quadrillion',
        1000000000000000000 => 'Qintillion'
    );
   
    if (!is_numeric($number)) {
        return false;
    }
   
    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }
   
    $string = $fraction = null;
   
    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }
   
    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . $this->convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = $this->convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= $this->convert_number_to_words($remainder);
            }
            break;
    }
   
    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }
   
    return $string;
}


/************NUMBER TO WORDS*****************************/








public function listVoucher($checkedNo) { 

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

if( $checkedNo == "" ) {
$result = mysql_query("SELECT controlNo,checkedNo,date,payee,invoiceNo from vouchers limit 0,0 ");
}else if( $checkedNo == "all" ) {
$result = mysql_query("SELECT controlNo,checkedNo,date,payee,invoiceNo from vouchers order by checkedNo asc ");
}else {
$result = mysql_query("SELECT controlNo,checkedNo,date,payee,invoiceNo from vouchers WHERE (checkedNo = '$checkedNo' or invoiceNo = '$checkedNo') order by checkedNo asc ");
}

echo "<center>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Invoice No#");
$this->coconutTableHeader("Check No#");
$this->coconutTableHeader("Date");
$this->coconutTableHeader("Payee");
//$this->coconutTableHeader("");
//$this->coconutTableHeader("");
$this->coconutTableRowStop();
while($row = mysql_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/accounting/voucher/voucherOutput.php?invoiceNo=$row[invoiceNo]' target='_blank'>".$row['invoiceNo']."</a>");
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/accounting/voucher/voucherOutput.php?invoiceNo=$row[invoiceNo]' target='_blank'>".$row['checkedNo']."</a>");
$this->coconutTableData($row['date']);
$this->coconutTableData($row['payee']);
//$this->coconutTableData(" <a href='http://".$this->getMyUrl()."/COCONUT/accounting/voucher/editVoucher.php?controlNo=$row[controlNo]'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/pencil.jpeg'></a> ");
//$this->coconutTableData(" <a href='http://".$this->getMyUrl()."/COCONUT/accounting/voucher/deleteVoucher.php?controlNo=$row[controlNo]'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/delete.jpeg'></a> ");
$this->coconutTableRowStop();
}
$this->coconutTableStop();


}











public function phic_reconcillation_acct($month,$day,$year,$month1,$day1,$year1,$type) { 

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$date = $month."_".$day."_".$year;
$date1 = $month1."_".$day1."_".$year1;

if( $type == "All" ) {
$result = mysql_query("SELECT pr.lastName,pr.firstName,rd.registrationNo,rd.dateUnregistered FROM registrationDetails rd,patientCharges pc,patientRecord pr WHERE pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and (rd.dateUnregistered between '$date' and '$date1') group by rd.registrationNo order by pr.lastName asc ");
}else {
$result = mysql_query("SELECT pr.lastName,pr.firstName,rd.registrationNo,rd.dateUnregistered FROM registrationDetails rd,patientCharges pc,patientRecord pr WHERE pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and (rd.dateUnregistered between '$date' and '$date1') and rd.type = '$type' group by rd.registrationNo order by pr.lastName asc ");
}

echo "<center>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Discharged");
$this->coconutTableHeader("Patient");
$this->coconutTableHeader("Amount");
$this->coconutTableHeader("Ref#");
$this->coconutTableHeader("Date");
$this->coconutTableHeader("Remarks");
$this->coconutTableHeader("");
$this->coconutTableHeader("");
$this->coconutTableRowStop();
while($row = mysql_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->coconutTableData($row['dateUnregistered']);
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/philhealth/reconciled/reconcileDetails.php?registrationNo=$row[registrationNo]' target='_blank'>".$row['lastName'].", ".$row['firstName']."</a>");
echo "<Td>&nbsp;".$this->selectNow("phicReconcile","amount","registrationNo",$row['registrationNo'])."</tD>";
echo "<Td>&nbsp;".$this->selectNow("phicReconcile","refno","registrationNo",$row['registrationNo'])."</tD>";
echo "<Td>&nbsp;".$this->selectNow("phicReconcile","date","registrationNo",$row['registrationNo'])."</tD>";
echo "<Td>&nbsp;".$this->selectNow("phicReconcile","remarks","registrationNo",$row['registrationNo'])."</tD>";
$this->coconutTableData(" <a href='http://".$this->getMyUrl()."/COCONUT/philhealth/reconciled/reconcileDetails_edit.php?reconcileNo=".$this->selectNow("phicReconcile","reconcileNo","registrationNo",$row['registrationNo'])."&registrationNo=$row[registrationNo]' target='_blank'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/pencil.jpeg'></a> ");
$this->coconutTableData(" <a href='http://".$this->getMyUrl()."/COCONUT/philhealth/reconciled/reconcileDetails_delete.php?reconcileNo=".$this->selectNow("phicReconcile","reconcileNo","registrationNo",$row['registrationNo'])."&registrationNo=$row[registrationNo]' target='_blank'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/delete.jpeg'></a> ");
$this->coconutTableRowStop();
}
$this->coconutTableStop();


}








public function phicReconcile($registrationNo,$refno,$amount,$remarks,$date) {

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$sql="INSERT INTO phicReconcile (registrationNo,refno,amount,remarks,date)
VALUES
('$registrationNo','$refno','$amount','$remarks','$date')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }


/*
echo "<script type='text/javascript' >";
echo  "window.location='http://".$this->getMyUrl()."/COCONUT/patientProfile/patientProfile_handler.php?username=$paidBy&registrationNo=$registrationNo '";
echo "</script>";
*/
mysql_close($con);

}




public function monthlyCashCollection($title,$date,$date1) {

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$result = mysql_query("SELECT sum(amount) as amountCols FROM cashCollection WHERE title = '$title' and ( date between '$date' and '$date1' ) ");

while($row = mysql_fetch_array($result))
  {
return $row['amountCols'];
  }

}



public $monthlySalesReport_laboratoryz;
public $monthlySalesReport_radiology;
public $monthlySalesReport_ecg;
public $monthlySalesReport_medicine;
public $monthlySalesReport_supplies;
public $monthlySalesReport_miscellaneous;
public $monthlySalesReport_room;
public $monthlySalesReport_nbs;
public $monthlySalesReport_cardiology;
public $monthlySalesReport_bloodBank;
public $monthlySalesReport_dialysis;
public $monthlySalesReport_oxygen;
public $monthlySalesReport_rFee;
public $monthlySalesReport_totalPerPx;
public $monthlySalesreport_totalAllPx;

public function monthlySalesReport($month,$day,$year,$month1,$day1,$year1,$type,$paidVia) {


echo "

<script type='text/javascript' src='http://".$this->getMyUrl()."/jquery.js'></script>
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";


$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$date = $year."-".$month."-".$day;
$date1 = $year1."-".$month1."-".$day;

$result = mysql_query("SELECT pr.lastName,pr.firstName,rd.registrationNo,rd.dateUnregistered FROM patientRecord pr,registrationDetails rd WHERE pr.patientNo = rd.patientNo and (dateUnregistered between '$date' and '$date1') and rd.type='$type' order by rd.dateUnregistered,pr.lastName asc ");

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
<a href="#" id="exportToExcel">Export</a>
<?
//echo "<a href='#' id='exportToExcel'>Export to Excel</a>";
echo "<Table border=1 cellpadding=0 rules=all cellspacing=0 id='ReportTable' >";
$this->coconutTableRowStart();
echo "<th>Discharged</th>";
echo "<th>Patient</th>";
echo "<th>Laboratory</th>";
echo "<th>Radiology</th>";
echo "<th>ECG</th>";
echo "<th>Medicine</th>";
echo "<th>Supplies</th>";
echo "<th>Miscellaneous</th>";
echo "<th>Room</th>";
echo "<th>NBS</th>";
echo "<th>CARDIO</th>";
echo "<th>BloodBank</th>";
echo "<th>Dialysis</th>";
echo "<th>Oxygen</th>";
echo "<th>OR/DR/ER Fee</th>";
echo "<th>TOTAL</th>";
$this->coconutTableRowStop();
while($row = mysql_fetch_array($result))
  {

$this->getMonthlySalesReport_laboratoryz += $this->getTotal($paidVia,"LABORATORY",$row['registrationNo']);
$this->getMonthlySalesReport_radiology += $this->getTotal($paidVia,"RADIOLOGY",$row['registrationNo']);
$this->getMonthlySalesReport_ecg += $this->getTotal($paidVia,"ECG",$row['registrationNo']);
$this->getMonthlySalesReport_medicine += $this->getTotal($paidVia,"MEDICINE",$row['registrationNo']);
$this->getMonthlySalesReport_supplies += $this->getTotal($paidVia,"SUPPLIES",$row['registrationNo']);
$this->getMonthlySalesReport_miscellaneous += $this->getTotal($paidVia,"MISCELLANEOUS",$row['registrationNo']);
$this->getMonthlySalesReport_room += $this->getTotal($paidVia,"Room And Board",$row['registrationNo']);
$this->getMonthlySalesReport_nbs += $this->getTotal($paidVia,"NBS",$row['registrationNo']);
$this->getMonthlySalesReport_cardiology += $this->getTotal($paidVia,"CARDIOLOGY",$row['registrationNo']);
$this->getMonthlySalesReport_bloodBank += $this->getTotal($paidVia,"BLOODBANK",$row['registrationNo']);
$this->getMonthlySalesReport_dialysis += $this->getTotal($paidVia,"DIALYSIS",$row['registrationNo']);
$this->getMonthlySalesReport_oxygen += $this->getTotal($paidVia,"OXYGEN",$row['registrationNo']);
$this->getMonthlySalesReport_rFee += $this->getTotal($paidVia,"OR/DR/ER Fee",$row['registrationNo']);


$this->getMonthlySalesReport_totalPerPx = ( 

$this->getMonthlySalesReport_laboratoryz +
$this->getMonthlySalesReport_radiology +
$this->getMonthlySalesReport_ecg +
$this->getMonthlySalesReport_medicine +
$this->getMonthlySalesReport_supplies +
$this->getMonthlySalesReport_miscellaneous +
$this->getMonthlySalesReport_room +
$this->getMonthlySalesReport_nbs +
$this->getMonthlySalesReport_cardiology +
$this->getMonthlySalesReport_bloodBank +
$this->getMonthlySalesReport_dialysis +
$this->getMonthlySalesReport_oxygen +
$this->getMonthlySalesReport_rFee 

  );


$this->getMonthlySalesReport_totalAllPx += ( 

$this->getTotal($paidVia,"LABORATORY",$row['registrationNo']) +
$this->getTotal($paidVia,"RADIOLOGY",$row['registrationNo']) +
$this->getTotal($paidVia,"ECG",$row['registrationNo']) +
$this->getTotal($paidVia,"MEDICINE",$row['registrationNo']) +
$this->getTotal($paidVia,"SUPPLIES",$row['registrationNo']) +
$this->getTotal($paidVia,"MISCELLANEOUS",$row['registrationNo']) + 
$this->getTotal($paidVia,"Room And Board",$row['registrationNo']) +
$this->getTotal($paidVia,"NBS",$row['registrationNo']) +
$this->getTotal($paidVia,"CARDIOLOGY",$row['registrationNo']) +
$this->getTotal($paidVia,"BLOODBANK",$row['registrationNo']) +
$this->getTotal($paidVia,"DIALYSIS",$row['registrationNo']) +
$this->getTotal($paidVia,"OXYGEN",$row['registrationNo']) +
$this->getTotal($paidVia,"OR/DR/ER Fee",$row['registrationNo']) 
  ) ;


$this->coconutTableRowStart();
$this->coconutTableData("&nbsp;".$row['dateUnregistered']);
$this->coconutTableData($row['lastName'].", ".$row['firstName']);
$this->coconutTableData("&nbsp;".number_format($this->getTotal($paidVia,"LABORATORY",$row['registrationNo']),2));
$this->coconutTableData("&nbsp;".number_format($this->getTotal($paidVia,"RADIOLOGY",$row['registrationNo']),2));
$this->coconutTableData("&nbsp;".number_format($this->getTotal($paidVia,"ECG",$row['registrationNo']),2));
$this->coconutTableData("&nbsp;".number_format($this->getTotal($paidVia,"MEDICINE",$row['registrationNo']),2));
$this->coconutTableData("&nbsp;".number_format($this->getTotal($paidVia,"SUPPLIES",$row['registrationNo']),2));
$this->coconutTableData("&nbsp;".number_format($this->getTotal($paidVia,"MISCELLANEOUS",$row['registrationNo']),2));
$this->coconutTableData("&nbsp;".number_format($this->getTotal($paidVia,"Room And Board",$row['registrationNo']),2));
$this->coconutTableData("&nbsp;".number_format($this->getTotal($paidVia,"NBS",$row['registrationNo']),2));
$this->coconutTableData("&nbsp;".number_format($this->getTotal($paidVia,"CARDIOLOGY",$row['registrationNo']),2));
$this->coconutTableData("&nbsp;".number_format($this->getTotal($paidVia,"BLOODBANK",$row['registrationNo']),2));
$this->coconutTableData("&nbsp;".number_format($this->getTotal($paidVia,"DIALYSIS",$row['registrationNo']),2));
$this->coconutTableData("&nbsp;".number_format($this->getTotal($paidVia,"OXYGEN",$row['registrationNo']),2));
$this->coconutTableData("&nbsp;".number_format($this->getTotal($paidVia,"OR/DR/ER Fee",$row['registrationNo']),2));
$this->coconutTableData("&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/SOAoption/summary.php?registrationNo=$row[registrationNo]' target='_blank'>".number_format( ( 

$this->getTotal($paidVia,"LABORATORY",$row['registrationNo']) +
$this->getTotal($paidVia,"RADIOLOGY",$row['registrationNo']) +
$this->getTotal($paidVia,"ECG",$row['registrationNo']) +
$this->getTotal($paidVia,"MEDICINE",$row['registrationNo']) +
$this->getTotal($paidVia,"SUPPLIES",$row['registrationNo']) +
$this->getTotal($paidVia,"MISCELLANEOUS",$row['registrationNo']) + 
$this->getTotal($paidVia,"Room And Board",$row['registrationNo']) +
$this->getTotal($paidVia,"NBS",$row['registrationNo']) +
$this->getTotal($paidVia,"CARDIOLOGY",$row['registrationNo']) +
$this->getTotal($paidVia,"BLOODBANK",$row['registrationNo']) +
$this->getTotal($paidVia,"DIALYSIS",$row['registrationNo']) +
$this->getTotal($paidVia,"OXYGEN",$row['registrationNo']) +
$this->getTotal($paidVia,"OR/DR/ER Fee",$row['registrationNo']) 
  ) ,2)."</a>");
$this->coconutTableRowStop();
  }
$this->coconutTableRowStart();
$this->coconutTableData("&nbsp;");
$this->coconutTableData("&nbsp;<b>TOTAL</b>");
$this->coconutTableData("&nbsp;".number_format($this->getMonthlySalesReport_laboratoryz),2);
$this->coconutTableData("&nbsp;".number_format($this->getMonthlySalesReport_radiology),2);
$this->coconutTableData("&nbsp;".number_format($this->getMonthlySalesReport_ecg),2);
$this->coconutTableData("&nbsp;".number_format($this->getMonthlySalesReport_medicine),2);
$this->coconutTableData("&nbsp;".number_format($this->getMonthlySalesReport_supplies),2);
$this->coconutTableData("&nbsp;".number_format($this->getMonthlySalesReport_miscellaneous),2);
$this->coconutTableData("&nbsp;".number_format($this->getMonthlySalesReport_room),2);
$this->coconutTableData("&nbsp;".number_format($this->getMonthlySalesReport_nbs),2);
$this->coconutTableData("&nbsp;".number_format($this->getMonthlySalesReport_cardiology),2);
$this->coconutTableData("&nbsp;".number_format($this->getMonthlySalesReport_bloodBank),2);
$this->coconutTableData("&nbsp;".number_format($this->getMonthlySalesReport_dialysis),2);
$this->coconutTableData("&nbsp;".number_format($this->getMonthlySalesReport_oxygen),2);
$this->coconutTableData("&nbsp;".number_format($this->getMonthlySalesReport_rFee),2);
$this->coconutTableData("&nbsp;".number_format($this->getMonthlySalesReport_totalAllPx,2));
$this->coconutTableRowStop();
$this->coconutTableStop();

}






public $getOPD_title_total;

public function getOPD_title($month,$day,$year,$title,$user) {

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);
$datez = $year."-".$month."-".$day;


if( $title == "PHARMACY" ) {
$result = mysql_query("SELECT pr.lastName,pr.firstName,pc.description,pc.datePaid,pc.cashPaid FROM patientRecord pr,registrationDetails rd,patientCharges pc WHERE pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and rd.type='OPD' and (pc.title = 'MEDICINE' or pc.title = 'SUPPLIES') and pc.datePaid = '$datez' and paidBy = '$user' order by lastName asc  ");
}else {
$result = mysql_query("SELECT pr.lastName,pr.firstName,pc.description,pc.datePaid,pc.cashPaid FROM patientRecord pr,registrationDetails rd,patientCharges pc WHERE pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and rd.type='OPD' and pc.title = '$title' and pc.datePaid = '$datez' and paidBy = '$user' order by lastName asc  ");
}

echo "<br><Br><Center>$title";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Patient");
$this->coconutTableHeader("Particulars");
$this->coconutTableHeader("Paid");
$this->coconutTableRowStop();
while($row = mysql_fetch_array($result))
  {
$this->getOPD_title_total += $row['cashPaid'];
$this->coconutTableRowStart();
$this->coconutTableData($row['lastName'].", ".$row['firstName']);
$this->coconutTableData($row['description']);
$this->coconutTableData(number_format($row['cashPaid'],2));
$this->coconutTableRowStop();
}
$this->coconutTableRowStart();
$this->coconutTableData("<b>TOTAL</b>");
$this->coconutTableData("&nbsp;");
$this->coconutTableData("&nbsp;".number_format($this->getOPD_title_total,2));
$this->coconutTableRowStop();
$this->coconutTableStop();

}







public function insertGeneratorLog($dateStart,$timeStart,$dateStop,$timeStop,$status,$user) {

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$sql="INSERT INTO generatorCharge (dateStart,timeStart,dateStop,timeStop,status,user)
VALUES
('$dateStart','$timeStart','$dateStop','$timeStop','$status','$user')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }


/*
echo "<script type='text/javascript' >";
echo  "window.location='http://".$this->getMyUrl()."/COCONUT/patientProfile/patientProfile_handler.php?username=$paidBy&registrationNo=$registrationNo '";
echo "</script>";
*/
mysql_close($con);

}



public function insertGeneratorLog_new($dateStart,$timeStart,$dateStop,$timeStop,$status,$user,$hrs) {

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$sql="INSERT INTO generatorCharge (dateStart,timeStart,dateStop,timeStop,status,user,hours)
VALUES
('$dateStart','$timeStart','$dateStop','$timeStop','$status','$user','$hrs')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }


/*
echo "<script type='text/javascript' >";
echo  "window.location='http://".$this->getMyUrl()."/COCONUT/patientProfile/patientProfile_handler.php?username=$paidBy&registrationNo=$registrationNo '";
echo "</script>";
*/
mysql_close($con);

}




public $checkGenerator_total;
public function checkGenerator($month,$day,$year,$month1,$day1,$year1,$registrationNo,$username) {

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);
$date = $year."-".$month."-".$day;
$date1 = $year1."-".$month1."-".$day1;
$result = mysql_query("SELECT * from generatorCharge WHERE (dateStart between '$date' and '$date1' )  ");

echo "<Br><Br><br><Center>";
$this->coconutFormStart("get","http://".$this->getMyUrl()."/COCONUT/systemBiller/generatorCharge/addGeneratorCharges.php");
$this->coconutHidden("registrationNo",$registrationNo);
$this->coconutHidden("username",$username);
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("");
$this->coconutTableHeader("Date");
$this->coconutTableHeader("Mins");
$this->coconutTableRowStop();
while($row = mysql_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->checkGenerator_total += $row['hours'];
$this->coconutTableData("<input type=checkbox name='chargeNo[]' value='$row[chargeNo]' checked>");
$this->coconutTableData($row['dateStart']);
$this->coconutTableData($row['hours']);
$this->coconutTableRowStop();
}
$this->coconutTableRowStart();
$this->coconutTableData("");
$this->coconutTableData("<b>TOTAL</b>");
$this->coconutTableData("".$this->checkGenerator_total);
$this->coconutTableRowStop();
$this->coconutTableStop();
echo "<Br>";
$this->coconutButton("Proceed");
$this->coconutFormStop();

}



public function showGeneratorList($month,$day,$year,$username) {

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);
$date = $year."-".$month."-".$day;
$result = mysql_query("SELECT dateStart,timeStart,chargeNo from generatorCharge WHERE dateStart  = '$date' ");

echo "<Br><Br><br><Center>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("");
$this->coconutTableHeader("Date");
$this->coconutTableHeader("Time Start");
$this->coconutTableRowStop();
while($row = mysql_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/systemBiller/generatorCharge/generatorSummary1.php?chargeNo=$row[chargeNo]&username=ricky' style='text-decoration:none; color:red;'>View</a>");
$this->coconutTableData($row['dateStart']);
$this->coconutTableData($row['timeStart']);
$this->coconutTableRowStop();
}
$this->coconutTableRowStart();
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableRowStop();
$this->coconutTableStop();
echo "<Br>";

}





public function addOrder($description,$sellingPrice,$unitCost,$batchNo,$dateOrder,$username,$qty,$supplier) {

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$sql="INSERT INTO orderForm (description,sellingPrice,unitcost,batchNo,dateOrder,orderBy,qty,supplier)
VALUES
('$description','$sellingPrice','$unitCost','$batchNo','$dateOrder','$username','$qty','$supplier')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }


mysql_close($con);

}





//********************* RE-ORDER FORM ****************************//

public function searchReOrder($search,$searchType,$batchNo,$username) {

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);


if( $searchType == "brand" ) {
$result = mysql_query("SELECT description,genericName,unitcost,Added,supplier from inventory WHERE description like '".$search."%%%%%%%%' and inventoryLocation = 'PHARMACY' ");
}else {
$result = mysql_query("SELECT description,genericName,unitcost,Added,supplier from inventory WHERE genericName like '$search%%%%%%%%' and inventoryLocation = 'PHARMACY' ");
}


echo "<Br><Br>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("<Font size=2>Brand</font>");
$this->coconutTableHeader("<font size=2>Generic</font>");
$this->coconutTableHeader("<font size=2>Unit Cost</font>");
$this->coconutTableHeader("<font size=2>Price</font>");
$this->coconutTableHeader("<font size=2>Supplier</font>");
$this->coconutTableRowStop();
while($row = mysql_fetch_array($result))
  {
$this->coconutTableRowStart();
$sp = preg_split ("/\_/", $row['Added']); 
$this->coconutTableData("&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/availableMedicine/reOrder/reOrder_qty.php?description=$row[description]&genericName=$row[genericName]&unitcost=$row[unitcost]&sp=$sp[1]&supplier=$row[supplier]&batchNo=$batchNo&username=$username' style='text-decoration:none; color:black;'><font size=2>".$row['description']."</font></a>&nbsp;");
$this->coconutTableData("&nbsp;<font size=2>".$row['genericName']."</font>&nbsp;");
$this->coconutTableData("&nbsp;<font size=2>".$row['unitcost']."</font>&nbsp;");
$this->coconutTableData("&nbsp;<font size=2>".number_format($sp[1],2)."</font>&nbsp;");
$this->coconutTableData("&nbsp;<font size=2>".$row['supplier']."</font>&nbsp;");
$this->coconutTableRowStop();
}
$this->coconutTableStop();
echo "<Br>";

}


public function reOrderNo() {
$myFile = $this->getReportInformation("homeRoot")."/COCONUT/trackingNo/reOrder.dat";
$fh = fopen($myFile, 'r');
$theData = fread($fh, 1000);
fclose($fh);

    

$myFile = $this->getReportInformation("homeRoot")."/COCONUT/trackingNo/reOrder.dat";
$fh = fopen($myFile, 'w') or die("can't open file"); 
fwrite($fh, $theData+1);
fclose($fh);
}




public function showOrderForm($batchNo) {

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);



$result = mysql_query("SELECT batchNo,orderNo,description,unitcost,supplier,qty FROM orderForm WHERE batchNo = '$batchNo' ");



echo "<Br><Br>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("<Font size=2>Particulars</font>");
$this->coconutTableHeader("<font size=2>QTY</font>");
$this->coconutTableHeader("<font size=2>Unit Cost</font>");
$this->coconutTableHeader("<font size=2>Supplier</font>");
$this->coconutTableRowStop();
while($row = mysql_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->coconutTableData("&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/availableMedicine/reOrder/delete.php?orderNo=$row[orderNo]&batchNo=$row[batchNo]' style='text-decoration:none; color:black;'>".$row['description']."</a>");
$this->coconutTableData("&nbsp;".$row['qty']);
$this->coconutTableData("&nbsp;".$row['unitcost']);
$this->coconutTableData("&nbsp;".$row['supplier']);
$this->coconutTableRowStop();
}
$this->coconutTableStop();


}





//************************* END OF RE-ORDER FORM ***************************//



//**************** RADIO RESULT ****************************//

public function listRadioResult($m,$d,$y) {

echo "<style type='text/css'>

a {
text-decoration:none;
}

</style>";


$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$datez = $y."-".$m."-".$d;

$result = mysql_query("SELECT rsr.refer,rsr.radioSavedNo,pr.lastName,pr.firstName,pc.description,rsr.time,rsr.itemNo,rsr.registrationNo from patientRecord pr,registrationDetails rd,patientCharges pc,radioSavedReport rsr where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and pc.itemNo = rsr.itemNo and rsr.approvedDate = '$datez' and rsr.approved = 'yes'  ");

while($row = mysql_fetch_array($result))
  {
$this->coconutTableRowStart();

if( $row['refer'] != "" ) {
$this->coconutTableData("&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Laboratory/testDone/referredUser_radio.php?radioSavedNo=$row[radioSavedNo]'><font size=2 color=blue>".$row['lastName'].", ".$row['firstName']."</font></a><br><font size=1 color=red>(Referred)</font>");
}else {
$this->coconutTableData("&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Laboratory/testDone/referredUser_radio.php?radioSavedNo=$row[radioSavedNo]'><font size=2 color=blue>".$row['lastName'].", ".$row['firstName']."</font></a>");
}
$this->coconutTableData("&nbsp;<font size=2 color=black>".$row['description']."</font>");
$this->coconutTableData("&nbsp;<font size=2 color=black>".$row['time']."</font>");
$this->coconutTableData("&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Reports/radiologyReport/radioReport_output.php?itemNo=$row[itemNo]&registrationNo=$row[registrationNo]&description=$row[description]' target='_blank'><font size=2 color=red>View</font></a>");
$this->coconutTableRowStop();
  }

}





public function searchRadioResult($m,$d,$y,$name) {

echo "<style type='text/css'>

a {
text-decoration:none;
}

</style>";


$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$datez = $m."_".$d."_".$y;

$result = mysql_query("SELECT pr.lastName,pr.firstName,pc.description,rsr.time,rsr.itemNo,rsr.registrationNo from patientRecord pr,registrationDetails rd,patientCharges pc,radioSavedReport rsr where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and pc.itemNo = rsr.itemNo and rsr.date = '$datez' and pr.lastName like '".mysql_real_escape_string($name)."%%%%%%%%'  ");

while($row = mysql_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->coconutTableData("&nbsp;<font size=2 color=blue>".$row['lastName'].", ".$row['firstName']."</font>");
$this->coconutTableData("&nbsp;<font size=2 color=black>".$row['description']."</font>");
$this->coconutTableData("&nbsp;<font size=2 color=black>".$row['time']."</font>");
$this->coconutTableData("&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Reports/radiologyReport/radioReport_output.php?itemNo=$row[itemNo]&registrationNo=$row[registrationNo]&description=$row[description]' target='_blank'><font size=2 color=red>View</font></a>");
$this->coconutTableRowStop();
  }

}



/***************** END OF RADIO RESULT *********************///




public function radioResult_onPatient($registrationNo,$username) {

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);



$result = mysql_query("SELECT rsr.radioSavedNo,rsr.date,pc.description,rsr.itemNo FROM radioSavedReport rsr,patientCharges pc WHERE pc.registrationNo = '$registrationNo' and pc.registrationNo = rsr.registrationNo and pc.itemNo = rsr.itemNo order by pc.description asc ");



while($row = mysql_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->coconutTableData("&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Reports/radiologyReport/radioReport_output.php?itemNo=$row[itemNo]&registrationNo=$registrationNo&description=$row[description]' target='_blank' style='text-decoration:none; color:black;'>".$row['radioSavedNo']."</a>");
$this->coconutTableData("&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Reports/radiologyReport/radioReport_output.php?itemNo=$row[itemNo]&registrationNo=$registrationNo&description=$row[description]' target='_blank' style='text-decoration:none; color:black;'>".$row['description']."</a>");
$this->coconutTableData("&nbsp;".$row['date']);

if( $this->selectNow("registeredUser","module","username",$username) == "RADIOLOGY" ) {
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/masterfile/DELETE/deleteRadio.php?radioSavedNo=$row[radioSavedNo]&registrationNo=$registrationNo&username=$username'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/delete.jpeg'></a>");
}else {
$this->coconutTableData("&nbsp;");
}
$this->coconutTableRowStop();
}



}



////////////////////////////////////

public function deptInventory($desc,$dept) {


echo "
<style type='text/css'>
.data{
font-size:12px;
}

tr:hover{ background-color:yellow; color:black; }

</style>

";

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);



$result = mysql_query("SELECT description,quantity from inventory where (description like '$desc%%%%%%%' or genericName like '$desc%%%%%%%' ) and inventoryLocation='$dept' and status not like 'DELETED_%%%%%%%%%%' order by description asc  ");



echo "<center><table border=1 cellpadding=0 cellspacing=0>";
echo "<tr>";
echo "<th>Description</th>";
echo "<th>QTY</th>";
echo "</tr>";
while($row = mysql_fetch_array($result))
  {
echo "<tr>";
echo "<td>".$row['description']."</td>";
echo "<td>&nbsp;".$row['quantity']."</td>";
echo "</tr>";
  }
echo "</table>";


}




public function getQTY_dispensed($inventoryCode) { 


$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);


$result = mysql_query("SELECT sum(quantity) as qtyDispensed from patientCharges WHERE chargesCode = '$inventoryCode' and (title = 'MEDICINE' or title = 'SUPPLIES') and departmentStatus like 'dispensedBy_%%%%%%%%' ");

while($row = mysql_fetch_array($result))
  {
return $row['qtyDispensed'];
}

}





public $laboratoryCensus_count;
public $laboratoryCensus_count_opd;
public $laboratoryCensus_count_ipd;
public $laboratoryCensus_total_opd;
public $laboratoryCensus_total_ipd;

//pinalitan q e2 from "rd.dateUnregistered gnwa kong pc.dateCharge" kc nagkaproblema kay mam.ann akala 
//nea c pascua annielyn 2015-10-22 ung lumbas pero ngwa ang procedure noong 2015-09-17
//edited 2015-11-06
public function laboratoryCensus($dateFrom,$dateTo,$chargesCode,$title) {


echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a { text-decoration:none; color:black; }
</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$this->laboratoryCensus_count=0;

$result = mysqli_query($connection, "select pr.lastName,pr.firstName,pc.description,pc.total,rd.type,rd.dateUnregistered,rd.Company,rd.registrationNo,pc.dateCharge from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and pc.chargesCode = '$chargesCode' and (pc.dateCharge between '$dateFrom' and '$dateTo') and pc.status not like 'DELETED%%%%%%' and pc.title = '$title' order by rd.type,rd.dateUnregistered,pr.lastName") or die("Query fail: " . mysqli_error()); 

echo "<br><br>";
echo "<center>";
echo "<table border=1 cellspacing=0>";
echo "<tr>";
echo "<th><font size=2>Date</font></th>";
echo "<th><font size=2>Name</font></th>";
echo "<th><font size=2>Type</font></th>";
echo "<th><font size=2>Examination</font></th>";
echo "<th><font size=2>HMO</font></th>";
echo "<th><font size=2>Amount</font></th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {
echo "<tr>";

if( $row['type'] == "IPD" ) {
$this->laboratoryCensus_count_ipd++;
$this->laboratoryCensus_total_ipd += $row['total'];
}else if( $row['type'] == "OPD" ) {
$this->laboratoryCensus_count_opd++;
$this->laboratoryCensus_total_opd += $row['total'];
}else {
$this->laboratoryCensus_count_undefined ++;
}

$this->laboratoryCensus_count++;
echo "<td>&nbsp;".$row['dateCharge']."</tD>";
echo "<tD>&nbsp;".$row['lastName'].", ".$row['firstName']."</tD>";
echo "<td>&nbsp;".$row['type']."</tD>";
echo "<td>&nbsp;".$row['description']."</tD>";
echo "<td>&nbsp;".$row['Company']."</tD>";
echo "<td>&nbsp;".$row['total']."</tD>";
echo "</tr>";
}

echo "<tr>";
echo "<Td>&nbsp;<b>IPD</b></tD>";
echo "<Td>&nbsp;<b>".$this->laboratoryCensus_count_ipd."</b> - <b>".number_format($this->laboratoryCensus_total_ipd,2)."</b></tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "</tr>";

echo "<tr>";
echo "<Td>&nbsp;<b>OPD</b></tD>";
echo "<Td>&nbsp;<b>".$this->laboratoryCensus_count_opd."</b> - <b>".number_format($this->laboratoryCensus_total_opd)."</b></tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "</tr>";

echo "<tr>";
echo "<Td>&nbsp;<b>TOTAL</b></tD>";
echo "<Td>&nbsp;<b>".$this->laboratoryCensus_count."</b> - <b>".number_format($this->laboratoryCensus_total_ipd + $this->laboratoryCensus_total_opd,2)."</b></tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "</tr>";
echo "</table>";
}







public function addBabyNow($mother,$baby) {

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$sql="INSERT INTO nbs (motherRegistrationNo,babyRegistrationNo)
VALUES
('$mother','$baby')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }

mysql_close($con);

}


public $getBabies_no=1;
public function getBabies($registrationNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$this->laboratoryCensus_count=0;

$result = mysqli_query($connection, "select babyRegistrationNo from nbs where motherRegistrationNo = '$registrationNo' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
$this->getPatientProfile($row['babyRegistrationNo']);
echo "<font color=red>[".$this->getBabies_no++.".</font>".$this->getPatientRecord_lastName().", ".$this->getPatientRecord_firstName()."<font color=red>]</font>  ";
}

}


public function countRow($table,$column) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$this->laboratoryCensus_count=0;

$result = mysqli_query($connection, "select count($column) as cols from $table ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['cols'];
}

}



public function androidViewPatient($doctorCode) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, "select pr.lastName,pr.firstName,rd.registrationNo,pc.itemNo,rd.pxCount from patientRecord pr,registrationDetails rd,patientCharges pc,Doctors doc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and doc.doctorCode = '$doctorCode' and pc.chargesCode = doc.doctorCode and pc.dateCharge = '".date("Y-m-d")."' and rd.type='OPD' order by rd.pxCount ") or die("Query fail: " . mysqli_error()); 

$docName = $this->selectNow("Doctors","Name","doctorCode",$doctorCode);

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td><center><form method='post' action='http://".$this->getMyUrl()."/COCONUT/android/doctor/viewPatient_information.php' target='rightFrame'>
<input type='hidden' name='itemNo' value='".$row['itemNo']."'>
<input type='submit' style='border:1px solid yellow; border-radius:15px; height:30px; background-color:transparent; color:white; font-size:15px;' value='(".$row['pxCount'].") ".$row['lastName'].", ".$row['firstName']."'> <input type='hidden' name='registrationNo' value='".$row['registrationNo']."'><input type='hidden' name='username' value='$docName'></form></center></td>";
echo "</tr>";
}

}




public function getAvailableCharges_mobile($charges,$registrationNo,$batchNo,$serverTime,$username,$room) {

echo "
<style type='text/css'>
a { text-decoration:none; color:white; }
tr:hover { background-color:black;}
</style>";

$this->getPatientProfile($registrationNo);

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);



if($this->getRegistrationDetails_company() != "" && $this->getRegistrationDetails_type() == "OPD" ) {
$result = mysql_query("SELECT Category,chargesCode,upper(Description) as Description,(HMO) as sellingPrice,Service FROM availableCharges where Description like '$charges%%%%%' ");
}else if( $charges == "all" || $charges == "All" ) {
$result = mysql_query("SELECT Category,chargesCode,upper(Description) as Description,(OPD) as sellingPrice,Service FROM availableCharges where 1=1 order by description asc ");
}else if( $charges == "laboratory" || $charges == "lab"  ) {
$result = mysql_query("SELECT Category,chargesCode,upper(Description) as Description,(OPD) as sellingPrice,Service FROM availableCharges where 1=1 and Category = 'LABORATORY' order by description asc ");
}else if( $charges == "radiology" || $charges == "rad"  ) {
$result = mysql_query("SELECT Category,chargesCode,upper(Description) as Description,(OPD) as sellingPrice,Service FROM availableCharges where 1=1 and Category = 'RADIOLOGY' order by description asc ");
}
else if( $charges == "nbs" || $charges == "NBS"  ) {
$result = mysql_query("SELECT Category,chargesCode,upper(Description) as Description,(OPD) as sellingPrice,Service FROM availableCharges where 1=1 and Category = 'NBS' order by description asc ");
}
else {
$result = mysql_query("SELECT Category,chargesCode,upper(Description) as Description,(OPD) as sellingPrice,Service FROM availableCharges where Description like '".mysql_real_escape_string($charges)."%%%%%%%' ");
}

echo "&nbsp;  <table border=0 cellpadding=0 cellspacing=0 width='400px'>";
echo "<tr>";
echo  "<th>&nbsp;<font color=white><b>Description</b></font>&nbsp;</th>";
echo  "<th>&nbsp;<font color=white><b>Price</font></b>&nbsp;</th>";
echo "</tr>";

while($row = mysql_fetch_array($result))
  {

$senior = $row['sellingPrice'] - $row['sellingPrice'] * 0.20;
$sellingPrice = 0;
echo "<tr>";
echo "<td style='background:#transparent; color:white; font-size:23px;'><a href='http://".$this->getMyUrl()."/COCONUT/android/doctor/notifyToAdd.php?status=UNPAID&registrationNo=$registrationNo&chargesCode=$row[chargesCode]&description=$row[Description]&sellingPrice=$row[sellingPrice]&discount=0&timeCharge=$serverTime&chargeBy=$username&service=$row[Service]&title=$row[Category]&paidVia=Cash&cashPaid=0.00&batchNo=$batchNo&username=$username&quantity=1&inventoryFrom=none&room=OPD_OPD'><b>&nbsp;".$row['Description']."&nbsp;</b></a></td>";

if( $row['Category'] == "LABORATORY" ) {
$sellingPrice = $row['sellingPrice'];
if($this->getPatientRecord_senior() == "NO") {
echo "<td>&nbsp;<a href='#'><font color='white' size='4px'>".number_format($sellingPrice,2)."</font></a>&nbsp;</td>";
}else {
//$sellingPrice = $senior;
echo "<td>&nbsp;<a href='#'><font color='white' size='4px'>".number_format($sellingPrice,2)."</font></a>&nbsp;</td>";
}
}else {
$sellingPrice = $row['sellingPrice'];
echo "<td>&nbsp;<a href='#'><font color='white' size='4px'>".number_format($sellingPrice,2)."</font></a>&nbsp;</td>";
}

/*
if($this->getPatientRecord_senior() == "YES") {
$senior = $row['sellingPrice'] - $row['sellingPrice'] * $this->percentage("senior");
echo "<td>&nbsp;<a href='#'>".$senior."</a>&nbsp;</td>";
}else {
echo "";
}
*/



//e2 ung ggmitin
//echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/availableCharges/addCharges.php?status=UNPAID&registrationNo=$registrationNo&chargesCode=$row[chargesCode]&description=$row[Description]&sellingPrice=$sellingPrice&discount=0&timeCharge=$serverTime&chargeBy=$username&service=$row[Service]&title=$row[Category]&paidVia=Cash&cashPaid=0.00&batchNo=$batchNo&username=$username&quantity=1&inventoryFrom=none&room=".$room[0]."_".$room[1]."'><font color=blue>Add</font></a>&nbsp;";

/*
if($this->getRegistrationDetails_company() != "") {
echo "|&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/availableCharges/addCharges.php?status=APPROVED&registrationNo=$registrationNo&chargesCode=$row[chargesCode]&description=$row[Description]&sellingPrice=$row[sellingPrice]&discount=0&timeCharge=$serverTime&chargeBy=$username&service=Examination&title=$row[Category]&paidVia=Company&cashPaid=0.00&batchNo=$batchNo&username=$username&quantity=1&inventoryFrom=none&room=".$room[0]."_".$room[1]."'><font color=red>Company</font></a>&nbsp;";
}else {
echo "";
}

$discount =$row['sellingPrice'] * $this->percentage("senior");
if($this->getPatientRecord_senior() == "YES") {
echo "|&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/availableCharges/addCharges.php?status=UNPAID&registrationNo=$registrationNo&chargesCode=$row[chargesCode]&description=$row[Description]&sellingPrice=$row[sellingPrice]&discount=$discount&timeCharge=$serverTime&chargeBy=$username&service=Examination&title=$row[Category]&paidVia=Cash&cashPaid=0.00&batchNo=$batchNo&username=$username&quantity=1&inventoryFrom=none&room=".$room[0]."_".$room[1]."'><font color=darkgreen>Senior Disc</font></a>&nbsp;";
}else {
echo "";
}
*/

echo "</td>";
echo "</tr>";

}

}



public $showCartMobile_discount;
public $showCartMobile_total;

//iLLbas Lhat ng chinarge
public function showCartMobile($registrationNo,$batchNo,$username) {

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$result = mysql_query("SELECT pc.* FROM patientCharges pc where pc.registrationNo='$registrationNo' and status not like 'DELETED_%%%%%%%%' and pc.batchNo='$batchNo' order by pc.description asc  ");

echo "<div style='background:#47a3da; border-radius:15px; width:350px;'>";
echo "<table border=0 width='350px;'>";
$this->coconutTableRowStart();
echo "<th><font color='white'>Description</font></th>";
echo "<th><font color='white'>Price</font></th>";
echo "<th><font color='white'>QTY</font></th>";
$this->coconutTableRowStop();
while($row=mysql_fetch_array($result)) {
echo "<tr id='rowz'>";
$this->showCartMobile_discount += $row['discount'];
$this->showCartMobile_total += $row['total'];


$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/android/mobileECART/deleteCart.php?registrationNo=$registrationNo&batchNo=$batchNo&itemNo=$row[itemNo]&username=$username' style='text-decoration:none;'><font color='white'><b>".$row['description']."</b></font></a>");
$this->coconutTableData("<font color='white'><b>".number_format($row['total'],2)."</b></font>");
$this->coconutTableData("<font color='white'><b>".$row['quantity']."</b></font>");

echo "</tr>";
}


$this->coconutTableRowStart();
$this->coconutTableData("&nbsp;<font color='white'><b>Balance</b></font>");
$this->coconutTableData("&nbsp;<font color='white'><b>".number_format($this->showCartMobile_total,2)."</b></font>");
$this->coconutTableData("&nbsp;");
$this->coconutTableRowStop();



$this->coconutTableStop();
echo "</div>";
}




public function addCharges_cash_mobile($status,$registrationNo,$chargesCode,$description,$sellingPrice,$discount,$total,$cashUnpaid,$phic,$company,$timeCharge,$dateCharge,$chargeBy,$service,$title,$paidVia,$cashPaid,$batchNo,$quantity,$inventoryFrom,$branch,$room) {


$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$sql="INSERT INTO patientCharges (status,registrationNo,chargesCode,description,sellingPrice,discount,total,cashUnpaid,phic,company,timeCharge,dateCharge,chargeBy,
service,title,paidVia,cashPaid,batchNo,quantity,inventoryFrom,branch,control_dateCharge,control_datePaid)
VALUES
('$status','$registrationNo','$chargesCode','$description','$sellingPrice','$discount','$total','$cashUnpaid','$phic','$company',
'$timeCharge','$dateCharge','$chargeBy','$service','".strip_tags($title)."','$paidVia','$cashPaid','$batchNo','$quantity','$inventoryFrom','$branch','".date("Y-m-d")."','')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }


if($title == "LABORATORY" || $title == "RADIOLOGY") { 

echo "
<script type='text/javascript'>
window.location='http://".$this->getMyUrl()."/COCONUT/android/doctor/mobileAddCharges_charges.php?registrationNo=$registrationNo&username=$chargeBy&room=$room&batchNo=$batchNo';
</script>";
}else if($title == "MEDICINE") {

echo "
<script type='text/javascript'>
window.location='http://".$this->getMyUrl()."/COCONUT/android/doctor/mobileAddCharges_medicine.php?registrationNo=$registrationNo&username=$chargeBy&room=$room&batchNo=$batchNo';
</script>";

}


else {
echo "";
}
mysql_close($con);

}



public $med_sp_mobile;

public function getAvailableMedicine_mobile($searchBy,$searchDesc,$registrationNo,$batchNo,$serverTime,$username,$searchFrom,$room) {

echo "

<script type='text/javascript' src='http://".$this->getMyUrl()."/jquery.js'></script>
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:black;}

</style>";

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$result = mysql_query("SELECT phic,preparation,inventoryCode,description,genericName,((unitcost * ".$this->percentage("medicine").") + unitcost) as sellingPrice,quantity,unitcost,Added FROM inventory WHERE $searchBy like '$searchDesc%%%%%%%' and inventoryType = 'medicine' and inventoryLocation = '$searchFrom' and status not like 'DELETED_%%%%%' and quantity > 0 order by $searchBy asc ");

echo "<table border=0 cellpadding=0 cellspacing=0 >";
echo "<tr>";
echo "<th>&nbsp;<font color=white>Description</font>&nbsp;</th>";
echo "<th>&nbsp;<font color=white>Price</font>&nbsp;</th>";
echo "<th>&nbsp;<font color=white>QTY</font>&nbsp;</th>";
echo "<th>&nbsp;<font color=white>&nbsp;</font>&nbsp;</th>";
echo "<th>&nbsp;<font color=white>&nbsp;</font>&nbsp;</th>";
echo "<th>&nbsp;<font color=white>&nbsp;</font>&nbsp;</th>";

echo "</tr>";
while($row = mysql_fetch_array($result))
  {
echo "<tr>";
$senior = $row['sellingPrice'] * $this->percentage("senior");
$priceOption = preg_split ("/\_/", $row['Added']); 
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/android/doctor/medicineNotify.php?status=UNPAID&registrationNo=$registrationNo&chargesCode=$row[inventoryCode]&description=$row[description]&sellingPrice=".$priceOption[1]."&timeCharge=$serverTime&chargeBy=$username&service=Medication&title=MEDICINE&paidVia=Cash&cashPaid=0&batchNo=$batchNo&username=$username&inventoryFrom=$searchFrom&discount=0&room=$room' style='text-decoration:none;'><font size=3 color='white'><b><i>*".$row['description']."</i></b></font><br><font color='white'><b>".$row['genericName']."</b></font><br><font color='white'><b>".$row['preparation']."</b></font></a>&nbsp;</td>";



echo "<td>&nbsp;<font color='white'><b>".number_format($priceOption[1],2)."</b></font>&nbsp;</td>";
$this->med_sp_mobile = $priceOption[1];



echo "<td>&nbsp;<font color='white'><b>".$row['quantity']."</b></font>&nbsp;</td>";



}
echo "</table>";

}



public function addNewPlan($registrationNo,$medicine,$timing,$instruction,$indication,$qty) {

/* make your connection */
$sql = new mysqli($this->host,$this->username,$this->password,$this->database);
 
/* we will just create an insert query here, and use it,
normally this would be done by form submission or other means */
$query = "insert into doctorsPlan(registrationNo,medicine,timing,instruction,indication,qty) values('$registrationNo','$medicine','$timing','$instruction','$indication','$qty')";
 
if ( $sql->query($query) ) {
   //echo "A new entry has been added with the `id`";
$this->gotoPage("http://".$this->getMyUrl()."/COCONUT/android/doctor/newPlan.php?registrationNo=$registrationNo");
} else {
    echo "There was a problem:<br />$query<br />{$sql->error}";
}
 
/* close our connection */
$sql->close();
}


public function addNewPlan_fromCharging($registrationNo,$medicine,$timing,$instruction,$indication,$qty,$batchNo,$room,$username) {

/* make your connection */
$sql = new mysqli($this->host,$this->username,$this->password,$this->database);
 
/* we will just create an insert query here, and use it,
normally this would be done by form submission or other means */
$query = "insert into doctorsPlan(registrationNo,medicine,timing,instruction,indication,qty) values('$registrationNo','$medicine','$timing','$instruction','$indication','$qty')";
 
if ( $sql->query($query) ) {
   //echo "A new entry has been added with the `id`";
$this->gotoPage("http://".$this->getMyUrl()."/COCONUT/android/doctor/mobileAddCharges_medicine.php?registrationNo=$registrationNo&batchNo=$batchNo&room=$room&username=$username");
} else {
    echo "There was a problem:<br />$query<br />{$sql->error}";
}
 
/* close our connection */
$sql->close();
}

public function getDoctorsNewPlan($registrationNo) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow;color:black;}

a { text-decoration:none; color:black; }
</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select planNo,medicine,timing,instruction,indication,qty from doctorsPlan where registrationNo = '$registrationNo' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
  {
echo "<tr>";
echo "<td style='width:30px;'><Center><a href='http://".$this->getMyUrl()."/COCONUT/android/doctor/deleteMeds_alert.php?planNo=$row[planNo]&registrationNo=$registrationNo'><font size=2>".$row['medicine']."</font></a></center></td>";
echo "<td style='width:15px;'><div contenteditable='true'><center><font size=2>".$row['timing']."</font></center></div></td>";
echo "<td style='width:15px;'><div contenteditable='true'><center><font size=2>".$row['instruction']."</font></center></div></td>";
echo "<td style='width:15px;'><div contenteditable='true'><center><font size=2>".$row['indication']."</font></center></div></td>";
echo "<td style='width:15px;'><div contenteditable='true'><center><font size=2>".$row['qty']."</font></center></div></td>";
echo "</tr>";
}

}


public function showAdvisedIn_SOAP_returns($registrationNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$this->laboratoryCensus_count=0;

$result = mysqli_query($connection, "select advised from registrationDetails where registrationNo = '$registrationNo' ") or die("Query fail: " . mysqli_error()); 
$x=1;
while($row = mysqli_fetch_array($result))
{
return $row['advised'];
}
}

public function doctorsMedicinePlan_SOAP_returns($registrationNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$this->laboratoryCensus_count=0;

$result = mysqli_query($connection, "select planNo,medicine,timing,instruction,indication,qty from doctorsPlan where registrationNo = '$registrationNo'  ") or die("Query fail: " . mysqli_error()); 
$x=1;
while($row = mysqli_fetch_array($result))
{
$result_array[] = "<b>".$row['medicine']."</b><br>- ".$row['timing']."<br>- ".$row['instruction']."<br>- ".$row['indication']."<br>- ".$row['qty']."<br>";
}
return implode(",",$result_array);
}


public function checkAdvisedFromCharges($registrationNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$this->laboratoryCensus_count=0;

$result = mysqli_query($connection, "select description from patientCharges where registrationNo = '$registrationNo' and title != 'MEDICINE' and title != 'PROFESSIONAL FEE' and status not like 'DELETED_%%%%%%%' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['description'];
}

}

public function showAdvisedFromCharges($registrationNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$this->laboratoryCensus_count=0;

$result = mysqli_query($connection, "select description from patientCharges where registrationNo = '$registrationNo' and title != 'MEDICINE' and title != 'PROFESSIONAL FEE' and status not like 'DELETED_%%%%%%%' ") or die("Query fail: " . mysqli_error()); 
$x=1;

if( $this->checkAdvisedFromCharges($registrationNo) != "" ) {
while($row = mysqli_fetch_array($result))
{
$result_array[] = ",<font size=2>".$row['description']."</font>";
}
return implode(",",$result_array);
}else { 
return "";
}


}




public function mobileHospitalCharges($registrationNo,$title) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, "select itemNo,description from patientCharges where registrationNo = '$registrationNo' and title = '$title' and status not like 'DELETED_%%%%%%%' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{

if( $this->selectNow("labSavedResult","itemNo","itemNo",$row['itemNo']) != "" ) {
echo "
<div style='border:1px solid #000; width:60%; background:#F8F8FF; font-size:35px;' >
<a href='http://".$this->getMyUrl()."/COCONUT/android/doctor/deleteCharges.php?itemNo=$row[itemNo]&registrationNo=$registrationNo' style='text-decoration:none; color:black;'>&nbsp;".$row['description']."</a>
<br>
<a href='http://".$this->getMyUrl()."/COCONUT/Laboratory/resultList/resultForm_output.php?registrationNo=$registrationNo&itemNo=$row[itemNo]'><font color='red' size=2>View Result</font></a>
</div>";
}else {
echo "
<div style='border:1px solid #000; width:60%; background:#F8F8FF; font-size:35px;' >
<a href='http://".$this->getMyUrl()."/COCONUT/android/doctor/deleteCharges.php?itemNo=$row[itemNo]&registrationNo=$registrationNo' style='text-decoration:none; color:black;'>&nbsp;".$row['description']."</a>
</div>";
}
}
}


public function getPatientForResult_itemizedResult($registrationNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$this->laboratoryCensus_count=0;

$result = mysqli_query($connection, "select pc.registrationNo,pc.itemNo,pc.description from patientCharges pc,labSavedResult lsr where pc.itemNo = lsr.itemNo and lsr.registrationNo='$registrationNo'   ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
echo "
<form method='get' action='http://".$this->getMyUrl()."/COCONUT/Laboratory/resultList/resultForm_output.php'>
<input type='hidden' name='registrationNo' value='$row[registrationNo]'>
<input type='submit' style='height:8%; width:30%; border:0px; color:white; font-weight:bold; border-radius:15px; background:#47a3da;' value='$row[description]'>
<input type='hidden' name='itemNo' value='$row[itemNo]'>
</form>
";
}

}



public function getPatientForResult($doctorCode) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$this->laboratoryCensus_count=0;

$result = mysqli_query($connection, "select rd.registrationNo,pr.lastName,pr.firstName from patientRecord pr,registrationDetails rd,labSavedResult lsr,patientCharges pc where pr.patientNo=rd.patientNo and rd.registrationNo=pc.registrationNo and rd.registrationNo=lsr.registrationNo and lsr.date='".date("Y-m-d")."' and pc.chargesCode = '$doctorCode' group by rd.registrationNo order by lsr.time desc ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{

echo "<div style='border-bottom:1px solid #000;'><font size=6>".$row['lastName'].", ".$row['firstName']."</font>";
$this->getPatientForResult_itemizedResult($row['registrationNo']);
echo "</div>";
}

}




/******************NEW CF2**************************/

public function getDiagnosisForNewCF2($registrationNo) {

echo "<style type='text/css'>
.diagnosis{
	border: 1px solid #000;
	color: #000;
	height: 28px;
	width: 200px;
	border-color:white white black white;
	font-size:15px;

}

.icd{
	border: 1px solid #000;
	color: #000;
	height: 28px;
	width: 80px;
	border-color:white white black white;
	font-size:15px;

}

.relatedProcedure{
	border: 1px solid #000;
	color: #000;
	height: 28px;
	width: 100px;
	border-color:white white black white;
	font-size:15px;

}


.date{
	border: 1px solid #000;
	color: #000;
	height: 28px;
	width: 130px;
	border-color:white white black white;
	font-size:15px;

}

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$this->laboratoryCensus_count=0;

$result = mysqli_query($connection, "select icdCode,diagnosis from patientICD where registrationNo='$registrationNo' ") or die("Query fail: " . mysqli_error()); 

echo "<center><table width='840px' border='0px;'>";
echo "<tr>";
echo "<th><font size=2>Diagnosis</font></th>";
echo "<th><font size=1>ICD 10 Code/s</font></th>";
echo "<th><font size=1>Related Procedure/s (is there's any)</font></th>";
echo "<th><font size=1>RVS Code</font></th>";
echo "<th><font size=1>Date of Operation</font></th>";
echo "<th><font size=1>Laterality (check applicable boxes)</font></th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
{
echo "<tr>";
//echo "<td style='vertical-align:top;'> <input type='text' class='diagnosis' value='$row[diagnosis]'></td>";
echo "<td style='vertical-align:top; width:10%' > <div contenteditable='true' style='border-top:0px; border-left:0px; border-bottom:1px solid #000; font-size:15px;'> $row[diagnosis] </div> </td>";
//echo "<td style='vertical-align:top;'> <input type='text' class='icd' value='$row[icdCode]'> </td>";
echo "<td style='vertical-align:top;'><div contenteditable='true' style='border-top:0px; border-left:0px; border-bottom:1px solid #000;'> $row[icdCode] </div> </td>";
echo "<td> <font size=2>i.</font><input type='text' class='relatedProcedure'>
<br>
<font size=2>ii.</font><input type='text' class='relatedProcedure'>
<br>
<font size=2>iii.</font> <input type='text' class='relatedProcedure'>
<br>
<font size=2>iv.</font><input type='text' class='relatedProcedure'>
</td>";
echo "<td style='vertical-align:top;'> <input type='text' class='icd' > </td>";
echo "<td style='vertical-align:top;'> <input type='text' class='date' > </td>";
echo "<td style='vertical-align:top;'> <input type='checkbox'><font size=1>Left</font>
<input type='checkbox'><font size=1>Right</font>
<input type='checkbox'><font size=1>Both</font> </td>
</tr>";
}
echo "</table></center>";
}




public function getChargesAndPFinNewCF2($registrationNo) {

echo "
<style type='text/css'>
.box{
	border: 1px solid #000;
	color: #000;
	height: 18px;
	width: 20px;
	border-color:white black black black;
	font-size:15px;
	text-align:center;
}

.box1{
	border: 1px solid #000;
	color: #000;
	height: 18px;
	width: 20px;
	border-color:white black black white;
	font-size:15px;
	text-align:center;
}

.signature{
	border: 1px solid #000;
	color: #000;
	height: 28px;
	width: 250px;
	border-color:white white black white;
	font-size:15px;
	text-align:center;
}


.amountz{
	border: 1px solid #000;
	color: #000;
	height: 28px;
	width: 150px;
	border-color:white white black white;
	font-size:15px;
	text-align:center;
}


</style>

";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$this->laboratoryCensus_count=0;

$result = mysqli_query($connection, "select pc.chargesCode,pc.description from patientCharges pc where pc.registrationNo = '$registrationNo' and pc.title = 'PROFESSIONAL FEE' and status not like 'DELETED_%%%%%%%' ") or die("Query fail: " . mysqli_error()); 

echo "<table style='width:860px;' border=1px; cellspacing=0px; cellpadding=10px;  >";
echo "<tr>";
echo "<th><font size=2>Accreditation Number/Name of Accredited Health Care Professional/Date Signed</font></th>";
echo "<th><font size=2>Details</font></th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
{


$phicPin0 = substr($this->selectNow("Doctors","PhilHealth_AccreditationNo","doctorCode",$row['chargesCode']),0,1);
$phicPin1 = substr($this->selectNow("Doctors","PhilHealth_AccreditationNo","doctorCode",$row['chargesCode']),1,1);
$phicPin2 = substr($this->selectNow("Doctors","PhilHealth_AccreditationNo","doctorCode",$row['chargesCode']),2,1);
$phicPin3 = substr($this->selectNow("Doctors","PhilHealth_AccreditationNo","doctorCode",$row['chargesCode']),3,1);
//-
$phicPin4 = substr($this->selectNow("Doctors","PhilHealth_AccreditationNo","doctorCode",$row['chargesCode']),5,1);
$phicPin5 = substr($this->selectNow("Doctors","PhilHealth_AccreditationNo","doctorCode",$row['chargesCode']),6,1);
$phicPin6 = substr($this->selectNow("Doctors","PhilHealth_AccreditationNo","doctorCode",$row['chargesCode']),7,1);
$phicPin7 = substr($this->selectNow("Doctors","PhilHealth_AccreditationNo","doctorCode",$row['chargesCode']),8,1);
$phicPin8 = substr($this->selectNow("Doctors","PhilHealth_AccreditationNo","doctorCode",$row['chargesCode']),9,1);
$phicPin9 = substr($this->selectNow("Doctors","PhilHealth_AccreditationNo","doctorCode",$row['chargesCode']),10,1);
$phicPin10 = substr($this->selectNow("Doctors","PhilHealth_AccreditationNo","doctorCode",$row['chargesCode']),11,1);
//-
$phicPin11 = substr($this->selectNow("Doctors","PhilHealth_AccreditationNo","doctorCode",$row['chargesCode']),13,1);

echo "<tr>";
echo "<td width='50%'>";
echo "<center><br><font size=2><b>Accreditation No:</b> <input type='text' class='box' value='$phicPin0'><input type='text' class='box1' value='$phicPin1' ><input type='text' class='box1' value='$phicPin2' ><input type='text' class='box1' value='$phicPin3' >-<input type='text' class='box' value='$phicPin4' ><input type='text' class='box1' value='$phicPin5' ><input type='text' class='box1' value='$phicPin6' ><input type='text' class='box1' value='$phicPin7' ><input type='text' class='box1' value='$phicPin8' ><input type='text' class='box1' value='$phicPin9' ><input type='text' class='box1' value='$phicPin10' >-<input type='text' class='box' value='$phicPin11' >  </font>";
echo "<br><Br>";
echo "<input type='text' class='signature' value='$row[description]'><br><font size=1>Signature Over Printed Name</font><br>";
echo "<br>";
echo "<font size=2>Date Signed:</font> <input type='text' class='box'><input type='text' class='box1'>-<input type='text' class='box'><input type='text' class='box1'>-<input type='text' class='box'><input type='text' class='box1'><input type='text' class='box1'><input type='text' class='box1'>";
echo "</td>";
echo "<td width='50%;'>
<input type='checkbox'><font size=1>No Co-pay on top of PhilHealth Benefit</font>
<Br>
<input type='checkbox'><font size=1>With Co-pay on top of PhilHealth Benefit</font><input type='text' class='amountz'>
</td>";
echo "</tr>";
}
echo "</table>";

}




public function getTotalPF($registrationNo,$columns) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$this->laboratoryCensus_count=0;

$result = mysqli_query($connection, "select sum($columns) as total from patientCharges where registrationNo='$registrationNo' and title = 'PROFESSIONAL FEE' and status = 'UNPAID' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['total'];
}

}



public function getRoomPHIC_unpaid($registrationNo) {

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$result = mysql_query("SELECT sum(cashUnpaid) as unpaid from patientCharges where registrationNo = '$registrationNo' and title = 'Room And Board'  ");


while($row = mysql_fetch_array($result))
  {
return $row['unpaid'];

}


}


/*****************NEW CF2**************************/




public function addReagents($referenceNo,$description,$qty,$dateIn,$user,$permanentReference) {

/* make your connection */
$sql = new mysqli($this->host,$this->username,$this->password,$this->database);
 
/* we will just create an insert query here, and use it,
normally this would be done by form submission or other means */
$query = "insert into labReagents(referenceNo,description,qty,dateIn,user,permanentReference) values('$referenceNo','$description','$qty','$dateIn','$user','$permanentReference')";

 
if ( $sql->query($query) ) {
   //echo "A new entry has been added with the `id`";
$this->gotoPage("http://".$this->getMyUrl()."/COCONUT/Laboratory/addReagents.php?username=$user");
} else {
    echo "There was a problem:<br />$query<br />{$sql->error}";
}
 
/* close our connection */
$sql->close();
}






public function viewReagents($username) {

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$result = mysql_query("SELECT referenceNo,description,qty,dateIn,dateOut,user from labReagents order by dateOut desc  ");

echo "<br><Br><br><center>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Reference#");
$this->coconutTableHeader("Description");
$this->coconutTableHeader("QTY");
$this->coconutTableHeader("Date In");
$this->coconutTableHeader("Date Out");
$this->coconutTableHeader("User");
$this->coconutTableRowStop();
while($row = mysql_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->coconutTableData($row['referenceNo']);
$this->coconutTableData($row['description']);
$this->coconutTableData($row['qty']);
$this->coconutTableData($row['dateIn']);
$this->coconutTableData($row['dateOut']);
$this->coconutTableData($row['user']);
$this->coconutTableRowStop();
}
$this->coconutTableStop();

}

public $getReagentsWillBeUse_referenceNo;
public function getReagentsWillBeUse_referenceNo() {
return $this->getReagentsWillBeUse_referenceNo;
}

public function getReagentsWillBeUse($permanentReferenceNo) {

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$result = mysql_query("SELECT description,referenceNo,permanentReference from labReagents where permanentReference = '$permanentReferenceNo'  ");


while($row = mysql_fetch_array($result))
{
if( $permanentReferenceNo != "none" ) {
echo "<font color='red'>Reagents:</font>".$row['description']." &nbsp;&nbsp;&nbsp; <font color=red>Lot#</font>".$row['referenceNo'];
$this->getReagentsWillBeUse_referenceNo = $row['permanentReference'];
}else {
echo "";
}


}

}



public function useReagents($itemNo,$registrationNo,$permanentNo,$date) {

/* make your connection */
$sql = new mysqli($this->host,$this->username,$this->password,$this->database);
 
/* we will just create an insert query here, and use it,
normally this would be done by form submission or other means */
$query = "insert into labReagentsUsed(itemNo,registrationNo,permanentNo,date) values('$itemNo','$registrationNo','$permanentNo','$date')";

 
if ( $sql->query($query) ) {
   //echo "A new entry has been added with the `id`";
//$this->gotoPage("http://".$this->getMyUrl()."/COCONUT/Laboratory/addReagents.php?username=$user");
} else {
    echo "There was a problem:<br />$query<br />{$sql->error}";
}
 
/* close our connection */
$sql->close();
}



public function addDiet($dietName,$dietCode,$username) {

/* make your connection */
$sql = new mysqli($this->host,$this->username,$this->password,$this->database);
 
/* we will just create an insert query here, and use it,
normally this would be done by form submission or other means */
$query = "insert into dietList(dietCode,dietName) values('$dietCode','$dietName')";

 
if ( $sql->query($query) ) {
   //echo "A new entry has been added with the `id`";
$this->gotoPage("http://".$this->getMyUrl()."/COCONUT/dietary/addDiet.php?username=$username");
} else {
    echo "There was a problem:<br />$query<br />{$sql->error}";
}
 
/* close our connection */
$sql->close();
}



public function viewDiet($username) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow;color:black;}

a { text-decoration:none; color:black; }
</style>";

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$result = mysql_query("SELECT dietNo,dietName,dietCode from dietList order by dietName asc  ");

$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Diet Code");
$this->coconutTableHeader("Diet");
$this->coconutTableHeader("");
$this->coconutTableHeader("");
$this->coconutTableRowStop();
while($row = mysql_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->coconutTableData($row['dietCode']);
$this->coconutTableData($row['dietName']);
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/dietary/editDiet.php?username=$username&dietName=$row[dietName]&dietCode=$row[dietCode]&dietNo=$row[dietNo]'>".$this->coconutImages_return("pencil.jpeg")."</a>");
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/dietary/deleteDiet.php?username=$username&dietNo=$row[dietNo]&dietName=$row[dietName]'>".$this->coconutImages_return("delete.jpeg")."</a>");
$this->coconutTableRowStop();
}
$this->coconutTableStop();

}




public function viewPxForDietary($username) {


echo "
<style type='text/css'>
tr:hover { background-color:yellow;color:black;}

a { text-decoration:none; color:black; }
</style>";


$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$result = mysql_query("SELECT pr.lastName,pr.firstName,rd.room,rd.diet,pr.Age,rd.registrationNo from patientRecord pr,registrationDetails rd where pr.patientNo = rd.patientNo and rd.dateUnregistered = '' and rd.type='IPD' and room != 'ER_ER' and room != '' and room != 'OPD_OPD' ");

$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Room");
$this->coconutTableHeader("Patient");
$this->coconutTableHeader("Diet");
$this->coconutTableHeader("Age");
$this->coconutTableHeader("Doctor");
$this->coconutTableRowStop();
while($row = mysql_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->coconutTableData($row['room']);
$this->coconutTableData($row['lastName'].", ".$row['firstName']);
$this->coconutTableData($this->selectNow("dietList","dietName","dietNo",$row['diet']));
$this->coconutTableData($row['Age']);
$this->coconutTableData($this->getAttendingDoc($row['registrationNo'],"Attending"));
$this->coconutTableRowStop();
}
$this->coconutTableStop();
}



public function countDeptRequest($title,$date) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

if( $title == "MEDICINE" || $title == "SUPPLIES" ) {
$result = mysqli_query($connection, " select count(itemNo) as totalItem from patientCharges where (title = '$title') and (dateCharge = '$date' or dateReturn = '$date') and (departmentStatus = '' or departmentStatus not like 'dispensedBy_%%%%%%') ") or die("Query fail: " . mysqli_error()); 
}else if( $title == "CSR" ) {
$result = mysqli_query($connection, " select count(verificationNo) as totalItem from inventoryManager where dateRequested = '$date' and status = 'requesting' ") or die("Query fail: " . mysqli_error()); 
}else {
$result = mysqli_query($connection, " select count(itemNo) as totalItem from patientCharges where title = '$title' and dateCharge = '$date' and departmentStatus = '' ") or die("Query fail: " . mysqli_error()); 
}


while($row = mysqli_fetch_array($result))
  {
return $row['totalItem'];
}
}





public function getRequestForCSR($date,$username) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select requestingUser,batchNo from inventoryManager where requestTo_department = 'CSR' and dateRequested = '$date' and status = 'requesting' and dispensedDate = '' group by batchNo ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/CSR/showRequest.php?batchNo=$row[batchNo]&username=$username' style='text-decoration:none; color:red;' target='patientCharges'>".$row['requestingUser']."</a>");
echo "</tr>";
}
}

public function getRequestForCSR_itemized($batchNo,$username) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select verificationNo,batchNo,inventoryCode,description,quantity,requestingDepartment,timeRequested from inventoryManager where batchNo = '$batchNo' and status = 'requesting' and requestTo_department = 'CSR' ") or die("Query fail: " . mysqli_error()); 

$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("");
$this->coconutTableHeader("Description");
$this->coconutTableHeader("QTY");
$this->coconutTableHeader("Department");
$this->coconutTableHeader("Time");
$this->coconutTableHeader("");
$this->coconutTableHeader("");
$this->coconutTableRowStop();
$this->coconutFormStart("get","http://".$this->getMyUrl()."/COCONUT/CSR/dispensedCSR.php");
$this->coconutHidden("username",$username);
while($row = mysqli_fetch_array($result))
{
$this->coconutTableRowStart();
$this->coconutTableData("<input type='checkbox' name='verificationNo[]' value='$row[verificationNo]_".$row['inventoryCode']."' checked>");
$this->coconutTableData($row['description']);
$this->coconutTableData($row['quantity']);
$this->coconutTableData($row['requestingDepartment']);
$this->coconutTableData($row['timeRequested']);
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/CSR/editItem.php?verificationNo=$row[verificationNo]&description=$row[description]&quantity=$row[quantity]&username=$username&batchNo=$row[batchNo]'>".$this->coconutImages_return("pencil.jpeg")."</a>");
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/CSR/cancelRequest.php?verificationNo=$row[verificationNo]&description=$row[description]&username=$username&batchNo=$row[batchNo]'>".$this->coconutImages_return("delete.jpeg")."</a>");
$this->coconutTableRowStop();
}
$this->coconutTableStop();
echo "<br>";
$this->coconutButton("Dispensed");
$this->coconutFormStop();
}





public function getCSR_dispensed($date,$username,$status) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select verificationNo,inventoryCode,description,quantity,quantityIssued,requestingDepartment,requestingUser from inventoryManager where dispensedDate = '$date' and status = '$status' ") or die("Query fail: " . mysqli_error()); 

$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Description");
$this->coconutTableHeader("QTY");
$this->coconutTableHeader("Department");
$this->coconutTableHeader("Requested By");
if( $status == "dispensed" ) {
$this->coconutTableHeader("");
}else { }
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
{
$this->coconutTableRowStart();
$this->coconutTableData($row['description']);
$this->coconutTableData($row['quantity']);
$this->coconutTableData($row['requestingDepartment']);
$this->coconutTableData($row['requestingUser']);
if( $status == "dispensed" ) {

if( $this->selectNow("csrReturned","returnNo","verificationNo",$row['verificationNo']) == "" ) {
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/CSR/csrReturn.php?username=$username&description=$row[description]&verificationNo=$row[verificationNo]&inventoryCode=$row[inventoryCode]&qty=$row[quantity]&borrowerDepartment=$row[requestingDepartment]' style='text-decoration:none; color:red;'><font size=2>Return</font></a>");
}else {
echo "<td>&nbsp;</td>";
}

}
else { }
$this->coconutTableRowStop();
}
$this->coconutTableStop();
}



public function addConsumed($inventoryCode,$department,$qty,$description,$date,$time,$username) {

/* make your connection */
$sql = new mysqli($this->host,$this->username,$this->password,$this->database);
 
/* we will just create an insert query here, and use it,
normally this would be done by form submission or other means */
$query = "insert into inventoryConsumed(inventoryCode,department,qty,description,date,time,username) values('$inventoryCode','$department','$qty','$description','$date','$time','$username')";

 
if ( $sql->query($query) ) {
   //echo "A new entry has been added with the `id`";
//$this->gotoPage("http://".$this->getMyUrl()."/COCONUT/dietary/addDiet.php?username=$username");
} else {
    echo "There was a problem:<br />$query<br />{$sql->error}";
}
 
/* close our connection */
$sql->close();
}



public function getConsumed($date) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select inventoryCode,department,qty,description,date,time,username from inventoryConsumed where date = '$date' ") or die("Query fail: " . mysqli_error()); 

echo "<center><br>$date";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Inventory Code");
$this->coconutTableHeader("Department");
$this->coconutTableHeader("Description");
$this->coconutTableHeader("QTY");
$this->coconutTableHeader("Time");
$this->coconutTableHeader("Username");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
{
$this->coconutTableRowStart();
$this->coconutTableData($row['inventoryCode']);
$this->coconutTableData($row['department']);
$this->coconutTableData($row['description']);
$this->coconutTableData($row['qty']);
$this->coconutTableData($row['time']);
$this->coconutTableData($row['username']);
$this->coconutTableRowStop();
}
$this->coconutTableStop();
}


public function csrReturnItem($verificationNo,$inventoryCode,$description,$qty,$borrowerDepartment,$borrowerUsername,$dateReturn,$timeReturn) {

/* make your connection */
$sql = new mysqli($this->host,$this->username,$this->password,$this->database);
 
/* we will just create an insert query here, and use it,
normally this would be done by form submission or other means */
$query = "insert into csrReturned(verificationNo,inventoryCode,description,qty,borrowerDepartment,borrowerUsername,dateReturn,timeReturn) values('$verificationNo','$inventoryCode','$description','$qty','$borrowerDepartment','$borrowerUsername','$dateReturn','$timeReturn')";

 
if ( $sql->query($query) ) {
   //echo "A new entry has been added with the `id`";
//$this->gotoPage("http://".$this->getMyUrl()."/COCONUT/dietary/addDiet.php?username=$username");
} else {
    echo "There was a problem:<br />$query<br />{$sql->error}";
}
 
/* close our connection */
$sql->close();
}


public function getReturnedItem($date) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select inventoryCode,borrowerDepartment,description,qty,timeReturn,borrowerUsername from csrReturned where dateReturn = '$date' ") or die("Query fail: " . mysqli_error()); 

echo "<center><br>Return Items in $date";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Inventory Code");
$this->coconutTableHeader("Department");
$this->coconutTableHeader("Description");
$this->coconutTableHeader("QTY");
$this->coconutTableHeader("Time");
$this->coconutTableHeader("Return By");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
{
$this->coconutTableRowStart();
$this->coconutTableData($row['inventoryCode']);
$this->coconutTableData($row['borrowerDepartment']);
$this->coconutTableData($row['description']);
$this->coconutTableData($row['qty']);
$this->coconutTableData($row['timeReturn']);
$this->coconutTableData($row['borrowerUsername']);
$this->coconutTableRowStop();
}
$this->coconutTableStop();
}




public function getReceivingReport($date) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select inventoryCode,inventoryType,unitcost,suppliesUNITCOST,description,quantity,expiration,Added,preparation from inventory where dateAdded = '$date' and status not like 'DELETED_%%%%%%' ") or die("Query fail: " . mysqli_error()); 

echo "<center><br>Receiving Items in $date";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Inventory Code");
$this->coconutTableHeader("Description");
$this->coconutTableHeader("Unitcost");
$this->coconutTableHeader("Price");
$this->coconutTableHeader("QTY");
$this->coconutTableHeader("Preparation");
$this->coconutTableHeader("Expiration");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
{
$this->coconutTableRowStart();
$this->coconutTableData($row['inventoryCode']);
$this->coconutTableData($row['description']);

if( $row['inventoryType'] == "medicine" ) {
$this->coconutTableData($row['unitcost']);
}else {
$this->coconutTableData($row['suppliesUNITCOST']);
}

if( $row['inventoryType'] == "medicine" ) {
$pricez = preg_split ("/\_/", $row['Added']); 
$this->coconutTableData($pricez[1]);
}else {
$this->coconutTableData($row['unitcost']);
}

$this->coconutTableData($row['quantity']);
$this->coconutTableData($row['preparation']);
$this->coconutTableData($row['expiration']);
$this->coconutTableRowStop();
}
$this->coconutTableStop();
}



public function getRadiologyAttachment($registrationNo,$itemNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select itemNo,fileName,fileUrl,fileOwner,dateUploaded from uploadedFiles where registrationNo='$registrationNo' and itemNo=$itemNo ") or die("Query fail: " . mysqli_error()); 

echo "<center><br>Radiology attachment Result";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Charges");
$this->coconutTableHeader("File Name");
$this->coconutTableHeader("Uploaded By");
$this->coconutTableHeader("Date");
$this->coconutTableHeader("");
$this->coconutTableHeader("");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
{

$info = pathinfo("http://".$this->getMyUrl()."".$row['fileUrl']);


$this->coconutTableRowStart();
$this->coconutTableData("<b><i>".$this->selectNow("patientCharges","description","itemNo",$row['itemNo'])."</i></b>");
$this->coconutTableData($row['fileName']);
$this->coconutTableData($row['fileOwner']);
$this->coconutTableData($row['dateUploaded']);
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/uploader/xXxdicomxXx/".$row['fileName']."' style='text-decoration:none; color:red;'><font size=2>Download</font></a>");


$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/uploader/xXxdicomxXx/viewRadioDocu.php?itemNo=$row[itemNo]' style='text-decoration:none; color:red;'><font size=2>View</font></a>");


$this->coconutTableRowStop();
}
$this->coconutTableStop();
}


public function sumFromPharmacy($registrationNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select sum(cashUnpaid) as totalSum from patientCharges where registrationNo='$registrationNo' and status='UNPAID' and (title = 'MEDICINE' or title = 'SUPPLIES') ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
  {
return $row['totalSum'];
}
}


public function sumFromNotPharmacy($registrationNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select sum(cashUnpaid) as totalSumz from patientCharges where registrationNo='$registrationNo' and status='UNPAID' and (title != 'MEDICINE' and title != 'SUPPLIES') ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
  {
return $row['totalSumz'];
}
}


/********************** R-BANNY *************************/

public function getCurrentPHIC_check_rBanny($registrationNo) {

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$result = mysql_query("SELECT sum(pc.phic) as totalPHIC FROM registrationDetails rd,patientCharges pc where rd.registrationNo = '$registrationNo' and rd.registrationNo = pc.registrationNo and pc.phic >0 and status = 'UNPAID' ");


while($row = mysql_fetch_array($result))
  {
return $row['totalPHIC'];
  }

mysql_close($con);

}


public function getCurrentPaid_check_rBanny($registrationNo) {

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$result = mysql_query("SELECT sum(pc.cashPaid) as totalPaid FROM registrationDetails rd,patientCharges pc where rd.registrationNo = '$registrationNo' and rd.registrationNo = pc.registrationNo and pc.cashPaid >0 and status = 'UNPAID' ");


while($row = mysql_fetch_array($result))
  {
return $row['totalPaid'];
  }

mysql_close($con);

}


public function getMaximumTotal_rBanny($registrationNo) { //kkuhain ang maximum sa medicine 

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$result = mysql_query("SELECT pc.cashUnpaid,pc.itemNo from patientCharges pc where pc.registrationNo = '$registrationNo' and pc.status = 'UNPAID' and pc.sellingPrice > 0 and pc.phic=0 and pc.title != 'PROFESSIONAL FEE' and pc.rBannyStatus != 'exclude' and pc.remarks != 'takeHomeMeds' HAVING MAX(pc.cashUnpaid) ");


while($row = mysql_fetch_array($result))
  {
return $row['cashUnpaid']."_".$row['itemNo'];
  }

}



public function getMaximumTotal_rBanny_cash($registrationNo) { //kkuhain ang maximum sa medicine 

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$result = mysql_query("SELECT pc.cashUnpaid,pc.itemNo from patientCharges pc where pc.registrationNo = '$registrationNo' and pc.status = 'UNPAID' and pc.sellingPrice > 0 and pc.cashPaid=0 and pc.title != 'PROFESSIONAL FEE' HAVING MAX(pc.cashUnpaid) ");


while($row = mysql_fetch_array($result))
  {
return $row['cashUnpaid']."_".$row['itemNo'];
  }

}


public function getMaximumTotal_rBanny_cash_cashier($registrationNo) { //rBanny pra sa cashier module

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$result = mysql_query("SELECT pc.cashUnpaid,pc.itemNo from patientCharges pc where pc.registrationNo = '$registrationNo' and pc.status = 'UNPAID' and pc.sellingPrice > 0 and pc.cashUnpaid > 0 HAVING MAX(pc.cashUnpaid) ");


while($row = mysql_fetch_array($result))
  {
return $row['cashUnpaid']."_".$row['itemNo'];
  }

}



public function update_rBanny($registrationNo,$itemNo,$total) {

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

mysql_query("UPDATE patientCharges SET cashUnpaid = '$total',company = 0,phic = 0
WHERE itemNo = '$itemNo' and registrationNo = '$registrationNo' and title != 'PROFESSIONAL FEE' ");

mysql_close($con);
}


public function getReady_rBanny($registrationNo) {

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);


$result = mysql_query("SELECT itemNo,total,description from patientCharges where registrationNo = '$registrationNo' and status = 'UNPAID' and rBannyStatus != 'exclude' ");


echo "<table border=0>";
while($row = mysql_fetch_array($result))
  {
echo "<tr>";
$this->update_rBanny($registrationNo,$row['itemNo'],$row['total']);
echo "</tr>";  
}

echo "</table>";

}



public function itemException_rBanny($registrationNo) {

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";


$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select itemNo,description,sellingPrice,quantity,total,title,rBannyStatus,dateCharge from patientCharges where registrationNo = '$registrationNo' and status = 'UNPAID' order by description,dateCharge asc ") or die("Query fail: " . mysqli_error()); 

$this->coconutFormStart("get","http://".$this->getMyUrl()."/COCONUT/rBanny/itemException1.php");
$this->coconutHidden("registrationNo",$registrationNo);
echo "<br><br><center>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("&nbsp;");
$this->coconutTableHeader("Description");
$this->coconutTableHeader("Price");
$this->coconutTableHeader("QTY");
$this->coconutTableHeader("Total");
$this->coconutTableHeader("Date");
$this->coconutTableHeader("Title");
$this->coconutTableHeader("R-Banny");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->coconutTableData("<input type='checkbox' name='itemNo[]' value='".$row['itemNo']."'>");
$this->coconutTableData("&nbsp;".$row['description']);
$this->coconutTableData("&nbsp;".$row['sellingPrice']);
$this->coconutTableData("&nbsp;".$row['quantity']);
$this->coconutTableData("&nbsp;".$row['total']);
$this->coconutTableData("&nbsp;".$row['dateCharge']);
$this->coconutTableData("&nbsp;".$row['title']);
$this->coconutTableData("&nbsp;".$row['rBannyStatus']);
$this->coconutTableRowStop();
}
$this->coconutTableStop();
echo "<Br>";
$this->coconutButton("Proceed");
$this->coconutFormStop();


}




/****************** R-BANNY ****************************/



public function checkIfRecordExist($lastName,$firstName,$middleName) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select patientNo from patientRecord where lastName = '$lastName' and firstName = '$firstName' and middleName = '$middleName' ") or die("Query fail: " . mysqli_error()); 


while($row = mysqli_fetch_array($result))
  {
return $row['patientNo'];
}


}



public function selectedNOD($registrationNo,$dateCharge,$from,$to) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select chargeBy from patientCharges where registrationNo=$registrationNo and (title='MEDICINE' or title='SUPPLIES') and departmentStatus not like 'dispensedBy%%%%' and dateCharge='$dateCharge' and (timeCharge between '$from' and '$to') group by chargeBy  ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
  {
echo "<option value='".$row['chargeBy']."'>".$row['chargeBy']."</option>";
}
}


public $totalRefunds;

public function totalRefunds() {
return $this->totalRefunds;
}

public function showRefunds($date) {

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select paymentFor,registrationNo,amountPaid,paidBy from patientPayment where datePaid = '$date' and paymentFor = 'REFUND'  ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
  {
$this->getPatientProfile($row['registrationNo']);
$this->totalRefunds += $row['amountPaid'];
echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>".$this->getPatientRecord_lastName().", ".$this->getPatientRecord_firstName()."</td>";
echo "<td>&nbsp;".$row['paymentFor']."</td>";
echo "<td>&nbsp;".number_format($row['amountPaid'],2)."</td>";
echo "<td>&nbsp;".number_format($row['amountPaid'],2)."</td>";
echo "<td>&nbsp;".number_format($row['amountPaid'],2)."</td>";
echo "<td>&nbsp;".$row['paidBy']."</td>";
echo "<td>&nbsp;".number_format($row['amountPaid'],2)."</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";
}

}




public function admissionDischargedRecord($patientNo,$registrationNo,$birthPlace,$nationality,$pxOccupation,$fathersName,$mothersName,$address,$contact1,$spouseName,$address1,$contactNo2,$admissionType,$ssc,$ws,$employerName,$dataGivenBy,$informantAddress,$patientRelation,$disposition,$result) {

/* make your connection */
$sql = new mysqli($this->host,$this->username,$this->password,$this->database);
 
/* we will just create an insert query here, and use it,
normally this would be done by form submission or other means */
$query = "insert into patientRecord2(patientNo,registrationNo,birthPlace,nationality,pxOccupation,fathersName,mothersName,address,contact1,spouseName,address1,contact2,admissionType,socialService,ws,employerName,dataGivenBy,informantAddress,relation2patient,disposition,result) values('$patientNo','$registrationNo','$birthPlace','$nationality','$pxOccupation','$fathersName','$mothersName','$address','$contact1','$spouseName','$address1','$contactNo2','$admissionType','$ssc','$ws','$employerName','$dataGivenBy','$informantAddress','$patientRelation','$disposition','$result')";

 
if ( $sql->query($query) ) {
   //echo "A new entry has been added with the `id`";
//$this->gotoPage("http://".$this->getMyUrl()."/COCONUT/dietary/addDiet.php?username=$username");
} else {
    echo "There was a problem:<br />$query<br />{$sql->error}";
}
 
/* close our connection */
$sql->close();
}




public function showIssuedRequest($date) {

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select description,quantity,requestingDepartment,requestingUser,issuedBy from inventoryManager where dateIssued = '$date'  ") or die("Query fail: " . mysqli_error()); 

echo "<Br><br><center>";
echo "<font size=2>Inventory Issued ($date)</font>";
echo "<Br>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Description");
$this->coconutTableHeader("QTY");
$this->coconutTableHeader("Department");
$this->coconutTableHeader("Request By");
$this->coconutTableHeader("Issued By");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
echo "<tr>";
echo "<td>&nbsp;".$row['description']."</td>";
echo "<td>&nbsp;".$row['quantity']."</td>";
echo "<td>&nbsp;".$row['requestingDepartment']."</td>";
echo "<td>&nbsp;".$row['requestingUser']."</td>";
echo "<td>&nbsp;".$row['issuedBy']."</td>";
echo "</tr>";
}
$this->coconutTableStop();

}




public function getAllPayment($registrationNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select sum(amountPaid) as totalz from patientPayment where registrationNo = '$registrationNo'  ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
  {
return $row['totalz'];
}
}


public function checkPermission($registrationNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select status from pxUnlocked where registrationNo = '$registrationNo' and status = 'Open'  ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
  {
return $row['status'];
}
}


public function showSupervisorLocked($registrationNo,$username) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select unlockNo,timeOpen,timeClosed,dateOpen,dateClosed,supervisor,status from pxUnlocked where registrationNo = '$registrationNo' ") or die("Query fail: " . mysqli_error()); 

$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Status");
$this->coconutTableHeader("Time Open");
$this->coconutTableHeader("Time Closed");
$this->coconutTableHeader("Date Open");
$this->coconutTableHeader("Time Closed");
$this->coconutTableHeader("Supervisor");
$this->coconutTableHeader("");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->coconutTableData($row['status']);
$this->coconutTableData($row['timeOpen']);
$this->coconutTableData($row['timeClosed']);
$this->coconutTableData($row['dateOpen']);
$this->coconutTableData($row['dateClosed']);
$this->coconutTableData($row['supervisor']);
if( $row['supervisor'] == $username && $row['status'] == "Open" ) {
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/currentPatient/locked/unlock.php?unlockNo=$row[unlockNo]&username=$username&registrationNo=$registrationNo'>".$this->coconutImages_return("delete.jpeg")."</a>");
}else {
$this->coconutTableData($this->coconutImages_return("locked1.jpeg"));
}
$this->coconutTableRowStop();
}
$this->coconutTableStop();
}




public function addPermission($registrationNo,$timeOpen,$dateOpen,$username) {

/* make your connection */
$sql = new mysqli($this->host,$this->username,$this->password,$this->database);
 
/* we will just create an insert query here, and use it,
normally this would be done by form submission or other means */
$query = "insert into pxUnlocked(registrationNo,timeOpen,dateOpen,supervisor,status) values('$registrationNo','$timeOpen','$dateOpen','$username','Open')";

 
if ( $sql->query($query) ) {
   //echo "A new entry has been added with the `id`";
//$this->gotoPage("http://".$this->getMyUrl()."/COCONUT/dietary/addDiet.php?username=$username");
} else {
    echo "There was a problem:<br />$query<br />{$sql->error}";
}
 
/* close our connection */
$sql->close();
}




public function returnInventory($itemNo,$registrationNo,$description,$qty,$returnDetails_nod,$returnNOD) {

/* make your connection */
$sql = new mysqli($this->host,$this->username,$this->password,$this->database);
 
/* we will just create an insert query here, and use it,
normally this would be done by form submission or other means */
$query = "insert into returnInventory(itemNo,registrationNo,description,qty,returnDetails_nod,returnNOD) values('$itemNo','$registrationNo','$description','$qty','$returnDetails_nod','$returnNOD')";

 
if ( $sql->query($query) ) {
   //echo "A new entry has been added with the `id`";
//$this->gotoPage("http://".$this->getMyUrl()."/COCONUT/dietary/addDiet.php?username=$username");
} else {
    echo "There was a problem:<br />$query<br />{$sql->error}";
}
 
/* close our connection */
$sql->close();
}



public function showReturnz($registrationNo,$username,$module,$month,$day,$year,$fromTime_hour,$fromTime_minutes,$fromTime_seconds,$toTime_hour,$toTime_minutes,$toTime_seconds,$nod) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select description,returnNo,itemNo,qty from returnInventory where registrationNo = '$registrationNo' and returnDetails_PHARMACY = ''  ") or die("Query fail: " . mysqli_error()); 

$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Description");
$this->coconutTableHeader("QTY");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/availableMedicine/returnNow.php?registrationNo=$registrationNo&itemNo=$row[itemNo]&returnNo=$row[returnNo]&username=$username&module=$module&month=$month&day=$day&year=$year&fromTime_hour=$fromTime_hour&fromTime_minutes=$fromTime_minutes&fromTime_seconds=$fromTime_seconds&toTime_hour=$toTime_hour&toTime_minutes=$toTime_minutes&toTime_seconds=$toTime_seconds&nod=$nod'>".$row['description']."</a>");
$this->coconutTableData($row['qty']);
$this->coconutTableRowStop();
}
$this->coconutTableStop();


}


public $walkInSearch_price;

public function walkInSearch($description) {

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select description,quantity,inventoryType,Added,unitcost,inventoryCode from inventory where description like '$description%%%%%%%' or genericName like '$description%%%%%%' and status not like 'DELETED_%%%%%' and quantity > 0  ") or die("Query fail: " . mysqli_error()); 

$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Description");
$this->coconutTableHeader("QTY");
$this->coconutTableHeader("Price");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {

if( $row['inventoryType'] == "medicine" ) {
$pricez = preg_split ("/\_/", $row['Added']); 
$this->walkInSearch_price = $pricez[1];
}else {
$this->walkInSearch_price = $row['unitcost'];
}

$this->coconutTableRowStart();
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/Pharmacy/walkin/add.php?inventoryCode=$row[inventoryCode]'>".$row['description']."</a>");
$this->coconutTableData($row['quantity']);
$this->coconutTableData(number_format($this->walkInSearch_price,2));
$this->coconutTableRowStop();
}
$this->coconutTableStop();

}






public function radioApproval($physician,$username,$checkz,$doctorCode,$module) {

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select radioSavedNo,registrationNo,itemNo,physician from radioSavedReport where approved != 'yes' and physician = '$physician' group by itemNo ") or die("Query fail: " . mysqli_error()); 

$this->coconutFormStart("get","http://".$this->getMyUrl()."/COCONUT/radiology/checkedApproved.php");
$this->coconutHidden("username",$username);
$this->coconutHidden("doctorCode",$doctorCode);
$this->coconutHidden("module",$module);
$this->coconutHidden("checkz",$checkz);
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Patient");
$this->coconutTableHeader("Procedure");
$this->coconutTableHeader("Details");
$this->coconutTableHeader("");
//$this->coconutTableHeader("");
$this->coconutTableHeader("");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
$this->getPatientProfile($row['registrationNo']);
$this->coconutTableRowStart();
$this->coconutTableData($this->getPatientRecord_lastName().", ".$this->getPatientRecord_firstName() );
$this->coconutTableData($this->selectNow("patientCharges","description","itemNo",$row['itemNo']));
$this->coconutTableData($this->selectNow("radioSavedReport","date","itemNo",$row['itemNo'])."@".$this->selectNow("radioSavedReport","time","itemNo",$row['itemNo']));
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/Reports/radiologyReport/radioReport_output_doctor.php?itemNo=$row[itemNo]&registrationNo=$row[registrationNo]&description=".$this->selectNow("patientCharges","description","itemNo",$row['itemNo'])."' target='_blank'><font color=red size=2>View</font></a>");
//$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/radiology/approved.php?radioSavedNo=$row[radioSavedNo]&username=$username&module=DOCTOR&doctorCode=".$this->selectNow("Doctors","doctorCode","Name",$row['physician'])."'><font color=blue size=2>Approved</font></a>");

if( $checkz == "yes" ) {
$this->coconutTableData("<input type='checkbox' name='radioSavedNo[]' value='$row[radioSavedNo]' checked>");
}else {
$this->coconutTableData("<input type='checkbox' name='radioSavedNo[]' value='$row[radioSavedNo]'>");
}

$this->coconutTableRowStop();
}
$this->coconutTableStop();
echo "<Br>";
$this->coconutButton("Approved");
$this->coconutFormStop();
}




public function radioApprovedResult($month,$day,$year,$month1,$day1,$year1,$physician,$username) {

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$date = $year."-".$month."-".$day;
$date1 = $year1."-".$month1."-".$day1;

$result = mysqli_query($connection, " select radioSavedNo,registrationNo,itemNo,physician from radioSavedReport where (approvedDate between '$date' and '$date1')  and physician = '$physician' ") or die("Query fail: " . mysqli_error()); 

$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Patient");
$this->coconutTableHeader("Procedure");
$this->coconutTableHeader("Details");
$this->coconutTableHeader("");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
$this->getPatientProfile($row['registrationNo']);
$this->coconutTableRowStart();
$this->coconutTableData($this->getPatientRecord_lastName().", ".$this->getPatientRecord_firstName() );
$this->coconutTableData($this->selectNow("patientCharges","description","itemNo",$row['itemNo']));
$this->coconutTableData($this->selectNow("radioSavedReport","date","itemNo",$row['itemNo'])."@".$this->selectNow("radioSavedReport","time","itemNo",$row['itemNo']));
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/Reports/radiologyReport/radioReport_output.php?itemNo=$row[itemNo]&registrationNo=$row[registrationNo]&description=".$this->selectNow("patientCharges","description","itemNo",$row['itemNo'])."' target='_blank'><font color=red size=2>View</font></a>");
$this->coconutTableRowStop();
}
$this->coconutTableStop();

}


public function getFirstCaseRate($icdCode) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select hospital from availableICD where icdCode = '$icdCode' limit 1 ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
  {
return $row['hospital'];
}
}



public function countDeptIssued($month,$day,$year,$inventoryCode) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$datez = $year."-".$month."-".$day;

$result = mysqli_query($connection, " select SUM(quantityIssued) as qty from inventoryManager where dateIssued = '$datez' and inventoryCode = '$inventoryCode' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
  {
return $row['qty'];
}
}


public function pxReturnInventory($registrationNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select description,qty,returnDetails_nod,returnNOD,returnDetails_PHARMACY,returnPHARMACY from returnInventory where registrationNo = '$registrationNo' ") or die("Query fail: " . mysqli_error()); 


$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Description");
$this->coconutTableHeader("QTY");
$this->coconutTableHeader("Return Details");
$this->coconutTableHeader("Return By");
$this->coconutTableHeader("Pharmacy Status");
$this->coconutTableHeader("Pharmacy Staff");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->coconutTableData($row['description']);
$this->coconutTableData($row['qty']);
$this->coconutTableData($row['returnDetails_nod']);
$this->coconutTableData($row['returnNOD']);
$this->coconutTableData($row['returnDetails_PHARMACY']);
$this->coconutTableData($row['returnPHARMACY']);
$this->coconutTableRowStop();
}
$this->coconutTableStop();
}





public function radiologyPF($date,$date1,$doctors) {

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";


$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select registrationNo,itemNo,date from radioSavedReport where physician = '$doctors' and (date between '$date' and '$date1') order by date asc ") or die("Query fail: " . mysqli_error()); 

echo "<Center><br><Br><font color=red>$doctors</font><Br>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Patient");
$this->coconutTableHeader("Procedure");
$this->coconutTableHeader("Date");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
$this->getPatientProfile($row['registrationNo']);
$this->coconutTableRowStart();
$this->coconutTableData($this->getPatientRecord_lastName().", ".$this->getPatientRecord_firstName());
$this->coconutTableData($this->selectNow("patientCharges","description","itemNo",$row['itemNo']));
$this->coconutTableData($row['date']);
$this->coconutTableRowStop();
}
$this->coconutTableStop();
}



public $receiptTypeReport_total;

public function receiptTypeReport_total() {
return $this->receiptTypeReport_total;
}

public function receiptTypeReport($date,$receiptType,$username,$from,$to) {

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";


$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$title=strtoupper($receiptType);

if( $this->selectNow("registeredUser","module","username",$username) == "ADMIN" ) {
$result = mysqli_query($connection, " select registrationNo,title as receiptType,description,orNO,cashPaid,quantity from patientCharges where datePaid = '$date' and title = '$title' and (timePaid between '$from' and '$to') and status = 'PAID' order by orNO asc ") or die("Query fail: " . mysqli_error()); 
}else {
$result = mysqli_query($connection, " select registrationNo,description,orNO,title as receiptType,cashPaid,quantity from patientCharges where datePaid = '$date' and title = '$title' and paidBy = '$username' and (timePaid between '$from' and '$to') and status = 'PAID' order by orNO asc ") or die("Query fail: " . mysqli_error()); 
}

echo "<Center><br><Br>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Patient");
$this->coconutTableHeader("Particulars");
$this->coconutTableHeader("QTY");
$this->coconutTableHeader("Paid");
$this->coconutTableHeader("OR#");
$this->coconutTableHeader("Type");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
$this->getPatientProfile($row['registrationNo']);
$this->receiptTypeReport_total += $row['cashPaid'];
$this->coconutTableRowStart();
$this->coconutTableData($this->getPatientRecord_lastName().", ".$this->getPatientRecord_firstName());
$this->coconutTableData($row['description']);
$this->coconutTableData($row['quantity']);
$this->coconutTableData(number_format($row['cashPaid'],2));
$this->coconutTableData($row['orNO']);
$this->coconutTableData($row['receiptType']);
$this->coconutTableRowStop();
}
$this->coconutTableRowStart();
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("<b>".number_format($this->receiptTypeReport_total,2)."</b>");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableRowStop();
$this->coconutTableStop();
}



public $receiptTypeReport1_total;

public function receiptTypeReport1_total() {
return $this->receiptTypeReport1_total;
}

public function receiptTypeReport1($date,$receiptType,$username,$from,$to) {

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";


$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select registrationNo,paymentFor,orNO,receiptType,amountPaid from patientPayment where datePaid = '$date' and receiptType = '$receiptType' and paidBy = '$username' and (timePaid between '$from' and '$to') order by orNO asc ") or die("Query fail: " . mysqli_error()); 

echo "<Center><br><Br>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Patient");
$this->coconutTableHeader("Particulars");
$this->coconutTableHeader("Paid");
$this->coconutTableHeader("OR#");
$this->coconutTableHeader("Type");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
$this->getPatientProfile($row['registrationNo']);
$this->receiptTypeReport1_total += $row['amountPaid'];
$this->coconutTableRowStart();
$this->coconutTableData($this->getPatientRecord_lastName().", ".$this->getPatientRecord_firstName());
$this->coconutTableData($row['paymentFor']);
$this->coconutTableData(number_format($row['amountPaid'],2));
$this->coconutTableData($row['orNO']);
$this->coconutTableData($row['receiptType']);
$this->coconutTableRowStop();
}
$this->coconutTableRowStart();
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("<b>".number_format($this->receiptTypeReport1_total,2)."</b>");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableRowStop();
$this->coconutTableStop();
}





public function listOfLab($registrationNo,$username) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select itemNo,registrationNo,checkerNo from core2_laboratoryResultChecker where registrationNo = '$registrationNo' and status not like 'DELETED_%%%%%%%%%%%' order by checkerNo asc ") or die("Query fail: " . mysqli_error()); 

$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Description");
$this->coconutTableHeader("Date Released");
$this->coconutTableHeader("Time Released");
$this->coconutTableHeader("MedTech");
$this->coconutTableHeader("");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/Laboratory/resultList/resultForm_output.php?registrationNo=$registrationNo&itemNo=$row[itemNo]' style='color:black; text-decoration:none;'>".$this->selectNow("patientCharges","description","itemNo",$row['itemNo'])."</a>");
$this->coconutTableData( $this->selectNow("labSavedResult","date","itemNo",$row['itemNo']));
$this->coconutTableData( $this->selectNow("labSavedResult","time","itemNo",$row['itemNo']));
$this->coconutTableData( $this->selectNow("labSavedResult","medtech","itemNo",$row['itemNo']));
$this->coconutTableData( "<a href='http://".$this->getMyUrl()."/COCONUT/Laboratory/resultList/deleteResult.php?registrationNo=$registrationNo&username=$username&itemNo=$row[itemNo]'>".$this->coconutImages_return("delete.jpeg")."</a>" );
$this->coconutTableRowStop();
}
$this->coconutTableStop();
}




public function request2bill($registrationNo,$dateRequest,$timeRequest,$requestBy) {

/* make your connection */
$sql = new mysqli($this->host,$this->username,$this->password,$this->database);
 
/* we will just create an insert query here, and use it,
normally this would be done by form submission or other means */
$query = "insert into billingRequest(registrationNo,dateRequest,timeRequest,requestBy,status) values('$registrationNo','$dateRequest','$timeRequest','$requestBy','pending')";

 
if ( $sql->query($query) ) {
   //echo "A new entry has been added with the `id`";
$this->gotoPage("http://".$this->getMyUrl()."/COCONUT/patientProfile/patientProfile_right.php?username=$requestBy&registrationNo=$registrationNo");
} else {
    echo "There was a problem:<br />$query<br />{$sql->error}";
}
 
/* close our connection */
$sql->close();
}



public function getRequest2bill($date,$username) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select registrationNo,requestBy from billingRequest where dateRequest = '$date' and status = 'pending' ") or die("Query fail: " . mysqli_error()); 

echo "<font size=2 color=red>REQUEST TO BILL</font>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Patient");
$this->coconutTableHeader("N.O.D");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->coconutTableData("<form method='post' action='http://".$this->getMyUrl()."/COCONUT/currentPatient/patientInterface1.php?username=$username&registrationNo=$row[registrationNo]' target='_blank'><input type='submit' style='border:1px solid #000; color:red;' value='".$this->selectNow("patientRecord","lastName","patientNo",$this->selectNow("registrationDetails","patientNo","registrationNo",$row['registrationNo'])).", ".$this->selectNow("patientRecord","firstName","patientNo",$this->selectNow("registrationDetails","patientNo","registrationNo",$row['registrationNo']))."'>
<input type='hidden' name='registrationNo' value='$row[registrationNo]'>
<input type='hidden' name='username' value='$username'>
</form>");
$this->coconutTableData($row['requestBy']);
$this->coconutTableRowStop();
}
$this->coconutTableStop();
}


public function getPxNameByAttendingDoctor($doctorCode,$date,$date1,$type,$title) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select pc.registrationNo,rd.patientNo from patientCharges pc,registrationDetails rd where pc.registrationNo = rd.registrationNo and pc.chargesCode = '$doctorCode' and pc.title = 'PROFESSIONAL FEE' and pc.service = 'ATTENDING' and pc.status not like 'DELETED_%%%%' order by pc.pxName asc ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
$this->editNow("patientCharges","registrationNo",$row['registrationNo'],"pxName",$this->selectNow("patientRecord","lastName","patientNo",$this->selectNow("registrationDetails","patientNo","registrationNo",$row['registrationNo']))." ".$this->selectNow("patientRecord","firstName","patientNo",$this->selectNow("registrationDetails","patientNo","registrationNo",$row['registrationNo'])));
$this->editNow("patientCharges","registrationNo",$row['registrationNo'],"type",$this->selectNow("registrationDetails","type","registrationNo",$row['registrationNo']));

//if( $result->num_rows > 1 ) {
$this->getPxNameBasedOnDateCharged($date,$date1,$type,$row['registrationNo'],$row['patientNo'],$type,$title);
//echo "1";
//}else { echo "2"; }
}

}


public $getPxChargesByHorizontal_total;
public $getPxChargesByHorizontal_grandTotal;

public function getPxChargesByHorizontal_grandTotal() {
return $this->getPxChargesByHorizontal_grandTotal;
}

public function getPxChargesByHorizontal($date,$type,$registrationNo,$title) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select pc.description,total from patientRecord pr,registrationDetails rd,patientCharges pc where pc.registrationNo = '$registrationNo' and pc.registrationNo = rd.registrationNo and rd.patientNo = pr.patientNo and pc.dateCharge = '$date' and rd.type='$type' and pc.title='$title' and pc.status not like 'DELETED_%%%%%' ") or die("Query fail: " . mysqli_error()); 

$this->getPxChargesByHorizontal_total = 0;
while($row = mysqli_fetch_array($result))
  {
$result_array[] = "<font size=2>".$row['description']."</font> - <font size=2 color=red>".number_format($row['total'],2)."</font>";
$this->getPxChargesByHorizontal_total += $row['total'];
$this->getPxChargesByHorizontal_grandTotal += $row['total'];
}
return implode(",",$result_array); 

}


public function countDateLabRow($registrationNo,$title) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select count(dateCharge) as totalReg from patientCharges where registrationNo = '$registrationNo' and title = '$title' and status not like 'DELETED_%%%%%%' group by dateCharge  ") or die("Query fail: " . mysqli_error()); 

return $result->num_rows;

}

public function countFirstDateLab($registrationNo,$title) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select  min(dateCharge) as dateCharge from patientCharges where registrationNo = '$registrationNo' and title = '$title' and status not like 'DELETED_%%%%%%' group by dateCharge limit 1  ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
  {
return $row['dateCharge'];
}

}

public $getPxNameBasedOnDateCharged_rebateTotal;

public function getPxNameBasedOnDateCharged_rebateTotal() {
return $this->getPxNameBasedOnDateCharged_rebateTotal;
}

public function getPxNameBasedOnDateCharged($date,$date1,$type,$registrationNo,$patientNo,$type,$title) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select pc.pxName,pc.dateCharge,pc.registrationNo from patientCharges pc WHERE pc.registrationNo = '$registrationNo' and (pc.dateCharge between '$date' and '$date1') and pc.type='$type' and pc.title='$title' and pc.status not like 'DELETED_%%%%%%' and pc.pxName != '' group by pc.dateCharge ORDER BY dateCharge asc ") or die("Query fail: " . mysqli_error()); 


while($row = mysqli_fetch_array($result))
  {
$this->coconutTableRowStart();
if( $this->countDateLabRow($registrationNo,$title) > 1 ) {

if( $this->countFirstDateLab($registrationNo,$title) == $row['dateCharge'] ) {
$this->coconutTableData("<font size=2>".$row['pxName']."</font>");
}else {
$this->coconutTableData("<font size=2 color=white>".$row['pxName']."</font>");
}

}else {
$this->coconutTableData("<font size=2>".$row['pxName']."</font>");
}
$this->coconutTableData("<font size=2>".$row['dateCharge']."</font>");
echo "<td width='40%'>". $this->getPxChargesByHorizontal($row['dateCharge'],$type,$registrationNo,$title)."</td>";

$this->coconutTableData(number_format(($this->getPxChargesByHorizontal_total),2));
$this->coconutTableData( number_format(($this->getPxChargesByHorizontal_total * 0.05 ),2));
$this->getPxNameBasedOnDateCharged_rebateTotal += ( $this->getPxChargesByHorizontal_total * 0.05 );
$this->coconutTableRowStop();
}

}




public function getRequestedDept($inventoryCode) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select description,quantity,inventoryLocation,dateAdded,addedBy from inventory where from_inventoryCode = '$inventoryCode' ") or die("Query fail: " . mysqli_error()); 

echo "<br><br><Center>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Description");
$this->coconutTableHeader("QTY");
$this->coconutTableHeader("Dept");
$this->coconutTableHeader("Added");
$this->coconutTableHeader("User");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->coconutTableData($row['description']);
$this->coconutTableData($row['quantity']);
$this->coconutTableData($row['inventoryLocation']);
$this->coconutTableData($row['dateAdded']);
$this->coconutTableData($row['addedBy']);
$this->coconutTableRowStop();
}
$this->coconutTableStop();
}


public function getRoomForDischarged($registrationNo,$username) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select itemNo,description from patientCharges where registrationNo='$registrationNo' and title = 'Room And Board' and status = 'UNPAID' ") or die("Query fail: " . mysqli_error()); 

echo "<br><br><Center>";
$this->coconutFormStart("get","discharge_new1.php");
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
$this->coconutTableData("<input type='checkbox' name='itemNo[]' value='$row[itemNo]' checked>");
$this->coconutTableData($row['description']);
$this->coconutTableRowStop();
}
$this->coconutTableStop();
echo "<br><br>";
echo "Discharged Date ";
$this->coconutComboBoxStart_short("monthDischarged");
echo "<option value='".date("m")."'>".date("M")."</option>";
echo "<option value='01'>Jan</option>";
echo "<option value='02'>Feb</option>";
echo "<option value='03'>Mar</option>";
echo "<option value='04'>Apr</option>";
echo "<option value='05'>May</option>";
echo "<option value='06'>Jun</option>";
echo "<option value='07'>Jul</option>";
echo "<option value='08'>Aug</option>";
echo "<option value='09'>Sep</option>";
echo "<option value='10'>Oct</option>";
echo "<option value='11'>Nov</option>";
echo "<option value='12'>Dec</option>";
$this->coconutComboBoxStop();
echo "-";
$this->coconutComboBoxStart_short("dayDischarged");
echo "<option value='".date("d")."'>".date("d")."</option>";
for($x=1;$x<32;$x++) {

if($x < 10) {
echo "<option value='0$x'>$x</option>";
}else {
echo "<option value='$x'>$x</option>";
}

}

$this->coconutComboBoxStop();
echo "-";
$this->coconutTextBox_short("yearDischarged",date("Y"));
echo "<br><br>";
$this->coconutButton("Discharged");
$this->coconutFormStop();

}


public function checkAllReturns($registrationNo,$username) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select itemNo from patientCharges where status = 'Return' and registrationNo = '$registrationNo' ") or die("Query fail: " . mysqli_error()); 

if( $result->num_rows > 0 ) {
echo "<font color=red>Unable to Discharge There are pending returns.</font>";
$this->showReturnsBeforeDischarge($registrationNo);
}else {
$this->getRoomForDischarged($registrationNo,$username);
}

}


public function checkAllReturns_notification($registrationNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select itemNo from patientCharges where status = 'Return' and registrationNo = '$registrationNo' ") or die("Query fail: " . mysqli_error()); 

if( $result->num_rows > 0 ) {
return "<font color=red size=4>Patient has a pending returns</font>";
}else { }

}

public function checkForDispense_notification($registrationNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select itemNo from patientCharges where status = 'UNPAID' and departmentStatus ='' and registrationNo = '$registrationNo' and (title = 'MEDICINE' or title = 'SUPPLIES') ") or die("Query fail: " . mysqli_error()); 

if( $result->num_rows > 0 ) {
return "<font color=red size=4>Patient has a pending meds/sup to dispense</font>";
}else { }

}


public function showReturnsBeforeDischarge($registrationNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select  description from patientCharges where status = 'Return' and registrationNo = '$registrationNo'  ") or die("Query fail: " . mysqli_error()); 

$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Description");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->coconutTableData("&nbsp;".$row['description']);
$this->coconutTableRowStop();
}

}


public function removePending($registrationNo,$username) {

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

mysql_query("UPDATE patientCharges SET status = 'DELETED_PENDING_".$username."[".date("Y-m-d")."]'
WHERE registrationNo = '$registrationNo' and (title = 'MEDICINE' or title = 'SUPPLIES') and departmentStatus = '' ");

mysql_close($con);
}


public $getPatientChargesForNewSOA_total_total;
public $getPatientChargesForNewSOA_total_disc;
public $getPatientChargesForNewSOA_total_cashUnpaid;
public $getPatientChargesForNewSOA_total_company;
public $getPatientChargesForNewSOA_total_phic;

public $getPatientChargesForNewSOA_inventory_total_total;
public $getPatientChargesForNewSOA_inventory_total_disc;
public $getPatientChargesForNewSOA_inventory_total_cashUnpaid;
public $getPatientChargesForNewSOA_inventory_total_company;
public $getPatientChargesForNewSOA_inventory_total_phic;




public function getPatientChargesForNewSOA_total_total() {
return $this->getPatientChargesForNewSOA_total_total;
}
public function getPatientChargesForNewSOA_total_disc() {
return $this->getPatientChargesForNewSOA_total_disc;
}
public function getPatientChargesForNewSOA_total_cashUnpaid() {
return $this->getPatientChargesForNewSOA_total_cashUnpaid;
}
public function getPatientChargesForNewSOA_total_company() {
return $this->getPatientChargesForNewSOA_total_company;
}
public function getPatientChargesForNewSOA_total_phic() {
return $this->getPatientChargesForNewSOA_total_phic;
}


public function getPatientChargesForNewSOA_inventory_total_total() {
return $this->getPatientChargesForNewSOA_inventory_total_total;
}
public function getPatientChargesForNewSOA_inventory_total_disc() {
return $this->getPatientChargesForNewSOA_inventory_total_disc;
}
public function getPatientChargesForNewSOA_inventory_total_cashUnpaid() {
return $this->getPatientChargesForNewSOA_inventory_total_cashUnpaid;
}
public function getPatientChargesForNewSOA_inventory_total_company() {
return $this->getPatientChargesForNewSOA_inventory_total_company;
}
public function getPatientChargesForNewSOA_inventory_total_phic() {
return $this->getPatientChargesForNewSOA_inventory_total_phic;
}

public function getPatientChargesForNewSOA($registrationNo,$mode) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


if( $mode == "inventory" ) {
$result = mysqli_query($connection, " SELECT pc.chargesCode,pc.quantity,pc.description,pc.quantity,pc.sellingPrice,pc.dateCharge,pc.discount,pc.total,pc.cashPaid,pc.company,pc.phic,pc.cashUnpaid,pc.title,rd.* from patientCharges pc,registrationDetails rd WHERE rd.registrationNo = '$registrationNo' and pc.registrationNo = rd.registrationNo and pc.status = 'UNPAID' and (pc.title = 'MEDICINE' or pc.title = 'SUPPLIES') and departmentStatus like 'dispensedBy%%%%%%%%%' order by pc.title asc   ") or die("Query fail: " . mysqli_error()); 
}else {
$result = mysqli_query($connection, " SELECT pc.chargesCode,pc.quantity,pc.description,pc.quantity,pc.sellingPrice,pc.dateCharge,pc.discount,pc.total,pc.cashPaid,pc.company,pc.phic,pc.cashUnpaid,pc.title,rd.* from patientCharges pc,registrationDetails rd WHERE rd.registrationNo = '$registrationNo' and pc.registrationNo = rd.registrationNo and (pc.status = 'UNPAID' or pc.status = 'Discharged') and (pc.title != 'MEDICINE' and pc.title != 'SUPPLIES') order by pc.title asc   ") or die("Query fail: " . mysqli_error()); 
}


while($row = mysqli_fetch_array($result))
  {

if( $mode == "inventory" ) {
$this->getPatientChargesForNewSOA_inventory_total_total += $row['total'];
$this->getPatientChargesForNewSOA_inventory_total_disc += $row['discount'];
$this->getPatientChargesForNewSOA_inventory_total_cashUnpaid += $row['cashUnpaid'];
$this->getPatientChargesForNewSOA_inventory_total_company += $row['company'];
$this->getPatientChargesForNewSOA_inventory_total_phic += $row['phic'];
}else{
$this->getPatientChargesForNewSOA_total_total += $row['total'];
$this->getPatientChargesForNewSOA_total_disc += $row['discount'];
$this->getPatientChargesForNewSOA_total_cashUnpaid += $row['cashUnpaid'];
$this->getPatientChargesForNewSOA_total_company += $row['company'];
$this->getPatientChargesForNewSOA_total_phic += $row['phic'];
}

echo "<tr>";
echo "<td>&nbsp;".$row['dateCharge']."</td>";
//admission kit change to miscellaneous kpag ang title ay miscellaneous
if( $row['description'] == "admission kit" ) {
echo "<td>&nbsp;<font class='heading' color=red>Miscellaneous</font>&nbsp;</td>";
}else {
echo "<td>&nbsp;<font class='heading'>".$row['description']."</font>&nbsp;</td>";
}
echo "<td>&nbsp;".$row['quantity']."</td>";
echo "<td>&nbsp;".$row['sellingPrice']."</td>";
echo "<td>&nbsp;".$row['discount']."</td>";
echo "<td>&nbsp;".$row['total']."</td>";
echo "<td>&nbsp;".$row['cashUnpaid']."</td>";
echo "<td>&nbsp;".$row['company']."</td>";
echo "<td>&nbsp;".$row['phic']."</td>";
echo "</tr>";
}

}





public function checkIfTitleExist_newDetailed($registrationNo,$title) {

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$result = mysql_query("SELECT title from patientCharges where registrationNo = '$registrationNo' and title = '$title' and status not like 'DELETED%%%%' ");

while($row = mysql_fetch_array($result))
  {
return mysql_num_rows($result);
  }

}


public function checkIfTitleExist_newDetailed_opd($registrationNo,$title) {

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);

$result = mysql_query("SELECT title from patientCharges where registrationNo = '$registrationNo' and title = '$title' and status not like 'DELETED%%%%%' ");

while($row = mysql_fetch_array($result))
  {
return mysql_num_rows($result);
  }

}



public $newDetailed_inventory_total;
public $newDetailed_inventory_pd;
public $newDetailed_inventory_disc;
public $newDetailed_inventory_unpaid;
public $newDetailed_inventory_phic;
public $newDetailed_inventory_hmo;

public function newDetailed_inventory_total() {
return $this->newDetailed_inventory_total;
}

public function newDetailed_inventory_pd() {
return $this->newDetailed_inventory_pd;
}

public function newDetailed_inventory_disc() {
return $this->newDetailed_inventory_disc;
}

public function newDetailed_inventory_unpaid() {
return $this->newDetailed_inventory_unpaid;
}

public function newDetailed_inventory_phic() {
return $this->newDetailed_inventory_phic;
}

public function newDetailed_inventory_hmo() {
return $this->newDetailed_inventory_hmo;
}



public function newDetailed_inventory($registrationNo,$title) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " SELECT pc.status,pc.dateCharge,pc.itemNo,pc.description,pc.quantity,pc.sellingPrice,pc.total,pc.cashPaid,pc.discount,pc.cashUnpaid,pc.company,pc.phic from patientCharges pc,registrationDetails rd WHERE rd.registrationNo = '$registrationNo' and pc.registrationNo = rd.registrationNo and pc.title = '$title' and pc.status IN ('UNPAID','PAID') order by pc.dateCharge asc   ") or die("Query fail: " . mysqli_error()); 

$this->newDetailed_inventory_total=0;
$this->newDetailed_inventory_pd=0;
$this->newDetailed_inventory_disc=0;
$this->newDetailed_inventory_unpaid=0;
$this->newDetailed_inventory_phic=0;
$this->newDetailed_inventory_hmo=0;

while($row = mysqli_fetch_array($result))
  {

$this->newDetailed_inventory_total += $row['total'];
$this->newDetailed_inventory_pd += $row['cashPaid'];
$this->newDetailed_inventory_disc += $row['discount'];
$this->newDetailed_inventory_unpaid += $row['cashUnpaid'];
$this->newDetailed_inventory_phic += $row['phic'];
$this->newDetailed_inventory_hmo += $row['company'];

echo "<tr>";
echo "<td>&nbsp;<font size=2>".$row['dateCharge']."</font></td>";
//echo "<td>&nbsp;<font size=2>".$row['itemNo']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['description']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['quantity']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['sellingPrice']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['total']."</font></td>";
echo "</tr>";
}

}



public $newDetailed_inventory_wholeRecord_total;
public $newDetailed_inventory_wholeRecord_pd;
public $newDetailed_inventory_wholeRecord_disc;
public $newDetailed_inventory_wholeRecord_unpaid;
public $newDetailed_inventory_wholeRecord_phic;
public $newDetailed_inventory_wholeRecord_hmo;

public function newDetailed_inventory_wholeRecord_total() {
return $this->newDetailed_inventory_wholeRecord_total;
}

public function newDetailed_inventory_wholeRecord_pd() {
return $this->newDetailed_inventory_wholeRecord_pd;
}

public function newDetailed_inventory_wholeRecord_disc() {
return $this->newDetailed_inventory_wholeRecord_disc;
}

public function newDetailed_inventory_wholeRecord_unpaid() {
return $this->newDetailed_inventory_wholeRecord_unpaid;
}

public function newDetailed_inventory_wholeRecord_phic() {
return $this->newDetailed_inventory_wholeRecord_phic;
}

public function newDetailed_inventory_wholeRecord_hmo() {
return $this->newDetailed_inventory_wholeRecord_hmo;
}


public function newDetailed_inventory_wholeRecord($patientNo,$title) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " SELECT pc.status,pc.dateCharge,pc.itemNo,pc.description,pc.quantity,pc.sellingPrice,pc.total,pc.cashPaid,pc.discount,pc.cashUnpaid,pc.company,pc.phic,pc.amountPaidFromCreditCard from patientCharges pc WHERE pc.registrationNo in ((select registrationNo from registrationDetails where patientNo = '$patientNo')) and pc.title = '$title' and pc.status in ('PAID','UNPAID') order by pc.dateCharge asc   ") or die("Query fail: " . mysqli_error()); 

$this->newDetailed_inventory_wholeRecord_total=0;
$this->newDetailed_inventory_wholeRecord_pd=0;
$this->newDetailed_inventory_wholeRecord_disc=0;
$this->newDetailed_inventory_wholeRecord_unpaid=0;
$this->newDetailed_inventory_wholeRecord_phic=0;
$this->newDetailed_inventory_wholeRecord_hmo=0;

while($row = mysqli_fetch_array($result))
  {

$this->newDetailed_inventory_wholeRecord_total += $row['total'];
$this->newDetailed_inventory_wholeRecord_pd += ($row['cashPaid'] + $row['amountPaidFromCreditCard']);
$this->newDetailed_inventory_wholeRecord_disc += $row['discount'];
$this->newDetailed_inventory_wholeRecord_unpaid += $row['cashUnpaid'];
$this->newDetailed_inventory_wholeRecord_phic += $row['phic'];
$this->newDetailed_inventory_wholeRecord_hmo += $row['company'];

echo "<tr>";
echo "<td>&nbsp;<font size=2>".$row['dateCharge']."</font></td>";
//echo "<td>&nbsp;<font size=2>".$row['itemNo']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['description']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['quantity']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['sellingPrice']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['total']."</font></td>";
echo "</tr>";
}

}



public $newDetailed_inventory_package_total;
public $newDetailed_inventory_package_phic;
public $newDetailed_inventory_package_company;

public function newDetailed_inventory_package_total() {
return $this->newDetailed_inventory_package_total;
}

public function newDetailed_inventory_package_phic() {
return $this->newDetailed_inventory_package_phic;
}

public function newDetailed_inventory_package_company() {
return $this->newDetailed_inventory_package_company;
}

public function newDetailed_inventory_package($registrationNo,$title,$condition) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " SELECT pc.status,pc.dateCharge,pc.itemNo,pc.description,pc.quantity,pc.sellingPrice,pc.total,pc.cashUnpaid,pc.phic,pc.company from patientCharges pc,registrationDetails rd WHERE rd.registrationNo = '$registrationNo' and pc.registrationNo = rd.registrationNo and pc.title = '$title' and departmentStatus != '' and pc.inventoryFrom $condition 'OB PACKAGE' order by pc.dateCharge asc   ") or die("Query fail: " . mysqli_error()); 

$this->newDetailed_inventory_package_total=0;
$this->newDetailed_inventory_package_phic=0;
$this->newDetailed_inventory_package_company=0;

while($row = mysqli_fetch_array($result))
  {

if( $row['status'] == "UNPAID" ) {
$this->newDetailed_inventory_package_total += $row['cashUnpaid'];
$this->newDetailed_inventory_package_phic += $row['phic'];
$this->newDetailed_inventory_package_company += $row['company'];
}else { }

echo "<tr>";
echo "<td>&nbsp;<font size=2>".$row['dateCharge']."</font></td>";
//echo "<td>&nbsp;<font size=2>".$row['itemNo']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['description']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['quantity']."</font></td>";
echo "<td>&nbsp;<font size=2>0.00</font></td>";
echo "<td>&nbsp;<font size=2>".$row['total']."</font></td>";

if( $row['status'] == 'UNPAID' ) {
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<font size=2>".$row['cashUnpaid']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['phic']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['company']."</font></td>";
}else {
echo "<td>&nbsp;<font size=2>".$row['total']."</font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
}


echo "</tr>";
}

}


public $newDetailed_inventory_company1_total;
public $newDetailed_inventory_company1_phic;
public $newDetailed_inventory_company1_company;
public $newDetailed_inventory_company1_company1;

public function newDetailed_inventory_company1_total() {
return $this->newDetailed_inventory_company1_total;
}

public function newDetailed_inventory_company1_phic() {
return $this->newDetailed_inventory_company1_phic;
}

public function newDetailed_inventory_company1_company() {
return $this->newDetailed_inventory_company1_company;
}

public function newDetailed_inventory_company1_company1() {
return $this->newDetailed_inventory_company1_company1;
}


public function newDetailed_inventory_company1($registrationNo,$title) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " SELECT pc.status,pc.dateCharge,pc.itemNo,pc.description,pc.quantity,pc.sellingPrice,pc.total,pc.cashUnpaid,pc.phic,pc.company,pc.company1 from patientCharges pc,registrationDetails rd WHERE rd.registrationNo = '$registrationNo' and pc.registrationNo = rd.registrationNo and pc.title = '$title' and departmentStatus != '' and status != 'PAID' order by pc.dateCharge asc   ") or die("Query fail: " . mysqli_error()); 

$this->newDetailed_inventory_company1_total=0;
$this->newDetailed_inventory_company1_phic=0;
$this->newDetailed_inventory_company1_company=0;
$this->newDetailed_inventory_company1_company1=0;

while($row = mysqli_fetch_array($result))
  {

if( $row['status'] == "UNPAID" ) {
$this->newDetailed_inventory_company1_total += $row['cashUnpaid'];
$this->newDetailed_inventory_company1_phic += $row['phic'];
$this->newDetailed_inventory_company1_company += $row['company'];
$this->newDetailed_inventory_company1_company1 += $row['company1'];
}else { }

echo "<tr>";
echo "<td>&nbsp;<font size=2>".$row['dateCharge']."</font></td>";
//echo "<td>&nbsp;<font size=2>".$row['itemNo']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['description']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['quantity']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['sellingPrice']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['total']."</font></td>";

if( $row['status'] == 'UNPAID' ) {
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<font size=2>".$row['cashUnpaid']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['phic']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['company']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['company1']."</font></td>";
}else {
echo "<td>&nbsp;<font size=2>".$row['total']."</font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
}


echo "</tr>";
}

}






public $newDetailed_total;
public $newDetailed_pd;
public $newDetailed_disc;
public $newDetailed_unpaid;
public $newDetailed_docPF;
public $newDetailed_phic;
public $newDetailed_hmo;


public function newDetailed_total() {
return $this->newDetailed_total;
}

public function newDetailed_pd() {
return $this->newDetailed_pd;
}

public function newDetailed_disc() {
return $this->newDetailed_disc;
}

public function newDetailed_unpaid() {
return $this->newDetailed_unpaid;
}

public function newDetailed_docPF() {
return $this->newDetailed_docPF;
}

public function newDetailed_phic() {
return $this->newDetailed_phic;
}

public function newDetailed_hmo() {
return $this->newDetailed_hmo;
}

public function newDetailed($registrationNo,$title) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " SELECT pc.status,pc.dateCharge,pc.itemNo,pc.description,pc.quantity,pc.sellingPrice,pc.total,pc.doctorsPF,pc.cashPaid,pc.discount,pc.cashUnpaid,pc.title,pc.phic,pc.company,pc.amountPaidFromCreditCard from patientCharges pc,registrationDetails rd WHERE rd.registrationNo = '$registrationNo' and pc.registrationNo = rd.registrationNo and pc.title = '$title' and pc.status not like 'DELETED%%%%%%' order by pc.dateCharge asc   ") or die("Query fail: " . mysqli_error()); 

$this->newDetailed_total=0;
$this->newDetailed_pd=0;
$this->newDetailed_disc=0;
$this->newDetailed_unpaid=0;
$this->newDetailed_docPF=0;
$this->newDetailed_phic=0;
$this->newDetailed_hmo=0;

while($row = mysqli_fetch_array($result))
  {
$this->newDetailed_total += $row['total'];
$this->newDetailed_pd += ($row['cashPaid']);
$this->newDetailed_disc += $row['discount'];
$this->newDetailed_unpaid += $row['cashUnpaid'];
$this->newDetailed_docPF += $row['doctorsPF'];
$this->newDetailed_phic += $row['phic'];
$this->newDetailed_hmo += $row['company'];


echo "<tr>";
echo "<td>&nbsp;<font size=2>".$row['dateCharge']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['description']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['quantity']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['sellingPrice']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['total']."</font></td>";
echo "</tr>";
}

}




public $newDetailed_wholeRecord_total;
public $newDetailed_wholeRecord_pd;
public $newDetailed_wholeRecord_disc;
public $newDetailed_wholeRecord_unpaid;
public $newDetailed_wholeRecord_docPF;
public $newDetailed_wholeRecord_phic;
public $newDetailed_wholeRecord_hmo;


public function newDetailed_wholeRecord_total() {
return $this->newDetailed_wholeRecord_total;
}

public function newDetailed_wholeRecord_pd() {
return $this->newDetailed_wholeRecord_pd;
}

public function newDetailed_wholeRecord_disc() {
return $this->newDetailed_wholeRecord_disc;
}

public function newDetailed_wholeRecord_unpaid() {
return $this->newDetailed_wholeRecord_unpaid;
}

public function newDetailed_wholeRecord_docPF() {
return $this->newDetailed_wholeRecord_docPF;
}

public function newDetailed_wholeRecord_phic() {
return $this->newDetailed_wholeRecord_phic;
}

public function newDetailed_wholeRecord_hmo() {
return $this->newDetailed_wholeRecord_hmo;
}

public function newDetailed_wholeRecord($patientNo,$title) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " SELECT pc.status,pc.dateCharge,pc.itemNo,pc.description,pc.quantity,pc.sellingPrice,pc.total,pc.doctorsPF,pc.cashPaid,pc.discount,pc.cashUnpaid,pc.title,pc.phic,pc.company,pc.amountPaidFromCreditCard from patientCharges pc WHERE pc.registrationNo in ((select registrationNo from registrationDetails where patientNo = '$patientNo')) and pc.title = '$title' and pc.status in ('PAID','UNPAID') order by pc.dateCharge asc   ") or die("Query fail: " . mysqli_error()); 

$this->newDetailed_wholeRecord_total=0;
$this->newDetailed_wholeRecord_pd=0;
$this->newDetailed_wholeRecord_disc=0;
$this->newDetailed_wholeRecord_unpaid=0;
$this->newDetailed_wholeRecord_docPF=0;
$this->newDetailed_wholeRecord_phic=0;
$this->newDetailed_wholeRecord_hmo=0;

while($row = mysqli_fetch_array($result))
  {
$this->newDetailed_wholeRecord_total += $row['total'];
$this->newDetailed_wholeRecord_pd += ($row['cashPaid'] + $row['amountPaidFromCreditCard'] + $row['doctorsPF']);
$this->newDetailed_wholeRecord_disc += $row['discount'];
$this->newDetailed_wholeRecord_unpaid += $row['cashUnpaid'];
$this->newDetailed_wholeRecord_docPF += $row['doctorsPF'];
$this->newDetailed_wholeRecord_phic += $row['phic'];
$this->newDetailed_wholeRecord_hmo += $row['company'];


echo "<tr>";
echo "<td>&nbsp;<font size=2>".$row['dateCharge']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['description']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['quantity']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['sellingPrice']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['total']."</font></td>";
echo "</tr>";
}

}



public $newDetailed_company1_total;
public $newDetailed_company1_phic;
public $newDetailed_company1_company;
public $newDetailed_company1_company1;

public function newDetailed_company1_total() {
return $this->newDetailed_company1_total;
}

public function newDetailed_company1_phic() {
return $this->newDetailed_company1_phic;
}

public function newDetailed_company1_company() {
return $this->newDetailed_company1_company;
}

public function newDetailed_company1_company1() {
return $this->newDetailed_company1_company1;
}




public function newDetailed_company1($registrationNo,$title) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " SELECT pc.status,pc.dateCharge,pc.itemNo,pc.description,pc.quantity,pc.sellingPrice,pc.total,pc.cashUnpaid,pc.phic,pc.company,pc.company1 from patientCharges pc,registrationDetails rd WHERE rd.registrationNo = '$registrationNo' and pc.registrationNo = rd.registrationNo and pc.title = '$title' and status != 'PAID' order by pc.dateCharge asc   ") or die("Query fail: " . mysqli_error()); 

$this->newDetailed_company1_total=0;
$this->newDetailed_company1_phic=0;
$this->newDetailed_company1_company=0;
$this->newDetailed_company1_company1=0;

while($row = mysqli_fetch_array($result))
  {
if( $row['status'] == "UNPAID" || $row['status'] == "Discharged" ) {
$this->newDetailed_company1_total += $row['cashUnpaid'];
$this->newDetailed_company1_phic += $row['phic'];
$this->newDetailed_company1_company += $row['company'];
$this->newDetailed_company1_company1 += $row['company1'];
}else { }

echo "<tr>";
echo "<td>&nbsp;<font size=2>".$row['dateCharge']."</font></td>";
//echo "<td>&nbsp;<font size=2>".$row['itemNo']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['description']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['quantity']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['sellingPrice']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['total']."</font></td>";

if( $row['status'] == 'UNPAID' ) {
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<font size=2>".$row['cashUnpaid']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['phic']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['company']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['company1']."</font></td>";
}else {
echo "<td>&nbsp;<font size=2>".$row['total']."</font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
}

echo "</tr>";
}

}




public function newDetailed_discounted($registrationNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " SELECT pc.status,pc.dateCharge,pc.itemNo,pc.description,pc.quantity,pc.sellingPrice,pc.total,pc.cashUnpaid,pc.phic,pc.company,pc.discount from patientCharges pc,registrationDetails rd WHERE rd.registrationNo = '$registrationNo' and pc.registrationNo = rd.registrationNo and status = 'PAID' and pc.discount > 0 order by pc.dateCharge asc   ") or die("Query fail: " . mysqli_error()); 

$this->newDetailed_total=0;
$this->newDetailed_phic=0;
$this->newDetailed_company=0;

while($row = mysqli_fetch_array($result))
  {
if( $row['status'] == "UNPAID" || $row['status'] == "Discharged" ) {
$this->newDetailed_total += $row['cashUnpaid'];
$this->newDetailed_phic += $row['phic'];
$this->newDetailed_company += $row['company'];
}else { }

echo "<tr>";
echo "<td>&nbsp;<font size=2>".$row['dateCharge']."</font></td>";
//echo "<td>&nbsp;<font size=2>".$row['itemNo']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['description']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['quantity']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['sellingPrice']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['total']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['discount']."</font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";

echo "</tr>";
}

}




public function countChargesCode($chargesCode,$registrationNo,$title) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

if(($title=="MEDICINE")||($title=="SUPPLIES")){
$totqty=0;
$result = mysqli_query($connection, " select quantity from patientCharges where registrationNo = '$registrationNo' and status = 'UNPAID' and chargesCode = '$chargesCode' and departmentStatus LIKE 'dispensedBy%%%%' ") or die("Query fail: " . mysqli_error()); 
while($row = mysqli_fetch_array($result))
  {
$totqty+=$row['quantity'];

}
return $totqty;
}
else{
$result = mysqli_query($connection, " select sum(quantity) as total from patientCharges where registrationNo = '$registrationNo' and status = 'UNPAID' and chargesCode = '$chargesCode' ") or die("Query fail: " . mysqli_error()); 
while($row = mysqli_fetch_array($result))
  {
return $row['total'];
}
}



}



public $detailedTotalOnly_inventory_totalCharges;
public $detailedTotalOnly_inventory_company;
public $detailedTotalOnly_inventory_cash;

public function detailedTotalOnly_inventory_totalCharges() {
return $this->detailedTotalOnly_inventory_totalCharges;
}

public function detailedTotalOnly_inventory_company() {
return $this->detailedTotalOnly_inventory_company;
}

public function detailedTotalOnly_inventory_cash() {
return $this->detailedTotalOnly_inventory_cash;
}


public function detailedTotalOnly_inventory($registrationNo,$title,$chargesCode,$username,$show,$showdate) {

  $this->detailedTotalOnly_inventory_totaltem = 0;

  $connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

  $result = mysqli_query($connection, " SELECT pc.status,pc.dateCharge,pc.itemNo,pc.chargesCode,pc.description,pc.quantity,pc.sellingPrice,pc.total,pc.cashUnpaid,pc.phic,pc.company,pc.departmentStatus,pc.title from patientCharges pc,registrationDetails rd WHERE rd.registrationNo = '$registrationNo' and pc.registrationNo = rd.registrationNo and pc.title = '$title' and departmentStatus != '' and (pc.status = 'UNPAID') and remarks = '' order by pc.dateCharge asc   ") or die("Query fail: " . mysqli_error()); 

  $this->detailedTotalOnly_inventory_totalCharges=0;
  $this->detailedTotalOnly_inventory_company=0;
  $this->detailedTotalOnly_inventory_cash=0;

  while($row = mysqli_fetch_array($result)) {


    if( $row['status'] == "UNPAID" ) {
      $this->detailedTotalOnly_inventory_totalCharges += $row['total'];
      $this->detailedTotalOnly_inventory_company += $row['company'];
      $this->detailedTotalOnly_inventory_cash += $row['cashUnpaid'];
    }else { }

    echo "<tr>";
    //echo "<td>&nbsp;<font size=2>".$row['itemNo']."</font></td>";
    if( $row['chargesCode'] == $chargesCode )  {
      echo "<td>&nbsp;<font size=2 color=red>".$this->formatDate($row['dateCharge'])."</font></td>";
      echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/SOAoption/newSOA/detailedTotalOnly_update.php?registrationNo=$registrationNo&username=$username&show=$show&showdate=$showdate&chargesCode=$row[chargesCode]' title='TOTAL QTY: ".$this->countChargesCode($row['chargesCode'],$registrationNo,$row['title'])."'><font size=2 color=red>".$row['description']."</font></a></td>";
      echo "<td>&nbsp;<font size=2 color=red>".$row['quantity']."</font></td>";
      echo "<td>&nbsp;<font size=2 color=red>".number_format($row['sellingPrice'],2)."</font></td>";
      echo "<td>&nbsp;<font size=2 color=red>".number_format($row['total'],2)."</font></td>";
    }else {
      echo "<td>&nbsp;<font size=2>".$this->formatDate($row['dateCharge'])."</font></td>";
      echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/SOAoption/newSOA/detailedTotalOnly_update.php?registrationNo=$registrationNo&username=$username&show=$show&showdate=$showdate&chargesCode=$row[chargesCode]' title='TOTAL QTY: ".$this->countChargesCode($row['chargesCode'],$registrationNo,$row['title'])."'><font size=2>".$row['description']."</font></a></td>";
      echo "<td>&nbsp;<font size=2>".$row['quantity']."</font></td>";
      echo "<td>&nbsp;<font size=2>".number_format($row['sellingPrice'],2)."</font></td>";
      echo "<td>&nbsp;<font size=2>".number_format($row['total'],2)."</font></td>";
    }
    echo "</tr>";
  }

  }


public $detailedTotalOnly_total;
public $detailedTotalOnly_company;
public $detailedTotalOnly_cash;

public function detailedTotalOnly_total() {
return $this->detailedTotalOnly_total;
}

public function detailedTotalOnly_company() {
return $this->detailedTotalOnly_company;
}

public function detailedTotalOnly_cash() {
return $this->detailedTotalOnly_cash;
}

public function detailedTotalOnly($registrationNo,$title,$chargesCode,$username,$show,$showdate) {

  $connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


  $result = mysqli_query($connection, " SELECT pc.status,pc.dateCharge,pc.itemNo,pc.chargesCode,pc.description,pc.quantity,pc.sellingPrice,pc.total,pc.cashUnpaid,pc.phic,pc.company,pc.title from patientCharges pc,registrationDetails rd WHERE rd.registrationNo = '$registrationNo' and pc.registrationNo = rd.registrationNo and pc.title = '$title' and (pc.status = 'UNPAID' or pc.status = 'Discharged') order by pc.dateCharge asc   ") or die("Query fail: " . mysqli_error()); 

  $this->detailedTotalOnly_total=0;
  $this->detailedTotalOnly_company=0;
  $this->detailedTotalOnly_cash=0;

  while($row = mysqli_fetch_array($result))
  {
  if( $row['status'] == "UNPAID" || $row['status'] == "Discharged" ) {
  $this->detailedTotalOnly_total += $row['total'];
  $this->detailedTotalOnly_company += $row['company'];
  $this->detailedTotalOnly_cash += $row['cashUnpaid'];
  }else { }

  echo "<tr>";
  if( $row['chargesCode'] == $chargesCode ){
    echo "<td>&nbsp;<font size=2 color=red>".$this->formatDate($row['dateCharge'])."</font></td>";
    //echo "<td>&nbsp;<font size=2>".$row['itemNo']."</font></td>";
    echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/SOAoption/newSOA/detailedTotalOnly_update.php?registrationNo=$registrationNo&username=$username&show=$show&chargesCode=$row[chargesCode]&showdate=$showdate' title='".$this->countChargesCode($row['chargesCode'],$registrationNo,$row['title'])."'><font size=2 color=red>".$row['description']."</font></a></td>";
    echo "<td>&nbsp;<font size=2 color=red>".$row['quantity']."</font></td>";
    if( $row['title']=="PROFESSIONAL FEE"){
    $pfsp=$row['sellingPrice'];
    $truepf=preg_split('[/]',$pfsp);

    echo "<td>&nbsp;<font size=2 color=red>".$truepf[0]."</font></td>";
    }
    else{
      echo "<td>&nbsp;<font size=2 color=red>".$row['sellingPrice']."</font></td>";
    } 
      echo "<td>&nbsp;<font size=2 color=red>".$row['total']."</font></td>";
  }else {
  echo "<td>&nbsp;<font size=2>".$this->formatDate($row['dateCharge'])."</font></td>";
  //echo "<td>&nbsp;<font size=2>".$row['itemNo']."</font></td>";
  echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/SOAoption/newSOA/detailedTotalOnly_update.php?registrationNo=$registrationNo&username=$username&show=$show&showdate=$showdate&chargesCode=$row[chargesCode]' title='".$this->countChargesCode($row['chargesCode'],$registrationNo,$row['title'])."'><font size=2>".$row['description']."</font></a></td>";

  if( $row['title'] == "PROFESSIONAL FEE" ) {
  echo "<td>&nbsp;</td>";
  }else {
  echo "<td>&nbsp;<font size=2>".$row['quantity']."</font></td>";
  }

  if( $row['title']=="PROFESSIONAL FEE"){
    $pfsp=$row['sellingPrice'];
    $truepf=preg_split('[/]',$pfsp);
    echo "<td>&nbsp;<font size=2>".$truepf[0]."</font></td>";
  } else{
    echo "<td>&nbsp;<font size=2>".$row['sellingPrice']."</font></td>";
  } 
    echo "<td>&nbsp;<font size=2>".$row['total']."</font></td>";
  }
  echo "</tr>";
  }

}







public $transferToCompany1_total;
public $transferToCompany1_cash;
public $transferToCompany1_company;
public $transferToCompany1_phic;
public $transferToCompany1_company1;

public function transferToCompany1($registrationNo,$mode,$category) {

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


if( $category != "" ) {

if( $mode == "cash2company1" ) {
$result = mysqli_query($connection, " select  itemNo,description,sellingPrice,quantity,total,cashUnpaid,phic,company,company1 from patientCharges where (status = 'UNPAID' or status = 'Discharged') and registrationNo = '$registrationNo' and title='$category' and cashUnpaid > 0 ") or die("Query fail: " . mysqli_error()); 
}else if( $mode == "company1_to_cash" ) {
$result = mysqli_query($connection, " select  itemNo,description,sellingPrice,quantity,total,cashUnpaid,phic,company,company1 from patientCharges where (status = 'UNPAID' or status = 'Discharged') and registrationNo = '$registrationNo' and title='$category' and company1 > 0 ") or die("Query fail: " . mysqli_error()); 
}else if( $mode == "company2company1" ) {
$result = mysqli_query($connection, " select  itemNo,description,sellingPrice,quantity,total,cashUnpaid,phic,company,company1 from patientCharges where (status = 'UNPAID' or status = 'Discharged') and registrationNo = '$registrationNo' and title='$category' and company > 0 ") or die("Query fail: " . mysqli_error()); 
}else if( $mode == "company1_to_company" ) {
$result = mysqli_query($connection, " select  itemNo,description,sellingPrice,quantity,total,cashUnpaid,phic,company,company1 from patientCharges where (status = 'UNPAID' or status = 'Discharged') and registrationNo = '$registrationNo' and title='$category' and company1 > 0 ") or die("Query fail: " . mysqli_error()); 
}else if( $mode == "phic2company1" ) {
$result = mysqli_query($connection, " select  itemNo,description,sellingPrice,quantity,total,cashUnpaid,phic,company,company1 from patientCharges where (status = 'UNPAID' or status = 'Discharged') and registrationNo = '$registrationNo' and title='$category' and phic > 0 ") or die("Query fail: " . mysqli_error()); 
}else if( $mode == "company1_to_phic" ) {
$result = mysqli_query($connection, " select  itemNo,description,sellingPrice,quantity,total,cashUnpaid,phic,company,company1 from patientCharges where (status = 'UNPAID' or status = 'Discharged') and registrationNo = '$registrationNo' and title = '$category' and company1 > 0 ") or die("Query fail: " . mysqli_error()); 
}else {
$result = mysqli_query($connection, " select  itemNo,description,sellingPrice,quantity,total,cashUnpaid,phic,company,company1 from patientCharges where (status = 'UNPAID' or status = 'Discharged') and registrationNo = '$registrationNo' and title='$category'  ") or die("Query fail: " . mysqli_error()); 
}


}else {

if( $mode == "cash2company1" ) {
$result = mysqli_query($connection, " select  itemNo,description,sellingPrice,quantity,total,cashUnpaid,phic,company,company1 from patientCharges where (status = 'UNPAID' or status = 'Discharged') and registrationNo = '$registrationNo' and cashUnpaid > 0 ") or die("Query fail: " . mysqli_error()); 
}else if( $mode == "company1_to_cash" ) {
$result = mysqli_query($connection, " select  itemNo,description,sellingPrice,quantity,total,cashUnpaid,phic,company,company1 from patientCharges where (status = 'UNPAID' or status = 'Discharged') and registrationNo = '$registrationNo' and company1 > 0 ") or die("Query fail: " . mysqli_error()); 
}else if( $mode == "company2company1" ) {
$result = mysqli_query($connection, " select  itemNo,description,sellingPrice,quantity,total,cashUnpaid,phic,company,company1 from patientCharges where (status = 'UNPAID' or status = 'Discharged') and registrationNo = '$registrationNo' and company > 0 ") or die("Query fail: " . mysqli_error()); 
}else if( $mode == "company1_to_company" ) {
$result = mysqli_query($connection, " select  itemNo,description,sellingPrice,quantity,total,cashUnpaid,phic,company,company1 from patientCharges where (status = 'UNPAID' or status = 'Discharged') and registrationNo = '$registrationNo' and company1 > 0 ") or die("Query fail: " . mysqli_error()); 
}else if( $mode == "phic2company1" ) {
$result = mysqli_query($connection, " select  itemNo,description,sellingPrice,quantity,total,cashUnpaid,phic,company,company1 from patientCharges where (status = 'UNPAID' or status = 'Discharged') and registrationNo = '$registrationNo' and phic > 0 ") or die("Query fail: " . mysqli_error()); 
}else if( $mode == "company1_to_phic" ) {
$result = mysqli_query($connection, " select  itemNo,description,sellingPrice,quantity,total,cashUnpaid,phic,company,company1 from patientCharges where (status = 'UNPAID' or status = 'Discharged') and registrationNo = '$registrationNo' and company1 > 0 ") or die("Query fail: " . mysqli_error()); 
}else {
$result = mysqli_query($connection, " select  itemNo,description,sellingPrice,quantity,total,cashUnpaid,phic,company,company1 from patientCharges where (status = 'UNPAID' or status = 'Discharged') and registrationNo = '$registrationNo'  ") or die("Query fail: " . mysqli_error()); 
}

}


$this->coconutFormStart("get","transferNow.php");
$this->coconutHidden("registrationNo",$registrationNo);
$this->coconutHidden("mode",$mode);
echo "<center><br><font color=red>$mode</font>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("");
$this->coconutTableHeader("Description");
$this->coconutTableHeader("Price");
$this->coconutTableHeader("QTY");
$this->coconutTableHeader("Total");
$this->coconutTableHeader("CASH");
$this->coconutTableHeader("PHIC");
$this->coconutTableHeader("COMPANY");
$this->coconutTableHeader($this->selectNow("registrationDetails","company1","registrationNo",$registrationNo));
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {

$this->transferToCompany1_total += $row['total'];
$this->transferToCompany1_cash += $row['cashUnpaid'];
$this->transferToCompany1_company += $row['company'];
$this->transferToCompany1_phic += $row['phic'];
$this->transferToCompany1_company1 += $row['company1'];

$this->coconutTableRowStart();
$this->coconutTableData("&nbsp;<input type='checkbox' name='itemNo[]' value='".$row['itemNo']."' checked=checked>");
$this->coconutTableData("&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/additionalCompany/editCharges.php?itemNo=$row[itemNo]&description=$row[description]&cashUnpaid=$row[cashUnpaid]&company=$row[company]&phic=$row[phic]&company1=$row[company1]' style='text-decoration:none; color:black;'>".$row['description']."</a>");
$this->coconutTableData("&nbsp;".$row['sellingPrice']);
$this->coconutTableData("&nbsp;".$row['quantity']);
$this->coconutTableData("&nbsp;".$row['total']);
$this->coconutTableData("&nbsp;".$row['cashUnpaid']);
$this->coconutTableData("&nbsp;".$row['phic']);
$this->coconutTableData("&nbsp;".$row['company']);
$this->coconutTableData("&nbsp;".$row['company1']);
$this->coconutTableRowStop();
}
echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;".number_format($this->transferToCompany1_total,2)."</td>";
echo "<td>&nbsp;".number_format($this->transferToCompany1_cash,2)."</td>";
echo "<td>&nbsp;".number_format($this->transferToCompany1_phic,2)."</td>";
echo "<td>&nbsp;".number_format($this->transferToCompany1_company,2)."</td>";
echo "<td>&nbsp;".number_format($this->transferToCompany1_company1,2)."</td>";
echo "</tr>";

$this->coconutTableStop();
echo "<Br>";
$this->coconutButton("Proceed");
$this->coconutFormStop();

}




public $getLaboratoryReport_paid_total;
public $getLaboratoryReport_paid_discount;

public function getLaboratoryReport_paid_total() {
return $this->getLaboratoryReport_paid_total;
}

public function getLaboratoryReport_paid_discount() {
return $this->getLaboratoryReport_paid_discount;
}

public function getLaboratoryReport_paid($from,$to,$title) {

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select pr.lastName,pr.firstName,pc.description,rd.room,pc.cashPaid,pc.discount,pr.Senior,pc.chargeBy,pc.datePaid from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and (pc.datePaid between '$from' and '$to') and pc.title='$title' and pc.status = 'PAID' order by datePaid asc   ") or die("Query fail: " . mysqli_error()); 

echo "<Br><br><font size=4>Paid via Cash</font>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Date");
$this->coconutTableHeader("Patient");
$this->coconutTableHeader("Particulars");
$this->coconutTableHeader("Room");
$this->coconutTableHeader("Amt Pd");
$this->coconutTableHeader("Disc");
$this->coconutTableHeader("Senior");
$this->coconutTableHeader("chargeBy");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {

$this->getLaboratoryReport_paid_total += $row['cashPaid'];
$this->getLaboratoryReport_paid_discount += $row['discount'];

$this->coconutTableRowStart();
$this->coconutTableData($row['datePaid']);
$this->coconutTableData("&nbsp;".$row['lastName'].", ".$row['firstName']);
$this->coconutTableData($row['description']);
$this->coconutTableData($row['room']);
$this->coconutTableData(number_format($row['cashPaid'],2));
if( $row['discount'] > 0 ) {
$this->coconutTableData(number_format($row['discount'],2));
}else {
$this->coconutTableData("&nbsp;");
}
$this->coconutTableData($row['Senior']);
$this->coconutTableData($row['chargeBy']);
$this->coconutTableRowStop();
}
$this->coconutTableRowStart();
$this->coconutTableData("&nbsp;");
$this->coconutTableData("&nbsp;<B>TOTAL</b>");
$this->coconutTableData("&nbsp;");
$this->coconutTableData("&nbsp;");
$this->coconutTableData("&nbsp;".number_format($this->getLaboratoryReport_paid_total,2));
$this->coconutTableData("&nbsp;".number_format($this->getLaboratoryReport_paid_discount,2));
$this->coconutTableData("&nbsp;");
$this->coconutTableData("&nbsp;");
$this->coconutTableRowStop();
$this->coconutTableStop();

}


public $getLaboratoryReport_discharged_total;
public $getLaboratoryReport_discharged_phic;
public $getLaboratoryReport_discharged_company;
public $getLaboratoryReport_discharged_company1;
public $getLaboratoryReport_discharged_cashUnpaid;

public function getLaboratoryReport_discharged($from,$to,$title) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select pr.lastName,pr.firstName,rd.dateUnregistered,rd.room,rd.registrationNo from patientRecord pr,registrationDetails rd where pr.patientNo = rd.patientNo and rd.type='IPD' and (rd.dateUnregistered between '$from' and '$to') order by dateUnregistered asc  ") or die("Query fail: " . mysqli_error()); 


echo "<br><br><font size=4>Paid via Discharged</font>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Discharged");
$this->coconutTableHeader("Patient");
$this->coconutTableHeader("Room");
$this->coconutTableHeader("Cash");
$this->coconutTableHeader("PHIC");
$this->coconutTableHeader("Company");
$this->coconutTableHeader("Company1");
$this->coconutTableHeader("Total");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {

$this->getLaboratoryReport_discharged_total += $this->getTotal("total","LABORATORY",$row['registrationNo']);
$this->getLaboratoryReport_discharged_phic += $this->getTotal("phic","LABORATORY",$row['registrationNo']);
$this->getLaboratoryReport_discharged_company += $this->getTotal("company","LABORATORY",$row['registrationNo']);
$this->getLaboratoryReport_discharged_company1 += $this->getTotal("company1","LABORATORY",$row['registrationNo']);
$this->getLaboratoryReport_discharged_cashUnpaid += $this->getTotal("cashUnpaid","LABORATORY",$row['registrationNo']);


$this->coconutTableRowStart();
$this->coconutTableData("&nbsp;".$row['dateUnregistered']);
$this->coconutTableData("&nbsp;".$row['lastName'].", ".$row['firstName']);
$this->coconutTableData("&nbsp;".$row['room']);

if( $this->getTotal("cashUnpaid","LABORATORY",$row['registrationNo']) > 0 ) {
$this->coconutTableData("&nbsp;".number_format($this->getTotal("cashUnpaid","LABORATORY",$row['registrationNo']),2));
}else {
$this->coconutTableData("&nbsp;");
}

if( $this->getTotal("phic","LABORATORY",$row['registrationNo']) > 0 ) {
$this->coconutTableData("&nbsp;".number_format($this->getTotal("phic","LABORATORY",$row['registrationNo']),2));
}else {
$this->coconutTableData("&nbsp;");
}

if( $this->getTotal("company","LABORATORY",$row['registrationNo']) > 0 ) {
$this->coconutTableData("&nbsp;".number_format($this->getTotal("company","LABORATORY",$row['registrationNo']),2));
}else {
$this->coconutTableData("&nbsp;");
}

if( $this->getTotal("company1","LABORATORY",$row['registrationNo']) > 0 ) {
$this->coconutTableData("&nbsp;".$this->getTotal("company1","LABORATORY",$row['registrationNo']));
}else {
$this->coconutTableData("&nbsp;");
}

$this->coconutTableData("&nbsp;".number_format($this->getTotal("total","LABORATORY",$row['registrationNo']),2));
$this->coconutTableRowStop();
}
$this->coconutTableRowStart();
$this->coconutTableData("&nbsp;");
$this->coconutTableData("&nbsp;");
$this->coconutTableData("&nbsp;");
$this->coconutTableData("&nbsp;".number_format($this->getLaboratoryReport_discharged_cashUnpaid,2));
$this->coconutTableData("&nbsp;".number_format($this->getLaboratoryReport_discharged_phic,2));
$this->coconutTableData("&nbsp;".number_format($this->getLaboratoryReport_discharged_company,2));
$this->coconutTableData("&nbsp;".number_format($this->getLaboratoryReport_discharged_company1,2));
$this->coconutTableData("&nbsp;".number_format($this->getLaboratoryReport_discharged_total,2));
$this->coconutTableRowStop();
$this->coconutTableStop();

}


public $getLaboratoryReport_unpaid_cashUnpaid;
public $getLaboratoryReport_unpaid_phic;
public $getLaboratoryReport_unpaid_company;
public $getLaboratoryReport_unpaid_company1;

public function getLaboratoryReport_unpaid($from,$to,$title) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select pr.lastName,pr.firstName,pc.description,pc.cashUnpaid,pc.phic,pc.company,rd.room,pc.company1,pc.dateCharge from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and rd.dateUnregistered != '' and (pc.dateCharge between '$from' and '$to') and pc.title='$title' and status = 'UNPAID' order by dateCharge asc ") or die("Query fail: " . mysqli_error()); 


echo "<br><br>UNPAID";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("");
$this->coconutTableHeader("Patient");
$this->coconutTableHeader("Particulars");
$this->coconutTableHeader("Room");
$this->coconutTableHeader("CASH");
$this->coconutTableHeader("PHIC");
$this->coconutTableHeader("Company");
$this->coconutTableHeader("Company1");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {

$this->getLaboratoryReport_unpaid_cashUnpaid += $row['cashUnpaid'];
$this->getLaboratoryReport_unpaid_phic += $row['phic'];
$this->getLaboratoryReport_unpaid_company += $row['company'];
$this->getLaboratoryReport_unpaid_company1 += $row['company1'];

$this->coconutTableRowStart();
$this->coconutTableData("&nbsp;".$row['dateCharge']);
$this->coconutTableData("&nbsp;".$row['lastName'].", ".$row['firstName']);
$this->coconutTableData("&nbsp;".$row['description']);
$this->coconutTableData("&nbsp;".$row['room']);
if( $row['cashUnpaid'] > 0 ) {
$this->coconutTableData("&nbsp;".$row['cashUnpaid']);
}else {
$this->coconutTableData("&nbsp;");
}

if( $row['phic'] > 0 ) {
$this->coconutTableData("&nbsp;".$row['phic']);
}else {
$this->coconutTableData("&nbsp;");
}
if( $row['company'] > 0 ) {
$this->coconutTableData("&nbsp;".$row['company']);
}else {
$this->coconutTableData("&nbsp;");
}

$this->coconutTableData("&nbsp;".$row['company1']);
$this->coconutTableRowStop();
}
$this->coconutTableRowStart();
$this->coconutTableData("&nbsp;");
$this->coconutTableData("&nbsp;");
$this->coconutTableData("&nbsp;");
$this->coconutTableData("&nbsp;");
$this->coconutTableData("&nbsp;".number_format($this->getLaboratoryReport_unpaid_cashUnpaid,2));
$this->coconutTableData("&nbsp;".number_format($this->getLaboratoryReport_unpaid_phic,2));
$this->coconutTableData("&nbsp;".number_format($this->getLaboratoryReport_unpaid_company,2));
$this->coconutTableData("&nbsp;".number_format($this->getLaboratoryReport_unpaid_company1,2));
$this->coconutTableRowStop();
$this->coconutTableStop();

}



public function prePackage_selection($registrationNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select packageName,package_phicPrice,packagePrice from hospitalPackage group by packageName  ") or die("Query fail: " . mysqli_error()); 


while($row = mysqli_fetch_array($result))
  {
echo "<option value='".$row['packageName']."_".$row['packagePrice']."_".$row['package_phicPrice']."'>".$row['packageName']."_".$row['packagePrice']."_".$row['package_phicPrice']."</option>";
}

}


public $oxygenReport_total;

public function oxygenReport($from,$to) {

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select pr.lastName,pr.firstName,pc.description,pc.sellingPrice,pc.quantity,pc.total,pc.dateCharge,rd.room from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and (pc.dateCharge between '$from' and '$to') and pc.title = 'OXYGEN' order by pc.dateCharge,pr.lastName  ") or die("Query fail: " . mysqli_error()); 


echo "<Br><br><center>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Date");
$this->coconutTableHeader("Patient");
$this->coconutTableHeader("Room");
$this->coconutTableHeader("Particulars");
$this->coconutTableHeader("Price");
$this->coconutTableHeader("QTY");
$this->coconutTableHeader("Total");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {

$this->oxygenReport_total += $row['total'];

$this->coconutTableRowStart();
$this->coconutTableData("&nbsp;".$row['dateCharge']);
$this->coconutTableData("&nbsp;".$row['lastName'].",".$row['firstName']);
$this->coconutTableData("&nbsp;".$row['room']);
$this->coconutTableData("&nbsp;".$row['description']);
$this->coconutTableData("&nbsp;".$row['sellingPrice']);
$this->coconutTableData("&nbsp;".$row['quantity']);
$this->coconutTableData("&nbsp;".$row['total']);
$this->coconutTableRowStop();
}
$this->coconutTableRowStart();
$this->coconutTableData("&nbsp;");
$this->coconutTableData("&nbsp;");
$this->coconutTableData("&nbsp;");
$this->coconutTableData("&nbsp;<b>TOTAL</b>");
$this->coconutTableData("&nbsp;");
$this->coconutTableData("&nbsp;");
$this->coconutTableData("&nbsp;".number_format($this->oxygenReport_total,2));
$this->coconutTableRowStop();
$this->coconutTableStop();

}








public function soaSummary_payType($registrationNo,$paymentType) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select sum(amountPaid) as payment from patientPayment where registrationNo='$registrationNo' and paymentFor = '$paymentType' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
  {
return $row['payment'];
}

}

public $soaSummary_actual=0;
public $soaSummary_phic=0;
public $soaSummary_hmo=0;
public $soaSummary_pf=0;
public $soaSummary_deposit=0;
public $soaSummary_cash=0;

public function soaSummary($from,$to) {


echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select pr.lastName,pr.firstName,rd.registrationNo,rd.dateUnregistered from patientRecord pr,registrationDetails rd where pr.patientNo = rd.patientNo and (rd.dateUnregistered between '$from' and '$to') and rd.type = 'IPD' order by rd.dateUnregistered,pr.lastName asc ") or die("Query fail: " . mysqli_error()); 

echo "<br><Br><center>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Discharged");
$this->coconutTableHeader("Patient");
$this->coconutTableHeader("Actual");
$this->coconutTableHeader("PHIC");
$this->coconutTableHeader("HMO");
$this->coconutTableHeader("PF");
$this->coconutTableHeader("Deposit");
$this->coconutTableHeader("CASH");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
$actual = $this->getTotal("total","",$row['registrationNo']);
$phic = $this->getTotal("phic","",$row['registrationNo']);
$company = $this->getTotal("company","",$row['registrationNo']) + $this->getTotal("company1","",$row['registrationNo']);;
$pf = $this->getTotal("cashUnpaid","PROFESSIONAL FEE",$row['registrationNo']);
$deposit = $this->soaSummary_payType($row['registrationNo'],"DEPOSIT");
$cash = $this->soaSummary_payType($row['registrationNo'],"HOSPITAL BILL");

$this->soaSummary_actual += $this->getTotal("total","",$row['registrationNo']);
$this->soaSummary_phic += $this->getTotal("phic","",$row['registrationNo']);
$this->soaSummary_company += $this->getTotal("company","",$row['registrationNo']) + $this->getTotal("company1","",$row['registrationNo']);
$this->soaSummary_pf += $this->getTotal("cashUnpaid","PROFESSIONAL FEE",$row['registrationNo']);
$this->soaSummary_deposit += $this->soaSummary_payType($row['registrationNo'],"DEPOSIT");
$this->soaSummary_cash += $this->soaSummary_payType($row['registrationNo'],"HOSPITAL BILL");

$this->coconutTableRowStart();
$this->coconutTableData($row['dateUnregistered']);
$this->coconutTableData(strtoupper($row['lastName'].", ".$row['firstName']));
$this->coconutTableData(number_format($actual,2));
$this->coconutTableData(number_format($phic,2));
$this->coconutTableData(number_format($company,2));
$this->coconutTableData(number_format($pf,2));
$this->coconutTableData(number_format($deposit,2));
$this->coconutTableData(number_format($cash,2));
$this->coconutTableRowStop();
}
$this->coconutTableRowStart();
$this->coconutTableData("&nbsp;<b>TOTAL</b>");
$this->coconutTableData("&nbsp;".number_format($this->soaSummary_actual,2));
$this->coconutTableData("&nbsp;".number_format($this->soaSummary_phic,2));
$this->coconutTableData("&nbsp;".number_format($this->soaSummary_company,2));
$this->coconutTableData("&nbsp;".number_format($this->soaSummary_pf,2));
$this->coconutTableData("&nbsp;".number_format($this->soaSummary_deposit,2));
$this->coconutTableData("&nbsp;".number_format($this->soaSummary_cash,2));
$this->coconutTableRowStop();
$this->coconutTableStop();
}



public function adminSOA($date,$fromTime,$toTime) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select pr.lastName,pr.firstName,rd.registrationNo from patientRecord pr,registrationDetails rd where pr.patientNo = rd.patientNo and rd.dateUnregistered = '$date' and (rd.timeUnregistered between '$fromTime' and '$toTime') and rd.type = 'IPD' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
  {
$this->coconutTableRowStart();
echo "<td><form method='get' action='http://".$this->getMyUrl()."/COCONUT/patientProfile/SOAoption/summary.php' target='selection1'>
<input type='hidden' name='registrationNo' value='".$row['registrationNo']."'>
<input type='hidden' name='username' value='x'>
<input type='submit' style='width:100%; height:100px;' value='".strtoupper($row['lastName'].", ".$row['firstName'])."'>
</form>
</td>";
$this->coconutTableRowStop();
}

}


public $cashCollection_mmc_total;

public function cashCollection_mmc_total() {
return $this->cashCollection_mmc_total;
}

public function cashCollection_mmc($date,$type) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select title,amount from cashCollection where date='$date' and type='$type'  ") or die("Query fail: " . mysqli_error()); 

$this->cashCollection_mmc_total=0;

while($row = mysqli_fetch_array($result))
  {
$this->cashCollection_mmc_total += $row['amount'];
echo "<tr>";
echo "<td>".$row['title']."</td>";
echo "<td>&nbsp;</td>";
echo "<td>".number_format($row['amount'],2)."</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";
}

}


public function addNameToCashCollection($preparedBy,$billingName,$date) {

/* make your connection */
$sql = new mysqli($this->host,$this->username,$this->password,$this->database);
 
/* we will just create an insert query here, and use it,
normally this would be done by form submission or other means */
$query = "insert into cashCollection_preparedBy(preparedBy,billingName,date) values('$preparedBy','$billingName','$date')";

 
if ( $sql->query($query) ) {
   //echo "A new entry has been added with the `id`";
} else {
    echo "There was a problem:<br />$query<br />{$sql->error}";
}
 
/* close our connection */
$sql->close();
}



public function addPhilhealthDeduction($registrationNo,$hospitalBill,$professionalFee,$case) {

/* make your connection */
$sql = new mysqli($this->host,$this->username,$this->password,$this->database);
 
/* we will just create an insert query here, and use it,
normally this would be done by form submission or other means */
$query = "insert into phicDeductionAmount(registrationNo,hospitalBill,professionalFee,caserate) values('$registrationNo','$hospitalBill','$professionalFee','".$case."')";

 
if ( $sql->query($query) ) {
   //echo "A new entry has been added with the `id`";
} else {
    echo "There was a problem:<br />$query<br />{$sql->error}";
}
 
/* close our connection */
$sql->close();
}



public $reportWithOR;

public function reportWithOR($from,$to) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select pc.datePaid,pc.orNO,pc.description,pc.quantity,i.unitcost,i.suppliesUNITCOST,i.Added,i.inventoryType from patientCharges pc,inventory i where pc.chargesCode = i.inventoryCode and (pc.datePaid between '$from' and '$to') and pc.status = 'PAID' and (pc.title = 'MEDICINE' or pc.title = 'SUPPLIES') order by pc.datePaid,pc.orNO asc ") or die("Query fail: " . mysqli_error()); 

echo "<font size=3 color=red>Cash Sales of Medicine and Supplies <Br> ( $from to $to )</font>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Date");
$this->coconutTableHeader("OR#");
$this->coconutTableHeader("Particulars");
$this->coconutTableHeader("QTY");
$this->coconutTableHeader("Unitcost");
$this->coconutTableHeader("Selling Price");
$this->coconutTableHeader("Total<br>Unit Cost");
$this->coconutTableHeader("Total<br>Amount");
$this->coconutTableHeader("Profit/Net");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
if( $row['inventoryType'] == "medicine" ) {
$sprice = preg_split ("/\_/", $row['Added']); //selling price ng medicine
$sp = $sprice[1];
$uc = $row['unitcost'];
}else {
$sp = $row['unitcost']; //selling price ng supplies
$uc = $row['suppliesUNITCOST'];
}

$this->reportWithOR += ($sp * $row['quantity']) - ($uc * $row['quantity']);

$this->coconutTableRowStart();
$this->coconutTableData($row['datePaid']);
$this->coconutTableData($row['orNO']);
$this->coconutTableData($row['description']);
$this->coconutTableData($row['quantity']);
$this->coconutTableData($uc);
$this->coconutTableData($sp);
$this->coconutTableData($uc * $row['quantity']);
$this->coconutTableData($sp * $row['quantity']);
$this->coconutTableData( ($sp * $row['quantity']) - ($uc * $row['quantity']) );
$this->coconutTableRowStop();
}
$this->coconutTableRowStart();
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("<b>TOTAL</b>");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData(number_format($this->reportWithOR,2));
$this->coconutTableRowStop();

$this->coconutTableStop();
}



public function cashANDcharge_paidVia($chargesCode,$from,$to,$cols) {

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
#ilaw:hover { background-color:yellow;color:black;}
</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select sum($cols) as cols from patientCharges where (dateCharge between '$from' and '$to') and chargesCode='$chargesCode' ") or die("Query fail: " . mysqli_error()); 

$this->cashCollection_mmc_total=0;

while($row = mysqli_fetch_array($result))
  {
return $row['cols'];
}

}

public $cashANDcharge_paid_medicine;
public $cashANDcharge_paid_supplies;

public function cashANDcharge_paid_medicine() {
return $this->cashANDcharge_paid_medicine;
}

public function cashANDcharge_paid_supplies() {
return $this->cashANDcharge_paid_supplies;
}

public function cashANDcharge_paid($from,$to,$title) {

echo "
<style type='text/css'>
a { text-decoration:none; color:white; }
#ilaw:hover { background-color:yellow;}
</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select description,sum(cashPaid) as cash,dateCharge,chargesCode,title,orNO,datePaid from patientCharges where (datePaid between '$from' and '$to') and title = '$title' and status = 'PAID' group by itemNo order by datePaid,orNO asc ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
  {

if( $row['title'] == "MEDICINE" ) {
$this->cashANDcharge_paid_medicine += $row['cash'];
}else { 
$this->cashANDcharge_paid_supplies += $row['cash'];
}


echo "<tr id='ilaw'>";
$this->coconutTableData("&nbsp;".$row['datePaid']);
$this->coconutTableData("&nbsp;".$row['description']."<br> <font size=2 color=red>OR# ".$row['orNO']."</font>");
$this->coconutTableData("&nbsp;".number_format($row['cash'],2));
echo "</tr>";
}

}



public $cashANDcharge_charge_medicine_phic;
public $cashANDcharge_charge_medicine_company;
public $cashANDcharge_charge_supplies_phic;
public $cashANDcharge_charge_supplies_company;

public function cashANDcharge_charge_medicine_phic() {
return $this->cashANDcharge_charge_medicine_phic;
}

public function cashANDcharge_charge_medicine_company() {
return $this->cashANDcharge_charge_medicine_company;
}

public function cashANDcharge_charge_supplies_phic() {
return $this->cashANDcharge_charge_supplies_phic;
}

public function cashANDcharge_charge_supplies_company() {
return $this->cashANDcharge_charge_supplies_company;
}

public function cashANDcharge_charge($from,$to,$title) {

echo "
<style type='text/css'>
a { text-decoration:none; color:white; }
#ilaw:hover { background-color:yellow;}
</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select description,sum(phic) as phic,sum(company) as company,dateCharge,chargesCode,title from patientCharges where (dateCharge between '$from' and '$to') and title = '$title' and status = 'UNPAID' and phic > 0 and company > 0 group by chargesCode order by dateCharge asc ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
  {

if( $row['title'] == "MEDICINE" ) {
$this->cashANDcharge_charge_medicine_phic += $row['phic'];
$this->cashANDcharge_charge_medicine_company += $row['company'];
}else {
$this->cashANDcharge_charge_supplies_phic += $row['phic'];
$this->cashANDcharge_charge_supplies_company += $row['company'];
}
echo "<tr id='ilaw'>";
$this->coconutTableData("&nbsp;".$row['dateCharge']);
$this->coconutTableData("&nbsp;".$row['description']);
$this->coconutTableData("&nbsp;".number_format($row['phic'],2));
$this->coconutTableData("&nbsp;".number_format($row['company'],2));
echo "</tr>";
}

}





public function addMedicoLegal($registrationNo,$dateOfIncidence,$timeOfIncidence,$dateOfExamination,$timeOfExamination,$placeOfExamination,$placeOfExamination1,$nature,$pertinentPhysicalExamination,$dateAdded) {

/* make your connection */
$sql = new mysqli($this->host,$this->username,$this->password,$this->database);
 
/* we will just create an insert query here, and use it,
normally this would be done by form submission or other means */
$query = "insert into medicoLegal(registrationNo,dateOfIncidence,timeOfIncidence,dateOfExamination,timeOfExamination,placeOfExamination,placeOfExamination1,nature,pertinentPhysicalExamination,dateAdded) values('$registrationNo','$dateOfIncidence','$timeOfIncidence','$dateOfExamination','$timeOfExamination','$placeOfExamination','$placeOfExamination1','$nature','$pertinentPhysicalExamination','$dateAdded')";

 
if ( $sql->query($query) ) {
   //echo "A new entry has been added with the `id`";
} else {
    echo "There was a problem:<br />$query<br />{$sql->error}";
}
 
/* close our connection */
$sql->close();
}




public function medicoLegalList($registrationNo) {

echo "
<style type='text/css'>
a { text-decoration:none; color:white; }
tr:hover { background-color:yellow;}
</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select dateAdded from medicoLegal where registrationNo = '$registrationNo' order by dateAdded asc ") or die("Query fail: " . mysqli_error()); 

$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Date");
$this->coconutTableHeader("&nbsp;");
$this->coconutTableHeader("&nbsp;");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->coconutTableData("&nbsp;".$row['dateAdded']);
$this->coconutTableData("&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/medicoLegal_view.php?registrationNo=$registrationNo' target='patientX' style='text-decoration:none; color:red;'>View</a>");
$this->coconutTableData("&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/medicoLegal_edit.php?registrationNo=$registrationNo' target='patientX' style='text-decoration:none; color:red;'>Edit</a>");
$this->coconutTableRowStop();
}
$this->coconutTableStop();
}


public $dischargeWithCompanyAndPHIC_total;
public $dischargeWithCompanyAndPHIC_company;
public $dischargeWithCompanyAndPHIC_phic;

public function dischargeWithCompanyAndPHIC($date1,$date2,$type) {

echo "
<style type='text/css'>
a { text-decoration:none; color:white; }
tr:hover { background-color:yellow;}
</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

if( $type == "company" ) {
$result = mysqli_query($connection, " select upper(pr.lastName) as lastName,upper(pr.firstName) as firstName,rd.dateRegistered,rd.dateUnregistered,rd.Company,sum(pc.company) as company,rd.registrationNo from registrationDetails rd,patientRecord pr,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and (rd.dateUnregistered between '$date1' and '$date2') and rd.Company != '' and rd.type = 'IPD' group by pc.registrationNo order by rd.timeUnregistered asc") or die("Query fail: " . mysqli_error()); 
}else {
$result = mysqli_query($connection, " select upper(pr.lastName) as lastName,upper(pr.firstName) as firstName,rd.dateRegistered,rd.dateUnregistered,rd.Company,pr.PHIC,sum(pc.phic) as phic,rd.registrationNo from registrationDetails rd,patientRecord pr,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and (rd.dateUnregistered between '$date1' and '$date2') and pr.PHIC = 'YES' and rd.type = 'IPD' group by pc.registrationNo order by rd.timeUnregistered asc") or die("Query fail: " . mysqli_error()); 
}


$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Name");
$this->coconutTableHeader("Admitted");
$this->coconutTableHeader("Discharged");
if( $type == "company" ) {
$this->coconutTableHeader("Company");
}else {
$this->coconutTableHeader("PhilHealth");
}
$this->coconutTableHeader("Amount");
$this->coconutTableHeader("Attendiing Doc.");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {

$this->dischargeWithCompanyAndPHIC_total += 1;

if( $type == "company" ) {
$this->dischargeWithCompanyAndPHIC_company += $row['company'];
}else {
$this->dischargeWithCompanyAndPHIC_phic += $row['phic'];
}

$this->coconutTableRowStart();
$this->coconutTableData("&nbsp;".$row['lastName'].", ".$row['firstName']);
$this->coconutTableData("&nbsp;".$row['dateRegistered']);
$this->coconutTableData("&nbsp;".$row['dateUnregistered']);
if( $type == "company" ) {
$this->coconutTableData("&nbsp;".$row['Company']);
$this->coconutTableData("&nbsp;".number_format($row['company'],2));
}else {
$this->coconutTableData("&nbsp;".$row['PHIC']);
$this->coconutTableData("&nbsp;".number_format($row['phic'],2));
}
$this->coconutTableData("&nbsp;".$this->getAttendingDoc($row['registrationNo'],"ATTENDING"));
$this->coconutTableRowStop();
}
$this->coconutTableRowStart();
$this->coconutTableData("&nbsp;<font size=3><b>TOTAL PATIENT</b></font>");
$this->coconutTableData("&nbsp;<b>".$this->dischargeWithCompanyAndPHIC_total."</b>");
$this->coconutTableData("&nbsp;");
$this->coconutTableData("&nbsp;");
if( $type == "company" ) {
$this->coconutTableData("&nbsp;<b>".number_format($this->dischargeWithCompanyAndPHIC_company)."</b>");
}else {
$this->coconutTableData("&nbsp;<b>".number_format($this->dischargeWithCompanyAndPHIC_phic)."</b>");
}

$this->coconutTableRowStop();
$this->coconutTableStop();
}




public function segregatedRoom($date1,$date2,$roomType) {

echo "
<style type='text/css'>
a { text-decoration:none; color:white; }
tr:hover { background-color:yellow;}
</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select pr.lastName,pr.firstName,rd.room,rd.dateRegistered,rd.dateUnregistered from patientRecord pr,registrationDetails rd where pr.patientNo = rd.patientNo and (rd.dateUnregistered between '$date1' and '$date2') and rd.room like '$roomType%%%%%%%%%%' order by pr.lastName asc ") or die("Query fail: " . mysqli_error()); 

$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Patient");
$this->coconutTableHeader("Room");
$this->coconutTableHeader("Confinement");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->coconutTableData("&nbsp;".$row['lastName'].", ".$row['firstName']);
$this->coconutTableData("&nbsp;".$row['room']);
$this->coconutTableData("&nbsp;".$row['dateRegistered']." to ".$row['dateUnregistered']);
$this->coconutTableRowStop();
}
$this->coconutTableRowStart();
$this->coconutTableData("&nbsp;");
$this->coconutTableData("&nbsp;");
$this->coconutTableData("&nbsp;");
$this->coconutTableRowStop();
$this->coconutTableStop();
}



public $cashCollection_mmc_monthly_total;

public function cashCollection_mmc_monthly_total() {
return $this->cashCollection_mmc_monthly_total;
}

public function cashCollection_mmc_monthly($date,$date1,$type) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select title,sum(amount) as amount from cashCollection where (date between '$date' and '$date1') and type='$type' group by title  ") or die("Query fail: " . mysqli_error()); 

$this->cashCollection_mmc_total=0;

while($row = mysqli_fetch_array($result))
  {
$this->cashCollection_mmc_monthly_total += $row['amount'];
echo "<tr>";
echo "<td>".$row['title']."</td>";
echo "<td>&nbsp;</td>";
echo "<td>".number_format($row['amount'],2)."</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";
}

}

public function cashCollection_mmc_customTotal_monthly($date,$date1,$type) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select sum(amount) as total from cashCollection where (date between '$date' and '$date1') and type='$type'  ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['total'];
}

}



/***************** MONTHLY COLLECTION *********************************/

public $partial_monthly;
public $getPartialReport_hb_monthly;
public $getPartialReport_pf_monthly;
public $getPartialReport_admitting_monthly;

public $getPartialReport_hospital_monthly;
public $getPartialReport_medicine_monthly;

public function partial_monthly() {
return $this->partial_monthly;
}
public function getPartialReport_hb_monthly() {
return $this->getPartialReport_hb_monthly;
}
public function getPartialReport_pf_monthly() {
return $this->getPartialReport_pf_monthly;
}
public function getPartialReport_admitting_monthly() {
return $this->getPartialReport_admitting_monthly;
}
public function getPartialReport_hospital_monthly() {
return $this->getPartialReport_hospital_monthly;
}
public function getPartialReport_medicine_monthly() {
return $this->getPartialReport_medicine_monthly;
}



public function getPartialReport_monthly($date1,$date2) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a { text-decoration:none; color:black; }
</style>";


$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);


$result = mysql_query("SELECT rd.registrationNo,pp.paidVia,upper(pr.completeName) as completeName,pp.paymentFor,pp.paidBy,pp.datePaid,pp.amountPaid,pp.pf,pp.admitting,pp.receiptType FROM patientPayment pp,patientRecord pr,registrationDetails rd,patientCharges pc WHERE pr.patientNo = rd.patientNo and pp.registrationNo = rd.registrationNo and rd.registrationNo = pc.registrationNo and (pp.datePaid between '$date1' and '$date2') and paymentFor not in ('REFUND') group by paymentNo order by completeName asc ");



while($row = mysql_fetch_array($result))
  {
$this->partial_monthly+=$row['amountPaid'];
$this->getPartialReport_hb_monthly += $row['amountPaid'];
$this->getPartialReport_pf_monthly += $row['pf'];
$this->getPartialReport_admitting_monthly += $row['admitting'];

if( $row['receiptType'] == "medicine" ) {
$this->getPartialReport_medicine_monthly += $row['amountPaid'];
}else if( $row['receiptType'] == "hospital" ) {
$this->getPartialReport_hospital_monthly += $row['amountPaid'];
}else { }

echo "<tr>";
echo "<td>&nbsp;<font color=red>".$row['completeName']."</font>&nbsp;</td>";
echo "<td>&nbsp;".$row['paymentFor']."&nbsp;</td>";
echo "<td>&nbsp;".number_format(($row['amountPaid'] + $row['pf']) + $row['admitting'],2)."&nbsp;</td>";
//echo "<td>&nbsp;".number_format("1",2)."&nbsp;</td>";// header [QTY]
//echo "<td>&nbsp;".number_format("0",2)."&nbsp;</td>";// header [DISC]
echo "<td>&nbsp;".number_format(($row['amountPaid'] + $row['pf']) + $row['admitting'],2)."&nbsp;</td>";
//echo "<td>&nbsp;".number_format("0",2)."&nbsp;</td>"; //header [Balance]
echo "<td>&nbsp;".(($row['amountPaid']+$row['pf'])+$row['admitting'])." - (".$row['paidVia'].")&nbsp;</td>";
echo "<td>&nbsp;".$row['paidBy']."&nbsp;</td>";
echo "<tD>&nbsp;".number_format($row['amountPaid'],2)."&nbsp;</tD>";
echo "<tD>&nbsp;".number_format($row['pf'],2)."&nbsp;</tD>";
echo "<tD>&nbsp;".$this->getAttendingDoc($row['registrationNo'],"Attending")."&nbsp;</tD>";
echo "<tD>&nbsp;</tD>";
//$this->collection_salesTotal+=$row['total'];
//$this->collection_salesUnpaid+=$row['cashUnpaid'];
//$this->collection_salesPaid+=$row['cashPaid'];
/*
if($row['paidVia'] == "Cash") {
$this->collection_cash += $row['cashPaid'];
}else {
$this->collection_creditCard += $row['cashPaid'];
}
*/
echo "</tr>";
  }


					
}




public $collection_salesTotal_monthly;
public $collection_salesUnpaid_monthly;
public $collection_salesPaid_monthly;
public $collection_cash_monthly;
public $collection_creditCard_monthly;
public $collection_medicine_monthly;
public $collection_hospital_monthly;

public function collection_salesTotal_monthly() {
return $this->collection_salesTotal_monthly;
}

public function collection_salesUnpaid_monthly() {
return $this->collection_salesUnpaid_monthly;
}

public function collection_salesPaid_monthly() {
return $this->collection_salesPaid_monthly;
}

public function collection_cash_monthly() {
return $this->collection_cash_monthly;
}

public function collection_creditCard_monthly() {
return $this->collection_creditCard_monthly;
}

public function collection_medicine_monthly() {
return $this->collection_medicine_monthly;
}

public function collection_hospital_monthly() {
return $this->collection_hospital_monthly;
}


//COLLLECTION REPORT CASHIER
public function getCashierReport_monthly($date1,$date2) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a { text-decoration:none; color:black; }
</style>";


$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);



$result = mysql_query("SELECT upper(pr.completeName) as completeName,pc.description,pc.sellingPrice,pc.quantity,pc.title,pc.orNO,receiptType,pc.discount,pc.total,pc.cashUnpaid,pc.cashPaid,pc.paidBy,pc.paidVia FROM patientRecord pr,registrationDetails rd,patientCharges pc WHERE pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and (pc.datePaid between '$date1' and '$date2') and (pc.status='PAID') group by pc.itemNo order by pc.title,completeName asc ");

$this->collection_salesTotal_monthly=0;
$this->collection_salesUnpaid_monthly=0;
$this->collection_salesPaid_monthly=0;
while($row = mysql_fetch_array($result))
  {

$price = preg_split ("/\//", $row['sellingPrice']); 

echo "<tr>";
echo "<td>&nbsp;<font size=2>".$row['completeName']."</font>&nbsp;</td>";
echo "<td>&nbsp;<font size=2>".$row['description']."</font>&nbsp;<br><font size=2 color=red>OR#:".$row['orNO']."</font></td>";
echo "<td>&nbsp;<font size=2>".$price[0]."</font>&nbsp;</td>";
//echo "<td>&nbsp;".number_format($row['quantity'],2)."&nbsp;</td>";
//echo "<td>&nbsp;".number_format($row['discount'],2)."&nbsp;</td>";
echo "<td>&nbsp;<font size=2>".number_format($row['total'],2)."</font>&nbsp;</td>";
//echo "<td>&nbsp;".number_format($row['cashUnpaid'],2)."&nbsp;</td>";
echo "<td>&nbsp;<font size=2>".number_format($row['cashPaid'],2)." - (".$row['paidVia'].")</font>&nbsp;</td>";
echo "<td>&nbsp;<a href='#'><font size=2>".$row['paidBy']."</font></a>&nbsp;</td>";

echo "<td>&nbsp;<font size=2>".number_format($row['cashPaid'],2)."</font>&nbsp;</td>";
$this->collection_salesTotal_monthly+=$row['total'];
$this->collection_salesUnpaid_monthly+=$row['cashUnpaid'];
$this->collection_salesPaid_monthly+=$row['cashPaid'];

if($row['paidVia'] == "Cash") {
$this->collection_cash_monthly += $row['cashPaid'];
}else {
$this->collection_creditCard_monthly += $row['cashPaid'];
}

if( $row['receiptType'] == "medicine" ) {
$this->collection_medicine_monthly += $row['cashPaid'];
}else if( $row['receiptType'] == "hospital" ) {
$this->collection_hospital_monthly += $row['cashPaid'];
}
else {

}


echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";  

}



}



public $othersPartial_monthly;

public function othersPartial_monthly() {
return $this->othersPartial_monthly;
}

public function getOthersPartialReport_monthly($date1,$date2) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a { text-decoration:none; color:black; }
</style>";


$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);



$result = mysql_query("SELECT * FROM patientPayment pp WHERE (pp.datePaid between '$date1' and '$date2') and paymentFor not in ('BILLED') and registrationNo like 'manual_%%%%%%' group by paymentNo order by registrationNo asc ");




//$this->collection_salesTotal=0;
//$this->collection_salesUnpaid=0;
//$this->collection_salesPaid=0;
while($row = mysql_fetch_array($result))
  {
$this->othersPartial_monthly+=$row['amountPaid'];
$px = preg_split ("/\_/", $row['registrationNo']); 

echo "<tr>";
echo "<td>&nbsp;<font color=red>".$px[1]."</font>&nbsp;</td>";
echo "<td>&nbsp;".$row['paymentFor']."&nbsp;</td>";
echo "<td>&nbsp;".$row['amountPaid']."&nbsp;</td>";
echo "<tD>&nbsp;</tD>";
echo "<td>&nbsp;".number_format($row['amountPaid'],2)."&nbsp;</td>";
echo "<td>&nbsp;".$row['paidBy']."&nbsp;</td>";
echo "<td>&nbsp;".number_format($row['amountPaid'],2)."&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
//$this->collection_salesTotal+=$row['total'];
//$this->collection_salesUnpaid+=$row['cashUnpaid'];
//$this->collection_salesPaid+=$row['cashPaid'];
/*
if($row['paidVia'] == "Cash") {
$this->collection_cash += $row['cashPaid'];
}else {
$this->collection_creditCard += $row['cashPaid'];
}
*/
echo "</tr>";
  }
echo "<tr>";
echo "<td>&nbsp;<B>TOTAL</b></tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;<B>".number_format($this->othersPartial_monthly,2)."</b></tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;<B>".number_format($this->othersPartial_monthly,2)."</b></tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "</tr>";

echo "<tr>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "<td>&nbsp;</tD>";
echo "</tr>";

}




public $showExpenses_total_monthly;

public function showExpenses_total_monthly() {
return $this->showExpenses_total_monthly;
}

public function showExpenses_monthly($date1,$date2) {

echo "<style type='text/css'>
tr:hover { background-color:yellow; color:black; }
.data{
font-size:14px;
}
</style>";

$con = mysql_connect($this->host,$this->username,$this->password);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db($this->database, $con);


$result = mysql_query("SELECT amount,payee,date,user,description FROM vouchers WHERE (date between '$date1' and '$date2') ");


while($row = mysql_fetch_array($result))
  {
echo "<tr>";
echo "<Td>&nbsp;<input type='checkbox' name='shift[]' checked></tD>";
$this->showExpenses_total_monthly += $row['amount'];
echo "<td>&nbsp; ".$row['payee']." </td>";
echo "<td>&nbsp; ".$row['description']."</td>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<td>&nbsp; ".$row['user']."</td>";
echo "<td>&nbsp; ".number_format($row['amount'],2)."</td>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "<Td>&nbsp;</tD>";
echo "</tr>";
  }
echo "<Tr>";
echo "<td><center><b>Total</b></center></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<b>".number_format($this->showExpenses_total_monthly)."</b></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

}




public $totalRefunds_monthly;

public function totalRefunds_monthly() {
return $this->totalRefunds_monthly;
}

public function showRefunds_monthly($date1,$date2) {

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select paymentFor,registrationNo,amountPaid,paidBy from patientPayment where (datePaid between '$date1' and '$date2') and paymentFor = 'REFUND'  ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
  {
$this->getPatientProfile($row['registrationNo']);
$this->totalRefunds_monthly += $row['amountPaid'];
echo "<tr>";
echo "<td>".$this->getPatientRecord_lastName().", ".$this->getPatientRecord_firstName()."</td>";
echo "<td>&nbsp;".$row['paymentFor']."</td>";
echo "<td>&nbsp;".number_format($row['amountPaid'],2)."</td>";
echo "<td>&nbsp;".number_format($row['amountPaid'],2)."</td>";
echo "<td>&nbsp;".number_format($row['amountPaid'],2)."</td>";
echo "<td>&nbsp;".$row['paidBy']."</td>";
echo "<td>&nbsp;".number_format($row['amountPaid'],2)."</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";
}

}




/******************** END OF MONTHLY COLLLECTION ***********************/




public function getTopDoctors($date1,$date2,$service) {

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select pc.description,count(rd.registrationNo) as totalPx,pc.chargesCode from registrationDetails rd,patientCharges pc,patientRecord pr where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and (rd.dateRegistered between '$date1' and '$date2') and pc.title = 'PROFESSIONAL FEE' and pc.service = '$service' and rd.type = 'IPD' and pc.status = 'UNPAID' group by pc.chargesCode order by totalPx desc limit 5  ") or die("Query fail: " . mysqli_error()); 

$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Doctor");
$this->coconutTableHeader("No. Of Px");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
echo "<tr>";
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/graphicalReport/bestSelling/monthlyRangeDoctor2.php?date1=$date1&date2=$date2&service=$service&chargesCode=$row[chargesCode]' target='selection1'>".$row['description']."</a>");
$this->coconutTableData(number_format($row['totalPx'],2));
echo "</tr>";
}
$this->coconutTableStop();
}


public $getTopDoctors_with_px_total;

public function getTopDoctors_with_px($date1,$date2,$service,$chargesCode) {

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select pr.lastName,pr.firstName,rd.dateRegistered from registrationDetails rd,patientCharges pc,patientRecord pr where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and (rd.dateRegistered between '$date1' and '$date2') and pc.title = 'PROFESSIONAL FEE' and pc.service = '$service' and rd.type = 'IPD' and pc.status = 'UNPAID' and pc.chargesCode = '$chargesCode' order by pr.lastName ") or die("Query fail: " . mysqli_error()); 

echo "<center>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Name");
$this->coconutTableHeader("Admitted");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {

$this->getTopDoctors_with_px_total += 1;

echo "<tr>";
$this->coconutTableData(strtoupper($row['lastName']).",".strtoupper($row['firstName']));
$this->coconutTableData($row['dateRegistered']);
echo "</tr>";
}
echo "<tr>";
$this->coconutTableData("<b>Total Patients</b>");
$this->coconutTableData("<b>".$this->getTopDoctors_with_px_total."</b>");
echo "</tr>";
$this->coconutTableStop();
}






public function monthlyCashCollection_disbursement_details($date1,$date2,$title) {

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " SELECT title,amount,date FROM cashCollection WHERE title = '$title' AND (date between '$date1' and '$date2') AND type = 'Disbursement' ") or die("Query fail: " . mysqli_error()); 

echo "<center>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Title");
$this->coconutTableHeader("Amount");
$this->coconutTableHeader("Date");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
echo "<tr>";
$this->coconutTableData($row['title']);
$this->coconutTableData(number_format($row['amount'],2));
$this->coconutTableData($row['date']);
echo "</tr>";
}
echo "<tr>";
$this->coconutTableData("");
$this->coconutTableData("");
echo "</tr>";
$this->coconutTableStop();
}





public function addCompanyPayment($refNo,$checkNo,$registrationNo,$amount,$tax,$discount,$company,$date,$postBy) {

/* make your connection */
$sql = new mysqli($this->host,$this->username,$this->password,$this->database);
 
/* we will just create an insert query here, and use it,
normally this would be done by form submission or other means */
$query = "insert into companyPayment(refNo,checkNo,registrationNo,amountPaid,tax,discount,company,datePaid,postBy,dateEncoded) values('$refNo','$checkNo','$registrationNo','$amount','$tax','$discount','$company','$date','$postBy','".date("Y-m-d")."')";

 
if ( $sql->query($query) ) {
   //echo "A new entry has been added with the `id`";
} else {
    echo "There was a problem:<br />$query<br />{$sql->error}";
}
 
/* close our connection */
$sql->close();
}

public function addPHICPayment($refNo,$registrationNo,$amount,$tax,$date,$postBy) {

/* make your connection */
$sql = new mysqli($this->host,$this->username,$this->password,$this->database);
 
/* we will just create an insert query here, and use it,
normally this would be done by form submission or other means */
$query = "insert into phicPayment(refNo,registrationNo,amountPaid,tax,datePaid,postBy,dateEncoded) values('$refNo','$registrationNo','$amount','$tax','$date','$postBy','".date("Y-m-d")."')";

 
if ( $sql->query($query) ) {
   //echo "A new entry has been added with the `id`";
} else {
    echo "There was a problem:<br />$query<br />{$sql->error}";
}
 
/* close our connection */
$sql->close();
}



public $viewCompanyPayment_total;

public function viewCompanyPayment($registrationNo,$username) {

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " SELECT refNo,checkNo,amountPaid,tax,discount,company,datePaid,postBy,dateEncoded from companyPayment where registrationNo = '$registrationNo' and status = '' ") or die("Query fail: " . mysqli_error()); 

echo "<br><br><br><center>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Ref#");
$this->coconutTableHeader("Check#");
$this->coconutTableHeader("Amount Paid");
$this->coconutTableHeader("Tax");
$this->coconutTableHeader("Discount");
$this->coconutTableHeader("Company");
$this->coconutTableHeader("Date Paid");
$this->coconutTableHeader("Post By");
$this->coconutTableHeader("Encoded");
$this->coconutTableHeader("");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {

$this->viewCompanyPayment_total += $row['amountPaid'];

echo "<tr>";
$this->coconutTableData($row['refNo']);
$this->coconutTableData($row['checkNo']);
$this->coconutTableData(number_format($row['amountPaid'],2));
$this->coconutTableData($row['tax']);
$this->coconutTableData($row['discount']);
$this->coconutTableData($row['company']);
$this->coconutTableData($row['datePaid']);
$this->coconutTableData($row['postBy']);
$this->coconutTableData($row['dateEncoded']);
$this->coconutTableData(" <a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/Payments/deleteCompanyPayment.php?registrationNo=$registrationNo&refNo=$row[refNo]&amountPaid=$row[amountPaid]&datePaid=$row[datePaid]&username=$username'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/delete.jpeg'></a> ");
echo "</tr>";
}

echo "<tr>";
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
echo "</tr>";

echo "<tr>";
$this->coconutTableData("<b>TOTAL</b>");
$this->coconutTableData("");
$this->coconutTableData("&nbsp;<b>".number_format($this->viewCompanyPayment_total,2)."</b>");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
echo "</tr>";
echo "<tr>";
$this->coconutTableData("<b>".$this->selectNow("registrationDetails","Company","registrationNo",$registrationNo)."</b>");
$this->coconutTableData("");
$this->coconutTableData("&nbsp;<b>".number_format($this->getTotal("company","",$registrationNo),2)."</b>");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
echo "</tr>";
echo "<tr>";
$this->coconutTableData("<b>BALANCE</b>");
$this->coconutTableData("");
$this->coconutTableData("&nbsp;<b>".number_format(($this->getTotal("company","",$registrationNo)-$this->viewCompanyPayment_total),2)."</b>");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
echo "</tr>";
$this->coconutTableStop();
}


public $getCompanyPayment_total;
public $getCompanyPayment_discount;
public $getCompanyPayment_tax;

public function getCompanyPayment_total() {
return $this->getCompanyPayment_total;
}

public function getCompanyPayment_discount() {
return $this->getCompanyPayment_discount;
}

public function getCompanyPayment_tax() {
return $this->getCompanyPayment_tax;
}

public function getCompanyPayment($registrationNo,$company) {

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " SELECT refNo,amountPaid,tax,discount,company,datePaid,postBy from companyPayment where registrationNo = '$registrationNo' and company = '$company' and status not like 'DELETED%%%%%%%%' ") or die("Query fail: " . mysqli_error()); 



while($row = mysqli_fetch_array($result))
  {

$this->getCompanyPayment_total += $row['amountPaid'];
$this->getCompanyPayment_discount += $row['discount'];
$this->getCompanyPayment_tax += $row['tax'];

echo "<tr>";
$this->coconutTableData($row['company']."<br><font size=2 color=blue>REF#".$row['refNo']." w/ tax=$row[tax]</font><br><font size=2 color='blue'>Disc=$row[discount]</font>");
$this->coconutTableData("&nbsp;");
$this->coconutTableData("&nbsp;");
$this->coconutTableData("&nbsp;".number_format($row['amountPaid']));
$this->coconutTableData("&nbsp;");
echo "</tr>";
}

}







public $viewPHICPayment_total;

public function viewPHICPayment($registrationNo,$username) {

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " SELECT refNo,amountPaid,tax,datePaid,postBy,dateEncoded from phicPayment where registrationNo = '$registrationNo' and status = '' ") or die("Query fail: " . mysqli_error()); 

echo "<br><br><br><center>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("RefNo#");
$this->coconutTableHeader("Amount Paid");
$this->coconutTableHeader("Tax");
$this->coconutTableHeader("Date Paid");
$this->coconutTableHeader("Post By");
$this->coconutTableHeader("Encoded");
$this->coconutTableHeader("");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {

$this->viewPHICPayment_total += $row['amountPaid'];

echo "<tr>";
$this->coconutTableData($row['refNo']);
$this->coconutTableData(number_format($row['amountPaid'],2));
$this->coconutTableData($row['tax']);
$this->coconutTableData($row['datePaid']);
$this->coconutTableData($row['postBy']);
$this->coconutTableData($row['dateEncoded']);
$this->coconutTableData(" <a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/Payments/deletePHICPayment.php?registrationNo=$registrationNo&refNo=$row[refNo]&amountPaid=$row[amountPaid]&datePaid=$row[datePaid]&username=$username'><img src='http://".$this->getMyUrl()."/COCONUT/myImages/delete.jpeg'></a> ");
echo "</tr>";
}

echo "<tr>";
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
echo "</tr>";

echo "<tr>";
$this->coconutTableData("<b>TOTAL</b>");
$this->coconutTableData("&nbsp;<b>".number_format($this->viewPHICPayment_total,2)."</b>");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
echo "</tr>";
echo "<tr>";
$this->coconutTableData("<b>PHILHEALTH</b>");
$this->coconutTableData("&nbsp;<b>".number_format($this->getTotal("phic","",$registrationNo),2)."</b>");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
echo "</tr>";
echo "<tr>";
$this->coconutTableData("<b>BALANCE</b>");
$this->coconutTableData("&nbsp;<b>".number_format(($this->getTotal("phic","",$registrationNo)-$this->viewPHICPayment_total),2)."</b>");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableData("");
echo "</tr>";
$this->coconutTableStop();
}






public $getPHICPayment_total;

public function getPHICPayment_total() {
return $this->getPHICPayment_total;
}

public function getPHICPayment($registrationNo) {

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " SELECT refNo,amountPaid,datePaid,postBy from phicPayment where registrationNo = '$registrationNo' and status not like 'DELETED%%%%%%%%' ") or die("Query fail: " . mysqli_error()); 


while($row = mysqli_fetch_array($result))
  {

$this->getPHICPayment_total += $row['amountPaid'];

echo "<tr>";
$this->coconutTableData("PhilHealth<br><font size=2 color=blue>REF#".$row['refNo']."</font>");
$this->coconutTableData("&nbsp;");
$this->coconutTableData("&nbsp;".number_format($row['amountPaid']));
$this->coconutTableData("&nbsp;");
$this->coconutTableData("&nbsp;");
echo "</tr>";
}

}




public function getCashPayment_details($registrationNo) {

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " SELECT sum(amountPaid) as paid from patientPayment where registrationNo = '$registrationNo' ") or die("Query fail: " . mysqli_error()); 


while($row = mysqli_fetch_array($result))
  {
return $row['paid'];
}

}


public $getCompanyPayment_details_total;
public $getCompanyPayment_details_tax;
public $getCompanyPayment_details_discount;

public function getCompanyPayment_details_total() {
return $this->getCompanyPayment_details_total;
}

public function getCompanyPayment_details_tax() {
return $this->getCompanyPayment_details_tax;
}

public function getCompanyPayment_details_discount() {
return $this->getCompanyPayment_details_discount;
}

public function getCompanyPayment_details($registrationNo) {

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " SELECT sum(amountPaid) as paid,sum(tax) as tax,sum(discount) as discount from companyPayment where registrationNo = '$registrationNo' and status not like 'DELETED%%%%%%%%%' ") or die("Query fail: " . mysqli_error()); 


while($row = mysqli_fetch_array($result))
  {
$this->getCompanyPayment_details_total = $row['paid'];
$this->getCompanyPayment_details_tax = $row['tax'];
$this->getCompanyPayment_details_discount = $row['discount'];
}

}


public function getPHICPayment_details($registrationNo) {

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " SELECT sum(amountPaid) as paid from phicPayment where registrationNo = '$registrationNo' and status not like 'DELETED%%%%%%%%%' ") or die("Query fail: " . mysqli_error()); 


while($row = mysqli_fetch_array($result))
  {
return $row['paid'];
}

}


/**************AGING OF RECEIVABLES**********************/


public function patientReceivables($registrationNo,$type) {

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " SELECT sum($type) as receivables from patientCharges where registrationNo = '$registrationNo' and status = 'UNPAID' having (sum($type) > 0) ") or die("Query fail: " . mysqli_error()); 


while($row = mysqli_fetch_array($result))
  {
return $row['receivables'];
}

}



public function phic_ReceivablesAging_links($discharged,$date,$type) {

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$number_of_records_per_page=30;

$result = mysqli_query($connection, " SELECT count(rd.registrationNo) as registrationNo from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and rd.dateUnregistered like '$discharged' group by pc.registrationNo having (sum(pc.phic) > 0)  ") or die("Query fail: " . mysqli_error()); 


while($row = mysqli_fetch_array($result))
  {
$totalPage = ceil($row['registrationNo']/$number_of_records_per_page);
return $totalPage;
}

}



public function phic_ReceivablesAging($discharged,$date,$type,$start,$to) {

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " SELECT pr.lastName,pr.firstName,rd.dateUnregistered,rd.registrationNo,sum(pc.phic) as phic from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and rd.dateUnregistered like '$discharged' group by pc.registrationNo having (sum(pc.phic) > 0) order by pr.lastName,pr.firstName asc limit $start,$to ") or die("Query fail: " . mysqli_error()); 


$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Reg#");
$this->coconutTableHeader("Patient");
$this->coconutTableHeader("Total<br>Receivables");
$this->coconutTableHeader("&nbsp;Current&nbsp;");
$this->coconutTableHeader("&nbsp;30 days&nbsp;");
$this->coconutTableHeader("&nbsp;60 days&nbsp;");
$this->coconutTableHeader("&nbsp;90 days&nbsp;");
$this->coconutTableHeader("&nbsp;120+ days&nbsp;");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->coconutTableData("&nbsp;".$row['registrationNo']);
$this->coconutTableData("&nbsp;".$row['lastName'].", ".$row['firstName']."");
$this->coconutTableData("&nbsp;".number_format($row['phic'],2));
$this->coconutTableData("&nbsp;");
$this->coconutTableData("&nbsp;");
$this->coconutTableData("&nbsp;");
$this->coconutTableData("&nbsp;");
$this->coconutTableData("&nbsp;");
$this->coconutTableRowStop();
}

$this->coconutTableStop();

}


/********************AGING OF RECEIVABLES*****************************/




public $companyPaymentReport_total;
public $companyPaymentReport_discount;
public $companyPaymentReport_tax;

public function companyPaymentReport($datePaid,$datePaid1,$dateSource) {

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " SELECT pr.lastName,pr.firstName,rd.registrationNo,rd.Company,cp.amountPaid,cp.datePaid,cp.tax,cp.discount,cp.refNo,cp.checkNo,cp.postBy from patientRecord pr,registrationDetails rd,companyPayment cp where pr.patientNo = rd.patientNo and rd.registrationNo = cp.registrationNo and (cp.$dateSource between '$datePaid' and '$datePaid1') and cp.status not like 'DELETED%%%%%%%%' ") or die("Query fail: " . mysqli_error()); 


$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Ref#");
$this->coconutTableHeader("Check#");
$this->coconutTableHeader("Reg#");
$this->coconutTableHeader("Patient");
$this->coconutTableHeader("Company");
$this->coconutTableHeader("Amount Paid");
$this->coconutTableHeader("Tax");
$this->coconutTableHeader("Discount");
$this->coconutTableHeader("Date Posted");
$this->coconutTableHeader("User");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {

$this->companyPaymentReport_total += $row['amountPaid'];
$this->companyPaymentReport_tax += $row['tax'];
$this->companyPaymentReport_discount += $row['discount'];

$this->coconutTableRowStart();
$this->coconutTableData("&nbsp;".$row['refNo']);
$this->coconutTableData("&nbsp;".$row['checkNo']);
$this->coconutTableData("&nbsp;".$row['registrationNo']);
$this->coconutTableData("&nbsp;".$row['lastName'].", ".$row['firstName']."");
$this->coconutTableData("&nbsp;".$row['Company']);
$this->coconutTableData("&nbsp;".number_format($row['amountPaid'],2));
( $row['tax'] != "" ) ? $this->coconutTableData("&nbsp;".$row['tax']) : $this->coconutTableData("");
( $row['discount'] != "" ) ? $this->coconutTableData("&nbsp;".$row['discount']) : $this->coconutTableData("");
$this->coconutTableData("&nbsp;".$row['datePaid']);
$this->coconutTableData("&nbsp;".$row['postBy']);

}
$this->coconutTableRowStart();
$this->coconutTableData("&nbsp;");
$this->coconutTableData("&nbsp;");
$this->coconutTableData("&nbsp;");
$this->coconutTableData("&nbsp;");
$this->coconutTableData("&nbsp;");
$this->coconutTableData("&nbsp;".number_format($this->companyPaymentReport_total,2));
($this->companyPaymentReport_tax != "") ? $this->coconutTableData("&nbsp;".number_format($this->companyPaymentReport_tax,2)) : $this->coconutTableData("&nbsp;");
($this->companyPaymentReport_discount != "") ? $this->coconutTableData("&nbsp;".number_format($this->companyPaymentReport_discount,2)) : $this->coconutTableData("&nbsp;");
$this->coconutTableData("&nbsp;");
$this->coconutTableData("&nbsp;");
$this->coconutTableRowStop();
$this->coconutTableStop();

}


public $currentAdmittedPatient_inventory_cash;
public $currentAdmittedPatient_inventory_phic;
public $currentAdmittedPatient_inventory_company;

public function currentAdmittedPatient_inventory_cash() {
return $this->currentAdmittedPatient_inventory_cash;
}
public function currentAdmittedPatient_inventory_phic() {
return $this->currentAdmittedPatient_inventory_phic;
}
public function currentAdmittedPatient_inventory_company() {
return $this->currentAdmittedPatient_inventory_company;
}


public function currentAdmittedPatient_inventory($room) {


echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " SELECT sum(pc.cashUnpaid) as cash,sum(pc.phic) as phic,sum(pc.company) as company from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and rd.room = '$room' and rd.type = 'IPD' and rd.dateUnregistered = '' and pc.status = 'UNPAID' and (pc.title = 'MEDICINE' or pc.title = 'SUPPLIES') and departmentStatus like 'dispensedBy%%%%%%%%%%%' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
  {
$this->currentAdmittedPatient_inventory_cash = $row['cash'];
$this->currentAdmittedPatient_inventory_phic = $row['phic'];
$this->currentAdmittedPatient_inventory_company = $row['company'];
}

}





private $currentAdmittedPatient_name;
private $currentAdmittedPatient_registrationNo;
private $currentAdmittedPatient_dateRegistered;
private $currentAdmittedPatient_cashUnpaid;
private $currentAdmittedPatient_phic;
private $currentAdmittedPatient_company;
private $currentAdmittedPatient_registrationDetailsCompany;

public function currentAdmittedPatient_name() {
return $this->currentAdmittedPatient_name;
}
public function currentAdmittedPatient_registrationNo() {
return $this->currentAdmittedPatient_registrationNo;
}
public function currentAdmittedPatient_dateRegistered() {
return $this->currentAdmittedPatient_dateRegistered;
}
public function currentAdmittedPatient_cashUnpaid() {
return $this->currentAdmittedPatient_cashUnpaid;
}
public function currentAdmittedPatient_phic() {
return $this->currentAdmittedPatient_phic;
}
public function currentAdmittedPatient_company() {
return $this->currentAdmittedPatient_company;
}
public function currentAdmittedPatient_registrationDetailsCompany() {
return $this->currentAdmittedPatient_registrationDetailsCompany;
}

public function currentAdmittedPatient($room) {

$this->currentAdmittedPatient_name = "";
$this->currentAdmittedPatient_registrationNo = "";
$this->currentAdmittedPatient_dateRegistered = "";

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " SELECT pr.lastName,pr.firstName,rd.Company,rd.registrationNo,rd.dateRegistered,sum(pc.cashUnpaid) as cash,sum(pc.phic) as phic,sum(pc.company) as company from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and rd.room = '$room' and rd.type = 'IPD' and rd.dateUnregistered = '' and (pc.status = 'UNPAID' or pc.status = 'Discharged') and rd.dateRegistered not like 'DELETED%' and (pc.title != 'MEDICINE' and pc.title != 'SUPPLIES')  ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
  {
  $this->currentAdmittedPatient_name = strtoupper($row['lastName'])." ".strtoupper($row['firstName']);
  $this->currentAdmittedPatient_registrationNo = $row['registrationNo'];
  $this->currentAdmittedPatient_dateRegistered = $row['dateRegistered'];
  $this->currentAdmittedPatient_cashUnpaid = $row['cash'];
  $this->currentAdmittedPatient_phic = $row['phic'];
  $this->currentAdmittedPatient_company = $row['company'];
  $this->currentAdmittedPatient_registrationDetailsCompany = $row['Company'];
}

}



public function currentAdmitted($floor) {

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " SELECT Description from room where floor = '$floor' order by Description asc ") or die("Query fail: " . mysqli_error()); 


while($row = mysqli_fetch_array($result))
  {
$this->currentAdmittedPatient($row['Description']);
$this->currentAdmittedPatient_inventory($row['Description']);
$this->coconutHidden("registrationNo[]",$this->currentAdmittedPatient_registrationNo());

$currentAdmitted_cash = (( $this->currentAdmittedPatient_cashUnpaid() + $this->currentAdmittedPatient_inventory_cash() ) - $this->getTotalPatientPayment($this->currentAdmittedPatient_registrationNo()));
$currentAdmitted_phic = ( $this->currentAdmittedPatient_phic() + $this->currentAdmittedPatient_inventory_phic() );
$currentAdmitted_company = ( $this->currentAdmittedPatient_company() + $this->currentAdmittedPatient_inventory_company() );

$this->coconutTableRowStart();
$this->coconutTableData("<font size=2>".$row['Description']."</font>");
$this->coconutTableData("<font size=2>".$this->currentAdmittedPatient_registrationNo()."</font>");
$this->coconutTableData("<font size=2>".$this->currentAdmittedPatient_name()."</font>");
$this->coconutTableData("<font size=2>".$this->currentAdmittedPatient_dateRegistered()."</font>");
$this->coconutTableData("<font size=2>".$this->currentAdmittedPatient_registrationDetailsCompany()."</font>");
( $currentAdmitted_cash > 0 ) ? $this->coconutTableData("<font size=2>".number_format($currentAdmitted_cash,2)."</font>") : $this->coconutTableData("");
( $currentAdmitted_phic > 0 ) ? $this->coconutTableData("<font size=2>".number_format($currentAdmitted_phic,2)."</font>") : $this->coconutTableData("");
( $currentAdmitted_company > 0 ) ? $this->coconutTableData("<font size=2>".number_format($currentAdmitted_company,2)."</font>") : $this->coconutTableData("");
$this->coconutTableRowStop();
}


}




public function getCompanyPaymentViaRefNo($refNo) {

echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " SELECT pr.lastName,pr.firstName,rd.Company,cp.checkNo,cp.amountPaid,cp.tax,cp.discount,cp.datePaid,cp.postBy from patientRecord pr,registrationDetails rd,companyPayment cp where pr.patientNo = rd.patientNo and rd.registrationNo = cp.registrationNo and cp.refNo = '$refNo' ") or die("Query fail: " . mysqli_error()); 

$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Patient");
$this->coconutTableHeader("Company");
$this->coconutTableHeader("Check#");
$this->coconutTableHeader("Amount Pd");
$this->coconutTableHeader("Tax");
$this->coconutTableHeader("Discount");
$this->coconutTableHeader("Date");
$this->coconutTableHeader("Post By");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->coconutTableData($row['lastName'].", ".$row['firstName']);
$this->coconutTableData($row['Company']);
$this->coconutTableData($row['checkNo']);
$this->coconutTableData(number_format($row['amountPaid'],2));
( $row['tax'] != "" ) ? $this->coconutTableData(number_format($row['tax'],2)) : $this->coconutTableData("");
( $row['discount'] != "" ) ? $this->coconutTableData(number_format($row['discount'],2)) : $this->coconutTableData("");
$this->coconutTableData($row['datePaid']);
$this->coconutTableData($row['postBy']);
$this->coconutTableRowStop();
}
$this->coconutTableStop();
}


public $checkCharges_counter;

public function checkCharges($registrationNo) {


$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, "select description,total,status,cashUnpaid,company,registrationNo from patientCharges where registrationNo = '$registrationNo' and (status = 'UNPAID' or status = 'PAID') ") or die("Query fail: " . mysqli_error()); 

$this->checkCharges_counter=1;

while($row = mysqli_fetch_array($result))
  {
if( $row['status'] == "PAID" ) {
echo "<font size=2 color=red><b>(Pd)</b></font><font size=2 color=red><i>".($this->checkCharges_counter++).".".$row['description']." - $row[total]</i></font><br>";
}else {

if( $row['cashUnpaid'] > 0 && $row['company'] == 0 ) {
echo "<font size=2 color=blue><i>".($this->checkCharges_counter++).".".$row['description']." - $row[total]</i></font><br>";
}else if( $row['company'] > 0 && $row['cashUnpaid'] == 0 ) {
echo "<font size=2 color=red><b>(".$this->selectNow("registrationDetails","Company","registrationNo",$registrationNo).")</b><i>".($this->checkCharges_counter++).".".$row['description']." - $row[total]</i></font><br>";
}else{ /*undefined*/ }

}
}


}



//Registration Patient List
public function getPatientForReg($date,$username) {

echo "
<style type='text/css'>
.buttonwithoutborder {
	font-family: Arial;
	font-size: 14px;
	font-weight: bold;
	color: #000000;
	background-color: #FFFFFF;
	border: 1px solid #FFFFFF;
}
form {
margin: 0;
padding: 0;
}
tr:hover { background-color:yellow;color:black;}
</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " SELECT upper(pr.lastName) as lastName,upper(pr.firstName) as firstName,rd.pxCount,rd.registrationNo from patientRecord pr,registrationDetails rd where pr.patientNo = rd.patientNo and rd.dateRegistered = '$date' order by rd.pxCount desc ") or die("Query fail: " . mysqli_error()); 

$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("No.");
$this->coconutTableHeader("Patient");
//$this->coconutTableHeader(" ");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->coconutTableData($row['pxCount']);
echo "<td><input type='submit' class='buttonwithoutborder' value='".$row['lastName'].", ".$row['firstName']."'>";
echo "</td>";
//$this->coconutTableData("<form method='post' action='http://".$this->getMyUrl()."/COCONUT/ER/finishER.php' target='rightFrame'><input type='hidden' name='registrationNo' value='$row[registrationNo]'><input type='hidden' name='username' value='$username'><input type='submit' class='buttonwithoutborder' value='OK'></form>");
$this->coconutTableRowStop();
}

$this->coconutTableStop();
}
//End Registration Patient List



//Billing Transaction Patient List
public function getPatientForBill($date,$username) {

echo "
<style type='text/css'>
.buttonwithoutborder {
	font-family: Arial;
	font-size: 14px;
	font-weight: bold;
	color: #000000;
	background-color: #FFFFFF;
	border: 1px solid #FFFFFF;
}
.buttonwithoutborderred {
	font-family: Arial;
	font-size: 14px;
	font-weight: bold;
	color: #FF0000;
	background-color: #FFFFFF;
	border: 1px solid #FFFFFF;
}
form {
margin: 0;
padding: 0;
}
tr:hover { background-color:yellow;color:black;}
</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " SELECT upper(pr.lastName) as lastName,upper(pr.firstName) as firstName,rd.pxCount,rd.registrationNo, rd.type from patientRecord pr,registrationDetails rd where pr.patientNo = rd.patientNo and rd.dateRegistered = '$date' and rd.dateUnregistered = '' order by rd.pxCount desc ") or die("Query fail: " . mysqli_error()); 

$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("No.");
$this->coconutTableHeader("Patient");
//$this->coconutTableHeader(" ");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {

$typ=$row['type'];
if($typ=='OPD'){$btclass="buttonwithoutborder";}else{$btclass="buttonwithoutborderred";}

$this->coconutTableRowStart();
$this->coconutTableData($row['pxCount']);
echo "<td><form method='post' action='http://".$this->getMyUrl()."/COCONUT/currentPatient/patientInterface1.php' target='rightFrame'><input type='hidden' name='username' value='$username'><input type='hidden' name='registrationNo' value='$row[registrationNo]'><input type='submit' class='$btclass' value='".$row['lastName'].", ".$row['firstName']."'></form>";
//$this->checkCharges($row['registrationNo']);
echo "</td>";
//$this->coconutTableData("<form method='post' action='http://".$this->getMyUrl()."/COCONUT/ER/finishER.php' target='rightFrame'><input type='hidden' name='registrationNo' value='$row[registrationNo]'><input type='hidden' name='username' value='$username'><input type='submit' class='buttonwithoutborder' value='OK'></form>");
$this->coconutTableRowStop();
}

$this->coconutTableStop();

echo "<br /><br />";

//Unfinished Transactions
$asql = mysqli_query($connection, " SELECT upper(pr.lastName) as lastName,upper(pr.firstName) as firstName,rd.pxCount,rd.registrationNo,type from patientRecord pr,registrationDetails rd where pr.patientNo = rd.patientNo and rd.dateRegistered NOT LIKE '$date' and rd.dateUnregistered = '' order by rd.dateRegistered,timeRegistered desc") or die("Query fail: " . mysqli_error()); 


$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Unfinished Transactions");
//$this->coconutTableHeader(" ");
$this->coconutTableRowStop();
while($afetch = mysqli_fetch_array($asql)){

$typ2=$afetch['type'];
if($typ2=='OPD'){$btclass2="buttonwithoutborder";}else{$btclass2="buttonwithoutborderred";}

$this->coconutTableRowStart();
echo "<td><form method='post' action='http://".$this->getMyUrl()."/COCONUT/currentPatient/patientInterface1.php' target='rightFrame'><input type='hidden' name='username' value='$username'><input type='hidden' name='registrationNo' value='$afetch[registrationNo]'><input type='submit' class='$btclass2' value='".$afetch['lastName'].", ".$afetch['firstName']."'></form>";
//$this->checkCharges($afetch['registrationNo']);
echo "</td>";
//$this->coconutTableData("<form method='post' action='http://".$this->getMyUrl()."/COCONUT/ER/finishER.php' target='rightFrame'><input type='hidden' name='registrationNo' value='$row[registrationNo]'><input type='hidden' name='username' value='$username'><input type='submit' class='buttonwithoutborder' value='OK'></form>");
$this->coconutTableRowStop();
}
//End Unfinished Transactions

$this->coconutTableStop();
}
//End Billing Transaction Patient List

public function getPatientForER($date,$username) {

echo "
<style type='text/css'>
.buttonwithoutborder {
	font-family: Arial;
	font-size: 14px;
	font-weight: bold;
	color: #000000;
	background-color: #FFFFFF;
	border: 1px solid #FFFFFF;
}
.style2 {font-family: Arial;font-size: 10px;color: #0066FF;font-weight: bold;}
form {
margin: 0;
padding: 0;
}
tr:hover { background-color:yellow;color:black;}
</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " SELECT upper(pr.lastName) as lastName,upper(pr.firstName) as firstName,rd.pxCount,rd.registrationNo,rd.timeRegistered from patientRecord pr,registrationDetails rd where pr.patientNo = rd.patientNo and rd.dateRegistered = '$date' and rd.dateUnregistered = '' order by rd.pxCount desc ") or die("Query fail: " . mysqli_error()); 

$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("No.");
$this->coconutTableHeader("Patient");
//$this->coconutTableHeader(" ");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->coconutTableData($row['pxCount']);
echo "<td><form method='post' action='http://".$this->getMyUrl()."/COCONUT/currentPatient/patientInterface1.php' target='rightFrame'><input type='hidden' name='username' value='$username'><input type='hidden' name='registrationNo' value='$row[registrationNo]'><input type='submit' class='buttonwithoutborder' value='".$row['lastName'].", ".$row['firstName']."'><br /><span class='style2'>Time Reg.: ".$row['timeRegistered']."</span></form>";
$this->checkCharges($row['registrationNo']);
echo "</td>";
//$this->coconutTableData("<form method='post' action='http://".$this->getMyUrl()."/COCONUT/ER/finishER.php' target='rightFrame'><input type='hidden' name='registrationNo' value='$row[registrationNo]'><input type='hidden' name='username' value='$username'><input type='submit' class='buttonwithoutborder' value='OK'></form>");
$this->coconutTableRowStop();
}
$this->coconutTableStop();
}


public $getPxBalance_registrationNo;
public $getPxBalance_dateRegistered;
public $getPxBalance_balance;

public function getPxBalance_registrationNo() {
return $this->getPxBalance_registrationNo;
}
public function getPxBalance_dateRegistered() {
return $this->getPxBalance_dateRegistered;
}
public function getPxBalance_balance() {
return $this->getPxBalance_balance;
}

public function getPxBalance($patientNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " SELECT registrationNo,dateRegistered,balance from registrationDetails where (balance != '' or balance > 0) and patientNo = '$patientNo' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
  {
$this->getPxBalance_registrationNo = $row['registrationNo'];
$this->getPxBalance_dateRegistered = $row['dateRegistered']; 
$this->getPxBalance_balance = $row['balance'];
}

}



/********************** NEW COLLECTION REPORT**********************************/


public function getBalanceForCollection($registrationNo) {


echo "
<style type='text/css'>
tr:hover { background-color:yellow;color:black;}
</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " SELECT sum(cashUnpaid) as balance from patientCharges pc where pc.registrationNo = '$registrationNo' and (status = 'UNPAID' or status = 'BALANCE') ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
  {
return $row['balance'];
}

}


public function getPaidForCollection($registrationNo,$cashPaid_cashPaidFromBalance,$datePaid_datePaidFromBalance,$date) {


echo "
<style type='text/css'>
tr:hover { background-color:yellow;color:black;}
</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " SELECT sum($cashPaid_cashPaidFromBalance) as paid from patientCharges pc where pc.registrationNo = '$registrationNo' and (status = 'PAID' or status = 'BALANCE') and $datePaid_datePaidFromBalance = '$date' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
  {
return $row['paid'];
}

}


public function newCollectionReport($month,$day,$year) {


echo "
<style type='text/css'>
tr:hover { background-color:yellow;color:black;}
</style>";

$date = $year."-".$month."-".$day;

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " SELECT pr.lastName,pr.firstName,sum(pc.total) as total,rd.registrationNo from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and pc.datePaid = '$date' group by rd.registrationNo") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
  {
$this->coconutTableRowStart();
echo "<td align='center'>".strtoupper($row['lastName']).", ".strtoupper($row['firstName'])."</td>";
echo "<td align='center'>".number_format($row['total'],2)."</td>";
echo "<td align='center'>".number_format($this->getBalanceForCollection($row['registrationNo']),2)."</td>";
echo "<td align='center'>".number_format($this->getPaidForCollection($row['registrationNo'],"cashPaid","datePaid",$date),2)."</td>";
$this->coconutTableRowStop();
}

}


/********************** NEW COLLECTION REPORT**********************************/




public function stockCard_quantityRequesition($inventoryCode) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select sum(quantityIssued) as qty from inventoryManager where inventoryCode = '$inventoryCode' and status = 'Received' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
  {
return $row['qty'];
}

}


public function stockCard_quantityOut($stockCardNo,$inventoryCode) {


echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " SELECT sum(pc.quantity) as qtyOUT from patientCharges pc,inventory i where i.inventoryCode = pc.chargesCode and pc.chargesCode = '$inventoryCode' and pc.departmentStatus like 'dispensedBy_%%%%%%' and pc.status not like 'DELETED%%%%%' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
  {
return $row['qtyOUT'];
}

}


public function viewStockCard($stockCardNo,$inventoryType,$show) {


echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

if( $show == "all" ) {
$result = mysqli_query($connection, " SELECT inventoryCode,dateAdded,beginningQTY,unitcost,Added,addedBy,inventoryLocation,quantity,status from inventory where stockCardNo = '$stockCardNo' order by dateAdded desc ") or die("Query fail: " . mysqli_error());
}else {
$result = mysqli_query($connection, " SELECT inventoryCode,dateAdded,beginningQTY,unitcost,Added,addedBy,inventoryLocation,quantity,status from inventory where stockCardNo = '$stockCardNo' and inventoryLocation = '$show' order by dateAdded desc ") or die("Query fail: " . mysqli_error()); 
}


$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Date Added");
$this->coconutTableHeader("Inv Code");
$this->coconutTableHeader("UnitCost");
$this->coconutTableHeader("Price");
$this->coconutTableHeader("QTY In");
$this->coconutTableHeader("QTY Out");
$this->coconutTableHeader("Remaining");
$this->coconutTableHeader("Location");
$this->coconutTableHeader("User");
$this->coconutTableHeader("Status");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
$price = preg_split ("/\_/", $row['Added']); 
$this->coconutTableRowStart();
$this->coconutTableData("&nbsp;<a href='/COCONUT/Pharmacy/monitoring/monitoringHead.php?inventoryCode=$row[inventoryCode]' style='text-decoration:none; color:red;' target='_blank' >".$row['dateAdded']."</a>");
$this->coconutTableData("&nbsp;".$row['inventoryCode']);
$this->coconutTableData("&nbsp;".$row['unitcost']);
$this->coconutTableData("&nbsp;".$price[1]);
$this->coconutTableData("&nbsp;".$row['beginningQTY']);
$this->coconutTableData("&nbsp;". ($this->stockCard_quantityOut($stockCardNo,$row['inventoryCode']) + $this->stockCard_quantityRequesition($row['inventoryCode'])) );
$this->coconutTableData("&nbsp;".$row['quantity']);
$this->coconutTableData("&nbsp;".$row['inventoryLocation']);
$this->coconutTableData("&nbsp;".$row['addedBy']);
$this->coconutTableData("&nbsp;".$row['status']);
$this->coconutTableRowStop();
}
$this->coconutTableStop();

}




public function getAllSOAP($patientNo) {


echo "
<style type='text/css'>
a { text-decoration:none; color:black; }
tr:hover { background-color:yellow;color:black;}

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " SELECT pc.itemNo,rd.registrationNo,pc.description,pc.dateCharge from patientRecord pr,registrationDetails rd,patientCharges pc,SOAP s where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and pc.itemNo = s.itemNo and rd.patientNo = '$patientNo' group by rd.registrationNo order by pc.dateCharge desc ") or die("Query fail: " . mysqli_error()); 

echo "<br><br><br>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Date");
$this->coconutTableHeader("Doctor");
$this->coconutTableHeader("");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->coconutTableData("&nbsp;".$row['dateCharge']);
$this->coconutTableData("&nbsp;".$row['description']);
$this->coconutTableData("&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/android/doctor/mobileSOAP_history.php?registrationNo=$row[registrationNo]&itemNo=$row[itemNo]&username=' style='color:red; text-size:10px;' target='rightSOAP'>View</a>");
$this->coconutTableRowStop();
}
$this->coconutTableStop();

}





public function getPTNotes($patientNo,$registrationNo,$username) {


echo "
<style type='text/css'>
a { text-decoration:none; color:red; }
tr:hover { background-color:yellow;color:black;}

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " SELECT ptNotesNo,date from ptNotes where patientNo = '$patientNo' and status not like 'DELETED%%%%' order by date desc ") or die("Query fail: " . mysqli_error()); 

echo "<center><br><br><font size=5><i>List of PT Notes</i></font><br><br><a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/ptNotes.php?registrationNo=$registrationNo&username=$username'>+ Add New PT Notes</a><br><br>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("Date");
$this->coconutTableHeader("");
$this->coconutTableHeader("");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
  {
$this->coconutTableRowStart();
$this->coconutTableData("&nbsp;".$row['date']);
$this->coconutTableData("&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/ptNotes_view.php?ptNotesNo=$row[ptNotesNo]' style='color:red; font-size:15px;'>View</a>");
$this->coconutTableData("&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/patientProfile/ptNotes_delete.php?ptNotesNo=$row[ptNotesNo]' style='color:red; font-size:15px;'>Delete</a>");
$this->coconutTableRowStop();
}
$this->coconutTableStop();

}




/*********************ACCOUNTING********************************************/



public function accounting_getTotalPaid($registrationNo) {

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

$result = mysqli_query($connection, " SELECT sum(cashPaid) as cashPaid from patientCharges where registrationNo = '$registrationNo' and status = 'PAID' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
  {
return $row['cashPaid'];
}
$this->coconutTableStop();
}


public $accounting_getTotalTitle_total;

public function accounting_getTotalTitle_total() {
return $this->accounting_getTotalTitle_total;
}

public function accounting_getTotalTitle($registrationNo) {

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

$result = mysqli_query($connection, " SELECT title,description,cashPaid,paidVia,amountPaidFromCreditCard from patientCharges where registrationNo = '$registrationNo' and status = 'PAID' order by title asc") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
  {

$this->accounting_getTotalTitle_total += $row['cashPaid'];

echo "<tr>";
echo "<td>&nbsp;&nbsp;".$row['title']." - ".$row['description']."</td>";
echo "<td></td>";
echo "<Td>&nbsp;</td>";
if( $row['paidVia'] == "Cash" ) {
echo "<td align='center'>".number_format($row['cashPaid'],2)."</td>";
}else {
echo "<td align='center'>".number_format($row['amountPaidFromCreditCard'],2)."</td>";
}
echo "<td align='center'></td>";
echo "</tr>";
}
$this->coconutTableStop();
}



public function accounting_patientSubLedger($registrationNo) {

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

$result = mysqli_query($connection, " SELECT pc.paidVia,sum(cashPaid) as totalPaid,sum(amountPaidFromCreditCard) as creditCard,rd.dateRegistered from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and rd.registrationNo = '$registrationNo' and pc.status = 'PAID' ") or die("Query fail: " . mysqli_error()); 

echo "<br>";
echo "<table border=0 width='70%'>";
echo "<tr class='table_header'>";
echo "<th>Account</th>";
echo "<th>Date</th>";
echo "<th>Debit</th>";
echo "<th>Credit</th>";
echo "<th>Balance</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {

echo "<tr>";
echo "<td>".$row['paidVia']."</td>";
echo "<td align='center'>".$row['dateRegistered']."</td>";
if( $row['paidVia'] == "Cash" ) {
echo "<td align='center'>".number_format($row['totalPaid'],2)."</td>";
}else {
echo "<td align='center'>".number_format($row['creditCard'],2)."</td>";
}
echo "<Td>&nbsp;</td>";
echo "<td align='center'></td>";
echo "</tr>";
}

$this->accounting_getTotalTitle($registrationNo);

$this->coconutTableStop();
}


public function accounting_showJournalEntries_opd($paidDate,$paidDate1,$username) {

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

$result = mysqli_query($connection, " SELECT pr.lastName,pr.firstName,rd.registrationNo,pc.paidVia,pc.datePaid,pc.cashPaid,pc.description,pc.title,pc.amountPaidFromCreditCard from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and (pc.datePaid between '$paidDate' and '$paidDate1') order by pc.title,pr.lastName,pc.timePaid,pc.datePaid ") or die("Query fail: " . mysqli_error()); 


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

//$this->getJournalEntriesTransaction($row['registrationNo']);

$this->coconutTableRowStart();
$this->coconutTableData($row['paidVia']);
$this->coconutTableData($row['datePaid']);

if( $row['paidVia'] == "Cash" ) {
$this->coconutTableData(number_format($row['cashPaid'],2));
}else {
$this->coconutTableData(number_format($row['amountPaidFromCreditCard'],2));
}

$this->coconutTableData("");
$this->coconutTableRowStop();

$this->coconutTableRowStart();
$this->coconutTableData("&nbsp;&nbsp;".$row['title']." - ".$row['description']);
$this->coconutTableData("");
$this->coconutTableData("");

if( $row['paidVia'] == "Cash" ) {
$this->coconutTableData(number_format($row['cashPaid'],2));
}else {
$this->coconutTableData(number_format($row['amountPaidFromCreditCard'],2));
}


$this->coconutTableRowStop();

echo "<tr class='border_bottom'>";
$this->coconutTableData("<a href='http://".$this->getMyUrl()."/COCONUT/accounting/patientSubLedger.php?registrationNo=$row[registrationNo]&username=$username' target='_blank'><b>($row[registrationNo]) ".strtoupper($row['lastName']).", ".strtoupper($row['firstName'])."</a></b>");
$this->coconutTableData("&nbsp;");
$this->coconutTableData("");
$this->coconutTableData("");
$this->coconutTableRowStop();


}
$this->coconutTableStop();
}


public $getGeneralLedger_credit_total;

public function getGeneralLedger_credit($accountTitle,$date,$date1,$type) {


echo "
<style type='text/css'>
a { text-decoration:none; color:red; }
tr:hover { background-color:yellow;color:black;}

tr.border_bottom td {
  border-bottom:1pt solid #CCCCCC;
}

tr.table_header th {
  border-bottom:1pt solid black;
}


tr.border_top td {
  border-top:1pt solid #CCCCCC;
}

tr.table_header_top th {
  border-top:1pt solid black;
}


</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, "select pc.dateCharge,sum(pc.total) as total from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and rd.type = '$type' and pc.title = '$accountTitle' and (pc.dateCharge between '$date' and '$date1') and status not like 'DELETED%%%%%%%' group by pc.dateCharge order by dateCharge asc ") or die("Query fail: " . mysqli_error()); 


echo "<table border=0 width='70%'>";
echo "<tr class='table_header'>";
echo "<th>Date</th>";
echo "<th>Narration</th>";
echo "<th>Debit</th>";
echo "<th>Credit</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {

$this->getGeneralLedger_credit_total += $row['total'];

$this->coconutTableRowStart();
echo "<td align='center'>".$row['dateCharge']."";
echo "<td align='center'>".$accountTitle."-".$type."</td>";
echo "<td>&nbsp;</td>";
echo "<td align='center'>".number_format($row['total'],2)."</td>";
$this->coconutTableRowStop();
}
echo "<tr class='table_header_top'>";
echo "<th>Total</th>";
echo "<th>&nbsp;</th>";
echo "<th>&nbsp;</th>";
echo "<th>&nbsp;".number_format($this->getGeneralLedger_credit_total,2)."</th>";
echo "</tr>";
$this->coconutTableStop();

}


public $getGeneralLedger_debit_total;

public function getGeneralLedger_debit($accountTitle,$date,$date1,$type,$cols) {


echo "
<style type='text/css'>
a { text-decoration:none; color:red; }
tr:hover { background-color:yellow;color:black;}

tr.border_bottom td {
  border-bottom:1pt solid #CCCCCC;
}

tr.table_header th {
  border-bottom:1pt solid black;
}


tr.border_top td {
  border-top:1pt solid #CCCCCC;
}

tr.table_header_top th {
  border-top:1pt solid black;
}


</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, "select pc.title,pc.datePaid,sum(pc.".$cols.") as cols from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and rd.type = '$type' and (pc.datePaid between '$date' and '$date1') and status ='PAID' group by pc.datePaid,pc.title order by pc.title,pc.datePaid  ") or die("Query fail: " . mysqli_error()); 


echo "<table border=0 width='70%'>";
echo "<tr class='table_header'>";
echo "<th>Date</th>";
echo "<th>Narration</th>";
echo "<th>Debit</th>";
echo "<th>Credit</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {

$this->getGeneralLedger_debit_total += $row['cols'];

$this->coconutTableRowStart();
echo "<td align='center'>".$row['datePaid']."";
echo "<td align='left'>".$row['title']."-".$type."</td>";
echo "<td align='left'>".number_format($row['cols'],2)."</td>";
echo "<td>&nbsp;</td>";
$this->coconutTableRowStop();
}
echo "<tr class='table_header_top'>";
echo "<th>Total</th>";
echo "<th>&nbsp;</th>";
echo "<th>&nbsp;".number_format($this->getGeneralLedger_debit_total,2)."</th>";
echo "<th>&nbsp;</th>";
echo "</tr>";
$this->coconutTableStop();

}



public function accounting_trialBalance_credit($year,$month,$day) {

$date = $year."-".$month."-".$day;
$date1 = $year."-".$month."-".($day+30);

echo "
<style type='text/css'>
a { text-decoration:none; color:red; }
tr:hover { background-color:yellow;color:black;}

tr.border_bottom td {
  border-bottom:1pt solid #CCCCCC;
}

tr.table_header th {
  border-bottom:1pt solid black;
}


tr.border_top td {
  border-top:1pt solid #CCCCCC;
}

tr.table_header_top th {
  border-top:1pt solid black;
}


</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, "select pc.title,sum(pc.total) as totalCreditPerAccountTitle from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and rd.type = 'OPD' and (pc.dateCharge between '$date' and '$date1') and status not like 'DELETED%%%%%%%' group by pc.title order by pc.title asc  ") or die("Query fail: " . mysqli_error()); 



while($row = mysqli_fetch_array($result))
  {

$this->coconutTableRowStart();
echo "<td align='left'>".$row['title']."</td>";
echo "<td>&nbsp;</td>";
echo "<td align='center'>".number_format($row['totalCreditPerAccountTitle'],2)."</td>";
$this->coconutTableRowStop();
}


}




public function accounting_trialBalance_cash_debit($year,$month,$day) {

$date = $year."-".$month."-".$day;
$date1 = $year."-".$month."-".($day+30);

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, "select sum(pc.cashPaid) as cashPaid from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and rd.type = 'OPD' and (pc.datePaid between '$date' and '$date1') and status = 'PAID' and paidVia = 'Cash'  ") or die("Query fail: " . mysqli_error()); 



while($row = mysqli_fetch_array($result))
  {

$this->coconutTableRowStart();
echo "<td align='left'>CASH</td>";
echo "<td align='center'>".number_format($row['cashPaid'],2)."</td>";
echo "<td>&nbsp;</td>";
$this->coconutTableRowStop();
}


}


/*********************ACCOUNTING********************************************/



public $detailedTotalOnly_deposit_total;

public function detailedTotalOnly_deposit_total() {
return $this->detailedTotalOnly_deposit_total;
}

public function detailedTotalOnly_deposit($registrationNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select datePaid,paymentFor,orNo,amountPaid from patientPayment where registrationNo = '$registrationNo' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
  {

$this->detailedTotalOnly_deposit_total += $row['amountPaid'];

echo "<tr>";
echo "<td>&nbsp;<font size=2>".$this->formatDate($row['datePaid'])."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['paymentFor']."</font></td>";
echo "<td>&nbsp;<font size=2>OR#:".$row['orNo']."</font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<font size=2>".number_format($row['amountPaid'],2)."</font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";
}


}



public $getTakeHomeMeds_total;

public function getTakeHomeMeds_total() {
return $this->getTakeHomeMeds_total;
}

public function getTakeHomeMeds($registrationNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select description,quantity,cashUnpaid,dateCharge from patientCharges where registrationNo = '$registrationNo' and title = 'MEDICINE' and remarks = 'takeHomeMeds' and status = 'UNPAID' order by dateCharge asc ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
  {

$this->getTakeHomeMeds_total += $row['cashUnpaid'];

echo "<tr>";
echo "<td>&nbsp;<font size=2>".$row['description']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['quantity']."</font></td>";
echo "<td>&nbsp;<font size=2>".number_format($row['cashUnpaid'],2)."</font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

}

echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<font size=2>".number_format($this->getTakeHomeMeds_total,2)."</font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";

}



public $detailedTotalOnly_patientToPay_total;

public function detailedTotalOnly_patientToPay_total() {
return $this->detailedTotalOnly_patientToPay_total;
}

public function detailedTotalOnly_patientToPay($registrationNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select dateCharge,description,quantity,sellingPrice,total,cashUnpaid,title from patientCharges where registrationNo = '$registrationNo' and cashUnpaid > 0 and status = 'UNPAID' order by dateCharge asc ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
  {

$this->detailedTotalOnly_patientToPay_total += $row['total'];

if($row['title']=="PROFESSIONAL FEE"){
$sp=preg_split('[/]',$row['sellingPrice']);
$sellingPrice=$sp[0];
}
else{
$sellingPrice=$row['sellingPrice'];
}

echo "<tr>";
echo "<td>&nbsp;<font size=2>".$row['dateCharge']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['description']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['quantity']."</font></td>";
echo "<td>&nbsp;<font size=2>".number_format($sellingPrice,2)."</font></td>";
echo "<td>&nbsp;<font size=2>".number_format(trim($row['cashUnpaid']),2)."</font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";
}
echo "<tr>";
echo "<tD>&nbsp;</td>";
echo "</tr>";
/*
$excessMaxBenefits=$this->selectNow("registrationDetails","excessMaxBenefits","registrationNo",$registrationNo);
$excessPF=$this->selectNow("registrationDetails","excessPF","registrationNo",$registrationNo);
$excessRoom=$this->selectNow("registrationDetails","excessRoom","registrationNo",$registrationNo);
$PHICportion=$this->selectNow("registrationDetails","PHICportion","registrationNo",$registrationNo);

if(trim($excessRoom)!=''){
echo "<tr>";
echo "<td>&nbsp;<font size=2>-</font></td>";
echo "<td colspan='3'>&nbsp;<font size=2>EXCESS ROOM</font></td>";
echo "<td>&nbsp;<font size=2>".number_format(trim($excessRoom))."</font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";
}

if(trim($excessPF)!=''){
echo "<tr>";
echo "<td>&nbsp;<font size=2>-</font></td>";
echo "<td colspan='3'>&nbsp;<font size=2>EXCESS PROFESSIONAL FEE</font></td>";
echo "<td>&nbsp;<font size=2>".number_format(trim($excessPF))."</font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";
}

if(trim($excessMaxBenefits)!=''){
echo "<tr>";
echo "<td>&nbsp;<font size=2>-</font></td>";
echo "<td colspan='3'>&nbsp;<font size=2>EXCESS MAX BENEFITS</font></td>";
echo "<td>&nbsp;<font size=2>".number_format(trim($excessMaxBenefits))."</font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";
}

if(trim($PHICportion)!=''){
echo "<tr>";
echo "<td>&nbsp;<font size=2>-</font></td>";
echo "<td colspan='3'>&nbsp;<font size=2>PHILHEALTH PORTION</font></td>";
echo "<td>&nbsp;<font size=2>".number_format(trim($PHICportion))."</font></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";
}

*/

}




/********START PROTACIO HMO SOA IPD*******************/


public function protacio_hmoSOA_ipd_total($registrationNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select sum(pc.company) as totCompany from patientCharges pc where pc.registrationNo = '$registrationNo' and pc.company != 0 and pc.status in ('UNPAID','Discharged') ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['totCompany'];
}

}


public function protacio_hmoSOA_ipd_phic_hb($registrationNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select sum(pc.phic) as totPHIC from patientCharges pc where pc.registrationNo = '$registrationNo' and pc.status = 'UNPAID'and pc.title != 'PROFESSIONAL FEE' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['totPHIC'];
}

}


public function protacio_hmoSOA_ipd_phic_pf($registrationNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select sum(pc.phic) as totPHIC from patientCharges pc where pc.registrationNo = '$registrationNo' and pc.status = 'UNPAID'and pc.title = 'PROFESSIONAL FEE' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['totPHIC'];
}

}


private $protacio_hmoSOA_ipd_attendingDoc_docName;
private $protacio_hmoSOA_ipd_attendingDoc_pf;
private $protacio_hmoSOA_ipd_attendingDoc_initial;

public function protacio_hmoSOA_ipd_attendingDoc_docName() {
return $this->protacio_hmoSOA_ipd_attendingDoc_docName;
}

public function protacio_hmoSOA_ipd_attendingDoc_pf() {
return $this->protacio_hmoSOA_ipd_attendingDoc_pf;
}

public function protacio_hmoSOA_ipd_attendingDoc_initial(){
  return $this->protacio_hmoSOA_ipd_attendingDoc_initial;
}

public function protacio_hmoSOA_ipd_attendingDoc($registrationNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select pc.description,pc.total,d.initial from patientCharges pc,Doctors d where pc.registrationNo = '$registrationNo' and pc.chargesCode = d.doctorCode and pc.title = 'PROFESSIONAL FEE' and pc.status = 'UNPAID' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
$this->protacio_hmoSOA_ipd_attendingDoc_docName[] = $row['description'];
$this->protacio_hmoSOA_ipd_attendingDoc_pf[] = $row['total'];
$this->protacio_hmoSOA_ipd_attendingDoc_initial[] = $row['initial'];
}

}


public $protacio_hmoSOA_ipd_grandTotal;

public function protacio_hmoSOA_ipd($hmo,$date,$date1) {


echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }
</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select pr.lastName,pr.firstName,rd.dateRegistered,rd.dateUnregistered,rd.registrationNo from patientRecord pr,registrationDetails rd where pr.patientNo = rd.patientNo and (rd.dateUnregistered between '$date' and '$date1') and rd.Company = '$hmo' and rd.type = 'IPD' order by rd.dateUnregistered asc ") or die("Query fail: " . mysqli_error()); 

echo "<table border=0 cellspacing=0 cellpadding=0>";
echo "<tr>";
echo "<th><font color='green'>Patient Name</font></th>";
echo "<th><font color='green'>Date of Exam</font></th>";
echo "<th><font size=2 color='green'>Exam/Treatment/Medicines</font></th>";
echo "<th>Amount</th>";
echo "<th><font color='red'>TOTAL</font></th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
  {

$this->protacio_hmoSOA_ipd_attendingDoc($row['registrationNo']);
$dateReg = preg_split ("/\-/", $row['dateRegistered']); 
$dateDischarged = preg_split ("/\-/", $row['dateUnregistered']); 
$this->protacio_hmoSOA_ipd_grandTotal += $this->protacio_hmoSOA_ipd_total($row['registrationNo']);

echo "<tr>";
echo "<td width='30%'><font size=2>".$row['lastName'].", ".$row['firstName']."</font><br><font size=2 color=blue><b>"; 

for($doctor=0,$pf=0;$doctor<count($this->protacio_hmoSOA_ipd_attendingDoc_initial()),$pf<count($this->protacio_hmoSOA_ipd_attendingDoc_pf());$doctor++,$pf++) {
echo $this->protacio_hmoSOA_ipd_attendingDoc_initial()[$doctor]."-".number_format($this->protacio_hmoSOA_ipd_attendingDoc_pf()[$pf],2)."/";
}

echo "</b></font><br><font size=2 color='blue'><b>1st case rate-H-".number_format($this->protacio_hmoSOA_ipd_phic_hb($row['registrationNo']),2)."/PF-".$this->protacio_hmoSOA_ipd_phic_pf($row['registrationNo'])."</b></font></td>";
echo "<td width='20%' align='center'>&nbsp;<font size=2>".$dateReg[1]."-".$dateReg[2]."-".$dateDischarged[2]."-".$dateReg[0]."</font><br>&nbsp;<br>&nbsp;</td>";
echo "<td width='20%' align='center'>&nbsp;<font size=2>CONFINEMENT</font><Br>&nbsp;<br>&nbsp;</td>";
echo "<td width='20%' align='center'>&nbsp;<font size=2><span style='border-bottom:1px solid black;'>".number_format($this->protacio_hmoSOA_ipd_total($row['registrationNo']),2)."</span></font><br>&nbsp;<br>&nbsp;</td>";
echo "<td width='20%' align='center'>&nbsp;<font size=2>".number_format($this->protacio_hmoSOA_ipd_total($row['registrationNo']),2)."</font><br>&nbsp;<br>&nbsp;</td>";
echo "</tr>";
}

echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";
/*
echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<b>TOTAL</b></td>";
echo "<td align='center'>&nbsp;<span style='border-bottom:1px solid #000; border-top:1px solid #000;'><a href='#'><font size=2>".number_format($this->protacio_hmoSOA_ipd_grandTotal,2)."</font></a></span></td>";
echo "</tr>";
*/
echo "</table>";

echo "<Table border=0>";
echo "<tr>";
echo "<Td width='63%'>&nbsp;</td>";
echo "<Td><font color='BLACK'>TOTAL:</font></td>";
echo "<td align='center'>&nbsp;<span style='border-bottom:1px solid #000; border-top:1px solid #000;'><a href='#'><font size=2>".number_format($this->protacio_hmoSOA_ipd_grandTotal,2)."</font></a></span></td>";
echo "</tr>";

echo "<tr>";
echo "<Td>&nbsp;</td>";
echo "<Td></td>";
echo "<Td>&nbsp;</td>";
echo "</tr>";

echo "<tr>";
echo "<Td>&nbsp;</td>";
echo "<Td></td>";
echo "<Td>&nbsp;</td>";
echo "</tr>";

echo "<tr>";
echo "<Td>&nbsp;</td>";
echo "<Td></td>";
echo "<Td>&nbsp;</td>";
echo "</tr>";

echo "<tr>";
echo "<Td>&nbsp;</td>";
echo "<Td><font color='blue' size=2>CERTIFIED TRUE AND CORRECT:</font></td>";
echo "<Td>&nbsp;</td>";
echo "</tr>";

echo "<tr>";
echo "<Td>&nbsp;</td>";
echo "<Td></td>";
echo "<Td>&nbsp;</td>";
echo "</tr>";

echo "<tr>";
echo "<Td>&nbsp;</td>";
echo "<Td></td>";
echo "<Td>&nbsp;</td>";
echo "</tr>";

echo "<tr>";
echo "<Td>&nbsp;</td>";
echo "<Td></td>";
echo "<Td>&nbsp;</td>";
echo "</tr>";

echo "<tr>";
echo "<Td>&nbsp;</td>";
echo "<Td></td>";
echo "<Td>&nbsp;</td>";
echo "</tr>";

echo "<tr>";
echo "<Td>&nbsp;</td>";
echo "<Td><font color=blue>MS SALVACION D. ASPA</font><bR><font color=blue>ACCOUNTING STAFF</font></td>";
echo "<Td></td>";
echo "</tr>";

echo "</table>";

}

/*********END OF PROTACIO HMO SOA IPD**************/




/**************TRANSACTION SUMMARY*********************/


public function transactionSummary_opd_creditCard($date,$date1) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select sum(pc.amountPaidFromCreditCard) as creditCard from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and rd.type = 'OPD' and (pc.datePaid between '$date' and '$date1') and pc.status = 'PAID' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['creditCard'];
}

}


public function transactionSummary_opd_cash($date,$date1) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select sum(pc.cashPaid) as cashPaid from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and rd.type = 'OPD' and (pc.datePaid between '$date' and '$date1') and pc.status = 'PAID' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['cashPaid'];
}

}





public function transactionSummary_opd_company($date,$date1) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select sum(pc.company) as company from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and rd.type = 'OPD' and (pc.dateCharge between '$date' and '$date1') and pc.status = 'UNPAID' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['company'];
}

}


public function transactionSummary_opd_revenueDiscount($date,$date1) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select sum(pc.discount) as disc from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and rd.type = 'OPD' and (pc.dateCharge between '$date' and '$date1') and pc.status not like 'DELETED%%%%%' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['disc'];
}

}

public function transactionSummary_opd_clinicRevenue($date,$date1) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select sum(pc.cashPaid) as clinicRevenue from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and rd.type = 'OPD' and (pc.datePaid between '$date' and '$date1') and pc.status = 'PAID' and pc.title = 'PROFESSIONAL FEE' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['clinicRevenue'];
}

}



public $transactionSummary_opd_department_phic;
public $transactionSummary_opd_department_company;

public function transactionSummary_opd_department_phic() {
return $this->transactionSummary_opd_department_phic;
}

public function transactionSummary_opd_department_company() {
return $this->transactionSummary_opd_department_company;
}

public function transactionSummary_opd_department($dept,$date,$date1) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select sum(pc.phic) as phic,sum(pc.company) as company from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and rd.type = 'OPD' and (pc.dateCharge between '$date' and '$date1') and pc.status = 'UNPAID' and pc.title = '$dept' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
$this->transactionSummary_opd_department_phic = $row['phic'];
$this->transactionSummary_opd_department_company = $row['company'];
}

}



public function transactionSummary_opd_department_cashPaid($dept,$date,$date1) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select sum(pc.cashPaid) as cashPaid from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and rd.type = 'OPD' and (pc.datePaid between '$date' and '$date1') and pc.status = 'PAID' and pc.title = '$dept' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['cashPaid'];
}

}


public function transactionSummary_opd_department_credit($dept,$date,$date1) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select sum(pc.total) as total from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and rd.type = 'OPD' and (rd.dateUnregistered between '$date' and '$date1') and pc.status in ('UNPAID','PAID') and pc.title = '$dept' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['total'];
}

}


public function transactionSummary_opd_department_debit($dept,$paymentMode,$date,$date1) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select sum(pc.".$paymentMode.") as paymentMode from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and rd.type = 'OPD' and (rd.dateUnregistered between '$date' and '$date1') and pc.status = 'UNPAID' and pc.title = '$dept' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['paymentMode'];
}

}


public function transactionSummary_opd_department_debit_paid($dept,$paymentMode,$date,$date1) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


if( $dept == "PROFESSIONAL FEE" ) {
$result = mysqli_query($connection, " select sum(pc.".$paymentMode.") as pd from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and rd.type = 'OPD' and (pc.datePaid between '$date' and '$date1') and pc.status = 'PAID' and pc.title = '$dept' and pc.doctorSpecialization != 'DERMATOLOGY' ") or die("Query fail: " . mysqli_error()); 
}else if ( $dept == "DERMATOLOGY" ) {
$result = mysqli_query($connection, " select sum(pc.".$paymentMode.") as pd from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and rd.type = 'OPD' and (pc.datePaid between '$date' and '$date1') and pc.status = 'PAID' and pc.title = 'PROFESSIONAL FEE' and pc.doctorSpecialization = 'DERMATOLOGY' ") or die("Query fail: " . mysqli_error()); 
}else {
$result = mysqli_query($connection, " select sum(pc.".$paymentMode.") as pd from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and rd.type = 'OPD' and (pc.datePaid between '$date' and '$date1') and pc.status = 'PAID' and pc.title = '$dept'  ") or die("Query fail: " . mysqli_error()); 
}


while($row = mysqli_fetch_array($result))
{
return $row['pd'];
}

}


public function transactionSummary_opd_department_debit_paid_pfCreditCard($date,$date1) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select sum(pc.doctorsPF) as pdPF from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and rd.type = 'OPD' and (pc.datePaid between '$date' and '$date1') and pc.status = 'PAID' and pc.title = 'PROFESSIONAL FEE' and paidVia = 'Credit Card' and pc.doctorSpecialization != 'DERMATOLOGY' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['pdPF'];
}

}



public function transactionSummary_opd_department_debit_covered($dept,$type,$date,$date1) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


if( $dept == "PROFESSIONAL FEE" ) {
$result = mysqli_query($connection, " select sum(pc.company) as covered from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and rd.type = 'OPD' and (rd.dateUnregistered between '$date' and '$date1') and pc.status = 'UNPAID' and pc.title = '$dept' and pc.doctorSpecialization != 'DERMATOLOGY' ") or die("Query fail: " . mysqli_error()); 
}else if( $dept == "DERMATOLOGY" ) {
$result = mysqli_query($connection, " select sum(pc.company) as covered from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and rd.type = 'OPD' and (rd.dateUnregistered between '$date' and '$date1') and pc.status = 'UNPAID' and pc.title = 'PROFESSIONAL FEE' and pc.doctorSpecialization = 'DERMATOLOGY' ") or die("Query fail: " . mysqli_error()); 
}else {
$result = mysqli_query($connection, " select sum(pc.company) as covered from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and rd.type = 'OPD' and (rd.dateUnregistered between '$date' and '$date1') and pc.status = 'UNPAID' and pc.title = '$dept'  ") or die("Query fail: " . mysqli_error()); 
}

while($row = mysqli_fetch_array($result))
{
return $row['covered'];
}

}



public function transactionSummary_opd_department_debit_personalBalance($dept,$date,$date1) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select sum(pc.cashUnpaid) as bal from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and rd.type = 'OPD' and (rd.dateUnregistered between '$date' and '$date1') and pc.status in ('PAID','BALANCE') and pc.title = '$dept' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['bal'];
}

}


public function transactionSummary_opd_department_debit_discount($dept,$date,$date1) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select sum(pc.discount) as discount from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and rd.type = 'OPD' and (rd.dateUnregistered between '$date' and '$date1') and pc.title = '$dept' and pc.discount > 0 and pc.status in ('PAID','UNPAID') ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['discount'];
}

}








public function transactionSummary_ipd_department_debit($paymentMode,$date,$date1) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select sum(pp.amountPaid) as pd from patientRecord pr,registrationDetails rd,patientPayment pp where pr.patientNo = rd.patientNo and rd.registrationNo = pp.registrationNo and (rd.dateUnregistered between '$date' and '$date1') and pp.paidVia = '$paymentMode' != 'DEPOSIT' and rd.type='IPD' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['pd'];
}

}


public function transactionSummary_ipd_department_debit_deposit($date,$date1) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select sum(pp.amountPaid) as pd from patientRecord pr,registrationDetails rd,patientPayment pp where pr.patientNo = rd.patientNo and rd.registrationNo = pp.registrationNo and (rd.dateUnregistered between '$date' and '$date1') and pp.paymentFor = 'DEPOSIT' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['pd'];
}

}


public function transactionSummary_ipd_department_debit_patientBalance($date,$date1) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select sum(rd.balance) as balance from patientRecord pr,registrationDetails rd where pr.patientNo = rd.patientNo and rd.type = 'IPD' and (rd.dateUnregistered between '$date' and '$date1') ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['balance'];
}

}

public function transactionSummary_ipd_department_debit_phic($date,$date1) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select sum(pc.phic) as phic from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and (rd.dateUnregistered between '$date' and '$date1') and pc.status in ('UNPAID','Discharged') and rd.type='IPD' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['phic'];
}

}


public function transactionSummary_ipd_department_debit_company($type,$date,$date1) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select sum(pc.company) as company from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and (rd.dateUnregistered between '$date' and '$date1') and pc.status in ('UNPAID','Discharged') and rd.type = 'IPD' and rd.companyType = '$type' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['company'];
}

}



public function transactionSummary_ipd_department_debit_discount($date,$date1) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select sum(discount) as discount from registrationDetails where (dateUnregistered between '$date' and '$date1') and type = 'IPD' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['discount'];
}

}



public function transactionSummary_ipd_department_debit_cashUnpaid($date,$date1) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select sum(pc.cashUnpaid) as cashUnpaid from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and rd.type = 'IPD' and (rd.dateUnregistered between '$date' and '$date1') and pc.status in ('UNPAID','Discharged') ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['cashUnpaid'];
}

}




public function transactionSummary_ipd_department_totalCharges($date,$date1) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select sum(pc.total) as totalBill from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and pc.status in ('UNPAID','Discharged') and (rd.dateUnregistered between '$date' and '$date1') and rd.type='IPD'") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['totalBill'];
}

}


public function transactionSummary_ipd_department_totalPaid($date,$date1) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, "select sum(pp.amountPaid) as totalPaid from registrationDetails rd,patientPayment pp where rd.registrationNo = pp.registrationNo and rd.type = 'IPD' and (rd.dateUnregistered between '$date' and '$date1') ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['totalPaid'];
}

}


public function transactionSummary_ipd_department_credit($dept,$date,$date1) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select sum(pc.total) as total from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and rd.type = 'IPD' and (rd.dateUnregistered between '$date' and '$date1') and pc.status in ('UNPAID','Discharged') and pc.title = '$dept' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['total'];
}

}


public function transactionSummary_ipd_department_inventory_credit($dept,$date,$date1) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select sum(pc.total) as total from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and rd.type = 'IPD' and (rd.dateUnregistered between '$date' and '$date1') and pc.status = 'UNPAID' and pc.title = '$dept' and pc.departmentStatus like 'dispensedBy%%%%%%' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['total'];
}

}



public function transactionSummaryDischarge_totalPaid($paymentFor,$registrationNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select sum(amountPaid) as total from patientPayment where registrationNo = '$registrationNo' and paymentFor = '$paymentFor' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['total'];
}

}

public function transactionSummaryDischarge_totalCharges($cols,$registrationNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select sum($cols) as total from patientCharges where status in ('UNPAID','Discharged') and registrationNo = '$registrationNo' and title not in ('MEDICINE','SUPPLIES') ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['total'];
}

}


public function transactionSummaryDischarge_totalInventory($cols,$registrationNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select sum($cols) as total from patientCharges where status ='UNPAID' and registrationNo = '$registrationNo' and title in ('MEDICINE','SUPPLIES') and departmentStatus like 'dispensedBy%%%%%%%'") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['total'];
}

}

public $transactionSummaryDischarge_total;
public $transactionSummaryDischarge_cash;
public $transactionSummaryDischarge_phic;
public $transactionSummaryDischarge_company;
public $transactionSummaryDischarge_deposit;
public $transactionSummaryDischarge_hospitalBill;
public $transactionSummaryDischarge_balanceTotal;

public function transactionSummaryDischarge($date,$date1) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }
</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, "select pr.lastName,pr.firstName,rd.Company,rd.registrationNo,rd.discount from patientRecord pr,registrationDetails rd where pr.patientNo = rd.patientNo and (rd.dateUnregistered between '$date' and '$date1') and rd.type='IPD' order by rd.registrationNo asc  ") or die("Query fail: " . mysqli_error()); 

echo "<br><br><br><center>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("&nbsp;");
$this->coconutTableHeader("Reg#");
$this->coconutTableHeader("Patient");
$this->coconutTableHeader("Total");
$this->coconutTableHeader("CASH");
$this->coconutTableHeader("PHIC");
$this->coconutTableHeader("HMO");
$this->coconutTableHeader("DEPOSIT");
$this->coconutTableHeader("HB");
$this->coconutTableHeader("DISCOUNT");
$this->coconutTableHeader("BALANCE");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
{

echo "<tr>";
$totalPd = ( $this->transactionSummaryDischarge_totalPaid("HOSPITAL BILL",$row['registrationNo']) + $this->transactionSummaryDischarge_totalPaid("DEPOSIT",$row['registrationNo'] ) 
);
$balance = ( 
($this->transactionSummaryDischarge_totalCharges("cashUnpaid",$row['registrationNo']) + $this->transactionSummaryDischarge_totalInventory("cashUnpaid",$row['registrationNo'])) - $totalPd  
);

$balance1 = ($balance - $row['discount']);

//CHARGES
$this->transactionSummaryDischarge_balanceTotal += $balance1;
$this->transactionSummaryDischarge_total += ($this->transactionSummaryDischarge_totalCharges("total",$row['registrationNo']) + $this->transactionSummaryDischarge_totalInventory("total",$row['registrationNo']));
$this->transactionSummaryDischarge_cash += ($this->transactionSummaryDischarge_totalCharges("cashUnpaid",$row['registrationNo']) + $this->transactionSummaryDischarge_totalInventory("cashUnpaid",$row['registrationNo']));
$this->transactionSummaryDischarge_company += ($this->transactionSummaryDischarge_totalCharges("company",$row['registrationNo']) + $this->transactionSummaryDischarge_totalInventory("company",$row['registrationNo']));
$this->transactionSummaryDischarge_phic += ($this->transactionSummaryDischarge_totalCharges("phic",$row['registrationNo']) + $this->transactionSummaryDischarge_totalInventory("phic",$row['registrationNo']));
//PAYMENT
$this->transactionSummaryDischarge_deposit += $this->transactionSummaryDischarge_totalPaid("DEPOSIT",$row['registrationNo'] );
$this->transactionSummaryDischarge_hospitalBill += $this->transactionSummaryDischarge_totalPaid("HOSPITAL BILL",$row['registrationNo'] );


echo "<td><input type='checkbox' name='balanceHandler[]' value='".$row['registrationNo']."-".round($balance1,2)."' checked></td>";
echo "<td>".$row['registrationNo']."</td>";
echo "<td>".$row['lastName'].", ".$row['firstName']."</td>";
echo "<td>".number_format( ($this->transactionSummaryDischarge_totalCharges("total",$row['registrationNo']) + $this->transactionSummaryDischarge_totalInventory("total",$row['registrationNo'])),2)."</td>";

echo "<td>".number_format( ($this->transactionSummaryDischarge_totalCharges("cashUnpaid",$row['registrationNo']) + $this->transactionSummaryDischarge_totalInventory("cashUnpaid",$row['registrationNo'])),2)."</td>";

echo "<td>".number_format( ($this->transactionSummaryDischarge_totalCharges("phic",$row['registrationNo']) + $this->transactionSummaryDischarge_totalInventory("phic",$row['registrationNo'])),2)."</td>";

echo "<td>".number_format( ($this->transactionSummaryDischarge_totalCharges("company",$row['registrationNo']) + $this->transactionSummaryDischarge_totalInventory("company",$row['registrationNo'])),2)."</td>";

echo "<td>".number_format($this->transactionSummaryDischarge_totalPaid("DEPOSIT",$row['registrationNo']),2)."</td>";
echo "<td>".number_format($this->transactionSummaryDischarge_totalPaid("HOSPITAL BILL",$row['registrationNo']),2)."</td>";
echo "<td>".$row['discount']."</td>";
if( $balance > 0 ) {
echo "<td>".number_format(round($balance1,2),2)."</td>";
}else {
echo "<td><font color=red>".number_format(round($balance1,2),2)."</font></td>";
}
echo "</tr>";
}
echo "<Tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;".number_format($this->transactionSummaryDischarge_total,2)."</td>";
echo "<td>&nbsp;".number_format($this->transactionSummaryDischarge_cash,2)."</td>";
echo "<td>&nbsp;".number_format($this->transactionSummaryDischarge_phic,2)."</td>";
echo "<td>&nbsp;".number_format($this->transactionSummaryDischarge_company,2)."</td>";
echo "<td>&nbsp;".number_format($this->transactionSummaryDischarge_deposit,2)."</td>";
echo "<td>&nbsp;".number_format($this->transactionSummaryDischarge_hospitalBill,2)."</td>";
echo "<td></td>";
echo "<td>&nbsp;".number_format($this->transactionSummaryDischarge_balanceTotal,2)."</td>";
echo "</tr>";
echo "</table>";
echo "<br><br>";
}


public function transactionSummary_paidBalance($type,$date,$date1) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select sum(amountPaid) as total from patientPayment where (datePaid between '$date' and '$date1') and registrationNo like 'manual_%%%%%%' and patientType = '$type' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['total'];
}

}

public function transactionSummary_paidBalance_paymentMode($type,$paidVia,$date,$date1) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select sum(amountPaid) as total from patientPayment where (datePaid between '$date' and '$date1') and registrationNo like 'manual_%%%%%%' and patientType = '$type' and paidVia = '$paidVia' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['total'];
}

}



public function transactionSummary_dermaPayments($paidVia,$date,$date1) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select sum(amountPaid) as total from patientPayment where (datePaid between '$date' and '$date1') and registrationNo like 'derma_%%%%%%' and patientType = 'OPD' and paidVia = '$paidVia' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['total'];
}

}



/*************TRANSACTION SUMMARY**********************/


/**********START OF INVENTORY MOVEMENT**************/



public function _1stQuarterBeginningBalance($stockCardNo,$dateAdded) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select sum(beginningCapital) as beginningBalance from inventory where stockCardNo = '$stockCardNo' and status not like 'DELETED%%%%' and dateAdded = '$dateAdded' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['beginningBalance'];
}

}


public function _3monthsPurchases($date,$date1,$stockCardNo,$inventoryType) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select sum(beginningCapital) as totalPurchases from inventory where stockCardNo = '$stockCardNo' and status not like 'DELETED%%%%' and (dateAdded between '$date' and '$date1') and inventoryType = '$inventoryType' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['totalPurchases'];
}
}


public function itemPriceList_medicine($stockCardNo) {


echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }
</style>";


$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select inventoryCode,description,unitcost,suppliesUNITCOST,opdPrice,ipdPrice,dateAdded,inventoryType,dateAdded from inventory where stockCardNo = '$stockCardNo' and status not like 'DELETED%%%%%' order by dateAdded asc ") or die("Query fail: " . mysqli_error()); 

echo "<br><center><table border=1 cellspacing=0 cellpadding=1>";
echo "<Tr>";
echo "<th>Encoded</th>";
echo "<th>Inv#</th>";
echo "<th>Description</th>";
echo "<th>UnitCost</th>";
echo "<th>IPD Price</th>";
echo "<th>OPD Price</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
{

echo "<tr>";
echo "<td>&nbsp;".$row['dateAdded']."</td>";
echo "<td>&nbsp;".$row['inventoryCode']."</td>";
echo "<td>&nbsp;".$row['description']."</td>";
echo "<td>&nbsp;".number_format($row['unitcost'],2)."</td>";
echo "<td>&nbsp;<font color='blue'>".number_format($row['opdPrice'],2)."</font></td>";
echo "<td>&nbsp;<font color='red'>".number_format($row['ipdPrice'],2)."</font></td>";
echo "</tr>";
}
echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";
echo "</table>";

}


public function itemPriceList_supplies($stockCardNo) {


echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }
</style>";


$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select inventoryCode,description,unitcost,suppliesUNITCOST,opdPrice,ipdPrice,dateAdded,inventoryType from inventory where stockCardNo = '$stockCardNo' and status not like 'DELETED%%%%%' order by dateAdded asc ") or die("Query fail: " . mysqli_error()); 

echo "<br><center><table border=1 cellspacing=0 cellpadding=1>";
echo "<Tr>";
echo "<th>Encoded</th>";
echo "<th>Inv#</th>";
echo "<th>Description</th>";
echo "<th>UnitCost</th>";
echo "<th>Price</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
{

echo "<tr>";
echo "<td>&nbsp;".$row['dateAdded']."</td>";
echo "<td>&nbsp;".$row['inventoryCode']."</td>";
echo "<td>&nbsp;".$row['description']."</td>";
if( $row['suppliesUNITCOST'] != "" ) {
echo "<td>&nbsp;".number_format($row['suppliesUNITCOST'],2)."</td>";
}else {
echo "<td>&nbsp;</td>";
}
echo "<td>&nbsp;<font color='blue'>".number_format($row['unitcost'],2)."</font></td>";
echo "</tr>";
}
echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "</tr>";
echo "</table>";

}


public $_3monthsPurchasesDetails_total;

public function _3monthsPurchasesDetails($stockCardNo,$date,$date1) {


echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }
</style>";


$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select inventoryCode,stockCardNo,description,quantity,beginningQTY,unitcost,suppliesUNITCOST,beginningCapital,opdPrice,ipdPrice,dateAdded,inventoryType,dateAdded from inventory where stockCardNo = '$stockCardNo' and (dateAdded between '$date' and '$date1') and status not like 'DELETED%%%%%' order by dateAdded asc ") or die("Query fail: " . mysqli_error()); 

echo "<br><center><table border=1 cellspacing=0 cellpadding=1>";
echo "<Tr>";
echo "<th>Encoded</th>";
echo "<th>Inv#</th>";
echo "<th>StockCard#</th>";
echo "<th>Description</th>";
echo "<th>UnitCost</th>";
echo "<th>Current QTY</th>";
echo "<th>Beginning QTY</th>";
echo "<th>Beginning Bal</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
{

$this->_3monthsPurchasesDetails_total += $row['beginningCapital'];

echo "<tr>";
echo "<td>&nbsp;".$row['dateAdded']."</td>";
echo "<td>&nbsp;".$row['inventoryCode']."</td>";
echo "<td>&nbsp;".$row['stockCardNo']."</td>";
echo "<td>&nbsp;".$row['description']."</td>";

if( $row['inventoryType'] == "medicine" ) {
echo "<td>&nbsp;".number_format($row['unitcost'],2)."</td>";
}else {
echo "<td>&nbsp;".number_format($row['suppliesUNITCOST'],2)."</td>";
}

echo "<td>&nbsp;".$row['quantity']."</td>";
echo "<td>&nbsp;".$row['beginningQTY']."</td>";
echo "<td>&nbsp;".number_format($row['beginningCapital'],2)."</td>";

echo "</tr>";
}
echo "<tr>";
echo "<td>&nbsp;<b>Total</b></td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;<b>".number_format($this->_3monthsPurchasesDetails_total,2)."</b></td>";
echo "</tr>";
echo "</table>";

}

public function inventoryMovement_insertEndingInventory($stockCardNo,$endingInventoryCols,$endingInventoryData) {

/* make your connection */
$sql = new mysqli($this->host,$this->username,$this->password,$this->database);
 
/* we will just create an insert query here, and use it,
normally this would be done by form submission or other means */
$query = "insert into inventoryMovement(stockCardNo,".$endingInventoryCols.") values('$stockCardNo','$endingInventoryData')";
 
if ( $sql->query($query) ) {
   //echo "A new entry has been added with the `id`";
} else {
    echo "There was a problem:<br />$query<br />{$sql->error}";
}
 
/* close our connection */
$sql->close();
}


public $inventoryMovement_beginning_1stQuarter;
public $inventoryMovement_beginning_2ndQuarter;
public $inventoryMovement_purchases_1stQuarter;
public $inventoryMovement_purchases_2ndQuarter;
public $inventoryMovement_purchases_3rdQuarter;
public $inventoryMovement_purchases_4thQuarter;
public $inventoryMovement_ending_1stQuarter;
public $inventoryMovement_ending_2ndQuarter;
public $inventoryMovement_ending_3rdQuarter;
public $inventoryMovement_ending_4thQuarter;
public $inventoryMovement_movement_1stQuarter;
public $inventoryMovement_movement_2ndQuarter;
public $inventoryMovement_movement_3rdQuarter;
public $inventoryMovement_movement_4thQuarter;

public function inventoryMovement_list($year,$title,$medType,$username) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }
</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


if( $medType == "all" ) {
$result = mysqli_query($connection, " select isc.description,isc.stockCardNo,i.Added,i.unitcost from inventoryStockCard isc,inventory i where isc.stockCardNo = i.stockCardNo and isc.inventoryType = '$title' group by isc.stockCardNo order by isc.description asc ") or die("Query fail: " . mysqli_error()); 
}else {
$result = mysqli_query($connection, " select isc.description,isc.stockCardNo,i.Added,i.unitcost from inventoryStockCard isc,inventory i,inventoryMovement im where isc.stockCardNo = i.stockCardNo and i.stockCardNo = im.stockCardNo and im.medicineType = '$medType' and isc.inventoryType = '$title' group by isc.stockCardNo order by isc.description asc ") or die("Query fail: " . mysqli_error());
}


echo "<table border=1 cellpadding=1 cellspacing=0>";
echo "<Tr>";
echo "<th>&nbsp;<font size=2>Name of $title</font></th>";
echo "<th>&nbsp;<font size=2>BEG. BAL<br> 1/1/$year </font></th>";
echo "<th>&nbsp;<font size=1>3 MOS.<BR>PURCHASES </font></th>";
echo "<th>&nbsp;<font size=2>END INVTY<BR>3/31/$year</font></th>";
echo "<th bgcolor='yellow'>&nbsp;<font size=1>3 MOS.<BR> MOVEMENTS</font></th>";
echo "<th>&nbsp;<font size=1>3 MOS.<BR>PURCHASES </font></th>";
echo "<th>&nbsp;<font size=2>END INVTY<BR>6/30/$year</font></th>";
echo "<th bgcolor='yellow'>&nbsp;<font size=1>3 MOS.<BR> MOVEMENTS</font></th>";
echo "<th>&nbsp;<font size=1>3 MOS.<BR>PURCHASES </font></th>";
echo "<th>&nbsp;<font size=2>END INVTY<BR>9/30/$year</font></th>";
echo "<th bgcolor='yellow'>&nbsp;<font size=1>3 MOS.<BR> MOVEMENTS</font></th>";
echo "<th>&nbsp;<font size=1>3 MOS.<BR>PURCHASES </font></th>";
echo "<th>&nbsp;<font size=2>END INVTY<BR>12/31/$year</font></th>";
echo "<th bgcolor='yellow'>&nbsp;<font size=1>3 MOS.<BR> MOVEMENTS</font></th>";

echo "</tr>";
while($row = mysqli_fetch_array($result))
{

$movementNo = $this->selectNow("inventoryMovement","movementNo","stockCardNo",$row['stockCardNo']);


$this->inventoryMovement_purchases_1stQuarter = $this->_3monthsPurchases($year."-01-02",$year."-03-31",$row['stockCardNo'],$title);
$this->inventoryMovement_purchases_2ndQuarter = $this->_3monthsPurchases($year."-04-01",$year."-06-31",$row['stockCardNo'],$title);
$this->inventoryMovement_purchases_3rdQuarter = $this->_3monthsPurchases($year."-07-01",$year."-09-31",$row['stockCardNo'],$title);
$this->inventoryMovement_purchases_4thQuarter = $this->_3monthsPurchases($year."-10-01",$year."-12-31",$row['stockCardNo'],$title);

$this->inventoryMovement_ending_1stQuarter = $this->selectNow("inventoryMovement","endingInventory","movementNo",$movementNo);
$this->inventoryMovement_ending_2ndQuarter = $this->selectNow("inventoryMovement","endingInventory1","movementNo",$movementNo);
$this->inventoryMovement_ending_3rdQuarter = $this->selectNow("inventoryMovement","endingInventory2","movementNo",$movementNo);
$this->inventoryMovement_ending_4thQuarter = $this->selectNow("inventoryMovement","endingInventory3","movementNo",$movementNo);

$this->inventoryMovement_beginning_1stQuarter = $this->_1stQuarterBeginningBalance($row['stockCardNo'],$year."-01-01");
$this->inventoryMovement_beginning_2ndQuarter = $this->inventoryMovement_ending_1stQuarter;
$this->inventoryMovement_beginning_3rdQuarter = $this->inventoryMovement_ending_2ndQuarter;
$this->inventoryMovement_beginning_4thQuarter = $this->inventoryMovement_ending_3rdQuarter;

$this->inventoryMovement_movement_1stQuarter = (( $this->inventoryMovement_beginning_1stQuarter + $this->inventoryMovement_purchases_1stQuarter ) - $this->inventoryMovement_ending_1stQuarter);
$this->inventoryMovement_movement_2ndQuarter =  (( $this->inventoryMovement_beginning_2ndQuarter + $this->inventoryMovement_purchases_2ndQuarter ) - $this->inventoryMovement_ending_2ndQuarter);
$this->inventoryMovement_movement_3rdQuarter =  (( $this->inventoryMovement_beginning_3rdQuarter + $this->inventoryMovement_purchases_3rdQuarter ) - $this->inventoryMovement_ending_3rdQuarter);
$this->inventoryMovement_movement_4thQuarter =  (( $this->inventoryMovement_beginning_4thQuarter + $this->inventoryMovement_purchases_4thQuarter ) - $this->inventoryMovement_ending_4thQuarter);


echo "<tr>";

if( $title == "medicine" ) {
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Reports/inventoryReport/inventoryMovementOption.php?description=$row[description]&stockCardNo=$row[stockCardNo]&movementNo=$movementNo&username=$username&inventoryType=$title&year=$year&medType=$medType' style='text-decoration:none;'><font size=2>".$row['description']."</font> <br> <a href='http://".$this->getMyUrl()."/COCONUT/Reports/inventoryReport/inventoryMovement_pricelist.php?stockCardNo=$row[stockCardNo]&inventoryType=medicine' style='text-decoration:none; color:red'><font color=red size=2>See Price List</font></a></a></td>";
}else {
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Reports/inventoryReport/inventoryMovementOption.php?description=$row[description]&stockCardNo=$row[stockCardNo]&movementNo=$movementNo&username=$username&inventoryType=$title&year=$year&medType=$medType' style='text-decoration:none;'><font size=2>".$row['description']."</font></a> - <a href='http://".$this->getMyUrl()."/COCONUT/Reports/inventoryReport/inventoryMovement_pricelist.php?stockCardNo=$row[stockCardNo]&inventoryType=supplies' style='text-decoration:none; color:red;'><font color=red size=2>See Price List</font></a></td>";
}


if( $this->inventoryMovement_beginning_1stQuarter > 0 ) {
echo "<td>&nbsp;".number_format($this->inventoryMovement_beginning_1stQuarter,2)."</td>";
}else {
echo "<td>&nbsp;</td>";
}


if( $this->inventoryMovement_purchases_1stQuarter > 0 ) {
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Reports/inventoryReport/inventoryMovement_purchasesDetails.php?stockCardNo=$row[stockCardNo]&date=".$year."-01-02&date1=".$year."-03-31' style='text-decoration:none; color:black;'>".number_format($this->inventoryMovement_purchases_1stQuarter,2)."</a></td>";
}else {
echo "<td>&nbsp;</td>";
}


if( $this->inventoryMovement_ending_1stQuarter > 0 ) {
echo "<td>&nbsp;".number_format($this->inventoryMovement_ending_1stQuarter,2)."</td>";
}else {
echo "<td>&nbsp;</td>";
}


if( $this->inventoryMovement_movement_1stQuarter != "" ) {
echo "<td bgcolor='yellow'>&nbsp;".number_format($this->inventoryMovement_movement_1stQuarter,2)."</td>";
}else {
echo "<td bgcolor='yellow'>&nbsp;</td>";
}


if( $this->inventoryMovement_purchases_2ndQuarter > 0 ) {
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Reports/inventoryReport/inventoryMovement_purchasesDetails.php?stockCardNo=$row[stockCardNo]&date=".$year."-04-01&date1=".$year."-06-31' style='text-decoration:none; color:black;'>".number_format($this->inventoryMovement_purchases_2ndQuarter,2)."</a></td>";
}else {
echo "<td>&nbsp;</td>";
}


if( $this->inventoryMovement_ending_2ndQuarter > 0 ) {
echo "<td>&nbsp;".number_format($this->inventoryMovement_ending_2ndQuarter,2)."</td>";
}else {
echo "<td>&nbsp;</td>";
}


if( $this->inventoryMovement_movement_2ndQuarter != "" ) {
echo "<td bgcolor='yellow'>&nbsp;".number_format($this->inventoryMovement_movement_2ndQuarter,2)."</td>";
}else {
echo "<td bgcolor='yellow'>&nbsp;</td>";
}


if( $this->inventoryMovement_purchases_3rdQuarter > 0 ) {
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Reports/inventoryReport/inventoryMovement_purchasesDetails.php?stockCardNo=$row[stockCardNo]&date=".$year."-07-01&date1=".$year."-09-31' style='text-decoration:none; color:black;'>".number_format($this->inventoryMovement_purchases_3rdQuarter,2)."</a></td>";
}else {
echo "<td>&nbsp;</td>";
}



if( $this->inventoryMovement_ending_3rdQuarter > 0 ) {
echo "<td>&nbsp;".number_format($this->inventoryMovement_ending_3rdQuarter,2)."</td>";
}else {
echo "<td>&nbsp;</td>";
}


if( $this->inventoryMovement_movement_3rdQuarter != "" ) {
echo "<td bgcolor='yellow'>&nbsp;".number_format($this->inventoryMovement_movement_3rdQuarter,2)."</td>";
}else {
echo "<td bgcolor='yellow'>&nbsp;</td>";
}


if( $this->inventoryMovement_purchases_4thQuarter > 0 ) {
echo "<td>&nbsp;<a href='http://".$this->getMyUrl()."/COCONUT/Reports/inventoryReport/inventoryMovement_purchasesDetails.php?stockCardNo=$row[stockCardNo]&date=".$year."-10-01&date1=".$year."-12-31' style='text-decoration:none; color:black;'>".number_format($this->inventoryMovement_purchases_4thQuarter,2)."</a></td>";
}else {
echo "<td>&nbsp;</td>";
}


echo "<td>&nbsp;".$this->inventoryMovement_ending_4thQuarter."</td>";

if( $this->inventoryMovement_movement_4thQuarter != "" ) {
echo "<td bgcolor='yellow'>&nbsp;".$this->inventoryMovement_movement_4thQuarter."</td>";
echo "</tr>";
}else {
echo "<td bgcolor='yellow'>&nbsp;</td>";
}


}
echo "</table>";
}

/**********END OF INVENTORY MOVEMENT***************/




/************PATIENT LIST*************************/

public static $patientList_totalPx;

public function patientList($dateType,$type,$date,$date1,$username) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }
</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


if( $type == "all" ) {
$result = mysqli_query($connection, "select pr.lastName,pr.firstName,rd.dateRegistered,rd.dateUnregistered,rd.type,rd.manual_patientNo,rd.manual_registrationNo,rd.registrationNo from patientRecord pr,registrationDetails rd where pr.patientNo = rd.patientNo and (rd.".$dateType." between '$date' and '$date1') order by rd.".$dateType.",pr.lastName asc ") or die("Query fail: " . mysqli_error()); 
}else {
$result = mysqli_query($connection, "select pr.lastName,pr.firstName,rd.dateRegistered,rd.dateUnregistered,rd.type,rd.manual_patientNo,rd.manual_registrationNo,rd.registrationNo from patientRecord pr,registrationDetails rd where pr.patientNo = rd.patientNo and rd.type = '$type' and (rd.".$dateType." between '$date' and '$date1') order by rd.".$dateType.",pr.lastName asc ") or die("Query fail: " . mysqli_error()); 
}

self::$patientList_totalPx = 1;

echo "<center>";
$this->coconutTableStart();
$this->coconutTableRowStart();
$this->coconutTableHeader("#");
$this->coconutTableHeader("Patient#");
$this->coconutTableHeader("Case#");
$this->coconutTableHeader("Patient");
$this->coconutTableHeader("Type");
$this->coconutTableHeader("In");
$this->coconutTableHeader("Out");
$this->coconutTableHeader("&nbsp;");
$this->coconutTableRowStop();
while($row = mysqli_fetch_array($result))
{
$this->coconutTableRowStart();
$this->coconutTableData(self::$patientList_totalPx++);
$this->coconutTableData($row['manual_patientNo']);
$this->coconutTableData($row['manual_registrationNo']);
$this->coconutTableData($row['lastName'].", ".$row['firstName']);
$this->coconutTableData($row['type']);
$this->coconutTableData($row['dateRegistered']);
$this->coconutTableData($row['dateUnregistered']);
$this->coconutTableData("<form method='post' action='http://".$this->getMyUrl()."/COCONUT/currentPatient/patientInterface1.php' target='_blank'>
<input type='hidden' style='display:none; font-size:0;' name='username' value='$username'>
<input type='hidden' style='display:none; font-size:0; ' name='registrationNo' value='$row[registrationNo]'>
<input type='submit' style='border:1px solid #ff0000;' value='View'>
</form>");
echo "</tr>";
$this->coconutTableRowStop();
}
$this->coconutTableStop();
}


public function patientList_countPx($dateType,$type,$date,$date1,$username) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }
</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


if( $type == "all" ) {
$result = mysqli_query($connection, "select count(rd.registrationNo) as registrationNo from patientRecord pr,registrationDetails rd where pr.patientNo = rd.patientNo and (rd.".$dateType." between '$date' and '$date1') order by rd.".$dateType.",pr.lastName asc ") or die("Query fail: " . mysqli_error()); 
}else {
$result = mysqli_query($connection, "select count(rd.registrationNo) as registrationNo from patientRecord pr,registrationDetails rd where pr.patientNo = rd.patientNo and rd.type = '$type' and (rd.".$dateType." between '$date' and '$date1') order by rd.".$dateType.",pr.lastName asc ") or die("Query fail: " . mysqli_error()); 
}

while($row = mysqli_fetch_array($result))
{
return $row['registrationNo'];
}

}


/***********PATIENT LIST**************************/



public function addAccountTitle($username,$accountNo,$accountName,$dateAdded,$bold,$accountType,$parentTitle_of_accountType) {

/* make your connection */
$sql = new mysqli($this->host,$this->username,$this->password,$this->database);
 
/* we will just create an insert query here, and use it,
normally this would be done by form submission or other means */
$query = "insert into accountTitle(accountNo,accountTitle,dateAdded,addedBy,bold,accountType,parentTitle_of_accountType) values('$accountNo','$accountName','$dateAdded','$username','$bold','$accountType','$parentTitle_of_accountType')";
 
if ( $sql->query($query) ) {
   //echo "A new entry has been added with the `id`";
} else {
    echo "There was a problem:<br />$query<br />{$sql->error}";
}
 
/* close our connection */
$sql->close();
}




public function subAccountTitle_3rdlane($refNo,$username) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }
</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, "select refNo,accountNo,accountTitle,bold from accountTitle where status != 'DELETED' and accountType = '$refNo' ") or die("Query fail: " . mysqli_error()); 


while($row = mysqli_fetch_array($result))
{
echo "<tr>";
$this->coconutTableData($row['accountNo']);
$this->coconutTableData("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$row['accountTitle']);

$this->coconutTableData("&nbsp;");


$this->coconutTableData("<form method='post' action='/COCONUT/accounting/deleteAccountTitle.php' style='margin-top:-10px; margin-bottom:-10px; margin-right:10px; margin-left:10px; '>
<input type='submit' style='border:1px solid #ff0000; padding-top:0px;' value='DEL'>
<input type='hidden' name='username' value='$username'>
<input type='hidden' name='accountNo' value='$row[accountNo]'>
<input type='hidden' name='accountTitle' value='$row[accountTitle]'>
<input type='hidden' name='refNo' value='$row[refNo]'>
</form>");

echo "</tr>";
}

}



public function subAccountTitle_2ndlane($refNo,$username) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }
</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, "select refNo,accountNo,accountTitle,bold,accountType,parentTitle_of_accountType from accountTitle where status != 'DELETED' and accountType = '$refNo' ") or die("Query fail: " . mysqli_error()); 


while($row = mysqli_fetch_array($result))
{
echo "<tr>";
$this->coconutTableData($row['accountNo']);
$this->coconutTableData("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$row['accountTitle']);

$this->coconutTableData("<form method='post' action='/COCONUT/accounting/addAccountTitle.php' style='margin-top:-10px; margin-bottom:-10px; margin-right:10px; margin-left:10px; '>
<input type='submit' style='border:1px solid #ff0000; padding-top:0px;' value='ADD'>
<input type='hidden' name='username' value='$username'>
<input type='hidden' name='accountType' value='$row[refNo]'>
<input type='hidden' name='parentTitle_of_accountType' value='$row[parentTitle_of_accountType]'>
</form>");


$this->coconutTableData("<form method='post' action='/COCONUT/accounting/deleteAccountTitle.php' style='margin-top:-10px; margin-bottom:-10px; margin-right:10px; margin-left:10px; '>
<input type='submit' style='border:1px solid #ff0000; padding-top:0px;' value='DEL'>
<input type='hidden' name='username' value='$username'>
<input type='hidden' name='accountNo' value='$row[accountNo]'>
<input type='hidden' name='accountTitle' value='$row[accountTitle]'>
<input type='hidden' name='refNo' value='$row[refNo]'>
</form>");
echo "</tr>";
$this->subAccountTitle_3rdlane($row['refNo'],$username);
}

}


public function subAccountTitle_1stlane($refNo,$username) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }
</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, "select refNo,accountNo,accountTitle,accountType,bold from accountTitle where status != 'DELETED' and accountType = '$refNo' ") or die("Query fail: " . mysqli_error()); 


while($row = mysqli_fetch_array($result))
{
echo "<tr>";
$this->coconutTableData($row['accountNo']);
$this->coconutTableData("&nbsp;&nbsp;&nbsp;<font color='red'>".$row['accountTitle']."</font>");

$this->coconutTableData("<form method='post' action='/COCONUT/accounting/addAccountTitle.php' style='margin-top:-10px; margin-bottom:-10px; margin-right:10px; margin-left:10px; '>
<input type='submit' style='border:1px solid #ff0000; padding-top:0px;' value='ADD'>
<input type='hidden' name='username' value='$username'>
<input type='hidden' name='accountType' value='$row[refNo]'>
<input type='hidden' name='parentTitle_of_accountType' value='$row[accountType]'>
</form>");

$this->coconutTableData("<form method='post' action='/COCONUT/accounting/deleteAccountTitle.php' style='margin-top:-10px; margin-bottom:-10px; margin-right:10px; margin-left:10px; '>
<input type='submit' style='border:1px solid #ff0000; padding-top:0px;' value='DEL'>
<input type='hidden' name='username' value='$username'>
<input type='hidden' name='accountNo' value='$row[accountNo]'>
<input type='hidden' name='accountTitle' value='$row[accountTitle]'>
<input type='hidden' name='refNo' value='$row[refNo]'>
</form>");

echo "</tr>";
$this->subAccountTitle_2ndlane($row['refNo'],$username);
}

}

public function chartOfAccountsz($username) {

echo "
<style type='text/css'>
tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }
</style>
";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, "select * from accountTitle where status != 'DELETED' and accountType = 'primaryTitle' order by AccountNo asc ") or die("Query fail: " . mysqli_error()); 

echo "<center><br><br>";
$this->coconutTableStart();
echo "<tr>";
$this->coconutTableHeader("Account No");
$this->coconutTableHeader("Account Name");
$this->coconutTableHeader("");
$this->coconutTableHeader("");
echo "</tr>";
while($row = mysqli_fetch_array($result))
{

echo "<tr>";
if( $row['accountType'] == "primaryTitle" ) {
$this->coconutTableData("<b><font color='black'>".$row['accountNo']."</font></b>");
$this->coconutTableData("<b><font color='#4d3382'>".$row['accountTitle']."</font></b>");
}else {
$this->coconutTableData($row['accountNo']);
$this->coconutTableData($row['accountTitle']);
}


$this->coconutTableData("<form method='post' action='/COCONUT/accounting/addAccountTitle.php' style='margin-top:-10px; margin-bottom:-10px; margin-right:10px; margin-left:10px; '>
<input type='submit' style='border:1px solid #ff0000; padding-top:0px;' value='ADD'>
<input type='hidden' name='username' value='$username'>
<input type='hidden' name='accountType' value='$row[refNo]'>
</form>");

$this->coconutTableData("<form method='post' action='/COCONUT/accounting/deleteAccountTitle.php' style='margin-top:-10px; margin-bottom:-10px; margin-right:10px; margin-left:10px; '>
<input type='submit' style='border:1px solid #ff0000; padding-top:0px;' value='DEL'>
<input type='hidden' name='username' value='$username'>
<input type='hidden' name='accountNo' value='$row[accountNo]'>
<input type='hidden' name='accountTitle' value='$row[accountTitle]'>
<input type='hidden' name='refNo' value='$row[refNo]'>
</form>");
echo "</tr>";

$this->subAccountTitle_1stlane($row['refNo'],$username);


}
echo "</table>";

}












/****************DISBURSEMENT [aug 29,2015]*************************/

public function accountTitleSelection_primaryTitle() {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      



$result = mysqli_query($connection, " select refNo,accountNo,accountTitle from accountTitle where status != 'DELETED' and accountType = 'primaryTitle' order by accountNo asc ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
echo "<option value='".$row['refNo']."'>$row[accountTitle]</option>";
}

}


public function accountTitleSelection_subTitle($refNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      



$result = mysqli_query($connection, " select accountNo,accountTitle from accountTitle where status != 'DELETED' and (accountType = '$refNo' or parentTitle_of_accountType = '$refNo') order by accountNo asc ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
echo "<option value='".$row['accountNo']."_".$row['accountTitle']."'>$row[accountTitle]</option>";
}

}



public function addDisbursement($transactionNo,$accountNo,$accountTitle,$paidTo,$narration,$invoiceNo,$dated,$debit,$credit,$username,$dateEncoded,$type) {

/* make your connection */
$sql = new mysqli($this->host,$this->username,$this->password,$this->database);
 
/* we will just create an insert query here, and use it,
normally this would be done by form submission or other means */
$query = "insert into disbursement(transactionNo,accountNo,accountTitle,paidTo,narration,invoiceNo,dated,debit,credit,username,dateEncoded,type) values('$transactionNo','$accountNo','$accountTitle','$paidTo','$narration','$invoiceNo','$dated','$debit','$credit','$username','$dateEncoded','$type')";
 
if ( $sql->query($query) ) {
   //echo "A new entry has been added with the `id`";
} else {
    echo "There was a problem:<br />$query<br />{$sql->error}";
}
 
/* close our connection */
$sql->close();
}


public $disbursementOutput_debit;
public $disbursementOutput_credit;

public function disbursementOutput($transactionNo,$username,$fromPage) {

echo "<style>

.matrix {
font-family:courier;
color:black;
}

tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select idNo,accountNo,accountTitle,paidTo,narration,invoiceNo,dated,debit,credit from disbursement where transactionNo = '$transactionNo' and status != 'DELETED' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{

$this->disbursementOutput_debit += $row['debit'];
$this->disbursementOutput_credit += $row['credit'];

echo "<tr>";
echo "<td width='10%'><font size=2 class='matrix'>".$row['accountNo']."</font></td>";
if( $row['paidTo'] != "" ) {
echo "<td><font size=2 class='matrix'>".$row['accountTitle']."-$row[paidTo]</font></td>";
}else {
echo "<td><font size=2 class='matrix'>".$row['accountTitle']."</font></td>";
}
echo "<td><font size=2 class='matrix'>".$row['narration']."</font></td>";
echo "<td><font size=2 class='matrix'>".$row['invoiceNo']."</font></td>";
echo "<td><font size=2 class='matrix'>".$row['dated']."</font></td>";
if( $row['debit'] != "" ) {
echo "<td><font size=2 class='matrix'>".number_format($row['debit'],2)."</font></td>";
}else { 
echo "<td>&nbsp;</td>";
}


if( $row['credit'] != "" ) {
echo "<td><font size=2 class='matrix'>".number_format($row['credit'],2)."</font></td>";
}else {
echo "<td>&nbsp;</td>";
}


if( $fromPage == "encode" ) {
echo "<td><a href='/COCONUT/accounting/cashDisbursement/deleteDisbursementEntry.php?idNo=$row[idNo]&username=$username&transactionNo=$transactionNo&fromPage=encode'>".$this->coconutImages_return("delete.jpeg")."</a></td>";
}else {
echo "<td><a href='/COCONUT/accounting/cashDisbursement/deleteDisbursementEntry.php?idNo=$row[idNo]&username=$username&transactionNo=$transactionNo&fromPage=edit'>".$this->coconutImages_return("delete.jpeg")."</a></td>";
}


echo "</tr>";
}
echo "<tr>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;</td>";
echo "<Td>&nbsp;<font size=2 class='matrix'>".number_format($this->disbursementOutput_debit,2)."</font></td>";
echo "<Td>&nbsp;<font size=2 class='matrix'>".number_format($this->disbursementOutput_credit,2)."</font></td>";
echo "<Td>&nbsp;</td>";
echo "</tr>";

}



public function countDisbursementEntry($transactionNo,$type) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      



$result = mysqli_query($connection, " select count(idNo) as totalEntry from disbursement where transactionNo = '$transactionNo' and status != 'DELETED' and type = '$type' ") or die("Query fail: " . mysqli_error()); 

while($row = mysqli_fetch_array($result))
{
return $row['totalEntry'];
}

}


public $getDisbursementReport_individual_debit;
public $getDisbursementReport_individual_credit;


public function getDisbursementReport_individual_debit() {
return $this->getDisbursementReport_individual_debit;
}

public function getDisbursementReport_individual_credit() {
return $this->getDisbursementReport_individual_credit;
}

public function getDisbursementReport_individual($transactionNo) {

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

$result = mysqli_query($connection, " select transactionNo,accountNo,accountTitle,paidTo,narration,invoiceNo,dated,debit,credit,dateEncoded from disbursement where transactionNo = '$transactionNo' and status != 'DELETED' and type = 'individual' ") or die("Query fail: " . mysqli_error()); 


while($row = mysqli_fetch_array($result))
{

$this->getDisbursementReport_individual_debit += $row['debit'];
$this->getDisbursementReport_individual_credit += $row['credit'];


echo "<tr>";
echo "<td class='matrix'><font size=2>&nbsp;".$row['dateEncoded']."</font></td>";
echo "<td class='matrix'><font size=2>&nbsp;".$row['accountNo']."</font></td>";
echo "<td class='matrix'><font size=2>&nbsp;".$row['accountTitle']."-".$row['paidTo']."</font></td>";
echo "<Td class='matrix'><font size=2>&nbsp;".$row['narration']."</font></td>";
echo "<td class='matrix'><font size=2>&nbsp;".$row['invoiceNo']."</font></td>";
echo "<Td class='matrix'><font size=2>&nbsp;".$row['dated']."</font></td>";

if( $row['debit'] != "" ) {
echo "<td class='matrix'><font size=2>&nbsp;".number_format($row['debit'],2)."</font></td>";
}else {
echo "<td class='matrix'><font size=2>&nbsp;</font></td>";
}

if( $row['credit'] != "" ) {
echo "<td class='matrix'><font size=2>&nbsp;".number_format($row['credit'],2)."</font></td>";
}else {
echo "<td class='matrix'><font size=2>&nbsp;</font></td>";
}

echo "</tr>";
}

}


public $getDisbursementReport_group_transactionNo;
public $getDisbursementReport_group_debit;
public $getDisbursementReport_group_credit;

public function getDisbursementReport_group_debit() {
return $this->getDisbursementReport_group_debit;
}

public function getDisbursementReport_group_credit() {
return $this->getDisbursementReport_group_credit;
}

public function getDisbursementReport_group($transactionNo) {

$this->getDisbursementReport_group_debit = 0;
$this->getDisbursementReport_group_credit = 0;

echo "<style>

.matrix {
font-family:courier;
}

tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select idNo,transactionNo,accountNo,accountTitle,paidTo,narration,invoiceNo,dated,debit,credit,dateEncoded from disbursement where transactionNo = '$transactionNo' and status != 'DELETED' and type = 'group' ") or die("Query fail: " . mysqli_error()); 


while($row = mysqli_fetch_array($result))
{
$this->getDisbursementReport_group_transactionNo = $row['transactionNo'];
$this->getDisbursementReport_group_debit += $row['debit'];
$this->getDisbursementReport_group_credit += $row['credit'];


echo "<tr>";
echo "<td class='matrix'><font size=2>&nbsp;".$row['dateEncoded']."</font></td>";
echo "<td class='matrix'><font size=2>&nbsp;".$row['accountNo']."</font></td>";
echo "<td class='matrix'><font size=2>&nbsp;".$row['accountTitle']."-".$row['paidTo']."</font></td>";
echo "<Td class='matrix'><font size=2>&nbsp;".$row['narration']."</font></td>";
echo "<td class='matrix'><font size=2>&nbsp;".$row['invoiceNo']."</font></td>";
echo "<Td class='matrix'><font size=2>&nbsp;".$row['dated']."</font></td>";

if( $row['debit'] != "" ) {
echo "<td class='matrix'><font size=2>&nbsp;".number_format($row['debit'],2)."</font></td>";
}else {
echo "<td class='matrix'><font size=2>&nbsp;</font></td>";
}

if( $row['credit'] != "" ) {
echo "<td class='matrix'><font size=2>&nbsp;".number_format($row['credit'],2)."</font></td>";
}else {
echo "<td class='matrix'><font size=2>&nbsp;</font></td>";
}

echo "</tr>";
}


if( $this->countDisbursementEntry($this->getDisbursementReport_group_transactionNo,"group") > 2 ) {
echo "<tr>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td>&nbsp;</td>";
echo "<td style='border-top:1px solid #000; border-bottom:1px solid #000;'>&nbsp;<font size=2 class='matrix'>".number_format($this->getDisbursementReport_group_debit,2)."</font></td>";
echo "<td style='border-top:1px solid #000; border-bottom:1px solid #000;'>&nbsp;<font size=2 class='matrix'>".number_format($this->getDisbursementReport_group_credit,2)."</font></td>";
echo "</tr>";
}else { }


}



public $getDisbursementReport_group_debitTotal;
public $getDisbursementReport_group_creditTotal;

public function getDisbursementReport_group_debitTotal() {
return $this->getDisbursementReport_group_debitTotal;
}

public function getDisbursementReport_group_creditTotal() {
return $this->getDisbursementReport_group_creditTotal;
}


public function getDisbursementReportForGroup($date,$date1) {

echo "<style>

.matrix {
font-family:courier;
}

tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select transactionNo from disbursement where (dateEncoded between '$date' and '$date1') and status != 'DELETED' and type = 'group' group by transactionNo ") or die("Query fail: " . mysqli_error()); 


while($row = mysqli_fetch_array($result))
{
$this->getDisbursementReport_group($row['transactionNo']);
$this->getDisbursementReport_group_debitTotal += $this->getDisbursementReport_group_debit();
$this->getDisbursementReport_group_creditTotal += $this->getDisbursementReport_group_credit();
}

}


public function getDisbursementReportForIndividual($date,$date1) {

echo "<style>

.matrix {
font-family:courier;
}

tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select transactionNo from disbursement where (dateEncoded between '$date' and '$date1') and status != 'DELETED' and type = 'individual' group by transactionNo ") or die("Query fail: " . mysqli_error()); 


while($row = mysqli_fetch_array($result))
{
$this->getDisbursementReport_individual($row['transactionNo']);
}
}



public function searchDisbursementEntry($date,$date1,$username) {

echo "<style>

.matrix {
font-family:courier;
}

tr:hover { background-color:yellow; color:black;}
a {  border_bottom:10px; color:black; }

</style>";

$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      


$result = mysqli_query($connection, " select transactionNo,paidTo,narration,dateEncoded,type from disbursement where (dateEncoded between '$date' and '$date1') and status != 'DELETED' group by transactionNo order by dateEncoded asc  ") or die("Query fail: " . mysqli_error()); 


echo "<center><br><br>";
echo "<table border=1 width='50%' rules=all>";
echo "<tr>";
echo "<th><font size=2>Encoded</font></th>";
echo "<th><font size=2>Paid-To</font></th>";
echo "<th><font size=2>Narration</font></th>";
echo "<th>&nbsp;</th>";
echo "<th>&nbsp;</th>";
echo "</tr>";
while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>&nbsp;<font size=2>".$row['dateEncoded']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['paidTo']."</font></td>";
echo "<td>&nbsp;<font size=2>".$row['narration']."</font></td>";
echo "<td>&nbsp;<form method='post' action='/COCONUT/accounting/cashDisbursement/editDisbursementEntry/editDisbursement_handler.php' style='margin-right:0px; margin-left:0px;' ><input type='submit' value='View' style='border:1px solid #ff0000;' >
<input type='hidden' name='username' value='$username'>
<input type='hidden' name='transactionNo' value='$row[transactionNo]'>
<input type='hidden' name='type' value='$row[type]'>
</form>
</td>";

echo "<td>&nbsp;<form method='post' action='/COCONUT/accounting/cashDisbursement/deleteWholeDisbursement.php' style='margin-right:0px; margin-left:0px;' ><input type='submit' value='Delete' style='border:1px solid #ff0000;' >
<input type='hidden' name='username' value='$username'>
<input type='hidden' name='date' value='$date'>
<input type='hidden' name='date1' value='$date1'>
<input type='hidden' name='transactionNo' value='$row[transactionNo]'>
</form>
</td>";

echo "</tr>";
}
}


/****************DISBURSEMENT [aug 29,2015]*************************/




public function addCollectionReport($registrationNo,$itemNo,$shift,$description,$amountPaid,$orNo,$type,$paidBy,$timePaid,$datePaid,$paidVia) {

/* make your connection */
$sql = new mysqli($this->host,$this->username,$this->password,$this->database);
 
/* we will just create an insert query here, and use it,
normally this would be done by form submission or other means */
$query = "insert into collectionReport(registrationNo,itemNo,shift,description,amountPaid,orNo,type,paidBy,timePaid,datePaid,paidVia) values('$registrationNo','$itemNo','$shift','$description','$amountPaid','$orNo','$type','$paidBy','$timePaid','$datePaid','$paidVia')";
 
if ( $sql->query($query) ) {
   //echo "A new entry has been added with the `id`";
} else {
    echo "There was a problem:<br />$query<br />{$sql->error}";
}
 
/* close our connection */
$sql->close();
}












}








?>
