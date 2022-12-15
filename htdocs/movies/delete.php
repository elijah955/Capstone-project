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
	require_once ('../../mysqli_connect.php');
	$id=$_GET['id']; 
	$query = "DELETE FROM movies WHERE id=$id"; 
	$result = @mysqli_query ($dbc, $query);
	if ($result){
		echo "<center>";
		echo "The selected movie has been deleted."; 
	}else {
		echo "The selected movie could not be deleted."; 
	}
	echo "<p><a href=menu.php class='add'>Home</a></p>";
	echo "</center>"; 
	mysqli_close($dbc);
	//include the footer
	include ('../includes/footer.php');
}

?>
