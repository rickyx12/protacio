<?php

class ending_inventory {

private $host;
private $username;
private $password;
private $db;

public function __construct() {
	$this->host = $_SERVER['DB_HOST'];
	$this->username = $_SERVER['DB_USER'];
	$this->password = $_SERVER['DB_PASS'];
	$this->database = $_SERVER['DB_DB'];
}


private $ending_inventory_endingNo;

public function ending_inventory_endingNo() {
	return $this->ending_inventory_endingNo;
}

public function ending_inventory($quarter) {

	$this->ending_inventory_endingNo = [];

	$connection = mysqli_connect($this->host,$this->username,$this->password,$this->database);      
	$result = mysqli_query($connection, "SELECT endingNo FROM endingInventory WHERE quarter = '$quarter' ") or die("Query fail: " . mysqli_error()); 
	while($row = mysqli_fetch_array($result)) {
		$this->ending_inventory_endingNo[] = $row['endingNo'];
	}
}

}