<?php session_start(); /* input.php */ 

	$_SESSION['uid'] = 1;

if (array_key_exists("username",$_REQUEST) && 
	array_key_exists("string1", $_REQUEST) && 
 	array_key_exists("string2", $_REQUEST)) 
// if (isset($_POST['username']) && isset($_POST['string1']) && isset($_POST['string2'])) 
// if (!isset($_SESSION['uid']))
{ 
	/* here is where we would check the username and password */ 
// 	$_SESSION['uid'] = 1;
	// if the user has just tried to log in 
	$_SESSION['username'] = $_POST['username'];
	$_SESSION['string1'] = $_POST['string1'];
	$_SESSION['string2'] = $_POST['string2'];

// 	echo '<a href="session.php">Go to session.php</a>';
// 	echo '<p>username:'.htmlspecialchars($_POST["username"]).'</p>';
// 	echo '<p>string1:'.htmlspecialchars($_POST["string1"]).'</p>';
// 	echo '<p>string2:'.htmlspecialchars($_POST["string2"]).'</p>';
} 
else {
?>
	<form action="session.php" method="POST">
		<div>Username: <input type="text" name="username"></div> 
		<div>String 1: <input type="text" name="string1"></div> 
		<div>String 2: <input type="text" name="string2"></div> 
		<div><input type="submit" value="Go play with strings!"></div>
	</form>
<?php 
}
?>
