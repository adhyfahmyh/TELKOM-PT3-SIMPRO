<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kpoptima2";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?><!-- 
    text-shadow: 10px black;.topnav .navindex span{
	margin-top: 20px;
} -->