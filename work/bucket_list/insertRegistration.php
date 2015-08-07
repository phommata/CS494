<?php 
if (isset($_SESSION['user'])) destroySession();

if (isset($_POST['user']))
{
    $user = sanitizeString($_POST['user']);
    $pass = sanitizeString($_POST['pass']);
    
    if ($user == "" || $pass == "")
        $error = "Not all fields were entered<br /><br />";
    else
    {
        if (mysql_num_rows(queryMysql("SELECT * FROM members
		      WHERE user='$user'")))
            $error = "That username already exists<br /><br />";
        else
		  {
            queryMysql("INSERT INTO members VALUES('$user', '$pass')");
            die("<h4>Account created</h4>Please Log in.<br /><br />");
        }
    }
}
?>