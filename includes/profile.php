<?php 
session_start();
include_once 'viewData.php';
include_once 'user.php';

$con = new User();

if($_SESSION['loggedIn'] != 1){
  $_SESSION['message'] = 'There was an error';
  header('location: ../index.php');
}
else if(isset($_POST['btn-save'])){
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
else {
    // Makes it easier to read
    $userId = $_SESSION['id'];
    $firstName = $_SESSION['firstName'];
    $lastName = $_SESSION['lastName'];
    $email = $_SESSION['email'];
    $loggedIn = $_SESSION['loggedIn'];
  }
?>
<!DOCTYPE html>
<html>
<head>
<!-- bootstrap -->
<link rel='stylesheet' type='text/css' href = '../assets/css/My_stylesheet.css'>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<!-- Custom script as written on bootstrap page -->
<title>User Profile Page</title>
</head>
<body> 
  <a href="logout.php"><button class="btn btn-primary logout" name="logout"/>Log Out</button></a>
  <div class="container">
    <h1>Welcome <?= $firstName.' '. $lastName?></h1>
      <?php
        $viewdata = new viewData();
        $viewdata->showAllData($userId);
      ?>
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#workoutForm">Enter New Workout</button>
  <div class="modal fade" id="workoutForm" tabindex="-1" role="dialog">
    <div class="vertical-alignment-helper">
      <div class="modal-dialog vertical-align-center">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Enter a new workout</h4>
          </div>
          <div class="modal-body">
            <form method = "post">
              <div class="container">
                <div class="form-group">
                  <div class="dropdown">
                    <select class="btn btn-primary dropdown-toggle" type="text" name = 'type' data-toggle="dropdown">Type
                      <span class="caret"></span>
                        <option value = 'swim'>swim</option>
                        <option value = 'bike'>bike</option>
                        <option value = 'run'>run</option>
                       </select>
                  </div>
                </div>
                <div class="form-group">
                  <input type = "text" name ="distance" placeholder="Distance(yards/miles)" />
                </div>
                <div class="form-group">  
                <input type = "text" name ="time_in_hours" placeholder ="Workout Length(minutes)" />
                </div>
                <button class="btn btn-primary" name="tbn-save" type="submit">Submit</button>
              </div>   
            </form>
          </div>
        </div>
      </div>
    </div>      
  </div>
  </div>  
</body>
</html>