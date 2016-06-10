<? include "../../myDatabase.php" ?>
<? $ro = new database() ?>
<? $stockCardNo = $_GET['stockCardNo'] ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="../../jquery-2.1.4.min.js"></script>
	<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
	<script src="../../bootstrap-3.3.6/js/bootstrap.js"></script>
</head>
<body>
	<div class="container">
		<h3>&nbsp;</h3>
		<div class="col-md-3">
			
		</div>

		<div class="col-md-6">
			<div class="panel panel-success">
				<div class="panel panel-heading">
					Manual Ending Inventory
				</div>
				<div class="panel panel-body">
					<form class="form-horizontal" role="form" method="post" action="addEndingInventory_manual1.php">
						<div class="form-group">
							<label class="control-label col-sm-2">Stock#</label>
							<div class="col-sm-3">
								<input type="text" name="stockCardNo" class="form-control col-sm-3" autocomplete="off" readonly="readonly" value="<? echo $stockCardNo ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-2">Brand</label>
							<div class="col-sm-8">
								<input type="text" name="brandName" class="form-control col-sm-8" readonly="readonly" value="<? echo $ro->selectNow('inventoryStockCard','description','stockCardNo',$stockCardNo) ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-2">Generic</label>
							<div class="col-sm-8">
								<input type="text" name="genericName" class="form-control col-sm-8" readonly="readonly" value="<? echo $ro->selectNow('inventoryStockCard','genericName','stockCardNo',$stockCardNo) ?>">
							</div>
						</div>						

						<div class="form-group">
							<label class="control-label col-sm-2">Current QTY</label>
							<div class="col-sm-3">
								<input type="text" name="currentQTY" class="form-control col-sm-3" autocomplete="off">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-2">Ending QTY</label>
							<div class="col-sm-3">
								<input type="text" name="endingQTY" class="form-control col-sm-3" autocomplete="off">
							</div>
						</div>						

						<div class="form-group">
							<label class="control-label col-sm-2">Date</label>
							<div class="col-sm-5">
								<input type="text" name="dateAdded" class="form-control col-sm-5" readonly="readonly" value="<? echo date('Y-m-d') ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-2">Quarter</label>
							<div class="col-sm-10">
								<input type="radio" name="quarter" value="1st" checked="checked">&nbsp;1st
								&nbsp;&nbsp;&nbsp;
								<input type="radio" name="quarter" value="2nd">&nbsp;2nd
								&nbsp;&nbsp;&nbsp;
								<input type="radio" name="quarter" value="3rd">&nbsp;3rd
								&nbsp;&nbsp;&nbsp;
								<input type="radio" name="quarter" value="4th">&nbsp;4th
							</div>
						</div>		
						<br>
						<div class="form-group">
							<div class="col-sm-10 text-center">
								<input type="submit" class="btn btn-success" value="Proceed">
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