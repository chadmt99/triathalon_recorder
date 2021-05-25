<?php

class Dbh {
	private $servername;
	private $username;
	private $password;
	private $dbname;

	public function connect_user(){
		$this -> servername = "localhost";
		$this -> username = "root";
		$this -> password = "Q6Nb52xlUlm9";
		$this -> dbname = "users";

		$conn = new mysqli($this -> servername, $this -> username, $this -> password, $this -> dbname);
		if($conn->connect_error){
			die("Connection failed: ". $conn->connect_error);
		}
		else{
		return $conn;
		}
	}
}

?>