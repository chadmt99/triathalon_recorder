<?php
	include_once 'dbh.php';
	$value = new Dbh();
	$conn = $value ->connect_user();
	if(isset($_GET['deleteItem']) and is_numeric($_GET['deleteItem']))
	{
	  // here comes your delete query: use $_POST['deleteItem'] as your id
	  $stmt = $conn ->prepare("DELETE FROM workout WHERE id =?"); 
	  $stmt ->bind_param("i",$delete);
	  $delete = $_GET['deleteItem'];
	  $stmt ->execute();
	  header('location: profile.php');
	  echo "value deleted";
	}
	$conn->close();
?>