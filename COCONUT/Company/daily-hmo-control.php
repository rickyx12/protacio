<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>		
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="../../jquery-2.1.4.min.js"></script>
		<script src="../js/jquery-ui.min.js"></script>
		<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
		<link rel="stylesheet" href="../js/jquery-ui.css"></link>
		<link rel="stylesheet" href="../js/jquery-ui.theme.min.css"></link>		

		<script>
			$(document).ready(function(){
				$("#date").datepicker({
					dateFormat:'yy-mm-dd'
				});
			});
		</script>

	</head>
	<body>
		<div class="container">
			<h3>HMO Patient</h3>
			<div class="col-md-4">
				
			</div>
			<form method="post" action="daily-hmo.php">
				<div class="col-md-6">
					<br><br><br>

					<div class="row">
						<div class="col-md-5">
							<input type="text" id="date" name="date" class="form-control" placeholder="Click to Enter Date" readonly="readonly">
						</div>
					</div>

					<div class="row">
						<div class="col-md-5">
							<br>
							<input type="radio" name="shift" value="Morning">&nbsp;Morning
							<Br>
							<input type="radio" name="shift" value="Noon">&nbsp;Noon
							<br>
							<input type="radio" name="shift" value="Afternoon">&nbsp;Afternoon
							<br>
							<input type="radio" name="shift" value="Night">&nbsp;Night
						</div>
					</div>

					<div class="row">
						<div class="col-md-5 text-center">
							<br>
							<input type="submit" class="btn btn-info" value="Proceed">
						</div>
					</div>

				</div>
			</form>
			<div class="col-md-3">
				
			</div>
		</div>
	</body>
</html>