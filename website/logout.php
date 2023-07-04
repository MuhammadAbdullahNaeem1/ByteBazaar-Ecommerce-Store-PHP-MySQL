<?php
include("include/connect.php");
session_start();
// Perform your desired action here
$aid = $_SESSION['aid'];
$query = "DELETE FROM CART WHERE aid = $aid";

$result = mysqli_query($con, $query);
$_SESSION['aid'] = -1;

$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect the user to the login page or home page
header("Location: login.php");
?>