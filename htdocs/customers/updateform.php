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
	$id=$_GET['id']; 
	$query = "SELECT * FROM customers WHERE id=$id"; 
	$result = @mysqli_query ($dbc, $query);
	$num = mysqli_num_rows($result);
	if ($num > 0) { // If it ran OK, display all the records.
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
?>
		<center>
			<form action="update.php" method="post">
				<h2>Update this customer record below:</h2>
					<p>First Name: <input name="first_name" size=50 value="<? echo $row['first_name']; ?>"></p>
					<p>Last Name: <input name="last_name" size=50 value="<? echo $row['last_name']; ?>"></p>
					<p>Phone #: <input name="phone" size=50 value="<? echo $row['phone']; ?>"></p>
					<p>Address: <input name="address" size=50 value="<? echo $row['address']; ?>"></p>
					<p>Email: <input name="email" size=50 value="<? echo $row['email']; ?>"></p>
					<input type=submit value=Update class="submit">
					<a href="https://www.ejfranks.uwmsois.com/Capstone/htdocs/customers/index.php" class="cancel">Cancel<a/>
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





