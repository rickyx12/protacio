<?
include "../../myDatabase.php";
include "../../myDatabase4.php";

$registrationNo = $_GET['registrationNo'];

$ro = new database();
$ro4 = new database4();

$ro4->get_patient_charges($registrationNo);

?>

<script src="../js/jquery-2.1.4.min.js"></script>

<script>
	
	$(document).ready(function() {
	    $('#print').click(function(){   
	        var divContents = $('#printData').html();
	        var printWindow = window.open('', '', ',width=800');
	        printWindow.document.write('<!DOCTYPE html><html>');
	        
	        printWindow.document.write('<body>');
	        printWindow.document.write(divContents);
	        printWindow.document.write('</body></html>');
	        printWindow.print();
	        printWindow.close();
	    });//end of print button click
	});//end of ready function

</script>
<button type="button" id="print">Print</button>
<div id='printData'>

<?

echo "<table style='width:40%;'>";
	foreach( $ro4->get_patient_charges_itemNo() as $itemNo ) {
		$description = $ro->selectNow("patientCharges","description","itemNo",$itemNo);
		$price = $ro->selectNow("patientCharges","sellingPrice","itemNo",$itemNo);
		$qty = $ro->selectNow("patientCharges","quantity","itemNo",$itemNo);
		$title = $ro->selectNow("patientCharges","title","itemNo",$itemNo);

		if( $title == "MEDICINE" || $title == "SUPPLIES" ) {
			echo "<tr>";
			echo "<td style='width:15%;'><font style='font-size:13px;'>".$description." (".$qty."pcs)</font></td>";
			echo "<td style='width:3%;'><font style='font-size:13px;'>---</font></td>";
			echo "<td style='width:2%'><font style='font-size:13px;'>".$price."</font></td>";
			echo "</tr>";
		}else {
			echo "<tr>";
			echo "<td style='width:15%;'><font style='font-size:13px;'>".$description."</font></td>";
			echo "<td style='width:3%;'><font style='font-size:13px;'>---</font></td>";
			echo "<td style='width:2%;'><font style='font-size:13px;'>".$price."</font></td>";
			echo "</tr>";
		}

	}
echo "</table>";
?>
</div>