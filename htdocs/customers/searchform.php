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
	require_once ('../../mysqli_connect2.php');
?>

<center>
	<table>
		<form action="search.php" method="post">
			<h2>Enter the name or phone number of the customer you are trying to locate.</h2>
		<tr>
			<input name="first_name" class="form" size=50 placeholder="First Name">
		</tr>
			<input name="last_name" class="form" size=50 placeholder="Last Name">
		</tr>
		<tr>
			<input name="phone" class="form" size=50 placeholder="Phone Number">
		</tr>
		<tr>
			<td>
				<input type=submit value=Search class="submit">
				<a href="https://www.ejfranks.uwmsois.com/Capstone/htdocs/customers/index.php" class="cancel">Cancel</a>
			</td>
		</tr>
		<input type=hidden name="id" value="<? echo $row['ID'];?>">
		</form>
	</table>
</center>	
<?
	//include the footer
	include ("../includes/footer.php");
}
?>