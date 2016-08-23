<?
include "../../myDatabase.php";
include "../../myDatabase4.php";

$ro = new database();
$ro4 = new database4();

$ro = new database();
$ro4 = new database4();

$ro4->inventory_list("medicine");

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<script src='../js/jquery-2.1.4.min.js'></script>
		<script src='../js/table2excel/dist/jquery.table2excel.min.js'></script>
		<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
		<script>
			$(document).ready(function(){

				var isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);
				console.log(isChrome);

				if( isChrome == true ) {
					$("#export").click(function() {
						
						var data='<table>'+$("#medicine").html().replace(/<a\/?[^>]+>/gi, '')+'</table>';
						var reportName = '<? echo 'Medicine Cost ['.$ro4->formatDate(date('Y-m-d')).']' ?>';

						/*
						$('body').prepend("<form method='post' action='../../export-to-excel/exporttoexcel.php' style='display:none' id='ReportTableData'><input type='text' name='tableData' value='"+data+"' ><input type='text' name='reportName' value='"+reportName+"'></form>");
						*/

						$('body').prepend("<form method='post' action='../../export-to-excel/exporttoexcel.php' style='display:none' id='ReportTableData'><textarea name='tableData'>"+data+"</textarea><input type='text' name='reportName' value='"+reportName+"'></form>");

						 $('#ReportTableData').submit().remove();
						 return false;	
						 

						 /*
						$("#medicine").table2excel({
						    name: "Medicine",
						    filename: "Medicine [<? echo $ro4->formatDate(date('Y-m-d')) ?>]" //do not include extension
						});
						*/
					});
				}else {
					$("#export").hide();
					$("#msg").text("Exporting available only on Google Chrome");
				}
			});
		</script>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<h3>Medicine Cost</h3>
				<a href="#" id="export" ><img src="../../export-to-excel/excel-icon.png"></a>
				<i id='msg'></i>
			</div>
			<div class="row">
				<div class="col-md-6">
					<table id='medicine' class="table table-hover">
						<thead>
							<tr>
								<th>Generic</th>
								<th>Brand</th>
								<th>Unitcost</th>
								<th>OPD</th>
								<th>IPD</th>
							</tr>
						</thead>
						<tbody>
							<? foreach( $ro4->inventory_list_inventoryCode() as $inventoryCode ) { ?>
								<tr>
									<td>
										<?
											echo $ro->selectNow("inventory","genericName","inventoryCode",$inventoryCode)
										?>
									</td>
									<td>
										<?
											echo $ro->selectNow("inventory","description","inventoryCode",$inventoryCode)
										?>
									</td>
									<td>
										<?
											$unitcost = $ro->selectNow("inventory","unitcost","inventoryCode",$inventoryCode);
											($unitcost != '') ? $x = number_format($unitcost,2) : $x = '';
											echo $x;
										?>
									</td>
									<td>
										<?
											$opd = $ro->selectNow("inventory","opdPrice","inventoryCode",$inventoryCode);
											($opd != '') ? $x = number_format($opd,2) : $x = '';
											echo $x;
										?>
									</td>
									<td>
										<?
											$ipd = $ro->selectNow("inventory","ipdPrice","inventoryCode",$inventoryCode);
											($ipd != '') ? $x = number_format($ipd,2) : $x = '';
											echo $x;
										?>
									</td>
								</tr>
							<? } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>

