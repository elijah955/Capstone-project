<?php
session_start();
if (!isset($_SESSION['emp_id'])){
	echo "You are not logged in!<br>";
	echo ("<a href=https://www.ejfranks.uwmsois.com/Capstone/htdocs/Home/login.php>Login here</a><p>");
	exit();
}else{
	include ('../includes/header.php');
	require_once ('../../mysqli_connect2.php');
	echo ("<center>"); 
	echo ("<h2>Customers</h2>");
	echo ("<p class='space'><a href=add.php class='add'>Add a customer</a></p>"); 
	echo ("<p><a href=searchform.php class='add'>Search customers</a></p>"); 
	$display = 10;
	if (isset($_GET['p']) && is_numeric($_GET['p'])){
		$pages = $_GET['p'];
	}else{
		$q = "SELECT COUNT(ID) FROM customers";
		$r = @mysqli_query($dbc, $q); 
		$row = @mysqli_fetch_array ($r,MYSQLI_NUM);
		$records = $row[0]; 
		if($records > $display){
			$pages = ceil($records/$display);
		}else{
			$pages = 1;
		}
	}
	if(isset($_GET['s'])&&is_numeric($_GET['s'])){
		$start = $_GET['s'];
	}else{
		$start = 0;
	}
	$query = "SELECT * FROM customers LIMIT $start, $display"; 
	$result = @mysqli_query ($dbc, $query);
	echo "<table cellpadding=5 cellspacing=5 border=1><tr>
	<th>First Name</th><th>Last Name</th><th>Phone #</th><th>Address</th><th>Email</th><th>*</th><th>*</th></tr>"; 
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		echo "<tr><td>".$row['first_name']."</td>"; 
		echo "<td>".$row['last_name']."</td>"; 
		echo "<td>".$row['phone']."</td>"; 
		echo "<td>".$row['address']."</td>";
		echo "<td>".$row['email']."</td>";  
		echo "<td><a href=deleteconfirm.php?id=".$row['ID'].">Delete</a></td>"; 
		echo "<td><a href=updateform.php?id=".$row['ID'].">Update</a></td></tr>"; 
	} 
	echo "</table>";         
	mysqli_close($dbc);
	if($pages>1){
		echo '<br/><table><tr>';
		$current_page = ($start/$display) + 1;
		if($current_page != 1){
			echo '<td><a href="menu.php?s='. ($start - $display) . '&p=' . $pages. '"> Previous </a></td>';
		}
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
		
		echo '</tr></table>';  //Close the table.
	}//End of pages links
	//include the footer
	include ('../includes/footer.php');
}
?>