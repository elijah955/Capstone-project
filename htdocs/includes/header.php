<!DOCTYPE html PUBLIC>
<head>
	<title>INFOST40 Final Project Website</title>
	<link rel="stylesheet" type="text/css" href="../includes/style.css">
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
</head>
<body>
<center>
<img src="../includes/bcr.png" alt="Brew City Rentals against a movie film background" width="290px" height="80px">
</center>

<?
if (!isset($_SESSION['emp_id'])){
} else {
		echo('<h2><a href="../Home/logout.php" class="signout">SIGN OUT</a></h2>'); 
		echo('<div class="nav">');
		echo('<div class="flex-container">');
		echo('<h2><a href="../movies/menu.php" class="inventory">INVENTORY FUNCTIONS</a></h2>');
		echo('<h2><a href="../customers/index.php" class="customers">CUSTOMER FUNCTIONS</a></h2>');
		echo('<h2><a href="../employees/menu.php" class="manager">MANAGER FUNCTIONS</a></h2>');
		echo('</div>');
		echo('<div class="flex-container2">');
		echo('<h2><a href="../checkout/checkout.php" class="checkout">CHECKOUT</a></h2>');
		echo('<h2><a href="../report/report.php" class="report">RUN REPORT</a></h2>');
		echo('</div>');
		echo('</div>');
} 
?>



