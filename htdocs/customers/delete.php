<?php
session_start();
if (!isset($_SESSION['emp_id'])){
	echo "You are not logged in!<br>";
	echo ("<a href=https://www.ejfranks.uwmsois.com/Capstone/htdocs/Home/login.php>Login here</a><p>");
	exit();
}else{
	include ('../includes/header.php');
	require_once ('../../mysqli_connect2.php');
	$id=$_GET['id']; 
	$query = "DELETE FROM customers WHERE id=$id"; 
	$result = @mysqli_query ($dbc, $query);
	if ($result){
		echo "<center>";
		echo "The selected customer record has been deleted."; 
	}else {
		echo "The selected customer record could not be deleted."; 
	}
	echo "<p><a href=index.php class='add'>Home</a></p>"; 
	echo "</center>";
	mysqli_close($dbc);
	include ('../includes/footer.php');
}

?>
