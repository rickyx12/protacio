<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<script src="../js/jquery-2.1.4.min.js"></script>
		<script src="../js/jquery-ui.min.js"></script>
		<script src="../js/open.js"></script>
		<script src="../../bootstrap-3.3.6/js/bootstrap.js"></script>
		<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
		<link rel="stylesheet" href="../myCSS/jquery-ui.css"></link>

		<script>
			$(document).ready(function(){
				$(".date").datepicker({
					dateFormat:'yy-mm-dd'
				});

				$("#checkBtn").click(function(){

					var date1 = $("#date1").val();
					var date2 = $("#date2").val();

					var data = {
						date1:date1,
						date2:date2
					};
					open("POST","paid-invoices-check.php",data,"_self");
				});

				$("#cashBtn").click(function(){

					var date1 = $("#date1").val();
					var date2 = $("#date2").val();

					var data = {
						date1:date1,
						date2:date2
					};
					open("POST","paid-invoices-cash.php",data,"_self");
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
						<h3 class="panel-title">Paid Invoices</h3>
					</div>
					<div class="panel-body">
						<div class="col-md-12 text-center">
							<div class="col-md-12">								
								<div class="input-group">
									<span class="input-group-addon">From</span>
									<input type="text" id="date1" name="from" class="form-control date" placeholder="Click Me for Date">
									<span class="input-group-addon">To</span>
									<input type="text" id="date2" name="to" class="form-control date" placeholder="Click Me for Date">
									<div class="input-group-btn">
										<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											Action
											<span class="caret"></span>
										</button>
										<ul class="dropdown-menu dropdown-menu-right">
											<li>
												<a id="checkBtn" href="#">Check</a>
											</li>
											<li>
												<a id="cashBtn" href="#">Cash</a>
											</li>
										</ul>
									</div>
									<!--
									<span class="input-group-btn">
										<button id="proceed" class="btn btn-info">Proceed</button>
									</span>
									-->
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