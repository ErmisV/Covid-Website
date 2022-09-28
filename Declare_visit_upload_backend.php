<?php
session_start();
include "Connector.php";

if($_SERVER["REQUEST_METHOD"]=="POST" && $_SESSION['loggedin'] == true){

  //Get data from javascript
  $JSON = $_POST['json'];

  //current datetime
  //change
  date_default_timezone_set('Europe/Athens');
  $today_datetime = date('Y-m-d H:i:s');
  
  //store info
  $store_latitude = $JSON['loc'][0];
  $store_longitude = $JSON['loc'][1];
  $store_name = $JSON['name'];
  $store_address = $JSON['address'];
  $store_id = $JSON['id'];
  $estimation = $JSON['estimation'];

  //Get current logged user id in order to know which user uploaded his Visit
  $client_id = $_SESSION['client_id'];

   mysqli_query($db,"INSERT INTO user_visits(User_id,id_store,Address,Name,lat,lng,Date_of_upload,estimation) VALUES('$client_id','$store_id','$store_address','$store_name','$store_latitude','$store_longitude','$today_datetime','$estimation')");
}


  ?>
