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
	echo ("<h2>This tool runs the report that displays which customers have an outstanding balance.</h2>");
	echo ("<p><a href=reportrun.php class='add'>Run report</a></p>"); 
	include ('../includes/footer.php');
}
?>
