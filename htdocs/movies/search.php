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
	echo "<center>";
	echo ("<p><a href=searchform.php class='add'>Another Search</a></p>"); 
	echo ("<p><a href=menu.php class='add'>Home</a></p>"); 
	//formulate the search query
	if (!empty($_POST['id'])||!empty($_POST['Title'])||!empty($_POST['Year'])
		||!empty($_POST['Genre'])){
		$id = mysqli_real_escape_string($dbc, $_POST['id']); 
		$Title = mysqli_real_escape_string($dbc, $_POST['Title']); 
		$Year = mysqli_real_escape_string($dbc, $_POST['Year']); 
		$Genre = mysqli_real_escape_string($dbc, $_POST['Genre']); 
		
		$query="SELECT * FROM movies WHERE (Title LIKE '%$Title%')
		AND (Year LIKE '%$Year%')
		AND (Genre LIKE '%$Genre%')";
	}else {
		$query="SELECT * FROM movies";
	}
	$result = @mysqli_query ($dbc, $query);
	$num = mysqli_num_rows($result);
	if ($num > 0) { // If it ran OK, display all the records.
		echo "<p><b>Your search returns $num entries.</b></p>";
		echo "<table cellpadding=5 cellspacing=5 border=1><tr>
		<th>Title</th><th>Year</th><th>Genre</th><th>*</th><th>*</th></tr>"; 
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			echo "<tr><td>".$row['Title']."</td>"; 
			echo "<td>".$row['Year']."</td>"; 
			echo "<td>".$row['Genre']."</td>"; 
			echo "<td><a href=deleteconfirm.php?id=".$row['ID'].">Delete</a></td>"; 
			echo "<td><a href=updateform.php?id=".$row['ID'].">Update</a></td></tr>"; 
		} // End of While statement
		echo "</table>"; 
		       
	} else { // If it did not run OK.
		echo '<p>Your search has no result.</p>';
	}
	mysqli_close($dbc); // Close the database connection.
	echo ("</center>"); 
	//include the footer
	include ("../includes/footer.php");
}

?>