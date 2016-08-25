<?
	include "../../../myDatabase.php";
	include "../../../myDatabase4.php";

	$chargesCode = $_POST['chargesCode'];
	$date1 = $_POST['date1'];
	$date2 = $_POST['date2'];

	$ro = new database();
	$ro4 = new database4();

	$opdPrice = $ro->selectNow("availableCharges","OPD","chargesCode",$chargesCode);
	$censusOPD = $ro4->count_charges($chargesCode,$date1,$date2,"OPD");
	$opdTotal = ( $opdPrice * $censusOPD );

	$hmoPrice = $ro->selectNow("availableCharges","HMO","chargesCode",$chargesCode);
	$censusHMO = $ro4->count_charges($chargesCode,$date1,$date2,"HMO");
	$hmoTotal = ( $hmoPrice * $censusHMO );

	$specialRates_opdPrice = $ro->selectNow("availableCharges","specialRates","chargesCode",$chargesCode);
	$censusSpecialRates_opd = $ro4->count_charges($chargesCode,$date1,$date2,"specialRates_opd");
	$specialRatesTotal_opd = ( $specialRates_opdPrice * $censusSpecialRates_opd );	

	$ipdPrice = $ro->selectNow("availableCharges","WARD","chargesCode",$chargesCode);
	$censusIPD = $ro4->count_charges($chargesCode,$date1,$date2,"IPD");
	$ipdTotal = ( $ipdPrice * $censusIPD );

	$specialRates_ipdPrice = $ro->selectNow("availableCharges","specialRates","chargesCode",$chargesCode);
	$censusSpecialRates_ipd = $ro4->count_charges($chargesCode,$date1,$date2,"specialRates_ipd");
	$specialRatesTotal_ipd = ( $specialRates_ipdPrice * $censusSpecialRates_ipd );	

	$totalCensus = ( $censusOPD + $censusHMO + $censusIPD + $censusSpecialRates_opd + $censusSpecialRates_ipd );
	$totalAmount = ( $opdTotal + $hmoTotal + $ipdTotal + $specialRatesTotal_opd + $specialRatesTotal_ipd );

	if( $totalCensus > 0 ) {
		echo "(".$totalCensus.") ".number_format($totalAmount,2);
	}else {

	}

?>