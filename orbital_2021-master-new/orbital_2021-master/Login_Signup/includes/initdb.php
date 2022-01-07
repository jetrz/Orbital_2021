<?php
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";

// Create connection
$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// Create database
$sql = "CREATE DATABASE IF NOT EXISTS orbitaldatabase;";

if ($conn->query($sql) === TRUE) {
  echo "Database created successfully <br>";
} else {
  echo "Error creating database: " . $conn->error . "<br>";
}

//mysqli_query($conn, $sql);
$conn->close();

$dbName = "orbitaldatabase";
// Create connection
$conn2 = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
// Check connection

if ($conn2->connect_error) {
  die("Connection failed: " . $conn2->connect_error);
}
// sql to create table
$createusers = "CREATE TABLE IF NOT EXISTS users (
    usersId int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    usersName varchar(128) NOT NULL,
    usersEmail varchar(128) NOT NULL,
    usersUid varchar(128) NOT NULL,
    usersPwd varchar(128) NOT NULL
);";

$createschedules = "CREATE TABLE IF NOT EXISTS schedules (
    userID int(11) NOT NULL,
    moduleCode varchar(256) NOT NULL,
    moduleName text NOT NULL,
    classNo varchar(256) NOT NULL,
    dayOn int(11) NOT NULL,
    startTime int(11) NOT NULL,
    endTime int(11) NOT NULL
);";

$createtasklist = "CREATE TABLE IF NOT EXISTS taskList (
	  listId int(255) PRIMARY KEY AUTO_INCREMENT NOT NULL,
	  userId varchar(255) NOT NULL,
	  listName varchar(255) NOT NULL
);";

$createtask = "CREATE TABLE IF NOT EXISTS tasks (
    taskId int(255) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    userId varchar(255) NOT NULL,
    listId int(255) NOT NULL,
    taskName varchar(128) NOT NULL,
    taskDeadline date,
    taskChecked int(1) NOT NULL	DEFAULT 0
);";


if ($conn2->query($createusers) === TRUE) {
    echo "Table users created successfully <br>";
} else {
    echo "Error creating table: " . $conn2->error . "<br>";
}

if ($conn2->query($createschedules) === TRUE) {
    echo "Table schedules created successfully <br>";
} else {
    echo "Error creating table: " . $conn2->error . "<br>";
}

if ($conn2->query($createtasklist) === TRUE) {
  echo "Table tasklist created successfully <br>";
} else {
  echo "Error creating table: " . $conn2->error . "<br>";
}

if ($conn2->query($createtask) === TRUE) {
  echo "Table tasks created successfully <br>";
} else {
  echo "Error creating table: " . $conn2->error . "<br>";
}

/*
mysqli_query($conn2, $createusers);
mysqli_query($conn2, $createschedules);
*/

?>