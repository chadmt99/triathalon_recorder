<?php
include_once 'dbh.php';
include_once 'user.php';
$con = new User();
session_start();

if(isset($_POST['btn-save'])){
	$dist = $_POST['distance'];
	$dist = trim($_POST['distance']);
	$dist = strip_tags($dist);
	$dist = htmlspecialchars($dist);

	$TiH = trim($_POST['time_in_hours']);
	$TiH = strip_tags($TiH);
	$TiH = htmlspecialchars($TiH);

	$ID =  $_SESSION['id'];
	$type = $_POST['type'];

	$con->insertData($dist,$TiH,$ID,$type);
}

?>



<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>  
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<form method = "post">
		<table align = "center">
			<tr>
				<td><input type = "text" name ="distance" placeholder="yards swam" /></td>
			</tr>
			<tr>
				<td><input type = "text" name ="time_in_hours" placeholder ="Time spent(minutes)" /></td>
			</tr>
			<tr>
				<div class="dropdown">
				   <select class="btn btn-primary dropdown-toggle" type="text" name = 'type' data-toggle="dropdown">Type
				   <span class="caret"></span>
					   	<option value = 'swim'>swim</option>
					   	<option value = 'bike'>bike</option>
					   	<option value = 'run'>run</option>
				   </select>
				</div> 
			</tr>
			<tr>
				<td><button type="submit" name = "btn-save">SAVE</button></td>
			</tr>
		</table>
	</form>
	<form action ='profile.php' method = 'post'>
		<input type = 'submit' value = 'index'/>
	</form>
</body>
</html>
