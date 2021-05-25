<?php 
include_once 'dbh.php';

$database = new Dbh();
$conn_users = $database -> connect_user();

$stmt = $conn_users ->prepare('SELECT * FROM users_info WHERE userEmail = ?');
$stmt -> bind_param("s",$email);

$email = trim($_POST['email']);
$email = strip_tags($email);
$email = htmlspecialchars($email);

$stmt->execute();
$result = $stmt ->get_result();
$row = $result -> num_rows;

if($row == 0){
	echo "<script language=\"JavaScript\">\n";
	echo "alert('Username was incorrect!');\n";
	echo "window.location='index.php'";
	echo "</script>";
}
else{
	$user = $result -> fetch_assoc();
	$pass = trim($_POST['password']);
	$pass = strip_tags($pass);
	$pass = htmlspecialchars($pass);



	if(password_verify($pass, $user['userPass'])){
		$_SESSION['id'] = $user['userId'];
		$_SESSION['email'] = $user['userEmail'];
		$_SESSION['firstName'] = $user['userFirstName'];
		$_SESSION['lastName'] = $user['userLastName'];
		$_SESSION['loggedIn'] = true;

		header('location: includes/profile.php');
	}
	else{
		echo "<script language=\"JavaScript\">\n";
		echo "alert('Password was incorrect!');\n";
		echo "window.location='index.php'";
		echo "</script>";
	}
}

?>

