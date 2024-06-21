<?php
$servername = "localhost";
$database = "pizzeria";
$username = "root";
$password = "";
$conn = new mysqli($servername, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
