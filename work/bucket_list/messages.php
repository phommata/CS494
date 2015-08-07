<?php

include 'library.php'; // include the library for database connection

if (empty($_SESSION['user']))
{
	header('Location: index.php');
} 

$user = $_SESSION['user'];

include 'header.php';
?>

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
            <li class="active"><a><?php echo $user?></a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul> 
        </div><!-- end of navbar navbar-collapse collapse-->
      </div><!-- end of container-fluid -->    
    </nav>  
      <form action="messages.php" method="post" id="form-container">
        <div class="form-group">
          <input type="text" name="toDo" height="71" size="47">
          <br><br>
          <input type="submit" value="Enter Item">
        </div>
      </form>
      <ul>
<?php
	$user = $_SESSION['user'];
	if (isset($_POST['toDo'])){
		$toDo = $_POST['toDo'];
		
		$query = "INSERT into messages (auth, message) VALUES ('".$user."', '".$toDo."')"; 
		$result = $db->query($query);	

	} 
	
	if (isset($_GET['deleteID']))
    {
        $deleteID = $_GET['deleteID'];
        $db->query("DELETE FROM messages WHERE id='".$deleteID."' AND auth='".$user."'");
    }

	$query  = "SELECT * FROM messages WHERE auth='".$user."'";
	$result = $db->query($query);	
	$num    = mysqli_num_rows($result);
	
	for ($j = 0 ; $j < $num ; ++$j)
	{
		$row = mysqli_fetch_row($result);
		echo "<li> $row[5] <a href='messages.php?deleteID=$row[0]'>Delete</a></li>";			
	}
?>
      </ul>
  </div> <!-- end of container -->
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