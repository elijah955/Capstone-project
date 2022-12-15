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
	$query = "SELECT * FROM movies WHERE id=$id"; 
	$result = @mysqli_query ($dbc, $query);
	$num = mysqli_num_rows($result);
	if ($num > 0) { // If it ran OK, display all the records.
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			echo "<center>";
			echo "<h2>";
			echo $row['Title']."<br>".$row['Year']."<br>".$row['Genre']; 
			echo "</h2>";
		} // End of While statement
		echo "Are you sure that you want to delete this movie?";
		echo "<br><br>";
		echo "<a href=delete.php?id=".$id." class='delete'>YES</a> 
			<a href=menu.php class='no'>NO</a>";          
	}else{ // If it dID not run OK.
		echo '<p>There is no such record.</p>';
		echo "</center>";
	}
	mysqli_close($dbc); // Close the database connection.
	//include the footer
		include ('../includes/footer.php');
}

?>
