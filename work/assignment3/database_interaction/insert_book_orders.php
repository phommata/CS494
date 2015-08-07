<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">        

	<title>Book-Off - New Book Order Results</title>
<!--	<link rel="stylesheet" href="new_book_orders.css" type="text/css">-->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</head>
<body role="document">
  <div class="container">
    <h1>Book-Off - New Book Order Results</h1>
    <?php
    // create short variable names
    $author=$_POST['author'];
    $title=$_POST['title'];
    $quantity=$_POST['quantity'];
    
    if (!$author || !$title || !$quantity)
    {
       echo 'You have not entered all the required details.<br />'
            .'Please go back and try again.';
       exit;
    }
    
    ini_set('display_errors', 'On');
    
    @ $db = new mysqli("db_host", 
                       "db_name", 
                       "db_user", 
                       "db_pass");
    
    if (mysqli_connect_errno()) 
    {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " .
                                               $mysqli->connect_error;
        exit;
    }
    else {
        // echo "Successfully connected to database!<br>";
    }
    
    $query = "insert into assign3 values 
              ('".$author."', '".$title."', '".$quantity."')"; 
    $result = $db->query($query);
    if ($result)
       // echo  $db->affected_rows.' book inserted into database.'; 
    
    $query = "select * from assign3 ";
    $result = $db->query($query);
    
    $num_results = $result->num_rows;
    // 	$num_results = mysqli_num_rows($result);
    
    // echo '<p>Number of total entries in database: '.$num_results.'</p>';
    
    echo '<table class="table table-striped">';	
    echo '<tr><th>',  "Author",'</th>
              <th>',  "Title" ,'</th>
              <th>',  "Quantity" ,'</th>
          </tr>';
              
    $sum = null;
              
    for ($i = 0; $i < $num_results; $i++) { 
    // for ($i = $num_results; $i > 0; $i--) { 
        // process results
        $row = $result->fetch_assoc();
    // 	$row = mysqli_fetch_assoc($result);
    
        if (($num_results < 10) || ($i >= ($num_results - 10))) 
        {
            echo '<tr><td>',  $row['varchar1'] ,'</td>
                      <td>',  $row['varchar2'] ,'</td>
                      <td>',  $row['int'] 	   ,'</td>
                 </tr>';	 	  
            $sum += $row['int'];
        }	
    }
    echo '</table>';
    
    echo '<br><h4>The sum of the books shown is ' . $sum . '.</h4>';
    $result->close();
    $db->close();
    ?>
  </div>
</body>
</html>
