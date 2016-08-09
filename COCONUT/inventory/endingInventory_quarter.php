<!DOCTYPE html>
<html>
	<head>
		<title>Ending Inventory</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>		
	</head>
	<body>
		<h1>&nbsp;</h1>
		<div class="container">
			<div class="col-md-3">
				
			</div>

			<div class="col-md-6">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title">
							Ending Inventory
						</h3>
					</div>

					<div class="panel-body">
						<form method="post" action="new-ending-inventory.php">
							<div class="row">
								<div class="form-group">
									<label class="control-label col-sm-2">Type</label>
									<div class="col-sm-3">
										<input type="radio" name="inventoryType" value="medicine" checked>&nbsp;Medicine
									</div>
									<div class="col-sm-4">
										<input type="radio" name="inventoryType" value="supplies">&nbsp;Supplies
									</div>							
								</div>
							</div>

							<div class="row">
								<div class="form-group">
									
								</div>
							</div>

							<div class="row">
								<div class="form-group">
									<label class="control-label col-sm-2">Quarter</label>
									
									<div class="col-sm-2">
										<input type="radio" name="quarter" value="1st" checked>&nbsp;1st
									</div>
									
									<div class="col-sm-2">
										<input type="radio" name="quarter" value="2nd">&nbsp;2nd
									</div>	

									<div class="col-sm-2">
										<input type="radio" name="quarter" value="3rd">&nbsp;3rd
									</div>

									<div class="col-sm-2">
										<input type="radio" name="quarter" value="4th">&nbsp;4th
									</div>

								</div>
							</div>

							<br><br>

							<div class="row">
								<div class="form-group text-center">
									<div class="col-sm-12">
										<input type="submit" class="btn btn-info" value="Proceed">
									</div>
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