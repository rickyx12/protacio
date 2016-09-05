<?

	include "../../myDatabase.php";
	include "../../myDatabase4.php";

	if( isset($_POST['patientName']) ) {
		
		if( $_POST['patientName'] != "" ) {
			$patientName = $_POST['patientName'];
		}else {
			$patientName = "avoidLike";
		}
		
	}else {
		$patientName = "avoidLike";
	}

	$ro = new database();
	$ro4 = new database4();

	$ro4->search_uploaded_files($patientName);

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title></title>
  <script src="../js/jquery-2.1.4.min.js"></script>
  <script src="../js/open.js"></script>
  <script src="../js/sweetalert/dist/sweetalert.min.js"></script>
  <link rel="stylesheet" href="../js/sweetalert/dist/sweetalert.css"></link>
  <link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
  <script>
  	$(document).ready(function(){

  		$("#searchBtn").click(function(){
  			
  			var pxName = $("#pxName").val();

  			$.post("result-list.php",{patientName:pxName},function(){
  				open("POST","result-list.php",{patientName:pxName},"_self");
  			});
  		});

  		$("#pxName").keypress(function(event){
  			if( event.which == 13 ) {

  				pxName = $("#pxName").val();
	  			
	  			$.post("result-list.php",{patientName:pxName},function(){
	  				open("POST","result-list.php",{patientName:pxName},"_self");
	  			});  				
  			}
  		});

  		<? if( $ro4->search_uploaded_files_fileNo() != "" ) { ?>
	  		<? foreach( $ro4->search_uploaded_files_fileNo() as $fileNo ) { ?>
		  		$("#remove<? echo $fileNo ?>").click(function() {

		  			swal({
		  				title:"Are you sure?",
		  				text:"You will not be able to recover this result. ",
		  				type: "warning",
		  				showCancelButton:true,
		  				confirmButtonColor:"#DD6B55",
		  				confirmButtonText: "Yes, Remove it!",
		  				closeOnConfirm: false				
		  			},
		  				function(){

		  					$.post("result-list-remove.php",{fileNo:'<? echo $fileNo ?>'},function(result){ 
		  						swal({
		  							title:"Deleted!",
		  							text:"Result has been deleted.",
		  							type:"success"
		  						},
		  							function(){
		  								location.reload();
		  							});
		  						
		  					});
		  				}
		  			);

		  		});
	  		<? } ?>
  		<? } ?>

  	});
  </script>
</head>
<body>
	<div class="container">
		<h3>Radiology Result</h3>
		<div class="row">
			<div class="col-md-4">
				<div class="input-group">
					<input type="text" id="pxName" class="form-control" placeholder="Enter Patient Name" autocomplete="off">
					<span class="input-group-btn">
						<button type="button" id="searchBtn" class="btn btn-info">
							Search
						</button>
					</span>
				</div>
			</div>
		</div>

		<div class="row">
			<h1></h1>
		</div>

		<div class="row">
			<div class="col-md-7">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Reg#</th>
							<th>Patient</th>
							<th>Procedure</th>
							<th>Date</th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<? if( $ro4->search_uploaded_files_fileNo() != "" ) { ?>
							<? foreach( $ro4->search_uploaded_files_fileNo() as $fileNo ) { ?>
								<tr>
									<td>
										<?
											echo $ro->selectNow("uploadedFiles","registrationNo","fileNo",$fileNo)
										?>
									</td>
									<td>
										<?
											echo strtoupper($ro->selectNow("uploadedFiles","patientName","fileNo",$fileNo));
										?>
									</td>
									<td>
										<?
											$itemNo = $ro->selectNow("uploadedFiles","itemNo","fileNo",$fileNo);
											echo $ro->selectNow("patientCharges","description","itemNo",$itemNo);
										?>
									</td>
									<td>
										<?
											echo $ro4->formatDate($ro->selectNow("uploadedFiles","dateUploaded","fileNo",$fileNo));
										?>
									</td>
									<td>
										<a href="../../<? echo $ro->selectNow("uploadedFiles","fileUrl","fileNo",$fileNo) ?>" style="color:black" download="<? echo $ro->selectNow("uploadedFiles","fileName","fileNo",$fileNo) ?>"><i class="glyphicon glyphicon-cloud-download"></i> Download</a>				
									</td>							
									<td>
										<a href="#" id="remove<? echo $fileNo ?>" style="color:red"><i class="glyphicon glyphicon-remove"></i> Remove</a>
									</td>
								</tr>
							<? } ?>
						<? }else { ?>
							<h1>No Results Available</h1>
						<? } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>
</html>