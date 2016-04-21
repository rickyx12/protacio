<? include "../../myDatabase.php" ?>
<? include "../../myDatabase4.php" ?>
<? $ro = new database() ?>
<? $ro4 = new database4() ?>
<!doctype html>
<html>
	<head>
		<title></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="../../jquery-2.1.4.min.js"></script>
		<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
		<script src="../../bootstrap-3.3.6/js/bootstrap.js"></script>

		<script>
			
			$(document).ready(function(){
					
				$("#alert").hide();

				$("#discountBtn").click(function(){
				var checkedVal = $('input[class=itemNo]:checked').map(function(){
									return this.value;
								}).get();
				var discount = $("#discount").val();
									
					$.post("manual-discount1.php",{itemNo:checkedVal,discount:discount},function(data) {
						$("#alert").show();
						$("#alert").html(data);
						$("#charges").load("manual-discount.php?registrationNo=<? echo $_GET['registrationNo'] ?> #charges");
						$("#discount").val("");
					});
				});


			});
		
		</script>

	</head>
	<body>
		<? $ro4->get_patient_charges($_GET['registrationNo']) ?>
		<!--
		<form method="post" action="manual-discount1.php">
		-->
		<div class="container">
			<div class="row">
				<h3>Manual Discount</h3>
				<div class="col-md-3">
					<input type="text" id="discount" name="discount" class="form-control" placeholder="Enter discount" autocomplete="off">
				</div>
			</div>
			<div class="row">
				&nbsp;
			</div>
			<div class="row">
				<div class="col-md-7">
				<div id="alert" class="alert alert-info"></div>
				<table id="charges" class="table table-hover">
					<thead>
						<tr>
							<th>Description</th>
							<th>Price</th>
							<th>QTY</th>
							<th>Diiscount</th>
							<th>Total</th>
							<th>Unpaid</th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
						<? foreach($ro4->get_patient_charges_itemNo() as $itemNo) { ?>
							<tr>

							<? if($ro->selectNow("patientCharges","status","itemNo",$itemNo) == "UNPAID") { ?>
								<td><? echo $ro->selectNow("patientCharges","description","itemNo",$itemNo) ?></td>
								<td><? echo $ro->selectNow("patientCharges","sellingPrice","itemNo",$itemNo) ?></td>
								<td><? echo $ro->selectNow("patientCharges","quantity","itemNo",$itemNo) ?></td>
								<td><? echo $ro->selectNow("patientCharges","discount","itemNo",$itemNo) ?></td>
								<td><? echo $ro->selectNow("patientCharges","total","itemNo",$itemNo) ?></td>
								<td><? echo $ro->selectNow("patientCharges","cashUnpaid","itemNo",$itemNo) ?></td>

								<? if($ro->selectNow("patientCharges","discount","itemNo",$itemNo) < 1) { ?>
										
									<? if($ro->selectNow("patientCharges","title","itemNo",$itemNo) != "PROFESSIONAL FEE") { ?>
										<td><input type="checkbox" id="itemNo<? echo $itemNo ?>" class="itemNo" name="itemNo[]" value="<? echo $itemNo ?>"></td>
									<? }else { } ?>

								<?	}else { ?>
										<td>&nbsp;</td>
								<? } ?>
							<? } else { } ?>
							</tr>
						<? } ?>
					</tbody>

				</table>
				</div>
			</div>
			<div class="row">
				<div class="col-md-7 text-right">
					<input type="submit" id="discountBtn" class="btn btn-success" value="Add Discount">
				</div>
			</div>
		</div>
		<!--
		</form>
		-->
	</body>
</html>