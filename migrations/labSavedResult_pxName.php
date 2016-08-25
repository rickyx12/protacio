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
$sql = "ALTER TABLE labSavedResult
ADD COLUMN patientName VARCHAR(200) NOT NULL;
";

if ($conn->query($sql) === TRUE) {
    echo "ok";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>