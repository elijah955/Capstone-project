<?php
session_start(); 
include ('../includes/header.php'); // Include the header file.
// Print a customized message:
if (!isset($_SESSION['emp_id'])){
	echo "<h1>You have not logged in yet!</h1>";
	echo('<h2><a href="../Home/login.php">LOGIN</a></h2>');
} else {
	echo "<center>";
	echo "<h1>Welcome, you are now logged in.</h1>";
	echo "</center>";
} 

include ('../includes/footer.php'); // Include the footer file.
?>
