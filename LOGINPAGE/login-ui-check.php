<?
	session_start();
	include "homeDatabase.php";
	$username = $_POST['username'];
	$password = $_POST['password'];
	$module = $_POST['module'];
	$from = $_POST['from'];

	$synapse = new synapse();

	$synapse->check_user($username,$password,$module);


	if( $synapse->check_user_employeeID() > 0 ) {
		echo "1-".$username;
		foreach( $synapse->check_user_employeeID() as $employeeID ) {
			$_SESSION['employeeID'] = $employeeID;
		}
	}else {
		echo "0";
	}

?>