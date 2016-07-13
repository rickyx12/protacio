<?php
	include "../myDatabase.php";
	$ro = new database();
    $toDay = date('m-d-Y');
    $time = date('g:ia');

    $dbhost =   $_SERVER['DB_HOST'];
    $dbuser =  	$_SERVER['DB_USER'];
    $dbpass =   $_SERVER['DB_PASS'];
    $dbname =   $_SERVER['DB_DB'];

    exec("/opt/lampp/bin/mysqldump --user=$dbuser --password='$dbpass' --host=$dbhost $dbname > /opt/lampp/htdocs/COCONUT/DB_Backup/".$toDay."_".$time."_DB.sql",$output,$return);

	// Return will return non-zero upon an error
	if (!$return) {
	    echo "Database Backup Created:
	    <br>
	    Filename: <b>".$toDay."_".$time."_DB.sql</b> &nbsp;&nbsp;<a href='http://".$ro->getMyUrl()."/COCONUT/DB_Backup/".$toDay."_".$time."_DB.sql' download='".$toDay."_".$time."_DB.sql'><font size=2 color=red>[Download]</font></a>";

	    echo "<br><br>";
	 	echo "<b>Disk Status</b><br>";
	    $out = shell_exec('df -H /');
	    print(nl2br($out));


	} else {
	    echo "Database Backup Failed =(  ";
	}    

?>