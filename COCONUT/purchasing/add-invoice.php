<? require_once "../authentication.php" ?>
<? include "../../myDatabase.php" ?>
<? $ro = new database() ?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<script src="../js/jquery-2.1.4.min.js"></script>
		<script src="../js/jquery-ui.min.js"></script>
		<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
		<link rel="stylesheet" href="../myCSS/jquery-ui.css"></link>

		<script>
			$(document).ready(function(){

				$("#invoiceNoExist").hide();
				$("#invoiceNoAlert").hide();
				$("#supplierAlert").hide();
				$("#termsAlert").hide();
				$("#dateAlert").hide();

				$("#date").datepicker({
					dateFormat:'yymmdd'
				});


				$("#addPurchaseBtn").click(function(){

					var invoiceNo = $("#invoiceNo").val();
					var supplier = $("#supplier").val();
					var terms = $("#terms").val();
					var date = $("#date").val();

					if( invoiceNo == "" || supplier == "" || terms == "" || date == "" ) {
						if( invoiceNo == "" ) {
							$("#invoiceNoAlert").show();
						}

						if( supplier == "" ) {
							$("#supplierAlert").show();
						}

						if( terms == "" ) {
							$("#termsAlert").show();
						}

						if( date == "" ) {
							$("#dateAlert").show();
						}
					}else {
						var data = {
							"invoiceNo":invoiceNo,
							"supplier":supplier,
							"terms":terms,
							"date":date
						}

						$.post("add-invoice-check-exist.php",{invoiceNo:invoiceNo},function(result){

							if( result == 1 ) {
								$("#invoiceNoExist").show();
							}else {
								$.post("add-invoice1.php",data,function(result){
									window.location = "invoice-items.php?invoiceNo="+invoiceNo+"&supplier="+supplier+"&terms="+terms+"&date="+date+"&siNo="+result;
									//console.log(result);
								});					
							}
						});
					}
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

				<div id="invoiceNoExist" class="alert alert-danger text-center">
					Invoice No# already exist
				</div>

				<div id="invoiceNoAlert" class="alert alert-danger text-center">
					Pls Enter Invoice No#
				</div>

				<div id="supplierAlert" class="alert alert-danger text-center">
					Pls Enter Supplier
				</div>

				<div id="termsAlert" class="alert alert-danger text-center">
					Pls Enter Terms
				</div>

				<div id="dateAlert" class="alert alert-danger text-center">
					Pls Enter Date
				</div>

				<br>
				<div class="panel panel-info">
					<div class="panel-heading">
						<h4 class="panel-title">
							New Purchases
						</h4>
					</div>
					<div class="panel-body">
						<form id="invoiceForm" data-toggle="validator">
							<div class="row">
								<div class="col-md-8">
									<label>Invoice No#</label>							
									<input id="invoiceNo" type="text" class="form-control" autocomplete="off" required >
								</div>
							</div>

							<div class="row">
								&nbsp;
							</div>

							<div class="row">
								<div class="col-md-8">
									<label>Supplier</label>
									<select id="supplier" class="form-control">
										<option></option>
										<? $ro->showOption("supplier","supplierName") ?>
									</select>
								</div>
							</div>

							<div class="row">
								&nbsp;
							</div>

							<div class="row">
								<div class="col-md-8">
									<label>Terms</label>
									<select id="terms" class="form-control">
										<option></option>									 		
										<option>30 Days</option>
										<option>60 Days</option>
										<option>90 Days</option>
										<option>PDC 30 Days</option>
										<option>PDC 60 Days</option>
										<option>C.O.D.</option>
										<option>Retail</option>
										<option value='CASH'>Cash</option>		
									</select>
								</div>
							</div>

							<div class="row">
								&nbsp;
							</div>

							<div class="row">
								<div class="col-md-5">
									<label>Date</label>
									<input type="text" id="date" class="form-control" readonly placeholder="Click To Enter Date">
								</div>
							</div>

							<div class="row">
								&nbsp;
							</div>

							<div class="row">
								<div class="col-md-12 text-right">
									<input id="addPurchaseBtn" type="button" class="btn btn-success" value="Add Purchases >>">
								</div>
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