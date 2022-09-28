<?php

session_start();

//connect to db
include 'Connector.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $bool_val = $_POST['bool_value'];

  if($bool_val == true){
    if (mysqli_query($db,"DELETE from stores")) {
      echo "New record created successfully";
    } else {
        echo "Error: " . $result . "<br>" . mysqli_error($result). "<br>";
    }
  }
}



?>
