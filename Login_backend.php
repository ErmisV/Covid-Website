<?php
	session_start();

	include 'Connector.php';

	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		//Take the data from javascript
		$username=$_POST["username"];
		$password=$_POST["password"];


		//check pass and do the login
		$rslt = mysqli_query($db, "SELECT * FROM users WHERE Usersusername = '$username'");

		//If 1 then the given data connects to user already registered to our database
		if (mysqli_num_rows($rslt) === 1){

			$row = mysqli_fetch_assoc($rslt);//fetch a result row as an associative array
			if(password_verify($password,$row['Userspwd'])){

				$_SESSION['client_id'] =$row['UsersId'];
				$_SESSION['name'] = $username;
				$_SESSION['loggedin'] = true;

				$client_id = $_SESSION['client_id'];

				$role_result = mysqli_query($db,"SELECT role_id FROM user_roles WHERE user_id = '$client_id' ");
				$role = mysqli_fetch_array($role_result);
				
				$_SESSION['role'] = $role['role_id'];
				if($role['role_id'] == 0){
					echo "user";//Login for simple user
				}
				else{
					echo "admin";//Login for administrator
				}
			} else{
				echo "wrong pass";//Wrong password
			}

		} else{
			echo "no user";//User not found
		}
	}
?>
