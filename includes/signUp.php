<?php
include_once 'dbh.php';

session_start();
$_SESSION['message'] = '';

$database = new Dbh();
$conn = $database -> connect_user();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if($_POST['pass'] == $_POST['confirmPass']){
		$firstName = trim($_POST['first_name']);
		$firstName = strip_tags($firstName);
		$firstName = htmlspecialchars($firstName);

		$lastName = trim($_POST['last_name']);
		$lastName = strip_tags($lastName);
		$lastName = htmlspecialchars($lastName);

		$email = trim($_POST['email']);
		$email = strip_tags($email);
		$email = htmlspecialchars($email);

		$pass = trim($_POST['pass']);
		$pass = strip_tags($pass);
		$pass = htmlspecialchars($pass);

		$hash = md5(rand(0,1000));

		if(strlen($pass) >6){
			$stmt = $conn ->prepare('SELECT userEmail FROM users_info WHERE userEmail = ?');
			$stmt -> bind_param('s', $email);
			$stmt -> execute();
			$result = $stmt -> get_result();
			$row = $result -> num_rows;
			if($row == 0){
				$pass = password_hash($pass, PASSWORD_BCRYPT);
				$stmt = $conn -> prepare('INSERT INTO users_info (userFirstName, userLastName, userEmail, userPass, hash) VALUES(?,?,?,?,?)');
				$stmt -> bind_param('sssss',$firstName,$lastName, $email, $pass, $hash);
				if($stmt ->execute()){
 					$_SESSION['active'] = 0;
 					$_SESSION['loggedIn'] = true;
 					header("location: profile.php");
				}
				else{
					$_SESSION['message'] = "Error adding user to Database";
				}
				$conn ->close();
			}
			else{
				$_SESSION['message'] = "Email already in datase";
			}
		}
		else{
			$_SESSION['message'] = "Password must be longer than 6 characters";
		}
	}	
	else {
		$_SESSION['message'] = "Passwords do not match";
	}
}
?>
<html>
<head>
	<title>Registration</title>
	<link rel='stylesheet' type='text/css' href = '../assets/css/My_stylesheet.css'>
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>	
   	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
	<form class="form-signin" action="signUp.php" method="post" enctype="multipart/form-data" autocomplete="off">
       	<h1>Registration</h1>
       		<div class="alert alert-error"><?=$_SESSION['message'] ?></div>
       		<label>
       			First Name<span class ='req'></span>
       		</label>
   			<input type = 'text' name='first_name' class = 'form-control' placeholder = 'Enter First Name' maxlength = '50' required />
			<label>
				Last Name<span class ='req'></span>
			</label>
			<input type = 'text' name='last_name' class = 'form-control' placeholder = 'Enter Last Name' maxlength = '50' required />
   			<label>
   				Email<span class ='req'></span>
   			</label>
			<input type = 'email' name='email' class = 'form-control' placeholder = 'Enter email' maxlength = '50' required />
       		<label>
       			Password<span class ='req'></span>
       		</label>
       		<input type = 'password' name='pass' class = 'form-control' placeholder = 'Enter Password' maxlength = '50' required />
       		<label>
       			Re-enter Password<span class ='req'></span>
       		</label>
       		<input type = 'password' name='confirmPass' class = 'form-control' placeholder = 'Enter First Name' maxlength = '50' required />
       		<button type='submit' class ='btn btn-block btn-primary' name = 'register'>Sign Up</button>
		</form>
</div>
</body>
</html>
<?php ob_end_flush(); ?>




