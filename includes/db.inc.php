<?php

$servername = "localhost";
$username = "Jani";
$password = "xldPl3vWywo0Clkg";
$dbname = "teszt";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";

?>