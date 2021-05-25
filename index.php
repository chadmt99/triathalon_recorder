<?php
	include_once 'includes/dbh.php';

	session_start();
	$_SESSION['message'] = '';
?>

<!DOCTYPE html>
<html>
<head>
<!-- bootstrap -->
<link rel='stylesheet' type='text/css' href = 'assets/css/My_stylesheet.css'>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script><!--custom css -->
<title>Sign-Up/Login Form</title>
</head>

<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if (isset($_POST['login'])) { //user logging in

        require 'includes/login.php';
        
    }
}
?>

<body>
	<div class="container">
		<div class="jumbotron">
        	<h1 class="display-3">Tri-Relay</h1>
        	<p class="lead">Record and compare your workouts with your teammates today</p>
        </div>
		<form action = 'index.php' class= "form-signin" method = 'post' autocomplete = 'off'>
		   	<h1 class="form-signin-heading">Login</h1>
		   	<label for= "inputEmail" class ="sr-only">Email address</label>
			<input type="email" id ="inputEmail" class = "form-control" placeholder ="Email Address" autocomplete="off" name="email" required>
			<label for= "inputPass" class="sr-only">Password</label>
			<input type="password" id="inputPass" class = "form-control" placeholder ="Password" autocomplete="off" name="password" required>
	       	<p class="forgot"><a href="forgot.php">Forgot Password?</a></p>
	       	<button class="btn btn-lg btn-primary btn-block" name="login" type="submit">Log In</button>
			<span>New to the website? <a href = 'includes/signUp.php'>Register</a>
	    </form>
    </div>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->    
<script src="../../../../assets/js/ie10-viewport-bug-workaround.js"></script>    
</body>
</html>