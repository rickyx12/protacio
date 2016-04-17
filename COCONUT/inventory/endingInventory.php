<?
include "../../myDatabase4.php";
include "../../myDatabase.php";

$ro = new database4();
$ro1 = new database();

$inventoryType = $_GET['inventoryType'];

$ro->inventory_list($inventoryType);

$inventoryCode = $ro->inventory_list_inventoryCode();
$stockCardNo = $ro->inventory_list_stockCardNo();
$generic = $ro->inventory_list_genericName();
$brand = $ro->inventory_list_description();
$qty = $ro->inventory_list_qty();

$inventoryCodeNo = count($inventoryCode);
$countStockCard = count($stockCardNo);
$genericNameNo = count($generic);
$brandNo = count($brand);
$qtyNo = count($qty);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Inventory</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="../../jquery1.11.1.js"></script>
  <link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.min.css">
  <script src="../../bootstrap-3.3.6/js/bootstrap.min.js"></script>

  	<? for($a=0;$a<$genericNameNo;$a++) { ?>
  	<script>
		$(document).ready(function(){
			$("#save<? echo $a ?>").click(function(){

				var inventoryCode = $("#inventoryCode<? echo $a ?>").val();
				var stockCardNo = $("#stockCardNo<? echo $a ?>").val();
				var genericName = $("#genericName<? echo $a ?>").val();
				var currentQTY = $("#qty<? echo $a ?>").val();
				var endingQTY = $("#endingQTY<? echo $a ?>").val();
				var data = 'inventoryCode='+inventoryCode+'&stockCardNo='+stockCardNo+'&currentQTY='+currentQTY+'&endingQTY='+endingQTY;
				$("#modalMessage").text("Ending Inventory Added for "+genericName);

				if($("#endingQTY<? echo $a ?>").val() == "" || $("#endingQTY<? echo $a ?>") < 1) {
				$("#modalMessage").text("Error! No value for "+genericName);
				}else {
					$.ajax({
						type: "POST",
						url: "endingInventory1.php",
						data: data, 
						cache: false,
						success: function(result){
							$("#myModal").modal();
							$("#save<? echo $a ?>").hide();
						}
					});
					return false;
				}
			});

			$("#suppliesButton").click(function(){
				window.location.href='endingInventory.php?inventoryType=supplies';
			});

			$("#medicineButton").click(function() {
				window.location.href='endingInventory.php?inventoryType=medicine';
			});

			$("#endingInventory").hide();
			$("#checkBoxes<? echo $a ?>").hide();
			$("#deleteButton").hide();
			$("#beginningButton").hide();
			$("#deleteStatus<? echo $a ?>").hide();
			$("#hasEnding<? echo $a ?>").hide();

			$("#deleting").click(function(){
				$("#checkBoxes<? echo $a ?>").show();
				$("#hasEnding<? echo $a ?>").hide();
				$("#endingInventory").show();
				$("#inventory").hide();
				$("#save<? echo $a ?>").hide();
				$("#deleteButton").show();
				$("#beginningButton").hide();
				$("#formControl").attr("action","delete_noEndingInventory.php");
				$("#ending").attr("class","btn btn-default btn-sm");
				$("#deleting").attr("class","btn btn-info btn-sm");
				$("#beginning").attr("class","btn btn-default btn-sm");
			});

			$("#ending").click(function() {
				$("#checkBoxes<? echo $a ?>").hide();
				$("#endingInventory").hide();
				$("#deleteButton").hide();
				$("#beginningButton").hide();
				$("#inventory").show();
				$("#save<? echo $a ?>").show();
				$("#ending").attr("class","btn btn-info btn-sm");
				$("#deleting").attr("class","btn btn-default btn-sm");
				$("#beginning").attr("class","btn btn-default btn-sm");
			});

			$("#beginning").click(function() {
				$("#ending").attr("class","btn btn-default btn-sm");
				$("#deleting").attr("class","btn btn-default btn-sm");
				$("#beginning").attr("class","btn btn-info btn-sm")
				$("#hasEnding<? echo $a ?>").show();
				$("#checkBoxes<? echo $a ?>").hide();
				$("#save<? echo $a ?>").hide();
				$("#deleteButton").hide();
				$("#beginningButton").show();
				$("#formControl").attr("action","makeBeginning.php");
			})

		});
	</script>
	<? } ?>
</head>
<body>
	<form id="formControl" method="post">
	<div id="mainContainer" class="container">
  		<h2>Inventory</h2>
				
  				<div class="btn-group" role="group">
  					<button type="button" id="ending" class="btn btn-info btn-sm">Ending Inventory</button>
  					<button type="button" id="deleting" class="btn btn-default btn-sm">Deleting Inventory</button>
  					<button type="button" id="beginning" class="btn btn-default btn-sm">Beginning Inventory</button>
  				</div>
  				<br><br>
  				<div class="btn-group" role="group">
  				<? if($inventoryType == "medicine") { ?>
  					 <button type="button" id="medicineButton" class="btn btn-info">Medicine</button>
  					 <button type="button" id="suppliesButton" class="btn btn-default">Supplies</button>
  				<? }else { ?>
  					 <button type="button" id="medicineButton" class="btn btn-default">Medicine</button>
  					 <button type="button" id="suppliesButton" class="btn btn-info">Supplies</button>
  				<? } ?>
  				</div>

  				<table class="table table-hover" id="inventoryTable">
    				<thead>
      					<tr>
      					<th></th>
      					<th>#</th>
        				<th>Generic</th>
        				<th>Brand</th>
        				<th>QTY</th>
        				<th><div class="col-sm-offset-2">Ending</div></th>
        				<th></th>
      					</tr>
    				</thead>
    				<tbody>
    					<? for($a=0,$b=0,$c=0,$d=0,$e=0;$a<$genericNameNo,$b<$brandNo,$c<$inventoryCodeNo,$d<$countStockCard,$e<$qtyNo;$a++,$b++,$c++,$d++,$e++) { ?>	
    						<tr>
    							<input type="hidden" id="genericName<? echo $a ?>" value="<? echo $generic[$a] ?>">
    							<input type="hidden" id="inventoryCode<? echo $a ?>" value="<? echo $inventoryCode[$c] ?>">
    							<input type="hidden" id="stockCardNo<? echo $a ?>" value="<? echo $stockCardNo[$d] ?>">
    							<input type="hidden" id="qty<? echo $a ?>" value="<? echo $qty[$e] ?>">
    							
    							<? if($ro1->selectNow("endingInventory","endingQTY","inventoryCode",$inventoryCode[$c]) < 1) { ?>


    							<? if($ro1->selectNow("endingInventory_deleted","deleteNo","inventoryCode",$inventoryCode[$c]) < 1) { ?>
    							<td><input type="checkbox" id="checkBoxes<? echo $a ?>" name="inventoryCode[]" value="<? echo $inventoryCode[$c] ?>" checked="checked"></td>
    							<? }else { ?>
    							<td></td>
    							<? } ?>

    							<? }else { ?>
    							<td><input type="checkbox" id="hasEnding<? echo $a ?>" name="inventoryCode[]" value="<? echo $inventoryCode[$c] ?>" checked="checked"></td>
    							<? } ?>


    							<td><? echo $inventoryCode[$c] ?></td>
    							<td><? echo $generic[$a] ?></td>
    							<td><? echo $brand[$b] ?></td>
    							<td><? echo $qty[$e] ?></td>
    							<td><div class="col-xs-7"><input class="form-control" type="text" id="endingQTY<? echo $a ?>" value="<? echo $ro1->selectNow("endingInventory","endingQTY","inventoryCode",$inventoryCode[$c]) ?>"></div></td>
    						
    							<? if($ro1->selectNow("endingInventory","endingQTY","inventoryCode",$inventoryCode[$c]) < 1) { ?>
    							<td><button type="button" id="save<? echo $a ?>" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal">Save</button></td>
    							<? }else { ?>
    							<td></td>
    							<? } ?>
     						
     						</tr>
     					<? } ?>
    				</tbody>
  					</table>
	</div>
	<br>
	<center>
	<button id="deleteButton" class="btn btn-danger">Delete Inventory</button>
	<button id="beginningButton" class="btn btn-danger">Create Beginning Inventory</button>
	</center
	><br><br>
	</form>

	<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Inventory</h4>
        </div>
        <div class="modal-body">
          <p id="modalMessage"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
</body>
</html>