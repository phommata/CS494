<?php

include 'library.php'; // include the library for database connection

$error = $user = $pass = '';

// $error = 'page loaded';
		
		
if (isset($_POST['username'])) 
{
	$user = $_POST['username'];
	$pass = $_POST['password'];
	
	// $user = sanitizeString($_POST['username']);
	// $pass = sanitizeString($_POST['password']);
			
	if ( empty($user) || empty($pass) ) {
		$error = "You have NOT entered all the required details.";
	} else {
		$result = $db->query("SELECT user, pass FROM members 
								WHERE user='$user' AND pass='$pass'");
		$num_results = $result->num_rows;
	
		if ($num_results > 0) {
			$_SESSION['user'] = $user;
			
			$error = "You are logged in " . $_SESSION['user'] . ".";
			header('Location: messages.php');
		} else {
			$error = "Incorrect username and password combination.";
		}
	}
}

?>

<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name='description' content=''>
    <meta name='author' content=''>
<!--    <link rel='icon' href='../../favicon.ico'>-->

    <title>Bucket List</title>

    <!-- Bootstrap core CSS -->
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css' rel='stylesheet'>

    <!-- Custom styles for this template -->
    <link href='signin.css' rel='stylesheet'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src='https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js'></script>
      <script src='https://oss.maxcdn.com/respond/1.4.2/respond.min.js'></script>
    <![endif]-->
  </head>
<body>
 <div class="container">
    <form method='post' action='index.php' class="form-signin" role="form">
	 	<h1>Bucket List</h1>
        <h2 class="form-signin-heading">Please sign in</h2>
      <input type='text' maxlength='16' name='username' class="form-control" placeholder="Username" required autofocus/><br />

        <input type='password' maxlength='16' name='password' class="form-control" placeholder="Password" required autofocus/>
        <br />
        <input type='submit' value='Login' class="btn btn-default"/><br><br>
	    <a href="register.php">Register</a></br>
		<?php		
echo <<<_END
        <br><span id='info'>$error</span>
_END;
    //    $result->close();
    //    $db->close();
        ?> 
    </form>

  <!-- Bootstrap core JavaScript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>