<?php
session_start();

include "Connector.php";

if($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION['loggedin'] == true){

  $datetime = date('Y-m-d H:i:s');
  $client_id = $_SESSION['client_id'];
  $JSON = array();
  $store_data = array();
  $store_data_1 = array();
  $common_stores = array();

  $positive_id=mysqli_query($db,"SELECT id, Covid_date FROM covid_cases WHERE DATEDIFF('$datetime',Covid_date)<=7");//Last 7 days of positive users



  while($row = mysqli_fetch_assoc($positive_id)){
    if (in_array($row,$JSON) == false){
      array_push($JSON,$row);
    }
  }

  for($i=0;$i<sizeof($JSON);$i++){
    $positive_id = $JSON[$i]['id'];
    $covid_date = $JSON[$i]['Covid_date'];

    $stores_user = mysqli_query($db,"SELECT id_store, Name, Date_of_upload FROM user_visits WHERE User_id='$client_id' ");//Stores that the user of the app visited at last 7 days
    $stores_positive_b = mysqli_query($db,"SELECT id_store, Name, Date_of_upload FROM user_visits WHERE User_id = '$positive_id' && DATEDIFF('$covid_date', Date_of_upload)<=7");//Stores that the positive users visited in span of 7 days after their covid declaration

    while($row = mysqli_fetch_assoc($stores_positive_b)){
      array_push($store_data,$row);
    }

    while($row = mysqli_fetch_assoc($stores_user)){
      if(in_array($row, $store_data_1) == false){
        array_push($store_data_1, $row);
      }
    }

  }

  for($i=0;$i<sizeof($store_data_1);$i++){
    for($j=0;$j<sizeof($store_data);$j++){
      $time_0 = strtotime($store_data_1[$i]['Date_of_upload']);
      $time_1 = strtotime($store_data[$j]['Date_of_upload']);
		//change
      if($store_data_1[$i]['id_store'] == $store_data[$j]['id_store'] && abs($time_0 - $time_1)>7200){
        array_push($common_stores,array('user_b'=>$store_data_1[$i],'other_users_b'=>$store_data[$j]));
      }
    }
  }



echo json_encode($common_stores, true);


}












?>
