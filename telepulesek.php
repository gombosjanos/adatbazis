<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Települések</title>	
    <link rel="stylesheet" type="text/css" href="css/telepules.css">

</head>
<body>

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

$result = mysqli_query($conn,"SELECT * FROM Telepulesek");

echo "<table border='1'>
<tr>
<th>Irányítószám</th>
<th>Név</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['iranyitoszam'] . "</td>";
echo "<td>" . $row['nev'] . "</td>";
echo "</tr>";
}
echo "</table>";

mysqli_close($conn);
?>
</body>
</html>
