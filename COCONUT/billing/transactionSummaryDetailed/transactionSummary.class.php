<?

class transactionSummary {
	
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


	private $get_outpatients_registrationNo;

	public function get_outpatients_registrationNo() {
		return $this->get_outpatients_registrationNo;
	}

	//list all opd in specified date
	public function get_outpatients($year,$month,$day,$year1,$month1,$day1) {
		
		$this->get_outpatients_registrationNo = [];

		$date = $year."-".$month."-".$day;
		$date1 = $year1."-".$month1."-".$day1;
		
		$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
		$result = mysqli_query($connection, "SELECT registrationNo FROM registrationDetails WHERE (dateUnregistered BETWEEN '$date' AND '$date1') AND type = 'OPD'") or die("Query fail: " . mysqli_error()); 
		while($row = mysqli_fetch_array($result)) {
			$this->get_outpatients_registrationNo[] = $row['registrationNo'];
		}
	}

	//sum the total of specific title e.g LABORATORY,XRAY etc.
	public function get_outpatients_title_total($registrationNo,$title,$shift) {
		$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
		$result = mysqli_query($connection, "SELECT SUM(total) as total FROM patientCharges WHERE registrationNo = '$registrationNo' AND title = '$title' AND status NOT LIKE 'DELETED%' AND reportShift = '$shift' ") or die("Query fail: " . mysqli_error()); 
		while($row = mysqli_fetch_array($result)) {
			return $row['total'];
		}
	}

	//get only the hospital share in OT/ST
	public function get_outpatients_therapy_total($registrationNo,$title,$shift) {
		$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
		$result = mysqli_query($connection, "SELECT SUM(otShare) as otShare,SUM(total) as total FROM patientCharges WHERE registrationNo = '$registrationNo' AND title = '$title' AND status NOT LIKE 'DELETED%' AND reportShift = '$shift' ") or die("Query fail: " . mysqli_error()); 
		while($row = mysqli_fetch_array($result)) {
			return ($row['total'] - $row['otShare']);
		}
	}

	//get only the PF share in OT/ST and reflect as payables because it paid as credit card
	public function get_outpatients_therapy_payables_total($registrationNo,$shift) {
		$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
		$result = mysqli_query($connection, "SELECT SUM(otShare) as otShare FROM patientCharges WHERE registrationNo = '$registrationNo' AND title IN ('OT','ST','SPED') AND status NOT LIKE 'DELETED%' AND paidVia = 'Credit Card' AND reportShift = '$shift' ") or die("Query fail: " . mysqli_error()); 
		while($row = mysqli_fetch_array($result)) {
			return $row['otShare'];
		}
	}

	//get only the hospital share in PF
	public function get_outpatients_PF_total($registrationNo,$title,$shift) {
		$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
		$result = mysqli_query($connection, "SELECT SUM(cashUnpaid) as unpaid,SUM(cashPaid) as paid,SUM(amountPaidFromCreditCard) as creditCard,SUM(phic) as phic,SUM(company) as hmo,SUM(discount) as discount FROM patientCharges WHERE registrationNo = '$registrationNo' AND title = '$title' AND status NOT LIKE 'DELETED%' AND reportShift = '$shift' ") or die("Query fail: " . mysqli_error()); 
		while($row = mysqli_fetch_array($result)) {
			return ( $row['unpaid'] + $row['paid'] + $row['creditCard'] + $row['phic'] + $row['hmo'] + $row['discount'] );
		}
	}

	//get only the PF share in PF and reflect as payables because it paid as credit card
	public function get_outpatients_PF_payables_total($registrationNo,$title,$shift) {
		$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
		$result = mysqli_query($connection, "SELECT SUM(doctorsPF_payable) as PF_payable FROM patientCharges WHERE registrationNo = '$registrationNo' AND title = '$title' AND status NOT LIKE 'DELETED%' AND paidVia = 'Credit Card' AND reportShift = '$shift' ") or die("Query fail: " . mysqli_error()); 
		while($row = mysqli_fetch_array($result)) {
			return $row['PF_payable'];
		}
	}


	//get patient's shift
	public function get_outpatients_shift($registrationNo,$month,$day,$year) {

		if( $day < 10 ) {
			$day_format = "0".$day;
		}else {
			$day_format = $day;
		}

		$format = $year."-".$month."-".$day_format;

		$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
		$result = mysqli_query($connection, "SELECT pc.reportShift FROM registrationDetails rd,patientCharges pc WHERE pc.registrationNo = '$registrationNo' AND rd.registrationNo = '$registrationNo' AND rd.dateUnregistered = '$format' AND pc.status NOT LIKE 'DELETED%' and pc.reportShift != '' ") or die("Query fail: " . mysqli_error()); 
		while($row = mysqli_fetch_array($result)) {
			return $row['reportShift'];
		}
	}

	/*
	check if patient has an unpaid charges. the Purpose is

	if( hasCharges ) {
		showPatient
	}else {
		hidePatient
	}
	*/
	public function check_total($registrationNo) {
		$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
		$result = mysqli_query($connection, "SELECT SUM(total) as total FROM patientCharges WHERE registrationNo = '$registrationNo' AND status NOT LIKE 'DELETED%' and reportShift = '' ") or die("Query fail: " . mysqli_error()); 
		while($row = mysqli_fetch_array($result)) {
			return $row['total'];
		}
	}


	public function get_outpatients_cash_payment($registrationNo,$shift) {
		$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
		$result = mysqli_query($connection, "SELECT SUM(cashPaid) as pd FROM patientCharges WHERE registrationNo = '$registrationNo' AND status NOT LIKE 'DELETED%' AND reportShift = '$shift' ") or die("Query fail: " . mysqli_error()); 
		while($row = mysqli_fetch_array($result)) {
			return $row['pd'];
		}
	}


	public function get_outpatients_creditCard_payment($registrationNo,$shift) {
		$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
		$result = mysqli_query($connection, "SELECT SUM(amountPaidFromCreditCard) as pd FROM patientCharges WHERE registrationNo = '$registrationNo' AND status NOT LIKE 'DELETED%' AND reportShift = '$shift' ") or die("Query fail: " . mysqli_error()); 
		while($row = mysqli_fetch_array($result)) {
			return $row['pd'];
		}
	}


	public function get_outpatients_hmo_covered($registrationNo,$shift) {
		$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
		$result = mysqli_query($connection, "SELECT SUM(pc.company) as covered FROM registrationDetails rd,patientCharges pc WHERE rd.registrationNo = '$registrationNo' AND pc.registrationNo = rd.registrationNo AND rd.companyType != 'company' AND pc.status NOT LIKE 'DELETED%' AND pc.reportShift = '$shift' ") or die("Query fail: " . mysqli_error()); 
		while($row = mysqli_fetch_array($result)) {
			return $row['covered'];
		}
	}


	public function get_outpatients_company_covered($registrationNo,$shift) {
		$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
		$result = mysqli_query($connection, "SELECT SUM(pc.company) as covered FROM registrationDetails rd,patientCharges pc WHERE rd.registrationNo = '$registrationNo' AND pc.registrationNo = rd.registrationNo AND rd.companyType = 'company' AND pc.status NOT LIKE 'DELETED%' AND pc.reportShift = '$shift' ") or die("Query fail: " . mysqli_error()); 
		while($row = mysqli_fetch_array($result)) {
			return $row['covered'];
		}
	}

	//sum the total unpaid amount of patient.
	public function get_outpatients_unpaid_total($registrationNo,$shift) {
		$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
		$result = mysqli_query($connection, "SELECT SUM(cashUnpaid) as unpaid FROM patientCharges WHERE registrationNo = '$registrationNo' AND status NOT LIKE 'DELETED%' AND reportShift = '$shift' ") or die("Query fail: " . mysqli_error()); 
		while($row = mysqli_fetch_array($result)) {
			return $row['unpaid'];
		}
	}

	public function get_outpatients_discount_total($registrationNo,$shift) {
		$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
		$result = mysqli_query($connection, "SELECT SUM(discount) as discount FROM patientCharges WHERE registrationNo = '$registrationNo' AND status NOT LIKE 'DELETED%' AND reportShift = '$shift' ") or die("Query fail: " . mysqli_error()); 
		while($row = mysqli_fetch_array($result)) {
			return $row['discount'];
		}
	}

	public function get_OR_number($registrationNo,$shift,$month,$day,$year) {

		if( $day < 10 ) {
			$day_format = "0".$day;
		}else {
			$day_format = $day;
		}

		$format = $year."-".$month."-".$day_format;		

		$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
		$result = mysqli_query($connection, "SELECT orNO FROM patientCharges WHERE registrationNo = '$registrationNo' AND status NOT LIKE 'DELETED%' AND reportShift = '$shift' AND datePaid = '$format' ") or die("Query fail: " . mysqli_error()); 
		while($row = mysqli_fetch_array($result)) {
			return $row['orNO'];
		}
	}


}