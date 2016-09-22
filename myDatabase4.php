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
	return date('h:i A', strtotime($time));
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

public function select($table,$cols) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "SELECT ".$cols." as cols FROM ".$table) or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
		return $row['cols'];
	}
}

public function selectLast($table,$cols,$identifier,$identifierData,$ordering) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "select ".$cols." as cols FROM ".$table." WHERE ".$identifier." = '".$identifierData."' and ".$cols." != '' ORDER BY ".$ordering." desc limit 1 ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
		return $row['cols'];
	}
}

public function doubleSelectCondition($table,$cols,$identifier,$identifierData,$condition,$identifier1,$identifierData1,$condition1) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection,"SELECT (".$cols.") as cols FROM ".$table." WHERE ".$identifier." ".$condition." '".$identifierData."' and ".$identifier1." ".$condition1." '".$identifierData1."' ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
		return $row['cols'];
	}
}

public function tripleSelectCondition($table,$cols,$identifier,$identifierData,$condition,$identifier1,$identifierData1,$condition1,$identifier2,$identifierData2,$condition2) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection,"SELECT (".$cols.") as cols FROM ".$table." WHERE ".$identifier." ".$condition." '".$identifierData."' and ".$identifier1." ".$condition1." '".$identifierData1."' and ".$identifier2." ".$condition2." '".$identifierData2."' ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
		return $row['cols'];
	}
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


private $search_inventory_inventoryCode;

public function search_inventory_inventoryCode() {
	return $this->search_inventory_inventoryCode;
}

public function search_inventory($desc,$inventoryLocation) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, " SELECT inventoryCode FROM inventory WHERE inventoryLocation = '$inventoryLocation' and status not like 'DELETED_%' and (description like '$desc%' or genericName like '$desc%') and quantity > 0 order by genericName,description asc ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
	 	$this->search_inventory_inventoryCode[] = $row['inventoryCode'];
	}
}

private $edited_inventory_editNo;

public function edited_inventory_editNo() {
	return $this->edited_inventory_editNo;
}

public function edited_inventory($inventoryCode) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "select editNo from editedInventory where inventoryCode = '$inventoryCode'  ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
		$this->edited_inventory_editNo[] = $row['editNo'];
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

private $ending_inventory_list_stockCardNo;
private $ending_inventory_list_totalCost;

public function ending_inventory_list_stockCardNo() {
	return $this->ending_inventory_list_stockCardNo;
}

public function ending_inventory_list_totalCost() {
	return $this->ending_inventory_list_totalCost;
}

public function ending_inventory_list($quarter,$inventoryType) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "SELECT ei.stockCardNo,SUM(ei.endingQTY * ei.unitcost) as totalCost FROM endingInventory ei,inventoryStockCard isc WHERE ei.stockCardNo = isc.stockCardNo and isc.inventoryType = '$inventoryType' and ei.quarter = '$quarter' group by ei.stockCardNo order by isc.genericName asc ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
		$this->ending_inventory_list_stockCardNo[] = $row['stockCardNo'];
		$this->ending_inventory_list_totalCost[] = $row['totalCost'];
	}
}


public function ending_inventory_sumQTY($stockCardNo,$quarter,$inventoryLocation) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);   

	if( $inventoryLocation != "" ) {
		$result = mysqli_query($connection, "SELECT SUM(endingQTY) as endTotal FROM endingInventory WHERE stockCardNo = '$stockCardNo' and quarter = '$quarter' and inventoryLocation = '$inventoryLocation' ") or die("Query fail: " . mysqli_error()); 
	}else {
		$result = mysqli_query($connection, "SELECT SUM(endingQTY) as endTotal FROM endingInventory WHERE stockCardNo = '$stockCardNo' and quarter = '$quarter' ") or die("Query fail: " . mysqli_error()); 
	}

	while($row = mysqli_fetch_array($result)) {
		return $row['endTotal'];
	}
}


private $ending_inventory_list_details_endingNo;

public function ending_inventory_list_details_endingNo() {
	return $this->ending_inventory_list_details_endingNo;
}

public function ending_inventory_list_details($stockCardNo,$quarter) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "SELECT endingNo FROM endingInventory WHERE stockCardNo = '$stockCardNo' and quarter = '$quarter'") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
		$this->ending_inventory_list_details_endingNo[] = $row['endingNo'];
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
	$result = mysqli_query($connection, "SELECT sum(amountPaid) as total from patientPayment where registrationNo = '$registrationNo' and paidVia = '$paidVia' and paymentFor not in ('REFUND','BALANCE PAID') ") or die("Query fail: " . mysqli_alerror()); 

	while($row = mysqli_fetch_array($result)) {
		return $row['total'];
	}
}

public function inpatient_balancePayment_total($registrationNo,$paidVia) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "SELECT sum(amountPaid) as total from patientPayment where registrationNo = '$registrationNo' and paidVia = '$paidVia' and paymentFor in ('BALANCE PAID') ") or die("Query fail: " . mysqli_alerror()); 

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

private $inpatient_balance_paid_paymentNo;

public function inpatient_balance_paid_paymentNo() {
	return $this->inpatient_balance_paid_paymentNo;
}

public function inpatient_balance_paid($datePaid,$datePaid1) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "SELECT paymentNo from patientPayment where paymentFor = 'BALANCE PAID' and (datePaid between '$datePaid' and '$datePaid1')  ") or die("Query fail: " . mysqli_alerror()); 

	while($row = mysqli_fetch_array($result)) {
	 	$this->inpatient_balance_paid_paymentNo[] = $row['paymentNo'];
	}
}

private $inpatient_deposit_paymentNo;
private $inpatient_deposit_registrationNo;
private $inpatient_deposit_dateUnregistered;
private $inpatient_deposit_amountPaid;
private $inpatient_deposit_paidVia;

public function inpatient_deposit_paymentNo() {
	return $this->inpatient_deposit_paymentNo;
}

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
	$result = mysqli_query($connection, "SELECT rd.registrationNo,rd.dateUnregistered,pp.amountPaid,pp.paidVia,pp.paymentNo FROM registrationDetails rd,patientPayment pp WHERE rd.registrationNo = pp.registrationNo and rd.dateUnregistered = '' and (pp.datePaid between '$date1' and '$date2') and pp.paidVia = '$paidVia' and pp.paymentFor = 'DEPOSIT' ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
		$this->inpatient_deposit_paymentNo[] = $row['paymentNo'];
		$this->inpatient_deposit_registrationNo[] = $row['registrationNo'];
		$this->inpatient_deposit_dateUnregistered[] = $row['dateUnregistered'];
		$this->inpatient_deposit_amountPaid[] = $row['amountPaid'];
		$this->inpatient_deposit_paidVia[] = $row['paidVia'];
	}
}


private $unitcost_list_inventoryCode;

public function unitcost_list_inventoryCode() {
	return $this->unitcost_list_inventoryCode;
}

public function unitcost_list($stockCardNo) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "SELECT inventoryCode from inventory where stockCardNo = '$stockCardNo' order by dateAdded desc limit 0,3  ") or die("Query fail: " . mysqli_alerror()); 

	while($row = mysqli_fetch_array($result)) {
	 	$this->unitcost_list_inventoryCode[] = $row['inventoryCode'];
	}
}

private $inpatient_discharged_registrationNo;

public function inpatient_discharged_registrationNo() {
	return $this->inpatient_discharged_registrationNo;
}

public function inpatient_discharged($date1,$date2) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "SELECT registrationNo FROM registrationDetails WHERE type = 'IPD' and (dateUnregistered between '$date1' and '$date2') order by dateUnregistered asc ") or die("Query fail: " . mysqli_alerror()); 

	while($row = mysqli_fetch_array($result)) {
	 	$this->inpatient_discharged_registrationNo[] = $row['registrationNo'];
	}
}


private $outpatient_discharged_registrationNo;

public function outpatient_discharged_registrationNo() {
	return $this->outpatient_discharged_registrationNo;
}

public function outpatient_discharged($date1,$date2) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "SELECT registrationNo FROM registrationDetails WHERE type = 'OPD' and (dateUnregistered between '$date1' and '$date2') order by dateUnregistered asc ") or die("Query fail: " . mysqli_alerror()); 

	while($row = mysqli_fetch_array($result)) {
	 	$this->outpatient_discharged_registrationNo[] = $row['registrationNo'];
	}
}

/*
public function inpatient_payment_summary_total($registrationNo,$paidVia) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "SELECT sum(amountPaid) as pd FROM patientPayment WHERE registrationNo = '$registrationNo' and paidVia = '$paidVia' ") or die("Query fail: " . mysqli_alerror()); 

	while($row = mysqli_fetch_array($result)) {
	 	return $row['pd'];
	}
}
*/
public function inpatient_hmo_total($registrationNo) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "SELECT sum(company) as hmo FROM patientCharges WHERE registrationNo = '$registrationNo' and status in ('UNPAID','Discharged') ") or die("Query fail: " . mysqli_alerror()); 

	while($row = mysqli_fetch_array($result)) {
	 	return $row['hmo'];
	}
}

public function inpatient_hmoExcess($registrationNo,$cols) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "SELECT sum(".$cols.") as excess FROM registrationDetails WHERE registrationNo = '$registrationNo' ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
	 	return $row['excess'];
	}
}

public function inpatient_phic_total($registrationNo) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "SELECT sum(phic) as phic FROM patientCharges WHERE registrationNo = '$registrationNo' and status in ('UNPAID','Discharged') ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
	 	return $row['phic'];
	}
}

private $stock_card_list_stockCardNo;

public function stock_card_list_stockCardNo() {
	return $this->stock_card_list_stockCardNo;
}

public function stock_card_list($inventoryType) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "SELECT stockCardNo FROM inventoryStockCard WHERE status not like 'DELETED%' and inventoryType = '$inventoryType' order by genericName,description asc ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
	 	$this->stock_card_list_stockCardNo[] = $row['stockCardNo'];
	}
}

private $stock_card_search_stockCardNo;

public function stock_card_search_stockCardNo() {
	return $this->stock_card_search_stockCardNo;
}

public function stock_card_search($search) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "SELECT stockCardNo FROM inventoryStockCard WHERE (stockCardNo = '$search' or genericName like '$search%' or description like '$search%') and status not like 'DELETED%' order by genericName,description asc ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
	 	$this->stock_card_search_stockCardNo[] = $row['stockCardNo'];
	}
}

private $daily_hmo_patient_registrationNo;

public function daily_hmo_patient_registrationNo() {
	return $this->daily_hmo_patient_registrationNo;
}

public function daily_hmo_patient($date,$shift) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "SELECT rd.registrationNo FROM registrationDetails rd,patientCharges pc WHERE rd.registrationNo = pc.registrationNo and rd.Company != '' AND rd.type = 'OPD' and rd.dateUnregistered = '$date' and pc.reportShift = '$shift' group by rd.registrationNo ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
	 	$this->daily_hmo_patient_registrationNo[] = $row['registrationNo'];
	}
}

public function outpatient_hmo_total($registrationNo,$shift) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "SELECT sum(company) as hmo FROM patientCharges WHERE registrationNo = '$registrationNo' and status in ('UNPAID','Discharged') and reportShift = '$shift' ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
	 	return $row['hmo'];
	}
}

private $non_invoice_inventory_inventoryCode;

public function non_invoice_inventory_inventoryCode() {
	return $this->non_invoice_inventory_inventoryCode;
}

public function non_invoice_inventory($inventoryType) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "SELECT inventoryCode FROM inventory WHERE inventoryType = '$inventoryType' and invoiceNo = '' and status not like 'DELETED%' and classification != 'noInventory' ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
	 	$this->non_invoice_inventory_inventoryCode[] = $row['inventoryCode'];
	}
}


public function count_inventory_via_stockCard($stockCardNo) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "SELECT sum(quantity) as qty FROM inventory WHERE stockCardNo = '$stockCardNo' and status not like 'DELETED%' ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
	 	return $row['qty'];
	}
}

public function stockCard_purchases($stockCardNo,$fromDate,$toDate,$inventoryType) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "SELECT sum(beginningCapital) as purchases  FROM inventory WHERE stockCardNo = '$stockCardNo' and invoiceNo != '' and dateAdded between '$fromDate' and '$toDate' and from_inventoryCode = '' ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
	 	return $row['purchases'];
	}
}

private $get_purchases_via_stockcard_inventoryCode;

public function get_purchases_via_stockcard_inventoryCode() {
	return $this->get_purchases_via_stockcard_inventoryCode;
}

public function get_purchases_via_stockcard($stockCardNo,$fromDate,$toDate) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, " SELECT inventoryCode  FROM inventory WHERE stockCardNo = '$stockCardNo' and invoiceNo != '' and dateAdded between '$fromDate' and '$toDate' and from_inventoryCode = '' order by inventoryCode asc ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
	 	$this->get_purchases_via_stockcard_inventoryCode[] = $row['inventoryCode'];
	}
}

private $view_purchases_siNo;

public function view_purchases_siNo() {
	return $this->view_purchases_siNo;
}

//ipakita lahat ng purchases/invoice in a date range
public function view_purchases($fromDate,$toDate) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, " SELECT siNo  FROM salesInvoice WHERE (recievedDate BETWEEN '$fromDate' and '$toDate') and (status = 'Active' and invoiceNo not like 'DELETED%') order by recievedDate asc  ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
	 	$this->view_purchases_siNo[] = $row['siNo'];
	}
}

//pra sa "request" menu ng purchasing ilabas kung ilan ung lahat ng request
public function count_requesition() {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, " SELECT COUNT(batchNo) as request FROM inventoryManager WHERE status = 'requesting' group by batchNo ") or die("Query fail: " . mysqli_error()); 

	return mysqli_num_rows($result);
}


private $list_requesition_batchNo;

public function list_requesition_batchNo() {
	return $this->list_requesition_batchNo;
}

//list lahat ng requesition by batch pag click ng "request" menu s purchasing
public function list_requesition() {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, " SELECT batchNo FROM inventoryManager WHERE status = 'requesting' and requestTo_department = 'Stockroom' group by batchNo ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
	 	$this->list_requesition_batchNo[] = $row['batchNo'];
	}
}

public function sum_unitcost_endingInventory($stockCardNo,$quarter) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, " SELECT SUM(unitcost) as unitcost  FROM endingInventory WHERE stockCardNo = '$stockCardNo' and quarter = '$quarter' ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
	 	return $row['unitcost'];
	}
}

private $get_invoice_items_refNo;

public function get_invoice_items_refNo() {
	return $this->get_invoice_items_refNo;
}

public function get_invoice_items($siNo) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, " SELECT refNo FROM salesInvoiceItems WHERE siNo = '$siNo' and status = 'Active' ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
	 	$this->get_invoice_items_refNo[] = $row['refNo'];
	}
}


private $list_invoice_siNo;

public function list_invoice_siNo() {
	return $this->list_invoice_siNo;
} 

public function list_invoice($from,$to) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, " SELECT siNo FROM salesInvoice WHERE (recievedDate BETWEEN '$from' and '$to') and status = 'Active' ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
	 	$this->list_invoice_siNo[] = $row['siNo'];
	}
}

private $search_invoice_siNo;

public function search_invoice_siNo() {
	return $this->search_invoice_siNo;
}

public function search_invoice($invoiceNo) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, " SELECT siNo FROM salesInvoice WHERE invoiceNo like '$invoiceNo%' and status = 'Active' ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
	 	$this->search_invoice_siNo[] = $row['siNo'];
	}
}

public function total_invoice($siNo) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, " SELECT SUM((unitPrice * quantity) - (unitPrice * fgquantity)) as total FROM salesInvoiceItems WHERE siNo = '$siNo' and status = 'Active' ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
	 	return $row['total'];
	}
}

private $stock_room_inventoryCode;

public function stock_room_inventoryCode() {
	return $this->stock_room_inventoryCode;
}

public function stock_room($inventoryType) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, " SELECT  inventoryCode FROM inventory WHERE inventoryLocation = 'Stockroom' and inventoryType = '$inventoryType' and status not like 'DELETED%' ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
	 	$this->stock_room_inventoryCode[] = $row['inventoryCode'];
	}
}

private $search_stock_room_inventoryCode;

public function search_stock_room_inventoryCode() {
	return $this->search_stock_room_inventoryCode;
}

public function search_stock_room($search) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, " SELECT  inventoryCode FROM inventory WHERE (description like '$search%' or genericName like '$search%') and inventoryLocation = 'Stockroom' and quantity > 0 and status not like 'DELETED%' ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
	 	$this->search_stock_room_inventoryCode[] = $row['inventoryCode'];
	}
}

private $requested_inventory_verificationNo;

public function requested_inventory_verificationNo() {
	return $this->requested_inventory_verificationNo;
}

public function requested_inventory($requesitionNo) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, " SELECT  verificationNo FROM inventoryManager WHERE batchNo = '$requesitionNo' and status = 'requesting' ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
	 	$this->requested_inventory_verificationNo[] = $row['verificationNo'];
	}
}

private $pending_request_batchNo;

public function pending_request_batchNo() {
	return $this->pending_request_batchNo;
}

public function pending_request($module) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, " SELECT batchNo FROM inventoryManager WHERE requestingDepartment = '$module' and status = 'requesting' group by batchNo ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
	 	$this->pending_request_batchNo[] = $row['batchNo'];
	}
}

public function count_pending_request($module) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, " SELECT COUNT(verificationNo) FROM inventoryManager WHERE requestingDepartment = '$module' and status = 'requesting' group by batchNo ") or die("Query fail: " . mysqli_error()); 

	return mysqli_num_rows($result);

}

private $pending_request_details_verificationNo;

public function pending_request_details_verificationNo() {
	return $this->pending_request_details_verificationNo;
}

public function pending_request_details($batchNo) {

	$this->pending_request_details_verificationNo = array(); //clear ung huling content ng array kc sa loop q e2 gngmet
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, " SELECT verificationNo FROM inventoryManager WHERE batchNo = '$batchNo' and status = 'requesting' ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
	 	$this->pending_request_details_verificationNo[] = $row['verificationNo'];
	}
}

public function sum_quantity_endingInventory($stockCardNo,$quarter) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, " SELECT SUM(endingQTY) as qty  FROM endingInventory WHERE stockCardNo = '$stockCardNo' and quarter ='$quarter' ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
	 	return $row['qty'];
	}
}

private $ekit_inventory_inventoryCode;

public function ekit_inventory_inventoryCode() {
	return $this->ekit_inventory_inventoryCode;
}

public function ekit_inventory($inventoryLocation) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, " SELECT inventoryCode FROM inventory WHERE inventoryLocation = '$inventoryLocation' and status not like 'DELETED_%' order by genericName,description asc ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
	 	$this->ekit_inventory_inventoryCode[] = $row['inventoryCode'];
	}
}


private $charges_cart_itemNo;

public function charges_cart_itemNo() {
	return $this->charges_cart_itemNo;
}

public function charges_cart($batchNo,$registrationNo) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, " SELECT itemNo FROM patientCharges WHERE batchNo = '$batchNo' and registrationNo = '$registrationNo' and status = 'UNPAID' order by description asc ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
	 	$this->charges_cart_itemNo[] = $row['itemNo'];
	}
}


//count inventory to dispense group by registrationNo..
public function count_dept_dispense($inventoryLocation) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, " SELECT registrationNo FROM `patientCharges` WHERE inventoryFrom = '$inventoryLocation' and status = 'UNPAID' and departmentStatus = '' group by registrationNo ") or die("Query fail: " . mysqli_error()); 

	return mysqli_num_rows($result);

}

private $dept_dispense_registrationNo;

public function dept_dispense_registrationNo() {
	return $this->dept_dispense_registrationNo;
}

public function dept_dispense($inventoryLocation) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, " SELECT registrationNo FROM `patientCharges` WHERE inventoryFrom = '$inventoryLocation' and status = 'UNPAID' and departmentStatus = '' group by registrationNo ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
	 	$this->dept_dispense_registrationNo[] = $row['registrationNo'];
	}
}

private $dept_dispense_patient_itemNo;

public function dept_dispense_patient_itemNo() {
	return $this->dept_dispense_patient_itemNo;
}

public function dept_dispense_patient($registrationNo,$inventoryLocation) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, " SELECT itemNo FROM `patientCharges` WHERE registrationNo = '$registrationNo' and inventoryFrom = '$inventoryLocation' and status = 'UNPAID' and departmentStatus = '' ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
	 	$this->dept_dispense_patient_itemNo[] = $row['itemNo'];
	}
}


private $get_return_inventory_registrationNo;

public function get_return_inventory_registrationNo() {
	return $this->get_return_inventory_registrationNo;
}

public function get_return_inventory($inventoryFrom) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, " SELECT registrationNo FROM `patientCharges` WHERE inventoryFrom = '$inventoryFrom' and status = 'Return' group by registrationNo ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
	 	$this->get_return_inventory_registrationNo[] = $row['registrationNo'];
	}
}

private $get_return_inventory_itemNo;

public function get_return_inventory_itemNo() {
	return $this->get_return_inventory_itemNo;
}

public function get_return_inventory_item($registrationNo,$inventoryLocation) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, " SELECT itemNo FROM `patientCharges` WHERE registrationNo = '$registrationNo' and inventoryFrom = '$inventoryLocation' and status = 'Return' and departmentStatus != '' ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
	 	$this->get_return_inventory_itemNo[] = $row['itemNo'];
	}
}


private $list_retail_inventoryCode;

public function list_retail_inventoryCode() {
	return $this->list_retail_inventoryCode;
}

public function list_retail($from,$to) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, " SELECT inventoryCode FROM inventory WHERE status not like 'DELETED%' and (dateAdded between '$from' and '$to') and retail != '' ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
	 	$this->list_retail_inventoryCode[] = $row['inventoryCode'];
	}
}


private $list_charges_chargesCode;

public function list_charges_chargesCode() {
	return $this->list_charges_chargesCode;
}

public function list_charges($title,$date1,$date2) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, " SELECT ac.chargesCode FROM availableCharges ac,patientCharges pc where pc.title = '$title' and ac.chargesCode = pc.chargesCode and (pc.dateCharge BETWEEN '$date1' and '$date2') and pc.status not like 'DELETED%' group by ac.chargesCode order by ac.Description asc ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
	 	$this->list_charges_chargesCode[] = $row['chargesCode'];
	}
}

//bilangin kung ilan procedure/examination ung ngwa
public function count_charges($chargesCode,$date1,$date2,$type) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      

	if( $type == "IPD" ) {	
		$result = mysqli_query($connection, " SELECT pc.itemNo FROM registrationDetails rd,patientCharges pc WHERE rd.registrationNo = pc.registrationNo and rd.type = 'IPD' and pc.chargesCode = '$chargesCode' and rd.Company NOT IN ('INTELLICARE','AVEGA Managed Care, Inc.') and pc.status not like 'DELETED%' and (dateCharge BETWEEN '$date1' and '$date2') ") or die("Query fail: " . mysqli_error()); 
	}else if($type == "OPD") {
		$result = mysqli_query($connection, " SELECT pc.itemNo FROM registrationDetails rd,patientCharges pc WHERE rd.registrationNo = pc.registrationNo and rd.type = 'OPD' and pc.chargesCode = '$chargesCode' and pc.company < 1 and pc.status not like 'DELETED%' and (dateCharge BETWEEN '$date1' and '$date2') ") or die("Query fail: " . mysqli_error()); 
	}else if($type == "HMO") {
		$result = mysqli_query($connection, " SELECT pc.itemNo FROM registrationDetails rd,patientCharges pc WHERE rd.registrationNo = pc.registrationNo and rd.type = 'OPD' and pc.chargesCode = '$chargesCode' and pc.company > 0 and rd.Company NOT IN ('INTELLICARE','AVEGA Managed Care, Inc.') and pc.status not like 'DELETED%' and (dateCharge BETWEEN '$date1' and '$date2') ") or die("Query fail: " . mysqli_error()); 
	}else if($type == "specialRates_opd") {
		$result = mysqli_query($connection, " SELECT pc.itemNo FROM registrationDetails rd,patientCharges pc WHERE rd.registrationNo = pc.registrationNo and rd.type = 'OPD' and pc.chargesCode = '$chargesCode' and pc.company > 0 and rd.Company IN ('INTELLICARE','AVEGA Managed Care, Inc.') and pc.status not like 'DELETED%' and (dateCharge BETWEEN '$date1' and '$date2') ") or die("Query fail: " . mysqli_error()); 
	}else if($type == "specialRates_ipd") {
		$result = mysqli_query($connection, " SELECT pc.itemNo FROM registrationDetails rd,patientCharges pc WHERE rd.registrationNo = pc.registrationNo and rd.type = 'IPD' and pc.chargesCode = '$chargesCode' and pc.company > 0 and rd.Company IN ('INTELLICARE','AVEGA Managed Care, Inc.') and pc.status not like 'DELETED%' and (dateCharge BETWEEN '$date1' and '$date2') ") or die("Query fail: " . mysqli_error()); 
	}
	else {

	}


	return mysqli_num_rows($result);
}


private $count_charges_details_itemNo;

public function count_charges_details_itemNo() {
	return $this->count_charges_details_itemNo;
}

public function count_charges_details($chargesCode,$date1,$date2,$type) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);

	if( $type == "IPD" ) {      
		$result = mysqli_query($connection, " SELECT pc.itemNo FROM registrationDetails rd,patientCharges pc WHERE rd.registrationNo = pc.registrationNo and rd.type = 'IPD' and pc.chargesCode = '$chargesCode' and rd.Company NOT IN ('INTELLICARE','AVEGA Managed Care, Inc.') and pc.status not like 'DELETED%' and (dateCharge BETWEEN '$date1' and '$date2') ") or die("Query fail: " . mysqli_error()); 
	}else if( $type == "OPD" ) {
		$result = mysqli_query($connection, " SELECT pc.itemNo FROM registrationDetails rd,patientCharges pc WHERE rd.registrationNo = pc.registrationNo and rd.type = 'OPD' and pc.chargesCode = '$chargesCode' and pc.company < 1 and pc.status not like 'DELETED%' and (dateCharge BETWEEN '$date1' and '$date2') ") or die("Query fail: " . mysqli_error()); 
	}else if( $type == "HMO" ) {
		$result = mysqli_query($connection, " SELECT pc.itemNo FROM registrationDetails rd,patientCharges pc WHERE rd.registrationNo = pc.registrationNo and rd.type = 'OPD' and pc.chargesCode = '$chargesCode' and pc.company > 0 and rd.Company NOT IN ('INTELLICARE','AVEGA Managed Care, Inc.') and pc.status not like 'DELETED%' and (dateCharge BETWEEN '$date1' and '$date2') ") or die("Query fail: " . mysqli_error()); 
	}else if( $type == "specialRates_opd" ) {
		$result = mysqli_query($connection, " SELECT pc.itemNo FROM registrationDetails rd,patientCharges pc WHERE rd.registrationNo = pc.registrationNo and rd.type = 'OPD' and pc.chargesCode = '$chargesCode' and pc.company > 0 and rd.Company IN ('INTELLICARE','AVEGA Managed Care, Inc.') and pc.status not like 'DELETED%' and (dateCharge BETWEEN '$date1' and '$date2') ") or die("Query fail: " . mysqli_error()); 
	}else if( $type == "specialRates_ipd" ) {
		$result = mysqli_query($connection, " SELECT pc.itemNo FROM registrationDetails rd,patientCharges pc WHERE rd.registrationNo = pc.registrationNo and rd.type = 'IPD' and pc.chargesCode = '$chargesCode' and rd.Company IN ('INTELLICARE','AVEGA Managed Care, Inc.') and pc.status not like 'DELETED%' and (dateCharge BETWEEN '$date1' and '$date2') ") or die("Query fail: " . mysqli_error());
	}
	else {

	}

	while( $row = mysqli_fetch_array($result) ) {
		$this->count_charges_details_itemNo[] = $row['itemNo'];
	}
}

public function count_return_inventory($inventoryLocation) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, " SELECT registrationNo FROM `patientCharges` WHERE inventoryFrom = '$inventoryLocation' and status = 'Return' and departmentStatus != '' group by registrationNo ") or die("Query fail: " . mysqli_error()); 

	return mysqli_num_rows($result);

}


private $list_inventory_preparation_preparationNo;

public function list_inventory_preparation_preparationNo() {
	return $this->list_inventory_preparation_preparationNo;
}

public function list_inventory_preparation() {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, " SELECT preparationNo FROM inventoryPreparation ORDER BY preparation ASC ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
	 	$this->list_inventory_preparation_preparationNo[] = $row['preparationNo'];
	}
}

private $paid_invoices_controlNo;

public function paid_invoices_controlNo() {
	return $this->paid_invoices_controlNo;
}

public function paid_invoices($from,$to,$paymentMode) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, " SELECT controlNo FROM vouchers WHERE (datePaid BETWEEN '$from' and '$to') and invoiceNo != '' and paymentMode = '$paymentMode' order by datePaid asc ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
	 	$this->paid_invoices_controlNo[] = $row['controlNo'];
	}
}

private $charges_list_chargesCode;

public function charges_list_chargesCode() {
	return $this->charges_list_chargesCode;
}

public function charges_list($title) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, " SELECT chargesCode FROM availableCharges WHERE Category = '$title' ORDER BY Description ASC ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
	 	$this->charges_list_chargesCode[] = $row['chargesCode'];
	}
}

public function uploadedFilesInformation($fileName,$fileUrl,$fileOwner,$itemNo,$registrationNo,$patientName) {

/* make your connection */
$sql = new mysqli($this->host,$this->username,$this->password,$this->database);
 
/* we will just create an insert query here, and use it,
normally this would be done by form submission or other means */
$query = "insert into uploadedFiles(fileName,fileUrl,fileOwner,dateUploaded,timeUploaded,itemNo,registrationNo,patientName) values('$fileName','$fileUrl','$fileOwner','".date("Y-m-d")."','".date("H:i:s")."','$itemNo','$registrationNo','$patientName')";
 
if ( $sql->query($query) ) {
   echo "A new entry has been added with the `id`";
} else {
    echo "There was a problem:<br />$query<br />{$sql->error}";
}
 

/* close our connection */
$sql->close();
}


private $search_uploaded_files_fileNo;

public function search_uploaded_files_fileNo() {
	return $this->search_uploaded_files_fileNo;
}

public function search_uploaded_files($patientName) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, " SELECT fileNo FROM uploadedFiles WHERE patientName like '$patientName%' order by patientName,fileName ASC ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
	 	$this->search_uploaded_files_fileNo[] = $row['fileNo'];
	}
}

private $list_uploaded_files_fileNo;

public function list_uploaded_files_fileNo() {
	return $this->list_uploaded_files_fileNo;
}

public function list_uploaded_files($date1,$date2) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, " SELECT fileNo FROM uploadedFiles WHERE (dateUploaded BETWEEN '$date1' and '$date2') order by dateUploaded,patientName,fileName ASC ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
	 	$this->list_uploaded_files_fileNo[] = $row['fileNo'];
	}
}


private $list_laboratory_result_savedNo;

public function list_laboratory_result_savedNo() {
	return $this->list_laboratory_result_savedNo;
}

public function list_laboratory_result($date1,$date2) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, " SELECT savedNo FROM labSavedResult WHERE (date BETWEEN '$date1' and '$date2') and status = '' order by date ASC ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
	 	$this->list_laboratory_result_savedNo[] = $row['savedNo'];
	}
}

private $search_laboratory_result_savedNo;

public function search_laboratory_result_savedNo() {
	return $this->search_laboratory_result_savedNo;
}

public function search_laboratory_result($pxName) {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, " SELECT savedNo FROM labSavedResult WHERE patientName like '$pxName%' and patientName != '' and status = '' order by date ASC ") or die("Query fail: " . mysqli_error()); 

	while($row = mysqli_fetch_array($result)) {
	 	$this->search_laboratory_result_savedNo[] = $row['savedNo'];
	}
}

/*temporary function lng e2*/

private $endingInventory_updater_endingNo;

public function endingInventory_updater_endingNo() {
	return $this->endingInventory_updater_endingNo;
}

public function endingInventory_updater() {
	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "SELECT endingNo from endingInventory WHERE quarter = '1st' ") or die("Query fail: " . mysqli_error()); 
	while($row = mysqli_fetch_array($result)) {
		$this->endingInventory_updater_endingNo[] = $row['endingNo'];
	}
}






}


?>
