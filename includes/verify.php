<?php

require_once 'dbh.php';
session_start();

$database = new Dbh();
$conn = $database -> connect_user();

if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
	$email = $mysqli -> escape_string($_GET['email']);
	$hash = $mysqli -> escape_string($_GET['hash']);

	$stmt = $conn -> prepare('SELECT * FROM users WHERE email = ? AND hash = ? AND active = ?');
	$stmt -> bind_param("ssi", $email, $hash, $active);
	$stmt-> execute();
	$result = $stmt -> get_result();
	$row = $result -> num_rows;
	if($row ==0){
		$_SESSION['message'] = 'Account has already been activated or the URL is invalid';
		header("location: profile.php");
	}
	else {
		$_SESSION['message'] = "Your account has been activated!";

		$stmt = $conn ->prepare('UPDATE users SET active = ? WHERE email = ?');
		$stmt -> bind_param("is", 1, $email);
		$stmt ->execute();
		$_SESSION['active'] = 1;

		header('location: profile.php');
	}
}
else {
	$_SESSION['message'] = "Invalid parameters provided for account verification!";
	header('location: profile.php');
}
?>