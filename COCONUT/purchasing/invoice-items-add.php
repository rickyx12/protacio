<? $invoiceNo = $_POST['invoiceNo'] ?>
<? $siNo = $_POST['siNo'] ?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<script src="../js/jquery-2.1.4.min.js"></script>
		<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
		<script>
			$(document).ready(function(){
				$("#searchBtn").click(function(){
					var search = $("#searchValue").val();
					$.post("invoice-items-add1.php",{ search:search,invoiceNo:<? echo $invoiceNo ?>,siNo:<? echo $siNo ?> },function(result) { 
						$("#result").html(result);
					});
				});

				$("#searchValue").keypress(function(event){
					if(event.which == 13) {
						var search = $("#searchValue").val();
						$.post("invoice-items-add1.php",{ search:search,invoiceNo:'<? echo $invoiceNo ?>',siNo:'<? echo $siNo ?>' },function(result) { 
							$("#result").html(result);
						});					
					}
				});

			});
		</script>

	</head>
	<body>
		
		<div class="container">
				<div class="col-md-3">
					<input type="text" id="searchValue" class="form-control" placeholder="Search StockCard# / Generic" autocomplete="off"> 
				</div>
				<input type="button" id="searchBtn" class="btn btn-success" value="Search">

			<div class="row">
				<div id="result" class="col-md-6">
					
				</div>
			</div>

		</div>
	</body>
</html>