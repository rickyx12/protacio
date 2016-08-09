<?
	include "../../myDatabase.php";
	include "../../myDatabase4.php";
	$invoiceNo = $_POST['invoiceNo'];
	$ro = new database();
	$ro4 = new database4();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
	</head>
	<body>
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Date</th>
					<th>Mode</th>
					<? if( $ro->selectNow("vouchers","paymentMode","invoiceNo",$invoiceNo) == "check" ) { ?>
						<th>Check#</th>
					<? }else { ?>
						<th>OR#</th>
					<? } ?>
					<th>Description</th>
					<th>Bank</th>
					<th>Vattable</th>
					<th>vat</th>
					<th>W/ Tax</th>
					<th>Amount</th>
					<th>User</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<?
							echo $ro4->formatDate($ro->selectNow("vouchers","date","invoiceNo",$invoiceNo))
						?>
					</td>
					<td>
						<?
							echo $ro->selectNow("vouchers","paymentMode","invoiceNo",$invoiceNo)
						?>
					</td>
					<? if( $ro->selectNow("vouchers","paymentMode","invoiceNo",$invoiceNo) == "check" ) { ?>
						<td>
							<?
								echo $ro->selectNow("vouchers","checkedNo","invoiceNo",$invoiceNo)
							?>
						</td>
					<? }else { ?>
						<td>
							<?
								echo $ro->selectNow("vouchers","orNo","invoiceNo",$invoiceNo)
							?>
						</td>
					<? } ?>
					<td>
						<?
							echo $ro->selectNow("vouchers","description","invoiceNo",$invoiceNo)
						?>
					</td>
					<td>
						<?
							echo $ro->selectNow("vouchers","bank","invoiceNo",$invoiceNo)
						?>
					</td>
					<td>
						<?
							$vattable = $ro->selectNow("vouchers","vattable","invoiceNo",$invoiceNo);
							( $vattable > 0 ) ? $x = number_format($vattable,2) : $x = "";
							echo $x;
						?>
					</td>
					<td>
						<?
							$vat = $ro->selectNow("vouchers","vat","invoiceNo",$invoiceNo);
							( $vat > 0 ) ? $x = number_format($vat,2) : $x = "";
							echo $x;
						?>
					</td>
					<td>
						<?
							$wtax = $ro->selectNow("vouchers","wtax","invoiceNo",$invoiceNo);
							( $wtax > 0 ) ? $x = number_format($wtax,2) : $x = "";
							echo $x;
						?>
					</td>
					<td>
						<?
							$amount = $ro->selectNow("vouchers","amount","invoiceNo",$invoiceNo);
							( $amount > 0 ) ? $x = number_format($amount,2) : $x = "";
							echo $x;
						?>
					</td>
					<td>
						<?
							echo $ro->selectNow("vouchers","user","invoiceNo",$invoiceNo)
						?>
					</td>
				</tr>
			</tbody>
		</table>
	</body>
</html>