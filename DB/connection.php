<?php 

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "flower_shop";

$conn = new mysqli($dbServername, $dbUsername, $dbPassword, $dbName);


// Check connection
// if ($connect -> connect_error) {
//   echo "Failed to connect to MySQL: " . $connect -> connect_error;
//   exit();
// }else{
//   echo "Connect Successfully" ; 
// }
?>