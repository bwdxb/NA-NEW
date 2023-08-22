<?php
$servername = "db_na:3306";
$username = "na_user";
$password = 'TB#o98KJULJ$jYN';
$dbname = "na_db";

// Create connection
$conn = new mysqli();
$con = mysqli_connect($servername, $username, $password,$dbname);


// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>