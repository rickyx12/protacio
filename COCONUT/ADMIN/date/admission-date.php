<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<script src="../../js/jquery-2.1.4.min.js"></script>
		<script src="../../js/jquery-ui.min.js"></script>
		<script src="../../js/open.js"></script>
		<link rel="stylesheet" href="../../../bootstrap-3.3.6/css/bootstrap.css"></link>
		<link rel="stylesheet" href="../../myCSS/jquery-ui.css"></link>

		<script>
			$(document).ready(function(){
				$(".date").datepicker({
					dateFormat:'yy-mm-dd'
				});

				$("#proceed").click(function(){

					var fromRegistered = $("#fromRegistered").val();
					var toRegistered = $("#toRegistered").val();

					var data = {
						fromRegistered:fromRegistered,
						toRegistered:toRegistered,
						type:'IPD',
						dept:''
					};
					open("POST","../../Reports/Census/registrationCensus-new-date.php",data,"_self");
				});

			});
		</script>

	</head>
	<body>
		<div class="container">
			<div class="col-md-3">
				
			</div>
			<div class="col-md-6">
				<br><br><br><br><br>
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title">Admission</h3>
					</div>
					<div class="panel-body">
						<div class="col-md-12 text-center">
							<div class="col-md-12">								
								<div class="input-group">
									<span class="input-group-addon">From</span>
									<input type="text" id="fromRegistered" name="from" class="form-control date" placeholder="Click Me for Date">
									<span class="input-group-addon">To</span>
									<input type="text" id="toRegistered" name="to" class="form-control date" placeholder="Click Me for Date">
									<span class="input-group-btn">
										<button id="proceed" class="btn btn-info">Proceed</button>
									</span>
								</div>														
							</div>
						</div>					
					</div>
				</div>
			</div>
			<div class="col-md-3">
				
			</div>
		</div>
	</body>
</html>