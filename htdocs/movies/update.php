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
	require_once ('../../mysqli_connect.php');
	#execute UPDATE statement
	$id = mysqli_real_escape_string($dbc, $_POST['id']); 
	$Title = mysqli_real_escape_string($dbc, $_POST['Title']); 
	$Year = mysqli_real_escape_string($dbc, $_POST['Year']); 
	$Genre = mysqli_real_escape_string($dbc, $_POST['Genre']); 

	$query = "UPDATE movies SET Title='$Title',Year='$Year',Genre='$Genre' WHERE id='$id'"; 
	$result = @mysqli_query ($dbc, $query); 
	if ($result){
		echo "<center><p><b>The selected movie record has been updated.</b></p>"; 
		echo "<a href=menu.php class='add'>Home</a></center>"; 
	}else {
		echo "<p>The movie record could not be updated due to a system error" . mysqli_error() . "</p>"; 
	}
	mysqli_close($dbc);
	//include the footer
	include ("../includes/footer.php");
}

?>
