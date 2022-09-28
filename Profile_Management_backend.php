<?php
session_start();

include 'Connector.php';



if($_SESSION['loggedin'] == true){

  //Take the data from form-javascript
  $username = $_POST['username'];
  $pass= $_POST['password'];
  $old_pass= $_POST['old_password'];

  //Take the user id
  $client_id = $_SESSION['client_id'];
  

  //chek
  $check = mysqli_query($db,"SELECT Userspwd,UsersId,Usersusername from users WHERE UsersId='$client_id'");


    while($row = mysqli_fetch_assoc($check)){
		$pass_mysql = $row['Userspwd'];
		$id = $row['UsersId'];
		$user_mysql = $row['Usersusername'];
    }
  

  $user_check = mysqli_query($db, "SELECT Usersusername,UsersId FROM users WHERE Usersusername = '$username'");

    while($row = mysqli_fetch_assoc($user_check)){
		$id_check = $row['UsersId'];
		$username_check = $row['Usersusername'];
    }

  //When user changes username
	if(mysqli_num_rows($user_check)==0){
		if(password_verify($old_pass,$pass_mysql)){//Change user and pass
			if($pass!=$old_pass){
				$hashed_pwd = password_hash($pass,PASSWORD_DEFAULT);
				mysqli_query($db,"UPDATE users SET Usersusername = '$username', Userspwd='$hashed_pwd' WHERE UsersId = '$client_id'");
				echo 1;
			else{
				mysqli_query($db,"UPDATE users SET Usersusername = '$username' WHERE UsersId = '$client_id'");
				echo 1;
			}
		} else{//Wrong pass
			echo 2;
			}
		}	 //when user is just changing password
	elseif(mysqli_num_rows($user_check)!==0 && $client_id == $id_check){//Same user change pss
		if(password_verify($old_pass,$pass_mysql)){//Change user and pass 
			$hashed_pwd = password_hash($pass,PASSWORD_DEFAULT);
			mysqli_query($db,"UPDATE users SET Userspwd = '$hashed_pwd' WHERE UsersId = '$client_id'");
			echo 1;
		}
		else{//Wrong pass
		echo 2;
		}
	}
	else{//Put another username
		echo 3;
	}
}




?>
