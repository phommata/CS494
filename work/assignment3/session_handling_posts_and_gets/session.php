<?php session_start(); /* session.php */ 
// if (array_key_exists("username", $_REQUEST)) {
//  if (isset($_SESSION['uid'])) {
if($_SERVER['REQUEST_METHOD'] == "POST") {

// 	echo 'submitted:'.htmlspecialchars($_POST["username"]).'<br>';
// 	echo 'submitted:'.htmlspecialchars($_POST["string1"]).'<br>';
// 	echo 'submitted:'.htmlspecialchars($_REQUEST["string2"]).'<br><br>';

	$_SESSION['username'] = $_POST['username'];
	$_SESSION['string1'] = $_POST['string1'];
	$_SESSION['string2'] = $_POST['string2'];
// 	echo "<a href='strings.php'>Redirect to strings.php</a><br><br>"; 
// 
// 	echo 'username: '.$_SESSION['username'].'<br>';
// 	echo 'string1: '.$_SESSION['string1'].'<br>';
// 	echo 'string2: '.$_SESSION['string2'].'<br>';
	header("Location: strings.php");

}
else if (isset($_SESSION['uid'])){
		header("Location: strings.php");
}	
else
// 	echo "You need to <a href='input.php'>Log in</a>";
	header("Location: input.php?nosession=true");
?>