<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once 'dbh.php';
class User extends Dbh{

	protected function getAllData($ID){
		$conn = $this -> connect_user();
		$stmt = $conn->prepare("SELECT * FROM workout WHERE user_id = ?");
		$stmt->bind_param('i',$ID);
		$stmt->execute();
		$result = $stmt -> get_result();
		$numRows = $result -> num_rows;
		if($numRows > 0){
			while ($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
		$conn -> close();
		return $data;
		}
	}

	public function insertData($dist, $TiH, $ID, $type){
		$conn= $this->connect_user();

		if(!$stmt = $conn -> prepare("INSERT INTO workout (distance, time_hours_minutes, workout_date, user_id, workout_type) VALUES(?,?,?,?,?)")){
			echo "prepare failed";
		}

		$distance = $dist;
		$time_in_hours = $TiH;
		$date = date('Y-m-d');
		if (!$stmt->bind_param("iisis", $distance,$time_in_hours,$date,$ID,$type)) {
    		echo "Binding parameters failed";
		}

		if (!$stmt->execute()) {
    		echo "Execute failed";
		}
		$stmt->close();
		$conn -> close();
		header('location: profile.php');

	}
}

?>