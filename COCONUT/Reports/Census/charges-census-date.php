<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<script src="../../js/jquery-2.1.4.min.js"></script>
		<script src="../../js/jquery-ui.min.js"></script>
		<script src="../../js/open.js"></script>
		<script src="../../../bootstrap-3.3.6/js/bootstrap.js"></script>
		<link rel="stylesheet" href="../../../bootstrap-3.3.6/css/bootstrap.css"></link>
		<link rel="stylesheet" href="../../myCSS/jquery-ui.css"></link>

		<script>
			$(document).ready(function(){
				$(".date").datepicker({
					dateFormat:'yy-mm-dd'
				});

				$("#laboratory").click(function(){

					var date1 = $("#date1").val();
					var date2 = $("#date2").val();

					var data = {
						date1:date1,
						date2:date2,
						title:'LABORATORY'
					};
					open("POST","charges-census.php",data,"_self");
				});

				$("#xray").click(function(){

					var date1 = $("#date1").val();
					var date2 = $("#date2").val();

					var data = {
						date1:date1,
						date2:date2,
						title:'XRAY'
					};
					open("POST","charges-census.php",data,"_self");
				});				

				$("#ultrasound").click(function(){

					var date1 = $("#date1").val();
					var date2 = $("#date2").val();

					var data = {
						date1:date1,
						date2:date2,
						title:'ULTRASOUND'
					};
					open("POST","charges-census.php",data,"_self");
				});		

				$("#ctscan").click(function(){

					var date1 = $("#date1").val();
					var date2 = $("#date2").val();

					var data = {
						date1:date1,
						date2:date2,
						title:'CTSCAN'
					};
					open("POST","charges-census.php",data,"_self");
				});	

				$("#ecg").click(function(){

					var date1 = $("#date1").val();
					var date2 = $("#date2").val();

					var data = {
						date1:date1,
						date2:date2,
						title:'ECG'
					};
					open("POST","charges-census.php",data,"_self");
				});	

				$("#ot").click(function(){

					var date1 = $("#date1").val();
					var date2 = $("#date2").val();

					var data = {
						date1:date1,
						date2:date2,
						title:'OT'
					};
					open("POST","charges-census.php",data,"_self");
				});

				$("#pt").click(function(){

					var date1 = $("#date1").val();
					var date2 = $("#date2").val();

					var data = {
						date1:date1,
						date2:date2,
						title:'PT'
					};
					open("POST","charges-census.php",data,"_self");
				});

				$("#st").click(function(){

					var date1 = $("#date1").val();
					var date2 = $("#date2").val();

					var data = {
						date1:date1,
						date2:date2,
						title:'ST'
					};
					open("POST","charges-census.php",data,"_self");
				});

				$("#erFee").click(function(){

					var date1 = $("#date1").val();
					var date2 = $("#date2").val();

					var data = {
						date1:date1,
						date2:date2,
						title:'ER FEE'
					};
					open("POST","charges-census.php",data,"_self");
				});

				$("#misc").click(function(){

					var date1 = $("#date1").val();
					var date2 = $("#date2").val();

					var data = {
						date1:date1,
						date2:date2,
						title:'MISCELLANEOUS'
					};
					open("POST","charges-census.php",data,"_self");
				});

				$("#others").click(function(){

					var date1 = $("#date1").val();
					var date2 = $("#date2").val();

					var data = {
						date1:date1,
						date2:date2,
						title:'OTHERS'
					};
					open("POST","charges-census.php",data,"_self");
				});

				$("#or").click(function(){

					var date1 = $("#date1").val();
					var date2 = $("#date2").val();

					var data = {
						date1:date1,
						date2:date2,
						title:'OR/DR/ER Fee'
					};
					open("POST","charges-census.php",data,"_self");
				});

				$("#nursery").click(function(){

					var date1 = $("#date1").val();
					var date2 = $("#date2").val();

					var data = {
						date1:date1,
						date2:date2,
						title:'NURSERY'
					};
					open("POST","charges-census.php",data,"_self");
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
						<h3 class="panel-title">Charges Census Summary</h3>
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
											Title
											<span class="caret"></span>
										</button>
										<ul class="dropdown-menu dropdown-menu-right">
											<li>
												<a id="laboratory" href="#">LABORATORY</a>
											</li>
											<li>
												<a id="xray" href="#">XRAY</a>
											</li>
											<li>
												<a id="ultrasound" href="#">ULTRASOUND</a>
											</li>
											<li>
												<a id="ctscan" href="#">CTSCAN</a>
											</li>
											<li>
												<a id="ecg" href="#">ECG</a>
											</li>
											<li>
												<a id="ot" href="#">OT</a>
											</li>
											<li>
												<a id="pt" href="#">PT</a>
											</li>
											<li>
												<a id="st" href="#">ST</a>
											</li>
											<li>
												<a id="erFee" href="#">ER FEE</a>
											</li>
											<li>
												<a id="misc" href="#">MISCELLANEOUS</a>
											</li>																								 <li>
												<a id="others" href="#">OTHERS</a>
											</li>
											<li>
												<a id="or" href="#">OR/DR</a>
											</li>
											<li>
												<a id="nursery" href="#">NURSERY</a>
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