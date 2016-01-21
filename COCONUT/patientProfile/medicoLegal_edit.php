<?php
include("../../myDatabase2.php");
$registrationNo = $_GET['registrationNo'];
$ro = new database2();
$ro->getPatientProfile($registrationNo);


echo "<style type='text/css'>";
echo "
.patientName{
	border: 1px solid #000;
	color: #000;
	height: 28px;
	width: 340px;
	border-color:white white black white;
	font-size:17px;

}

.patientAge{
	border: 1px solid #000;
	color: #000;
	height: 28px;
	width: 120px;
	border-color:white white black white;
	font-size:17px;

}

.patientAddress{
	border: 1px solid #000;
	color: #000;
	height: 28px;
	width: 80%;
	border-color:white white black white;
	font-size:17px;

}

.medicoLegalInformation{
	border: 1px solid #000;
	color: #000;
	height: 28px;
	width: 50%;
	border-color:white white black white;
	font-size:17px;

}

.medicoLegalInformation1{
	border: 1px solid #000;
	color: #000;
	height: 28px;
	width: 60%;
	border-color:white white black white;
	font-size:17px;

}

.txtBox {
	border: 1px solid #000;
	color: #000;
	height: 130px;
	width: 80%;
	padding:4px 4px 4px 5px;
}

";
echo "</style>";
echo "<center>";
echo "<font size=3>Cabrera St,Pagadian City</font>";
echo "<br><font size=2>Philipines</font>";
echo "<br><font size=2>Tel No.(062) 2143737</font>";

echo "<hr>";

echo "<br><b><font size=5>MEDICO LEGAL</font></b>";

$ro->coconutFormStart("post","medicoLegal_edit1.php");
$ro->coconutHidden("registrationNo",$registrationNo);
echo "<br><br><br>";
echo "<table border=0 width='70%'>";
echo "<Tr>";
echo "<td width='70%'>Name:&nbsp;<input type='text' class='patientName' value='".$ro->getPatientRecord_lastName().", ".$ro->getPatientRecord_firstName()."'></td>";
echo "<td width='30%'>Age:&nbsp;<input type='text' class='patientAge' value='".$ro->getPatientRecord_Age()."'></td>";
echo "</tr>";
echo "</table>";

echo "<table border=0 width='70%'>";
echo "<td>Address:&nbsp;<input type='text' class='patientAddress' value='".$ro->getPatientRecord_address()."'></td>";
echo "</table>";
echo "<Br><br>";
echo "<table border=0 width='70%'>";
echo "<tr>";
echo "<td>DATE OF INCIDENCCE:&nbsp;<input type='text' autocomplete='off' name='dateOfIncidence' class='medicoLegalInformation' value='".$ro->selectNow("medicoLegal","dateOfIncidence","registrationNo",$registrationNo)."'></td>";
echo "</tr>";
echo "<tr>";
echo "<td>TIME OF INCIDENCCE:&nbsp;<input type='text' autocomplete='off' name='timeOfIncidence' class='medicoLegalInformation' value='".$ro->selectNow("medicoLegal","timeOfIncidence","registrationNo",$registrationNo)."'></td>";
echo "</tr>";
echo "<tr>";
echo "<td>DATE OF EXAMINATION:&nbsp;<input type='text' autocomplete='off' name='dateOfExamination' class='medicoLegalInformation' value='".$ro->selectNow("medicoLegal","dateOfExamination","registrationNo",$registrationNo)."'></td>";
echo "</tr>";
echo "<tr>";
echo "<td>TIME OF EXAMINATION:&nbsp;<input type='text' autocomplete='off' name='timeOfExamination' class='medicoLegalInformation' value='".$ro->selectNow("medicoLegal","timeOfExamination","registrationNo",$registrationNo)."'></td>";
echo "</tr>";
echo "<tr>";
echo "<td>PLACE OF EXAMINATION:&nbsp;<input type='text' autocomplete='off' name='placeOfExamination' class='medicoLegalInformation' value='".$ro->selectNow("medicoLegal","placeOfExamination","registrationNo",$registrationNo)."'></td>";
echo "</tr>";
echo "<tr>";
echo "<td><input type='text' name='placeOfExamination1' autocomplete='off' class='medicoLegalInformation1' value='".$ro->selectNow("medicoLegal","placeOfExamination1","registrationNo",$registrationNo)."'></td>";
echo "</tr>";
echo "<tr>";
echo "<td>NATURE<input type='text' autocomplete='off' name='nature' class='medicoLegalInformation' value='".$ro->selectNow("medicoLegal","nature","registrationNo",$registrationNo)."'></td>";
echo "</tr>";
echo "</table>";

echo "<br><br><br>";

echo "<table border=0 width='70%'>";
echo "<Tr>";
echo "<td>PERTINENT PHYSICAL EXAMINATION</td>";
echo "</tr>";
echo "<tr>";
echo "<td><textarea class='txtBox' name='pertinentPhysicalExamination'>".$ro->selectNow("medicoLegal","pertinentPhysicalExamination","registrationNo",$registrationNo)."</textarea></td>";
echo "</tr>";
echo "</table>";
echo "<br><bR>";
$ro->coconutButton("Edit");
$ro->coconutFormStop();

?>
