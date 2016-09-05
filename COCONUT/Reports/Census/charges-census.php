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
							chargesCode:<? echo $chargesCode ?>,
							date1:'<? echo $date1 ?>',
							date2:'<? echo $date2 ?>'
						};

						$("#opdCensus<? echo $chargesCode ?>").html("<p>Calculating..</p>");
						$("#opdAmount<? echo $chargesCode ?>").html("<p>Calculating..</p>");


						$("#hmoCensus<? echo $chargesCode ?>").html("<p>Waiting OPD</p>");
						$("#hmoAmount<? echo $chargesCode ?>").html("<p>Waiting OPD</p>");

						$("#specialRates_opdCensus<? echo $chargesCode ?>").html("<p>Waiting HMO</p>");
						$("#specialRates_opdAmount<? echo $chargesCode ?>").html("<p>Waiting HMO</p>");


						$("#ipdCensus<? echo $chargesCode ?>").html("<p>Waiting Spec.Rates</p>");
						$("#ipdAmount<? echo $chargesCode ?>").html("<p>Waiting Spec.Rates</p>");


						$("#specialRates_ipdCensus<? echo $chargesCode ?>").html("<p>Waiting IPD</p>");
						$("#specialRates_ipdAmount<? echo $chargesCode ?>").html("<p>Waiting IPD</p>");


						$("#totalCensus<? echo $chargesCode ?>").html("<p>Waiting All</p>");
						$("#totalAmount<? echo $chargesCode ?>").html("<p>Waiting All</p>");

						$.post("charges-census-count-opd.php",data,function(result){
							var opdResult = result;
							var opdData = opdResult.split("-");

							
							$("#opdCensus<? echo $chargesCode ?>").html(opdData[0]);
							$("#opdAmount<? echo $chargesCode ?>").html(opdData[1]);

							
							$("#hmoCensus<? echo $chargesCode ?>").html("<p>Calculating..</p>");
							$("#hmoAmount<? echo $chargesCode ?>").html("<p>Calculating..</p>");

									$.post("charges-census-count-hmo.php",data,function(result){
										var hmoResult = result;
										var hmoData = hmoResult.split("-");

										$("#hmoCensus<? echo $chargesCode ?>").html(hmoData[0]);
										$("#hmoAmount<? echo $chargesCode ?>").html(hmoData[1]);

										$("#specialRates_opdCensus<? echo $chargesCode ?>").html("<p>Calculating..</p>");
										$("#specialRates_opdAmount<? echo $chargesCode ?>").html("<p>Calculating..</p>");
								
										$.post("charges-census-count-specialRates-opd.php",data,function(result){
											var specialRates_opdResult = result;
											var specialRates_opdData = specialRates_opdResult.split("-");

											$("#specialRates_opdCensus<? echo $chargesCode ?>").html(specialRates_opdData[0]);
											$("#specialRates_opdAmount<? echo $chargesCode ?>").html(specialRates_opdData[1]);
											
											$("#ipdCensus<? echo $chargesCode ?>").html("<p>Calculating..</p>");
											$("#ipdAmount<? echo $chargesCode ?>").html("<p>Calculating</p>");
										
											$.post("charges-census-count-ipd.php",data,function(result){
												var ipdResult = result;
												var ipdData = ipdResult.split("-");

												$("#ipdCensus<? echo $chargesCode ?>").html(ipdData[0]);
												$("#ipdAmount<? echo $chargesCode ?>").html(ipdData[1]);

												$("#specialRates_ipdCensus<? echo $chargesCode ?>").html("<p>Calculating..</p>");
												$("#specialRates_ipdAmount<? echo $chargesCode ?>").html("<p>Calculating..</p>");

												$.post("charges-census-count-specialRates-ipd.php",data,function(result){
													var specialRates_ipdResult = result;
													var specialRates_ipdData = specialRates_ipdResult.split("-");

													$("#specialRates_ipdCensus<? echo $chargesCode ?>").html(specialRates_ipdData[0]);
													$("#specialRates_ipdAmount<? echo $chargesCode ?>").html(specialRates_ipdData[1]);

																										
													$("#totalCensus<? echo $chargesCode ?>").html("<p>Calculating..</p>");
													$("#totalAmount<? echo $chargesCode ?>").html("<p>Calculating..</p>");

													$.post("charges-census-count-total.php",data,function(result){
														var totalResult = result;
														var totalData = totalResult.split("-");

														$("#totalCensus<? echo $chargesCode ?>").html(totalData[0]);
														$("#totalAmount<? echo $chargesCode ?>").html(totalData[1]);

														
														$("#opdCensus<? echo $chargesCode ?>").attr("id","opdCensusResult<? echo $chargesCode ?>");

														$("#opdAmount<? echo $chargesCode ?>").attr("id","opdAmountResult<? echo $chargesCode ?>");

														$("#hmoCensus<? echo $chargesCode ?>").attr("id","hmoCensusResult<? echo $chargesCode ?>");

														$("#hmoAmount<? echo $chargesCode ?>").attr("id","hmoAmountResult<? echo $chargesCode ?>");

														$("#specialRates_opdCensus<? echo $chargesCode ?>").attr("id","specialRates_opdCensusResult<? echo $chargesCode ?>");

														$("#specialRates_opdAmount<? echo $chargesCode ?>").attr("id","specialRates_opdAmountResult<? echo $chargesCode ?>");

														$("#ipdCensus<? echo $chargesCode ?>").attr("id","ipdCensusResult<? echo $chargesCode ?>");

														$("#ipdAmount<? echo $chargesCode ?>").attr("id","ipdAmountResult<? echo $chargesCode ?>");

														$("#specialRates_ipdCensus<? echo $chargesCode ?>").attr("id","specialRates_ipdCensusResult<? echo $chargesCode ?>");

														$("#specialRates_ipdAmount<? echo $chargesCode ?>").attr("id","specialRates_ipdAmountResult<? echo $chargesCode ?>");
														
														$("#totalCensus<? echo $chargesCode ?>").attr("id","totalCensusResult<? echo $chargesCode ?>");

														$("#totalAmount<? echo $chargesCode ?>").attr("id","totalAmountResult<? echo $chargesCode ?>");


														$(".opdCash<? echo $chargesCode ?>").tooltipster({
															content: $('<span>Loading....</span>'),
															position: 'right',
															theme: 'tooltipster-noir',
															interactive:true,
															repositionOnScroll:true,
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

										
														$(".opdHMO<? echo $chargesCode ?>").tooltipster({
															content: $('<span>Loading....</span>'),
															position: 'right',
															theme: 'tooltipster-noir',
															interactive:true,
															contentAsHTML:true,
															functionBefore:function(origin,continueTooltip) {
																continueTooltip();
																if( origin.data('ajax') !== 'cached' ){ 
																	$.ajax({
																		type:'POST',
																		url:'charges-census-details-hmo.php',
																		data:{chargesCode:'<? echo $chargesCode ?>',date1:'<? echo $date1 ?>',date2:'<? echo $date2 ?>'},
																		success:function(data) {
																			origin.tooltipster('content',data).data('ajax','cached');
																		}
																	});
																}
															}									
														});


														$(".opdSpecialRates<? echo $chargesCode ?>").tooltipster({
															content: $('<span>Loading....</span>'),
															position: 'right',
															theme: 'tooltipster-noir',
															interactive:true,
															contentAsHTML:true,
															functionBefore:function(origin,continueTooltip) {
																continueTooltip();
																if( origin.data('ajax') !== 'cached' ){ 
																	$.ajax({
																		type:'POST',
																		url:'charges-census-details-specialRates-opd.php',
																		data:{chargesCode:'<? echo $chargesCode ?>',date1:'<? echo $date1 ?>',date2:'<? echo $date2 ?>'},
																		success:function(data) {
																			origin.tooltipster('content',data).data('ajax','cached');
																		}
																	});
																}
															}									
														});


														$(".ipd<? echo $chargesCode ?>").tooltipster({
															content: $('<span>Loading....</span>'),
															position: 'right',
															theme: 'tooltipster-noir',
															interactive:true,
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

														$(".ipdSpecialRates<? echo $chargesCode ?>").tooltipster({
															content: $('<span>Loading....</span>'),
															position: 'right',
															theme: 'tooltipster-noir',
															interactive:true,
															contentAsHTML:true,
															functionBefore:function(origin,continueTooltip) {
																continueTooltip();
																if( origin.data('ajax') !== 'cached' ){ 
																	$.ajax({
																		type:'POST',
																		url:'charges-census-details-specialRates-ipd.php',
																		data:{chargesCode:'<? echo $chargesCode ?>',date1:'<? echo $date1 ?>',date2:'<? echo $date2 ?>'},
																		success:function(data) {
																			origin.tooltipster('content',data).data('ajax','cached');
																		}
																	});
																}
															}									
														});

													});												

												});												

											});											

										});		
													
								});								
						});

					}).click(function(){

						var data = {
							chargesCode:<? echo $chargesCode ?>,
							date1:'<? echo $date1 ?>',
							date2:'<? echo $date2 ?>'
						};

						$("#opdCensusResult<? echo $chargesCode ?>").html("<p>Re Calculating..</p>");
						$("#opdAmountResult<? echo $chargesCode ?>").html("<p>Re Calculating..</p>");


						$("#hmoCensusResult<? echo $chargesCode ?>").html("<p>Waiting OPD</p>");
						$("#hmoAmountResult<? echo $chargesCode ?>").html("<p>Waiting OPD</p>");

						$("#specialRates_opdCensusResult<? echo $chargesCode ?>").html("<p>Waiting HMO</p>");
						$("#specialRates_opdAmountResult<? echo $chargesCode ?>").html("<p>Waiting HMO</p>");


						$("#ipdCensusResult<? echo $chargesCode ?>").html("<p>Waiting Spec.Rates</p>");
						$("#ipdAmountResult<? echo $chargesCode ?>").html("<p>Waiting Spec.Rates</p>");


						$("#specialRates_ipdCensusResult<? echo $chargesCode ?>").html("<p>Waiting IPD</p>");
						$("#specialRates_ipdAmountResult<? echo $chargesCode ?>").html("<p>Waiting IPD</p>");


						$("#totalCensusResult<? echo $chargesCode ?>").html("<p>Waiting All</p>");
						$("#totalAmountResult<? echo $chargesCode ?>").html("<p>Waiting All</p>");

						$.post("charges-census-count-opd.php",data,function(result){
							var opdResult = result;
							var opdData = opdResult.split("-");

							
							$("#opdCensusResult<? echo $chargesCode ?>").html(opdData[0]);
							$("#opdAmountResult<? echo $chargesCode ?>").html(opdData[1]);

							
							$("#hmoCensusResult<? echo $chargesCode ?>").html("<p>Re Calculating..</p>");
							$("#hmoAmountResult<? echo $chargesCode ?>").html("<p>Re Calculating..</p>");

									$.post("charges-census-count-hmo.php",data,function(result){
										var hmoResult = result;
										var hmoData = hmoResult.split("-");

										$("#hmoCensusResult<? echo $chargesCode ?>").html(hmoData[0]);
										$("#hmoAmountResult<? echo $chargesCode ?>").html(hmoData[1]);

										$("#specialRates_opdCensusResult<? echo $chargesCode ?>").html("<p>Re Calculating..</p>");
										$("#specialRates_opdAmountResult<? echo $chargesCode ?>").html("<p>Re Calculating..</p>");
								
										$.post("charges-census-count-specialRates-opd.php",data,function(result){
											var specialRates_opdResult = result;
											var specialRates_opdData = specialRates_opdResult.split("-");

											$("#specialRates_opdCensusResult<? echo $chargesCode ?>").html(specialRates_opdData[0]);
											$("#specialRates_opdAmountResult<? echo $chargesCode ?>").html(specialRates_opdData[1]);
											
											$("#ipdCensusResult<? echo $chargesCode ?>").html("<p>Re Calculating..</p>");
											$("#ipdAmountResult<? echo $chargesCode ?>").html("<p>Re Calculating</p>");
										
											$.post("charges-census-count-ipd.php",data,function(result){
												var ipdResult = result;
												var ipdData = ipdResult.split("-");

												$("#ipdCensusResult<? echo $chargesCode ?>").html(ipdData[0]);
												$("#ipdAmountResult<? echo $chargesCode ?>").html(ipdData[1]);

												$("#specialRates_ipdCensusResult<? echo $chargesCode ?>").html("<p>Re Calculating..</p>");
												$("#specialRates_ipdAmountResult<? echo $chargesCode ?>").html("<p>Re Calculating..</p>");

												$.post("charges-census-count-specialRates-ipd.php",data,function(result){
													var specialRates_ipdResult = result;
													var specialRates_ipdData = specialRates_ipdResult.split("-");

													$("#specialRates_ipdCensusResult<? echo $chargesCode ?>").html(specialRates_ipdData[0]);
													$("#specialRates_ipdAmountResult<? echo $chargesCode ?>").html(specialRates_ipdData[1]);

																										
													$("#totalCensusResult<? echo $chargesCode ?>").html("<p>Re Calculating..</p>");
													$("#totalAmountResult<? echo $chargesCode ?>").html("<p>Re Calculating..</p>");
													$.post("charges-census-count-total.php",data,function(result){
														var totalResult = result;
														var totalData = totalResult.split("-");

														$("#totalCensusResult<? echo $chargesCode ?>").html(totalData[0]);
														$("#totalAmountResult<? echo $chargesCode ?>").html(totalData[1]);

														
													});												

												});												

											});											

										});		
													
								});								
						});

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
			<div class="col-md-12">
				<table id="charges" class="table table-hover">
					<thead>
						<tr>
							<th>Description</th>
							<th>OPD Count (Cash)</th>
							<th>OPD Amount (Cash)</th>
							<th>OPD Count (HMO)</th>
							<th>OPD Amount (HMO)</th>
							<th>OPD Count (Spec.Rates)</th>
							<th>OPD Amount (Spec.Rates)</th>
							<th>IPD Count</th>
							<th>IPD Amount</th>
							<th>IPD Count (Spec.Rates)</th>
							<th>IPD Amount (Spec.Rates)</th>
							<th>Total Count</th>
							<th>Total Amount</th>
						</tr>
					</thead>
					<tbody>
						<? if( $ro4->list_charges_chargesCode() != "" ) { ?>
							<? foreach( $ro4->list_charges_chargesCode() as $chargesCode ) { ?>
								<tr>
									<td>
										<a style="color:black; text-decoration:none;" href="#" id="charges<? echo $chargesCode ?>">
											<?
												echo strtoupper($ro->selectNow("availableCharges","Description","chargesCode",$chargesCode))
											?>
										</a>
									</td>
									<td>
										<span class="opdCash<? echo $chargesCode ?>" id="opdCensus<? echo $chargesCode ?>">
											
										</span>
									</td>
									<td>
										<span class="opdCash<? echo $chargesCode ?>" id="opdAmount<? echo $chargesCode ?>">
											
										</span>
									</td>
									<td>
										<span class="opdHMO<? echo $chargesCode ?>" id="hmoCensus<? echo $chargesCode ?>">
											
										</span>
									</td>
									<td>
										<span class="opdHMO<? echo $chargesCode ?>" id="hmoAmount<? echo $chargesCode ?>">
											
										</span>
									</td>
									<td>
										<span class="opdSpecialRates<? echo $chargesCode ?>" id="specialRates_opdCensus<? echo $chargesCode ?>">
											
										</span>
									</td>
									<td>
										<span class="opdSpecialRates<? echo $chargesCode ?>" id="specialRates_opdAmount<? echo $chargesCode ?>">
											
										</span>
									</td>
									<td>
										<span class="ipd<? echo $chargesCode ?>" id="ipdCensus<? echo $chargesCode ?>">
											
										</span>
									</td>
									<td>
										<span class="ipd<? echo $chargesCode ?>" id="ipdAmount<? echo $chargesCode ?>">
											
										</span>
									</td>
									<td>
										<span class="ipdSpecialRates<? echo $chargesCode ?>" id="specialRates_ipdCensus<? echo $chargesCode ?>">
										
										</span>
									</td>
									<td>
										<span class="ipdSpecialRates<? echo $chargesCode ?>" id="specialRates_ipdAmount<? echo $chargesCode ?>">
											
										</span>
									</td>
									<td>
										<span id="totalCensus<? echo $chargesCode ?>">
											
										</span>
									</td>
									<td>
										<span id="totalAmount<? echo $chargesCode ?>">
											
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