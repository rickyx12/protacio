<? $doctorCode = $_POST['doctorCode'] ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
		<script src="../../bower_components/jquery-ui/jquery-ui.min.js"></script>
		<script src="../js/open.js"></script>
		<link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css"></link>
		<link rel="stylesheet" href="../myCSS/jquery-ui.css"></link>

		<script>
			$(document).ready(function(){
				$("#date").datepicker({
					dateFormat:'yy-mm-dd'
				});

				$("#proceed").click(function(){

					var date = $("#date").val();
					var doctorCode = '<? echo $doctorCode ?>';

					var data = {
						date:date,
						doctorCode:doctorCode
					}
					open("POST","outpatient-ui.php",data,"_self");
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
						<h3 class="panel-title">Patient</h3>
					</div>
					<div class="panel-body">
						<div class="col-md-12 text-center">
							<div class="col-md-3">
								
							</div>
							<div class="col-md-6">
								<div class="input-group">
									<input type="text" id="date" class="form-control" value="<? echo date("Y-m-d") ?>" readonly>
									<span class="input-group-btn">
										<button id="proceed" type="button" class="btn btn-info">
											Proceed
										</button>
									</span>
								</div>								
							</div>
							<div class="col-md-3">
								
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