<?
	//require_once "../authentication.php";
	include "../../myDatabase.php";
	include "../../myDatabase4.php";

	if( isset($_POST['fromDate']) ) {
		$fromDate = $_POST['fromDate'];
	}else {
		$fromDate = "";
	}

	if( isset($_POST['toDate']) ) {
		$toDate = $_POST['toDate'];
	}else {
		$toDate = "";
	}

	$totalPurchase = 0;

	$ro = new database();
	$ro4 = new database4();

	$ro4->view_purchases($fromDate,$toDate);

	$fromYear = substr($fromDate,0,4);
	$fromMonth = substr($fromDate,4,2);
	$fromDay = substr($fromDate,6,2);
	$formatFromDate = $fromYear."-".$fromMonth."-".$fromDay;

	$toYear = substr($toDate,0,4);
	$toMonth = substr($toDate,4,2);
	$toDay = substr($toDate,6,2);
	$formatToDate = $toYear."-".$toMonth."-".$toDay;					

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<script src="../js/jquery-2.1.4.min.js"></script>
		<script src="../js/jquery-ui.js"></script>
		<script src="../js/open.js"></script>
		<script src="../js/jquery.tooltipster.min.js"></script>
		<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
		<link rel="stylesheet" href="../myCSS/jquery-ui.css"></link>
		<link rel="stylesheet" href="../myCSS/tooltipster.css"></link> 
		<link rel="stylesheet" href="../myCSS/tooltipster-noir.css"></link>		

		<script>
			$(document).ready(function(){
				$(".date").datepicker({
					dateFormat:'yymmdd',
				});

				$("#purchasesBtn").click(function(){
					var fromDate = $("#from").val();
					var toDate = $("#to").val();

					var data = {
						fromDate:fromDate,
						toDate:toDate
					};
					open("POST","view-purchases.php",data,"_self");
				});

				<? if( $ro4->view_purchases_siNo() != "" ) { ?>
					<? foreach( $ro4->view_purchases_siNo() as $siNo ) { ?>
						$(".details<? echo $siNo ?>").tooltipster({
							content: $('<span>Loading....</span>'),
							position: 'right',
							theme: 'tooltipster-noir',
							contentAsHTML:true,
							functionBefore:function(origin,continueTooltip) {
								continueTooltip();
								if( origin.data('ajax') !== 'cached' ){ 
									$.ajax({
										type:'POST',
										url:'invoice-details.php',
										data:{'siNo':<? echo $siNo ?>},
										success:function(data) {
											origin.tooltipster('content',data).data('ajax','cached');
										}
									});
								}
							}									
						});					
					<? } ?>
				<? } ?>

			});
		</script>

	</head>
	<body>
		<div class="container">
			<h4>&nbsp;</h4>

			<div class="row">
				<div class="col-md-5">
					<div class="input-group">
						<span class="input-group-addon">From</span>
						<input type="text" id="from" name="from" class="form-control date" placeholder="Click Me">
						<span class="input-group-addon">To</span>
						<input type="text" id="to" name="to" class="form-control date" placeholder="Click Me">
						<span class="input-group-btn">
							<button id="purchasesBtn" class="btn btn-info">View Purchases</button>
						</span>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-7">
						<? if( $ro4->view_purchases_siNo() != "" ) { ?>
							<h5><? echo $ro4->formatDate($formatFromDate)." - ".$ro4->formatDate($formatToDate) ?></h5>
							<table class="table table-hover">
								<thead>
									<tr>
										<th>Date</th>
										<th>Invoice#</th>
										<th>Supplier</th>
										<th>Amount</th>
									</tr>
								</thead>
								<tbody>
									<? foreach( $ro4->view_purchases_siNo() as $siNo ) { ?>
										<tr>
											<td>
												<?
													$date = $ro->selectNow("salesInvoice","recievedDate","siNo",$siNo);
													$year = substr($date,0,4);
													$month = substr($date,4,2);
													$day = substr($date,6,2);
													$formatDate = $year."-".$month."-".$day;									
													echo $ro4->formatDate($formatDate);												
												?>
											</td>
											<td>
												<?
													echo $ro->selectNow("salesInvoice","invoiceNo","siNo",$siNo)
												?>
											</td>
											<td>
												<span class="details<? echo $siNo ?>">
													<?
														echo $ro->selectNow("supplier","supplierName","supplierCode",$ro->selectNow("salesInvoice","supplier","siNo",$siNo))
													?>
												</span>
											</td>
											<td>
												<?
													$x = $ro4->total_invoice($siNo);
													( $x > 0 ) ? $amount = number_format($x,2) : $amount = "";
													echo $amount;
													$totalPurchase += $x;
												?>
											</td>
										</tr>
									<? } ?>
								</tbody>
								<tfoot>
									<tr>
										<td><h4>Total</h4></td>
										<td></td>
										<td></td>
										<td><h4><? echo number_format($totalPurchase) ?></h4></td>
									</tr>
								</tfoot>
							</table>
						<? } ?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>