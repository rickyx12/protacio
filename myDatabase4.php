<?php

class database4 {

private $host;
private $username;
private $password;
private $db;

public function __construct() {
	$this->host = $_SERVER['DB_HOST'];
	$this->username = $_SERVER['DB_USER'];
	$this->password = $_SERVER['DB_PASS'];
	$this->database = $_SERVER['DB_DB'];
}


public function formatDate($date) {
	$date1 = preg_split ("/\-/", $date); 
	$month = [
			'01'=>'Jan',
			'02'=>'Feb',
			'03'=>'Mar',
			'04'=>'Apr',
			'05'=>'May',
			'06'=>'Jun',
			'07'=>'Jul',
			'08'=>'Aug',
			'09'=>'Sep',
			'10'=>'Oct',
			'11'=>'Nov',
			'12'=>'Dec'];
	return $month[$date1[1]]." ".$date1[2].", ".$date1[0];
}

public function formatTime($time) {
	return date('h:i:s A', strtotime($time));
}

public function getStartingDate($currentDate,$no_of_days_to_subract) {
	$date = date_create($currentDate);
	date_sub($date,date_interval_create_from_date_string($no_of_days_to_subract." days"));
	return date_format($date,"Y-m-d");
}

public function calculateDays($date,$date1) {
	$datetime1 = strtotime($date." 00:00:00");
	$datetime2 = strtotime($date1." 00:00:00");

	$secs = $datetime2 - $datetime1;// == <seconds between the two times>
	$days = $secs / 86400;
	return $days;
}


private $aging_of_accounts_details_firstName;
private $aging_of_accounts_details_lastName;
private $aging_of_accounts_details_registrationNo;
private $aging_of_accounts_details_dateUnregistered;

public function aging_of_accounts_details_firstName() {
	return $this->aging_of_accounts_details_firstName;
}
public function aging_of_accounts_details_lastName() {
	return $this->aging_of_accounts_details_lastName;
}
public function aging_of_accounts_details_registrationNo() {
	return $this->aging_of_accounts_details_registrationNo;
}
public function aging_of_accounts_details_dateUnregistered() {
	return $this->aging_of_accounts_details_dateUnregistered;
}

public function aging_of_accounts_details($company) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "select upper(pr.lastName) as lastName,upper(pr.firstName) as firstName,rd.registrationNo,rd.dateUnregistered from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and rd.dateUnregistered != '' and rd.type = 'OPD' and rd.Company = '$company' and pc.company > 0 group by rd.registrationNo order by rd.dateUnregistered asc ") or die("Query fail: " . mysqli_error()); 
	while($row = mysqli_fetch_array($result)) {
		$this->aging_of_accounts_details_firstName[] = $row['firstName'];
		$this->aging_of_accounts_details_lastName[] = $row['lastName'];
		$this->aging_of_accounts_details_registrationNo[] = $row['registrationNo'];
		$this->aging_of_accounts_details_dateUnregistered[] = $row['dateUnregistered'];
	}
}


public function aging_of_accounts_details_amount($registrationNo) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "select sum(pc.company) as comp from registrationDetails rd,patientCharges pc where rd.registrationNo = pc.registrationNo and rd.type = 'OPD' and pc.status = 'UNPAID' and rd.registrationNo = '$registrationNo' ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
		($row['comp'] > 0) ? $x = $row['comp'] : $x = 0;
		return $x;
	}
}


public function aging_of_accounts_details_payment($registrationNo) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "select sum(amountPaid) as compPd from companyPayment where registrationNo = '$registrationNo' and status not like 'DELETED%%%%%%%' ") or die("Query fail: " . mysqli_error()); 
	while($row = mysqli_fetch_array($result)) {
		return $row['compPd'];
	}
}


private $aging_of_accounts_companyName;

public function aging_of_accounts_companyName() {
	return $this->aging_of_accounts_companyName;
}

public function aging_of_accounts() {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "select upper(companyName) as companyName from Company order by companyName asc ") or die("Query fail: " . mysqli_error()); 
	while($row = mysqli_fetch_array($result)) {
		$this->aging_of_accounts_companyName[] = $row['companyName'];
	}
}


private $aging_of_accounts_amount_30days;
private $aging_of_accounts_amount_60days;
private $aging_of_accounts_amount_90days;
private $aging_of_accounts_amount_120days;

public function aging_of_accounts_amount_30days() {
	return $this->aging_of_accounts_amount_30days;
}
public function aging_of_accounts_amount_60days() {
	return $this->aging_of_accounts_amount_60days;
}
public function aging_of_accounts_amount_90days() {
	return $this->aging_of_accounts_amount_90days;
}
public function aging_of_accounts_amount_120days() {
	return $this->aging_of_accounts_amount_120days;
}

public function aging_of_accounts_amount($company) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "select dateUnregistered,registrationNo from registrationDetails where Company = '$company' and type = 'OPD' and dateUnregistered != '' ") or die("Query fail: " . mysqli_error()); 

	$this->aging_of_accounts_amount_30days = 0;
	$this->aging_of_accounts_amount_60days = 0;
	$this->aging_of_accounts_amount_90days = 0;

	while($row = mysqli_fetch_array($result)) {
		$companyBalance = ($this->aging_of_accounts_details_amount($row['registrationNo']) - $this->aging_of_accounts_details_payment($row['registrationNo']));
		if($this->calculateDays($row['dateUnregistered'],date("Y-m-d")) <= 30 ) {
			$this->aging_of_accounts_amount_30days += $companyBalance;
		}else if($this->calculateDays($row['dateUnregistered'],date("Y-m-d")) >= 31 && $this->calculateDays($row['dateUnregistered'],date("Y-m-d")) <= 60){
			$this->aging_of_accounts_amount_60days += $companyBalance;
		}else if($this->calculateDays($row['dateUnregistered'],date("Y-m-d")) >= 61 && $this->calculateDays($row['dateUnregistered'],date("Y-m-d")) <= 90 ) {
			$this->aging_of_accounts_amount_90days += $companyBalance;
		}else if($this->calculateDays($row['dateUnregistered'],date("Y-m-d")) >= 91) {
			$this->aging_of_accounts_amount_120days += $companyBalance;
		}else { /***/ }
	}
}

private $companyList_company;

public function companyList_company() {
	return $this->companyList_company;
}

public function companyList() {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "select companyName from Company order by companyName asc ") or die("Query fail: " . mysqli_error()); 
	while($row = mysqli_fetch_array($result)) {
	$this->companyList_company[] = $row['companyName'];
}
}

private $patient_with_transaction_registrationNo;
private $patient_with_transaction_lastName;
private $patient_with_transaction_firstName;
private $patient_with_transaction_patientCompany;
private $patient_with_transaction_pxCount;

public function patient_with_transaction_registrationNo() {
	return $this->patient_with_transaction_registrationNo;
}
public function patient_with_transaction_lastName() {
	return $this->patient_with_transaction_lastName;
}
public function patient_with_transaction_firstName() {
	return $this->patient_with_transaction_firstName;
}
public function patient_with_transaction_patientCompany() {
	return $this->patient_with_transaction_patientCompany;
}
public function patient_with_transaction_pxCount() {
	return $this->patient_with_transaction_pxCount;
}

public function patient_with_transaction($date) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "select upper(pr.lastName) as lastName,upper(pr.firstName) as firstName,rd.registrationNo,rd.Company,rd.pxCount from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and pc.datePaid = '$date' and rd.type = 'OPD' order by pxCount asc ") or die("Query fail: " . mysqli_error()); 
	while($row = mysqli_fetch_array($result)) {
	$this->patient_with_transaction_registrationNo[] = $row['registrationNo'];
	$this->patient_with_transaction_lastName[] = $row['lastName'];
	$this->patient_with_transaction_firstName[] = $row['firstName'];
	$this->patient_with_transaction_patientCompany[] = $row['Company'];
	$this->patient_with_transaction_pxCount[] = $row['pxCount'];
	}
}


public function patient_with_transaction_total($registrationNo) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "select sum(total) as total from patientCharges where registrationNo = '$registrationNo' and status not like 'DELETED%%%' ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
		($row['total'] > 0) ? $x = $row['total'] : $x = 0;
		return $x;
	}
}

public function patient_with_transaction_balance($registrationNo) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "select sum(cashUnpaid) as cashUnpaid from patientCharges where registrationNo = '$registrationNo' and status not like 'DELETED%%%' ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
		($row['cashUnpaid'] > 0) ? $x = $row['cashUnpaid'] : $x = 0;
		return $x;
	}
}

public function patient_with_transaction_company($registrationNo) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "select sum(company) as company from patientCharges where registrationNo = '$registrationNo' and status not like 'DELETED%%%' ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
		($row['company'] > 0) ? $x = $row['company'] : $x = 0;
		return $x;
	}
}


public function patient_with_transaction_cash($registrationNo) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "select sum(cashPaid) as pd from patientCharges where registrationNo = '$registrationNo' and status not like 'DELETED%%%' and paidVia = 'Cash' ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
		($row['pd'] > 0) ? $x = $row['pd'] : $x = 0;
		return $x;
	}
}

public function patient_with_transaction_creditCard($registrationNo) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "select sum(amountPaidFromCreditCard) as pd from patientCharges where registrationNo = '$registrationNo' and status not like 'DELETED%%%' and paidVia = 'Credit Card' ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
		($row['pd'] > 0) ? $x = $row['pd'] : $x = 0;
		return $x;
	}
}


private $inpatient_payment_paymentNo;
private $inpatient_payment_lastName;
private $inpatient_payment_firstName;
private $inpatient_payment_paymentFor;
private $inpatient_payment_registrationNo;
private $inpatient_payment_patientNo;

public function inpatient_payment_lastName() {
	return $this->inpatient_payment_lastName;
}
public function inpatient_payment_firstName() {
	return $this->inpatient_payment_firstName;
}
public function inpatient_payment_paymentFor() {
	return $this->inpatient_payment_paymentFor;
}
public function inpatient_payment_registrationNo() {
	return $this->inpatient_payment_registrationNo;
}
public function inpatient_payment_paymentNo() {
	return $this->inpatient_payment_paymentNo;
}

public function inpatient_payment($date) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "select upper(pr.lastName) as lastName,upper(pr.firstName) as firstName,rd.registrationNo,pp.paymentFor,pp.amountPaid,pp.paymentNo from patientRecord pr,registrationDetails rd,patientPayment pp where pr.patientNo = rd.patientNo and rd.registrationNo = pp.registrationNo and pp.datePaid = '$date' and rd.type = 'IPD' ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
		$this->inpatient_payment_lastName[] = $row['lastName'];
		$this->inpatient_payment_firstName[] = $row['firstName'];
		$this->inpatient_payment_paymentFor[] = $row['paymentFor'];
		$this->inpatient_payment_registrationNo[] = $row['registrationNo'];
		$this->inpatient_payment_paymentNo[] = $row['paymentNo'];
			}
}


public function inpatient_payment_paid($registrationNo,$paymentNo,$paymentMode) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "select amountPaid as pd from patientPayment where registrationNo = '$registrationNo' and paidVia = '$paymentMode' and paymentNo = '$paymentNo'  ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
		($row['pd'] > 0) ? $x = $row['pd'] : $x = 0;
		return $x;
	}
}


private $inventory_list_inventoryCode;
private $inventory_list_stockCardNo;
private $inventory_list_description;
private $inventory_list_genericName;
private $inventory_list_qty;
private $inventory_list_unitcost;
private $inventory_list_ipdPrice;
private $inventory_list_opdPrice;
private $inventory_list_dateAdded;

public function inventory_list_inventoryCode() {
	return $this->inventory_list_inventoryCode;
}
public function inventory_list_stockCardNo() {
	return $this->inventory_list_stockCardNo;
}
public function inventory_list_description() {
	return $this->inventory_list_description;
}
public function inventory_list_genericName() {
	return $this->inventory_list_genericName;
}
public function inventory_list_qty() {
	return $this->inventory_list_qty;
}
public function inventory_list_unitcost() {
	return $this->inventory_list_unitcost;
}
public function inventory_list_ipdPrice() {
	return $this->inventory_list_ipdPrice;
}
public function inventory_list_opdPrice() {
	return $this->inventory_list_opdPrice;
}
public function inventory_list_dateAdded() {
	return $this->inventory_list_dateAdded;
}


public function inventory_list($type) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "SELECT i.inventoryCode,i.stockCardNo,i.description,i.genericName,i.quantity,i.unitcost,i.ipdPrice,i.opdPrice,i.dateAdded from inventory i where i.status not like 'DELETED%%%%%' and i.quantity > 0 and i.inventoryType = '$type' order by i.genericName asc") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
		$this->inventory_list_inventoryCode[] = $row['inventoryCode'];
		$this->inventory_list_stockCardNo[] = $row['stockCardNo'];
		$this->inventory_list_description[] = $row['description'];
		$this->inventory_list_genericName[] = $row['genericName'];
		$this->inventory_list_qty[] = $row['quantity'];
		$this->inventory_list_unitcost[] = $row['unitcost'];
		$this->inventory_list_ipdPrice[] = $row['ipdPrice'];
		$this->inventory_list_opdPrice[] = $row['opdPrice'];
		$this->inventory_list_dateAdded[] = $row['dateAdded'];
	}
}


private $insertNow_cols;
private $insertNow_data;
private $insertNow_totalArray;
private $insertNow_a;

public function insertNow($table,$data) {

	$this->insertNow_totalArray = count($data);
	$this->insertNow_a = 0;
	$this->insertNow_cols=""; //pra sa looping alisin ung last value nea n gling s huling loop. 
	$this->insertNow_data="";
	/* make your connection */
	$sql = new mysqli($this->host,$this->username,$this->password,$this->database);
 	
 	$table = "insert into ".$table;
 	foreach($data as $c => $d) {
		
 		if(++$this->insertNow_a == $this->insertNow_totalArray) { //knuha q ung last array pra matanggal ung comma sa $d
 			$this->insertNow_cols .= $c;
 			$this->insertNow_data .= "'".$d."'";
 		}else {
 			$this->insertNow_cols .= $c.",";
 			$this->insertNow_data .= "'".$d."',";
 		}
	} 
	$query = $table."(".$this->insertNow_cols.") values(".$this->insertNow_data.")";
	if ( $sql->query($query) ) {
   	//echo "new entry has been added with the `id`";
	} else {
    echo "There was a problem:<br />$query<br />{$sql->error}";
	}	
	/* close our connection */
	$sql->close();
}







}


?>
