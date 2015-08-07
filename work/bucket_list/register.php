<?php

include 'library.php'; // include the library for database connection

$error = $user = $pass = '';
		
if (isset($_POST['username'])) 
{
	$user = $_POST['username'];
	$pass = $_POST['password'];
	
	// $user = sanitizeString($_POST['username']);
	// $pass = sanitizeString($_POST['password']);
			
	if ( empty($user) || empty($pass) ) {
		$error = "You have NOT entered all the required details.";
	} else {
		// $error = "You have entered all the required details.";
		$db->query("INSERT INTO members VALUES('$user', '$pass')");
		header('Location: index.php');
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

    <title>Bucket List Registration</title>

    <!-- Bootstrap core CSS -->
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css' rel='stylesheet'>

    <!-- Custom styles for this template -->
    <link href='signin.css' rel='stylesheet'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src='https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js'></script>
      <script src='https://oss.maxcdn.com/respond/1.4.2/respond.min.js'></script>
    <![endif]-->
    
<!--    <link rel="stylesheet" href="live-username-availability-checking-using-ajax_copy.css">-->
    
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        $('#username').keyup(function(){ // Keyup function for check the user action in input
            var Username = $(this).val(); // Get the username textbox using $(this) or you can use directly $('#username')
            var UsernameAvailResult = $('#username_avail_result'); // Get the ID of the result where we gonna display the results
            if(Username.length > 3) { // check if greater than 3 (minimum 4)
                UsernameAvailResult.html('Loading..'); // Preloader, use can use loading animation here
                var UrlToPass = 'action=username_availability&username='+Username;
                $.ajax({ // Send the username val to another checker.php using Ajax in POST menthod
                type : 'POST',
                data : UrlToPass,
                url  : 'checkUser.php',
                success: function(responseText){ // Get the result and asign to each cases
                    if(responseText == 0){
                        UsernameAvailResult.html('<span class="success">Username name available</span>');
                    }
                    else if(responseText > 0){
                        UsernameAvailResult.html('<span class="error">Username already taken</span>');
                    }
                    else{
                        alert('Problem with sql query');
                    }
                }
                });
            }else{
                UsernameAvailResult.html('Enter at least 4 characters');
            }
            if(Username.length == 0) {
                UsernameAvailResult.html('');
            }
        });
        
        $('#password, #username').keydown(function(e) { // Dont allow users to enter spaces for their username and passwords
            if (e.which == 32) { // spacebar keycode
                return false;
            }
        });
		
        $('#password').keyup(function() { // As same using keyup function for get user action in input
            var PasswordLength = $(this).val().length; // Get the password input using $(this)
            var PasswordStrength = $('#password_strength'); // Get the id of the password indicator display area
            
            if(PasswordLength <= 0) { // Check is less than 0
                PasswordStrength.html(''); // Empty the HTML
                PasswordStrength.removeClass('normal weak strong verystrong'); //Remove all the indicator classes
            }	
            if(PasswordLength < 8) { // If string length < 8
                PasswordStrength.html('Enter at least 8 characters');
			}
            if(PasswordLength >= 8) { // If string length >= 8 and less than 12 add 'strong' class
                PasswordStrength.html('Good');
			}
        });
        
    });
    </script>
</head>

<body>
  <div class="container">
    <!-- Static navbar -->
    <nav class="navbar navbar-default" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        <a class="navbar-brand">Bucket List</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Register</a></li>
            <li><a href="index.php">Login</a></li>
          </ul> 
        </div><!-- end of navbar navbar-collapse collapse-->
      </div><!-- end of container-fluid -->    
    </nav>      
    <form method='post' action='register.php' class="form-signin" role="form">
        <h1>Register</h1>
        <input type="text" id="username" class="form-control" placeholder="Username" required autofocus/>
        <div class="username_avail_result" id="username_avail_result"></div>
        <input type="text" id="password"  class="form-control" placeholder="Password" required autofocus/>
        <div class="password_strength" id="password_strength"></div>
        <input type="submit" value="Sign Up" class="btn btn-default"/>
    </form>
    <?php		
echo <<<_END
    <span id='info'>$error</span>
_END;
    $db->close();
    ?>
  </div>
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
