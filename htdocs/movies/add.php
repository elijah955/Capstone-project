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
if (isset($_POST['submitted'])){
		$Title=$_POST['Title'];  
		$Year=$_POST['Year']; 
		$Genre=$_POST['Genre']; 
		$query="INSERT INTO movies (Title, Year, Genre)
			Values ('$Title', '$Year', '$Genre')";
		$result=@mysqli_query ($dbc, $query); 
		if ($result){
			echo "<center><h2>A new movie has been added.</h2>"; 
			echo "<a href=menu.php class='add'>Show All movies</a></center>"; 
		}else {
			echo "<p>The record could not be added due to a system error.</p>"; 
		}
	} // only if submitted by the form
	mysqli_close($dbc);
?>

<center>
	<h2>Enter the following to add a movie to the database:</h2>
	<h3 id="slash">NOTE: If title contains symbols, type a backslash before the symbol to prevent an error. <br>Example: What\'s Up\? </h3>
	<form action="add.php" method="post">
	<input name="Title" class="form" size=50 placeholder="Title" required value="<?php if (isset($_POST['Title'])) echo $_POST['Title']; ?>" />
	<input name="Year" class="form" size=50 placeholder="Release Year" required value="<?php if (isset($_POST['Year'])) echo $_POST['Year']; ?>" />
	<input name="Genre" class="form" size=50 placeholder="Genre" required value="<?php if (isset($_POST['Genre'])) echo $_POST['Genre']; ?>" />
	<input type=submit value=Add class="submit">
		<a href="https://www.ejfranks.uwmsois.com/Capstone/htdocs/movies/menu.php" class="cancel">Cancel</a>
	<input type="hidden" name="submitted" value="true">
	</form>
</center>

<?
	//include the footer
	include ("../includes/footer.php");
}
?>
