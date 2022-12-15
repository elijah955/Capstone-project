<?php 

// This page lets the user logout.
session_start(); 

// If no session variable exists, redirect the user.
if (!isset($_SESSION['emp_id'])) {
	header("Location: index.php");
	exit(); // Quit the script.
} else { // Cancel the session.
	$_SESSION = array(); // Destroy the variables.
	session_destroy(); // Destroy the session itself.
}

// Include the header code.
include ('../includes/header.php');

// Print a customized message.
echo "<center>";
echo "<h1>Logged Out!</h1>
<div>You are now logged out!</div>
<br /><br />";

echo ("<a href=../Home/login.php class='add'>Login</a> ");
echo "<center>";

include ('../includes/footer.php');
?>
