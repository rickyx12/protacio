<?php
include("../../myDatabase3.php");
$date = $_GET['date'];
$date1 = $_GET['date1'];
$type = $_GET['type'];
$title = $_GET['title'];

$ro = new database3();

echo $date."<Br>";
echo $date1."<Br>";
echo $title."-".$type;
echo "<br><br>";
$ro->patientAccountOPD_mismatch($date,$date1,$type,$title);
if($type == "IPD" ) {
$ro->patientAccount($date,$date1,$type,$title);
}else {
echo "<Br><br><center>";
echo "<Table border=0 width='90%'>";
	echo "<tr>";
		echo "<th>Patient</th>";
		echo "<th>Particulars</th>";
		echo "<th>Disc</th>";
		echo "<th>UNPAID</th>";
		echo "<th>HMO</th>";
		echo "<th>PHIC</th>";
		echo "<th>CASH</th>";
		echo "<th>Cr.Card</th>";
		echo "<th>Total</th>";
		if($title == "OT") {
			echo "<th>Hospital</th>";
			echo "<th>PF</th>";
		}else {	
			/*hide*/
		}

	echo "</tr>";	
	$ro->patientAccountOPD_notPaid($date,$date1,$title);
	$ro->patientAccountOPD_paid($date,$date1,$title);
	echo "<tr>";
		echo "<td>&nbsp;</td>";
		echo "<td>&nbsp;</td>";
		echo "<td align='right'>&nbsp;".($ro->patientAccountOPD_discount)."</td>";
		echo "<td align='right'>&nbsp;".($ro->patientAccountOPD_unpaid)."</td>";
		echo "<td align='right'>&nbsp;".($ro->patientAccountOPD_hmo)."</td>";
		echo "<td align='right'>&nbsp;".($ro->patientAccountOPD_phic)."</td>";
		echo "<td align='right'>&nbsp;".($ro->patientAccountOPD_cashpaid)."</td>";
		echo "<td align='right'>&nbsp;".($ro->patientAccountOPD_creditCard)."</td>";
		echo "<td align='right'>&nbsp;".($ro->patientAccountOPD_total)."</td>";

		if($title == "OT") {
			echo "<td align='right'>".$ro->patientAccountOPD_paid_hospital()."</td>";
			echo "<td align='right'>".$ro->patientAccountOPD_paid_pf()."</td>";
		}else {

		}

	echo "</tr>";
echo "</table>";

}

?>
