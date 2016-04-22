<? include "../../../myDatabase.php" ?>
<? include "../../../myDatabase4.php" ?>
<? $registrationNo = $_GET['registrationNo'] ?>
<? $ro = new database() ?>
<? $ro4 = new database4() ?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="../../../jquery-2.1.4.min.js"></script>
		<link rel="stylesheet" href="../../../bootstrap-3.3.6/css/bootstrap.css"></link>
		<script src="../../../bootstrap-3.3.6/js/bootstrap.js"></script>		

		<script>
			$(document).ready(function(){ 
				$("#approximateNotifier").hide();

				$("#approximateBtn").click(function(){
					
					var itemNo = $('input[class=itemNo]:checked').map(function(){
									return this.value;
								}).get();	

					$.post("discount-approximate.php",{itemNo:itemNo},function(data){
						//console.log(data);
						$("#approximateNotifier").show();
						$("#approximateNotifier").html(data);
					});
				});

				$("#discountBtn").click(function(){

					var itemNo = $('input[class=itemNo]:checked').map(function(){
									return this.value;
								}).get();	

					$.post("discount1.php",{itemNo:itemNo,registrationNo:<? echo $registrationNo ?>},function(data){
						//console.log(data);
						$("#approximateNotifier").show();
						$("#approximateNotifier").html(data);
						location.reload();
					});					

				});

			});					
		</script>

	</head>
	<body>
	<? $ro4->get_patient_charges($registrationNo) ?>
		<div class="container">
			<h3>Discount</h3>
			<div class="row">
				<div class="col-md-6">
					<div id="approximateNotifier" class="alert alert-info"></div>
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Particulars</th>
								<th>Price</th>
								<th>QTY</th>
								<th>Discount</th>
								<th>Unpaid</th>
								<th>Total</th>
								<th></th>
							</tr>
						</thead>
						<tbody id="charges">
							<? foreach($ro4->get_patient_charges_itemNo() as $itemNo) { ?>

								<? if($ro->selectNow("patientCharges","status","itemNo",$itemNo) == "UNPAID") { ?>
									<? if( $ro->selectNow("patientCharges","title","itemNo",$itemNo) != "PROFESSIONAL FEE" ) { ?>
										<tr>
											<td><? echo $ro->selectNow("patientCharges","description","itemNo",$itemNo) ?></td>
											<td><? ($ro->selectNow("patientCharges","sellingPrice","itemNo",$itemNo) > 0) ? $x = number_format($ro->selectNow("patientCharges","sellingPrice","itemNo",$itemNo),2) : $x = 0; echo $x ?></td>
											<td><? echo $ro->selectNow("patientCharges","quantity","itemNo",$itemNo) ?></td>
											<td><? echo $ro->selectNow("patientCharges","discount","itemNo",$itemNo) ?></td>

											<td><? ($ro->selectNow("patientCharges","cashUnpaid","itemNo",$itemNo) > 0) ? $x = number_format($ro->selectNow("patientCharges","cashUnpaid","itemNo",$itemNo),2) : $x = 0; echo $x  ?></td>

											<td><?  ($ro->selectNow("patientCharges","total","itemNo",$itemNo) > 0) ? $x = number_format($ro->selectNow("patientCharges","total","itemNo",$itemNo),2) : $x = 0; echo $x ?></td>
										<? if($ro->selectNow("patientCharges","discount","itemNo",$itemNo) < 1) { ?>
											<td><input type="checkbox" class="itemNo" name="itemNo[]" value="<? echo $itemNo ?>"></td>
										<? }else { } ?>
										</tr>
									<? } ?>
								<? }else { } ?>

							<? } ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 text-right">
					<input type="button" id="approximateBtn" class="btn btn-warning" value="Approximate">
					<input type="button" id="discountBtn" class="btn btn-success" value="Add Discount">
				</div>
			</div>
		</div>
	</body>
</html>