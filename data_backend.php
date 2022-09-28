<?php
session_start();

include 'Connector.php';

if($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION['loggedin'] == true){

  $count_cases = 0;

  $positive = mysqli_query($db,"SELECT DATEDIFF(covid_cases.Covid_date, user_visits.Date_of_upload) AS Difference FROM user_visits INNER JOIN covid_cases ON user_visits.User_id = covid_cases.id");
  $data="SELECT count(*) AS user_visits FROM user_visits; ";
  $data .= "SELECT count(*) AS covid_case FROM covid_cases;";


  while($row = mysqli_fetch_assoc($positive)) {
    if($row['Difference']>=-7 && $row['Difference']<=14) {
      $count_cases = $count_cases + 1;
    }
  }

  if(mysqli_multi_query($db,$data)){
    $JSON = array();
    do{
      if($result = mysqli_store_result($db)){
        while($row = mysqli_fetch_assoc($result)){
          array_push($JSON,$row);
        }
      //mysqli_free_result($result);
      }
    }while(mysqli_next_result($db));
  }

  array_push($JSON,array('positive'=>$count_cases));
  
  echo json_encode($JSON,true);

}


?>
