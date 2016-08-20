<?

	include "../../myDatabase.php";
	include "../../myDatabase4.php";

	$title = $_GET['title'];

	$ro = new database();
	$ro4 = new database4();

	$ro4->charges_list($title);

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
						var data='<table>'+$("#chargesList").html().replace(/<a\/?[^>]+>/gi, '')+'</table>';
						var reportName = '<? echo $title.' ['.$ro4->formatDate(date('Y-m-d')).']' ?>';	

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
			<h3><? echo $title ?></h3>
			<div class="col-md-8">
				<a href="#" id="export"><img src="../../export-to-excel/excel-icon.png"></a>
				<table id="chargesList" class="table table-hover">
					<thead>
						<tr>
							<th>Description</th>
							<th>OPD</th>
							<th>IPD</th>
							<th>HMO</th>
							<th>Spec.Rates</th>
							<th>Discount</th>
						</tr>
					</thead>
					<tbody>
						<? foreach( $ro4->charges_list_chargesCode()  as $chargesCode ) { ?>
							<tr>
								<td>
									<?
										echo $ro->selectNow("availableCharges","Description","chargesCode",$chargesCode)
									?>
								</td>
								<td>
									<?
										$opdPrice = $ro->selectNow("availableCharges","OPD","chargesCode",$chargesCode);
										($opdPrice > 0) ? $x = number_format($opdPrice,2) : $x = "";
										echo $x;
									?>
								</td>
								<td>
									<?
										$ipdPrice = $ro->selectNow("availableCharges","WARD","chargesCode",$chargesCode);
										($ipdPrice > 0) ? $x = number_format($ipdPrice,2) : $x = "";
										echo $x;
									?>
								</td>
								<td>
									<?
										$hmoPrice = $ro->selectNow("availableCharges","HMO","chargesCode",$chargesCode);
										($hmoPrice > 0) ? $x = number_format($hmoPrice,2) : $x = "";
										echo $x;
									?>
								</td>
								<td>
									<?
										$specialRates = $ro->selectNow("availableCharges","specialRates","chargesCode",$chargesCode);
										//($specialRates > 0) ? $x = number_format($specialRates,2) : $x = "";
										echo $specialRates;
									?>
								</td>
								<td>
									<?
										echo $ro->selectNow("availableCharges","senior","chargesCode",$chargesCode)
									?>
								</td>
							</tr>
						<? } ?>
					</tbody>
				</table>
			</div>
		</div>
	</body>
</html>