<?php
include 'library.php'; // include the library for database connection
if(isset($_POST['action']) && $_POST['action'] == 'username_availability'){ // Check for the username posted
	$username 		= htmlentities($_POST['username']); // Get the username values
	$check_query	= 'SELECT user FROM members WHERE user = "'.$username.'" '; // Check the database
	// echo mysql_num_rows($check_query); // echo the num or rows 0 or greater than 0
    $result = $db->query($check_query);
	echo $num_results = $result->num_rows;
    // 	$num_results = mysqli_num_rows($result);
}
?>