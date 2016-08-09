<? 
	require_once "../authentication.php";
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

	$totalInvoice = 0;

	$from = $year."-".$month."-"."01";
	$to = $year."-".$month."-"."31";

	$ro4->list_retail($from,$to);

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
	</head>
	<body>
		<div class="container">
			<h2>Retail List</h2>
				<form method="post" action="view-retail.php">
					<div class="col-md-2">
						<select class="form-control" name="month">
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
						<input type="text" name="year" class="form-control" value="<? echo $year ?>">
					</div>
					<div class="col-md-1">
						<input type="submit" class="btn btn-info" value="Proceed">
					</div>
				</form>
				<div class="col-md-10">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>OR#</th>
								<th>Particulars</th>
								<th>QTY</th>
								<th>Amount</th>
								<th>Supplier</th>
								<th>User</th>
								<th>Date</th>
							</tr>
						</thead>
						<tbody>
							<? if( $ro4->list_retail_inventoryCode() != "" ) { ?>
								<? foreach( $ro4->list_retail_inventoryCode() as $inventoryCode ) { ?>
									<tr>
										<td>
											<?
												echo $ro->selectNow("inventory","retail","inventoryCode",$inventoryCode)
											?>
										</td>
										<td>
											<? if( $ro->selectNow("inventory","inventoryType","inventoryCode",$inventoryCode) == "medicine" ) { ?>
											<?
												echo $ro->selectNow("inventory","genericName","inventoryCode",$inventoryCode)
											?>
											<h6>
												<?
													echo $ro->selectNow("inventory","description","inventoryCode",$inventoryCode)
												?>
											</h6>
											<? }else { ?>
												<?
													echo $ro->selectNow("inventory","description","inventoryCode",$inventoryCode)
												?>
											<? } ?>
										</td>
										<td>
											<?
												echo $ro->selectNow("inventory","quantity","inventoryCode",$inventoryCode)
											?>
										</td>
										<td>
											<?
												if( $ro->selectNow("inventory","inventoryType","inventoryCode",$inventoryCode) == "medicine" ) {
													echo $ro->selectNow("inventory","unitcost","inventoryCode",$inventoryCode);
												}else {
													echo $ro->selectNow("inventory","suppliesUNITCOST","inventoryCode",$inventoryCode);
												}
											?>
										</td>
										<td>
											<?
												echo $ro->selectNow("inventory","supplier","inventoryCode",$inventoryCode)
											?>
										</td>
										<td>
											<?
												echo $ro->selectNow("inventory","addedBy","inventoryCode",$inventoryCode)
											?>
										</td>
										<td>
											<?
												echo $ro4->formatDate($ro->selectNow("inventory","dateAdded","inventoryCode",$inventoryCode))
											?>
										</td>
									</tr>
								<? } ?>
							<? } ?>
						</tbody>
					</table>
				</div>			
		</div>
	</body>
</html>