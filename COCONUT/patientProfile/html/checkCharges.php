<? include "../../../myDatabase.php" ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Check Charges</title>
  <script language="javascript" src="../../../jquery1.11.1.js"></script>
  <link rel="stylesheet" href="../../../bootstrap-3.3.6/css/bootstrap.min.css">
 <script src="../../../bootstrap-3.3.6/js/bootstrap.min.js"></script>

 <script>

 		function loadTable() {
	        $.getJSON("../checkCharges.php",{ registrationNo:"<? echo $_GET['registrationNo'] ?>" },function(result){
        		var table = "";
        		var status = "";
            	$.each(result, function(i,field){
            		table += "<tr>";
            		if(field.checked == "check") {
            		table += "<td><a href='#' id='checker' style='text-decoration:none; color:orange;' onclick='checkNow("+field.itemNo+")'>"+field.description+"</a></td>";
            		}else {
            		table += "<td><a href='#' id='checker' style='text-decoration:none; color:black;' onclick='checkNow("+field.itemNo+")'>"+field.description+"</a></td>";
            		}
            		table += "<td>"+field.sellingPrice+"</td>";
            		table += "<td>"+field.total+"</td>";
            		table += "<td>"+field.cashUnpaid+"</td>";
            		table += "<td>"+field.company+"</td>";
            		table += "<td>"+field.phic+"</td>";
            		table += "<td>"+field.chargeBy+"</td>";
            		table += "<td>"+field.timeCharge+"</td>";
            		table += "<td>"+field.dateCharge+"</td>";
            		table += "</tr>";
            		               
            });
            	$("#charges").html(table);

        });

 		}

 	 	function checkNow(itemNo1,status){
            $.ajax({
            	type:"GET",
            	url:"../checkCharges1.php",
            	data:{"itemNo":itemNo1,"checked":status},
            	success:function() {
            		loadTable();
            	}
            })     
 		}

 	$(document).ready(function() {
 		loadTable();
 		/*
 		$.ajax({
 			data:"GET",
 			url:"checkCharges.html",
 			data:{registrationNo:"27064"},
 			success:function() {
 				loadTable();
 			}
 		});
		*/

	 });
 </script>


</head>
<body>
    <? $ro = new database() ?>
    <? $ro->getPatientProfile($_GET['registrationNo']); ?>
	<div class="container">
	<h3><? echo $ro->getPatientRecord_lastName().", ".$ro->getPatientRecord_firstName() ?> Charges</h3>
	<p>Charges</p>
	<table class="table table-hover table-responsive">
		<thead>	
			<tr>
			<th>Description</th>
			<th>Price</th>
			<th>Total</th>
			<th>Cash</th>
			<th>Company</th>
			<th>PhiilHealth</th>
			<th>User</th>
			<th>Time</th>
			<th>Date</th>
			</tr>
		</thead>
		<tbody id="charges">
		</tbody>
	</table>
	</div>
</body>
</html>