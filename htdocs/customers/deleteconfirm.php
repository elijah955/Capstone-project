<?php
session_start();
if (!isset($_SESSION['emp_id'])){
	echo "You are not logged in!<br>";
	echo ("<a href=https://www.ejfranks.uwmsois.com/Capstone/htdocs/Home/login.php>Login here</a><p>");
	exit();
}else{
	include ('../includes/header.php');
	require_once ('../../mysqli_connect2.php');
	$id=$_GET['id']; ; 
	$query = "SELECT * FROM customers WHERE id=$id"; 
	$result = @mysqli_query ($dbc, $query);
	$num = mysqli_num_rows($result);
	if ($num > 0) { 
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			echo "<center>";
			echo "<h2>";
			echo $row['first_name']." ".$row['last_name']."<br>".$row['phone'];
			echo "</h2>";
		} 
		echo "Are you sure that you want to delete this customer?";
		echo "<br><br>";
		echo "<a href=delete.php?id=".$id." class='delete'>YES</a> 
			<a href=index.php class='no'>NO</a>";          
	}else{ 
		echo '<p>There is no such record.</p>';
		echo '</center>';
	}
	mysqli_close($dbc);
		include ('../includes/footer.php');
}
?>
