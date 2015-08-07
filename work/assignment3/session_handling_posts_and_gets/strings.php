<?php session_start(); /* input.php */ 
// if (array_key_exists("username",$_REQUEST) && 
// 	array_key_exists("string1", $_REQUEST) && 
// 	array_key_exists("string2", $_REQUEST)) 
if (!isset($_SESSION['uid'])) {
		header("Location: input.php?nosession=true");
}
else if (!isset($_GET['op'])) { 
	echo 'Welcome '.$_SESSION['username'].
		', lets string your strings '.$_SESSION['string1'].
		' and '.$_SESSION['string2'].'!';
?>
	<form method="GET" action="strings.php">
		<div><input type="hidden" name="op" value="conxy"></div>
		<div><input type="submit" value="concatenate x + y"></div>
		</form>
	<form method="GET" action="strings.php">
		<div><input type="hidden" name="op" value="conyx"></div>
		<div><input type="submit" value="concatenate y + x"></div>
	</form>
	<form method="GET" action="strings.php">
		<div><input type="hidden" name="op" value="substr"></div>
		<div><input type="submit" value="to check and see if a string is a substring of the other "></div>
	</form> 
<?php
// 	unset($_SESSION[‘username’]);
// 	unset($_SESSION[‘string1’]);
// 	unset($_SESSION[‘string2’]);
// 	unset($_SESSION[‘uid’]);		
// 	session_destroy();
} 
else if ($_GET['op'] == 'conxy') { 
	echo 'the strings have been concatenated: '.$_SESSION['string1'].$_SESSION['string2'];
}
else if ($_GET['op'] == 'conyx') { 
	echo 'the strings have been concatenated: '.$_SESSION['string2'].$_SESSION['string1'];
}
else if ($_GET['op'] == 'substr') { 
	if (strpos($_SESSION['string1'],$_SESSION['string2']) != false) {
		echo $_SESSION['string1'] . ' contains ' . $_SESSION['string2'].'<br>';
	} else {
		echo $_SESSION['string1'] . ' does not contain ' . $_SESSION['string2'].'<br>';	
	}	
	if (strpos($_SESSION['string2'],$_SESSION['string1']) != false) {
		echo $_SESSION['string2'] . ' contains ' . $_SESSION['string1'].'<br>';	
	} else {	
		echo $_SESSION['string2'] . ' does not contain ' . $_SESSION['string1'].'<br>';	
	}	
}
else if (!isset($_SESSION['uid'])) { 
	echo '<p> username: '.$_SESSION['username'].'</p>';
	echo '<p> string1: '.$_SESSION['string1'].'</p>';
	echo '<p> string2: '.$_SESSION['string2'].'</p>';
}
?>
