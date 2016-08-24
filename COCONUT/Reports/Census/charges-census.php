<?
	include "../../../myDatabase.php";
	include "../../../myDatabase4.php";

	$date1 = $_POST['date1'];
	$date2 = $_POST['date2'];
	$title = $_POST['title'];

	$ro = new database();
	$ro4 = new database4();

	$ro4->list_charges($title,$date1,$date2);

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<script src="../../js/jquery-2.1.4.min.js"></script>
		<script src="../../js/jquery-ui.min.js"></script>
		<script src="../../js/jquery.tooltipster.min.js"></script>
		<link rel="stylesheet" href="../../../bootstrap-3.3.6/css/bootstrap.min.css"></link>
		<link rel="stylesheet" href="../../myCSS/tooltipster.css"></link>
		<link rel="stylesheet" href="../../myCSS/tooltipster-noir.css"></link>

		<script>
			$(document).ready(function(){

				<? foreach( $ro4->list_charges_chargesCode() as $chargesCode ) { ?>
					$("#charges<? echo $chargesCode ?>").mouseover(function(){

						var data = {
							chargesCode:'<? echo $chargesCode ?>',
							date1:'<? echo $date1 ?>',
							date2:'<? echo $date2 ?>'
						};

						$("#opd<? echo $chargesCode ?>").html("<p>Calculating..</p>");
						$("#ipd<? echo $chargesCode ?>").html("<p>Calculating..</p>");

						$.post("charges-census-count-opd.php",data,function(result){
							$("#opd<? echo $chargesCode ?>").html(result);
							$("#opd<? echo $chargesCode ?>").removeAttr("id");
						});

						$.post("charges-census-count-ipd.php",data,function(result){
							$("#ipd<? echo $chargesCode ?>").html(result);
							$("#ipd<? echo $chargesCode ?>").removeAttr("id");
						});


					});


					$("#opd<? echo $chargesCode ?>").tooltipster({
						content: $('<span>Loading....</span>'),
						position: 'right',
						theme: 'tooltipster-noir',
						contentAsHTML:true,
						functionBefore:function(origin,continueTooltip) {
							continueTooltip();
							if( origin.data('ajax') !== 'cached' ){ 
								$.ajax({
									type:'POST',
									url:'charges-census-details-opd.php',
									data:{chargesCode:'<? echo $chargesCode ?>',date1:'<? echo $date1 ?>',date2:'<? echo $date2 ?>'},
									success:function(data) {
										origin.tooltipster('content',data).data('ajax','cached');
									}
								});
							}
						}									
					});

					$("#ipd<? echo $chargesCode ?>").tooltipster({
						content: $('<span>Loading....</span>'),
						position: 'right',
						theme: 'tooltipster-noir',
						contentAsHTML:true,
						functionBefore:function(origin,continueTooltip) {
							continueTooltip();
							if( origin.data('ajax') !== 'cached' ){ 
								$.ajax({
									type:'POST',
									url:'charges-census-details-ipd.php',
									data:{chargesCode:'<? echo $chargesCode ?>',date1:'<? echo $date1 ?>',date2:'<? echo $date2 ?>'},
									success:function(data) {
										origin.tooltipster('content',data).data('ajax','cached');
									}
								});
							}
						}									
					});


				<? } ?>

				var isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);
				console.log(isChrome);

				if( isChrome == true ) {
					$("#export").click(function() {
						
						var data='<table>'+$("#charges").html().replace(/<a\/?[^>]+>/gi, '')+'</table>';
						var reportName = '<? echo $title.' Census ['.$ro4->formatDate($date1).' - '.$ro4->formatDate($date2).']' ?>';

						$('body').prepend("<form method='post' action='../../../export-to-excel/exporttoexcel.php' style='display:none' id='ReportTableData'><textarea name='tableData'>"+data+"</textarea><input type='text' name='reportName' value='"+reportName+"'></form>");

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
			<h3>Charges Census</h3>
			<h5>Per Examination<a href="#" id="export"><img src="../../../export-to-excel/excel-icon.png"></a></h5>
			<h5><? echo $ro4->formatDate($date1)." - ".$ro4->formatDate($date2) ?></h5>
			<div class="col-md-6">
				<table id="charges" class="table table-hover">
					<thead>
						<tr>
							<th>Description</th>
							<th>Outpatient</th>
							<th>Inpatient</th>
						</tr>
					</thead>
					<tbody>
						<? if( $ro4->list_charges_chargesCode() != "" ) { ?>
							<? foreach( $ro4->list_charges_chargesCode() as $chargesCode ) { ?>
								<tr>
									<td>
										<span id="charges<? echo $chargesCode ?>">
											<?
												echo strtoupper($ro->selectNow("availableCharges","Description","chargesCode",$chargesCode))
											?>
										</span>
									</td>
									<td>
										<span id="opd<? echo $chargesCode ?>">
											
										</span>
									</td>
									<td>
										<span id="ipd<? echo $chargesCode ?>">
											
										</span>
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