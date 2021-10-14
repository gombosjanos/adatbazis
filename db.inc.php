<?php
$servername = "localhost";
$username = "phpteszt";
$password = "O32Qf8zS6nadJaq7";
$dbname = "teszt";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>
