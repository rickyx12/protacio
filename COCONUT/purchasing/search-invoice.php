<?
	include "../../myDatabase.php";
	include "../../myDatabase4.php";

	if( isset($_GET['invoiceNo']) ) {
		$invoiceNo = $_GET['invoiceNo'];
	}else {
		$invoiceNo = "avoidLike";
	}

	$ro = new database();
	$ro4 = new database4();

	$ro4->search_invoice($invoiceNo);

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<script src="../js/jquery-2.1.4.min.js"></script>
		<script src="../js/jquery.tooltipster.min.js"></script>
		<script src="../../bootstrap-3.3.6/js/bootstrap.min.js"></script>
		<script src="../js/open.js"></script>
		<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
		<link rel="stylesheet" href="../myCSS/tooltipster.css"></link> 
		<link rel="stylesheet" href="../myCSS/tooltipster-noir.css"></link>

		<script>
			$(document).ready(function(){

				<? if( $ro4->search_invoice_siNo() != "" ) { ?>
					<? foreach( $ro4->search_invoice_siNo() as $siNo ) { ?>
						<? $invoiceNo = $ro->selectNow("salesInvoice","invoiceNo","siNo",$siNo) ?>
						$(".details").tooltipster({
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

								var data = {
									"invoiceNo":'<? echo $invoiceNo ?>',
								};

								open("POST","search-invoice.php",data,"_self");
							});
						});


						$("#paid<? echo $invoiceNo ?>").tooltipster({
							content: $('<span>Loading....</span>'),
							position: 'left',
							theme: 'tooltipster-noir',
							contentAsHTML:true,	
							functionBefore:function(origin,continueTooltip) {
								continueTooltip();
								if( origin.data('ajax') !== 'cached' ){ 
									$.ajax({
										type:'POST',
										url:'payment-details.php',
										data:{invoiceNo:'<? echo $invoiceNo ?>'},
										success:function(data) {
											origin.tooltipster('content',data).data('ajax','cached');
										}
									});
								}
							}									
						});

					<? } ?>
				<? }else { } ?>

				$("#searchBtn").click(function(){
					var invoiceNo = $("#invoiceNo").val();
					window.location = "search-invoice.php?invoiceNo="+invoiceNo;
				});

				$("#invoiceNo").keypress(function(event){
					if(event.which == 13) {
						var invoiceNo = $("#invoiceNo").val();
						window.location = "search-invoice.php?invoiceNo="+invoiceNo;						
					}
				});

			});
		</script>

	</head>
	<body>
		<div class="container">
			<h6>&nbsp;</h6>
			<div class="row">
				<div class="col-md-2">
					<input type="text" id="invoiceNo" class="form-control" placeholder="Enter Invoice#" autocomplete="off">
				</div>
				<div class="col-md-1">
					<input type="button" id="searchBtn" class="btn btn-success" value="Search">
				</div>
			</div>

			<div class="row">
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
							<? if( $ro4->search_invoice_siNo() != "" ) { ?>
								<? foreach( $ro4->search_invoice_siNo() as $siNo ) { ?>
									<tr>
										<td>
											<span class="details">
												<?
													echo $ro->selectNow("salesInvoice","invoiceNo","siNo",$siNo)
												?>
											</span>
										</td>
										<td>
											<span class="details">
												<?
													echo $ro->selectNow("supplier","supplierName","supplierCode",$ro->selectNow("salesInvoice","supplier","siNo",$siNo))
												?>
											</span>
										</td>
										<td>
											<?
												( $ro4->total_invoice($siNo) > 0 ) ? $x = number_format($ro4->total_invoice($siNo),2) : $x = "";
												echo $x;
											?>
										</td>
										<td>
											<?
												echo $ro->selectNow("salesInvoice","terms","siNo",$siNo)
											?>
										</td>
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
												echo $ro->selectNow("salesInvoice","encodedBy","siNo",$siNo)
											?>
										</td>
										<? if( $ro->selectNow("vouchers","controlNo","invoiceNo",$invoiceNo) != "" ) { ?>
											<td>
												<span id="paid<? echo $invoiceNo ?>" class="label label-success">
													PAID
												</span>
											</td>
										<? }else { ?>
											<td>
												<button id="remove<? echo $siNo ?>" class="btn btn-danger" data-toggle="modal" data-target="#removeModal<? echo $siNo ?>">
													Remove
												</button>
											</td>
										<? } ?>
									</tr>
								<? } ?>
							<? }else { } ?>
						</tbody>
					</table>
					<? if( $ro4->search_invoice_siNo() != "" ) { ?>
						<? foreach( $ro4->search_invoice_siNo() as $siNo ) { ?>
							<div id="removeModal<? echo $siNo ?>" class="modal fade" role="dialog">
								<div class="modal-dialog">

									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title">Remove</h4>
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
					<? } ?>				
				</div>
			</div>
		</div>
	</body>
</html>