<!DOCTYPE html>
	<html>
		<head>
			<title>Registration Form</title>
			<link rel="stylesheet" href="Style.css">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
			<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
			<script src="sweetalert2.min.js"></script>
			<link rel="stylesheet" href="sweetalert.min.css">


			<script type="text/javascript" src="Registration_check.js"></script>
			<style>
			
			html {
	background-color: #F08080;
}

body {
    margin: 0;
    padding: 0;
    background: url(bg.jpg);
    background-size: cover;
    font-family: sans-serif;
}
a {
	color: #E9967A;
	display:inline-block;
	text-decoration: none;
	font-weight: 400;
}
h2 {
	text-align: center;
	font-size: 16px;
	font-weight: 600;
	text-transform: uppercase;
	display:inline-block;
	margin: 40px 8px 10px 8px; 
	color: #0d0d0d;
	border-bottom: 2px solid #cc66ff;
}

h1 {
	text-align: center; 
	font-size:30px;
	text-transform: uppercase;
	margin: 40px 8px 10px 8px; 
}

.wrapper {
  display: flex;
  align-items: center; 
  flex-direction: column; 
  justify-content: center;
  width: 100%;
  min-height: 100%;
  padding: 20px;
}
.user{
    width: 100px;
    height: 100px;
    border-radius: 50%;
    overflow: hidden;
    position: absolute;
    top: calc(-10px/2);
    left: calc(50% - 50px);
}


#formContent {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    margin-top: 300px;
    width: 350px;
    height: 522px;
    padding: 50px;
    border-radius: 10px;
    box-sizing: border-box;
    background: rgba(0,0,0,.5);
}

#formFooter {
	background-color:#f6f6f6;
	border-top: 1px solid #dce8f1;
	width: 260px;
    height: 100px;
	padding: 20px;
	text-align: center;
	-webkit-border-radius: 0 0 10px 10px;
	border-radius: 0 0 10px 10px;
}

 button[type=submit]  {
	background-color: #cc66ff;
	border: none;
	color: white;
	padding: 15px 80px;
	text-align: center;
	text-decoration: none;
	display: inline-block;
	text-transform: uppercase;
	font-size: 13px;
	-webkit-box-shadow: 0 10px 30px 0 
	rgba(95,186,233,0.4);
	box-shadow: 0 10px 30px 0 rgba(195, 95, 2330.4);
	-webkit-border-radius: 5px 5px 5px 5px;
	border-radius: 5px 5px 5px 5px;
	margin: 5px 20px 40px 20px;
	-webkit-transition: all 0.3s ease-in-out;
	-moz-transition: all 0.3s ease-in-out;
	transition: all 0.3s ease-in-out;
}

 button[type=submit]:hover {
  background-color: #eeccff;
}

input[type=text] , input[type=password], input[type=email]{
	background-color: #f6f6f6;
	border: none;
	color: #0d0d0d;
	padding: 15px 32px;
	text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 13px;
    width: 85%;
    border: 2px solid #f6f6f6;
    -webkit-transition: all 0.5s ease-in-out;
 	-moz-transition: all 0.5s ease-in-out;
	transition: all 0.5s ease-in-out;
	-webkit-border-radius: 5px 5px 5px 5px;
	border-radius: 5px 5px 5px 5px;
}

input[type=text]:focus , input[type=password]:focus{
  background-color: #fff;
  border-bottom: 2px solid #5fbae9;
}

input[type=text]:placeholder  , input[type=password]:placeholder {
  color: #cccccc;
}

	



.fadeInDown {
  -webkit-animation-name: fadeInDown;
  animation-name: fadeInDown;
  -webkit-animation-duration: 1s;
  animation-duration: 1s;
  -webkit-animation-fill-mode: both;
  animation-fill-mode: both;
}

@-webkit-keyframes fadeInDown {
  0% {
    opacity: 0;
    -webkit-transform: translate3d(0, -100%, 0);
    transform: translate3d(0, -100%, 0);
  }
  100% {
    opacity: 1;
    -webkit-transform: none;
    transform: none;
  }
}

@keyframes fadeInDown {
  0% {
    opacity: 0;
    -webkit-transform: translate3d(0, -100%, 0);
    transform: translate3d(0, -100%, 0);
  }
  100% {
    opacity: 1;
    -webkit-transform: none;
    transform: none;
  }
}

*:focus {
    outline: none;
} 

#icon {
  width:60%;
}

* {
  box-sizing: border-box;
}
			</style>
		</head>
		<body>
			<div class="wrapper fadeInDown">     <div id="formContent">     <div class="container">
				<div class="container">

					<div class="header">

						<h2>Register</h2>

					</div>



						<div>

							<label for="username"> </label>
							<input type="text" class="form-control" name="name" placeholder="Username..." required>

						</div>

						<div>

							<label for="email"></label>
							<input type="email" class="form-control" name="email" placeholder="Email..." required>

						</div>

						<div>

							<label for="password"></label>
							<input type="password" class="form-control" name="pass" placeholder="Password..." required>

						</div>
						<div>

							<label for="password"></label>
							<input type="password" class="form-control" name="repeat_pass" placeholder="Repeat Password..." required>

						</div>

						<button type="submit" name="reg_user" onclick = "register_user()" >Submit</button>
						<div id="formFooter">
							<p>Already a user?<a href="Login_form.php"><b><br>Log in</b></a></p>
						</div>



					</form>



				</div>
			</div>
			</div>
			</div>
		</body>
	</html>
