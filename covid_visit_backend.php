<?php

session_start();

include "Connector.php";


if($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION['loggedin'] == true){

  $JSON = array();
  $store_data_0 = array();
  $store_data_1 = array();
  $store_data_2 = array();
  $common_stores = array();

  $client_id = $_SESSION['client_id'];
  $datetime = date('Y-m-d H:i:s');


  $positive_id=mysqli_query($db,"SELECT id, Covid_date FROM covid_cases WHERE DATEDIFF('$datetime',Covid_date)<=7");//Last 7 days of positive users

  while($row = mysqli_fetch_assoc($positive_id)){
    if (in_array($row,$JSON) == false){
      array_push($JSON,$row);
    }
  }

  for ($i=0;$i<sizeof($JSON);$i++){
    $positive_id = $JSON[$i]['id'];
    $covid_date = $JSON[$i]['Covid_date'];


    $stores_positive = mysqli_query($db,"SELECT id_store, Name, Date_of_upload FROM user_visits WHERE User_id='$positive_id'  ");//Stores that the positive users visited. This is not needed at select && DATEDIFF('$datetime', Date_of_upload)<=7
    $stores_user = mysqli_query($db,"SELECT id_store, Name, Date_of_upload FROM user_visits WHERE User_id='$client_id' ");//Stores that the user of the app visited at last 7 days

    while($row = mysqli_fetch_assoc($stores_positive)){
      if (in_array($row,$store_data_0) == false){
        array_push($store_data_0,$row);
      }
    }

    while($row = mysqli_fetch_assoc($stores_user)){
      if(in_array($row, $store_data_1) == false){
        array_push($store_data_1,$row);
      }
    }


  }

  for ($i=0;$i<sizeof($store_data_0);$i++) {
    for ($j=0;$j<sizeof($store_data_1);$j++) {

          $time_0 = strtotime($store_data_0[$i]['Date_of_upload']);
          $time_1 = strtotime($store_data_1[$j]['Date_of_upload']);

          if ( ($store_data_0[$i]['id_store'] == $store_data_1[$j]['id_store']) && abs($time_0 - $time_1)<=7200)  {
            array_push($common_stores,array('user'=>$store_data_1[$j],'other_users'=>$store_data_0[$i]));

          }

      }
    }

  echo json_encode($common_stores, true);

}


?>
