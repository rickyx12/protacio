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



}


?>
