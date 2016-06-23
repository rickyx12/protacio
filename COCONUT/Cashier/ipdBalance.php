<? require_once "../authentication.php" ?>
<? include "../../myDatabase.php" ?>
<? include "../../myDatabase4.php" ?>

<? 
	
	if( isset($_POST['month']) ) {
		$month = $_POST['month'];
	}else {
		$month = date("m");
	}
	
?>


<?

	if( isset($_POST['year']) ) {
		$year = $_POST['year'];
	}else {	
		$year = date("Y");
	}

?>

<?

	$wordMonth = array(

		"01" => "January",
		"02" => "February",
		"03" => "March",
		"04" => "April",
		"05" => "May",
		"06" => "June",
		"07" => "July",
		"08" => "August",
		"09" => "September",
		"10" => "October",
		"11" => "November",
		"12" => "December"
	);

?>

<? $ro = new database() ?>
<? $ro4 = new database4() ?>

<? $balanceTotal = 0 ?>

<? $ro4->inpatient_discharged($year."-".$month."-01",$year."-".$month."-31") ?>

<!DOCTYPE html>
	<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="../../jquery-2.1.4.min.js"></script>
		<script src="../js/jquery-ui.min.js"></script>		
		<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
		<script src="../../bootstrap-3.3.6/js/bootstrap.js"></script>
		<link rel="stylesheet" href="../js/jquery-ui.css"></link>
		<link rel="stylesheet" href="../js/jquery-ui.theme.min.css"></link>	

		<script>
			$(document).ready(function(){
				
				<? foreach($ro4->inpatient_discharged_registrationNo() as $registrationNo) { ?>
					$("#paidBtn<? echo $registrationNo ?>").click(function(){

						var registrationNo = $("#registrationNo<? echo $registrationNo ?>").val();
						var paymentFor = $("#paymentFor<? echo $registrationNo ?>").val();
						var paidVia = $("#paidVia<? echo $registrationNo ?>").val();
						var or = $("#or<? echo $registrationNo ?>").val();
						var amount = $("#amount<? echo $registrationNo ?>").val();
						var date = $("#date<? echo $registrationNo ?>").val();
						var shift = $("#shift<? echo $registrationNo ?>").val();

						var myData = {
							"registrationNo":registrationNo,
							"paymentFor":paymentFor,
							"paidVia":paidVia,
							"or":or,
							"amount":amount,
							"date":date,
							"shift":shift
						};

						$.post("ipdBalance1.php",myData,function(data){
							$("#balanceTable").load("ipdBalance.php #balanceTable");
							//console.log(data);
						});

					});

					$("#date<? echo $registrationNo ?>").datepicker({
						dateFormat:'yy-mm-dd'
					});

				<? } ?>

			});
		</script>

	</head>
	<body>
		<div class="container">
			<h3>Inpatient with Balance</h3>
			<form method="post" action="<? $_SERVER['PHP_SELF'] ?>">
				<div class="row">
					<div class="col-md-2">
						<select name="month" class="form-control">
							<option value="<? echo $month ?>"><? echo $wordMonth[$month] ?></option>
							<option value="01">January</option>
							<option value="02">February</option>
							<option value="03">March</option>
							<option value="04">April</option>
							<option value="05">May</option>
							<option value="06">June</option>
							<option value="07">July</option>
							<option value="08">August</option>
							<option value="09">September</option>
							<option value="10">October</option>
							<option value="11">November</option>
							<option value="12">December</option>
						</select>
					</div>
					<div class="col-md-1">
						<input type="text" name="year" class="form-control" value="<? echo date("Y") ?>">
					</div>

					<div class="col-md-1">
						<input type="submit" class="btn btn-info" value="Proceed >>">
					</div>

				</div>
			</form>
			<div class="col-md-7">
				<table id="balanceTable" class="table table-hover">
					<thead>
						<tr>
							<th>Reg#</th>
							<th>Discharged</th>
							<th>Patient</th>
							<th>Balance</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<? foreach( $ro4->inpatient_discharged_registrationNo() as $registrationNo ) { ?>
						<?
							//get balance px
							$unpaid = round( 
								$ro4->inpatient_paymentMode_total_charges($registrationNo,"cashUnpaid") + 
								$ro4->inpatient_paymentMode_total_inventory($registrationNo,"cashUnpaid") + 
								$ro4->inpatient_paymentMode_total_inventory_takeHomeMeds($registrationNo,"cashUnpaid") + $ro->selectNow("registrationDetails","hmoManualExcessValue","registrationNo",$registrationNo) + 
								$ro->selectNow("registrationDetails","PHICportion","registrationNo",$registrationNo) + $ro->selectNow("registrationDetails","excessMaxBenefits","registrationNo",$registrationNo) + 
								$ro->selectNow("registrationDetails","excessRoom","registrationNo",$registrationNo) + 
								$ro->selectNow("registrationDetails","excessPF","registrationNo",$registrationNo),2 
							); 										

							$cash = ($ro4->inpatient_payment_total($registrationNo,"Cash"));
							$balPaid = $ro4->inpatient_balancePayment_total($registrationNo,"Cash");
							$creditCard = $ro4->inpatient_payment_total($registrationNo,"Credit Card");
							$disc = round($ro->selectNow("registrationDetails","discount","registrationNo",$registrationNo),2);

							$totalPaid = ( $cash + $balPaid + $creditCard + $disc );
							$bal = ($unpaid - $totalPaid);

						?>

							<? if( $bal > 0 ) { ?>
							<tr>
								<td><? echo $registrationNo ?></td>
								<td>
									<?
										echo $ro4->formatDate($ro->selectNow("registrationDetails","dateUnregistered","registrationNo",$registrationNo));
									?>
								</td>
								<td>
									<?
										$patientNo = $ro->selectNow("registrationDetails","patientNo","registrationNo",$registrationNo);
										$lastName = $ro->selectNow("patientRecord","lastName","patientNo",$patientNo);
										$firstName = $ro->selectNow("patientRecord","firstName","patientNo",$patientNo);

										echo strtoupper($lastName).", ".strtoupper($firstName);

									?>
								</td>
								<td>
									<? 
										echo number_format(round($bal,2),2); 
										$balanceTotal += round($bal);
									?>
								</td>
								<td>
									<input type="submit" class="btn btn-success" data-toggle="modal" data-target="#myModal<? echo $registrationNo ?>" value="Paid Balance">
								</td>
							</tr>	
								<!-- Modal -->
								<div id="myModal<? echo $registrationNo ?>" class="modal fade" role="dialog">
								  <div class="modal-dialog">

								    <!-- Modal content-->
								    <div class="modal-content">
								      <div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal">&times;</button>
								        <h4 class="modal-title"><? echo $lastName.", ".$firstName ?></h4>
								      </div>
								      <div class="modal-body">
								      	<div class="container">
									      	<form>
									      		<input type="hidden" id="registrationNo<? echo $registrationNo ?>" value="<? echo $registrationNo ?>">
									      		<div class="row">
										      		<div class="col-md-12">
											      		<label class="form-label col-sm-1">Payment</label>
											      		<div class="col-md-3">
											      			<select id="paymentFor<? echo $registrationNo ?>" class="form-control">
											      				<option>BALANCE PAID</option>
											      			</select>
											      		</div>
										      		</div>
									      		</div>

									      		<div class="row">
										      		<div class="col-md-12">
										      			<label class="form-label col-sm-1">Paid Via</label>
										      			<div class="col-md-3">
										      				<select id="paidVia<? echo $registrationNo ?>" class="form-control">
										      					<option>Cash</option>
										      					<option>Credit Card</option>
										      				</select>
										      			</div>
										      		</div>
									      		</div>

									      		<div class="row">
									      			<div class="col-md-12">
									      				<label class="form-label col-sm-1">OR#</label>
									      				<div class="col-md-2">
									      					<input type="text" id="or<? echo $registrationNo ?>" class="form-control" class="col-md-2">
									      				</div>
									      			</div>
									      		</div>

									      		<div class="row">
									      			<div class="col-md-12">
									      				<label class="form-label col-sm-1">Amount</label>
									      				<div class="col-md-2">
									      					<input type="text" id="amount<? echo $registrationNo ?>" class="form-control" class="col-md-2">
									      				</div>
									      			</div>
									      		</div>

									      		<div class="row">
									      			<div class="col-md-12">
									      				<label class="form-label col-sm-1">Date</label>
									      				<div class="col-md-2">
									      					<input type="text" id="date<? echo $registrationNo ?>" class="form-control" class="col-md-2" value="<? echo date("Y-m-d") ?>" readonly>
									      				</div>
									      			</div>
									      		</div>	

									      		<div class="row">
										      		<div class="col-md-12">
										      			<label class="form-label col-sm-1">Shift</label>
										      			<div class="col-md-3">
										      				<select id="shift<? echo $registrationNo ?>" class="form-control">
										      					<option>Morning</option>
										      					<option>Noon</option>
										      					<option>Afternoon</option>
										      					<option>Night</option>
										      				</select>
										      			</div>
										      		</div>
									      		</div>

									      	</form>
								      	</div>
								      </div>
								      <div class="modal-footer">
								      	<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
								        <button type="button" id="paidBtn<? echo $registrationNo ?>" class="btn btn-success" data-dismiss="modal">Payment</button>
								      </div>
								    </div>

								  </div>
								</div>
							<? } ?>
						<? } ?>
					</tbody>
					<tfoot>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td><? echo number_format($balanceTotal,2) ?></td>
							<td></td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</body>
</html>