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

public function number_format($number) {
	($number > 0) ? $x = number_format($number,2) : $x = "";
	return $x;
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

public function patient_with_transaction($date,$shift) {

	$this->patient_with_transaction_registrationNo = array();
	$this->patient_with_transaction_lastName = array();
	$this->patient_with_transaction_firstName = array();
	$this->patient_with_transaction_patientCompany = array();
	$this->patient_with_transaction_pxCount = array();

	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "select upper(pr.lastName) as lastName,upper(pr.firstName) as firstName,rd.registrationNo,rd.Company,rd.pxCount from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and pc.datePaid = '$date' and pc.reportShift = '$shift' and rd.type = 'OPD' group by rd.registrationNo order by pxCount asc ") or die("Query fail: " . mysqli_error()); 
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
	$result = mysqli_query($connection, "select sum(discount) as discount,sum(cashUnpaid) as unpaid,sum(company) as company,sum(cashPaid) as cash,sum(amountPaidFromCreditCard) as creditCard  from patientCharges where registrationNo = '$registrationNo' and status not like 'DELETED%%%' ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
		$total = ( $row['discount'] + $row['unpaid'] + $row['company'] + $row['cash'] + $row['creditCard'] );
		($total > 0) ? $x = $total : $x = 0;
		return $x;
	}
}


public function patient_with_transaction_discount($registrationNo) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "select sum(discount) as discount from patientCharges where registrationNo = '$registrationNo' and status not like 'DELETED%%%' ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
		($row['discount'] > 0) ? $x = number_format($row['discount'],2) : $x = 0;
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

private $patient_with_transaction_hmo_registrationNo;

public function patient_with_transaction_hmo_registrationNo() {
	return $this->patient_with_transaction_hmo_registrationNo;
}

public function patient_with_transaction_hmo($date,$shift) {

	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "select rd.registrationNo from patientRecord pr,registrationDetails rd,patientCharges pc where pr.patientNo = rd.patientNo and rd.registrationNo = pc.registrationNo and rd.dateRegistered = '$date' and rd.Company != '' and pc.datePaid < 1 and pc.reportShift = '$shift' and rd.type = 'OPD' group by rd.registrationNo order by pxCount asc ") or die("Query fail: " . mysqli_error()); 
	while($row = mysqli_fetch_array($result)) {
		$this->patient_with_transaction_hmo_registrationNo[] = $row['registrationNo'];
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

public function inpatient_payment($date,$shift) {	

	unset($this->inpatient_payment_paymentNo);
unset($this->inpatient_payment_lastName);
unset($this->inpatient_payment_firstName);
unset($this->inpatient_payment_paymentFor);
unset($this->inpatient_payment_registrationNo);
unset($this->inpatient_payment_patientNo);


	$this->inpatient_payment_registrationNo = array();
	$this->inpatient_payment_lastName = array();
	$this->inpatient_payment_firstName = array();
	$this->inpatient_payment_paymentFor = array();
	$this->inpatient_payment_paymentNo = array();

	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "select upper(pr.lastName) as lastName,upper(pr.firstName) as firstName,rd.registrationNo,pp.paymentFor,pp.amountPaid,pp.paymentNo from patientRecord pr,registrationDetails rd,patientPayment pp where pr.patientNo = rd.patientNo and rd.registrationNo = pp.registrationNo and pp.datePaid = '$date' and pp.shift = '$shift' and rd.type = 'IPD' ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
		$this->inpatient_payment_registrationNo[] = $row['registrationNo'];
		$this->inpatient_payment_lastName[] = $row['lastName'];
		$this->inpatient_payment_firstName[] = $row['firstName'];
		$this->inpatient_payment_paymentFor[] = $row['paymentFor'];
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
	$result = mysqli_query($connection, "SELECT i.inventoryCode,i.stockCardNo,i.description,i.genericName,i.quantity,i.unitcost,i.ipdPrice,i.opdPrice,i.dateAdded from inventory i,inventoryStockCard isc where i.stockCardNo = isc.stockCardNo and i.status not like 'DELETED%%%%%' and isc.status not like 'DELETED%' and i.quantity > 0 and i.inventoryType = '$type' order by i.genericName,i.description asc") or die("Query fail: " . mysqli_error()); 

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


public function dispensed_quantity($inventoryCode) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "SELECT sum(quantity) as qty FROM patientCharges WHERE departmentStatus like 'dispensedBy%' and status not like 'DELETED' and chargesCode = '$inventoryCode' and title in ('MEDICINE','SUPPLIES') ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
		($row['qty'] > 0) ? $x = $row['qty'] : $x = 0;
		return $x;
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


private $get_patient_charges_itemNo;
private $get_patient_charges_registrationNo;
private $get_patient_charges_description;
private $get_patient_charges_sellingPrice;
private $get_patient_charges_qty;
private $get_patient_charges_total;
private $get_patient_charges_cashUnpaid;
private $get_patient_charges_company;
private $get_patient_charges_phic;
private $get_patient_charges_chargeBy;
private $get_patient_charges_dateCharge;
private $get_patient_charges_timeCharge;
private $get_patient_charges_checked;

public function get_patient_charges_itemNo() {
	return $this->get_patient_charges_itemNo;
}

public function get_patient_charges_registrationNo() {
	return $this->get_patient_charges_registrationNo;
}

public function get_patient_charges_description() {
	return $this->get_patient_charges_description;
}

public function get_patient_charges_sellingPrice() {
	return $this->get_patient_charges_sellingPrice;
}

public function get_patient_charges_qty() {
	return $this->get_patient_charges_qty;
}

public function get_patient_charges_total() {
	return $this->get_patient_charges_total;
}

public function get_patient_charges_cashUnpaid() {
	return $this->get_patient_charges_cashUnpaid;
}

public function get_patient_charges_company() {
	return $this->get_patient_charges_company;
}

public function get_patient_charges_phic() {
	return $this->get_patient_charges_phic;
}

public function get_patient_charges_chargeBy() {
	return $this->get_patient_charges_chargeBy;
}

public function get_patient_charges_dateCharge() {
	return $this->get_patient_charges_dateCharge;
}

public function get_patient_charges_timeCharge() {
	return $this->get_patient_charges_timeCharge;
}

public function get_patient_charges_checked(){
	return $this->get_patient_charges_checked;
}

public function get_patient_charges($registrationNo) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "select itemNo,registrationNo,description,sellingPrice,quantity,total,cashUnpaid,company,phic,chargeBy,dateCharge,timeCharge,checked from patientCharges where registrationNo = '$registrationNo' and status not like 'DELETED%' order by title,description,dateCharge asc") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
		$this->get_patient_charges_itemNo[] = $row['itemNo'];
		$this->get_patient_charges_registrationNo[] = $row['registrationNo'];
		$this->get_patient_charges_description[] = $row['description'];
		$this->get_patient_charges_sellingPrice[] = $row['sellingPrice'];
		$this->get_patient_charges_qty[] = $row['quantity'];
		$this->get_patient_charges_total[] = $row['total'];
		$this->get_patient_charges_cashUnpaid[] = $row['cashUnpaid'];
		$this->get_patient_charges_company[] = $row['company'];
		$this->get_patient_charges_phic[] = $row['phic'];
		$this->get_patient_charges_chargeBy[] = $row['chargeBy'];
		$this->get_patient_charges_dateCharge[] = $row['dateCharge'];
		$this->get_patient_charges_timeCharge[] = $row['timeCharge'];
		$this->get_patient_charges_checked[] = $row['checked'];
	}
}



private $get_hmo_patient_registrationNo;

public function get_hmo_patient_registrationNo() {
	return $this->get_hmo_patient_registrationNo;
}

public function get_hmo_patient($date,$date1) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "SELECT rd.registrationNo FROM registrationDetails rd WHERE rd.dateRegistered BETWEEN '$date' and '$date1' and rd.Company != '' ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
		$this->get_hmo_patient_registrationNo[] = $row['registrationNo'];
	}
}

private $get_hmo_charges_itemNo;

public function get_hmo_charges_itemNo() {
	return $this->get_hmo_charges_itemNo;
}

public function get_hmo_charges($registrationNo) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "SELECT itemNo FROM patientCharges WHERE registrationNo = '$registrationNo' and company > 0 and status = 'UNPAID' ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
		$this->get_hmo_charges_itemNo[] = $row['itemNo'];
	}
}

public function get_hmo_charges_setShift($registrationNo,$shift) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "UPDATE patientCharges SET reportShift = '$shift' WHERE registrationNo = '$registrationNo' and company > 0 and status = 'UNPAID' ") or die("Query fail: " . mysqli_error()); 
}

public function get_hmo_charges_getShift($registrationNo) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "SELECT reportShift FROM patientCharges where registrationNo = '$registrationNo' and company > 0 and status = 'UNPAID' ") or die("Query fail: " . mysqli_error()); 
	while($row = mysqli_fetch_array($result)) {
		return $row["reportShift"];
	}
}

public function get_hmo_patient_total($registrationNo) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "SELECT sum(company) as company FROM patientCharges WHERE registrationNo = '$registrationNo' and status = 'UNPAID' ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
		$x=0;	
		($row['company'] > 0) ? $x = $row["company"] : $x = 0;
		return $x;
	}
}


private $get_opd_collection_collectionNo;

public function get_opd_collection_collectionNo() {
	return $this->get_opd_collection_collectionNo;
}

public function get_opd_collection($registrationNo) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "SELECT collectionNo FROM collectionReport WHERE registrationNo = '$registrationNo' ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
		$this->get_opd_collection_collectionNo[] = $row['collectionNo'];
	}
}

private $deleted_inventory_inventoryCode;

public function deleted_inventory_inventoryCode() {
	return $this->deleted_inventory_inventoryCode;
}

public function deleted_inventory($search,$inventoryType) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "SELECT inventoryCode FROM inventory WHERE status like 'DELETED%' and (genericName like '$search%' or description like '$search%') and inventoryType = '$inventoryType' order by genericName asc") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
		$this->deleted_inventory_inventoryCode[] = $row['inventoryCode'];
	}
}



private $opd_patient_census_registrationNo;

public function opd_patient_census_registrationNo(){
	return $this->opd_patient_census_registrationNo;
}

public function opd_patient_census($date,$date1) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "SELECT registrationNo FROM registrationDetails WHERE dateRegistered between '$date' and '$date1' and pxCount > 0 ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
		$this->opd_patient_census_registrationNo[] = $row['registrationNo'];
	}
}

private $room_list_description;

public function room_list_description() {
	return $this->room_list_description;
}

public function room_list() {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "SELECT Description FROM room ORDER BY Description ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
		$this->room_list_description[] = $row['Description'];
	}
}

private $ipd_census_id;

public function ipd_census_id() {
	return $this->ipd_census_id;
}

public function ipd_census($date) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "SELECT id FROM ipdCensus WHERE date = '$date' ORDER BY id asc ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
		$this->ipd_census_id[] = $row['id'];
	}
}

private $ending_inventory_list_endingNo;

public function ending_inventory_list_endingNo() {
	return $this->ending_inventory_list_endingNo;
}

public function ending_inventory_list() {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "SELECT endingNo FROM endingInventory ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
		$this->ending_inventory_list_endingNo[] = $row['endingNo'];
	}
}

private $paid_balance_itemNo;

public function paid_balance_itemNo() {
	return $this->paid_balance_itemNo;
}

public function paid_balance($date,$date1) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "SELECT itemNo FROM patientCharges WHERE title = 'BALANCE' AND (datePaid BETWEEN '$date' AND '$date1') AND status = 'PAID' ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
		$this->paid_balance_itemNo[] = $row['itemNo'];
	}
}

private $registration_details_registrationNo;

public function registration_details_registrationNo() {
	return $this->registration_details_registrationNo;
}

public function registration_details($patientNo) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "SELECT registrationNo FROM registrationDetails WHERE patientNo = '$patientNo' and dateRegistered not like 'DELETED%' order by registrationNo DESC ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
		$this->registration_details_registrationNo[] = $row['registrationNo'];
	}
}

private $opdPayment_updater_itemNo;

public function opdPayment_updater_itemNo() {
	return $this->opdPayment_updater_itemNo;
}

public function get_last_register($date) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "SELECT pxCount from registrationDetails where dateRegistered = '$date' and pxCount > 0 order by pxCount DESC limit 1 ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
		return $row['pxCount'];
	}
}


public function get_ipd_census($date) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "SELECT count(id) total from ipdCensus where date = '$date' ") or die("Query fail: " . mysqli_alerror()); 

	while($row = mysqli_fetch_array($result)) {
		($row['total'] > 0) ? $x = $row['total'] : $x = "";
		return $x;
	}
}

private $census_list_patient_id;

public function census_list_patient_id() {
	return $this->census_list_patient_id;
}

public function census_list_patient($registrationNo) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "SELECT id from ipdCensus where registrationNo = '$registrationNo' ") or die("Query fail: " . mysqli_alerror()); 

	while($row = mysqli_fetch_array($result)) {
		$this->census_list_patient_id[] = $row['id'];
	}
}

public function inpatient_title_total($registrationNo,$cols,$title) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "SELECT sum($cols) as total from patientCharges where registrationNo = '$registrationNo' and title = '$title' and status in ('UNPAID','Discharged') ") or die("Query fail: " . mysqli_alerror()); 

	while($row = mysqli_fetch_array($result)) {
		return $row['total'];
	}
}

public function inpatient_title_total_inventory($registrationNo,$cols,$title) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "SELECT sum($cols) as total from patientCharges where registrationNo = '$registrationNo' and title = '$title' and status in ('UNPAID','Discharged') and remarks = '' ") or die("Query fail: " . mysqli_alerror()); 

	while($row = mysqli_fetch_array($result)) {
		return $row['total'];
	}
}

public function inpatient_paymentMode_total_charges($registrationNo,$cols) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "SELECT sum($cols) as total from patientCharges where registrationNo = '$registrationNo' and status in ('UNPAID','Discharged') and title not in ('MEDICINE','SUPPLIES') ") or die("Query fail: " . mysqli_alerror()); 

	while($row = mysqli_fetch_array($result)) {
		return $row['total'];
	}
}

public function inpatient_paymentMode_total_inventory($registrationNo,$cols) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "SELECT sum($cols) as total from patientCharges where registrationNo = '$registrationNo' and status in ('UNPAID','Discharged') and title in ('MEDICINE','SUPPLIES') and remarks = '' ") or die("Query fail: " . mysqli_alerror()); 

	while($row = mysqli_fetch_array($result)) {
		return $row['total'];
	}
}

public function inpatient_paymentMode_total_inventory_takeHomeMeds($registrationNo,$cols) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "SELECT sum($cols) as total from patientCharges where registrationNo = '$registrationNo' and status in ('UNPAID','Discharged') and title in ('MEDICINE','SUPPLIES') and remarks = 'takeHomeMeds' ") or die("Query fail: " . mysqli_alerror()); 

	while($row = mysqli_fetch_array($result)) {
		return $row['total'];
	}
}

public function inpatient_payment_total($registrationNo,$paidVia) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "SELECT sum(amountPaid) as total from patientPayment where registrationNo = '$registrationNo' and paidVia = '$paidVia' and paymentFor not in ('REFUND') ") or die("Query fail: " . mysqli_alerror()); 

	while($row = mysqli_fetch_array($result)) {
		return $row['total'];
	}
}

public function inpatient_refund_total($registrationNo,$paidVia) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "SELECT sum(amountPaid) as total from patientPayment where registrationNo = '$registrationNo' and paidVia = '$paidVia' and paymentFor in ('REFUND') ") or die("Query fail: " . mysqli_alerror()); 

	while($row = mysqli_fetch_array($result)) {
		return $row['total'];
	}
}

private $inpatient_deposit_registrationNo;
private $inpatient_deposit_dateUnregistered;
private $inpatient_deposit_amountPaid;
private $inpatient_deposit_paidVia;

public function inpatient_deposit_registrationNo() {
	return $this->inpatient_deposit_registrationNo;
}

public function inpatient_deposit_dateUnregistered() {
	return $this->inpatient_deposit_dateUnregistered;
}

public function inpatient_deposit_amountPaid() {
	return $this->inpatient_deposit_amountPaid;
}

public function inpatient_deposit_paidVia() {
	return $this->inpatient_deposit_paidVia;
}

public function inpatient_deposit($date1,$date2,$paidVia) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "SELECT rd.registrationNo,rd.dateUnregistered,pp.amountPaid,pp.paidVia FROM registrationDetails rd,patientPayment pp WHERE rd.registrationNo = pp.registrationNo and rd.dateUnregistered = '' and (pp.datePaid between '$date1' and '$date2') and pp.paidVia = '$paidVia' and pp.paymentFor = 'DEPOSIT' ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
		$this->inpatient_deposit_registrationNo[] = $row['registrationNo'];
		$this->inpatient_deposit_dateUnregistered[] = $row['dateUnregistered'];
		$this->inpatient_deposit_amountPaid[] = $row['amountPaid'];
		$this->inpatient_deposit_paidVia[] = $row['paidVia'];
	}
}



/*temporary function lng e2*/
public function opdPayment_updater($date,$date1) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "SELECT itemNo from patientCharges where (datePaid between '$date' and '$date1') ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
		$this->opdPayment_updater_itemNo[] = $row['itemNo'];
	}
}






}


?>
