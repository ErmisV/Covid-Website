<?php
session_start();

include 'Connector.php';

$data = array();

if($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION['loggedin'] == true && $_SESSION['role'] == '1'){
  $query = mysqli_query($db,"SELECT stores.types FROM stores INNER JOIN user_visits ON stores.id = user_visits.id_store INNER JOIN covid_cases ON user_visits.User_id = covid_cases.id WHERE DATEDIFF(user_visits.Date_of_upload,covid_cases.Covid_date)>= -7 && DATEDIFF(user_visits.Date_of_upload,covid_cases.Covid_date)<= 14");

  while($row = mysqli_fetch_assoc($query)){
    array_push($data,$row);
  }

  echo json_encode($data, true);
}



?>
