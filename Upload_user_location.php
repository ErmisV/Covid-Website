<?php
session_start();
include "Connector.php";

if($_SERVER["REQUEST_METHOD"]=="POST" && $_SESSION['loggedin'] == true){
  $Upload_data = $_POST['q'];
  $datetime = date('Y-m-d H:i:s');
  $lat = $Upload_data['lat'];
  $lng = $Upload_data['lng'];
  $name = $Upload_data['name'];
  $Address = $Upload_data['Address'];
  $store_id = $Upload_data['id'];
  $estimation = $Upload_data['estimate'];

  $client_id = $_SESSION['client_id'];

  $result = mysqli_query($db,"INSERT INTO user_visits(User_id,id_store,Address,Name,lat,lng,Date_of_upload,estimation) VALUES('$client_id','$store_id','$Address','$name','$lat','$lng','$datetime','$estimation')");
  echo 0;
}





?>
