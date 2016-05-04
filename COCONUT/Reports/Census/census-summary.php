<? include "../../../myDatabase4.php" ?>
<? $ro4 = new database4() ?>

<?
	if(isset($_POST['date'])) {
		$date = $_POST['date'];
	}else {
		$date = date("M-Y");
	}
?>

<?

	$date1 = preg_split ("/\-/", $date); 
	if($date1[0] == "Jan") {
		$month = "01";
	}else if( $date1[0] == "Feb" ) {
		$month = "02";
	}else if( $date1[0] == "Mar" ) {
		$month = "03";
	}else if( $date1[0] == "Apr" ) {
		$month = "04";
	}else if( $date1[0] == "May" ) {
		$month = "05";
	}else if( $date1[0] == "Jun" ) {
		$month = "06";
	}else if( $date1[0] == "Jul" ) {
		$month = "07";
	}else if( $date1[0] == "Aug" ) {
		$month = "08";
	}else if( $date1[0] == "Sep" ) {
		$month = "09";
	}else if( $date1[0] == "Oct" ) {
		$month = "10";
	}else if( $date1[0] == "Nov" ) {
		$month = "11";
	}else if( $date1[0] == "Dec" ) {
		$month = "12";
	}else {
		$month = "0";
	}

	$year = $date1[1];

?>

<? //$month = "04" ?>
<? //$year = "2016" ?>
<? $totalOPD = 0 ?>
<? $totalIPD = 0 ?>
<!doctype html>
<html>
	<head>
	<title>Census Summary</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="../../../jquery-2.1.4.min.js"></script>
	<link rel="stylesheet" href="../../../bootstrap-3.3.6/css/bootstrap.css"></link>
	<script src="../../../bootstrap-3.3.6/js/bootstrap.js"></script>		
	</head>
	<body>
		<div class="container">
			<h3>Census Summary</h3>

			<div class="row">
				<form method="post" action="<? echo $_SERVER['PHP_SELF'] ?>">
					<div class="col-md-2">
						<input type="text" class="form-control" name="date" value="<? echo $date ?>">	
					</div>
				</form>			
			</div>

			<div class="col-md-3">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Date</th>
							<th>Patients</th>
						</tr>
					</thead>
					<tbody>
						
						<? for( $x=1;$x<=31;$x++ ) { ?>
							<tr>
								<td><? echo $ro4->formatDate($year."-".$month."-".$x) ?></td>

								<? if($x < 10) { ?>

									<? $totalOPD += $ro4->get_last_register($year."-".$month."-"."0".$x) ?>
									<td><? echo $ro4->get_last_register($year."-".$month."-"."0".$x) ?></td>
								
								<? }else { ?>
								
									<? $totalOPD += $ro4->get_last_register($year."-".$month."-".$x) ?>
									<td><? echo $ro4->get_last_register($year."-".$month."-".$x) ?></td>
								
								<? } ?>

							</tr>
						<? } ?>
						<tr>
							<td>Patients</td>
							<td><? echo $totalOPD ?></td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="col-md-3">
				
			</div>

			<div class="col-md-3">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Date</th>
							<th>Admitted</th>
						</tr>
					</thead>
					<tbody>
						<? for( $x=1;$x<=31;$x++ ) { ?>
							<tr>
								<td><? echo $ro4->formatDate($year."-".$month."-".$x) ?></td>
								<? if( $x < 10 ) { ?>
									<? $totalIPD += $ro4->get_ipd_census($year."-".$month."-"."0".$x) ?>
									<td><? echo $ro4->get_ipd_census($year."-".$month."-"."0".$x) ?></td>
								<? }else { ?>
									<? $totalIPD += $ro4->get_ipd_census($year."-".$month."-".$x) ?>
									<td><? echo $ro4->get_ipd_census($year."-".$month."-".$x) ?></td>
								<? } ?>	
							</tr>
						<? } ?>
						<tr>
							<td>Patients</td>
							<td><? echo $totalIPD ?></td>
						</tr>
					</tbody>
				</table>
			</div>

		</div>
	</body>
</html>