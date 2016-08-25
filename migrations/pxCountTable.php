<?php
$servername = $_SERVER['DB_HOST'];
$username = $_SERVER['DB_USER'];
$password = $_SERVER['DB_PASS'];
$dbname = $_SERVER['DB_DB'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// sql to create table
$sql = "CREATE TABLE pxCount (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
pxCount INT(6) NOT NULL,
currentDate VARCHAR(30) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table pxCount created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>