<?php

ini_set('display_errors', 'On');

session_start();

$db = new mysqli("db_host", "db_name", "db_user", "db_pass") or die ("Oops! Server not connected"); // Connect to the host

if (mysqli_connect_errno()) 
{
	echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " .
										   $mysqli->connect_error;
	exit;
}
else {
	// echo "Successfully connected to database!<br>";
}

function sanitizeString($var)
{
    $var = strip_tags($var);
    $var = htmlentities($var);
    $var = stripslashes($var);
    return mysql_real_escape_string($var);
}

?>