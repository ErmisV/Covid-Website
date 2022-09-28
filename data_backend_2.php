<?php
session_start();

include 'Connector.php';

$data = array();

if($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION['loggedin'] == true && $_SESSION['role'] == '1'){
  $query = mysqli_query($db,"SELECT types FROM user_visits INNER JOIN stores ON user_visits.id_store = stores.id");

  while($row = mysqli_fetch_assoc($query)){
    array_push($data,$row);
  }

  echo json_encode($data, true);
}







?>
