<?php
session_start();

include 'Connector.php';



if($_SESSION['loggedin'] == true){
  $JSON = array();
  $id = $_SESSION['client_id'];

  $print_values = mysqli_query($db,"SELECT Address,Name,lat,lng,Date_of_upload FROM user_visits WHERE User_id='$id'");
  $covid_cases = mysqli_query($db,"SELECT count(*) FROM covid_cases WHERE id='$id'");
  $covid_date = mysqli_query($db,"SELECT Covid_date FROM covid_cases WHERE id='$id'");

  $array = mysqli_fetch_assoc($covid_cases);
  $date = mysqli_fetch_assoc($covid_date);



  foreach($array as $value){
    $count = $value;
  }

    while($row = $print_values->fetch_assoc()){
      array_push($JSON,array('Address'=>$row['Address'],'name'=>$row['Name'],'loc'=>[$row['lat'],$row['lng']],'Date_of_visit'=>$row['Date_of_upload']));
    }

    array_push($JSON,array('covid_date'=>$date));
    array_push($JSON,array('count'=>$count));

    echo json_encode($JSON,true);

}





?>
