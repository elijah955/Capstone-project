<?php
// Send NOTHING to the Web browser prior to the session_start() line!
// Check if the form has been submitted.
if (isset($_POST['submitted'])) {
	require_once ('../../mysqli_connect3.php'); // Connect to the db.
	$errors = array(); // Initialize error array.
	if (empty($_POST['emp_id'])) {
		$errors[] = 'You forgot to enter your ID.';
	} else {
		$e = mysqli_real_escape_string($dbc, trim($_POST['emp_id']));
	}
	// Check for a password.
	if (empty($_POST['password'])) {
		$errors[] = 'You forgot to enter your password.';
	} else {
		$p = mysqli_real_escape_string($dbc, $_POST['password']);
	}
	if (empty($errors)) { // If everything's OK.
		/* Retrieve the user_id and first_name for 
		that email/password combination. */
		$query = "SELECT * FROM Users WHERE emp_ID='$e' AND password='$p'"; 
		$result = @mysqli_query ($dbc, $query); // Run the query.
		$row = mysqli_fetch_array($result, MYSQLI_NUM);
		if ($row) { // A record was pulled from the database.
			//Set the session data:
			session_start(); 
			$_SESSION['emp_id'] = $row[1];
			$_SESSION['password'] = $row[2];	
			// Redirect:
			header("Location:../Home/loggedin.php");
			exit(); // Quit the script.
		} else { // No record matched the query.
			$errors[] = 'The ID and password entered do not match those on file.'; // Public message.
		}
	} // End of if (empty($errors)) IF.
	mysqli_close($dbc); // Close the database connection.
} else { // Form has not been submitted.
	$errors = NULL;
} // End of the main Submit conditional.

// Begin the page now.
$page_title = 'Login';
include ('../includes/header.php');
if (!empty($errors)) { // Print any error messages.
	echo '<h1 id="mainhead">Error!</h1>
	<p class="error">The following error(s) occurred:<br />';
	foreach ($errors as $msg) { // Print each error.
		echo " - $msg<br />\n";
	}
	echo '</p><p>Please try again.</p>';
}

// Create the form.
?>
<center>
	<h2>Please, login here.</h2>
	<form action="login.php" method="post">
		<p>Employee ID: <input type="text" name="emp_id" size="20" maxlength="40" /> </p>
		<p>Password: <input type="password" name="password" size="20" maxlength="20" /></p>
		<p><input type="submit" name="submit" value="Login" class="submit" /></p>
		<input type="hidden" name="submitted" value="TRUE" />
	</form>

	<div id="failed">
		<p>Management lockout assistance: (111)-222-3333</p>
	</div>
	
</center>

<?php
include ('../includes/footer.php');
?>
