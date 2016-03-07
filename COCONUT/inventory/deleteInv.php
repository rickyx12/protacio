<?
include "../../myDatabase.php";
$ro = new database();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Title</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/bootstrap-3.3.6/css/bootstrap.min.css">
  <script src="/bootstrap-3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

<br><br><Br><Br>
<form method="post" action="deleteInv1.php">
<? $ro->coconutHidden("inventoryCode",$_GET['inventoryCode']); ?>
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-default panel-danger">
  			<div class="panel-heading">Warning</div>
  				<div class="panel-body">
    		 		<? echo $ro->selectNow("inventory","genericName","inventoryCode",$_GET['inventoryCode'])." - ".$ro->selectNow("inventory","description","inventoryCode",$_GET['inventoryCode']) ?> is about to DELETE
				</div>
			</div>
			<div class="col-md-offset-5">
				<button type="submit" class="btn btn-danger">Confirm Delete</button>
			</div>
	</div>
</form>
</body>
</html>