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
	$first_name = mysqli_real_escape_string($dbc, $_POST['first_name']); 
	$last_name = mysqli_real_escape_string($dbc, $_POST['last_name']); 
	$phone = mysqli_real_escape_string($dbc, $_POST['phone']); 
	$address = mysqli_real_escape_string($dbc, $_POST['address']);
	$email = mysqli_real_escape_string($dbc, $_POST['email']); 
	$id = mysqli_real_escape_string($dbc, $_POST['id']); 

	$query = "UPDATE customers SET first_name='$first_name',last_name='$last_name',phone='$phone',address='$address', email='$email' WHERE id='$id'"; 
	$result = @mysqli_query ($dbc, $query); 
	if ($result){
		echo "<center><p><b>The selected customer record has been updated.</b></p>"; 
		echo "<a href=menu.php class='add'>Home</a></center>"; 
	}else {
		echo "<p>The record could not be updated due to a system error" . mysqli_error() . "</p>"; 
	}
	mysqli_close($dbc);
	//include the footer
	include ("../includes/footer.php");
}

?>