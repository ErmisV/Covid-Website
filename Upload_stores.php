<?php
session_start();

function alertBox($message) {

  echo "<script>alert('$message');</script>";
}



//connect to db
include 'Connector.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $my_data = $_POST['data'];

  //$my_data = mysqli_real_escape_string($db,$my_data);
  $my_data = json_decode($my_data, true);
  $datetime = date('Y-m-d H:i:s');
  $count =0;



  for($i=0; $i<sizeof($my_data); $i++){
    $data_id = "null";
    $data_name = "null";
    $data_address = "null";
    $data_rating = "null";
    $data_rating_n = "null";
    $data_types = "null";
    $data_lat = "null";
    $data_lng = "null";

    if(isset($my_data[$i]['id'])){
          $data_id = $my_data[$i]['id'];
    }
    if(isset($my_data[$i]['name'])){
          $data_name = $my_data[$i]['name'];
    }
    if(isset($my_data[$i]['address'])){
          $data_address = $my_data[$i]['address'];
    }
    if(isset($my_data[$i]['rating'])){
          $data_rating = $my_data[$i]['rating'];
    }
    if(isset($my_data[$i]['rating_n'])){
          $data_rating_n = $my_data[$i]['rating_n'];
    }
    if(isset($my_data[$i]['types'])){
          $data_types = $my_data[$i]['types'];
    }
    if(isset($my_data[$i]['lat'])){
          $data_lat = $my_data[$i]['lat'];
    }
    if(isset($my_data[$i]['lng'])){
          $data_lng = $my_data[$i]['lng'];
    }



    $sql = "INSERT INTO stores (id, Name, Address,Rating,Rating_number,lat,lng,types,DATES) VALUES ('$data_id', '$data_name', '$data_address', '$data_rating', '$data_rating_n', '$data_lat',  '$data_lng','$data_types','$datetime')";
    mysqli_query($db, $sql);

    for($j=0; $j<sizeof($my_data[$i]['days_name']); $j++){
      $day_name = $my_data[$i]['days_name'][$j];
      $day0 = $my_data[$i]['days_data'][$j][0];
      $day1 = $my_data[$i]['days_data'][$j][1];
      $day2 = $my_data[$i]['days_data'][$j][2];
      $day3 = $my_data[$i]['days_data'][$j][3];
      $day4 = $my_data[$i]['days_data'][$j][4];
      $day5 = $my_data[$i]['days_data'][$j][5];
      $day6 = $my_data[$i]['days_data'][$j][6];
      $day7 = $my_data[$i]['days_data'][$j][7];
      $day8 = $my_data[$i]['days_data'][$j][8];
      $day9 = $my_data[$i]['days_data'][$j][9];
      $day10 = $my_data[$i]['days_data'][$j][10];
      $day11 = $my_data[$i]['days_data'][$j][11];
      $day12 = $my_data[$i]['days_data'][$j][12];
      $day13 = $my_data[$i]['days_data'][$j][13];
      $day14 = $my_data[$i]['days_data'][$j][14];
      $day15 = $my_data[$i]['days_data'][$j][15];
      $day16 = $my_data[$i]['days_data'][$j][16];
      $day17 = $my_data[$i]['days_data'][$j][17];
      $day18 = $my_data[$i]['days_data'][$j][18];
      $day19 = $my_data[$i]['days_data'][$j][19];
      $day20 = $my_data[$i]['days_data'][$j][20];
      $day21 = $my_data[$i]['days_data'][$j][21];
      $day22 = $my_data[$i]['days_data'][$j][22];
      $day23 = $my_data[$i]['days_data'][$j][23];

      $result = "INSERT INTO data_pop(id,day,data_0,data_1,data_2,data_3,data_4,data_5,data_6,data_7,data_8,data_9,data_10,data_11,data_12,data_13,data_14,data_15,data_16,data_17,data_18,data_19,data_20,data_21,data_22,data_23) VALUES ('".$my_data[$i]['id']."', '$day_name', '$day0', '$day1', '$day2', '$day3','$day4','$day5', '$day6', '$day7', '$day8', '$day9', '$day10', '$day11', '$day12', '$day13', '$day14', '$day15', '$day16', '$day17', '$day18', '$day19', '$day20', '$day21', '$day22', '$day23')";
      if (mysqli_query($db, $result)) {
        echo "New record created successfully";
      } else {
          echo "Error: " . $result . "<br>" . mysqli_error($result). "<br>";
      }


    }
  }
}




?>
