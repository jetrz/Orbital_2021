<?php
$serverName = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "orbitaldatabase";

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
	die("Connection Failed: " . mysqli_connect_error());	
}

$altertable = "ALTER TABLE tasks
ALTER taskChecked SET DEFAULT '0'";

if ($conn->query($altertable) === TRUE) {
    echo "Column successfully altered<br>";
} else {
    echo "Error altering column: " . $conn->error . "<br>";
}

?>