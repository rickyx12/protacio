<?

	include "../../myDatabase.php";
	include "../../myDatabase4.php";

	$ro = new database();
	$ro4 = new database4();

	if( isset($_POST['month']) ) {
		$month = $_POST['month'];
	}else {
		$month = date("m");
	} 

	if( isset($_POST['year']) ) {
		$year  = $_POST['year'];
	}else {
		$year = date("Y");
	}

	$monthWord = array(
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

	$from = $year."-".$month."-"."01";
	$to = $year."-".$month."-"."31";

	$ro4->list_laboratory_result($from,$to);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<script src="../js/jquery-2.1.4.min.js"></script>
		<script src="../js/open.js"></script>
		<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
		<script>
			$(document).ready(function(){

				<? if( $ro4->list_laboratory_result_savedNo() != "" ) { ?>
					<? foreach( $ro4->list_laboratory_result_savedNo() as $savedNo ) { ?>

						$("#result<? echo $savedNo ?>").click(function(){

							var data = {
								registrationNo:'<? echo $ro->selectNow('labSavedResult','registrationNo','savedNo',$savedNo) ?>',
								itemNo:'<? echo $ro->selectNow('labSavedResult','itemNo','savedNo',$savedNo) ?>'
							};

							open("GET","resultList/resultForm_output.php",data,"_blank");
						});

						$("#delete<? echo $savedNo ?>").click(function(){

							$.post('lab-result-list-delete.php',{savedNo:'<? echo $savedNo ?>'},function(){

								var data = {
									month:'<? echo $month ?>',
									year:'<? echo $year ?>'
								};

								open("POST","lab-result-list.php",data,"_self");
							});

						});


					<? } ?>
				<? } ?>

			});
		</script>
	</head>
	<body>
		<div class="container">
			<h2>Lab Result</h2>
			<form method="post" action="lab-result-list.php">
				<div class="row">
					<div class="col-md-2">
						<select name="month" class="form-control">
							<option value="<? echo $month ?>"><? echo $monthWord[$month] ?></option>
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
						<input type="text" name="year" class="form-control" value="<? echo date('Y') ?>">
					</div>
					<div class="col-md-2">
						<button type="submit" class="btn btn-success">
							Proceed
						</button>
					</div>
				</div>
			</form>
			<div class="row">
				<div class="col-md-8">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Patient</th>
								<th>Date</th>
								<th>Type</th>
								<th>Laboratory</th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<? if( $ro4->list_laboratory_result_savedNo() != "" ) { ?>
								<? foreach( $ro4->list_laboratory_result_savedNo() as $savedNo ) { ?>
									<tr>
										<td>
											<?
												$registrationNo = $ro->selectNow("labSavedResult","registrationNo","savedNo",$savedNo);
												$patientNo = $ro->selectNow("registrationDetails","patientNo","registrationNo",$registrationNo);
												$lastName = $ro->selectNow("patientRecord","lastName","patientNo",$patientNo);
												$firstName = $ro->selectNow("patientRecord","firstName","patientNo",$patientNo);
												echo strtoupper($lastName).", ".strtoupper($firstName);
											?>
										</td>
										<td>
											<?
												echo $ro4->formatDate($ro->selectNow("labSavedResult","date","savedNo",$savedNo));
											?>
										</td>
										<td>
											<?
												echo $ro->selectNow("registrationDetails","type","registrationNo",$registrationNo);
											?>
										</td>
										<td>
											<?
												$itemNo = $ro->selectNow("labSavedResult","itemNo","savedNo",$savedNo);
												echo $ro->selectNow("patientCharges","description","itemNo",$itemNo);
											?>
										</td>
										<td>
											<button id="result<? echo $savedNo ?>" type="button" class="btn btn-success col-xs">
												View Result
											</button>									
										</td>
										<td>
											<button id="delete<? echo $savedNo ?>" type="button" class="btn btn-danger col-xs">
												Delete Result
											</button>									
										</td>									
									</tr>
								<? } ?>
							<? } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>