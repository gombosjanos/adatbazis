<?php

$servername = "localhost";
$username = "jani";
$password = "C1NJCCoC7BA5tT9u";
$dbname = "teszt";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";

?>
