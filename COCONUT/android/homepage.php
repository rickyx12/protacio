<?php include("../../myDatabase.php"); ?>
<?php $ro = new database(); ?>
<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Synapse System</title>
		<link rel="shortcut icon" href="../favicon.ico">
		<link rel="stylesheet" type="text/css" href="css/default.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<script src="js/modernizr.custom.js"></script>
		<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
  		<script type="text/javascript" charset="utf-8" src="js/jquery.leanModal.min.js"></script>
	</head>
	<body class="cbp-spmenu-push">
		<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
			<h3>Module</h3>
			<a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/android/loginpage.php?module=ADMIN" >Admin</a>
			<a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/android/loginpage.php?module=DOCTOR">Doctor</a>
			<a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/android/loginpage.php?module=LABORATORY">Laboratory</a>
			<a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/android/loginpage.php?module=PATIENT">Nursing</a>
			<a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/android/loginpage.php?module=CASHIER">Cashier</a>
			<a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/opdRegistration.php?module=REGISTRATION">Registration</a>
			<a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/android/loginpage.php?module=MAINTENANCE">Maintenance</a>
			<a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/android/loginpage.php?module=ER">E.R</a>
			<a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/android/loginpage.php?module=PHARMACY">Pharmacy</a>
			<a href="http://<?php echo $ro->getMyUrl(); ?>/COCONUT/android/loginpage.php?module=PHILHEALTH">PHILHEALTH</a>
		</nav>
		
		<div class="container">
			<header class="clearfix">
				<center><span>Synapse System</span>
			</header>
			<div class="main">
				<section>
					<!-- Class "cbp-spmenu-open" gets applied to menu -->
					<button id="showLeft">Staff Login</button>

					<button id="showLeft">MIMS</button>
				</section>
			</div>
		</div>



<div id="loginmodal" style="display:none;">
    <h1>User Login</h1>
    <form id="loginform" name="loginform" method="post" action="index.html">
      <label for="username">Username:</label>
      <input type="text" name="username" id="username" class="txtfield" tabindex="1">
      
      <label for="password">Password:</label>
      <input type="password" name="password" id="password" class="txtfield" tabindex="2">
      
      <div class="center"><input type="submit" name="loginbtn" id="loginbtn" class="flatbtn-blu hidemodal" value="Log In" tabindex="3"></div>
    </form>
  </div>


		<!-- Classie - class helper functions by @desandro https://github.com/desandro/classie -->
		<script src="js/classie.js"></script>
		<script>
	
$(function(){
  $('#loginform').submit(function(e){
    return false;
  });
  
  $('#modaltrigger').leanModal({ top: 110, overlay: 0.45, closeButton: ".hidemodal" });
});


		var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
				menuRight = document.getElementById( 'cbp-spmenu-s2' ),
				menuTop = document.getElementById( 'cbp-spmenu-s3' ),
				menuBottom = document.getElementById( 'cbp-spmenu-s4' ),
				showLeft = document.getElementById( 'showLeft' ),
				showRight = document.getElementById( 'showRight' ),
				showTop = document.getElementById( 'showTop' ),
				showBottom = document.getElementById( 'showBottom' ),
				showLeftPush = document.getElementById( 'showLeftPush' ),
				showRightPush = document.getElementById( 'showRightPush' ),
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
			showTop.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( menuTop, 'cbp-spmenu-open' );
				disableOther( 'showTop' );
			};
			showBottom.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( menuBottom, 'cbp-spmenu-open' );
				disableOther( 'showBottom' );
			};
			showLeftPush.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( body, 'cbp-spmenu-push-toright' );
				classie.toggle( menuLeft, 'cbp-spmenu-open' );
				disableOther( 'showLeftPush' );
			};
			showRightPush.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( body, 'cbp-spmenu-push-toleft' );
				classie.toggle( menuRight, 'cbp-spmenu-open' );
				disableOther( 'showRightPush' );
			};

			function disableOther( button ) {
				if( button !== 'showLeft' ) {
					classie.toggle( showLeft, 'disabled' );
				}
				if( button !== 'showRight' ) {
					classie.toggle( showRight, 'disabled' );
				}
				if( button !== 'showTop' ) {
					classie.toggle( showTop, 'disabled' );
				}
				if( button !== 'showBottom' ) {
					classie.toggle( showBottom, 'disabled' );
				}
				if( button !== 'showLeftPush' ) {
					classie.toggle( showLeftPush, 'disabled' );
				}
				if( button !== 'showRightPush' ) {
					classie.toggle( showRightPush, 'disabled' );
				}
			}

		</script>
	</body>
</html>
