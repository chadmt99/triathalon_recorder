<? php
	if($_SERVER["REQUESTED_METHOD"] == "POST"){
		if($_POST['pass'] == $_POST['confirmPass']){
			$name = trim($_POST['name']);
  			$name = strip_tags($name);
  			$name = htmlspecialchars($name);

  			$email = trim($_POST['email']);
  			$email = strip_tags($email);
  			$email = htmlspecialchars($email);

  			$pass = trim($_POST['pass']);
  			$pass = strip_tags($pass);
  			$pass = htmlspecialchars($pass);

  			if(strlen($pass) >6){
	  			if(preg_match("/^[a-zA-Z ]+$/",$name)){
	  				$stmt = $database ->prepare('SELECT userEmail FROM users_info WHERE userEmail = ?');
	  				$stmt -> bind_param('s', $email);
	  				$stmt -> execute();
	  				$result = $stmt -> get_result();
	  				$row = $result -> num_rows;
					if($row == 0){
						$stmt = $database -> prepare('INSERT INTO users_info (userName, userEmail, userPass) VALUES(?,?)');
						$stmt -> bind_param('sss',$name, $email, $pass);
						if($stmt ->execute()){

						}
						else{
							$_SESSION['message'] = "Error adding user to Database";
						}
						$database ->close();
					}
					else{
						$_SESSION['message'] = "Email already in datase";
					}
				}
				else{
					$_SESSION['message'] = "Name must contain alphabets and space";
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