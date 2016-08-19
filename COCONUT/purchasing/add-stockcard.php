<? require_once "../authentication.php" ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<script src="../js/jquery-2.1.4.min.js"></script>
		<script src="../js/sweetalert/dist/sweetalert.min.js"></script>
		<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
		<link rel="stylesheet" href="../js/sweetalert/dist/sweetalert.css"></link>
		<script>
			$(document).ready(function(){

				$(".inventoryType").click(function(){
					if($('#supplies').is(':checked')){
						$("#genericName").hide();
						$("#genericNameLabel").hide();
					}else {
						$("#genericName").show();
						$("#genericNameLabel").show();
					}
				});

				$("#addMedicine").click(function(){
					
					var description = $("#description").val();
					var genericName = $("#genericName").val();
					var inventoryType = $('input[name=inventoryType]:checked').map(function(){
									return this.value;
								}).get();					

					var data = {
						description:description,
						genericName:genericName,
						inventoryType:inventoryType
					};
					
					if( $('#supplies').is(':checked') || $('#medicine').is(':checked') ) {
						$.post("add-stockcard1.php",data,function(result){
							swal("Success","Stock Card Added to Masterfile","success");
							$("#description").val("");
							$("#genericName").show();
							$("#genericNameLabel").show();
							$("#genericName").val("");
							$('.inventoryType').prop('checked', false);
						});	
					}else {
						swal("Sorry","Pls select which inventory type is the stockcard","error");
					}			
					


				});
			});
		</script>
	</head>
	<body>
		<div class="container">
			<h3>&nbsp;</h3>
			<div class="col-md-3">
				
			</div>

			<div class="col-md-6">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h4 class="panel-title">New Stock Card</h4>
					</div>
					<div class="panel-body">
						<form class="form-horizontal" role="form">
							<div class="form-group">
								<label class="control-label col-sm-2">Description</label>
								<div class="col-sm-10">
									<input type="text" id="description" class="form-control" placeholder="Brand Name or Description" autocomplete="off">
								</div>
							</div>
							<div class="form-group">
								<label id="genericNameLabel" class="control-label col-sm-2">Generic</label>
								<div class="col-sm-10">
									<input type="text" id="genericName" class="form-control" placeholder="Generic Name" autocomplete="off">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2">Type</label>
								<div class="col-sm-10">
									<input type="radio" class="inventoryType" id="medicine" name="inventoryType" value="medicine">&nbsp;Medicine
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<input type="radio" class="inventoryType" id="supplies" name="inventoryType" value="supplies">&nbsp;Supplies
								</div>
							</div>
							<div class="form-group text-center">
								<button type="button" id="addMedicine" class="btn btn-success">
									Proceed
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div class="col-md-3">
				
			</div>

		</div>
	</body>
</html>