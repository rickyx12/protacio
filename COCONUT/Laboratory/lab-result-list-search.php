<?
	require_once "../authentication.php";
	include "../../myDatabase.php";
	include "../../myDatabase4.php";

	if( isset($_POST['pxName']) ) {
		$pxName = $_POST['pxName'];
	}else {
		$pxName = "avoidLike";
	}

	$ro = new database();
	$ro4 = new database4();

	$ro4->search_laboratory_result($pxName);
	
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<script src="../js/jquery-2.1.4.min.js"></script>
		<script src="../js/open.js"></script>
		<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
		<script>
			$(document).ready(function(){

				$("#searchBtn").click(function(){

					var pxName = $("#pxName").val();
					if( pxName != "" ) {
						open("POST","lab-result-list-search.php",{pxName:pxName},"_self");
					}else {

					}

				});

				$("#pxName").keypress(function(event){
					if(event.which == 13) {
						var pxName = $("#pxName").val();
						if( pxName != "" ) {
							open("POST","lab-result-list-search.php",{pxName:pxName},"_self");
						}else {

						}						
					}
				});

				<? if( $ro4->search_laboratory_result_savedNo() != "" ) { ?>
					<? foreach( $ro4->search_laboratory_result_savedNo() as $savedNo ) { ?>

						$("#result<? echo $savedNo ?>").click(function(){

							var data = {
								registrationNo:'<? echo $ro->selectNow('labSavedResult','registrationNo','savedNo',$savedNo) ?>',
								itemNo:'<? echo $ro->selectNow('labSavedResult','itemNo','savedNo',$savedNo) ?>'
							};

							open("GET","resultList/resultForm_output.php",data,"_blank");
						});

						$("#delete<? echo $savedNo ?>").click(function(){

							$.post('lab-result-list-delete.php',{savedNo:'<? echo $savedNo ?>'},function(){

								var data = {
									pxName:'<? echo $pxName ?>'
								};

								open("POST","lab-result-list-search.php",data,"_self");
							});

						});


					<? } ?>
				<? } ?>

			});
		</script>
	</head>
	<body>
		<div class="container">
			<h2>Lab Result</h2>		
				<div class="row">
					<div class="col-md-4">
						<div class="input-group">
							<input type="text" id="pxName" class="form-control" placeholder="Enter Patient Name" autocomplete="off">
							<span class="input-group-btn">
								<button type="button" id="searchBtn" class="btn btn-info">
									Search
								</button>
							</span>
						</div>
					</div>
				</div>
			<br>
			<div class="row">
				<div class="col-md-8">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Patient</th>
								<th>Date</th>
								<th>Type</th>
								<th>Laboratory</th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<? if( $ro4->search_laboratory_result_savedNo() != "" ) { ?>
								<? foreach( $ro4->search_laboratory_result_savedNo() as $savedNo ) { ?>
									<tr>
										<td>
											<?
												$registrationNo = $ro->selectNow("labSavedResult","registrationNo","savedNo",$savedNo);
												echo strtoupper($ro->selectNow("labSavedResult","patientName","savedNo",$savedNo))
											?>
										</td>
										<td>
											<?
												echo $ro4->formatDate($ro->selectNow("labSavedResult","date","savedNo",$savedNo));
											?>
										</td>
										<td>
											<?
												echo $ro->selectNow("registrationDetails","type","registrationNo",$registrationNo);
											?>
										</td>
										<td>
											<?
												$itemNo = $ro->selectNow("labSavedResult","itemNo","savedNo",$savedNo);
												echo $ro->selectNow("patientCharges","description","itemNo",$itemNo);
											?>
										</td>
										<td>
											<button id="result<? echo $savedNo ?>" type="button" class="btn btn-success col-xs">
												View Result
											</button>									
										</td>
										<td>
											<button id="delete<? echo $savedNo ?>" type="button" class="btn btn-danger col-xs">
												Delete Result
											</button>									
										</td>									
									</tr>
								<? } ?>
							<? } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>