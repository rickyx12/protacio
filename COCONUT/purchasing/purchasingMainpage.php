<? require_once "../authentication.php" ?>
<? include "../../myDatabase4.php" ?>
<? $ro4 = new database4() ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Purchasing</title>
		<script src="../js/jquery-2.1.4.min.js"></script>
		<script src="../js/jquery-ui.min.js"></script>
		<script src="../js/jquery.fixedMenu.js"></script>
		<script src="../js/open.js"></script>
		<link rel="stylesheet" href="../../bootstrap-3.3.6/css/bootstrap.css"></link>
		<link rel="stylesheet" href="../../Registration/menu/fixedMenu_style1.css"></link>
		<link rel="stylesheet" href="../myCSS/jquery-ui.css"></link>

		<script>
			$(document).ready(function(){
				$(".menu").fixedMenu();

				$("#viewPurchases").click(function(){
					open("POST","view-purchases.php",{fromDate:'<? echo date('Ymd') ?>',toDate:'<? echo date('Ymd') ?>'},"departmentX");
				});

				$("#pharmacy").click(function(){
					open('POST','dept-inventory.php',{inventoryLocation:'PHARMACY'},'departmentX');
				});

				$("#ER").click(function(){
					open("POST","dept-inventory.php",{inventoryLocation:'E.R'},'departmentX');
				});

				$("#OR").click(function(){
					open('POST','dept-inventory.php',{inventoryLocation:'OR'},'departmentX');
				});

				$("#nursing").click(function(){
					open('POST','dept-inventory.php',{inventoryLocation:'NURSING'},'departmentX');
				});

			});
		</script>

		<style>
			.breadcrumb {
				margin-bottom:0px;
			}

			.breadcrumb {background: rgba(10, 10, 10, 1); border: 0px solid rgba(245, 245, 245, 1); border-radius: 0px; display: block;}
			.breadcrumb li {font-size: 14px;}
			.breadcrumb a {color: rgba(66, 139, 202, 1);}
			.breadcrumb a:hover {color: rgba(250, 0, 38, 1);}
			.breadcrumb>.active {color: rgba(230, 230, 230, 1);}
			.breadcrumb>li+li:before {color: rgba(204, 204, 204, 1); content: "\2192\00a0";}

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
			<li><a href="../../LOGINPAGE/module.php">Home</a></li>
			<li class="active">Purchasing</li>
		</ol>
		<div class="menu">
			<ul>
				<li>
					<a href="#">Invoice<span class="arrow"></span></a>
					<ul>
						<a href="add-invoice.php" target="departmentX">Add Invoice</a>
						<a href="list-invoice.php" target="departmentX">View Invoice</a>
						<a href="#" id="viewPurchases">View Purchases</a>
						<a href="search-invoice.php" target="departmentX">Search Invoice</a>
					</ul>
				</li>

				<li>
					<a href="#">Stock Room</a>
					<ul>
						<a href="stock-room.php?inventoryType=medicine" target="departmentX">Medicine Stock</a>
						<a href="stock-room.php?inventoryType=supplies" target="departmentX">Supplies Stock</a>
					</ul>
				</li>

				<li>
					<a href="#">Inventory</a>
					<ul>
						<a href="#" id="pharmacy">Pharmacy</a>
						<a href="#" id="ER">E.R Emegency Kit</a>
						<a href="#" id="OR">OR Emergency Kit</a>
						<a href="#" id="nursing">NS Emergency Kit</a>
					</ul>
				</li>

				<li>
					<? if( $ro4->count_requesition() > 0 ) { ?>
						<a href="list-requesition.php" target="departmentX">
							Request 
							<span class="badge">
								<? echo $ro4->count_requesition() ?>
							</span>
						</a>
					<? }else { ?>
						<a href="list-requesition.php" target="departmentX">
							Request
						</a>
					<? } ?>

				</li>

			</ul>
		</div>
		<!--
		<iframe class="iframe" src="purchaseNull.php" style="border:1px solid red; width:97%;" onload="this.style.height=this.contentDocument.body.scrollHeight +'px';" name="departmentX" border="1"></iframe>
		-->
		<div class="row">
			<iframe src="purchaseNull.php" style="border:0px; width:100%; height:100%;" name="departmentX" border=1 frameborder=no></iframe>
		</div>
	</body>
</html>