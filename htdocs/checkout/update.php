<?php
session_start();
//check the session
if (!isset($_SESSION['emp_id'])){
	echo "You are not logged in!<br>";
	echo ("<a href=https://www.ejfranks.uwmsois.com/Capstone/htdocs/Home/login.php>Login here</a><p>");
	exit();
}else{
	//include the header
	include ("../includes/header.php");
	require_once ('../../mysqli_connect2.php');
	#execute UPDATE statement
	$payment = mysqli_real_escape_string($dbc, $_POST['payment']); 
	$balance = mysqli_real_escape_string($dbc, $_POST['balance']); 
	$id = mysqli_real_escape_string($dbc, $_POST['id']); 

	$query = "UPDATE customers SET payment='$payment',balance='$balance'WHERE id='$id'"; 
	$result = @mysqli_query ($dbc, $query); 
	if ($result){
		echo "<center>";
		echo "<h2>The selected record has been updated.</h2>"; 
		echo "<a href=checkout2.php class='add'>Back to list</a>"; 
	}else {
		echo "<p>The record could not be updated due to a system error" . mysqli_error() . "</p>"; 
		echo "</center>";
	}
	mysqli_close($dbc);
	//include the footer
	include ("../includes/footer.php");
}

?>
