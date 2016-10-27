<? require_once "../authentication.php" ?>
<? include "../../myDatabase4.php" ?>
<? $ro4 = new database4() ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Doctor</title>
		<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
		<script src="../js/jquery-ui.min.js"></script>
		<script src="../js/jquery.fixedMenu.js"></script>
		<script src="../js/open.js"></script>
		<link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css"></link>
		<link rel="stylesheet" href="../../Registration/menu/fixedMenu_style1.css"></link>
		<link rel="stylesheet" href="../myCSS/jquery-ui.css"></link>

		<script>
			$(document).ready(function(){

				var doctorCode = '<? echo $_SESSION['employeeID'] ?>';
				
				$(".menu").fixedMenu();

				$("#opd").click(function(){
					open("POST","doctor-opd-date.php",{doctorCode:doctorCode},"departmentX");
				});

				$("#completedPatient").click(function(){
					open("POST","completed-patient-date.php",{doctorCode:doctorCode},"departmentX");
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
			<li><a href="../session/out.php">Home</a></li>
			<li class="active">Doctor</li>
		</ol>
		<div class="menu">
			<ul>
				<li>
					<a href="#">Patients<span class="arrow"></span></a>
					<ul>
						<a href="#" id="opd">Outpatient</a>
						<a href="#">Inpatient</a>
					</ul>
				</li>
			</ul>

			<ul>
				<li>
					<a href="#">Reports<span class="arrow"></span></a>
					<ul>
						<a href="#" id="completedPatient">Completed Patients</a>
					</ul>
				</li>
			</ul>

		</div>
		<!--
		<iframe class="iframe" src="purchaseNull.php" style="border:1px solid red; width:97%;" onload="this.style.height=this.contentDocument.body.scrollHeight +'px';" name="departmentX" border="1"></iframe>
		-->
		<div class="row">
			<iframe src="doctorNull.php" style="border:0px; width:100%; height:100%;" name="departmentX" border=1 frameborder=no></iframe>
		</div>
	</body>
</html>