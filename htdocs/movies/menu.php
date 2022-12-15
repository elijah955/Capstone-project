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
	echo ("<center>"); 
	echo ("<h2>Movie List</h2>");
	echo ("<p class='space'><a href=add.php class='add'>Add Movie</a></p>"); 
	echo ("<p><a href=searchform.php class='search'>Search Movies</a></p>"); 
	//Set the number of records to display per page
	$display = 25;
	//Check if the number of required pages has been determined
	if (isset($_GET['p']) && is_numeric($_GET['p'])){//Already been determined
		$pages = $_GET['p'];
	}else{//Need to determine
		//Count the number of records;
		$q = "SELECT COUNT(id) FROM movies";
		$r = @mysqli_query($dbc, $q); 
		$row = @mysqli_fetch_array ($r,MYSQLI_NUM);
		$records = $row[0]; //get the number of records
		//Calculate the number of pages ...
		if($records > $display){//More than 1 page is needed
			$pages = ceil($records/$display);
		}else{
			$pages = 1;
		}
	}// End of p IF.

	//Determine where in the database to start returning results ...
	if(isset($_GET['s'])&&is_numeric($_GET['s'])){
		$start = $_GET['s'];
	}else{
		$start = 0;
	}

	//Make the paginated query;
	$query = "SELECT * FROM movies LIMIT $start, $display"; 
	$result = @mysqli_query ($dbc, $query);

	//Table header:
	echo "<table cellpadding=5 cellspacing=5 border=1><tr>
	<th>Title</th><th>Year</th><th>Genre</th><th>*</th><th>*</th></tr>"; 

	//Fetch and print all the records...
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		echo "<tr><td>".$row['Title']."</td>"; 
		echo "<td>".$row['Year']."</td>"; 
		echo "<td>".$row['Genre']."</td>"; 
		echo "<td><a href=deleteconfirm.php?id=".$row['ID'].">Delete</a></td>"; 
		echo "<td><a href=updateform.php?id=".$row['ID'].">Update</a></td></tr>"; 
	} // End of While statement
	echo "</table>";         
	mysqli_close($dbc); // Close the database connection.

	//Make the links to other pages if necessary.
	if($pages>1){
		echo '<br/><table><tr>';
		//Determine what page the script is on:
		$current_page = ($start/$display) + 1;
		//If it is not the first page, make a Previous button:
		if($current_page != 1){
			echo '<td><a href="menu.php?s='. ($start - $display) . '&p=' . $pages. '"> Previous </a></td>';
		}
		//Make all the numbered pages:
		for($i = 1; $i <= $pages; $i++){
			if($i != $current_page){ // if not the current pages, generates links to that page
				echo '<td><a href="menu.php?s='. (($display*($i-1))). '&p=' . $pages .'"> ' . $i . ' </a></td>';
			}else{ // if current page, print the page number
				echo '<td>'. $i. '</td>';
			}
		} //End of FOR loop
		//If it is not the last page, make a Next button:
		if($current_page != $pages){
			echo '<td><a href="menu.php?s=' .($start + $display). '&p='. $pages. '"> Next </a></td>';
		}
		
		echo '</tr></table><br>';  //Close the table.
	}//End of pages links
	//include the footer
	include ('../includes/footer.php');
}
?>





