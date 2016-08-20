<?

	include "../../myDatabase.php";
	include "../../myDatabase4.php";

	$date1 = $_POST['date1'];
	$date2 = $_POST['date2'];

	$ro = new database();
	$ro4 = new database4();

	$vattableTotal = 0;
	$vatTotal = 0;
	$wtaxTotal = 0;
	$paidTotal = 0;

	$ro4->paid_invoices($date1,$date2,"cash");

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<script src="../js/jquery-2.1.4.min.js"></script>
		<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
		<script>
			$(document).ready(function(){

				var isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);

				if( isChrome == true ) {
					$("#export").click(function(){
						var data='<table>'+$("#paidInvoice").html().replace(/<a\/?[^>]+>/gi, '')+'</table>';
						var reportName = '<? echo 'Cash Paid Invoice  ['.$ro4->formatDate($date1).' to '.$ro4->formatDate($date2).']' ?>';	

						$('body').prepend("<form method='post' action='../../export-to-excel/exporttoexcel.php' style='display:none' id='ReportTableData'><input type='text' name='tableData' value='"+data+"' ><input type='text' name='reportName' value='"+reportName+"'></form>");
						$('#ReportTableData').submit().remove();
						return false;	
					
					});
				}else {
					$("#export").hide();
				}	
			});
		</script>		
	</head>
	<body>
		<div class="container">
			<h3>Paid Invoice</h3>	
			<h5>
				<?
					echo $ro4->formatDate($date1)." to ".$ro4->formatDate($date2)
				?>
			</h5>
			<div class="col-md-12">
				<a href="#" id="export"><img src="../../export-to-excel/excel-icon.png"></a>
				<table id="paidInvoice" class="table table-hover">
					<thead>
						<tr>
							<th>Date</th>
							<th>Invoice</th>
							<th>Payee</th>
							<th>OR#</th>
							<th>Vattable</th>
							<th>Vat</th>
							<th>W/ Tax</th>
							<th>Paid</th>
						</tr>
					</thead>
					<tbody>
						<? foreach( $ro4->paid_invoices_controlNo() as $controlNo ) { ?>
							<tr>
								<td>
									<?
										echo $ro4->formatDate($ro->selectNow("vouchers","datePaid","controlNo",$controlNo))
									?>
								</td>
								<td>
									<?
										echo $ro->selectNow("vouchers","invoiceNo","controlNo",$controlNo)
									?>
								</td>
								<td>
									<?
										echo $ro->selectNow("vouchers","payee","controlNo",$controlNo)
									?>
								</td>
								<td>
									<?
										echo $ro->selectNow("vouchers","orNo","controlNo",$controlNo)
									?>
								</td>
								<td>
									<?
										$vattable = $ro->selectNow("vouchers","vattable","controlNo",$controlNo);
										$vattableTotal += $vattable;
										($vattable > 0) ? $x = number_format($vattable,2) : $x;
										echo $x;
									?>
								</td>
								<td>
									<?
										$vat = $ro->selectNow("vouchers","vat","controlNo",$controlNo);
										$vatTotal += $vat;
										($vat > 0) ? $x = number_format($vat,2) : $x = "";
										echo $x;
									?>
								</td>
								<td>
									<?
										$wtax = $ro->selectNow("vouchers","wtax","controlNo",$controlNo);
										$wtaxTotal += $wtax;
										($wtax > 0) ? $x = number_format($wtax,2) : $x = "";
										echo $x;
									?>
								</td>
								<td>
									<?
										$paid = $ro->selectNow("vouchers","amount","controlNo",$controlNo);
										$paidTotal += $paid;
										($paid > 0) ? $x = number_format($paid,2) : $x = "";
										echo $x;
									?>
								</td>
							</tr>
						<? } ?>
					</tbody>
					<tfoot>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td>
								<?
									echo number_format($vattableTotal,2)
								?>
							</td>
							<td>
								<?
									echo number_format($vatTotal,2)
								?>
							</td>
							<td>
								<?
									echo number_format($wtaxTotal,2)
								?>
							</td>
							<td>
								<?
									echo number_format($paidTotal,2)
								?>
							</td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</body>
</html>