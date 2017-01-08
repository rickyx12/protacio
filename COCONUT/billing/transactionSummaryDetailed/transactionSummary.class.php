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

	//get only the PF share in OT/ST/SPED and reflect as payables because it is paid as credit card
	public function get_outpatients_therapy_payables_total($registrationNo,$shift) {
		$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
		$result = mysqli_query($connection, "SELECT SUM(otShare) as otShare FROM patientCharges WHERE registrationNo = '$registrationNo' AND title IN ('OT','ST','SPED') AND status NOT LIKE 'DELETED%' AND paidVia = 'Credit Card' AND reportShift = '$shift' ") or die("Query fail: " . mysqli_error()); 
		while($row = mysqli_fetch_array($result)) {
			return $row['otShare'];
		}
	}


	//get only the PF share in OT/ST/SPED and reflect as payables because it is covered by HMO
	public function get_outpatients_therapy_payables_company_total($registrationNo,$shift) {
		$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
		$result = mysqli_query($connection, "SELECT SUM(otShare) as otShare FROM patientCharges WHERE registrationNo = '$registrationNo' AND title IN ('OT','ST','SPED') AND status NOT LIKE 'DELETED%' AND company > 0 AND reportShift = '$shift' ") or die("Query fail: " . mysqli_error()); 
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
	public function get_outpatients_shift($registrationNo,$month,$day,$year,$shift) {

		if( $day < 10 ) {
			$day_format = "0".$day;
		}else {
			$day_format = $day;
		}

		$format = $year."-".$month."-".$day_format;

		$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
		$result = mysqli_query($connection, "SELECT pc.reportShift FROM registrationDetails rd,patientCharges pc WHERE pc.registrationNo = '$registrationNo' AND rd.registrationNo = '$registrationNo' AND rd.dateUnregistered = '$format' AND pc.status NOT LIKE 'DELETED%' and pc.reportShift = '$shift' ") or die("Query fail: " . mysqli_error()); 
		while($row = mysqli_fetch_array($result)) {
			if( $row['reportShift'] != "" ) {
				return $row['reportShift'];
			}else {
				return "noShift";
			}
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

	//get the total amount covered in philhealth
	public function get_outpatients_philhealth_covered($registrationNo,$shift) {
		$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
		$result = mysqli_query($connection, "SELECT SUM(pc.phic) as covered FROM registrationDetails rd,patientCharges pc WHERE rd.registrationNo = '$registrationNo' AND pc.registrationNo = rd.registrationNo AND pc.status NOT LIKE 'DELETED%' AND pc.reportShift = '$shift' ") or die("Query fail: " . mysqli_error()); 
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

	private $get_or_number;

	public function get_or_number() {
		return $this->get_or_number;
	}

	public function or_number($registrationNo,$shift,$month,$day,$year) {

		$this->get_or_number = [];

		if( $day < 10 ) {
			$day_format = "0".$day;
		}else {
			$day_format = $day;
		}

		$format = $year."-".$month."-".$day_format;		

		$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
		$result = mysqli_query($connection, "SELECT orNO FROM patientCharges WHERE registrationNo = '$registrationNo' AND status NOT LIKE 'DELETED%' AND reportShift = '$shift' AND datePaid = '$format' GROUP BY orNO ") or die("Query fail: " . mysqli_error()); 
		while($row = mysqli_fetch_array($result)) {
			$this->get_or_number[] = $row['orNO'];
		}
	}



	private $get_discharged_inpatients_registrationNo;

	/**
		*@return String registrationNo
	*/
	public function get_discharged_inpatients_registrationNo() {
		return $this->get_discharged_inpatients_registrationNo;
	}

	/**
		*to get all the discharged inpatient in the given date.
		*
		*@param String month of from date.
		*@param String day of from date.
		*@param String year of from date.
		*@param String month1 of to date.
		*@param String day1 of to date.
		*@param String year1 of to date
		*
		*@return void
	*/
	public function get_discharged_inpatients($month,$day,$year,$month1,$day1,$year1) {

		$this->get_discharged_inpatients_registrationNo = [];

		//from day
		$format_day;

		//to day 
		$format_day1;

		///format from day to have leading zero in day 1-9
		if( $day < 10 ) {
			$format_day = '0'.$day;
		}else {
			$format_day = $day;
		}

		///format from day to have leading zero in day 1-9
		if( $day1 < 10 ) {
			$format_day1 = '0'.$day1;
		}else {
			$format_day1 = $day1;
		}

		$date = $year.'-'.$month.'-'.$format_day;
		$date1 = $year1.'-'.$month1.'-'.$format_day1;


		$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
		$result = mysqli_query($connection, "SELECT registrationNo FROM registrationDetails WHERE type = 'IPD' AND dateUnregistered = '$date' ") or die("Query fail: " . mysqli_error()); 
		while($row = mysqli_fetch_array($result)) {
			$this->get_discharged_inpatients_registrationNo[] = $row['registrationNo'];	
		}
	}


	/**
	*to check if the patient has a payment in patientPayment tbl
	*
	*@param String registrationNo
	*
	*@return Boolean
	*/
	public function check_inpatient_payment($registrationNo) {
		$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
		$result = mysqli_query($connection, "SELECT registrationNo FROM patientPayment WHERE registrationNo = '$registrationNo' ") or die("Query fail: " . mysqli_error()); 
		
		$res = mysqli_num_rows($result);

		if( $res > 0 ) {
			return true;
		}else {
			return false;
		}

	}

	/**
	 *to determine the shift of payment in inpatient.
	 *if no payments in patientPayment tbl then return as noShift.
	 *
	 *@param String registrationNo
	 *@param String shift
	 *
	 *@return String shift
	*/
	public function get_inpatient_shift($registrationNo,$shift) {
		$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
		$result = mysqli_query($connection, "SELECT shift FROM patientPayment WHERE registrationNo = '$registrationNo' AND shift = '$shift' ") or die("Query fail: " . mysqli_error()); 

		if( $this->check_inpatient_payment($registrationNo) ) {
			while($row = mysqli_fetch_array($result)) {
				
				if( $row['shift'] != '' ) {
					return $row['shift'];
				}else {
					return 'noShift';
				}

			}
		}else {
			return 'noShift';
		}		

	}

	/**
	 *to get cash payment of inpatient, HOSPITAL BILL only it means patient DEPOSIT is excluded in this payment.
	 *
	 *@param String registrationNo
	 *@param String paidVia = Cash|Credit Card 
	 *@param String shift
	 *
	 *@return Integer totalPd. total payment of patient where payment type is HOSPITAL BILL
	*/
	public function get_inpatient_payment($registrationNo,$paidVia,$shift) {
		$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
		$result = mysqli_query($connection, "SELECT SUM(amountPaid) as totalPd FROM patientPayment WHERE registrationNo = '$registrationNo' AND paidVia = '$paidVia' AND shift = '$shift' AND paymentFor = 'HOSPITAL BILL' ") or die("Query fail: " . mysqli_error()); 
		while($row = mysqli_fetch_array($result)) {
			return $row['totalPd'];
		}
	}


	/**
	 *to determine the paymentFor
	 *
	 *@param String registrationNo
	 *@param String paidVia = Cash|Credit Card 
	 *@param String shift
	 *
	 *@return String paymentFor
	*/
	public function get_inpatient_payment_for($registrationNo,$paidVia,$shift) {
		$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
		$result = mysqli_query($connection, "SELECT paymentFor FROM patientPayment WHERE registrationNo = '$registrationNo' AND paidVia = '$paidVia' AND shift = '$shift' AND paymentFor = 'HOSPITAL BILL' ") or die("Query fail: " . mysqli_error()); 
		while($row = mysqli_fetch_array($result)) {
			return $row['paymentFor'];
		}
	}

	/**
	 *get the payment of inpatient where paymentFor is DEPOSIT
	 *
	 *@param String registrationNo
	 *@param String paidVia = Cash|Credit Card
	 *@param String shift
	 *
	 *@return Integer. total deposit of patient.
	 */
	public function get_inpatient_deposit($registrationNo,$paidVia,$shift) {
		$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
		$result = mysqli_query($connection, "SELECT SUM(amountPaid) as totalPd FROM patientPayment WHERE registrationNo = '$registrationNo' AND paidVia = '$paidVia' AND paymentFor = 'DEPOSIT' ") or die("Query fail: " . mysqli_error()); 
		while($row = mysqli_fetch_array($result)) {
			return $row['totalPd'];
		}
	}



	private $list_deposit_paymentNo;

	public function list_deposit_paymentNo() {
		return $this->list_deposit_paymentNo;
	}


	/**
	 *get and list all the deposit in the specified date.
	 *
	 *@param String month
	 *@param String day
	 *@param String year
	 *
	 *@return void
	 */
	public function list_deposit($month,$day,$year) {

		$this->list_deposit_paymentNo = [];

		$format_day;

		if( $day < 10 ) {
			$format_day = '0'.$day;
		}else {
			$format_day = $day;
		}


		$datePaid = $year.'-'.$month.'-'.$format_day;

		$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
		$result = mysqli_query($connection, "SELECT paymentNo FROM patientPayment WHERE paymentFor = 'DEPOSIT' AND datePaid = '$datePaid'  ") or die("Query fail: " . mysqli_error()); 
		while($row = mysqli_fetch_array($result)) {
			$this->list_deposit_paymentNo[] = $row['paymentNo'];
		}
	}



	/**
	*to get the total coverage of HMO/Company of an inpatient
	*
	*@param String registrationNo
	*@param String companyType
	*
	*@return Integer total hmo/company covered with deductions of all excess/incrementalCost/discount.
	*/
	public function get_inpatient_hmo($registrationNo,$companyType,$shift) {
		
		$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
		
		$result = mysqli_query($connection, "SELECT SUM(pc.company) AS totalCovered,rd.excessMaxBenefits,rd.excessPF,rd.excessRoom,rd.PHICportion,rd.hmoManualExcessValue,rd.incrementalCost,rd.discount FROM registrationDetails rd,patientCharges pc WHERE rd.registrationNo = '$registrationNo' AND rd.registrationNo = pc.registrationNo AND rd.companyType = '$companyType' AND pc.status NOT LIKE 'DELETED%' AND pc.remarks != 'VAT' ") or die("Query fail: " . mysqli_error()); 
		
		while($row = mysqli_fetch_array($result)) {

			return ($row['totalCovered'] - ( $row['excessMaxBenefits'] + $row['excessPF'] + $row['excessRoom'] + $row['PHICportion'] + $row['hmoManualExcessValue'] + $row['incrementalCost'] + $row['discount'] ));
		
		}
	}
	

	/**
	*to get the philhealth covered of patient
	*
	*@param String registrationNo
	*
	*@return Integer philhealth
	*/
	public function get_inpatient_philhealth($registrationNo) {
		$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
		$result = mysqli_query($connection, "SELECT SUM(phic) AS phic FROM patientCharges WHERE registrationNo = '$registrationNo' AND status not like 'DELETED%' and remarks != 'VAT' ") or die("Query fail: " . mysqli_error()); 
		while($row = mysqli_fetch_array($result)) {
			return $row['phic'];
		}
	}	




	private $list_inpatient_balance_paid_paymentNo;

	public function list_inpatient_balance_paid_paymentNo() {
		return $this->list_inpatient_balance_paid_paymentNo;
	}

	/**
	*show the paid balance of inpatient.
	*
	*@param String month
	*@param String day
	*@param String year
	*
	*@return void
	*/
	public function list_inpatient_balance_paid($month,$day,$year) {

		$this->list_inpatient_balance_paid_paymentNo = [];

		$format_day;

		if( $day < 10 ) {
			$format_day = '0'.$day;
		}else {
			$format_day = $day;
		}

		$datePaid = $year.'-'.$month.'-'.$format_day;

		$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
		$result = mysqli_query($connection, "SELECT paymentNo FROM patientPayment WHERE datePaid = '$datePaid' AND paymentFor = 'BALANCE PAID' ") or die("Query fail: " . mysqli_error()); 
		while($row = mysqli_fetch_array($result)) {
			$this->list_inpatient_balance_paid_paymentNo[] = $row['paymentNo'];
		}
	}


}