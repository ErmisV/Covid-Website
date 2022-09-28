<?php

session_start();

include 'Connector.php';

$data = array();

if($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION['loggedin'] == true){
  $query = mysqli_query($db,"SELECT * from stores");

  while($row = mysqli_fetch_assoc($query)){
    array_push($data, array('id'=>$row['id'], 'name'=>$row['Name'], 'address'=>$row['Address'], 'loc'=>[$row['lat'],$row['lng']]));
  }

  echo json_encode($data, true);
}


?>
