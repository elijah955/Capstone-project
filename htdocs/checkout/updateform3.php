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
		<h2>Update information for: <? echo $row['first_name']." ".$row['last_name']; ?></h2>
		<p>Payment Method: <input name="payment" size=50 value="<? echo $row['payment']; ?>"></p>
		<p>Balance Due: <input name="balance" size=50 value="<? echo $row['balance']; ?>"></p>
		<input type=submit value=Update class="submit">
		<a href="https://www.ejfranks.uwmsois.com/Capstone/htdocs/checkout/checkout2.php" class="cancel">Cancel</a>
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