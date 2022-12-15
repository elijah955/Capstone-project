<?php
session_start();
//check session first
if (!isset($_SESSION['emp_id'])){
	echo "You are not logged in!<br>";
	echo ("<a href=https://www.ejfranks.uwmsois.com/Capstone/htdocs/Home/login.php>Login here</a><p>");
	exit();
}else{
	//include the header
	include ("../includes/header.php");
	require_once ('../../mysqli_connect.php');
	$id=$_GET['id']; 
	$query = "SELECT * FROM movies WHERE id=$id"; 
	$result = @mysqli_query ($dbc, $query);
	$num = mysqli_num_rows($result);
	if ($num > 0) { // If it ran OK, display all the records.
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
?>
		<center>
			<form action="update.php" method="post">
				<h2>Update this movie record below:</h2>
					<p>Title: <input name="Title" size=50 value="<? echo $row['Title']; ?>"></p>
					<p>Year: <input name="Year" size=50 value="<? echo $row['Year']; ?>"></p>
					<p>Genre: <input name="Genre" size=50 value="<? echo $row['Genre'];?>"></p>
					<input type=submit value=Update class="submit">
					<a href="https://www.ejfranks.uwmsois.com/Capstone/htdocs/movies/menu.php" class="cancel">Cancel</a>
					<input type=hidden name="id" value="<? echo $row['ID']; ?>">
			</form>
		</center>
<?
		} //end while statement
	} //end if statement
	mysqli_close($dbc);
	//include the footer
	include ("../includes/footer.php");
}
?>





