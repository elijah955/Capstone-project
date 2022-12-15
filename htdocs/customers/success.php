<?php
session_start();
if (!isset($_SESSION['emp_id'])){
	echo "You are not logged in!<br>";
	echo ("<a href=https://www.ejfranks.uwmsois.com/Capstone/htdocs/Home/login.php>Login here</a><p>");
	exit();
}else{
	include ('../includes/header.php');
	require_once ('../../mysqli_connect2.php');
	echo ("<center>"); 
	echo "<center><h1><b>A new customer has been added.</b></h1>"; 
	echo "<a href=add.php>Add another customer.</a></center>"; 
	echo ("<a href=index.php>Back to customer functions.</a><p><br>"); 	
	include ('../includes/footer.php');
}
?>