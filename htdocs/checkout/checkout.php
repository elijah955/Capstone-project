<?php
session_start();
//check session first
if (!isset($_SESSION['emp_id'])){
	echo "You are not logged in!<br>";
	echo ("<a href=https://www.ejfranks.uwmsois.com/Capstone/htdocs/Home/login.php>Login here</a><p>");
	exit();
}else{
	//include the header
	include ('../includes/header.php');
	require_once ('../../mysqli_connect2.php');
	echo ("<center>"); 
	echo ("<h2>Use the separate system for actual payment processing. Follow link below to change record of payment for customer.</h2>");
	echo ("<p><a href=checkout2.php class='add'>Update Payment Information</a></p><br>"); 
	
	include ('../includes/footer.php');
}
?>
