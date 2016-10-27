<?
include "../../myDatabase.php";
include "../../myDatabase4.php";

$registrationNo = $_GET['registrationNo'];
$doctorCode = $_GET['doctorCode'];

$ro = new database();
$ro4 = new database4();

$itemNo = $ro4->get_current_doctor($registrationNo,$doctorCode);
$soapNo = $ro->doubleSelectNow("SOAP","soapNo","registrationNo",$registrationNo,"itemNo",$itemNo);


$data = [];

if( $soapNo != "" ) {
	array_push($data,[
			"subjective" => $ro->selectNow("SOAP","subjective","soapNo",$soapNo),
			"objective" => $ro->selectNow("SOAP","objective","soapNo",$soapNo),
			"assessment" => $ro->selectNow("SOAP","assessment","soapNo",$soapNo),
			"plan" => $ro->selectNow("SOAP","plan","soapNo",$soapNo)
		]);
	$json = json_encode($data);
	echo $json;
}else {
	$json = "none";
	echo $json;
}


?>