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
	require_once ('../../mysqli_connect2.php');
	echo "<center>";
	echo ("<a href=searchform.php class='add'>Another Search</a><p>"); 
	echo ("<a href=menu.php class='add'>Home</a><p>"); 
	//formulate the search query
	if (!empty($_POST['ID'])||!empty($_POST['first_name'])||!empty($_POST['last_name'])
		||!empty($_POST['phone'])||!empty($_POST['address'])||!empty($_POST['email'])){
		$first_name = mysqli_real_escape_string($dbc, $_POST['first_name']); 
		$last_name = mysqli_real_escape_string($dbc, $_POST['last_name']); 
		$phone = mysqli_real_escape_string($dbc, $_POST['phone']); 
		// $email = mysqli_real_escape_string($dbc, $_POST['email']);
		// $position = mysqli_real_escape_string($dbc, $_POST['position']); 
		// $id = mysqli_real_escape_string($dbc, $_POST['ID']);  
		
		$query="SELECT * FROM customers WHERE (first_name LIKE '%$first_name%')
		AND (last_name LIKE '%$last_name%')
		AND (phone LIKE '%$phone%')";
	}else {
		$query="SELECT * FROM customers";
	}
	$result = @mysqli_query ($dbc, $query);
	$num = mysqli_num_rows($result);
	if ($num > 0) { // If it ran OK, display all the records.
		echo "<p><b>Your search returns $num entries.</b></p>";
		echo "<table cellpadding=5 cellspacing=5 border=1><tr>
		<th>First Name</th><th>Last Name</th><th>Phone</th><th>Address</th><th>Email</th><th>*</th><th>*</th></tr>"; 
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			echo "<tr><td>".$row['first_name']."</td>"; 
			echo "<td>".$row['last_name']."</td>"; 
			echo "<td>".$row['phone']."</td>"; 
			echo "<td>".$row['address']."</td>"; 
			echo "<td>".$row['email']."</td>"; 
			echo "<td><a href=deleteconfirm.php?id=".$row['ID'].">Delete</a></td>"; 
			echo "<td><a href=updateform.php?id=".$row['ID'].">Update</a></td></tr>"; 
		} // End of While statement
		echo "</table>"; 
		       
	} else { // If it did not run OK.
		echo '<p>Your search has no result.</p>';
	}
	mysqli_close($dbc); // Close the database connection.
	echo ("</center></html>"); 
	//include the footer
	include ("../includes/footer.php");
}

?>