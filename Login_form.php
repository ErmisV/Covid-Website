<!DOCTYPE html>
	<html>
		<head>
			<title>Welcome to our app</title>
			 <meta http-equiv="pragma" content="no-cache" />
			<link rel="stylesheet" href="Style.css">
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
			<script src="sweetalert2.min.js"></script>
			<link rel="stylesheet" href="sweetalert.min.css">
			<script type="text/javascript" src="Login_check.js"></script>
		</head>
		<body>
			<p id="demo"></p>
			<div class="wrapper fadeInDown">     <div id="formContent">     <div class="container">
				<div class="container">
					<img src="images/user_login.png" class="user">

					<div class="header">

						<h2>Login In</h2>

					</div>


						<div>

							<label for="username"> </label>
							<input type="text" name="name" class="form-control" placeholder="Username..." required>

						</div>


						<div>

							<label for="password"></label>
							<input type="password" name="pass" class="form-control" placeholder="Password..." required>

						</div>
						<button type="submit" onclick="Login()"> Log In </button>
						<div id="formFooter">
							<p>Not a user?<a href="Registration_form.php"><b><br>Register Here</b></a></p>
						</div>
					</form>

				</div>
			</div>
			</div>
			</div>
		</body>
	</html>
