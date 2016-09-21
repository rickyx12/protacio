<?
include "../../myDatabase.php";
include "../../myDatabase4.php";

$registrationNo = $_GET['registrationNo'];

$ro = new database();
$ro4 = new database4();

$discTotal = 0;
$phicTotal = 0;
$hmoTotal = 0;
$cashTotal = 0;
$grandTotal = 0;

$patientNo = $ro->selectNow("registrationDetails","patientNo","registrationNo",$registrationNo);
$lastName = $ro->selectNow("patientRecord","lastName","patientNo",$patientNo);
$firstName = $ro->selectNow("patientRecord","firstName","patientNo",$patientNo);
$ro4->get_patient_charges($registrationNo);

?>

<script src="../js/jquery-2.1.4.min.js"></script>
<link rel='stylesheet' href='../myCSS/chargeSlip.css'>

<script>
	
	$(document).ready(function() {
	    $('#print').click(function(){   
	        var divContents = $('#printData').html();
	        var printWindow = window.open('', '', ',width=650');
	        printWindow.document.write('<!DOCTYPE html>');
	        printWindow.document.write('<head><link rel="stylesheet" href="../myCSS/chargeSlip.css"></head>')	
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

<div id='header'>
	<div class='headerContainer'>
		<font class='data'><b>Patient</b></font>
		&nbsp;
		<font class='data'><? echo $lastName.", ".$firstName ?></font>
	</div>

	<div class='headerContainer'>
		<font class='data'><b>PIN#</b></font>
		&nbsp;
		<font class='data'><? echo $ro->selectNow('registrationDetails','manual_patientNo','registrationNo',$registrationNo) ?></font>
	</div>


	<div class='headerContainer'>
		<font class='data'><b>Age</b></font>
		&nbsp;
		<font class='data'><? echo $ro->selectNow('patientRecord','Age','patientNo',$patientNo) ?></font>
	</div>

	<div class='headerContainer'>
		<font class='data'><b>Reg#</b></font>
		&nbsp;
		<font class='data'><? echo $ro->selectNow('registrationDetails','registrationNo','registrationNo',$registrationNo) ?></font>
	</div>

	<div class='headerContainer'>
		<font class='data'><b>Birthday</b></font>
		&nbsp;
		<font class='data'><? echo $ro4->formatDate($ro->selectNow('patientRecord','Birthdate','patientNo',$patientNo)) ?></font>
	</div>

	<div class='headerContainer'>
		<font class='data'><b>Date</b></font>
		&nbsp;
		<font class='data'><? echo $ro4->formatDate($ro->selectNow('registrationDetails','dateRegistered','registrationNo',$registrationNo)) ?></font>
	</div>

	<div class='headerContainerFullWidth'>
		<font class='data'><b>Room</b></font>
		&nbsp;
		<font class='data'><? echo $ro->selectNow('registrationDetails','room','registrationNo',$registrationNo) ?></font>
	</div>

</div>


<table id='charges'>
	<thead>
		<tr>
			<th class='description'><font class='data'>Particulars</font></th>
			<th class='qty'><font class='data'>QTY</font></th>
			<th class='prices'><font class='data'>Disc</font></th>
			<th class='prices'><font class='data'>PHIC</font></th>
			<th class='prices'><font class='data'>HMO</font></th>
			<th class='prices'><font class='data'>Cash</font></th>
			<th class='prices'><font class='data'>Total</font></th>
		</tr>
	</thead>
	<tbody>
		<? foreach( $ro4->get_patient_charges_itemNo() as $itemNo ) { ?>
			<tr>
				<td class='description'>
					<font class='data'>
						<?
							echo $ro->selectNow('patientCharges','description','itemNo',$itemNo)
						?>
					</font>
				</td>
				<td class='qty'>
					<font class='data'>
						<?
							echo $ro->selectNow('patientCharges','quantity','itemNo',$itemNo)
						?>
					</font>
				</td>
				<td class='prices'>
					<font class='data'>
						<?
							$disc = $ro->selectNow('patientCharges','discount','itemNo',$itemNo);
							$discTotal += $disc;
							( $disc > 0 ) ? $d = number_format($disc,2) : $d = '';
							echo $d;
						?>
					</font>
				</td>
				<td class='prices'>
					<font class='data'>
						<?
							$phic = $ro->selectNow('patientCharges','phic','itemNo',$itemNo);
							$phicTotal += $phic;
							( $phic > 0 ) ? $p = number_format($phic,2) : $p = '';
							echo $p;
						?>
					</font>
				</td>
				<td class='prices'>
					<font class='data'>
						<?
							$hmo = $ro->selectNow('patientCharges','company','itemNo',$itemNo);
							$hmoTotal += $hmo;
							( $hmo > 0 ) ? $h = number_format($hmo,2) : $h = '';
							echo $h;
						?>
					</font>
				</td>
				<td class='prices'>
					<font class='data'>
						<?
							$cash = $ro->selectNow('patientCharges','cashUnpaid','itemNo',$itemNo);
							$cashTotal += $cash;
							( $cash > 0 ) ? $c = number_format($cash,2) : $c = '';
							echo $c;
						?>
					</font>
				</td>
				<td class='prices'>
					<font class='data'>
						<?
							$total = $ro->selectNow('patientCharges','total','itemNo',$itemNo);
							$grandTotal += $total;
							( $total > 0 ) ? $t = number_format($total,2) : $t = '';
							echo $t;
						?>
					</font>
				</td>																
			</tr>
		<? } ?>
		<tfoot>
			<tr>
				<td>
					<font class='data'>
						<b>
							Total
						</b>
					</font>
				</td>
				<td></td>
				<td>
					<font class='data'>
						<b>
							<?
								($discTotal > 0) ? $d = number_format($discTotal,2) : $d = '';
								echo $d;
							?>
						</b>
					</font>
				</td>
				<td>
					<font class='data'>
						<b>
							<?
								($phicTotal > 0) ? $p = number_format($phicTotal,2) : $p = '';
								echo $p;
							?>
						</b>						
					</font>
				</td>
				<td>
					<font class='data'>
						<b>
							<?
								($hmoTotal > 0) ? $h = number_format($hmoTotal,2) : $h = '';
								echo $h;
							?>
						</b>
					</font>
				</td>
				<td>
					<font class='data'>
						<b>
							<?
								($cashTotal > 0) ? $c = number_format($cashTotal,2) : $c = '';
								echo $c;
							?>
						</b>
					</font>
				</td>
				<td>
					<font class='data'>
						<b>
							<?
								($grandTotal > 0) ? $g = number_format($grandTotal,2) : $g = '';
								echo $g;
							?>
						</b>
					</font>
				</td>
			</tr>
		</tfoot>
	</tbody>
</table>

<?
/*
echo "<table id='charges'>";
	foreach( $ro4->get_patient_charges_itemNo() as $itemNo ) {
		$description = $ro->selectNow("patientCharges","description","itemNo",$itemNo);
		$price = $ro->selectNow("patientCharges","sellingPrice","itemNo",$itemNo);
		$qty = $ro->selectNow("patientCharges","quantity","itemNo",$itemNo);
		$title = $ro->selectNow("patientCharges","title","itemNo",$itemNo);

		if( $title == "MEDICINE" || $title == "SUPPLIES" ) {
			echo "<tr>";
			echo "<td class='description'><font class='data'>".$description." (".$qty."pcs)</font></td>";
			echo "<td class='delimiter'><font class='data'>---</font></td>";
			echo "<td class='prices'><font class='data'>".$price."</font></td>";
			echo "</tr>";
		}else {
			echo "<tr>";
			echo "<td class='description'><font class='data'>".$description."</font></td>";
			echo "<td class='delimiter'><font class='data'>---</font></td>";
			echo "<td class='prices'><font class='data'>".$price."</font></td>";
			echo "</tr>";
		}

	}
echo "</table>";
*/
?>
</div>