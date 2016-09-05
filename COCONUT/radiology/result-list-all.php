<?

	include "../../myDatabase.php";
	include "../../myDatabase4.php";

	$ro = new database();
	$ro4 = new database4();

	if( isset($_POST['month']) ) {
		$month = $_POST['month'];
	}else {
		$month = date("m");
	} 

	if( isset($_POST['year']) ) {
		$year  = $_POST['year'];
	}else {
		$year = date("Y");
	}

	$monthWord = array(
			"01" => "January",
			"02" => "February",
			"03" => "March",
			"04" => "April",
			"05" => "May",
			"06" => "June",
			"07" => "July",
			"08" => "August",
			"09" => "September",
			"10" => "October",
			"11" => "November",
			"12" => "December"
		);

	$from = $year."-".$month."-"."01";
	$to = $year."-".$month."-"."31";

	$ro4->list_uploaded_files($from,$to);
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

  		<? if( $ro4->list_uploaded_files_fileNo() != "" ) { ?>
	  		<? foreach( $ro4->list_uploaded_files_fileNo() as $fileNo ) { ?>
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
		<form method="post" action="result-list-all.php">
			<div class="row">
				<div class="col-md-2">
					<select id="month" name="month" class="form-control">
						<option value="<? echo $month ?>"><? echo $monthWord[$month] ?></option>
						<option value="01">January</option>
						<option value="02">February</option>
						<option value="03">March</option>
						<option value="04">April</option>
						<option value="05">May</option>
						<option value="06">June</option>
						<option value="07">July</option>
						<option value="08">August</option>
						<option value="09">September</option>
						<option value="10">October</option>
						<option value="11">November</option>
						<option value="12">December</option>
					</select>
				</div>
				<div class="col-md-1">
					<input type="text" name="year" class="form-control" value="<? echo $year ?>">
				</div>
				<div class="col-md-1">
					<input type="submit" class="btn btn-info" value="Proceed">
				</div>			
			</div>
		</form>
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
						<? if( $ro4->list_uploaded_files_fileNo() != "" ) { ?>
							<? foreach( $ro4->list_uploaded_files_fileNo() as $fileNo ) { ?>
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