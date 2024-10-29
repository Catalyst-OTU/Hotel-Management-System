<?php

// $server = "localhost";
// $username = "bluebird_user";
// $password = "password";
// $database = "bluebirdhotel";

// $conn = mysqli_connect($server,$username,$password,$database);

// if(!$conn){
//     die("<script>alert('connection Failed.')</script>");
// }
// else{
//     echo "<script>alert('connection successfully.')</script>";
// }

// Cloud Database configuration
$host = 'sql206.ezyro.com';    // Your database host
$username = 'ezyro_29068185';     // Your database username
$password = 'mc3a3pix';         // Your database password
$database = 'ezyro_29068185_hotel_management'; // Your database name

// Create a new mysqli instance and connect to the database
$conn = new mysqli($host, $username, $password, $database);



// // Localhost Database configuration
// $host = 'localhost';    // Your database host
// $username = 'root';     // Your database username
// $password = '';         // Your database password
// $database = 'bluebirdhotel'; // Your database name

// // Create a new mysqli instance and connect to the database
// $conn = new mysqli($host, $username, $password, $database);



?>