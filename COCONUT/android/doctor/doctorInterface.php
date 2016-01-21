<?php
include("../../../myDatabase2.php");
session_start();
$employeeID = $_SESSION['employeeID'];
$module = $_SESSION['module'];
$username = $_SESSION['username'];
$ro = new database2();
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Sysnapse System Doctor</title>
		<link rel="shortcut icon" href="../favicon.ico">
		<link rel="stylesheet" type="text/css" href="../css/default.css" />
		<link rel="stylesheet" type="text/css" href="../css/component.css" />
		<script src="../js/modernizr.custom.js"></script>
	</head>
	<body class="cbp-spmenu-push">
		<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
			<h3>My Patient</h3>
			<a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/android/doctor/androidDoctor_handler.php?doctorCode=<?php echo $employeeID; ?>&username=<?php echo $username; ?>">Outpatient</a>
			<a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/Doctor/doctorModule/ipdPatient.php?module=DOCTOR&username=<?php echo $username; ?>&doctor=<?php echo $ro->getDoctorName($username,'DOCTOR'); ?>&employeeID=<?php echo $employeeID; ?> ">Inpatient</a>
			<a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/android/doctor/patientsResult.php?doctorCode=<?php echo $employeeID; ?>&username=<?php echo $username; ?>&module=DOCTOR">Laboratory</a>

<?php if( $ro->selectNow("Doctors","Specialization1","Name",$ro->selectNow("Doctors","Name","doctorCode",$employeeID)) == "RADIOLOGIST" || $ro->selectNow("Doctors","Specialization1","Name",$ro->selectNow("Doctors","Name","doctorCode",$employeeID)) == "OB-GYN SONOLOGIST" ) {  ?>

			<a href="http://<?php echo $ro->getMyUrl(); ?>/Department/selectShift.php?module=RADIOLOGY&username=<?php echo $username; ?>&branch=Consolacion" target="_blank">Request</a>

			<a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/radiology/doctorsPF.php" target="_blank">My Census</a>

			<a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/radiology/forApproval.php?doctorCode=<?php echo $employeeID; ?>&username=<?php echo $username; ?>&module=DOCTOR&checkz=no">For Approval Result</a>

			<a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/radiology/approvedDate.php?doctorCode=<?php echo $employeeID; ?>&username=<?php echo $username; ?>&module=DOCTOR">View Approved Result</a>


<?php }else { }  ?>

		</nav>
		<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s2">
			<h3>Menu</h3>
			<a href="#">Celery seakale</a>
			<a href="#">Dulse daikon</a>
			<a href="#">Zucchini garlic</a>
			<a href="#">Catsear azuki bean</a>
			<a href="#">Dandelion bunya</a>
			<a href="#">Rutabaga</a>
		</nav>
		<div class="container">
			<header class="clearfix">
				<span><center>Synapse System</center></span>
			</header>
			<div class="main">
				<section>
					<!-- Class "cbp-spmenu-open" gets applied to menu -->
					<button id="showLeft"><font size=4><i>My Patient</i></font></button>
					<form method="post" action="/mimsy/mimsySearch.php" target="_blank">
					<input type="hidden" name="username" value="<?php echo $username; ?>">
					<button><font size=4><i>MIMS</i></font></button>
					</form>
					<form method="post" action="/COCONUT/currentPatient/patientInterface.php" target="_blank">
					<input type="hidden" name="module" value="">
					<input type="hidden" name="patientSearch" value="">
					<input type="hidden" name="username" value="<?php echo $username; ?>">
					<button><font size=4><i>Search Px</i></font></button>
					</form>

					<form method="post" action="/COCONUT/Doctor/initializeDoctor.php">
					<button><font size=4><i>Sign Out</i></font></button>
					</form>

				</section>
			</div>
		</div>
		<!-- Classie - class helper functions by @desandro https://github.com/desandro/classie -->
		<script src="../js/classie.js"></script>
		<script>
			var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
				menuRight = document.getElementById( 'cbp-spmenu-s2' ),
				body = document.body;

			showLeft.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( menuLeft, 'cbp-spmenu-open' );
				disableOther( 'showLeft' );
			};
			showRight.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( menuRight, 'cbp-spmenu-open' );
				disableOther( 'showRight' );
			};

			function disableOther( button ) {
				if( button !== 'showLeft' ) {
					classie.toggle( showLeft, 'disabled' );
				}
				if( button !== 'showRight' ) {
					classie.toggle( showRight, 'disabled' );
				}
			}
		</script>
	</body>
</html>
