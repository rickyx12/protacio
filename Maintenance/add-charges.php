<? include "../myDatabase.php" ?>
<? $ro = new database() ?>
<!DOCTYPE html>
<html>
	<head>
	  <meta charset="UTF-8">
	  <title></title>
	  <script src="../COCONUT/js/jquery-2.1.4.min.js"></script>
	  <link rel="stylesheet" href="../bootstrap-3.3.6/css/bootstrap.css"></link>

	  <script>
	  	$(document).ready(function(){

	  		$("#alert").hide();
	  		$("#hospitalShareRow").hide();
	  		$("#PFShareRow").hide();

	  		$(document).on("change","#category",function(){

	  			if( $("#category").val() == "OT" || $("#category").val() == "ST" || $("#category").val() == "SPED" ) {
	  				$("#hospitalShareRow").show();
	  				$("#PFShareRow").show();
	  			}else {
	  				$("#hospitalShareRow").hide();
	  				$("#PFShareRow").hide();
	  			}

	  		});

	  		$("#addChargesBtn").click(function(){

	  			var description = $("#description").val();
	  			var category = $("#category").val();
	  			var opdPrice = $("#opdPrice").val();
	  			var ipdPrice = $("#ipdPrice").val();
	  			var hmoPrice = $("#hmoPrice").val();
	  			var specialRates = $("#specialRates").val();
	  			var discountable = $('input[name=discount]:checked').val();
	  			var hospitalShare = $("#hospitalShare").val();
	  			var pfShare = $("#pfShare").val();

	  			var data = {
	  				"description":description,
	  				"category":category,
	  				"opdPrice":opdPrice,
	  				"ipdPrice":ipdPrice,
	  				"hmoPrice":hmoPrice,
	  				"specialRates":specialRates,
	  				"discountable":discountable,
	  				"hospitalShare":hospitalShare,
	  				"pfShare":pfShare
	  			};

	  			$.post("add-charges1.php",data,function(result){
	  				$("#alert").show();
	  				$("#description").val("");
	  				$("#category").val("");
	  				$("#opdPrice").val("");
	  				$("#ipdPrice").val("");
	  				$("#hmoPrice").val("");
	  				$("#specialRates").val("");
	  				$("#hospitalShareRow").hide();
	  				$("#PFShareRow").hide();	  				
	  			});

	  		});
	  	});
	  </script>

	</head>
	<body>
		<div class="container">
			<div class="col-md-3">
				
			</div>

			<div class="col-md-6">

				<br><br>
				<div id="alert" class="alert alert-success">
					New Charges Successfully Added to the Masterlist of Charges
				</div>
				<br>
				<div class="panel panel-info">
					<div class="panel-heading">
						<h5 class="panel-title">
							New Charges
						</h5>
					</div>
					<div class="panel-body">
						<form class="form-inliine" role="form">

							<div class="row">
								<div class="form-group">
									<label class="control-label col-sm-3" for="description">Description:</label>
									 <div class="col-sm-8">
	      								<input type="text" class="form-control" id="description" placeholder="Name of Charges" autocomplete="off">
	   								 </div>
								</div>
							</div>

							<div class="row">
								<div class="form-group">
									<label class="control-label col-sm-3">Category:</label>
									<div class="col-sm-8">
										<select id="category" class="form-control">
											<option>
												<? $ro->showOption_group("availableCharges","Category") ?>
											</option>
										</select>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="form-group">
									<label class="control-label col-sm-3">Outpatient:</label>
									 <div class="col-sm-5">
	      								<input type="text" class="form-control" id="opdPrice" placeholder="Price for Outpatient" autocomplete="off">
	   								 </div>
								</div>
							</div>

							<div class="row">
								<div class="form-group">
									<label class="control-label col-sm-3">Inpatient:</label>
									 <div class="col-sm-5">
	      								<input type="text" class="form-control" id="ipdPrice" placeholder="Price for Inpatient" autocomplete="off">
	   								 </div>
								</div>
							</div>

							<div class="row">
								<div class="form-group">
									<label class="control-label col-sm-3">HMO:</label>
									 <div class="col-sm-5">
	      								<input type="text" class="form-control" id="hmoPrice" placeholder="Price for HMO" autocomplete="off">
	   								 </div>
								</div>
							</div>

							<div class="row">
								<div class="form-group">
									<label class="control-label col-sm-3">Special Rates:</label>
									 <div class="col-sm-5">
	      								<input type="text" class="form-control" id="specialRates" placeholder="Price for Special Rates" autocomplete="off">
	   								 </div>
								</div>
							</div>

							<div class="row">
								<div class="form-group">
									<label class="control-label col-sm-3">Discountable?</label>
									 <div class="col-sm-5">
	      								<input type="radio" id="discountable" name="discount" value="yes" checked>&nbsp;Yes
	      								&nbsp;&nbsp;&nbsp;&nbsp;
	      								<input type="radio" id="discountable" name="discount" value="no">&nbsp;No
	   								 </div>
								</div>
							</div>

							<div id="hospitalShareRow" class="row">
								<div class="form-group">
									<label class="control-label col-sm-3">Hospital</label>
									<div class="col-sm-5">
										<input type="text" class="form-control" id="hospitalShare" placeholder="Hospital Share">
									</div>
								</div>
							</div>

							<div id="PFShareRow" class="row">
								<div class="form-group">
									<label class="control-label col-sm-3">PF</label>
									<div class="col-sm-5">
										<input type="text" class="form-control" id="pfShare" placeholder="PF Share">
									</div>
								</div>
							</div>

							<div class="row">
								<h5>&nbsp;</h5>
							</div>

							<div class="row text-center">
								<input id="addChargesBtn" type="button" class="btn btn-success" value="Proceed">
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