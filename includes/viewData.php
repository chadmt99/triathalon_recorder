<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
</html>
<?php
include_once 'user.php';
class ViewData extends User{

	public function showAllData($ID){
		$datas = $this ->getAllData($ID);
		if(!empty($datas)){
			echo "<form action='' method='post'>";
			echo "<table class= 'table'>";
			echo "<thead class='thead-inverse'>";
			echo "<tr><th>Type</th><th>Distance</th><th>Amount of time</th><th>date</th></tr></thead><tbody>";
			foreach ($datas as $data){
				echo "<tr>";
				if($data['workout_type'] == 'swim'){
					echo "<td>".$data['workout_type']."</td>";
					echo "<td>".$data['distance']. " yards/meters</td>";
				}
				else if($data['workout_type'] == 'bike' or 'run'){
					echo "<td>".$data['workout_type']."</td>";
					echo "<td>".$data['distance']. " miles</td>";
				}
				echo "<td>".$data['time_hours_minutes']."</td>";
				echo "<td>".$data['workout_date']."</td>";
				echo '<td><a href="delete.php?deleteItem='.$data['id'].'">Delete</a></td>';
				echo "</tr>";
			}
			echo "</tbody>";
			echo "</table>";
			echo "</form>";
		}
		else{
			echo "Enter some data!";
			}
	}
}

?>