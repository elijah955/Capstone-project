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
?>
<center>
	<table>
	<form action="search.php" method="post">
	<h3>Enter the title, year, or genre of the movie you are trying to locate.</h3>
	<tr>
		<input name="Title" class="form" size=50 placeholder="Title">
	</tr>
	<tr>
		<input name="Year" class="form" size=50 placeholder="Release Year">
	</tr>
	<tr>
		<input name="Genre" class="form" size=50 placeholder="Genre">
	</tr>
	<tr>
		<td>
			<input type=submit value=Search class="submit">
			<a href="https://www.ejfranks.uwmsois.com/Capstone/htdocs/movies/menu.php" class="cancel">Cancel</a>
		</td>
	</tr>
	<input type=hidden name="id" value="<? echo $row['id'];?>">
	</form>
	</table>
</center>
<?
	//include the footer
	include ("../includes/footer.php");
}
?>