<? require_once "../authentication.php" ?>
<? include "../../myDatabase.php" ?>
<? include "../../myDatabase4.php" ?>
<? $ro = new database() ?>
<? $ro4 = new database4() ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Operating Room</title>
		<script src="../js/jquery-2.1.4.min.js"></script>
		<script src="../js/jquery-ui.min.js"></script>
		<script src="../js/jquery.fixedMenu.js"></script>
		<script src="../js/open.js"></script>
		<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
		<link rel="stylesheet" href="../../Registration/menu/fixedMenu_style1.css"></link>
		<link rel="stylesheet" href="../myCSS/jquery-ui.css"></link>
		<link rel="stylesheet" href="../myCSS/breadcrumb.css"></link>

		<script>
			$(document).ready(function(){
				$(".menu").fixedMenu();


				$("#searchPx").click(function(){
					var data = {
						username:'<? echo $ro->selectNow('registeredUser','username','employeeID',$_SESSION['employeeID']) ?>',
						module:'OR',
						'patientSearch':''
					};
					open("POST","../currentPatient/patientInterface.php",data,'_blank')
				});

				$("#pendingRequest").click(function(){
					open("POST","../requestition/pending-request.php",{module:'OR'},"departmentX");
				});

				$("#toDispense").click(function(){
					open("POST","../inventory/to-dispense-dept.php",{inventoryLocation:'OR'},'departmentX');
				});	

				$("#returnInventory").click(function(){
					open("POST","../inventory/return-inventory.php",{inventoryLocation:'OR'},'departmentX');
				});				

			});

		</script>

		<style>
			.row {
				height: 600px;
				max-width: 100%;
			}
		
			body {
				overflow-x:hidden; 
			}

		</style>

	</head>
	<body>
		<ol class="breadcrumb">
			<li><a href="../session/out.php">Home</a></li>
			<li class="active">Operating Room</li>
		</ol>
		<div class="menu">
			<ul>
				<li>
					<a href="#">Patient<span class="arrow"></span></a>
					<ul>
						<a href="#" id="searchPx">Search Patient</a>
					</ul>
				</li>

				<li>
					<a href="#">Census</a>
					<ul>
						<a href="../Reports/Census/selectShift_registered.php" target="departmentX">Registration Census</a>
					</ul>
				</li>

				<li>
					<a href="#">Inventory</a>
					<ul>
						<a href="../inventory/ekit.php" target="departmentX">E-KIT Inventory</a>
						<a href="../requestition/generateRequesitionNo.php" target="departmentX">Request Inventory</a>
						<? if( $ro4->count_pending_request("OR") > 0 ) { ?>
							<a href="#" id="pendingRequest" >
								Pending Inventory Request 
								<span class="badge">
									<? echo $ro4->count_pending_request("OR") ?>
								</span>
							</a>
						<? }else { ?>
							<a href="#">
								Pending Request
							</a>
						<? } ?>

						<a href="#" id="returnInventory" >
							Return Inventory
								<? if( $ro4->count_return_inventory('OR') > 0 ) { ?>
									<span class="badge">
										<?
											echo $ro4->count_return_inventory('OR')
										?>
									</span>
								<? }else { } ?>
						</a>

					</ul>
				</li>

				<li>
					<a href="#" id="toDispense">
						Dispensing
						<? if( $ro4->count_dept_dispense('OR') > 0 ) { ?>
							<span class="badge">
								<?
									echo $ro4->count_dept_dispense('OR')
								?>
							</span>
						<? }else { } ?>
					</a>
				</li>				

			</ul>
		</div>
		<div class="row">
			<iframe src="orNull.php" style="border:0px; width:100%; height:100%;" name="departmentX" border=1 frameborder=no></iframe>
		</div>
	</body>
</html>