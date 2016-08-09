<?
	require_once "../authentication.php";
	include "../../myDatabase.php";

	$ro = new database();

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<script src="../js/jquery-2.1.4.min.js"></script>
		<script src="../js/jquery-ui.min.js"></script>
		<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
		<link rel="stylesheet" href="../myCSS/jquery-ui.css"></link>
	</head>
	<body>
		<div class="container">
			<h1>&nbsp;</h1>
			<div class="col-md-3">
				
			</div>
			<div class="col-md-6">
				<form method="post" action="unpaidPO.php">
					<div class="panel panel-info">
						<div class="panel-heading">
							<h4 class="panel-title">Unpaid Purchases</h4>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-12">
									<select name="supplier" class="form-control">
										<option>Select Supplier</option>
										<? $ro->showOption_with_value("supplier","supplierName","supplierCode") ?>
									</select>
								</div>
							</div>
							<div class="row">
								&nbsp;
							</div>
							<div class="row">
								<div class="col-md-12 text-center">
									<button class="btn btn-success">
										Proceed
									</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="col-md-3">
				
			</div>
		</div>
	</body>
</html>