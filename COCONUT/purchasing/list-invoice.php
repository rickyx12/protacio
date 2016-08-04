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

	$from = $year.$month."01";
	$to = $year.$month."31";

	$ro4->list_invoice($from,$to);

?>
<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
	<title></title>
	<script src="../js/jquery-2.1.4.min.js"></script>
	<script src="../js/jquery.tooltipster.min.js"></script>
	<script src="../../bootstrap-3.3.6/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
	<link rel="stylesheet" href="../myCSS/tooltipster.css"></link> 
	<link rel="stylesheet" href="../myCSS/tooltipster-noir.css"></link>

	<script>
		$(document).ready(function(){

			<? foreach( $ro4->list_invoice_siNo() as $siNo ) { ?>

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

				$("#removeBtn<? echo $siNo ?>").click(function(){
					$.post("delete-invoice.php",{ siNo:<? echo $siNo ?> },function(){
						location.reload();
					});
				});

			<? } ?>


		});		
	</script>

	</head>
	<body>
		<div class="container">
			<h2>Invoice list</h2>
				<form method="post" action="list-invoice.php">
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
							<th>Invoice#</th>
							<th>Supplier</th>
							<th>Amount</th>
							<th>Terms</th>
							<th>Date</th>
							<th>User</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<? foreach( $ro4->list_invoice_siNo() as $siNo ) { ?>
							<tr>
								<td>
									<span class="details<? echo $siNo ?>">
										<? 
											$invoiceNo = $ro->selectNow("salesInvoice","invoiceNo","siNo",$siNo);
											echo $invoiceNo;
										?>
									</span>
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
										( $ro4->total_invoice($siNo) > 0 ) ? $x = number_format($ro4->total_invoice($siNo),2) : $x = "";
										echo $x;
										$totalInvoice += $ro4->total_invoice($siNo);
									 ?>
								</td>
								<td>
									<?
										echo $ro->selectNow("salesInvoice","terms","siNo",$siNo)
									?>
								</td>
								<td>
									<?
										$date = $ro->selectNow("salesInvoice","dateEncoded","siNo",$siNo);
										$year = substr($date,0,4);
										$month = substr($date,4,2);
										$day = substr($date,6,2);
										$formatDate = $year."-".$month."-".$day;									
										echo $ro4->formatDate($formatDate);
									?>
								</td>
								<td>
									<?
										echo $ro->selectNow("salesInvoice","encodedBy","siNo",$siNo)
									?>
								</td>
								<td>
									<input type="button" class="btn btn-danger" data-toggle="modal" data-target="#removeModal<? echo $siNo ?>" value="Remove">
								</td>
							</tr>	
						<? } ?>
					</tbody>
					<tfoot>
						<tr>
							<td><h5>Total</h5></td>
							<td></td>
							<td><? echo number_format($totalInvoice) ?></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					</tfoot>
				</table>
					<? foreach( $ro4->list_invoice_siNo() as $siNo ) { ?>
						<div id="removeModal<? echo $siNo ?>" class="modal fade" role="dialog">
							<div class="modal-dialog">

								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title">Header</h4>
									</div>
									<div class="modal-body">
										Remove Invoice <? echo $invoiceNo ?> ?
									</div>
									<div class="modal-footer">
										<button class="btn btn-success" data-dismiss="modal">Cancel Remove</button>
										<button id="removeBtn<? echo $siNo ?>" class="btn btn-danger" data-dismiss="modal">Confirm Remove</button>
									</div>
								</div>

							</div>
						</div>	
					<? } ?>
			</div>
		</div>
	</body>
</html>
